<div id="sidebar"  class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
        <li>
            <a class="{{ request()->segment(1) == 'dashboard' ? 'active' : null }}" href="{!! route('dashboard') !!}">
                <i class="fa fa-dashboard"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a class="{{ request()->segment(1) == 'transaction.history' ? 'active' : null }}" href="{!! route('transaction.history') !!}">
                <i class="fa fa-dollar"></i>
                <span>Transaction History</span>
            </a>
        </li>
        @if(auth()->user()->type=='Client'||auth()->user()->type=='Customer')
            <li>
                <a class="{{ request()->segment(1) == 'invoice.history' ? 'active' : null }}" href="{!! route('invoice.history') !!}">
                    <i class="fa fa-file-text"></i>
                    <span>Invoice History</span>
                </a>
            </li>
        @endif
        @if(auth()->user()->type=='Admin')
            <li class="sub-menu">
                <a href="javascript:;" class="{{ request()->segment(1) == 'admin' ? 'active' : null }}" >
                    <i class="fa fa-user"></i>
                    <span>Users</span>
                </a>
                <ul class="sub">
                    <li class="{{ request()->segment(2) == 'index' ? 'active' : null }}"><a href="{{ route('admin.index') }}">All</a></li>
                    <li class="{{ request()->segment(2) == 'Admin' ? 'active' : null  }}"><a href="{{ route('admin.index') }}?type=Admin">Admins</a></li>
                    <li class="{{ request()->segment(3) == 'Client' ? 'active' : null  }}"><a href="{{ route('admin.index') }}?type=Client">Clients</a></li>
                    <li class="{{ request()->segment(2) == 'Customer' ? 'active' : null  }}"><a href="{{ route('admin.index') }}?type=Customer">Customers</a></li>
                    <li class="{{ request()->segment(2) == 'create' ? 'active' : null }}"><a href="{{ route('admin.create') }}">Create</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" class="{{ request()->segment(1) == '' ? 'active' : null }}" >
                    <i class="fa fa-user"></i>
                    <span>Report</span>
                </a>
                <ul class="sub">
                    <li class="{{ request()->segment(2) == 'client.report' ? 'active' : null }}"><a href="{{ route('clients.report') }}">Client</a></li>

                </ul>
            </li>
        @endif
        @if(auth()->user()->type=='Client')
            <li class="sub-menu">
                <a href="javascript:;" class="{{ request()->segment(1) == 'employee_manage' ? 'active' : null }}" >
                    <i class="fa fa-user"></i>
                    <span>Manage Employee  </span>
                </a>
                <ul class="sub">
                    <li class="{{ request()->segment(1) == 'customer_group' && request()->segment(2) == '' ? 'active' : null }}"><a href="{{ route('employee_manage.index') }}">Lists</a></li>
                    <li class="{{ request()->segment(1) == 'customer_group' && request()->segment(2) == 'create' ? 'active' : null }}"><a href="{{ route('employee_manage.create') }}">Create</a></li>
                </ul>

            </li>
            <li class="sub-menu">
                <a href="javascript:;" class="{{ request()->segment(1) == 'client_business_type' ? 'active' : null }}" >
                    <i class="fa  fa-briefcase"></i>
                    <span>Client Business Type</span>
                </a>
                <ul class="sub">
                    <li class="{{ request()->segment(1) == 'client_business_type' && request()->segment(2) == '' ? 'active' : null }}"><a href="{{ route('client_business_type.index') }}">Lists</a></li>
                    <li class="{{ request()->segment(1) == 'client_business_type' && request()->segment(2) == 'create' ? 'active' : null }}"><a href="{{ route('client_business_type.create') }}">Create</a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;" class="{{ request()->segment(1) == 'items_manage' ? 'active' : null }}" >
                    <i class="fa   fa-list-ol"></i>
                    <span>Items Manage</span>
                </a>
                <ul class="sub">
                    <li class="{{ request()->segment(1) == 'items_manage' && request()->segment(2) == '' ? 'active' : null }}"><a href="{{ route('items_manage.index') }}">Lists</a></li>
                    <li class="{{ request()->segment(1) == 'items_manage' && request()->segment(2) == 'create' ? 'active' : null }}"><a href="{{ route('items_manage.create') }}">Create</a></li>
                </ul>

            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="{{ request()->segment(1) == 'client_discount' ? 'active' : null }}" >
                    <i class="fa fa-cut"></i>
                    <span>Discount</span>
                </a>
                <ul class="sub">
                    <li class="{{ request()->segment(1) == 'client_discount' && request()->segment(2) == '' ? 'active' : null }}"><a href="{{ route('client_discount.index') }}">Lists</a></li>
                    <li class="{{ request()->segment(1) == 'client_discount' && request()->segment(2) == 'create' ? 'active' : null }}"><a href="{{ route('client_discount.create') }}">Create</a></li>
                </ul>

            </li>

            <li class="sub-menu">
                <a href="javascript:;" class="{{ request()->segment(1) == 'customer_group' ? 'active' : null }}" >
                    <i class="fa fa-group"></i>
                    <span>Customer Group</span>
                </a>
                <ul class="sub">
                    <li class="{{ request()->segment(1) == 'customer_group' && request()->segment(2) == '' ? 'active' : null }}"><a href="{{ route('customer_group.index') }}">Lists</a></li>
                    <li class="{{ request()->segment(1) == 'customer_group' && request()->segment(2) == 'create' ? 'active' : null }}"><a href="{{ route('customer_group.create') }}">Create</a></li>
                </ul>

            </li>

            {{--<li class="sub-menu">--}}
            {{--<a href="{{ route('client_customer_group_pivot.index') }}" class="{{ request()->segment(1) == 'client_customer_group_pivot' ? 'active' : null }}" >--}}
            {{--<i class="fa fa-sitemap"></i>--}}
            {{--<span>Customer Group Pivot</span>--}}
            {{--</a>--}}
            {{--</li>--}}

            <li class="sub-menu">
                <a href="javascript:;" class="{{ request()->segment(1) == 'invoice' ? 'active' : null }}" >
                    <i class="fa fa-file-text"></i>
                    <span>Invoice</span>
                </a>
                <ul class="sub">
                    <li class="{{ request()->segment(6) == '' ? 'active' : null }}"><a href="{{ route('invoice.index') }}">Lists</a></li>
                    <li class="{{ request()->segment(6) == 'create' ? 'active' : null }}"><a href="{{ route('invoice.create') }}">Create</a></li>
                </ul>

            </li>
        @endif

    </ul>
    <!-- sidebar menu end-->
</div>
