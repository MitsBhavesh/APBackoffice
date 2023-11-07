    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Video Gallery</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                <?php
               if(!empty($results))
               {
                  // print_r($results);exit();
                 $i=1;
                foreach ($results as  $value) 
                   {
                     // $Row_ID =$value['Row_id'];
                     // $Title =$value['title'];
                     // $Description =$value['description'];
               ?>

                
                    <!-- <div class="col-sm-12"> -->
                        <div class="col-xl-6">
                            <div class="card border-primary">
                                <div class="card-header bg-transparent border-primary"
                                    style="background-color: #0b5639!important;padding: 9px!important;">
                                    <h5 class="my-0 text-primary" style="color:#ffff!important;"><i
                                            class="mdi mdi-clipboard-account me-3"></i><?php echo $value['title'];?></h5>
                                    <p class="card-title-desc" style="color:#ffff!important;"><i
                                            class="mdi mdi-account-arrow-right me-3"></i><?php echo $value['description'];?></p>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <!-- 16:9 aspect ratio -->
                                    <div class="ratio ratio-16x9">
                                        <iframe width="727" height="409" src="<?php echo $value['url'];?>"
                                            title="<?php echo $value['description'];?>" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    <!-- </div> -->
                
                <?php
                  $i++;
                  }
                  }
               ?>

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->