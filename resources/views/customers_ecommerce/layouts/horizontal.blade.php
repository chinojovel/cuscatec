<header id="page-topbar" class="ishorizontal-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ url('/') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="22"> <span class="logo-txt">@lang('translation.Ecommerce')</span>
                    </span>
                </a>

                <a href="{{ url('/') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ URL::asset('assets/images/logo-sm.svg') }}" alt="" height="22"> <span class="logo-txt">@lang('translation.Ecommerce')</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <div class="topnav">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link dropdown-toggle arrow-none" href="/index" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class='bx bx-tachometer'></i>
                                    <span data-key="t-dashboards">@lang('translation.Dashboard')</span>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button">
                                    <i class='bx bx-grid-alt'></i>
                                    <span data-key="t-apps">@lang('translation.Apps')</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-pages">

                                    <a href="apps-calendar" class="dropdown-item" data-key="t-calendar">@lang('translation.Calendar')</a>
                                    <a href="apps-chat" class="dropdown-item" data-key="t-chat">@lang('translation.Chat')</a>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email" role="button">
                                            <span data-key="t-email">@lang('translation.Email')</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-email">
                                            <a href="email-inbox" class="dropdown-item" data-key="t-inbox">@lang('translation.Inbox')</a>
                                            <a href="email-read" class="dropdown-item" data-key="t-read-email">@lang('translation.Read_Email')</a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ecommerce" role="button">@lang('translation.Ecommerce') <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-ecommerce">
                                            <a href="ecommerce-products" class="dropdown-item" data-key="t-products">@lang('translation.Products')</a>
                                            <a href="ecommerce-product-detail" class="dropdown-item" data-key="t-product-detail">@lang('translation.Product_Detail')</a>
                                            <a href="ecommerce-orders" class="dropdown-item" data-key="t-orders">@lang('translation.Orders')</a>
                                            <a href="ecommerce-customers" class="dropdown-item" data-key="t-customers">@lang('translation.Customers')</a>
                                            <a href="ecommerce-cart" class="dropdown-item" data-key="t-cart">@lang('translation.Cart')</a>
                                            <a href="ecommerce-checkout" class="dropdown-item" data-key="t-checkout">@lang('translation.Checkout')</a>
                                            <a href="ecommerce-shops" class="dropdown-item" data-key="t-shops">@lang('translation.Shops')</a>
                                            <a href="ecommerce-add-product" class="dropdown-item" data-key="t-add-product">@lang('translation.Add_Product')</a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-invoice" role="button"><span data-key="t-invoices">@lang('translation.Invoices')</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-invoice">
                                            <a href="invoices-list" class="dropdown-item" data-key="t-invoice-list">@lang('translation.Invoice_List')</a>
                                            <a href="invoices-detail" class="dropdown-item" data-key="t-invoice-detail">@lang('translation.Invoice_Detail')</a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-contact" role="button">
                                            <span data-key="t-contacts">@lang('translation.Contacts')</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-contact">
                                            <a href="contacts-grid" class="dropdown-item" data-key="t-user-grid">@lang('translation.User_Grid')</a>
                                            <a href="contacts-list" class="dropdown-item" data-key="t-user-list">@lang('translation.User_List')</a>
                                            <a href="contacts-profile" class="dropdown-item" data-key="t-user-settings">@lang('translation.User_Profile')</a>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class='bx bxl-bootstrap'></i>
                                    <span data-key="t-bootstrap">@lang('translation.Bootstrap')</span>
                                    <div class="arrow-down"></div>
                                </a>

                                <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl" aria-labelledby="topnav-uielement">
                                    <div class="ps-2 p-lg-0">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div>
                                                    <div class="menu-title">Elements</div>
                                                    <div class="row g-0">
                                                        <div class="col-lg-4">
                                                            <div>
                                                                <a href="ui-alerts" class="dropdown-item" data-key="t-alerts">@lang('translation.Alerts')</a>
                                                                <a href="ui-buttons" class="dropdown-item" data-key="t-buttons">@lang('translation.Buttons')</a>
                                                                <a href="ui-cards" class="dropdown-item" data-key="t-cards">@lang('translation.Cards')</a>
                                                                <a href="ui-carousel" class="dropdown-item" data-key="t-carousel">@lang('translation.Carousel')</a>
                                                                <a href="ui-dropdowns" class="dropdown-item" data-key="t-dropdowns">@lang('translation.Dropdowns')</a>
                                                                <a href="ui-grid" class="dropdown-item" data-key="t-grid">@lang('translation.Grid')</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div>
                                                                <a href="ui-images" class="dropdown-item" data-key="t-images">@lang('translation.Images')</a>
                                                                <a href="ui-modals" class="dropdown-item" data-key="t-modals">@lang('translation.Modals')</a>
                                                                <a href="ui-offcanvas" class="dropdown-item" data-key="t-offcanvas">@lang('translation.Offcanvas')</a>
                                                                <a href="ui-placeholders" class="dropdown-item" data-key="t-placeholders">@lang('translation.Placeholders')</a>
                                                                <a href="ui-progressbars" class="dropdown-item" data-key="t-progress-bars">@lang('translation.Progress_Bars') </a>
                                                                <a href="ui-tabs-accordions" class="dropdown-item" data-key="t-tabs-accordions">@lang('translation.Tabs_&_Accordions')</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <a href="ui-typography" class="dropdown-item" data-key="t-typography">@lang('translation.Typography')</a>
                                                            <a href="ui-video" class="dropdown-item" data-key="t-video">@lang('translation.Video')</a>
                                                            <a href="ui-general" class="dropdown-item" data-key="t-general">@lang('translation.General')</a>
                                                            <a href="ui-colors" class="dropdown-item" data-key="t-colors">@lang('translation.Colors')</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button">
                                    <i class='bx bx-layer'></i>
                                    <span data-key="t-components">@lang('translation.Components')</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-components">
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-extended" role="button">
                                            <span data-key="t-extendeds">@lang('translation.Extended')</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-form">
                                            <a href="extended-lightbox" class="dropdown-item" data-key="t-lightbox">@lang('translation.Lightbox')</a>
                                            <a href="extended-rangeslider" class="dropdown-item" data-key="t-range-slider">@lang('translation.Range_Slider') </a>
                                            <a href="extended-sweet-alert" class="dropdown-item" data-key="t-sweet-alert">@lang('translation.SweetAlert_2') </a>
                                            <a href="extended-rating" class="dropdown-item" data-key="t-rating">@lang('translation.Rating')</a>
                                            <a href="extended-notifications" class="dropdown-item" data-key="t-notifications">@lang('translation.Notifications')</a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form" role="button">
                                            <span data-key="t-forms">@lang('translation.Forms')</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-form">
                                            <a href="form-elements" class="dropdown-item" data-key="t-basic-elements">@lang('translation.Basic_Elements')</a>
                                            <a href="form-validation" class="dropdown-item" data-key="t-validation">@lang('translation.Validation')</a>
                                            <a href="form-advanced" class="dropdown-item" data-key="t-advanced-plugins">@lang('translation.Advanced_Plugins')</a>
                                            <a href="form-editors" class="dropdown-item" data-key="t-editors">@lang('translation.Editors')</a>
                                            <a href="form-uploads" class="dropdown-item" data-key="t-file-upload">@lang('translation.File_Upload')</a>
                                            <a href="form-wizard" class="dropdown-item" data-key="t-wizard">@lang('translation.Wizard')</a>
                                            <a href="form-mask" class="dropdown-item" data-key="t-mask">@lang('translation.Mask')</a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-table" role="button">
                                            <span data-key="t-tables">@lang('translation.Tables')</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-table">
                                            <a href="tables-basic" class="dropdown-item" data-key="t-bootstrap-basic">@lang('translation.Bootstrap_Basic')</a>
                                            <a href="tables-advanced" class="dropdown-item" data-key="t-advanced-tables">@lang('translation.Advance_Tables')</a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts" role="button">
                                            <span data-key="t-charts">@lang('translation.Charts')</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                            <a href="charts-apex" class="dropdown-item" data-key="t-apex-charts">@lang('translation.Apex_Charts') </a>
                                            <a href="charts-chartjs" class="dropdown-item" data-key="t-chartjs-charts">@lang('translation.Chartjs')</a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-icons" role="button">
                                            <span data-key="t-icons">@lang('translation.Icons')</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-icons">
                                            <a href="icons-feather" class="dropdown-item" data-key="t-feather">@lang('translation.Feather')</a>
                                            <a href="icons-boxicons" class="dropdown-item" data-key="t-boxicons">@lang('translation.Boxicons')</a>
                                            <a href="icons-materialdesign" class="dropdown-item" data-key="t-material-design">@lang('translation.Material_Design') </a>
                                            <a href="icons-dripicons" class="dropdown-item" data-key="t-dripicons">@lang('translation.Dripicons')</a>
                                            <a href="icons-fontawesome" class="dropdown-item" data-key="t-font-awesome">@lang('translation.Font_Awesome_5') </a>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-map" role="button">
                                            <span data-key="t-maps">@lang('translation.Maps')</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-map">
                                            <a href="maps-google" class="dropdown-item" data-key="t-google">@lang('translation.Google')</a>
                                            <a href="maps-vector" class="dropdown-item" data-key="t-vector">@lang('translation.Vector')</a>
                                            <a href="maps-leaflet" class="dropdown-item" data-key="t-leaflet">@lang('translation.Leaflet')</a>
                                        </div>
                                    </div>
                                </div>

                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button">
                                    <i class='bx bx-file'></i>
                                    <span data-key="t-pages">@lang('translation.Pages')</span>
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-more">
                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth" role="button">
                                            <span data-key="t-authentication">@lang('translation.Authentication')</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                            <a href="auth-login" class="dropdown-item" data-key="t-login">@lang('translation.Login')</a>
                                            <a href="auth-register" class="dropdown-item" data-key="t-register">@lang('translation.Register')</a>
                                            <a href="auth-recoverpw" class="dropdown-item" data-key="t-recover-password">@lang('translation.Recover_Password')</a>
                                            <a href="auth-lock-screen" class="dropdown-item" data-key="t-lock-screen">@lang('translation.Lock_Screen') </a>
                                            <a href="auth-logout" class="dropdown-item" data-key="t-logout">@lang('translation.Log_Out') </a>
                                            <a href="auth-confirm-mail" class="dropdown-item" data-key="t-confirm-mail">@lang('translation.Confirm_Mail') </a>
                                            <a href="auth-email-verification" class="dropdown-item" data-key="t-email-verification">@lang('translation.Email_Verification') </a>
                                            <a href="auth-two-step-verification" class="dropdown-item" data-key="t-two-step-verification">@lang('translation.Two_Step_Verification') </a>
                                        </div>
                                    </div>

                                    <div class="dropdown">
                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-utility" role="button">
                                            <span data-key="t-utility">@lang('translation.Utility')</span>
                                            <div class="arrow-down"></div>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="topnav-utility">
                                            <a href="pages-starter" class="dropdown-item" data-key="t-starter-page">@lang('translation.Starter_Page')</a>
                                            <a href="pages-maintenance" class="dropdown-item" data-key="t-maintenance">@lang('translation.Maintenance')</a>
                                            <a href="pages-comingsoon" class="dropdown-item" data-key="t-coming-soon">@lang('translation.Coming_Soon')</a>
                                            <a href="pages-timeline" class="dropdown-item" data-key="t-timeline">@lang('translation.Timeline')</a>
                                            <a href="pages-faqs" class="dropdown-item" data-key="t-faqs">@lang('translation.FAQs')</a>
                                            <a href="pages-pricing" class="dropdown-item" data-key="t-pricing">@lang('translation.Pricing')</a>
                                            <a href="pages-404" class="dropdown-item" data-key="t-error-404">@lang('translation.Error_404')</a>
                                            <a href="pages-500" class="dropdown-item" data-key="t-error-500">@lang('translation.Error_500')</a>
                                        </div>
                                    </div>

                                    <a href="layouts-vertical" class="dropdown-item" data-key="t-vertical">@lang('translation.Vertical')</a>
                                </div>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="icon-sm" data-feather="search"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0">
                    <form class="p-3">
                        <div class="search-box">
                            <div class="position-relative">
                                <input type="text" class="form-control rounded" placeholder="Search here...">
                                <i class="mdi mdi-magnify search-icon"></i>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- <div class="dropdown d-inline-block language-switch">
                <button type="button" class="btn header-item"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="header-lang-img" src="{{ URL::asset('assets/images/flags/us.jpg') }}" alt="Header Language" height="16">
            </button>
            <div class="dropdown-menu dropdown-menu-end">

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="eng">
                    <img src="{{ URL::asset('assets/images/flags/us.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                </a>
                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp">
                    <img src="{{ URL::asset('assets/images/flags/spain.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr">
                    <img src="{{ URL::asset('assets/images/flags/germany.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it">
                    <img src="{{ URL::asset('assets/images/flags/italy.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                </a>

                <!-- item-->
                <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru">
                    <img src="{{ URL::asset('assets/images/flags/russia.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                </a>
            </div>
        </div> --}}

        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @switch(Session::get('lang'))
                @case('ru')
                <img src="{{ URL::asset('/assets/images/flags/russia.jpg') }}" alt="Header Language" height="16"> <span class="align-middle"></span>
                @break
                @case('it')
                <img src="{{ URL::asset('/assets/images/flags/italy.jpg') }}" alt="Header Language" height="16"> <span class="align-middle"></span>
                @break
                @case('de')
                <img src="{{ URL::asset('/assets/images/flags/germany.jpg') }}" alt="Header Language" height="16"> <span class="align-middle"></span>
                @break
                @case('es')
                <img src="{{ URL::asset('/assets/images/flags/spain.jpg') }}" alt="Header Language" height="16"> <span class="align-middle"></span>
                @break
                @default
                <img src="{{ URL::asset('/assets/images/flags/us.jpg') }}" alt="Header Language" height="16">
                <span class="align-middle"></span>
                @endswitch
            </button>
            <div class="dropdown-menu dropdown-menu-end">

                <!-- item-->
                <a href="{{ url('index/en') }}" class="dropdown-item notify-item language" data-lang="eng">
                    <img src="{{ URL::asset('/assets/images/flags/us.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">English</span>
                </a>
                <!-- item-->
                <a href="{{ url('index/es') }}" class="dropdown-item notify-item language" data-lang="sp">
                    <img src="{{ URL::asset('/assets/images/flags/spain.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                </a>

                <!-- item-->
                <a href="{{ url('index/de') }}" class="dropdown-item notify-item language" data-lang="gr">
                    <img src="{{ URL::asset('/assets/images/flags/germany.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                </a>

                <!-- item-->
                <a href="{{ url('index/it') }}" class="dropdown-item notify-item language" data-lang="it">
                    <img src="{{ URL::asset('/assets/images/flags/italy.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                </a>

                <!-- item-->
                <a href="{{ url('index/ru') }}" class="dropdown-item notify-item language" data-lang="ru">
                    <img src="{{ URL::asset('/assets/images/flags/russia.jpg') }}" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                </a>
            </div>
        </div>

        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item noti-icon" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon-sm" data-feather="bell"></i>
                <span class="noti-dot bg-danger rounded-pill">3</span>
            </button>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                <div class="p-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="m-0 font-size-15"> Notifications </h5>
                        </div>
                        <div class="col-auto">
                            <a href="javascript:void(0);" class="small"> Mark all as read</a>
                        </div>
                    </div>
                </div>
                <div data-simplebar style="max-height: 250px;">
                    <a href="" class="text-reset notification-item">
                        <div class="d-flex border-bottom align-items-start bg-light">
                            <div class="flex-shrink-0">
                                <img src="{{ URL::asset('assets/images/users/avatar-3.jpg') }}" class="me-3 rounded-circle avatar-sm" alt="user-pic">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Justin Verduzco</h6>
                                <div class="text-muted">
                                    <p class="mb-1 font-size-13">Your task changed an issue from "In Progress" to
                                        <span class="badge text-success  bg-success-subtle">Review</span></p>
                                    <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i> 1 hour ago</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="" class="text-reset notification-item">
                        <div class="d-flex border-bottom align-items-start">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm me-3">
                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                        <i class="bx bx-shopping-bag"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">New order has been placed</h6>
                                <div class="text-muted">
                                    <p class="mb-1 font-size-13">Open the order confirmation or shipment
                                        confirmation.</p>
                                    <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i> 5 hours ago</p>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="" class="text-reset notification-item">
                        <div class="d-flex border-bottom align-items-start">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm me-3">
                                    <span class="avatar-title bg-success-subtle text-success rounded-circle font-size-16">
                                        <i class="bx bx-cart"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Your item is shipped</h6>
                                <div class="text-muted">
                                    <p class="mb-1 font-size-13">Here is somthing that you might light like to
                                        know.</p>
                                    <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i> 1 day ago</p>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="" class="text-reset notification-item">
                        <div class="d-flex border-bottom align-items-start">
                            <div class="flex-shrink-0">
                                <img src="{{ URL::asset('assets/images/users/avatar-4.jpg') }}" class="me-3 rounded-circle avatar-sm" alt="user-pic">
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Salena Layfield</h6>
                                <div class="text-muted">
                                    <p class="mb-1 font-size-13">Yay ! Everything worked!</p>
                                    <p class="mb-0 font-size-10 text-uppercase fw-bold"><i class="mdi mdi-clock-outline"></i> 3 days ago</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="p-2 border-top d-grid">
                    <a class="btn btn-sm btn-link font-size-14 btn-block text-decoration-underline fw-bold text-center" href="javascript:void(0)">
                        <span>View All <i class='bx bx-right-arrow-alt'></i></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="dropdown d-none d-sm-inline-block">
            <button type="button" class="btn header-item light-dark" id="mode-setting-btn">
                <i data-feather="moon" class="icon-sm layout-mode-dark "></i>
                <i data-feather="sun" class="icon-sm layout-mode-light"></i>
            </button>
        </div>

        <div class="dropdown d-inline-block">
            <button type="button" class="btn header-item user text-start d-flex align-items-center" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="rounded-circle header-profile-user" src="{{ (isset(Auth::user()->avatar) && Auth::user()->avatar != '')  ? asset(Auth::user()->avatar) : asset('/assets/images/users/avatar-1.jpg') }}" alt="Header Avatar">
                <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ucfirst(Auth::user()->name)}}</span>
            </button>
            <div class="dropdown-menu dropdown-menu-end pt-0">
                <a class="dropdown-item" href="contacts-profile"><i class='bx bx-user-circle text-muted font-size-18 align-middle me-1'></i> <span class="align-middle">My Account</span></a>
                <a class="dropdown-item" href="apps-chat"><i class='bx bx-chat text-muted font-size-18 align-middle me-1'></i> <span class="align-middle">Chat</span></a>
                <a class="dropdown-item" href="pages-faqs"><i class='bx bx-buoy text-muted font-size-18 align-middle me-1'></i> <span class="align-middle">Support</span></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item d-flex align-items-center" href="#"><i class='bx bx-cog text-muted font-size-18 align-middle me-1'></i> <span class="align-middle me-3">Settings</span><span class="badge badge-soft-success ms-auto">New</span></a>
                <a class="dropdown-item" href="auth-lock-screen"><i class='bx bx-lock text-muted font-size-18 align-middle me-1'></i> <span class="align-middle">Lock screen</span></a>
                <a class="dropdown-item text-danger" href="javascript:void();" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span key="t-logout">@lang('translation.Logout')</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
            </div>
        </div>
    </div>
    </div>
</header>
