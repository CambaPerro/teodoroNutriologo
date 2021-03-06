<div class="sidebar">
        <nav class="sidebar-nav">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="../public"><i class="icon-speedometer"></i> Escritorio</a>
                </li>
                <li class="nav-title">
                    Gestion de Dieta
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon icon-people"></i>Usuarios</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="dietas"><i class="nav-icon icon-user"></i> Dieta</a>
                        </li>
                    </ul>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="perfils"><i class="nav-icon icon-user"></i> Perfil</a>
                        </li>
                    </ul>
                </li>
                @guest
                
                @else
                @if (Auth::user()->tipo=='A')

                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon icon-bag"></i> Administracion</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="categorias"><i class="nav-icon icon-grid"></i> Categoria Alimentos</a>
                        </li>
                    </ul>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="alimentos"><i class="nav-icon icon-grid"></i> Alimentos</a>
                        </li>
                    </ul>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="tipo_actividads"><i class="nav-icon icon-grid"></i> Tipo Actividad Fisica</a>
                        </li>
                    </ul>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="actividad_fisicas"><i class="nav-icon icon-grid"></i> Actividad Fisica</a>
                        </li>
                    </ul>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="menus"><i class="nav-icon icon-grid"></i> Menu</a>
                        </li>
                    </ul>
                </li>  
                @endif
                @endguest                
            </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>