<?php
	include 'database.php';
	// we have $mysqli object created in database.php, ie our connection with database has been established
?>
<?php session_start(); ?>
<?php

	// related to questions table - - - - 
	$number= (int) $_GET['n'];  // current question number
	$query= "SELECT * FROM `questions` WHERE question_number=$number";
	$result= $mysqli->query($query) or die($mysqli->error.__LINE__); // we will only get one record, because, we have selected by que id
	$question= $result->fetch_assoc();  // we get requested data in form of associative array

	// related to options table - - - -
	$query2= "SELECT * FROM `choices` WHERE question_number=$number";
	$result2= $mysqli->query($query2) or die($mysqli->error.__LINE__); // we will get many recoreds


	$query3= "SELECT * FROM `questions`";
	$result3= $mysqli->query($query3) or die($mysqli->error.__LINE__);
	$total= $result3->num_rows;

	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>PQuiz</title>
		<link rel="stylesheet" href="css/style.css" />
	</head>
	
	<body>
		<header>
			<div class="container">
				<h1>PQuiz</h1>
			</div>
		</header>	
		
		<main>
			<div class="container">
			<div class="current">Question <?php echo $question['question_number']; ?> of <?php echo $total; ?></div>
				<p class="question"> <!-- make sure that the link is something like: ...question?n=1 -->
					<?php echo $question['text']; ?>
				</p>
				<form method="post" action="process.php">
					<ul class="choices">
						<?php while($row = $result2->fetch_assoc()): ?>
							<li><input type="radio" name="choice" value="<?php echo $row['id']; ?>" /> <?php echo $row['text'] ?> </li>
						<?php endwhile; ?>
					</ul>
					<input type="submit" value="Confirm" />
					<input type="hidden" name="number" value="<?php echo $number; ?>" />
				</form>
			</div>
		</main>

		<footer>
			<div class="container">
				Sample Copyright &copy; 2024, PQuiz
			</div>
		</footer>
	</body>
</html>

