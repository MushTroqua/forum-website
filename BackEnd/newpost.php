<?php 
    session_start();
    require_once "database.php";

    if(isset($_SESSION['username'])) { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Create a post</title>
            <style>
                textarea {
                    resize: none;
                }

                form label, form input, form textarea, form button {
                    display: block;
                    margin-bottom: 10px;
                    margin-left: 20px;
                }

                .post-container {
                    border-color: black;
                    border: solid;
                    border-width: 1px;
                }
            </style>
        </head>
        <body>
            <div class="post-container">
                <form method="post">
                    <label for="title-text">Title</label>
                    <input type="text" name="title-text" size="55"> 
                    <label for="text-body">Body</label>
                    <textarea name="text-body" rows="4" cols="50"></textarea>
                    <button type="submit">Submit Post</button>
                </form>
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