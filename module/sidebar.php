<?php
if ($_SESSION['LOGINAKS_GIS'] == 'Admin') {
    include 'menu/admin.php';
}
if ($_SESSION['LOGINAKS_GIS'] == 'User') {
    include 'menu/user.php';
}
if ($_SESSION['LOGINAKS_GIS'] == 'Manager') {
    include 'menu/manager.php';
}
?>