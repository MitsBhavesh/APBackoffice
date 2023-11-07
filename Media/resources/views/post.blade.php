{{-- @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script> -->
<style>
    .info {
        font-family: "Poppins", sans-serif;
        color: #c9d0cf;
    }
    .btnopen {
        border: none;
        padding: 0px;
    }
    .rounded {
        margin-top: -83px;
        margin-left: 10px;
    }
    .info1 {
        margin-top: -80px;
        margin-left: 100px;
        font-size: 25px;
    }
    .info2 {
        margin-top: -8px;
        margin-left: 100px;
        font-size: 13px;
    }
    .info3 {
        margin-top: -4px;
        margin-left: 100px;
        font-size: 13px;
    }
    .info4 {
        margin-top: -2px;
        margin-left: 100px;
        font-size: 13px;
    }
    .custCanvas {
        width: 220px!important;
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
                    <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Trending Post</h6>
                </div>
            </div>
        </div>
        <div class="row mb-5 container cardcenter">
            @foreach($user as $value)
           {{-- @php print_r($value); @endphp --}}
            @php $objData = explode("/", $value->image) @endphp
            @php $bobjData = explode("/", $value->bimage) @endphp
            <div class="col-md-6 col-lg-3 mb-3 h-100">
                <button type="button" class="btnopen btn-p post-cust-btn" id="btn-p" name="btn-p" value="assets/img/digital/{{ $bobjData[count($bobjData) - 1] }}"  data-bs-toggle="modal" data-bs-target="#basicModal" style="width: -webkit-fill-available;">
                    <div class="card cardborder" style="height: 332px;">               
                        <img class="card-img-top" id="scream" src="assets/img/digital/{{ $objData[count($objData) - 1] }}" alt="Card image cap" />
                        <div class="card-body">
                            <div class="">
                                <div class="">
                                    <h5 class="card-title lineCum">{{print_r($value->title)}}</h5>
                                </div>
                                {{-- <input type="hidden" name="name" id="name" value="@php print_r( $value->title);  @endphp"> --}}
                            </div>
                         </div>
                    </div>
                </button>
            </div>
            @endforeach
        </div>
    </div>
</div>


<!-- trending post -->

<div class="col-10">
    <div class="card" style="margin-top: 5px;">
        <div class="card-body">
            <div class="alert alert-success d-flex" role="alert">
                <div class="d-flex flex-column ps-1">
                    <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Fastival Post</h6>
                </div>
            </div>
        </div>
        <div class="row mb-5 container cardcenter">
            
            @foreach($fuser as $fvalue)
            {{-- @php dd($fvalue->image); @endphp --}}
            @if(!empty($fvalue->image))
           
            
             @php $objData = explode("/", $fvalue->image) @endphp
             @php $bobjData = explode("/", $fvalue->bimage) @endphp
            
             <div class="col-md-6 col-lg-3 mb-3 h-100">
                 <button type="button" class="btnopen btn-p post-cust-btn" id="btn-p" name="btn-p" value="assets/img/digital/{{ $objData[count($objData) - 1] }}"  data-bs-toggle="modal" data-bs-target="#basicModal">
                     <div class="card cardborder" style="height: 332px;">               
                         <img class="card-img-top " id="scream" src="assets/img/digital/{{ $bobjData[count($bobjData) - 1] }}" alt="Card image cap" />
                         <div class="card-body">
                             <div class="">
                                 <div class="">
                                     <h5 class="card-title lineCum">{{print_r($fvalue->title)}}</h5>
                                 </div>
                             </div>
                          </div>
                     </div>
                 </button>
             </div>
             @endif
             @endforeach
        </div>
    </div>
</div>
{{-- <img id="scream" src="assets/img/digital/Happy New Year.jpg" alt="Card image cap" style="width: 50px;margin-top: -332px;position: absolute;z-index: 1;margin-left: -171px;display: none;" /> --}}
<div class="mt-3">
    <!-- Modal -->
    <div class="modal fade" id="basicModal"  tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="exampleModalLabel1">Post title</h5> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- <canvas id="displaycake_sketch"></canvas> -->
                <div class="modal-body" id="html-content-holder" style="    align-self: center;">
                    <div id="smileyLoader">
                        <svg role="img" aria-label="Mouth and eyes come from 9:00 and rotate clockwise into position, right eye blinks, then all parts rotate and merge into 3:00" class="smiley" viewBox="0 0 128 128" width="128px" height="128px">
                          <defs>
                            <clipPath id="smiley-eyes">
                              <circle class="smiley__eye1" cx="64" cy="64" r="8" transform="rotate(-40,64,64) translate(0,-56)" />
                              <circle class="smiley__eye2" cx="64" cy="64" r="8" transform="rotate(40,64,64) translate(0,-56)" />
                            </clipPath>
                            <linearGradient id="smiley-grad" x1="0" y1="0" x2="0" y2="1">
                              <stop offset="0%" stop-color="#000" />
                              <stop offset="100%" stop-color="#fff" />
                            </linearGradient>
                            <mask id="smiley-mask">
                              <rect x="0" y="0" width="128" height="128" fill="url(#smiley-grad)" />
                            </mask>
                          </defs>
                          <g stroke-linecap="round" stroke-width="12" stroke-dasharray="175.93 351.86">
                            <g>
                              <rect fill="hsl(193,90%,50%)" width="128" height="64" clip-path="url(#smiley-eyes)" style="fill: #97b23d;" />
                              <g fill="none" stroke="hsl(193,90%,50%)" style="    stroke: #97b23d;">
                                <circle class="smiley__mouth1" cx="64" cy="64" r="56" transform="rotate(180,64,64)" />
                                <circle class="smiley__mouth2" cx="64" cy="64" r="56" transform="rotate(0,64,64)" />
                              </g>
                            </g>
                            <g mask="url(#smiley-mask)">
                              <rect fill="hsl(223,90%,50%)" width="128" height="64" clip-path="url(#smiley-eyes)" style="    fill: rgb(0 61 55);" />
                              <g fill="none" stroke="hsl(223,90%,50%)" style="    stroke: rgb(0 73 66);">
                                <circle class="smiley__mouth1" cx="64" cy="64" r="56" transform="rotate(180,64,64)" />
                                <circle class="smiley__mouth2" cx="64" cy="64" r="56" transform="rotate(0,64,64)" />
                              </g>
                            </g>
                          </g>
                        </svg>
                    </div>
                    <canvas id="myCanvas" class="custCanvas" width="1200px" height="1200px" style="border:1px solid #d3d3d3;display: none;font-family: Poppins">
                          
                    </canvas>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-label-secondary" onclick="download_image()">Download</button>               
                </div>
            </div>
        </div>
        
    </div>
</div>
<script>
    const ProfileData = [@php echo json_encode(Session()->get('Login_Email')[0]) @endphp];
    console.log(ProfileData);
</script>
<script type="text/javascript">
        
    $(document).ready(function () {
        
        
        $(".post-cust-btn").on("click", function () { 
            
            $("#smileyLoader").show();
            $("#myCanvas").hide();

            var pathImg = $(this).val();
            // alert(pathImg);
            
            // var profilePath = "./assets/img/digital/";
            var canvas = document.getElementById("myCanvas");
            var ctx = canvas.getContext("2d");
            // var img = document.getElementById("scream");
            var img = new Image();
            img.src = pathImg;
            // alert(img.src);

            setTimeout(function(){
              //put your code in here to be delayed by 2 seconds
                ctx.drawImage(img, 0, 0, 1200, 1200);
                ctx.fillStyle = "white";
                ctx.font = "40px sans-serif";
                // var nameNew = ProfileData[0].name[0].toUpperCase() + 
                const str = ProfileData[0].name;

                const arr = str.split(" ");

                for (var i = 0; i < arr.length; i++) {
                    arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1);

                }

                const str2 = arr.join(" ");


                ctx.fillText(str2,210,1050);
                ctx.font = "22px sans-serif";
                ctx.fillText(ProfileData[0].Address,210,1090);
                ctx.font = "28px sans-serif";
                ctx.fillText("Contact : (+91) " + ProfileData[0].mobile_no,210,1130);
                ctx.fillText("AP.Code : " + ProfileData[0].APCode,210,1170);

                var proData = ProfileData[0].profile_pic.split("/");
                var ext = proData[proData.length - 1];

                var img2 = new Image();
                img2.src = "assets/img/digital/"+ext+"" ;
                // console.log(img2);
                // ctx.arc(250, 250, 250, 0, Math.+PI * 2, true);
                ctx.save();
                ctx.beginPath();
                ctx.arc(110, 1100, 75, 0, Math.PI * 2, false);
                ctx.closePath();
                ctx.clip();
                
                // ctx.drawImage(img2, 30, 1020 , 150, 150);
                ctx.drawImage(img2, 35, 1025 , 150, 150); 
                ctx.restore();
                $("#smileyLoader").hide();
                $("#myCanvas").show();
                $("#myCanvas").addClass("custCanvas");
            },3000);

            
            return false;
            
        });

    });
</script>
<script>
    var c=document.getElementById("myCanvas");
    var ctx=c.getContext("2d");
    ctx.beginPath();
    ctx.arc(100,75,50,0,2*Math.PI);
    ctx.stroke();

    function download_image()
    {
        var canvas = document.getElementById("myCanvas");
        image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
        var link = document.createElement('a');
        link.download =     "my-image.png";
        link.href = image;
        link.click();
    }
</script>

