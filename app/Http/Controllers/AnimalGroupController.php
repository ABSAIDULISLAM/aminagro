<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnimalGroupController extends Controller
{
    public function index()
    {
        $alldata = Group::with('animals')->get();
        $cows = Animal::all();
        $groups = Group::all();
        $ids = [];
        foreach ($groups as $key => $value) {
           $ids =  $value->animals->pluck('id');
        }

        return view('animal_group.index', compact('alldata', 'cows','groups'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'group_id' => 'required|exists:groups,id',
        'cow_ids' => 'required|array',
        'cow_ids.*' => 'exists:animals,id',
    ]);
// Custom validation to check duplicates
    $validator->after(function ($validator) use ($request) {
        $group = \App\Models\Group::find($request->group_id);
        $existingIds = $group->animals()->pluck('animal_id')->toArray();

        $duplicates = array_intersect($existingIds, $request->cow_ids ?? []);

        if (!empty($duplicates)) {
            $validator->errors()->add('cow_ids', 'Some cows are already assigned to this group.');
        }
    });

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }
        $group = Group::findOrFail($request->group_id);
        $group->animals()->syncWithoutDetaching($request->cow_ids); // prevents duplicates

        return redirect()->route('animal-group')->with('success', 'Group assigned successfully!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:groups,id',
            'cow_ids' => 'required|array',
            'cow_ids.*' => 'exists:animals,id',
        ]);

        $group = Group::findOrFail($request->group_id);
        $group->animals()->sync($request->cow_ids); // replace with new animals

        return redirect()->route('animal-group')->with('success', 'Group updated successfully!');
    }

    public function getCowsByGroup($group_id)
    {
        $group = Group::with('animals')->find($group_id);
        if (!$group) {
            return response()->json([]);
        }

        return response()->json($group->animals); // or ->cows depending on your relation
    }


}
