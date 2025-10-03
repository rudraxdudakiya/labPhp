<?php
session_start();

$code = substr(bin2hex(random_bytes(4)), 0, 6);
$_SESSION["captcha"] = $code;
$img = imagecreate(90, 25);

imagecolorallocate($img, 0, 0, 0);

imagestring(
    $img, 15, 20, 5, $code, imagecolorallocate($img, 255, 255, 255)
);

imagepng($img);