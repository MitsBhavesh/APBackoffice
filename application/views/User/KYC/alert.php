<?php
if(!empty($_SESSION['APBackOffice_danger_alert']))
 {
//echo "login";
 	?>
  <!-- <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button> 
    <?php echo $_SESSION['APBackOffice_danger_alert']; ?>
  </div> -->
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="mdi mdi-block-helper me-2"></i><strong> <?php echo $_SESSION['APBackOffice_danger_alert']; ?></strong> 
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  
 	<?php
 unset($_SESSION['APBackOffice_danger_alert']);
}
if(!empty($_SESSION['APBackOffice_success']))
 {
//echo "login";
 ?>
<!--  <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">×</span>
    </button> 
    <?php echo $_SESSION['APBackOffice_success']; ?>
  </div> -->
  <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
      <i class="mdi mdi-check-all me-3 align-middle"></i><strong> <?php echo $_SESSION['APBackOffice_success']; ?></strong> 
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
  </div>
 	
 	<?php
 	unset($_SESSION['APBackOffice_success']);
}




?>