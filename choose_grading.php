<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<?php
require_once('mysql_connection.php');

session_start();
if(!isset($_SESSION["id"]) || $_SESSION["id"] == '') 
{
	header('location: index.php');
}

if(isset($_POST['process'])){
	$grading = $_POST['grading'];
	header("location:add_student_grade.php?grading=$grading");
}
?>
<body>
	<center>
		<?php include('header.html');?>
		<?php include('teacher_header.php');?>
		</br>
		<form action="choose_grading.php" method="post">
			<table width="50%" cellspacing="0" style="border:3px solid #f35306;border-style: inset;">
				<tr>
					<th>
						<table width="100%" cellspacing="0">
							<tr>
								<th colspan="4" style="border-bottom: 1px solid;background-color: #f7b553;padding: 5px 0px;font-size: 45px;">Add Students Grade</th>
							</tr>
							<tr>
								<th width="33.3%" style="background-color: #f38b5a;border-bottom: 1px solid;padding: 5px 0px;">Choose Grading: </th>
								<th width="33.4%" style="background-color: #f38b5a;border-bottom: 1px solid;padding: 5px 0px;">
									<select name="grading">
										<option value="Prelim">Prelim</option>
										<option value="Midterm">Midterm</option>
										<option value="Pre_final">Pre_Final</option>
										<option value="Final">Final</option>
									</select>
								</th>
								<th style="background-color: #efb295;border-bottom: 1px solid;" width="33.3%">
									<input type="submit" name="process" value="Process" style="text-decoration: none;padding: 0px 15px;color: black;background-color: #abb5fb;border: 2px solid black;border-style: outset;border-radius: 5px;">
								</th>
							</tr>
						</table>
					</th>
				</tr>
			</table>
		</form>
	</center>
</body>
</html>