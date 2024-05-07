<?php
    session_start();
    require_once "database.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
        }

        .container {
            width: 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="password"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Change Password</h2>
        <form method="post">
            <label for="old_password">Old Password:</label>
            <input type="password" id="old_password" name="old_password" required>

            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>

            <input type="submit" value="Change Password">
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