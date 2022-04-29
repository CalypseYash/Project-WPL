<?php
    session_start();

    $err = '';

    // if request method is post
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        require_once "config.php";

        $tickets_requested = $_POST['tickets-requested'];
        $tickets_left = $_SESSION['tickets-left'];
        unset($_SESSION['tickets-left']);
        $email = $_SESSION['email'];
        $id = $_SESSION['event-id'];
        unset($_SESSION['event-id']);
    
        if ($tickets_requested > $tickets_left) {
            $err = "Please enter tickets less than " . $tickets_left;
        } 
        else {
            $set_tickets = $tickets_left - $tickets_requested;
            $sql = "INSERT INTO `sold_tickets` (`User_Email`, `Event_Number`, `Tickets_Booked`) VALUES (?, ?, ?);";
            // $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            if ($stmt)
            {
                mysqli_stmt_bind_param($stmt, "sii", $param_email, $param_event_number, $param_tickets_booked);

                // Set these parameters
                $param_email = $email;
                $param_event_number = $id;
                $param_tickets_booked = $tickets_requested;

                // Try to execute the query
                if (mysqli_stmt_execute($stmt))
                {
                    $que = "UPDATE `events` SET `Tickets`='$set_tickets' WHERE `Sr_No`='$id'";
                    $res = mysqli_query($conn, $que);
                    if ($res) {
                        header("location: my_profile.php");
                    }
                }
                else{
                    echo "Something went wrong... cannot redirect!";
                }
            }
            mysqli_stmt_close($stmt);
        }
        if(!empty($err)) {
            // echo '<div class="alert alert-danger alert-dismissible" role="alert">'
            //       . $err .
            //       '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            echo $err;
        }
    }
?>