<!-- index.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<style>  footer {
        position: fixed;
        bottom: 0;
        right: 0;
        margin: 10px;
        display: flex;
        align-items: center;
    }

    footer img {
        margin-right: 10px;
    } 
    </style>
<body>
    <h2>Login</h2>
    <form action="viewcontract.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>

    <footer>
    <img src="logo.png" alt="" />
    <p>@CopyRight by DreamTeam</p>
</footer>
</body>
</html>