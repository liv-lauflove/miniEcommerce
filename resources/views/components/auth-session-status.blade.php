@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'text-sm font-medium text-green-700 bg-green-50 border border-green-200 rounded-lg px-4 py-3']) }}>
        {{ $status }}
    </div>
@endif
