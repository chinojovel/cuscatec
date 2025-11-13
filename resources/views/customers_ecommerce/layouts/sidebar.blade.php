<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    {{-- <body data-layout="horizontal" data-sidebar="dark"> --}}
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="{{ route('customer.ecommerce.categories') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo.jpg') }}" alt="" height="30">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo.jpg') }}" alt="" height="30"> <span
                    class="logo-txt">@lang('translation.Ecommerce')</span>
            </span>
        </a>

        <a href="{{ route('customer.ecommerce.categories') }}" class="logo logo-light">
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo.jpg') }}" alt="" height="30"> <span
                    class="logo-txt">@lang('translation.Ecommerce')</span>
            </span>
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo.jpg') }}" alt="" height="30">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->

            <ul class="metismenu list-unstyled" id="side-menu">
                <li>
                    <a href="{{ route('customer.ecommerce.categories') }}">
                        <i class="bx bxs-store icon nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboards">Categories</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('customer.ecommerce.orders.index') }}">
                        <i class="bx bxs-store icon nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboards">Orders</span>
                    </a>
                </li>

            
                
                {{-- <li class="menu-title" data-key="t-applications">@lang('translation.Applications')</li>

                <li>
                    <a href="apps-calendar">
                        <i class="bx bx-calendar icon nav-icon"></i>
                        <span class="menu-item" data-key="t-calendar">@lang('translation.Calendar')</span>
                    </a>
                </li>

                <li>
                    <a href="apps-chat">
                        <i class="bx bx-chat icon nav-icon"></i>
                        <span class="menu-item" data-key="t-chat">@lang('translation.Chat')</span>
                        <span class="badge rounded-pill bg-danger" data-key="t-hot">@lang('translation.Hot')</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-envelope icon nav-icon"></i>
                        <span class="menu-item" data-key="t-email">@lang('translation.Email')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="email-inbox" data-key="t-inbox">@lang('translation.Inbox')</a></li>
                        <li><a href="email-read" data-key="t-read-email">@lang('translation.Read_Email')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-store icon nav-icon"></i>
                        <span class="menu-item" data-key="t-ecommerce">@lang('translation.Ecommerce')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ecommerce-products" data-key="t-products">@lang('translation.Products')</a></li>
                        <li><a href="ecommerce-product-detail" data-key="t-product-detail">@lang('translation.Product_Detail')</a></li>
                        <li><a href="ecommerce-orders" data-key="t-orders">@lang('translation.Orders')</a></li>
                        <li><a href="ecommerce-customers" data-key="t-customers">@lang('translation.Customers')</a></li>
                        <li><a href="ecommerce-cart" data-key="t-cart">@lang('translation.Cart')</a></li>
                        <li><a href="ecommerce-checkout" data-key="t-checkout">@lang('translation.Checkout')</a></li>
                        <li><a href="ecommerce-shops" data-key="t-shops">@lang('translation.Shops')</a></li>
                        <li><a href="ecommerce-add-product" data-key="t-add-product">@lang('translation.Add_Product')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-receipt icon nav-icon"></i>
                        <span class="menu-item" data-key="t-invoices">@lang('translation.Invoices')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="invoices-list" data-key="t-invoice-list">@lang('translation.Invoice_List')</a></li>
                        <li><a href="invoices-detail" data-key="t-invoice-detail">@lang('translation.Invoice_Detail')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bxs-user-detail icon nav-icon"></i>
                        <span class="menu-item" data-key="t-contacts">@lang('translation.Contacts')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="contacts-grid" data-key="t-user-grid">@lang('translation.User_Grid') </a></li>
                        <li><a href="contacts-list" data-key="t-user-list">@lang('translation.User_List')</a></li>
                        <li><a href="contacts-profile" data-key="t-user-settings">@lang('translation.Profile')</a></li>
                    </ul>
                </li>

                <li class="menu-title" data-key="t-pages">@lang('translation.Pages')</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-user-circle icon nav-icon"></i>
                        <span class="menu-item" data-key="t-authentication">@lang('translation.Authentication')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="auth-login" data-key="t-login">@lang('translation.Login')</a></li>
                        <li><a href="auth-register" data-key="t-register">@lang('translation.Register')</a></li>
                        <li><a href="auth-recoverpw" data-key="t-recover-password">@lang('translation.Recover_Password')</a></li>
                        <li><a href="auth-lock-screen" data-key="t-lock-screen">@lang('translation.Lock_Screen')</a></li>
                        <li><a href="auth-logout" data-key="t-logout">@lang('translation.Log_Out')</a></li>
                        <li><a href="auth-confirm-mail" data-key="t-confirm-mail">@lang('translation.Confirm_Mail')</a></li>
                        <li><a href="auth-email-verification" data-key="t-email-verification">@lang('translation.Email_Verification')</a></li>
                        <li><a href="auth-two-step-verification" data-key="t-two-step-verification">@lang('translation.Two_Step_Verification')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-file icon nav-icon"></i>
                        <span class="menu-item" data-key="t-utility">@lang('translation.Utility')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-starter" data-key="t-starter-page">@lang('translation.Starter_Page')</a></li>
                        <li><a href="pages-maintenance" data-key="t-maintenance">@lang('translation.Maintenance')</a></li>
                        <li><a href="pages-comingsoon" data-key="t-coming-soon">@lang('translation.Coming_Soon')</a></li>
                        <li><a href="pages-timeline" data-key="t-timeline">@lang('translation.Timeline')</a></li>
                        <li><a href="pages-faqs" data-key="t-faqs">@lang('translation.FAQs')</a></li>
                        <li><a href="pages-pricing" data-key="t-pricing">@lang('translation.Pricing')</a></li>
                        <li><a href="pages-404" data-key="t-error-404">@lang('translation.Error_404')</a></li>
                        <li><a href="pages-500" data-key="t-error-500">@lang('translation.Error_500')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="layouts-vertical">
                        <i class="bx bx-layout icon nav-icon"></i>
                        <span class="menu-item" data-key="t-vertical">@lang('translation.Vertical')</span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-components">@lang('translation.Components')</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bxl-bootstrap icon nav-icon"></i>
                        <span class="menu-item" data-key="t-bootstrap">@lang('translation.Bootstrap')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ui-alerts" data-key="t-alerts">@lang('translation.Alerts')</a></li>
                        <li><a href="ui-buttons" data-key="t-buttons">@lang('translation.Buttons')</a></li>
                        <li><a href="ui-cards" data-key="t-cards">@lang('translation.Cards')</a></li>
                        <li><a href="ui-carousel" data-key="t-carousel">@lang('translation.Carousel')</a></li>
                        <li><a href="ui-dropdowns" data-key="t-dropdowns">@lang('translation.Dropdowns')</a></li>
                        <li><a href="ui-grid" data-key="t-grid">@lang('translation.Grid')</a></li>
                        <li><a href="ui-images" data-key="t-images">@lang('translation.Images')</a></li>
                        <li><a href="ui-modals" data-key="t-modals">@lang('translation.Modals')</a></li>
                        <li><a href="ui-offcanvas" data-key="t-offcanvas">@lang('translation.Offcanvas')</a></li>
                        <li><a href="ui-placeholders" data-key="t-placeholders">@lang('translation.Placeholders')</a></li>
                        <li><a href="ui-progressbars" data-key="t-progress-bars">@lang('translation.Progress_Bars')</a></li>
                        <li><a href="ui-tabs-accordions" data-key="t-tabs-accordions">@lang('translation.Tabs_&_Accordions')</a></li>
                        <li><a href="ui-typography" data-key="t-typography">@lang('translation.Typography')</a></li>
                        <li><a href="ui-video" data-key="t-video">@lang('translation.Video')</a></li>
                        <li><a href="ui-general" data-key="t-general">@lang('translation.General')</a></li>
                        <li><a href="ui-colors" data-key="t-colors">@lang('translation.Colors')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-disc icon nav-icon"></i>
                        <span class="menu-item" data-key="t-extended">@lang('translation.Extended')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="extended-lightbox" data-key="t-lightbox">@lang('translation.Lightbox')</a></li>
                        <li><a href="extended-rangeslider" data-key="t-range-slider">@lang('translation.Range_Slider')</a></li>
                        <li><a href="extended-sweet-alert" data-key="t-sweet-alert">@lang('translation.SweetAlert_2')</a></li>
                        <li><a href="extended-rating" data-key="t-rating">@lang('translation.Rating')</a></li>
                        <li><a href="extended-notifications" data-key="t-notifications">@lang('translation.Notifications')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bxs-eraser icon nav-icon"></i>
                        <span class="menu-item" data-key="t-forms">@lang('translation.Forms')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="form-elements" data-key="t-basic-elements">@lang('translation.Basic_Elements')</a></li>
                        <li><a href="form-validation"data-key="t-validation">@lang('translation.Validation')</a></li>
                        <li><a href="form-advanced"data-key="t-advanced-plugins">@lang('translation.Advanced_Plugins')</a></li>
                        <li><a href="form-editors"data-key="t-editors">@lang('translation.Editors')</a></li>
                        <li><a href="form-uploads"data-key="t-file-upload">@lang('translation.File_Upload')</a></li>
                        <li><a href="form-wizard"data-key="t-wizard">@lang('translation.Wizard')</a></li>
                        <li><a href="form-mask" data-key="t-mask">@lang('translation.Mask')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-list-ul icon nav-icon"></i>
                        <span class="menu-item" data-key="t-tables">@lang('translation.Tables')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="tables-basic" data-key="t-bootstrap-basic">@lang('translation.Bootstrap_Basic')</a></li>
                        <li><a href="tables-advanced" data-key="t-advanced-tables">@lang('translation.Advance_Tables')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bxs-bar-chart-alt-2 icon nav-icon"></i>
                        <span class="menu-item" data-key="t-charts">@lang('translation.Charts')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="charts-apex" data-key="t-apex-charts">@lang('translation.Apex')</a></li>
                        <li><a href="charts-chartjs" data-key="t-chartjs-charts">@lang('translation.Chartjs')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-aperture icon nav-icon"></i>
                        <span class="menu-item" data-key="t-icons">@lang('translation.Icons')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="icons-feather" data-key="t-feather">@lang('translation.Feather')</a></li>
                        <li><a href="icons-boxicons" data-key="t-boxicons">@lang('translation.Boxicons')</a></li>
                        <li><a href="icons-materialdesign" data-key="t-material-design">@lang('translation.Material_Design')</a></li>
                        <li><a href="icons-dripicons" data-key="t-dripicons">@lang('translation.Dripicons')</a></li>
                        <li><a href="icons-fontawesome" data-key="t-font-awesome">@lang('translation.Font_awesome')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-map icon nav-icon"></i>
                        <span class="menu-item" data-key="t-maps">@lang('translation.Maps')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="maps-google" data-key="t-google">@lang('translation.Google')</a></li>
                        <li><a href="maps-vector" data-key="t-vector">@lang('translation.Vector')</a></li>
                        <li><a href="maps-leaflet" data-key="t-leaflet">@lang('translation.Leaflet')</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-share-alt icon nav-icon"></i>
                        <span class="menu-item" data-key="t-multi-level">@lang('translation.Multi_Level')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="javascript: void(0);" data-key="t-level-1.1">@lang('translation.Level_1_1')</a></li>
                        <li><a href="javascript: void(0);" class="has-arrow" data-key="t-level-1.2">@lang('translation.Level_1_2')</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript: void(0);" data-key="t-level-2.1">@lang('translation.Level_2_1')</a></li>
                                <li><a href="javascript: void(0);" data-key="t-level-2.2">@lang('translation.Level_2_2')</a></li>
                            </ul>
                        </li>
                    </ul>
                </li> --}}

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
