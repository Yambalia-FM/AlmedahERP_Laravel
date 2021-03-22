<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\DebugController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BOMController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobSchedulingController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\MaterialsPurchasedController;
use App\Http\Controllers\MaterialUOMController;
use App\Http\Controllers\MatRequestController;
use App\Http\Controllers\PartsController;
use App\Http\Controllers\ProductMonitoringController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\WorkOrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function() {
    return view('modules.dashboard');
});

Route::get('/accounting', function() {
    return view('modules.accounting.accounting');
});

/**BOM ROUTES */
Route::get('/bom', [BOMController::class, 'index']);
Route::get('/newBOM', function() { 
    return view('modules.manufacturing.bomsubModules.newbom');
});
Route::get('/subNewBOM', function() {
    return view('modules.newbom');
});
Route::post('/createBOM', [BOMController::class , 'store']);
Route::post('/update_status/{bom_id}', [BOMController::class, 'updateStatus']);
Route::get('/checkBOM/{bom_id}', [BOMController::class, 'checkIfBOMExists']);
Route::get('/getBomMaterials/{bom_id}', [BOMController::class, 'getMaterials']);
Route::post('/deleteBOM/{bom_id}', [BOMController::class, 'delete']);
Route::post('/suggest_product', [BOMController::class, 'search']);
Route::get('/search-product/{product_code}', [BOMController::class, 'search_product']);
Route::get('/viewbom/{id}', [BOMController::class, 'get']);

/**BUYING ROUTES */
Route::get('/buying', function() {
    return view('modules.buying.Buying');
});

/**CRM ROUTES */
Route::get('/contacts', function() {
    return view('modules.crm.contacts');
});
Route::get('/crm', function() {
    return view('modules.crm.crm');
});
Route::get('/customers', function() {
    return view('modules.crm.customers');
});
Route::get('/leads', function() {
    return view('modules.crm.leads');
});
Route::get('/objectives', function() {
    return view('modules.crm.objectives');
});
Route::get('/opportunities', function() {
    return view('modules.crm.opportunities');
});

/**DELIVERY ROUTES */
Route::get('/delivery', function() {
    return view('modules.productreleasing.delivery');
});
Route::get('/view-delivery-info', function() {
    return view('modules.productreleasing.deliveryinfo');
});

/**HR ROUTES */
Route::get('/hr', function() {
    return view('modules.hr.hr');
});
Route::get('/employee', [EmployeeController::class, 'index']);
Route::post('/create-employee', [EmployeeController::class, 'store'])->name('employee');
Route::post('/update-employee-image/{id}', [EmployeeController::class, 'updateimage']);
Route::put('/update-employee/{id}', [EmployeeController::class, 'update']);
Route::put('/update-employee-status/{id}/{stat}', [EmployeeController::class, 'toggle']);

/**INVENTORY ROUTES */
Route::get('/openInventoryInfo', function() {
    return view('modules.manufacturing.inventoryInfo');
});
Route::get('/inventory', [MaterialsController::class, 'index'])->name('inventory');
Route::get('/inventory/{id}', [MaterialsController::class, 'get'])->name('inventory.specific');
Route::post('/create-material', [MaterialsController::class, 'store']);
Route::patch('/update-material/{id}', [MaterialsController::class,'update'])->name('material.update');
Route::post('/delete-material/{id}', [MaterialsController::class, 'delete']);
Route::post('/create-categories' , [MaterialsController::class, 'storeCategory']);
Route::post('/add-stock/{id}', [MaterialsController::class,'addStock'])->name('material.add-stock');

/**ITEM ROUTES */
Route::get('/item',[ProductsController::class, 'index']);
Route::patch('/create-product', [ProductsController::class, 'store']);
Route::patch('/update-product/{id}', [ProductsController::class, 'update']);
Route::post('/delete-product/{id}', [ProductsController::class, 'delete']);
Route::post('/create-item-group', [ProductsController::class, 'add_item_group']);
Route::post('/create-product-unit', [ProductsController::class ,'add_product_unit']);
Route::get('/get-attribute/{id}', [ProductsController::class, 'get_attribute']);


/**ITEM VARIANT ROUTES */
Route::get('/openItemVariantSettings', function() {
    return view('modules.stock.itemvariantsettings');
});
Route::post('/create-attribute', [ProductsController::class, 'add_attribute']);
Route::get('/get-attribute/{id}', [ProductsController::class,' get_attribute']);
Route::patch('/update-attribute/{id}', [ProductsController::class, 'update_attribute']);
Route::post('/delete-attribute/{id}', [ProductsController::class, 'delete_attribute']);

