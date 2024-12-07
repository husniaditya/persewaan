<?php
$ID_USER = $_SESSION['LOGINUS_GIS'];

$TANGGAL_KELUAR_AWAL = date('Y-m-01');
$TANGGAL_KELUAR_AKHIR = date('Y-m-t');
$ID_KATEGORI_EDIT="";

$kategori = "SELECT ID_KATEGORI,NAMA_KATEGORI FROM m_kategori WHERE STATUS = 1";
$params = array();
$getKategori = GetQuery2($kategori, $params);


$rowKategori = $getKategori->fetchAll(PDO::FETCH_ASSOC);


?>