@props(['first' => false, 'pdfUrl' => null])

@php
  $id = $attributes->get('id');
  $isFinal = $id === 'finalStep';
  $calloutColor = $isFinal ? 'success' : 'primary';
  $buttonText = $isFinal ? 'Ir al listado de cursos' : 'Cancelar';
  $buttonColor = $isFinal ? 'secondary' : 'danger' ;
@endphp

<div {{ $attributes->class(['content', 'fade', 'initial' => $first]) }}>
  <div class="callout callout-{{ $calloutColor }}">
    {{ $slot }}
    <div class="d-flex justify-content-between align-items-center mt-3">
      <div>
        @if (!$first && !$isFinal)
          <x-button class="btn-outline" color="secondary" data-stepper="previous">
            Volver
          </x-button>
        @endif
        @if ($id === 'modeStep' || $id === 'typeStep')
          <x-button data-stepper="next" disabled id="{{ $id }}Next">
            Siguiente
          </x-button>
        @elseif ($id === 'confirmStep')
          <x-button disabled type="submit">
            Siguiente
          </x-button>
        @else
        <x-button :url="$pdfUrl" icon="file-download">
          Descargar Planilla de Inscripción
        </x-button>
        @endif
      </div>
      @can('role', 'Estudiante')
        <x-button :color="$buttonColor" :url="route('available-courses.index')">
          {{ $buttonText }}
        </x-button>
      @endcan
    </div>
  </div>
</div>