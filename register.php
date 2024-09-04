<?php
    session_start();
    include("database.php");
?>
<?php
    if(isset($_POST["submit"])){
        $email = filter_input(INPUT_POST,"email",FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $date = filter_input(INPUT_POST,"date", FILTER_SANITIZE_NUMBER_INT);
       
        
        $retrive = "SELECT email FROM  user WHERE email = '{$email}'";
        $emailval = mysqli_query($conn, $retrive);
        $result = mysqli_fetch_array($emailval);
        if(!empty($result)){
            $getmail = $result['email'];
            if($email == $getmail){
                $messege = '<span style="color:red;">Already have a accout with this email !</span>';
            }
        }
        
        elseif(!empty($email) && !empty($password) && !empty($name) && !empty($date)){
            $hash = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO user ( name, date, email, password) VALUES ('{$name}','{$date}','{$email}','{$hash}')";
            mysqli_query($conn, $sql);
            $messege = '<span style="color: green;">Registration successfull ! lets go to login page</span>';
            header("Refresh:7; URL=index.php");
        }
        else{
            $messege = '<span style="color:red;">fill all the section !</span>';
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
    <div class="login" style="height: 34rem; margin: 8rem auto">
      <form action="register.php" method="POST">
        <h1>Register</h1>
        <label class="labeltext" >Your Name</label><br>
        <input class="inputitem" type="name" name="name" placeholder="Enter your full name"><br>
        <label class="labeltext" >Your date of birth</label><br>
        <input class="inputitem" type="date" name="date"><br>
        <label class="labeltext" >Email</label><br>
        <input class="inputitem" type="email" name="email" placeholder="Enter your Email address"><br>
        <label  class="labeltext">Password</label><br>
        <input class="inputitem" type="password" name="password" placeholder="Enter your password" id="pass">
        <img src="assets\visual.png" alt="show password" class="show" onmouseover="Active();" onmouseout="notActive();"><br>
        <input type="submit" name="submit" value="sign up" class="submit">
        <p>already have an accout?<br><a href="index.php">log in now</a> </p>
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

<?php
      session_destroy();
?>