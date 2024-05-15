<?php
    session_start();
    require_once "database.php";

    try{
        $pdo = new PDO($attr, $user, $pw, $opts);
        //echo "Database Connected";
    }catch(PDOException $e){
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $currentYear = date('Y');
        $randomNumber = rand(100000, 999999);
        $generate_userID = $currentYear . $randomNumber; 
        $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $age = filter_input(INPUT_POST, "age", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO userCredentials (UserID, FirstName, LastName, Age, Email, Username, Password) VALUES (?, ?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$generate_userID, $firstname, $lastname, $age, $email, $username, $passwordHash]);
            $_SESSION["username"] = $username;
            echo "<script>alert('Registered Successfully!'); window.location.href='index.php';</script>";
            exit();
        } catch (PDOException $e) {
            echo("Could not insert data: " . $e->getMessage());
        }

    }
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
    <div id="signup-form-container" class="position-absolute top-50 start-50 translate-middle" style="margin:30px 0 0 0; padding:20px;border-radius:20px;">
        <div id="signup-form" class="align-items-center justify-content-center" style="padding:10px 50px 20px 50px;">
            <h1 id="title-link" style="color:#ffca2c;font-size:250%;">Connect-UST</h1>
            <h1 style="text-align:center;">Sign-Up</h1>
            <form method="post">
                <label for="firstname">First Name:</label><br>
                <input type="text" name="firstname" class="form-control" required autocomplete="off" placeholder="John"><br>
                <label for="lastname">Last Name:</label><br>
                <input type="text" name="lastname" class="form-control" required autocomplete="off" placeholder="Smith"><br>
                <label for="age">Age:</label><br>
                <input type="text" name="age" class="form-control" required autocomplete="off" placeholder="20"><br>
                <label for="email">Email:</label><br>
                <input type="text" name="email" class="form-control" required autocomplete="off" placeholder="johnsmith@gmail.com"><br>
                <label for="username">Username:</label><br>
                <input type="text" name="username" class="form-control" required autocomplete="off" placeholder="johnsmith20"><br>
                <label for="password">Password:</label><br>
                <input type="password" name="password" class="form-control" required autocomplete="off" placeholder="********"><br>
                <div style="text-align:center;">
                    <button class="btn btn-warning" type="submit"><i class="bi bi-box-arrow-in-right"> </i>Sign Up</button>
                </div>
            </form>
            <hr>
            <footer style="text-align:center;">
                <div id="login-footer">
                    <p>Already an existing user? <a href="login.php">Login now!</a>
                </div>
                <div style="font-size:80%;"><br>
                    <a href="index.php" id="login-links" ><i class="bi bi-house-door-fill"></i>Return Home</a>
                 </div>
            </footer>
        </div>
    </div>
</body>
</html>

