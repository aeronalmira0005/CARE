<?php

$username = $password = " ";

if ($_SERVER['REQUEST_METHOD']=='POST'){

  $username = $_POST["username"];

  $password = $_POST["password"];

  $server = "localhost";
  $user = "root";
  $pass = "Aeron0005";
  $dbname = "relief_db";
  $conn=mysqli_connect($server,$user,$pass,$dbname);

  if ($conn){

      $sql = "SELECT username, password FROM admins WHERE username ='".$username."' AND password = '".$password."'";

      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);

      if(empty($row[0]) || empty($row[1])){

        header("location: ../index.html");

      }

      else if($username == $row[0] && $password == $row[1]){

        header("location: ../home.php?admin=".$row[0]."&donation_type=goods");

      }

      else {

        header("location: ../index.html");

      }

    }

    mysqli_close($conn);

}
?>
