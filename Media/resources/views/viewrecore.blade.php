<?php
//  print_r($user);
//  exit;
?>
<style>
    .badge{
        background-color: #8aafa8 !important;
        color: #364f4b !important;
    }
</style>
@foreach($user as $value)
@php $objData = json_decode($value) @endphp 
{{ $objData->name }}
<div class="row container-fluid" style="padding-top: 80px;">
	
    <div class="col-md-12" >
    <div class="card" style="margin-top:80px;">
        <h4 class="fw-bold py-2 mb-4" style="margin-left: 21px;margin-top: 20px;">View Record</h4>
        <div class="card-datatable table-responsive">
        <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

            <table class="invoice-list-table table border-top dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" style="width: 1391px;">
            <thead>
                <tr>
                <!-- <th>No.</th> -->
                <th>Name</th>
                <th>Mobile No.</th>
                <th>Ap Code</th>
                <th>Address</th>
                <th class="cell-fit">Actions</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            <tr>
                    <td>{{ $objData->name }}</td>
                    
                        
                        <td>
                            <span class="badge "><i class="fa-solid fa-pen-to-square"></i> </span>
                            <span class="badge "><i class="fa-regular fa-rectangle-xmark"></i></span>
                        </td>
                    </tr>
                
            </tbody>
            </table>
           
        </div>
        </div>
    </div>
    </div>
</div>  


@endforeach
