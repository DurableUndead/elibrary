<?php

use CodeIgniter\Session\SessionInterface;
use Config\Services;

if (!function_exists('checkLoggedIn')) {
    function checkLoggedIn(SessionInterface $session)
    {
        $loggedIn = $session->get('user');
        $response = Services::response();
        //print('Fungsi checkLoggedIn dijalankan');

        if (!$loggedIn) {
            //print('asdasd');
            $session->setFlashdata('error', 'Anda belum login!');
            return $response->redirect('/elibrary/login');
        } 
        // else 
        // {
        //     print('123123');
        //     //$response = Services::response();
        //     return $response->redirect('/elibrary/admin');
        // }
    }
}


// if (!function_exists('checkLoggedIn')) {
//     function checkLoggedIn($loggedIn)
//     {
//         //$session = \Config\Services::session();
//         //$loggedIn = $session->get('user');
//         $response = service('response');

//         if (!$loggedIn) {
//             //return redirect()->to('/login');
//             return $response->redirect('/elibrary/login');
//         }
//         else
//         {
//             $session->setFlashdata('error', 'Anda belum login!');
//             return $response->redirect('/elibrary/login');
//         }
//     }
// }

// <?php

// use CodeIgniter\Session\SessionInterface;
// use Config\Services;

// if (!function_exists('checkLoggedIn')) {
//     function checkLoggedIn(SessionInterface $session)
//     {
//         $loggedIn = $session->get('user');
//         print('Fungsi checkLoggedIn dijalankan');

//         if (!$loggedIn) {
//             print('asdasd');
//             //$session->setFlashdata('error', 'Anda belum login!');
//             $response = Services::response();
//             return $response->redirect('/elibrary/login');
//         } else {
//             print('123123');
//             $response = Services::response();
//             return $response->redirect('/elibrary/login');
//         }
//     }
// }