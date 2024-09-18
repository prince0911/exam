<?php
include('connect.php');
session_start();

$username=$_SESSION['username'];
$select="select * from register where username='" . $username . "'";
$result=mysqli_query($con,$select);
$data=mysqli_fetch_assoc($result);

// Check if the session variable 'username' is set
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $select = "SELECT * FROM register WHERE username='$username'";
    $result = mysqli_query($con, $select);
    
    // Check if the query was successful and returned a result
    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        die("No user found or query failed: " . mysqli_error($con));
    }
} else {
    die("No username in session. Please log in.");
}



// Handle form submission
if (isset($_POST['btnsubmit'])) {
    $pid = $_POST['txtproductid'];
    $productName = $_POST['txtproductname'];
    $productPrice = $_POST['txtproductprice'];

    // Check if we're updating an existing product
    if (isset($_GET['updatepid'])) {
        $pid = $_GET['updatepid']; // Get the product ID from the URL for the update
        // Update the existing product
        $query = "UPDATE product SET productName='$productName', productPrice='$productPrice' WHERE pid='$pid'";
        if (mysqli_query($con, $query)) {
            echo "Product updated successfully!";
        } else {
            echo "Error updating product: " . mysqli_error($con);
        }
    } else {
        // Insert a new product
        $query = "INSERT INTO product (userid, pid, pname, productName, productPrice) 
                  VALUES ('" . $data['userid'] . "', '" . $pid . "', '" . $data['name'] . "', '" . $productName . "', '" . $productPrice . "')";
        if (mysqli_query($con, $query)) {
            echo "Product inserted successfully!";
        } else {
            echo "Error inserting product: " . mysqli_error($con);
        }
    }
}


$uid=$data['userid'];
$select2="select * from product where userid='" . $uid . "' ";
$result2=mysqli_query($con,$select2);

if (isset($_GET['updatepid'])) {
    $pid = $_GET['updatepid'];
    $select3 = "SELECT * FROM product WHERE pid='$pid'";
    $result3 = mysqli_query($con, $select3);
    if ($result3 && mysqli_num_rows($result3) > 0) {
        $data3 = mysqli_fetch_assoc($result3); // Fetch the data for the selected product
    } else {
        echo "Product not found for update.";
    }
}


if (isset($_GET['deletepid'])) { 
    $pid = $_GET['deletepid']; 
    $delete = "DELETE FROM product WHERE pid='$pid'"; 
    mysqli_query($con, $delete); 
    header("Location: home.php");
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <center>
    <h2>-- Product Details --</h2>
    <form method="post" action="home.php<?php if(isset($_GET['updatepid'])){ echo "?updatepid=" . $_GET['updatepid']; } ?>">
    <table>
        <tr>
            <td>Enter ProductId : </td>
            <td><input type="text" name="txtproductid" value="<?php if(isset($data3)){ echo $data3['pid']; } ?>" <?php if(isset($data3)){ ?> readonly <?php } ?>  /></td>
        </tr>

        <tr>
            <td>Enter ProductName : </td>
            <td><input type="text" name="txtproductname" value="<?php if(isset($data3)){ echo $data3['productName']; } ?>" /></td>
        </tr>

        <tr>
            <td>Enter ProductPrice : </td>
            <td><input type="text" name="txtproductprice" value="<?php if(isset($data3)){ echo $data3['productPrice']; } ?>" /></td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" name="btnsubmit" value="submit" /></td>
        </tr>
    </table>
</form>

        <table>
                <tr>
                    <th> Pid </th>
                    <th> Name </th> 
                    <th> ProductName </th>
                    <th> ProductPrice </th> 
                </tr>
                <?php
                  if(mysqli_num_rows($result2)>0){
                    while($data2 = mysqli_fetch_assoc($result2)){
                ?>
                <tr>
                    <td> <?php echo $data2['pid']; ?> </td>
                    <td> <?php echo $data2['pname']; ?> </td>
                    <td> <?php echo $data2['productName']; ?> </td>
                    <td> <?php echo $data2['productPrice']; ?> </td>
                    <td><td><a href="home.php?updatepid=<?php echo $data2['pid']; ?>">Update</a>
                        <a href="home.php?deletepid=<?php echo $data2['pid']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a></td>
                </tr>
                <?php
                    }
                }
                ?>
                </table>

    </center>
</body>
</html>