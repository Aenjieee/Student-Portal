<!DOCTYPE html>
<html>
<head>
    <title>Student Records</title>
    <style>
        /* Add your CSS styles here */
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

        .logout-btn {
            text-decoration: none;
            padding: 0px 15px;
            color: black;
            background-color: #3498db;
            border: 2px solid black;
            border-style: outset;
            border-radius: 5px;
        }
    </style>
</head>
<?php
require_once('mysql_connection.php');



session_start();

$id = isset($_GET['id']) ? $_GET['id'] : '';

?>
<body>

    <center>
        <table width="80%" cellspacing="0" style="border: 3px solid #3498db;border-style: inset;">
            <tr>
                <th>
                    <table width="100%" cellspacing="0">
                        <tr>
                            <th colspan="11" style="border-bottom: 1px solid;background-color: #3498db;padding: 5px 0px;font-size: 45px;">Students Records <a href="logout"><img src = ./images/logout.png style="width: 40px" align="right"></a></th>
                            
                        </tr>
                        <tr>
                            <th width="15%" style="background-color: #5eb8f7;border-bottom: 1px solid;padding: 5px 0px;">Picture</th>
                            <th width="15%" style="background-color: #5eb8f7;border-bottom: 1px solid;padding: 5px 0px;">Name</th>
                            <th width="7%" style="background-color: #5eb8f7;border-bottom: 1px solid;padding: 5px 0px;">Prelim</th>
                            <th width="7%" style="background-color: #5eb8f7;border-bottom: 1px solid;padding: 5px 0px;">Midterm</th>
                            <th width="7%" style="background-color: #5eb8f7;border-bottom: 1px solid;padding: 5px 0px;">Prefinal</th>
                            <th width="7%" style="background-color: #5eb8f7;border-bottom: 1px solid;padding: 5px 0px;">Final</th>
                            <th width="7%" style="background-color: #5eb8f7;border-bottom: 1px solid;">Final Grade</th>
                            <th width="10%" style="background-color: #5eb8f7;border-bottom: 1px solid;padding: 5px 0px;">Remarks</th>
                            <th width="10%" style="background-color: #5eb8f7;border-bottom: 1px solid;">
                                <a href="logout.php" class="logout-btn">Logout</a>
                            </th>
                            <th colspan="2" style="background-color: #5eb8f7;border-bottom: 1px solid;padding: 5px 0px;"></th>
                        </tr>
                        <?php
                        // Example student record
                        echo '<tr>';
                        echo '<th style="background-color: #aed6f1;border-bottom: 1px solid;"><img src="example_picture.jpg" style="width: 40px; height: 40px;background-color: #f9f5f5;border: 2px solid black;"></th>';
                        echo '<th style="background-color: #aed6f1;border-bottom: 1px solid;">John Doe M.</th>';
                        echo '<th style="background-color: #aed6f1;border-bottom: 1px solid;">85</th>';
                        echo '<th style="background-color: #aed6f1;border-bottom: 1px solid;">78</th>';
                        echo '<th style="background-color: #aed6f1;border-bottom: 1px solid;">92</th>';
                        echo '<th style="background-color: #aed6f1;border-bottom: 1px solid;">88</th>';
                        echo '<th style="background-color: #9df5f1;border-bottom: 1px solid;">85.75</th>';
                        echo '<th style="background-color: #aed6f1;border-bottom: 1px solid;">PASSED</th>';
                        echo '<th style="background-color: #aed6f1;border-bottom: 1px solid;" width="10%">';
                        echo '<a href="#" onclick="showPopup(\'Edit\')" style="text-decoration: none;padding: 0px 15px;color: black;background-color: #3498db;border: 2px solid black;border-style: outset;border-radius: 5px;">Edit</a>';
                        echo '</th>';
                        echo '<th style="background-color: #aed6f1;border-bottom: 1px solid;" width="10%">';
                        echo '<a href="#" onclick="showPopup(\'Delete\')" style="text-decoration: none;padding: 0px 15px;color: black;background-color: #3498db;border: 2px solid black;border-style: outset;border-radius: 5px;">Delete</a>';
                        echo '</th>';
                        echo '</tr>';
                        
                        // Your actual student records loop
                        $query = "SELECT * FROM records where teacher_number = '" . $id . "' order by lastname ASC";
                        $result = mysqli_query($bd, $query);
                        while ($row = mysqli_fetch_array($result)) {
                            $id = $row['id'];
                            $firstname = $row['firstname'];
                            $lastname = $row['lastname'];
                            $mi = $row['mi'];
                            $prelim = $row['first_grading'];
                            $midterm = $row['second_grading'];
                            $prefinal = $row['third_grading'];
                            $final = $row['fourth_grading'];
                            $final_grade = ($prelim + $midterm + $prefinal + $final) / 4;
                            $remarks = ($final_grade >= 75) ? "PASSED" : "FAILED";
                            $picture = $row['picture'];
                        ?>
                            <tr>
                                <th style="background-color: #aed6f1;border-bottom: 1px solid;"><img src="images/<?php echo "$picture"; ?>" style="width: 40px; height: 40px;background-color: #f9f5f5;border: 2px solid black;"></th>
                                <th style="background-color: #aed6f1;border-bottom: 1px solid;"><?php echo "$lastname, $firstname $mi."; ?></th>
                                <th style="background-color: #aed6f1;border-bottom: 1px solid;"><?php echo "$prelim"; ?></th>
                                <th style="background-color: #aed6f1;border-bottom: 1px solid;"><?php echo "$midterm"; ?></th>
                                <th style="background-color: #aed6f1;border-bottom: 1px solid;"><?php echo "$prefinal"; ?></th>
                                <th style="background-color: #aed6f1;border-bottom: 1px solid;"><?php echo "$final"; ?></th>
                                <th style="background-color: #9df5f1;border-bottom: 1px solid;"><?php echo "$final_grade"; ?></th>
                                <th style="background-color: #aed6f1;border-bottom: 1px solid;"><?php echo "$remarks"; ?></th>
                                <th style="background-color: #aed6f1;border-bottom: 1px solid;" width="10%">
                                    <a href="edit_student.php?id=<?php echo $row['id']; ?>" onclick="showPopup('Edit')" style="text-decoration: none;padding: 0px 15px;color: black;background-color: #3498db;border: 2px solid black;border-style: outset;border-radius: 5px;">Edit</a>
                                </th>
                                <th style="background-color: #aed6f1;border-bottom: 1px solid;" width="10%">
                                    <a href="delete_student.php?id=<?php echo $row['id']; ?>" onclick="showPopup('Delete')" style="text-decoration: none;padding: 0px 15px;color: black;background-color: #3498db;border: 2px solid black;border-style: outset;border-radius: 5px;">Delete</a>
                                </th>
                            </tr>
                        <?php } ?>
                    </table>
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
