<?php
if (isset($_GET['method']) && $_GET['method'] == 'delete') {
    require_once '../../../connection/conn.php';
    
    $ID_USER_LOGIN = $_SESSION['LOGINUS_GIS'];

    $ID_USER_GET = $_GET['id'];
    $query = "DELETE FROM m_user WHERE ID_USER = :ID_USER";
    $params = array(':ID_USER' => $ID_USER_GET);
    $deleteKategori = GetQuery2($query, $params);

    if ($deleteKategori->rowCount() > 0) {
        echo "<script>alert('Data berhasil dihapus');</script>";
        echo "<script>document.location.href='../../../../pengguna.php';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus');</script>";
    }
} else {
    $ID_USER_LOGIN = $_SESSION['LOGINUS_GIS'];

    $query = "SELECT *,CASE WHEN STATUS = 1 THEN 'Aktif' ELSE 'Tidak Aktif' END STATUS_DETAIL FROM m_user";
    $params = array();
    $getUser = GetQuery2($query, $params);
    $rowUser = $getUser->fetchAll(PDO::FETCH_ASSOC);

    $options = [
        'cost' => 12,
    ];

    // Get Data for Edit or View
    if (isset($_GET['id'])) {
        $ID_USER_GET = $_GET['id'];
        $query = "SELECT *,CASE WHEN STATUS = 1 THEN 'Aktif' ELSE 'Tidak Aktif' END STATUS_DETAIL FROM m_user WHERE ID_USER = :ID_USER";
        $params = array(':ID_USER' => $ID_USER_GET);
        $getUser = GetQuery2($query, $params);
        $rowUser = $getUser->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rowUser as $row) {
            extract($row);
        }

        // Update Data
        if (isset($_POST['simpan'])) {
            $USERNAME = $_POST['USERNAME'];
            $PASSWORD = $_POST['USERPASSWORD'];
            $NAMA = $_POST['NAMA'];
            $EMAIL = $_POST['EMAIL'];
            $AKSES = $_POST['AKSES'];
            $STATUS = $_POST['STATUS'];

            $USER_PASSWORD = password_hash($PASSWORD, PASSWORD_BCRYPT, $options);

            // Update Query
            if ($PASSWORD != "") {
                $query = "UPDATE m_user SET USERNAME = :USERNAME, USERPASSWORD = :PASSWORD, NAMA = :NAMA, EMAIL = :EMAIL, AKSES = :AKSES, STATUS = :STATUS, UPDATED_BY = :UPDATED_BY, UPDATED_DATE = NOW() WHERE ID_USER = :ID_USER";
                $params = array(
                    ':USERNAME' => $USERNAME,
                    ':PASSWORD' => $USER_PASSWORD,
                    ':NAMA' => $NAMA,
                    ':EMAIL' => $EMAIL,
                    ':AKSES' => $AKSES,
                    ':STATUS' => $STATUS,
                    ':UPDATED_BY' => $ID_USER_LOGIN,
                    ':ID_USER' => $ID_USER_GET
                );
            } else {
                $query = "UPDATE m_user SET USERNAME = :USERNAME, NAMA = :NAMA, EMAIL = :EMAIL, AKSES = :AKSES, STATUS = :STATUS, UPDATED_BY = :UPDATED_BY, UPDATED_DATE = NOW() WHERE ID_USER = :ID_USER";
                $params = array(
                    ':USERNAME' => $USERNAME,
                    ':NAMA' => $NAMA,
                    ':EMAIL' => $EMAIL,
                    ':AKSES' => $AKSES,
                    ':STATUS' => $STATUS,
                    ':UPDATED_BY' => $ID_USER_LOGIN,
                    ':ID_USER' => $ID_USER_GET
                );
            }
            $editUser = GetQuery2($query, $params);

            // Check if the query executed successfully
            if ($editUser->rowCount() > 0) {
                echo "<script>alert('Data berhasil diubah');</script>";
                echo "<script>document.location.href='pengguna.php';</script>";
            } else {
                echo "<script>alert('Data gagal diubah');</script>";
            }
        }
    } else { // Add Data
        if (isset($_POST['simpan'])) {
            $ID_USER = createKode('m_user', 'ID_USER', 'USER', 3);
            $USERNAME = $_POST['USERNAME'];
            $PASSWORD = $_POST['USERPASSWORD'];
            $NAMA = $_POST['NAMA'];
            $EMAIL = $_POST['EMAIL'];
            $AKSES = $_POST['AKSES'];
            
            $USER_PASSWORD = password_hash($PASSWORD, PASSWORD_BCRYPT, $options);

            // Update Query
            $query = "INSERT INTO m_user (ID_USER, USERNAME, USERPASSWORD, NAMA, EMAIL, AKSES, CREATED_BY, CREATED_DATE) VALUES (:ID_USER, :USERNAME, :PASSWORD, :NAMA, :EMAIL, :AKSES, :CREATED_BY, NOW())";
            $params = array(
                ':ID_USER' => $ID_USER,
                ':USERNAME' => $USERNAME,
                ':PASSWORD' => $USER_PASSWORD,
                ':NAMA' => $NAMA,
                ':EMAIL' => $EMAIL,
                ':AKSES' => $AKSES,
                ':CREATED_BY' => $ID_USER_LOGIN
            );
            $editTingkatan = GetQuery2($query, $params);

            // Check if the query executed successfully
            if ($editTingkatan->rowCount() > 0) {
                echo "<script>alert('Data berhasil ditambahkan');</script>";
                echo "<script>document.location.href='pengguna.php';</script>";
            } else {
                echo "<script>alert('Data gagal diubah');</script>";
            }
        }
    }
}
?>