<?php
require_once("../module/connection/conn.php");

// Helper function to send error responses
function sendErrorResponse($message, $statusCode = 400) {
    http_response_code($statusCode);
    echo json_encode([
        'result' => ['message' => 'ERROR', 'details' => $message],
        'data' => []
    ]);
    exit;
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendErrorResponse('Invalid request method', 405);
}

// Read raw input data
$inputData = json_decode(file_get_contents("php://input"), true);

// Extract `id` from the input
$ID_PENGELUARAN = $inputData["id"] ?? null;

// Validate `ID_PENGELUARAN`
if (empty($ID_PENGELUARAN)) {
    sendErrorResponse('Missing or invalid ID', 400);
}

// Query to fetch data
$query = "SELECT m.*, d.FOTO, d.KONDISI, REPLACE(d.QTY,'-','') QTY, b.ID_BARANG, b.NAMA_BARANG, k.NAMA_KATEGORI, d.KETERANGAN AS KETERANGAN_PERSEDIAAN, m.KETERANGAN AS KETERANGAN_PENGELUARAN, b.ID_KATEGORI, j.NAMA_PEKERJAAN, j.ID_PEKERJAAN
        FROM t_pengeluaran m
        LEFT JOIN t_persediaan d ON m.ID_PENGELUARAN = d.ID_TRANSAKSI
        LEFT JOIN m_barang b ON d.ID_BARANG = b.ID_BARANG
        LEFT JOIN m_kategori k ON k.ID_KATEGORI = b.ID_KATEGORI
        LEFT JOIN m_pekerjaan j ON m.ID_PEKERJAAN = j.ID_PEKERJAAN
        WHERE m.ID_PENGELUARAN = :ID_PENGELUARAN";
$params = [':ID_PENGELUARAN' => $ID_PENGELUARAN];

$getPemasukan = GetQuery2($query, $params);
$rowPemasukan = $getPemasukan->fetchAll(PDO::FETCH_ASSOC);

// Check if any data was retrieved
if (empty($rowPemasukan)) {
    sendErrorResponse('No data found for the provided ID', 404);
}

// Prepare the response data
$options = [];
foreach ($rowPemasukan as $row) {
    $options[] = [
        'ID_PENGELUARAN' => $row["ID_PENGELUARAN"],
        'TANGGAL_KELUAR' => $row["TANGGAL_KELUAR"],
        'NAMA' => $row["NAMA"],
        'OPERATING_UNIT' => $row["OPERATING_UNIT"],
        'DIVISI' => $row["DIVISI"],
        'ID_PEKERJAAN' => $row["ID_PEKERJAAN"],
        'NAMA_PEKERJAAN' => $row["NAMA_PEKERJAAN"],
        'ID_BARANG' => $row["ID_BARANG"],
        'NAMA_BARANG' => $row["NAMA_BARANG"],
        'NAMA_KATEGORI' => $row["NAMA_KATEGORI"],
        'FOTO' => $row["FOTO"],
        'QTY' => $row["QTY"],
        'KONDISI' => $row["KONDISI"],
        'KETERANGAN_PERSEDIAAN' => $row["KETERANGAN_PERSEDIAAN"],
        'KETERANGAN_PENGELUARAN' => $row["KETERANGAN_PENGELUARAN"],
        'CREATED_BY' => $row["CREATED_BY"],
        'CREATED_DATE' => $row["CREATED_DATE"],
        'UPDATED_BY' => $row["UPDATED_BY"],
        'UPDATED_DATE' => $row["UPDATED_DATE"],
        'ID_KATEGORI' => $row["ID_KATEGORI"]
    ];
}

// Return a success response
header('Content-Type: application/json');
$response = [
    'result' => [
        'message' => 'OK',
        'id' => bin2hex(random_bytes(16)) // Generate a random 16-byte ID
    ],
    'data' => $options
];
echo json_encode($response);
?>
