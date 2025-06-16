@if(session()->has('success'))
    <div id="flash-message" class="fixed inset-x-0 top-4 flex justify-center z-50">
        <div class="bg-[#606C38] text-[#FEFAE0] px-6 py-3 rounded-lg shadow-lg">
            {{ session('success') }}
            <a href="{{ route('home') }}" class="text-[#DDA15E] hover:text-[#BC6C25] ml-2">
                {{ __('Naar de homepagina') }}
            </a>
        </div>
    </div>

    <script>
        setTimeout(() => {
            document.getElementById('flash-message').remove();
        }, 5000);
    </script>
@endif