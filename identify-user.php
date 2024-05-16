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
    <a href="index.php" style="text-decoration:none;"> < Go back</a><br><br>
        <h1 id="title-link" style="color:#ffca2c;font-size:250%;">Connect-UST</h1>   
        <h2>Enter your Username</h2><br>
        <form method="post">
            <label for="enter-username">Do you remember your Username?</label><br><Br>
            <input type="text" class="form-control" id="enter-username" name="enter-username" required><br>
            <div style="text-align: center;">
                <input type="submit" class="btn btn-warning" value="Verify">
            </div>
            <div style="text-align:center;  "><br>
                    <a href="index.php" id="login-links" ><i class="bi bi-house-door-fill"></i>Return Home</a>
            </div>
        </form>
    </div>
</body>
</html>