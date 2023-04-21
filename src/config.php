<?php
$username = 'root';
$password = '';

try {
    $conn = new PDO ('mysql:host=localhost;dbname=app',$username, $password);
    $conn->SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo 'Success';
}catch (PDOException $e) {
    echo 'ERROR '.$e->getMessage();
};

?>