<?php
include "header-menu.php";
?>
    <body >
    <div id="carouselExampleCaptions" class="carousel slide" style="background-color:#f5c63b84;">
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
        <div id="index-body-container" class="row justify-content-md-center" style="background-color:inherit;">
            <div class="col-lg-2" id="left-content-box">
                <div class="d-grid gap-2 col-6 mx-auto" id="left-content-box-buttons">
                <a class="btn" type="button" href="index.php"><i class="bi bi-house-door-fill"></i> Home</a>
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
                                //echo'<a href="post_details.php '. '?id='  . $row["PostID"] . '">';
                                echo "<div class='container' style='margin:0 50px 0 10px;padding:50px;background-color:#242526;border-radius:20px;'>";
                                echo "<div style='text-align:right;background-color:inherit;'>";
                                echo "<div class='dropdown' style='background-color:inherit;'>";
                                echo "<a class='btn' data-bs-toggle='dropdown' aria-expanded='false'><i class='bi bi-three-dots'></i></a>";
                                echo "<ul class='dropdown-menu' style='text-align:center;'>";
                                echo "<li class='dropdown-item><a href='#'><i class='bi bi-trash3-fill'></i>Delete</a>";//DELETE BUTTON FOR USER (FRONTEND)
                                echo "<li class='dropdown-item><a href='#'><i class='bi bi-flag-fill'></i>Report</a>";//REPORT BUTTON (REDIRECT TO REPORT PAGE?)
                                echo "</ul></div></div>";
                                echo'<div class="container" onclick="window.location=\'post_details.php' . '?id=' . $row["PostID"] . '\'" style="cursor:pointer;background-color:inherit;">';
                                echo"<p>" . htmlspecialchars($row["Username"]) . " <i class='bi bi-person-circle'></i> || ".htmlspecialchars($row["Date_Submitted"])."</p>";
                                echo"<h1>" . htmlspecialchars($row["Title"]) . "</h1>";
                                echo"<p>" . htmlspecialchars($row["Body"]) . "</p>";
                                echo"</div></div><br>";
                                //echo'</a>';
                            }
                        ?>

                    </div><br>
                    <!-- </div> !-->
            </div>
            <div class="col-lg-2" id="right-content-box" style="border-left:2px solid white;">
            <p class="d-inline-flex gap-1">
                <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#community" aria-expanded="false" aria-controls="community">
                <img src="assets/logo.png" id="dropdown-community-icons"> UST Affliated Sites <i class="bi bi-arrow-down-short"></i>
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