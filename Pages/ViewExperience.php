<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="description" content="This Page Contain Of My Experience">
        <meta http-equiv="refresh" content="60">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="HTML, CSS">
        <meta name="author" content="Al-Motaz Bellah Adel Ahmed">
        <title>View Experiences</title>
        <link rel="stylesheet" href="../CSS/style.css">
    </head>
    <body>
        <header>
            <div>
                <a href="Home.php">Personal Information</a>
                <a href="ViewCourses.php">Courses Information</a>
                <a class="live-header" href="ViewExperience.php">Experiences Information</a>
                <a href="AddCourse.php">Add Course</a>
                <a href="AddExperience.php">Add experience</a>
            </div>
            <img src="../Images/Azhar_WHITE_LOGO.png" alt="None">
        </header>
        <section class="exper-info">
            <h1>All Experiences Information</h1>
            <?php
                $conn = mysqli_connect('localhost', 'root', '', 'final_lab_project') or die("Connection Failed" . mysqli_connect_error());

                $sql = "SELECT * FROM experience where user_id='20201685'";
                $result = $conn->query($sql);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $course_name = htmlspecialchars($row['course_name']);
                        $institution = htmlspecialchars($row['institution']);
                        $start_date = date('n/Y', strtotime($row['start_date']));
                        $end_date = date('n/Y', strtotime($row['end_date']));
                        $notes = htmlspecialchars($row['notes']);

                        echo "<article>";
                        echo "<h2>$course_name<sub>$institution</sub><button><a href='delete.php?delete-id={$row['experience_id']}&from-page=experiences-page'>Delete</a></button></h2>";
                        echo "<div class='article-date'><b>from $start_date to $end_date</b></div>";
                        echo "<div class='article-body'>$notes</div>";
                        echo "</article>";
                    }
                } else {
                    echo "No rows found.";
                }
                $conn->close();
            ?>
        </section>
    </body>
</html>
