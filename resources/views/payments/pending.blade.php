<x-layout.main title="Pagos por verificar">
  @push('js')
    <script defer type="module" src="{{ asset('js/payments/editPayment.js') }}"></script>
  @endpush
  @push('css')
    <link rel="stylesheet" href="{{ asset('css/pagos.css') }}">
  @endpush
  <section class="container-fluid pt-2">
    <div class="payments-grid">
      @foreach ($payments as $payment)
        <x-payment.card :payment="$payment" />
      @endforeach
    </div>
  </section>
</x-layout.main>