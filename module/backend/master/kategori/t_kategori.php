<?php
if (isset($_GET['method']) && $_GET['method'] == 'delete') {
    require_once '../../../connection/conn.php';
    
    $ID_USER = $_SESSION['LOGINUS_GIS'];

    $ID_KATEGORI = $_GET['id'];
    $query = "DELETE FROM m_kategori WHERE ID_KATEGORI = :ID_KATEGORI";
    $params = array(':ID_KATEGORI' => $ID_KATEGORI);
    $deleteKategori = GetQuery2($query, $params);

    if ($deleteKategori->rowCount() > 0) {
        echo "<script>alert('Data berhasil dihapus');</script>";
        echo "<script>document.location.href='../../../../kategori.php';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus');</script>";
    }
} else {
    $ID_USER = $_SESSION['LOGINUS_GIS'];

    $NAMA_KATEGORI = "";
    $DESKRIPSI = "";

    $query = "SELECT *,CASE WHEN STATUS = 1 THEN 'Aktif' ELSE 'Tidak Aktif' END STATUS_DETAIL FROM m_kategori";
    $params = array();
    $getKategori = GetQuery2($query, $params);
    $rowKategori = $getKategori->fetchAll(PDO::FETCH_ASSOC);

    // Get Data for Edit or View
    if (isset($_GET['id'])) {
        $ID_KATEGORI = $_GET['id'];
        $query = "SELECT *,CASE WHEN STATUS = 1 THEN 'AKTIF' ELSE 'TIDAK AKTIF' END STATUS_DETAIL FROM m_kategori WHERE ID_KATEGORI = :ID_KATEGORI";
        $params = array(':ID_KATEGORI' => $ID_KATEGORI);
        $getKategori = GetQuery2($query, $params);
        $rowKategori = $getKategori->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rowKategori as $row) {
            extract($row);
        }

        // Update Data
        if (isset($_POST['simpan'])) {
            $NAMA_KATEGORI = $_POST['NAMA_KATEGORI'];
            $DESKRIPSI = $_POST['DESKRIPSI'];
            $STATUS = $_POST['STATUS'];

            // Update Query
            $query = "UPDATE m_kategori SET NAMA_KATEGORI = :NAMA_KATEGORI, DESKRIPSI = :DESKRIPSI, STATUS = :STATUS, UPDATED_BY = :UPDATED_BY, UPDATED_DATE = NOW() WHERE ID_KATEGORI = :ID_KATEGORI";
            $params = array(
                ':NAMA_KATEGORI' => $NAMA_KATEGORI,
                ':DESKRIPSI' => $DESKRIPSI,
                ':STATUS' => $STATUS,
                ':UPDATED_BY' => $ID_USER,
                ':ID_KATEGORI' => $ID_KATEGORI
            );
            $editTingkatan = GetQuery2($query, $params);

            // Check if the query executed successfully
            if ($editTingkatan->rowCount() > 0) {
                echo "<script>alert('Data berhasil diubah');</script>";
                echo "<script>document.location.href='kategori.php';</script>";
            } else {
                echo "<script>alert('Data gagal diubah');</script>";
            }
        }
    } else { // Add Data
        if (isset($_POST['simpan'])) {
            $ID_KATEGORI = createKode('m_kategori', 'ID_KATEGORI', 'KAT', 3);
            $NAMA_KATEGORI = $_POST['NAMA_KATEGORI'];
            $DESKRIPSI = $_POST['DESKRIPSI'];

            // Update Query
            $query = "INSERT INTO m_kategori (ID_KATEGORI, NAMA_KATEGORI, DESKRIPSI, CREATED_BY, CREATED_DATE) VALUES (:ID_KATEGORI, :NAMA_KATEGORI, :DESKRIPSI, :CREATED_BY, NOW())";
            $params = array(
                ':ID_KATEGORI' => $ID_KATEGORI,
                ':NAMA_KATEGORI' => $NAMA_KATEGORI,
                ':DESKRIPSI' => $DESKRIPSI,
                ':CREATED_BY' => $ID_USER
            );
            $editTingkatan = GetQuery2($query, $params);

            // Check if the query executed successfully
            if ($editTingkatan->rowCount() > 0) {
                echo "<script>alert('Data berhasil ditambahkan');</script>";
                echo "<script>document.location.href='kategori.php';</script>";
            } else {
                echo "<script>alert('Data gagal diubah');</script>";
            }
        }
    }
}
?>