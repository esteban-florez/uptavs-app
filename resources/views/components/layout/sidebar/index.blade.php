<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <div class="sidebar mt-0 h-100">
  <div class="user-panel my-3 pb-3 d-flex align-items-center">
    <div class="image pl-2">
    <img src="{{ asset('img/sample1.jpg') }}" class="img-circle elevation-2" alt="Imagen del usuario">
    </div>
    <div class="info">
    <p class="d-block text-white m-0">{{ Auth::user()->name }}</p>
    <span class="text-bold text-muted">{{ Str::ucfirst(Auth::user()->role) }}</span>
    </div>
  </div>
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu">
      <x-layout.sidebar.item icon="graduation-cap">
        Cursos
        <x-slot name="menu">
          <x-layout.sidebar.item url="#" icon="list">
            Lista de cursos
          </x-layout.sidebar.item>
          @is('administrator')
          <x-layout.sidebar.item url="#" icon="plus">
            Registrar curso
          </x-layout.sidebar.item>
          <x-layout.sidebar.item url="#" icon="book">
            Expedientes
          </x-layout.sidebar.item>
          @endis
          @isnt('administrator')
          <x-layout.sidebar.item url="#" icon="star">
            Mis cursos
          </x-layout.sidebar.item>
          @endisnt
          @isnt('student')
          <x-layout.sidebar.item :url="route('areas.index')" icon="chalkboard-teacher">
            Áreas de formación
          </x-layout.sidebar.item>
          <x-layout.sidebar.item url="#" icon="clipboard-list">
            Matrícula
          </x-layout.sidebar.item>
          @endisnt
        </x-slot>
      </x-layout.sidebar.item>
      <x-layout.sidebar.item icon="basketball-ball">
        Clubes
        <x-slot name="menu">
          <x-layout.sidebar.item url="#" icon="list">
            Lista de clubes
          </x-layout.sidebar.item>
          @isnt('administrator')
          <x-layout.sidebar.item url="#" icon="star">
            Mis clubes
          </x-layout.sidebar.item>
          @endisnt
          @is('administrator')
          <x-layout.sidebar.item url="#" icon="plus">
            Registrar club
          </x-layout.sidebar.item>
          @endis
          @isnt('student')
          <x-layout.sidebar.item url="#" icon="shopping-basket">
            Artículos
          </x-layout.sidebar.item>
          <x-layout.sidebar.item url="#" icon="users">
            Miembros
          </x-layout.sidebar.item>
          @endisnt
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
          <x-layout.sidebar.item :url="route('pagos')" icon="list">
            Lista de pagos
          </x-layout.sidebar.item>
          @is('administrator')
          <x-layout.sidebar.item url="#" icon="check">
            Por verificar
          </x-layout.sidebar.item>
          @endis
          @is('student')
          <x-layout.sidebar.item url="#" icon="receipt">
            Cuotas pendientes
          </x-layout.sidebar.item>
          @endis
        </x-slot>
      </x-layout.sidebar.item>
      @endisnt
      @isnt('administrator')
      <x-layout.sidebar.item url="#" icon="calendar-alt">
        Horario
      </x-layout.sidebar.item>
      @endisnt
      @is('administrator')
      <x-layout.sidebar.item url="#" icon="chart-pie">
        Estadísticas
      </x-layout.sidebar.item>
      @endis
      <div class="divider"></div>
      @isnt('administrator')
      <x-layout.sidebar.item url="#" icon="user-alt">
        Perfil
      </x-layout.sidebar.item>
      @endisnt
      @is('administrator')
      <x-layout.sidebar.item icon="cog">
        Configuración
        <x-slot name="menu">
          <x-layout.sidebar.item url="#" icon="user-alt">
            Usuarios del sistema
          </x-layout.sidebar.item>
          <x-layout.sidebar.item url="#" icon="file-invoice">
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