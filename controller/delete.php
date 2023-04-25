<?php 
require('../src/config.php');

$delete = 'DELETE FROM post WHERE id = "' . $_GET['id'] . '"';
$stmt = $conn->prepare($delete);
$stmt->execute();
header('Location:../view/dashboard.php');
?>