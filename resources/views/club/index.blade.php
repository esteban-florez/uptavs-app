<x-layout.main title="Club">
  <x-layout.bar>
    <x-search placeholder="Buscar club..." :value="$search" name="search" :action="route(Route::currentRouteName())">
      <x-slot name="hidden">
        @foreach ($filters as $filter => $value)
          <input type="hidden" name="filters|{{ $filter }}" value="{{ $value }}">
        @endforeach
        <input type="hidden" name="sort" value="{{ $sort }}">
      </x-slot>
    </x-search>
    <div>
      <x-button icon="plus" color="success" hide-text="sm" :url="route('club.create')">
        Añadir
      </x-button>
      <x-button icon="filter" hide-text="sm" data-target="#filtersCollapse" data-toggle="collapse">
        Filtros
      </x-button>
    </div>
    <x-slot name="filtersCollapse">
      <x-filters-collapse>
        <x-slot name="filters">
          <x-select :options="['' => 'Seleccionar...', 'mo' => 'Lunes', 'tu' => 'Martes', 'we' => 'Miércoles', 'Th' => 'Jueves', 'fr' => 'Viernes', 'sa' => 'Sábado', 'su' => 'Domingo']" id="day" name="filters|day" :selected="$filters['day'] ?? ''">
            Días:
          </x-select>
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
        <th>Día</th>
        <th>Hora de Inicio</th>
        <th>Hora de Cierre</th>
        <th>Acciones</th>
      </x-slot>
      <x-slot name="body">
        @forelse ($clubs as $club)
          <x-row :data="[
            $club->name,
            $club->instructor->full_name,
            $club->day,
            $club->start_hour,
            $club->end_hour,
            ]"
            :details="route('club.show', $club->id)"
            :edit="route('club.edit', $club->id)"
            :delete="route('club.destroy', $club->id)"
          />
        @empty
          <div class="empty-container">
            <h2 class="empty">No hay clubs disponibles</h2>
          </div>
        @endforelse
      </x-slot>
      <x-slot name="pagination">
        <div class="pagination-container">
          {{ $clubs->links() }}
        </div>
      </x-slot>
    </x-table>
  </section>
</x-layout.main>