<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Tut</title>
</head>
<body>
<?php
include ('connection.php');
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
            </td>
        </tr>
    <?php } ?>
    </tbody>

</table>
<?php
if(isset( $_GET['action']) && $_GET['action'] == 'modify_user'){
    $query="select first_name,last_name,email from users where id=:id limit 1";
    $stmt= $db->prepare($query);
    $stmt->execute(['id' => $_GET['user_id']]);
 $user= $stmt->fetch();
    ?>
<form method="get">
    <label>Modify <br></label>
<label>First Name</label>
    <input type="text" name="first_name" value="<?=$user['first_name']?>"/><br>
    <label>Last Name</label>
    <input type="text" name="last_name" value="<?=$user['last_name']?>"/><br>
    <label>Email</label>
    <input type="text" name="email" value="<?=$user['email']?>"/><br>
    <input type="submit" name="Submit_Changes"/><br>
</form>
<?php }?>
</body>
</html>