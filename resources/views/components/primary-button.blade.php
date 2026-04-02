<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center justify-center w-full px-5 py-2.5 '
               . 'bg-chocolate-500 border border-transparent rounded-lg '
               . 'font-semibold text-sm text-white tracking-wide '
               . 'hover:bg-chocolate-600 hover:shadow-md '
               . 'focus:bg-chocolate-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-chocolate-400 '
               . 'active:bg-chocolate-700 '
               . 'transition-all duration-150 cursor-pointer select-none'
]) }}>
    {{ $slot }}
</button>
