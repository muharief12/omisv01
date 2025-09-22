<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart | Parma</title>
  <link rel="shortcut icon" href="{{ asset('assets/svgs/logo-mark.svg') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <!-- Topbar -->
  <section class="relative flex items-center justify-between w-full gap-5 wrapper">
    <a href="{{ url('/')}}" class="p-2 bg-white rounded-full">
      <img src="{{ asset('assets/svgs/ic-arrow-left.svg') }}" class="size-5" alt="">
    </a>
    <p class="absolute text-base font-semibold translate-x-1/2 -translate-y-1/2 top-1/2 right-1/2">
      Shopping Carts
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
      <!-- Softovac Rami -->
      <!-- @forelse ($productCarts as $productCart)
      <div class="py-3.5 pl-4 pr-[22px] bg-white rounded-2xl flex gap-1 items-center relative cart-item">
        <img src="{{ Storage::url($productCart->product->photo) }}" class="w-full max-w-[70px] max-h-[70px] object-contain"
          alt="">
        <div class="flex flex-wrap items-center justify-between w-full gap-1">
          <div class="flex flex-col gap-1">
            <a href="{{ route('front.product.details', $productCart->product->slug)}}"
              class="text-base font-semibold whitespace-nowrap w-[150px] truncate">
              {{ $productCart->product->name }}
            </a>
            <p class="text-sm text-grey product-price" data-price="{{ $productCart->product->price }}">
              Rp {{ number_format($productCart->product->price) }}
            </p>
          </div>
          <div class="flex flex-1 items-center justify-end gap-2">
            <form action="{{ route('carts.updateQty', $productCart->id) }}" method="POST" class="flex flex-1 items-center justify-end gap-2 qty-form">
              @csrf
              <button type="submit" id="remove-quantity" class="remove-quantity">
                <img src="assets/svgs/minus-square.svg" alt="icon">
              </button>
              <p id="quantity" class="font-semibold text-sm quantity">{{ $productCart->qty }}</p>
              <input type="hidden" name="qty" id="quantity_input" value="{{ $productCart->qty }}" />
              <button type="submit" id="add-quantity" class="add-quantity">
                <img src="assets/svgs/add-square.svg" alt="icon">
              </button>
            </form>
          </div>
          <form action="{{ route('carts.destroy', $productCart->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit">
              <img src="{{ asset('assets/svgs/ic-trash-can-filled.svg') }}" class="size-[30px]" alt="">
            </button>
          </form>
        </div>
      </div>
      @empty
      <p>Your don't have any product on the carts</p>
      @endforelse -->
      @forelse ($productCarts as $productCart)
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
            <form action="{{ route('carts.updateQty', $productCart->id) }}"
              method="POST"
              class="flex flex-1 items-center justify-end gap-2 qty-form">
              @csrf
              <button type="button" class="remove-quantity">
                <img src="{{ asset('assets/svgs/minus-square.svg') }}" alt="icon">
              </button>
              <p class="font-semibold text-sm quantity">{{ $productCart->qty }}</p>
              <input type="hidden" name="qty" class="quantity_input" value="{{ $productCart->qty }}" />
              <button type="button" class="add-quantity">
                <img src="{{ asset('assets/svgs/add-square.svg') }}" alt="icon">
              </button>
            </form>
          </div>

          <form action="{{ route('carts.destroy', $productCart->id)}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit">
              <img src="{{ asset('assets/svgs/ic-trash-can-filled.svg') }}" class="size-[30px]" alt="">
            </button>
          </form>
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
            Rp {{ number_format($totalPrice)}}
          </p>
        </li>
        <li class="flex items-center justify-between">
          <p class="text-base font-semibold first:font-normal">
            PPN {{ $adminFee->tax }}%
          </p>
          <p class="text-base font-semibold first:font-normal" id="checkout-ppn">
            Rp {{ number_format($ppn)}}
          </p>
        </li>
        <li class="flex items-center justify-between">
          <p class="text-base font-semibold first:font-normal">
            Insurance {{ $adminFee->insurance }}%
          </p>
          <p class="text-base font-semibold first:font-normal" id="checkout-insurance">
            Rp {{ number_format($insurance)}}
          </p>
        </li>
        <li class="flex items-center justify-between">
          <p class="text-base font-semibold first:font-normal">
            Delivery {{ $adminFee->delivery }}%
          </p>
          <p class="text-base font-semibold first:font-normal" id="checkout-delivery">
            Rp {{ number_format($delivery)}}
          </p>
        </li>
        <li class="flex items-center justify-between">
          <p class="text-base font-bold first:font-normal">
            Grand Total
          </p>
          <p class="text-base font-bold first:font-normal text-primary" id="checkout-grand-total">
            Rp {{ number_format($grandTotal)}}
          </p>
        </li>
      </ul>
    </div>
  </section>

  <form action="{{ route('product_transactions.store')}}" method="POST" enctype="multipart/form-data" class="">
    @csrf
    <!-- Payment Method -->
    <section class="wrapper flex flex-col gap-2.5">
      <div class="flex items-center justify-between">
        <p class="text-base font-bold">
          Payment Method
        </p>
      </div>
      <div class="grid items-center grid-cols-2 gap-4">
        <label
          class="relative rounded-2xl bg-white flex gap-2.5 px-3.5 py-3 items-center justify-start has-[:checked]:ring-2 has-[:checked]:ring-primary transition-all">
          <input type="radio" name="type" value="qris" id="QRISMethod" class="absolute opacity-0" checked>
          <img src="{{ asset('assets/svgs/ic-receipt-text-filled.svg') }}" alt="">
          <p class="text-base font-semibold">
            QRIS
          </p>
        </label>
        <label
          class="relative rounded-2xl bg-white flex gap-2.5 px-3.5 py-3 items-center justify-start has-[:checked]:ring-2 has-[:checked]:ring-primary transition-all">
          <input type="radio" name="type" value="cash" id="cashMethod" class="absolute opacity-0">
          <img src="{{ asset('assets/svgs/ic-card-filled.svg') }}" alt="">
          <p class="text-base font-semibold">
            Cash
          </p>
          </lab>
      </div>
      <div class="p-4 mt-0.5 bg-white rounded-3xl" id="QRISPaymentDetail">
        <div class="flex flex-col gap-5">
          <p class="text-base font-bold">
            Send Payment to
          </p>
          <div class="inline-flex items-center gap-2.5">
            <img src="{{ asset('assets/svgs/ic-bank.svg') }}" class="size-5" alt="">
            <p class="text-base font-semibold">
              QRIS AN. ABC Coffee Shop
            </p>
          </div>
          <div class="inline-flex items-center gap-2.5">
            <img src="{{ asset('assets/svgs/ic-security-card.svg') }}" class="size-5" alt="">
            <p class="text-base font-semibold">
              085800288265
            </p>
          </div>
          <div class="inline-flex items-center gap-2.5">
            <img src="{{ asset('assets/images/qris.png') }}" class="text-center w-full p-3 border" alt="">
          </div>
        </div>
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
          <input type="text" name="address" id="address__"
            class="form-input bg-[url('{{ asset('assets/svgs/ic-location.svg') }}')]" value="{{ Auth::user()->address }}">
        </div>
        <!-- City -->
        <div class="flex flex-col gap-2.5">
          <label for="city" class="text-base font-semibold">City</label>
          <input type="text" name="city" id="city__" class="form-input bg-[url('{{ asset('assets/svgs/ic-map.svg') }}')]"
            value="{{ Auth::user()->city }}">
        </div>
        <!-- Post Code -->
        <div class="flex flex-col gap-2.5">
          <label for="postal_code" class="text-base font-semibold">Post Code</label>
          <input type="number" name="postal_code" id="postcode__"
            class="form-input bg-[url('{{ asset('assets/svgs/ic-house.svg') }}')]" value="{{ Auth::user()->postal_code }}">
        </div>
        <!-- Phone Number -->
        <div class="flex flex-col gap-2.5">
          <label for="phone_number" class="text-base font-semibold">Phone Number</label>
          <input type="number" name="phone_number" id="phonenumber__"
            class="form-input bg-[url('{{ asset('assets/svgs/ic-phone.svg') }}')]" value="{{ Auth::user()->phone_number }}">
        </div>
        <!-- Add. Notes -->
        <div class="flex flex-col gap-2.5">
          <label for="notes" class="text-base font-semibold">Add. Notes</label>
          <span class="relative">
            <img src="{{ asset('assets/svgs/ic-edit.svg') }}" class="absolute size-5 top-4 left-4" alt="">
            <textarea name="notes" id="notes__"
              class="form-input !rounded-2xl w-full min-h-[150px]" placeholder="Catatan khusus"></textarea>
          </span>
        </div>
        <!-- Proof of Payment -->
        <div class="flex flex-col gap-2.5">
          <label for="proof" class="text-base font-semibold">Proof of Payment</label>
          <input type="file" name="proof" id="proof_of_payment__"
            class="form-input bg-[url('{{ asset('assets/svgs/ic-folder-add.svg') }}')]">
        </div>
      </div>
      </div>
    </section>

    <!-- Floating grand total -->
    <div class="fixed z-50 bottom-[30px] bg-black rounded-3xl p-5 left-1/2 -translate-x-1/2 w-[calc(100dvw-32px)] max-w-[425px]">
      <section class="flex items-center justify-between gap-5">
        <div>
          <p class="text-sm text-grey mb-0.5">
            Grand Total
          </p>
          <p class="text-lg min-[350px]:text-2xl font-bold text-white" id="checkout-grand-total-price">
            {{-- Rp 3.290.000 --}}
            Rp {{ number_format($grandTotal) }}
          </p>
        </div>
        <button type="submit" {{ $totalPrice == 0 ? 'disabled' :''}} class="inline-flex items-center justify-center px-5 py-3 text-base font-bold text-white rounded-full w-max bg-primary whitespace-nowrap">
          Confirm
        </button>
  </form>
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