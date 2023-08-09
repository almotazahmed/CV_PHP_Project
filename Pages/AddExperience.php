<?php
    function test_input(string $data): string
    {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    function generateRandomNumber(): int
    {
        return mt_rand(10000000, 99999999);
    }

    function isNumberExists($number, $conn): bool
    {
        $query = "SELECT * FROM experience WHERE experience_id = '$number'";
        $result = mysqli_query($conn, $query);
        return mysqli_num_rows($result) > 0;
    }

    $formData = [
        "course-name" => "",
        "hours-number" => "",
        "start-date" => "",
        "end-date" => "",
        "institution" => "",
        "notes" => "",
    ];

    $resultData = $formData;

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {

        foreach ($formData as $key => $value) {
            $formData[$key] = test_input($_POST[$key]);

            if (empty($formData[$key])) {
                $resultData[$key] = "This field is required!";
            }
        }

        if (!in_array("", $formData)) {
            $conn = mysqli_connect('localhost', 'root', '', 'final_lab_project') or die("Connection Failed: " . mysqli_connect_error());

            $uniqueNumber = generateRandomNumber();

            while (isNumberExists($uniqueNumber, $conn)) {
                $uniqueNumber = generateRandomNumber();
            }

            $user_id = 20201685;

            $sql = "INSERT INTO experience VALUES (
                '$uniqueNumber',
                '{$formData["course-name"]}',
                '{$formData["start-date"]}',
                '{$formData["end-date"]}',
                '{$formData["institution"]}',
                '{$formData["notes"]}',
                '$user_id',
                '{$formData["hours-number"]}'
            )";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                $formData = array_fill_keys(array_keys($formData), "");
                mysqli_close($conn);
                header("Location: ViewExperience.php");
                exit;
            } else {
                die(mysqli_errno($conn));
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="description" content="This Is The Add Experience Page">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="HTML, CSS">
        <meta name="author" content="Al-Motaz Bellah Adel Ahmed">
        <title>Add Experience</title>
        <link rel="stylesheet" href="../CSS/style.css">
    </head>
    <body>
        <header>
            <div>
                <a href="Home.php">Personal Information</a>
                <a href="ViewCourses.php">Courses Information</a>
                <a href="ViewExperience.php">Experiences Information</a>
                <a href="AddCourse.php">Add Course</a>
                <a class="live-header" href="AddExperience.php">Add experience</a>
            </div>
            <img src="../Images/Azhar_WHITE_LOGO.png" alt="None">
        </header>
        <section class="add-exper">
            <form action="" method="post">
                <div class="form-style">
                    <div class="input-label">
                        <label for="course-name">Course Name:</label>
                        <label for="hours-number">Number of Hours:</label>
                        <label for="start-date">Start Date:</label>
                        <label for="end-date">End Date:</label>
                        <label for="institution">Institution:</label>
                        <label for="notes">Notes:</label>
                    </div>
                    <div class="exper-input">
                        <div class="for-span">
                            <input type="text" name="course-name" id="course-name" value="<?= $formData["course-name"]; ?>">
                            <span><?= $resultData["course-name"]; ?></span>
                        </div>
                        <div class="for-span">
                            <input type="number" name="hours-number" id="hours-number" min="0" max="200" step="1" value="<?= $formData["hours-number"]; ?>">
                            <span><?= $resultData["hours-number"]; ?></span>
                        </div>
                        <div class="for-span">
                            <input type="date" name="start-date" id="start-date" value="<?= $formData["start-date"]; ?>">
                            <span><?= $resultData["start-date"]; ?></span>
                        </div>
                        <div class="for-span">
                            <input type="date" name="end-date" id="end-date" value="<?= $formData["end-date"]; ?>">
                            <span><?= $resultData["end-date"]; ?></span>
                        </div>
                        <div class="for-span">
                            <input type="text" name="institution" id="institution" value="<?= $formData["institution"]; ?>">
                            <span><?= $resultData["institution"]; ?></span>
                        </div>
                        <div class="for-span">
                            <textarea name="notes" id="notes"><?= $formData["notes"]; ?></textarea>
                            <span class="textarea-span"><?= $resultData["notes"]; ?></span>
                        </div>
                    </div>
                </div>
                <div class="exper-buttons">
                    <input type="submit" name="submit" value="Save">
                    <input type="reset" name="reset" value="Reset">
                </div>
            </form>
            <div class="form-pic">
                <img src="../Images/experience.jpg" alt="None">
            </div>
        </section>
    </body>
</html>
