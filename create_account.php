<!DOCTYPE html>
<html>
<head>
	<title>Create Teacher Account</title>
</head>
<?php
require_once('mysql_connection.php');
session_start();
if(!isset($_SESSION["id"]) || $_SESSION["id"] == '') 
{
	header('location: index.php');
}

if(!isset($_FILES['image']['tmp_name']))
{
	echo "";
} else {

	$firstname = $_POST['firstname']; 
	$lastname = $_POST['lastname']; 
	$username = $_POST['username']; 
	$password = $_POST['password']; 
	$usertype = "USER";
	$dir = "images/";
	$target_file = $dir.basename($_FILES["image"]["name"]);
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$file=$_FILES['image']['tmp_name'];
	$picture=$_FILES['image']['name'];
	if($picture == "")
	{
		echo "<script>alert('Please choose a picture!')</script>";
	} else {
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
	    	echo "<script>alert('PNG, JPG, and JPEG are allowed!')</script>";
		} else {
			$image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$image_name= addslashes($_FILES['image']['name']);
			move_uploaded_file($_FILES["image"]["tmp_name"], $dir . $_FILES["image"]["name"]);
			$query = "INSERT INTO accounts(id,firstname,lastname,username,password,picture,usertype) VALUES (null,'".$firstname."','".$lastname."','".$username."','".$password."','".$picture."','".$usertype."')";
			mysqli_query($bd, $query);
			echo "<script>alert('Data Successfully Saved!')</script>";
			echo '<script>window.location="view_accounts.php"</script>';
		}
	}
	
}
?>
<body>
	<center>
		<table width="30%">
			<tr>
				<td>
					<form action="" method="post" enctype="multipart/form-data">
					<center>
					<table style="border: 4px solid #0909da;border-style: inset;border-radius: 10px;background-color: #c9e8ec;">
						<tr>
							<th style="border-bottom: 2px solid;padding: 5px 0px;">Create Teacher Account</th>
						</tr>
						<tr>
							<th width="50%" style="border-bottom: 2px solid;">
								<table width="100%">
									<tr>
										<th style="text-align: left;padding-left: 20px;" width="45%">Firstname: </th>
										<td><input type="text" name="firstname" value="<?php echo '';?>" required></td>
									</tr>
									<tr>
										<th style="text-align: left;padding-left: 20px;">Lastname: </th>
										<td><input type="text" name="lastname" value="<?php echo '';?>" required></td>
									</tr>
									<tr>
										<th style="text-align: left;padding-left: 20px;">Username: </th>
										<td><input type="text" name="username" value="<?php echo '';?>" required></td>
									</tr>
									<tr>
										<th style="text-align: left;padding-left: 20px;">Password: </th>
										<td><input type="password" name="password" value="<?php echo '';?>" required></td>
									</tr>
									<tr>
										<th style="text-align: left;padding-left: 20px;">Picture: </th>
										<td><input type="file" name="image" id="image" value="<?php echo '';?>" style="width: 85%;"></td>
									</tr>
								</table>
							</th>
						<tr>
							<th colspan="2" style="padding: 5px 0px;"><input type="submit" name="save" value="Save" style="width: 40%;padding: 5px 30px;font-size: 17px;font-weight: bold;border-radius: 3px;border: 2px solid crimson;"></th>
						</tr>
					</table>
					</center>
					</form> 
				</td>
			</tr>
		</table>	
	</center>
</body>
</html>
