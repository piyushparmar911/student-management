<?php
require ("../../includes/init.php");
include  pathOf("./includes/header.php");
include pathof("./includes/sidebar.php");


$query = "SELECT * FROM `roles`";

$data = select($query);
?>

         <div class="page-wrapper">
            <div class="content container-fluid">
               <div class="page-header">
                  <div class="row align-items-center">
                     <div class="col">
                        <h3 class="page-title">Roles</h3>
                        <ul class="breadcrumb">
                           <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                           <li class="breadcrumb-item active">Roles</li>
                        </ul>
                     </div>
                     <div class="col-auto text-right float-right ml-auto">
                        <a href="add-role.php" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                     </div>
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
                                       <th>Role Name</th>
                                       <th>Modify</th>
                                       <th>Delete</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php foreach($data as $row){?>
                                    <tr>
                                       <td><?=$row['Id']?></td>
                                       <td>
                                          <h2>
                                             <a><?=$row['Name']?></a>
                                          </h2>
                                       </td>
                                          
                                       <td class="text-left">
                                            <a href="edit-role.php?id=<?=$row['Id']?>" class="btn btn-sm bg-success-light ml-2">
                                                <i class="fas fa-pen"></i>

                                            </a>
                                        </td>
                                        <td class="text-left">
                                            <a href="../../api/roles/deleteRoles.php?id=<?=$row['Id']?>" class="btn btn-sm bg-danger-light ml-1">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                    
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>


<?php
include pathOf("./includes/footer.php");
include pathOf("./includes/pageend.php"); 
include pathOf("./includes/script.php");
?>