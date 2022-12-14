<x-layout.main title="Cursos">
  @push('css')
    <link rel="stylesheet" href="{{ asset('css/cursos.css') }}">
  @endpush
  <x-layout.bar>
    <x-search placeholder="Buscar curso..." :value="$search" name="search" :action="route(Route::currentRouteName())">
      <x-slot name="hidden">
        @foreach ($filters as $filter => $value)
          <input type="hidden" name="filters|{{ $filter }}" value="{{ $value }}">
        @endforeach
        <input type="hidden" name="sort" value="{{ $sort }}">
      </x-slot>
    </x-search>
    <div>
      <x-button icon="plus" color="success" hide-text="sm" :url="route('courses.create')">
        Añadir
      </x-button>
      <x-button icon="filter" hide-text="sm" data-target="#filtersCollapse" data-toggle="collapse">
        Filtros
      </x-button>
    </div>
    <x-slot name="filtersCollapse">
      <x-filters-collapse>
        <x-slot name="filters">
          <x-select :options="$areas" id="areaId" name="filters|area_id" :selected="$filters['area_id'] ?? ''">
            Área de Formación
          </x-select>
        </x-slot>
        <x-slot name="sorts">
          <x-radio :options="['' => 'Fecha de creación', 'name' => 'Nombre', 'total_price' => 'Monto', 'duration' => 'Duración']" name="sort" :checked="$sort" notitle/>
        </x-slot>
      </x-filters-collapse>
    </x-slot>
  </x-layout.bar>
  <section class="container-fluid">
    <x-alerts type="success" icon="plus-circle"/>
    <x-alerts type="warning" icon="edit"/>
    <x-alerts type="danger" icon="times-circle"/>
    <x-table>
      <x-slot name="header">
        <th>Nombre</th>
        <th>Instructor</th>
        <th>Inscripciones</th>
        <th>Fecha</th>
        <th>Duración</th>
        <th>Matrícula</th>
        <th>Monto</th>
        <th>Estado</th>
        <th>Acciones</th>
      </x-slot>
      <x-slot name="body">
        @forelse ($courses as $course)
          <x-row :data="[
            $course->name,
            $course->instructor->full_name,
            $course->start_ins . ' al ' . $course->end_ins,
            $course->start_course . ' al ' . $course->end_course,
            $course->duration_hours,
            $course->student_diff,
            $course->total_price . ' $',
            $course->status,
            ]"
            :details="route('courses.show', $course->id)"
            :edit="route('courses.edit', $course->id)"
            :delete="route('courses.destroy', $course->id)"
          >
          <x-slot name="extraActions">
            <x-button class="btn-sm" color="secondary" :url="route('inscriptions.index', ['course' => $course->id])" icon="clipboard-list">
              Matrícula
            </x-button>
          </x-slot>
        </x-row>
        @empty
          <div class="empty-container">
            <h2 class="empty">No hay cursos disponibles</h2>
          </div>
        @endforelse
        </x-slot>
        <x-slot name="pagination">
          <div class="pagination-container">
            {{ $courses->links() }}
          </div>
        </x-slot>
      </x-table>
  </section>
</x-layout.main>