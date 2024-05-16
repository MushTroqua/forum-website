<?php 
    include "header-menu.php";
    try {
        $pdo = new PDO($attr, $user, $pw, $opts);
        //echo "Database Connected!";
    } catch(PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    $loggedInUsername = $_SESSION['username'];

    $stmt = $pdo->prepare("SELECT * FROM UserPost WHERE Username = ? ORDER BY Date_Submitted DESC");
    $stmt->execute([$loggedInUsername]);

    $userPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    
?>
<?php 
     $stmt = $pdo->prepare("SELECT FirstName, LastName FROM userCredentials WHERE Username = ?");
     $stmt->execute([$_SESSION['username']]);
     $user = $stmt->fetch(PDO::FETCH_ASSOC);
 
     $firstName = $user['FirstName'];
     $lastName = $user['LastName'];
?>

    <body>
        <div id="profile-body-container" class="container">
        <div class="container" style="background-color: none;">
            <div id="profile-settings_container" class="row align-items-center" style="background-color:inherit;">
                <div class="col-1" style="background-color:inherit;">
                <i class="bi bi-person-circle" style="font-size: 600%;" ></i>
                </div>
                <div id="profile" class="col-3" style="line-height:0.5;" style="background-color:inherit;">
                    <h1><b><?php echo $_SESSION['username']; ?></b></h1>
                    <p> <?php echo $firstName . " " . $lastName; ?> </p>
                </div>
            </div>
        
            <div class="col-lg-2" style="background-color:inherit;">
                    
            </div>
            <div id="button-settings" style="background-color:inherit;">
                <a class="btn btn-outline-light" href="profile-settings.php"><i class="bi bi-pencil-square"></i> Change Password</a>
                <a class="btn btn-outline-light" href="logout.php"><i class="bi bi-box-arrow-left"></i> Logout</a>
            </div>
        </div>
        <hr>
            <div id="Profile-userpost">
            <h2><?php echo $_SESSION['username']; ?>'s Post Discussions</h2>
            <div style="border:1px solid white;">
                <?php foreach ($userPosts as $post): ?>
                    <div class="container" id="post-profile-container" style="border:1px solid white;line-height:1.5;cursor:pointer;" onclick="redirectToPostDetails(<?php echo $post['PostID']; ?>)">
                        <h3><?php echo $post['Title']; ?></h3>
                        <p><?php echo $post['Body']; ?></p>
                        <p>Date Submitted: <?php echo $post['Date_Submitted']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div><br>
            </div>

        <script>
            function redirectToPostDetails(postID) {
                window.location.href = 'post_details.php?id=' + postID;
            }
        </script>
        </div>
    </body>
</html>