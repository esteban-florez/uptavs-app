@php
  $course = $payment->enrollment->course;
  $user = Auth::user();
@endphp

<x-layout.main title="Editar pago">
  <x-select2/>
  <x-slot name="breadcrumbs">
    {{ Breadcrumbs::render('payments.edit', $payment) }}
  </x-slot>
  @push('js')
    <script defer src="{{ asset('js/ref-input.js') }}"></script>
  @endpush
  <section class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="card my-2">
          <div class="card-body">
            @can('update', $user, [App\Models\Payment::class, $payment])
              <form method="POST" action="{{ route('payments.update', $payment) }}">
                @csrf
                @method('PUT')
                <h4>
                  Curso: <a class="text-bold" href="{{ route('courses.show', $course) }}">{{ $course->name }}</a>
                </h4>
                <div class="d-flex">
                  <x-payment.status :payment="$payment"/>
                  <p class="ml-5 mb-0">Categoría: <b>{{ $payment->category }}</b></p>
                </div>
                <hr>
                <x-select name="type" :options="payTypes()->pairs()" :selected="old('type') ?? $payment->type">
                  Tipo de pago:
                </x-select>
                <x-input-group name="amount" type="number" step="0.01" :value="old('amount') ?? $payment->amount" maxlength="10" validNumber>
                  Monto:
                  <x-slot name="append">
                    <span class="input-group-text">--</span>
                  </x-slot>
                </x-input-group>
                <x-field name="ref" type="number" :value="old('ref') ?? $payment->ref" minlength="4" maxlength="10" validNumber>
                  Referencia:
                </x-field>
                <div class="d-flex gap-2">
                  @can('users.payments.viewAny', $user)
                    <x-button color="secondary" icon="arrow-left" :url="route('users.payments.index', auth()->user())">
                      Volver
                    </x-button>
                  @endcan
                  <x-button color="success" icon="check" type="submit">
                    Aceptar
                  </x-button>
                </div>
              </form>
            @endcan
          </div>
        </div>
      </div>
    </div>
  </section>
</x-layout.main>