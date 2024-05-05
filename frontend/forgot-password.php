<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/kimeiga/bahunya/dist/bahunya.min.css">
</head>
<body>

    <h1>Forgot Password</h1>
    <p style="color:orange">Forgotten your password? Don't worry!</p>

    <form method="post" action="send-password-reset.php">

        <label for="email">Enter your E-mail</label>
        <input type="email" name="email" id="email">

        <button>Send link</button>

    </form>

</body>