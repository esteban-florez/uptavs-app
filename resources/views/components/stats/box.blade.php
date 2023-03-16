@props(['title', 'content', 'color'])

<div class="info-box">
  <span class="info-box-icon bg-{{ $color }} elevation-1">
    <i class="fas fa-users"></i>
  </span>
  <div class="info-box-content">
    <span class="info-box-text h5 text-{{ $color }}">{{ $title }}</span>
    <span class="info-box-number h5">
      {{ $content }}
    </span>
  </div>  
</div> 