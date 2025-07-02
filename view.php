<?php
require_once("db.php");

$dbUser = "root";
$password = "";
$db_name = "student_records";
$hostname = "localhost";

$db = new Database($hostname, $dbUser, $password, $db_name);

$students = $db->getStudentData();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <th>
            <tr>
                <td>ID</td>
                <td>username</td>
                <td>age</td>
                <td>email</td>
                <td>gender</td>
                <td>program</td>
                <td>action</td>
            </tr>
        </th>
        <tbody>
            <?php foreach($students as $student): ?>
            <tr>
                <td><?php echo $student["id"]?> </td>
                <td><?php echo $student["username"]?> </td>
                <td><?php echo $student["age"] ?> </td>
                <td><?php echo $student["email"]?> </td>
                <td><?php echo $student["gender"]?> </td>
                <td><?php echo $student["program"]?> </td> 
                <td>
                    <a href="view.php id=<?php echo $student['id']; ?>">view</a>
                </td>                 
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>