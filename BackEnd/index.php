<?php
include "header-menu.php";
?>
        <div class="parent-tabs">
            <div class="leftside-tab">
                <?php
                /*
                This code shows that if the user is not yet logged in when they click 
                the New Post they will be directed to login.php 
                */ 
                    if(!isset($_SESSION['username'])) { ?>
                        <a href="login.php">New post</a>
                <?php } else { ?>
                    <a href="newpost.php">New post</a>
                <?php } ?>
                <hr>

            </div>
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
            <div class="userpost-container">
            <?php
                while($row = $result->fetch()){
                    //echo'<a href="post_details.php '. '?id='  . $row["PostID"] . '">';
                    echo'<div class="userpost" onclick="window.location=\'post_details.php' . '?id=' . $row["PostID"] . '\'">';
                    echo"<p>" . htmlspecialchars($row["Username"]) . "</p>";
                    echo"<h1>" . htmlspecialchars($row["Title"]) . "</h1>";
                    echo"<p>" . htmlspecialchars($row["Body"]) . "</p>";
                    echo"<p>" . htmlspecialchars($row["Date_Submitted"]) . "</p>";
                    echo"</div>";
                    //echo'</a>';
                }
            ?>

            </div>
            <!-- </div> !-->

            <div class="rightside-tab">
                <ul>
                    <li>lorem ipsum...</li>
                    <li>lorem ipsum...</li>
                    <li>lorem ipsum...</li>
                    <li>lorem ipsum...</li>
                    <li>lorem ipsum...</li>
                    
                </ul>
            </div>
        </div>
    </div>
</body>
</html>