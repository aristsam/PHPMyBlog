<?php
include "header.php"; 
include "config.php";
$id = $_GET['id'];

if (empty($id)) {
    header("location:index.php");
}

// Fetch the blog post
$sql = "SELECT * FROM blog WHERE blog_id='$id'";
$run = mysqli_query($config, $sql);
$post = mysqli_fetch_assoc($run);

// Fetch comments for the blog post
$commentsSql = "SELECT * FROM comments WHERE post_id='$id' ORDER BY comment_date DESC";
$commentsRun = mysqli_query($config, $commentsSql);
?>

<div class="container mt-2">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-body">
                    <div id="single_img">
                        <?php $img = $post['blog_image'] ?>
                        <a href="admin/upload/<?= $img ?>">
                            <img src="admin/upload/<?= $img ?>" alt=" ">
                        </a>
                    </div>
                    <hr>
                    <div>
                        <h5><?= $post['blog_title'] ?></h5>
                        <p><?php echo $post['blog_body'] ?></p>
                    </div>
                </div>
            </div>
  <!-- Display Comments -->
  <div class="card mt-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Comments</h5>
                    <?php
                    while ($comment = mysqli_fetch_assoc($commentsRun)) {
                        echo "<div class='mb-3'>";
                        echo "<strong>{$comment['user_name']}</strong> on {$comment['comment_date']}<br>";
                        echo "{$comment['comment_body']}";                      
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
            <!-- Comment Form -->
            <div class="card mt-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Add a Comment</h5>
                    <form action="add_comment.php" method="post">
                        <input type="hidden" name="post_id" value="<?= $id ?>">
                        <div class="form-group">
                            <label for="user_name">Your Name</label>
                            <input type="text" class="form-control" id="user_name" name="user_name" required>
                        </div>
                        <div class="form-group">
                            <label for="comment_body">Your Comment</label>
                            <textarea class="form-control" id="comment_body" name="comment_body" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                    </form>
                </div>
            </div>
        </div>          
        <?php include "sidebar.php"; ?>
    </div>
</div>

<?php include "footer.php"; ?>
