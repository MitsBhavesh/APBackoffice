<style>
    iframe{
        margin-top: 20px;

    }
</style>
<!-- Festival post -->
<div class="col-10">
    <div class="card" style="margin-top: 85px;">
        <div class="card-body">
        <div class="alert alert-success d-flex" role="alert">
          <div class="d-flex flex-column ps-1">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Video</h6>
          </div>
        </div>
        

            <!-- <h5 class="card-title text-primary">Trending post</h5> -->
        </div>
        <div class="row mb-5 container">
        @foreach($res as $value)
            <div class="col-md-6 col-lg-3 mb-3">
                <div class="card cardborder h-80 pt-10">
                    <iframe width="250" height="200" src="@php print_r( $value->video_url);  @endphp" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>                    <!-- <iframe width="250" height="200"     margin-top="20px" src="https://www.youtube.com/embed/8mgco2XesgY?list=PLl-MVukPcAXDZWLiPmdTvD9oIyIHjvS0q" title="How to Generate EDIS in Backoffice?" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>         -->
                    <div class="card-body">
                        <h5 class="card-title">@php print_r( $value->title);  @endphp</h5>
                    </div>
                </div>
            </div>
            @endforeach    
        </div>
    </div>
</div>



<!-- <video width="320" height="240" controls>
  <source src="assets/img/movie.mp4" type="video/mp4">
  <source src="movie.ogg" type="video/ogg">
  Your browser does not support the video tag.
</video> -->