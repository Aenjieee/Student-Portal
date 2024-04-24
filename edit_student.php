<!DOCTYPE html>
<html>
<head>
    <title>Edit Student Information</title>
</head>
<?php
require_once('mysql_connection.php');
session_start();

if (!isset($_SESSION["id"]) || $_SESSION["id"] == '') {
    header('location: index.php');
}

$id = $_GET['id'];
$selectquery = "SELECT * FROM records WHERE id = '" . $id . "'";
$result = mysqli_query($bd, $selectquery);

while ($row = mysqli_fetch_array($result)) {
    $getfirstname = $row['firstname'];
    $getlastname = $row['lastname'];
    $getmi = $row['mi'];
    $getfirst = $row['prelim'];
    $getsecond = $row['midterm'];
    $getthird = $row['prefinal'];
    $getfourth = $row['final'];
}
?>

<body>
    <center>
        <form action="" method="post" enctype="multipart/form-data">
            <table width="30%" style="border: 4px solid #0909da;border-style: inset;border-radius: 10px;background-color: #c9e8ec;">
                <tr>
                    <th style="border-bottom: 2px solid;padding: 5px 0px;">Update Student Information</th>
                </tr>
                <tr>
                    <th width="50%" style="border-bottom: 2px solid;">
                        <table width="100%">
                            <tr>
                                <th style="text-align: left;padding-left: 20px;" width="45%">Firstname: </th>
                                <td><input type="text" name="firstname" value="<?php echo $getfirstname; ?>" required></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;padding-left: 20px;">Lastname: </th>
                                <td><input type="text" name="lastname" value="<?php echo $getlastname; ?>" required></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;padding-left: 20px;">Middle Initial: </th>
                                <td><input type="text" name="mi" value="<?php echo $getmi; ?>" maxlength="1" required></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;padding-left: 20px;">Picture: </th>
                                <td><input type="file" name="image" id="image" style="width: 85%;"></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;padding-left: 20px;">Prelim: </th>
                                <td><input type="text" name="prelim" value="<?php echo $getfirst; ?>" required></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;padding-left: 20px;">Midterm: </th>
                                <td><input type="text" name="midterm" value="<?php echo $getsecond; ?>" required></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;padding-left: 20px;">Pre-Final: </th>
                                <td><input type="text" name="prefinal" value="<?php echo $getthird; ?>" required></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;padding-left: 20px;">Final: </th>
                                <td><input type="text" name="final" value="<?php echo $getfourth; ?>" required></td>
                            </tr>
                        </table>
                    </th>
                </tr>
                <tr>
                    <th colspan="2" style="padding: 5px 0px;"><input type="submit" name="update" value="Update" style="width: 40%;padding: 5px 30px;font-size: 17px;font-weight: bold;border-radius: 3px;border: 2px solid crimson;"></th>
                </tr>
            </table>
        </form>
    </center>
</body>
</html>

<?php
if (isset($_POST['update'])) {
    // Your existing update logic here
    // Make sure to validate and sanitize user inputs before updating the database
}
?>
