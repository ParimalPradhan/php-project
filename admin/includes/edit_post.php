<?php

if(isset(($_GET['p_id'])))
{
    $the_post_id = $_GET['p_id'];
}

$query = "SELECT * FROM posts WHERE post_id = $the_post_id";

$select_posts_id = mysqli_query($connect,$query);

while($row = mysqli_fetch_assoc($select_posts_id))
{
    $post_id = $row['post_id'];
    $post_user = $row['post_user'];                                                
    $post_title = $row['post_title'];                                                
    $post_category_id = $row['post_category_id'];                                                
    $post_status = $row['post_status'];                                                
    $post_image = $row['post_image'];                                            
    $post_tags = $row['post_tags'];       
    $post_content = $row['post_content'];       
    $post_comment_count = $row['post_comment_count'];                                                
    $post_date = $row['post_date'];

}


if(isset($_POST['update_post']))
{


    $post_title         = escape($_POST['title']);
    $post_user          = escape($_POST['post_user']);
    $post_category_id   = escape($_POST['post_category']);
    $post_status        = escape($_POST['post_status']);

    $post_image         = escape($_FILES['image']['name']);
    $post_image_temp    = escape($_FILES['image']['tmp_name']);

    $post_tags          = escape($_POST['post_tags']);
    $post_content       = escape($_POST['post_content']);    

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if(empty($post_image))
    {
        $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
        $select_image = mysqli_query($connect,$query);

        while($row = mysqli_fetch_assoc($select_image))
        {
            $post_image = $row['post_image'];
        }
    }

    $query = "UPDATE posts SET 
                     post_category_id = '{$post_category_id}', 
                     post_title = '{$post_title}',
                     post_user = '{$post_user}', 
                     post_date = now(), 
                     post_image = '{$post_image}', 
                     post_content = '{$post_content}',
                     post_tags = '{$post_tags}', 
                     post_status = '{$post_status}' ";
    $query .="WHERE post_id = {$the_post_id}";

    $update_post = mysqli_query($connect,$query);

    confirm($update_post);

    echo "<p class='bg-success p-2' text-align: center ;>Post Updated!<br><a href='../post.php?p_id={$post_id}'> View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";

    // echo "<div class='bg-success p-3' style='padding: 20px; text-align: center;'><h3>Post Updated</h3></div>";
 
   
}




?>


<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">Post Title</label>
    <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
</div>

<div class="form-group">
    <label for="post-category" >Post Category Id</label>
    <select name="post_category" id="">

        <?php

            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connect,$query);

            confirm($select_categories);

            while ($row = mysqli_fetch_assoc($select_categories))
            {
                $cat_id = $row ['cat_id'];    
                $cat_title = $row ['cat_title']; 

                echo "<option value='{$cat_id}'>{$cat_title}</option>";

            }



        ?>


    </select>
</div>

<div class="form-group">
<label for="post-status" >Post Status</label>

<select name="post_status" id="">
<option value='<?php echo $post_status ?>'><?php echo $post_status; ?></option>

<?php
    if($post_status == 'published')
    {
        echo "<option value = 'draft'>Draft</option>";
    }
    else
    {
        echo "<option value = 'published'>published</option>";

    }
?>

</select>
</div>

<?php echo "<option value='{$post_user}'>{$post_user}</option>" ?>

<div class="form-group">
    <label for="post-users" >Users</label>
    <select name="post_user" id="">

        <?php

            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connect,$query);

            confirm($select_users);

            while ($row = mysqli_fetch_assoc($select_users))
            {
                $user_id = $row ['user_id'];    
                $username = $row ['username']; 

                echo "<option value='{$username}'>{$username}</option>";

            }



        ?>


    </select>
</div>


<!-- <div class="form-group">
    <label for="title">Post Author</label>  
    <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="author">
</div> -->

<div class="form-group">
   <img width="100" src="../images/<?php echo $post_image;?>" alt="no img">
</div>

<div class="form-group">
   <input type="file" name="image">
</div>


<div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
</div>


<div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control"  name="post_content" id="summernotes" cols="100" rows="10"><?php echo $post_content;?></textarea>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
</div>


</form>