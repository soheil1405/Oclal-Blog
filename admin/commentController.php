<?php

session_start();

include '../database/db.php';


$id=$_GET['id'];
$whatToDo=$_GET['what'];



if($whatToDo=='delete'){

    $select = $conn->prepare("DELETE FROM comment WHERE id=?");
    $select->bindValue(1,$id);
    $select->execute();

    header('Location:comments.php');
}

?>