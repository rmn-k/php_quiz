<?php include 'database.php'; ?>
<?php
	// mysqli obj has been created in the included database.php file, we need to proceed further from there

	// trying to get total number of questions from the table, so that it can be dynamically displayed
	$query= "SELECT * FROM questions";
	$results= $mysqli->query($query) or die($mysqli->error.__LINE__); // contains all the rows from the table
	$total= $results->num_rows;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>PQuiz</title>
		<link rel="stylesheet" href="css/style.css" type="text/css" />
	</head>
	
	<body>
		<header>
			<div class="container">
				<h1>PQuiz</h1>
			</div>
		</header>	
		
		<main>
			<div class="container">
				<h2>Test your PHP knowledge</h2>	
				<p>This is a multiple choice, single correct quiz to test your knowledge of PHP</p>
				<ul>
					<li><strong>Number of questions: </strong><?php echo $total; ?></li>
					<li><strong>Type of quiz: </strong>Multiple Choice Single Correct</li>
					<li><strong>Estimated time: </strong><?php echo $total*.5; ?> Minutes</li>
				</ul>
				<a href="question.php?n=1" class="start">Start Quiz</a>
			</div>
		</main>

		<footer>
			<div class="container">
				Sample Copyright &copy; 2024, PQuiz
			</div>
		</footer>
	</body>
</html>

