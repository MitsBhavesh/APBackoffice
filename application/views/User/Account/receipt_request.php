<body onload="page_onload_bankcode()"> 
<div class="main-content">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <div class="page-content">
        <div class="container-fluid" style="margin-top:0px;">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Receipt Request
                        </h4>
                        <!-- <div class="page-title-right">
                     <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">APBackOffice</a></li>
                        <li class="breadcrumb-item active">HelpDesk</li>
                     </ol>
                     </div> -->
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <?php include("alert.php"); ?>
            <div class="row">
                <div id="ajax_loader" style="display:none;">
                    <img src="<?php echo base_url()?>assets/img/loader.gif"
                        style="display: block; margin-left: auto;">
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <!-- Start Form -->
                            <!-- End Form -->
                        </div>
                        <!-- Start DataTable -->
                        <div class="card-body">
                            <form method="post" action="<?php echo base_url();?>Accounts/receipt_request_from" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <label>Exchange/Segment:</label>
                                          <select class="form-select" name="exchange_code_ins" id="exchange_code_ins" required onchange="Exchange_Code_Insert();">
                                            <option value="NSE_CASH" selected="">NSE_CASH</option>
                                            <option value="BSE_CASH">BSE_CASH</option>
                                            <option value="CD_NSE">CD_NSE</option>
                                            <option value="NSE_FNO">NSE_FNO</option>
                                            <!-- <option value="ICEX">ICEX</option> -->
                                            <option value="MCX">MCX</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Client Code:</label>
                                        <input type="text" class="form-control" id="client_code" name="client_code"
                                            size="10" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Client Name:</label>
                                        <input type="text" class="form-control" id="client_name" name="client_name"
                                            size="30" readonly="" required>
                                            <small style="color:red;" id="client_name_error"></small>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Closing Balance:</label>
                                        <input type="text" class="form-control" name="closing_price" id="closing_price"
                                            value="" size="10" readonly="" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Date:</label>
                                        <input type="date" class="form-control" name="date" id="date"
                                            value="<?php echo date('Y-m-d');?>" size="10" maxlength="10" required="Yes"
                                            readonly="" aria-required="true" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Bank Code:</label>
                                         <input type="text" class="form-control bank_code_ins" id="bank_code_ins" name="bank_code_ins" size="30" readonly="" required>
                                       <!--  <select class="form-select bank_code_ins" name="bank_code_ins" id="bank_code_ins" class="fieldbutton" required>
                                            <option value="HDFC 10">HDFC 10-HDFC BANK 00670340001633 [NSE CLIENT MONEY
                                                A/C ]</option>
                                        </select> -->
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Mode of Entry:</label>
                                        <select class="form-select" name="mode_entry" id="mode_entry"
                                            aria-invalid="false" required onchange="Mode_Of_Entry_insert()">
                                            <option value="C">C-Cheque Received</option>
                                            <option value="T">T-Transfered</option>
                                            <option value="R">R-RTGS</option>
                                            <option value="N">N-NEFT</option>
                                            <option value="L">L-Lien</option>
                                            <option value="D">D-DD</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Cr Amt:</label>
                                        <input class="form-control" type="number" id="Cr_Amt" name="Cr_Amt" size="10"
                                            maxlength="20" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Cheque No.:</label>
                                        <input type="text" class="form-control" id="Cheque_No" name="Cheque_No"
                                            value='0' size="10" maxlength="6" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Client Bank A/C:</label>
                                        <select class="form-select" name="Client_bank" id="client_bank" required>
                                            <option value="">None</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Upload Image:</label>
                                        <input type="file" class="form-control" accept="image/*,application/pdf"
                                            name="ChequeImg" id="ChequeImg" size="50" width="100%" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Ref No.:</label>
                                        <input type="text" class="form-control" id="Refe_No" name="Refe_No" size="10"
                                            maxlength="16">
                                    </div>
                                    <div class="col-sm-2">
                                        <label>Narration:</label>
                                        <input type="text" class="form-control" id="Narration" name="Narration"
                                            value="being amount received from client" size="50" aria-required="true"
                                            aria-invalid="false" readonly="true" required>
                                    </div>
                                    <div class="col-sm-3" style="margin-top:28.5px;">
                                        <input type="submit" name="btn_receipt" class="btn btn-primary" value="Add"
                                            style="width:30%;">
                                    </div>
                                </div>
                            </form>

                        </div>
                        <!-- End DataTable -->
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">Receipt Request
                        </div>
                        <!-- Start DataTable -->
                        <div class="card-body">
                            <!-- Start Form Table -->
                            <form action="<?php echo base_url(); ?>Accounts/Receipt_Report_Accept" method="post" enctype="multipart/form-data">
                            <table id="datatable1" class="table table-bordered dt-responsive w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Action</th>
                                        <th>Date</th>
                                        <th>Exchange Code</th>
                                        <th>Client Code</th>
                                        <th>Client Name</th>
                                        <th>Closing Balance</th>
                                        <th>Bank Code</th>
                                        <th>Mode of Entry</th>
                                        <th>Credit Amount</th>
                                        <th>Cheque No</th>
                                        <th>Client Bank_Account</th>
                                        <th>Files</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if(!empty($result)){
                                $i=1;
                                foreach ($result as $data_row) {
                                ?>

                                    <tr>
                                        <td><span class="row_id"
                                                style="display: none;"><?php echo $data_row['Receipt_ID']; ?>  
                                            </span>
                                            <input type="checkbox" class="checkbox__input" name="chk_report" id="checkbox_<?php echo $i; ?>" value="<?php echo $data_row['Receipt_ID']; ?>" onclick="selectOnlyThis(this)">
                                        </td>
                                        <td><button id="edit_btn" type="button"
                                                class="btn btn-primary waves-effect waves-light RowId"
                                                data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl">View
                                            </button></td>
                                        <td><?php echo $data_row['Date'];?></td>
                                        <td class="Exchange_Code"><?php echo $data_row['Exchange_Code'];?></td>
                                        <td><?php echo $data_row['Client_Code'];?></td>
                                        <td><?php echo $data_row['Client_Name'];?></td>
                                        <td><?php echo $data_row['Closing_Balance'];?></td>
                                        <td><?php echo $data_row['Bank_Code'];?></td>
                                        <td><?php echo $data_row['Mode_of_Entry'];?></td>
                                        <td><?php echo $data_row['Credit_Amount'];?></td>
                                        <td><?php echo $data_row['Cheque_No'];?></td>
                                        <td><?php echo $data_row['Client_Bank_Account'];?></td>
                                        <!-- <td><?php echo $data_row['Upload_Path'];?></td> -->
                                         <td><!-- <?php echo $data_row['Upload_Path'];?> -->
                                            <?php $img_path = $data_row['Upload_Path']; ?>
                                            <a class="btn" onClick="swipe('<?php echo $img_path; ?>')" value=""> 
                                              <?php if(!file_exists($img_path)){ ?>
                                            <!--  <i class="fas fa-ban" aria-hidden="true" style="color: red; font-size: 15px; padding: 8px 0px"></i> -->
                                            <img src="<?php echo base_url();?>assets/images/cross.png" alt="">
                                            <?php }
                                             else { ?>
                                              <!-- <i class="far fa-file-image" aria-hidden="true"></i> -->
                                              <img src="<?php echo base_url();?>assets/images/image.png" alt="">
                                           <?php }  ?> 
                                           <!-- Image -->
                                            </a>
                                        </td>

                                    </tr>
                                    <?php } } ?>

                                </tbody>
                            </table>
                            <br>
                            <button type="submit" class="btn btn-primary" name="btn_accept" style="float: left;" id="btn_accept">Accept</button>
                            <button type="submit" class="btn btn-primary" name="btn_reject" style="float: right;" id="btn_reject" onclick="<?php echo base_url('Accounts/Receipt_Report_Accept')?>">Reject</button>
                            </form>
                            <!-- End Form Table -->
                            <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog"
                                aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myExtraLargeModalLabel">Edit Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post"
                                                action="<?php echo base_url();?>Accounts/receipt_request_update" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <label>Exchange/Segment:</label>
                                                        <input type="hidden" class="receipt_id" name="receipt_id"
                                                            id="receipt_id">
                                                        <select class="form-select exchange_code" name="exchange_code"
                                                            id="exchange_code" onchange="Get_BankCode()" required>

                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Client Code:</label>
                                                        <input type="text" class="form-control client_code"
                                                            id="client_code" name="client_code" size="10" required>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Client Name:</label>
                                                        <input type="text" class="form-control client_name"
                                                            id="client_name" name="client_name" size="30" readonly=""
                                                            required>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Closing Balance:</label>
                                                        <input type="text" class="form-control closing_price"
                                                            name="closing_price" id="closing_price" value="" size="10"
                                                            readonly="" required>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Date:</label>
                                                        <input type="date" class="form-control date" name="date"
                                                            id="date" value="<?php echo date('Y-m-d');?>" size="10"
                                                            maxlength="10" required="Yes" readonly=""
                                                            aria-required="true" required>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Bank Code:</label>
                                                        <input type="text" class="form-control bank_code"
                                                            id="bank_code" name="bank_code" size="30" readonly=""
                                                            required>
                                                       <!--  <select class="form-select" name="bank_code"
                                                            class="fieldbutton bank_code" required>
                                                            <option value="HDFC 10">HDFC 10-HDFC BANK 00670340001633
                                                                [NSE CLIENT MONEY A/C ]</option>
                                                        </select> -->
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Mode of Entry:</label>
                                                        <select class="form-select mode_entry" name="mode_entry" id="mode_entry"
                                                            aria-invalid="false" required onchange="Mode_Of_Entry()">
                                                            <option value="C">C-Cheque Received</option>
                                                            <option value="T">T-Transfered</option>
                                                            <option value="R">R-RTGS</option>
                                                            <option value="N">N-NEFT</option>
                                                            <option value="L">L-Lien</option>
                                                            <option value="D">D-DD</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Cr Amt:</label>
                                                        <input class="form-control Cr_Amt" type="number" id="Cr_Amt"
                                                            name="Cr_Amt" size="10" maxlength="20" required>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Cheque No.:</label>
                                                        <input type="text" class="form-control Cheque_No" id="Cheque_No"
                                                            name="Cheque_No" value='0' size="10" maxlength="6" required>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Client Bank A/C:</label>
                                                        <select class="form-select client_bank" name="Client_bank"
                                                            id="client_bank" required>
                                                            <option value="">None</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Upload Image:</label>
                                                        <input type="file" class="form-control ChequeImg"
                                                            accept="image/*,application/pdf" name="ChequeImg"
                                                            id="ChequeImg" size="50" width="100%" required>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Ref No.:</label>
                                                        <input type="text" class="form-control Refe_No" id="Refe_No"
                                                            name="Refe_No" size="10" maxlength="16">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <label>Narration:</label>
                                                        <input type="text" class="form-control Narration" id="Narration"
                                                            name="Narration" value="being amount received from client"
                                                            size="50" aria-required="true" aria-invalid="false"
                                                            readonly="true" required>
                                                    </div>
                                                    <div class="col-sm-3" style="margin-top:28.5px;">
                                                        <input type="submit" name="btn_edit_receipt"
                                                            class="btn btn-primary" value="Update" style="width:30%;">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
