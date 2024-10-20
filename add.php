<?php
	include 'database.php';

	// check if submit button was pushed in the below form, and then take extra steps
	if(isset($_POST['submit'])){
		// echo 'Submit was clicked';
		
		// get POST variables
		$question_number= $_POST['question_number'];
		$question_text= $_POST['question_text'];
		


		$choices= array();
		$choices[0]= $_POST['choice1'];
		$choices[1]= $_POST['choice2'];
		$choices[2]= $_POST['choice3'];

		// query to insert data into 'questions' table
		$query= "INSERT INTO `questions` (question_number, text)
				VALUES('$question_number', '$question_text')"; // question_number and text are column names in questions table of quizzer database
		$insert_row= $mysqli->query($query) or die($mysql->error.__LINE__);

		// validate that data related to question was inserted
		if($insert_row){
			// iterating over each choice for the given question
			foreach($choices as $choice => $value){
					    // 0-->$_POST['choice1'] 
				if($value!=''){
					if($correct_choice== $choice){
						$is_correct=1;
					}
					else{
						$is_correct=0;
					}
					// query for choice
					$query= "INSERT INTO `choices` (question_number, is_correct, text)
							VALUES('$question_number', '$is_correct', '$value')";
					$insert_row= $mysqli->query($query) or die($mysqli->error.__LINE__);
				
					// validate insert
					if($insert_row){
						continue;
					} else{
						die("Error : " . $mysqli->errno . " " . $mysqli->error);
					}
				}
			}
			$msg= "Question has been added.";

		}
	}
	
	$query= "SELECT * FROM 	`questions`";
	$result= $mysqli->query($query) or die($mysqli->error.__LINE__);
	$total= $result->num_rows;
	$next= $total+1;
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>QuizMaster</title>
		<link rel="stylesheet" href="css/style.css" />
	</head>
	
	<body>
		<header>
			<div class="container">
				<h1>QuizMaster</h1>
			</div>
		</header>	
		
		<main>
			<div class="container">
				<h2>Add a question</h2>
				<?php
					if(isset($msg)){
						echo '<p>' . $msg . '</p>';
					}
				?>
				<form method="POST" action="add.php"> <!-- the response of this form is being sent to `add.php` itself -->
					<p>
						<label>Question Number: </label>
						<input type="number" value="<?php echo $next; ?>" name="question_number" />
					</p>
					<p>
						<label>Question Text: </label>
						<input type="text" name="question_text" />
					</p>
					<p>
						<label>Choice #1: </label>
						<input type="text" name="choice1" />
					</p>
					<p>
						<label>Choice #2: </label>
						<input type="text" name="choice2" />
					</p>
					<p>
						<label>Choice #3: </label>
						<input type="text" name="choice3" />
					</p>
					
					<!--
					<p>
						<label>Choice #4: </label>
						<input type="text" name="choice4" />
					</p>
					-->

					<p>	
						<label>Correct Choice Number: </label>
						<input type="number" name="correct_choice" />
					</p>
					<p>
						<input type="submit" name="submit" value="Submit" />
						<!-- upon filling the form, data that is sent for this line is: $_POST['x']='y'  , where, 'x' is value of name attribute ( 'submit' ), and 'y' is value of value attribute ( 'Submit' ) -->
					</p>
				</form>
			</div>
		</main>

		<footer>
			<div class="container">
				Sample Copyright &copy; 2024, QuizMaster
			</div>
		</footer>
	</body>
</html>

