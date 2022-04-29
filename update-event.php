<?php
    session_start();

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["event-image"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["event-image"]["tmp_name"]);
        if($check !== false) {
            echo "";
            $uploadOk = 1;
        } else {
            die( "<center>File is not an image.</center>");
            $uploadOk = 0;
        }
    }

    // // Check if file already exists
    // if (file_exists($target_file)) {
    //     die( "<center>Sorry, file already exists.</center>");
    //     $uploadOk = 0;
    // }

    // Check file size
    // if ($_FILES["event-image"]["size"] > 500000) {
    //     die ("<center>Sorry, your file is too large.</center>");
    //     $uploadOk = 0;
    // }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        die ("<center>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</center>");
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        die ("<center>Sorry, your file was not uploaded.</center>");

        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["event-image"]["tmp_name"], $target_file)) {
            echo "<center><i><h4>The file ". basename( $_FILES["event-image"]["name"]). " has been uploaded.</h4></i></center>";
        } else {
            die ("<center>Sorry, there was an error uploading your file.</font></center>");
        }
    }

    $showError = "false";

    // Script to connect to the database
    require_once "config.php"; 

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $sr_no = $_SESSION['sr_no'];
        $event_name = $_POST['event-name'];
        $event_image = $target_dir . basename( $_FILES["event-image"]["name"]);
        $start_date = $_POST['event-start-date'];
        $start_time = $_POST['event-start-time'];
        $end_date = $_POST['event-end-date'];
        $end_time = $_POST['event-end-time'];
        $city = $_POST['event-city'];
        $address = $_POST['event-address'];
        $tickets = $_POST['event-tickets'];
        $description = $_POST['event-tickets'];

        echo $id;

        $existSql = "UPDATE `events` SET `Event_Name`='$event_name', `Event_Image`='$event_image', `Start_Date`='$start_date', `Start_Time`='$start_time', `End_Date`='$end_date', `End_Time`='$end_time', `City`='$city', `Address`='$address', `Tickets`='$tickets', `Description`='$description' WHERE `Sr_No`='$sr_no'";
        $result = mysqli_query($conn, $existSql);

        if($result) {
            $showAlert = true;
            $message = 'Category Updated Successfully';
            header("Location: admin.php?success=true&message= $message");
            unset($_SESSION['sr_no']);
            exit();
        }
        else {
            die("Something went wrong!");
        }
    }
?>