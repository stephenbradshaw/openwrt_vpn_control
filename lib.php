<?php

// You'll need to install sudo and add the following file
// to allow these files to run with root privs
// cat /etc/sudoers.d/nobody
// nobody ALL=(ALL) NOPASSWD: /etc/init.d/openvpn, /bin/cat

$vpn_config = "/etc/config/openvpn";
$config_suffix = "_tv'"; // suffix on vpn name configs to list

function start_stop_vpn($name, $action) {
    if ($action === "Enable") {
        shell_exec("/usr/bin/sudo /etc/init.d/openvpn up " . $name);
    }
    if ($action === "Disable") {
        shell_exec("/usr/bin/sudo /etc/init.d/openvpn down " . $name);
    }
}

function getFileContents($filename) {
    return shell_exec("/usr/bin/sudo /bin/cat " . $filename);
}

function endsWith($haystack, $needle) {
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }
    return (substr($haystack, -$length) === $needle);
}

function startsWith($haystack, $needle) {
    $length = strlen($needle);
    return (substr($haystack, 0, $length) === $needle);
}

function configParse($config) {
    $match = "config 'openvpn' '";
    $out = array();
    $lines = explode("\n", $config);
    $counter = 0;
    foreach($lines as $item) {
        if(startsWith ($item, $match) && endsWith($item, $config_suffix)) {
            $vpnp = str_replace($match, "", $item);
            $out[$counter] = rtrim($vpnp, "'");
            $counter++;
        }
    }
    return $out;
}

function checkFile($fb) {
    return file_exists ("/var/run/openvpn-" . $fb . ".pid");
}

function b2s($b) {
    return $b ? 'Enabled' : 'Disabled';
}

function b2b($b) {
    return $b ? 'Disable' : 'Enable';
}

?>