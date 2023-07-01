<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// $routes->group('elibrary', function($routes) {
//     $routes->get('/', 'CClient::index');

//     $routes->get('login', 'CLogin::index');
//     $routes->post('login/process', 'CLogin::processLogin');
//     $routes->get('admin/logout/process', 'CLogin::processLogout');
    
//     $routes->get('register', 'CRegister::index');
//     $routes->post('register/create', 'CRegister::createAccount');

//     $routes->get('login/forgot-password', 'CForgotPassword::index');
//     $routes->post('login/forgot-password/check', 'CForgotPassword::checkEmail');
//     $routes->post('login/forgot-password/verification', 'CForgotPassword::verificationPin');
//     $routes->post('login/forgot-password/reset', 'CForgotPassword::resetPassword');

//     $routes->get('admin', 'CAdmin::index');
//     $routes->get('admin/account', 'CAdmin::Account');
//     $routes->post('admin/account/edit', 'CAdmin::updateProfile');
//     $routes->post('admin/account/change', 'CAdmin::changePassword');
//     $routes->post('admin/account/delete', 'CAdmin::deleteAccount');

//     $routes->get('admin/daftar-buku', 'CBuku::index');
//     $routes->post('admin/daftar-buku/create', 'CBuku::createBuku');
//     $routes->post('admin/daftar-buku/edit/(:num)', 'CBuku::updateBuku/$1');
//     $routes->post('admin/daftar-buku/delete/(:num)', 'CBuku::deleteBuku/$1');

//     $routes->get('admin/daftar-kategori-buku', 'CKategoriBuku::index');
//     $routes->post('admin/kategori-buku/create', 'CKategoriBuku::createKategori');
//     $routes->post('admin/kategori-buku/edit/(:num)', 'CKategoriBuku::updateKategori/$1');
//     $routes->post('admin/kategori-buku/delete/(:num)', 'CKategoriBuku::deleteKategori/$1');

//     $routes->get('admin/daftar-murid', 'CMurid::index');
//     $routes->post('admin/daftar-murid/create', 'CMurid::createMurid');
//     $routes->post('admin/daftar_murid/edit/(:num)', 'CMurid::updateMurid/$1');
//     $routes->post('admin/daftar_murid/delete/(:num)', 'CMurid::deleteMurid/$1');

//     $routes->get('admin/data-peminjaman-buku', 'CPeminjamanBuku::index');
//     $routes->post('admin/data-peminjaman-buku/create', 'CPeminjamanBuku::createPeminjamanBuku');
//     $routes->post('admin/data-peminjaman-buku/edit/(:num)', 'CPeminjamanBuku::updatePeminjamanBuku/$1');
//     $routes->post('admin/data-peminjaman-buku/delete/(:num)', 'CPeminjamanBuku::deletePeminjamanBuku/$1');
//     $routes->post('admin/data-peminjaman-buku/action/(:num)', 'CPeminjamanBuku::moveToPengembalianBuku/$1');

//     $routes->get('admin/data-pengembalian-buku', 'CPengembalianBuku::index');
//     $routes->post('admin/data-pengembalian-buku/return/(:num)', 'CPengembalianBuku::returnPengembalianBeberapaBuku/$1');
// });

//YANG ATAS VERSI LAMA

$routes->group('elibrary', function($routes) {
    $routes->get('/', 'CClient::index');

    $routes->group('login', function($routes) {
        $routes->get('/', 'CLogin::index');
        $routes->post('process', 'CLogin::processLogin');
        
        $routes->group('forgot-password', function($routes) {
            $routes->get('/', 'CForgotPassword::index');
            $routes->post('check', 'CForgotPassword::checkEmail');
            $routes->post('verification', 'CForgotPassword::verificationPin');
            $routes->post('reset', 'CForgotPassword::resetPassword');
        });
    });

    $routes->group('register', function($routes) {
        $routes->get('/', 'CRegister::index');
        $routes->post('create', 'CRegister::createAccount');
    });

    $routes->group('admin', function($routes) {
        $routes->get('/', 'CAdmin::index');
        $routes->get('account', 'CAdmin::Account');
        $routes->get('logout/process', 'CLogin::processLogout');
        $routes->post('account/edit', 'CAdmin::updateProfile');
        $routes->post('account/change', 'CAdmin::changePassword');
        $routes->post('account/delete', 'CAdmin::deleteAccount');

        $routes->group('daftar-buku', function($routes) {
            $routes->get('/', 'CBuku::index');
            $routes->post('create', 'CBuku::createBuku');
            $routes->post('edit/(:num)', 'CBuku::updateBuku/$1');
            $routes->post('delete/(:num)', 'CBuku::deleteBuku/$1');
        });

        $routes->group('daftar-kategori-buku', function($routes) {
            $routes->get('/', 'CKategoriBuku::index');
            $routes->post('create', 'CKategoriBuku::createKategori');
            $routes->post('edit/(:num)', 'CKategoriBuku::updateKategori/$1');
            $routes->post('delete/(:num)', 'CKategoriBuku::deleteKategori/$1');
        });

        $routes->group('daftar-murid', function($routes) {
            $routes->get('/', 'CMurid::index');
            $routes->post('create', 'CMurid::createMurid');
            $routes->post('edit/(:num)', 'CMurid::updateMurid/$1');
            $routes->post('delete/(:num)', 'CMurid::deleteMurid/$1');
        });

        $routes->group('data-peminjaman-buku', function($routes) {
            $routes->get('/', 'CPeminjamanBuku::index');
            $routes->post('create', 'CPeminjamanBuku::createPeminjamanBuku');
            $routes->post('edit/(:num)', 'CPeminjamanBuku::updatePeminjamanBuku/$1');
            $routes->post('delete/(:num)', 'CPeminjamanBuku::deletePeminjamanBuku/$1');
            $routes->post('action/(:num)', 'CPeminjamanBuku::moveToPengembalianBuku/$1');
        });

        $routes->group('data-pengembalian-buku', function($routes) {
            $routes->get('/', 'CPengembalianBuku::index');
            $routes->post('return/(:num)', 'CPengembalianBuku::returnPengembalianBeberapaBuku/$1');
        });
    });
});

//$routes->get('/auth/logout', 'Auth::logout');

// Rute untuk mengakses folder elibrary
// $routes->add('elibrary', function() {
//     return view('elibrary/index');
// });

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
