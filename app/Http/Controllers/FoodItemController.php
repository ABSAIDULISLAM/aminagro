<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\FoodItem;
use App\Models\Shed;
use App\Models\Supplier;
use App\Models\CowFeedDtls;
use App\Models\FoodUnit;
use App\Models\CowFood;
use App\Models\Expense;
use Validator;
use Session;

class FoodItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['alldata'] = $foodItems = FoodItem::paginate(20);
        return view('food-item.index', $data);
    }

    public function addFood()
    {
        $data['alldata'] = FoodItem::paginate(20);
        $supplier = Supplier::all();
        $foodItem = FoodItem::all()->groupBy('name')->map(function ($group) {
            return $group->first();
        });
        $foodUnit = FoodUnit::all();
        //return view('food-item.addFood', $data);
        return view('food-item.addFood', compact('data', 'supplier', 'foodItem', 'foodUnit'));
    }

    public function addFoodSave(Request $request)
    {
        $branch_id = Session::get('branch_id');

        $this->validate($request, [
            'supplier' => 'required',
            'food' => 'required',
            'quantity' => 'required|numeric',
            'unit' => 'required',
            'price' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'required',
        ]);

        // Create CowFood record
        $cowFood = CowFood::create([
            'branch' => $branch_id,
            'supplier' => $request->supplier,
            'food' => $request->food,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'price' => $request->price,
            'date' => $request->date,
            'description' => $request->description,
        ]);

        $foodItem = FoodItem::where('id', $request->food)->first();

        // Create Expense record
        Expense::create([
            'purpose_id' => 7,
            'date' => $request->date,
            'amount' => $request->price,
            'note' => $request->description,
            'food' => $foodItem->name . ' ' . $request->quantity . ' ' . $request->unit,
            'created_by' => 1,
        ]);

        $unit = $request->unit;
        $foodItemWithUnit = DB::table('food_items')
            ->where('name', $foodItem->name)
            ->where(function ($query) use ($unit) {
                $query->where('unit', $unit)
                    ->orWhere('unit', '0');
            })
            ->exists();

        if ($foodItemWithUnit) {
            // Update existing food_items record
            DB::table('food_items')
                ->where('name', $foodItem->name)
                ->where(function ($query) use ($unit) {
                    $query->where('unit', $unit)
                        ->orWhere('unit', '0');
                })
                ->update([
                    'stock' => DB::raw("stock + {$request->quantity}"),
                    'unit' => $request->unit
                ]);

            // Get the updated food_items.id
            $updatedFoodItem = DB::table('food_items')
                ->where('name', $foodItem->name)
                ->where(function ($query) use ($unit) {
                    $query->where('unit', $unit)
                        ->orWhere('unit', '0');
                })
                ->first();

            // Update CowFood.food with the updated food_items.id
            if ($updatedFoodItem) {
                $cowFood->update(['food' => $updatedFoodItem->id]);
            }
        } else {
            // Insert new food_items record
            $newFoodItemId = DB::table('food_items')->insertGetId([
                'name' => $foodItem->name,
                'unit' => $unit,
                'stock' => $request->quantity,
            ]);

            // Update CowFood.food with the new food_items.id
            $cowFood->update(['food' => $newFoodItemId]);
        }

        Session::flash('success', 'Food added successfully!');
        return redirect()->route('addFood');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input  = $request->all();
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', 'Please Fillup all Inputs.');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color', 'warning');
        }

        try {
            $bug = 0;
            $insert = FoodItem::create($input);
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
        }

        if ($bug == 0) {
            Session::flash('flash_message', 'New Data Successfully Saved !');
            return redirect()->back()->with('status_color', 'success');
        } else {
            Session::flash('flash_message', 'Something Error Found !');
            return redirect()->back()->with('status_color', 'danger');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = FoodItem::findOrFail($id);
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('flash_message', 'Please Fillup all Inputs.');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color', 'warning');
        }

        try {
            $bug = 0;
            $data->update($input);
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
        }

        if ($bug == 0) {
            Session::flash('flash_message', 'Data Successfully Updated !');
            return redirect()->back()->with('status_color', 'warning');
        } else {
            Session::flash('flash_message', 'Something Error Found !');
            return redirect()->back()->with('status_color', 'danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = FoodItem::findOrFail($id);
        try {
            $bug = 0;
            $delete = $data->delete();
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
        }

        if ($bug == 0) {

            Session::flash('flash_message', 'Data Successfully Deleted !');
            return redirect()->back()->with('status_color', 'danger');
        } else {

            Session::flash('flash_message', 'Something Error Found !');
            return redirect()->back()->with('status_color', 'danger');
        }
    }

    public function mix_food()
    {
        $data['all_sheds'] = Shed::where('branch_id', Session::get('branch_id'))->get();
        $data['food_items'] = FoodItem::orderBy('name', 'asc')->where('stock', '!=', '0')->get();
        $data['food_units'] = FoodUnit::orderBy('name', 'asc')->get();
        return view('food-item.mix-food', $data);
    }


    public function mix_food_add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'date' => 'required',
            'cow_feed' => 'array',
            'cow_feed.*.item_id' => 'exists:food_items,id',
            'cow_feed.*.qty' => 'nullable|numeric|min:1',
            'cow_feed.*.unit_id' => 'nullable|exists:food_units,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Filter out unchecked items
        $filteredCowFeed = array_filter($request->cow_feed, function ($feed) {
            return isset($feed['item_id']) && !empty($feed['item_id']);
        });

        if (empty($filteredCowFeed)) {
            return redirect()->back()->with('error', 'No food items selected!');
        }

        DB::beginTransaction();

        try {
            $totalQty = 0;
            $selectedItems = [];
            $itemIds = implode(',', array_column($filteredCowFeed, 'item_id'));

            foreach ($filteredCowFeed as $feed) {
                $foodItem = FoodItem::findOrFail($feed['item_id']);

                if ($foodItem->stock < $feed['qty']) {
                    throw new \Exception("Insufficient stock for {$foodItem->name}");
                }

                $foodItem->stock -= $feed['qty'];
                $foodItem->save();

                $totalQty += $feed['qty'];
                $selectedItems[] = [
                    'item_id' => $feed['item_id'],
                    'qty' => $feed['qty'],
                    'unit_id' => $feed['unit_id'],
                ];
            }

            $mixedFoodItem = FoodItem::create([
                'name' => $request->name,
                'stock' => $totalQty,
                'unit' => 'KG',
                'date' => $request->date,
                'food_id' => $itemIds, // Comma-separated IDs
            ]);

            foreach ($selectedItems as $item) {
                CowFeedDtls::create([
                    'mixed_food_id' => $mixedFoodItem->id,
                    'item_id' => $item['item_id'],
                    'qty' => $item['qty'],
                    'unit_id' => $item['unit_id'],
                ]);
            }

            DB::commit();
            return redirect()->back()->with('success', 'Mixed food created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
