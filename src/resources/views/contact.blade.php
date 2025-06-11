<x-app-layout>
    {{-- header image --}}
    {{-- <div class="relative h-[calc(100vh-4rem)] overflow-hidden p-8">
        <img src="{{ asset('/images/contact-header.jpg') }}" alt="Header Image" class="w-full h-full object-cover rounded-xl brightness-60">
        <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4">
            <h1 class="text-gray-200 text-4xl font-bold">Neem contact met ons op</h1>
            <p class="text-gray-200">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            <button class="bg-[#DDA15E] hover:bg-[#BC6C25] ease-in-out duration-300 w-48 h-12 rounded-xl text-gray-200 mt-6 shadow-md">Meest gestelde vragen</button>
        </div>
    </div> --}}
    
    <div class="w-full my-6 text-center">
        <h1 class="text-2xl font-bold">Neem contact op met ons!</h1>
    </div>
        {{-- boxes container --}}
    <div class="flex flex-col md:flex-row mt-4 justify-center items-center md:space-x-4 mb-10">
        {{-- contact info/openingstijden --}}
        <div class="bg-[#606C38] text-white rounded-lg w-[90vw] md:w-80 h-[460px] mt-4 p-4 gap-2">
            <h2 class="text-xl text-[#FEFAE0] font-bold">Contact Informatie</h2>
            <p class="">Telefoon: 123-456-7890</p>
            <p class="">Email: email@email.com</p>
            <p class="">Adres: Voorbeeldstraat 123, 1234 AB, Plaatsnaam</p>
            <h2 class="text-xl text-[#FEFAE0] font-bold mt-4">Openingstijden</h2>
            <p class="">Maandag: 09:00 - 17:00</p>
            <p class="">Dinsdag: 09:00 - 17:00</p>
            <p class="">Woensdag: 09:00 - 17:00</p>
            <p class="">Donderdag: 09:00 - 17:00</p>
            <p class="">Vrijdag: 09:00 - 17:00</p>
            <p class="">Zaterdag: 10:00 - 16:00</p>
            <p class="">Zondag: Gesloten</p>
            <h2 class="text-xl text-[#FEFAE0] font-bold mt-4">Social Media</h2>
            {{-- facebook, instagram, X and linkedin icons --}}
            <div class="flex flex-row gap-4 mt-2">
                <a href="#" class="text-[#FEFAE0] hover:text-blue-600 transition-all duration-150 text-2xl" aria-label="Facebook">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="#" class="text-[#FEFAE0] hover:text-pink-500 transition-all duration-150 text-2xl" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="text-[#FEFAE0] hover:text-black transition-all duration-150 text-2xl" aria-label="X">
                    <i class="fab fa-x-twitter"></i>
                </a>
                <a href="#" class="text-[#FEFAE0] hover:text-blue-700 transition-all duration-150 text-2xl" aria-label="LinkedIn">
                    <i class="fab fa-linkedin"></i>
                </a>
            </div>
        </div>
        {{-- contact formulier --}}
        <div class="flex flex-col bg-[#606C38] text-white rounded-lg w-[90vw] md:w-[50%] h-[460px] mt-4 p-4 gap-2">
            <h2 class="text-xl text-[#FEFAE0] font-bold">Stel je vraag</h2>
            <form method="post" action="{{ route('contact.store') }}" 
            class="flex flex-col justify-center">
                @csrf
            
                    <div class="flex flex-row gap-4 w-full">
                        <div class="flex flex-col w-1/2">
                            <label for="name">Voornaam:</label>
                            <input type="text" id="name" class="w-full bg-[#FEFAE0] focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] text-black rounded-md border-none" name="name" required>
                        </div>
                        <div class="flex flex-col w-1/2">
                            <label for="lastname">Achternaam:</label>
                            <input type="text" id="lastname" class="w-full bg-[#FEFAE0] text-black focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] rounded-md border-none" name="lastname" required>
                        </div>

                    </div>
                
                    <div class="flex flex-row gap-4 w-full">
                        <div class="flex flex-col w-1/2">
                            <label for="email">Email:</label>
                            <input type="email" id="email" class="w-full bg-[#FEFAE0] text-black focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] rounded-md border-none" name="email" required>
                        </div>
                    
                        <div class="flex flex-col w-1/2">
                            <label for="phone">Phone:</label>
                            <input type="text" id="phone" class="w-full bg-[#FEFAE0] text-black focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] rounded-md border-none" name="phone">
                        </div>
                    </div>
                
                    <label for="subject">Subject:</label>
                    <input type="text" id="subject" class="bg-[#FEFAE0] text-black focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] rounded-md border-none" name="subject" required>
                
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" class="h-24 bg-[#FEFAE0] text-black focus:outline-2 focus:outline-offset-0 focus:outline-[#BC6C25] rounded-md border-none" required></textarea>
                
                    <div class="flex items-center justify-center">
                        <button type="submit" class="bg-[#DDA15E] hover:bg-[#BC6C25] text-[#FEFAE0] ease-in-out duration-300 w-[90%] h-12 rounded-xl mt-6">Send</button>
                    </div>

            </form>
        </div>
    </div>
    
</x-app-layout>