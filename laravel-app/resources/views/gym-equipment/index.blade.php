<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ジム設備の登録') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- ジム情報表示 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">登録対象のジム</h3>
                    <p class="text-gray-700 font-medium">{{ $gym->name }}</p>
                    <p class="text-gray-500 text-sm">{{ $gym->full_address }}</p>
                </div>
            </div>

            <!-- 成功メッセージ -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- エラーメッセージ -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('gym-equipment.store') }}">
                @csrf

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-6">あなたのジムにある器具を選択してください</h3>
                        
                        @foreach ($equipmentByCategory as $categoryKey => $categoryData)
                            <div class="mb-8">
                                <h4 class="text-md font-medium text-gray-800 mb-4 bg-gray-50 p-3 rounded">
                                    {{ $categoryData['label'] }}
                                </h4>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 ml-4">
                                    @forelse ($categoryData['equipment'] as $equipment)
                                        <label class="inline-flex items-center">
                                            <input 
                                                type="checkbox" 
                                                name="equipment[]" 
                                                value="{{ $equipment->id }}"
                                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                                {{ in_array($equipment->id, $currentEquipment) ? 'checked' : '' }}
                                            >
                                            <span class="ml-2 text-sm text-gray-700">{{ $equipment->name }}</span>
                                            @if ($equipment->description)
                                                <span class="ml-1 text-xs text-gray-500" title="{{ $equipment->description }}">ⓘ</span>
                                            @endif
                                        </label>
                                    @empty
                                        <p class="text-gray-500 text-sm">この部位の器具はまだ登録されていません。</p>
                                    @endforelse
                                </div>

                                <!-- カスタム器具入力欄 -->
                                <div class="mt-4 ml-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        {{ $categoryData['label'] }}の器具で上記にないもの（自由入力）
                                    </label>
                                    <div class="space-y-2">
                                        <input 
                                            type="text" 
                                            name="custom_equipment[{{ $categoryKey }}][]"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            placeholder="例: 〇〇メーカーのマシン名"
                                        >
                                        <input 
                                            type="text" 
                                            name="custom_equipment[{{ $categoryKey }}][]"
                                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            placeholder="複数ある場合はこちらにも入力"
                                        >
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <div class="flex items-center justify-between">
                                <a href="{{ route('gym-equipment.show') }}" class="text-indigo-600 hover:text-indigo-500">
                                    現在登録されている器具を確認
                                </a>
                                <div class="flex space-x-3">
                                    <a href="{{ route('dashboard') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded">
                                        キャンセル
                                    </a>
                                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded">
                                        登録・更新
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 p-4 bg-blue-50 rounded-md">
                            <h4 class="text-sm font-medium text-blue-900 mb-2">💡 ヒント</h4>
                            <ul class="text-sm text-blue-800 space-y-1">
                                <li>• 同じジムの他のユーザーが登録した器具も共有されます</li>
                                <li>• カスタム入力した器具は、今後このジムに登録する他のユーザーにも表示されます</li>
                                <li>• いつでも設備情報を編集・追加できます</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
