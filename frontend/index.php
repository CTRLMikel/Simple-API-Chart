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
    <script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
</head>
<body>

    <!-- Navigation  -->
        <div class="card text-center m-5">
        <div class="card-header">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" data-bs-toggle="modal" data-bs-target="#about" role="button">About</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Account
                </a>
                <ul class="dropdown-menu">
                    <?php if (isset($user)): ?>
                        <a class="dropdown-item" id="changeUsername" role="button">Change Username</a>
                        <li><a class="dropdown-item" href="forgot-password.php" role="button">Change password</a></li>
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#accountModal" role="button">My Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" role="button">Delete account</a></li>
                    <?php else: ?>
                        <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" role="button">Change Username</a>
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" role="button">Change password</a></li>
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" role="button">My Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" role="button">Delete account</a></li>
                    <?php endif; ?>

                </ul>
                </li>
                <button class="btn btn-dark" onclick="toggleTheme()">Toggle Theme</button>
            </ul>
            </div>
        </div>
        </nav>

    <!-- Chart -->

    <div class="card text-center m-5">
    <div class="card-header">

    <div style="text-align:right;" class="dropdown">
        <?php if (isset($user)): ?>
            <a class="btn btn-success btn-sm" href="#user-chart">+ Add your chart</a>
        <?php else: ?>
            <button class="btn btn-secondary btn-sm" disabled>Log in to add Chart</button>
        <?php endif; ?>

        <?php if (isset($user)): ?>
        <button id="addDataButton" class="btn btn-primary btn-sm">Add Data</button>
        <?php else: ?>
            <button class="btn btn-secondary btn-sm" disabled>Log in to Add Data</button>
        <?php endif; ?>
    </div>
    
    <h2 style="font-size:20px;">Alcohol Chart per Country</h2>
    </div>
        <canvas id="myChart"></canvas>
    </div>

    <!-- Log in / Out Handling -->
    
    <?php if (isset($user)): ?>
        
        <p style="margin-top: 24px; margin-right: 130px;position:absolute;top:0;right:0;">Welcome to our dashboard, <?= htmlspecialchars($user["name"]) ?>!</p>
        
        <p style="margin-top: 17px; margin-right: 30px;position:absolute;top:0;right:0;"><a href="logout.php" class="btn btn-outline-danger">Log out</a></p>
        
    <?php else: ?>
        
        <p style="margin-top: 20px; margin-right: 30px;position:absolute;top:0;right:0;"><a class="btn btn-outline-primary btn-sm" href="login.php">Log in</a> or <a class="btn btn-outline-primary btn-sm" href="signup.html">Sign up</a></p>
        
    <?php endif; ?>

    <div id="user-chart" class="card text-center m-5">
    <div class="card-header">
    <h2>User Generated Chart</h2>
    <?php if (isset($user)): ?>
        <input class="form-control form-control-sm" type="file" id="upload-csv" accept=".csv" style="width: 300px; text-align:center; display: inline-block;">
    <?php else: ?>
        <input class="form-control form-control-sm" type="file" style="width: 300px; text-align:center; display: inline-block;" disabled>
    <?php endif; ?>
    <div id="main" style="padding-top:100px; width: 1800px;height:800px;"></div>

    <!-- About Modal -->

    <div class="modal fade" id="about" tabindex="-1" aria-labelledby="aboutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aboutModalLabel">About me</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                My Student ID: 100675715 <br>
                My College Email: 100675715@unimail.derby.uk.ac <br>
                This is a test website made for a college assignment
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>


    <!-- Delete account Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <?php if (isset($user)): ?>
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
    <?php else: ?>
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Warning!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                You need an account to do that
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Okay</button>
            </div>
            </div>
    <?php endif; ?>
    </div>

    <!-- Account Modal -->

    <div class="modal fade" id="accountModal" tabindex="-1" aria-labelledby="accountModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="accountModalLabel">My Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Your Username: <?= htmlspecialchars($user["name"]) ?></p>
                <p>Your Email: <?= isset($user["email"]) ? htmlspecialchars($user["email"]) : "" ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Delete user account -->

    <script>
        document.getElementById("deleteButton").addEventListener("click", function() {
                window.location.href = "delete-account.php"; // Redirects the user to the delete-account.php script which deletes the user from our database
        });
    </script>

    <!-- Username Change -->

    <script>
    document.getElementById("changeUsername").addEventListener("click", function() {
        var newUsername = prompt("Enter new username:");

        if (newUsername !== null && newUsername !== "") {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "change-username.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle response, if needed
                    location.reload(); // Refresh the page after username change
                }
            };
            xhr.send("new_username=" + encodeURIComponent(newUsername));
        }
    });
    </script>

    <script>
        function toggleTheme() {
            var htmlElement = document.querySelector("html");
            var currentTheme = htmlElement.getAttribute("data-bs-theme");

            // Toggle between "dark" and "light" themes
            var newTheme = (currentTheme === "dark") ? "light" : "dark";
            
            // Update the data-bs-theme attribute
            htmlElement.setAttribute("data-bs-theme", newTheme);
        }
    </script>

    <script>
        document.getElementById("addDataButton").addEventListener("click", function() {
        // Call a function to add data to the database
        addDataToDatabase();

        async function addDataToDatabase() {

        const newCountry = prompt("Enter the country:");
        const newAlcohol = parseFloat(prompt("Enter the alcohol consumption:"));
        if (newCountry === '' || isNaN(newAlcohol)) {alert("No value"); return}
            const apiUrl = "../api/create.php"; // URL to API endpoint for adding data
            const data = { Country: newCountry, Alcohol: newAlcohol };

            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });

            if (response.ok) {
                // If data added successfully, reload the chart with updated data
                await getData();
                alcoholChart();
            } else {
                alert("Failed to add data. Please try again.");
            }
        
    }

    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>    
    <script src="app.js"></script>
    <script src="userchart.js"></script>
</body>
</html>