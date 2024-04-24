<?php
require_once('mysql_connection.php');
session_start();

// Set default value for $type if not set
$type = isset($_GET['usertype']) ? $_GET['usertype'] : 'ADMIN';
/*
$selectquery = "SELECT * FROM accounts WHERE usertype = '" . $type . "'";
$result = mysqli_query($bd, $selectquery);
while ($row = mysqli_fetch_array($result)) {
    $image = $row['picture'];
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    // Use prepared statement to prevent SQL injection
    $query = "SELECT id, username, password, usertype, picture FROM accounts WHERE username = ? AND usertype = ?";
    $stmt = mysqli_prepare($bd, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $type);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);

    // Check if a matching user is found
    if (mysqli_stmt_num_rows($stmt) > 0) {
        mysqli_stmt_bind_result($stmt, $id, $username, $storedPassword, $usertype, $picture);

        while (mysqli_stmt_fetch($stmt)) {
            // Check password based on user type
            if (($usertype == "ADMIN" && $password == "admin123") || ($usertype == "USER" && $password == "user123")) {
                $_SESSION["id"] = $id;
                if ($usertype == "ADMIN") {
                    header('location: view_accounts.php');
                } elseif ($usertype == "USER") {
                    header('location: view_records.php');
                }
            } else {
                echo "<script>alert('Incorrect Password!')</script>";
            }
        }
    } else {
        echo "<script>alert('Incorrect Username!')</script>";
    }

    mysqli_stmt_close($stmt);

}*/

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM accounts WHERE username = ?";
    $stmt = $bd->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
    // User found in the database
    $row = $result->fetch_assoc();
    $passwords = $row['password'];

    if ($passwords === $password) {
        // Password is correct
        $_SESSION['login'] = $row['id'];
        $_SESSION['Role'] = $row['usertype'];

        if ($_SESSION['Role'] == 'ADMIN') {
            header('Location: view_accounts.php?id='.$row['id']);
            exit();
        } else if ($_SESSION['Role'] == 'USER') {
            header('Location: view_records.php?id='.$row['id']);
            exit();
        }
    }
}

}
?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
    <style type="text/css">
        header img{
            width: 100%;
            height: 200px;
        }
    </style>
    
</head>

<body style="margin: 0">
    <header >
        <img src="images/SchoolBanner.png" alt="Banner Image" style="margin-top: 0;">
    </header>
    <center>
        <table width="25%">
            <tr>
                <th style="border: 4px solid #0909da;border-style: inset;border-radius: 10px;background-color: #88edfb;">
                    <center>
                        <form action="" method="post">
                            <table>
                                <tr>
                                    <font style="font-size: 25px;"><strong>LOGIN FORM</strong></font>
                                    </br>
                                    <font style="font-size: 15px;"><strong>(<?php echo $type; ?>)</strong></font>
                                    </br>
                                </tr>
                                <?php
                                if ($type == "ADMIN") {
                                ?>
                                    <tr>
                                        <td colspan="2"><center><img src="./images/adminpic.png" style="width: 30%; height: 30%;background-color: #f9f5f5;border: 2px solid black;"></center></td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <th>Username:</th>
                                    <td><input type="text" name="username" required></td>
                                </tr>
                                <tr>
                                    <th>Password:</th>
                                    <td><input type="password" name="password" required></td>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        </br>
                                        <input type="submit" name="submit" value="Login" style="border-radius: 4px;border-color: #ab9090; padding: 5px 15px;font-size: 15px;">
                                        <button style="border-radius: 4px;border-color: #ab9090; padding: 5px 0px;font-size: 15px;"><a href="index.php" style="text-decoration: none;cursor: default; padding: 5px 15px; color: black;">Back</a></button>
                                    </th>
                                </tr>
                            </table>
                        </form>
                    </center>
                    </br>
                    </br>
                </th>
            </tr>
        </table>
    </center>
</body>

</html>
