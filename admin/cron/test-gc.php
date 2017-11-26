//DOWNLOAD FILE 
<?php
set_time_limit(0); // unlimited max execution time 
$fh = fopen('gc.csv', 'w');
$options = array(
  CURLOPT_FILE => $fh,
  CURLOPT_TIMEOUT => 28800, // set this to 8 hours so we dont timeout on big files
  CURLOPT_URL => 'http://goldencatch.com.ua/files/ItemsRRPOPT.csv',
);  

$ch = curl_init(); 
curl_setopt_array($ch, $options); 
curl_exec($ch); 

?>