<x-layouts.web title="Shopping Cart">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl md:text-3xl font-bold text-chocolate-600 mb-8">Shopping Cart</h1>

        @if($cartItems->isEmpty())
            <div class="card p-12 text-center">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                <h3 class="font-semibold text-chocolate-600 text-lg mb-2">Your cart is empty</h3>
                <p class="body-text mb-6">Looks like you haven't added anything to your cart yet.</p>
                <a href="{{ route('shop') }}" class="btn-primary inline-flex">Continue Shopping</a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Cart Items --}}
                <div class="lg:col-span-2 space-y-4">
                    @foreach($cartItems as $item)
                        <div class="card p-4 flex gap-4 items-center" id="cart-item-{{ $item['product_id'] }}">
                            {{-- Image --}}
                            <div class="w-20 h-20 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                @if($item['image'])
                                    <img src="{{ asset('storage/' . $item['image']) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                @endif
                            </div>

                            {{-- Info --}}
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('product.show', $item['product']?->slug ?? $item['product_id']) }}" class="font-medium text-chocolate-600 hover:text-chocolate-500 transition-colors line-clamp-1">{{ $item['name'] }}</a>
                                <p class="text-sm body-text mt-1">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                @if(!$item['in_stock'])
                                    <span class="badge-red mt-1 text-xs">Insufficient stock</span>
                                @endif
                            </div>

                            {{-- Quantity --}}
                            <div class="flex items-center gap-2">
                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center border border-gray-200 rounded-lg">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" class="px-3 py-2 hover:bg-gray-100 transition-colors text-gray-600 text-sm">−</button>
                                    <span class="px-3 py-2 text-sm text-gray-900 border-x border-gray-200 min-w-[40px] text-center">{{ $item['quantity'] }}</span>
                                    <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="px-3 py-2 hover:bg-gray-100 transition-colors text-gray-600 text-sm">+</button>
                                </form>
                            </div>

                            {{-- Subtotal --}}
                            <div class="text-right min-w-[80px]">
                                <p class="font-semibold text-chocolate-600">{{ $item['formatted_subtotal'] }}</p>
                            </div>

                            {{-- Remove --}}
                            <form action="{{ route('cart.destroy', $item['product_id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon text-red-400 hover:text-red-600 hover:bg-red-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                {{-- Summary --}}
                <div>
                    <div class="card p-6 sticky top-24">
                        <h2 class="font-semibold text-chocolate-600 mb-4">Order Summary</h2>
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="body-text">Subtotal ({{ $cartCount }} items)</span>
                                <span class="font-medium text-chocolate-600">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="body-text">Shipping</span>
                                <span class="font-medium text-chocolate-600">{{ $cartTotal >= 500000 ? 'Free' : 'Calculated at checkout' }}</span>
                            </div>
                            <hr class="border-gray-100">
                            <div class="flex justify-between text-base">
                                <span class="font-semibold text-chocolate-600">Total</span>
                                <span class="font-bold text-chocolate-600">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        @if($cartTotal >= 500000)
                            <div class="mt-3 p-2 bg-green-50 rounded-lg text-xs text-green-700 text-center">
                                🎉 You've unlocked free shipping!
                            </div>
                        @endif

                        <a href="{{ route('checkout') }}" class="btn-primary w-full text-center mt-6">Proceed to Checkout</a>
                        <a href="{{ route('shop') }}" class="btn-ghost w-full text-center mt-2 text-sm">Continue Shopping</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layouts.web>
