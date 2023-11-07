<style>
    .btnopen{
        border:none;
        padding: 0px;
    }
    .modal-body{
        max-height: 300px!important;
        align-self: center;
    }
    .card-img{
        max-width :300px;
        max-height: 270px;
    }
    .custCanvas {
        width: 500px!important;
    }
    .custCard {
      max-height: unset;
      height: 360px;
    }
    .lineCum {
        line-height: 1.5em;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        text-overflow: ellipsis;
    }
</style>

<!-- trending post -->
<div class="col-10">
    <div class="card" style="margin-top: 85px;">
        <div class="card-body">
            <div class="alert alert-success d-flex" role="alert">
              <div class="d-flex flex-column ps-1">
                <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Updates</h6>
              </div>
            </div>
            <!-- <h5 class="card-title text-primary">Trending post</h5> -->
        </div>
        <div class="row mb-5 container cardcenter">
          @foreach($res as $value)
          {{-- @php print_r($value); @endphp --}}
          @php $objData = explode("/", $value->image) @endphp
            <div class="col-md-6 col-lg-3 mb-3">
                <button type="button" class="btnopen post-cust-btn update-btn " data-bs-toggle="modal" id="btn-p" name="btn-p"  value="assets/img/digital/{{ $objData[count($objData) - 1] }} ,{{ $value->title}}, {{$value->description}}, {{$value->m_link  }}" data-bs-target="#basicModal" >
                    <div class="card cardborder custCard">
                      <div class="modal-body " id="html-content-holder " style="    align-self: center;">

                        <img src="assets/img/digital/{{ $objData[count($objData) - 1] }}" alt=" " height="250" width="250">
                        <div class="card-body p-3">
                            <h5 class="card-title lineCum">@php print_r( $value->title);  @endphp</h5>
                        </div>
                    </div>
                </button>
            </div>
          @endforeach
        </div>
    </div>
</div>

<div class="mt-3">
  <!-- Modal -->
  <div class="modal fade" id="basicModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <p class="titlev container"  id="titlev" name="titlev" style="border: none;">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>     
        <div class="modal-body myimage" id="html-content-holder" style="align-self: center;">
      </div>
        <div class="modal-bodyd " style="text-align:center;">
            <p class="description container" id="description" name="description" style="border: none;">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
            <a href="" class="btn  modal-a-tag" style="background-color:#364f4b; color:#fff;">Join Now</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
        
  $(document).ready(function () {
      $(".post-cust-btn").on("click", function () { 
          var pathImg = $(this).val();
          var upimg = pathImg.split(",")[0];
          // alert(pathImg.split(",")[0]);
          // var profilePath = "./assets/img/digital/";
          var canvas = document.getElementById("myCanvas");
          var ctx = canvas.getContext("2d");
          // var img = document.getElementById("scream");
          var img = new Image();
          img.src = upimg;
          // alert(img);
          ctx.drawImage(img, 0, 0, 200, 200);

          
          $("#myCanvas").addClass("custCanvas");
          return false;
          
      });

      
  });
</script>

<script type="text/javascript">
  $('.update-btn').on('click', function()
    {
      $('#myimage1').remove();
      var title = $(this).val();
      $("#titlev").html(title.split(",")[1]);
      $("#description").html(title.split(",")[2]);
      $(".myimage").append('<img src="'+title.split(",")[0]+'" id="myimage1" alt=" " height="250" width="250">');

      document.getElementById('m_linkv').value = $(".modal-a-tag").attr("href", title.split(",")[3]);
    });
</script>