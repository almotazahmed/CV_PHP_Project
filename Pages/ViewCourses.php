<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="description" content="This Page Contain Of My Courses">
        <meta http-equiv="refresh" content="60">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="HTML, CSS">
        <meta name="author" content="Al-Motaz Bellah Adel Ahmed">
        <title>View Courses</title>
        <link rel="stylesheet" href="../CSS/style.css">
    </head>
    <body>
        <header>
            <div>
                <a href="Home.php">Personal Information</a>
                <a  class="live-header" href="ViewCourses.php">Courses Information</a>
                <a href="ViewExperience.php">Experiences Information</a>
                <a href="AddCourse.php">Add Course</a>
                <a href="AddExperience.php">Add experience</a>
            </div>
            <img src="../Images/Azhar_WHITE_LOGO.png" alt="None">
        </header>
        <section class="courses-info">
            <h1>All Courses Information</h1>
            <table>
                <thead>
                    <tr>
                        <th rowspan="2">#</th>
                        <th rowspan="2">Course Name</th>
                        <th rowspan="2">Total Hours</th>
                        <th class="date1" colspan="2">Date</th>
                        <th rowspan="2">Institution</th>
                        <th rowspan="2">Attachment</th>
                        <th rowspan="2">Notes</th>
                        <th rowspan="2">Operations</th>
                    </tr>
                    <tr>
                        <th class="date">From</th>
                        <th class="date">To</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'final_lab_project') or die("Connection Failed: " . mysqli_connect_error());

                    $sql = "SELECT * FROM course WHERE user_id='20201685'";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        $count = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><b>$count</b></td>";
                            echo "<td>" . (isset($row['name']) ? htmlspecialchars($row['name']) : 'Not Set') . "</td>";
                            echo "<td>" . (isset($row['number_of_hours']) ? htmlspecialchars($row['number_of_hours']) : 'Not Set') . "</td>";
                            echo "<td class='date'>" . (isset($row['start_date']) ? htmlspecialchars(date('j/n/Y', strtotime($row['start_date']))) : 'Not Set') . "</td>";
                            echo "<td class='date'>" . (isset($row['end_date']) ? htmlspecialchars(date('j/n/Y', strtotime($row['end_date']))) : 'Not Set') . "</td>";
                            echo "<td>" . (isset($row['institution']) ? htmlspecialchars($row['institution']) : 'Not Set') . "</td>";
                            echo "<td><u><a href='CourseView.php?course_id={$row['course_id']}' target='_blank'>view</a></u></td>";
                            echo "<td><div class='notes-td-div'>" . (isset($row['notes']) ? htmlspecialchars($row['notes']) : 'Not Set') . "</div></td>";
                            echo "<td>";
                            echo "<div class='button-class'>";
                            echo "<button class='delete-row'><a href='delete.php?delete-id={$row['course_id']}&from-page=courses-page'>Delete</a></button>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                            $count++;
                        }
                    } else {
                        echo "<tr>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td class='date'></td>";
                        echo "<td class='date'></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "</tr>";
                        echo "No rows found.";
                    }
                    $conn->close();
                ?>
                </tbody>
            </table>
        </section>
    </body>
</html>