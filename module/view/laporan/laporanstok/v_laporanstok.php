
<!-- START Template Container -->
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header page-header-block">
        <div class="page-header-section">
            <h4 class="title semibold">Laporan Stok Alat</h4>
        </div>
        <div class="page-header-section">
            <!-- Toolbar -->
            <div class="toolbar">
                <ol class="breadcrumb breadcrumb-transparent nm">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li >Laporan</li>
                    <li class="active"> Laporan Stok Alat</li>
                </ol>
            </div>
            <!--/ Toolbar -->
        </div>
    </div>
    <!-- Page Header -->

    <!-- START row -->
    <form role="form" action="print_laporanstok.php" method="get" target="_blank" data-parsley-validate>
        <div class="row">
            <div class="mb-4 col-md-3 col-12">
                <div class="form-group">
                    <label class="control-label"> Tanggal Periode</label>
                    <input type="text" class="form-control" id="datepicker11" name="DATEA" value="<?= $TANGGAL_KELUAR_AWAL; ?>" readonly data-parsley-required />
                </div> 
            </div>
            <div class="mb-4 col-md-3 col-12">
                <div class="form-group">
                    <label class="col-form-label" style="color: transparent;">.</label>
                    <input type="text" class="form-control" id="datepicker12" name="DATEB" value="<?= $TANGGAL_KELUAR_AKHIR; ?>" readonly data-parsley-required />
                </div>  
            </div>
        </div>
        <div class="row">
            <div class="mb-4 col-md-3 col-12">
                <div class="form-group">
                    <label class="control-label">Kategori Alat</label>
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
                    <label class="control-label"> Alat</label>
                    <select name="ID_BARANG" id="selectize-select2" class="form-control" >
                        <option value="">-- Pilih Alat --</option>
                    </select>
                </div>  
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-9 col-sm-offset-2">
                    <button type="submit" name="cari" class="btn btn-success"><i class="fa fa-print"></i> Cetak</button>
                    <a href="laporanstok.php" class="btn btn-default"><i class="fa fa-rotate-left"></i> Reset</a>
                </div>
            </div>
        </div>
    </form>
    <br>
    <!--/ END row -->
</div>
<!--/ END Template Container -->

<!-- START To Top Scroller -->
<a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
<!--/ END To Top Scroller -->

