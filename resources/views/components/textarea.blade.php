@props(['content' => ''])

<div class="mb-3">
  @if($attributes->get('required'))
  <i class="mr-1 fas fa-asterisk text-danger"></i>
  @endif
  <label for="{{ $attributes->get('id') }}">{{ $slot }}</label>
  <textarea autocomplete="off" class="form-control" {{ $attributes }}>{{ $content }}</textarea>
  @error($attributes->get('name'))
  <p class="text-danger">{{$message}}</p>
  @enderror
</div>