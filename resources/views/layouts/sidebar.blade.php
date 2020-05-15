<div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">

            <?php if(Auth::user()->nid_tipousuario == 1){?>

            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" href="#" style="background: #3A4248">
                <i class="fas fa-sync-alt nav-icon"></i>Mantenedores</a>

                <ul class="nav-dropdown-items">
                  <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('administrador/persona')}}">
                    <i class="fas fa-user-chart nav-icon"></i>Personal<span class="selec"></span></a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('administrador/procesoservicio')}}">
                    <i class="fas fa-puzzle-piece nav-icon"></i>Proceso<span class="selec"></span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('administrador/servicioactividad')}}">
                    <i class="far fa-briefcase nav-icon"></i>Servicio<span class="selec"></span></a>
                  </li>

                    <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('administrador/proyecto')}}">
                    <i class="far fa-project-diagram nav-icon"></i>Proyecto<span class="selec"></span></a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('administrador/cliente')}}">
                    <i class="fas fa-user-tie nav-icon"></i>Cliente<span class="selec"></span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('administrador/usuario')}}">
                    <i class="fas fa-user-friends nav-icon"></i>Usuarios<span class="selec"></span></a>
                  </li>
				  <li class="nav-item">
                    <a class="nav-link" href="{{URL::to('administrador/changepass')}}">
                    <i class="fas fa-lock nav-icon"></i>Cambiar clave<span class="selec"></span></a>
                  </li>
                
              </ul>
            </li>

        <?php }?>
        

          </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
