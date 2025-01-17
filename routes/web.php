<?php

use App\Http\Controllers\admin\CustomFromController;
use App\Http\Controllers\admin\ExpenseController;
use App\Http\Controllers\admin\FtpController;
use App\Http\Controllers\admin\LocationController;
use App\Http\Controllers\admin\NoticeController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\admin\PackageRequestController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\PurchaseController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\TermsController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\BkashController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\employee\EmpDashboard;
use App\Http\Controllers\employee\ExpenseController as EmployeeExpenseController;
use App\Http\Controllers\web\HomePageController;
use App\Http\Controllers\web\PagesController;
use App\Http\Middleware\ClientGuard;
use App\Http\Middleware\EmployeeGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// PUBLIC WEBSITE ROUTES
Route::get('/', [HomePageController::class, 'index'])->name('home');
Route::get('/payment', [PagesController::class, 'paymnet_page'])->name('payment');
Route::get('/ftp', [PagesController::class, 'ftp_page'])->name('ftp.servers');
Route::get('/packages', [PagesController::class, 'packagesPage'])->name('packages');
Route::get('/packages/hotspot', [PagesController::class, 'packageHotspotPage'])->name('packages.hotspot');
Route::get('/terms', [PagesController::class, 'terms'])->name('terms');
Route::get('/connection-request', [PagesController::class, 'conReqPage'])->name('conreq.page');
Route::post('/connection-request/create', [PagesController::class, 'connReqSubmit'])->name('conreq.create');
Route::get('/privacy', [PagesController::class, 'privacy_policy'])->name('policy.privacy');
Route::get('/refund-policy', [PagesController::class, 'refund_policy'])->name('policy.refund');
Route::get('/about', [PagesController::class, 'about'])->name('aboutus');
Route::get('/free-wifi', [PagesController::class, 'free_wifi'])->name('web.freewifi');

// BKASH GATEWAY
Route::get('/bkash/pay/{id}', [BkashController::class, 'init_bkash_payment']);
Route::get('/bkash/verify', [BkashController::class, 'verify_bkash_payment']);

// CUSTOM FORM
Route::get('/tv', [PagesController::class, 'custom_form_view'])->name('customform.create');
Route::post('/custom-form/store', [PagesController::class, 'custom_form_store'])->name('customform.store');

Route::get('/admin', function() {
    return redirect()->route('admin.dashboard');
});

// AUTH LANDING AND REDIRECTS
Route::get('/auth_land', function() {
    if (Auth::user()) {
        if (Auth::user()->user_type == 'admin') {
            return redirect()->route('admin.dashboard');
        }else if(auth()->user()->user_type == 'employee') {
            return redirect()->route('employee.dashboard');
        }else if(auth()->user()->user_type == 'client'){
            return redirect()->route('client.dashboard');
        }
    }else {
        Auth::logout();
        return redirect()->route('login');
    }
})->name('auth.land');

