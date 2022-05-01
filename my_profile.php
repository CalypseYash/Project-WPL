<?php
  session_start();

  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: login.php");
    exit;
  }

  require_once "config.php";

  $email = $_SESSION['email'];

  $query = "SELECT * FROM `users` WHERE `User_Email` = '$email'";
  $data = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
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

    <!--Bootstrap JQuery-->
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

    <!--CSS-->
    <link rel="stylesheet" href="styles/styles.css" />
    <link rel="stylesheet" href="styles/profile-page-style.css" />
  </head>

  <body>
    <!-- header -->
    <section id="navigation">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2 p-1">
        <div class="container-fluid">
          <a href="index" class="navbar-brand">mint</a>

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

    <!-- displaying basic account information -->
    <section id="user-details-section">
      <h2>User Details</h2>
      <?php while ($row = mysqli_fetch_array($data)) {
      ?>

      <table>
        <tr>
          <td><p>Name:</p></td>
          <td><p class="user-details-values"><?php print($row['User_Name']); ?></p></td>
        </tr>
        <tr>
          <td><p>E-mail:</p></td>
          <td><p class="user-details-values"><?php print($row['User_Email']); ?></p></td>
        </tr>
        <tr>
          <td><p>Phone Number:</p></td>
          <td><p class="user-details-values"><?php print($row['User_Phone']); ?></p></td>
        </tr>
      </table>
      <?php
      }
      ?>
    </section>

    <!-- booked tickets history -->
    <section id="booked-tickets-section">
      <h2>Booked Tickets</h2>
      <?php
        $query1 = "SELECT Event_Number FROM sold_tickets WHERE User_Email='$email'";
        $data1 = mysqli_query($conn, $query1);
        
        while ($row1 = mysqli_fetch_array($data1)) {
          $arr1 = $row1['Event_Number'];
          $query2 = "SELECT * FROM `events` WHERE `Sr_No`='$arr1'";
          $data2 = mysqli_query($conn, $query2);
          
          while ($row2 = mysqli_fetch_array($data2)) {
            ?>
            <div class="card event-card">
              <div class="row g-0">
                <div class="col-md-4 image-container">
                  <img src="<?php print($row2['Event_Image']); ?>" class="img-fluid rounded-start event-image" alt="Event Image" />
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title"><?php print($row2['Event_Name']); ?></h5>
                    <p class="event-timing card-text">
                      <small class="text-muted">Start: <?php print($row2['Start_Date'] . " "); print($row2['Start_Time']); ?></small>
                    </p>
                    <p class="event-timing card-text">
                      <small class="text-muted">End: <?php print($row2['End_Date'] . " "); print($row2['End_Time']); ?></small>
                    </p>
                    <p class="card-text">
                      <?php
                        print($row2['Tickets']);
                      ?>
                    </p>
                    <p class="card-text">
                      <?php
                        print($row2['Description']);
                      ?>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          <?php
          }
        ?>
        <?php    
        }
      ?>
    </section>
  </body>
</html>
