<?php
    session_start();
    require_once "database.php";

    try{
        $pdo = new PDO($attr, $user, $pw, $opts);
        //echo "Database Connected";
    }catch(PDOException $e){
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $currentYear = date('Y');
        $randomNumber = rand(100000, 999999);
        $generate_userID = $currentYear . $randomNumber; 
        $firstname = filter_input(INPUT_POST, "firstname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $lastname = filter_input(INPUT_POST, "lastname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $age = filter_input(INPUT_POST, "age", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO userCredentials (UserID, FirstName, LastName, Age, Email, Username, Password) VALUES (?, ?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$generate_userID, $firstname, $lastname, $age, $email, $username, $passwordHash]);
            echo "<script>alert('User registered successfully!');</script>";
            $_SESSION["username"] = $username;
            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            echo("Could not insert data: " . $e->getMessage());
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create your own account</title>
    <style>
    form label, form input {
        display: block;   /* Makes the element fill the entire width and moves the next element to a new line */
        margin-bottom: 10px; /* Adds some space below each element */
    }

    form input {
        margin-left: 20px; /* Adds some indentation to the input fields relative to the labels */
    }

    form button {
        display: block; /* Ensures the button also appears on a new line */
        margin-top: 20px; /* Adds some space above the button */
        width: 100px; /* Sets a specific width to the submit button */
        margin-left: 20px; /* Aligns the button with the input fields */
    }
    </style>
</head>
<body>
    <form method="post">
        <label for="firstname">First Name</label>
        <input type="text" name="firstname" required autocomplete="off">
        <label for="lastname">Last Name</label>
        <input type="text" name="lastname" required autocomplete="off">
        <label for="age">Age</label>
        <input type="text" name="age" required autocomplete="off">
        <label for="email">Email</label>
        <input type="text" name="email" required autocomplete="off">
        <label for="username">Username</label>
        <input type="text" name="username" required autocomplete="off">
        <label for="password">Password</label>
        <input type="password" name="password" required autocomplete="off">
        <button type="submit">Sign Up</button>
    </form>
</body>
</html>

