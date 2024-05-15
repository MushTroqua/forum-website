<?php 
    session_start();
    require_once "database.php";

    try {
        $pdo = new PDO($attr, $user, $pw, $opts);
        //echo "Database Connected";
    } catch(PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }


    if($_SERVER["REQUEST_METHOD"] == "POST") {
        //Check if all required fields are filled

        if(isset($_POST['comment_id'], $_POST['post_id'], $_POST['reply_username'], $_POST['reply_body'], $_POST['date_submitted'])) {
            $comment_id = $_POST['comment_id'];
            $post_id = $_POST['post_id'];
            $reply_username = $_POST['reply_username'];
            $reply_body = $_POST['reply_body'];
            $date_submitted = $_POST['date_submitted'];

            

            $query = "INSERT INTO comments (CommentID, PostID, Username, CommentBody, CommentDate) VALUES (:comment_id ,:post_id, :reply_username, :reply_body, :date_submitted)";
            $stmt = $pdo->prepare($query);
            $stmt ->execute(['comment_id' => $comment_id, 'post_id' => $post_id, 'reply_username' => $reply_username, 'reply_body' => $reply_body, 'date_submitted' => $date_submitted]);

            header('Location: post_details.php?id=' . $post_id);
            exit();
        } else {
            echo "All fields are required!";
        }
    } else {
        echo "Invalid Request!";
    }
?>