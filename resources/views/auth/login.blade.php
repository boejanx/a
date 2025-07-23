<x-guest-layout>
    <div class="min-h-screen bg-gray-100 text-gray-900 flex justify-center">
        <div class="max-w-screen-xl m-0 sm:m-10 bg-white shadow sm:rounded-lg flex justify-center flex-1">
            <div class="lg:w-1/2 xl:w-5/12 p-6 sm:p-12">
                <div>
                    <img src="https://eoffice.tegalkab.go.id/assets/media/logos/tegal-border.png"
                        class="w-32 mx-auto" />
                </div>
                <div class="mt-6 flex flex-col items-center">
                    <h1 class="text-2xl xl:text-3xl font-extrabold">
                        Login
                    </h1>
                    <p>Silakan masuk untuk melanjutkan</p>

                    <div class="w-full flex-1 mt-8 mb-12">
                        {{-- Form login --}}
                        <form method="POST" action="{{ route('login') }}" class="mx-auto max-w-xs">
                            @csrf

                            {{-- Email/NIP --}}
                            <input
                                class="w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border @error('email') border-red-500 @else border-gray-200 @enderror placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white"
                                type="text" name="email" placeholder="Username / NIP" :value="old('email')" required autofocus>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            {{-- Password --}}
                            <input
                                class="mb-6 w-full px-8 py-4 rounded-lg font-medium bg-gray-100 border @error('password') border-red-500 @else border-gray-200 @enderror placeholder-gray-500 text-sm focus:outline-none focus:border-gray-400 focus:bg-white mt-5"
                                type="password" name="password" placeholder="Password" required>
                            @error('password')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror

                            <div id="captcha"></div>
                            <input type="hidden" name="captcha" id="captcha-input">

                            {{-- Remember Me --}}
                            {{-- Tombol login --}}
                            <button
                                type="submit"
                                class="mt-12 tracking-wide font-semibold bg-indigo-500 text-white w-full py-4 rounded-lg hover:bg-indigo-700 transition-all duration-300 ease-in-out flex items-center justify-center focus:shadow-outline focus:outline-none">
                                <svg class="w-6 h-6 -ml-2" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                    <circle cx="8.5" cy="7" r="4" />
                                    <path d="M20 8v6M23 11h-6" />
                                </svg>
                                <span class="ml-3">Masuk</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Gambar samping --}}
            <div class="flex-1 bg-indigo text-center hidden lg:flex">
                <div class="m-12 xl:m-16 w-full bg-contain bg-center bg-no-repeat"
                    style="background-image: url('{{ asset('assets/img/logo/bg.png') }}');">
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
