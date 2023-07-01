<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MAdminToken;
use App\Models\MAdmin;
use App\Models\MBuku;
use App\Models\MMurid;
use App\Models\MPeminjamanBuku;
use App\Models\MPengembalianBuku;

use Config\Services;

class CAdmin extends BaseController
{
    //protected $session;
    protected $modelBuku;
    protected $modelMurid;
    protected $modelAdmin;
    protected $modelPeminjaman;
    protected $modelPengembalian;
    protected $modelAdminToken;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        helper('auth'); // Config/Helpers/auth_helper.php
        checkLoggedIn($this->session);

        $this->modelBuku = new MBuku();
        $this->modelAdmin = new MAdmin();
        $this->modelMurid = new MMurid();
        $this->modelPeminjaman = new MPeminjamanBuku();
        $this->modelPengembalian = new MPengembalianBuku();
        $this->modelAdminToken = new MAdminToken();
    }

    public function index()
    {
        $data = [
            'title_web' => 'Dashboard Admin | E-Library',
            'judul' => 'Dashboard Admin',
            'user' => $this->session->get('user'),
            'totalBuku' => $this->modelBuku->countBooks(),
            'totalMurid' => $this->modelMurid->countMurid(),
            'totalPeminjaman' => $this->modelPeminjaman->countPeminjaman(),
            'totalPengembalian' => $this->modelPengembalian->countPengembalian(),
            // 'totalMember' => $this->modelMember->countMember(),
        ];

        echo view('templates/header', $data);
        echo view('templates/navbar', $data);
        echo view('templates/sidebar');
        echo view('admin/dashboard');
        echo view('templates/footer');
    }

    public function account()
    {
        
        $user = $this->session->get('user');
        $result = $this->modelAdmin->where('nama', $user['nama'])->first();

        $pin = null;
        if ($result !== null) {
            $pin = $result['pin'];
        }

        $data = [
            'title_web' => 'My Account | E-Library',
            'judul' => 'My Account',
            'user' => $user,
            'pin' => $pin,
        ];

        echo view('templates/header', $data);
        echo view('templates/navbar', $data);
        echo view('templates/sidebar');
        echo view('admin/myaccount');
        echo view('templates/footer');
    }

    public function UpdateProfile()
    {
        $memberId = $this->session->get("user.id");
        // $resetPin = $this->request->getVar('reset_pin'); //checkbox
        $changename = $this->request->getVar('changename');
        $changeemail = $this->request->getVar('changeemail');
        $changepin = $this->request->getVar('changepin');

        //Cek apakah ada file foto yang diupload
        $profilePhoto = $this->request->getFile('profile_photo');

        if ($profilePhoto && $profilePhoto->isValid() && !$profilePhoto->hasMoved() && $profilePhoto->getClientExtension() === 'jpg') {
            $newProfilePhotoName = $changeemail . $changename . '.jpg';
            $newProfilePhotoPath = 'images/profile/' . $newProfilePhotoName;

            // Create the directory if it doesn't exist
            // if (!is_dir(ROOTPATH . 'public/images/profile')) {
            //     mkdir(ROOTPATH . 'public/images/profile', 0777, true);
            // }
            // Menghapus foto profil lama jika ada
            $oldProfilePhotoPath = $newProfilePhotoPath;
            if (file_exists($oldProfilePhotoPath)) {
                unlink($oldProfilePhotoPath);
            }

            $profilePhoto->move(ROOTPATH . 'public/images/profile', $newProfilePhotoName);
            $data['profile_photo'] = $newProfilePhotoPath;
        } elseif (!$profilePhoto || $profilePhoto->getError() === 4) {
            // Tidak ada foto yang diunggah, tidak perlu melakukan tindakan apa pun
        } else {
            // Set pesan error
            session()->setFlashdata('error', 'Foto profil gagal diperbarui. Pastikan file yang diupload adalah file JPG.');

            return redirect()->to('/elibrary/admin/account');
        }


        $data = [
            'nama' => $changename,
            'email' => $changeemail,
            //'password' => $this->request->getPost('password'),
            'pin' => $changepin,
        ];

        // Update profil pengguna
        $this->modelAdmin->update($memberId, $data);

        // Update data di session
        $userData = $this->session->get('user');
        $userData['nama'] = $changename;
        $userData['email'] = $changeemail;
        $userData['pin'] = $changepin;
        $this->session->set('user', $userData);

        // Set pesan sukses
        session()->setFlashdata('success', 'Profil berhasil diperbarui.');

        return redirect()->to('/elibrary/admin/account');
    }

    public function ChangePassword()
    {
        $adminId = $this->session->get("user.id");

        $oldPassword = $this->request->getVar('oldpassword');
        $newPassword = $this->request->getVar('newpassword');
        $confirmPassword = $this->request->getVar('newconfirmpassword');

        // Cek apakah password lama sesuai
        $isAdmin = $this->modelAdmin->find($adminId);

        if (!password_verify($oldPassword, $isAdmin['password'])) {
            return redirect()->to('/elibrary/admin/account')->with('error', 'Password lama tidak sesuai.');
        }

        if (strlen($newPassword) < 8) {
            return redirect()->to('/elibrary/admin/account')->with('error', 'Password minimal 8 karakter.');
        }

        if ($newPassword !== $confirmPassword) {
            return redirect()->to('/elibrary/admin/account')->with('error', 'Password tidak sama dengan konfirmasi password.');
        }

        $data = [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT),
        ];

        // Update profil pengguna
        $this->modelAdmin->update($adminId, $data);

        // Update data di session
        $userData = $this->session->get('user');
        $userData['password'] = $newPassword;
        $this->session->set('user', $userData);

        // Set pesan sukses
        session()->setFlashdata('success', 'Password berhasil diperbarui.');

        return redirect()->to('/elibrary/admin/account');
    }

    public function DeleteAccount()
    {
        $nama = $this->session->get("user.nama");
        $email = $this->session->get("user.email");

        $memberId = $this->session->get("user.id");

        //menghapus token di tabel member_token dulu
        $this->modelAdminToken->where('member_id', $memberId)->delete();

        // Menghapus data member
        $this->modelAdmin->delete($memberId);

        // Hapus data di session
        $this->session->remove('user');

        //hapus foto
        $tujuan = FCPATH . 'images/profile/';
        $namaFileBaru = $email . $nama . '.jpg';
        $fileTujuan = $tujuan . $namaFileBaru;
        unlink($fileTujuan);

        // Set pesan sukses
        session()->setFlashdata('success', 'Akun berhasil dihapus.');
        return redirect()->to('/elibrary/login');
    }
}
