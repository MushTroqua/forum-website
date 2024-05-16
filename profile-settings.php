<?php
    session_start();
    require_once "database.php";
?>


<!DOCTYPE html>
<html lang="en"  lang="en" data-bs-theme="dark" style="width: 100%; background-image:linear-gradient(rgba(0, 0, 0, 0.527),rgba(0, 0, 0, 0.5)) , url('assets/ust.jpg'); background-size: cover;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create your own account</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div id="logo-login-container" style="background-color: #212529;">
        <div id="logo">
            <img src="assets/tiger.png" style="width:2.5%;">
        </div>
    </div>
    <div class="position-absolute top-50 start-50 translate-middle" style="padding:80px;border-radius:5%;">
        <h1 id="title-link" style="color:#ffca2c;font-size:250%;">Connect-UST</h1>
        <h2>Change Password</h2>
        <form method="post">
            <label for="old_password">Old Password:</label>
            <input type="password" class="form-control" id="old_password" name="old_password" required><br>

            <label for="new_password">New Password:</label>
            <input type="password" class="form-control" id="new_password" name="new_password" required><br>
            <div style="text-align: center;">
                <input class="btn btn-warning" type="submit" value="Change Password"><br>
            </div>
            <div style="text-align:center;  "><br>
                    <a href="index.php" id="login-links" ><i class="bi bi-house-door-fill"></i>Return Home</a>
            </div>
        </form>
    </div>
</body>
</html>


<?php

    try{
        $pdo = new PDO($attr, $user, $pw, $opts);
        //echo "Database Connected";
    }catch(PDOException $e){
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $old_password = $_POST["old_password"];
        $new_password = $_POST["new_password"];

        $user_id = $_SESSION['user-id'];

        $query = "SELECT Password FROM userCredentials WHERE UserID = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$user_id]);
        $row = $stmt->fetch();

        if($row) {
            $hashed_password_from_database = $row['Password'];

            if(password_verify($old_password, $hashed_password_from_database)) {
                $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                $stmt = $pdo->prepare("UPDATE userCredentials SET Password = ? WHERE UserID = ?");
                $stmt->execute([$new_hashed_password, $user_id]);

                echo "<script>alert('Password changed successfully, logging user out.');";
                echo "window.location.href = 'logout.php';</script>";
                exit();
            } else {
                echo "Old password is incorrect.";
            }
        } else {
            echo "User not found.";
        }
    }
?>