$(document).ready(function() {
    $('#datatable1').DataTable({
        responsive: true

    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $("#client_code").on('change', function() {

        var client_code = $(this).val().toUpperCase();
        // Start ajax
        $('#client_name').empty();
        $('#client_bank').empty();
        $('#closing_price').empty();
        $('#ajax_loader').show();
        $.ajax({
            // Make sure this is the correct path
            url: "<?php echo base_url();?>Accounts/client_bank_data",
            type: "POST",
            data: {
                client_code: client_code
            },
            success: function(response) {

                  if(response==="0"){
                    $('#client_name_error').html("Invalid Client Code");
                    return false;
                }
                else{
                      $('#client_name_error').html("");
                     $('#client_bank').append(response);
                }
                // var old = JSON.stringify(response).replace(/\]\[/g, ",");
                // var newData = JSON.parse(old);
                // // var data = response.replace("[","");
                // // var data1 =data.replace("]","");
                // var obj = jQuery.parseJSON(newData);
                // console.log(obj);
                // $('#client_name').val(obj[0].CLIENTNAME);
                // $('#client_bank').append(response);
            }
        });
        $('#closing_price').empty();
        $.ajax({
            // Make sure this is the correct path
            url: "<?php echo base_url();?>Accounts/client_name_data",
            type: "POST",
            data: {
                client_code: client_code
            },
            success: function(response) {
                if(response==="0"){
                    $('#client_name_error').html("Invalid Client Code");
                    return false;
                }
                else{
                      $('#client_name_error').html("");
                     $('#client_name').val(response);
                }
                //  var old = JSON.stringify(response).replace(/\]\[/g, ",");
                //  var newData = JSON.parse(old);
                //  // var data = response.replace("[","");
                //  // var data1 =data.replace("]","");
                //  var obj = jQuery.parseJSON(newData);
                // console.log(obj);
               
            }
        });

        $.ajax({
            // Make sure this is the correct path
            url: "<?php echo base_url();?>Accounts/closing_bal",
            type: "POST",
            data: {
                client_code: client_code
            },
            success: function(response) {
                if(response==="0")
                {
                    $('#ajax_loader').hide();
                    $('#client_name_error').html("Invalid Client Code");
                    return false;
                }
                else
                {
                    var objJSON = JSON.parse(response);

                    if (objJSON === "") {
                        $('#ajax_loader').hide();
                        $('#closing_price').val('');
                    } else {
                        $('#ajax_loader').hide();
                        var balance = objJSON[9][3];
                        // alert(balance);
                        // console.log(balance);

                        if (balance === "") {
                              $('#client_name_error').html("");
                            $('#ajax_loader').hide();
                            $('#closing_price').val(objJSON[7][3]);


                        } else {
                            $('#client_name_error').html("");
                            $('#ajax_loader').hide();
                            $('#closing_price').val(balance);

                        }

                    }
                }
            }
        });
    });
});
</script>
<!-- <script type="text/javascript">
$('.RowId').click(function(e) {
    e.preventDefault();
    var receipt_request_id = $(this).closest('tr').find('.row_id').text();
    $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>Accounts/receipt_request_id",
        data: {
            'attend_btn': true,
            'receipt_request_id': receipt_request_id,
        },
        success: function(response) {

            var data = response.replace("[", "");
            var data1 = data.replace("]", "");
            var obj = jQuery.parseJSON(data1);
            var row_id = obj.Receipt_ID;

            $('.receipt_id').val(row_id);
            console.log(obj);
            $.each(obj, function(key, value) {
                $('#exchange_code')
                    .append($('<option>', {
                            value: key
                        })
                        .text(value));
            });

           

        }
    });
});
</script> -->
<script type="text/javascript">
$('.RowId').click(function(e) {
    e.preventDefault();
    var receipt_request_id = $(this).closest('tr').find('.row_id').text();
    var Exchange_Code = $(this).closest('tr').find('.Exchange_Code').text();
    // alert(Exchange_Code);

     $.ajax ({
            type: 'POST',
            url: '<?php echo base_url();?>Accounts/receipt_bank_code_tdrow',
            data: {
            'attend_btn': true,
            'Exchange_Code': Exchange_Code,
            },
            success : function(response) {
                // alert(response);
                var data = response.replace("[", "");
                var data1 = data.replace("]", "");
                var obj = jQuery.parseJSON(data1);
                // var bankcode=obj.Bank_Code;
                // alert(bankcode);
                $('.bank_code').val(obj.Bank_Code);
            }
        });

    $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>Accounts/receipt_request_id",
        data: {
            'attend_btn': true,
            'receipt_request_id': receipt_request_id,
        },
        success: function(response) {
            // alert(response);
            var data = response.replace("[", "");
            var data1 = data.replace("]", "");
            var obj = jQuery.parseJSON(data1);
            var row_id = obj.Receipt_ID;
            var excode=obj.Exchange_Code;
            var bank_account=obj.Client_Bank_Account;
            // alert(bank_account);
            $('.receipt_id').val(row_id);
            
            $('.client_code').val(obj.Client_Code);
            $('.client_name').val(obj.Client_Name);
            $('.closing_price').val(obj.Closing_Balance);
            $('.Cr_Amt').val(obj.Credit_Amount);
            $('.Refe_No').val(obj.Ref_no);
            $(".exchange_code").empty();//Empty Dropdown list <option>
            if(excode==="NSE_CASH"){

                $(".exchange_code").append('<option value=' + excode + ' selected="">' + excode + '</option><option value="BSE_CASH">BSE_CASH</option><option value="CD_NSE">CD_NSE</option><option value="NSE_FNO">NSE_FNO</option><option value="MCX">MCX</option>');
                // <option value="ICEX">ICEX</option>
                                            
            }
            if(excode==="BSE_CASH"){

                $(".exchange_code").append('<option value=' + excode + ' selected="">' + excode + '</option><option value="NSE_CASH">NSE_CASH</option><option value="CD_NSE">CD_NSE</option><option value="NSE_FNO">NSE_FNO</option><option value="MCX">MCX</option>');
                // <option value="ICEX">ICEX</option>
            }
            if(excode==="CD_NSE"){

                $(".exchange_code").append('<option value=' + excode + ' selected="">' + excode + '</option><option value="NSE_CASH">NSE_CASH</option><option value="BSE_CASH">BSE_CASH</option><option value="NSE_FNO">NSE_FNO</option><option value="MCX">MCX</option>');
                // <option value="ICEX">ICEX</option>
            }
            if(excode==="NSE_FNO"){
                $(".exchange_code").append('<option value=' + excode + ' selected="">' + excode + '</option><option value="NSE_CASH">NSE_CASH</option><option value="BSE_CASH">BSE_CASH</option><option value="CD_NSE">CD_NSE</option><option value="MCX">MCX</option>');
                // <option value="ICEX">ICEX</option>
            }
            // if(excode==="ICEX"){
            //    $(".exchange_code").append('<option value=' + excode + ' selected="">' + excode + '</option><option value="NSE_CASH">NSE_CASH</option><option value="BSE_CASH">BSE_CASH</option><option value="CD_NSE">CD_NSE</option><option value="NSE_FNO">NSE_FNO</option><option value="MCX">MCX</option>');
            // }
            if(excode==="MCX"){

                $(".exchange_code").append('<option value=' + excode + ' selected="">' + excode + '</option><option value="NSE_CASH">NSE_CASH</option><option value="BSE_CASH">BSE_CASH</option><option value="CD_NSE">CD_NSE</option><option value="NSE_FNO">NSE_FNO</option>');
                // <option value="ICEX">ICEX</option>
            }


             $(".client_bank").append('<option value=' + bank_account + ' selected="">' + bank_account + '</option>');

        }
    });
});
</script>

