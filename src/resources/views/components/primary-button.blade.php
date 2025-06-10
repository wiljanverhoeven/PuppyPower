<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] focus:ring-[#BC6C25] rounded-md font-semibold text-xs uppercase tracking-widest transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
