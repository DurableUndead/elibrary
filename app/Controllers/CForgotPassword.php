<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MAdmin;

use Config\Services;

class CForgotPassword extends BaseController
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
            'title_web' => 'Forgot Password | E-Library',
            'judul' => 'Forgot Password',
            'user' => $this->session->get('user'),
        ];
        return view('auth/forgot_password', $data);
    }

    public function checkEmail()
    {
        $email = $this->request->getPost('email');
        $cek = $this->modelAdmin->where('email', $email)->first();

        if (!$cek) {
            return redirect()->to('/elibrary/login/forgot-password')->with('error', 'Email tidak ditemukan. Silakan masukkan email yang telah didaftarkan.');
        } else {
            //$this->savedPin = $cek['pin'];
            session()->set('email', $email);
            return redirect()->to('/elibrary/login/forgot-password')->with('success_checkEmail', 'Email : ' . $email . ' ditemukan. Silakan masukkan PIN verifikasi ketika anda register sebelumnya.');
        }
    }

    public function verificationPin()
    {
        $enteredPin = $this->request->getVar('pin');
        $email = session('email');

        $user = $this->modelAdmin->where('email', $email)->first();
        $pin = $user['pin'];

        if ($enteredPin == $pin) {
            //session()->remove('email');
            return redirect()->to('/elibrary/login/forgot-password')->with('success_verificationPin', 'PIN verifikasi benar. Silakan ganti password Anda.');
        } else {
            return redirect()->to('/elibrary/login/forgot-password')->withInput()->with('error_pin', 'PIN verifikasi salah. Silakan coba lagi.');
            //return redirect()->back()->withInput()->with('error', 'PIN verifikasi salah. Silakan coba lagi.');
        }
    }

    public function resetPassword()
    {
        $newPassword = $this->request->getVar('password');
        $confirmPassword = $this->request->getVar('confirm_password');
        $email = $this->request->getVar('email');
        $resetPin = $this->request->getVar('reset_pin'); //checkbox
        $newPin = $this->request->getVar('new_pin');

        if (strlen($newPassword) < 8) {
            return redirect()->to('/elibrary/login/forgot-password')->with('error_resetPassword', 'Password minimal 8 karakter.');
        }

        if ($newPassword !== $confirmPassword) {
            return redirect()->to('/elibrary/login/forgot-password')->with('error_resetPassword', 'Password tidak sama dengan konfirmasi password.');
        }

        if ($resetPin === 'on') {
            if (strlen($newPin) == 0) {
                return redirect()->to('/elibrary/login/forgot-password')->with('error_resetPassword', 'PIN harus diisi.');
            }

            if (strlen($newPin) < 6) {
                return redirect()->to('/elibrary/login/forgot-password')->with('error_resetPassword', 'PIN harus 6 digit.');
            }
        }

        $data = [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT),
            'pin' => $newPin,
        ];

        if (!$resetPin) {
            unset($data['pin']);
        }

        $this->modelAdmin->where('email', $email)->set($data)->update();

        session()->remove('email');
        if ($resetPin === 'on') {
            return redirect()->to('/elibrary/login')->with('success', 'Ganti Password dan Pin telah berhasil. Silakan login dengan password baru Anda.');
        }
        return redirect()->to('/elibrary/login')->with('success', 'Ganti Password telah berhasil. Silakan login dengan password baru Anda.');
    }
}