<script>
function Get_BankCode() {
    // alert('jfgh');
     var exchange_code = $(".exchange_code").val();
     // alert(exchange_code);
    $.ajax ({
                type: 'POST',
                url: '<?php echo base_url();?>Accounts/receipt_branch_code',
                data: {exchange_code:exchange_code},
                success : function(response) {
                    // alert(response);
                    var data = response.replace("[", "");
                    var data1 = data.replace("]", "");
                    var obj = jQuery.parseJSON(data1);
                    // var bankcode=obj.Bank_Code;
                    // alert(bankcode);
                    $('.bank_code').val(obj.Bank_Code);
                }
            });
 
}
</script>
<script>
function Mode_Of_Entry() {
    alert('mode');
    var mode_of_entry = $(".mode_entry").val();
    // alert(mode_of_entry);
    if(mode_of_entry=='C')
    {
        document.getElementById("ChequeImg").disabled = false;
        $('.Cheque_No').prop("disabled", false);
    }
    else
    {
        document.getElementById("ChequeImg").disabled = true;
        $('.Cheque_No').prop("disabled", true);
    }
 
}
</script>
<script type="text/javascript">
function Mode_Of_Entry_insert() {
    // alert('mode');
    var mode_of_entry_ins = $("#mode_entry").val();
    // alert(mode_of_entry_ins);
    if(mode_of_entry_ins=='C')
    {
        document.getElementById("ChequeImg").disabled = false;
        $('#Cheque_No').prop("disabled", false);
    }
    else
    {
        document.getElementById("ChequeImg").disabled = true;
        $('#Cheque_No').prop("disabled", true);
    }
 
}
</script>
<script type="text/javascript">
//Img
function swipe(path1) 
{
    $.ajax({
        type: "POST",
        url: '<?php echo base_url(); ?>Accounts/view_img',
        data: { path1:path1 },
        success: function(data1){
        }
    });
    window.open("<?php echo base_url() ?>Accounts/view_img", "hello", "width=1000,height=800");
}
</script>
<script type="text/javascript">
    function Exchange_Code_Insert()
    {
        // alert('fgfjkh');
        var exchange_code = $("#exchange_code_ins").val();
        // alert(exchange_code);
        $.ajax ({
            type: 'POST',
            url: '<?php echo base_url();?>Accounts/receipt_bank_code_insert',
            data: {exchange_code:exchange_code},
            success : function(response) {
                // alert(response);
                var data = response.replace("[", "");
                var data1 = data.replace("]", "");
                var obj = jQuery.parseJSON(data1);
                // var bankcode=obj.Bank_Code;
                // alert(bankcode);
                $('.bank_code_ins').val(obj.Bank_Code);
            }
        });
    }
