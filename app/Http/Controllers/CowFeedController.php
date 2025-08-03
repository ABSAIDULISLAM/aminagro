<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Shed;
use App\Models\Animal;
use App\Models\Calf;
use App\Models\FoodUnit;
use App\Models\FoodItem;
use App\Models\CowFeed;
use App\Models\CowFood;
use App\Models\CowFeedDtls;
use App\Models\FoodReport;
use App\Models\Group;
use App\Models\Supplier;
use Carbon\Carbon;
use Validator;
use Response;
use Session;

class CowFeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['alldata'] = CowFeed::leftJoin('sheds', 'sheds.id', 'cow_feed.shed_no')
        //     ->where('cow_feed.branch_id', Session::get('branch_id'))
        //     ->select('cow_feed.*', 'sheds.shed_number')
        //     ->orderBy('shed_no', 'ASC')
        //     ->paginate(40);
        $data['alldata'] = CowFeed::leftJoin('groups', 'groups.id', 'cow_feed.shed_no')
            ->where('cow_feed.branch_id', Session::get('branch_id'))
            ->select('cow_feed.*', 'groups.group_name')
            ->orderBy('shed_no', 'ASC')
            ->paginate(40);
        return view('cow-feed.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['all_sheds'] = Shed::where('branch_id', Session::get('branch_id'))->get();
        $data['food_items'] = FoodItem::orderBy('name', 'asc')
            ->where('stock', '!=', '0')->get();
        $data['food_units'] = FoodUnit::orderBy('name', 'asc')->get();
        $data['groups'] = Group::with('animals')->get();
        return view('cow-feed.form', $data);
    }

    public function FoodStockReport()
    {
        $data['all_sheds'] = Shed::where('branch_id', Session::get('branch_id'))->get();
        $data['food_items'] = FoodItem::orderBy('name', 'asc')->get();
        $data['food_units'] = FoodUnit::orderBy('name', 'asc')->get();
        $data['cow_food'] = CowFood::all();
        $data['cow_food'] = DB::table('cow_food')
            ->join('branchs', 'cow_food.branch', '=', 'branchs.id')
            ->join('food_items', 'cow_food.food', '=', 'food_items.id')
            ->select(
                'cow_food.*',
                'branchs.branch_name as branch_name',
                'food_items.name as food_name'
            )
            ->orderBy('cow_food.id', 'desc')
            ->get();
        return view('cow-feed.FoodStockReport', $data);
    }

    public function search(Request $request)
    {
        $all_sheds = Shed::where('branch_id', Session::get('branch_id'))->get();
        $food_items = FoodItem::orderBy('name', 'asc')->get();
        $food_units = FoodUnit::orderBy('name', 'asc')->get();
        // Validate input dates
        $this->validate($request, [
            'fdate' => 'required',
            'tdate' => 'required',
        ]);

        // Convert dates from mm/dd/yyyy to yyyy-mm-dd (database format)
        $fromDate = $request->fdate;
        $toDate = $request->tdate;

        // Query the database to filter cow food by date range
        $cow_food = DB::table('cow_food')
            ->join('branchs', 'cow_food.branch', '=', 'branchs.id')
            ->join('food_items', 'cow_food.food', '=', 'food_items.id')
            ->select(
                'cow_food.*',
                'branchs.branch_name as branch_name',
                'food_items.name as food_name'
            )
            ->whereBetween('cow_food.date', [$fromDate, $toDate]) // Add date range filter
            ->orderBy('cow_food.id', 'desc')
            ->get();

        // Return the view with filtered data
        return view('cow-feed.FoodStockReport', compact('cow_food', 'all_sheds'));
    }

    public function CowFeedReport()
    {
        $data['all_sheds'] = Shed::where('branch_id', Session::get('branch_id'))->get();
        $data['food_items'] = FoodItem::orderBy('name', 'asc')->get();
        $data['food_units'] = FoodUnit::orderBy('name', 'asc')->get();
        $data['cow_food'] = DB::table('cow_food')
            ->join('branchs', 'cow_food.branch', '=', 'branchs.id')
            ->join('food_items', 'cow_food.food', '=', 'food_items.id')
            ->select(
                'cow_food.*',
                'branchs.branch_name as branch_name',
                'food_items.name as food_name'
            )
            ->orderBy('cow_food.id', 'desc')
            ->get();
        return view('cow-feed.CowFeedReport', $data);
    }

    public function CowFeedReportEdit($id)
    {
        $cow_food = DB::table('cow_food')->where('id', $id)->first();
        $data['alldata'] = FoodItem::paginate(20);
        $supplier = Supplier::all();
        $foodItem = FoodItem::all()->groupBy('name')->map(function ($group) {
            return $group->first();
        });
        $foodUnit = FoodUnit::all();
        return view('cow-feed.CowFeedReportEdit', compact('data', 'supplier', 'foodItem', 'foodUnit', 'cow_food'));
    }

    public function CowFeedReportUpdate(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'supplier' => 'required|string', // Supplier is a string (name)
            'food' => 'required|exists:food_items,id', // Food is an ID from food_items table
            'quantity' => 'required|numeric|min:0', // Quantity must be a positive number
            'unit' => 'required|string', // Unit is a string (name)
            'price' => 'required|numeric|min:0', // Price must be a positive number
            'description' => 'nullable|string', // Description is optional
            'date' => 'required|date', // Date must be a valid date
        ]);

        // Update the record in the database
        DB::table('cow_food')
            ->where('id', $id)
            ->update([
                'supplier' => $request->input('supplier'), // Update supplier
                'food' => $request->input('food'), // Update food (ID)
                'quantity' => $request->input('quantity'), // Update quantity
                'unit' => $request->input('unit'), // Update unit
                'price' => $request->input('price'), // Update price
                'description' => $request->input('description'), // Update description
                'date' => $request->input('date'), // Update date
            ]);

        // Redirect back with a success message
        return redirect()->route('CowFeedReport')->with('success', 'Record updated successfully.');
    }
    public function CowFeedReportDelete($id)
    {
        // Delete the record
        DB::table('cow_food')->where('id', $id)->delete();

        // Redirect with a success message
        return redirect()->route('CowFeedReport')->with('success', 'Record deleted successfully.');
    }

    public function CowFeedStockReport()
    {
        $data['all_sheds'] = Shed::where('branch_id', Session::get('branch_id'))->get();

        $data['food_report'] = DB::table('food_items')
            ->select(
                'food_items.id',
                'food_items.name',
                'food_items.unit',
                'food_items.stock',
                'food_items.food_id'
            )
            ->where('food_items.stock', '>', 0)
            ->orderBy('food_items.name')
            ->get()
            ->map(function ($item) {
                // Initialize values
                $item->price = null;
                $item->total_value = null;

                // Determine which food IDs to use for price lookup
                $lookupIds = !empty($item->food_id) ? explode(',', $item->food_id) : [$item->id];

                // Get the latest price for each lookup ID
                $prices = DB::table('cow_food')
                    ->whereIn('food', $lookupIds)
                    ->orderBy('created_at', 'desc')
                    ->get()
                    ->groupBy('food')
                    ->map(function ($group) {
                        return $group->first()->price;
                    });

                // Use the average price if multiple IDs, or single price if one ID
                if ($prices->isNotEmpty()) {
                    $item->price = $prices->avg();
                    $item->total_value = $item->price * $item->stock;
                }

                return $item;
            });

        // Rest of your calculations remain the same
        $data['totalByUnit'] = $data['food_report']->groupBy('unit')->map(function ($items) {
            return (object)[
                'unit' => $items->first()->unit,
                'total_stock' => $items->sum('stock'),
                'total_value' => $items->sum('total_value')
            ];
        })->values();

        $data['grandTotalStock'] = $data['food_report']->sum('stock');
        $data['grandTotalValue'] = $data['food_report']->sum('total_value');


        return view('cow-feed.CowFeedStockReport', $data);
    }

    public function CowFeedReportSearch(Request $request)
    {
        $data['all_sheds'] = Shed::where('branch_id', Session::get('branch_id'))->get();
        $data['food_items'] = FoodItem::orderBy('name', 'asc')->get();
        $data['food_units'] = FoodUnit::orderBy('name', 'asc')->get();

        $this->validate($request, [
            'fdate' => 'required',
            'tdate' => 'required',
        ]);

        $fromDate =  $request->fdate;
        $toDate =  $request->tdate;

        $data['cow_food'] = DB::table('cow_food')
            ->join('branchs', 'cow_food.branch', '=', 'branchs.id')
            ->join('food_items', 'cow_food.food', '=', 'food_items.id')
            ->select(
                'cow_food.*',
                'branchs.branch_name as branch_name',
                'food_items.name as food_name'
            )
            ->whereBetween('cow_food.date', [$fromDate, $toDate]) // Add date range filter
            ->orderBy('cow_food.id', 'desc')
            ->get();

        return view('cow-feed.CowFeedReport', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        // Validate required fields
        $validator = Validator::make($input, [
            'shed_no' => 'required|not_in:0',
            'date' => 'required',
            'cow_id' => 'required|array|min:1', // Ensure at least one cow is selected
        ]);

        if ($validator->fails()) {
            Session::flash('flash_message', 'Please fill up all inputs.');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color', 'warning');
        }

        $input['branch_id'] = Session::get('branch_id');
        $input['date'] = date('Y-m-d', strtotime($input['date'])); // Format date properly

        try {
            DB::beginTransaction(); // Start transaction

            // Loop through each selected cow
            foreach ($request->cow_id as $cowId) {
                $input['cow_id'] = $cowId; // Set the current cow ID
                $insert = CowFeed::create($input); // Create a new feed entry for the cow

                if (isset($request->cow_feed)) {
                    foreach ($request->cow_feed as $value) {
                        if (isset($value['item_id']) && isset($value['qty']) && isset($value['unit_id']) && !empty($value['qty'])) {
                            $value['feed_id'] = $insert->id;

                            // Insert feed details
                            CowFeedDtls::create($value);

                            // Fetch the unit and food item
                            $unit = DB::table('food_units')->where('id', $value['unit_id'])->first();
                            if ($unit) {
                                $foodItem = DB::table('food_items')
                                    ->where('id', $value['item_id'])
                                    ->where('unit', $unit->name)
                                    ->first();
                            } else {
                                \Log::error("Unit not found for unit_id", ['unit_id' => $value['unit_id']]);
                            }

                            // Update food item stock
                            if ($foodItem) {
                                if ($foodItem->stock >= $value['qty']) {
                                    DB::table('food_items')
                                        ->where('id', $foodItem->id)
                                        ->update(['stock' => DB::raw("stock - {$value['qty']}")]);
                                } else {
                                    DB::rollBack();
                                    Session::flash('flash_message', "Not enough stock for {$foodItem->name}.");
                                    return redirect()->back()->with('status_color', 'danger');
                                }
                            }
                        }
                    }
                }
            }

            DB::commit(); // Commit transaction

            Session::flash('flash_message', 'New Data Successfully Saved!');
            return redirect('cow-feed')->with('status_color', 'success');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback in case of an error
            Session::flash('flash_message', 'Something went wrong: ' . $e->getMessage());
            return redirect()->back()->with('status_color', 'danger');
        }
    }


    public function loadCow(Request $request)
    {
        $data = Animal::where('branch_id', Session::get('branch_id'))
            ->where('shade_no', $request->shed_no)
            ->where('sale_status', 0)
            ->get();

        if ($data->isEmpty()) {
            $data = Calf::where('branch_id', Session::get('branch_id'))
                ->where('shade_no', $request->shed_no)
                ->where('sale_status', 0)
                ->get();
        }
        return Response::json($data);
    }

    public function loadCowReport(Request $request)
    {
        $data = Animal::where('branch_id', Session::get('branch_id'))
            ->where('shade_no', $request->shed_no)
            ->get();

        if ($data->isEmpty()) {
            $data = Calf::where('branch_id', Session::get('branch_id'))
                ->where('shade_no', $request->shed_no)
                ->get();
        }


        return Response::json($data);
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
        $data['all_sheds'] = Shed::where('branch_id', Session::get('branch_id'))->get();
        $data['food_items'] = FoodItem::orderBy('name', 'asc')->get();
        $data['food_units'] = FoodUnit::orderBy('name', 'asc')->get();
        $data['single_data'] = CowFeed::findOrFail($id);
        $data['cowArr'] = Animal::where('branch_id', Session::get('branch_id'))
            ->where('shade_no', $data['single_data']->shed_no)->get();
        return view('cow-feed.form', $data);
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
        $data = CowFeed::findOrFail($id);
        $input  = $request->all();
        $validator = Validator::make($request->all(), [
            'shed_no' => 'required|not_in:0',
            'cow_id' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('flash_message', 'Please Fillup all Inputs.');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color', 'warning');
        }

        $input['branch_id'] = Session::get('branch_id');
        $input['date'] = date('y-m-d', strtotime($input['date']));

        try {
            $bug = 0;
            $data->update($input);
            CowFeedDtls::where('feed_id', $data->id)->delete();
            foreach ($request->cow_feed as $value) {
                if (isset($value['item_id'])) {
                    $value['feed_id'] = $data->id;
                    CowFeedDtls::create($value);
                }
            }
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
        }

        if ($bug == 0) {
            Session::flash('flash_message', 'Data Successfully Updated !');
            return redirect('cow-feed')->with('status_color', 'warning');
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
        $data = CowFeed::findOrFail($id);
        try {
            $bug = 0;
            $delete = $data->delete();
            CowFeedDtls::where('feed_id', $id)->delete();
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
}
