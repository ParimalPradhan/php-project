<?php

if(isset($_POST['create_user']))
{
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname  = escape($_POST['user_lastname']);
    $user_role      = escape($_POST['user_role']);

    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];

    $username      = escape($_POST['username']);
    $user_email    = escape($_POST['user_email']);
    $user_password = escape($_POST['user_password']);
    // $post_date = date('d-m-y');

    // move_uploaded_file($post_image_temp, "../images/$post_image");

    $user_password = password_hash ($user_password, PASSWORD_BCRYPT, array('cost' => 10));

      $query = 
      "INSERT INTO users(username,
                        user_password, 
                        user_firstname,
                        user_lastname,
                        user_email,
                        user_role)";
             
      $query .= 
      "VALUES   ('{$username}',
                '{$user_password}',
                '{$user_firstname}',
                '{$user_lastname}',
                '{$user_email}',
                '{$user_role}')"; 
             
$create_user_query = mysqli_query($connect,$query);

confirm($create_user_query);



// echo "User Created: " . " " . "<a href= 'users.php'>View Users</a> ";

echo "<div class='bg-success p-3' style='padding: 20px; text-align: center;'><h3>User Successfully Added</h3></div>";
header("Refresh:3; url='users.php' ");
echo "<br>" . "If not refreshed, click the link - " . "<a href= 'users.php'>View Users</a>" . "<br>" ;

// header ("location:users.php ");
}


?>



<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="user_firstname">First Name</label>
    <input type="text" class="form-control" name="user_firstname">
</div>

<div class="form-group">
    <label for="user_lastname">Last Name</label>
    <input type="text" class="form-control" name="user_lastname">
</div>


<div class="form-group">
    <label for="user_role" >User Roles: </label>
    <select name="user_role" id="">


        <option value="admin">Admin</option>
        <option value="Subscriber">Subscriber</option>        


    </select>
</div>




<div class="form-group">
    <label for="username">User Name</label>
    <input type="text" class="form-control" name="username">
</div>

<!-- <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="image">
</div> -->


<div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" class="form-control" name="user_email">
</div>


<div class="form-group">
    <label for="user_password">Password</label>
    <input type="password" class="form-control" name="user_password">
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
</div>


</form>