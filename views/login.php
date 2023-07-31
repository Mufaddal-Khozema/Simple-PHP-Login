<script>
    const email = <?= json_encode($_POST['email'] ?? null) ?>;
    const password = <?= json_encode($_POST['password'] ?? null) ?>;
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <a href="home.php">Back</a>
    <a href="signup.php">Signup</a>
    <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="emal">Email: </label>
        <br>
        <input type="text" name="email" value="<?= $_POST['email']??''; ?>" id="">
        <br>
        <br>
        <label for="password">Password: </label>
        <br>
        <input type="password" name="password" value="<?= $_POST['password']??''; ?>" id="">
        <br>
        <br>
        <input type="submit" value="Submit">
    </form>

</body>
<script src="handlers/login.js"></script>
</html>