<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MAdmin;

use Config\Services;

class CRegister extends BaseController
{
    protected $modelAdmin;

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
    }

    public function index()
    {
        $data = [
            'title_web' => 'Register | E-Library',
            'judul' => 'Register Admin E-Library',
            'user' => $this->session->get('user'),
        ];
        return view('auth/register', $data);
    }

    public function createAccount()
    {
        //mengambil value email yang ada di form register
        $nama = $this->request->getVar('nama');
        $email = $this->request->getVar('email');
        $cek = $this->modelAdmin->where('email', $email)->first(); //mengambil data email yang ada didatabase

        $password = $this->request->getVar('password');
        $password_verifikasi = $this->request->getVar('password_verifikasi');

        $pin = $this->request->getVar('pin');

        //mencocokan email dengan yang ada didatabase
        if ($cek) {
            return redirect()->to('/elibrary/register')->with('error', 'Email sudah terdaftar. Silakan gunakan email lain.');
        }

        $password = $this->request->getVar('password');
        $password_verifikasi = $this->request->getVar('password_verifikasi');

        if (strlen($password) < 8) {
            // Password kurang dari 8 karakter, lakukan tindakan yang sesuai
            return redirect()->to('/elibrary/register')->with('error', 'Password minimal 8 karakter.');
        }

        if ($password !== $password_verifikasi) {
            // Password tidak sama dengan password verifikasi, lakukan tindakan yang sesuai
            return redirect()->to('/elibrary/register')->with('error', 'Password tidak sama dengan konfirmasi password.');
        }

        if (strlen($pin) == 0) {
            return redirect()->to('/elibrary/register')->with('error', 'PIN harus diisi.');
        }

        if (strlen($pin) < 6) {
            // PIN kurang dari 6 digit, lakukan tindakan yang sesuai
            return redirect()->to('/elibrary/register')->with('error', 'PIN harus 6 digit.');
        }

        $data = [
            'nama' => $this->request->getVar('nama'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'pin' => $this->request->getVar('pin'),
        ];

        $tujuan = FCPATH . 'images/profile/';
        $namaFileBaru = $email . $nama . '.jpg';

        $fileAsal = $tujuan . 'user.jpg';
        $fileTujuan = $tujuan . $namaFileBaru;

        copy($fileAsal, $fileTujuan);

        $this->modelAdmin->insert($data);

        //return $this->respond(['message' => 'Registrasi berhasil']);
        // Menggunakan redirect
        return redirect()->to('/elibrary/login')->with('success', 'Registrasi berhasil. Silakan masuk dengan akun yang telah didaftarkan.');
    }
}