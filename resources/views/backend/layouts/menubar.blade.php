<nav class="navbar navbar-light navbar-expand-lg topnav-menu">
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content"
    aria-controls="topnav-menu-content" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="topnav-menu-content">
    <ul class="navbar-nav">

      <!-- 1️⃣ Dashboard -->
      <li class="nav-item">
        <a class="nav-link dropdown-toggle arrow-none {{ request()->routeIs('dashboard') ? 'active' : '' }}"
          href="{{ route('dashboard') }}" id="topnav-dashboard" role="button">
          <i data-feather="home"></i>
          <span data-key="t-dashboard">@lang('translation.Dashboards')</span>
        </a>
      </li>

      <!-- 2️⃣ Orders -->
      <li class="nav-item">
        <a class="nav-link dropdown-toggle arrow-none {{ request()->routeIs('order.index') ? 'active' : '' }}"
          href="{{ route('order.index') }}" id="topnav-orders" role="button">
          <i data-feather="shopping-bag"></i>
          <span data-key="t-orders">@lang('translation.orders')</span>
        </a>
      </li>

      <!-- Optional: Customer Orders (Local Env) -->
      @if(Auth::user()->user_type < 3 && Auth::user()->designation_id != 12 && config('app.env') === 'local')
        <li class="nav-item">
          <a class="nav-link dropdown-toggle arrow-none {{ request()->routeIs('customer.orders') ? 'active' : '' }}"
            href="{{ route('customer.orders') }}" id="topnav-customer-orders" role="button">
            <i data-feather="clipboard"></i>
            <span data-key="t-customer_orders">@lang('translation.customer') @lang('translation.orders')</span>
          </a>
        </li>
      @endif

      <!-- 3️⃣ Sales -->
      @php $salesRoutes = ['sales.index','sales.stockloading','sales.unsoldstockreturn']; @endphp
      @if(Auth::user()->user_type < 3 && Auth::user()->designation_id != 12)
        <li class="nav-item dropdown {{ in_array(Route::currentRouteName(), $salesRoutes) ? 'active' : '' }}">
          <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-sales"
            role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i data-feather="dollar-sign"></i>
            <span data-key="t-sales">@lang('translation.sales')</span>
            <div class="arrow-down"></div>
          </a>
          <div class="dropdown-menu" aria-labelledby="topnav-sales">
            <a href="{{ route('sales.index') }}" class="dropdown-item" data-key="t-sales-listing">@lang('translation.sales') @lang('translation.listing')</a>
            <a href="{{ route('sales.stockloading') }}" class="dropdown-item" data-key="t-stock-loading">@lang('translation.stock_loading')</a>
            <a href="{{ route('sales.unsoldstockreturn') }}" class="dropdown-item" data-key="t-unsold-stock">@lang('translation.unsold_stock_return')</a>
          </div>
        </li>
      @endif

      <!-- 4️⃣ Stock -->
      @php $stockRoutes = ['stock.index','adjustmentstock.index']; @endphp
      @if(Auth::user()->user_type < 3 && Auth::user()->designation_id != 12)
        <li class="nav-item dropdown {{ in_array(Route::currentRouteName(), $stockRoutes) ? 'active' : '' }}">
          <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-stock"
            role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i data-feather="package"></i>
            <span data-key="t-stock">@lang('translation.stock')</span>
            <div class="arrow-down"></div>
          </a>
          <div class="dropdown-menu" aria-labelledby="topnav-stock">
            <a href="{{ route('stock.index') }}" class="dropdown-item" data-key="t-add-stock">@lang('translation.add_stock')</a>
            <a href="{{ route('adjustmentstock.index') }}" class="dropdown-item" data-key="t-adjust-stock">@lang('translation.add_adjustment_stock')</a>
          </div>
        </li>
      @endif

      <!-- 5️⃣ Customers -->
      <li class="nav-item">
        <a class="nav-link dropdown-toggle arrow-none {{ request()->routeIs('customer.index') ? 'active' : '' }}"
          href="{{ route('customer.index') }}" id="topnav-customers" role="button">
          <i data-feather="users"></i>
          <span data-key="t-customers">@lang('translation.customers')</span>
        </a>
      </li>

      <!-- 6️⃣ Management -->
      @php $managementRoutes = ['staff','menuitems','menu.category','bulk-offers.index']; @endphp
      @if(Auth::user()->user_type < 3 && Auth::user()->designation_id != 12)
        <li class="nav-item dropdown {{ in_array(Route::currentRouteName(), $managementRoutes) ? 'active' : '' }}">
          <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-management"
            role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i data-feather="settings"></i>
            <span data-key="t-management">@lang('translation.management')</span>
            <div class="arrow-down"></div>
          </a>
          <div class="dropdown-menu" aria-labelledby="topnav-management">
            <a href="{{ route('staff') }}" class="dropdown-item" data-key="t-staff">@lang('translation.staffmanagement')</a>
            <a href="{{ route('menuitems') }}" class="dropdown-item" data-key="t-products">@lang('translation.productmanagement')</a>
            <a href="{{ route('menu.category') }}" class="dropdown-item" data-key="t-categories">@lang('translation.categoriesmanagement')</a>
            <a href="{{ route('bulk-offers.index') }}" class="dropdown-item" data-key="t-bulk-offers">@lang('translation.bulk_offers')</a>
          </div>
        </li>
      @endif

      <!-- 7️⃣ Reports -->
      @php $reportRoutes = ['report.sales','inventory.index','report.productSalesReport','inventory.summary']; @endphp
      @if(Auth::user()->user_type < 3 && Auth::user()->designation_id != 12)
        <li class="nav-item dropdown {{ in_array(Route::currentRouteName(), $reportRoutes) ? 'active' : '' }}">
          <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-report"
            role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i data-feather="bar-chart-2"></i>
            <span data-key="t-report">@lang('translation.report')</span>
            <div class="arrow-down"></div>
          </a>
          <div class="dropdown-menu" aria-labelledby="topnav-report">
            <a href="{{ route('report.sales') }}" class="dropdown-item" data-key="t-daily-sales">@lang('translation.dailysales')</a>
            <a href="{{ route('inventory.summary') }}" class="dropdown-item" data-key="t-transaction-summary">@lang('translation.transaction')</a>
            <a href="{{ route('inventory.index') }}" class="dropdown-item" data-key="t-daily-stock">@lang('translation.daily_stock_report')</a>
            <a href="{{ route('report.productSalesReport') }}" class="dropdown-item" data-key="t-product-sales">@lang('translation.product_sales_report')</a>
          </div>
        </li>
      @endif

    </ul>
  </div>
</nav>
