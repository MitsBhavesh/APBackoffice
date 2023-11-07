        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>
                        document.write(new Date().getFullYear())
                        </script> © Arhamshare Private Limited.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Developed by <a href="https://www.arhamshare.com/" target="_blank"
                                class="text-decoration-underline">Arhamshare Private Limited.</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        </div>
        <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->
        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center bg-dark p-3">

                    <h5 class="m-0 me-2 text-white">Theme Customizer</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="m-0" />

                <div class="p-4">
                    <h6 class="mb-3">Layout</h6>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout" id="layout-vertical"
                            value="vertical">
                        <label class="form-check-label" for="layout-vertical">Vertical</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout" id="layout-horizontal"
                            value="horizontal">
                        <label class="form-check-label" for="layout-horizontal">Horizontal</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Mode</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode" id="layout-mode-light"
                            value="light">
                        <label class="form-check-label" for="layout-mode-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-mode" id="layout-mode-dark"
                            value="dark">
                        <label class="form-check-label" for="layout-mode-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Width</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width" id="layout-width-fuild"
                            value="fuild" onchange="document.body.setAttribute('data-layout-size', 'fluid')">
                        <label class="form-check-label" for="layout-width-fuild">Fluid</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-width" id="layout-width-boxed"
                            value="boxed" onchange="document.body.setAttribute('data-layout-size', 'boxed')">
                        <label class="form-check-label" for="layout-width-boxed">Boxed</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Layout Position</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position" id="layout-position-fixed"
                            value="fixed" onchange="document.body.setAttribute('data-layout-scrollable', 'false')">
                        <label class="form-check-label" for="layout-position-fixed">Fixed</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-position"
                            id="layout-position-scrollable" value="scrollable"
                            onchange="document.body.setAttribute('data-layout-scrollable', 'true')">
                        <label class="form-check-label" for="layout-position-scrollable">Scrollable</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Topbar Color</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color" id="topbar-color-light"
                            value="light" onchange="document.body.setAttribute('data-topbar', 'light')">
                        <label class="form-check-label" for="topbar-color-light">Light</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="topbar-color" id="topbar-color-dark"
                            value="dark" onchange="document.body.setAttribute('data-topbar', 'dark')">
                        <label class="form-check-label" for="topbar-color-dark">Dark</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Size</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-default"
                            value="default" onchange="document.body.setAttribute('data-sidebar-size', 'lg')">
                        <label class="form-check-label" for="sidebar-size-default">Default</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-compact"
                            value="compact" onchange="document.body.setAttribute('data-sidebar-size', 'md')">
                        <label class="form-check-label" for="sidebar-size-compact">Compact</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-size" id="sidebar-size-small"
                            value="small" onchange="document.body.setAttribute('data-sidebar-size', 'sm')">
                        <label class="form-check-label" for="sidebar-size-small">Small (Icon View)</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2 sidebar-setting">Sidebar Color</h6>

                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-light"
                            value="light" onchange="document.body.setAttribute('data-sidebar', 'light')">
                        <label class="form-check-label" for="sidebar-color-light">Light</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-dark"
                            value="dark" onchange="document.body.setAttribute('data-sidebar', 'dark')">
                        <label class="form-check-label" for="sidebar-color-dark">Dark</label>
                    </div>
                    <div class="form-check sidebar-setting">
                        <input class="form-check-input" type="radio" name="sidebar-color" id="sidebar-color-brand"
                            value="brand" onchange="document.body.setAttribute('data-sidebar', 'brand')">
                        <label class="form-check-label" for="sidebar-color-brand">Brand</label>
                    </div>

                    <h6 class="mt-4 mb-3 pt-2">Direction</h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction" id="layout-direction-ltr"
                            value="ltr">
                        <label class="form-check-label" for="layout-direction-ltr">LTR</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="layout-direction" id="layout-direction-rtl"
                            value="rtl">
                        <label class="form-check-label" for="layout-direction-rtl">RTL</label>
                    </div>

                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>


        <!-- JAVASCRIPT -->
        <script src="<?php echo base_url();?>assets/libs/jquery/jquery.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/node-waves/waves.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/feather-icons/feather.min.js"></script>
        <!-- pace js -->
        <script src="<?php echo base_url();?>assets/libs/pace-js/pace.min.js"></script>
        <!-- Required datatable js -->
        <script src="<?php echo base_url();?>assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js">
        </script>
        <script src="<?php echo base_url();?>assets/libs/jszip/jszip.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="<?php echo base_url();?>assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        <!-- Responsive examples -->
        <script src="<?php echo base_url();?>assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js">
        </script>
        <script src="<?php echo base_url();?>assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js">
        </script>
        <!-- Datatable init js -->
        <script src="<?php echo base_url();?>assets/js/pages/datatables.init.js"></script>
        <!-- apexcharts -->
        <script src="<?php echo base_url();?>assets/libs/apexcharts/apexcharts.min.js"></script>
        <!-- Plugins js-->
        <script
            src="<?php echo base_url();?>assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js">
        </script>
        <script
            src="<?php echo base_url();?>assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js">
        </script>
        <!-- Plugins js-->
        <!--ckeditor js-->
        <script src="<?php echo base_url();?>assets/libs/_ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
        <script src="<?php echo base_url();?>assets/userjs/ckeditor.js"></script>
        <!-- email editor init -->
        <script src="<?php echo base_url();?>assets/js/pages/email-editor.init.js"></script>
        <script
            src="<?php echo base_url();?>assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js">
        </script>
        <script
            src="<?php echo base_url();?>assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js">
        </script>
        <script type="text/javascript">
