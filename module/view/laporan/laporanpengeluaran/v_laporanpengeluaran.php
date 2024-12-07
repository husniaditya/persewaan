
<!-- START Template Container -->
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header page-header-block">
        <div class="page-header-section">
            <h4 class="title semibold">Laporan Peminjaman Alat</h4>
        </div>
        <div class="page-header-section">
            <!-- Toolbar -->
            <div class="toolbar">
                <ol class="breadcrumb breadcrumb-transparent nm">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li >Laporan</li>
                    <li class="active"> Laporan Peminjaman Alat</li>
                </ol>
            </div>
            <!--/ Toolbar -->
        </div>
    </div>
    <!-- Page Header -->

    <!-- START row -->
    <form role="form" action="" method="post" data-parsley-validate>
        <div class="row">  
            <div class="mb-4 col-md-3 col-12">
                <div class="form-group">
                    <label class="control-label"> Tanggal Periode Peminjaman</label>
                    <input type="text" class="form-control" id="datepicker11" name="TANGGAL_KELUAR_AWAL" value="<?= $TANGGAL_KELUAR_AWAL; ?>" readonly />
                </div> 
            </div>
            <div class="mb-4 col-md-3 col-12">
                <div class="form-group">
                    <label class="col-form-label" style="color: transparent;">.</label>
                    <input type="text" class="form-control" id="datepicker12" name="TANGGAL_KELUAR_AKHIR" value="<?= $TANGGAL_KELUAR_AKHIR; ?>" readonly />
                </div>  
            </div>
        </div>
        <div class="row">
            <div class="mb-4 col-md-3 col-12">
                <div class="form-group">
                    <label class="control-label"> ID Peminjaman</label>
                    <input type="text" name="ID_PENGELUARAN" class="form-control" value="<?= $ID_PENGELUARAN; ?>">
                </div>
            </div>
            <div class="mb-4 col-md-3 col-12">
                <div class="form-group">
                    <label class="control-label">Kategori Barang</label>
                    <select name="ID_KATEGORI" id="selectize-select" class="form-control" >
                        <option value="">-- Pilih Kategori --</option>
                        <?php
                        foreach ($rowKategori as $dataKategori) {
                            extract($dataKategori);
                            ?>
                            <option value="<?= $ID_KATEGORI; ?>" <?php if ($ID_KATEGORI == $ID_KATEGORI_EDIT) echo "selected"; ?>><?= $NAMA_KATEGORI; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>  
            </div>
            <div class="mb-4 col-md-3 col-12">
                <div class="form-group">
                    <label class="control-label"> Barang</label>
                    <select name="ID_BARANG" id="selectize-select2" class="form-control" >
                        <option value="">-- Pilih Barang --</option>
                        <?php
                        if (isset($_POST['cari'])) {
                            foreach ($rowBarang as $dataBarang) {
                                extract($dataBarang);
                                ?>
                                    <option value="<?= $ID_BARANG; ?>" <?php if ($ID_BARANG == $ID_BARANG_EDIT) echo "selected"; ?>><?= $NAMA_BARANG; ?></option>
                                <?php
                            }
                            ?>
                        <?php
                        }
                        ?>
                    </select>
                </div>  
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12 text-center">
                <button type="submit" name="cari" class="btn btn-info"><i class="fa fa-search"></i> Cari</button>
                <a href="laporanpengeluaran.php" class="btn btn-default"><i class="fa fa-rotate-left"></i> Reset</a>
            </div>
        </div>
    </form>
    <br>
    <!--/ END row -->

    <!-- START row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" id="demo">
                <div class="panel-heading">
                    <h3 class="panel-title">Tabel Laporan Peminjaman Alat</h3>
                </div>
                <table class="table table-striped table-bordered" id="laporanpengeluaran-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID Peminjaman</th>
                            <th>Tanggal</th>
                            <th>ID Alat</th>
                            <th>Nama Alat</th>
                            <th>Kategori</th>
                            <th>QTY</th>
                            <th>Kondisi Alat</th>
                            <th>Gambar</th>
                            <th>Jenis Pekerjaan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rowPengeluaran as $dataPengeluaran) {
                            extract($dataPengeluaran);
                            ?>
                            <tr>
                                <td>
                                    <a class="btn btn-inverse" href="print_pengeluaran.php?id=<?= $ID_PENGELUARAN; ?>" target="_blank"><span class="ico-print"></span> Cetak</a>
                                </td>
                                <td>
                                    <?= $ID_PENGELUARAN; ?><br>
                                    <span class="<?= $APPROVAL_BADGE; ?>"><i class="<?= $APPROVAL_CLASS; ?>"></i> <?= $STATUS_APPROVAL_DESK; ?> </span>
                                </td>
                                <td align="center"><?= $TANGGAL_KELUAR; ?></td>
                                <td align="center"><?= $ID_BARANG; ?></td>
                                <td><?= $NAMA_BARANG; ?></td>
                                <td align="center"><?= $NAMA_KATEGORI; ?></td>
                                <td align="center"><?= $QTY; ?></td>
                                <td align="center"><?= $KONDISI; ?></td>
                                <td align="center">
                                    <a href="<?= $FOTO; ?>" target="_blank">
                                        <img src="<?= createThumbnail($FOTO); ?>" alt="Thumbnail">
                                    </a>
                                </td>
                                <td><?= $NAMA_PEKERJAAN; ?></td>
                                <td align="center"><?= $KETERANGAN; ?></td>
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

