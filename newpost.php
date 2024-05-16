<?php
    include "header-menu.php";
    if(isset($_SESSION['username'])) { ?>
        <body>
            <br>
            <div id="post-container" class="container">
                <div class="row justify-content-md-center">
                    <div class="col-lg-2"></div>
                    <div id="post-form" class="col">
                    <a href="index.php" style="text-decoration:none;">< Go Back</a>
                        <h2>Create New Post</h2><br>
                        <form method="post">
                            <h4><label for="title-text">Title:</label></h4>
                            <input type="text" maxlength="300" class="form-control"  name="title-text" size="55"><br>
                            <h4><label for="text-body">Description:</label><br></h4>
                            <textarea class="form-control"  name="text-body" rows="4" cols="50"></textarea><br>
                            <button class="btn btn-warning" type="submit">Submit Post</button>
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