<?php
$id = '1';
$parametri = array(
    'employers_name' => 'Snezana', 
    'employers_salary' => '2600',
    'employers_age' => '25'
);

$parametriJSON = json_encode($parametri);

$akcija ='unesi';
$host = "localhost";
$port = 80;
$servis ="svetlanasaletovi/servis3/employers.php";

$response ="";
$fp = fsockopen($host, $port);

//GET dio
if($akcija == "prikazi"){

    fputs($fp, "GET /{$servis} HTTP/1.1\r\n");
    fputs($fp, "Host: {$host}\r\n");
    fputs($fp, "Connection: close\r\n\r\n");

}else if($akcija == "prikaziPojedinacno"){

    fputs($fp, "GET /{$servis} HTTP/1.1\r\n");
    fputs($fp, "Host: {$host}\r\n");
    fputs($fp, "Connection: close\r\n\r\n");

}else if ($akcija == "unesi"){

    fputs($fp, "POST /{$servis}  HTTP/1.1\r\n");
    fputs($fp, "Host: {$host}\r\n");
    fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
    fputs($fp, "Content-lenght: " . strlen($parametriJSON) . "\r\n");
    fputs($fp, "Connection: close\r\n\r\n");
    fputs($fp, $parametriJSON);
}
?>