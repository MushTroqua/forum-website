<?php 
    require_once "database.php";

    try{
        $pdo = new PDO($attr, $user, $pw, $opts);
        //echo "Database Connected";
    }catch(PDOException $e){
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    if(isset($_GET['username'])) {
        $username = $_GET['username'];

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $newPassword = $_POST['new-password'];
            $confirmPassword = $_POST['confirm-password'];

            if($newPassword === $confirmPassword) {
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);


                $query = "UPDATE userCredentials SET Password = ? WHERE Username = ?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$hashedPassword, $username]);

                echo "<script>alert('Password changed successfully, try to login.');";
                echo "window.location.href = 'login.php';</script>";
            } else {
                echo "Passwords do not match. Please try again.";
            }
        }
    } else {
        header("Location: identify-user.php");
        exit();
    }
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
        <h2>Set New Password</h2>
        <form method="post">
            <label for="new-password">New Password:</label>
            <input type="password" id="new-password" name="new-password" required>

            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm-password" required>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>