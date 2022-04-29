<?php
    $insert = false;
    if(isset($_POST['city-name'])) {
        $server = "localhost";
    
        $username = "root";
    
        $password = "";
    
        $con = mysqli_connect($server, $username, $password);
        //echo $con;


        if(!$con){
            die("connection to this database failed due to" . mysqli_connect_error());
        }
        echo "Success connecting to the db";
    
        $city_name = $_POST['city-name'];
        $sql = "INSERT INTO `event_ticket_booking_website_db`.`cities` (`City_Name`) VALUES ('$city_name');";
        // echo $sql;
        //INSERT INTO `newform` (`Sno`, `name`, `age`, `gender`, `email`, `phone`, `info`, `date`) VALUES ('1', 'umang', '22', 'male', 'nmhiji@gh.com', '68789379348', 'hidh', '2022-03-22'); 
        if($con->query($sql) == true) {
            $insert = true;
        }
        $con->close();
        // echo "<center><h3>City Added Successfully</h3></center>";

        header("Location: admin.php");
    }
?> 
