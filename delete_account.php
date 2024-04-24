<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<?php
require_once('mysql_connection.php');

session_start();
if (!isset($_SESSION["id"]) || $_SESSION["id"] == '') {
    header('location: index.php');
}

$id = $_GET['id'];

if ($id == 1) {
    echo '<script>alert("Deleting this account is not allowed!")</script>';
    echo '<script>window.location="view_accounts.php"</script>';
} else {
    $query = "SELECT * FROM accounts where id = '$id'";
    $result = mysqli_query($bd, $query);

    // Check if there is a row with the given ID
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $getfirstname = $row['firstname'];
        $getlastname = $row['lastname'];
        $getusername = $row['username'];
        $getpicture = $row['picture'];

        if (isset($_POST['yes'])) {
            $deletequery = "DELETE FROM accounts WHERE id = '$id'";
            mysqli_query($bd, $deletequery);
            echo '<script>alert("Data successfully deleted!");</script>';
            echo '<script>window.location="view_accounts.php"</script>';
        }

        if (isset($_POST['no'])) {
            echo '<script>window.location="view_accounts.php"</script>';
        }
    } else {
        echo '<script>alert("Account not found!");</script>';
        echo '<script>window.location="view_accounts.php"</script>';
    }
}
?>
<body style="background-color: skyblue;">
    <center>
        <table width="40%" style="border: 4px solid #0909da;border-style: inset;border-radius: 10px;background-color: white;">
            <tr>
                <td>
                    <center>
                        <form action="" method="post">
                            <table width="100%">
                                <tr>
                                    <th width="50%" colspan="2"><img src="images/<?php echo "$getpicture"; ?>" style="width: 25%; height: 100px;background-color: #f9f5f5;border: 2px solid black;"></th>
                                </tr>
                                <tr>
                                    <th width="50%">Name: </th>
                                    <td><strong><?php echo "$getfirstname $getlastname"; ?></strong></td>
                                </tr>
                                <tr>
                                    <th>Username: </th>
                                    <td><strong><?php echo $getusername; ?></strong></td>
                                </tr>
                                <tr>
                                    <th colspan="2" style="border-top: 2px solid black; padding: 10px 0px;">
                                        <font style="font-size: 20px"><strong>Are you sure you want to delete this data?</strong></font>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        </br>
                                        <input type="submit" name="yes" value="YES" style="padding: 5px 30px;font-size: 12px;font-weight: bold;border-radius: 3px;border: 2px solid crimson;background-color: skyblue;color: white;">&nbsp;&nbsp;
                                        <input type="submit" name="no" value="NO" style="padding: 5px 30px;font-size: 12px;font-weight: bold;border-radius: 3px;border: 2px solid crimson;background-color: skyblue;color: white;">
                                        </br>
                                    </th>
                                </tr>
                            </table>
                        </form>
                    </center>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>
