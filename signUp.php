<?php
include("connect.php");

if(isset($_POST['btnsubmit'])){
    $uid = $_POST['txtuserid'];
    $uname = $_POST['txtname'];
    $username = $_POST['txtusername'];
    $pass = $_POST['txtpassword'];
    $insert = "insert into register values('$uid','$uname','$username','$pass')";
    if(mysqli_query($con,$insert)){
        echo "user register successfully";
        header("location:home.php");
    }else{
        echo "Something Error";
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
        <a href="signIn.php">Login</a>
        <h2>-- User Registration --</h2>
        <form method="post" action="signUp.php">
            <table>
                <tr>
                    <td>Enter Id:</td>
                    <td><input type="text" name="txtuserid" /></td>
                </tr>

                <tr>
                    <td>Enter Name:</td>
                    <td><input type="text" name="txtname" /></td>
                </tr>

                <tr>
                    <td>Enter Username:</td>
                    <td><input type="text" name="txtusername" /></td>
                </tr>
                <tr>
                    <td>Enter Password:</td>
                    <td><input type="password" name="txtpassword" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="btnsubmit" value="submit" /></td>
                </tr>
            </table>
        </form>
    </center>

</html>
