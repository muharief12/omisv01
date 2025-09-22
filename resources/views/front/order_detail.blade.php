<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Detail | Parma</title>
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
      Order Details
    </p>
  </section>

  <!-- Items -->
  <section class="wrapper flex flex-col gap-2.5">
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
  </section>

  <!-- Details Payment -->
  <section class="wrapper flex flex-col gap-2.5">
    <div class="flex items-center justify-between">
      <p class="text-base font-bold">
        Details Payment
      </p>
      <button type="button" class="p-2 bg-white rounded-full" data-expand="__detailsPayment">
        <img src="{{ asset('assets/svgs/ic-chevron.svg') }}" class="transition-all duration-300 -rotate-180 size-5" alt="">
      </button>
    </div>
    <div class="p-6 bg-white rounded-3xl" id="__detailsPayment">
      <ul class="flex flex-col gap-5">
        <li class="flex items-center justify-between">
          <p class="text-base font-semibold first:font-normal">
            Total
          </p>
          <p class="text-base font-semibold first:font-normal" id="checkout-subtotal">
            Rp {{ number_format($order->point * 1000)}}
          </p>
        </li>
        <li class="flex items-center justify-between">
          <p class="text-base font-semibold first:font-normal">
            PPN {{ $adminFee->tax }}%
          </p>
          <p class="text-base font-semibold first:font-normal" id="checkout-ppn">
            Rp {{ number_format($order->point * 1000 * $adminFee->tax / 100 )}}
          </p>
        </li>
        <li class="flex items-center justify-between">
          <p class="text-base font-semibold first:font-normal">
            Insurance {{ $adminFee->insurance }}%
          </p>
          <p class="text-base font-semibold first:font-normal" id="checkout-insurance">
            Rp {{ number_format($order->point * 1000 * $adminFee->insurance)}}
          </p>
        </li>
        <li class="flex items-center justify-between">
          <p class="text-base font-semibold first:font-normal">
            Delivery {{ $adminFee->delivery }}%
          </p>
          <p class="text-base font-semibold first:font-normal" id="checkout-delivery">
            Rp {{ number_format($order->point * 1000 * $adminFee->delivery)}}
          </p>
        </li>
        <li class="flex items-center justify-between">
          <p class="text-base font-bold first:font-normal">
            Grand Total
          </p>
          <p class="text-base font-bold first:font-normal text-primary" id="checkout-grand-total">
            Rp {{ number_format($order->total_amount)}}
          </p>
        </li>
      </ul>
    </div>
  </section>

  <!-- Payment Method -->
  <section class="wrapper flex flex-col gap-2.5">
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
  </section>

  <!-- Delivery to -->
  <section class="wrapper flex flex-col gap-2.5 pb-40">
    <div class="flex items-center justify-between">
      <p class="text-base font-bold">
        Delivery to
      </p>
      <button type="button" class="p-2 bg-white rounded-full" data-expand="deliveryForm">
        <img src="{{ asset('assets/svgs/ic-chevron.svg') }}" class="transition-all duration-300 -rotate-180 size-5" alt="">
      </button>
    </div>
    <div class="flex flex-col gap-5 p-6 bg-white rounded-3xl" id="deliveryForm">
      <!-- Address -->
      <div class="flex flex-col gap-2.5">
        <label for="address" class="text-base font-semibold">Address</label>
        <p type="text" name="address" id="address__" class="form-input bg-[url('{{ asset('assets/svgs/ic-location.svg') }}')]">{{ $order->address }}</p>
      </div>
      <!-- City -->
      <div class="flex flex-col gap-2.5">
        <label for="city" class="text-base font-semibold">City</label>
        <p type="text" name="city" id="city__" class="form-input bg-[url('{{ asset('assets/svgs/ic-map.svg') }}')]">{{ $order->city }}</p>
      </div>
      <!-- Post Code -->
      <div class="flex flex-col gap-2.5">
        <label for="postal_code" class="text-base font-semibold">Post Code</label>
        <p type="number" name="postal_code" id="postcode__"
          class="form-input bg-[url('{{ asset('assets/svgs/ic-house.svg') }}')]">{{ $order->postal_code }}</p>
      </div>
      <!-- Phone Number -->
      <div class=" flex flex-col gap-2.5">
        <label for="phone_number" class="text-base font-semibold">Phone Number</label>
        <p type="number" name="phone_number" id="phonenumber__"
          class="form-input bg-[url('{{ asset('assets/svgs/ic-phone.svg') }}')]">{{ $order->phone_number }}</p>
      </div>
      <!-- Add. Notes -->
      <div class=" flex flex-col gap-2.5">
        <label for="notes" class="text-base font-semibold">Add. Notes</label>
        <span class="relative">
          <img src="{{ asset('assets/svgs/ic-edit.svg') }}" class="absolute size-5 top-4 left-4" alt="">
          <p name="notes" id="notes__"
            class="form-input !rounded-2xl w-full min-h-[150px]" placeholder="Catatan khusus">{{ $order->notes ?? '-' }}</p>
        </span>
      </div>
      <!-- Proof of Payment -->
      <div class="flex flex-col gap-2.5">
        <label for="proof" class="text-base font-semibold">Proof of Payment</label>
        @if ($order->proof)
        <img src="{{ Storage::url($order->proof) }}" class="size-5" alt="">
        @endif
      </div>
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