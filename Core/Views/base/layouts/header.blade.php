@php
    $logo_details = getGeneralSettingsDetails();
    $placeholder_info = getPlaceHolderImage();
    $placeholder_image = '';
    $placeholder_image_alt = '';
    
    if ($placeholder_info != null) {
        $placeholder_image = $placeholder_info->placeholder_image;
        $placeholder_image_alt = $placeholder_info->placeholder_image_alt;
    }
@endphp
<header class="header white-bg fixed-top d-flex align-content-center flex-wrap">
    <!-- Logo -->
    @if ($mood == 'dark')
        <div class="logo pl-20 bg-transparent align-items-center d-flex">
            @if (sizeof($logo_details) > 0 && isset($logo_details['admin_dark_logo']))
                <a href="{{ route('admin.dashboard') }}" class="default-logo"><img
                        src="{{ project_asset($logo_details['admin_dark_logo']) }}" alt="logo"></a>
            @else
                <h3 class="default-logo">{{ $logo_details['system_name'] }}</h3>
            @endif

            @if (sizeof($logo_details) > 0 && isset($logo_details['admin_dark_mobile_logo']))
                <a href="/" class="mobile-logo"><img
                        src="{{ project_asset($logo_details['admin_dark_mobile_logo']) }}" alt="logo"></a>
            @else
                <h3 class="mobile-logo">{{ $logo_details['system_name'] }}</h3>
            @endif
        </div>
    @else
        <div class="logo pl-20 bg-white align-items-center d-flex">
            @if (sizeof($logo_details) > 0 && isset($logo_details['admin_logo']))
                <a href="{{ route('admin.dashboard') }}" class="default-logo"><img
                        src="{{ project_asset($logo_details['admin_logo']) }}" alt="logo"></a>
            @else
                <h3 class="default-logo">{{ $logo_details['system_name'] }}</h3>
            @endif

            @if (sizeof($logo_details) > 0 && isset($logo_details['admin_mobile_logo']))
                <a href="{{ route('admin.dashboard') }}" class="mobile-logo"><img
                        src="{{ project_asset($logo_details['admin_mobile_logo']) }}" alt="logo"></a>
            @else
                <h3 class="mobile-logo">{{ $logo_details['system_name'] }}</h3>
            @endif
        </div>
    @endif
    <!-- End Logo -->

    <!-- Main Header -->
    <div class="main-header">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <div class="col-3 col-lg-1 col-xl-4">
                    <!-- Header Left -->
                    <div class="main-header-left h-100 d-flex align-items-center">
                        <!-- Main Header User -->
                        @auth
                            <div class="main-header-user">
                                <a href="#" class="d-flex align-items-center" data-toggle="dropdown">
                                    <div class="menu-icon">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                    <div class="user-profile d-lg-flex align-items-center d-none">
                                        <!-- User Avatar -->
                                        <div class="user-avatar">
                                            @if (auth()->user()->image != null)
                                                <img src="{{ asset(getFilePath(auth()->user()->image)) }}"
                                                    alt="{{ auth()->user()->name }}">
                                            @else
                                                <img src="{{ asset('/public/backend/assets/img/avatar/user.png') }}"
                                                    alt="{{ auth()->user()->name }}">
                                            @endif
                                        </div>
                                        <!-- End User Avatar -->

                                        <!-- User Info -->
                                        <div class="user-info">
                                            <h4 class="user-name">{{ auth()->user()->name }}</h4>
                                            <p class="user-email">{{ auth()->user()->email }}</p>
                                        </div>
                                        <!-- End User Info -->
                                    </div>
                                </a>
                                <div class="dropdown-menu">
                                    <a href="{{ route('core.profile') }}">{{ translate('My Profile') }}</a>
                                    <a href="{{ route('core.logout') }}">{{ translate('Log Out') }}</a>
                                </div>
                            </div>
                        @endauth
                        <!-- End Main Header User -->
                        <!-- Main Header Menu -->
                        <div class="main-header-menu d-block d-lg-none">
                            <div class="header-toogle-menu">
                                <img src="{{ asset('/public/backend/assets/img/menu.png') }}" alt="">
                            </div>
                        </div>
                        <!-- End Main Header Menu -->
                    </div>
                    <!-- End Header Left -->
                </div>
                <div class="col-9 col-lg-11 col-xl-8">
                    <!-- Header Right -->
                    <div class="main-header-right d-flex justify-content-end">
                        <ul class="nav">
                            <li class="d-none d-lg-flex">
                                <!-- Main Header Time -->
                                <div class="main-header-date-time text-right" data-timezone="{{ getGeneralSetting('default_timezone') }}" id="dateTime">
                                    <h3 class="time">
                                        <span id="hours">21</span>
                                        <span id="point">:</span>
                                        <span id="min">06</span>
                                    </h3>
                                    <span class="date"><span id="date">Tue, 12 October
                                            2019</span></span>
                                </div>
                                <!-- End Main Header Time -->
                            </li>
                            <li class="d-none d-lg-flex">
                                <!-- Main Header Button -->
                                <div class="main-header-btn ml-md-1">
                                    <a href="{{ route('core.admin.clear.system.cache') }}"
                                        class="btn">{{ translate('Clear Cache') }}</a>
                                </div>
                                <!-- End Main Header Button -->
                            </li>
                            <li class="ml-3">
                                <!-- Visit website -->
                                <div class="main-header-notification">
                                    <a href="{{ url('/') }}" target="_blank" title="Visit website"
                                        class="header-icon notification-icon">
                                        <img src="{{ asset('/public/backend/assets/img/svg/globe-icon.svg') }}"
                                            alt="bell" class="svg">
                                    </a>
                                </div>
                                <!-- End Visit website -->
                            </li>
                            <li class="ml-3">
                                <!-- Main Header Language -->
                                <div class="main-header-notification">
                                    <a href="#" class="header-icon notification-icon" data-toggle="dropdown"
                                        title="Language Options">
                                        @if (isset($active_lang->code))
                                            <img src="{{ asset('/public/flags/') . '/' . $active_lang->code . '.png' }}"
                                                class="w-20" alt="{{ $active_lang->code }}">
                                        @endif
                                    </a>
                                    <div id="lang-change" class="dropdown-menu style--three">
                                        @foreach ($active_langs as $lang)
                                            <a href="#" class="dropdown-item" data-lan="{{ $lang->code }}">
                                                <img src="{{ asset('/public/flags/') . '/' . $lang->code . '.png' }}"
                                                    class="mr-2 w-20" alt="{{ $lang->code }}">
                                                {{ $lang->native_name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- End Main Header Language -->
                            </li>
                        </ul>
                    </div>
                    <!-- End Header Right -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Header -->
</header>
