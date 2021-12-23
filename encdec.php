<?php
// $key = sha1('EnCRyprfawtegbavgartrestgt4468hbhrtz3hbT10nDeCRypT!OnK#Y!RiSRNn');
// define("KEY1", sha1('EnCRyprfawtegbavgartrestgt4468hbhrtz3hbT10nDeCRypT!OnK#Y!RiSRNn'));
// define("KEY2", "EnCRyprfawtegbavgartrestgt4468hbhrtz3hbT10nDeCRypT!OnK#Y!RiSRNn");
// Encode String - 1
function encode($value) {
    if (!$value) {
        return false;
    }
    $key = sha1('EnCRyprfawtegbavgartrestgt4468hbhrtz3hbT10nDeCRypT!OnK#Y!RiSRNn');
    // vagy $key = KEY1;
    // vagy $key = sha1(KEY2);
    $strLen = strlen($value);
    $keyLen = strlen($key);
    $j = 0;
    $encrypttext = '';
    for ($i = 0; $i < $strLen; $i++) {
        $ordStr = ord(substr($value, $i, 1));
        if ($j == $keyLen) {
            $j = 0;
        }
        $ordKey = ord(substr($key, $j, 1));
        $j++;
        $encrypttext .= strrev(base_convert(dechex($ordStr + $ordKey), 16, 36));
    }
    return $encrypttext;
}
// Decode String - 1
function decode($value) {
    if (!$value) {
        return false;
    }
    $key = sha1('EnCRyprfawtegbavgartrestgt4468hbhrtz3hbT10nDeCRypT!OnK#Y!RiSRNn');
    // vagy $key = KEY1;
    // vagy $key = sha1(KEY2);
    $strLen = strlen($value);
    $keyLen = strlen($key);
    $j = 0;
    $decrypttext = '';
    for ($i = 0; $i < $strLen; $i += 2) {
        $ordStr = hexdec(base_convert(strrev(substr($value, $i, 2)), 36, 16));
        if ($j == $keyLen) {
            $j = 0;
        }
        $ordKey = ord(substr($key, $j, 1));
        $j++;
        $decrypttext .= chr($ordStr - $ordKey);
    }
    return $decrypttext;
}
// Encode String - 2
function encryptPass($password) {
    $sSalt = 'Titkosítási kulcs';
    $sSalt = substr(hash('sha256', $sSalt, true), 0, 32);
    $method = 'aes-256-cbc';

    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

    $encrypted = base64_encode(openssl_encrypt($password, $method, $sSalt, OPENSSL_RAW_DATA, $iv));
    return $encrypted;
}
// Decode String - 2
function decryptPass($password) {
    $sSalt = 'Titkosítási kulcs';
    $sSalt = substr(hash('sha256', $sSalt, true), 0, 32);
    $method = 'aes-256-cbc';

    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

    $decrypted = openssl_decrypt(base64_decode($password), $method, $sSalt, OPENSSL_RAW_DATA, $iv);
    return $decrypted;
}
?>

