<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <h2 class="navbar-brand tab-list-title">
        <a href='javascript:onclick=loadBuyingRequestForQuotation();'
            class="fas fa-arrow-left back-button"><span></span></a>
        <h2 class="navbar-brand" style="font-size: 35px;">Request for Quotation Form</h2>
    </h2>

    <div class="collapse navbar-collapse float-right" id="navbarSupportedContent">
        <div class="navbar-nav ml-auto">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Menu
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="#">Send SMS</a>
                        <a class="dropdown-item" href="#">Print</a>
                        <a class="dropdown-item" href="#">Email</a>
                        <a class="dropdown-item" href="#">Jump to field <span
                                class="float-right small">Ctrl+J</span></a>
                        <a class="dropdown-item" href="#">Links</a>
                        <a class="dropdown-item" href="#">Duplicate</a>
                        <a class="dropdown-item" href="#">Rename</a>
                        <a class="dropdown-item" href="#">Reload</a>
                        <a class="dropdown-item" href="#">Customize</a>
                        <a class="dropdown-item" href="#">New Request for Quotation <span
                                class="float-right small">Ctrl+B</span></a>
                    </div>
                </div>
                <button type="button" class="btn btn-primary ml-1" href="#">Save</button>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid" style="margin: 0; padding: 0;">
    <div class="row mt-2 mb-3">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="float-right">
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <div class="btn-group btn-group-sm" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Supplier Quotation
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a class="dropdown-item" href="#">Create</a>
                                    <a class="dropdown-item" href="#">View</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm ml-1">Send Supplier Emails</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6><strong>DASHBOARD</strong></h6>

                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <!-- display when NEW button is clicked-->
                                <label for="inputEmail4">Series</label>
                                <select class="form-control"></select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Date</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <hr class="mt-2 mb-5">
                    <h6><strong>Supplier Detail</strong></h6>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center" style="width: 0%;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th scope="col">Supplier</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Email Id</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < 1; $i++): ?> <tr>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </tr>
                                <?php endfor; ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="7 p-5">
                                    <button class="btn btn-secondary btn-sm">Add Row</button>
                                </td>
                            </tr>
                        </tfoot>

                    </table>

                    <button class="btn btn-secondary btn-sm">Get Suppliers</button>
                </div>
                <div class="card-body">
                    <hr class="mt-2 mb-5">
                    <h6><strong>Items</strong></h6>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center" style="width: 0%;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </th>
                                <th scope="col">Item Code</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Required Date</th>
                                <th scope="col">Warehouse</th>
                                <th scope="col">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 0; $i < 1; $i++): ?> <tr>
                                <td class="text-center">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">&nbsp;</label>
                                    </div>
                                </td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                </tr>
                                <?php endfor; ?>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td colspan="7 p-5">
                                    <button class="btn btn-secondary btn-sm">Add Multiple Row</button>
                                    <button class="btn btn-secondary btn-sm">Add Row</button>
                                </td>
                            </tr>
                        </tfoot>

                    </table>


                    <button class="btn btn-secondary btn-sm">Link to Material Requests</button>

                </div>
                <div class="card-body">
                    <!-- <hr class="mt-2 mb-5">
                    <h6><strong>Message for Supplier</strong></h6> -->

                    <form>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Email Template</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">&nbsp;</div>
                        </div>

                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Message for Supplier</label>
                                <textarea id="notes" class="summernote" name="notes"></textarea>
                            </div>

                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <hr class="mt-2 mb-5">
                    <h6><strong>Terms and Conditions</strong></h6>

                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Terms</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">&nbsp;</div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Terms and Conditions</label>
                                <textarea id="notes" class="summernote" name="notes"></textarea>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <hr class="mt-2 mb-5">
                    <h6><strong>PRINTING SETTINGS</strong></h6>

                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Print Heading</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">&nbsp;</div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Letter Head</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">&nbsp;</div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <hr class="mt-2 mb-5">
                    <h6><strong>MORE INFORMATION</strong></h6>

                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Status</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">&nbsp;</div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Fiscal Year</label>
                                <input type="text" class="form-control" id="inputEmail4" placeholder=""></select>
                            </div>
                            <div class="form-group col-md-6">&nbsp;</div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <!-- <div class="btn-group" role="group">
                        <button type="button" class="btn btn-dark" href="#">20</button>
                        <button type="button" class="btn btn-secondary" href="#">100</button>
                        <button type="button" class="btn btn-secondary" href="#">500</button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200
        });
        $('#myTimeline').verticalTimeline({
            startLeft: false,
            alternate: false,
            arrows: false
        });
    });

</script>
