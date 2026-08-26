<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    {{-- Success messages--}}
    @if (session('status') === 'profile-updated')
        <div class="p-4 mt-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
            {{ __('Profile information updated successfully!') }}
        </div>
    @endif

    {{-- 2.Error messages--}}
    @if ($errors->any())
        <div class="p-4 mt-4 text-sm text-red-800 rounded-lg bg-red-50">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- resend validation--}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- update profile & image--}}
    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Profile Photo -->
        <div>
            <x-input-label for="image" :value="__('Profile Photo')" />

            <div class="flex items-center gap-4 mt-2">
                @if($user->image)
                    <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Photo" class="w-16 h-16 rounded-full object-cover shadow">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->full_name) }}&background=0D8ABC&color=fff" alt="Profile Photo" class="w-16 h-16 rounded-full object-cover shadow">
                @endif

                <input id="image" name="image" type="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" accept="image/*" />
            </div>

            <x-input-error class="mt-2" :messages="$errors->get('image')" />
        </div>

        <!-- Full Name -->
        <div>
            <x-input-label for="full_name" :value="__('Full Name')" />
            <x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full" :value="old('full_name', $user->full_name)" required autofocus autocomplete="full_name" />
            <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Saved button--}}
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
