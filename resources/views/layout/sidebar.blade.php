
<input type="checkbox" id="menu-open" class="hidden" />

<label for="menu-open" class="absolute right-2 bottom-2 shadow-lg rounded-full p-2 bg-gray-100 text-gray-600 md:hidden" data-dev-hint="floating action button">
    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</label>

<header class="bg-gray-600 text-gray-100 flex justify-between md:hidden" data-dev-hint="mobile menu bar">
    <a href="#" class="block p-4 text-white font-bold whitespace-nowrap truncate">
        Your App is cool
    </a>

    <label for="menu-open" id="mobile-menu-button" class="m-2 p-2 focus:outline-none hover:text-white hover:bg-gray-700 rounded-md">
        <svg id="menu-open-icon" class="h-6 w-6 transition duration-200 ease-in-out" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg id="menu-close-icon" class="h-6 w-6 transition duration-200 ease-in-out" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </label>
</header>
<aside id="sidebar" class="bg-gray-800 z-50 text-gray-100 md:w-64 w-3/4 space-y-6 pt-6 px-0 absolute inset-y-0 left-0 transform md:relative md:translate-x-0 transition duration-200 ease-in-out  md:flex md:flex-col md:justify-between overflow-y-auto" data-dev-hint="sidebar; px-0 for frameless; px-2 for visually inset the navigation max-h-[100vh]">
    <div class="flex flex-col space-y-6" data-dev-hint="optional div for having an extra footer navigation">
        <a href="#" class="text-white flex items-center space-x-2 px-4" title="Your App is cool">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 flex-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
            </svg>
            <span class="text-2xl font-extrabold whitespace-nowrap truncate">Your App is cool</span>
        </a>

      
        <nav data-dev-hint="main navigation">
          <a href="{{ route('user/index') }}" class="flex items-center space-x-2 py-2 px-4 transition duration-200 hover:bg-gray-700 hover:text-white">
            <i class="bi bi-house-door-fill"></i>
              <span>Home</span>
          </a>
          <a href="{{ route('agency') }}" class="flex items-center space-x-2 py-2 px-4 transition duration-200 hover:bg-gray-700 hover:text-white">
            <i class="bi bi-person-lines-fill"></i>
              <span>Agent</span>
          </a>
          <a href="{{ route('passenger') }}" class="flex items-center space-x-2 py-2 px-4 transition duration-200 hover:bg-gray-700 hover:text-white">
            <i class="bi bi-person-lines-fill"></i>
              <span>Passenger</span>
          </a>
          <a href="{{ route('company') }}" class="flex items-center space-x-2 py-2 px-4 transition duration-200 hover:bg-gray-700 hover:text-white">
            <i class="bi bi-person-lines-fill"></i>
              <span>Company</span>
          </a>
          <div class="relative group">
            <button class="flex items-center w-full space-x-2 py-2 px-4 transition duration-200 hover:bg-gray-700 hover:text-white">
                <i class="bi bi-person-lines-fill"></i>
                <span>Visa</span>
            </button>
            <ul class="absolute hidden group-hover:block bg-white rounded-lg border border-gray-300 py-2 ml-6 z-50">
                <!-- Submenu items -->
                <li><a href="{{ route('visa_sell') }}" class="block hover:bg-pink-400 py-2 px-4 hover:text-white text-gray-800 font-semibold ">Visa Sell</a></li>
                <li><a href="{{ route('visa_purchase') }}" class="block hover:bg-pink-400 py-2 px-4 hover:text-white text-gray-800 font-semibold ">Visa Purchase</a></li>
            </ul>
        </div>
          <div class="relative group">
            <button class="flex items-center w-full space-x-2 py-2 px-4 transition duration-200 hover:bg-gray-700 hover:text-white">
                <i class="bi bi-person-lines-fill"></i>
                <span>Hajj</span>
            </button>
            <ul class="absolute hidden z-50 group-hover:block bg-white rounded-lg border border-gray-300 py-2 ml-6 ">
                <!-- Submenu items -->
                <li><a href="{{ route('hajj_sell') }}" class="block hover:bg-pink-400 py-2 px-4 hover:text-white text-gray-800 font-semibold ">Hajj Sell</a></li>
                <li><a href="{{ route('hajj_purchase') }}" class="block hover:bg-pink-400 py-2 px-4 hover:text-white text-gray-800 font-semibold ">Hajj Purchase</a></li>
            </ul>
        </div>
          <div class="relative group">
            <button class="flex items-center w-full space-x-2 py-2 px-4 transition duration-200 hover:bg-gray-700 hover:text-white">
                <i class="bi bi-person-lines-fill"></i>
                <span>Umrah</span>
            </button>
            <ul class="absolute hidden z-50 group-hover:block bg-white rounded-lg border border-gray-300 py-2 ml-6 ">
                <!-- Submenu items -->
                <li><a href="{{ route('umrah_sell') }}" class="block hover:bg-pink-400 py-2 px-4 hover:text-white text-gray-800 font-semibold ">Umrah Sell</a></li>
                <li><a href="{{ route('umrah_purchase') }}" class="block hover:bg-pink-400 py-2 px-4 hover:text-white text-gray-800 font-semibold ">Umrah Purchase</a></li>
            </ul>
        </div>
          <div class="relative group">
            <button class="flex items-center w-full space-x-2 py-2 px-4 transition duration-200 hover:bg-gray-700 hover:text-white">
                <i class="bi bi-person-lines-fill"></i>
                <span>Ticket</span>
            </button>
            <ul class="absolute hidden z-50 group-hover:block bg-white rounded-lg border border-gray-300 py-2 ml-6 ">
                <!-- Submenu items -->
                <li><a href="{{ route('ticket_sell') }}" class="block hover:bg-pink-400 py-2 px-4 hover:text-white text-gray-800 font-semibold ">Ticket Sell</a></li>
                <li><a href="{{ route('ticket_purchase') }}" class="block hover:bg-pink-400 py-2 px-4 hover:text-white text-gray-800 font-semibold ">Ticket Purchase</a></li>
            </ul>
        </div>
          
          
      </nav>
      </div>
</aside>