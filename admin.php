<html>
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	
	<?php 
	include_once 'config.php';


	if(true){

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
	}
	?>

</body>
</html>