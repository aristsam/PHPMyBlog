<?php include "header.php";
 if(isset($_SESSION['user_data'])) {
   $userID=$_SESSION['user_data']['0'];
 }  

?>
<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <h5 class="mb-2 text-gray-800">Blog Posts</h5>
   <!-- DataTales Example -->
   <div class="card shadow">
      <div class="card-header py-3 d-flex justify-content-between">
         <div>
            <a href="add_blog.php">
               <h6 class="font-weight-bold text-primary mt-2">Add New Post</h6>
            </a>
         </div>
        
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>Sr.No</th>
                     <th>Title</th>
                     <th>Category</th>
                     <th>Author</th>
                     <th>Date</th>
                     <th colspan="2">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  $sql="SELECT * FROM blog LEFT JOIN categories ON blog.category=categories.cat_id 
                  LEFT JOIN user ON blog.author_id=user.user_id WHERE user_id='$userID' ORDER BY blog.publish_date DESC";
                  $query=mysqli_query($config,$sql);
                  $rows=mysqli_num_rows($query);
                  $count=0;
                  if($rows){
                     while($result=mysqli_fetch_assoc($query)){
                        ?>
                        <tr>
                           <td><?= ++$count ?></td>
                           <td><?= $result['blog_title']  ?></td>
                           <td><?= $result['cat_name']  ?></td>
                           <td><?= $result['username']  ?></td>
                           <td><?= $result['publish_date']  ?></td>
                           <td><a href="edit_blog.php?id=<?= $result['blog_id'] ?>" class="btn btn-sm btn-success">Edit</a></td>
                           <td>
                           <form   class="mt-2" method="POST"
                            onsubmit="return confirm('Do you really want to delete? Please make sure you delete all comments before you delete')">
                              <input type="hidden" name="id" value="<?= $result['blog_id'] ?>" >
                              <input type="hidden" name="image" value="<?= $result['blog_image'] ?>" >
                                 <input type="submit" name="deletePost" value="Delete" class="btn btn-sm btn-danger" >
                              </form>
                           </td>
                        </tr>
                        <?php

                     }
                  } else{
                     ?>
                     <tr><td colspan="7">The table is empty.</td></tr>
                     <?php
                  }

                  
                  ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<!-- /.container-fluid -->
</div>
<?php include "footer.php";
if(isset($_POST['deletePost'])){
   $id=$_POST['id'];
   $image="upload/".$_POST['image'];
   $delete="DELETE FROM blog WHERE blog_id='$id'";
   $run=mysqli_query($config,$delete);
   if($run){
      unlink($image);
      $msg=['Post has been deleted','alert-success'];
            $_SESSION['msg']=$msg;
        header('location:index.php');
   } else {
      $msg=['Failed to delete','alert-danger'];
      $_SESSION['msg']=$msg;
  header('location:index.php');
   }
}

?>