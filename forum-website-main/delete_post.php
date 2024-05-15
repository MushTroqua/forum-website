<?php 
    session_start();
    require_once "database.php";


    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post_id']) && isset($_SESSION['username'])) {
        $post_id = intval($_POST['post_id']);
        $username = $_SESSION['username'];

        try {
            $pdo = new PDO($attr, $user, $pw, $opts);

            $query = "SELECT * FROM userpost WHERE PostID = :post_id AND Username = :username";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['post_id' => $post_id, 'username' => $username]);
            $post = $stmt->fetch();

            if($post) {
                $del_query = "UPDATE userpost SET Username = NULL, Title = NULL, Body = NULL, Date_Submitted = NULL WHERE PostID = :post_id";
                $del_stmt = $pdo->prepare($del_query);
                $del_stmt->execute(['post_id' => $post_id]);

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