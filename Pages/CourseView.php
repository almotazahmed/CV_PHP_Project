<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="description" content="This Is The HTML Attachment Page">
        <meta http-equiv="refresh" content="60">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="HTML, CSS">
        <meta name="author" content="Al-Motaz Bellah Adel Ahmed">
        <title>Course Attachment</title>
        <link rel="stylesheet" href="../CSS/style.css">
    </head>
    <body>
        <header>
            <div>
                <a href="Home.php">Personal Information</a>
                <a href="ViewCourses.php">Courses Information</a>
                <a href="ViewExperience.php">Experiences Information</a>
                <a href="AddCourse.php">Add Course</a>
                <a href="AddExperience.php">Add experience</a>
            </div>
            <img src="../Images/Azhar_WHITE_LOGO.png" alt="None">
        </header>
        <section class="view-attach">
            <?php
                if (isset($_GET['course_id'])) {
                    $courseId = $_GET['course_id'];
                    $conn = mysqli_connect('localhost', 'root', '', 'final_lab_project') or die("Connection Failed: " . mysqli_connect_error());
                    $sql = "SELECT * FROM course WHERE course_id = '" . $courseId . "'";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        echo '<h1>Course "' . $row['name'] . '"</h1>';
                        echo '<div class="attach-info">';
                        echo '<div>from ' . date('j/n/Y', strtotime($row['start_date'])) . ' to ' . date('j/n/Y', strtotime($row['end_date'])) . ', totally ' . $row['number_of_hours'] . ' training hours</div>';
                        echo '<div>Institution was "' . $row['institution'] . '"</div>';
                        echo '</div>';
                        echo '<div class="attach-photo">';
                        echo '<div>';
                        if ($row['attachment_type'] == "File") {
                            $path = $row['attachment_value'];
                            echo "<img src='$path' alt='none'>";
                        } else {
                            echo "<a href='" . $row['attachment_value'] . "'>Click to open</a>";
                        }
                        echo '<p>Certificate file</p>';
                        echo '</div>';
                        echo '</div>';
                    } else {
                        echo "No data found for the given course ID.";
                    }
                    $conn->close();
                } else {
                    echo "Invalid course ID.";
                }
            ?>
    </body>
</html>
