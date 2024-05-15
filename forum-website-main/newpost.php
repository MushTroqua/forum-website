<?php
    session_start();
    require_once "database.php";

    if(isset($_SESSION['username'])) { ?>
        <!DOCTYPE html>
        <html lang="en" data-bs-theme="dark">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connect-UST</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        </head>
        <body>
            <br>
            <div id="post-container" class="container">
                <div class="row justify-content-md-center">
                    <div class="col-lg-2"></div>
                    <div id="post-form" class="col">
                        <form method="post">
                            <label for="title-text">Title:</label>
                            <input type="text" class="form-control"  name="title-text" size="55"><br>
                            <label for="text-body">Description:</label><br>
                            <textarea class="form-control"  name="text-body" rows="4" cols="50"></textarea><br>
                            <div style="text-align: center;"> 
                                <button class="btn btn-warning" type="submit">Submit Post</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2"></div>
                </div>
            </div>
        </body>
        </html>
    <?php }
?>

<?php 
    try {
        $pdo = new PDO($attr, $user, $pw, $opts);
        //echo "Database Connected";
    }catch(PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }


    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $randomNumber = rand(100000, 999999);
        $generate_userID = $randomNumber;
        $username = $_SESSION['username'];
        $date = date("Y-m-d");
        $title =  filter_input(INPUT_POST, "title-text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $body = filter_input(INPUT_POST, "text-body", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sql = "INSERT INTO UserPost (PostID, Username, Title, Body, Date_Submitted) VALUES (?,?,?,?,?)";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$generate_userID, $username, $title, $body, $date]);
            $_SESSION["username"] = $username;
            echo "<script>alert('New Post Submitted!'); window.location.href='index.php';</script>";
            exit();
        } catch (PDOException $e) {
            echo("Could not insert data: " . $e->getMessage());
        }
    }
?>