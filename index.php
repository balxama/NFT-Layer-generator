<?php
die;
$people_json = file_get_contents('http://localhost/mistix/json.js');
 
$decoded_json = json_decode($people_json, false, JSON_PRETTY_PRINT);

//echo $people_json;
$i=0;
 foreach( $decoded_json as $keys=>$key) {
 $i++;
 foreach( $key->swaps as $keys2=>$key2) {
     
    $id=$key2->transactionHash;
    $protocol=$key2->protocol;
    $date=date("Y-m-d H:i:s ", strtotime(date($key->createdAt)));
    $amount=$key->profitAmountUsd;
    image_maker($id,$amount,$i,$date,$protocol);

 }

 if($i==100){
     die;
 }
}
//print_r($decoded_json);
//echo "</pre>";



function image_maker($text1,$text,$counter,$date,$protocol){

    $font = dirname(__FILE__) . '/fonts/Supply-Regular.ttf';
    
    $image = imagecreate(2000, 2000);
    // Set the background color of image
    $background_color = imagecolorallocatealpha($image, 0, 0, 0, 127);
      
    // Set the text color of image
    $text_color = imagecolorallocate($image, 175, 175, 175);
      
    // // Function to create image which contains string.
    // imagestring($image, 40, 50, 100,  "ID : ".$text1, $text_color);
    // imagestring($image, 40, 800, 100,  "Amount In USD : ".$text, $text_color);
    // imagestring($image, 40, 1100, 100,  "Attack Date : ".$date, $text_color);
    // imagestring($image, 40, 1100, 100,  "Protocol : ".$protocol, $text_color);

    imagettftext($image, 16, 0,50,50, $text_color,$font, strtoupper($text1));
    imagettftext($image, 16, 0, 980,50, $text_color,$font, "$ ".strtoupper($text));
    //imagettftext($image, 20, 0, 1400,120, $text_color,$font, "Amount: ".$counter);
    imagettftext($image, 16, 0, 1250,50, $text_color,$font, "DATE: ".strtoupper($date));
    imagettftext($image, 16, 0, 1700,50, $text_color,$font, "PROTOCOL: ".strtoupper($protocol));
    //header("Content-Type: image/png");
      
   // imagepng($image);
    $save = strtolower($counter) .".png";
    imagepng($image, $save);
    //imagedestroy($image);
}
?>