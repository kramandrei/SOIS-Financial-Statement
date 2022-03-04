<!--start sidebar -->
<aside class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <h4 class="logo-text">SOIS-FS</h4>
        </div>
        <div class="toggle-icon ms-auto"> <i class="bi bi-list"></i></div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="#">
                <div class="parent-icon"><i class="bi bi-house-fill"></i></div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        @if(Auth::user()->role_id == 9 || Auth::user()->role_id == 7)
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa fa-money-bill"></i></div>
                <div class="menu-title">Finances</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('org-incomes.index') }}"><i class="fa fa-piggy-bank"></i>Organization Incomes</a>
                </li>
                <li>
                    <a href="{{ route('org-expenses.index') }}"><i class="fa fa-credit-card"></i>Organization Expenses</a>
                </li>
            </ul>
        </li>
        @endif
        @if(Auth::user()->role_id == 7)
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa fa-print"></i></div>
                <div class="menu-title">Reports</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('report.finance') }}"><i class="fa fa-print"></i>Finance Report</a>
                </li>
            </ul>
        </li>
        @endif
        @if(Auth::user()->role_id == 1)
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="fa fa-cogs"></i></div>
                <div class="menu-title">Utilities</div>
            </a>
            <ul>
                <li>
                    <a href="{{ route('incomes.index') }}"><i class="fa fa-piggy-bank"></i>Incomes</a>
                </li>
                <li>
                    <a href="{{ route('expenses.index') }}"><i class="fa fa-credit-card"></i>Expenses</a>
                </li>
                <li>
                    <a href="{{ route('roles.index') }}"><i class="fa fa-universal-access"></i>Roles</a>
                </li>
                <li>
                    <a href="{{ route('organizations.index') }}"><i class="fa fa-layer-group"></i>Organizations</a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}"><i class="fa fa-users"></i>Users</a>
                </li>
            </ul>
        </li>
        @endif
        <li>
            <a href="{{ route('gawas') }}">
                <div class="parent-icon"><i class="fa fa-sign-out-alt"></i></div>
                <div class="menu-title">Logout</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</aside>
<!--end sidebar -->