<?php
require("../../includes/init.php");
include  pathOf("./includes/header.php");
include pathof("./includes/sidebar.php");



$UserId = $_SESSION['UserId'];
$permissions = authenticate('Leave', $UserId);
$Id = $_POST['id'];
$query = "SELECT * FROM `leave` WHERE `Id` = '$Id'";
$queryUser = "SELECT `Id`, `Name` FROM `users`";

$resultUser = select($queryUser);
$data = selectOne($query);
?>



<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Edit Leave</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="leave-list.php.html">Leave</a></li>
                        <li class="breadcrumb-item active">Edit Leave</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title"><span>Leave Details</span></h5>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Leave ID</label>
                                        <input type="text" readonly class="form-control" id="Id" value="<?=$data['Id']?>">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>User Id</label>
                                        <select id="UserId" class="form-control">
                                                <?php foreach ($resultUser as $user) : ?>
                                                    <option><?=$user['Id'] ?> - <?=$user['Name'] ?></option>
                                                    <?= $user['Id'] , $user['Name'] ?>
                                                <?php endforeach; ?>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Leave Start Date</label>
                                        <input type="date" class="form-control" id="DateStart" value="<?=$data['DateStart']?>">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Leave End Date</label>
                                        <input type="date" class="form-control" id="DateEnd" value="<?=$data['DateEnd']?>">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Leave reason</label>
                                        <input type="text" class="form-control" id="Reason" value="<?=$data['Reason']?>">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary" onclick="updatedata(event)">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

 
<!-- Sucess modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel">Success</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        leave updated successfully!
      </div>
    </div>
  </div>
</div>

<!-- warning Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel"><h4 class="text-danger">Warning</h4></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Please fill the all fields.
      </div>
    </div>
  </div>
</div>


<script>
    function updatedata(event) {
        event.preventDefault();
        
        let Id =  $('#Id').val();
        let UserId = $('#UserId').val();
        let DateStart = $('#DateStart').val();
        let DateEnd = $('#DateEnd').val();
        let Reason = $('#Reason').val();

        if (!DateStart.trim() || !UserId.trim() || !DateEnd.trim() || !Reason.trim()) {
        $('#errorModal').modal('show');
        setTimeout(function() {
            $('#errorModal').modal('hide');
        }, 1500);
        return;
    }

        $.ajax({
            url: '../../api/leaves/updateleave.php',
            type: 'POST',
            data: {
                Id: Id,
                UserId: UserId,
                DateStart: DateStart,
                DateEnd: DateEnd,
                Reason: Reason
            },
            success: function(response) {
                console.log(response); 
                if (response.error) {
                    alert("Error: " + response.message); 
                } else {
                    $('#successModal').modal('show');
                    setTimeout(function() {
                        $('#successModal').modal('hide');
                        redirectToClassList(); 
                    }, 1500);
                }
            }
        });
    }

function redirectToClassList() {
    window.location.href = 'leave-list.php';
    }
    </script>


<?php
include pathOf("./includes/footer.php");
include pathOf("./includes/pageend.php");
include pathOf("./includes/script.php");
?>