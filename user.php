<?php

define("SERVER", "localhost");
define("USERNAME","root");
define("PASSWORD", "");
define("DBNAME", "examdb");

if (isset($_POST['createUser'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    createUser($username,$password);
}
if (isset($_POST['loginUser'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    echo userLogin($username,$password);
}

if (isset($_POST['getUser'])) {
    getUser();
}

function getUser()
{
	$mysqli = new mysqli(SERVER,USERNAME,PASSWORD,DBNAME);

    // Check connection
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }

    // Attempt insert query execution
    $sql = "SELECT * FROM `user`";

    $result = $mysqli->query($sql);
    $row =   mysqli_fetch_array($result);


    $dbdata = array();


    while ( $row = $result->fetch_assoc())  {
        $dbdata[]=$row;
    }


    echo json_encode($dbdata);

    $mysqli->close();
}



function createUser($username,$password)
{
    $mysqli = new mysqli(SERVER,USERNAME,PASSWORD,DBNAME);

    // Check connection
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
	$encrypted_password = hash('ripemd160', $password);
    // Attempt insert query execution
    $sql = "INSERT INTO `user`(`username`, `password`) VALUES ('".$username."','".$encrypted_password."')";

    if($mysqli->query($sql) === true){
        echo "Records inserted successfully.";
    } else{
        echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
    }

    // Close connection
    $mysqli->close();
}

function userLogin($username,$password)
{
    $mysqli = new mysqli(SERVER,USERNAME,PASSWORD,DBNAME);

    // Check connection
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }
	$encrypted_password = hash('ripemd160', $password);
    // Attempt insert query execution
    $sql = "SELECT COUNT(*) AS sample FROM `user` WHERE username = '".$username."' AND password = '".$encrypted_password."' ";

    $result = $mysqli->query($sql);
    $row = mysqli_fetch_assoc($result);


    // Close connection
    $mysqli->close();

    return $row['sample'];
}



 ?>
