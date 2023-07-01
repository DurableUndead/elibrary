<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use App\Models\MMember;

class CreateUser extends BaseCommand
{
    protected $group = 'user';
    protected $name = 'user:create';
    protected $description = 'Create a new user.';

    public function run(array $params)
    {
        //php spark user:create (MENJALANKAN MEMBUAT USER LEWAT CMD)

        $memberModel = new MMember();

        $name = '';
        $email = '';
        $password = '';
        $pin = '';

        do {
            $name = CLI::prompt('Enter name');
            if (empty($name)) {
                CLI::write("\e[31mName is required. Please try again.\n\e[0m");
            }
        } while (empty($name));

        do {
            $email = CLI::prompt('Enter email');
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                //CLI::write("\e[31mInvalid email format. Please try again.\n\e[0m");
                CLI::write("\e[31m[Invalid Email] Harus berformat email seperti : (kulkas123@gmail.com). Ulangi lagi!\n\e[0m");
            } elseif ($this->isEmailExists($email, $memberModel)) {
                //CLI::write("\e[31mEmail is already registered. Please try again with a different email.\n\e[0m");
                CLI::write("\e[31m[Invalid Email] Email sudah terdaftar. Daftarkan dengan email yang lain.\n\e[0m");
            }
        } while (!filter_var($email, FILTER_VALIDATE_EMAIL) || $this->isEmailExists($email, $memberModel));

        do {
            $password = CLI::prompt('Enter password (minimum 8 characters)');
            if (strlen($password) < 8) {
                //CLI::write("\e[31mPassword should be at least 8 characters long. Please try again.\n\e[0m");
                CLI::write("\e[31m[Invalid Password] Minimal Password harus 8 karakter. Ulangi lagi.\n\e[0m");
            }
        } while (strlen($password) < 8);

        do {
            $pin = CLI::prompt('Enter pin (1-6 digits)');
            if (!is_numeric($pin)) {
                CLI::write("\e[31m[Invalid PIN] Pin harus berupa angka.\n\e[0m");
            } elseif (strlen($pin) != 6) {
                CLI::write("\e[31m[Invalid PIN] Pin harus memiliki 6 digit.\n\e[0m");
            }
        } while (!is_numeric($pin) || strlen($pin) != 6);

        $data = [
            'nama' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'pin' => $pin,
        ];

        $memberModel->insert($data);

        CLI::write('User created successfully.');
    }

    protected function isEmailExists($email, $memberModel)
    {
        return $memberModel->where('email', $email)->countAllResults() > 0;
    }
}
