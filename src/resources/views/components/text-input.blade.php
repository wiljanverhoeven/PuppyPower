@props(['disabled' => false])

<input 
    @disabled($disabled) 
    {{ $attributes->merge([
        'class' => '
            bg-[#FEFAE0] 
            border-none 
            focus:ring-[#BC6C25] 
            focus:border-[#BC6C25]
            focus:outline-2
            rounded-md 
            shadow-sm
            text-black
        ']) 
    }} 
/>
