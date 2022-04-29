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

  $dbc = mysqli_connect($server,$username,$password,$dbname);
  $query = "SELECT `City_Name` FROM `cities`";
  $data = mysqli_query($dbc, $query);
  $array=[];
  while ($row = mysqli_fetch_array($data)) {
    $array[] = $row['City_Name'];
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin: Create Event</title>
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

    <!--External CSS-->
    <link rel="stylesheet" href="styles/styles.css" />
    <link rel="stylesheet" href="styles/admin-form-styles.css" />
  </head>
  <body>
    <!-- header -->
    <section id="navigation">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2 p-1">
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

    <!--Event data form-->
    <section id="event-form">
      <form
        method="POST"
        action="event-create.php"
        enctype="multipart/form-data"
      >
        <div>
          <label for="event-name">Event Name:</label>
          <input type="text" name="event-name" autocomplete="off" required/>
        </div>
        <div>
          <label for="event-image">Add Display Image:</label>
          <input type="file" name="event-image" id="image" required/>
        </div>
        <div>
          <div class="date-time">
            <div>
              <label for="event-start-date">Start Date:</label>
              <input type="date" name="event-start-date" required/>
              <label for="event-start-time">Start Time:</label>
              <input type="time" name="event-start-time" required/>
            </div>
            <div>
              <label for="event-end-date">End Date:</label>
              <input type="date" name="event-end-date" required/>
              <label for="event-end-time">End Time:</label>
              <input type="time" name="event-end-time" required/>
            </div>
          </div>
        </div>
        <div>
          <label for="event-city">City:</label>
          <select name="event-city" required>
            <?php foreach ($array as $arr) { ?>
              <option value="<?php print($arr);?>"><?php print($arr); ?></option>
            <?php } ?>
          </select>
          <!-- <select id="" name="event-city">
            <option selected>Choose your city</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Delhi">Delhi</option>
            <option value="Jaipur">Jaipur</option>
          </select> -->
        </div>
        <div>
          <label for="event-address">Address:</label>
          <input type="text" name="event-address" required/>
        </div>
        <div>
          <label for="event-tickets">Total Tickets:</label>
          <input type="number" name="event-tickets" required/>
        </div>
        <div class="event-description">
          <label for="event-description">Description:</label>
          <textarea
            name="event-description"
            id=""
            cols="30"
            rows="4"
            placeholder="Enter your event description..."
            required
          ></textarea>
        </div>
        <div>
          <input type="submit" id="insert" name="submit" value="Create!">
        </div>
      </form>
    </section>
  </body>

  <script>
    // validation of file type
    $(document).ready(function () {
      $("#insert").click(function () {
        var image_name = $("#image").val();
        if (image_name == "") {
          alert("Please select image");
          return false;
        } else {
          // getting extension of uploaded file
          var extension = $("#image").val().split(".").pop().toLowerCase();
          if (JQuery.inArray(extension, ["jpg", "jpeg", "png", "gif"]) == -1) {
            alert("Invalid image file");
            $("#image").val("");
            return false;
          }
        }
      });
    });
  </script>
</html>
