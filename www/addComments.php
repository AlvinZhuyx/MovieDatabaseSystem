<html>
<head>
  <title> Add Comments to Movie </title>
  <style type = "text/css">
  .requirement{color:red; font-size:small}
  .reminder{font-size:small}
  .error{color:red; font-size:x-large; font-weight:bold}
  </style> 
</head>
<h2>Please add the comments here! </h2>

<body>
<form method = "GET" action = ""><br>
	<span class = "reminder">Don't know the exact name of the movie?</span>
	<br>
	<span class = "reminder">No worry, just type in what you know, and select in the box below!</span>
	<br>
	<br>Search Movie:<br>
	<input type = "text" name = "searchMovie">
	<input type = "submit" name = "submitMovie" value = "show results">
	<?php
		$movie = $_GET["searchMovie"];
		if($movie != ""){
			$db_connection = mysql_connect("localhost", "cs143", "");
			
			mysql_select_db("CS143", $db_connection);
			$queryMovie = "select id, title, year from Movie where title like \"%$movie%\" order by title;";
			$resMovie = mysql_query($queryMovie, $db_connection);
		}
	?>
</form>



<form method = "POST" action = "addComments.php">
	
	<span class = "requirement"> required information*</span><br>
	<br>Choose Movie<br>
	<select class="form-control" name = "mid">
		<?php
			while($row = mysql_fetch_assoc($resMovie))
				echo '<option value=' . $row['id'] .'>'.$row['title'].'('.$row['year'].')</option>';
		?>
	</select>
	<span class = "requirement">*</span><br>

	<br>Rating<br>
	<select name = "rating">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
	</select>
	<span class = "requirement">*</span><br>

	<br>Comment<br>
	<input type = "text" name = "comment">
	<br><span class = "reminder"> Not required, but you are welcome to leave any comment!</span><br>
	<br>Your Name<br>
	<input type = "text" name = "userName">
	<br><br>

	<input type = "submit" name = "submit" value = "Add!">
</form>
</body>

<?php
	#required fields:
	# mid, 
	# at least one should be not null: rating, comment
	$error = 0;
	$eMsg = "";
	$comment = "";
	$userName = "N/A";
	$noComment = 0;

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$timeStamp = date('Y-m-d G:i:s');
		
		//if(!empty($_GET["mid"]))
			$mid = $_POST["mid"];
		//else{
		//	$error = 1;
		//	print 'Please specify the Movie id<br>';
		//	exit(1);
		//}
		
		if(!empty($_POST["userName"]))
			$userName = $_POST["userName"];

		if(!empty($_POST["rating"]))
			$rating = $_POST["rating"];
		else{
			$error = 1;
			print 'Please specify the rating<br>';
			exit(1);
		}

		if(!empty($_POST["comment"]))
			$comment = $_POST["comment"];
	}

	if($error == 0 && $_SERVER["REQUEST_METHOD"] == "POST"){
		$query = "insert into Review
					values(\"$userName\", \"$timeStamp\", $mid, $rating, \"$comment\");";
		$db_connection = mysql_connect("localhost", "cs143", "");
		mysql_select_db("CS143", $db_connection);
		//print $query;
		$res = mysql_query($query, $db_connection) or print 'Fail<br>';
		mysql_close($db_connection);
		print 'Success!<br>';
	}
?>

</html>