/**JOB SCHEDULING ROUTES */
Route::get('/loadJobsched', function() {
    return view('modules.manufacturing.jobschedulinginfo');
});
Route::get('/jobscheduling', [JobSchedulingController::class, 'index']);

// Route for parts needed in a job scheduling entry
Route::resource('/jobscheduling/part', PartsController::class);
// Route for the component being made in a job scheduling entry
Route::resource('/jobscheduling/component', ComponentController::class);

/**MANUFACTURING ROUTES */
Route::get('/manufacturing', function() {
    return view('modules.manufacturing.manufacturing');
});
Route::get('/customer', [CustomerController::class, 'index']);
Route::post('/create-customer', [CustomerController::class, 'store'])->name('customer');
Route::put('/update-customer/{id}', [CustomerController::class, 'update']);

/**MANUFACTURING ITEM ATTRIBUTE ROUTES */
Route::get('/itemattribute', function() {
    return view('modules.manufacturing.itemattribute');
});
Route::get('/openManufacturingItemAttributeForm', function() {
    return view('modules.manufacturing.itemattributeform');
});

/**MANUFACTURING ITEM PRICE ROUTES */
Route::get('/itemprice', function() {
    return view('modules.manufacturing.itemprice');
});
Route::get('/openManufacturingItemPriceForm', function() {
    return view('modules.manufacturing.itempriceform');
});

/**MANUFACTURING ROUTING ROUTES */
Route::get('/routing', function() {
    return view('modules.manufacturing.routing');
});
Route::get('/openManufacturingRoutingForm', function(){
    return view('modules.manufacturing.routingform');
});

/**MATERIAL REQUEST ROUTES */
Route::resource('/materialrequest', MatRequestController::class);
Route::get('/openNewMaterialRequest', function(){
    return view('modules.buying.newMaterialRequest');
});
Route::get('/openMaterialRequestInfo', function() {
    return view('modules.buying.MaterialRequestInfo');
});

/**MESSAGING ROUTES */
Route::get('/inbox', function() {
    return view('modules.messaging.inbox');
});
Route::get('/important', function() {
    return view('modules.messaging.important');
});
Route::get('/archived', function() {
    return view('modules.messaging.archived');
});

/**PAYMENT ENTRY ROUTES*/
Route::get('/paymententry', function() {
    return view('modules.accounting.paymententry');
});

/**PENDING ORDERS ROUTES */
Route::get('/pendingorders', function() {
    return view('modules.buying.pendingorders');
});
Route::get('/view-pending-order', function() {
    return view('modules.buying.pendingordersinfo');
});

/**PRICE LIST ROUTES */
Route::get('/openNewPriceList', function() {
    return view('modules/selling/pricelistitem.php');
});
Route::get('/loadPriceList', function() {
    return view('modules.selling.pricelist');
});

/**PRODUCTION ROUTES */
Route::get('/production', function() {
    return view('modules.manufacturing.production');
});

/**PRODUCT MONITORING ROUTES */
// Route::get('/productmonitoring', [ProductMonitoringController::class, 'index']);
// Route::post('/create-monitor-entry', [ProductMonitoringController::class, 'store']);
Route::resource('/productmonitoring', ProductMonitoringController::class);

/**PRODUCTION PLAN ROUTES */
Route::get('/productionplan', function() {
    return view('modules.manufacturing.productionplan');
});
Route::get('/openManufacturingProductionPlanForm', function() {
    return view('modules.manufacturing.productionplanform');
});

/**PROJECTS ROUTES */
Route::get('/projects', function() {
    return view('modules.projects.projects');
});
Route::get('/task', function() {
    return view('modules.projects.task');
});

/**PROJECT TEMPLATE */
Route::get('/project', function() {
    return view('modules.projects.project');
});
Route::get('/openNewProjectTemplate', function() {
    return view('modules.projects.newprojecttemplate');
});
Route::get('/loadProjectTemplate', function() {
    return view('modules.projects.projecttemplate');
});

/**PURCHASE ORDER ROUTES */
Route::get('/purchaseorder', [MaterialsPurchasedController::class,'index']);
Route::get('/openNewPurchaseOrder', function() {
    return view('modules.buying.newpurchaseorder');
});

