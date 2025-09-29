<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Complaint | ABC Coffee Shop</title>
  <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <!-- Topbar -->
  <section class="relative flex items-center justify-between w-full gap-5 wrapper">
    <a href="{{ url('/orders')}}" class="p-2 bg-white rounded-full">
      <img src="{{ asset('assets/svgs/ic-arrow-left.svg') }}" class="size-5" alt="">
    </a>
    <p class="absolute text-base font-semibold translate-x-1/2 -translate-y-1/2 top-1/2 right-1/2">
      Order Complaint
    </p>
  </section>

  <!-- Delivery to -->
  <section class="wrapper flex flex-col gap-2.5 pb-40">
    @if ($errors->any())
    <ul>
      @foreach ($errors->all() as $error)
      <li class="py-5 px-5 bg-red-500 text-white rounded-full">
        {{ $error}}
      </li>
      @endforeach
    </ul>
    @endif
    <div class="flex items-center justify-between">
      <p class="text-base font-bold">
        Complaint Details
      </p>
      <button type="button" class="p-2 bg-white rounded-full" data-expand="deliveryForm">
        <img src="{{ asset('assets/svgs/ic-chevron.svg') }}" class="transition-all duration-300 -rotate-180 size-5" alt="">
      </button>
    </div>
    <div class="flex flex-col gap-5 p-6 bg-white rounded-3xl" id="deliveryForm">
      <ul class="flex flex-col gap-5">
        <li class="flex items-center justify-between">
          <p class="text-base font-semibold first:font-normal">
            Order Code
          </p>
          <p class="text-base font-semibold first:font-normal" id="checkout-subtotal">
            {{$complaint->order->code }}
          </p>
        </li>
        <li class="flex items-center justify-between">
          <p class="text-base font-semibold first:font-normal">
            Status
          </p>
          @if ($complaint->status === 'submission')
          <span class="inline-flex items-center rounded-md bg-red-400/10 px-2 py-1 text-xs font-medium text-red-500 inset-ring inset-ring-red-400/20">{{ $complaint->status}}</span>
          @elseif ($complaint->status === 'process')
          <span class="inline-flex items-center rounded-md bg-blue-400/10 px-2 py-1 text-xs font-medium text-blue-400 inset-ring inset-ring-blue-500/20">{{ $complaint->status}}</span>
          @else
          <span class="inline-flex items-center rounded-md bg-green-400/10 px-2 py-1 text-xs font-medium text-green-400 inset-ring inset-ring-green-500/20">{{ $complaint->status}}</span>
          @endif
        </li>
      </ul>
      <hr>
      <!-- title -->
      <div class="flex flex-col gap-2.5 mb-3">
        <label for="title" class="text-base font-semibold">Title</label>
        <p type="text" name="title" value="{{ $complaint->title }}" id="title__" class="form-input" autofocus>{{ $complaint->title }}</p>
      </div>
      <!-- Desc -->
      <div class=" flex flex-col gap-2.5 mb-3">
        <label for="description" class="text-base font-semibold">Add Decription</label>
        <span class="relative">
          <img src="{{ asset('assets/svgs/ic-edit.svg') }}" class="absolute size-5 top-4 left-4" alt="">
          <textarea name="description" id="decription__"
            class="form-input !rounded-2xl w-full min-h-[150px]" placeholder="Catatan khusus">{{ $complaint->description }}</textarea>
        </span>
      </div>
      <!-- Attachment -->
      <div class="flex flex-col gap-2.5 mb-3">
        <label for="attachment" class="text-base font-semibold">Attachment</label>
        <input type="file" name="attachment"
          class="form-input bg-[url('{{ asset('assets/svgs/ic-folder-add.svg') }}')]">
        @if ($complaint->attachment)
        <img src="{{ Storage::url($complaint->attachment) }}" class="size-5" alt="">
        @endif
      </div>
      <form action="{{ route('destroy_complaint', $complaint->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="w-full items-center justify-center px-5 py-3 text-base font-bold text-white rounded-full bg-primary whitespace-nowrap">
          Canceled
        </button>
      </form>
    </div>
    </div>
  </section>

  </section>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="{{ asset('scripts/global.js') }}"></script>
  <!-- <script>
    function calculatePrice() {
      let total = 0;
      let deliveryPct = {
        {
          $adminFee - > delivery
        }
      };
      let taxPct = {
        {
          $adminFee - > tax
        }
      };
      let insurancePct = {
        {
          $adminFee - > insurance
        }
      };

      document.querySelectorAll('.product-price').forEach(item => {
        total += parseFloat(item.getAttribute('data-price'));
      });

      document.getElementById('checkout-subtotal').textContent = 'Rp ' + subTotal.toLocaleString('id', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });

      const delivery = deliveryPct / 100 * subTotal;
      document.getElementById('checkout-delivery').textContent = 'Rp ' + delivery.toLocaleString('id', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });

      const tax = taxPct / 100 * subTotal;
      document.getElementById('checkout-ppn').textContent = 'Rp ' + tax.toLocaleString('id', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });

      const insurance = insurancePct / 100 * subTotal;
      document.getElementById('checkout-insurance').textContent = 'Rp ' + insurance.toLocaleString('id', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });

      const grandTotal = subTotal + delivery + tax + insurance;
      document.getElementById('checkout-grand-total').textContent = 'Rp ' + grandTotal.toLocaleString('id', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });
      document.getElementById('checkout-grand-total-price').textContent = 'Rp ' + grandTotal.toLocaleString('id', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
      });
    }

    document.addEventListener('DOMContentLoaded', function() {
      calculatePrice();
    });
  </script> -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.cart-item').forEach(function(item) {
        const addBtn = item.querySelector('.add-quantity');
        const removeBtn = item.querySelector('.remove-quantity');
        const qtyEl = item.querySelector('.quantity');
        const qtyInput = item.querySelector('.quantity_input');
        const form = item.querySelector('.qty-form');

        addBtn.addEventListener('click', function() {
          let qty = parseInt(qtyInput.value);
          qty++;
          qtyInput.value = qty;
          qtyEl.textContent = qty;
          form.submit();
        });

        removeBtn.addEventListener('click', function() {
          let qty = parseInt(qtyInput.value);
          if (qty > 1) {
            qty--;
            qtyInput.value = qty;
            qtyEl.textContent = qty;
            form.submit();
          }
        });
      });
    });
  </script>


</body>

</html>