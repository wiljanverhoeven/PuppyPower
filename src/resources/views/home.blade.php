<x-app-layout>
    <div class="">
        {{-- Image Slideshow with Slide Animation --}}
        <div class="relative h-[calc(100vh-4rem)] overflow-hidden p-8">
            <div class="absolute inset-0 z-10 flex flex-col items-start justify-center p-14">
                <h1 class="text-gray-100 text-7xl font-bold w-[50%]">Welkom bij Puppy Power Academy</h1>
                <p class="text-gray-100 w-[30%]">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. scelerisque risus vel, imperdiet neque.
                </p>
                {{-- buttons to contact and trainings --}}
                <div class="mt-4 flex flex-row gap-2 w-[30%]">
                    <button class="w-2/3 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] py-2 rounded-md transition">
                        <a href="{{ url('/contact') }}">Neem contact op <i class="fa-solid fa-paper-plane"></i></a>
                    </button>
                    <button class="w-2/3 bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] py-2 rounded-md transition">
                        <a href="{{ url('/contact') }}">Meer over ons <i class="fa-solid fa-circle-info"></i></a>
                    </button>
                </div>
            </div>
            
            {{-- slides container --}}
            <div class="slider-container relative h-full w-full overflow-hidden rounded-xl">
                <div class="slider-track flex h-full w-full transition-transform duration-1000 ease-in-out">
                    <div class="slide flex-shrink-0 w-full h-full">
                        <img src="{{ asset('/images/header/header-1.jpg') }}" alt="Slide 1" class="w-full h-full object-cover brightness-60">
                    </div>
                    <div class="slide flex-shrink-0 w-full h-full">
                        <img src="{{ asset('/images/header/header-2.jpg') }}" alt="Slide 2" class="w-full h-full object-cover brightness-60">
                    </div>
                    <div class="slide flex-shrink-0 w-full h-full">
                        <img src="{{ asset('/images/header/header-3.jpg') }}" alt="Slide 3" class="w-full h-full object-cover brightness-60">
                    </div>
                </div>
                
                {{-- navigatie dots --}}
                <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2 z-20">
                    <button class="slide-dot w-3 h-3 rounded-full bg-white transition-all duration-300" data-slide="0" aria-label="Go to slide 1"></button>
                    <button class="slide-dot w-3 h-3 rounded-full bg-white/50 transition-all duration-300" data-slide="1" aria-label="Go to slide 2"></button>
                    <button class="slide-dot w-3 h-3 rounded-full bg-white/50 transition-all duration-300" data-slide="2" aria-label="Go to slide 3"></button>
                </div>
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
        {{-- foto gallerij --}}
        <div class="container mx-auto p-8 border-b-2 border-gray-300">
            {{-- tietel --}}
            <div class="text-center mb-4">
                    <h2 class="text-3xl font-bold">Onze Pups</h2>
                    <p>Zie meer foto's van onze schattige pups op 
                        <a href="" class="text-pink-500 hover:underline">Instagram</a>!
                    </p>
            </div>

            {{-- pictures from instagram --}}
            <div class="relative h-screen p-8">
                
                {{-- upper row --}}
                <div class="h-1/3 flex justify-between items-center gap-2 mb-2">
                    <div class="h-full w-2/3 hover:scale-[102%] transition-transform duration-300 hover:cursor-pointer">
                        <img src="{{ asset('images/header/puppy-5.jpg') }}" alt="Header Image" class="w-full h-full object-cover rounded-lg shadow-md">
                    </div>
                    <div class="h-full w-1/3 hover:scale-[102%] transition-transform duration-300 hover:cursor-pointer">
                        <img src="{{ asset('images/header/puppy-2.jpg') }}" alt="Header Image" class="w-full h-full object-cover rounded-lg shadow-md">
                    </div>
                </div>
                {{-- middle row --}}
                <div class="h-1/3 flex justify-between items-center gap-2 mb-2">
                    <div class="h-full w-1/4 hover:scale-[102%] transition-transform duration-300 hover:cursor-pointer">
                        <img src="{{ asset('images/header/puppy-7.jpg') }}" alt="Header Image" class="w-full h-full object-cover rounded-lg shadow-md">
                    </div>
                    <div class="h-full w-1/4 hover:scale-[102%] transition-transform duration-300 hover:cursor-pointer">
                        <img src="{{ asset('images/header/puppy-3.jpg') }}" alt="Header Image" class="w-full h-full object-cover rounded-lg shadow-md">
                    </div>
                    <div class="h-full w-1/4 hover:scale-[102%] transition-transform duration-300 hover:cursor-pointer">
                        <img src="{{ asset('images/header/puppy-4.jpg') }}" alt="Header Image" class="w-full h-full object-cover rounded-lg shadow-md">
                    </div>
                    <div class="h-full w-1/4 hover:scale-[102%] transition-transform duration-300 hover:cursor-pointer">
                        <img src="{{ asset('images/header/puppy-1.jpg') }}" alt="Header Image" class="w-full h-full object-cover rounded-lg shadow-md">
                    </div>
                </div>
                {{-- bottom row --}}
                <div class="h-1/3 flex justify-between items-center gap-2">
                    <div class="h-full w-1/3 hover:scale-[102%] transition-transform duration-300 hover:cursor-pointer">
                        <img src="{{ asset('images/header/puppy-6.jpg') }}" alt="Header Image" class="w-full h-full object-cover rounded-lg shadow-md">
                    </div>
                    <div class="h-full w-2/3 hover:scale-[102%] transition-transform duration-300 hover:cursor-pointer">
                        <img src="{{ asset('images/header/puppy-8.jpg') }}" alt="Header Image" class="w-full h-full object-cover rounded-lg shadow-md">
                    </div>
                </div>
            </div>
        </div>

        {{-- over ons --}}
        <div class="flex flex-col lg:flex-row w-full justify-center items-center gap-16 p-8">
            <div class="container w-[70%] lg:w-[50%]">
                <h2 class="text-3xl font-bold text-center mb-4">Over Ons</h2>
                <p class="text-gray-700 text-center">
                     Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ut quam condimentum, scelerisque risus vel, imperdiet neque. Donec at maximus tellus, eget lobortis nibh. Sed sit amet eros mauris. Integer ac interdum turpis. Nullam at porta purus, id facilisis nisl. Sed ac pellentesque risus, vitae aliquet ex. Aliquam eget porta nulla. Donec placerat sapien a metus laoreet feugiat. In hac habitasse platea dictumst.

