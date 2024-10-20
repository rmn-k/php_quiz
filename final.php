<?php
	// starting session to access session variable
	session_start();
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
				<h2>The test is completed.</h2>
				<p>Final Score: <?php echo $_SESSION['score'] ?></p>
				<a href="question.php?n=1" class="start">Retake test</a>
			</div>
		</main>

		<footer>
			<div class="container">
				Sample Copyright &copy; 2024, PQuiz
			</div>
		</footer>
	</body>
</html>
<?php
	// destroying session at end to reset session variables
	session_destroy();
?>
