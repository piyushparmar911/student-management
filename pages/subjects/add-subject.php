<?php
require("../../includes/init.php");
include  pathOf("./includes/header.php");
include pathof("./includes/sidebar.php");


$UserId = $_SESSION['UserId'];
$permissions = authenticate('Subject', $UserId);
$queryclass ="SELECT `Id`, `Name` FROM `class`";

$resultclass = select($queryclass);
?>


<div class="page-wrapper">
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Add Subject</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="subjects.html">Subject</a></li>
                        <li class="breadcrumb-item active">Add Subject</li>
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
                                    <h5 class="form-title"><span>Subject Information</span></h5>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Subject Name</label>
                                        <input type="text" autofocus id="Name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Class Id</label>
                                        <select id="ClassId" class="form-control">
                                                <?php foreach ($resultclass as $class) : ?>
                                                    <option><?=$class['Id'] ?> - <?=$class['Name'] ?></option>
                                                    <?= $class['Id'] , $class['Name'] ?>
                                                <?php endforeach; ?>
                                            </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="button" onclick="insertdata()" class="btn btn-primary">Submit</button>
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
<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="successModalLabel"><h5 class="text-success">Success</h5></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Subject added successfully!
      </div>
    </div>
  </div>
</div>
<script>
    function insertdata() {
        let Name = $('#Name').val(); 
        let ClassId = $('#ClassId').val();

        if (!Name.trim()) {
        $('#errorModal').modal('show');
        setTimeout(function() {
            $('#errorModal').modal('hide');
        }, 1500);
        return;
    }

        $.ajax({
            url: '../../api/subjects/insertSubject.php',
            type: 'POST',
            data: {
                Name: Name,
                ClassId: ClassId
                
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
    window.location.href = 'subjects-list.php';
    }
</script>

<?php
include pathOf("./includes/footer.php");
include pathOf("./includes/pageend.php");
include pathOf("./includes/script.php");
?>