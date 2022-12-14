@props(['action', 'areas', 'instructors', 'pnfs', 'edit' => false, 'course' => null])

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
  @if ($edit)
    @method('PUT')
  @endif
  @csrf
  <div class="row d-flex align-items-center">
    <div class="col-sm-6 col-md-4 mb-3">
      <x-image-input :image="$course->image ?? null" :required="!$edit"/>
    </div>
    <div class="col-sm-6 col-md-8">
      <x-field name="name" id="name" placeholder="Nombre del Curso" autocomplete="off" :value="old('name') ?? $course->name ?? ''" required>
        Nombre:
      </x-field>
      <x-select name="instructor_id" id="instructorId" :options="$instructors" :selected="old('instructor_id') ?? $course->instructor_id ?? ''" required>
        Instructores:
      </x-select>
      <x-select name="area_id" id="areaId" :options="$areas" :selected="old('area_id') ?? $course->area_id ?? ''" required>
        Área de Formación:
        <x-slot name="extra">
          <a class="mt-1 ml-1" href="#" data-toggle="modal" data-target="#newAreaModal">Crear nueva área de formación</a>
        </x-slot>
      </x-select>
    </div>
    <div class="col-12 col-sm-6 mb-3">
      <label class="form-label" for="totalPrice"><i class="fas fa-asterisk text-danger mr-1"></i>Monto Total:</label>
      <div class="input-group flex-nowrap">
        <input autocomplete="off" class="form-control" type="number" id="totalPrice" name="total_price" placeholder="Ej. 45" value="{{ old('total_price') ?? $course->total_price ?? '' }}" required/>
        <div class="input-group-append">
          <span class="input-group-text" id="basic-addon1">$</span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 mb-3">
      <label class="form-label" for="reservPrice"><i class="fas fa-asterisk text-danger mr-1"></i>Monto de Reservación:</label>
      {{-- TODO -> quitar required cuando el monto sea opcional en el futuro --}}
      <div class="input-group flex-nowrap">
        <input class="form-control w-50" type="number" id="reservPrice" name="reserv_price" placeholder="Ej. 5" value="{{ old('reserv_price') ?? $course->reserv_price ?? '' }}" required/>
        <div class="input-group-append">
          <span class="input-group-text" id="basic-addon1">$</span>
        </div>
      </div>
    </div>
    <div class="col-12">
      <x-textarea name="description" id="description" rows="2" maxlength="2000" placeholder="Descripción del curso" :content="old('description') ?? $course->description ?? ''" required>
        Descripción del curso:
      </x-textarea>
    </div>
    <div class="col-sm-6">
      <x-field type="date" name="start_ins" id="startIns" value="{{ old('start_ins') ?? $course->start_ins ?? '' }}" required>
        Incio de Inscripciones:
      </x-field>
    </div>
    <div class="col-sm-6">
      <x-field type="date" name="end_ins" id="endIns" value="{{ old('end_ins') ?? $course->end_ins ?? '' }}" required>
        Fin de Inscripciones:
      </x-field>
    </div>
    <div class="col-sm-6">
      <x-field type="date" name="start_course" value="{{ old('start_course') ?? $course->start_course ?? '' }}" id="startCourse" required>
        Incio de Curso:
      </x-field>
    </div>
    <div class="col-sm-6">
      <x-field type="date" name="end_course" value="{{ old('end_course') ?? $course->end_course ?? '' }}" id="endCourse" required>
        Fin de Curso:
      </x-field>
    </div>
    <div class="col-sm-6 mb-3">
      <label class="form-label" for="duration">Duración del curso:</label>
      <div class="input-group">
        <input autocomplete="off" class="form-control" type="number" name="duration" id="duration" placeholder="Ej. 80" value="{{ old('duration') ?? $course->duration ?? '' }}" required/>
        <div class="input-group-append">
          <span class="input-group-text">horas</span>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <x-field type="number" name="student_limit" id="studentLimit" placeholder="Ej. 15" value="{{ old('student_limit') ?? $course->student_limit ?? '' }}" required>
        Máx. de Estudiantes:
      </x-field>
    </div>
    <div class="col-sm-4">
      <x-select name="days[]" id="days" :options="week()" :selected="old('days') ?? $course->days_arr ?? ''" default multiple required>
        Días de clases:
      </x-select>
    </div>
    <div class="col-sm-4">
      <x-field type="time" name="start_time" id="startTime" value="{{ old('start_time') ?? $course->start_time ?? '' }}" required>
        Hora de Inicio:
      </x-field>
    </div>
    <div class="col-sm-4">
      <x-field type="time" name="end_time" id="endTime" value="{{ old('end_time') ?? $course->end_time ?? '' }}" required>
        Hora de Cierre:
      </x-field>
    </div>
  </div>
  <div class="d-flex justify-content-between align-items-center">
    <x-button url="{{ route('courses.index') }}" color="danger" icon="times">
      Cancelar
    </x-button>
    <x-button type="submit" color="success" icon="check">
      Aceptar
    </x-button>
  </div>
</form>
<x-area.new id="newAreaModal" :pnfs="$pnfs"/>