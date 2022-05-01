<?php 
session_start();
?>

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
