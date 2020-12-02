<?php

$name = $contact = $address = $donationMethod = " ";

if ($_SERVER['REQUEST_METHOD']=='POST'){

  $name = $_POST["name"];

  $contact = $_POST["contact-number"];

  $address = $_POST["address"];

  $donationMethod = $_POST["donation-method"];

  echo $name."\n".$contact."\n".$address."\n".$donationMethod;

  $server = "localhost";
  $user = "root";
  $pass = "Aeron0005";
  $dbname = "relief_db";
  $conn=mysqli_connect($server,$user,$pass,$dbname);

  if ($conn){

    if ($donationMethod == 0){

      $is_gcash = 1;
      $is_bdo = 0;
      $is_paypal = 0;

      $insert = "INSERT INTO cash (name, contact_number, address, is_gcash, is_bdo, is_paypal)
      VALUES('".$name."','".$contact."','".$address."','".$is_gcash."','".$is_bdo."','".$is_paypal."')";

      }


      else if ($donationMethod == 1){

        $is_gcash = 0;
        $is_bdo = 1;
        $is_paypal = 0;

        $insert = "INSERT INTO cash (name, contact_number, address, is_gcash, is_bdo, is_paypal)
        VALUES('".$name."','".$contact."','".$address."','".$is_gcash."','".$is_bdo."','".$is_paypal."')";

        }

        else {

          $is_gcash = 0;
          $is_bdo = 0;
          $is_paypal = 1;

          $insert = "INSERT INTO cash (name, contact_number, address, is_gcash, is_bdo, is_paypal)
          VALUES('".$name."','".$contact."','".$address."','".$is_gcash."','".$is_bdo."','".$is_paypal."')";

          }

          $test = mysqli_query($conn,$insert);

    }

    mysqli_close($conn);


    header("location: ../../index.html");
}
?>
