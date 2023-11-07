<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<?php ob_flush();?>
<div class="main-content">
   <div class="page-content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                  <h4 class="mb-sm-0 font-size-18"></h4>
                   <a href="<?php echo base_url()?>Digital"><i
                                         class="mdi mdi-keyboard-backspace"></i> Back</a>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-xl-12">
               <div class="card border-primary">
                  <div class="card-header" style="background-color: #0b5639!important;padding: 9px!important;">
                     <h6 class="card-title" style="color:#ffff!important;"><i class="mdi mdi-digital-ocean me-3"
                        style="color: #ffff;"></i>Sales Kit</h6>
                  </div>
                  <div class="card-body">
                     <div class="row">
                        <!-- Festival Post -->
                         <?php 
                        $i=1;
                         foreach ($result as $value){?>
                        <div class="col-md-6 col-xl-4">
                           <div class="card">
                                 <div class="card-body">
                                    <ul id="lightgallery_s<?php echo $i;?>" class="list-unstyled row">
                                    <li data-src="<?php echo base_url();?>assets/images/small/Sale_post/<?php echo $value['File_name'];?>"
                                       data-sub-html="<h4><?php echo $value['Title'];?></h4><p><?php echo $value['Descr'];?></p>"
                                        data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1">
                                            <img class="card-img-top img-fluid box1 "
                                                src="<?php echo base_url();?>assets/images/small/Sale_post/<?php echo  $value['File_name'];?>"
                                                alt="Thumb-1">
                                        
                                    </li>
                                 </ul>
                                 <h4 class="card-title" style="text-align: center;"><?php echo $value['Title'];?></h4>

                                 </div>  
                              </div>
                           </div>
                           <script>
                              lightGallery(document.getElementById('lightgallery_s<?php echo $i;?>'));
                           </script>
                           <?php $i++;}?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>