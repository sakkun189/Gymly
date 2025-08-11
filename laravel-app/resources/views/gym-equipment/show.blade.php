<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('登録済みジム設備') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- ジム情報表示 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $gym->name }}</h3>
                    <p class="text-gray-500 text-sm">{{ $gym->full_address }}</p>
                </div>
            </div>

            @if (empty($equipmentByCategory))
                <!-- 器具が登録されていない場合 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center">
                        <div class="mb-4">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">ジム設備がまだ登録されていません</h3>
                        <p class="text-gray-500 mb-4">トレーニングメニューの提案を受けるために、ジムの設備を登録しましょう。</p>
                        <a href="{{ route('gym-equipment.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded">
                            設備を登録する
                        </a>
                    </div>
                </div>
            @else
                <!-- 器具一覧表示 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-lg font-medium text-gray-900">登録済みの器具</h3>
                            <a href="{{ route('gym-equipment.index') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded">
                                設備を編集
                            </a>
                        </div>

                        @foreach ($equipmentByCategory as $categoryKey => $categoryData)
                            <div class="mb-6">
                                <h4 class="text-md font-medium text-gray-800 mb-3 bg-gray-50 p-3 rounded">
                                    {{ $categoryData['label'] }} ({{ $categoryData['equipment']->count() }}個)
                                </h4>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 ml-4">
                                    @foreach ($categoryData['equipment'] as $gymEquipment)
                                        <div class="border border-gray-200 rounded-lg p-3 bg-gray-50">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1">
                                                    <h5 class="font-medium text-gray-900">
                                                        {{ $gymEquipment->display_name }}
                                                    </h5>
                                                    @if ($gymEquipment->equipment->description)
                                                        <p class="text-sm text-gray-600 mt-1">
                                                            {{ $gymEquipment->equipment->description }}
                                                        </p>
                                                    @endif
                                                    @if ($gymEquipment->notes)
                                                        <p class="text-sm text-blue-600 mt-1">
                                                            メモ: {{ $gymEquipment->notes }}
                                                        </p>
                                                    @endif
                                                </div>
                                                @if (!$gymEquipment->equipment->is_default)
                                                    <span class="ml-2 bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">
                                                        カスタム
                                                    </span>
                                                @endif
                                            </div>
                                            
                                            @if ($gymEquipment->equipment->youtube_url)
                                                <div class="mt-2">
                                                    <a href="{{ $gymEquipment->equipment->youtube_url }}" target="_blank" class="text-sm text-red-600 hover:text-red-500 flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                                        </svg>
                                                        使い方動画
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <a href="{{ route('dashboard') }}" class="text-indigo-600 hover:text-indigo-500">
                                    ← ダッシュボードに戻る
                                </a>
                                <div class="text-sm text-gray-500">
                                    合計: {{ collect($equipmentByCategory)->sum(function($category) { return $category['equipment']->count(); }) }}個の器具が登録されています
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
