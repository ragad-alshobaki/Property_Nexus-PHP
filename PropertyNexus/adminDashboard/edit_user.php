<?php
include("connection.php");


?>

<!-- ==================================================================================================================== -->
<?php
//To fetch data
    if (isset($_GET['userID'])) {
        $userID = $_GET['userID'];
    
        $select_Q = "SELECT * FROM users WHERE userID = $userID";
                $select_r = mysqli_query($db_conn, $select_Q);
                if (!$select_r) {
                    die("Query failed". mysqli_error($db_conn));
                }else{
                    $rec = mysqli_fetch_assoc($select_r);
                }
                
                }
            
//To update data
    if (isset($_POST["updUser"])) {
        $userFname = $_POST["uFname"];
        $userLname = $_POST["uLname"];
        $uPW = $_POST["u_pw"];
        $uEmail = $_POST["u_email"];
        $uAdress = $_POST["u_adress"];
        $uMobile = $_POST["u_mob"];

        $update_q = "UPDATE users set userFname = '$userFname', userLname = '$userLname', userAdress =' $uAdress', userPW = '$uPW',
            userMobile = '$uMobile', userEmail = '$uEmail' WHERE userID = '$userID'";
        $update_r = mysqli_query($db_conn, $update_q);
        if (!$update_r) {
            die("Update failed". mysqli_error($db_conn));
    }else{
        echo '<script>alert("Update successfully!")</script>'; 

    }
}

?>

<form action="edit_user.php?userID=<?php echo $userID ?>" method="post">
    <label for="uFname">First Name:</label>
    <input type="text" name="uFname" value=<?php echo $rec['userFname']?>><br>

    <label for="uLname">Last Name:</label>
    <input type="text" name="uLname" value=<?php echo $rec['userLname']?>><br>

    <label for="u_pw">Password:</label>
    <input type="password" name="u_pw"value=<?php echo $rec['userPW']?>><br>

    <label for="u_email">Email:</label>
    <input type="email" name="u_email" value=<?php echo $rec['userEmail']?>><br>

    <label for="u_adress">Address:</label>
    <input type="text" name="u_adress" value=<?php echo $rec['userAdress']?>><br>

    <label for="u_mob">Mobile:</label>
    <input type="text" name="u_mob" value=<?php echo $rec['userMobile']?>><br>

    <input type="submit" name="updUser" value="Save">
</form>
