<?php include_once "include/db.php"?>
<?php include "include/header.php"?>
<?php include "include/navigation.php"?>



    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php

                if(isset($_GET['p_id']))
                {

                    $the_post_id = $_GET['p_id'];
                    $the_post_author = $_GET['author'];

                }

                    $query = "SELECT * FROM posts WHERE post_user= '{$the_post_author}'";
                    $select_all_posts_query = mysqli_query($connect,$query);

                    while($row = mysqli_fetch_assoc($select_all_posts_query))
                    {
                        $post_title = $row ['post_title'];
                        $post_author = $row ['post_user'];
                        $post_date = $row ['post_date'];
                        $post_image = $row ['post_image'];
                        $post_content = $row ['post_content'];
                        
                ?>


                    
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $the_post_id ?>"><?php echo $post_title ?></a>
                </h2>
              
                <p class="lead">
                    all post by <?php echo $post_author ?></a>
                </p>
              
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
              
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
              
                <p><?php echo $post_content ?>.</p>
                <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                <hr>

                 <?php 
                    }
                ?>

                <!-- Blog Comments -->


                <?php


                    if(isset($_POST['create_comment']))
                    {
                        

                        $the_post_id = $_GET['p_id'];

                        $comment_author  = $_POST['comment_author'];
                        $comment_email   = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];

                        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content))
                        {

                        $query = "INSERT INTO comments 
                                              (comment_post_id,
                                              comment_author,
                                              comment_email,
                                              comment_content,
                                              comment_status,
                                              comment_date)

                                    VALUES  ($the_post_id,
                                            '{$comment_author}',
                                            '{$comment_email}',
                                            '{$comment_content}',
                                            'unapproved',
                                             now())";

                        $create_comment_query = mysqli_query($connect,$query);

                        if(!$create_comment_query)
                        {
                            die('Query Failed' . mysqli_error($connect));
                        }

                        $query = "UPDATE posts SET post_comment_count = post_comment_count + 1";
                        $query .= " WHERE post_id = $the_post_id";

                        $update_comment_count = mysqli_query($connect,$query);

                        }
                        else
                        {
                            echo "<script>alert('Fields cannot be empty') </script>";
                        }

                    }
                

                ?>

      

                
            </div>

            <?php include "include/sidebar.php"?>

            
        </div>
        <!-- /.row -->

        <hr>

       <?php include "include/footer.php"?>