Nunc leo erat, convallis nec imperdiet vitae, dapibus id mi. Morbi lacinia ullamcorper nibh ac mollis. Cras egestas, enim vel congue eleifend, leo tortor varius elit, a volutpat massa erat eu augue. Sed sagittis felis maximus libero volutpat, sed aliquam massa feugiat. Proin imperdiet nec metus vitae mattis. Etiam aliquet vitae nisl id viverra. Proin varius leo sit amet neque dictum viverra. Cras justo turpis, convallis ac purus ac, porta ullamcorper lorem. Proin condimentum sem sit amet euismod ullamcorper. Curabitur facilisis fermentum enim, id molestie quam semper quis. Aliquam tempus, leo blandit volutpat ullamcorper, leo nisl lacinia risus, luctus vestibulum lectus velit id nunc. Sed quis nisi et turpis malesuada placerat.

In est arcu, viverra non nisl eget, euismod tincidunt leo. Suspendisse laoreet iaculis commodo. Vivamus posuere felis nec neque ultrices efficitur. Etiam scelerisque luctus neque eget porta. Curabitur ac varius justo, quis egestas metus. Ut aliquet felis quam, sit amet commodo ligula laoreet et. Quisque finibus faucibus arcu, sit amet vulputate elit pulvinar quis. Nullam tincidunt libero sagittis nunc accumsan, at lacinia erat semper. 
                </p>
            </div>
            <div class="w-[50%] lg:w-[30%] h-full">
                <img src="{{ asset('/images/header/puppy-9.jpg') }}" alt="Over Ons" class="w-full h-full object-cover rounded-lg shadow-md">
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sliderTrack = document.querySelector('.slider-track');
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.slide-dot');
            let currentIndex = 0;
            const slideCount = slides.length;
            const slideDuration = 4000; // 4 seconds per slide
            
            function showSlide(index) {
                // Move the slider track
                const translateX = -index * 100;
                sliderTrack.style.transform = `translateX(${translateX}%)`;
                
                // Update dot styles
                dots.forEach((dot, i) => {
                    if (i === index) {
                        dot.classList.remove('bg-white/50');
                        dot.classList.add('bg-white');
                    } else {
                        dot.classList.remove('bg-white');
                        dot.classList.add('bg-white/50');
                    }
                });
                
                currentIndex = index;
            }
            
            // Dot click handlers
            dots.forEach((dot, index) => {
                dot.addEventListener('click', function() {
                    showSlide(index);
                });
            });
            
            // Auto-advance slides
            setInterval(() => {
                const nextIndex = (currentIndex + 1) % slideCount;
                showSlide(nextIndex);
            }, slideDuration);
        });
    </script>
</x-app-layout>