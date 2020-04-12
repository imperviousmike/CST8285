<?php
function findOddEven(){
	$numEntered = $_POST['num'];
	$even = array();
	$odd = array();

	if(isset($numEntered) && $numEntered > 4 && $numEntered < 100){
		echo "Number entered: $numEntered </br>";
		for($i = 0;  $i <= $numEntered; $i++){
			if($i%2 == 0){
				$even[] = $i;
			}
			else{
				$odd[] = $i;
			}
		}
		echo "Even numbers: ";
		foreach ($even as &$value) {
			if( $value != end($even)) echo "$value, ";
			else  echo "$value";
		}
		echo "</br>Odd numbers: ";
		foreach ($odd  as &$value) {
			if( $value != end($odd)) echo "$value, ";
			else  echo "$value";
		}

	}
	else{
		echo "<font color=\"red\">Error: number has to be greater than 4 and less than 100</font>";
	}


}



?>


<!DOCTYPE html>
<html>
<head>
	<title>PHP to find Odd or Even number!</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
	<form action="" method="post">
		<div style="margin-top: 10px;" id="result">
			<h2>PHP to find Odd or Even number!</h2>
			Enter a number:  <input type="text" id="num" name="num" value="0" />
			<input type="submit" name="btn" value="find Odd or Even number">
		</div>


		<?php
		if(isset($_POST['btn']))
		{
			findOddEven();
		}

		?>
	</form>
</body>
</html>
