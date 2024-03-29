@props(['club', 'body' => null])

<div class="card">
  <div class="row no-gutters">
    <div class="col-sm-5">
      <img  
        class="w-100 img-cover"
        src="{{ asset($club->image) }}"
        alt="Imagen del Club: {{$club->name }}"
        style="height: 12.5rem;">
    </div>
    <div class="col-sm-7 d-flex align-items-center">
      <div class="card-body">
        <h4>{{ $club->name }}</h4>
        <p class="card-text">{{ $club->excerpt }}</p>
        <div class="d-flex justify-content-between align-items-center">
          <x-button url="{{ route('clubs.show', $club) }}">Detalles</x-button>
        </div>
      </div>
    </div>
  </div>
</div>