<?php
  $server = "localhost";
  $username = "root";
  $password = "";
  $dbname = "event_ticket_booking_website_db";

  $con = mysqli_connect($server, $username, $password, $dbname);

  if (!$con) {
    die("connection to database failed as " . mysqli_connect_error());
  }

  $selected_city = $_POST['selected-city'];

  if ($selected_city == "") {
    header("Location: index.php");
  }

  $query = "SELECT * FROM `events` WHERE `City` = '$selected_city'";
  $data = mysqli_query($con, $query);
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
    <link rel="stylesheet" href="styles/events-page-styles.css" />
  </head>
  <body>
    <!-- header -->
    <section id="navigation">
      <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2 p-1">
        <div class="container-fluid">
          <a href="#" class="navbar-brand">Site-Name</a>

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
                <?php
                  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
                      ?>
                      <li><a href="signup.php" class="dropdown-item">Sign-Up</a></li>
                      <li><a href="login.php" class="dropdown-item">Log-In</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a href="" class="dropdown-item disabled">My Profile</a></li>
                      <li><a href="" class="dropdown-item disabled">Sign-Out</a></li>                
                      <?php
                  }
                  else {
                      ?>
                      <li><a href="" class="dropdown-item disabled">Sign-Up</a></li>
                      <li><a href="" class="dropdown-item disabled">Log-In</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a href="my-profile.php" class="dropdown-item">My Profile</a></li>
                      <li><a href="logout.php" class="dropdown-item">Sign-Out</a></li>
                      <?php
                  }
                ?> 
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav> -->

      <?php include 'header.php'; ?> 
    </section>

    <!--Event List-->
    <section id="event-list-section">
      <h2>Whats Happening in <?php print($selected_city);?>...</h2>
      <div class="event-list">

        <?php
          while ($row = mysqli_fetch_array($data)) {
        ?>
          <div class="card event-card">
            <div class="row g-0">
              <div class="col-md-4 image-container">
                <img src="<?php print($row['Event_Image']); ?>" class="img-fluid rounded-start event-image" alt="Event Image" />
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title"><?php print($row['Event_Name']); ?></h5>
                  <p class="event-timing card-text">
                    <small class="text-muted">Start: <?php print($row['Start_Date'] . " "); print($row['Start_Time']); ?></small>
                  </p>
                  <p class="event-timing card-text">
                    <small class="text-muted">End: <?php print($row['End_Date'] . " "); print($row['End_Time']); ?></small>
                  </p>
                  <p class="card-text">
                    <?php
                      print($row['Tickets']);
                    ?>
                  </p>
                  <p class="card-text">
                    <?php
                      print($row['Description']);
                    ?>
                  </p>
                  <?php
                  echo '<a class="btn btn-outline-dark book-button" href="book-event.php?id=' . $row['Sr_No'] . '">Book!</a>';
                  ?>
                </div>
              </div>
            </div>
          </div>
          <?php
          }
        ?>
        

        

        <!-- <div class="card mb-3" style="max-width: 540px">
          <div class="row g-0">
            <div class="col-md-4">
              <img src="..." class="img-fluid rounded-start" alt="..." />
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">
                  This is a wider card with supporting text below as a natural
                  lead-in to additional content. This content is a little bit
                  longer.
                </p>
                <p class="card-text">
                  <small class="text-muted">Last updated 3 mins ago</small>
                </p>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </section>
  </body>
</html>
