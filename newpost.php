<?php 
    require_once "database.php";
    include "header-menu.php";

    if(isset($_SESSION['username'])) { ?>
    
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
            echo "<script>alert('New Post Submitted!');</script>";
            $_SESSION["username"] = $username;
            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            echo("Could not insert data: " . $e->getMessage());
        }
    }
?>