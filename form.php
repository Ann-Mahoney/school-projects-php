<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form handling</title>
</head>
<body>
    <form action="back.php" method="post">
        <input type="text" name="name" placeholder = "Ann Jinx"><br>
        <input type="email" name="email" placeholder = "abc@xyz.bbb"><br>
        <input type="text" name="age" placeholder = "00yrs"><br>
        <input type="submit" value="submit">
    </form>
</body>
</html>
    

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $errors["email"] = "Email field is empty";
    } else {
        $email = trim($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Email is not valid";
        } else {
            $approved["email"] = $email;
        }
    }

    // Validate age
    if (empty(trim($_POST["age"]))) {
        $errors["age"] = "Age field is empty";
    } else {
        $age = trim($_POST["age"]);
        if (!preg_match('/^[0-9]+$/', $age)) {
            $errors["age"] = "Age must be a number";
        } else {
            $approved["age"] = $age;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Form Handling</title>
    <style>
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 2px;
            margin-bottom: 10px;
        }
        .approved {
            color: green;
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
        input {
            display: block;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <form action="form.php" method="post" novalidate>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Ann Jinx" value="<?php echo htmlspecialchars($name); ?>" />
        <?php if (isset($errors["name"])): ?>
            <div class="error"><?php echo $errors["name"]; ?></div>
        <?php endif; ?>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="abc@xyz.bbb" value="<?php echo htmlspecialchars($email); ?>" />
        <?php if (isset($errors["email"])): ?>
            <div class="error"><?php echo $errors["email"]; ?></div>
        <?php endif; ?>

        <label for="age">Age:</label>
        <input type="text" id="age" name="age" placeholder="00yrs" value="<?php echo htmlspecialchars($age); ?>" />
        <?php if (isset($errors["age"])): ?>
            <div class="error"><?php echo $errors["age"]; ?></div>
        <?php endif; ?>

        <input type="submit" value="Submit" />
    </form>

    <?php if (!empty($approved)): ?>
        <div class="approved">
            <h3>Approved Form Values:</h3>
            <ul>
                <?php foreach ($approved as $field => $value): ?>
                    <li><strong><?php echo ucfirst($field); ?>:</strong> <?php echo htmlspecialchars($value); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</body>
</html>
