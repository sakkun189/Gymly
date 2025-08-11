<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ダッシュボード') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- ウェルカムメッセージ -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">{{ auth()->user()->name }}さん、ようこそGymlyへ！</h3>
                    <p class="mt-2 text-gray-600">ユーザーID: {{ auth()->user()->user_id }}</p>
                </div>
            </div>

            <!-- ユーザー情報 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">あなたの情報</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">年齢</p>
                            <p class="font-medium">{{ auth()->user()->age }}歳</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">性別</p>
                            <p class="font-medium">
                                @switch(auth()->user()->gender)
                                    @case('male')
                                        男性
                                        @break
                                    @case('female')
                                        女性
                                        @break
                                    @case('other')
                                        その他
                                        @break
                                @endswitch
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">マッチング機能</p>
                            <p class="font-medium">
                                {{ auth()->user()->matching_enabled ? '利用中' : '利用しない' }}
                            </p>
                        </div>
                        @if(auth()->user()->gym)
                        <div>
                            <p class="text-sm text-gray-600">通っているジム</p>
                            <p class="font-medium">{{ auth()->user()->gym->name }}</p>
                            <p class="text-sm text-gray-500">{{ auth()->user()->gym->full_address }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- 次のステップ -->
            <div class="bg-blue-50 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-blue-900 mb-4">次のステップ</h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-medium">1</span>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="font-medium text-blue-900">ジム設備を登録する</p>
                                <p class="text-sm text-blue-700">通っているジムにある器具を登録しましょう</p>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('gym-equipment.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-1 px-3 rounded">
                                    登録
                                </a>
                                <a href="{{ route('gym-equipment.show') }}" class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-sm font-medium py-1 px-3 rounded">
                                    確認
                                </a>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-medium">2</span>
                            </div>
                            <div class="ml-3">
                                <p class="font-medium text-blue-900">トレーニングメニューを確認する</p>
                                <p class="text-sm text-blue-700">あなたのジムに合わせたメニューを提案します</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-medium">3</span>
                            </div>
                            <div class="ml-3">
                                <p class="font-medium text-blue-900">トレーニングを始める</p>
                                <p class="text-sm text-blue-700">記録をつけて進捗を確認しましょう</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
