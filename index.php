<?php
include("database.php");

if (isset($_POST["submit"])) {
    $emails = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $passwords = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if (!empty($emails) && !empty($passwords)) {
        $sql = "SELECT * FROM user WHERE email ='{$emails}'";
        $values = mysqli_query($conn, $sql);

        if ($values && mysqli_num_rows($values) > 0) {
            $results = mysqli_fetch_assoc($values);

            if ($results && password_verify($passwords, $results['password'])) {
                header("Location: home.php");
                exit();
            } else {
                $messege = '<span style="color:red;">Wrong credential! You can create a new account</span>';
            }
        } else {
            $messege = '<span style="color:red;">Email not found! You can create a new account</span>';
        }
    } else {
        $messege = '<span style="color:red;">Please fill in all fields!</span>';
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="login">
      <form action="index.php" method="POST">
        <h1>login</h1>
        <label class="labeltext" >Email</label><br>
        <input class="inputitem" type="email" name="email" placeholder="Enter your Email address"><br>
        <label  class="labeltext">Password</label><br>
        <input class="inputitem" type="password" name="password" placeholder="Enter your password" id="pass">
        <img src="assets\visual.png" alt="show password" class="show" onmouseover="Active();" onmouseout="notActive();"><br>
        <input type="submit" name="submit" value="Login" class="submit">
        <p>Creteing a new accout?<br><a href="register.php">register now</a> </p>
      </form>
      <div>
        <?php
            if(!empty($messege)){
                echo $messege;
            }
        ?>
     </div>
    </div>
</body>
</html>

