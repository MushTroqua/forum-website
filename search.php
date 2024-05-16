<?php 
    require_once "database.php";
    
    try {
        $pdo = new PDO($attr, $user, $pw, $opts);
        //echo "Database Connected";
    }catch(PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    if(isset($_GET['query'])) {
        $query = $_GET['query'];
        $sql = "SELECT PostID, Username, Title, Body, Date_Submitted FROM UserPost WHERE Title LIKE :query";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':query', "%$query%");
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($results);
    }
?>