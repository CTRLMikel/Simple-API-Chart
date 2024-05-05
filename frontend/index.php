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
<html data-bs-theme="dark">
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <!-- Navigation  -->
        <div class="card text-center m-5">
        <div class="card-header">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Account
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Change Username</a></li>
                    <li><a class="dropdown-item" href="#">Change password</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item cursor-pointer pe-auto" data-bs-toggle="modal" data-bs-target="#exampleModal" role="button">Delete account</a></li>
                </ul>
                </li>
            </ul>
            </div>
        </div>
        </nav>
    <!-- Navigation -->
    <div class="card text-center m-5">
    <div class="card-header">
    
    <h2>Alcohol Chart per Country</h2>
    </div>
    <canvas id="myChart" ></canvas>
    </div>
    
    <?php if (isset($user)): ?>
        
        <p style="margin-top: 22px; margin-right: 130px;position:absolute;top:0;right:0;">Welcome to our dashboard, <?= htmlspecialchars($user["name"]) ?>!</p>
        
        <p style="margin-top: 17px; margin-right: 30px;position:absolute;top:0;right:0;"><a href="logout.php" class="btn btn-outline-danger">Log out</a></p>
        
    <?php else: ?>
        
        <p style="margin-top: 20px; margin-right: 30px;position:absolute;top:0;right:0;"><a class="btn btn-outline-primary btn-sm" href="login.php">Log in</a> or <a class="btn btn-outline-primary btn-sm" href="signup.html">Sign up</a></p>
        
    <?php endif; ?>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Warning!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete your acount?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="deleteButton">Delete</button>
            </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("deleteButton").addEventListener("click", function() {
                window.location.href = "delete-account.php";
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="app.js"></script>
</body>
</html>