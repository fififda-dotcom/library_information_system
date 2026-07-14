<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/dashboard', 'DashboardController::index');

$routes->get('/list/books', 'BookController::index');
$routes->get('/create/book', 'BookController::create');
$routes->post('/create/book', 'BookController::store');
$routes->get('/edit/book/(:num)', 'BookController::edit/$1');
$routes->post('/update/book', 'BookController::update');
$routes->post('/delete/book/(:num)', 'BookController::delete/$1');

$routes->get('/list/books/table', 'BookController::ajaxTable');
$routes->get('/ajax/create/book', 'BookController::ajaxCreate');

// Member Routes
// Member Routes
$routes->get('list/members', 'MemberController::index');
$routes->get('/create/member', 'MemberController::create');
$routes->post('/create/member', 'MemberController::store');
$routes->get('/edit/member/(:num)', 'MemberController::edit/$1');
$routes->post('/update/member', 'MemberController::update');
$routes->post('/delete/member/(:num)', 'MemberController::delete/$1');
$routes->get('/list/members/table', 'MemberController::ajaxTable');
$routes->get('/ajax/create/member', 'MemberController::ajaxCreate');

// Member Spark Routes
$routes->get('list/members-spark', 'MemberSparkController::index');

$routes->get('/create/member-spark', 'MemberSparkController::create');
$routes->post('/create/member-spark', 'MemberSparkController::store');

$routes->get('/edit/member-spark/(:num)', 'MemberSparkController::edit/$1');
$routes->post('/update/member-spark', 'MemberSparkController::update');

$routes->post('/delete/member-spark/(:num)', 'MemberSparkController::delete/$1');

$routes->get('/list/transactions', 'PeminjamanController::index');
$routes->get('list/transactions/table', 'PeminjamanController::ajaxTable');
$routes->get('/list/transactions/table', 'PeminjamanController::ajaxTable');
$routes->get('/ajax/create/transaction', 'PeminjamanController::ajaxCreate');
// Peminjaman Routes
$routes->get('/peminjaman', 'PeminjamanController::index');
$routes->post('/peminjaman/get-anggota', 'PeminjamanController::getAnggota');
$routes->get('/peminjaman/semua', 'PeminjamanController::semua');
$routes->post('/peminjaman/store', 'PeminjamanController::store');
$routes->post('/peminjaman/kembalikan/(:num)', 'PeminjamanController::kembalikan/$1');

$routes->get('/laporan/cetak-struk/(:num)', 'LaporanController::cetakStruk/$1');

$routes->get('/list/pengembalian', 'PengembalianController::index');
$routes->get('/list/pengembalian/table', 'PengembalianController::ajaxTable');
$routes->get('/ajax/create/pengembalian', 'PengembalianController::ajaxCreate');
$routes->get('/ajax/edit/pengembalian/(:num)', 'PengembalianController::ajaxEdit/$1');
$routes->post('/create/pengembalian', 'PengembalianController::store');
$routes->post('/update/pengembalian', 'PengembalianController::update');
$routes->post('/delete/pengembalian/(:num)', 'PengembalianController::delete/$1');

// Label Buku Routes
// Laporan Routes
$routes->get('/laporan/buku', 'LaporanController::buku');
$routes->get('/laporan/cetak-buku', 'LaporanController::cetakBuku');
$routes->get('/laporan/member', 'LaporanController::member');
$routes->get('/laporan/cetak-member', 'LaporanController::cetakMember');
$routes->get('/laporan/peminjaman', 'LaporanController::peminjaman');
$routes->get('/laporan/cetak-peminjaman', 'LaporanController::cetakPeminjaman');
$routes->get('/laporan/pengembalian', 'LaporanController::pengembalian');
$routes->get('/laporan/cetak-pengembalian', 'LaporanController::cetakPengembalian');
$routes->get('/laporan/denda', 'LaporanController::denda');
$routes->get('/laporan/cetak-denda', 'LaporanController::cetakDenda');

$routes->get('/laporan/label-buku', 'LaporanController::labelBuku');
$routes->get('/laporan/cetak-label-buku', 'LaporanController::cetakLabelBuku');
$routes->get('/laporan/cetak-label-buku/(:num)', 'LaporanController::cetakLabelSatu/$1');

