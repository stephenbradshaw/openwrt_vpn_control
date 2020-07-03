<?php

require("lib.php");

$v_config = getFileContents($vpn_config);
$clines = configParse($v_config);

$id = intval($_GET['id']);
$action = $_GET['action'];

$name = $clines[$id];

start_stop_vpn($name, $action);
echo $name;

?>