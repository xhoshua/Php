<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Tut</title>
</head>
<body>
<form action="register.php" method="post">
    <label>First Name:</label>
    <input type="text" name="first_name"/><br>
    <label>Last Name:</label>
    <input type="text" name="last_name"/><br>
    <label>Email:</label>
    <input type="text" name="email"/><br>
    <label>Password:</label>
    <input type="text" name="password"/><br>
    <label>Confirm Password:</label>
    <input type="text" name="confirm_password"/><br>
    <input type="submit" name="Submit_Register"/><br>
</form>
<?php
include('connection.php');
if (isset($_POST['Submit_Register'])) {
    $errorCount = 0;
    $firstName = $_POST['first_name'];
    if (empty($firstName)) {
        $errorCount++;
        echo 'Emri duhet te vendoset';
    }
    $email = $_POST['email'];
    if (empty($email)) {
        $errorCount++;
        echo 'Email eshte i detyrueshem';
    }
    // TODO: validimet e atributeve

    if ($errorCount === 0) {
        // TODO:query i insert
        echo "Useri u regjistrua me sukses";
    }
}
?>
</body>
</html>