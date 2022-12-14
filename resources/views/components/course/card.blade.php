@props(['course', 'last' => false])

<div class="card{{$last ? '' : ' mb-0'}}">
  <div class="row no-gutters">
    <div class="col-sm-5">
      <img class="w-100" src="{{ $course->image }}" alt="Imagen del curso">
    </div>
    <div class="col-sm-7 d-flex align-items-center">
      <div class="card-body">
        <h5 class="mb-2">{{ $course->name }}</h5>
        <p class="card-text">{{ $course->excerpt }}</p>
        <div class="d-flex justify-content-between align-items-center">
          <x-button url="{{ route('market.show', $course->id) }}">Detalles</x-button>
          <h4 class="text-success mb-0">{{ $course->total_price }} $</h4>
        </div>
      </div>
    </div>
  </div>
</div>