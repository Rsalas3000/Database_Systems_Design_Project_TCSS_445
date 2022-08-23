<?php require_once('config.php'); ?>

<!-- This allows insertion into the Applicant table and is used with signup.php form-->

<script src ="code.js"></script>

<?php
    $connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    if ( mysqli_connect_errno() )
    {
        die( mysqli_connect_error() );
    }

    //Variables from singup.php
    $firstname = mysqli_real_escape_string($connection, $_REQUEST['firstname']);
    $lastname = mysqli_real_escape_string($connection, $_REQUEST['lastname']);
    $email = mysqli_real_escape_string($connection, $_REQUEST['email']);
    $password = mysqli_real_escape_string($connection, $_REQUEST['password']);

    $dob = mysqli_real_escape_string($connection, $_REQUEST['dateofbirth']);
    $phonenum = mysqli_real_escape_string($connection, $_REQUEST['phonenum']);
    $degree = mysqli_real_escape_string($connection, $_REQUEST['degree']);
    $location = mysqli_real_escape_string($connection, $_REQUEST['location']);

    $sql = "INSERT INTO APPLICANTS (FName, LName, DOB, PhoneNumber, Degree_Status, PreferredLocation, Password,  Email) VALUES ('$firstname', '$lastname', '$dob', '$phonenum', '$degree', '$location', '$password','$email')";


    if(mysqli_query($connection, $sql)){
?>
<html>
    <meta http-equiv="refresh" content="0; URL=index.php" />
</html>

<?php
    } else{
?>
<html>
     <meta http-equiv="refresh" content="0; URL=signup.php" />
    <script src ="code.js"></script>
    <script>error1()</script>
</html>

<?php
    }
    // Close connection
    mysqli_close($connection);
?>