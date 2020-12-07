<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>CARE Ops</title>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <link rel="stylesheet" href="css/home.css">

</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.html">
      <img src="images/logo.png" class="logo-img">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="contactus.html">Contact US</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Donate
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="donation-forms/goods.html">Goods</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="donation-forms/cash.html">Cash</a>
          </div>
        </li>
      </ul>
      <div>
        <form class="form-inline" action="functions/login.php" method="post">
          <div class="form-group mx-sm-3 mb-2">
            <span>Welcome<?php if (!empty($_GET["admin"])){echo " ".$_GET["admin"];}
                               else {echo "";} ?>!</span>
          </div>
          <button type="submit" class="btn btn-success mb-2">Register a new admin</button>
        </form>
      </div>
    </div>
  </nav>

  <div class="container-home-body">
    <div class="container table_con mt-3">
      <form class="form-inline">
        <button type="submit" name="donation_type" class="btn btn-secondary mb-3 mr-3" value="goods">In Good</button>
        <button type="submit" name="donation_type" class="btn btn-success mb-3" value="cash">In Cash</button>
      </form>



      <form class="form-inline" action="#" method="post">
        <div class="form-group mb-2">
          <label for="staticEmail2" class="sr-only">Email</label>
          <input type="text" class="form-control" id="staticEmail2" placeholder="Name" name="name">
        </div>
        <div class="form-group mx-sm-3 mb-2">
          <label for="inputPassword2" class="sr-only">Password</label>
          <input type="date" class="form-control" id="inputPassword2" placeholder="Date" name="date">
        </div>
        <button type="submit" name="donation_type" class="btn btn-secondary mb-2" value="<?php echo $_GET['donation_type']; ?>">Search</button>
      </form>
      <div class="container-table">

        <?php

            $donation_type = $name = $date = "";

            $donation_type = $_GET["donation_type"];

            if ($_SERVER['REQUEST_METHOD']=='POST'){

              $name = $_POST["name"];
              $date = $_POST["date"];



            }

            $server = "localhost";
            $user = "root";
            $pass = "Aeron0005";
            $dbname = "relief_db";
            $conn=mysqli_connect($server,$user,$pass,$dbname);

            if ($conn){

              if ($donation_type=="goods"){

                if (empty($name) && empty($date)){

                  $sql = "SELECT name, contact_number, address, list, sent_datetime FROM goods ORDER BY id DESC";

                }

                else if (empty($date)){

                  $date = strtotime($date);

                  $date = date('Y-m-d', $date);

                  $sql = "SELECT name, contact_number, address, list, sent_datetime FROM goods WHERE name LIKE '%".$name."%' ORDER BY id DESC";
                }

                else if (empty($name)){

                  $sql = "SELECT name, contact_number, address, list, sent_datetime FROM goods WHERE CAST(sent_datetime AS DATE) = '".$date."' ORDER BY id DESC";
                }

                else{
                  $sql = "SELECT name, contact_number, address, list, sent_datetime FROM goods WHERE name LIKE '%".$name."%' AND CAST(sent_datetime AS DATE) = '".$date."' ORDER BY id DESC";
                }

              $result = mysqli_query($conn, $sql);

              echo "
                <table class='table'>
                  <thead>
                    <tr>
                      <th scope='col'>Name</th>
                      <th scope='col'>Contact</th>
                      <th scope='col'>Address</th>
                      <th scope='col'>List</th>
                      <th scope='col'>Date</th>
                    </tr>
                  </thead>
                  <tbody>";

                while ($row = mysqli_fetch_array($result)){

                    echo  "<tr>
                            <th scope='row'>".$row[0]."</th>
                              <td>".$row[1]."</td>
                              <td>".$row[2]."</td>
                              <td>".$row[3]."</td>
                              <td>".$row[4]."</td>
                            </tr>";
                          }

            echo "</tbody>
                  </table>";
          }

          else if ($donation_type=="cash"){

            if (empty($name) && empty($date)){

              $sql = "SELECT name, contact_number, address, sent_datetime FROM cash ORDER BY id DESC";
            }

            else if (empty($date)){

              $date = strtotime($date);

              $date = date('Y-m-d', $date);

              $sql = "SELECT name, contact_number, address, sent_datetime FROM cash WHERE name= '".$name."' ORDER BY id DESC";
            }

            else if (empty($name)){

              $sql = "SELECT name, contact_number, address, sent_datetime FROM cash WHERE CAST(sent_datetime AS DATE) = '".$date."' ORDER BY id DESC";
            }

            else {
              $sql = "SELECT name, contact_number, address, sent_datetime FROM cash WHERE name= '".$name."' AND CAST(sent_datetime AS DATE) = '".$date."' ORDER BY id DESC";
            }

          $result = mysqli_query($conn, $sql);

          echo "
            <table class='table'>
              <thead>
                <tr>
                  <th scope='col'>Name</th>
                  <th scope='col'>Contact</th>
                  <th scope='col'>Address</th>
                  <th scope='col'>Date</th>
                </tr>
              </thead>
              <tbody>";

            while ($row = mysqli_fetch_array($result)){

                echo  "<tr>
                        <th scope='row'>".$row[0]."</th>
                          <td>".$row[1]."</td>
                          <td>".$row[2]."</td>
                          <td>".$row[3]."</td>
                        </tr>";
                      }

        echo "</tbody>
              </table>";
      }
        }

         ?>
      </div>
    </div>
  </div>

  <div class="container-fluid footer bg-dark">
    <p>Copyright © Calamity Application for Relief and Evacuation Operations 2020. All Rights Reserved.</p>
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>