// ADMIN ROUTES
Route::prefix('admin')->name('admin.')->middleware('adminguard')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/ftp', [FtpController::class, 'index'])->name('ftp');
    Route::get('/ftp/update/{ftpid}', [FtpController::class, 'updatePage'])->name('ftp.page.update');
    Route::post('/ftp/create', [FtpController::class, 'create'])->name('ftp.create');
    Route::post('/ftp/update', [FtpController::class, 'updateFtp'])->name('ftp.update');
    Route::get('/ftp/delete/{ftpid}', [FtpController::class, 'delete'])->name('ftp.delete');

    // PACKAGE ROUTES
    Route::get('/packages', [PackageController::class, 'index'])->name('package.index');
    Route::get('/package/create', [PackageController::class, 'createPage'])->name('package.create');
    Route::post('/package/store', [PackageController::class, 'createPackage'])->name('package.store');
    Route::get('/package/delete/{packageId}', [PackageController::class, 'delete'])->name('package.delete');
    Route::get('/package/edit/{packageId}', [PackageController::class, 'editPage'])->name('package.edit');
    Route::post('/package/update', [PackageController::class, 'update'])->name('package.update');

    // LOCATION ROUTES
    Route::get('/location/upozilas', [LocationController::class, 'upozilas'])->name('location.upozilas');
    Route::get('/location/upozila/edit/{upozila_id}', [LocationController::class, 'editUpozila'])->name('location.upozila.edit');
    Route::post('/location/upozila/update', [LocationController::class, 'updateUpozila'])->name('location.upozila.update');
    Route::post('/location/upozila/store', [LocationController::class, 'storeUpozila'])->name('location.upozila.store');
    Route::get('/location/upozila/delete/{upozila_id}', [LocationController::class, 'deleteUpozila'])->name('location.upozila.delete');
    Route::get('/location/unions', [LocationController::class, 'unions'])->name('location.unions');
    Route::get('/location/union/create', [LocationController::class, 'createUnion'])->name('location.union.create');
    Route::post('/location/union/store', [LocationController::class, 'storeUnion'])->name('location.union.store');
    Route::get('/location/union/delete/{union_id}', [LocationController::class, 'deleteUnion'])->name('location.union.delete');

    // NOTICE ROUTES
    Route::get('/notice', [NoticeController::class, 'index'])->name('notice.index');
    Route::post('/notice/update', [NoticeController::class, 'update'])->name('notice.update');

    // TERMS AND CONDITIONS
    Route::get('/terms', [TermsController::class, 'index'])->name('terms.index');
    Route::post('/terms/update', [TermsController::class, 'update'])->name('terms.update');

    // INTERNET CONNECTION REQUESTS
    Route::get('/connection-requests', [PackageRequestController::class, 'index'])->name('con.req.index');
    Route::get('/connection-requests/view/{package_id}', [PackageRequestController::class, 'viewPackage'])->name('con.req.view');
    Route::get('/connection-requests/delete/{package_id}', [PackageRequestController::class, 'deletePackage'])->name('conn.req.delete');

    // SLIDER ROUTES
    Route::get('/sliders', [SliderController::class, 'index'])->name('slider.index');
    Route::get('/slider/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('/slider/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('/slider/delete/{id}', [SliderController::class, 'delete'])->name('slider.delete');
    Route::get('/slider/edit/{id}', [SliderController::class, 'edit_view'])->name('slider.edit');
    Route::post('/slider/update', [SliderController::class, 'update'])->name('slider.update');

    // CUSTOM FORM
    Route::get('/custom-form-data', [CustomFromController::class, 'index'])->name('customform.index');
    Route::get('/custom-form-data/delete/{id}', [CustomFromController::class, 'delete'])->name('customform.delete');
    Route::post('/custom-form-update', [CustomFromController::class, 'update'])->name('customform.update');

    // USER MANAGEMENT
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

    // CATEGORY MANAGEMENT
    Route::get('/expense-category', [ExpenseController::class, 'expense_categories'])->name('expense.category.index');
    Route::post('/expense-category/store', [ExpenseController::class, 'expense_category_store'])->name('expense.category.store');
    Route::get('/expense-category/edit/{id}', [ExpenseController::class, 'expense_category_edit'])->name('expense.category.edit');
    Route::post('/expense-category/update', [ExpenseController::class, 'expense_category_update'])->name('expense.category.update');

    // EXPENSE MANAGEMENT
    Route::get('/expenses', [ExpenseController::class, 'expenses'])->name('expense.index');
    Route::get('/expense/create', [ExpenseController::class, 'create'])->name('expense.create');
    Route::post('/expense/store', [ExpenseController::class, 'store'])->name('expense.store');
    Route::get('/expense/delete/{id}', [ExpenseController::class, 'delete'])->name('expense.delete');

    // MANAGE ZONES
    Route::get('/zones', [ProductController::class, 'zones'])->name('zone.index');
    Route::post('/zone/store', [ProductController::class, 'zone_store'])->name('zone.store');

    // PRDOUCT MANAGEMENT
    Route::get('/products', [ProductController::class, 'products'])->name('product.index');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update', [ProductController::class, 'update'])->name('product.update');

    // PURCHASE MANAGEMENT
    Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase.index');
    Route::get('/purchase/create', [PurchaseController::class, 'create'])->name('purchase.create');
    Route::post('/purchase/store', [PurchaseController::class, 'store'])->name('purchase.store');
    Route::get('/purchase/view/{id}', [PurchaseController::class, 'show'])->name('purchase.show');
    Route::get('/purchase/delete/{id}', [PurchaseController::class, 'delete'])->name('purchase.delete');

    // ORDER MANAGEMENT
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/create', [OrderController::class, 'create'])->name('order.create');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/view/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/order/print/{id}', [OrderController::class, 'print'])->name('order.print');
    Route::get('/order/delete/{id}', [OrderController::class, 'delete'])->name('order.delete');
    Route::get('/order/done/{id}', [OrderController::class, 'done'])->name('order.done');
    Route::post('/order/add-rider', [OrderController::class, 'add_rider'])->name('order.add.rider');
    // ORDER TRANSACTION
    Route::post('/order/transaction/create', [OrderController::class, 'add_transaction'])->name('order.transaction.create');
    Route::get('/order/transaction/verify/{id}', [OrderController::class, 'verify_transaction'])->name('order.transaction.verify');
    Route::get('/order/transaction/cash-in-hand', [OrderController::class, 'cash_in_hand'])->name('order.transaction.handcash');
});

// EMPLOYEE ROUTES
Route::prefix('/employee')->name('employee.')->middleware([EmployeeGuard::class])->group(function() {
    Route::get('/dashboard', [EmpDashboard::class, 'index'])->name('dashboard');

    // EXPENSE MANAGEMENT
    Route::get('/expenses', [EmployeeExpenseController::class, 'index'])->name('expense.index');
    Route::get('/expense/create', [EmployeeExpenseController::class, 'create'])->name('expense.create');
    Route::post('/expense/store', [EmployeeExpenseController::class, 'store'])->name('expense.store');

    // ORDER MANGEMENT
    Route::get('/orders', [OrderController::class, 'employee_assigned_orders'])->name('order.index');
    Route::get('/order/create', [OrderController::class, 'employee_order_create'])->name('order.create');
    Route::post('/order/store', [OrderController::class, 'store_emp_order'])->name('order.store');
    Route::get('/order/view/{id}', [OrderController::class, 'employee_order_view'])->name('order.view');
    Route::post('/order/transaction/create', [OrderController::class, 'employee_payment_create'])->name('order.payment.create');
    Route::get('/order/print/{id}', [OrderController::class, 'employee_print'])->name('order.print');
});


Route::prefix('/client')->name('client.')->middleware([ClientGuard::class])->group(function () {
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('dashboard');
    
    // ORDER PANEL
    Route::get('/orders', [ClientController::class, 'orders'])->name('order.index');
    Route::get('/order/place', [ClientController::class, 'create'])->name('order.place');
    Route::post('/order/store', [ClientController::class, 'store'])->name('order.store');
    Route::get('/order/view/{id}', [ClientController::class, 'view'])->name('order.view');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
