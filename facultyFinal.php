<!DOCTYPE html>

<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300" rel="stylesheet">
<?php

$servername = "";
$username = "";
$password = "";
$dbname = "";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}


 ?>

<link rel="stylesheet" media="screen" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript"  src="jquery.js"></script>
<script>
setInterval(function(){
		$('#faculty div:first-child').fadeOut(3000)
		 .delay(5000)
		 .next('div').fadeIn(3000)
		 .delay(1000)
		 .end().appendTo('#faculty');},
		 12000);
</script>
<style = “text/css”>

#particles-js
{
	width: auto;
	overflow: hidden;
	top: -220px;
	margin-left: auto;
	margin-bottom: -500px;
}

.heading
{

	font-family: 'Roboto', sans-serif;
	font-size: 180px;
	color: #f9f9ea;
	z-index: 1;
	top: -10px;
	right: 20px;
	text-align: center;
	padding-right: 60px;
	letter-spacing: 5px;
	font-weight: 100;
}

#leftHeadingLine
{
	width: 305px;
	height: 50px;
	border-bottom: 7px solid;
	left: 195px;
	top: -157px;
	z-index: 1;
	color: #f9f9ea;
	opacity: 0.4;
}

#rightHeadingLine
{
	width: 305px;
	height: 50px;
	border-bottom: 7px solid;
	left: 1152px;
	top: -214px;
	z-index: 1;
	color: #f9f9ea;
	opacity: 0.4;
}

.page
{
	margin: auto;
}

#faculty
{
	margin: auto;
}

table
{
	width: 100%;
	position: fixed;
	bottom: -60px;
	overflow: hidden;
}

.cellw
{
	width: 33.33%
}

th,td
{
	padding-left: 125px;

	font-size: 15px
}

.pname
{

	font-family: 'Roboto', sans-serif;
	font-size: 30px;
	font-weight: 100;
	color: #f9f9ea;
}

img
{
		border-radius: 70%;
		width: 135px;
		height: 135px;

}

div
{
		margin-left: 150px;
		position: relative;
		top: -110px;
		color: #f9f9ea;
		letter-spacing: 1px;
		line-height: 122%;
		font-family: 'Roboto', sans-serif;
		font-weight: 300;

}


body {
      animation: colorchange 50s infinite;
      -webkit-animation: colorchange 50s infinite;
			background: url("squarebg.png"),
			url("squarebg.png");
    }


    @keyframes colorchange
    {


			0%  {background-color: #007FA5;}
      16.6%  {background-color: #00807F;}
			33.2%  {background-color: #0a8eab;}
      49.8%  {background-color: #077C83;}
      65% {background-color: #852459;}
			75% {background-color: #a360a3;}
			82%  {background-color: #734E84;}
      95% {background-color: #0087A5;}
			100% {background-color: #007FA5;}
    }

    @-webkit-keyframes colorchange /* Safari and Chrome - necessary duplicate */
    {

			0%  {background-color: #007FA5;}
      16.6%  {background-color: #00807F;}
			33.2%  {background-color: #0a8eab;}
      49.8%  {background-color: #077C83;}
      65% {background-color: #852459;}
			75% {background-color: #a360a3;}
			82%  {background-color: #734E84;}
      95% {background-color: #0087A5;}
			100% {background-color: #007FA5;}
    }

</style>
</head>

<body onload="$('#faculty div.page:gt(0)').hide();">
	<div class = "heading">Faculty</div>
	<div id="leftHeadingLine"></div>
	<div id="rightHeadingLine"></div>
	<div id="particles-js"></div>

 <!-- scripts -->
 	<script src="particles.js"></script>
 	<script src="app.js"></script>





<div id="faculty">

	<?php


	$sql = "SELECT * FROM facstaff WHERE type = 'faculty' AND showHide = 'show' ORDER BY lname ASC";
	$result = $conn->query($sql);

	$profCount = $result->num_rows;

	$extraProfs = $profCount % 12;
	$profs = $profCount - $extraProfs;
	$pages = $profs / 12;
	if($extraProfs > 0)
	{
		$pages++;
	}

	$rows = 4;
	$cols = 3;

	for($i = 1; $i <= $pages; $i++)
	{
		echo "<div class = \"page\"><table>";

		for($j = 1; $j <= $rows; $j++)
		{
		  echo "<tr>\n";
		  for($k = 1; $k <= $cols; $k++)
		  {
				$currProf = $result->fetch_assoc();

				if($currProf["fname"] != "")
				{
					echo "<td class=\"cellw\"><img src=\"".$currProf["picture"]."\">\n";
				}
				else
				{
					echo "<td class=\"cellw\"><img>\n";
				}
				echo "<div><span class=\"pname\">".$currProf["fname"]." ". $currProf["lname"]."</span><br>\n";
				echo $currProf["title1"]."<br>\n";
				if ($currProf["title2"] != "")
				{
					echo $currProf["title2"]."<br>\n";
				}
				echo $currProf["email"]."<br>\n";
				echo $currProf["office1"]. " ". $currProf["phone1"]."<br>\n";
				if ($currProf["office2"] != "")
				{
					echo $currProf["office2"]." ";
				}
				if ($currProf["phone2"] != "")
				{
					echo $currProf["phone2"];
				}
				echo "</td></div>\n\n";
		  }
		  echo "</tr>\n";
		}
		echo "</table></div>\n";
	}
	?>
</div>
</body>
</html>
