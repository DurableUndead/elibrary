<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MAdminToken;
use App\Models\MAdmin;

use Config\Services;

class CLogin extends BaseController
{
    protected $modelAdmin;
    protected $modelAdminToken;

    public function __construct()
    {
        $this->session = \Config\Services::session();

        $loggedIn = $this->session->get('user');
        $response = Services::response();
        if ($loggedIn) {
            $this->session->setFlashdata('error', 'Anda sudah Login!');
            return $response->redirect('/elibrary/admin');
        }

        $this->modelAdmin = new MAdmin();
        $this->modelAdminToken = new MAdminToken();
    }

    public function index()
    {
        $data = [
            'title_web' => 'Login | E-Library',
            'judul' => 'Login Admin E-Library',
            'user' => $this->session->get('user'),
        ];
        return view('auth/login', $data);
    }

    public function processLogin()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $siAdmin = $this->modelAdmin->where('email', $email)->first();

        if (!$siAdmin) {
            //return $this->response->setJSON(['message' => 'Email tidak ditemukan'])->setStatusCode(400);
            return redirect()->to('/elibrary/login')->with('error', 'Email tidak ditemukan!');
        }

        if (!password_verify($password, $siAdmin['password'])) {
            //return $this->response->setJSON(['message' => 'Password tidak valid'])->setStatusCode(400);
            return redirect()->to('/elibrary/login')->with('error', 'Password tidak valid!');
        }

        $authKey = $this->generateRandomString();
        $this->modelAdminToken->insert([
            'admin_id' => $siAdmin['id'],
            'auth_key' => $authKey
        ]);

        $data = [
            'token' => $authKey,
            'user' => [
                'id' => $siAdmin['id'],
                'nama' => $siAdmin['nama'],
                'email' => $siAdmin['email'],
            ]
        ];

        $this->session->set($data);
        
        $this->session->setFlashdata('success', 'Anda telah berhasil login.');
        return redirect()->route('CAdmin::index');
        // return redirect()->route('CAdmin::index')->with('success', 'Anda telah berhasil login.');
        //return $this->response->setJSON($data)->setStatusCode(200);
    }

    private function generateRandomString($length = 100)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    public function processLogout()
    {
        $this->modelAdminToken = new MAdminToken();
        $memberId = $this->session->get("user.id");
        
        if ($memberId) {
            $this->modelAdminToken->where('admin_id', $memberId)->delete();
            $this->session->destroy();
        }
        // $this->session->setFlashdata('success', 'Anda Berhasil Logout!!');
        // return redirect()->to('/elibrary/login');
        // return redirect()->to('/elibrary/login')->with('success', 'Anda telah berhasil logout.');
        return redirect()->to('/elibrary/login?success=1');
    }
}
