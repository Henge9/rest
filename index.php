<?php 
include_once 'config.php';


echo "<pre>";
$allowed_fields = ['name','phone','email','pincode'];
// name=a&phone=b&email=c&pincode=d&gender=e
foreach($_POST as $k => $v){
	if(in_array($k, $allowed_fields)){
		$fields[] = $k;
		$value = mysqli_real_escape_string($db, $v);
		$values[] = "'$value'";
	}
}
$sql_fields = implode(',',$fields);
$sql_values = implode(',',$values);
echo "
INSERT INTO users
($sql_fields)
VALUES
($sql_values)
";
// ================================
foreach($_POST as $k => $v){
	if(in_array($k, $allowed_fields) && $v != ''){
		$value = mysqli_real_escape_string($db, $v);
		$keyvalues[] = "$k = '$value'";
	}
}
$sql_keyvalues = implode(',',$keyvalues);
echo "
UPDATE users
SET $sql_keyvalues
";

?>


<form method="post">
name <input type="text" name='name'><br>
phone <input type="text" name='phone'><br>
email <input type="text" name='email'><br>
pincode <input type="text" name='pincode'>
<br>
gender <input type="text" name='gender'>
<input type='submit'>
</form>

