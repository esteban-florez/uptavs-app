<x-layout.main title="Cursos dictados">
  <x-slot name="breadcrumbs">
    {{ Breadcrumbs::render('users.courses.index', $user) }}
  </x-slot>
  <x-layout.bar>
    <x-search name="search" placeholder="Buscar curso..." value="{{ $search }}"/>
  </x-layout.bar>
  <div class="container-fluid px-2">
    @if ($courses->isNotEmpty())
      <div class="row px-sm-5" style="row-gap: 1rem;">
        @foreach ($courses as $course)
          <div class="col-md-6">
            <x-course.alt-card :course="$course">
              <p class="mb-0">Nro de Estudiantes: <b>{{ $course->student_diff }}</b></p>
              <p class="mb-0">Inscripciones: <b>{{ $course->ins_date }}</b></p>
              <p>Fecha de clases: <b>{{ $course->date }}</b></p>
              <x-button :url="route('courses.show', $course->id)" icon="list-ul">
                Detalles
              </x-button>
              @can('update', $course)
                <x-button color="warning" :url="route('courses.edit', $course)" icon="edit">
                  Editar
                </x-button>
              @endcan
              @can('viewAny', [App\Models\Enrollment::class, $course])
                <x-button color="secondary" :url="route('enrollments.index', ['course' => $course])" icon="clipboard-list">
                  Matrícula
                </x-button>
              @endcan
            </x-course.alt-card>
          </div>
        @endforeach
      </div>
    @else
      <div class="empty-container">
        <div class="empty">No estas dictando cursos actualmente.</div>
      </div>
    @endif
  </div>
</x-layout.main>