<x-layout.main title="Inicio">
  {{-- TODO -> ver que titulo se le pone, por ahora se quedó inicio --}}
  @push('css')
  <link rel="stylesheet" href="{{ asset('css/home.css') }}">
  @endpush

  <!-- Hay muchas cosas que arreglar aquí en el home, pero, yastoi harta ptm jasjajskajk -->

  <!-- TODO -> Hacer que me lleve a los detalles de todas las cards -->
  <!-- TODO -> Agregar la relación con pagos, para que se muestren los de verificar y así -->
  <!-- TODO -> Poner links de ver más -->
  <!-- TODO -> Desglozar partes en varios componentes, mucho código -->
  <!-- TODO -> Hacer que funcionen bien las cards, osea que agarren realmente los ultimos cursos -->

  @is('student')
  <section class="container fluid px-sm-4">
    <div class="row mt-3">
      <div class="col-md-7 col-lg-8">
        <div class="card mb-2 text-center">
          <div class="card-header">
            <h2 class="mb-0">¡Últimos cursos!</h2>
          </div>
          <x-carousel :items="$courses" :details="route('courses.show', '$courses->id')"/>
        </div>
      </div>
      <div class="col-md-5 col-lg-4">
        <div class="card w-100 d-sm-inline-block d-none mb-0">
          <div class="card-body d-flex flex-column justify-content-center align-items-center py-2">
            <h4 class="mb-0">8:30 PM</h4>
            <h4 class="mb-0">30/11/2022</h4>
          </div>
        </div>
        <div class="card card-dark mt-3">
          <div class="card-header">
            <h5 class="mb-0">Pagos pendientes</h5>
          </div>
          <div class="card-body p-3 payment-container">
            <!-- <div class="card mb-2">
              <div class="card-body p-2">
                <h5>Programación Web</h5>
                <h6 class="mb-0 text-success">Monto total: 45$</h6>
              </div>
            </div>
            <div class="card mb-2">
              <div class="card-body p-2">
                <h5>Programación Web</h5>
                <h6 class="mb-0 text-success">Monto total: 45$</h6>
              </div>
            </div> -->
            <div class="empty-container">
              <div class="empty">No hay pagos pendientes</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <h3 class="mb-0">Clubes destacados</h3>
      </div>
      <div class="card-body">
        <div class="courses-grid">
          @forelse($clubs as $club)
          <x-club.card :club="$club"/>
          @empty
          <div class="empty-container">
            <h2 class="empty">No hay clubs disponibles</h2>
          </div>
          @endforelse
        </div>
      </div>
    </div>
  </section>
  @endis
  @is('admin')
  <section class="container fluid px-sm-4">
    <div class="row mt-3">
      <div class="col-md-7 col-lg-8">
        <div class="card">
          <div class="card-header">
            <h3 class="mb-0">Pagos pendientes</h3>
          </div>
          <div class="card-body p-3 payment-container">
            <!-- <div class="card mb-2">
              <div class="card-body p-2">
                <h5>Programación Web</h5>
                <h6 class="mb-0 text-success">Monto total: 45$</h6>
              </div>
            </div>
            <div class="card mb-2">
              <div class="card-body p-2">
                <h5>Programación Web</h5>
                <h6 class="mb-0 text-success">Monto total: 45$</h6>
              </div>
            </div> -->
            <div class="empty-container">
              <div class="empty">No hay pagos pendientes</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5 col-lg-4">
        <div class="card w-100 d-sm-inline-block d-none mb-0">
          <div class="card-body d-flex flex-column justify-content-center align-items-center py-2">
            <h4 class="mb-0">8:30 PM</h4>
            <h4 class="mb-0">30/11/2022</h4>
          </div>
        </div>
        <div class="card card-dark mt-sm-3">
          <div class="card-header">
            <h5 class="mb-0">Estadísticas Generales</h5>
          </div>
          <div class="card-body p-2">
            <div class="row">
              <div class="col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>500</h3>
                    <p class="font-weight-bold mb-2">Total de Usuarios</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-users"></i>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>12k $</h3>
                    <p class="font-weight-bold mb-2">Total de Ingresos</p>
                  </div>
                  <div class="icon">
                    <i class="fas fa-money-bill"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h3 class="mb-0">Últimos cursos</h3>
          </div>
          <div class="card-body">
            <div class="courses-grid-admin">
              @forelse($courses as $course)
              <x-course.card :course="$course"/>
              @empty
              <div class="empty-container">
                <h2 class="empty">No hay cursos disponibles</h2>
              </div>
              @endforelse
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-header">
            <h3 class="mb-0">Últimos clubes</h3>
          </div>
          <div class="card-body">
            <div class="courses-grid-admin">
              @forelse($clubs as $club)
              <x-club.card :club="$club"/>
              @empty
              <div class="empty-container">
                <h2 class="empty">No hay clubs disponibles</h2>
              </div>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endis
</x-layout.main>