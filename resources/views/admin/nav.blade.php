<div class="sidebar sidebar-dark sidebar-fixed sidebar-narrow-unfoldable" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
        <img class="sidebar-brand-full" src="{{ asset('logo.png') }}" style="    height: 2rem !important;" alt="" srcset="">
        <i class="sidebar-brand-narrow"><i class="fa-solid fa-cart-arrow-down"></i></i>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">
                <i class="nav-icon fa-solid fa-house-crack"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.settings') }}">
                <i class="nav-icon fa-solid fa-sliders"></i> Cài đặt</a></li>

        <li class="nav-item"><a class="nav-link" href="{{ route('admin.seo') }}">
                <i class="nav-icon fa-solid fa-icons"></i> Tuỳ chỉnh SEO</a></li>

        <li class="nav-item"><a class="nav-link" href="{{ route('admin.img') }}">
                <i class="nav-icon fa-solid fa-images"></i> Tuỳ chỉnh hình ảnh</a></li>

        <li class="nav-item"><a class="nav-link" href="{{ route('admin.headers') }}">
                <i class="nav-icon fa-solid fa-images"></i> Tuỳ chỉnh Header</a></li>

        <li class="nav-item"><a class="nav-link" href="{{ route('admin.lucky_game') }}">
                <i class="nav-icon fa-solid fa-gamepad"></i> Game</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.bai_viet') }}">
                <i class="nav-icon fa-regular fa-newspaper"></i> Quản lý bài viết</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.danh_muc') }}">
                <i class="nav-icon fa-regular fa-newspaper"></i> Quản lý danh mục</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.list') }}">
                <i class="nav-icon fa-solid fa-users"></i> Quản lý người dùng</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.recharge') }}">
                <i class="nav-icon fa-solid fa-cash-register"></i> Quản lý nạp tiền</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.withdraw') }}">
                <i class="nav-icon fa-solid fa-money-bill-wave"></i> Quản lý rút tiền</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.game_manager') }}">
                <i class="nav-icon fa-solid fa-masks-theater"></i> Quản lý đánh giá</a></li>

    </ul>
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
