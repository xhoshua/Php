<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Tut</title>
</head>
<body>
<?php
include ('connection.php');
?>
<?php
if (isset($_POST['Submit_User_Modify'])){
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
    } else if (!preg_match("/^[a-zA-Z-' ]*$/",$lastName)) {
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
    }
    if($errorCount===0){
        $query="UPDATE users SET first_name=:first_name,last_name=:last_name,email=:email WHERE id=:id limit 1";
        $stmt= $db->prepare($query);
        if ($stmt->execute([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $email,
            'id' => $_POST['id'],
        ])){
            echo "Useri u modifikua me sukses <br>";
        } else {
            echo "Provoje perseri";
        }
    }
}
?>
<?php
if (isset($_GET['action']) && $_GET['action']== 'delete_user'){
    $query="DELETE FROM users WHERE id=:id";
    $stmt= $db->prepare($query);
    $stmt->execute(['id' => $_GET['user_id']]);
    ?>
<?php } ?>
<?php
$query= "select id,first_name,last_name,email,created_at,updated_at from users";
$stmt= $db->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll();

?>
<table>
    <thead>
    <tr>
        <th> Nr</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php $number = 0;
        foreach ($users as $user){
            $number++;
            ?>
        <tr>
            <td><?= $number ?></td>
            <td><?=$user['first_name']?></td>
            <td><?=$user['last_name']?></td>
            <td><?=$user['email']?></td>
            <td><?=$user['created_at']?></td>
            <td><?=$user['updated_at']?></td>
            <td>
                <a href="users.php?action=modify_user&user_id=<?=$user['id']?>">Modify</a>
                <a href="users.php?action=delete_user&user_id=<?=$user['id']?>"> Delete </a>
            </td>
            </tr>
    <?php } ?>
    </tbody>

</table>
<?php


if(isset( $_GET['action']) && $_GET['action'] == 'modify_user'){
    $query="select id, first_name,last_name,email from users where id=:id limit 1";
    $stmt= $db->prepare($query);
    $stmt->execute(['id' => $_GET['user_id']]);
    $user= $stmt->fetch();
    ?>
<form method="post" action="users.php">
    <label>Modify <br></label>
    <input type="hidden" name="id" value="<?=$user['id']?>"/><br>
    <label>First Name</label>
    <input type="text" name="first_name" value="<?=$user['first_name']?>"/><br>
    <label>Last Name</label>
    <input type="text" name="last_name" value="<?=$user['last_name']?>"/><br>
    <label>Email</label>
    <input type="text" name="email" value="<?=$user['email']?>"/><br>
    <input type="submit" name="Submit_User_Modify"/><br>
</form>

<?php } ?>


</body>
</html>