<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('vendor/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">RELIANCE CRM</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('vendor/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                @if(Auth::user()->role == 'Office Admin')
                <li class="nav-item">
                    <a href="/reconciliation" class="nav-link">
                        <i class="nav-icon fas fa-calculator"></i>
                        <p>
                            Reconciliation
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Reconciliation Report
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/expenses" class="nav-link">
                        <i class="nav-icon fas fa-file-import"></i>
                        <p>
                            Expenses
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/summary" class="nav-link">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>
                            Cash Summary
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sort-amount-down"></i>
                        <p>
                            Shortage
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/approve_cashflow" class="nav-link">
                        <i class="nav-icon fas fa-record"></i>
                        <p>
                            Cashflow
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/bank_balance" class="nav-link">
                        <i class="nav-icon fas fa-bank"></i>
                        <p>
                            Bank Balance
                        </p>
                    </a>
                </li>

                @endif

                @if(Auth::user()->role == 'Sales Executive')
                <li class="nav-item">
                    <a href="/sep/customers" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Customers
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/sep/reconciliation" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Reconciliation
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Logs
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/sep/logs/savings" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Deposits</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/sep/logs/withdrawals" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Withdrawals</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/sep/logs/loan_repayments" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Loan Repayment</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-dollar-sign"></i>
                        <p>
                            Loans
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Loan Applications</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Active Loans</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Expired Loans</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Closed Loans</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Loan Status Summary</p>
                            </a>
                        </li>

                    </ul>

                </li>
                @endif

                @if(Auth::user()->role == 'Admin')

                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/users" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Users List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/users/create" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/users/import" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Import User</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="/roles/create" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New Role</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/roles" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                    </ul>

                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Branches
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/branches/create" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>New Branch</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/branches" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Branches</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>
                            Notifications
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/sms" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SMS Message</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/emails" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Email</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-money-bill"></i>
                        <p>
                            Sales
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/customers" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Customers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/payments" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Payments</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Withdrawals</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Real Invest</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Loans</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/customers/import" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Import Customers</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Setup
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/plans" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Plans</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/finance/banks" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bank Accounts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/finance/cashflow" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cashflow</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Expenses</p>
                            </a>
                        </li>
                    </ul>

                </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>