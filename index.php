<?php 
include_once 'config.php';


//writes the url /rest/tablename/column/id into $fullurl
$fullurl = $_SERVER['REQUEST_URI']; 
echo $fullurl;
echo '<br>';
//makes a array of the url
$url_parts = explode('/', $fullurl);
//split the aray up for easyer understanding of the code
$tablename = $url_parts[2];
//$columns = $url_parts[3];
//$column_sort = $url_parts[4];
//$value = $url_parts[5];

/*=============================
Please note that the request method 
shall not be confused with $_POST and $_GET from 
forms in HTML....
HTTP:	|CRUD:	|mySQL:
GET		|READ	|SELECT
PUT		|UPDATE	|UPDATE
POST	|CREATE	|INSERT INTO
DELETE	|DELETE	|DELETE
===============================*/
$method = $_SERVER['REQUEST_METHOD'];

//switch to make correct SQL query
switch ($method) {
	/*==========================
	GET example:
	/rest/tablename
	
	============================*/
	case 'GET':
		$query = 
			"SELECT 'columns'
			FROM $tablename
			WHERE 'column_sort value'";
		echo $query;
		break;
	
	default:
		echo "crap";
		break;
}
echo $method;
/*


*/