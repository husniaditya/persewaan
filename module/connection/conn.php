<?php

$host = "localhost";
$database = "persewaan";
$username = "root";
$password = "";

try {
    $db1 = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $db1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	ini_set('max_execution_time', 300); //300 seconds = 5 minutes
	ini_set('upload_max_filesize', '10M');
    session_start();

    $YEAR = date("Y");
    $MONTH = date("m");
    $DATE = date("d");

    function GetQuery2($query, $params = [])
    {
        global $db1;
        $result = $db1->prepare($query);
        $result->execute($params);
        return $result;
    }

    function createKode($namaTabel, $namaKolom, $awalan, $jumlahAngka)
    {
        global $db1, $YEAR, $MONTH;
        $angkaAkhir = 0;
        
        // Query to find the maximum existing number for the current year and month
        $stmt = $db1->query("SELECT MAX(RIGHT($namaKolom, $jumlahAngka)) AS akhir FROM $namaTabel WHERE SUBSTR($namaKolom, 5, 6) = '$YEAR$MONTH'");
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (isset($row["akhir"])) {
                $angkaAkhir = intval($row["akhir"]);
            }
        }

        // Increment the number to generate the next code
        $angkaAkhir = $angkaAkhir + 1;
        
        // Format the code with the prefix, year-month, and padded number
        return $awalan . '-' . $YEAR . $MONTH . '-' . str_pad($angkaAkhir, $jumlahAngka, '0', STR_PAD_LEFT);
    }

    function KodeBarang($namaTabel, $namaKolom, $awalan, $jumlahAngka, $idKategori)
    {
        global $db1, $YEAR, $MONTH;
        $angkaAkhir = 0;
        $idKategori = substr($idKategori,-2);
        
        // Query to find the maximum existing number for the current year and month
        $stmt = $db1->query("SELECT MAX(RIGHT($namaKolom, $jumlahAngka)) AS akhir FROM $namaTabel WHERE SUBSTR($namaKolom, 5, 6) = '$YEAR$MONTH'");
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (isset($row["akhir"])) {
                $angkaAkhir = intval($row["akhir"]);
            }
        }

        // Increment the number to generate the next code
        $angkaAkhir = $angkaAkhir + 1;
        
        // Format the code with the prefix, year-month, and padded number
        return $awalan . '-' . $YEAR . $MONTH . '-' . $idKategori .'.' . str_pad($angkaAkhir, $jumlahAngka, '0', STR_PAD_LEFT);
    }

    function createBatch($namaTabel, $namaKolom, $jumlahAngka, $idKategori, $tanggal)
    {
        global $db1, $YEAR, $MONTH;

        $YEARFORMAT = date("Y", strtotime($tanggal));
        // Get the current month as a numeric value (1 = January, 2 = February, etc.)
        $monthNumber = date("n", strtotime($tanggal));

        // Convert the month number to a corresponding letter (A = 1, B = 2, etc.)
        $MONTHFORMAT = chr(64 + $monthNumber);

        $angkaAkhir = 0;
        $idKategori = substr($idKategori,-2);
        
        // Query to find the maximum existing number for the current year and month
        $stmt = $db1->query("SELECT MAX(RIGHT($namaKolom, $jumlahAngka)) AS akhir FROM $namaTabel WHERE SUBSTR($namaKolom, 5, 6) = '$YEAR$MONTH'");
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (isset($row["akhir"])) {
                $angkaAkhir = intval($row["akhir"]);
            }
        }

        // Increment the number to generate the next code
        $angkaAkhir = $angkaAkhir + 1;
        
        // Format the code with the prefix, year-month, and padded number
        return $YEARFORMAT . $MONTHFORMAT . $idKategori . str_pad($angkaAkhir, $jumlahAngka, '0', STR_PAD_LEFT);
    }

    function autoInc($namaTabel, $namaKolom, $jumlahAngka)
    {
        global $db1;
        $angkaAkhir = 0;
        $stmt = $db1->query("select max(right($namaKolom,$jumlahAngka)) as akhir from $namaTabel");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (isset($row["akhir"])) {
                $angkaAkhir = intval($row["akhir"]);
            }
        }
        $angkaAkhir = $angkaAkhir + 1;
        return substr("00000000" . $angkaAkhir, -1 * $jumlahAngka);
    }
    
    // Create a thumbnail from an image file
    function createThumbnail($source, $width = 150, $height = 150) {
        if (!file_exists($source)) {
            return ''; // Return an empty string if the source image doesn't exist
        }
    
        // Get image details
        list($originalWidth, $originalHeight, $type) = getimagesize($source);
        $mime = image_type_to_mime_type($type);
    
        // Create image resource from the source
        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($source);
                break;
            case 'image/png':
                $image = imagecreatefrompng($source);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($source);
                break;
            default:
                return ''; // Return empty string if image type is unsupported
        }
    
        // Create a blank canvas for the thumbnail
        $thumbnail = imagecreatetruecolor($width, $height);
    
        // Resize the original image onto the thumbnail canvas
        imagecopyresampled(
            $thumbnail,
            $image,
            0, 0, 0, 0,
            $width, $height,
            $originalWidth, $originalHeight
        );
    
        // Output the thumbnail as a data URL
        ob_start();
        imagejpeg($thumbnail, null, 85); // Output as JPEG
        $thumbnailData = ob_get_clean();
    
        imagedestroy($image);
        imagedestroy($thumbnail);
    
        return 'data:image/jpeg;base64,' . base64_encode($thumbnailData);
    }    

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

?>