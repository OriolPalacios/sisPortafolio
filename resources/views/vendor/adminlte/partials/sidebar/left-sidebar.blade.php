<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if (config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title"><b>¡Bienvenido!</b></h5>
                </div>
                <ul class="list-group list-group-flush  rounded">
                    <li class="list-group-item text-center bg-warning">{{ Auth::user()->nombres . ' ' . Auth::user()->apellido_paterno . ' ' . Auth::user()->apellido_materno }}</li>
                    @if (session('current_role'))
                        <li class="list-group-item text-center bg-secondary">
                            <span>{{ session('current_role') }}</span>
                        </li>
                    @endif
                </ul>
            </div>
            
            
            <script>
                // Función para mostrar/ocultar submenús
                function toggleMenu(menuId) {
                    const menu = document.getElementById(menuId);
                    if (menu.classList.contains('d-none')) {
                        menu.classList.remove('d-none');
                    } else {
                        menu.classList.add('d-none');
                    }
                }
            </script>
            
            <style>
                .triangle {
                    font-size: 0.8rem;
                    transform: rotate(0deg);
                    transition: transform 0.3s;
                }
            
                /* Ocultar menú por defecto */
                .d-none {
                    display: none;
                }
            </style>
            
            
            
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if (config('adminlte.sidebar_nav_animation_speed') != 300) data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}" @endif
                @if (!config('adminlte.sidebar_nav_accordion')) data-accordion="false" @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
    </div>


</aside>
