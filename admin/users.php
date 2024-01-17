<?php include "header.php";
$sql="SELECT * FROM user";
$query=mysqli_query($config,$sql);
$rows=mysqli_num_rows($query);


?>

<!-- Begin Page Content -->
<div class="container-fluid">
   <!-- Page Heading -->
   <h5 class="mb-2 text-gray-800">Users</h5>
   <!-- DataTales Example -->
   <div class="card shadow">
      <div class="card-header py-3 d-flex justify-content-between">
         <div>
            <a href="add_user.php">
               <h6 class="font-weight-bold text-primary mt-2">Add New User</h6>
            </a>
         </div>
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
                     <th>Email</th> 
                     <th>Role</th>                     
                     <th colspan="2">Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  $count=0;
                  if($rows){
                     while($result=mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                           <td><?= ++$count ?></td>
                           <td><?= $result['username'] ?></td>
                           <td><?= $result['email'] ?></td>
                           <td>
                              <?php
                           $role=$result['role'];
                           if($role==1){
                              echo "Admin";
                           }else {
                              echo "Co-Admin";
                           }
                            ?>
                            </td>
                            <td>
                            <form class="mt-2" action="" method="POST" 
                            onsubmit="return confirm('Are you sure you want to delete this user?')">
                              <input type="hidden" name="userid" value="<?= $result['user_id'] ?>" >
                                 <input type="submit" name="deleteUser" value="Delete" class="btn btn-sm btn-danger" >
                              </form>
                            </td>
                        </tr>
                        <?php

                     }
                  }
                  else {
                     ?>
                     <tr><td>User not found</td></tr>
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
if(isset($_POST['deleteUser'])){
   $id=$_POST['userid'];
   $delete="DELETE FROM user WHERE user_id='$id'";
   $run=mysqli_query($config,$delete);
   if($run){
      $msg=['User has been deleted','alert-success'];
            $_SESSION['msg']=$msg;
        header('location:users.php');
   } else {
      $msg=['Failed to delete','alert-danger'];
      $_SESSION['msg']=$msg;
  header('location:users.php');
   }
}



?>