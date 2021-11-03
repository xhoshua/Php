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
    <input type="password" name="password"/><br>
    <label>Confirm Password:</label>
    <input type="password" name="confirm_password"/><br>
    <input type="submit" name="Submit_Register"/><br>
</form>
<?php
include('connection.php');
if (isset($_POST['Submit_Register'])) {
    $errorCount = 0;
    $firstName = $_POST['first_name'];
    if (empty($firstName)) {
        $errorCount++;
        echo 'Emri duhet te vendoset <br>';
    } else if (!preg_match("/^[a-zA-Z-' ]*$/",$firstName)) {
        echo 'Emri duhet vetem me shkronja dhe hapsira <br>';
        $errorCount++;
    }

    $lastName = $_POST['last_name'];
    if (empty($lastName)) {
        $errorCount++;
        echo 'Mbiemri duhet te vendoset <br>';
    } else if (!preg_match("/^[a-zA-Z-' ]*$/",$firstName)) {
        echo 'Mbiemri duhet vetem me shkronja dhe hapsira <br>';
        $errorCount++;
    }

    $email = $_POST['email'];
    if (empty($email)) {
        $errorCount++;
        echo 'Email eshte i detyrueshem';
    } else if(!filter_input(INPUT_POST,"email", FILTER_VALIDATE_EMAIL)){
        echo "Email isn't valid <br>";
        $errorCount++;
    } else {
        $query="select * from users where email=:email limit 1";
        $stmt= $db->prepare($query);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();
        if ($user) {
            echo "Ky email eshte regjistruar me pare! </br>";
            $errorCount++;
        }
    }

    $password = $_POST['password'];
    if(empty($password)){
        $errorCount++;
        echo  'Password esht i detyrushem <br>';
    } else if (!preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
        echo "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character. <br>";
        $errorCount++;
    }

    $confirm_password = $_POST['confirm_password'];
    if(empty($confirm_password)){
        $errorCount++;
        echo  'Komfirmimi i password-it esht i detyrushem <br>';
    } else if ($_POST["password"] != $_POST["confirm_password"]) {
        echo 'Passwordi nuk esht i njejte <br>';
        $errorCount++;
    }


    if ($errorCount === 0) {
        $hashedPassword = md5($password);
        $moment = date('Y-m-d H:i:s');
        $query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) 
                    VALUE (:first_name, :last_name, :email, :password, :created_at, :updated_at)";
        $stmt= $db->prepare($query);
        if ($stmt->execute([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'password' => $password,
            'created_at' => $moment,
            'updated_at' => $moment,
        ])) {
            echo "Useri u regjistrua me sukses <br>";
        } else {
            echo "ERROR! <br>";
        }
    }
}
?>
</body>
</html>