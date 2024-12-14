<?php
if (isset($_GET['id']) && $_GET['method'] == 'view') {
    ?>
    <!-- START Template Container -->
    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header page-header-block">
            <div class="page-header-section">
                <h4 class="title semibold">Lihat Pengembalian Alat</h4>
            </div>
            <div class="page-header-section">
                <!-- Toolbar -->
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li >Master</li>
                        <li><a href="pemasukan.php"> Pengembalian Alat</a></li>
                        <li class="active">Lihat Pengembalian Alat</li>
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
                    <h4>Form Pengembalian</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">ID Peminjaman</label>
                        <input type="text" class="form-control" id="ID_PENGELUARAN" name="ID_PENGELUARAN" value="" readonly/>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">ID Pengembalian</label>
                        <input type="text" class="form-control" id="ID_PEMASUKAN" name="ID_PEMASUKAN" value="" readonly/>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Tanggal Pemasukan</label>
                        <input type="text" class="form-control" id="TANGGAL_MASUK" name="TANGGAL_MASUK" value="" readonly/>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Nama Pemohon</label>
                        <input class="form-control" type="text" name="NAMA" id="NAMA" value="" readonly>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Unit Operasi</label>
                        <input class="form-control" type="text" name="OPERATING_UNIT" id="OPERATING_UNIT" value="" readonly>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Divisi</label>
                        <input class="form-control" type="text" name="DIVISI" id="DIVISI" value="" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Keterangan</label>
                        <input class="form-control" type="text" name="KETERANGAN_PENGELUARAN" id="KETERANGAN_PENGELUARAN" value="" readonly>
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
                        </div>
                    </div>
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label">QTY</label>
                            <input class="form-control" type="text" name="QTY" id="QTY" value="" readonly>
                        </div>
                    </div>
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label">Kondisi Alat</label>
                            <input class="form-control" type="text" name="KONDISI" id="KONDISI" value="" readonly>
                        </div>
                    </div>
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label">Keterangan</label>
                            <input class="form-control" type="text" name="KETERANGAN_PERSEDIAAN" id="KETERANGAN_PERSEDIAAN" value="" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" align="center">
                    <div class="form-group">
                        <!-- PUT THE SAMPLE UPLOAD PHOTO HERE -->
                        <label>Foto Alat </label><br>
                        <div id="preview-container">
                            <a href="" id="openFoto" target="_blank">
                                <img id="preview-image" src="#" alt="Preview" style="width: 400px; height: 280px;text-align: center;overflow: hidden;position: relative; object-fit:contain" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a href="pemasukan.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
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
                <h4 class="title semibold">Tambah Pengembalian Alat</h4>
            </div>
            <div class="page-header-section">
                <!-- Toolbar -->
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li >Transaksi</li>
                        <li><a href="pemasukan.php"> Pengembalian Alat</a></li>
                        <li class="active">Tambah Pengembalian Alat</li>
                    </ol>
                </div>
                <!--/ Toolbar -->
            </div>
        </div>
        <!-- Page Header -->
        
        <form class="form" method="post" action="" enctype="multipart/form-data" data-parsley-validate>
            <div class="row">
                <div class="col-md-12">
                    <h4>Form Pengembalian</h4>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">No. Dokumen Peminjaman</label>
                        <input class="form-control" type="text" name="ID_PENGELUARAN" id="ID_PENGELUARAN" placeholder="No. Dokumen Peminjaman" value="" data-parsley-required>
                        <p class="hidden" style="color: red" id="result">Data tidak ditemukan!</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label hidden">.</label><br>
                        <button type="button" name="cari" id="cari" class="btn btn-inverse"><i class="fa fa-search"></i> Cari</button>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Tanggal Pengembalian</label>
                        <input type="text" class="form-control" id="datepicker52" name="TANGGAL_MASUK" placeholder="Pilih tanggal" readonly data-parsley-required/>
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
                        <label class="control-label">Keterangan</label>
                        <input class="form-control" type="text" name="KETERANGAN_PEMASUKAN" id="KETERANGAN_PEMASUKAN" placeholder="Keterangan" value="">
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
                            <label class="control-label">QTY</label>
                            <input class="form-control" type="text" name="QTY" id="QTY" placeholder="Qty" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '')" data-parsley-required>
                        </div>
                    </div>
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label">Kondisi Alat</label>
                            <select name="KONDISI" id="selectize-select3" class="form-control" data-parsley-required>
                                <option value="">-- Pilih Kondisi Alat --</option>
                                <option value="Baik">Baik</option>
                                <option value="Rusak">Rusak</option>
                            </select>
                        </div>
                    </div>
                    <div class="short-div">
                        <div class="form-group">
                            <label class="control-label">Keterangan</label>
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
                    <a href="pemasukan.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            <br><br>
        </form>
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
                <h4 class="title semibold">Tambah Pengembalian Alat</h4>
            </div>
            <div class="page-header-section">
                <!-- Toolbar -->
                <div class="toolbar">
                    <ol class="breadcrumb breadcrumb-transparent nm">
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li >Transaksi</li>
                        <li><a href="pemasukan.php"> Pengembalian Alat</a></li>
                        <li class="active">Tambah Pengembalian Alat</li>
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
                    <h4>Form Pengembalian</h4>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label">No. Dokumen Peminjaman</label>
                        <input class="form-control" type="text" name="ID_PENGELUARAN" id="ID_PENGELUARAN" placeholder="No. Dokumen Peminjaman" value="" data-parsley-required>
                    </div>
                    <p class="hidden" style="color: red" id="result">Data tidak ditemukan!</p>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="control-label hidden">.</label><br>
                        <button type="button" name="cari" id="cari" class="btn btn-inverse"><i class="fa fa-search"></i> Cari</button>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label class="control-label">Tanggal Pengembalian</label>
                        <input type="text" class="form-control" id="datepicker52" name="TANGGAL_MASUK" placeholder="Pilih tanggal" readonly data-parsley-required/>
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
                        <label class="control-label">Keterangan</label>
                        <input class="form-control" type="text" name="KETERANGAN_PEMASUKAN" id="KETERANGAN_PEMASUKAN" placeholder="Keterangan" value="">
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
                            <label class="control-label">Keterangan</label>
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
                    <a href="pemasukan.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
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
