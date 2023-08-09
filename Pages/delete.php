<?php
    $conn = mysqli_connect('localhost', 'root', '', 'final_lab_project') or die("Connection Failed: " . mysqli_connect_error());

    if (isset($_GET['delete-id']) && isset($_GET['from-page'])) {
        $from_page = $_GET['from-page'];
        $id = $_GET['delete-id'];

        if ($from_page == "courses-page") {
            $sql = "DELETE FROM course WHERE course_id = $id";
            $redirectPage = 'ViewCourses.php';
        } else {
            $sql = "DELETE FROM experience WHERE experience_id = $id";
            $redirectPage = 'ViewExperience.php';
        }

        $result = $conn->query($sql);

        if ($result) {
            header("Location: $redirectPage");
            exit();
        } else {
            die(mysqli_error($conn));
        }
    }

    mysqli_close($conn);

