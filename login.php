<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['email']))
{
    header("location: index.php");
    exit;
}
require_once "config.php";

$email = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if(empty($_POST['email']) || empty($_POST['password']))
    {
        $err = "Please enter username + password";
    }
    else{
        $email = $_POST['email'];
        $password = $_POST['password'];
    }


    if(empty($err))
    {
        $sql = "SELECT `SrNo`, `User_Email`, `User_Password`, `User_Type` FROM `users` WHERE `User_Email` = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_email);
        $param_email = $email;
        
        
        // Try to execute this statement
        if(mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1)
            {
                mysqli_stmt_bind_result($stmt, $SrNo, $email, $hashed_password, $user_type);
                if(mysqli_stmt_fetch($stmt))
                {
                    if(password_verify($password, $hashed_password) || $password == $hashed_password)
                    {
                        // this means the password is corrct. Allow user to login
                        session_start();
                        $_SESSION["email"] = $email;
                        $_SESSION["SrNo"] = $SrNo;
                        $_SESSION["user_type"] = $user_type;
                        $_SESSION["loggedin"] = true;

                        if ($_SESSION["user_type"] == "admin") {
                            //Redirect user to admin page
                            header("location: admin.php");
                        }
                        else {
                            //Redirect user to home page
                            header("location: index.php");
                        }
                    }
                }

            }

        }
    }    
}
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

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Asap&family=Pacifico&display=swap" rel="stylesheet">
    
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
                <a href="index.php" class="navbar-brand">mint</a>

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
                                <li><a href="signup.php" class="dropdown-item">Sign-Up</a></li>
                                <li><a href="" class="dropdown-item disabled">Log-In</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a href="" class="dropdown-item disabled">My Profile</a></li>
                                <li><a href="" class="dropdown-item disabled">Sign-Out</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </section>
    
    <!-- form -->
    <section id="login">

        <form name="login-form" action="" method="post">
            <div class="card">
                <div class="card-header">
                    <h3>Log In</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="email" class="form-label">Email: </label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">Password: </label>
                        <input type="password" class="form-control" name="password">
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

    <?php
    //     if (isset($_POST['submit'])) {
    //         $server = "localhost";
    //         $username = "root";
    //         $password = "";
    //         $dbname = "event_ticket_booking_website_db";

    //         $con = mysqli_connect($server, $username, $password, $dbname);

    //         if (!$con) {
    //             die("connection to database failed as " . mysqli_connect_error());
    //         }

    //         $email = $_POST['email'];
    //         $password = $_POST['password'];

    //         // storing the query in a variable
    //         $sql = "SELECT * FROM `users` WHERE `User_Email` = '$email' and `User_Password` = '$password'";

    //         // executing the query and storing the result in a variable
    //         $result = $con->query($sql);

    //         // if the result has more than 0 rows, it means that user exists
    //         if ($result->num_rows > 0) {
    //             // TODO make a session and cookie to keep user logged in

    //             // ! for now, displaying the row as output
    //             while ($row = $result->fetch_assoc()) {
    //                 echo "Sr No: " . $row["SrNo"] . "<br>Date Of Creation: " . $row["Date_Of_Creation"] . "<br>Name: " . $row["User_Name"] . "<br>Email: " . $row["User_Email"] . "<br>Phone: " . $row["User_Phone"] . "<br>Password: " . $row["User_Password"] . "<br>City: " . $row["User_City_Preference"];
    //             }
    //         } else {
    //             echo "No such user exists";
    //         }

    //         $con->close();
    //     }
    ?>

</body>
</html>