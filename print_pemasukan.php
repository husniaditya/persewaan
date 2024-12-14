<?php
require_once 'module/connection/conn.php';

if(!isset($_SESSION["LOGINID_GIS"])) {
    ?><script>alert('Silahkan login dahulu');</script><?php
    ?><script>document.location.href='index.php';</script><?php
    die(0);
}

$DATENOW = date("d-m-Y H:i:s");
$USERNAMA = $_SESSION["LOGINNAMA_GIS"];

// Include the main TCPDF library (search for installation path).
require_once('assets/tcpdf/tcpdf.php');

if (isset($_GET['id'])) {
    $ID_PEMASUKAN = $_GET["id"];

    class CustomPDF extends TCPDF {
        // Custom Header
        public function Header() {
            $this->SetMargins(40, 30, 40);
    
            // Logo
            $image_ipsi = 'assets/image/logo/gis.png';
            $this->Image($image_ipsi, 15, 4, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    
            // Set font
            $this->SetFont('helvetica', 'B', 14);
    
            // Get the width of the page
            $pageWidth = $this->getPageWidth();
    
            // Title
            $title = "Hardware Loan GIS";
            $titleWidth = $this->GetStringWidth($title);
    
            $this->Ln(7);
            $this->SetX(($pageWidth - $titleWidth) / 2); // Centering the title
            $this->Write(5, $title, '', 0, 'L', true, 0, false, false, 0);
            $this->Ln(1);
    
            $this->SetFont('helvetica', '', 8);
            // Centering the branch information
            $this->Write(5, 'Regional Office - Wilmar CKP', '', 0, 'C', true, 0, false, false, 0);
            $this->Ln(-1);
            $branchWidth = $this->GetStringWidth('Pd. Damar, Kec. Mentaya Hilir Utara, Kabupaten Kotawaringin Timur, Kalimantan Tengah 74361');
            $this->SetX(($pageWidth - $branchWidth) / 8);
            $this->Cell(32, 5, '', 0, 0, "L");
            $this->MultiCell(185, 5, 'Pd. Damar, Kec. Mentaya Hilir Utara, Kabupaten Kotawaringin Timur, Kalimantan Tengah 74361' . "\n", 0, 'C', 0, 1);
            // Draw a horizontal line under the header
            $this->Line(10, $this->GetY() + 2, $pageWidth - 10, $this->GetY() + 2);
        }
    
        // Custom Footer
        public function Footer() {
            global $USERNAMA, $DATENOW;
            $this->SetY(-15);
            $this->SetFont('helvetica', 'I', 8);
            $this->Cell(0, 10, 'Dicetak Oleh: ' . $USERNAMA . " (" . $DATENOW . ")", 0, 0, 'L');
            $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, 0, 'R');
        }
    }
    
    // Create PDF object
    $pdf = new CustomPDF('L', 'mm', 'A4', true, 'UTF-8', false);
    
    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('System');
    $pdf->SetTitle('Laporan Pengembalian Alat');
    
    // Set default header data
    $pdf->setPrintHeader(true);
    $pdf->setPrintFooter(true);
    
    // Set margins
    $pdf->SetMargins(15, 30, 15);
    $pdf->SetHeaderMargin(10);
    $pdf->SetFooterMargin(10);
    
    // Set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, 10);
    
    // Add a page
    $pdf->AddPage();
    
    // Title
    $pdf->SetFont('helvetica', 'BU', 14);
    $pdf->Cell(0, 10, 'Laporan Pengembalian Alat', 0, 1, 'C');

    $query = "SELECT m.*,d.KONDISI,d.FOTO,CASE WHEN d.DK = 'D' THEN 'Debit' ELSE 'Kredit' END DK_DESK,d.QTY,b.ID_BARANG,b.NAMA_BARANG,k.NAMA_KATEGORI,m.KETERANGAN KETERANGAN_MASUK,d.KETERANGAN KETERANGAN_ALAT
    FROM t_pemasukan m
    LEFT JOIN t_persediaan d ON m.ID_PEMASUKAN = d.ID_TRANSAKSI
    LEFT JOIN t_persediaan d2 ON m.ID_PENGELUARAN = d2.ID_TRANSAKSI
    LEFT JOIN m_barang b ON d.ID_BARANG = b.ID_BARANG
    LEFT JOIN m_kategori k ON k.ID_KATEGORI = b.ID_KATEGORI
    WHERE m.`STATUS` = 1 AND ID_PEMASUKAN = :ID_PEMASUKAN";
    
    $params = array(
        ":ID_PEMASUKAN" => $ID_PEMASUKAN
    );
    $getPemasukan = GetQuery2($query, $params);
    $rowPemasukan = $getPemasukan->fetchAll(PDO::FETCH_ASSOC);
    $dataMasuk = $rowPemasukan[0];

    $ID_PENGELUARAN = $dataMasuk['ID_PENGELUARAN'];

    $query2 = "SELECT p.*,d.FOTO,CASE WHEN d.DK = 'D' THEN 'Debit' ELSE 'Kredit' END DK_DESK,REPLACE(d.QTY,'-','') QTY,b.ID_BARANG,b.NAMA_BARANG,k.NAMA_KATEGORI,d.ID_PERSEDIAAN,j.NAMA_PEKERJAAN,d.KONDISI,p.KETERANGAN KETERANGAN_PENGELUARAN,d.KETERANGAN KETERANGAN_ALAT,u.NAMA APPROVAL_NAMA,p.TANGGAL_APPROVAL,
    CASE WHEN p.STATUS_APPROVAL = 0 THEN 'Menunggu persetujuan'
    WHEN p.STATUS_APPROVAL = 1 THEN 'Disetujui' 
    ELSE 'Ditolak' 
    END AS STATUS_APPROVAL_DESK
    FROM t_pengeluaran p
    LEFT JOIN t_persediaan d ON p.ID_PENGELUARAN = d.ID_TRANSAKSI
    LEFT JOIN m_barang b ON d.ID_BARANG = b.ID_BARANG
    LEFT JOIN m_kategori k ON k.ID_KATEGORI = b.ID_KATEGORI
    LEFT JOIN m_pekerjaan j ON p.ID_PEKERJAAN = j.ID_PEKERJAAN
    LEFT JOIN m_user u ON p.USER_APPROVAL = u.USERNAME
    WHERE p.`STATUS` = 1 AND p.ID_PENGELUARAN = :ID_PENGELUARAN";
    
    $params = array(
        ":ID_PENGELUARAN" => $ID_PENGELUARAN
    );
    $getPengeluaran = GetQuery2($query2, $params);
    $dataKeluar = $getPengeluaran->fetchAll(PDO::FETCH_ASSOC);

    if (empty($dataKeluar)) {
        $dataKeluar['ID_PENGELUARAN'] = $dataMasuk['ID_PENGELUARAN'];
        $dataKeluar['ID_BARANG'] = '';
        $dataKeluar['NAMA_BARANG'] = '';
        $dataKeluar['NAMA_KATEGORI'] = '';
        $dataKeluar['QTY'] = '';
        $dataKeluar['KONDISI'] = '';
        $dataKeluar['KETERANGAN_ALAT'] = '';
        $dataKeluar['FOTO'] = '';
        $dataKeluar['STATUS_APPROVAL_DESK'] = '';
        $dataKeluar['APPROVAL_NAMA'] = '';
        $dataKeluar['NAMA_PEKERJAAN'] = '';
        $dataKeluar['TANGGAL_APPROVAL'] = '';
        $dataKeluar['TANGGAL_KELUAR'] = '';
    } else {
        $dataKeluar = $dataKeluar[0];
    }
    
    // Member Information
    $pdf->SetFont('helvetica', '', 10);
    $pdf->Ln(2);
    $pdf->Cell(40, 6, 'Nama Pemohon', 0, 0, 'L');
    $pdf->Cell(150, 6, ': ' . $dataMasuk['NAMA'], 0, 0, 'L');
    $pdf->Cell(40, 6, 'Dokumen Peminjaman', 0, 0, 'L');
    $pdf->Cell(40, 6, ': ' . $dataKeluar['ID_PENGELUARAN'], 0, 1, 'L');
    $pdf->Cell(40, 6, 'Unit Operasi', 0, 0, 'L');
    $pdf->Cell(150, 6, ': ' . $dataMasuk['OPERATING_UNIT'], 0, 0, 'L');
    $pdf->Cell(40, 6, 'Dokumen Pengembalian', 0, 0, 'L');
    $pdf->Cell(40, 6, ': ' . $dataMasuk['ID_PEMASUKAN'], 0, 1, 'L');
    $pdf->Cell(40, 6, 'Divisi', 0, 0, 'L');
    $pdf->Cell(150, 6, ': ' . $dataMasuk['DIVISI'], 0, 0, 'L');
    $pdf->Cell(40, 6, 'Status Dokumen', 0, 0, 'L');
    $pdf->Cell(40, 6, ': ' . $dataKeluar['STATUS_APPROVAL_DESK'], 0, 1, 'L');
    $pdf->Cell(40, 6, 'Keterangan Peminjaman', 0, 0, 'L');
    $pdf->Cell(150, 6, ': ' . $dataMasuk['KETERANGAN_MASUK'], 0, 0, 'L');
    $pdf->Cell(40, 6, 'Disetujui Oleh', 0, 0, 'L');
    $pdf->Cell(40, 6, ': ' . $dataKeluar['APPROVAL_NAMA'], 0, 1, 'L');
    $pdf->Cell(40, 6, 'Jenis Pekerjaan', 0, 0, 'L');
    $pdf->Cell(150, 6, ': ' . $dataKeluar['NAMA_PEKERJAAN'], 0, 0, 'L');
    $pdf->Cell(40, 6, 'Tanggal Persetujuan', 0, 0, 'L');
    $pdf->Cell(40, 6, ': ' . $dataKeluar['TANGGAL_APPROVAL'], 0, 1, 'L');
    $pdf->Cell(40, 6, 'Tanggal Peminjaman', 0, 0, 'L');
    $pdf->Cell(70, 6, ': ' . $dataKeluar['TANGGAL_KELUAR'], 0, 1, 'L');
    $pdf->Cell(40, 6, 'Tanggal Pengembalian', 0, 0, 'L');
    $pdf->Cell(70, 6, ': ' . $dataMasuk['TANGGAL_MASUK'], 0, 0, 'L');

    $pdf->Ln(15);
    
    // Table Header Peminjaman
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(40, 6, 'Data peminjaman alat:', 0, 0, 'L');
    $pdf->Ln();
    $pdf->SetFillColor(240, 240, 240);
    $pdf->Cell(30, 8, 'ID Alat', 1, 0, 'C', 1);
    $pdf->Cell(40, 8, 'Nama Alat', 1, 0, 'C', 1);
    $pdf->Cell(30, 8, 'Kategori', 1, 0, 'C', 1);
    $pdf->Cell(10, 8, 'Qty', 1, 0, 'C', 1);
    $pdf->Cell(20, 8, 'Kondisi', 1, 0, 'C', 1);
    $pdf->Cell(85, 8, 'Keterangan Alat', 1, 0, 'C', 1);
    $pdf->Cell(50, 8, 'Gambar', 1, 1, 'C', 1);
    
    // Table Content Peminjaman
    $pdf->SetFont('helvetica', '', 9);
    $pdf->Cell(30, 40, $dataKeluar['ID_BARANG'], 1, 0, 'C');
    $pdf->Cell(40, 40, $dataKeluar['NAMA_BARANG'], 1, 0, 'L');
    $pdf->Cell(30, 40, $dataKeluar['NAMA_KATEGORI'], 1, 0, 'C');
    $pdf->Cell(10, 40, $dataKeluar['QTY'], 1, 0, 'R');
    $pdf->Cell(20, 40, $dataKeluar['KONDISI'], 1, 0, 'C');
    $pdf->MultiCell(85, 40, $dataKeluar['KETERANGAN_ALAT'], 1, 'L', 0, 0, '', '', true, 0, false, true, 40, 'M');
    if (empty($dataKeluar['FOTO'])) {
        $pdf->Cell(50, 40, '', 1, 0, 'C');
    } else {
        $extension = strtoupper(pathinfo($dataKeluar['FOTO'], PATHINFO_EXTENSION)); // Extract the file extension
        // Place the image
        $pdf->Image($dataKeluar['FOTO'], $pdf->GetX(), $pdf->GetY(), 50, 40, $extension, '', '', true, 150, '', false, false, 1, false, false, false);
    }

    $pdf->Ln(40);

    // Table Header Pengembalian
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(40, 6, 'Data pengembalian alat:', 0, 0, 'L');
    $pdf->Ln();

    // Table Content Pengembalian
    $pdf->SetFont('helvetica', '', 9);
    $pdf->Cell(30, 40, $dataMasuk['ID_BARANG'], 1, 0, 'C');
    $pdf->Cell(40, 40, $dataMasuk['NAMA_BARANG'], 1, 0, 'L');
    $pdf->Cell(30, 40, $dataMasuk['NAMA_KATEGORI'], 1, 0, 'C');
    $pdf->Cell(10, 40, $dataMasuk['QTY'], 1, 0, 'R');
    $pdf->Cell(20, 40, $dataMasuk['KONDISI'], 1, 0, 'C');
    $pdf->MultiCell(85, 40, $dataMasuk['KETERANGAN_ALAT'], 1, 'L', 0, 0, '', '', true, 0, false, true, 40, 'M');
    if (empty($dataMasuk['FOTO'])) {
        $pdf->Cell(50, 40, '', 1, 0, 'C');
    } else {
        $extension2 = strtoupper(pathinfo($dataMasuk['FOTO'], PATHINFO_EXTENSION)); // Extract the file extension
        // Place the image
        $pdf->Image($dataMasuk['FOTO'], $pdf->GetX(), $pdf->GetY(), 50, 40, $extension2, '', '', true, 150, '', false, false, 1, false, false, false);
    }
    
    
    // Output PDF
    $pdf->Output('Laporan Pengembalian ' . $ID_PEMASUKAN . '.pdf', 'I');
}
