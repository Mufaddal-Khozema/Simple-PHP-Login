<script>
    const email = <?= json_encode($_POST['email'] ?? null) ?>;
    const password = <?= json_encode($_POST['password'] ?? null) ?>;
    const cpassword = <?= json_encode($_POST['cpassword'] ?? null) ?>;
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
</head>
<body>
    <a href="home.php">Back</a>
    <a href="login.php">Login</a>
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="emal">Email: </label>
        <br>
        <input type="text" name="email" id="">
        <br>
        <br>
        <label for="password">Password: </label>
        <br>
        <input type="password" name="password" id="">
        <br>
        <br>
        <label for="password">Confirm Password: </label>
        <br>
        <input type="password" name="cpassword" id="">
        <br>
        <br>
        <input type="submit" value="Submit">
    </form>
<script src="handlers/signup.js"></script>
</body>
</html>