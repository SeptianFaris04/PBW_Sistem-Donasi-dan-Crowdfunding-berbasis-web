<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div {{ $attributes->merge([
        'class' => "bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"
    ]) }}>
        {{ $slot }}
    </div>
</div>