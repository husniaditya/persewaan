<?php

$ID_USER = $_SESSION['LOGINUS_GIS'];

$DATENOW = date('Y-m-d');

$query = "SELECT 
        b.ID_KATEGORI,
        g.NAMA_KATEGORI,
        b.ID_BARANG,
        b.NAMA_BARANG
    FROM 
        m_barang b
    LEFT JOIN
        m_kategori g on b.ID_KATEGORI = g.ID_KATEGORI
    ORDER BY 
        b.ID_KATEGORI,b.NAMA_BARANG";

$params = array();
$getBarang = GetQuery2($query, $params);
$rowBarang = $getBarang->fetchAll(PDO::FETCH_ASSOC);

$queryApproval = "SELECT p.*,d.FOTO,CASE WHEN d.DK = 'D' THEN 'Debit' ELSE 'Kredit' END DK_DESK,REPLACE(d.QTY,'-','') QTY,b.ID_BARANG,b.NAMA_BARANG,k.NAMA_KATEGORI,d.ID_PERSEDIAAN,j.NAMA_PEKERJAAN,
CASE WHEN p.STATUS_APPROVAL = 0 THEN 'fa-solid fa-spinner fa-spin'
WHEN p.STATUS_APPROVAL = 1 THEN 'fa-solid fa-check'
ELSE 'fa-solid fa-xmark'
END APPROVAL_CLASS,
CASE WHEN p.STATUS_APPROVAL = 0 THEN 'badge badge-inverse'
WHEN p.STATUS_APPROVAL = 1 THEN 'badge badge-success' 
ELSE 'badge badge-danger' 
END AS APPROVAL_BADGE,
CASE WHEN p.STATUS_APPROVAL = 0 THEN 'Menunggu persetujuan'
WHEN p.STATUS_APPROVAL = 1 THEN 'Disetujui' 
ELSE 'Ditolak' 
END AS STATUS_APPROVAL_DESK
FROM t_pengeluaran p
LEFT JOIN t_persediaan d ON p.ID_PENGELUARAN = d.ID_TRANSAKSI
LEFT JOIN m_barang b ON d.ID_BARANG = b.ID_BARANG
LEFT JOIN m_kategori k ON k.ID_KATEGORI = b.ID_KATEGORI
LEFT JOIN m_pekerjaan j ON p.ID_PEKERJAAN = j.ID_PEKERJAAN
WHERE p.`STATUS` = 1 AND p.STATUS_APPROVAL = 0";

$params = array();
$getPemasukan = GetQuery2($queryApproval, $params);
$rowPemasukan = $getPemasukan->fetchAll(PDO::FETCH_ASSOC);
?>