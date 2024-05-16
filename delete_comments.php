<?php 
    session_start();
    require_once "database.php";


    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_id']) && isset($_SESSION['username'])) {
        $comment_id = intval($_POST['comment_id']);
        $username = $_SESSION['username'];

        try {
            $pdo = new PDO($attr, $user, $pw, $opts);

            $query = "SELECT * FROM comments WHERE CommentID = :comment_id AND Username = :username";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['comment_id' => $comment_id, 'username' => $username]);
            $comment = $stmt->fetch();

            if($comment) {
                $del_query = "UPDATE comments SET Username = NULL, CommentBody = NULL, CommentDate = NULL WHERE CommentID = :comment_id";
                $del_stmt = $pdo->prepare($del_query);
                $del_stmt->execute(['comment_id' => $comment_id]);

                echo "<script>alert('Deleted Successfully!'); window.location.href='index.php';</script>";
                exit();
            } else {
                echo "You are not authorized to delete this post.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid Request.";
    }
?>