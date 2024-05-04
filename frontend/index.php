<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kimeiga/bahunya/dist/bahunya.min.css">
</head>
<body>
    <div class="card text-center m-5">
    <div class="card-header">
    
    <h2 style="color:black;">Alcohol Chart</h2>
    </div>
    <canvas id="myChart" ></canvas>
    </div>
    
    <?php if (isset($user)): ?>
        
        <p style="text-align:center;">Welcome to our dashboard, <?= htmlspecialchars($user["name"]) ?>!</p>
        
        <p style="text-align:center;"><a href="logout.php" class="btn btn-outline-danger">Log out</a></p>
        
    <?php else: ?>
        
        <p style="text-align:center;"><a class="btn btn-outline-primary btn-sm" href="login.php">Log in</a> or <a class="btn btn-outline-primary btn-sm" href="signup.html">Sign up</a></p>
        
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="app.js"></script>
</body>
</html>