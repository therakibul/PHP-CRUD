<?php
    require_once("functions.php");
    session_start();
    $mysqli = new mysqli("localhost", "root", "", "crud") or die(mysqli_error($mysqli));
    $id = 0;
    if(isset($_POST["save"])){
        $name       = $_POST["name"];
        $location   = $_POST["location"];
        $mysqli->query("INSERT INTO data (name, location) VALUES('{$name}', '{$location}')") or die($mysqli->error);
        $_SESSION["message"] = "Record has been saved.";
        $_SESSION["msg_type"] = "success";
        redirect_to("index.php");
    }
    if(isset($_GET["action"]) && $_GET["action"] == "delete"){
        $id = $_GET["id"];
        $mysqli->query("DELETE FROM data WHERE id = {$id}") or die($mysqli->error);
         $_SESSION["message"] = "Record has been deleted.";
        $_SESSION["msg_type"] = "danger";
        redirect_to("index.php");
    }  
    $update = false;

    if(isset($_GET["action"]) && $_GET["action"] == "edit"){
        $id = $_GET["id"];
        $update = true;
        $result = $mysqli->query("SELECT * FROM data WHERE id = {$id}") or die($mysqli->error());
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $location = $row["location"];
    }
    if(isset($_POST["update"])){
        $id = $_POST["id"];
        $name = $_POST["name"];
        $location = $_POST["location"];
        $mysqli->query("UPDATE data SET name='{$name}', location='{$location}' WHERE id = {$id}") or die($mysqli->error());
        $_SESSION["message"] = "Record has been updated.";
        $_SESSION["msg_type"] = "success";
        redirect_to("index.php");
    }
?>