</script>
<script>
function page_onload_bankcode() {
  // alert("Page is loaded");
  var exchange_code = $("#exchange_code_ins").val();
    // alert(exchange_code);
    $.ajax ({
        type: 'POST',
        url: '<?php echo base_url();?>Accounts/receipt_bank_code_insert',
        data: {exchange_code:exchange_code},
        success : function(response) {
            // alert(response);
            var data = response.replace("[", "");
            var data1 = data.replace("]", "");
            var obj = jQuery.parseJSON(data1);
            // var bankcode=obj.Bank_Code;
            // alert(bankcode);
            $('.bank_code_ins').val(obj.Bank_Code);
        }
    });
}
</script>
<!-- start only one checkbox clicked -->
<script type="text/javascript">
    function selectOnlyThis(id){
      var myCheckbox = document.getElementsByName("chk_report");
      // alert(myCheckbox);
      Array.prototype.forEach.call(myCheckbox,function(el){
        el.checked = false;
      });
      id.checked = true;
    }
</script>
<!-- End only one checkbox clicked -->
<!-- Start Reject code -->
<script type="text/javascript">
    function Reject()
    {
        // checkbox__input
        var checkedValue = $('.checkbox__input:checked').val();
        // alert(checkedValue);
         $.ajax ({
        type: 'POST',
        url: '<?php echo base_url();?>Accounts/Receipt_Report_Reject',
        data: {checkedValue:checkedValue},
        success : function(response) {
            alert(response);
           // console.log(response);
           
        }
    });
        
    }
</script>
<!-- End Reject Code -->