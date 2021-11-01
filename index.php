<?php
$f_name="Xhoi";
$l_name="Muca";
$age=20;
$height = 1.83;
$can_vot=true;
$address = array('street'=>'liqeni', 'city'=>'tiran');
$state= NULL;
define('PI',3.1415);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP Tut</title>
</head>
<p>Name: <?php echo $f_name . '' .$l_name;?></p>
<form action="index.php" method="GET">
    <label>Your State:</label>
    <input type="text" name="state"/> <br>
    <label>Number 1:</label>
    <input type="text" name="num-1"/> <br>
    <label>Number 2:</label>
    <input type="text" name="num-2"/> <br>
    <input type="submit" value="Submit"/>
</form>
<?php
//if (isset($_GET) && array_key_exists('state',$_GET)){
if (isset($_GET['state'])){
    $state = $_GET['state'];
    if(!empty($state)){
        echo ' You live in '. $state. '<br>';
        echo "$f_name lives in $state <br>";
    }
    if(count($_GET)>=3){
        $num_1 = $_GET['num-1'];
        $num_2 = $_GET['num-2'];
        echo "$num_1 + $num_2 = " . ($num_1 + $num_2) . "<br>";
        echo "$num_1 - $num_2 = " . ($num_1 - $num_2) . "<br>";
        echo "$num_1 * $num_2 = " . ($num_1 * $num_2) . "<br>";
        echo "$num_1 / $num_2 = " . ($num_1 / $num_2) . "<br>";
        echo "$num_1 % $num_2 = " . ($num_1 % $num_2) . "<br>";
        echo "$num_1 / $num_2 = " . (intdiv($num_1,$num_2)) . "<br>";
        echo "Increment $num_1 = " . (intdiv($num_1++)) . "<br>";
        echo "Decrement $num_1 = " . (intdiv($num_1--)) . "<br>";
    }
}
$rand_str = " Random String  ";
printf("Length: %d <br>",strlen($rand_str));
printf("Length: %d <br>",strlen(ltrim($rand_str)));
printf("Length: %d <br>",strlen(rtrim($rand_str)));
$rand_str=trim($rand_str);
printf("Upper : %s<br>", strtoupper($rand_str));
printf("Lower : %s<br>", strtolower($rand_str));
printf("Upper : %s<br>", ucfirst($rand_str));
printf("1s 6 : %s<br>", substr($rand_str,0,6));
printf("Index: %s<br>",strpos($rand_str,"String"));
$rand_str =  str_replace("String", "Characters",$rand_str);
printf("Replace : %s <br>",$rand_str);
printf("A==B : %d <br>",strcmp("A","B"));

$friends = ['a' , 'b' , 'c'];
echo 'wife :'  .$friends[0] . '<br>';
$friends[3] = 'd';
foreach ( $friends as $f) {
printf("Friend: %s<br>",$f);
}
$me_info = ['Name'=>'derek' , 'street'=>'123'];
foreach ($me_info as $k=>$v) {
    printf("%s: %s<br>",$k,$v);
}
$friends2 = ['do'];
$friends = $friends + $friends2;
sort($friends);
rsort($friends);
arsort($me_info);
krsort($me_info);
$customers = [['do','123'],['so','122']];
for ($row =0; $row<2;$row++){
    for ($col=0;$col<2;$col++){
        echo  $customers [$row][$col] . ',';
        echo '<br>';
    }
}
$let_str = "A B C D";
$let_arr= explode(' ',$let_str);
foreach ($let_arr as $l){
    printf("Letter : %s<br>",$l);

}
$let_str_2= implode('',$let_arr);
echo "String :$let_str_2<br>";
printf("Key Exists : %d<br>",
array_key_exists('Name',$me_info));
printf("In Array : %d<br>", in_array('a',$friends));

$i = 0;
while ($i <10){
    echo ++$i . ',';
}
echo '<br>';
for ($i=0;$i <10; $i++){
    if (($i %2)==0){
        continue;
    }
    if ($i == 7)break;
    echo $i . ',';
}
echo '<br>';
$i=0;
do{
    echo "Do While : $i <br>";

}while($i > 0);

function addNumbers($num_1=0,$num_2){
    return $num_1 + $num_2;
}
printf("5+4 = %d<br>",addNumbers(5,4));
function changeMe(&$change){
    $change=10;
}
$change=5;
changeMe($change);
echo "Change: $change <br>";

function getSum(...$nums){
    $sum=0;
    foreach ($nums as $num){
        $sum+=$num;
    }
    return $sum;
}
printf("Sum %d <br>",getSum(1,2,3,4));
function doMath($x, $y){
    return array($x+$y, $x-$y);
}
list($sum,$difference)= doMath(5,4);
echo "Sum = $sum<br>";
echo "Difference=$difference<br>";


?>
<body>

</body>

</html>
