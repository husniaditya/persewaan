<!-- START Sidebar Content -->
<section class="content slimscroll">
    <!-- START Template Navigation/Menu -->
    <ul class="topmenu topmenu-responsive" data-toggle="menu">
        <li>
            <a href="dashboard.php" data-target="#dashboard" data-parent=".topmenu">
                <span class="figure"><i class="fa-solid fa-palette"></i></span>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li>
            <a >
                <span class="figure"><i class="fa-solid fa-database"></i></span>
                <span class="text">Master</span>
            </a>
            <!-- START 2nd Level Menu -->
            <ul id="master" class="submenu">
                <li class="submenu-header ellipsis">Master</li>
                <li>
                    <a href="pengguna.php">
                        <span class="text"><i class="fa-solid fa-user-group"></i> Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="kategori.php">
                        <span class="text"><i class="fa-solid fa-boxes-stacked"></i> Kategori Alat</span>
                    </a>
                </li>
                <li>
                    <a href="barang.php">
                        <span class="text"><i class="fa-solid fa-box"></i> Alat</span>
                    </a>
                </li>
                <li>
                    <a href="jenispekerjaan.php">
                        <span class="text"><i class="fa-solid fa-list-check"></i> Jenis Pekerjaan</span>
                    </a>
                </li>
            </ul>
            <!--/ END 2nd Level Menu -->
        </li>
        <li>
            <a >
                <span class="figure"><i class="fa-regular fa-pen-to-square"></i></span>
                <span class="text">Transaksi</span>
            </a>
            <!-- START 2nd Level Menu -->
            <ul id="transaksi" class="submenu">
                <li class="submenu-header ellipsis">Transaksi</li>
                    <a href="pengeluaran.php">
                        <span class="text"><i class="fa-solid fa-right-from-bracket"></i> Peminjaman Alat</span>
                    </a>
                </li>
                <li>
                    <a href="pemasukan.php">
                        <span class="text"><i class="fa-solid fa-right-to-bracket"></i> Pengembalian Alat</span>
                    </a>
                </li>
            </ul>
            <!--/ END 2nd Level Menu -->
        </li>
        <li>
            <a >
                <span class="figure"><i class="fa-solid fa-user-check"></i></span>
                <span class="text">Persetujuan</span>
            </a>
            <!-- START 2nd Level Menu -->
            <ul id="transaksi" class="submenu">
                <li class="submenu-header ellipsis">Persetujuan</li>
                <li>
                    <a href="persetujuanpengeluaran.php">
                        <span class="text"><i class="fa-solid fa-clipboard-check"></i> Persetujuan Peminjaman</span>
                    </a>
                </li>
            </ul>
            <!--/ END 2nd Level Menu -->
        </li>
        <li>
            <a >
                <span class="figure"><i class="fa-regular fa-folder-open"></i></span>
                <span class="text">Laporan</span>
            </a>
            <!-- START 2nd Level Menu -->
            <ul id="laporan" class="submenu">
                <li class="submenu-header ellipsis">Laporan</li>
                <li>
                    <a href="laporanpengeluaran.php">
                        <span class="text"><i class="fa-regular fa-file-pdf"></i> Laporan Peminjaman</span>
                    </a>
                </li>
                <li>
                    <a href="laporanpemasukan.php">
                        <span class="text"><i class="fa-regular fa-file-pdf"></i> Laporan Pengembalian </span>
                    </a>
                </li>
                <li>
                    <a href="laporanstok.php">
                        <span class="text"><i class="fa-regular fa-file-pdf"></i> Laporan Stok</span>
                    </a>
                </li>
            </ul>
            <!--/ END 2nd Level Menu -->
        </li>
    </ul>
    <!--/ END Template Navigation/Menu -->
</section>
<!--/ END Sidebar Container -->
