<?php 
    session_start();
    require_once "database.php";
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect-UST</title>
    <link rel="stylesheet" type="text/css" href="style.css?v=<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
    <header style="background-color: #212529;">
        <div id="header-container" class="row">
            <div id="header-title" class="col-3">
                <a href="index.php" id="title-link">
                    <h1 style="color:#ffca2c">Connect-UST</h1>
                </a>
            </div>
            <div class="col-5"> 
                <form action="/search" method="get" class="input-group mb-3">
                    <input type="text" class="form-control" id="search-bar" placeholder="Search..." aria-label="Search">
                    <div id="search-suggestions"></div>
                    <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
                </form>
                <script>
                     document.getElementById("search-bar").addEventListener("input", function() {
                        var query = this.value;
                        if (query.length > 0) {
                            fetchSuggestions(query);
                        } else {
                            document.getElementById("search-suggestions").innerHTML = "";
                        }
                    });

                    function fetchSuggestions(query) {
                        fetch("search.php?query=" + query)
                            .then(response => response.json())
                            .then(data => {
                                displaySuggestions(data);
                            })
                            .catch(error => {
                                console.error('Error fetching suggestions:', error);
                            });
                    }

                    /*function displaySuggestions(suggestions) {
                        var suggestionsContainer = document.getElementById("search-suggestions");
                        suggestionsContainer.innerHTML = "";
                        if (suggestions.length > 0) {
                            var ul = document.createElement("ul");
                            suggestions.forEach(function(item) {
                                var li = document.createElement("li");
                                li.textContent = item.Title;
                                ul.appendChild(li);
                            });
                            suggestionsContainer.appendChild(ul);
                        } else {
                            suggestionsContainer.innerHTML = "<p>No suggestions found.</p>";
                        }
                    }*/ 

                    function displaySuggestions(suggestions) {
                        var suggestionsContainer = document.getElementById("search-suggestions");
                        suggestionsContainer.innerHTML = "";
                        if (suggestions.length > 0) {
                            var ul = document.createElement("ul");
                            suggestions.forEach(function(item) {
                                var li = document.createElement("li");
                                var a = document.createElement("a");
                                a.textContent = item.Title;
                                a.href = "post_details.php?id=" + item.PostID; // Add href attribute
                                li.appendChild(a);
                                ul.appendChild(li);
                            });
                            suggestionsContainer.appendChild(ul);
                        } else {
                            suggestionsContainer.innerHTML = "<p>No suggestions found.</p>";
                        }
                    }

                    
                </script>
                
            </div>
            <div class="col">
            </div>  
            <div class ="col-3 " id="user-info">
                <div id="user-info-content"style="padding-right:20px;">
                    <?php
                                /*
                                This code shows that if the user is not yet logged in when they click 
                                the New Post they will be directed to login.php 
                                */ 
                                    if(!isset($_SESSION['username'])) { 
                                    echo '<a class="btn btn-outline-light" type="button" href="login.php" style="margin-right:20px;"><i class="bi bi-plus"></i>New post</a>';
                                    } else {
                                        echo '<a class="btn btn-outline-light" type="button" href="newpost.php" style="margin-right:20px;"><i class="bi bi-plus"></i>New post</a>';
                            } ?>
                    <?php    
                        /*
                        This code shows that if the user has logged in the website it replaces
                        the anchor tags saying "Welcome <name of user> and the Log out. Otherwise
                        Sign up and Sign in are displayed
                        */ 
                        if(isset($_SESSION['username'])) {
                    ?>      
                    <div class="btn-group">
                        <a href="profile.php" type="button" class="btn btn-outline-warning">Welcome, <?php echo " " . $_SESSION['username']; ?>  <i class="bi bi-person-circle"></i></a>
                        <button type="button" class="btn btn-outline-warning dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <ul class="dropdown-menu" id="dropdown-links">
                                <li><a href="profile.php" id="dropdown-links"><i class="bi bi-person-fill"></i> Profile Dashboard</a></li>
                                <li><a class="dropdown-item" id="dropdown-links" href="https://www.ust.edu.ph/"><i class="bi bi-box-arrow-in-left"></i> University Site</a></li>
                                <li><a class="dropdown-item" id="dropdown-links" href="https://myusteportal.ust.edu.ph/"><i class="bi bi-box-arrow-in-left"></i> myUSTe</a></li>
                                <li><a href="logout.php" id="dropdown-links">Logout <i class="bi bi-box-arrow-left"></i></a></li>
                                <li><div><?php $_SESSION['username']?></div></li>
                        </ul>
                    </div>
                </div>
                <div id="header-sign-in-button-container" class="row">
                    <?php 
                        } 
                    else { 
                            echo '<div class="btn-group" role="group">';
                            echo '<a class="btn btn-warning" type="button" href="register.php" id="header-sign-in-button"><i class="bi bi-box-arrow-in-right"></i> Sign Up</a> ';
                            echo ' <a class="btn btn-warning" type="button" href="login.php" id="header-sign-in-button"><i class="bi bi-person-circle"></i> Sign In</a>';
                            echo '<div class="dropdown">';
                            echo ' <a class="btn btn-dark" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>';
                            echo '<ul class="dropdown-menu">';
                            echo '<li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-in-left"></i> University Site</a></li>';
                            echo '<li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-in-left"></i> myUSTe</a></li>';
                            echo '<li><a class="dropdown-item" href="#">F.A.Q</a></li>';
                            echo '<li><a class="dropdown-item" href="#">About Us</a></li>';
                            echo '</ul></div></div>';

                        }
                    ?>
                </div>
            </div>
            <hr>
        </div>
    </header>

