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
        <h2>Set New Password</h2>
        <form method="post">
            <label for="new-password">New Password:</label><Br>
            <input class="form-control" type="password" id="new-password" name="new-password" required><br>

            <label for="confirm-password">Confirm Password:</label><br>
            <input class="form-control" type="password" id="confirm-password" name="confirm-password" required><br>
            <div style="text-align: center;">
                <input type="submit" class="btn btn-warning" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>