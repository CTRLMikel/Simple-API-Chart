<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="forgot.css">
</head>
<body>

    <form method="post" action="send-password-reset.php">
        <h1>Forgot Password</h1>
        
        <label for="email">Enter your E-mail</label>
        <input type="email" name="email" id="email">

        <button>Send link</button>
        <p style="text-align:center; padding-top: 15px; color:orange">Forgotten your password? Don't worry!</p>
    </form>

</body>