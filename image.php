<?php
session_start();

// Creating image usin php
$random_alpha = md5(rand());
$captcha_code = substr($random_alpha , 0 , 6);
$_SESSION['captcha_code'] = $captcha_code;
header('Content-Type: image/png');

$image = imagecreatetruecolor(200, 18); // (width , height)
$background_color = imagecolorallocate($image, 204,294,204); 
$text_color = imagecolorallocate($image, 255, 255 ,255);
imagefilledrectangle($image,0,0,200,38, $background_color);
//fill img background with $background_color
//imagefilledrectangle($image, x1, y1, x2, y2, $background_color);
imagettftext($image, 20, 0, 60, 38, $text_color, $captcha_code);
// imagettftext($image, size, angle, x, y, $text_color, $captcha_code);

imagepng($image);
imagedestroy($image);
?>
