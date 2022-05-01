<?php
  session_start();

  if ($_SESSION["user_type"] != "admin") {
    header("location: login.php");
    exit;
  }


  $server = "localhost";
  $username = "root";
  $password = "";
  $dbname = "event_ticket_booking_website_db";

  $con = mysqli_connect($server, $username, $password, $dbname);

  if (!$con) {
    die("connection to database failed as " . mysqli_connect_error());
  }


  // $array=[];
  // while ($row = mysqli_fetch_array($data)) {
  //   $array[] = $row[];
  // }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!--Bootstrap stylesheet-->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />

    <!--Bootstrap icons-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"
    />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Asap&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Bootstrap JQuery-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
      integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
      integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
      crossorigin="anonymous"
    ></script>

    <!--External CSS-->
    <link rel="stylesheet" href="styles/styles.css" />
    <link rel="stylesheet" href="styles/admin-page.css" />
  </head>
  <body>
    <!-- header -->
    <section id="navigation">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2 p-1">
        <div class="container-fluid">
          <a href="index.php" class="navbar-brand">mint</a>

          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto navigation">
              <li class="nav-item mt-1 me-1">
                <a class="nav-link" href="admin-event-info-form.php"
                  >Add Event</a
                >
              </li>
              <li class="nav-item mt-1 me-2">
                <a
                  class="nav-link"
                  href="#"
                  data-bs-toggle="modal"
                  data-bs-target="#staticBackdrop"
                >
                  Add City
                </a>
              </li>
              <li class="nav-item dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  <i class="bi bi-person-circle profile-icon"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a href="" class="dropdown-item disabled">Sign-Up</a></li>
                  <li><a href="" class="dropdown-item disabled">Log-In</a></li>
                  <li><hr class="dropdown-divider" /></li>
                  <li>
                    <a href="" class="dropdown-item disabled">My Profile</a>
                  </li>
                  <li>
                    <a href="logout.php" class="dropdown-item">Sign-Out</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </section>

    <?php

    if(isset($_GET['success']) && $_GET['success']==true && isset($_GET['message'])){
      echo '<div class="alert alert-success alert-dismissible" role="alert">'
            . $_GET['message'] .
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

    }

    ?>

    <!--Table-->
    <section id="admin-table">
      <?php
        $query = "SELECT `City_Name` FROM `cities`";
        $data = mysqli_query($con, $query);
        $array=[];
        while ($row = mysqli_fetch_array($data)) {
          $array[] = $row['City_Name'];
        }

        foreach ($array as $arr) {
          echo "<h4>". $arr . "</h4>";
      ?>
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Event Title</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col">Tickets Remaining</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query2 = "SELECT * FROM `events` WHERE `City` = '$arr'";
                $data2 = mysqli_query($con, $query2);
                while ( $row = mysqli_fetch_array($data2)) {
                  echo '<tr>';
                    echo '<th scope="row">' . $row['Sr_No'] . "</th>";
                    echo "<td>" . $row['Event_Name'] . "</td>";
                    echo "<td>" . $row['Start_Date'] . "</td>";
                    echo "<td>" . $row['End_Date'] . "</td>";
                    echo "<td>" . $row['Tickets'] . "</td>";
                    echo '<td>
                      <a class="btn btn-warning btn-sm" href="admin-event-edit-form.php?id='. $row['Sr_No']. '" style="color:#fff;">Edit</a>
                      <a class="btn btn-danger btn-sm" href="delete-event.php?id='. $row['Sr_No']. '" style="color:#fff;">Delete</a>
                    </td>';
                  echo "</tr>";
                }
              ?>
            </tbody>
          </table>
      <?php
        }
      ?>
    </section>

    <!-- Modal -->
    <form method="post" action="city-add.php" enctype="multipart/form-data">
      <div
        class="modal fade"
        id="staticBackdrop"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Add City</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <p>Enter the name of the city you want to host events in.</p>
              <input
                type="text"
                class="form-control"
                id="city-name"
                name="city-name"
              />
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>
              <button type="submit" class="btn btn-success" type="submit">
                Add
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"

        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">

    </script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"

        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">

    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"

        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">

    </script>
  </body>
</html>
