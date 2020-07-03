<?php

require("lib.php");

$v_config = getFileContents($vpn_config);
$clines = configParse($v_config);
$id = intval($_GET['id']);

if ($id < count($clines)) {
    echo b2s(checkFile($clines[$id]));
} else {
    echo 'false';
}

?>