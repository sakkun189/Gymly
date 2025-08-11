<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\GymEquipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GymEquipmentController extends Controller
{
    /**
     * Display the gym equipment registration form.
     */
    public function index(): View
    {
        $user = Auth::user();
        $gym = $user->gym;
        
        if (!$gym) {
            abort(404, 'ジム情報が登録されていません。');
        }

        // カテゴリ別に器具を取得
        $categories = [
            'chest' => '胸',
            'back' => '背中', 
            'legs' => '脚',
            'arms' => '腕',
            'shoulders' => '肩',
            'abs' => '腹',
            'cardio' => '有酸素',
            'other' => 'その他',
        ];

        $equipmentByCategory = [];
        foreach ($categories as $categoryKey => $categoryLabel) {
            $equipmentByCategory[$categoryKey] = [
                'label' => $categoryLabel,
                'equipment' => Equipment::byCategory($categoryKey)->default()->get(),
            ];
        }

        // 現在のジムで登録済みの器具
        $currentEquipment = $gym->equipment->pluck('id')->toArray();

        return view('gym-equipment.index', compact('equipmentByCategory', 'currentEquipment', 'gym'));
    }

    /**
     * Store the gym equipment registration.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();
        $gym = $user->gym;

        if (!$gym) {
            return redirect()->back()->withErrors(['error' => 'ジム情報が登録されていません。']);
        }

        $request->validate([
            'equipment' => 'array',
            'equipment.*' => 'exists:equipment,id',
            'custom_equipment' => 'array',
            'custom_equipment.*' => 'string|max:255',
        ]);

        // 現在の器具登録を削除（今回のユーザーが追加したもののみ）
        GymEquipment::where('gym_id', $gym->id)
                   ->where('added_by_user_id', $user->id)
                   ->delete();

        // 選択された器具を登録
        if ($request->has('equipment')) {
            foreach ($request->equipment as $equipmentId) {
                GymEquipment::create([
                    'gym_id' => $gym->id,
                    'equipment_id' => $equipmentId,
                    'added_by_user_id' => $user->id,
                ]);
            }
        }

        // カスタム器具を登録
        if ($request->has('custom_equipment')) {
            foreach ($request->custom_equipment as $category => $customNames) {
                foreach ($customNames as $customName) {
                    if (!empty($customName)) {
                        // カスタム器具用の Equipment レコードを作成
                        $equipment = Equipment::create([
                            'name' => $customName,
                            'category' => $category,
                            'is_default' => false,
                        ]);

                        GymEquipment::create([
                            'gym_id' => $gym->id,
                            'equipment_id' => $equipment->id,
                            'custom_name' => $customName,
                            'added_by_user_id' => $user->id,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('gym-equipment.index')
                         ->with('success', 'ジム設備の登録が完了しました。');
    }

    /**
     * Display the gym equipment list.
     */
    public function show(): View
    {
        $user = Auth::user();
        $gym = $user->gym;

        if (!$gym) {
            abort(404, 'ジム情報が登録されていません。');
        }

        $equipmentByCategory = [];
        $categories = [
            'chest' => '胸',
            'back' => '背中',
            'legs' => '脚', 
            'arms' => '腕',
            'shoulders' => '肩',
            'abs' => '腹',
            'cardio' => '有酸素',
            'other' => 'その他',
        ];

        foreach ($categories as $categoryKey => $categoryLabel) {
            $equipment = $gym->gymEquipment()
                           ->whereHas('equipment', function($query) use ($categoryKey) {
                               $query->where('category', $categoryKey);
                           })
                           ->with('equipment')
                           ->get();

            if ($equipment->isNotEmpty()) {
                $equipmentByCategory[$categoryKey] = [
                    'label' => $categoryLabel,
                    'equipment' => $equipment,
                ];
            }
        }

        return view('gym-equipment.show', compact('equipmentByCategory', 'gym'));
    }
}
