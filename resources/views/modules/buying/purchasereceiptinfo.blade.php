<?php
$today = date('Y-m-d');
$i = 1;
?>

<script src="{{ asset('js/new-purchase-receipt.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        let total_price = 0;
        let total_qty = 0;
        for (let i = 1; i <= $('#itemsToReceive tr').length; i++) {
            total_qty += parseInt($(`#qtyAcc${i}`).val());
            total_price += parseFloat($(`#amtAcc${i}`).val());
        }
        $('#receiveQty').val(total_qty);
        $('#receivePrice').val(total_price);
    });

</script>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="justify-content: space-between;">
    <div class="container-fluid">
        <h2 class="navbar-brand tab-list-title">
            <a href='javascript:onclick=loadPurchaseReceipt();' class="fas fa-arrow-left back-button"><span></span></a>
            <h2 class="navbar-brand" style="font-size: 35px;">Receipt <span
                    id="pr_id">{{ $receipt->p_receipt_id }}</span></h2>
            <br>
            <p id="recStatus">{{ $receipt->pr_status }}</p>
        </h2>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                @if ($receipt->pr_status === 'Draft')

                    <li class="nav-item li-bom">
                        <button class="btn btn-refresh" style="background-color: #d9dbdb;" type="submit"
                            onclick="loadPurchaseReceipt();">Cancel</button>
                    </li>
                    <li class="nav-item li-bom">
                        <button type="button" id="submitReceipt" class="btn btn-primary" data-target="#saveSale">
                            Submit
                        </button>
                    </li>

                @else
                    <li class="nav-item li-bom">
                        <button type="button" id="receiveMaterials" class="btn btn-primary" data-target="#saveSale">
                            Save Record
                        </button>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<div class="accordion" id="accordion">
    <div class="card">
        @if ($receipt->pr_status === 'Draft')
            <div class="card-header" id="heading1">
                <h2 class="mb-0">
                    <button class="btn-sm btn-primary dropdown-toggle float-right" href="#" role="button"
                        id="dropdownMenunpr" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Get Items from
                    </button>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenunpr">
                        <a class="dropdown-item" href="#" data-toggle="modal"
                            data-target="#npr_purchaseOrderModal">Purchase
                            Order</a>
                    </div>
                </h2>
            </div>
        @endif
        <div class="collapse show" id="salesOrderCard1">
            <div class="card-body">
                <form action="" id="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <br>
                            <label class=" text-nowrap align-middle">
                                Series
                            </label>
                            <div class="d-flex">
                                <input type="text" class="form-input form-control" id="receiptId" max="6"
                                    value={{ $receipt->p_receipt_id }} readonly>
                            </div>
                            <br>
                            <label class=" text-nowrap align-middle">
                                Supplier
                            </label>
                            <input type="text" required class="form-input form-control"
                                value="{{ $supplier->company_name }}" readonly id="">
                            <br>
                            <input type="text" required class="form-input form-control" hidden id="orderId"
                                value="{{ $receipt->purchase_id }}">
                        </div>
                        <div class="col">
                            <br>
                            <label class="text-nowrap align-middle">
                                Date
                            </label>
                            <input type="date" required class="form-input form-control" id="npr_date" readonly
                                value={{ $receipt->date_created }}>
                            <br>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card" id="cardAddressContacts">
        <div class="card-header">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                    data-target="#salesOrderCard4" aria-expanded="false">
                    ADDRESS AND CONTACTS
                </button>
            </h2>
        </div>
        <div id="salesOrderCard4" class="collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label class=" text-nowrap align-middle">
                                Select Supplier Address
                            </label>
                            <input type="text" required class="form-input form-control" readonly
                                value="{{ $supplier->supplier_address }}" id="">
                        </div>
                        <div class="form-group">
                            <label class=" text-nowrap align-middle">
                                Contact Person
                            </label>
                            <input type="text" required class="form-input form-control" id="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class=" text-nowrap align-middle">
                                Select Shipping Address
                            </label>
                            <input type="text" required class="form-input form-control" id="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" id="cardUpdateStock">
        <div class="card-header">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                    data-target="#salesOrderCard5" aria-expanded="false">
                    RECEIVE MATERIALS
                </button>
            </h2>
        </div>
        <div id="salesOrderCard5" class="collapse">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <label class=" text-nowrap align-middle">Items</label>
                        <table class="table border-bottom table-hover table-bordered" id="itemsFromOrder">
                            <thead class="border-top border-bottom bg-light">
                                <tr class="text-muted">
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" id="mainChk" @if ($receipt->pr_status === 'Draft') onchange="onChangeFunction();" @else disabled @endif class="form-check-input">
                                        </div>
                                    </td>
                                    <td>Item</td>
                                    @if ($receipt->pr_status !== 'Draft')
                                        <td>Accepted Quantity</td>
                                    @endif
                                    <td>Quantity Ordered</td>
                                    <td>Rate</td>
                                    <td>Amount</td>
                                </tr>
                            </thead>
                            <tbody class="" id="itemsToReceive">
                                @foreach ($materials as $material)
                                    <tr id="row-<?= $i ?>">
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" name="item-chk" id="chk<?= $i ?>" @if ($receipt->pr_status === 'Draft') onchange="onChangeFunction();" @else disabled @endif class="form-check-input">
                                        </div>
                                    </td>
                                    <td class="text-black-50">
                                        <input class="form-control" type="text" id="item_code<?= $i ?>" @if ($receipt->pr_status === 'Draft') onchange="onChangeFunction();" @else disabled @endif value={{ $material['item_code'] }}>
                                    </td>
                                    @if ($receipt->pr_status !== 'Draft')
                                        <td class="text-black-50">
                                            <input class="form-control" type="number" id="qtyRec<?= $i ?>" @if ($material['qty'] == 0) readonly value = "0" @else placeholder="Enter quantity..." @endif>
                                        </td>
                                    @endif
                                    <td class="text-black-50">
                                        <input class="form-control" id="qtyAcc<?= $i ?>" type="number" @if ($receipt->pr_status === 'Draft') onchange="calcPrice(<?= $i ?>); onChangeFunction();" @else disabled @endif min="0" value={{ $material['qty'] }}>
                                    </td> 
                                    <td class="text-black-50">
                                        <input class="form-control" id="rateAcc<?= $i ?>" type="text" @if ($receipt->pr_status === 'Draft') readonly onchange="calcPrice(<?= $i ?>); onChangeFunction();" @else disabled @endif min="0" value={{ $material['rate'] }}>
                                    </td> 
                                    <td class="text-black-50">
                                        <input class="form-control" id="amtAcc<?= $i ?>" type="text" @if ($receipt->pr_status === 'Draft') readonly onchange="onChangeFunction();" @else disabled @endif min="0" value={{ $material['amount'] }}>
                                    </td> 
                                </tr>
                                <?php ++$i; ?>
                                @endforeach
                            </tbody>
                            <tfoot>
                                @if ($receipt->pr_status === 'Draft')
                                <td colspan="7" rowspan="5">
                                    <button id="multBtn" class="btn btn-sm btn-sm btn-secondary mx-2">Add Multiple</button>
                                    <button id="rowBtn" class="btn btn-sm btn-sm btn-secondary mx-2">Add Row</button>
                                    <button id="deleteBtn" class="btn btn-sm btn-sm btn-secondary" style="display: none; background-color: red">Delete</button>
                                </td>
                                @endif
                                <tr>
                                    
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" id="cardQuantityPHP">
        <div class="card-header">
            <h2 class="mb-0">
                <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                    data-target="#salesOrderCard6" aria-expanded="false">
                    PRICE
                </button>
            </h2>
        </div>
        <div id="salesOrderCard6" class="collapse">
            <div class="card-body">
                <div class="row my-4">
                    <div class="col-6">
                        <div class="form-group">
                            <label class=" text-nowrap align-middle">
                                Total Quantity
                            </label>
                            <input type="number" required class="form-input form-control" id="receiveQty">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class=" text-nowrap align-middle">
                                Total (PHP)
                            </label>
                            <input type="number" required class="form-input form-control" id="receivePrice">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" id="cardPaymentLogs">
            <div class="card-header">
                <h2 class="mb-0">
                    <button class="btn btn-link d-flex w-100 collapsed" type="button" data-toggle="collapse"
                        data-target="#receiptLogs" aria-expanded="false">
                        ITEMS RECEIVED LOGS
                    </button>
                </h2>
            </div>
            <div id="receiptLogs" class="collapse">
                <div class="card-body">
                  <table id="paymentLogsTable" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Logs ID</th>
                            <th>Date Received</th>
                            <th>Quantity Received</th>
                            <th>Amount Paid</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class= "text-bold">PR-LOG-001</td>
                            <td>March/17/2021</td>
                            <td class="text-danger">10</td>
                        </tr>
                        <tr>
                            <td class= "text-bold">PR-LOG-002</td>
                            <td>April/17/2021</td>
                            <td class="text-danger">20</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">
                                <label class=" text-nowrap align-middle">
                                    
                                </label>
                                <input type="number" required class="form-input form-control" readonly id="" value="">
                            </td>
                            <td colspan="3">
                                <label class=" text-nowrap align-middle">
                                    Total Quantity Received
                                </label>
                                <input type="number" required class="form-input form-control" readonly id="" value="">
                            </td>
                        </tr>
                    </tfoot>
                  </table>
                </div>
            </div>
        </div>

    <!--
    <div class="card" id="cardMoreInfo">
        <div id="salesOrderCard9">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label class=" text-nowrap align-middle">
                                Status
                            </label>
                            <select id="" class="form-control">
                                <option selected>Draft</option>
                                <option>Paid</option>
                                <option>Unpaid</option>
                                <option>Overdue</option>
                                <option>Cancelled</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
-->
</div>
<!-- Modal Purchase Order-->
<div class="modal fade" id="npr_purchaseOrderModal" tabindex="-1" role="dialog" aria-labelledby="npr_purchaseOrderModal"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Purchase Orders</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="purchaseReceiptTable" class="table table-striped table-bordered hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Purchase ID</th>
                            <th>Date</th>
                            <th>Item List</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="text-bold">{{ $order->purchase_id }}</td>
                                <td>{{ $order->purchase_date }}</td>
                                <td class="text-bold text-center"><button type="button" class="btn-sm btn-primary"
                                        data-toggle="modal" data-target="#npr_itemListView">View</button></td>
                                <td class="text-bold text-center"><button type="button" class="btn-sm btn-primary"
                                        data-dismiss="modal" onclick="loadMaterials({{ $order->id }})">Select</button></td>   
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
