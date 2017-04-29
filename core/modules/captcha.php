<?php
session_start();
function getCode($length) {
    $chars = '23456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjklmnpqrstuvwxyz'; // Certains caractères ont été enlevés car ils prêtent à confusion
    $code = '';
    for ($i=0; $i<$length; $i++) {
        $code .= $chars{ mt_rand( 0, strlen($chars) - 1 ) };
    }
    return $code; 
}
function random($tab) {
    return $tab[array_rand($tab)];
}
header ("Content-type: image/png");
$image = imagecreate(110,30);
$colors = array (imagecolorallocate($image, 141, 0, 0),
                  imagecolorallocate($image, 141, 0, 100),
                  imagecolorallocate($image, 60, 0, 141),
                  imagecolorallocate($image, 0, 141, 13),
                  imagecolorallocate($image, 0, 141, 119));
$code = getCode(8);
$_SESSION['captcha'] = $code;
imagestring($image, 5, 35, 15, $_SESSION['captcha'], random($colors));
imagecolortransparent($image, 0); 
 
imagepng($image);
?>