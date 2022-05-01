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

  $id = $_GET['id'];
  if(!$id){
    return header("Location: admin.php");
  }

  // for select options
  $query = "SELECT `City_Name` FROM `Cities`";
  $data = mysqli_query($dbc, $query);
  $array=[];
  while ($row = mysqli_fetch_array($data)) {
    $array[] = $row['City_Name'];
  }

  // for data of event to be edited
  $sql1 = "SELECT * FROM events WHERE Sr_No=$id";
  $result1 = mysqli_query($dbc, $sql1);
  if($result1){
    $row = mysqli_fetch_assoc($result1);
    $sr_no = $row['Sr_No'];
    $event_name = $row['Event_Name'];
    $event_image = "D:\xampp\htdocs\WPL-Pro\uploads" . $row['Event_Image'];
    $start_date = $row['Start_Date'];
    $start_time = $row['Start_Time'];
    $end_date = $row['End_Date'];
    $end_time = $row['End_Time'];
    $city = $row['City'];
    $address = $row['Address'];
    $tickets = $row['Tickets'];
    $description = $row['Description'];
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin: Event Edit</title>
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

    <!--External CSS-->
    <link rel="stylesheet" href="styles/styles.css" />
    <link rel="stylesheet" href="styles/admin-form-styles.css" />
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
      <form method="post" action="update-event.php" enctype="multipart/form-data">
        <div>
          <label for="event-name">Event Name:</label>
          <input type="text" name="event-name" autocomplete="off" value="<?php echo $event_name; ?>" required/>
        </div>
        <div>
          <label for="event-image">Add Display Image:</label>
          <input type="file" name="event-image" id="image" required/>
        </div>
        <div>
          <div class="date-time">
          <div>
              <label for="event-start-date">Start Date:</label>
              <input type="date" name="event-start-date" value="<?php echo $start_date; ?>" required/>
              <label for="event-start-time">Start Time:</label>
              <input type="time" name="event-start-time" value="<?php echo $start_time; ?>" required/>
            </div>
            <div>
              <label for="event-end-date">End Date:</label>
              <input type="date" name="event-end-date" value="<?php echo $end_date; ?>" required/>
              <label for="event-end-time">End Time:</label>
              <input type="time" name="event-end-time" value="<?php echo $end_time; ?>" required/>
            </div>
          </div>
        </div>
        <div>
          <label for="event-city">City: </label>
          <select name="event-city" required>
            <?php foreach ($array as $arr) { ?>
              <option value="<?php print($arr);?>"><?php print($arr); ?></option>
            <?php } ?>
          </select>
          <!-- <select id="">
            <option selected>Choose your city</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Delhi">Delhi</option>
            <option value="Jaipur">Jaipur</option>
          </select> -->
          </div>
        <div>
          <label for="event-address">Address:</label>
          <input type="text" name="event-address" value="<?php echo $address; ?>" required/>
        </div>
        <div>
          <label for="event-tickets">Total Tickets:</label>
          <input type="number" name="event-tickets" value="<?php echo $tickets; ?>">
        </div>
        <div class="event-description">
          <label for="event-description">Description</label>
          <textarea
            name="event-description"
            id=""
            cols="30"
            rows="4"
            placeholder="Enter your event description..." 
            required
          ><?php echo $description; ?></textarea>
        </div>
        <div>
          <?php
            $_SESSION['sr_no'] = $sr_no;
          ?>
          <input type="submit" id="insert" name="submit" value="Edit!">
        </div>
      </form>
    </section>
  </body>
</html>
