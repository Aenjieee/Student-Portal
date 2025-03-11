<?php
require_once('mysql_connection.php');

session_start();
if (!isset($_SESSION["id"]) || $_SESSION["id"] == '') {
    header('location: index.php');
    exit;
}

$grading = $_GET['grading'];

if (isset($_POST['add'])) {
    $id = $_POST['hidden_id'];
    $grade = $_POST['grade'];
    if ($grading == "prelim") {
        $query = "UPDATE records SET prelim='" . $grade . "' where id='" . $id . "'";
        mysqli_query($bd, $query);
    } elseif ($grading == "midterm") {
        $query = "UPDATE records SET midterm='" . $grade . "' where id='" . $id . "'";
        mysqli_query($bd, $query);
    } elseif ($grading == "prefinal") {
        $query = "UPDATE records SET prefinal='" . $grade . "' where id='" . $id . "'";
        mysqli_query($bd, $query);
    } elseif ($grading == "final") {
        $query = "UPDATE records SET final='" . $grade . "' where id='" . $id . "'";
        mysqli_query($bd, $query);
    }
    echo "<script>alert('Grade Successfully Added!')</script>";
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Students Grade for <?php echo ucfirst($grading); ?></title>
</head>

<body>
    <center>
        <table width="50%" cellspacing="0" style="border:3px solid #f35306;border-style: inset;">
            <tr>
                <th>
                    <table width="100%" cellspacing="0">
                        <tr>
                            <th colspan="4" style="border-bottom: 1px solid;background-color: #f7b553;padding: 5px 0px;font-size: 25px;">Add Students Grade for <?php echo ucfirst($grading); ?></th>
                        </tr>
                        <tr>
                            <th width="25%" style="background-color: #f38b5a;border-bottom: 1px solid;padding: 5px 0px;">Picture</th>
                            <th width="25%" style="background-color: #f38b5a;border-bottom: 1px solid;padding: 5px 0px;">Name</th>
                            <th width="25%" style="background-color: #f38b5a;border-bottom: 1px solid;padding: 5px 0px;">Grade</th>
                            <th width="25%" style="background-color: #f38b5a;border-bottom: 1px solid;">
                                <a href="choose_grading.php" style="text-decoration: none;padding: 0px 15px;color: black;background-color: #abb5fb;border: 2px solid black;border-style: outset;border-radius: 5px;">Back</a>
                            </th>
                        </tr>
                        <?php
                        $query = "SELECT * FROM records where teacher_number = '" . $_SESSION["id"] . "' order by lastname ASC";
                        $result = mysqli_query($bd, $query);

                        while ($row = mysqli_fetch_array($result)) {
                            $id = $row['id'];
                            $firstname = $row['firstname'];
                            $lastname = $row['lastname'];
                            $mi = $row['mi'];
                            $picture = $row['picture'];

                            // Correted the variable name from $grade to $gradingValue
                            if ($grading == "prelim") {
                                $gradingValue = $row['prelim'];
                            } elseif ($grading == "midterm") {
                                $gradingValue = $row['midterm'];
                            } elseif ($grading == "prefinal") {
                                $gradingValue = $row['prefinal'];
                            } elseif ($grading == "final") {
                                $gradingValue = $row['final'];
                            }

                            // Corrected the condition to check if $gradingValue is 0
                            if ($gradingValue == 0) {
                        ?>
                                <form action="" method="post">
                                    <tr>
                                        <th style="background-color: #efb295;border-bottom: 1px solid;"><img src="images/<?php echo $picture; ?>" style="width: 40px; height: 40px;background-color: #f9f5f5;border: 2px solid black;"></th>
                                        <th style="background-color: #efb295;border-bottom: 1px solid;"><?php echo "$lastname, $firstname $mi."; ?></th>
                                        <th style="background-color: #efb295;border-bottom: 1px solid;">
                                            <input type="text" name="grade" style="width: 50%;" placeholder="Enter Grade">
                                            <input type="hidden" name="hidden_id" value="<?php echo $id; ?>" style="width: 50%;">
                                        </th>
                                        <th style="background-color: #efb295;border-bottom: 1px solid;">
                                            <input type="submit" name="add" value="Add Grade" style="text-decoration: none;padding: 5px 15px;font-size: 15px;color: black;background-color: #abb5fb;border: 2px solid black;border-style: outset;border-radius: 5px;">
                                        </th>
                                    </tr>
                                </form>
                        <?php
                            }
                        }
                        ?>
                    </table>
                </th>
            </tr>
        </table>
    </center>
</body>

</html>

