<?php
    $conn = mysqli_connect('localhost', 'root', '', 'final_lab_project') or die("Connection Failed".mysqli_connect_error());
    $id="";
    $name="";
    $gender="";
    $date_of_birth="";
    $nationality="";
    $job_title="";
    $year_of_experience="";
    $place_of_birth="";
    $profile_pic_path="";

    $sql = "SELECT * FROM user where id='20201685'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $id = $row["id"];
        $name = $row["name"];
        $gender = $row["gender"];
        $date_of_birth = $row["date_of_birth"];
        $nationality = $row["nationality"];
        $year_of_experience = $row["year_of_experience"];
        $place_of_birth = $row["place_of_birth"];
        $job_title = $row["job_title"];
        $profile_pic_path = $row["profile_picture"];
    } else {
        echo "No results found.";
    }

    $conn->close();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="description" content="This Is The Home Page">
        <meta http-equiv="refresh" content="60">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="HTML, CSS">
        <meta name="author" content="Al-Motaz Bellah Adel Ahmed">
        <title>Home Page</title>
        <link rel="stylesheet" href="../CSS/style.css">
    </head>
    <body>
        <header>
            <div>
                <a class="live-header" href="Home.php?$id">Personal Information</a>
                <a href="ViewCourses.php">Courses Information</a>
                <a href="ViewExperience.php">Experiences Information</a>
                <a href="AddCourse.php">Add Course</a>
                <a href="AddExperience.php">Add experience</a>
            </div>
            <img src="../Images/Azhar_WHITE_LOGO.png" alt="None">
        </header>
        <section class="personal-info">
            <h1>Personal Information</h1>
            <article>
                <div class="info-name">
                    <div>Full Name:</div>
                    <div>ID:</div>
                    <div>Gender:</div>
                    <div>Birth Date:</div>
                    <div>Nationality:</div>
                    <div>Place of Birth:</div>
                    <div>Job title:</div>
                    <div>Year of experience:</div>
                </div>
                <div class="info-value">
                    <div><b><?php echo $name; ?></b></div>
                    <div><b><?php echo $id; ?></b></div>
                    <div><b><?php echo $gender; ?></b></div>
                    <div><b><?php echo date("d", strtotime($date_of_birth)); ?><sup>th</sup>, <abbr title="April"><?php echo date("M", strtotime($date_of_birth)); ?></abbr><?php echo " ".date("Y", strtotime($date_of_birth)); ?></b></div>
                    <div><b><?php echo $nationality; ?></b></div>
                    <div><b><?php echo $place_of_birth; ?></b></div>
                    <div><b><?php echo $job_title; ?></b></div>
                    <div><b><?php echo $year_of_experience; ?> years</b></div>
                </div>
                <div class="info-pic">
                    <img src="<?php echo $profile_pic_path; ?> " alt="None">
                </div>
            </article>
        </section>
    </body>
</html>