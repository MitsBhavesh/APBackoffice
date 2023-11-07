<div class="card mb-4 " style="    margin-top: 81px;" >
  <h5 class="card-header">Profile Details</h5>
  <!-- Account -->
  <?php $value = Session()->get('Login_Email')[0]->profile_pic; ?>
  @php $objData = explode("/", $value) @endphp
  
  <form id="formAccountSettings" method="POST" action="{{url('/edit')}}"  class="fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" enctype="multipart/form-data">
    <div class="card-body">
      @csrf
      <div class="d-flex align-items-start align-items-sm-center gap-4">
        <img src="assets/img/digital/{{ $objData[count($objData) - 1] }}" alt="user-avatar" class="d-block rounded imageframe" height="100" width="100" id="image" name="image">
        <div class="button-wrapper">
          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0" style="background-color: #113d35; border: #113d35;">
            <span class="d-none d-sm-block">Upload new photo</span>
            <i class="bx bx-upload d-block d-sm-none"></i>
            <input type="hidden" name="oldimage" value="assets/img/digital/{{ $objData[count($objData) - 1] }}">
            <!-- OG Input Field -->
            <input type="file" id="upload" name="upload" class="account-file-input" hidden="" accept="image/png, image/jpeg">
            <!-- <input type="file" id="upload1" name="upload1" class="account-file-input" accept="image/png, image/jpeg"> -->
          </label>
          <p class="text-muted mb-0">Allowed JPG, GIF or PNG. </p>
        </div>
      </div>
    </div>
    <hr class="my-0">
    <div class="card-body">
        <div class="row">
          <div class="mb-3 col-md-6 fv-plugins-icon-container">
            <label for="Name" class="form-label">Name</label>
            <input type="hidden" class="form-control" id="id" name="id" value = "<?php echo Session()->get('Login_Email')[0]->ID; ?>">
            <input type="text" class="form-control" id="name" name="name" value = "<?php echo Session()->get('Login_Email')[0]->name; ?>">
            @if($errors->has('name'))
                <span class="error">{{ $errors->first('name') }}</span>
            @endif
          </div>
          <div class="mb-3 col-md-6 fv-plugins-icon-container">
            <label for="APCode" class="form-label">APCode</label>
            <input class="form-control bg-secondary text-white" type="text" name="APCode" id="APCode" value="<?php echo Session()->get('Login_Email')[0]->APCode; ?>" readonly>
            @if($errors->has('APCode'))
                <span class="error">{{ $errors->first('APCode') }}</span>
            @endif
          </div>
          <div class="mb-3 col-md-6">
            <label for="mobile" class="form-label">Mobile No.</label>
            <input class="form-control" type="text" id="mobile" name="mobile" value = "<?php echo Session()->get('Login_Email')[0]->mobile_no; ?>">
            @if($errors->has('mobile'))
                <span class="error">{{ $errors->first('mobile') }}</span>
            @endif
          </div>
          <div class="mb-3 col-md-6">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value = "<?php echo Session()->get('Login_Email')[0]->Address; ?>">
            @if($errors->has('address'))
                <span class="error">{{ $errors->first('address') }}</span>
            @endif
          </div>
          
        </div>
        <div class="mt-2">
          <button type="submit" class="btn btn-primary" style="background-color: #113d35; border: #113d35;">Submit</button>
          <button type="reset" class="btn btn-label-secondary">Cancel</button>
        </div>
    </div>
  </form>  
  <!-- /Account -->
</div>

<!-- script -->
<script type="text/javascript">

  $(document).ready(function(){
    $('#upload').on('change', function () {
      const [file] = upload.files
      if (file) {      
        image.src = URL.createObjectURL(file)
      }
    });   
  });

</script>
<!-- End Script -->