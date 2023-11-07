
<style type="text/css">
.hide {
    display: none;
}

.show {
    display: block;
}
</style>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid" style="margin-top:0px;">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Payment request[PENDING]</h4>
                    </div>
            <?php include("alert.php"); ?>
            <div class="row">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <!-- Start Form -->
                        <form method="post" action="<?php echo base_url();?>Accounts/payment_request_wallet"
                            onclick="return doValidations();">
                            <!-- <form method="post" action="#"> -->
                            <div class="row card-title mb-0 flex-grow-1">
                                <div class="col-md-3">
                                    <div class="mb-2">
                                        <label class="form-label" for="formrow-todate-input">Client Code:</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="client_code" name="client_code"
                                                value="<?php if(isset($_SESSION['client_code'])){echo $_SESSION['client_code'];}?>"
                                                required>
                                            <span class="pristine-error text-help" id="error_client_code"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-2">
                                        <label class="form-label">Group Wise:</label>
                                        <div class="mb-3">
                                            <select class="form-select" name="grp_wise" id="grp_wise">
                                                <option id="group1" name="group1" value="y">Yes</option>
                                                <option id="group2" name="group2" value="n">NO</option>
                                            </select>
                                            <!-- <input type="text" class="form-control"  id="grp_wise" name="grp_wise" required>  -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="mb-2" style="padding-top: 30px;">
                                        <button type="Submit" id="btn_wallet" class="btn btn-primary w-md"
                                            name="btn_wallet"
                                            style="background-color: #0b5639;border-color: #acc840;">Submit</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <!-- End Form -->
                    </div>
                </div>
                <!--******************************************************* Start DataTable ***************************************************************-->
            <form method="post" action="<?php echo base_url();?>Accounts/payment_request">

                <?php
                    // print_r($Grp1); exit();
                 if(isset($grp_wise) && !empty($grp_wise)){
                ?>
                    <table id="datatable1" class="table table-bordered dt-responsive w-100 dataTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>COCD</th>
                                <th>Client Code</th>
                                <th>Amount</th>
                                <th>pay</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                                if(!empty($Grp1)){
                                    $i=1;
                                 foreach ($Grp1 as $key => $value) { ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="checkbox" name="<?php echo ".$i.'chk_value'"; ?>">
                                </td>
                                <td><?php echo $value[0];?></td>
                                <td><?php echo $value[1];?></td>
                                <td><?php echo $value[2];?></td>
                                <td><input type="text" class="form-control" name="amount" value="<?php echo $value[2];?>">
                                </td>
                            </tr>
                            <?php $i++; } }?>
                        </tbody>
                    </table>
                    </br>
                   
                <div class="mb-2" style="padding-top: 35px;">
               <!--  <input type="button" class="btn btn-primary" name="button" value="Get Selected" onclick="GetSelected()" /> -->
                <input type="button" class="btn btn-primary" name="answer" value="Get Selected" onclick="GetSelected()" />
                </div>
                    <!-- <button type="Submit"  name="answer" id="printBut">Print selected</button> -->
                    <?php }?>
            </form>
                <!--*********************************************************** End DataTable **************************************************************-->


            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
function GetSelected() 
{
    //Reference the Table.
    var grid = document.getElementById("datatable1");

    //Reference the CheckBoxes in Table.
    var checkBoxes = grid.getElementsByTagName("INPUT");
    // var checkBoxes document.getElementsByClassName("example");
    var message = "";

    //Loop through the CheckBoxes.
    for (var i = 0; i < checkBoxes.length; i++) {
        if (checkBoxes[i].checked) {
            var row = checkBoxes[i].parentNode.parentNode;
            message += row.cells[1].innerHTML;
            message += "#"+ row.cells[2].innerHTML;
            message += "#"+ row.cells[3].innerHTML;
            message += "#"+ row.cells[4].querySelector('input').value;
            message += "#";
        }
    }

    // Display selected Row data in Alert Box.
    alert(message);
    $.ajax({
        type:"POST",
        url:"<?php echo base_url();?>Accounts/payment_export",
        data:{
            'Payment_data':message
        },
        success:function(response){
            //  alert(response);
            var w = window.open('about:block');
            w.document.open();
            w.document.write(response);
            w.document.close();
        }
    });     
}
</script>


<script type="text/javascript">
$(document).ready(function() {

    $('#datatable1').DataTable({
        responsive: true

    });
});

function Amount() 
{
    var nominee_error1 = 0;
    var amount1 = document.getElementById("amount1").value;
    var amount = document.getElementById("amount").value;

    if (amount1 >= amount) {
        document.getElementById('err_amount').innerHTML = "";
    } else {
        document.getElementById('err_amount').innerHTML = "Invalid Amount ID ";
        nominee_error1++;
        // alert("Amount Moti che"); return false;
    }
    // alert(amount); return false;

    if (nominee_error1 !== 0) {
        // alert("false");
        return false;
    } else {
        // alert("true");
        return true;
    }
}

function onButtonClick() 
{
    document.getElementById('textInput').className = "show";
}

function doValidations() {

    var code = 0;

    var client = document.getElementById('client_code').value;

    if (client == "") {
        document.getElementById('error_client_code').innerHTML = "Invalid Client Code";
        code++;
    } else {
        var client = client.replace(/  +/g, ' ');
        var chk_space = client.charAt(0);

        if (client == "" || client == " " || chk_space == " ") {
            document.getElementById('error_client_code').innerHTML = "White space not allowed";
            code++;
        } else {
            document.getElementById('error_client_code').innerHTML = "";
        }
    }

    if (code != 0) {
        return false;
    } else {
        return true;
    }
}

var clicked = false;
$(".checkall").on("click", function() {
    $(".checkhour").prop("checked", !clicked);
    clicked = !clicked;
    this.innerHTML = clicked ? 'Deselect' : 'Select';
});
</script>