setTimeout(function() {
    $('.alert-dismissible').fadeOut(1000);
}, 10000);
        </script>
        <script type="text/javascript">
$(document).ready(function() {
    // alert("sadsa");
    $('#vouchardateclick').trigger('click');
});
        </script>
       

        <!-- Sweet Alerts js -->
        <script src="<?php echo base_url();?>assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <!-- Sweet alert init js-->
        <script src="<?php echo base_url();?>assets/js/pages/sweetalert.init.js"></script>
       

        <!-- Chart JS -->
        
        
        <!-- alertifyjs js -->
        <script src="<?php echo base_url();?>assets/libs/alertifyjs/build/alertify.min.js"></script>
        <!-- notification init -->
        <script src="<?php echo base_url();?>assets/js/pages/notification.init.js"></script>
        <!-- dashboard init -->
        <script src="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/js/lightgallery.js"></script>
        <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lightgallery.js/master/dist/js/lightgallery.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-pager.js/master/dist/lg-pager.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-autoplay.js/master/dist/lg-autoplay.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-fullscreen.js/master/dist/lg-fullscreen.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-zoom.js/master/dist/lg-zoom.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-hash.js/master/dist/lg-hash.js"></script>
        <script src="https://cdn.rawgit.com/sachinchoolur/lg-share.js/master/dist/lg-share.js"></script>
        <script src="<?php echo base_url();?>assets/lgallery/js/lg-video.js"></script>
        <script src="<?php echo base_url();?>assets/lgallery/js/lg-rotate.js"></script>
        <script>
            lightGallery(document.getElementById('html5-videos'));
            lightGallery(document.getElementById('lightgallery'));
            lightGallery(document.getElementById('lightgallery_sales'));
            lightGallery(document.getElementById('lightgallery_product'));
            lightGallery(document.getElementById('html5-videos1'));
            lightGallery(document.getElementById('html5-lightgallery_sales'));
            lightGallery(document.getElementById('html5-lightgallery_product'));
        </script>
        <!-- Online Eipo -->
        <script type="text/javascript">
            // **************************  online Ipo get qty *******************
                     $("#online_ipo").change(function(){
                      GetOnlineEIPOData();
                    // var symbol = $("#online_ipo").val();
                    //  // alert(symbol);
                    //  $.ajax({
                    //     type: "POST",
                    //     data: {symbol:symbol},
                    //     url: '<?php echo base_url(); ?>eIPO/get_ipo_list_quantity',
                    //     success: function(data){
                    //        // alert(data);
                    //        $("#online_qty").html(data);
                    //         online_mul_amt();
                    //         bk_online_validation();
                    //         //bank
                    //         // var textBox = $('input:text').val();
                    //         // if (textBox == "") {
                    //         //     $("#error_online_bnk_upi").show('slow');
                    //         // }


                    //     }
                    // });
                });
        
 // **************************  Online Ipo get Price *******************
                $("#online_ipo").change(function(){
                  GetOnlineEIPOData();
                    // var symbol = $("#online_ipo").val();
                    //  // alert(symbol);
                    //  $.ajax({
                    //     type: "POST",
                    //     data: {symbol:symbol},
                    //     url: '<?php echo base_url(); ?>eIPO/get_ipo_list_bidprice',
                    //     success: function(data){
                    //        // alert(data);
                    //         obj = JSON.parse(data);
                    //        // alert(obj.cutOffPrice);
                    //        cutOffPrice = obj.cutOffPrice;
                    //        maxPrice = obj.maxPrice;
                    //        $("#online_price").val(obj.cutOffPrice);
                    //        $("#online_price").attr("min",obj.minPrice);
                    //        $("#online_price").attr("max",obj.maxPrice);
                    //        online_mul_amt();
                    //        bk_online_validation();
                          

                    //     }
                    // });
                });

              function GetOnlineEIPOData()
                {
                  var symbol = $("#online_ipo").val();
                  var category = $("#online_sub_category").val();
                     // alert(symbol);
                     $("#polid").attr('disabled', true); 
                     if(symbol == "LICI")
                     {
                        $("#polid").attr('disabled', false); 
                     }
                     else
                     {
                        $("#online_sub_category").val('IND');
                     }

                     $.ajax({
                        type: "POST",
                        data: {symbol:symbol},
                        url: '<?php echo base_url(); ?>IPO/get_ipo_list_quantity',
                        success: function(data){
                           // alert(data);
                           $("#online_qty").html(data);
                            online_mul_amt();
                            bk_online_validation();
                            //bank
                            // var textBox = $('input:text').val();
                            // if (textBox == "") {
                            //     $("#error_online_bnk_upi").show('slow');
                            // }


                        }
                    });

                     var symbol = $("#online_ipo").val();
                     // alert(symbol);
                     $.ajax({
                        type: "POST",
                        data: {symbol:symbol},
                        url: '<?php echo base_url(); ?>IPO/get_ipo_list_bidprice',
                        success: function(data){
                           // alert(data);
                          obj = JSON.parse(data);
                           // alert(obj.cutOffPrice);
                           cutOffPrice = obj.cutOffPrice;
                           maxPrice = obj.maxPrice;
                           $("#online_price").val(obj.cutOffPrice);
                           if(symbol == "ADANIENTPP")
                            {
                              $('#online_price').val('1574');
                            }
                           // if(symbol == "LICI")
                           // {
                           //    if(category == "IND")
                           //    {
                           //      $("#online_price").attr('readonly', true); 
                           //      $("#customCheck3").attr('checked', true); 
                           //      // $("#customCheck3").attr('disabled', true); 
                           //      $("#online_price").val(obj.cutOffPrice - 45);
                           //      online_mul_amt();
                           //    }
                           //    else
                           //    {
                           //      $("#online_price").attr('readonly', true); 
                           //      $("#customCheck3").attr('checked', true); 
                           //      // $("#customCheck3").attr('disabled', true); 
                           //      $("#online_price").val(obj.cutOffPrice - 60);
                           //      online_mul_amt();
                           //    }
                           // }
                           // else
                           // {
                           //  $("#customCheck3").attr('disabled', false);
                           //  online_mul_amt();
                           // }
                           $("#online_price").attr("min",obj.minPrice);
                           $("#online_price").attr("max",obj.maxPrice);
                           online_mul_amt();
                           bk_online_validation();
                          

                        }
                    });
                }
                // **************************  Online Ipo get Amount *******************

                function online_mul_amt()
                {
                    var online_ipo = document.getElementById("online_ipo").value;   //offline ipo
                        // alert(online_ipo);
                      // var err= 0;

                     if(online_ipo != "Please Select IPO")
                     {
                         //Amount

                        var online_qty = document.getElementById("online_qty").value;
                        var online_price = document.getElementById("online_price").value;

                        // alert(off_qty);
                        // var total_amount = online_qty * online_price;
                         // alert(amt);
                        var total_amount = parseFloat(online_qty.replace(/,/g, '')) *
                        parseFloat(online_price.replace(/,/g, ''));
                        $('#online_Amount').val(total_amount); 
                    }
                    else
                    {
                        $('#online_Amount').val("");   
                    }
                }

                $("#online_ipo").change(function(){
                    online_mul_amt();
                   // onlinecheckForBlank();
                     bk_online_validation();
                });
                $("#online_qty").change(function(){
                    online_mul_amt();
                   // onlinecheckForBlank();
                     bk_online_validation();
                });


 $("#online_ipo").change(function(){
                    online_mul_amt();
                   // onlinecheckForBlank();
                     bk_online_validation();
                });
                $("#online_qty").change(function(){
                    online_mul_amt();
                   // onlinecheckForBlank();
                     bk_online_validation();
                }); 
                $("#customCheck3").change(function(){
                    online_mul_amt();
                }); 
                $("#online_price").change(function(){
                    online_mul_amt();
                }); 

        </script>
        <!-- <script src="<?php echo base_url();?>assets/js/pages/dashboard.init.js"></script> -->
        <script src="<?php echo base_url();?>assets/js/app.js"></script>

        </body>

        <!-- Mirrored from minia.django.themesbrand.com/layouts-horizontal.html by HTTrack Website Copier/3.x [XR&CO'2010], Mon, 08 Nov 2021 08:04:38 GMT -->

        </html>