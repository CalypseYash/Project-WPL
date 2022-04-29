<?php

session_start();

// check if the user is already logged in
if(!isset($_SESSION['email']))
{
    header("location: login.php");
    exit;
}

require_once "config.php";

$id = $_GET['id'];

// get remaining tickets for the event
$q = "SELECT Tickets FROM events WHERE Sr_No='$id'";
$result = mysqli_query($conn, $q);
if($result) {
    $row = mysqli_fetch_assoc($result);
    $tickets_left = $row['Tickets'];
} else {
    die("No such event exists for $id");
}

// set email value
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <!--Bootstrap stylesheet-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--Bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    
    <!--Bootstrap JQuery-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!--CSS-->
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="styles/form-style.css">
</head>

<body>
    <!-- header -->
    <section id="navigation">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2 p-1">
            
            <div class="container-fluid">
                <a href="#" class="navbar-brand">Site-Name</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto navigation">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle profile-icon"></i>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a href="signup.php" class="dropdown-item disabled">Sign-Up</a></li>
                                <li><a href="" class="dropdown-item disabled">Log-In</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a href="my_profile.php" class="dropdown-item">My Profile</a></li>
                                <li><a href="logout.php" class="dropdown-item">Sign-Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </section>
    
    <!-- form -->
    <section id="login">

        <form name="ticket-booking-form" action="confirm-booking.php" method="post" onsubmit="return sessionCreate()">
            <div class="card">
                <div class="card-header">
                    <h3>Book Tickets</h3>
                </div>
                <div class="card-body">
                    <p class="card-text">Enter the number of Tickets you want to book.</p>
                    <p.card-subtitle mb-2 text-muted>Tickets Remaining: <?php print($tickets_left); ?></p>
                    <div class="form-group">
                        <label for="tickets" class="form-label">Tickets Needed: </label>
                        <input type="number" class="form-control" name="tickets-requested" required>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" name="submit">
                </div>
            </div>
        </form>
    </section>

    <!-- footer -->
    <section></section>

    <script>
        function sessionCreate() {
            <?php
                $_SESSION['event-id'] = $id;
                $_SESSION['tickets-left'] = $tickets_left;
            ?>
            return true;
        }
    </script>
</body>
</html>