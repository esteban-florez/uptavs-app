<x-layout.main title="Club">
  <section class="container-fluid">
    <x-table>
      <x-slot name="header">
        <th>ID</th>
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
            $club->id,
            $club->name,
            $club->instructor_id,
            $club->day,
            $club->start_hour,
            $club->end_hour,
            ]"
          />
        @empty
          <div class="empty-container">
            <h2 class="empty">No hay clubs disponibles</h2>
          </div>
        @endforelse
      </x-slot>
      <x-slot name="pagination">
        <div class="pagination-container">
          
        </div>
      </x-slot>
    </x-table>

    <!-- @if ($clubs!=null)
      <div class="container-fluid">
        <div class="row">
           <div class="col-12">
            <div class="card">
              <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-hover text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Instructor</th>
                      <th>Miembros</th>
                      <th>Día</th>
                      <th>Hora de Inicio</th>
                      <th>Hora de Cierre</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($clubs as $club)
                    <tr>
                      <td>{{ $club->id }}</td>
                      <td>{{ $club->name }}</td>
                      <td>{{ $club->description }}</td>
                      <td>{{ $club->image }}</td>
                      <td>{{ $club->day }}</td>
                      <td>{{ $club->start_hour }}</td>
                      <td>{{ $club->end_hour }}</td>
                      <td>{{ $club->instructor_id }}</td>
                      <td>
                        <a class="btn btn-primary btn-sm" href="#">Detalles</a>
                        <a class="btn btn-secondary btn-sm" href="#">Editar</a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
                <div class="card-footer">
                  <ul class="pagination pagination-sm m-0 d-flex justify-content-center">
                    <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                  </ul>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @else
      <div class="contenedor">
        <h2 class="coursent">No hay clubs disponibles</h2>
      </div>
    @endif   -->
  </section>
</x-layout.main>