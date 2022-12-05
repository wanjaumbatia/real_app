<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CashflowController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OfficeAdminController;
use App\Http\Controllers\OperationsController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\OfficeAdmin;
use App\Models\BankAccount;
use App\Models\Branch;
use App\Models\SMSMessage;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('index');
    });
    Route::middleware(['is_admin'])->group(function () {
        //ADMIN
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::get('/users/import', [UserController::class, 'import'])->name('admin.user.import');
        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
        Route::post('/users/import', [UserController::class, 'upload'])->name('admin.users.upload');
        Route::get('users/store_upload', [UserController::class, 'store_upload'])->name('admin.users.store_upload');

        Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
        Route::get('/roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
        Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('admin.roles.edit');
        Route::post('/roles', [RoleController::class, 'store'])->name('admin.roles.store');

        Route::get('/branches', [BranchController::class, 'index'])->name('admin.branches.index');
        Route::get('/branches/create', [BranchController::class, 'create'])->name('admin.branches.create');
        Route::get('/branches/edit/{id}', [BranchController::class, 'edit'])->name('admin.branches.edit');

        Route::get('/sms', [NotificationController::class, 'sms'])->name('admin.notifications.sms');
        Route::get('/emails', [NotificationController::class, 'email'])->name('admin.notifications.email');


        Route::get('/plans', [PlanController::class, 'index'])->name('admin.plans.index');
        Route::get('/plans/create', [PlanController::class, 'create'])->name('admin.plans.create');
        Route::get('/plans/edit/{id}', [PlanController::class, 'edit'])->name('admin.plans.edit');
        Route::post('/plans', [PlanController::class, 'store'])->name('admin.plans.store');
        Route::put('/plans/{id}', [PlanController::class, 'update'])->name('admin.plans.update');
        Route::put('/plans/{id}', [PlanController::class, 'update'])->name('admin.plans.update');

        //sales admin
        Route::get('/admin/customers', [AdminController::class, 'customers'])->name('admin.customers');
        Route::get('/load_customers', [AdminController::class, 'load_customers']);
        Route::get('/admin/customers/import', [AdminController::class, 'import_customers'])->name('admin.import_customers');
        Route::post('/admin/customer/upload', [AdminController::class, 'upload_customers'])->name('admin.upload_customer');
        Route::get('/admin/payments', [AdminController::class, 'payments'])->name('admin.payments');
        Route::get('/load_payments', [AdminController::class, 'load_payments']);

        Route::get('/finance/banks', [BankController::class, 'index'])->name('finance.banks.index');
        Route::get('/finance/banks/create', [BankController::class, 'create'])->name('finance.banks.create');
        Route::post('/finance/banks/store', [BankController::class, 'store'])->name('finance.banks.store');


        //END ADMIN
    });

    Route::get('/ops/cashflow', [OperationsController::class, 'cashflows'])->name('ops.cashflows');
    Route::get('/ops/cashflow/create', [OperationsController::class, 'create_cashflow'])->name('ops.create_cashflow');
    Route::post('/ops/cashflow/store', [OperationsController::class, 'store_cashflow'])->name('ops.store_cashflow');
    //SALES EXECUTIVE

    Route::middleware(['is_sep'])->group(function () {
        Route::get('/sep/customers', [SalesController::class, 'customers'])->name('sep.customers');
        Route::get('/sep/customer/{id}', [SalesController::class, 'customer'])->name('sep.customer');
        Route::get('/sep/collection/{id}', [SalesController::class, 'collection'])->name('sep.customer.collection');
        Route::post('/create_account/{id}', [SalesController::class, 'create_account'])->name('sep.create_account');
        Route::post('/sep/collection', [SalesController::class, 'collection_post'])->name('sep.customer.payment');
        Route::get('/sep/withdrawal/{id}', [SalesController::class, 'withdrawal'])->name('sep.customer.withdrawal');
        Route::post('/sep/withdrawal_post/{id}', [SalesController::class, 'withdrawal_post'])->name('sep.customer.withdrawal_post');

        Route::get('/sep/reconciliation', [SalesController::class, 'reconciliation'])->name('sep.reconciliation');

        Route::get('/sep/logs/savings', [SalesController::class, 'savings_logs'])->name('sep.logs.savings_logs');
        Route::get('/sep/logs/withdrawals', [SalesController::class, 'withdrawal_logs'])->name('sep.logs.withdrawals_logs');
        Route::get('/sep/logs/loan_repayments', [SalesController::class, 'loan_repayments_logs'])->name('sep.logs.loan_repayments_logs');
    });
    //SALES EXECUTIVE

    //OFFICE ADMIN
    Route::middleware(['is_office_admin'])->group(function () {
        Route::get("/reconciliation", [OfficeAdminController::class, 'reconciliation'])->name('office_admin.reconciliation');
        Route::get("/reconcile/{name}", [OfficeAdminController::class, 'reconcile'])->name('office_admin.reconcile');
        Route::post("/reconcile_post/{name}", [OfficeAdminController::class, 'reconcile_post'])->name('office_admin.reconcile_post');
        Route::get('/reconcile/withdrawal/{name}', [OfficeAdminController::class, 'recon_withdrawal_list'])->name('office_admin.recon_withdrawal_list');
        Route::get('/reconcile_withdrawal/{id}', [OfficeAdminController::class, 'recon_withdrawal_page'])->name('office_admin.recon_withdrawal');
        Route::get('/approve_cashflow', [OfficeAdminController::class, 'cashflow_approval'])->name('office_admin.cashflow_approval');
        Route::get('/confirm_cashflow/{id}', [OfficeAdminController::class, 'confirm_cashflow'])->name('office_admin.confirm_cashflow');

        Route::get('/expenses', [OfficeAdminController::class, 'expenses'])->name('office_admin.expenses.index');
        Route::get('/expenses/create', [OfficeAdminController::class, 'create_expense'])->name('office_admin.expenses.create');
        Route::post('/expenses/store', [OfficeAdminController::class, 'store_expenses'])->name('office_admin.expenses.store');
        Route::get('/bank_balance', [OfficeAdminController::class, 'BankBalance'])->name('office_admin.bank_balance');
        Route::get('/admin/summary', [OfficeAdminController::class, 'cash_summary'])->name('office_admin.cash_summary');
    });

    //OFFICE ADMIN

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});

Auth::routes();
