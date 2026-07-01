@extends('customer.layout')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-black text-emerald-800 mb-6">Checkout</h1>

    {{-- Error/Success Messages --}}
    @if(session('error'))
        <div class="mb-4 rounded-xl bg-red-50 p-4 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <form id="checkout-form" action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="grid md:grid-cols-2 gap-6">
            {{-- Left: Form --}}
            <div class="space-y-6">
                {{-- Data Penerima --}}
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Data Penerima</h2>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Penerima</label>
                            <input type="text" name="recipient_name" required
                                   value="{{ old('recipient_name') }}"
                                   class="relative z-10 w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @error('recipient_name') border-red-500 @enderror">
                            @error('recipient_name')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
                            <input type="tel" name="recipient_phone" required
                                   value="{{ old('recipient_phone') }}"
                                  class="relative z-10 w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @error('recipient_name') border-red-500 @enderror">
                            @error('recipient_phone')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Patokan Lokasi (Opsional)</label>
                            <input type="text" name="address_note" placeholder="Contoh: Dekat swalayan, lampu merah..."
                                   value="{{ old('address_note') }}"
                                   class="relative z-10 w-full rounded-xl border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 @error('recipient_name') border-red-500 @enderror">
                        </div>
                    </div>
                </div>

                {{-- Location Picker --}}
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Lokasi Pengiriman</h2>

                    {{-- Hidden fields for coordinates --}}
                    <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
                    <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}">

                    {{-- Location Option Tabs --}}
                    <div class="flex gap-2 mb-4">
                        <button type="button" id="tab-gps" class="tab-btn active" data-tab="gps">
                            GPS
                        </button>
                        <button type="button" id="tab-map" class="tab-btn" data-tab="map">
                            Peta
                        </button>
                        <button type="button" id="tab-manual" class="tab-btn" data-tab="manual">
                            Input Manual
                        </button>
                    </div>

                    {{-- GPS Tab --}}
                    <div id="panel-gps" class="tab-panel active">
                        <div id="gps-status" class="text-sm text-gray-600 mb-2"></div>
                        <button type="button" id="btn-get-gps"
                                class="w-full rounded-xl bg-blue-600 text-white px-4 py-2 hover:bg-blue-700 transition-colors">
                            Dapatkan Lokasi GPS
                        </button>
                        <p class="text-xs text-gray-500 mt-2">Aktifkan GPS di perangkat Anda untuk mendeteksi lokasi otomatis.</p>

                        {{-- Map will be shown here after GPS is found --}}
                        <div id="gps-map-container" class="hidden mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi Anda di Peta</label>
                            <div id="gps-map" class="w-full h-64 rounded-xl bg-gray-100 mb-2"></div>
                            <div id="gps-map-info" class="text-sm text-gray-600"></div>
                        </div>
                    </div>

                    {{-- Map Tab --}}
                    <div id="panel-map" class="tab-panel hidden">
                        <div id="map" class="w-full h-64 rounded-xl bg-gray-100 mb-2"></div>
                        <p class="text-sm text-gray-600">Klik atau geser marker untuk memilih lokasi pengiriman.</p>
                        <div id="map-coords" class="text-sm text-gray-600 mt-2"></div>
                    </div>

                    {{-- Manual Tab --}}
                    <div id="panel-manual" class="tab-panel hidden">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Latitude</label>
                                <input type="number" id="input-lat" step="any" placeholder="Contoh: -8.6577"
                                       class="w-full rounded-xl border-gray-300 focus:border-emerald-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Longitude</label>
                                <input type="number" id="input-lng" step="any" placeholder="Contoh: 115.2254"
                                       class="w-full rounded-xl border-gray-300 focus:border-emerald-500">
                            </div>
                            <button type="button" id="btn-validate-manual"
                                    class="w-full rounded-xl bg-gray-800 text-white px-4 py-2 hover:bg-gray-900 transition-colors">
                                Validasi Lokasi
                            </button>
                        </div>
                    </div>

                    {{-- Validation Result --}}
                    <div id="validation-result" class="mt-4 hidden"></div>
                </div>

                {{-- Payment Method --}}
                <div class="bg-white rounded-2xl shadow-sm p-6">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Metode Pembayaran</h2>

                    <div class="space-y-3">
                        <label class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer hover:border-emerald-500 transition-colors payment-label">
                            <input type="radio" name="payment_method" value="transfer" required
                                   class="w-5 h-5 text-emerald-600" {{ old('payment_method') === 'transfer' ? 'checked' : '' }}>
                            <div>
                                <span class="font-medium">Transfer Bank</span>
                                <p class="text-sm text-gray-500">BCA, Mandiri, BNI, BRI</p>
                            </div>
                        </label>

                        <label class="flex items-center gap-3 p-4 rounded-xl border-2 cursor-pointer hover:border-emerald-500 transition-colors payment-label">
                            <input type="radio" name="payment_method" value="cod" required
                                   class="w-5 h-5 text-emerald-600" {{ old('payment_method') === 'cod' ? 'checked' : '' }}>
                            <div>
                                <span class="font-medium">Cash on Delivery (COD)</span>
                                <p class="text-sm text-gray-500">Bayar saat barang diterima</p>
                            </div>
                        </label>
                    </div>
                    @error('payment_method')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Right: Order Summary --}}
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm p-6 sticky top-6">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Ringkasan Pesanan</h2>

                    <div class="space-y-3 mb-4">
                        @foreach($cartItems as $item)
                            <div class="flex justify-between text-sm">
                                <span>{{ $item['product']->name }} x {{ $item['quantity'] }}</span>
                                <span>Rp {{ number_format($item['product']->price * $item['quantity'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <hr class="my-4">

                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Ongkos Kirim</span>
                            <span id="shipping-fee" class="font-medium">
                                @if($subtotal >= 500000)
                                    <span class="text-green-600">GRATIS</span>
                                @else
                                    Rp {{ number_format(config('store.shipping_fee', 15000), 0, ',', '.') }}
                                @endif
                            </span>
                        </div>
                        <hr>
                        <div class="flex justify-between text-lg font-bold">
                            <span>Total</span>
                            <span id="grand-total">Rp {{ number_format($subtotal + ($subtotal >= 500000 ? 0 : config('store.shipping_fee', 15000)), 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div id="distance-info" class="mt-4 p-3 bg-gray-50 rounded-xl text-sm hidden">
                        <div class="flex justify-between">
                            <span>Jarak dari toko:</span>
                            <span id="distance-value" class="font-medium"></span>
                        </div>
                        <div class="flex justify-between">
                            <span>Status:</span>
                            <span id="distance-status" class="font-medium"></span>
                        </div>
                    </div>

                    <button type="submit" id="btn-submit"
                            class="w-full mt-6 rounded-2xl bg-emerald-600 px-6 py-3 font-black text-white hover:bg-emerald-700 transition-colors disabled:bg-gray-300 disabled:cursor-not-allowed">
                        Pesan Sekarang
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<!-- Leaflet JS (load before main script) -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ========================================
    // DEBUG: Check if elements exist
    // ========================================
    console.log('[GPS] DOM loaded');
    console.log('[GPS] btn-get-gps:', document.getElementById('btn-get-gps'));
    console.log('[GPS] gps-status:', document.getElementById('gps-status'));
    console.log('[GPS] Leaflet L:', typeof L);

    const storeLat = {{ $storeConfig['lat'] }};
    const storeLng = {{ $storeConfig['lng'] }};
    const maxRadius = {{ $storeConfig['radius'] }};

    // Tab switching
    document.querySelectorAll('.tab-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.tab-btn').forEach(function(b) { b.classList.remove('active'); });
            document.querySelectorAll('.tab-panel').forEach(function(p) { p.classList.add('hidden'); });
            this.classList.add('active');
            document.getElementById('panel-' + this.dataset.tab).classList.remove('hidden');
        });
    });

    // GPS functionality
    var btnGetGps = document.getElementById('btn-get-gps');
    var gpsStatus = document.getElementById('gps-status');
    var gpsMap = null;
    var gpsMarker = null;
    var gpsCircle = null;

    if (!btnGetGps) {
        console.error('[GPS] Tombol btn-get-gps tidak ditemukan!');
    } else {
        console.log('[GPS] Listener GPS terdaftar');
        btnGetGps.addEventListener('click', function() {
            if (!navigator.geolocation) {
                gpsStatus.textContent = 'Geolocation tidak didukung browser ini.';
                return;
            }

            gpsStatus.textContent = '⏳ Mendeteksi lokasi...';
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;
                    gpsStatus.textContent = '✅ Lokasi ditemukan: ' + lat.toFixed(6) + ', ' + lng.toFixed(6);
                    validateLocation(lat, lng);
                    showGpsMap(lat, lng);
                },
                function(error) {
                    var message = 'Gagal mendapatkan lokasi.';
                    if (error.code === 1) message = '⚠️ Izin GPS ditolak. Izinkan di browser lalu coba lagi.';
                    if (error.code === 2) message = '⚠️ Posisi tidak tersedia. Pastikan GPS perangkat aktif.';
                    if (error.code === 3) message = '⚠️ Waktu deteksi habis. Coba lagi.';
                    gpsStatus.textContent = message;
                    console.error('[GPS] Error:', error.code, error.message);
                },
                { enableHighAccuracy: true, timeout: 30000 }
            );
        });
    }

    // Show map with GPS location
    function showGpsMap(lat, lng) {
        var container = document.getElementById('gps-map-container');
        var mapEl = document.getElementById('gps-map');
        var infoEl = document.getElementById('gps-map-info');

        if (!container || !mapEl) return;

        container.classList.remove('hidden');

        if (gpsMap) {
            gpsMap.remove();
            gpsMap = null;
        }

        gpsMap = L.map('gps-map').setView([lat, lng], 16);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(gpsMap);

        // Delivery radius circle
        gpsCircle = L.circle([storeLat, storeLng], {
            color: 'green',
            fillColor: '#22c55e',
            fillOpacity: 0.15,
            radius: maxRadius * 1000
        }).addTo(gpsMap);

        // Store marker
        L.marker([storeLat, storeLng]).addTo(gpsMap)
            .bindPopup('📍 Lokasi Toko (±' + maxRadius + 'km)');

        // User location marker
        gpsMarker = L.marker([lat, lng], { draggable: true }).addTo(gpsMap)
            .bindPopup('📍 Lokasi Anda')
            .openPopup();

        // Update coordinates when marker is dragged
        gpsMarker.on('dragend', function(e) {
            var pos = e.target.getLatLng();
            document.getElementById('latitude').value = pos.lat;
            document.getElementById('longitude').value = pos.lng;
            validateLocation(pos.lat, pos.lng);
        });

        // Calculate distance
        var distance = getDistanceFromLatLng(lat, lng, storeLat, storeLng);
        infoEl.innerHTML = '📍 Lokasi Anda: ' + lat.toFixed(6) + ', ' + lng.toFixed(6) +
            ' | 🏪 Jarak dari toko: ' + distance.toFixed(2) + ' km';

        setTimeout(function() { gpsMap.invalidateSize(); }, 200);
    }

    // Haversine distance calculator (km)
    function getDistanceFromLatLng(lat1, lng1, lat2, lng2) {
        var R = 6371;
        var dLat = (lat2 - lat1) * Math.PI / 180;
        var dLng = (lng2 - lng1) * Math.PI / 180;
        var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLng / 2) * Math.sin(dLng / 2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c;
    }

    // Map initialization
    var map = null;
    var marker = null;

    document.getElementById('tab-map').addEventListener('click', function() {
        if (map) {
            setTimeout(function() { map.invalidateSize(); }, 100);
            return;
        }

        var mapEl = document.getElementById('map');
        if (!mapEl) return;

        map = L.map('map').setView([storeLat, storeLng], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        marker = L.marker([storeLat, storeLng], { draggable: true }).addTo(map);

        // Store circle (delivery radius)
        L.circle([storeLat, storeLng], {
            color: 'green',
            fillColor: '#22c55e',
            fillOpacity: 0.15,
            radius: maxRadius * 1000
        }).addTo(map).bindPopup('Lokasi Toko (±' + maxRadius + 'km)');

        marker.on('dragend', function(e) {
            var pos = e.target.getLatLng();
            document.getElementById('latitude').value = pos.lat;
            document.getElementById('longitude').value = pos.lng;
            document.getElementById('map-coords').textContent = 'Koordinat: ' + pos.lat.toFixed(6) + ', ' + pos.lng.toFixed(6);
            validateLocation(pos.lat, pos.lng);
        });

        map.on('click', function(e) {
            marker.setLatLng(e.latlng);
            document.getElementById('latitude').value = e.latlng.lat;
            document.getElementById('longitude').value = e.latlng.lng;
            document.getElementById('map-coords').textContent = 'Koordinat: ' + e.latlng.lat.toFixed(6) + ', ' + e.latlng.lng.toFixed(6);
            validateLocation(e.latlng.lat, e.latlng.lng);
        });

        // Fix map size after render
        setTimeout(function() { map.invalidateSize(); }, 200);
    });

    // Manual validation
    document.getElementById('btn-validate-manual').addEventListener('click', function() {
        var lat = parseFloat(document.getElementById('input-lat').value);
        var lng = parseFloat(document.getElementById('input-lng').value);

        if (isNaN(lat) || isNaN(lng)) {
            showValidationResult('Masukkan latitude dan longitude yang valid.', false);
            return;
        }

        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
        validateLocation(lat, lng);
        showGpsMap(lat, lng);

        // Switch to GPS tab to show the map
        document.querySelectorAll('.tab-btn').forEach(function(b) { b.classList.remove('active'); });
        document.querySelectorAll('.tab-panel').forEach(function(p) { p.classList.add('hidden'); });
        document.getElementById('tab-gps').classList.add('active');
        document.getElementById('panel-gps').classList.remove('hidden');
    });

    // AJAX validation
    function validateLocation(lat, lng) {
        var formData = new FormData();
        formData.append('latitude', lat);
        formData.append('longitude', lng);

        fetch('{{ route('checkout.validate-location') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (data.is_within_radius) {
                showValidationResult('Lokasi dalam jangkauan (' + data.distance + ' km dari toko)', true);
            } else {
                showValidationResult(data.message, false);
            }
            document.getElementById('distance-info').classList.remove('hidden');
            document.getElementById('distance-value').textContent = data.distance + ' km';
            document.getElementById('distance-status').innerHTML = data.is_within_radius
                ? '<span class="text-green-600">Dalam Jangkauan</span>'
                : '<span class="text-red-600">Di Luar Jangkauan</span>';
        });
    }

    function showValidationResult(message, isSuccess) {
        var result = document.getElementById('validation-result');
        result.classList.remove('hidden');
        result.className = 'mt-4 p-3 rounded-xl text-sm ' + (isSuccess ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700');
        result.textContent = message;
    }

    // Payment label styling
    document.querySelectorAll('.payment-label input').forEach(function(radio) {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.payment-label').forEach(function(label) {
                label.classList.remove('border-emerald-500');
                label.classList.add('border-gray-200');
            });
            this.closest('.payment-label').classList.remove('border-gray-200');
            this.closest('.payment-label').classList.add('border-emerald-500');
        });
    });

    // Form submission
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        var lat = document.getElementById('latitude').value;
        var lng = document.getElementById('longitude').value;

        if (!lat || !lng) {
            e.preventDefault();
            alert('Silakan pilih lokasi pengiriman terlebih dahulu.');
        }
    });
});
</script>

<style>
.tab-btn {
    padding: 8px 16px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    background: #f3f4f6;
    color: #6b7280;
    transition: all 0.2s;
    border: none;
    cursor: pointer;
}
.tab-btn.active {
    background: #059669;
    color: white;
}
</style>
@endpush