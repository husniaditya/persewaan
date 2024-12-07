<?php
require_once '../../../connection/conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $USERNAME = $_POST["username"] ?? '';
    $PASSWORD = $_POST['password'] ?? '';

    // Validate inputs
    if (empty($USERNAME) || empty($PASSWORD)) {
        echo json_encode(['status' => 'error', 'message' => 'Username atau Password tidak boleh kosong.']);
        exit;
    }

    $query = GetQuery2("SELECT * FROM m_user WHERE USERNAME = :USERNAME", [':USERNAME' => $USERNAME]);
    $rowUser = $query->fetch(PDO::FETCH_ASSOC);

    if ($rowUser && password_verify($PASSWORD, $rowUser['USERPASSWORD'])) {
        $_SESSION["LOGINID_GIS"] = $rowUser['ID_USER'];
        $_SESSION["LOGINUS_GIS"] = $rowUser['USERNAME'];
        $_SESSION["LOGINNAMA_GIS"] = $rowUser['NAMA'];
        $_SESSION["LOGINAKS_GIS"] = $rowUser['AKSES'];

        echo json_encode(['status' => 'success', 'redirect' => 'dashboard.php']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Username atau password tidak sesuai.']);
    }
    exit;
}
?>
