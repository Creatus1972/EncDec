<?php
// $key = sha1('EnCRyprfawtegbavgartrestgt4468hbhrtz3hbT10nDeCRypT!OnK#Y!RiSRNn');
// define("KEY1", sha1('EnCRyprfawtegbavgartrestgt4468hbhrtz3hbT10nDeCRypT!OnK#Y!RiSRNn'));
// define("KEY2", "EnCRyprfawtegbavgartrestgt4468hbhrtz3hbT10nDeCRypT!OnK#Y!RiSRNn");
// Encode String
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
// Decode String
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
?>

