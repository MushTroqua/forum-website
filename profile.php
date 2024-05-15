<?php 
    session_start();
    require_once "database.php";

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        if(isset($_SESSION['username'])) {
            echo'<title>' . $_SESSION['username'] . '</title>';
        } else {
            header("Location: index.php");
            exit();
        }
    ?>
    <style>

        .profile-settings_container {
            display: flex;
        }

        .profile {
            flex: 1;
        }

        .button-settings {
            display: flex;
            align-self: flex-end;
        }

        .button-settings a {
            display: inline-block;
            padding: 10px 20px;
            margin-right: 10px;
            background-color: #f9f9f9;
            color: black;
            text-decoration: none;
            border-radius: 5px;
        }

        .post {
            border: 1px solid #6c6c6c;
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Profile Dashboard</h1>
    <hr />
    <div class="profile-settings_container">
        <div class="profile">
            <h1> <?php echo $_SESSION['username']; ?> </h1>
            <p> <?php echo $firstName . " " . $lastName; ?> </p>
        </div>
        <div class="button-settings">
            <a href="profile-settings.php">Change Password</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <hr />
    
    <div class="Profile-userpost">
    <h2><?php echo $_SESSION['username']; ?>'s Post Discussions</h2>
        <?php foreach ($userPosts as $post): ?>
            <div class="post" onclick="redirectToPostDetails(<?php echo $post['PostID']; ?>)">
                <h3><?php echo $post['Title']; ?></h3>
                <p><?php echo $post['Body']; ?></p>
                <p>Date Submitted: <?php echo $post['Date_Submitted']; ?></p>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        function redirectToPostDetails(postID) {
            window.location.href = 'post_details.php?id=' + postID;
        }
    </script>
</body>
</html>