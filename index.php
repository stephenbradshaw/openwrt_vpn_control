<html>
<title>VPN Control</title>
<body>

<?php

require("lib.php");

$v_config = getFileContents($vpn_config);
$clines = configParse($v_config);
$ic = array();

echo "<script src='/script.js'></script>\n";
echo "<table>\n";
echo "<tr>\n";
echo "<th>Profile</th>\n";
echo "<th>Status</th>\n";
echo "<th>Control</th>\n";
echo "</tr>\n";
for ($i = 0; $i < count($clines); $i++) {
    echo "<tr>\n";
    echo "<td>" . $clines[$i] . "</td>\n";
    echo "<td><span id='st_" . $i . "'>" .  b2s(checkFile($clines[$i]))  . "</span></td>\n";
    echo "<td><button type='submit' onclick='change_config(\"" . $i . "\")'><span id='bt_" . $i . "'>" . b2b(checkFile($clines[$i])) . "</span></button></td>\n";
    echo "<tr>\n";
    array_push($ic, $i);
}
echo "</table>\n";

$list = implode('", "', $ic);
echo "<br>\n<br>\n<button type='submit' onclick='update_entire_page([\"" . $list ."\"])'>Update Page Status</button>\n";
?>
</body>
</html>