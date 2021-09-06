<?php

  session_start();

  $font1 = "Handage AOE Bold.ttf";
  $font2 = "Quantas Light Regular.ttf";
  
  header('Content-Type: image/png');
  
  $canvas = imagecreatetruecolor(370, 180); 
  
  $purple = imagecolorallocate($canvas, 98, 8, 155);
  $yellow = imagecolorallocate($canvas, 255, 236, 117);
  $blue = imagecolorallocate($canvas, 0, 14, 133);
  $red = imagecolorallocate($canvas, 195, 24, 24);
  $black = imagecolorallocate($canvas, 0, 0, 0);
  $length = 2;
  
  imagefill($canvas, 0, 0, $purple); 
  imagefilledrectangle($canvas, 8, 8, 360, 170, $yellow);
  
  $str1 = substr(str_shuffle(md5(time())), 0, $length);
  $str2 = substr(str_shuffle(md5(time())), 0, $length);
  
  $text = $str1 . $str2;
  
  $_SESSION["captcha"] = $text;

  imagettftext($canvas, 53, 41, 65, 90, $blue, $font1, $str1);
  imagettftext($canvas, 35, -30, 180, 55, $red, $font1, $str2);
  imagettftext($canvas, 12, 0, 13, 140, $black, $font2, "session id: " .
    session_id());
  imagettftext($canvas, 12, 0, 13, 160, $black, $font2, "captcha: " . $text);
  
  imagepng($canvas);

?>
