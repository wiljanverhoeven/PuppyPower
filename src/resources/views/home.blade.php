<x-app-layout>
    <div class="">
        {{-- header image --}}
        <div class="relative h-96">
            <img src="{{ asset('/images/header-placeholder.png') }}" alt="Header Image" class="w-full h-full object-cover brightness-60">
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4">
                <h1 class="text-gray-100 text-4xl font-bold">Welkom bij Puppy Power Academy</h1>
                <p class="text-gray-100">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
        </div>

        {{-- cards --}}
        <div class="container mx-auto p-8 border-b-2 border-gray-300">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-[#606C38] shadow-lg rounded-lg overflow-hidden hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('/images/placeholder.jpg') }}" alt="shop Image" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl text-[#FEFAE0] font-bold">Shop</h2>
                        <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <a href="{{route('store.index')}}" class="text-[#DDA15E] hover:text-[#BC6C25] transition-all duration-150">Naar Shop >></a>
                    </div>
                </div>
                <div class="bg-[#606C38] shadow-lg rounded-lg overflow-hidden hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('/images/placeholder.jpg') }}" alt="training Image" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl text-[#FEFAE0] font-bold">Training</h2>
                        <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <a href="#" class="text-[#DDA15E] hover:text-[#BC6C25] transition-all duration-150">Naar Training >></a>
                    </div>
                </div>
                <div class="bg-[#606C38] shadow-lg rounded-lg overflow-hidden hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('/images/placeholder.jpg') }}" alt="dagopvang Image" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl text-[#FEFAE0] font-bold">Dagopvang</h2>
                        <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        <a href="#" class="text-[#DDA15E] hover:text-[#BC6C25] transition-all duration-150">Naar Dagopvang >></a>
                    </div>
                </div>
            </div>
        </div>

        {{-- over ons --}}
        <div>
            <div class="container mx-auto p-8 w-[70%]">
                <h2 class="text-3xl font-bold text-center mb-4">Over Ons</h2>
                <p class="text-gray-700 text-center">
                     Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ut quam condimentum, scelerisque risus vel, imperdiet neque. Donec at maximus tellus, eget lobortis nibh. Sed sit amet eros mauris. Integer ac interdum turpis. Nullam at porta purus, id facilisis nisl. Sed ac pellentesque risus, vitae aliquet ex. Aliquam eget porta nulla. Donec placerat sapien a metus laoreet feugiat. In hac habitasse platea dictumst.

Nunc leo erat, convallis nec imperdiet vitae, dapibus id mi. Morbi lacinia ullamcorper nibh ac mollis. Cras egestas, enim vel congue eleifend, leo tortor varius elit, a volutpat massa erat eu augue. Sed sagittis felis maximus libero volutpat, sed aliquam massa feugiat. Proin imperdiet nec metus vitae mattis. Etiam aliquet vitae nisl id viverra. Proin varius leo sit amet neque dictum viverra. Cras justo turpis, convallis ac purus ac, porta ullamcorper lorem. Proin condimentum sem sit amet euismod ullamcorper. Curabitur facilisis fermentum enim, id molestie quam semper quis. Aliquam tempus, leo blandit volutpat ullamcorper, leo nisl lacinia risus, luctus vestibulum lectus velit id nunc. Sed quis nisi et turpis malesuada placerat.

In est arcu, viverra non nisl eget, euismod tincidunt leo. Suspendisse laoreet iaculis commodo. Vivamus posuere felis nec neque ultrices efficitur. Etiam scelerisque luctus neque eget porta. Curabitur ac varius justo, quis egestas metus. Ut aliquet felis quam, sit amet commodo ligula laoreet et. Quisque finibus faucibus arcu, sit amet vulputate elit pulvinar quis. Nullam tincidunt libero sagittis nunc accumsan, at lacinia erat semper. 
                </p>
            </div>
        </div>
    </div>
</x-app-layout>