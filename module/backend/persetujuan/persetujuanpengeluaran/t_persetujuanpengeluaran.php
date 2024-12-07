<?php

$ID_USER = $_SESSION['LOGINUS_GIS'];

$query = "SELECT p.*,d.FOTO,CASE WHEN d.DK = 'D' THEN 'Debit' ELSE 'Kredit' END DK_DESK,REPLACE(d.QTY,'-','') QTY,b.ID_BARANG,b.NAMA_BARANG,k.NAMA_KATEGORI,d.ID_PERSEDIAAN,j.NAMA_PEKERJAAN,
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
        WHERE p.`STATUS` = 1 AND p.STATUS_APPROVAL = 0";
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

if (isset($_POST['setuju'])) {
    // Data Pengeluaran
    $ID_PENGELUARAN = $_GET['id'];

    // Update Query
    $query = "UPDATE t_pengeluaran SET STATUS_APPROVAL = 1, TANGGAL_APPROVAL = NOW(), USER_APPROVAL = '$ID_USER' WHERE ID_PENGELUARAN = :ID_PENGELUARAN";
    $params = array(
        ':ID_PENGELUARAN' => $ID_PENGELUARAN
    );
    $insertPemasukan = GetQuery2($query, $params);

    // Check if the query executed successfully
    if ($insertPemasukan->rowCount() > 0) {
        echo "<script>alert('Data berhasil diupdate');</script>";
        echo "<script>document.location.href='persetujuanpengeluaran.php';</script>";
    } else {
        echo "<script>alert('Data gagal diubah');</script>";
    }
}
if (isset($_POST['tolak'])) {
    // Data Pengeluaran
    $ID_PENGELUARAN = $_GET['id'];

    // Update Query
    $query = "UPDATE t_pengeluaran SET STATUS_APPROVAL = 2, TANGGAL_APPROVAL = NOW(), USER_APPROVAL = '$ID_USER' WHERE ID_PENGELUARAN = :ID_PENGELUARAN";
    $params = array(
        ':ID_PENGELUARAN' => $ID_PENGELUARAN
    );
    $insertPemasukan = GetQuery2($query, $params);

    // Check if the query executed successfully
    if ($insertPemasukan->rowCount() > 0) {
        echo "<script>alert('Data berhasil diupdate');</script>";
        echo "<script>document.location.href='persetujuanpengeluaran.php';</script>";
    } else {
        echo "<script>alert('Data gagal diubah');</script>";
    }
}
?>