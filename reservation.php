<?php
    $votreposition = $_POST ['votreposition'];
    $destination = $_POST ['destination'];
    $date = $_POST ['date'];
    $heure = $_POST ['heure'];
    $nombredepersonne = $_POST ['nombredepersonne'];
    $numerotelephone = $_POST ['numerotelephone'];

    $conn = new mysqli('localhost','root','','taxisty');
    if ($conn->connect_error) {
        die('failed to connect' .$conn->connect_errort );
    } else{
        $stmt = $conn->prepare("Insert into reservation(votreposition, destination, date, heure, nombredepersonne , numerotelephone) 
        values(?, ?, ?, ?, ?, ?, ?) ");
        $stmt->bind_param("ssssiis",$votreposition,$destination,$date,$heure,$nombredepersonne,$numerotelephone);
        $stmt->execute();
        echo "registration complete";
        $stmt->close();
        $conn->close();
    }







?>