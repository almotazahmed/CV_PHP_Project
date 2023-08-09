<?php
    function test_input(string $data): string{
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    function generateRandomNumber(): int{
        return mt_rand(10000000, 99999999);
    }

    function isNumberExists($number, $conn): bool{
        $query = "SELECT * FROM course WHERE course_id = '$number'";
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
        "attachment" => "",
        "attachment-value" => ""
    ];

    $resultData = $formData;

    if ($_SERVER["REQUEST_METHOD"] === 'POST') {
        foreach ($formData as $key => $value) {
            if ($key === "attachment-value") {
                break;
            }
            $formData[$key] = test_input($_POST[$key]);
        }

        if ($formData["attachment"] === "url") {
            $formData["attachment-value"] = test_input($_POST["url"]);
        } else {
            $formData["attachment-value"] = test_input($_FILES['file']['name']);
        }

        foreach ($formData as $key => $value) {
            if (empty($value)) {
                $resultData[$key] = "This field is required!";
            }
        }

        if (!in_array("", $formData)) {
            $conn = mysqli_connect('localhost', 'root', '', 'final_lab_project') or die("Connection Failed: " . mysqli_connect_error());

            if ($formData["attachment"] === "file") {
                $attachment_value = $_FILES['file']['name'];
                $tmp_name = $_FILES['file']['tmp_name'];
                $path = "../images/" . $attachment_value;
                $formData["attachment-value"] = test_input($path);
                move_uploaded_file($tmp_name, $path);
            }

            $uniqueNumber = generateRandomNumber();

            while (isNumberExists($uniqueNumber, $conn)) {
                $uniqueNumber = generateRandomNumber();
            }

            $user_id = 20201685;
            $sql = "INSERT INTO course VALUES (
                '$uniqueNumber',
                '{$formData["course-name"]}',
                '{$formData["hours-number"]}',
                '{$formData["start-date"]}',
                '{$formData["end-date"]}',
                '{$formData["institution"]}',
                '{$formData["attachment"]}',
                '{$formData["attachment-value"]}',
                '{$formData["notes"]}',
                '$user_id'
            )";


            $result = mysqli_query($conn, $sql);

            if ($result) {
                $formData = array_fill_keys(array_keys($formData), "");
                mysqli_close($conn);
                header("Location: ViewCourses.php");
                exit;
            } else {
                die(mysqli_error($conn));
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="description" content="This Is The Add Course Page">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="HTML, CSS">
        <meta name="author" content="Al-Motaz Bellah Adel Ahmed">
        <title>Add Course</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#url').hide();
                $('.url').hide();
                $('#file').show();
                $('.file').show();
                $('input[type="radio"]').click(function() {
                    if($(this).attr('id') === 'radio-url') {
                        $('#url').show();
                        $('.url').show();
                        $('#file').hide();
                        $('.file').hide();
                    } else if($(this).attr('id') === 'radio-file') {
                        $('#url').hide();
                        $('.url').hide();
                        $('#file').show();
                        $('.file').show();
                    }
                });
            });
        </script>
        <link rel="stylesheet" href="../CSS/style.css">
    </head>
    <body>
        <header>
            <div>
                <a href="Home.php">Personal Information</a>
                <a href="ViewCourses.php">Courses Information</a>
                <a href="ViewExperience.php">Experiences Information</a>
                <a class="live-header" href="AddCourse.php">Add Course</a>
                <a href="AddExperience.php">Add experience</a>
            </div>
            <img src="../Images/Azhar_WHITE_LOGO.png" alt="None">
        </header>
        <section class="add-course">
            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
                <div class="form-style">
                    <div class="input-label">
                        <label for="course-name">Course Name:</label>
                        <label for="hours-number">Number of Hours:</label>
                        <label for="start-date">Start Date:</label>
                        <label for="end-date">End Date:</label>
                        <label for="institution">Institution:</label>
                        <label>Attachment:</label>
                        <label for="url" class="url">URL:</label>
                        <label for="file" class="file">File:</label>
                        <label for="notes">Notes:</label>
                    </div>
                    <div class="course-input">
                        <div class="for-span">
                            <input type="text" name="course-name" id="course-name" value="<?= $formData["course-name"];?>">
                            <span><?= $resultData["course-name"]; ?></span>
                        </div>
                        <div class="for-span">
                            <input type="number" name="hours-number" id="hours-number" min="0" max="200" step="1" value="<?= $formData["hours-number"];?>">
                            <span><?= $resultData["hours-number"]; ?></span>
                        </div>
                        <div class="for-span">
                            <input type="date" name="start-date" id="start-date" value="<?= $formData["start-date"];?>">
                            <span><?= $resultData["start-date"]; ?></span>
                        </div>
                        <div class="for-span">
                            <input type="date" name="end-date" id="end-date" value="<?= $formData["end-date"];?>">
                            <span><?= $resultData["end-date"]; ?></span>
                        </div>
                        <div class="for-span">
                            <input type="text" name="institution" id="institution" value="<?= $formData["institution"];?>">
                            <span><?= $resultData["institution"]; ?></span>
                        </div>
                        <div class="radio">
                            <div>
                                <input type="radio" name="attachment" id="radio-file" value="file" checked>
                                <label for="radio-file">File</label>
                            </div>
                            <div>
                                <input type="radio" name="attachment" id="radio-url" value="url">
                                <label for="radio-url">URL</label>
                            </div>
                        </div>
                        <div class="for-span">
                            <div class="file-url">
                                <input type="url" name="url" id="url">
                                <input type="file" name="file" id="file">
                            </div>
                            <span><?= $resultData["attachment-value"]; ?></span>
                        </div>
                        <div class="for-span">
                            <textarea name="notes" id="notes"><?= $formData["notes"];?></textarea>
                            <span class="textarea-span"><?= $resultData["notes"]; ?></span>
                        </div>
                    </div>
                </div>
                <div class="course-buttons">
                    <input type="submit" name="submit" value="Save">
                    <input type="reset" name="reset" value="Reset">
                </div>
            </form>
            <div class="form-pic">
                <img src="../Images/course.jpg" alt="None">
            </div>
        </section>
    </body>
</html>
