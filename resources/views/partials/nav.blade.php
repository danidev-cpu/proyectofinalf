 <div class="barra-inicio"></div>
 <nav>

     <ul class="nav-list">
         <li class="list_links"><a href="{{ route('index') }}"> Inicio</a></li>
         <li class="list_links"><a href="{{ route('jugadores') }}"> Jugadores</a></li>
         <li class="list_links"><a href="{{ route('events') }}"> Eventos</a></li>
         <li class="list_links"><a href="{{ route('tienda') }}"> Tienda</a></li>

     </ul>
     <div class="div-logo">

         <a href="{{ route('index') }}"><img src="/img/logo.jpg" alt="logo heretics"> </a>


     </div>

     <ul class="nav-list">
         @auth
             <!-- Menú desplegable-->
             <li class="dropdown">
                 <a href="#">Administración ▼</a>
                 <ul class="dropdown-content">
                     <li class="list_links"><a href="{{ route('players.store') }}">Añadir jugador</a></li>
                     <li class="list_links"><a href="{{ route('events.store') }}">Añadir evento</a></li>
                     <li class="list_links"><a href="{{ route('mensaje') }}">Mensajes</a></li>
                 </ul>
             </li>
             <li class="list_links">
                 <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                     @csrf
                     <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer;">Cerrar
                         Sesión</button>
                 </form>
             </li>
         @else
             <li></li>
             <li class="list_links"><a href="{{ route('login') }}">Iniciar Sesión</a></li>
             <li class="list_links"><a href="{{ route('signup') }}">Registrarse</a></li>
         @endauth
         <li class="list_links"><a href="{{ route('users.account') }}">Cuenta</a></li>

         <li class="list_links"><a href="{{ route('contact') }}">Contacto</a></li>
         <li class="list_links"><a href="{{ route('where-to-find-us') }}">Dónde estamos</a>
         </li>

     </ul>

 </nav>
