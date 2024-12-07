<?php
if (isset($_GET['method']) && $_GET['method'] == 'delete') {
    require_once '../../../connection/conn.php';
    
    $ID_USER = $_SESSION['LOGINUS_GIS'];

    $ID_PEMASUKAN = $_GET['id'];
    $query = "DELETE FROM t_pemasukan WHERE ID_PEMASUKAN = :ID_PEMASUKAN";
    $params = array(':ID_PEMASUKAN' => $ID_PEMASUKAN);
    $deletePemasukan = GetQuery2($query, $params);

    $query2 = "DELETE FROM t_persediaan WHERE ID_TRANSAKSI = :ID_PEMASUKAN";
    $params2 = array(':ID_PEMASUKAN' => $ID_PEMASUKAN);
    $deletePersediaan = GetQuery2($query2, $params2);
    

    if ($deletePemasukan->rowCount() > 0 && $deletePersediaan->rowCount() > 0) {
        echo "<script>alert('Data berhasil dihapus');</script>";
        echo "<script>document.location.href='../../../../pemasukan.php';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus');</script>";
    }
} else {
    $ID_USER = $_SESSION['LOGINUS_GIS'];

    $query = "SELECT m.*,d.KONDISI KONDISI_KEMBALI,d.FOTO FOTO_KEMBALI,CASE WHEN d.DK = 'D' THEN 'Debit' ELSE 'Kredit' END DK_DESK,d.QTY QTY_KEMBALI,b.ID_BARANG,b.NAMA_BARANG,k.NAMA_KATEGORI,d2.FOTO FOTO_KELUAR,d2.KONDISI KONDISI_KELUAR,REPLACE(d2.QTY,'-','') QTY_KELUAR
            FROM t_pemasukan m
            LEFT JOIN t_persediaan d ON m.ID_PEMASUKAN = d.ID_TRANSAKSI
            LEFT JOIN t_persediaan d2 ON m.ID_PENGELUARAN = d2.ID_TRANSAKSI
            LEFT JOIN m_barang b ON d.ID_BARANG = b.ID_BARANG
            LEFT JOIN m_kategori k ON k.ID_KATEGORI = b.ID_KATEGORI
            WHERE m.`STATUS` = 1";
    $params = array();
    $getPemasukan = GetQuery2($query, $params);
    $rowPemasukan = $getPemasukan->fetchAll(PDO::FETCH_ASSOC);

    $kategori = "SELECT ID_KATEGORI,NAMA_KATEGORI FROM m_kategori WHERE STATUS = 1 ORDER BY NAMA_KATEGORI";
    $params = array();
    $getKategori = GetQuery2($kategori, $params);
    $rowKategori = $getKategori->fetchAll(PDO::FETCH_ASSOC);
    
    $pekerjaan = "SELECT ID_PEKERJAAN,NAMA_PEKERJAAN FROM m_pekerjaan WHERE STATUS = 1 ORDER BY NAMA_PEKERJAAN";
    $params = array();
    $getPekerjaan = GetQuery2($pekerjaan, $params);
    $rowPekerjaan = $getPekerjaan->fetchAll(PDO::FETCH_ASSOC);

    // Get Data for Edit or View
    if (isset($_GET['id'])) {
        // Update Data
        if (isset($_POST['simpan'])) {
            $ID_PEMASUKAN = $_GET['id'];
            $ID_PENGELUARAN = $_POST['ID_PENGELUARAN'];
            $TANGGAL_MASUK = $_POST['TANGGAL_MASUK'];
            $NAMA = $_POST['NAMA'];
            $OPERATING_UNIT = $_POST['OPERATING_UNIT'];
            $DIVISI = $_POST['DIVISI'];
            $KETERANGAN_PEMASUKAN = $_POST['KETERANGAN_PEMASUKAN'];
            $ID_BARANG = $_POST['ID_BARANG'];
            $QTY = $_POST['QTY'];
            $KONDISI = $_POST['KONDISI'];
            $KETERANGAN_PERSEDIAAN = $_POST['KETERANGAN_PERSEDIAAN'];

            // create a path to store the uploaded image
            $FilePath = './assets/image/foto/pengembalian/';

            // Create directory if not exists
            if (!file_exists($FilePath)) {
                mkdir($FilePath, 0777, true);
            }

            // Handle FOTO files
            if (!empty($_FILES['FOTO']['tmp_name'][0])) {
                foreach ($_FILES['FOTO']['tmp_name'] as $key => $idCardFileTmp) {
                    $idCardFileName = $_FILES['FOTO']['name'][$key];
                    $idCardFileDestination = $FilePath . "/".$ID_PEMASUKAN ." " . $idCardFileName;
                    move_uploaded_file($idCardFileTmp, $idCardFileDestination);

                    // Re-initialize the variable for database
                    $idCardFileDestination = "./assets/image/foto/pengembalian/".$ID_PEMASUKAN ." " . $idCardFileName;
                }
            }
            else {
                $idCardFileDestination = "";
            }


            // Update Query
            $query = "UPDATE t_pemasukan SET ID_PENGELUARAN = :ID_PENGELUARAN, TANGGAL_MASUK = :TANGGAL_MASUK, NAMA = :NAMA, OPERATING_UNIT = :OPERATING_UNIT, DIVISI = :DIVISI, KETERANGAN = :KETERANGAN, UPDATED_BY = :UPDATED_BY, UPDATED_DATE = NOW() WHERE ID_PEMASUKAN = :ID_PEMASUKAN";
            $params = array(
                ':ID_PEMASUKAN' => $ID_PEMASUKAN,
                ':ID_PENGELUARAN' => $ID_PENGELUARAN,
                ':TANGGAL_MASUK' => $TANGGAL_MASUK,
                ':NAMA' => $NAMA,
                ':OPERATING_UNIT' => $OPERATING_UNIT,
                ':DIVISI' => $DIVISI,
                ':KETERANGAN' => $KETERANGAN_PEMASUKAN,
                ':UPDATED_BY' => $ID_USER
            );
            $editPemasukan = GetQuery2($query, $params);

            $query2 = "UPDATE t_persediaan SET ID_BARANG = :ID_BARANG, QTY = :QTY, FOTO = :FOTO, KONDISI = :KONDISI, KETERANGAN = :KETERANGAN WHERE ID_TRANSAKSI = :ID_PEMASUKAN";
            $params2 = array(
                ':ID_PEMASUKAN' => $ID_PEMASUKAN,
                ':ID_BARANG' => $ID_BARANG,
                ':QTY' => $QTY,
                ':FOTO' => $idCardFileDestination,
                ':KONDISI' => $KONDISI,
                ':KETERANGAN' => $KETERANGAN_PERSEDIAAN
            );
            $updatePersediaan = GetQuery2($query2, $params2);

            // Check if the query executed successfully
            if ($editPemasukan->rowCount() > 0) {
                echo "<script>alert('Data berhasil diubah');</script>";
                echo "<script>document.location.href='pemasukan.php';</script>";
            } else {
                echo "<script>alert('Data gagal diubah');</script>";
            }
        }
    } else { // Add Data
        if (isset($_POST['simpan'])) {
            $ID_PEMASUKAN = createKode('t_pemasukan', 'ID_PEMASUKAN', 'MSK', 3);
            $ID_PENGELUARAN = $_POST['ID_PENGELUARAN'];
            $TANGGAL_MASUK = $_POST['TANGGAL_MASUK'];
            $NAMA = $_POST['NAMA'];
            $OPERATING_UNIT = $_POST['OPERATING_UNIT'];
            $DIVISI = $_POST['DIVISI'];
            $KETERANGAN_PEMASUKAN = $_POST['KETERANGAN_PEMASUKAN'];
            $ID_BARANG = $_POST['ID_BARANG'];
            $QTY = $_POST['QTY'];
            $KONDISI = $_POST['KONDISI'];
            $KETERANGAN_PERSEDIAAN = $_POST['KETERANGAN_PERSEDIAAN'];

            // create a path to store the uploaded image
            $FilePath = './assets/image/foto/pengembalian/';

            // Create directory if not exists
            if (!file_exists($FilePath)) {
                mkdir($FilePath, 0777, true);
            }

            // Handle FOTO files
            if (!empty($_FILES['FOTO']['tmp_name'][0])) {
                foreach ($_FILES['FOTO']['tmp_name'] as $key => $idCardFileTmp) {
                    $idCardFileName = $_FILES['FOTO']['name'][$key];
                    $idCardFileDestination = $FilePath . "/".$ID_PEMASUKAN ." " . $idCardFileName;
                    move_uploaded_file($idCardFileTmp, $idCardFileDestination);

                    // Re-initialize the variable for database
                    $idCardFileDestination = "./assets/image/foto/pengembalian/".$ID_PEMASUKAN ." " . $idCardFileName;
                }
            }
            else {
                $idCardFileDestination = "";
            }

            // Update Query
            $query = "INSERT INTO t_pemasukan (ID_PEMASUKAN, ID_PENGELUARAN, TANGGAL_MASUK, NAMA, OPERATING_UNIT, DIVISI, KETERANGAN, CREATED_BY, CREATED_DATE) VALUES (:ID_PEMASUKAN, :ID_PENGELUARAN, :TANGGAL_MASUK, :NAMA, :OPERATING_UNIT, :DIVISI, :KETERANGAN, :CREATED_BY, NOW())";
            $params = array(
                ':ID_PEMASUKAN' => $ID_PEMASUKAN,
                ':ID_PENGELUARAN' => $ID_PENGELUARAN,
                ':TANGGAL_MASUK' => $TANGGAL_MASUK,
                ':NAMA' => $NAMA,
                ':OPERATING_UNIT' => $OPERATING_UNIT,
                ':DIVISI' => $DIVISI,
                ':KETERANGAN' => $KETERANGAN_PEMASUKAN,
                ':CREATED_BY' => $ID_USER
            );
            $insertPemasukan = GetQuery2($query, $params);

            $query2 = "INSERT INTO t_persediaan (ID_PERSEDIAAN, ID_TRANSAKSI, ID_BARANG, DK, QTY, FOTO, KONDISI, KETERANGAN) VALUES (:ID_PERSEDIAAN, :ID_TRANSAKSI, :ID_BARANG, :DK, :QTY, :FOTO, :KONDISI, :KETERANGAN)";
            $params2 = array(
                ':ID_PERSEDIAAN' => createKode('t_persediaan', 'ID_PERSEDIAAN', 'PER', 3),
                ':ID_TRANSAKSI' => $ID_PEMASUKAN,
                ':ID_BARANG' => $ID_BARANG,
                ':DK' => 'D',
                ':QTY' => $QTY,
                ':FOTO' => $idCardFileDestination,
                ':KONDISI' => $KONDISI,
                ':KETERANGAN' => $KETERANGAN_PERSEDIAAN
            );
            $updatePersediaan = GetQuery2($query2, $params2);

            // Check if the query executed successfully
            if ($insertPemasukan->rowCount() > 0) {
                echo "<script>alert('Data berhasil ditambahkan');</script>";
                echo "<script>document.location.href='pemasukan.php';</script>";
            } else {
                echo "<script>alert('Data gagal diubah');</script>";
            }
        }
    }
}
?>