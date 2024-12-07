<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default" id="demo">
                <div class="panel-heading">
                    <h3 class="panel-title">Tabel Monitoring Stok Alat</h3>
                </div>
                <table class="table table-striped table-bordered" id="stok-table">
                    <thead>
                        <tr>
                            <th>ID Alat</th>
                            <th>Kategori</th>
                            <th>Nama Alat</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rowBarang as $dataBarang) {
                            extract($dataBarang);
                            $getSaldoAkhir = "SELECT IFNULL(SUM(d.QTY), 0) STOK
                            FROM t_persediaan d
                            LEFT JOIN t_pemasukan m ON d.ID_TRANSAKSI = m.ID_PEMASUKAN AND DATE(m.TANGGAL_MASUK) < :DATEA AND m.STATUS = 1
                            LEFT JOIN t_pengeluaran k ON d.ID_TRANSAKSI = k.ID_PENGELUARAN AND DATE(k.TANGGAL_KELUAR) < :DATEA AND k.STATUS = 1
                            LEFT JOIN m_barang b ON d.ID_BARANG = b.ID_BARANG
                            LEFT JOIN m_kategori g ON b.ID_KATEGORI = g.ID_KATEGORI
                            WHERE d.ID_BARANG = :ID_BARANG AND d.STATUS = 1 AND (k.STATUS_APPROVAL IS NULL OR k.STATUS_APPROVAL <> 2)";
                            $params = array(
                                ":ID_BARANG" => $ID_BARANG,
                                ":DATEA" => $DATENOW
                            );
                            $getSaldo = GetQuery2($getSaldoAkhir, $params);
                            foreach ($getSaldo as $dataSaldo) {
                                extract($dataSaldo);
                                
                                ?>
                                <tr>
                                    <td align="center"><?= $ID_BARANG; ?></td>
                                    <td align="center"><?= $NAMA_KATEGORI; ?></td>
                                    <td align="center"><?= $NAMA_BARANG; ?></td>
                                    <td align="center"><?= $STOK; ?></td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-8">
        <div class="panel panel-default" id="demo">
                <div class="panel-heading">
                    <h3 class="panel-title">Tabel Monitoring Status Peminjaman</h3>
                </div>
                <table class="table table-striped table-bordered" id="approval-table">
                    <thead>
                        <tr>
                            <th>ID Peminjaman</th>
                            <th>Tanggal</th>
                            <th>ID Alat</th>
                            <th>Nama Alat</th>
                            <th>Kategori</th>
                            <th>QTY</th>
                            <th>Jenis Pekerjaan</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($rowPemasukan as $dataPemasukan) {
                            extract($dataPemasukan);
                            ?>
                            <tr>
                                <td>
                                    <?= $ID_PENGELUARAN; ?><br>
                                    <span class="<?= $APPROVAL_BADGE; ?>"><i class="<?= $APPROVAL_CLASS; ?>"></i> <?= $STATUS_APPROVAL_DESK; ?> </span>
                                </td>
                                <td align="center"><?= $TANGGAL_KELUAR; ?></td>
                                <td align="center"><?= $ID_BARANG; ?></td>
                                <td><?= $NAMA_BARANG; ?></td>
                                <td align="center"><?= $NAMA_KATEGORI; ?></td>
                                <td align="center"><?= $QTY; ?></td>
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
</div> 