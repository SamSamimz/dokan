<nav class="navbar col-lg-12 col-12 p-lg-0 fixed-top d-flex flex-row">
    <div class="navbar-menu-wrapper d-flex align-items-stretch justify-content-between">
      <a class="navbar-brand brand-logo-mini align-self-center d-lg-none" href="index.html"><img src="assets/images/logo-mini.svg" alt="logo" /></a>
      <button class="navbar-toggler navbar-toggler align-self-center mr-2" type="button" data-toggle="minimize">
        <i class="mdi mdi-menu"></i>
      </button>
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
            <i class="mdi mdi-bell-outline"></i>
            <span class="count count-varient1">7</span>
          </a>
          <div class="dropdown-menu navbar-dropdown navbar-dropdown-large preview-list" aria-labelledby="notificationDropdown">
            <h6 class="p-3 mb-0">Notifications</h6>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <img src="assets/images/faces/face4.jpg" alt="" class="profile-pic" />
              </div>
              <div class="preview-item-content">
                <p class="mb-0"> Dany Miles <span class="text-small text-muted">commented on your photo</span>
                </p>
              </div>
            </a>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <img src="assets/images/faces/face3.jpg" alt="" class="profile-pic" />
              </div>
              <div class="preview-item-content">
                <p class="mb-0"> James <span class="text-small text-muted">posted a photo on your wall</span>
                </p>
              </div>
            </a>
            <a class="dropdown-item preview-item">
              <div class="preview-thumbnail">
                <img src="assets/images/faces/face2.jpg" alt="" class="profile-pic" />
              </div>
              <div class="preview-item-content">
                <p class="mb-0"> Alex <span class="text-small text-muted">just mentioned you in his post</span>
                </p>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <p class="p-3 mb-0">View all activities</p>
          </div>
        </li>
        <li class="nav-item dropdown d-none d-sm-flex">
          <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown">
            <i class="mdi mdi-email-outline"></i>
            <span class="count count-varient2">5</span>
          </a>
          <div class="dropdown-menu navbar-dropdown navbar-dropdown-large preview-list" aria-labelledby="messageDropdown">
            <h6 class="p-3 mb-0">Messages</h6>
            <a class="dropdown-item preview-item">
              <div class="preview-item-content flex-grow">
                <span class="badge badge-pill badge-success">Request</span>
                <p class="text-small text-muted ellipsis mb-0"> Suport needed for user123 </p>
              </div>
              <p class="text-small text-muted align-self-start"> 4:10 PM </p>
            </a>
            <a class="dropdown-item preview-item">
              <div class="preview-item-content flex-grow">
                <span class="badge badge-pill badge-warning">Invoices</span>
                <p class="text-small text-muted ellipsis mb-0"> Invoice for order is mailed </p>
              </div>
              <p class="text-small text-muted align-self-start"> 4:10 PM </p>
            </a>
            <a class="dropdown-item preview-item">
              <div class="preview-item-content flex-grow">
                <span class="badge badge-pill badge-danger">Projects</span>
                <p class="text-small text-muted ellipsis mb-0"> New project will start tomorrow </p>
              </div>
              <p class="text-small text-muted align-self-start"> 4:10 PM </p>
            </a>
            <h6 class="p-3 mb-0">See all activity</h6>
          </div>
        </li>
      </ul>
      <ul class="navbar-nav navbar-nav-right ml-lg-auto">
        <button class="btn nav-item d-xl-flex border-0">
          @if (app()->getLocale() == 'en')
          <a wire:click='changeLang("bng")' class="nav-link">Bangla <img width="20" class="rounded" src="{{ asset('assets/vendors/flag-icon-css/flags/1x1/bd.svg') }}" alt=""></a>
          @else
          <a wire:click='changeLang("en")' class="nav-link">English <img width="20" class="rounded" src="{{ asset('assets/vendors/flag-icon-css/flags/1x1/us.svg') }}" alt=""></a>
          @endif
        </button>
        <li class="nav-item nav-profile dropdown border-0">
          <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown">
            <img class="nav-profile-img mr-2" alt="" src="assets/images/faces/face1.jpg" />
            <span class="profile-name">Henry Klein</span>
          </a>
          <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="#">
              <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a>
            <button class="dropdown-item" wire:click='logout()'>
              <i class="mdi mdi-logout mr-2 text-primary"></i>{{ __('message.logout') }} </button>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
    @push('scripts')
    <script>
      document.addEventListener('livewire:init', () => {
        Livewire.on('reload-page', (event) => {
            window.location.reload();
        });
    });
    </script>
    @endpush
  </nav>