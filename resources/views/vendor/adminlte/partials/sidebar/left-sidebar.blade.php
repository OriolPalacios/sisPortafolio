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
            <div class="card">
                <ul class="list-group list-group-flush rounded revisor-options">
                    @if (session('current_role') == 'Revisor')
                        <li class="list-group-item p-0 text-center {{ request()->is('Revisor') ? 'bg-primary' : 'bg-white' }}">
                            <a href="{{route('Revisor')}}" class="nav-link">
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="list-group-item p-0 text-center bg-white">
                            <a href="#" class="nav-link">
                                <span>Gestion de Portafolios</span>
                            </a>
                        </li>
                        <li class="list-group-item p-0 text-center bg-white">
                            <a href="#" class="nav-link">
                                <span>Observaciones</span>
                            </a>
                        </li>
                        <li class="list-group-item p-0 text-center bg-white">
                            <a href="#" class="nav-link">
                                <span>Reportes</span>
                            </a>
                        </li>
                        <li class="list-group-item p-0 text-center bg-white">
                            <a href="{{route('profile.edit')}}" class="nav-link">
                                <span>Perfil</span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="card">
                <ul class="list-group list-group-flush rounded administrador-options">
                    @if (session('current_role') == 'Administrador')
                        <li class="list-group-item p-0 text-center {{ request()->is('Administrador') ? 'bg-primary' : 'bg-white' }}">
                            <a href="{{route('Administrador')}}" class="nav-link">
                                <span>Dashboard</span>
                            </a>
                        </li>
            
                        <!-- Gestión de Docentes -->
                        <li class="list-group-item p-0 text-center bg-white">
                            <a href="#" class="nav-link d-flex justify-content-between align-items-center"
                            onclick="toggleMenu('docentes-menu')"
                            data-menu="{{ request()->is('Administrador/docentes', 'Administrador/revisores') ? 'open' : 'closed' }}">
                                <span>Gestión de Docentes</span>
                                <span class="triangle">&#9660;</span>
                            </a>
                            <ul id="docentes-menu" class="list-group list-group-flush text-start {{ request()->is('Administrador/docentes', 'Administrador/revisores') ? '' : 'd-none' }}">
                                <!-- Opción Docentes -->
                                <li class="list-group-item p-0 text-center {{ request()->is('Administrador/docentes') ? 'bg-primary' : 'bg-gray' }}">
                                    <a href="{{ route('admin.docentes') }}" class="nav-link">
                                        <span>Docentes</span>
                                    </a>
                                </li>
                                <!-- Opción Revisores -->
                                <li class="list-group-item p-0 text-center {{ request()->is('Administrador/revisores') ? 'bg-primary' : 'bg-gray' }}">
                                    <a href="{{ route('admin.revisores') }}" class="nav-link">
                                        <span>Revisores</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

            
                        <!-- Gestión Semestre -->
                        <li class="list-group-item p-0 text-center {{ request()->is('Administrador/semestre') ? 'bg-primary' : 'bg-white' }}">
                            <a href="{{ route('admin.semestre') }}" class="nav-link">
                                <span>Gestión Semestre</span>
                            </a>
                        </li>
            
                        <!-- Reportes Portafolios -->
                        <li class="list-group-item p-0 text-center bg-white">
                            <a href="#" class="nav-link d-flex justify-content-between align-items-center" onclick="toggleMenu('reportes-menu')"
                            data-menu="{{ request()->is('Administrador/reportegeneral', 'Administrador/reportehistorico') ? 'open' : 'closed' }}">
                                <span>Reportes Portafolios</span>
                                <span class="triangle">&#9660;</span>
                            </a>
                            <ul id="reportes-menu" class="list-group list-group-flush text-start {{ request()->is('Administrador/reportegeneral', 'Administrador/reportehistorico') ? '' : 'd-none' }}">
                                <li class="list-group-item p-0 text-center {{ request()->is('Administrador/reportegeneral') ? 'bg-primary' : 'bg-gray' }}">
                                    <a href="{{ route('admin.reportegeneral') }}" class="nav-link">
                                        <span>Reporte general de revisión</span>
                                    </a>
                                </li>
                                <li class="list-group-item p-0 text-center {{ request()->is('Administrador/reportehistorico') ? 'bg-primary' : 'bg-gray' }}">
                                    <a href="{{ route('admin.reportehistorico') }}" class="nav-link">
                                        <span>Reporte de desempeño histórico de un docente</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
            
                        <!-- Perfil -->
                        <li class="list-group-item p-0 text-center bg-white">
                            <a href="{{route('profile.edit')}}" class="nav-link">
                                <span>Perfil</span>
                            </a>
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
