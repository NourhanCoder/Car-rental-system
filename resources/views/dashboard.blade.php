<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Profile') }}
            
        </h2>
        
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex items-center space-x-6 rtl:space-x-reverse">
                    <!-- User Image or Default Avatar -->
                    <div class="shrink-0">
                       
                        @if(Auth::check() && Auth::user()->image)
                            <img class="h-24 w-24 object-cover rounded-full shadow" src="{{ asset('storage/' . Auth::user()->image) }}" alt="{{ Auth::user()->full_name }}">
                        @elseif(Auth::check())
                            <img class="h-24 w-24 object-cover rounded-full shadow" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->full_name) }}&background=0D8ABC&color=fff" alt="{{ Auth::user()->full_name }}">
                        @endif
                    </div>

                    <!-- User Details -->
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ Auth::user()->full_name }}</h3>
                        <p class="text-sm text-gray-500">@ {{ Auth::user()->user_name }}</p>
                        <p class="text-sm text-gray-600 mt-1"><i class="fa fa-envelope mr-1"></i> {{ Auth::user()->email }}</p>
                        
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 mt-2">
                            Active Account
                        </span>
                    </div>
                </div>

                <hr class="my-6 border-gray-200">

                <!-- Account Summary / Actions -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="p-4 bg-gray-50 rounded-lg text-center">
                        <span class="block text-2xl font-bold text-indigo-600">0</span>
                        <span class="text-sm text-gray-500">Active Bookings</span>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg text-center">
                        <span class="block text-2xl font-bold text-indigo-600">0</span>
                        <span class="text-sm text-gray-500">Completed Rentals</span>
                    </div>
                    <div class="p-4 bg-gray-50 rounded-lg text-center">
                        <a href="{{ route('profile.edit') }}" class="inline-block mt-2 text-sm font-semibold text-indigo-600 hover:text-indigo-500">
                            Edit Profile Settings &rarr;
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
