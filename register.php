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
    if (!preg_match("/^[a-zA-Z-' ]*$/",$firstName)) {
        echo 'Emri duhet vetem me shkronja dhe hapsira';
        $errorCount++;
    }
    $lastName = $_POST['last_name'];
    if (empty($lastName)) {
        $errorCount++;
        echo 'Mbiemri duhet te vendoset';
    }
    if (!preg_match("/^[a-zA-Z-' ]*$/",$firstName)) {
        echo 'Mbiemri duhet vetem me shkronja dhe hapsira';
        $errorCount++;
    }
    $email = $_POST['email'];
    if (empty($email)) {
        $errorCount++;
        echo 'Email eshte i detyrueshem';
        if(!filter_input(INPUT_POST,"email", FILTER_VALIDATE_EMAIL)){
            echo "Email isn't valid <br>";
            $errorCount++;
        }
    }
    // TODO: validimet e atributeve
      $password = $_POST['[password'];
    if(empty($password)){
        $errorCount++;
        echo  'Password esht i detyrushem';
    }
if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
    echo "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
  $errorCount++;}
    $confirm_password = $_POST[['confirm_password']];
    if(empty($confirm_password)){
        $errorCount++;
        echo  'Komfirmimi i password-it esht i detyrushem';
    }
    if ($_POST["password"] != $_POST["confirm_password"]) {
        echo 'Passwordi nuk esht i njejte';
        $errorCount++;
    }
    if ($errorCount === 0) {
        echo "Useri u regjistrua me sukses";
    }
}
?>
</body>
</html>