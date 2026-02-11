 <nav class="navbar navbar-expand-lg ">
     <div class="container-fluid">

         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
             aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav flex-grow-1">
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('index') }}">Inicio</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('jugadores.index') }}">Jugadores</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('events') }}">Eventos</a>
                 </li>
             </ul>

             <a class="navbar-brand mx-lg-auto" href="{{ route('index') }}">
                 <img src="/img/logo.jpg" alt="logo heretics" style="height: 40px;">
             </a>

             <form class="d-flex align-items-center ms-2" role="search" method="GET"
                 action="{{ route('jugadores.index') }}">
                 <input class="form-control form-control-sm" type="search" name="q" placeholder="Buscar jugador"
                     aria-label="Buscar jugador" value="{{ request('q') }}" style="width: 160px;">
             </form>

             <ul class="navbar-nav flex-grow-1 justify-content-end">
                 @php
                     $user = auth()->user();
                 @endphp
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('tienda') }}">Tienda</a>
                 </li>
                 <li class="nav-item">
                     <a class="nav-link" href="{{ route('contact') }}">Contacto</a>
                 </li>
                 <li class="nav-item pe-lg-3"> <a class="nav-link" href="{{ route('where-to-find-us') }}">Dónde
                         estamos</a>
                 </li>

                 @auth
                     @if ($user instanceof \App\Models\User && $user->isAdmin())
                         <li class="nav-item"><a class="nav-link" href="{{ route('mensaje') }}">Mensajes</a></li>
                     @endif
                     <li class="nav-item"><a class="nav-link" href="{{ route('users.account') }}">Cuenta</a></li>
                     @if ($user instanceof \App\Models\User && $user->isAdmin())
                         <li class="nav-item">
                             <span class="nav-link text-warning" aria-label="Usuario administrador">Admin</span>
                         </li>
                     @endif
                     <li class="nav-item">
                         <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                             @csrf
                             <button class="nav-link btn btn-link" type="submit"
                                 style="border: none; padding: 0.5rem 1rem;">Salir</button>
                         </form>
                     </li>
                 @else
                     <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                     <li class="nav-item"><a class="nav-link" href="{{ route('signup') }}">Registro</a></li>
                 @endauth
             </ul>
         </div>
     </div>
 </nav>
