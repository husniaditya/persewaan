<?php
if (isset($_GET['method']) && $_GET['method'] == 'delete') {
    require_once '../../../connection/conn.php';
    
    $ID_USER = $_SESSION['LOGINUS_GIS'];

    $ID_PEKERJAAN = $_GET['id'];
    $query = "DELETE FROM m_pekerjaan WHERE ID_PEKERJAAN = :ID_PEKERJAAN";
    $params = array(':ID_PEKERJAAN' => $ID_PEKERJAAN);
    $deleteKategori = GetQuery2($query, $params);

    if ($deleteKategori->rowCount() > 0) {
        echo "<script>alert('Data berhasil dihapus');</script>";
        echo "<script>document.location.href='../../../../jenispekerjaan.php';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus');</script>";
    }
} else {
    $ID_USER = $_SESSION['LOGINUS_GIS'];

    $NAMA_PEKERJAAN = "";
    $KETERANGAN = "";

    $query = "SELECT *,CASE WHEN STATUS = 1 THEN 'Aktif' ELSE 'Tidak Aktif' END STATUS_DETAIL FROM m_pekerjaan";
    $params = array();
    $getPekerjaan = GetQuery2($query, $params);
    $rowPekerjaan = $getPekerjaan->fetchAll(PDO::FETCH_ASSOC);

    // Get Data for Edit or View
    if (isset($_GET['id'])) {
        $ID_PEKERJAAN = $_GET['id'];
        $query = "SELECT *,CASE WHEN STATUS = 1 THEN 'AKTIF' ELSE 'TIDAK AKTIF' END STATUS_DETAIL FROM m_pekerjaan WHERE ID_PEKERJAAN = :ID_PEKERJAAN";
        $params = array(':ID_PEKERJAAN' => $ID_PEKERJAAN);
        $getPekerjaan = GetQuery2($query, $params);
        $rowPekerjaan = $getPekerjaan->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rowPekerjaan as $row) {
            extract($row);
        }

        // Update Data
        if (isset($_POST['simpan'])) {
            $NAMA_PEKERJAAN = $_POST['NAMA_PEKERJAAN'];
            $KETERANGAN = $_POST['KETERANGAN'];
            $STATUS = $_POST['STATUS'];

            // Update Query
            $query = "UPDATE m_pekerjaan SET NAMA_PEKERJAAN = :NAMA_PEKERJAAN, KETERANGAN = :KETERANGAN, STATUS = :STATUS, UPDATED_BY = :UPDATED_BY, UPDATED_DATE = NOW() WHERE ID_PEKERJAAN = :ID_PEKERJAAN";
            $params = array(
                ':NAMA_PEKERJAAN' => $NAMA_PEKERJAAN,
                ':KETERANGAN' => $KETERANGAN,
                ':STATUS' => $STATUS,
                ':UPDATED_BY' => $ID_USER,
                ':ID_PEKERJAAN' => $ID_PEKERJAAN
            );
            $editTingkatan = GetQuery2($query, $params);

            // Check if the query executed successfully
            if ($editTingkatan->rowCount() > 0) {
                echo "<script>alert('Data berhasil diubah');</script>";
                echo "<script>document.location.href='jenispekerjaan.php';</script>";
            } else {
                echo "<script>alert('Data gagal diubah');</script>";
            }
        }
    } else { // Add Data
        if (isset($_POST['simpan'])) {
            $ID_PEKERJAAN = createKode('m_pekerjaan', 'ID_PEKERJAAN', 'KAT', 3);
            $NAMA_PEKERJAAN = $_POST['NAMA_PEKERJAAN'];
            $KETERANGAN = $_POST['KETERANGAN'];

            // Update Query
            $query = "INSERT INTO m_pekerjaan (ID_PEKERJAAN, NAMA_PEKERJAAN, KETERANGAN, CREATED_BY, CREATED_DATE) VALUES (:ID_PEKERJAAN, :NAMA_PEKERJAAN, :KETERANGAN, :CREATED_BY, NOW())";
            $params = array(
                ':ID_PEKERJAAN' => $ID_PEKERJAAN,
                ':NAMA_PEKERJAAN' => $NAMA_PEKERJAAN,
                ':KETERANGAN' => $KETERANGAN,
                ':CREATED_BY' => $ID_USER
            );
            $editTingkatan = GetQuery2($query, $params);

            // Check if the query executed successfully
            if ($editTingkatan->rowCount() > 0) {
                echo "<script>alert('Data berhasil ditambahkan');</script>";
                echo "<script>document.location.href='jenispekerjaan.php';</script>";
            } else {
                echo "<script>alert('Data gagal diubah');</script>";
            }
        }
    }
}
?>