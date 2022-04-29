<html>
<head>
<link rel="stylesheet" href="styling.css">
</head>
<body>
<?php
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

// Check if file already exists
if (file_exists($target_file)) {
    die( "<center>Sorry, file already exists.</center>");
    $uploadOk = 0;
}

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

// * adding to database
if(isset($_POST['submit'])) {
    $server = "localhost";

    $username = "root";

    $password = "";

    $con = mysqli_connect($server, $username, $password);
    //echo $con;


    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    echo "Success connecting to the db";
    
    $event_name = $_POST['event-name'];
    $event_image = $target_dir . basename( $_FILES["event-image"]["name"]);
    // if( isset($_POST['event-image'])){
        
    //     $file_name = $_FILES['event-image']['name'];
    //     $file_tem = $_FILES['event-image']['tmp_name'];
    //     $file_store = "uploads/" . $file_name;
    
    //     // if(move_uploaded_file($file_tem, $file_store)){
    //     //     echo("Files are Uploaded");
    //     // }   
    //     $event_image = $file_store;
    // };
    $start_date = $_POST['event-start-date'];
    $start_time = $_POST['event-start-time'];
    $end_date = $_POST['event-end-date'];
    $end_time = $_POST['event-end-time'];
    $event_city = $_POST['event-city'];
    $event_address = $_POST['event-address'];
    $event_tickets = $_POST['event-tickets'];
    $event_desc = $_POST['event-description'];

    $sql = "INSERT INTO `event_ticket_booking_website_db`.`events` (`Event_Name`, `Event_Image`, `Start_Date`, `Start_Time`, `End_Date`, `End_Time`, `City`, `Address`, `Tickets`, `Description`) VALUES ('$event_name', '$event_image', '$start_date', '$start_time', '$end_date', '$end_time', '$event_city', '$event_address', '$event_tickets', '$event_desc');";
    // echo $sql;
    //INSERT INTO `newform` (`Sno`, `name`, `age`, `gender`, `email`, `phone`, `info`, `date`) VALUES ('1', 'umang', '22', 'male', 'nmhiji@gh.com', '68789379348', 'hidh', '2022-03-22'); 
    if($con->query($sql) == true) {
        $insert = true;
    }
    $con->close();
    // echo "<center><h3>City Added Successfully</h3></center>";

    // sleep(5);

    header("Location: admin.php");
}

?>

</body>
</html>
