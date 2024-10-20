<?php include 'database.php' ?>
<?php session_start(); ?> <!-- required everywhere where we have to use session variables -->
			  <!-- used to store variables which can be used in different pages -->
<?php
	// will store score of the candidate during the entire quiz
	if(!isset($_SESSION['score'])){
		$_SESSION['score']=0;
	}

	// check if form was submitted (via POST)  // in form submissions, we generally use POST method
	// if(isset($_POST['submit']){  // this didnt work
	if($_POST){
		$number= $_POST['number']; // to let form know we are on which question. value corresponding to name='number'	
		$selected_choice= $_POST['choice']; // value corresponding to name='choice'
		
		$next= $number + 1;

		// get total no of questions
		$query= "SELECT * FROM `questions`";
		$results= $mysqli->query($query) or die($mysqli->error.__LINE__);
		$total= $results->num_rows;

		// echo "PINK-PANTHER: " . $total;

		// get correct choice
		$query= "SELECT * FROM `choices` WHERE question_number=$number AND is_correct=1" ; // backticks are not quotes
		$result= $mysqli->query($query) or die($mysqli->error.__LINE__);
		$row= $result->fetch_assoc();

		// set correct choice
		$correct_choice= $row['id'];

		// compare with selected choice
		if($selected_choice==$correct_choice){
			$_SESSION['score']++;
		}
		
		

		// check if its the last que, then redirect to the final page
		if($number==$total){
			header("Location: final.php"); // redirect to this page
			exit();
		} else{
			header("Location: question.php?n=".$next);
			// exit();
		}
	}
