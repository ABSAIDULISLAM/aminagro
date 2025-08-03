<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Animal;
use App\Models\Calf;
use App\Models\Color;
use App\Models\AnimalType;
use App\Models\Shed;
use App\Models\Vaccines;
use App\Models\DeadAnimal;
use App\Models\DeadCalf;
use App\Models\CollectMilk;
use App\Models\SickCow;
use Validator;
use Session;

class AnimalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index(Request $request)
{
    $query = Animal::leftJoin('users', 'users.id', 'animals.user_id')
        ->leftJoin('users_type', 'users_type.id', 'users.user_type')
        ->where('animals.branch_id', Session::get('branch_id'));

    // Apply status filter if provided
    if ($request->filled('status')) {
        $query->where('animals.sale_status', $request->status);
    }

    // Apply Bull_Stage filter if provided
    if ($request->filled('bull_stage')) {
        $query->where('animals.Bull_Stage', $request->bull_stage);
    }

    $data['all_animals'] = $query->orderBy('animals.id', 'desc')
        ->select('animals.*', 'users.name', 'users_type.user_type')
        ->paginate(50);

    // Pass filter values back to view
    $data['current_status'] = $request->status;
    $data['current_bull_stage'] = $request->bull_stage;

    return view('animal.animalList', $data);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['all_colors'] = Color::all();
        $data['all_animal_type'] = AnimalType::whereRaw("type != 1 OR type IS NULL")->get();
        $data['all_animal_breed'] = AnimalType::whereRaw("type = 1 ")->get();
        $data['all_vaccines'] = Vaccines::all();
        $data['all_sheds'] = Shed::where('branch_id', Session::get('branch_id'))->get();
        return view('animal.animalForm', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'id' => 'unique:animals,id',
        'age' => 'required',
        'weight' => 'required',
        'height' => 'required',
        'gender' => 'required',
        'color' => 'required',
        'animal_type' => 'required',
        'pregnant_status' => 'required',
        'shade_no' => 'required',
        'previous_vaccine_done' => 'required',
    ]);

    if ($validator->fails()) {
        $plainErrorText = "";
        foreach ($validator->messages()->all() as $error) {
            $plainErrorText .= $error . ". ";
        }
        Session::flash('flash_message', $plainErrorText);
        return redirect()->back()->withErrors($validator)->withInput()->with('status_color', 'warning');
    }

    $input = $request->all();

    // Convert date fields
    $input['buy_date'] = !empty($request->buy_date) ? date('Y-m-d', strtotime($request->buy_date)) : null;
    $input['pregnancy_time'] = !empty($request->pregnancy_time) ? date('Y-m-d', strtotime($request->pregnancy_time)) : null;
    $input['DOB'] = !empty($request->DOB) ? date('Y-m-d', strtotime($request->DOB)) : null;

    // Set branch ID
    $input['branch_id'] = Session::get('branch_id');

    // Convert vaccines array to JSON
    $input['vaccines'] = isset($request->vaccines) ? json_encode($request->vaccines) : '';

    $newImages = [];
    if ($request->hasfile('animal_image')) {
        foreach ($request->file('animal_image') as $image) {
            $fileName = rand(1, 1000) . date('dmyhis') . "." . $image->getClientOriginalExtension();
            $newImages[] = $fileName;
        }
        $input['pictures'] = implode('_', $newImages);
    }

    try {
        $bug = 0;
        $animal = Animal::create($input);

        // Move images to storage
        if ($request->hasfile('animal_image')) {
            foreach ($request->file('animal_image') as $index => $image) {
                $image->storeAs('public/uploads/animal', $newImages[$index]);
            }
        }

        // Mark the selected stall as booked
        Shed::where('id', $request->shade_no)->update(['status' => 1]);
    } catch (\Exception $e) {
        \Log::error('Store Error: ' . $e->getMessage());
        return redirect()->back()->with('status_color', 'danger')->with('flash_message', 'Error: ' . $e->getMessage());
    }

    if ($bug == 0) {
        Session::flash('flash_message', 'Animal Successfully Saved!');
        return redirect('animal')->with('status_color', 'success');
    } else {
        Session::flash('flash_message', 'Something Error Found!');
        return redirect('animal/create')->with('status_color', 'danger');
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
        $data['all_colors'] = Color::all();
        $data['all_animal_type'] = AnimalType::whereRaw("type != 1 OR type IS NULL")->get();
        $data['all_animal_breed'] = AnimalType::whereRaw("type = 1 ")->get();
        $data['all_vaccines'] = Vaccines::all();
        $data['all_sheds'] = Shed::all();
        $data['all_vaccines'] = Vaccines::all();
        $data['single_data'] = Animal::findOrFail($id);

        return view('animal.animalForm', $data);
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
        // return $request->all();
        $data = Animal::findOrFail($id);
        if (!$data) {
            return redirect()->back()->with('status_color', 'danger')->with('flash_message', 'Animal not found.');
        }

        // 🔹 Validate Input
        $validator = Validator::make($request->all(), [
            'age' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'gender' => 'required',
            'color' => 'required',
            'animal_type' => 'required',
            'pregnant_status' => 'required',
            'shade_no' => 'required',
            'previous_vaccine_done' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color', 'warning');
        }

        // 🔹 Prepare Data for Update
        $input = $request->except(['id', 'animal_image', 'exitesPreviousImage']); // Prevent overwriting ID
        $input['pregnancy_time'] = $request->pregnancy_time ? date('Y-m-d', strtotime($request->pregnancy_time)) : null;
        $input['buy_date'] = $request->buy_date ? date('Y-m-d', strtotime($request->buy_date)) : null;
        $input['DOB'] = $request->DOB ? date('Y-m-d', strtotime($request->DOB)) : null;
        $input['vaccines'] = isset($input['vaccines']) ? json_encode($input['vaccines']) : '';

        // 🔹 Handle Image Upload
        $newImages = [];
        if ($request->hasfile('animal_image')) {
            foreach ($request->file('animal_image') as $index => $image) {
                $fileName = rand(1, 1000) . date('dmyhis') . "." . $image->getClientOriginalExtension();

                // 🔹 Move image to storage/app/public/uploads/animal
                $image->storeAs('public/uploads/animal', $fileName);

                // 🔹 Save file name in the array
                $newImages[] = $fileName;
            }

            // 🔹 Save image names in the database
            $input['pictures'] = implode('_', $newImages);
        }

                // 🔹 Merge New and Existing Images
                $existingImages = $data->pictures ? explode('_', $data->pictures) : [];
                if ($request->has('exitesPreviousImage')) {
                    $existingImages = array_intersect($existingImages, $request->exitesPreviousImage);
                }

                $allImages = array_merge($existingImages, $newImages);
                $input['pictures'] = implode('_', $allImages);

                // 🔹 Delete Old Images
        $imagesToDelete = array_diff(explode('_', $data->pictures), $existingImages);
        foreach ($imagesToDelete as $oldImage) {
            $imgPath = public_path('uploads/animal/' . $oldImage);
            if (!empty($oldImage) && file_exists($imgPath) && is_file($imgPath)) {
                unlink($imgPath);
            }
        }

        try {
            // 🔹 Update Shed Status if Changed
            if ($request->shade_no != $data->shade_no) {
                Shed::where('id', $data->shade_no)->update(['status' => 0]); // Free previous shed
                Shed::where('id', $request->shade_no)->update(['status' => 1]); // Mark new shed as booked
            }

            // 🔹 Update Animal Record
            $data->update($input);

            Session::flash('flash_message', 'Animal Successfully Updated!');
            return redirect('animal')->with('status_color', 'success');

        } catch (\Exception $e) {
            \Log::error('Update Error: ' . $e->getMessage());
            return redirect()->back()->with('status_color', 'danger')->with('flash_message', 'Error: ' . $e->getMessage());
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
        $data = Animal::findOrFail($id);
        try {
            $bug = 0;
            if (!empty($data->shade_no)) {
                Shed::where('id', $data->shade_no)->update(['status' => 0]); //make stall fee
            }
            $data->delete();
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
        }
        if ($bug == 0) {
            Session::flash('flash_message_delete', 'Animal Successfully Deleted !');
            return redirect('animal')->with('status_color', 'success');
        } else {
            Session::flash('flash_message_delete', 'Something Error Found !');
            return redirect('animal')->with('status_color', 'danger');
        }
    }

    public function DeadAnimal(){
        $DeadAnimal = DeadAnimal::all();
        return view('animal.deadAnimal', compact('DeadAnimal'));
    }

    public function AddDeadAnimal(){
       $animal = Animal::all();
       return view('animal.add-dead-animal', compact('animal'));
    }

    public function SaveDeadAnimal(Request $request){
         $this->validate($request, [
        'date' => 'required',
        'cow' => 'required',
        'price' => 'required',
    ]);

         DeadAnimal::create([
        'date' => $request->date,
        'cow' => $request->cow,
        'description' => $request->description,
        'price' => $request->price,
    ]);
        $animal = Animal::find($request->cow);
    if ($animal) {
        $animal->sale_status = 2;
        $animal->save();
    }
    Session::flash('success', 'Dead Animal added successfully!');
    return redirect()->route('add-dead-cow');
    }

    public function DeadCalf(){
        $DeadAnimal = DeadCalf::all();
        return view('calf.deadAnimal', compact('DeadAnimal'));
    }

    public function AddDeadCalf(){
       $animal = Calf::all();
       return view('calf.add-dead-animal', compact('animal'));
    }

    public function SaveDeadCalf(Request $request){
        $this->validate($request, [
        'date' => 'required',
        'calf' => 'required',
        'price' => 'required',
    ]);

         DeadCalf::create([
        'date' => $request->date,
        'calf' => $request->calf,
        'description' => $request->description,
        'price' => $request->price,
    ]);
        $animal = Calf::find($request->calf);
    if ($animal) {
        $animal->sale_status = 2;
        $animal->save();
    }
    Session::flash('success', 'Dead Animal added successfully!');
    return redirect()->route('add-dead-cow');
    }

    public function SickCow(){
        $DeadAnimal = SickCow::all();
        return view('animal.sick-cow', compact('DeadAnimal'));
    }

    public function AddSickAnimal(){
        $animal = Animal::all();
        return view('animal.add-sick-animal', compact('animal'));
    }

    public function SaveSickAnimal(Request $request){
    $this->validate($request, [
        'date' => 'required',
        'cow' => 'required',
    ]);

         SickCow::create([
        'date' => $request->date,
        'cow' => $request->cow,
        'description' => $request->description,
    ]);

    Session::flash('success', 'Sick Animal added successfully!');
    return redirect()->route('add-sick-cow');
    }

    public function DestroySickAnimal($id) {
    SickCow::findOrFail($id)->delete();
    return redirect()->route('sick-cow')->with('success', 'Record deleted successfully!');
    }

    public function cow_ledger($id){
        
        $all_animals = Animal::leftJoin('users', 'users.id', 'animals.user_id')
        ->leftJoin('users_type', 'users_type.id', 'users.user_type')
        ->where('animals.branch_id', Session::get('branch_id'))
        ->where('animals.id', $id) // Specify the table name for the id column
        ->orderBy('animals.id', 'desc')
        ->select('animals.*', 'users.name', 'users_type.user_type')
        ->first();
        $food = DB::table('cow_feed')->join('cow_feed_dtls', 'cow_feed_dtls.feed_id', '=', 'cow_feed.id')->join('food_items', 'cow_feed_dtls.item_id', '=', 'food_items.id')->join('food_units', 'cow_feed_dtls.unit_id', '=', 'food_units.id')->where('cow_feed.cow_id', $id)->select('cow_feed.*','cow_feed_dtls.*','food_items.name as food_name', 'food_items.id as food_items_id' ,'cow_feed_dtls.qty as cow_feed_dtls_qty','food_units.name as cow_feed_dtls_unit')->get();

    // Calculate price for each item
    $totalPriceAllRecords = 0; // Initialize total price for all records

    foreach ($food as $item) {
        $cowFood = DB::table('cow_food')
            ->where('food', $item->food_items_id)
            ->orderBy('id', 'desc')
            ->first();

        if ($cowFood && $cowFood->unit == $item->cow_feed_dtls_unit) {
            $pricePerUnit = $cowFood->price / $item->cow_feed_dtls_qty;
            $totalPrice = $pricePerUnit * $item->cow_feed_dtls_qty;

            $item->price_per_unit = $pricePerUnit;
            $item->total_price = $totalPrice;

            // Add to the total price for all records
            $totalPriceAllRecords += $totalPrice;
        } else {
            $item->price_per_unit = null;
            $item->total_price = null;
        }
    }
        $MilkCollection = CollectMilk::Where('dairy_number', $id)->get();
        $totalMilkSell = $MilkCollection->sum('total');

$cowSell = DB::table('cow_sale')
    ->join('cow_sale_dtls', 'cow_sale_dtls.sale_id', '=', 'cow_sale.id')
    ->where('cow_sale_dtls.cow_id', $id)
    ->select(
        'cow_sale.*',
        'cow_sale_dtls.*',
        'cow_sale.total_price as cow_total_price',
        'cow_sale.date as sell_date' // Aliased as sell_date
    )
    ->orderBy('cow_sale.id', 'desc') // Order by cow_sale.id in descending order
    ->first();

        return view('animal.cow-ledger',compact('all_animals','food', 'totalPriceAllRecords','MilkCollection','totalMilkSell','cowSell'));
    }
}
