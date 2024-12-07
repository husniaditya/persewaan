<?php
require_once 'module/connection/conn.php';

// Unset specific session variables
unset($_SESSION["LOGINID_GIS"]);
// Destroy the entire session (if needed)
session_destroy();
?><script>alert('Anda telah keluar');</script><?php
?><script>document.location.href='index.php';</script><?php
?>