/**QUALITY ROUTES */
Route::get('/quality', function() {
    return view('modules.quality.quality');
});

/**REPORTS ROUTES*/
Route::get('/reportsbuilder', function() {
    return view('modules.reports.reportsbuilder');
});
Route::get('/loadReportsBuilderShowReport', function() {
    return view('modules.reports.reportsbuilderform_showreport');
});
Route::get('/openReportsBuilderForm', function() {
    return view('modules.reports.reportsbuilderform');
}); 

/**REQUEST FOR QUOTATION ROUTES */
Route::get('/requestforquotation', function() {
    return view('modules.buying.requestforquotation');
});
Route::get('/new-quotation', function() {
    return view('modules.buying.requestforquotationform');
});
Route::get('/view-quotation', function() {
    return view('modules.buying.requestforquotationinfo');
});

/**RETAIL ROUTES */
Route::get('/retail', function() {
    return view('modules.retail.retail');
});

/**SALES ORDER ROUTES */
Route::get('/view-sales-order/{id}', [SalesOrderController::class, 'get']);
Route::get('/salesorder',[SalesOrderController::class, 'index']);
Route::post('/createsalesorder',[SalesOrderController::class, 'create']);
Route::get('/openNewSaleOrder', function() {
    return view('modules.selling.newsaleorder');
});
Route::get('/search-customer/{id}', [SalesOrderController::class, 'find_customer']);
Route::get('/getComponents/{selected}',[SalesOrderController::class, 'getComponents']);

/**SALES INVOICE ROUTES */
Route::get('/salesinvoice', function() {
    return view('modules.selling.salesinvoice');
});
Route::get('/sales-invoice-item', function() {
    return view('modules.selling.salesinvoiceitem');
});

/**SELLING ROUTES */
Route::get('/selling', function() {
    return view('modules.selling.selling');
});

/**STOCK ROUTES */
Route::get('/stock', function() {
    return view('modules.stock.stock');
});

/**STOCK ENTRY ROUTES */
Route::get('/openNewStockEntry', function() {
    return view('modules.manufacturing.NewStockEntry');
});
Route::get('/loadStockEntry', function() {
    return view('modules.manufacturing.stockentry');
});

/**SUPPLIER ROUTES */
Route::get('/supplier', function() {
    return view('modules.buying.supplier');
});
Route::get('/openSupplierInfo', function() {
    return view('modules.buying.supplierInfo');
});
Route::get('/createnewsupplier', function() {
    return view('modules.buying.createnewsupplier');
});

/**TASK ROUTES */
Route::get('/openNewTask', function() {
    return view('modules.projects.taskitem');
});
Route::get('/task', [JobController::class, 'index']);
Route::get('/create-task', [JobController::class, 'store']);

/**TIMESHEETS ROUTES */
Route::get('/loadProjectsTimesheet', function() {
    return view('modules.manufacturing.timesheet');
});
Route::get('/openManufacturingTimesheetForm', function(){
    return view('modules.manufacturing.timesheetform');
});

/**UOM ROUTES */
Route::get('/uom', [MaterialUOMController::class, 'index']);
Route::post('/create-mat-uom', [MaterialUOMController::class, 'store']);
Route::get('/openUOMNew', function() {
    return view('modules.stock.UOMNEW');
});
Route::get('/openUOMEdit', function() {
    return view('modules.stock.UOMEDIT');
});

/**WORK ORDER ROUTES*/
Route::get('/workorder', [WorkOrderController::class, 'index']);
Route::get('/openNewWorkorder', function() {
    return view('modules.manufacturing.workordersubModules.NewWorkorder');
});
Route::get('/loadWorkOrderInfo', function() {
    return view('modules.manufacturing.workordersubModules.workorder_info');
});

/**WAREHOUSE ROUTES */
Route::get('/loadWarehouse', function() {
    return view('modules.stock.warehouse');
});
Route::get('/openWarehouseNew', function(){
    return view('modules.stock.warehouseSubModules.warehouseNEW');
});
Route::get('/openWarehouseEdit', function() {
    return view('modules.stock.warehouseSubModules.warehouseEDIT');
});

/**WORKSTATION ROUTES */
Route::get('/workstation', [StationController::class, 'index']);
Route::get('/openManufacturingWorkstationForm', function() {
    return view('modules.manufacturing.workstationform');
});
Route::post('/create-station', [StationController::class, 'store']);

Route::get('/debug', [DebugController::class, 'index']);