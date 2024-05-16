<?php
include "header-menu.php";
?>
    <body >
    <div id="carouselExampleCaptions" class="carousel slide" style="background-image:linear-gradient(rgba(255, 218, 0, 0.527),rgba(33, 37, 41, 1)) , url('assets/ust-header.jpg'); background-size:cover;">
        <div class="carousel-inner" style="width:30%;margin:0 650px 0 650px;">
            <div class="carousel-item active">
            <img src="assets/pic-1.jpg" class="d-block w-100 " alt="... ">
            <div class="carousel-caption d-none d-md-block" style="color:white;background-color:#212529ab;">
                <h5>Photo by Deejae S. Dumlao.</h5>
                <p>6,000 Thomasians pass through the historic Arch of the Centuries last Aug. 3.</p>
            </div>
            </div>
            <div class="carousel-item">
            <img src="assets/pic-2.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block" style="color:white; background-color:#212529ab;">
                <h5 >Photo by The Varsitarian</h5>
                <p>Thomasian Audience in UAAP Season 85.</p>
            </div>
            </div>
            <div class="carousel-item">
            <img src="assets/pic-3.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block" style="color:white; background-color:#212529ab;">
                <h5>Photo by The Flame</h5>
                <p>UST Batch 2020, 2021, 2022 Baccalaureate mass</p>
            </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        </div>
        <br>
        <br>
        <div id="index-body-container" class="row justify-content-md-center" style="background-color:inherit;">
            <div class="col-lg-2" id="left-content-box">
                <div class="d-grid gap-2 col-6 mx-auto" id="left-content-box-buttons">
                <a class="btn" type="button" href="index.php"><i class="bi bi-house-door-fill"></i> Home</a>
                <?php
                                /*
                                This code shows that if the user is not yet logged in when they click 
                                the New Post they will be directed to login.php 
                                */ 
                                    if(!isset($_SESSION['username'])) { 
                                    echo '<a class="btn" type="button" href="login.php" style="margin-right:20px;"><i class="bi bi-plus"></i>New post</a>';
                                    } else {
                                        echo '<a class="btn" type="button" href="newpost.php" style="margin-right:20px;"><i class="bi bi-plus"></i>New post</a>';
                            } ?>
                <a class="btn" type="button" href="index.php"><i class="bi bi-question-circle-fill"></i> F.A.Q</a>
                <hr>
                <a class="btn" type="button" href="index.php"><i class="bi bi-chat-right-quote-fill"></i> About Us</a>
                <a class="btn" type="button" href="index.php"><i class="bi bi-telephone-outbound-fill"></i> Contact Us</a>

                </div>
            </div>
            <div class="col" id="center-content-box">
                <?php 

                        try {
                            $pdo = new PDO($attr, $user, $pw, $opts);
                            //echo "Database Connected";
                        } catch(PDOException $e) {
                            throw new PDOException($e->getMessage(), (int)$e->getCode());
                        }

                        $query = "SELECT * FROM UserPost ORDER BY Date_Submitted DESC";
                        $result = $pdo->query($query);
                ?>

                <!-- <div class="userpost"> !-->
                    <div id="userpost-container" class="container" style="padding:0 100px 0 50px;">
                        <?php
                            while($row = $result->fetch()){
                                if($row['Username'] !== NULL && $row['Title'] !== NULL && $row['Body'] !== NULL && $row['Body'] !== NULL && $row['Date_Submitted'] !== NULL) {
                                    //echo'<a href="post_details.php '. '?id='  . $row["PostID"] . '">';
                                    echo "<div class='container' style='margin:0 50px 0 10px;padding:50px;background-color:#242526;border-radius:20px;'>";
                                    echo "<div style='text-align:right;background-color:inherit;'>";
                                    
                                        echo "<div class='dropdown' style='background-color:inherit;'>";
                                        echo "<a class='btn' data-bs-toggle='dropdown' aria-expanded='false'><i class='bi bi-three-dots'></i></a>";
                                        echo "<ul class='dropdown-menu' style='text-align:center;'>";
                                        if(isset($_SESSION['username']) && $_SESSION['username'] === $row['Username']) {
                                        echo "<li class='dropdown-item'><form method='post' action='delete_post.php' onsubmit=\"return confirm('Are you sure you want to delete this post?');\"><input type='hidden' name='post_id' value='" . $row["PostID"] . "'><button type='submit' class='btn'><i class='bi bi-trash3-fill'></i>Delete</button></form></li>"; // DELETE BUTTON FOR USER (FRONTEND)
                                        //echo "<li class='dropdown-item><a href='#'><i class='bi bi-trash3-fill'></i>Delete</a>";//DELETE BUTTON FOR USER (FRONTEND)
                                        }
                                        echo "<li class='dropdown-item><a href='#' type='button' data-bs-toggle='modal' data-bs-target='#reportModal'><i class='bi bi-flag-fill'></i>Report</a>";//REPORT BUTTON (REDIRECT TO REPORT PAGE?)
                                        echo "</ul></div>";
                                    
                                    echo'</div>';
                                    echo'<div class="container" onclick="window.location=\'post_details.php' . '?id=' . $row["PostID"] . '\'" style="cursor:pointer;background-color:inherit;">';
                                    echo"<p>" . htmlspecialchars_decode($row["Username"]) . " <i class='bi bi-person-circle'></i> || ".htmlspecialchars($row["Date_Submitted"])."</p>";
                                    echo"<h1>" . htmlspecialchars_decode($row["Title"]) . "</h1>";
                                    echo"<p>" . htmlspecialchars_decode($row["Body"]) . "</p>";
                                    echo"</div></div><br>";
                                    //echo'</a>';
                                }
                            }
                        ?>
                    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true" style="background-color:rgba(0, 0, 0, 0.44);">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Submit a Report</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                Find this post offensive, or otherwise disturbing the peace? Let us know why by telling us!<Br><br>
                                <label for="report-body">Description of report:</label>
                                <textarea class="form-control"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <a type="button" class="btn btn-warning" href="index.php">Submit Report</a>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>

                    </div><br>
                    <!-- </div> !-->
            </div>
            <div class="col-lg-2" id="right-content-box">
            <p class="d-inline-flex gap-1">
                <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#community" aria-expanded="false" aria-controls="community">
                <img style="background-color:white;border-radius:100%;" src="assets/logo.png" id="dropdown-community-icons"> UST Affliated Sites <i class="bi bi-arrow-down-short"></i>
                </button>
            </p>
            <div class="collapse show" id="community">
                <div>
                    <a class="btn" href="#"><i class="bi bi-box-arrow-left"></i> Official University Site</a><br>
                    <a class="btn" href="#"><i class="bi bi-box-arrow-left"></i> myUSTe Student Portal</a><br>
                    <a class="btn" href="http://ict-services.ust.edu.ph/"><i class="bi bi-box-arrow-left"></i> UST-ICT Support Service</a><br>
                    <a class="btn" href="https://ust.instructure.com"><i class="bi bi-box-arrow-left"></i> UST Canvas</a><br>
                    <a class="btn" href="http://ust.blackboard.com/"><i class="bi bi-box-arrow-left"></i> UST Blackboard</a><br>
                </div>
            </div>      
            </div>
        </div>
     </body>
</body>
</html>