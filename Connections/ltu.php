<?php
# FileName="WADYN_MYSQLI_CONN.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_ltu = "localhost";
$database_ltu = "klarobg_ltu";
$username_ltu = "klarobg_ltu";
$password_ltu = "mysql123";
@session_start();

$ltu = mysqli_init();
if (defined("MYSQLI_OPT_INT_AND_FLOAT_NATIVE")) $ltu->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, TRUE);
$ltu->real_connect($hostname_ltu, $username_ltu, $password_ltu, $database_ltu) or die("Connect Error: " . mysqli_connect_error());
$ltu->set_charset('utf8');
?>