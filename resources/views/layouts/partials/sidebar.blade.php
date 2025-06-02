<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <span class="app-brand-text demo menu-text fw-bolder ms-2">SPK - SAW</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Dashboard">Dashboard</div>
            </a>
        </li>
        <li
            class="menu-item {{ request()->routeIs('dashboard.dataset', 'dashboard.normalisasi', 'dashboard.konversi') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-list-ol"></i>
                <div data-i18n="Data">Data</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('dashboard.dataset') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.dataset') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-list-ul"></i>
                        <div data-i18n="Dataset Awal">Dataset Awal</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('dashboard.normalisasi') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.normalisasi') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
                        <div data-i18n="Normalisasi">Normalisasi</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('dashboard.konversi') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.konversi') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-transfer-alt"></i>
                        <div data-i18n="Konversi">Konversi</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item {{ request()->routeIs('dashboard.criteria') ? 'active' : '' }}">
            <a href="{{ route('dashboard.criteria') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-list-check"></i>
                <div data-i18n="Criteria">Criteria</div>
            </a>
        </li>

        <li class="menu-item {{ request()->routeIs('dashboard.sub-criteria') ? 'active' : '' }}">
            <a href="{{ route('dashboard.sub-criteria') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-category-alt"></i>
                <div data-i18n="Sub-Criteria">Sub-Criteria</div>
            </a>
        </li>

        <li class="menu-item {{ request()->routeIs('dashboard.alternatif') ? 'active' : '' }}"">
            <a href="{{ route('dashboard.alternatif') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user-voice"></i>
                <div data-i18n="Alternative">Alternative</div>
            </a>
        </li>

        <li class="menu-item {{ request()->routeIs('dashboard.hasil') ? 'active' : '' }}"">
            <a href="{{ route('dashboard.hasil') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-flag"></i>
                <div data-i18n="Hasil">Hasil</div>
            </a>
        </li>

    </ul>
</aside>
