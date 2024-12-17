<div {{ $attributes->merge([
    'class' => "bg-white p-6 shadow-sm border border-zinc-300 rounded-lg"
]) }}>
    {{ $slot }}
</div>