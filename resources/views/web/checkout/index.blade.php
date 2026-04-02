<x-layouts.web title="Checkout">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-2xl md:text-3xl font-bold text-chocolate-600 mb-8">Checkout</h1>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Form --}}
                <div class="lg:col-span-2 space-y-6">
                    <div class="card p-6">
                        <h2 class="font-semibold text-chocolate-600 mb-4">Shipping Address</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="form-label">Full Address *</label>
                                <textarea name="shipping_address" rows="3" class="form-textarea" placeholder="Enter your full shipping address" required>{{ old('shipping_address') }}</textarea>
                                @error('shipping_address') <p class="form-error">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card p-6">
                        <h2 class="font-semibold text-chocolate-600 mb-4">Payment Method</h2>
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-chocolate-300 transition-colors {{ old('payment_method') === 'bank_transfer' ? 'border-chocolate-500 bg-chocolate-50' : '' }}">
                                <input type="radio" name="payment_method" value="bank_transfer" class="text-chocolate-500" {{ old('payment_method') === 'bank_transfer' ? 'checked' : '' }} required>
                                <div class="flex-1">
                                    <span class="font-medium text-chocolate-600">Bank Transfer</span>
                                    <p class="text-xs body-text mt-0.5">Transfer via BCA, Mandiri, BNI, or BRI</p>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-chocolate-300 transition-colors {{ old('payment_method') === 'cod' ? 'border-chocolate-500 bg-chocolate-50' : '' }}">
                                <input type="radio" name="payment_method" value="cod" class="text-chocolate-500" {{ old('payment_method') === 'cod' ? 'checked' : '' }}>
                                <div class="flex-1">
                                    <span class="font-medium text-chocolate-600">Cash on Delivery</span>
                                    <p class="text-xs body-text mt-0.5">Pay when you receive your order</p>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 p-4 border border-gray-200 rounded-lg cursor-pointer hover:border-chocolate-300 transition-colors {{ old('payment_method') === 'ewallet' ? 'border-chocolate-500 bg-chocolate-50' : '' }}">
                                <input type="radio" name="payment_method" value="ewallet" class="text-chocolate-500" {{ old('payment_method') === 'ewallet' ? 'checked' : '' }}>
                                <div class="flex-1">
                                    <span class="font-medium text-chocolate-600">E-Wallet</span>
                                    <p class="text-xs body-text mt-0.5">GoPay, OVO, DANA, or ShopeePay</p>
                                </div>
                            </label>
                            @error('payment_method') <p class="form-error">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="card p-6">
                        <h2 class="font-semibold text-chocolate-600 mb-4">Order Notes (Optional)</h2>
                        <textarea name="notes" rows="2" class="form-textarea" placeholder="Any special instructions for your order...">{{ old('notes') }}</textarea>
                    </div>
                </div>

                {{-- Order Summary --}}
                <div>
                    <div class="card p-6 sticky top-24">
                        <h2 class="font-semibold text-chocolate-600 mb-4">Order Summary</h2>
                        <div class="space-y-3 max-h-64 overflow-y-auto">
                            @foreach($cartItems as $item)
                                <div class="flex gap-3 items-center">
                                    <div class="w-12 h-12 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                        @if($item['image'])
                                            <img src="{{ asset('storage/' . $item['image']) }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-chocolate-600 line-clamp-1">{{ $item['name'] }}</p>
                                        <p class="text-xs body-text">Qty: {{ $item['quantity'] }}</p>
                                    </div>
                                    <p class="text-sm font-medium text-chocolate-600">{{ $item['formatted_subtotal'] }}</p>
                                </div>
                            @endforeach
                        </div>

                        <hr class="my-4 border-gray-100">

                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="body-text">Subtotal</span>
                                <span class="font-medium text-chocolate-600">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="body-text">Shipping</span>
                                <span class="font-medium text-chocolate-600">{{ $cartTotal >= 500000 ? 'Free' : 'Calculated' }}</span>
                            </div>
                            <hr class="border-gray-100">
                            <div class="flex justify-between text-base">
                                <span class="font-bold text-chocolate-600">Total</span>
                                <span class="font-bold text-chocolate-600">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <button type="submit" class="btn-primary w-full text-center mt-6">
                            Place Order
                        </button>
                        <a href="{{ route('cart.index') }}" class="btn-ghost w-full text-center mt-2 text-sm">← Back to Cart</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-layouts.web>
