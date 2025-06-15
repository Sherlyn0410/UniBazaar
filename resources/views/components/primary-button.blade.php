<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'inline-flex items-center px-4 py-2 bg-[#E21A22] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#b9151a] focus:bg-[#b9151a] active:bg-[#a11217] focus:outline-none focus:ring-2 focus:ring-[#E21A22] focus:ring-offset-2 transition ease-in-out duration-150'
]) }}>
    {{ $slot }}
</button>
