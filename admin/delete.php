<?php
include '../database/db.php';
$id=$_GET['id'];
$delete=$conn->prepare("DELETE FROM ocaladb WHERE id=?");
$delete->bindValue(1,$id);
$delete->execute();
header('location:showArticles.php');


?>