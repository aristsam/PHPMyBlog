<?php include "header.php"; ?>

<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <h5 class="mb-2 text-gray-800">Comments</h5>
   <!-- DataTales Example -->
   <div class="card shadow">
      <div class="card-header py-3 d-flex justify-content-between">
         
         <div>
            <form class="navbar-search">
               
            </form>
         </div>
      </div>
      <div class="card-body">
         <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
               <thead>
                  <tr>
                     <th>Sr.No</th>
                     <th>Username</th>                    
                     <th>Comment content</th>
                     <th>Date</th>                    
                     <th colspan="2">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  $sql="SELECT * FROM comments";
                  $query=mysqli_query($config,$sql);
                  $rows=mysqli_num_rows($query);
                  $count=0;
                  if($rows){
                     while($row=mysqli_fetch_assoc($query)){
                        ?>
                        <tr>
                           <td><?= ++$count ?></td>
                           <td><?= $row['user_name'] ?></td>
                           <td><?= $row['comment_body'] ?></td>
                           <td><?= $row['comment_date'] ?></td>
                           
                           <td>
                           <form action="" method="POST" onsubmit="return confirm('Do you really want to delete this comment?')">
                              <input type="hidden" name="comID" value="<?= $row['comment_id'] ?>" >
                                 <input type="submit" name="deleteCom" value="Delete" class="btn btn-sm btn-danger" >
                              </form>
                           </td>
                        </tr>
                        <?php
                     }
                  } else {
                     ?>
                     <tr><td colspan="4">No record found</td></tr>
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
if(isset($_POST['deleteCom'])){
   $id=$_POST['comID'];
   $delete="DELETE FROM comments WHERE comment_id='$id'";
   $run=mysqli_query($config,$delete);
   if($run){
      $msg=['Comment has been deleted','alert-success'];
            $_SESSION['msg']=$msg;
        header('location:delete_comment.php');
   } else {
      $msg=['Failed to delete','alert-danger'];
      $_SESSION['msg']=$msg;
  header('location:delete_comment.php');
   }
}


?>
