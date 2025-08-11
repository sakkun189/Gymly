<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('名前（ニックネーム可）')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Age -->
        <div class="mt-4">
            <x-input-label for="age" :value="__('年齢')" />
            <x-text-input id="age" class="block mt-1 w-full" type="number" name="age" :value="old('age')" required min="13" max="120" />
            <x-input-error :messages="$errors->get('age')" class="mt-2" />
        </div>

        <!-- Gender -->
        <div class="mt-4">
            <x-input-label for="gender" :value="__('性別')" />
            <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                <option value="">選択してください</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>男性</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>女性</option>
                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>その他</option>
            </select>
            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('パスワード')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <p class="text-sm text-gray-600 mt-1">8桁以上、英字と数字を必ず含む</p>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('パスワード確認')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Gym Information -->
        <div class="mt-6 p-4 bg-gray-50 rounded-md">
            <h3 class="text-lg font-medium text-gray-900 mb-4">通っているジム情報</h3>
            
            <!-- Gym Name -->
            <div>
                <x-input-label for="gym_name" :value="__('ジム名称')" />
                <x-text-input id="gym_name" class="block mt-1 w-full" type="text" name="gym_name" :value="old('gym_name')" required />
                <x-input-error :messages="$errors->get('gym_name')" class="mt-2" />
            </div>

            <!-- Gym Prefecture -->
            <div class="mt-4">
                <x-input-label for="gym_prefecture" :value="__('都道府県')" />
                <x-text-input id="gym_prefecture" class="block mt-1 w-full" type="text" name="gym_prefecture" :value="old('gym_prefecture')" required placeholder="例: 東京都" />
                <x-input-error :messages="$errors->get('gym_prefecture')" class="mt-2" />
            </div>

            <!-- Gym City -->
            <div class="mt-4">
                <x-input-label for="gym_city" :value="__('市区町村')" />
                <x-text-input id="gym_city" class="block mt-1 w-full" type="text" name="gym_city" :value="old('gym_city')" required placeholder="例: 渋谷区" />
                <x-input-error :messages="$errors->get('gym_city')" class="mt-2" />
            </div>

            <!-- Gym Address -->
            <div class="mt-4">
                <x-input-label for="gym_address" :value="__('番地・建物名')" />
                <x-text-input id="gym_address" class="block mt-1 w-full" type="text" name="gym_address" :value="old('gym_address')" required placeholder="例: 道玄坂1-1-1 〇〇ビル3F" />
                <x-input-error :messages="$errors->get('gym_address')" class="mt-2" />
            </div>
        </div>

        <!-- Matching Enabled -->
        <div class="mt-4">
            <label for="matching_enabled" class="inline-flex items-center">
                <input id="matching_enabled" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="matching_enabled" value="1" {{ old('matching_enabled') ? 'checked' : '' }}>
                <span class="ms-2 text-sm text-gray-600">{{ __('トレーニング仲間マッチング機能を利用する') }}</span>
            </label>
            <p class="text-sm text-gray-500 mt-1">後から設定を変更することも可能です</p>
            <x-input-error :messages="$errors->get('matching_enabled')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('すでに登録済みの方はこちら') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('登録') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
