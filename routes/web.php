<?php

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
// Open Routes Here

// Only Guest Routes Here
Route::middleware('guest')->group(function (){
    Route::get('/','Auth\LoginController@showLoginForm');

});
//Client Registration
Route::get('client/registration','RegistrationController@clientRegistration')->name('client.registration');
Route::post('client/registration','RegistrationController@saveClientRegistration')->name('client.registration');

//Customer Registration
Route::get('customer/registration','RegistrationController@customerRegistration')->name('customer.registration');
Route::post('customer/registration','RegistrationController@saveCustomerRegistration')->name('customer.registration');

//Payment Route
Route::post('invoice/payment/{status}','PaymentController@getPaymentOption');
//Transactions history
Route::get('transaction/history','PaymentController@getTransactionList')->name('transaction.history');
// Authenticate Routes Here
Route::middleware('auth')->namespace('Backend')->group(function (){

    // Common Routes
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    //All profile
    Route::get('profile','ProfileController@showProfile')->name('profile');
    Route::get('profile_edit/{id}','ProfileController@editClientProfile')->name('edit_profile');
    Route::post('profile_update/{id}','ProfileController@updateClientProfile')->name('update_profile');
    //Invoice History
    Route::get('invoice_history/list','InvoiceHistoryController@listOfInvoiceHistory')->name('invoice.history');
    Route::get('invoice/details/{id}','InvoiceHistoryController@customerDetailsInvoice')->name('invoice.details');


    // Admin Routes
    Route::middleware('authorized.user:Admin')->namespace('Admin')->group(function (){
        Route::resource('admin', 'AdminController', ['only' => [
            'index', 'create' , 'store', 'edit', 'update','show'
        ]]);

        Route::post('admin/status','AdminController@changeStatus')->name('admin.status');
        Route::resource('system_setting','SystemSettingController');
        //customer to client convert
        Route::post('customer-to-client','AdminController@customerToClient')->name('customer-to-client');
        //client business type active inactive
        Route::get('client/business/{id}','ClientBusinessController@clientBusinessList')->name('client.business');
        Route::post('business_type/status','ClientBusinessController@changestatus')->name('business_type.status');
        //Reports
         Route::get('clients/report','AdminReportsController@allClientInfoReport')->name('clients.report');
         Route::get('client/business_report/{cid}','AdminReportsController@allClientBusiness')->name('client.business_report');
        Route::get('client/invoice/{cid}','AdminReportsController@allClientInvoice')->name('client.invoice');

    });
    // Client Routes
    Route::middleware('authorized.user:Client')->namespace('Client')->group(function (){
        //Client Business type Route...
        Route::resource('client_business_type','BusinessTypeController');


        //items Route...
        Route::resource('items_manage','ItemController');
        Route::post('item/status','ItemController@itemStatusChange')->name('item.status');

        //Discount Route...
        Route::resource('client_discount','ClientDiscountController');
        Route::post('client_discount/status','ClientDiscountController@changeDiscountStatus')->name('client_discount.status');

        //Customer Route...
        Route::resource('customer_group','CustomerGroupController');
        Route::post('customer_group/status','CustomerGroupController@changeCustomerGroupStatus')->name('customer_group.status');

        Route::resource('client_customer_group_pivot','ClientCustomerGroupPivotController',['only' => [
            'index', 'store'
        ]]);
        Route::post('client_customer_group_pivot/status','ClientCustomerGroupPivotController@changeStatus')->name('client_customer_group_pivot.status');
        Route::resource('employee','RegistrationController');
        Route::get('ajaxSearchUserByMobileNumber','ClientCustomerGroupPivotController@ajaxSearchUserByMobileNumber');

        //Invoice Route...
        Route::resource('invoice','InvoiceController');
        Route::post('ajax_load_discount','InvoiceController@getdiscountlistbybusinesstype')->name('ajax_load_discount');
        Route::resource('notification','NotificationsController');

        Route::get('invoice_preview','InvoiceController@getAllInvoicePreview')->name('invoice_preview');
        Route::get('invoice_preview/edit/{id}','InvoiceController@getEditInvoice')->name('invoice_preview.edit');
        Route::post('invoice_preview/update','InvoiceController@updatePreviewInvoice')->name('invoice_preview.update');
        Route::post('invoice/save_all','InvoiceController@saveAllInvoiceFromSession')->name('invoice.save_all');
        Route::get('list/preview_invoice/{id}','InvoiceController@singleInvoicePreview')->name('invoice.singlePreview');
        //Employee Route...
        Route::resource('employee_manage', 'EmployeeManageController');
        Route::post('employee/status','EmployeeManageController@changeStatus')->name('employee.status');
        Route::get('employee/active/{id}','EmployeeManageController@employeeActive');

        Route::resource('customer','CustomerController');

    });

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/changePassword','HomeController@showChangePasswordForm')->name('changePassword');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');