<?php
$ID_USER = $_SESSION['LOGINUS_GIS'];
$USERAKSES = $_SESSION['LOGINAKS_GIS'];
$USERNAME = $_SESSION['LOGINUS_GIS'];

$ID_PENGELUARAN="";
$TANGGAL_KELUAR_AWAL = date('Y-m-01'); 
$TANGGAL_KELUAR_AKHIR = date('Y-m-t');
$KETERANGAN_PENGELUARAN="";
$ID_KATEGORI = "";
$ID_BARANG = "";
$NO_BATCH = "";
$KETERANGAN_PERSEDIAAN="";

$ID_KATEGORI_EDIT = "";
$ID_BARANG_EDIT = "";

if (isset($_POST['cari'])) {
    $ID_PENGELUARAN = $_POST['ID_PENGELUARAN'];
    $TANGGAL_KELUAR_AWAL = $_POST['TANGGAL_KELUAR_AWAL'];
    $TANGGAL_KELUAR_AKHIR = $_POST['TANGGAL_KELUAR_AKHIR'];
    $ID_KATEGORI = $_POST['ID_KATEGORI'];
    $ID_BARANG = $_POST['ID_BARANG'];

    $getBarang = GetQuery2("SELECT ID_BARANG ID_BARANG,NAMA_BARANG FROM m_barang WHERE STATUS = 1 AND ID_KATEGORI = :ID_KATEGORI ORDER BY NAMA_BARANG", [':ID_KATEGORI' => $ID_KATEGORI]);


    $ID_KATEGORI_EDIT = $ID_KATEGORI;
    $ID_BARANG_EDIT = $ID_BARANG;
    $NO_BATCH_EDIT = $NO_BATCH;

    if ($USERAKSES == "User") {
        $query = "SELECT p.*,d.FOTO,CASE WHEN d.DK = 'D' THEN 'Debit' ELSE 'Kredit' END DK_DESK,REPLACE(d.QTY,'-','') QTY,b.ID_BARANG,b.NAMA_BARANG,k.NAMA_KATEGORI,d.ID_PERSEDIAAN,j.NAMA_PEKERJAAN,d.KONDISI,
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
        WHERE p.`STATUS` = 1 AND p.ID_PENGELUARAN LIKE :ID_PENGELUARAN AND p.TANGGAL_KELUAR BETWEEN :TANGGAL_KELUAR_AWAL AND :TANGGAL_KELUAR_AKHIR AND b.ID_KATEGORI LIKE :ID_KATEGORI AND b.ID_BARANG LIKE :ID_BARANG AND p.CREATED_BY = '$USERNAME'";
    } else {
        $query = "SELECT p.*,d.FOTO,CASE WHEN d.DK = 'D' THEN 'Debit' ELSE 'Kredit' END DK_DESK,REPLACE(d.QTY,'-','') QTY,b.ID_BARANG,b.NAMA_BARANG,k.NAMA_KATEGORI,d.ID_PERSEDIAAN,j.NAMA_PEKERJAAN,d.KONDISI,
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
        WHERE p.`STATUS` = 1 AND p.ID_PENGELUARAN LIKE :ID_PENGELUARAN AND p.TANGGAL_KELUAR BETWEEN :TANGGAL_KELUAR_AWAL AND :TANGGAL_KELUAR_AKHIR AND b.ID_KATEGORI LIKE :ID_KATEGORI AND b.ID_BARANG LIKE :ID_BARANG";
    }
    

    $params = array(
        ":ID_PENGELUARAN" => "%" . $_POST['ID_PENGELUARAN'] . "%",
        ":TANGGAL_KELUAR_AWAL" => $_POST['TANGGAL_KELUAR_AWAL'],
        ":TANGGAL_KELUAR_AKHIR" => $_POST['TANGGAL_KELUAR_AKHIR'],
        ":ID_KATEGORI" => "%" . $_POST['ID_KATEGORI'] . "%",
        ":ID_BARANG" => "%" . $_POST['ID_BARANG'] . "%",
    );

    $getPengeluaran = GetQuery2($query, $params);
    $rowBarang = $getBarang->fetchAll(PDO::FETCH_ASSOC);
} else {
    $query = "SELECT p.*,d.FOTO,CASE WHEN d.DK = 'D' THEN 'Debit' ELSE 'Kredit' END DK_DESK,REPLACE(d.QTY,'-','') QTY,b.ID_BARANG,b.NAMA_BARANG,k.NAMA_KATEGORI,d.ID_PERSEDIAAN,j.NAMA_PEKERJAAN,d.KONDISI,
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
    WHERE p.`STATUS` = 1";
    $params = array();
    $getPengeluaran = GetQuery2($query, $params);
}

$kategori = "SELECT ID_KATEGORI,NAMA_KATEGORI FROM m_kategori WHERE STATUS = 1";
$params = array();
$getKategori = GetQuery2($kategori, $params);


$rowPengeluaran = $getPengeluaran->fetchAll(PDO::FETCH_ASSOC);
$rowKategori = $getKategori->fetchAll(PDO::FETCH_ASSOC);


?>