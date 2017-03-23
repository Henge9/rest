<html>
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	
	<?php 
	//error_reporting(E_ALL & ~E_NOTICE);
	
	include_once 'config.php';
	
	$error="";
	//logout
	if (isset($_POST['log_out'])) {
		
		$_SESSION= array();
		$params = session_get_cookie_params();
    	setcookie(session_name(), '', time() - 42000,
        	$params["path"], $params["domain"],
        	$params["secure"], $params["httponly"]
    	);

	}
	
	/*===============================
		Login check password
	=================================*/
	if (isset($_POST['password'])) {
		//$salt = "$2a$04$l4cQKFAB9o56tgURYYMtIt";
		$username=mysqli_real_escape_string ($db, $_POST['username']);
		$password=mysqli_real_escape_string ($db, $_POST['password']);

		$query="
			SELECT password FROM users
			WHERE username='$username';
		";
		$result = mysqli_query($db, $query);
		$from_db = mysqli_fetch_assoc($result);
		$pw_from_db = $from_db['password'];
		//$password = 'admin';
		$hashed_password = crypt($password, '$2a$04$l4cQKFAB9o56tgURYYMtIt');
		//$pw_from_db='$2a$04$l4cQKFAB9o56tgURYYMtIeg9kyR4..RZE/s9d5hg0GmCZ3ygQESYK';

		if (hash_equals($pw_from_db, $hashed_password)) {
			session_start();
			$_SESSION['admin'] = true;

		}else{
			$error = "Username or password not correct.";
			//$_SESSION['admin'] = false;
		}			
	}
	
	if(isset($_SESSION['admin']) || $_SESSION['admin']){

		echo "
			<form action='' method='post'>
				<input type='submit' value='Log out' name='log_out'>
			</form>
		";
		
		function showcards($db){
			$query = "SELECT * FROM us_cards";
			$result = mysqli_query($db, $query);
			echo "<div class='us-cards'>";
			echo "<h2>User stories</h2>";
			while($page = mysqli_fetch_assoc($result)){
				echo "
					<form action='' method='post'>
						<h3>Id: {$page['id']}</h3><input type='hidden' value='{$page['id']}' name='id'>
						<input type='hidden' value='us_cards' name='table'>
						<p> Number: <input class='input-text' type='text' name='number' value='{$page['number']}'></p>
						<p> Value: <input class='input-text' type='text' name='value' value='{$page['value']}'></p>
						<p>Analytics: <input class='input-text' type='text' name='analytics' value='{$page['analytics']}'></p>
						<p>Development: <input class='input-text' type='text' name='development' value='{$page['development']}'></p>
						<p>Test: <input class='input-text' type='text' name='test' value='{$page['test']}'></p>
						<br />
						<input type='submit' value='Save change' name='savepage'>
					</form>
					
				";
			}
			echo "</div>";

			$query = "SELECT * FROM m_cards";
			$result = mysqli_query($db, $query);
			echo "<div class='m-cards'>";
			echo "<h2>Maintanence</h1>";
			while($page = mysqli_fetch_assoc($result)){
				echo "
					<form action='' method='post'>
						<h3>Id: {$page['id']}</h1><input type='hidden' value='{$page['id']}' name='id'>
						<input type='hidden' value='m_cards' name='table'>
						<p>Number: <input class='input-text' type='text' name='number' value='{$page['number']}'></p>
						<p>Analytics: <input class='input-text' type='text' name='analytics' value='{$page['analytics']}'></p>
						<p>Development: <input class='input-text' type='text' name='development' value='{$page['development']}'></p>
						<p>Test: <input class='input-text' type='text' name='test' value='{$page['test']}'></p>
						<br />
						<input type='submit' value='Save change' name='savepage'>
					</form>
					
				";
			}
			echo "</div>";

			$query = "SELECT * FROM d_cards";
			$result = mysqli_query($db, $query);
			echo "<div class='d-cards'>";
			echo "<h2>Deviations</h2>";
			while($page = mysqli_fetch_assoc($result)){
				echo "
					<form action='' method='post'>
						<h3>Id: {$page['id']}</h3><input type='hidden' value='{$page['id']}' name='id'>
						<input type='hidden' value='d_cards' name='table'>
						<p>Number: <input class='input-text' type='text' name='number' value='{$page['number']}'></p>
						<p>Analytics: <input class='input-text' type='text' name='analytics' value='{$page['analytics']}'></p>
						<p>Development: <input class='input-text' type='text' name='development' value='{$page['development']}'></p>
						<p>Test: <input class='input-text' type='text' name='test' value='{$page['test']}'></p>
						<br />
						<input type='submit' value='Save change' name='savepage'>
					</form>
					
				";
			}
		}
		echo "</div>";
		
		if(isset($_POST['table'])){
			
			if (isset($_POST['value'])) {
				$value=mysqli_real_escape_string ($db, $_POST['value']);
			}

			$table=mysqli_real_escape_string ($db, $_POST['table']);
			$number=mysqli_real_escape_string ($db, $_POST['number']);
			$analytics=mysqli_real_escape_string ($db, $_POST['analytics']);
			$development=mysqli_real_escape_string ($db, $_POST['development']);
			$test=mysqli_real_escape_string ($db, $_POST['test']);
			$id=mysqli_real_escape_string ($db, $_POST['id']);
			
			if (strlen($number) == 1) {
				$number2="";
				$number2="0".$number;
			}else{
				$number2=$number;
			}

			if (isset($_POST['value'])) {
				$query="
				UPDATE $table
				SET number='$number2', 
					value=$value,
					analytics=$analytics, 
					development=$development, 
					test=$test
				WHERE id=$id 
			";
				
			}else{
				$query="
					UPDATE $table
					SET number='$number2', 
						analytics=$analytics, 
						development=$development, 
						test=$test
					WHERE id=$id 
				";
			}
			$result = mysqli_query($db, $query); 

		}
		showcards($db);
	}else{ 
		//login form
		echo "
			<form method='post'>
				<h3>Username:</h3><br />
				<input type='text' name='username'><br />
				<h3>Password:</h3><br />
				<input type='password' name='password'><br />
				<h3>When you push submit you accept the use of cookies</h3>
				<input type='submit' value='Submit'>
				<h3>$error</h3>
			</form>
		";
		

	}
	?>

</body>
</html>
<!--function generateSalt($max) {
		        $characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
		        $i = 0;
		        $salt = "";
		        while ($i < $max) {
		            $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
		            $i++;
		        }
		        echo "||";
		        echo $salt;
		        echo "||";
			}
			generateSalt('22');-->