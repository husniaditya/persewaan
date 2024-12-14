<?php
if (isset($_GET['method']) && $_GET['method'] == 'delete') {
    require_once '../../../connection/conn.php';
    
    $ID_USER = $_SESSION['LOGINUS_GIS'];

    $ID_PENGELUARAN = $_GET['id'];
    $query = "DELETE FROM t_pengeluaran WHERE ID_PENGELUARAN = :ID_PENGELUARAN";
    $params = array(':ID_PENGELUARAN' => $ID_PENGELUARAN);
    $deletePengeluaran = GetQuery2($query, $params);

    $query2 = "DELETE FROM t_persediaan WHERE ID_TRANSAKSI = :ID_PENGELUARAN";
    $params2 = array(':ID_PENGELUARAN' => $ID_PENGELUARAN);
    $deletePersediaan = GetQuery2($query2, $params2);

    if ($deletePengeluaran->rowCount() > 0 && $deletePersediaan->rowCount() > 0) {
        echo "<script>alert('Data berhasil dihapus');</script>";
        echo "<script>document.location.href='../../../../pengeluaran.php';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus');</script>";
    }
} else {
    $ID_USER = $_SESSION['LOGINUS_GIS'];
    $USERAKSES = $_SESSION['LOGINAKS_GIS'];
    $USERNAME = $_SESSION['LOGINUS_GIS'];

    if ($USERAKSES == "User") {
        $query = "SELECT p.*,d.FOTO,CASE WHEN d.DK = 'D' THEN 'Debit' ELSE 'Kredit' END DK_DESK,REPLACE(d.QTY,'-','') QTY,b.ID_BARANG,b.NAMA_BARANG,k.NAMA_KATEGORI,d.ID_PERSEDIAAN,j.NAMA_PEKERJAAN,d.KONDISI,
            CASE WHEN p.STATUS_APPROVAL = 0 THEN 'fa-solid fa-spinner fa-spin'
            WHEN p.STATUS_APPROVAL = 1 THEN 'fa-solid fa-check'
            ELSE 'fa-solid fa-xmark'
            END APPROVAL_CLASS,
            CASE WHEN p.STATUS_APPROVAL = 0 THEN 'badge badge-inverse'
            WHEN p.STATUS_APPROVAL = 1 THEN 'badge badge-success' 
            ELSE 'badge badge-danger' 
            END AS APPROVAL_BADGE,
            CASE WHEN p.STATUS_APPROVAL = 0 THEN 'Menunggu persetujuan'
            WHEN p.STATUS_APPROVAL = 1 THEN 'Disetujui' 
            ELSE 'Ditolak' 
            END AS STATUS_APPROVAL_DESK
            FROM t_pengeluaran p
            LEFT JOIN t_persediaan d ON p.ID_PENGELUARAN = d.ID_TRANSAKSI
            LEFT JOIN m_barang b ON d.ID_BARANG = b.ID_BARANG
            LEFT JOIN m_kategori k ON k.ID_KATEGORI = b.ID_KATEGORI
            LEFT JOIN m_pekerjaan j ON p.ID_PEKERJAAN = j.ID_PEKERJAAN
            WHERE p.`STATUS` = 1 AND p.CREATED_BY = '$USERNAME'";
    } else {
        $query = "SELECT p.*,d.FOTO,CASE WHEN d.DK = 'D' THEN 'Debit' ELSE 'Kredit' END DK_DESK,REPLACE(d.QTY,'-','') QTY,b.ID_BARANG,b.NAMA_BARANG,k.NAMA_KATEGORI,d.ID_PERSEDIAAN,j.NAMA_PEKERJAAN,d.KONDISI,
            CASE WHEN p.STATUS_APPROVAL = 0 THEN 'fa-solid fa-spinner fa-spin'
            WHEN p.STATUS_APPROVAL = 1 THEN 'fa-solid fa-check'
            ELSE 'fa-solid fa-xmark'
            END APPROVAL_CLASS,
            CASE WHEN p.STATUS_APPROVAL = 0 THEN 'badge badge-inverse'
            WHEN p.STATUS_APPROVAL = 1 THEN 'badge badge-success' 
            ELSE 'badge badge-danger' 
            END AS APPROVAL_BADGE,
            CASE WHEN p.STATUS_APPROVAL = 0 THEN 'Menunggu persetujuan'
            WHEN p.STATUS_APPROVAL = 1 THEN 'Disetujui' 
            ELSE 'Ditolak' 
            END AS STATUS_APPROVAL_DESK
            FROM t_pengeluaran p
            LEFT JOIN t_persediaan d ON p.ID_PENGELUARAN = d.ID_TRANSAKSI
            LEFT JOIN m_barang b ON d.ID_BARANG = b.ID_BARANG
            LEFT JOIN m_kategori k ON k.ID_KATEGORI = b.ID_KATEGORI
            LEFT JOIN m_pekerjaan j ON p.ID_PEKERJAAN = j.ID_PEKERJAAN
            WHERE p.`STATUS` = 1";
    }
    
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
            // Data Pengeluaran
            $ID_PENGELUARAN = $_GET['id'];
            $ID_PERSEDIAAN = $_GET['psd'];
            $TANGGAL_KELUAR = $_POST['TANGGAL_KELUAR'];
            $NAMA = $_POST['NAMA'];
            $OPERATING_UNIT = $_POST['OPERATING_UNIT'];
            $DIVISI = $_POST['DIVISI'];
            $ID_PEKERJAAN = $_POST['ID_PEKERJAAN'];
            $KETERANGAN_PENGELUARAN = $_POST['KETERANGAN_PENGELUARAN'];
            // Data Barang
            $ID_BARANG = $_POST['ID_BARANG'];
            $QTY = $_POST['QTY'];
            $KONDISI = $_POST['KONDISI'];
            $KETERANGAN_PERSEDIAAN = $_POST['KETERANGAN_PERSEDIAAN'];

            $QTY = $QTY * -1;

            $getstok = GetQuery2("SELECT SUM(p.QTY) AS TOTAL_QTY
            FROM t_persediaan p
            WHERE p.ID_BARANG = :ID_BARANG
            AND p.STATUS = 1
            AND ID_PERSEDIAAN < :ID_PERSEDIAAN", [':ID_BARANG' => $ID_BARANG, ':ID_PERSEDIAAN' => $ID_PERSEDIAAN]);
            $rowStok = $getstok->fetch(PDO::FETCH_ASSOC);
            $stok = $rowStok['TOTAL_QTY'];

            if ($stok + $QTY < 0) {
                echo "<script>alert('Stok tidak mencukupi');</script>";
                echo "<script>document.location.href='pengeluaran_transaksi.php?method=edit&id=$ID_PENGELUARAN&psd=$ID_PERSEDIAAN';</script>";
                exit;
            }

            // create a path to store the uploaded image
            $FilePath = './assets/image/foto/peminjaman/';

            // Create directory if not exists
            if (!file_exists($FilePath)) {
                mkdir($FilePath, 0777, true);
            }

            // Handle FOTO files
            if (!empty($_FILES['FOTO']['tmp_name'][0])) {
                foreach ($_FILES['FOTO']['tmp_name'] as $key => $idCardFileTmp) {
                    $idCardFileName = $_FILES['FOTO']['name'][$key];
                    $idCardFileDestination = $FilePath . "/".$ID_PENGELUARAN ." " . $idCardFileName;
                    move_uploaded_file($idCardFileTmp, $idCardFileDestination);

                    // Re-initialize the variable for database
                    $idCardFileDestination = "./assets/image/foto/peminjaman/".$ID_PENGELUARAN ." " . $idCardFileName;
                }
            }
            else {
                $idCardFileDestination = "";
            }

            // Update Query
            $query = "UPDATE t_pengeluaran SET TANGGAL_KELUAR = :TANGGAL_KELUAR, NAMA = :NAMA, OPERATING_UNIT = :OPERATING_UNIT, DIVISI = :DIVISI, ID_PEKERJAAN = :ID_PEKERJAAN, KETERANGAN = :KETERANGAN_PENGELUARAN WHERE ID_PENGELUARAN = :ID_PENGELUARAN";
            $params = array(
                ':ID_PENGELUARAN' => $ID_PENGELUARAN,
                ':TANGGAL_KELUAR' => $TANGGAL_KELUAR,
                ':NAMA' => $NAMA,
                ':OPERATING_UNIT' => $OPERATING_UNIT,
                ':DIVISI' => $DIVISI,
                ':ID_PEKERJAAN' => $ID_PEKERJAAN,
                ':KETERANGAN_PENGELUARAN' => $KETERANGAN_PENGELUARAN
            );
            $editPengeluaran = GetQuery2($query, $params);

            // Check if image is available
            if (!empty($_FILES['FOTO']['tmp_name'][0])) {
                $query2 = "UPDATE t_persediaan SET ID_BARANG = :ID_BARANG, QTY = :QTY, KONDISI = :KONDISI, FOTO = :FOTO, KETERANGAN = :KETERANGAN_PERSEDIAAN WHERE ID_TRANSAKSI = :ID_PENGELUARAN";
                $params2 = array(
                    ':ID_PENGELUARAN' => $ID_PENGELUARAN,
                    ':ID_BARANG' => $ID_BARANG,
                    ':QTY' => $QTY,
                    ':KONDISI' => $KONDISI,
                    ':FOTO' => $idCardFileDestination,
                    ':KETERANGAN_PERSEDIAAN' => $KETERANGAN_PERSEDIAAN
                );
            } else {
                $query2 = "UPDATE t_persediaan SET ID_BARANG = :ID_BARANG, QTY = :QTY, KONDISI = :KONDISI, KETERANGAN = :KETERANGAN_PERSEDIAAN WHERE ID_TRANSAKSI = :ID_PENGELUARAN";
                $params2 = array(
                    ':ID_PENGELUARAN' => $ID_PENGELUARAN,
                    ':ID_BARANG' => $ID_BARANG,
                    ':QTY' => $QTY,
                    ':KONDISI' => $KONDISI,
                    ':KETERANGAN_PERSEDIAAN' => $KETERANGAN_PERSEDIAAN
                );
            }
            $updatePersediaan = GetQuery2($query2, $params2);

            // Check if the query executed successfully
            if ($editPengeluaran) {
                echo "<script>alert('Data berhasil diubah');</script>";
                echo "<script>document.location.href='pengeluaran.php';</script>";
            } else {
                echo "<script>alert('Data gagal diubah');</script>";
            }
            
        }
    } else { // Add Data
        if (isset($_POST['simpan'])) {
            // Data Pengeluaran
            $ID_PENGELUARAN = createKode('t_pengeluaran', 'ID_PENGELUARAN', 'KLR', 3);
            $TANGGAL_KELUAR = $_POST['TANGGAL_KELUAR'];
            $NAMA = $_POST['NAMA'];
            $OPERATING_UNIT = $_POST['OPERATING_UNIT'];
            $DIVISI = $_POST['DIVISI'];
            $ID_PEKERJAAN = $_POST['ID_PEKERJAAN'];
            $KETERANGAN_PENGELUARAN = $_POST['KETERANGAN_PENGELUARAN'];
            // Data Barang
            $ID_BARANG = $_POST['ID_BARANG'];
            $QTY = $_POST['QTY'];
            $KONDISI = $_POST['KONDISI'];
            $KETERANGAN_PERSEDIAAN = $_POST['KETERANGAN_PERSEDIAAN'];

            $QTY = $QTY * -1;

            $getstok = GetQuery2("SELECT SUM(p.QTY) AS TOTAL_QTY FROM t_persediaan p LEFT JOIN t_pengeluaran k on p.ID_TRANSAKSI = k.ID_PENGELUARAN WHERE p.ID_BARANG = :ID_BARANG AND p.STATUS = 1", [':ID_BARANG' => $ID_BARANG]);
            $rowStok = $getstok->fetch(PDO::FETCH_ASSOC);
            $stok = $rowStok['TOTAL_QTY'];

            if ($stok + $QTY < 0) {
                echo "<script>alert('Stok tidak mencukupi');</script>";
                echo "<script>document.location.href='pengeluaran_transaksi.php';</script>";
                exit;
            }

            // create a path to store the uploaded image
            $FilePath = './assets/image/foto/peminjaman/';

            // Create directory if not exists
            if (!file_exists($FilePath)) {
                mkdir($FilePath, 0777, true);
            }

            // Handle FOTO files
            if (!empty($_FILES['FOTO']['tmp_name'][0])) {
                foreach ($_FILES['FOTO']['tmp_name'] as $key => $idCardFileTmp) {
                    $idCardFileName = $_FILES['FOTO']['name'][$key];
                    $idCardFileDestination = $FilePath . "/".$ID_PENGELUARAN ." " . $idCardFileName;
                    move_uploaded_file($idCardFileTmp, $idCardFileDestination);

                    // Re-initialize the variable for database
                    $idCardFileDestination = "./assets/image/foto/peminjaman/".$ID_PENGELUARAN ." " . $idCardFileName;
                }
            }
            else {
                $idCardFileDestination = "";
            }

            // Update Query
            $query = "INSERT INTO t_pengeluaran (ID_PENGELUARAN, TANGGAL_KELUAR, NAMA, OPERATING_UNIT, DIVISI, ID_PEKERJAAN, KETERANGAN, CREATED_BY, CREATED_DATE) VALUES (:ID_PENGELUARAN, :TANGGAL_KELUAR, :NAMA, :OPERATING_UNIT, :DIVISI, :ID_PEKERJAAN, :KETERANGAN, :CREATED_BY, NOW())";
            $params = array(
                ':ID_PENGELUARAN' => $ID_PENGELUARAN,
                ':TANGGAL_KELUAR' => $TANGGAL_KELUAR,
                ':NAMA' => $NAMA,
                ':OPERATING_UNIT' => $OPERATING_UNIT,
                ':DIVISI' => $DIVISI,
                ':ID_PEKERJAAN' => $ID_PEKERJAAN,
                ':KETERANGAN' => $KETERANGAN_PENGELUARAN,
                ':CREATED_BY' => $ID_USER
            );
            $insertPemasukan = GetQuery2($query, $params);

            $query2 = "INSERT INTO t_persediaan (ID_PERSEDIAAN, ID_TRANSAKSI, ID_BARANG, DK, FOTO, KONDISI, QTY, KETERANGAN, STATUS) VALUES (:ID_PERSEDIAAN, :ID_TRANSAKSI, :ID_BARANG, :DK, :FOTO, :KONDISI, :QTY, :KETERANGAN, 1)";
            $params2 = array(
                ':ID_PERSEDIAAN' => createKode('t_persediaan', 'ID_PERSEDIAAN', 'PER',3),
                ':ID_TRANSAKSI' => $ID_PENGELUARAN,
                ':ID_BARANG' => $ID_BARANG,
                ':DK' => 'K',
                ':FOTO' => $idCardFileDestination,
                ':KONDISI' => $KONDISI,
                ':QTY' => $QTY,
                ':KETERANGAN' => $KETERANGAN_PERSEDIAAN
            );
            $updatePersediaan = GetQuery2($query2, $params2);

            // Check if the query executed successfully
            if ($insertPemasukan->rowCount() > 0) {
                echo "<script>alert('Data berhasil ditambahkan');</script>";
                echo "<script>document.location.href='pengeluaran.php';</script>";
            } else {
                echo "<script>alert('Data gagal diubah');</script>";
            }
        }
    }
}
?>