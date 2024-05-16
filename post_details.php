<?php
    include "header-menu.php";
    require_once "database.php";

    try {
        $pdo = new PDO($attr, $user, $pw, $opts);
        //echo "Database Connected";
    } catch(PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    if(isset($_GET['id'])) {
        $post_id = $_GET['id'];
        
        $query = "SELECT * FROM UserPost WHERE PostID = :post_id";
        $stmt_post = $pdo->prepare($query);
        $stmt_post->execute(['post_id' => $post_id]);

        $post = $stmt_post->fetch(PDO::FETCH_ASSOC);

    } else {
        header("Location: index.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
            echo'<title>' . htmlspecialchars($post["Title"])  . '</title>';
    ?>
    <style>
        .post-container {
            display: block;
            margin-bottom: 20px;
        }
        .post-details {
            border: 1px solid #6c6c6c; 
            padding: 50px;
            margin-bottom: 50px;
        }
        .reply-form {
            display: block;
            border: 1px solid #6c6c6c;
            padding: 20px;
            margin-bottom: 100px;
        }
        
        #reply_body {
            resize: none;
        }

        .comment-sec {
            border: 1px solid #6c6c6c;
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="post-container">
        <div class="post-details">
            <p><?php echo htmlspecialchars_decode($post["Username"]); ?></p>
            <h1><?php echo htmlspecialchars_decode($post["Title"]); ?></h1>
            <p><?php echo htmlspecialchars_decode($post["Body"]); ?></p>
            <p><?php echo htmlspecialchars_decode($post["Date_Submitted"]); ?></p>
        </div>
        <div class="comment-section">
            <div class="reply-form">
                <form action="submit_reply.php" method="post">
                    <?php 
                        $randomNumber = rand(100000, 999999);
                        $generate_userID = $randomNumber;
                    ?>
                    <h1>Comment</h1>
                    <input type="hidden" name="comment_id" value="<?php echo $generate_userID ?>">
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <input type="hidden" id="reply_username" name="reply_username" value="<?php if(!isset($_SESSION['username'])) { echo "You are not logged in"; } else { echo $_SESSION['username']; } ?>">
                    <input type="hidden" name="date_submitted" value="<?php $date = date("Y-m-d"); echo $date;?>">
                    <?php 
                        if(!isset($_SESSION['username'])) { ?>
                            <textarea id="reply_body" name="reply_body" rows="10" cols="150" disabled></textarea>
                        <?php } else { ?> 
                            <textarea id="reply_body" name="reply_body" rows="10" cols="150" oninput="checkTextArea()"></textarea>
                        <?php }
                    ?>
                    
                    <button type="submit" id="submit_button" disabled>Post a Reply</button>
                    <script>
                        function checkTextArea() {
                            var textAreaValue = document.getElementById("reply_body").value;
                            var submitButton = document.getElementById("submit_button");

                            if(textAreaValue.trim() === "") {
                                submitButton.disabled = true;
                            } else {
                                submitButton.disabled = false;
                            }
                        }
                    </script>
                </form>
            </div>
            <?php 
                $query_comments = "SELECT * FROM comments WHERE PostID = :post_id ORDER BY CommentDate DESC";
                $stmt_comments = $pdo->prepare($query_comments);
                $stmt_comments->execute(['post_id' => $post_id]);

                while($comments = $stmt_comments->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='comment-sec'>";
                    echo "<p>" . htmlspecialchars_decode($comments['Username']) . "</p>";
                    echo "<p>" . htmlspecialchars_decode($comments['CommentBody']) . "</p>";
                    echo "<p>" . htmlspecialchars_decode($comments['CommentDate']) . "</p>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>
</body>
</html>