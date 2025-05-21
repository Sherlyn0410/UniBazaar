<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-6 px-10">
        <div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
            <div class="flex items-center gap-6">
                <!-- Profile Picture Placeholder -->
                <img src="https://i.pravatar.cc/100?u={{ Auth::id() }}" alt="Profile Picture" class="rounded-full w-24 h-24">
                
                <div>
                    <h2 class="text-2xl font-bold">{{ Auth::user()->name }}</h2>
                    <p class="text-green-600 font-semibold">Verified</p>
                </div>

                <!-- Change Picture Button (not functional yet) -->
                <div class="ml-auto">
                    <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Change picture</button>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div class="mt-6 border-b border-gray-200">
                <nav class="flex space-x-6">
                    <a href="#" class="font-semibold text-gray-800 border-b-2 border-gray-800 pb-2">Profile</a>
                    <a href="#" class="text-gray-500">Listings</a>
                    <a href="#" class="text-gray-500">Order History</a>
                    <a href="#" class="text-gray-500">Review</a>
                </nav>
            </div>

            <!-- Profile Form -->
            <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea name="message" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Your message here..."></textarea>
                </div>

                <div>
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

