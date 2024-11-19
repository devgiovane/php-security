<?php

if (count($argv) < 3) exit(1);

[ , $secretKey, $payload  ] = $argv;

$data = json_decode($payload, true);
$encryptedDataBase64 = $data['data'];
$ivBase64 = $data['iv'];
$tagBase64 = $data['tag'];

/**
 * @throws Exception
 */
function decryptData($encryptedDataBase64, $secretKey, $ivBase64, $tagBase64) {
    $key = hex2bin(bin2hex($secretKey));
    $encryptedData = base64_decode($encryptedDataBase64);
    $iv = base64_decode($ivBase64);
    $tag = base64_decode($tagBase64);
    if (strlen($iv) !== 12) {
        throw new Exception("error in iv");
    }
    $decrypted = openssl_decrypt(
        $encryptedData,
        'aes-256-gcm',
        $key,
        OPENSSL_RAW_DATA,
        $iv,
        $tag
    );
    return json_decode($decrypted, true);
}

try {
    $decryptedData = decryptData($encryptedDataBase64, $secretKey, $ivBase64, $tagBase64);
    var_dump($decryptedData);
} catch (Exception $exception) {
    var_dump($exception->getMessage());
}