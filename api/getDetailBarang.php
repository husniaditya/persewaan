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
$ID_BARANG = $inputData["id"] ?? null;
$PARAM = $inputData["param"] ?? null;
$ID_PERSEDIAAN = $inputData["url"] ?? null;
$TANGGAL = $inputData["tanggal"] ?? null;

// Validate if necessary data is provided
if (empty($ID_BARANG)) {
    sendErrorResponse('Missing or invalid ID_BARANG', 400);
    exit;
}

// Fetch Barang
try {
    $BARANG = fetchBarang($ID_BARANG);
} catch (Exception $e) {
    sendErrorResponse('Internal server error: ' . $e->getMessage(), 500);
    exit;
}

// Send success response
sendSuccessResponse(['Barang' => $BARANG]);

/**
 * Fetch Barang details based on category
 */
function fetchBarang($ID_BARANG) {
    global $ID_PERSEDIAAN;
    
    if (empty($ID_PERSEDIAAN)) {
        
        $GetDetails = GetQuery2("SELECT SUM(p.QTY) AS TOTAL_QTY
        FROM t_persediaan p
        LEFT JOIN t_pengeluaran d ON p.ID_TRANSAKSI = d.ID_PENGELUARAN
        WHERE (d.STATUS_APPROVAL IS NULL OR d.STATUS_APPROVAL <> 2) 
        AND p.ID_BARANG = :ID_BARANG  and p.STATUS = 1
        GROUP BY p.ID_BARANG
        HAVING SUM(p.QTY) > 0
        ORDER BY p.ID_BARANG", [':ID_BARANG' => $ID_BARANG]);
    } else {
        $GetDetails = GetQuery2("SELECT SUM(QTY) AS TOTAL_QTY
        FROM t_persediaan p
        LEFT JOIN m_barang b on p.ID_BARANG = b.ID_BARANG
        LEFT JOIN t_pengeluaran d on p.ID_TRANSAKSI = d.ID_PENGELUARAN AND d.STATUS_APPROVAL = 1
        WHERE p.STATUS = 1
        AND p.ID_BARANG = :ID_BARANG
        AND ID_PERSEDIAAN IN (
            SELECT ID_PERSEDIAAN
            FROM t_persediaan
            WHERE COALESCE(ID_PERSEDIAAN, '') = '' OR ID_PERSEDIAAN < :ID_PERSEDIAAN
        )
        GROUP BY b.ID_BARANG
        HAVING SUM(QTY) > 0
        ORDER BY b.ID_BARANG", [':ID_BARANG' => $ID_BARANG, ':ID_PERSEDIAAN' => $ID_PERSEDIAAN]);
    }

    if (!$GetDetails) {
        throw new Exception('Query execution failed');
    }

    
    $details = [];
    while ($row = $GetDetails->fetch(PDO::FETCH_ASSOC)) {
        $details[] = [
            'TOTAL_QTY' => $row['TOTAL_QTY']
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
    ]);
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
