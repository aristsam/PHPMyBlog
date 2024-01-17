<?php
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $post_id = mysqli_real_escape_string($config, $_POST["post_id"]);
    $user_name = mysqli_real_escape_string($config, $_POST["user_name"]);
    $comment_body = mysqli_real_escape_string($config, $_POST["comment_body"]);

    
    $insertCommentSql = "INSERT INTO comments (post_id, user_name, comment_body, comment_date) 
                         VALUES ('$post_id', '$user_name', '$comment_body', NOW())";

    if (mysqli_query($config, $insertCommentSql)) {
        
        header("location: single_post.php?id=$post_id");
        exit();
    } else {
       
        echo "Error: " . mysqli_error($config);
    }
} else {
    
    echo "Invalid request!";
}
?>
