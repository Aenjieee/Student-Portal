<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
			background-color: #f0f0f0;
		}

		header img{
			width: 100%;
			height: 200px;
		}
		table {
			width: 25%;
			height: 200px;
			border: 4px solid #4361b7;
			border-radius: 10px;
			background-color: #4361b7;
			border-style: inset;
		}
		#panel{
			justify-content: center;
		}

		th {
			width: 80%;
			padding: 20px;
		}

		a {

			text-decoration: none;
			background-color: #6cf1de;
			border-style: outset;
			border: 2px solid gray;
			border-radius: 5px;
			padding: 20px 40px;
			color: black;
			font-size: 15px;
		}

		a:hover {
			background-color: #48c68e;
			border-color: #3c8653;
		}
	</style>
</head>
<body>
	<center>
		<header >
        <img src="images/Banner.jpeg" alt="Banner Image">
    </header>
		<br>
		<table>
			<tr>
				<th id="panel">
					
					<font>
						<a href="login.php?usertype=ADMIN">ADMIN</a>
					</font>
					
					<font>
						<a href="login.php?usertype=USER">USER</a>
					</font>
					
				</th>
			</tr>
		</table>
	</center>
</body>
</html>
