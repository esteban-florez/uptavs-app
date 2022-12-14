@php
  $currentUser = user();
@endphp

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="sidebar mt-0 h-100">
  <div class="user-panel my-3 pb-3 d-flex align-items-center">
    <div class="image pl-2">
    <img src="{{ asset($currentUser->image) }}" class="img-circle elevation-2" alt="Imagen del usuario">
    </div>
    <div class="info">
      <p class="d-block text-white m-0">{{ $currentUser->full_name }}</p>
      <span class="text-bold text-muted">{{ $currentUser->role }}</span>
    </div>
  </div>
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu">
      <x-layout.sidebar.item :url="route('home')" icon="home">
        Home
      </x-layout.sidebar.item>
      <x-layout.sidebar.item icon="graduation-cap">
        Cursos
        <x-slot name="menu">
          @is('student')
          <x-layout.sidebar.item :url="route('market.index')" icon="list">
            Lista de cursos
          </x-layout.sidebar.item>
          @endis
          @isnt('student')
          <x-layout.sidebar.item :url="route('courses.index')" icon="list">
            Lista de cursos
          </x-layout.sidebar.item>
          @endisnt
          @is('admin')
          <x-layout.sidebar.item :url="route('courses.create')" icon="plus">
            Registrar curso
          </x-layout.sidebar.item>
          {{-- TODO -> comentado hasta que funcione --}}
          {{-- <x-layout.sidebar.item url="#" icon="book">
            Expedientes
          </x-layout.sidebar.item> --}}
          @endis
          @isnt('admin')
          <x-layout.sidebar.item url="#" icon="star">
            Mis cursos
          </x-layout.sidebar.item>
          @endisnt
          @isnt('student')
          <x-layout.sidebar.item :url="route('areas.index')" icon="chalkboard-teacher">
            Áreas de formación
          </x-layout.sidebar.item>
          @endisnt
        </x-slot>
      </x-layout.sidebar.item>
      <x-layout.sidebar.item icon="basketball-ball">
        Clubes
        <x-slot name="menu">
          <x-layout.sidebar.item :url="route('club.index')" icon="list">
            Lista de clubes
          </x-layout.sidebar.item>
          @isnt('admin')
          <x-layout.sidebar.item url="#" icon="star">
            Mis clubes
          </x-layout.sidebar.item>
          @endisnt
          @is('admin')
          <x-layout.sidebar.item :url="route('club.create')" icon="plus">
            Registrar club
          </x-layout.sidebar.item>
          @endis
        </x-slot>
      </x-layout.sidebar.item>
      @isnt('student')
      <x-layout.sidebar.item icon="boxes">
        Inventarios
        <x-slot name="menu">
          <x-layout.sidebar.item url="#" icon="list-alt">
            Inventario actual
          </x-layout.sidebar.item>
          <x-layout.sidebar.item url="#" icon="history">
            Historial
          </x-layout.sidebar.item>
        </x-slot>
      </x-layout.sidebar.item>
      @endisnt
      @isnt('instructor')
      <x-layout.sidebar.item icon="money-bill">
        Pagos
        <x-slot name="menu">
          <x-layout.sidebar.item :url="route('payments.index')" icon="list">
            Lista de pagos
          </x-layout.sidebar.item>
          @is('admin')
          <x-layout.sidebar.item :url="route('pending.index')" icon="check">
            Por verificar
          </x-layout.sidebar.item>
          @endis
        </x-slot>
      </x-layout.sidebar.item>
      @endisnt
      @isnt('admin')
      <x-layout.sidebar.item url="#" icon="calendar-alt">
        Horario
      </x-layout.sidebar.item>
      @endisnt
      @is('admin')
      <x-layout.sidebar.item url="#" icon="chart-pie">
        Estadísticas
      </x-layout.sidebar.item>
      @endis
      <div class="divider"></div>
      @isnt('admin')
      <x-layout.sidebar.item url="#" icon="user-alt">
        Perfil
      </x-layout.sidebar.item>
      @endisnt
      @is('admin')
      <x-layout.sidebar.item icon="cog">
        Configuración
        <x-slot name="menu">
          <x-layout.sidebar.item icon="user-alt">
            Usuarios
            <x-slot name="menu">
              <x-layout.sidebar.item :url="route('students.index')" icon="user-graduate">
                Estudiantes
              </x-layout.sidebar.item>
              <x-layout.sidebar.item :url="route('instructors.index')" icon="user-tie">
                Instructores
              </x-layout.sidebar.item>
            </x-slot>
          </x-layout.sidebar.item>
          <x-layout.sidebar.item :url="route('credentials.index')" icon="file-invoice">
            Credenciales de pago
          </x-layout.sidebar.item>
          <x-layout.sidebar.item url="#" icon="database">
            Base de datos
          </x-layout.sidebar.item>
        </x-slot>
      </x-layout.sidebar.item>
      @endis
      <x-layout.sidebar.item :url="route('logout')" icon="sign-out-alt">
        Cerrar Sesión
      </x-layout.sidebar.item>
    </ul>
  </nav>
  </div>
</aside>