<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="<?= base_url('/') ?>" class="brand-link">
        <span class="brand-text font-weight-light ml-3">Library Information System</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">

                <li class="nav-item">
                    <a href="<?= base_url('/dashboard') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('/list/books') ?>" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Master Buku</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('/list/members') ?>" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Master Member</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>
                            Peminjaman
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('/peminjaman') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Peminjaman</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('/peminjaman/semua') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Peminjaman</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('list/pengembalian') ?>" class="nav-link <?= (url_is('list/pengembalian*')) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-undo-alt"></i>
                        <p>Transaksi Pengembalian</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('laporan/buku') ?>" class="nav-link <?= (url_is('laporan/buku*')) ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Buku</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('laporan/member') ?>" class="nav-link <?= (url_is('laporan/member*')) ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Member</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('laporan/peminjaman') ?>" class="nav-link <?= (url_is('laporan/peminjaman*')) ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Peminjaman</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('laporan/pengembalian') ?>" class="nav-link <?= (url_is('laporan/pengembalian*')) ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Pengembalian</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('laporan/denda') ?>" class="nav-link <?= (url_is('laporan/denda*')) ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Denda</p>
                            </a>
                        </li>
                            <li class="nav-item">
                            <a href="<?= base_url('/laporan/label-buku') ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cetak Label Buku</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>