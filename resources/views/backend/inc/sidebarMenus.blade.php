<ul class="tt-side-nav searchMenu">

    <!-- dashboard -->
    <li class="side-nav-item nav-item">
        <a href="{{ route('admin.dashboard') }}" class="side-nav-link">
            <span class="tt-nav-link-icon"><i data-feather="pie-chart"></i></span>
            <span class="tt-nav-link-text">{{ localize('Dashboard') }}</span>
        </a>
    </li>

    <!-- products -->
    @php
        $productsActiveRoutes = [
            'admin.brands.index',
            'admin.brands.edit',
            'admin.units.index',
            'admin.units.edit',
            'admin.variations.index',
            'admin.variations.edit',
            'admin.variationValues.index',
            'admin.variationValues.edit',
            'admin.taxes.index',
            'admin.taxes.edit',
            'admin.categories.index',
            'admin.categories.create',
            'admin.categories.edit',
            'admin.products.index',
            'admin.products.create',
            'admin.products.edit',
        ];
    @endphp

    @canany(['products', 'categories', 'variations', 'brands', 'units', 'taxes'])
        <li class="side-nav-item nav-item {{ areActiveRoutes($productsActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#sidebarProducts"
                aria-expanded="{{ areActiveRoutes($productsActiveRoutes, 'true') }}" aria-controls="sidebarProducts"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="shopping-bag"></i></span>
                <span class="tt-nav-link-text">{{ localize('Products') }}</span>
            </a>

            <div class="collapse {{ areActiveRoutes($productsActiveRoutes, 'show') }}" id="sidebarProducts">
                <ul class="side-nav-second-level">

                    @can('products')
                        <li
                            class="{{ areActiveRoutes(['admin.products.index', 'admin.products.create', 'admin.products.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.products.index') }}"
                                class="{{ areActiveRoutes(['admin.products.index', 'admin.products.create', 'admin.products.edit']) }}">{{ localize('All Products') }}</a>
                        </li>
                    @endcan

                    @can('categories')
                        <li
                            class="{{ areActiveRoutes(['admin.categories.index', 'admin.categories.create', 'admin.categories.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.categories.index') }}"
                                class="{{ areActiveRoutes(['admin.categories.index', 'admin.categories.create', 'admin.categories.edit']) }}">{{ localize('All Categories') }}</a>
                        </li>
                    @endcan

                    {{-- @can('variations')
                        <li
                            class="{{ areActiveRoutes(
                                ['admin.variations.index', 'admin.variations.edit', 'admin.variationValues.index', 'admin.variationValues.edit'],
                                'tt-menu-item-active',
                            ) }}">
                            <a href="{{ route('admin.variations.index') }}"
                                class="{{ areActiveRoutes([
                                    'admin.variations.index',
                                    'admin.variations.edit',
                                    'admin.variationValues.index',
                                    'admin.variationValues.edit',
                                ]) }}">{{ localize('All Variations') }}</a>
                        </li>
                    @endcan --}}
                    @can('brands')
                        <li class="{{ areActiveRoutes(['admin.brands.index', 'admin.brands.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.brands.index') }}"
                                class="{{ areActiveRoutes(['admin.brands.index', 'admin.brands.edit']) }}">{{ localize('All Brands') }}</a>
                        </li>
                    @endcan

                    {{-- @can('units')
                        <li class="{{ areActiveRoutes(['admin.units.index', 'admin.units.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.units.index') }}"
                                class="{{ areActiveRoutes(['admin.units.index']) }}">{{ localize('All Units') }}</a>
                        </li>
                    @endcan --}}

                    {{-- @can('taxes')
                        <li class="{{ areActiveRoutes(['admin.taxes.index', 'admin.taxes.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.taxes.index') }}"
                                class="{{ areActiveRoutes(['admin.taxes.index']) }}">{{ localize('All Taxes') }}</a>
                        </li>
                    @endcan --}}
                </ul>
            </div>
        </li>
    @endcan


    <!-- orders -->
    @can('orders')
        <li
            class="side-nav-item nav-item {{ areActiveRoutes(['admin.orders.index', 'admin.orders.show'], 'tt-menu-item-active') }}">
            <a href="{{ route('admin.orders.index') }}"
                class="side-nav-link {{ areActiveRoutes(['admin.orders.index', 'admin.orders.show']) }}">
                <span class="tt-nav-link-icon"><i data-feather="shopping-cart"></i></span>
                <span class="tt-nav-link-text">
                    <span>{{ localize('Orders') }}</span>

                    @php
                        $newOrdersCount = \App\Models\Order::isPlaced()->count();
                    @endphp

                    @if ($newOrdersCount > 0)
                        <small class="badge bg-danger">{{ localize('New') }}</small>
                    @endif
                </span>
            </a>
        </li>
    @endcan


    <!-- Users -->
    <li class="side-nav-title side-nav-item nav-item mt-3">
        <span class="tt-nav-title-text">{{ localize('Users') }}</span>
    </li>

    <!-- customers -->
    @can('customers')
        <li class="side-nav-item nav-item">
            <a href="{{ route('admin.customers.index') }}" class="side-nav-link">
                <span class="tt-nav-link-icon"> <i data-feather="users"></i></span>
                <span class="tt-nav-link-text">{{ localize('Customers') }}</span>
            </a>
        </li>
    @endcan

    <!-- staffs -->
    {{-- @can('staffs')
        <li
            class="side-nav-item nav-item {{ areActiveRoutes(['admin.staffs.index', 'admin.staffs.create', 'admin.staffs.edit'], 'tt-menu-item-active') }}">
            <a href="{{ route('admin.staffs.index') }}" class="side-nav-link">
                <span class="tt-nav-link-icon"> <i data-feather="user-check"></i></span>
                <span class="tt-nav-link-text">{{ localize('Employee Staffs') }}</span>
            </a>
        </li>
    @endcan --}}



    <!-- delivery -->
    @php
        $deliveryActiveRoutes = ['admin.deliverymen.index', 'admin.deliverymen.create', 'admin.deliverymen.edit'];
    @endphp

    @canany(['add_deliveryman', 'edit_deliveryman', 'delete_deliveryman', 'assign_deliveryman', 'deliveryman_config',
        'deliveryman_list'])
        <li class="side-nav-item nav-item {{ areActiveRoutes($deliveryActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#manageDeliverymen"
                aria-expanded="{{ areActiveRoutes($deliveryActiveRoutes, 'true') }}" aria-controls="manageDeliverymen"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="send"></i></span>
                <span class="tt-nav-link-text">{{ localize('Delivery Men') }}</span>
            </a>
            <div class="collapse {{ areActiveRoutes($deliveryActiveRoutes, 'show') }}" id="manageDeliverymen">
                <ul class="side-nav-second-level">


                    @can('deliveryman_list')
                        <li
                            class="{{ areActiveRoutes(['admin.deliverymen.index', 'admin.deliverymen.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.deliverymen.index') }}"
                                class="{{ areActiveRoutes(['admin.deliverymen.index', 'admin.deliverymen.edit']) }}">{{ localize('All Deliverymen') }}</a>
                        </li>
                    @endcan

                    @can('add_deliveryman')
                        <li class="{{ areActiveRoutes(['admin.deliverymen.create'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.deliverymen.create') }}"
                                class="{{ areActiveRoutes(['admin.deliverymen.create']) }}">{{ localize('Add Deliveryman') }}</a>
                        </li>
                    @endcan

                    @can('deliveryman_cancel_request')
                        <li class="{{ areActiveRoutes(['admin.deliverymen.cancel-request'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.deliverymen.cancel-request') }}">{{ localize('Cancel Requests') }}</a>
                        </li>
                    @endcan

                     {{-- @can('deliveryman_payment_history')
                        <li class="{{ areActiveRoutes(['admin.deliverymen.payout.history'], 'tt-menu-item-active') }}">
                            <a
                                href="{{ route('admin.deliverymen.payout.history') }}">{{ localize('Payout Histories') }}</a>
                        </li>
                    @endcan --}}

                   {{-- @can('deliveryman_config')
                        <li class="{{ areActiveRoutes(['admin.deliveryman.config'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.deliveryman.config') }}">{{ localize('Configurations') }}</a>
                        </li>
                    @endcan --}}

                     {{--@can('deliveryman_payroll_create')
                        <li class="{{ areActiveRoutes(['admin.deliveryman.payroll'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.deliveryman.payroll') }}">{{ localize('Deliveryman Payroll') }}</a>
                        </li>
                    @endcan


                    @can('deliveryman_payroll_list')
                        <li class="{{ areActiveRoutes(['admin.deliveryman.payroll.list'], 'tt-menu-item-active') }}">
                            <a
                                href="{{ route('admin.deliveryman.payroll.list') }}">{{ localize('Deliveryman Payroll List') }}</a>
                        </li>
                    @endcan --}}


                </ul>
            </div>
        </li>
    @endcan

    <!-- Contents -->
    <li class="side-nav-title side-nav-item nav-item mt-3">
        <span class="tt-nav-title-text">{{ localize('Contents') }}</span>
    </li>

    <!-- media manager -->
    @can('media_manager')
        <li class="side-nav-item">
            <a href="{{ route('admin.mediaManager.index') }}" class="side-nav-link">
                <span class="tt-nav-link-icon"> <i data-feather="folder"></i></span>
                <span class="tt-nav-link-text">{{ localize('Media Manager') }}</span>
            </a>
        </li>
    @endcan

    <!-- Appearance -->
    <li class="side-nav-title side-nav-item nav-item mt-3">
        <span class="tt-nav-title-text">{{ localize('Appearance') }}</span>
    </li>


    <!-- Grocery -->
    @php
        $groceryActiveRoutes = [
            'admin.appearance.homepage.hero',
            'admin.appearance.homepage.editHero',
            'admin.appearance.homepage.topCategories',
            'admin.appearance.homepage.topTrendingProducts',
            'admin.appearance.homepage.featuredProducts',
            'admin.appearance.homepage.bannerOne',
            'admin.appearance.homepage.editBannerOne',
            'admin.appearance.homepage.bestDeals',
            'admin.appearance.homepage.bannerTwo',
            'admin.appearance.homepage.clientFeedback',
            'admin.appearance.homepage.editClientFeedback',
            'admin.appearance.homepage.bestSelling',
            'admin.appearance.homepage.customProductsSection',
        ];
    @endphp

    @canany(['homepage'])
        <li class="side-nav-item nav-item {{ areActiveRoutes($groceryActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#groceryOutlook"
                aria-expanded="{{ areActiveRoutes($groceryActiveRoutes, 'true') }}" aria-controls="groceryOutlook"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="home"></i></span>
                <span class="tt-nav-link-text">{{ localize('Grocery') }}</span>
            </a>
            <div class="collapse {{ areActiveRoutes($groceryActiveRoutes, 'show') }}" id="groceryOutlook">
                <ul class="side-nav-second-level">

                    @can('homepage')
                        <li class="{{ areActiveRoutes($groceryActiveRoutes, 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.homepage.hero') }}"
                                class="{{ areActiveRoutes($groceryActiveRoutes) }}">{{ localize('Homepage') }}</a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany

    <!-- commonOutlook -->
    @php
        $commonOutlookActiveRoutes = [
            'admin.appearance.header',
            'admin.appearance.products.index',
            'admin.appearance.products.details',
            'admin.appearance.products.details.editWidget',
            'admin.appearance.about-us.popularBrands',
            'admin.appearance.about-us.features',
            'admin.appearance.about-us.editFeatures',
            'admin.appearance.about-us.whyChooseUs',
            'admin.appearance.about-us.editWhyChooseUs',
        ];
    @endphp

    @canany(['product_page', 'product_details_page', 'about_us_page', 'header', 'footer'])
        <li class="side-nav-item nav-item {{ areActiveRoutes($commonOutlookActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#commonOutlook"
                aria-expanded="{{ areActiveRoutes($commonOutlookActiveRoutes, 'true') }}" aria-controls="commonOutlook"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="layout"></i></span>
                <span class="tt-nav-link-text">{{ localize('Common Outlook') }}</span>
            </a>
            <div class="collapse {{ areActiveRoutes($commonOutlookActiveRoutes, 'show') }}" id="commonOutlook">
                <ul class="side-nav-second-level">

                    @can('product_page')
                        <li class="{{ areActiveRoutes(['admin.appearance.products.index'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.products.index') }}"
                                class="{{ areActiveRoutes(['admin.appearance.products.index']) }}">{{ localize('Products Page') }}</a>
                        </li>
                    @endcan

                    {{-- @can('product_details_page')
                        <li
                            class="{{ areActiveRoutes(['admin.appearance.products.details', 'admin.appearance.products.details.editWidget'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.products.details') }}"
                                class="{{ areActiveRoutes(['admin.appearance.products.details']) }}">{{ localize('Product Details') }}</a>
                        </li>
                    @endcan --}}

                    @can('about_us_page')
                        @php
                            $aboutUsActiveRoutes = [
                                'admin.appearance.about-us.index',
                                'admin.appearance.about-us.popularBrands',
                                'admin.appearance.about-us.features',
                                'admin.appearance.about-us.editFeatures',
                                'admin.appearance.about-us.whyChooseUs',
                                'admin.appearance.about-us.editWhyChooseUs',
                            ];
                        @endphp

                        <li class="{{ areActiveRoutes($aboutUsActiveRoutes, 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.about-us.index') }}"
                                class="{{ areActiveRoutes($aboutUsActiveRoutes) }}">{{ localize('About Us') }}</a>
                        </li>
                    @endcan

                    @can('header')
                        <li class="{{ areActiveRoutes(['admin.appearance.header'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.header') }}"
                                class="{{ areActiveRoutes(['admin.appearance.header']) }}">{{ localize('Header') }}</a>
                        </li>
                    @endcan

                    @can('footer')
                        <li class="{{ areActiveRoutes(['admin.appearance.footer'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.appearance.footer') }}"
                                class="{{ areActiveRoutes(['admin.appearance.footer']) }}">{{ localize('Footer') }}</a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcanany

            <!-- Contents -->
            <li class="side-nav-title side-nav-item nav-item mt-3">
                <span class="tt-nav-title-text">{{ localize('Contents') }}</span>
            </li>

            <!-- pages -->
            @php
                $pagesActiveRoutes = ['admin.pages.index', 'admin.pages.create', 'admin.pages.edit'];
            @endphp
            @can('pages')
                <li class="side-nav-item nav-item {{ areActiveRoutes($pagesActiveRoutes, 'tt-menu-item-active') }}">
                    <a href="{{ route('admin.pages.index') }}" class="side-nav-link">
                        <span class="tt-nav-link-icon"> <i data-feather="copy"></i></span>
                        <span class="tt-nav-link-text">{{ localize('Pages') }}</span>
                    </a>
                </li>
            @endcan
    <!-- Settings -->
    <li class="side-nav-title side-nav-item nav-item mt-3">
        <span class="tt-nav-title-text">{{ localize('Settings') }}</span>
    </li>

    <!-- Roles & Permission -->
    {{-- @php
        $rolesActiveRoutes = ['admin.roles.index', 'admin.roles.create', 'admin.roles.edit'];
    @endphp
    @can('roles_and_permissions')
        <li class="side-nav-item nav-item {{ areActiveRoutes($rolesActiveRoutes, 'tt-menu-item-active') }}">
            <a href="{{ route('admin.roles.index') }}" class="side-nav-link">
                <span class="tt-nav-link-icon"><i data-feather="unlock"></i></span>
                <span class="tt-nav-link-text">{{ localize('Roles & Permissions') }}</span>
            </a>
        </li>
    @endcan --}}


    <!-- system settings -->
    @php
        $settingsActiveRoutes = [
            'admin.generalSettings',
            'admin.orderSettings',
            'admin.timeslot.edit',
            'admin.languages.index',
            'admin.languages.edit',
            'admin.currencies.index',
            'admin.currencies.edit',
            'admin.languages.localizations',
            'admin.smtpSettings.index',
        ];
    @endphp

    @canany(['smtp_settings', 'general_settings', 'currency_settings', 'language_settings'])
        <li class="side-nav-item nav-item {{ areActiveRoutes($settingsActiveRoutes, 'tt-menu-item-active') }}">
            <a data-bs-toggle="collapse" href="#systemSetting"
                aria-expanded="{{ areActiveRoutes($settingsActiveRoutes, 'true') }}" aria-controls="systemSetting"
                class="side-nav-link tt-menu-toggle">
                <span class="tt-nav-link-icon"><i data-feather="settings"></i></span>
                <span class="tt-nav-link-text">{{ localize('System Settings') }}</span>
            </a>
            <div class="collapse {{ areActiveRoutes($settingsActiveRoutes, 'show') }}" id="systemSetting">
                <ul class="side-nav-second-level">
                    @can('order_settings')
                        <li
                            class="{{ areActiveRoutes(['admin.orderSettings', 'admin.timeslot.edit'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.orderSettings') }}"
                                class="{{ areActiveRoutes(['admin.generalSettings']) }}">{{ localize('Order Settings') }}</a>
                        </li>
                    @endcan
                    @can('general_settings')
                        <li class="{{ areActiveRoutes(['admin.generalSettings'], 'tt-menu-item-active') }}">
                            <a href="{{ route('admin.generalSettings') }}"
                                class="{{ areActiveRoutes(['admin.generalSettings']) }}">{{ localize('General Settings') }}</a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>
    @endcan
    <li class="side-nav-item nav-item">
        <a href="{{ route('logout') }}" class="side-nav-link">
            <span class="tt-nav-link-icon"> <i data-feather="log-out"></i></span>
            <span class="tt-nav-link-text">{{ localize('Sign out') }}</span>
        </a>
    </li>
</ul>
