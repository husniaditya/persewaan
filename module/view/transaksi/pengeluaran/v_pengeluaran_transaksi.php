<?php
if (isset($_GET['id']) && $_GET['method'] == 'view') {
    ?>
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold">Lihat Peminjaman Alat</h4>
            </div>
            <div class="page-header-section">
                <!-- Toolbar -->
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li >Transaksi</li>
                        <li><a href="pengeluaran.php"> Peminjaman Alat</a></li>
                        <li class="active">Lihat Peminjaman Alat</li>
                    </ol>
                </div>
                <!--/ Toolbar -->
            </div>
        </div>
        <!-- Page Header -->
        
        <!-- START row -->
        <form class="form" method="post" action="" data-parsley-validate>
            <div class="row">
                <div class="col-md-12">
                    <h4>Form Peminjaman</h4>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">ID Peminjaman</label>
                        <input type="text" class="form-control" id="ID_PENGELUARAN" name="ID_PENGELUARAN" readonly />
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Tanggal Peminjaman</label>
                        <input type="text" class="form-control" id="TANGGAL_KELUAR" name="TANGGAL_KELUAR" readonly />
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Nama Pemohon</label>
                        <input class="form-control" type="text" name="NAMA" id="NAMA" readonly>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Unit Operasi</label>
                        <input class="form-control" type="text" name="OPERATING_UNIT" id="OPERATING_UNIT" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Divisi</label>
                        <input class="form-control" type="text" name="DIVISI" id="DIVISI" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Jenis Pekerjaan</label>
                        <input class="form-control" type="text" name="ID_PEKERJAAN" id="ID_PEKERJAAN" readonly>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">Keterangan Peminjaman</label>
                        <input class="form-control" type="text" name="KETERANGAN_PENGELUARAN" id="KETERANGAN_PENGELUARAN" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4>Form Alat</h4>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label">Kategori Alat</label>
                            <input class="form-control" type="text" name="ID_KATEGORI" id="ID_KATEGORI" value="" readonly>
                        </div>
                    </div>
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label"> Alat</label>
                            <input class="form-control" type="text" name="ID_BARANG" id="ID_BARANG" value="" readonly>
                            </select>
                        </div>
                    </div>
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label">QTY</label>
                            <input class="form-control" type="text" name="QTY" id="QTY" readonly>
                        </div>
                    </div>
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label">Kondisi Alat</label>
                            <input class="form-control" type="text" name="KONDISI" id="KONDISI" readonly>
                        </div>
                    </div>
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label">Keterangan Alat</label>
                            <input class="form-control" type="text" name="KETERANGAN_PERSEDIAAN" id="KETERANGAN_PERSEDIAAN" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" align="center">
                    <div class="form-group">
                        <!-- PUT THE SAMPLE UPLOAD PHOTO HERE -->
                        <label>Foto Alat </label><br>
                        <div id="preview-container">
                            <a href="#" id="openFoto" target="_blank">
                                <img id="preview-image" src="#" alt="Preview" style="width: 400px; height: 280px;text-align: center;overflow: hidden;position: relative; object-fit:contain" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="pengeluaran.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            <br><br>
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
                <h4 class="title semibold">Ubah Peminjaman Alat</h4>
            </div>
            <div class="page-header-section">
                <!-- Toolbar -->
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li >Transaksi</li>
                        <li><a href="pengeluaran.php"> Peminjaman Alat</a></li>
                        <li class="active">Ubah Peminjaman Alat</li>
                    </ol>
                </div>
                <!--/ Toolbar -->
            </div>
        </div>
        <!-- Page Header -->
        
        <!-- START row -->
        <form class="form" method="post" action="" enctype="multipart/form-data" data-parsley-validate>
            <div class="row">
                <div class="col-md-12">
                    <h4>Form Peminjaman</h4>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Tanggal Peminjaman</label>
                        <input type="text" class="form-control" id="datepicker52" name="TANGGAL_KELUAR" placeholder="Pilih tanggal" readonly data-parsley-required/>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Nama Pemohon</label>
                        <input class="form-control" type="text" name="NAMA" id="NAMA" placeholder="Nama Pemohon" value="">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Unit Operasi</label>
                        <input class="form-control" type="text" name="OPERATING_UNIT" id="OPERATING_UNIT" placeholder="Unit Operasi" value="">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Divisi</label>
                        <input class="form-control" type="text" name="DIVISI" id="DIVISI" placeholder="Nama Divisi" value="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Jenis Pekerjaan</label>
                        <select name="ID_PEKERJAAN" id="selectize-select3" class="form-control" data-parsley-required>
                            <option value="">-- Pilih Pekerjaan --</option>
                            <?php
                            foreach ($rowPekerjaan as $dataPekerjaan) {
                                extract($dataPekerjaan);
                                ?>
                                <option value="<?= $ID_PEKERJAAN; ?>"><?= $NAMA_PEKERJAAN; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Keterangan Peminjaman</label>
                        <input class="form-control" type="text" name="KETERANGAN_PENGELUARAN" id="KETERANGAN_PENGELUARAN" placeholder="Keterangan" value="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4>Form Alat</h4>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label">Kategori Alat</label>
                            <select name="ID_KATEGORI" id="selectize-select" class="form-control" data-parsley-required>
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
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label"> Alat</label>
                            <select name="ID_BARANG" id="selectize-select2" class="form-control" data-parsley-required>
                                <option value="">-- Pilih Alat --</option>
                            </select>
                        </div>
                    </div>
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label">Stok saat ini</label>
                            <input class="form-control" type="text" name="STOK" id="STOK" value="" readonly>
                        </div>
                    </div>
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label">QTY</label>
                            <input class="form-control" type="text" name="QTY" id="QTY" placeholder="Qty" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" data-parsley-required>
                        </div>
                    </div>
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label">Kondisi Alat</label>
                            <select name="KONDISI" id="selectize-select4" class="form-control" data-parsley-required>
                                <option value="">-- Pilih Kondisi Alat --</option>
                                <option value="Baik">Baik</option>
                                <option value="Rusak">Rusak</option>
                            </select>
                        </div>
                    </div>
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label">Keterangan Alat</label>
                            <input class="form-control" type="text" name="KETERANGAN_PERSEDIAAN" id="KETERANGAN_PERSEDIAAN" placeholder="Keterangan" value="" >
                        </div>
                    </div>
                </div>
                <div class="col-md-6" align="center">
                    <div class="form-group">
                        <!-- PUT THE SAMPLE UPLOAD PHOTO HERE -->
                        <label>Foto Alat </label><br>
                        <div id="preview-container">
                            <a href="#" id="openFoto" onclick="viewImage(); return false;" target="_blank">
                                <img id="preview-image" src="#" alt="Preview" style="width: 400px; height: 280px;text-align: center;overflow: hidden;position: relative; object-fit:contain" />
                            </a>
                        </div>
                        <br>
                        <div>
                            <span class="btn btn-inverse mb5 btn-rounded fileinput-button">
                                <i class="fa-regular fa-image"></i>
                                <span>Upload Foto...</span>
                                <!-- The file input field used as target for the file upload widget -->
                                <input type="file" name="FOTO[]" id="FOTO" onchange="previewImage(this);" accept="image/*" /> <br>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="submit" name="simpan" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
                    &nbsp;&nbsp;&nbsp;
                    <a href="pengeluaran.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            <br><br>
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
                <h4 class="title semibold">Tambah Peminjaman Alat</h4>
            </div>
            <div class="page-header-section">
                <!-- Toolbar -->
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li >Transaksi</li>
                        <li><a href="pengeluaran.php"> Peminjaman Alat</a></li>
                        <li class="active">Tambah Peminjaman Alat</li>
                    </ol>
                </div>
                <!--/ Toolbar -->
            </div>
        </div>
        <!-- Page Header -->
        
        <!-- START row -->
        <form class="form" method="post" action="" enctype="multipart/form-data" data-parsley-validate>
            <div class="row">
                <div class="col-md-12">
                    <h4>Form Peminjaman</h4>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Tanggal Peminjaman</label>
                        <input type="text" class="form-control" id="datepicker52" name="TANGGAL_KELUAR" placeholder="Pilih tanggal" readonly data-parsley-required/>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Nama Pemohon</label>
                        <input class="form-control" type="text" name="NAMA" placeholder="Nama Pemohon" value="">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Unit Operasi</label>
                        <input class="form-control" type="text" name="OPERATING_UNIT" placeholder="Unit Operasi" value="">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Divisi</label>
                        <input class="form-control" type="text" name="DIVISI" placeholder="Nama Divisi" value="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Jenis Pekerjaan</label>
                        <select name="ID_PEKERJAAN" id="selectize-select3" class="form-control" data-parsley-required>
                            <option value="">-- Pilih Pekerjaan --</option>
                            <?php
                            foreach ($rowPekerjaan as $dataPekerjaan) {
                                extract($dataPekerjaan);
                                ?>
                                <option value="<?= $ID_PEKERJAAN; ?>"><?= $NAMA_PEKERJAAN; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Keterangan Peminjaman</label>
                        <input class="form-control" type="text" name="KETERANGAN_PENGELUARAN" placeholder="Keterangan" value="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h4>Form Alat</h4>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label">Kategori Alat</label>
                            <select name="ID_KATEGORI" id="selectize-select" class="form-control" data-parsley-required>
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
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label"> Alat</label>
                            <select name="ID_BARANG" id="selectize-select2" class="form-control" data-parsley-required>
                                <option value="">-- Pilih Alat --</option>
                            </select>
                        </div>
                    </div>
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label">Stok saat ini</label>
                            <input class="form-control" type="text" name="STOK" id="STOK" value="" readonly>
                        </div>
                    </div>
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label">QTY</label>
                            <input class="form-control" type="text" name="QTY" id="QTY" placeholder="Qty" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" data-parsley-required>
                        </div>
                    </div>
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label">Kondisi Alat</label>
                            <select name="KONDISI" id="selectize-select4" class="form-control" data-parsley-required>
                                <option value="">-- Pilih Kondisi Alat --</option>
                                <option value="Baik">Baik</option>
                                <option value="Rusak">Rusak</option>
                            </select>
                        </div>
                    </div>
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label">Keterangan Alat</label>
                            <input class="form-control" type="text" name="KETERANGAN_PERSEDIAAN" id="KETERANGAN_PERSEDIAAN" placeholder="Keterangan" value="" >
                        </div>
                    </div>
                </div>
                <div class="col-md-6" align="center">
                    <div class="form-group">
                        <!-- PUT THE SAMPLE UPLOAD PHOTO HERE -->
                        <label>Foto Alat </label><br>
                        <div id="preview-container">
                            <a href="#" id="openFoto" onclick="viewImage(); return false;" target="_blank">
                                <img id="preview-image" src="#" alt="Preview" style="width: 400px; height: 280px;text-align: center;overflow: hidden;position: relative; object-fit:contain" />
                            </a>
                        </div>
                        <br>
                        <div>
                            <span class="btn btn-inverse mb5 btn-rounded fileinput-button">
                                <i class="fa-regular fa-image"></i>
                                <span>Upload Foto...</span>
                                <!-- The file input field used as target for the file upload widget -->
                                <input type="file" name="FOTO[]" id="FOTO" onchange="previewImage(this);" accept="image/*" /> <br>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button type="submit" name="simpan" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
                    &nbsp;&nbsp;&nbsp;
                    <a href="pengeluaran.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            <br><br>
        </form>
        <!--/ END row -->
    </div>
    <!--/ END Template Container -->
    <?php
}
?>

<!-- START To Top Scroller -->
<a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
<!--/ END To Top Scroller -->
