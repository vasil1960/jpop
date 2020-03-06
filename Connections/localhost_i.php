<?php
# FileName="WADYN_MYSQLI_CONN.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_localhost_i = "localhost";
$database_localhost_i = "klarobg_jpop";
$username_localhost_i = "klarobg_jpop";
$password_localhost_i = "}o&T;z.WKWnl";
@session_start();

$localhost_i = mysqli_init();
if (defined("MYSQLI_OPT_INT_AND_FLOAT_NATIVE")) $localhost_i->options(MYSQLI_OPT_INT_AND_FLOAT_NATIVE, TRUE);
$localhost_i->real_connect($hostname_localhost_i, $username_localhost_i, $password_localhost_i, $database_localhost_i) or die("Connect Error: " . mysqli_connect_error());
$localhost_i->set_charset('utf8');
?>