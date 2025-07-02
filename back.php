<?php 

$name = trim($_POST['name']);
$email = trim($_POST['email']);
$age = trim($_POST['age']);
if(!empty($name)){
    if(!preg_match('/[a-zA-Z]/',$name)){
        echo "<h2 style= 'color:blue'> name is not valid </h2>";
    }else{
        echo "<h2 style= 'color:green'> hello {$name}";    
    }
} else{
    echo "<h2 style= 'color:red'> name field is empty </h2>";    
}

echo '<br>';
if(!empty($email)){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "<h2 style= 'color:blue'> email is not valid </h2>";
    }else{
        echo $email;    
    }
} else{
    echo "<h2 style= 'color:red'> email field is empty </h2>";
}
echo '<br>';
if(!empty($age)){
    if(!preg_match('/[0-9]/',$age)){
        echo "<h2 style= 'color:blue'> age must be a number </h2>";
    }else{
        echo $age;    
    }
} else{
    echo "<h2 style= 'color:red'> age field is empty</h2>";
}

// echo $_POST['name'];
// echo "<br>" ;
// echo $_POST['email'];
// echo "<br>" ;
// echo $_POST['age'];
?>