<?php 
    require_once "database.php";

    try{
        $pdo = new PDO($attr, $user, $pw, $opts);
        //echo "Database Connected";
    }catch(PDOException $e){
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $enteredUsername = $_POST['enter-username'];

        $query = "SELECT * FROM userCredentials WHERE Username = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$enteredUsername]);
        $user = $stmt->fetch();

        if($user) {
            header("Location: new-password.php?username=" . $enteredUsername);
            exit();
        } else {
            echo "Username not found. Please try again.";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password?</title>
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

        input[type="text"], input[type="submit"] {
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
        <h2>Enter your Username</h2>
        <form method="post">
            <label for="enter-username">Do you remember your Username?</label>
            <input type="text" id="enter-username" name="enter-username" required>

            <input type="submit" value="Verify">
        </form>
    </div>
</body>
</html>