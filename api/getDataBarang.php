<?php
require_once("../module/connection/conn.php");

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    sendErrorResponse('Invalid request method', 405);
    exit;
}

// Set the Content-Type header to application/json
header('Content-Type: application/json');

// Read raw input data
$inputData = json_decode(file_get_contents("php://input"), true);

// Extract input data
$ID_KATEGORI = $inputData["id"] ?? null;
$TANGGAL = $inputData["tanggal"] ?? null;

// Validate if necessary data is provided
if (empty($ID_KATEGORI)) {
    sendErrorResponse('Missing or invalid ID_KATEGORI', 400);
    exit;
}

// Fetch Barang
try {
    $BARANG = fetchBarang($ID_KATEGORI);
} catch (Exception $e) {
    sendErrorResponse('Internal server error: ' . $e->getMessage(), 500);
    exit;
}

// Send success response
sendSuccessResponse(['Barang' => $BARANG]);

/**
 * Fetch Barang details based on category
 */
function fetchBarang($ID_KATEGORI) {
    $GetDetails = GetQuery2("SELECT * FROM m_barang WHERE ID_KATEGORI = :ID_KATEGORI ORDER BY NAMA_BARANG", [':ID_KATEGORI' => $ID_KATEGORI]);
    if (!$GetDetails) {
        throw new Exception('Query execution failed');
    }

    $details = [];
    while ($row = $GetDetails->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        // Don't apply htmlspecialchars, return the value directly
        $details[] = [
            'ID_BARANG' => $ID_BARANG,
            'NAMA_BARANG' => $NAMA_BARANG,
        ];        
    }
    $GetDetails->closeCursor();
    return $details;
}

/**
 * Send success response with data
 */
function sendSuccessResponse($data) {
    http_response_code(200);
    echo json_encode([
        'result' => [
            'message' => 'OK',
            'id' => bin2hex(random_bytes(16))
        ],
        'data' => $data
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}


/**
 * Send error response with message and status code
 */
function sendErrorResponse($message, $code) {
    http_response_code($code);
    echo json_encode([
        'result' => [
            'message' => $message,
            'id' => bin2hex(random_bytes(16))
        ],
        'data' => null
    ]);
}
?>
