<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Tut</title>
</head>
<body>
<form action="index.php" method="post">
    <label>Email:</label>
    <input type="text" name="email"/><br>
    <label>Number 1:</label>
    <input type="text" name="num1"/><br>
    <label>Number 2:</label>
    <input type="text" name="num2"/><br>
    <label>Website:</label>
    <input type="text" name="website"/><br>
    <input type="submit" name="Submit"/><br>
</form>
<?php
if (isset($_POST["email"])){
if(!filter_input(INPUT_POST,"email", FILTER_VALIDATE_EMAIL)){
echo "Email isn't valid <br>";
} else{
echo "Email is valid<br>";
}
}
if(isset($_POST["num1"]) && !empty($_POST["num2"])){
    $num1 = filter_input(INPUT_POST,'num1',FILTER_SANITIZE_NUMBER_FLOAT,
    FILTER_FLAG_ALLOW_FRACTION);
    $num2 = filter_input(INPUT_POST,'num2',FILTER_SANITIZE_NUMBER_FLOAT,
        FILTER_FLAG_ALLOW_FRACTION);
    $output = sprintf("%.1f+%.1f=%.1f",$num1,$num2,($num1+$num2));
    echo htmlspecialchars($output) . '<br>';
    if(isset($_POST["website"])){
        $website = filter_input(INPUT_POST,'website',FILTER_VALIDATE_URL);
        echo 'Website:' . htmlspecialchars($website) . '<br>';
    }
}

$con_html = '<a href="#">Sample</a>';
echo $con_html . '<br>';
echo htmlspecialchars($con_html) . '<br>';
echo  strip_tags($con_html,'<a>') . '<br>';
$con_html = strip_tags($con_html) . '<br>';
echo $con_html . '<br>';
?>
</body>
</html>