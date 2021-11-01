<?php ob_start(); ?>


<?php include "db.php"; ?>

<?php session_start() ?>

<?php

    if(isset($_POST['login']))
    {

        // $password = "secret";
        // $has_format ="$2y$10$";
        
        // $salt = "thisisastringof22words";

        // echo strlen($salt);

        // crypt($password, "$2y$10$thisisastringof22words");


        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = mysqli_real_escape_string($connect, $username);
        $password = mysqli_real_escape_string($connect, $password);
        //this function is used to prevent sql injection
        //https://www.php.net/manual/en/mysqli.real-escape-string.php

        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $select_user_query = mysqli_query($connect, $query);

        if(!$select_user_query)
        {
            die("Query Failed " . mysqli_error($connect));
        }

        while($row = mysqli_fetch_array($select_user_query))
        {
           $db_user_id          =   $row['user_id'];
           $db_username         =   $row['username'];
           $db_user_password    =   $row['user_password'];
           $db_user_firstname   =   $row['user_firstname'];
           $db_user_lastname    =   $row['user_lastname'];
           $db_user_role        =   $row['user_role'];
        }

        // $password = crypt($password, $db_user_password);


        //This below is not that strict method and some may have some problem in it

        // if($username !== $db_username && $password !== $db_user_password)
        // {
        //     header("Location: ../index.php");
        // }
        // else
        
        // if( password_verify($password, $db_user_password))
        // {
        //     if(session_status() == PHP_SESSION_NONE)
        //     { session_start(); }

        // if ($username == $db_username && $password == $db_user_password)
        
        if(password_verify($password, $db_user_password))
        {

            $_SESSION['username']   =  $db_username;
            $_SESSION['firstname']  =  $db_user_firstname;
            $_SESSION['lastname']   =  $db_user_lastname;
            $_SESSION['user_role']  =  $db_user_role;


            header("Location: ../admin");

        }
        else 
        {
            header("Location ../index.php");

        }

    
    //This is a improved code that strickly checked bothe the field, but facing $db_username problem here
    
    // if($username === $db_username && $password === $db_user_password)
    // {

    //     if (session_status() == PHP_SESSION_NONE) session_start(); // added this!

    //     $_SESSION['username']   =  $db_username;
    //     $_SESSION['firstname']  =  $db_user_firstname;
    //     $_SESSION['lastname']   =  $db_user_lastname;
    //     $_SESSION['user_role']  =  $db_user_role;
       
    //     header("Location: ../admin");
    
    // }
    // else 
    // {
    //     header("Location ../index.php");
    // }

}


?>