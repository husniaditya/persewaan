
<!-- START Template Container -->
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header page-header-block">
        <div class="page-header-section">
            <h4 class="title semibold">Transaksi Pengembalian Alat</h4>
        </div>
        <div class="page-header-section">
            <!-- Toolbar -->
            <div class="toolbar">
                <ol class="breadcrumb breadcrumb-transparent nm">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li >Transaksi</li>
                    <li class="active"> Pengembalian Alat</li>
                </ol>
            </div>
            <!--/ Toolbar -->
        </div>
    </div>
    <!-- Page Header -->

    <!-- START row -->
    <div class="row">
        <div class="col-lg-12">
            <a href="pemasukan_transaksi.php" class="btn btn-inverse mb5" ><i class="ico-plus2"></i> Tambah Pengembalian Alat</a>
        </div>
    </div>
    <br>
    <!--/ END row -->

    <!-- START row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" id="demo">
                <div class="panel-heading">
                    <h3 class="panel-title">Tabel Pengembalian Alat</h3>
                </div>
                <table class="table table-striped table-bordered" id="pemasukan-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID Pemasukan</th>
                            <th>Tanggal</th>
                            <th>ID Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Kondisi Pinjam</th>
                            <th>Kondisi Kembali</th>
                            <th>Keterangan</th>
                            <th>Dibuat Oleh</th>
                            <th>Dibuat Tanggal</th>
                            <th>Diubah Oleh</th>
                            <th>Diubah Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rowPemasukan as $dataPemasukan) {
                            extract($dataPemasukan);
                            ?>
                            <tr>
                                <td align="center">
                                    <form id="eventoption-form-<?= uniqid(); ?>" method="post" class="form">
                                        <div class="btn-group" style="margin-bottom:5px;">
                                            <button type="button" class="btn btn-primary mb5 dropdown-toggle" data-toggle="dropdown">Opsi <span class="caret"></span></button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="pemasukan_transaksi.php?method=view&id=<?= $ID_PEMASUKAN; ?>" style="color:#222222;"><i class="fa-solid fa-magnifying-glass"></i> Lihat</a></li>
                                                <li><a href="pemasukan_transaksi.php?method=edit&id=<?= $ID_PEMASUKAN; ?>" style="color:#00a5d2;"><span class="ico-edit"></span> Ubah</a></li>
                                                <li class="divider"></li>
                                                <li><a href="print_pemasukan.php?id=<?= $ID_PEMASUKAN; ?>" target="_blank" style="color:goldenrod;"><span class="ico-print"></span> Cetak</a></li>
                                                <li class="divider"></li>
                                                <li><a href="module/backend/transaksi/pemasukan/t_pemasukan.php?method=delete&id=<?= $ID_PEMASUKAN; ?>" onclick="return confirm('Hapus data ini ?')" style="color:firebrick;"><i class="fa-regular fa-trash-can"></i> Hapus</a></li>
                                            </ul>
                                        </div>
                                    </form>
                                </td>
                                <td align="center"><?= $ID_PEMASUKAN; ?></td>
                                <td align="center"><?= $TANGGAL_MASUK; ?></td>
                                <td align="center"><?= $ID_BARANG; ?></td>
                                <td><?= $NAMA_BARANG; ?></td>
                                <td align="center"><?= $NAMA_KATEGORI; ?></td>
                                <td align="center">
                                    <a href="<?= $FOTO_KELUAR; ?>" target="_blank">
                                        <img src="<?= createThumbnail($FOTO_KELUAR); ?>" alt="Thumbnail">
                                    </a>
                                    <br>
                                    Qty Pinjam: <?= $QTY_KELUAR; ?>
                                    <br>
                                    Kondisi Pinjam: <?= $KONDISI_KELUAR; ?>
                                </td>
                                <td align="center">
                                    <a href="<?= $FOTO_KEMBALI; ?>" target="_blank">
                                        <img src="<?= createThumbnail($FOTO_KEMBALI); ?>" alt="Thumbnail">
                                    </a>
                                    <br>
                                    Qty Kembali: <?= $QTY_KEMBALI; ?>
                                    <br>
                                    Kondisi Kembali: <?= $KONDISI_KEMBALI; ?>
                                </td>
                                <td align="center"><?= $KETERANGAN; ?></td>
                                <td align="center"><?= $CREATED_BY; ?></td>
                                <td align="center"><?= $CREATED_DATE; ?></td>
                                <td align="center"><?= $UPDATED_BY; ?></td>
                                <td align="center"><?= $UPDATED_DATE; ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ END row -->
</div>
<!--/ END Template Container -->

<!-- START To Top Scroller -->
<a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
<!--/ END To Top Scroller -->