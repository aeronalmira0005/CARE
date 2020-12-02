<?php

$name = $contact = $address = $reliefs = $is_pickup = " ";

if ($_SERVER['REQUEST_METHOD']=='POST'){

  $name = $_POST["name"];

  $contact = $_POST["contact-number"];

  $address = $_POST["address"];

  $reliefs = $_POST["list"];

  $is_pickup = $_POST["is_pickup"];

  date_default_timezone_set('Asia/Manila');
  $today = date("y-m-d h:i:sa");



  $server = "localhost";
  $user = "root";
  $pass = "Aeron0005";
  $dbname = "relief_db";
  $conn=mysqli_connect($server,$user,$pass,$dbname);

  if ($conn){

    if ($is_pickup == 1){

      $is_shipping = 0;

      $insert = "INSERT INTO goods (name, contact_number, address, list, is_pickup, is_shipping)
      VALUES('".$name."','".$contact."','".$address."','".$reliefs."','".$is_pickup."','".$is_shipping."')";

      $test = mysqli_query($conn,$insert);

      }


      else {

        $is_shipping = 1;

        $insert = "INSERT INTO goods (name, contact_number, address, list, is_pickup, is_shipping)
        VALUES('".$name."','".$contact."','".$address."','".$reliefs."','".$is_pickup."','".$is_shipping."')";

        $test = mysqli_query($conn,$insert);

        }

    }

    mysqli_close($conn);


    header("location: ../../index.html");
}
?>
