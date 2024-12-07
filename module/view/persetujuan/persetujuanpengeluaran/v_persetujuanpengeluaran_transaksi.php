
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
                                <img id="preview-image" src="#" alt="Preview" style="width: auto; height: 280px;text-align: center;overflow: hidden;position: relative; object-fit:contain" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4">
                    <button type="submit" name="setuju" class="btn btn-success"><i class="fa-regular fa-circle-check"></i> Setuju</button>
                    &nbsp;&nbsp;&nbsp;
                    <button type="submit" name="tolak" class="btn btn-danger"><i class="fa-regular fa-circle-xmark"></i> Tolak</button>
                </div>
                <div class="col-sm-6">
                    <a href="persetujuanpengeluaran.php" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            <br><br>
        </form>
        <!--/ END row -->
    </div>
    <!--/ END Template Container -->


<!-- START To Top Scroller -->
<a href="#" class="totop animation" data-toggle="waypoints totop" data-showanim="bounceIn" data-hideanim="bounceOut" data-offset="50%"><i class="ico-angle-up"></i></a>
<!--/ END To Top Scroller -->
