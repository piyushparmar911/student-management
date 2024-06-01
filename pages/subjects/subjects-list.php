<?php
require ("../../includes/init.php");
include  pathOf("./includes/header.php");
include pathof("./includes/sidebar.php");


$UserId = $_SESSION['UserId'];
$permissions = authenticate('Subjects', $UserId);
$query = "SELECT * FROM `subjects`" ;
$index = 0;
$data = select($query);
?>

         <div class="page-wrapper">
            <div class="content container-fluid">
               <div class="page-header">
                  <div class="row align-items-center">
                     <div class="col">
                        <h3 class="page-title">Subjects</h3>
                        <ul class="breadcrumb">
                           <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                           <li class="breadcrumb-item active">Subjects</li>
                        </ul>
                     </div>
                     <?php if ($permissions['AddPermission'] == 1) { ?>
                <div class="col-auto text-right float-right ml-auto">
                    <a href="add-subject.php" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                </div>
                <?php } ?>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="card card-table">
                        <div class="card-body">
                           <div class="table-responsive">
                              <table class="table table-hover table-center mb-0 datatable">
                                 <thead>
                                    <tr>
                                       <th>Sr No</th>
                                       <th>Name</th>
                                       <th>Class Id</th>
                                       <?php if ($permissions['EditPermission'] == 1) { ?>
                                                <th>Modify</th>
                                            <?php } ?>
                                            <?php if ($permissions['DeletePermission'] == 1) { ?>
                                                <th>Delete</th>
                                            <?php } ?>
                                    </tr>
                                    
                                 </thead>
                                 <tbody>
                                 <?php if ($permissions['ViewPermission'] == 1) {
                                    foreach ($data as $row): ?>
                                       <tr>
                                          <td><?=$index += 1?></td>
                                          <td>
                                             <h2>
                                                <a><?=$row['Name']?></a>
                                             </h2>
                                          </td>
                                          <td><?=$row['ClassId']?></td>
                                          <?php if ($permissions['EditPermission'] == 1) { ?>

                                       <form action="./edit-subject" method="post">
                                                       <td>
                                                           <input type="hidden" name="id" id="Id" value="<?= $row['Id'] ?>">
                                                           <button type="submit" class="btn  about-info ml-1 btn-info btn-circle mb-2">
                                                               <i class="fa fa-edit"></i>
                                                           </button>
                                                       </td>
                                                   </form>
                                               <?php } ?>

                                               
                                             
                                           <td>
                                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteModal<?= $row['Id'] ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="deleteModal<?= $row['Id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalTitle<?= $row['Id'] ?>">Confirmation</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete this subject?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <?php if ($permissions['DeletePermission'] == 1) { ?>
                                                                        <button type="button" class="btn btn-danger" onclick="deleteSubject(<?= $row['Id'] ?>)" autofocus>Delete</button>
                                                                    <?php } ?>
                                            </tr>
                                    <?php endforeach;
                                    } ?>

    
                                          
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>


            <script>
    function deleteSubject(Id)
    {
  
        $.ajax({
            url: "../../api/subjects/deleteSubject.php",
            method : "POST",
            data  : {
                id : Id
            },
            success: function(response){
                    if(response)
                    location.reload();
            }
        })
    }

    
   
</script>
<?php
include pathOf("./includes/footer.php");
include pathOf("./includes/pageend.php"); 
include pathOf("./includes/script.php");
?>