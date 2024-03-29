<x-layout.main title="Registrar usuario">
  <x-slot name="breadcrumbs">
    {{ Breadcrumbs::render('users.create') }}
  </x-slot>
  @push('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
  @endpush
  <section class="container-fluid pb-1">
    <div class="card px-3 pt-2 pb-3">
      @can('create', App\Models\User::class)
        <x-user-form 
          :areas="$areas"
          :action="route('users.store')"
          :pnfs="$pnfs"
          :role="$defaultRole"
        />
      @endcan
    </div>
  </section>
</x-layout.main>