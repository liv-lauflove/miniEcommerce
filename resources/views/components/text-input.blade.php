@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge([
    'class' => 'block w-full px-4 py-2.5 '
              . 'rounded-lg border border-gray-200 '
              . 'text-gray-700 placeholder-gray-400 '
              . 'bg-white '
              . 'focus:border-chocolate-400 focus:ring-2 focus:ring-chocolate-400/20 '
              . 'focus:outline-none '
              . 'shadow-sm '
              . 'transition-all duration-150 '
              . 'disabled:bg-gray-50 disabled:text-gray-400 disabled:cursor-not-allowed'
]) }}>
