<?php
 if( isset($_GET["id"])) {
    $id = $_GET["id"];

    $conn = new mysqli('localhost', 'root', '', 'taxisty');


    $sql="DELETE FROM reservation WHERE id=$id";
    $conn->query($sql);



 }
 header("location:/trips.php");
 exit;
?>