<?php
session_start();
require_once('mysql_connection.php');

if ($_SESSION['Role'] != 'ADMIN') {
    header('Location: index.php?error=Access denied');
    exit;
}

$id = isset($_GET['id']) ? $_GET['id'] : '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Teacher and Student Records</title>
    <style>
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            border: 2px solid #3498db;
            z-index: 1;
        }
        
        .logout-btn, .edit-btn, .delete-btn {
            text-decoration: none;
            padding: 0 15px;
            color: black;
            background-color: #3498db;
            border: 2px solid black;
            border-style: outset;
            border-radius: 5px;
        }
    </style>
</head>
<body>
	<th> <a href="dashboard.php"></th>

    <center>
        <!-- Teacher Accounts -->
        <form action="" method="POST">
            <table width="50%" cellspacing="0" style="border: 3px solid #3498db;border-style: inset;">
                <tr>
                    <th>
                        <table width="100%" cellspacing="0">
                            <tr>
                                <th colspan="6" style="border-bottom: 1px solid; background-color: #3498db; padding: 5px 0px;">Teachers Account</th>
                            </tr>
                            <tr>
                                <th style="background-color: #5eb8f7; border-bottom: 1px solid; padding: 5px 0px;">Picture</th>
                                <th style="background-color: #5eb8f7; border-bottom: 1px solid; padding: 5px 0px;">Name</th>
                                <th style="background-color: #5eb8f7; border-bottom: 1px solid; padding: 5px 0px;">Username</th>
                                <th style="background-color: #5eb8f7; border-bottom: 1px solid; padding: 5px 0px;">Type</th>
                                <th colspan="2" style="background-color: #5eb8f7; border-bottom: 1px solid; padding: 5px 0px;"></th>
                            </tr>
                            <?php
                            $query = "SELECT * FROM accounts ORDER BY id ASC";
                            $result = mysqli_query($bd, $query);
                            while ($row = mysqli_fetch_array($result)) {
                                $id = $row['id'];
                                $firstname = $row['firstname'];
                                $lastname = $row['lastname'];
                                $username = $row['username'];
                                $usertype = $row['usertype'];
                                $picture = $row['picture'];
                            ?>
                                <tr>
                                    <th style="background-color: #aed6f1; border-bottom: 1px solid;">
                                        <img src="images/<?php echo $picture; ?>" style="width: 35%; height: 60px; border: 2px solid black;">
                                    </th>
                                    <th style="background-color: #aed6f1; border-bottom: 1px solid;"><?php echo "$firstname $lastname"; ?></th>
                                    <th style="background-color: #aed6f1; border-bottom: 1px solid;"><?php echo $username; ?></th>
                                    <th style="background-color: #aed6f1; border-bottom: 1px solid;"><?php echo $usertype; ?></th>
                                    <th style="background-color: #aed6f1; border-bottom: 1px solid;">
                                        <a href="edit_account.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                                    </th>
                                    <th style="background-color: #aed6f1; border-bottom: 1px solid;">
                                        <a href="delete_account.php?id=<?php echo $row['id']; ?>" class="delete-btn">Delete</a>
                                    </th>
                                </tr>
                            <?php } ?>
                        </table>
                    </th>
                </tr>
            </table>
        </form>

       
                </th>
            </tr>
        </table>

        <div id="popup" class="popup">
            <p id="popup-text"></p>
            <button onclick="closePopup()">Close</button>
        </div>

        <script>
            function showPopup(action) {
                document.getElementById('popup-text').innerHTML = 'Only instructors and admins can ' + action.toLowerCase() + ' information.';
                document.getElementById('popup').style.display = 'block';
            }

            function closePopup() {
                document.getElementById('popup').style.display = 'none';
            }
        </script>
    </center>
</body>
</html>
