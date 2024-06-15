<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="text-center sidebar-brand-wrapper d-flex align-items-center">
      <a class="sidebar-brand brand-logo" href="{{ route('home') }}" wire:navigate><h2>Dokan</h2></a>
      <a class="sidebar-brand brand-logo-mini pl-4 pt-3" href="{{ route('home') }}" wire:navigate><h2>D</h2></a>
    </div>
    <ul class="nav mt-3">
      <li class="nav-item">
        <a class="nav-link" href="/" wire:navigate>
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">{{ __('sidebar.dashboard') }}</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#inventory-section" aria-expanded="false" aria-controls="inventory-section">
          <i class="mdi mdi-crosshairs-gps menu-icon"></i>
          <span class="menu-title">{{ __('sidebar.inventory section') }} :</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="inventory-section">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item">
              <a class="nav-link" href="{{route('category.index')}}" wire:navigate>{{ __('sidebar.category') }}</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{route('products.index')}}" wire:navigate>{{ __('sidebar.product') }}</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('customers.index') }}" wire:navigate>
          <i class="mdi mdi-crosshairs-gps menu-icon"></i>
          <span class="menu-title">{{ __('sidebar.customer') }}</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('sales.index') }}" wire:navigate>
          <i class="mdi mdi-crosshairs-gps menu-icon"></i>
          <span class="menu-title">{{ __('sidebar.sales') }}</span>
        </a>
      </li>
      <li class="nav-item sidebar-actions">
        <div class="nav-link">
            <ul class="mt-4 pl-0">
              <button class="btn btn-google col-12" wire:click='logout()'>{{ __('message.logout') }}</button>
            </ul>
        </div>
      </li>
    </ul>
  </nav>