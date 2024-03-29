@props(['options', 'selected' => null])

@php
  $required = $attributes->get('required');
@endphp
{{-- IMPROVE -> 1 --}}
<div class="mb-3">
  @if($required)
    <i class="mr-1 fas fa-asterisk text-danger"></i>
  @endif
  <label for="{{ $attributes->get('id') }}">{{ $slot }}</label>
  <select class="form-control" {{ $attributes }}>
    @unless($attributes->get('multiple'))
      <option value="" @unless($selected)selected @endunless>Seleccionar...</option>
    @endunless
    @foreach ($options as $value => $label)
      @php
        $isSelected = null;
        if (isset($selected)) {
          if($attributes->get('multiple') !== null) {
            $selected = collect($selected);
            $isSelected = $selected->contains((string) $value);
          } else {
            $isSelected = (string) $selected === (string) $value;
          }
        }
      @endphp
      <option value="{{ $value }}"@if($isSelected)selected @endif>{{ $label }}</option>
    @endforeach
  </select>
  @error($attributes->get('name'))
    <p class="text-danger">
      {{ ucfirst($message) }}
    </p>
  @enderror
  {{ $extra ?? '' }}
</div>