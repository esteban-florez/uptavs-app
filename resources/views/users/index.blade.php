<x-layout.main title="Usuarios">
  <x-layout.bar>
    <x-search placeholder="Buscar usuario..." :value="$search" name="search" :action="route(Route::currentRouteName())">
      <x-slot name="hidden">
        @foreach ($filters as $filter => $value)
          <input type="hidden" name="filters|{{ $filter }}" value="{{ $value }}">
        @endforeach
        <input type="hidden" name="sort" value="{{ $sort }}">
      </x-slot>
    </x-search>
    <div>
      <x-button icon="plus" color="success" hide-text="sm" :url="route('users.create')">Añadir</x-button>
      <x-button icon="filter" hide-text="sm" data-target="#filtersCollapse" data-toggle="collapse">Filtros</x-button>
    </div>
    <x-slot name="filtersCollapse">
      <x-filters-collapse>
        <x-slot name="filters">
          <x-select :options="['true' => 'Sí', 'false' => 'No']" id="isUpta" name="filters|is_upta" :selected="$filters['is_upta'] ?? null">
            ¿UPTA?
          </x-select>
        </x-slot>
        <x-slot name="sorts">
          <x-radio :options="['date' => 'Fecha', 'first_name' => 'Nombre', 'ci' => 'Cédula']" name="sort" :checked="$sort" notitle first-empty/>
        </x-slot>
      </x-filters-collapse>
    </x-slot>
  </x-layout.bar>
  <section class="container-fluid">
    <x-alerts type="success" icon="user-plus"/>
    <x-alerts type="warning" icon="user-edit"/>
    <x-alerts type="danger" icon="user-minus"/>
    @if ($users)
      <x-table>
        <x-slot name="header">
          <th>Nombre</th>
          <th>Cédula</th>
          <th>Teléfono</th>
          <th>Correo</th>
          <th>¿UPTA?</th>
          <th>Acciones</th>
        </x-slot>
        <x-slot name="body">
          @foreach ($users as $user)
            <x-row :data="[
              $user->full_name,
              $user->full_ci,
              $user->tel,
              $user->email,
              $user->upta,
              ]"
              :details="route('users.show', $user->id)"
            />
          @endforeach
        </x-slot>
        <x-slot name="pagination">
          <div class="pagination-container">
            {{ $users->links() }}
          </div>
        </x-slot>
      </x-table>
    @else
      <div class="empty-container">
        <h2 class="empty">No hay usuarios registrados</h2>
      </div>
    @endif
  </section>
</x-layout.main>