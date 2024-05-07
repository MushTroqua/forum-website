<?php 
    session_start();
    require_once "database.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        try{
            $pdo = new PDO($attr, $user, $pw, $opts);
            $stmt = $pdo->prepare("SELECT * FROM userCredentials WHERE Username = :username");
            $stmt->execute(["username" => $username]);

            $user = $stmt->fetch();

            if($user) {
                if(password_verify($password, $user["Password"])){
                    $_SESSION["username"] = $user["Username"];
                    $_SESSION["user-id"] = $user["UserID"];
                    echo "<script>alert('Successfully Logged In!');</script>";
                    header("Location: index.php");
                    exit();
                } else {
                echo "<p>Invalid username or password!</p>";
            }
        } else {
            echo "<p>Invalid username or password!</p>";
        }
            //echo "Database Connected";
        }catch(PDOException $e){
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    
    }

    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
    form label, form input {
        display: block;
        margin-bottom: 10px;
    }

    form input {
        margin-left: 20px;
    }

    form button {
        display: block;
        margin-top: 20px;
        width: 100px;
        margin-left: 20px;
    }
    </style>
</head>
<body>
    <form method="post">
        <label for="username">Username</label>
        <input type="text" name="username" required autocomplete="off">
        <label for="password">Password</label>
        <input type="password" name="password" required autocomplete="off">
        <a href="identify-user.php">Forget Password?</a>
        <button type="submit">Login</button>
    </form>
</body>
</html>

