<?php 
    session_start();
    require_once "database.php";
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="dark" style="width: 100%; background-image:linear-gradient(rgba(0, 0, 0, 0.527),rgba(0, 0, 0, 0.5)) , url('assets/ust.jpg'); background-size: cover;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        div{
            background-color: none;
        }
    </style>
</head>
    <body>
        <div id="login-body-container">
            <div id="logo-login-container">
                <div id="logo">
                    <img src="assets/tiger.png" style="width:2.5%;">
                </div>
            </div>
            <div id="login-form-container" class="container position-absolute top-50 start-50 translate-middle" style="border-radius:40px;">
                <div class="row gx-10 align-items-center justify-content-center">
                    <div class="col-"></div>
                    <div class="col" style="border-right:1px solid white;">
                        <div style="font-size:150%;">
                        <img src='assets/img-login.jpg' style="width:60%;border-radius:100%;" class="mx-auto d-block">
                            <a href="index.php" id="title-link">
                                <h1 style="color:#ffca2c;font-size:250%;">Connect-UST</h1>
                            </a>
                            <p>Connecting Thomasians through communities!</p>
                        </div>
                    </div>
                    <div class="col-1"></div>
                    <div class="col">
                        <div id="login-form">
                            <h1 style="text-align:center;"><b>Sign In</b></h1><br>
                            <form method="post">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" name="username" required autocomplete="off"><br>
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" name="password" required autocomplete="off">
                                <a href="identify-user.php">Forget Password?</a><br><br>
                                <?php
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
                                            echo "<p style='text-align:center;color:red;'>Invalid username or password!</p>";
                                        }
                                    } else {
                                        echo "<p style='text-align:center;color:red;'>Invalid username or password!</p>";
                                    }
                                        //echo "Database Connected";
                                    }catch(PDOException $e){
                                        throw new PDOException($e->getMessage(), (int)$e->getCode());
                                    }
                                
                                }

                                


                            ?>
                                <div style="text-align:center;">
                                    <button class="btn btn-warning" type="submit"><i class="bi bi-box-arrow-in-right"> </i>Login</button>
                                </div>
                            </form>
                            <hr>
                                <footer class="row">
                                        <div class="col-lg-5">
                                            <p>New here? <a href="register.php">Register now!</a></p>
                                        </div>
                                        <div class="col"></div>
                                        <div class="col-lg-3">
                                            <p><a href="index.php" id="login-links"  style="font-size:85%;"><i class="bi bi-house-door-fill"></i> Return Home</a></p>
                                        </div>
                                </footer>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </body>
</html>

