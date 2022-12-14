<x-layout.main title="Matrícula">
  @push('css')
    <link rel="stylesheet" href="{{ asset('css/listados.css') }}">
  @endpush
  {{-- TODO -> comentado hasta que funcione. Por ahora no se pudo búsqueda, pero sería bueno --}}
  {{-- <x-layout.bar>
    <x-search :action="route(Route::currentRouteName())" placeholder="Buscar estudiantes..." :value="$search">
      <x-slot name="hidden">
        <input type="hidden" name="course" value="{{ $course->id }}">
      </x-slot>
    </x-search>
  </x-layout.bar> --}}
  <section class="content">
    <div class="container-fluid">
      <div class="card py-2 px-3 mb-0 list-top">
        <x-inscribed.header :course="$course" :inscriptions="$inscriptions"/>
      </div>
      <div class="card list-bottom">
        @if($course->status === 'Pre-inscripciones' || $inscriptions->total() === 0)
          <div class="alert alert-info mx-3 mt-3 d-flex align-items-center gap-2">
            <i class="fas fa-info-circle"></i>
            <p class="h5 m-0">Este curso aún no posee estudiantes matriculados.</p>
          </div>
        @else
          <x-inscribed.table :course="$course" :inscriptions="$inscriptions"/>
        @endif
      </div>
    </div>
  </section>
</x-layout.main>