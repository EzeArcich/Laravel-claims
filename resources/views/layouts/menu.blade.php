<li class="side-menus  {{ Request::is('*') ? 'active' : '' }}">
    
        <a class="nav-link" href="/home">
            <i class=" fas fa-table fa-xl"></i><span style="font-size:16px">.    Dashboard</span>
        </a>

        @can('ver-usuario')
        <a class="nav-link" href="/usuarios">
            <i class=" fas fa-users fa-xl"></i><span style="font-size:16px">.    Usuarios</span>
        </a>
        @endcan
        @can('ver-rol')
        <a class="nav-link" href="/roles">
            <i class=" fas fa-user-lock fa-xl"></i><span style="font-size:16px">.    Roles</span>
        </a>
        @endcan
        @can('ver-blog')
        <a class="nav-link" href="/blogs">
            <i class=" fas fa-blog fa-xl"></i><span style="font-size:16px">.    Noticias</span>
        </a>
        @endcan
        
        @can('global-siniestro')
        <a class=" nav-link" href="/siniestros">
            <i class=" fas fa-car fa-xl"></i><span style="font-size:16px">.    Siniestros</span>
        </a>
        @endcan

        @can('coordinaciones-siniestro')
        <a class=" nav-link" href="/siniestros/pendientes">
            <i class=" fas fa-clock fa-xl"></i><span style="font-size:16px">.    Pendientes</span>
        </a>

        <a class=" nav-link" href="/siniestros/ausentes">
            <i class=" fas fa-calendar-xmark fa-xl"></i><span style="font-size:16px">.    Ausentes</span>
        </a>
        @endcan
        
        @can('terceros-siniestro')
        <a class=" nav-link" href="/siniestros/terceros">
            <i class=" fas fa-business-time fa-xl"></i><span style="font-size:16px">.    Terceros</span>   
        </a>

        <a class=" nav-link" href="/siniestros/cotizaciones">
            <i class=" fas fa-file-image fa-xl"></i><span style="font-size:16px">.    Sólo cotizar</span>   
        </a>
        @endcan
        

        @can('peritos-siniestro')
        <a class=" nav-link" href="/siniestros/peritos">
            <i class=" fas fa-list-check fa-xl"></i><span style="font-size:16px">.    IP asignadas</span>
        </a>

        <a class=" nav-link" href="/siniestros/peritosgestion">
            <i class=" fas fa-list-check fa-xl"></i><span style="font-size:16px">.    IP en gestión</span>
        </a>
        @endcan
        
        <a class=" nav-link" href="/talleres">
            <i class=" fas fa-wrench fa-xl"></i><span style="font-size:16px">.    Talleres homologados</span>
        </a>

        @can('derivar-siniestro')
        <a class=" nav-link" href="/siniestros/derivaciones">
            <i class=" fas fa-person-circle-check fa-xl"></i><span style="font-size:16px">.    Asignar inspecciones</span>
        </a>
        @endcan
        
        
        

</li>
