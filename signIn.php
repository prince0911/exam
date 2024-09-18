<?php
include("connect.php");
session_start();

if(isset($_POST['btnsubmit'])){
    $username=$_POST['txtemail'];
    $password=$_POST['txtpassword']; 
    $select="select * from register where username='$username' and password='$password'";
    $result=mysqli_query($con,$select);
    $count=mysqli_num_rows($result);
    if($count > 0){
        $_SESSION['username']=$username;
        header("location:home.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
        <h1>Project</h1>
        <a href="signUp.php">register</a>
        <h2> -- Login Form --</h2>
        <form method="post">
            <table>
                <tr>
                    <td>Enter Username:</td>
                    <td><input type="text" name="txtemail" /></td>
                </tr>

                <tr>
                    <td>Enter Password:</td>
                    <td><input type="password" name="txtpassword" /></td>
                </tr>

                <tr>
                    <td></td>
                    <td><input type="checkbox" name="chkRemember" /> Remember Me</td>
                </tr>

                <tr>
                    <td></td>
                    <td><input type="submit" name="btnsubmit" value="submit" /></td>
                </tr>
            </table>
        </form>
    </center>
</body>
</html>