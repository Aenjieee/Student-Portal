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

$id = $_GET['id'];
$selectquery = "SELECT * FROM accounts WHERE id = '".$id."'";
$result = mysqli_query($bd, $selectquery);
while ($row = mysqli_fetch_array($result)) {
	$getfirstname = $row['firstname']; 
	$getlastname = $row['lastname']; 
	$getusername = $row['username']; 
	$getpassword = $row['password']; 
	$getusertype = $row['usertype'];
}

if(!isset($_FILES['image']['tmp_name']))
{
	echo "";
} else {

	$firstname = $_POST['firstname']; 
	$lastname = $_POST['lastname']; 
	$username = $_POST['username']; 
	$password = $_POST['password']; 
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
		$query = "UPDATE accounts SET firstname='".$firstname."',lastname='".$lastname."',username='".$username."',password='".$password."',picture='".$picture."' where id='".$id."'";
if(mysqli_query($bd, $query)) {
}

			{	
				echo "<script>alert('Data Successfully Edited!')</script>";
echo '<script>window.location="view_accounts.php"</script>';
			}
			

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
							<th style="border-bottom: 2px solid;padding: 5px 0px;">Update Account Information</th>
						</tr>
						<tr>
							<th width="50%" style="border-bottom: 2px solid;">
								<table width="100%">
									<tr>
										<th style="text-align: left;padding-left: 20px;" width="45%">Firstname: </th>
										<td><input type="text" name="firstname" value="<?php echo $getfirstname;?>" required></td>
									</tr>
									<tr>
										<th style="text-align: left;padding-left: 20px;">Lastname: </th>
										<td><input type="text" name="lastname" value="<?php echo $getlastname;?>" required></td>
									</tr>
									<tr>
										<th style="text-align: left;padding-left: 20px;">Username: </th>
										<td><input type="text" name="username" value="<?php echo $getusername;?>" required></td>
									</tr>
									<tr>
										<th style="text-align: left;padding-left: 20px;">Password: </th>
										<td><input type="password" name="password" value="<?php echo $getpassword;?>" required></td>
									</tr>
									<tr>
										<th style="text-align: left;padding-left: 20px;">Picture: </th>
										<td><input type="file" name="image" id="image" style="width: 85%;"></td>
									</tr>
								</table>
							</th>
						<tr>
							<th colspan="2" style="padding: 5px 0px;"><input type="submit" name="update" value="Update" style="width: 40%;padding: 5px 30px;font-size: 17px;font-weight: bold;border-radius: 3px;border: 2px solid crimson;"></th>
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