<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'SOFTIDOR',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */


    'logo' => '<b><span class=" font-italic font-weight-bolder text-monospace">SOFTIDOR</span></b>',
    'logo_img' => 'vendor/adminlte/dist/img/softidor logo.png',

    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/softidor logo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/softidor logo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => 'd-none',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',
    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => '/',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'search',
            'topnav_right' => true,
        ],
        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'search',
        ],
        /* [
            'text' => 'blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ], */

        //-------------------modulo inventario---------------------------------
        [
            'text'    => 'Inventario',
            'icon'    => 'fas fa-fw fa-clipboard-list',
            'submenu' => [
                [
                    'text' => 'Productos',
                    'icon'    => 'fas fa-fw fa-box-open',
                    'url'  => 'producto/*',
                   
                    'submenu' => [
                        [
                            'text' => 'Nuevo Producto',
                            'icon'    => 'fas fa-fw fa-plus',
                            'url'  => 'producto/create',
                            
                            
                        ],
                        [
                            'text' => 'Almacen',
                            'icon'    => 'fas fa-fw fa-warehouse',
                            'url'  => '/producto',
                          
                            
                        ],
                    ],
                ],
                [
                    'text'    => 'Premios',
                    'icon'    => 'fas fa-fw fa-gift',
                    'url'  => 'premios/*',
                    
                    'submenu' => [
                        [
                            'text' => 'Nuevo premio',
                            'icon'    => 'fas fa-fw fa-plus',
                            'url'  => 'premios/create',
                            'can' => 'premios.create',
                        ],
                        [
                            'text' => 'Lista de premios',
                            'icon'    => 'fas fa-fw fa-list-ul',
                            'url'  => 'premios',
                            
                        ],
                    ],
                ],

            ],


        ],

        //-------------------modulo compras---------------------------------
        [
            'text'    => 'Compras',
            'icon'    => 'fas fa-fw fa-shopping-bag',
            'submenu' => [
                [
                    'text' => 'Cargas',
                    'icon'    => 'fas fa-fw fa-solid fa-truck',
                    'url'  => 'cargas/*',
                    'submenu' => [
                        [
                            'text' => 'Registrar carga',
                            'icon'    => '',
                            'url'  => 'cargas/create',
                        ],
                        [
                            'text' => 'Reporte(s)',
                            'icon'    => '',
                            'url'  => 'cargas/reportes',
                        ],


                    ],
                ],

                [
                    'text'    => 'Productos',
                    'icon'    => 'fas fa-fw fa-clipboard-check',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'Registrar compra',
                            'icon'    => '',
                            'url'  => 'nota_producto/create',
                        ],
                        [
                            'text' => 'Reporte(s)',
                            'icon'    => '',
                            'url'  => 'nota_producto',
                        ],
                    ],

                ],
                [
                    'text'    => 'Proveedor',
                    'icon'    => 'fas fa-fw fa-truck',
                    'submenu' => [
                        [
                            'text' => 'Nuevo proveedor',
                            'icon'    => '',
                            'url'  => 'proveedor/create',
                        ],
                        [
                            'text' => 'Lista proveedores',
                            'icon'    => '',
                            'url'  => 'proveedor',
                        ],
                    ],
                ],
            ],
        ],
        //------------------------------------------------------------------
        //-------------------modulo ventas---------------------------------
        [
            'text'    => 'Ventas',
            'icon'    => 'fas fa-fw fa-dollar-sign',
            'submenu' => [

                [
                    'text'    => 'Combustible',
                    'icon'    => 'fas fa-fire',
                    'submenu' => [
                        [
                            'text' => 'Registrar venta',
                            'icon'    => '',
                            'url'  => 'nota_venta_combustible/create',
                        ],
                        [
                            'text' => 'Reporte(s)',
                            'icon'    => '',
                            'url'  => 'nota_venta_combustible',
                        ],
                        [
                            'text' => 'Gráficas',
                            'icon'    => '',
                            'url'  => 'ventas-combustibles/graficas',
                        ],
                    ],
                ],


                [
                    'text'    => 'Productos',
                    'icon'    => 'fas fa-fw fa-shopping-cart',
                    'url'  => 'nota_venta_producto',
                    'submenu' => [

                        [
                            'text' => 'Registrar venta',
                            'icon'    => '',
                            'url'  => 'nota_venta_producto/create',
                        ],
                        [
                            'text' => 'Reporte(s)',
                            'icon'    => '',
                            'url'  => 'ventas-productos/reportes',
                        ],
                        [
                            'text' => 'Gráficas',
                            'icon'    => '',
                            'url'  => 'ventas-productos/graficas',
                        ],
                    ],
                ],
            ],
        ],
        [
            'text'    => 'Clientes',
            'icon'    => 'fas fa-fw fa-users',
            'url'  => 'clientes/*',
            'submenu' => [
                [
                    'text' => 'Nuevo cliente',
                    'icon'    => '',
                    'url'  => 'clientes/create',
                ],
                [
                    'text' => 'Lista de clientes',
                    'icon'    => '',
                    'url'  => 'clientes',
                ],
            ],
        ],
        [
            'text'    => 'Vehiculos',
            'icon'    => 'fa fa-fw fa-car-side',
            'url'  => 'vehiculos',
        ],
        //-------------------modulo herramientas---------------------------------
        [
            'header' => 'ADMINISTRACION',
        ],
        //-------------------modulo infraestructura---------------------------------
        [
            'text'    => 'Infraestructura',
            'icon'    => 'fas fa-fw fa-building',
            'submenu' => [
                [
                    'text' => 'Bombas',
                    'icon'    => 'fas fa-fw fa-gas-pump',
                    'url'  => 'bombas/*',
                    'submenu' => [
                        [
                            'text' => 'Nuevo Bomba',
                            'icon'    => 'fas fa-fw fa-plus',
                            'url'  => 'bombas/create',
                        ],
                        [
                            'text' => 'Lista de bombas',
                            'icon'    => 'fas fa-fw fa-list-ul',
                            'url'  => 'bombas',
                        ],


                    ],
                ],
                [
                    'text' => 'Tanques',
                    'icon'    => 'fas fa-fw fa-battery-half',
                    'url'  => 'tanques/*',
                    'submenu' => [
                        [
                            'text' => 'Nuevo tanque',
                            'icon'    => 'fas fa-fw fa-plus',
                            'url'  => 'tanques/create',
                        ],
                        [
                            'text' => 'Lista de tanques',
                            'icon'    => 'fas fa-fw fa-list-ul',
                            'url'  => 'tanques',
                        ],
                    ],
                ],
                [
                    'text' => 'Combustibles',
                    'icon'    => 'fas fa-fw fa-tint',
                    'url'  => 'combustibles/*',
                    'submenu' => [
                        [
                            'text' => 'Ingresar Combustible',
                            'icon'    => 'fas fa-fw fa-plus',
                            'url'  => 'combustibles/create',
                        ],
                        [
                            'text' => 'Lista de Combustibles',
                            'icon'    => 'fas fa-fw fa-list-ul',
                            'url'  => 'combustibles',
                        ],
                    ],
                ],
            ],
        ],
        //-------------------modulo administrativo---------------------------------
        [
            'text'    => 'Administrativo',
            'icon'    => 'fas fa-fw fa-graduation-cap',
            'can'     => 'admin.home',
            'submenu' => [
                [
                    'text' => 'Empleado',
                    'url'  => 'empleados/',
                    'icon'    => 'fas fa-fw fa-hard-hat',
                ],

                [
                    'text'    => 'Roles & Permisos',
                    'route'   => 'admin.roles.index',
                    'icon'    => 'fas fa-fw fa-handshake',
                    'can'     => 'admin.roles.index',
                ],

                [
                    'text'    => 'Turnos',
                    'icon'    => 'fas fa-fw fa-stopwatch',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'nuevo turno',
                            'icon'    => 'fas fa-fw fa-plus',
                            'url'  => 'turno/create',
                        ],
                        [
                            'text' => 'lista de turnos',
                            'icon'    => 'fas fa-fw fa-list-ul',
                            'url'  => 'turno',
                        ],
                        /* [
                            'text'    => 'Asistencia',
                            'icon'    => 'fas fa-fw fa-clipboard',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'lista de asistencias',
                                    'icon'    => 'fas fa-fw fa-list-ul',
                                    'url'  => 'asistencia',
                                ],
                            ],
                        ], */
                        /* [
                            'text'    => 'Turnos',
                            'icon'    => 'fas fa-fw fa-stopwatch',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'nuevo turno',
                                    'icon'    => 'fas fa-fw fa-plus',
                                    'url'  => 'turno/create',
                                ],
                                [
                                    'text' => 'lista de turnos',
                                    'icon'    => 'fas fa-fw fa-list-ul',
                                    'url'  => 'turno',
                                ],
                            ],
                        ], */
                    ],
                ],




            ],
        ],
        [
            'text'    => 'Herramientas',
            'icon'    => 'fas fa-fw fa-wrench',
            'submenu' => [
                [
                    'text' => 'Bitacora',
                    'icon'    => 'far fa-eye',
                    'url'  => 'bitacora',
                ],
               /*  [
                    'text' => 'Backup',
                    'icon'    => 'fas fa-fw fa-save',
                    'url'  => 'backups',
                ], */
            ],
        ],
        //------------------------------------------------------------------
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    //'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                    'location' => '//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    //'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                    'location' => '//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@11',
                ],

            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => true,
];
