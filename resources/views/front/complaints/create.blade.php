<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Complaint | ABC Coffee Shop</title>
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

  <!-- Items -->
  <!-- <section class="wrapper flex flex-col gap-2.5">
    <div class="flex items-center justify-between">
      <p class="text-base font-bold">
        Items
      </p>
      <button type="button" class="p-2 bg-white rounded-full" data-expand="itemsList">
        <img src="{{ asset('assets/svgs/ic-chevron.svg') }}" class="transition-all duration-300 -rotate-180 size-5" alt="">
      </button>
    </div>
    @if ($errors->any())
    <ul>
      @foreach ($errors->all() as $error)
      <li class="py-5 px-5 bg-red-500 text-white rounded-full">
        {{ $error}}
      </li>
      @endforeach
    </ul>
    @endif
    <div class="flex flex-col gap-4" id="itemsList">
      @forelse ($order->details as $productCart)
      <div class="py-3.5 pl-4 pr-[22px] bg-white rounded-2xl flex gap-1 items-center relative cart-item"
        data-cart-id="{{ $productCart->id }}">
        <img src="{{ Storage::url($productCart->product->photo) }}"
          class="w-full max-w-[70px] max-h-[70px] object-contain" alt="">

        <div class="flex flex-wrap items-center justify-between w-full gap-1">
          <div class="flex flex-col gap-1">
            <a href="{{ route('front.product.details', $productCart->product->slug)}}"
              class="text-base font-semibold whitespace-nowrap w-[150px] truncate">
              {{ $productCart->product->name }}
            </a>
            <p class="text-sm text-grey product-price"
              data-price="{{ $productCart->product->price }}">
              Rp {{ number_format($productCart->product->price) }}
            </p>
          </div>

          <div class="flex flex-1 items-center justify-end gap-2">
            <p class="font-semibold text-sm quantity">{{ $productCart->qty }}</p>
            <p class="font-semibold text-sm text-red-500 quantity">pcs</p>
          </div>
        </div>
      </div>
      @empty
      <p>You don't have any product on the carts</p>
      @endforelse
    </div>
  </section> -->


  <!-- Payment Method -->
  <!-- <section class="wrapper flex flex-col gap-2.5">
    <div class="flex items-center justify-between">
      <p class="text-base font-bold">
        Payment Method
      </p>
    </div>
    <div class="grid items-center grid-cols-2 gap-4">
      <label
        class="relative rounded-2xl bg-white flex gap-2.5 px-3.5 py-3 items-center justify-start transition-all has-[.active]:ring-2 has-[.active]:ring-primary">
        <img src="{{ asset('assets/svgs/ic-receipt-text-filled.svg') }}" alt="">
        <p class="text-base font-semibold {{ $order->type === 'qris' ? 'active' : '' }}">
          QRIS
        </p>
      </label>
      <label
        class="relative rounded-2xl bg-white flex gap-2.5 px-3.5 py-3 items-center justify-start transition-all has-[.active]:ring-2 has-[.active]:ring-primary">
        <img src="{{ asset('assets/svgs/ic-card-filled.svg') }}" alt="">
        <p class="text-base font-semibold {{ $order->type === 'cash' ? 'active' : '' }}">
          Cash
        </p>
      </label>
    </div>
  </section> -->

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
            {{$order->code }}
          </p>
        </li>
      </ul>
      <hr>
      <form action="{{ route('store_complaint', $order) }}" method="post" enctype="multipart/form-data">
        @csrf
        <!-- title -->
        <div class="flex flex-col gap-2.5 mb-3">
          <label for="title" class="text-base font-semibold">Title</label>
          <input type="text" name="title" id="title__" class="form-input" autofocus />
        </div>
        <!-- Desc -->
        <div class=" flex flex-col gap-2.5 mb-3">
          <label for="description" class="text-base font-semibold">Add Decription</label>
          <span class="relative">
            <img src="{{ asset('assets/svgs/ic-edit.svg') }}" class="absolute size-5 top-4 left-4" alt="">
            <textarea name="description" id="decription__"
              class="form-input !rounded-2xl w-full min-h-[150px]" placeholder="Catatan khusus"></textarea>
          </span>
        </div>
        <!-- Attachment -->
        <div class="flex flex-col gap-2.5 mb-3">
          <label for="attachment" class="text-base font-semibold">Attachment</label>
          <input type="file" name="attachment"
            class="form-input bg-[url('{{ asset('assets/svgs/ic-folder-add.svg') }}')]">
        </div>
        <button type="submit" class="w-full items-center justify-center px-5 py-3 text-base font-bold text-white rounded-full bg-primary whitespace-nowrap">
          Submit
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