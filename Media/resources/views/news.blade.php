<?php
//  echo "<pre>";
//  print_r($user);
//  exit;
?>
<style>
    .btnopen{
        border:none;
        padding: 0px;

    }
    .lineCum {
        line-height: 1.5em;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        text-overflow: ellipsis;
    }
    .h140{
        height: 140px;
    }
</style>



<!-- trending post -->
<div class="col-10">
    <div class="card" style="margin-top: 85px;">
        <div class="card-body">
            <div class="alert alert-success d-flex" role="alert">
            <div class="d-flex flex-column ps-1">
                <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">News</h6>
            </div>
            </div>
            <!-- <h5 class="card-title text-primary">Trending post</h5> -->
        </div>
        
        <div class="row mb-5 container cardcenter">
          @foreach($user as $value) 
            @if(isset($value['urlToImage']) ?? "" )
            <div class="col-lg-3 mb-5" >
              <a href="@php print_r( $value['url']);  @endphp">
                <button type="button" class="btnopen" data-bs-toggle="modal" data-bs-target="#basicModal">
                    <div class="card cardborder " >
                    
                        <img class="card-img-top h140" src="@php print_r( $value['urlToImage']);  @endphp" alt="Arhamshare" style="max-height: 158px!important;" />
                        <div class="card-body p-3">
                            <h6 class="card-title lineCum">@php print_r( $value['title']);  @endphp</h5>                            
                            <span class="link-primary">Learn more</span>
                        </div>
                    </div>
                </button>
              </a>  
            </div>
            @endif
            @endforeach
        </div>
        
    </div>
</div>    
