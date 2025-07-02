
<?php 
require_once 'db.php';
$nameError = $emailError = $ageError = $genderError = $programError = '';
$approvedMessages = [];

$username = $email = $age = $gender = $program = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $age = trim($_POST['age'] ?? '');
    $gender = $_POST['gender'] ?? '';
    $program = $_POST['Program'] ?? '';

    // Validate username
    if (empty($username)) {
        $nameError = "<h2 style='color:red'>Name field is empty</h2>";
    } elseif (!preg_match('/^[a-zA-Z]+$/', $username)) {
        $nameError = "<h2 style='color:blue'>Name must contain only alphabets</h2>";
    } 
    // else {
    //     $approvedMessages["username"] = "<h2 style='color:green'>Hello {$username}</h2>";
    // }

    // Validate email
    if (empty($email)) {
        $emailError = "<h2 style='color:red'>Email field is empty</h2>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "<h2 style='color:blue'>Email is not valid</h2>";
    } 
    // else {
    //     $approvedMessages[] = "<h2 style='color:green'>{$email}</h2>";
    // }

    // Validate age
    if (empty($age)) {
        $ageError = "<h2 style='color:red'>Age field is empty</h2>";
    } elseif (!preg_match('/^[0-9]+$/', $age)) {
        $ageError = "<h2 style='color:blue'>Age must be a number</h2>";
    } 
    // else {
    //     $approvedMessages[] = "<h2 style='color:green'>{$age}</h2>";
    // }

    // Validate gender
    if (empty($gender)) {
        $genderError = "<h2 style='color:red'>Gender field is required</h2>";
    } elseif (!in_array($gender, ['Male', 'Female'])) {
        $genderError = "<h2 style='color:blue'>Invalid gender selected</h2>";
    } 
    // else {
    //     $approvedMessages[] = "<h2 style='color:green'>Gender: {$gender}</h2>";
    // }

    // Validate program
    if (empty($program)) {
        $programError = "<h2 style='color:red'>Program selection is required</h2>";
    } elseif ($program === '') {
        $programError = "<h2 style='color:blue'>Please select a program</h2>";
    } 
    // else {
    //     $approvedMessages[] = "<h2 style='color:green'>Program: {$program}</h2>";
    // }


    $dbUser = "root";
    $password = "";
    $db_name = "student_records";
    $hostname = "localhost";

    $db = new Database($hostname, $dbUser, $password, $db_name);
    
    if (empty($nameError) && empty($emailError) && empty($ageError) && empty($genderError) && empty($programError)) {
        $db->savedata($username, $age, $gender, $email, $program);
        $approvedMessages["success"] = "<h2 style='color:green'>Registration successful</h2>";
    }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Some Profile</title>
    <link rel="stylesheet" href="style.css" />
        <style>
            .error {
                color: red;
                font-size: 1em;
                margin-top: 2px;
                margin-bottom: 10px;
            }
            .approved {
                color: green;
                margin-top: 10px;
                padding-top: 0;
                border-top: none;
            }
            input, select {
                display: block;
                margin-bottom: 5px;
            }
            .gender-options {
                margin-bottom: 10px;
            }
        </style>
</head>
<body>
    <div class="conko">
        <!-- <?php echo $approvedMessages["success"] ; ?> -->
        <div>
            <?php 
                if (isset($approvedMessages["success"])) {
                    echo $approvedMessages["success"];
                }
            ?>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>
            <label for="name">Name</label>
            <input type="text" name="username" placeholder="Enter your name" value="<?php echo htmlspecialchars($username); ?>" />
            <?php echo $nameError; ?>

            <label for="email">Email</label>
            <input type="text" name="email" placeholder="abc@xyz.com" value="<?php echo htmlspecialchars($email); ?>" />
            <?php echo $emailError; ?>

            <label for="age">Age</label>
            <input type="text" name="age" placeholder="How old are you?" value="<?php echo htmlspecialchars($age); ?>" />
            <?php echo $ageError; ?>

            <label>Gender</label>
            <div class="gender-options">
                <label class="gender-option">
                    <input type="radio" id="male" name="gender" value="Male" <?php if ($gender === 'Male') echo 'checked'; ?> />
                    Male
                </label>
                <label class="gender-option">
                    <input type="radio" id="female" name="gender" value="Female" <?php if ($gender === 'Female') echo 'checked'; ?> />
                    Female
                </label>
            </div>
            <?php echo $genderError; ?>

            <label for="form">Select a program</label>
            <select id="program" name="Program" required>
                <option value="" <?php if ($program === '') echo 'selected'; ?>>Choose a program</option>
                <option value="ICT" <?php if ($program === 'ICT') echo 'selected'; ?>>ICT</option>
                <option value="Computer Science" <?php if ($program === 'Computer Science') echo 'selected'; ?>>Computer Science</option>
                <option value="Industrial Arts" <?php if ($program === 'Industrial Arts') echo 'selected'; ?>>Industrial Arts</option>
                <option value="Fashion" <?php if ($program === 'Fashion') echo 'selected'; ?>>Fashion</option>
                <option value="Food Tech" <?php if ($program === 'Food Tech') echo 'selected'; ?>>Food Tech</option>
            </select>
            <?php echo $programError; ?>

            <button type="submit">Register</button>
            <a href="view.php">Get all students</a>
        </form>
        <!-- Removed duplicate success message display to show only at the top -->
    </div>
</body>
</html>

