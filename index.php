<?php
session_start();

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
    <meta charset="UTF-8">
    <title>Event-Website-Name</title>
    <!--Bootstrap stylesheet-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--Bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    
    <!--Bootstrap JQuery-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!--CSS-->
    <link rel="stylesheet" href="styles/styles.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Asap&family=Pacifico&display=swap" rel="stylesheet"> 

    <!--fontawesome-->
    <script src="https://kit.fontawesome.com/1c9ad4b785.js" crossorigin="anonymous"></script>

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
                                    <li><a href="my_profile.php" class="dropdown-item">My Profile</a></li>
                                    <li><a href="logout.php" class="dropdown-item">Sign-Out</a></li>
                                    <?php
                                }
                                ?>                          
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
    </section>
    
    <!-- city-wise search -->
    <section id="city-search">
        <div class="container">
            
            <div class="row justify-content-md-center">
                <h1 id="city-search-title">Enter your City and discover Magic!</h1>
            </div>
            
            <form method="post" action="events.php">
                <div class="row justify-content-md-center">
                    <div class="col-md-9">
                        <select class="form-select form-select-lg mt-md-5 mt-4" name="selected-city">
                            <option value="" disabled selected hidden>Choose your city</option>
                            <?php foreach ($array as $arr) { ?>
                                <option value="<?php print($arr);?>"><?php print($arr); ?></option>
                            <?php } ?>
                            <!--
                            <option value="Mumbai">Mumbai</option>
                            <option value="Delhi">Delhi</option>
                            <option value="Jaipur">Jaipur</option> -->
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-outline-dark btn-lg mt-md-5 mt-3" name="search-submit">Submit</button>
                        <?php
                            if (isset($_POST['submit'])) {
                                if($_POST['selected-city'] == '') {
                                    header("Location: index.php");
                                }
                            }
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- popular events -->
    <section id="popular-events">
        <h1>Popular Events</h1>
        <div id="carouselExampleControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="row justify-content-center">
                    <img class="col-3 popular-event-image" src="images/deadpool.png" alt="deadpool">
                    <img class="col-3 popular-event-image" src="images/bam.png" alt="bam-annotation">
                    <img class="col-3 popular-event-image" src="images/pikachu.png" alt="pikachu">
                </div>
                <div class="event-text">
                    <h2>Comic Con</h2>
                    <h4>Enter into a world where all your favourite characters come to life.</h3>
                </div>
              </div>
              <div class="carousel-item">
                <div class="row justify-content-center">
                    <img src="images/dandiya-raas.png" alt="dandiya" class="col-3 popular-event-image">
                </div>
                <div class="event-text">
                    <h2>Falguni Pathak - Raas Garba</h2>
                    <h4>If its Garba, Its Falguni Pathak. Duh</h3>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </section>

    <!-- reviews -->
    <section id="review">
        <h1>Reviews</h1>
        <div id="carouselExampleControls2" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <h4 class="review-text">I found the raddest seats for the athletics event of the Commonwealth Games. Watching everybody run 'dun dun dun dun' was fun!</h4>
                    <img src="images/kamlesh.jpg" alt="kamlesh-profile" class="review-image">
                    <i>Kamlesh, Patna</i>
                </div>
                <div class="carousel-item">
                    <h4 class="review-text">जल्दी से दूध पी लेता हु, फिर जस्टिन बीबर के कॉन्सर्ट पे भी तोह जाना है</h4>
                    <img src="images/4l6e5j.png" alt="milk-boy" class="review-image">
                    <i>Raman, Thiruvananthapuram</i>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls2" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls2" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- download our app -->
    <section id="app-advert">
        <div class="container-fluid">
            <h1>Download Our App!</h1>
            <div class="row">
                <div class="col-md-6 subtitle" >
                    <h4>Sign in through the app and enjoy additional benefits. You really are in for a treat</h4>
                </div>
                <div class="col-md-6 buttons" >
                    <button type="button" class="btn btn-dark btn-lg cta-dw-btn"><i class="fab fa-apple"></i> Download</button>
                    <button type="button" class="btn btn-light btn-lg cta-dw-btn"><i class="fab fa-google-play"></i> Download</button>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <section></section>

</body>
</html>