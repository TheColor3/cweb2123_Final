<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<title>MtG Database</title>
	<style>
		body {
			background-color: #292525;
			color: #FFF;
		}
		.header {
			text-align: center;
			color: #FFF;
			font-family: Papyrus,fantasy;
		}
		.tables {
			display: block;
			float: left;
			color: #FFF;
			font-family: Papyrus,fantasy;
			width: 45%;
			border: solid #DB212C 2px;
			padding: 10px;
			line-height: 2;
			margin-bottom: 30px;
		}
		.tables input{
			margin-left: 30px;
			color: #000;
		}
		.tables h2 input{
			margin-left: 40%;
			margin-right: auto;
			background-color: #494242;
			color: #FFF;
			border-color: #FAB426;
			font-size: 70%;
			padding: 10px;
		}
	</style>
	<script>
		window.onload = function() {
			document.getElementbyID(tables).reset();
		}
	</script>
</head>
<body>
	<div class="container"> 

		<div class="header">
			<img src=images/mtg_logo.png width=40% height=40% style="margin-top: 25px; margin-left: auto; margin-right: auto;display: block;">
			<h2 style="text-align: center; margin-top:0px;">Database</h2>
		</div>
		<div class="tables">
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<h2>Card <input type="submit" value="Card Search"></h2>
			<p>
				Name: <input id="nameOfCard" name="nameOfCard" value=""><br>
				Color: <input id="card_color" name="card_color" list="colors" placeholder=""><datalist id="colors"><option value="Red"><option value="Blue"><option value="Green"><option value="White"><option value="Black"><option value="Colorless"></datalist><br>
				CMC: <input id="card_cmc" name="card_cmc" type="number" min="0" max="9" placeholder="-"><br>
			</p> <br>
			</form>
		</div>
		<div class="tables" style="margin-left: 5%;">
			<p id="cardlist">
				<?php
					include "database.php";

					$name = $_REQUEST['nameOfCard'];
					$color = $_REQUEST['card_color'];
					$cmc = $_REQUEST['card_cmc'];

					if($name != ''){
						if($color != ''){
							if($cmc != ''){
								echo "<p>Searching for cards fitting your requirements: ";
								echo"</p>";
								echo "<br>";
								$query="SELECT card_name FROM card WHERE card_name LIKE '%$name%' AND card_color LIKE '$color' AND card_cmc = '$cmc'";
								$stmt=$conn->prepare($query);
								$stmt->execute();
								while ($row=$stmt->fetch(PDO ::FETCH_ASSOC)){
									extract($row);
								echo"<tr>";
									echo"<td>{$card_name}</td>";
									echo "<br>";
								echo"</tr>";
								}
							}else{
								echo "<p>Searching for cards fitting your requirements: ";
								echo"</p>";
								echo "<br>";
								$query="SELECT card_name FROM card WHERE card_name LIKE '%$name%' AND card_color LIKE '$color'";
								$stmt=$conn->prepare($query);
								$stmt->execute();
								while ($row=$stmt->fetch(PDO ::FETCH_ASSOC)){
									extract($row);
								echo"<tr>";
									echo"<td>{$card_name}</td>";
									echo "<br>";
								echo"</tr>";
								}
							}
						}else if($cmc != ''){
							echo "<p>Searching for cards fitting your requirements: ";
							echo"</p>";
							echo "<br>";
							$query="SELECT card_name FROM card WHERE card_name LIKE '%$name%' AND card_cmc = '$cmc'";
							$stmt=$conn->prepare($query);
							$stmt->execute();
							while ($row=$stmt->fetch(PDO ::FETCH_ASSOC)){
								extract($row);
							echo"<tr>";
								echo"<td>{$card_name}</td>";
								echo "<br>";
							echo"</tr>";
							}
						}else{
							echo "<p>Searching by Name for: ";
							echo $name;
							echo"</p>";
							echo "<br>";
							$query="SELECT card_name FROM card WHERE card_name LIKE '%$name%' ";
							$stmt=$conn->prepare($query);
							$stmt->execute();
							while ($row=$stmt->fetch(PDO ::FETCH_ASSOC)){
								extract($row);
							echo"<tr>";
								echo"<td>{$card_name}</td>";
								echo "<br>";
							echo"</tr>";
							}
						}
					}else if($color != ''){
						if($cmc != ''){	
							echo "<p>Searching for cards fitting your requirements: ";
							echo"</p>";
							echo "<br>";
							$query="SELECT card_name FROM card WHERE card_color LIKE '$color' AND card_cmc = '$cmc'";
							$stmt=$conn->prepare($query);
							$stmt->execute();
							while ($row=$stmt->fetch(PDO ::FETCH_ASSOC)){
								extract($row);
							echo"<tr>";
								echo"<td>{$card_name}</td>";
								echo "<br>";
							echo"</tr>";
							}
						}else{
							echo "<p>Searching by Color for: ";
							echo $color;
							echo"</p>";
							echo "<br>";
							$query="SELECT card_name FROM card WHERE card_color LIKE '$color'";
							$stmt=$conn->prepare($query);
							$stmt->execute();
							while ($row=$stmt->fetch(PDO ::FETCH_ASSOC)){
								extract($row);
							echo"<tr>";
								echo"<td>{$card_name}</td>";
								echo "<br>";
							echo"</tr>";
							}
						}
					}else if($cmc != ''){
						echo "<p>Searching by Converted Mana Cost for: ";
						echo $cmc;
						echo"</p>";
						echo "<br>";
						$query="SELECT card_name FROM card WHERE card_cmc = '$cmc'";

						$stmt=$conn->prepare($query);
						$stmt->execute();
						while ($row=$stmt->fetch(PDO ::FETCH_ASSOC)){
							extract($row);
						echo"<tr>";
							echo"<td>{$card_name}</td>";
							echo "<br>";
						echo"</tr>";
						}						
					}else{
						echo"Place input into at least one of the relevant fields";
					}
				?>
			</p>
		</div>
	</div>
</body>
</html>