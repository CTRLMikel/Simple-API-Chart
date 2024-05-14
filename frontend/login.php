<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <?php if ($is_invalid): ?>
        <em>Invalid login credentials, try again!</em>  
    <?php endif; ?>
        
        <form method="post">
            <h1>Login</h1>
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email"
                value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            
            <button>Log in</button>
            <div style="padding-top:20px; text-align:center;">
                <a href="forgot-password.php">Forgot password?</a>
            </div>
            <div style="padding-top:20px; text-align:center;">
                <a href="signup.html">Don't have an account?</a>
            </div>
        </form>
    
</body>
</html>








