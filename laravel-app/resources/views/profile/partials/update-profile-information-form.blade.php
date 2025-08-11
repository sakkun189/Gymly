<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('プロフィール情報') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("アカウントのプロフィール情報とメールアドレスを更新してください。") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('名前')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="age" :value="__('年齢')" />
            <x-text-input id="age" name="age" type="number" class="mt-1 block w-full" :value="old('age', $user->age)" required min="13" max="120" />
            <x-input-error class="mt-2" :messages="$errors->get('age')" />
        </div>

        <div>
            <x-input-label for="gender" :value="__('性別')" />
            <select id="gender" name="gender" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">選択してください</option>
                <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>男性</option>
                <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>女性</option>
                <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>その他</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('メールアドレス')" />
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

        <div>
            <label for="matching_enabled" class="inline-flex items-center">
                <input id="matching_enabled" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="matching_enabled" value="1" {{ old('matching_enabled', $user->matching_enabled) ? 'checked' : '' }}>
                <span class="ms-2 text-sm text-gray-600">{{ __('トレーニング仲間マッチング機能を利用する') }}</span>
            </label>
            <x-input-error class="mt-2" :messages="$errors->get('matching_enabled')" />
        </div>

        @if($user->gym)
        <div>
            <x-input-label :value="__('通っているジム')" />
            <div class="mt-1 p-3 bg-gray-50 rounded-md">
                <p class="font-medium text-gray-900">{{ $user->gym->name }}</p>
                <p class="text-sm text-gray-600">{{ $user->gym->full_address }}</p>
                <p class="text-xs text-gray-500 mt-1">ジム情報の変更は管理者にお問い合わせください</p>
            </div>
        </div>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('保存') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('保存されました。') }}</p>
            @endif
        </div>
    </form>
</section>
