<?php
if (isset($_GET['id']) && $_GET['method'] == 'view') {
    ?>
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold">Lihat Data Alat</h4>
            </div>
            <div class="page-header-section">
                <!-- Toolbar -->
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li >Master</li>
                        <li><a href="barang.php"> Alat</a></li>
                        <li class="active">Lihat  Alat</li>
                    </ol>
                </div>
                <!--/ Toolbar -->
            </div>
        </div>
        <!-- Page Header -->

        <!-- START row -->
        <form class="form" method="post" action="" data-parsley-validate>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label">Kategori Alat</label>
                        <input class="form-control" type="text" name="ID_KATEGORI" placeholder="Nama Kategori" value="<?= $NAMA_KATEGORI; ?>" readonly>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label">Nama Alat</label>
                        <input class="form-control" type="text" name="NAMA_BARANG" placeholder="Nama Alat" value="<?= $NAMA_BARANG; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label">KETERANGAN</label>
                        <textarea rows="4" class="form-control" name="KETERANGAN" placeholder="Keterangan" readonly><?= $KETERANGAN; ?></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Status</label>
                        <input class="form-control" type="text" name="SN" placeholder="Serial Number" value="<?= $STATUS_DETAIL; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="barang.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </form>
        <!--/ END row -->
    </div>
    <!--/ END Template Container -->
    <?php
}
elseif (isset($_GET['id']) && $_GET['method'] == 'edit') {
    ?>
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold">Ubah Data Alat</h4>
            </div>
            <div class="page-header-section">
                <!-- Toolbar -->
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li >Master</li>
                        <li><a href="barang.php"> Alat</a></li>
                        <li class="active">Ubah Alat</li>
                    </ol>
                </div>
                <!--/ Toolbar -->
            </div>
        </div>
        <!-- Page Header -->

        <!-- START row -->
        <form class="form" method="post" action="" data-parsley-validate>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label">Kategori Alat</label>
                        <select name="ID_KATEGORI" id="selectize-select" required="" class="form-control" data-parsley-error-message="Mohon pilih kategori alat" data-parsley-required>
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
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label">Nama Alat</label>
                        <input class="form-control" type="text" name="NAMA_BARANG" placeholder="Nama Alat" value="<?= $NAMA_BARANG; ?>" data-parsley-error-message="Mohon masukkan nama barang" data-parsley-required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="control-label">KETERANGAN</label>
                        <textarea rows="4" class="form-control" name="KETERANGAN" placeholder="Keterangan"><?= $KETERANGAN; ?></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label class="control-label">Status</label>
                        <select name="STATUS" id="selectize-select2" required="" class="form-control" data-parsley-required>
                            <option value="">-- Pilih Status --</option>
                            <option value="1" <?php if ($STATUS == 1) echo 'selected'; ?>>Aktif</option>
                            <option value="0" <?php if ($STATUS == 0) echo 'selected'; ?>>Tidak Aktif</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    &nbsp;&nbsp;&nbsp;
                    <a href="barang.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </form>
        <!--/ END row -->
    </div>
    <!--/ END Template Container -->
    <?php
}
else {
    ?>
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold">Tambah Data Alat</h4>
            </div>
            <div class="page-header-section">
                <!-- Toolbar -->
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li >Master</li>
                        <li><a href="barang.php"> Alat</a></li>
                        <li class="active">Tambah Alat</li>
                    </ol>
                </div>
                <!--/ Toolbar -->
            </div>
        </div>
        <!-- Page Header -->

        <!-- Form default layout -->
        <form class="form" method="post" action="" data-parsley-validate>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Kategori Alat</label>
                        <select name="ID_KATEGORI" id="selectize-select" required="" class="form-control" data-parsley-error-message="Mohon pilih kategori alat" data-parsley-required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php
                            foreach ($rowKategori as $dataKategori) {
                                extract($dataKategori);
                                ?>
                                <option value="<?= $ID_KATEGORI; ?>"><?= $NAMA_KATEGORI; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Nama Alat</label>
                        <input class="form-control" type="text" name="NAMA_BARANG" placeholder="Nama Alat" value="" data-parsley-error-message="Mohon masukkan nama barang" data-parsley-required>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Keterangan</label>
                        <textarea rows="4" class="form-control" name="KETERANGAN" placeholder="Keterangan"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    &nbsp;&nbsp;&nbsp;
                    <a href="barang.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
        </form>
        <!--/ Form default layout -->
    </div>
    <!--/ END Template Container -->
    <?php
}
?>

<!-- START To Top Scroller -->
<a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
<!--/ END To Top Scroller -->
