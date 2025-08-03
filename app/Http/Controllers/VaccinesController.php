<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vaccines;
use App\Models\Medicine;
use App\Models\BuyMedicine;
use App\Models\Supplier;
use App\Models\FoodUnit;
use App\Models\Expense;
use App\Models\Expense_new;
use Validator;
use Session;
use Illuminate\Support\Facades\DB;

class VaccinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['alldata'] =  Vaccines::orderBy('vaccine_name', 'asc')->paginate(20);
        return view('vaccines.index', $data);
    }
    public function medicine()
    {
        return view('vaccines.medicine');
    }
    public function medicine_list()
    {
        $medicine = Medicine::whereNull('unit')->get();
        return view('vaccines.medicine-list', compact('medicine'));
    }

    public function buy_medicine()
    {
        $medicine = Medicine::all();
        $vaccines = Vaccines::all();
        $supplier = Supplier::all();
        $foodUnit = FoodUnit::all();
        return view('vaccines.buy_medicine', compact('medicine', 'supplier', 'foodUnit','vaccines'));
    }
    public function AddMedicine(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
        ]);

        Medicine::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);
        Expense::create([
            'purpose_id' => 14,
            'date' => date("Y-m-d"),
            'amount' => $request->price,
            'note' => $request->description,
            'created_by' => 1,
        ]);
        Session::flash('success', 'Food added successfully!');
        return redirect()->route('medicine');
    }
    public function BuyMedicineSave(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'medicine' => 'nullable',
            'vaccine' => 'nullable',
            'suppliers' => 'required',
            'quantity' => 'required',
            'unit' => 'required',
            'description' => 'required',
            'date' => 'required',
            'price' => 'required',
        ]);

        BuyMedicine::create([
            'branch' => Session::get('branch_id'),
            'purpose_id' => $request->type, // Save type here
            'medicine' => $request->type == 14 ? $request->medicine : $request->vaccine,
            'suppliers' => $request->suppliers,
            'quantity' => $request->quantity,
            'unit' => $request->unit,
            'price' => $request->price,
            'description' => $request->description,
            'date' => $request->date,
            'price' => $request->price,
        ]);

        $medicine = Medicine::where('id', $request->medicine)
            ->where('unit', $request->unit)
            ->first();
        if ($medicine) {
            $medicine->stock += $request->quantity;
            $medicine->save();
        } else {
            $medicine = Medicine::where('id', $request->medicine)->first();
            Medicine::create([
                'name' => $medicine->name,
                'description' => $request->description,
                'unit' => $request->unit,
                'stock' => $request->quantity,
            ]);
        }

        $totalAount = $request->price * $request->quantity;

        Expense_new::create([
            'purpose_id' => $request->type,
            'date' => date('Y-m-d', strtotime($request->date)),
            'amount' => $request->price,
            'note' => $request->description,
            'status' => 0,
            'created_by' => auth()->user()->id,
            'amount' => $totalAount,
        ]);

        Expense::create([
            'purpose_id' => $request->type,
            'date' => date('Y-m-d', strtotime($request->date)),
            'amount' => $totalAount,
            'note' => $request->description,
            'created_by' => auth()->user()->id,
        ]);

        Session::flash('success', 'Medicine added successfully!');
        return redirect()->route('buy_medicine');
    }

    public function medicine_purchases()
    {
        $BuyMedicine = DB::table('buy_medicine')
                ->leftJoin('medicines', function ($join) {
                    $join->on('buy_medicine.medicine', '=', 'medicines.id')
                        ->where('buy_medicine.purpose_id', '=', 14);
                })
                ->leftJoin('vaccines', function ($join) {
                    $join->on('buy_medicine.medicine', '=', 'vaccines.id')
                        ->where('buy_medicine.purpose_id', '=', 13);
                })
                ->join('suppliers', 'buy_medicine.suppliers', '=', 'suppliers.id')
                ->select(
                    'buy_medicine.*',
                    'medicines.name as medicine_name',
                    'vaccines.Vaccine_name as vaccine_name',
                    'suppliers.name as supplier_name'
                )
                ->latest()->get();

        return view('vaccines.medicine_purchases', compact('BuyMedicine'));
    }

    public function editPurchase($id)
    {
        $purchase = BuyMedicine::findOrFail($id);
        $medicines = Medicine::all();
        $vaccines = Vaccines::all();
        $suppliers = Supplier::all();
        $foodUnit = FoodUnit::all();
        return view('vaccines.purchase_edit', compact('purchase', 'medicines', 'suppliers', 'vaccines','foodUnit'));
    }

    public function updatePurchase(Request $request, $id)
    {
        $validated = $request->validate([
            'type' => 'required',
            'medicine' => 'nullable',
            'vaccine' => 'nullable',
            'suppliers' => 'required|exists:suppliers,id',
            'medicine' => 'required|exists:medicines,id',
            'quantity' => 'required|numeric|min:1',
            'unit' => 'required',
            'date' => 'required|date',
            'description' => 'nullable|string'
        ]);

        $purchase = BuyMedicine::findOrFail($id);
        $purchase->update($validated);

        return redirect()->route('medicine_purchases')->with('success', 'Purchase updated successfully!');
    }

    public function destroyPurchase($id)
    {
        $purchase = BuyMedicine::findOrFail($id);
        $purchase->delete();

        return redirect()->route('medicine_purchases')->with('success', 'Purchase deleted successfully!');
    }


    public function medicine_purchases_by_date(Request $request)
    {
        $this->validate($request, [
            'fdate' => 'required|date',
            'tdate' => 'required|date',
        ]);

        $fromDate = $request->fdate;
        $toDate = $request->tdate;

        $BuyMedicine = BuyMedicine::join('medicines', 'buy_medicine.medicine', '=', 'medicines.id')
            ->select('buy_medicine.*', 'medicines.name as name')
            ->whereBetween('buy_medicine.date', [$fromDate, $toDate])
            ->orderBy('buy_medicine.id', 'desc')
            ->get();
        return view('vaccines.medicine_purchases', compact('BuyMedicine'));
    }
    public function medicine_purchases_report()
    {
        $BuyMedicine = BuyMedicine::join('medicines', 'buy_medicine.medicine', '=', 'medicines.id')
            ->join('branchs', 'buy_medicine.branch', '=', 'branchs.id')
            ->select(
                'buy_medicine.*',
                'medicines.name as medicine_name',
                'branchs.branch_name as branch_name'
            )
            ->get();
        return view('vaccines.medicine_purchases_report', compact('BuyMedicine'));
    }
    public function medicine_purchases_report_by_date(Request $request)
    {
        // Validate input dates
        $this->validate($request, [
            'fdate' => 'required|date',
            'tdate' => 'required|date',
        ]);

        // Get the date range from the request
        $fromDate = $request->fdate;
        $toDate = $request->tdate;

        // Query with date range filter and branch name
        $BuyMedicine = BuyMedicine::join('medicines', 'buy_medicine.medicine', '=', 'medicines.id')
            ->join('branchs', 'buy_medicine.branch', '=', 'branchs.id')
            ->select(
                'buy_medicine.*',
                'medicines.name as medicine_name',
                'branchs.branch_name as branch_name'
            )
            ->whereBetween('buy_medicine.date', [$fromDate, $toDate]) // Add date range filter
            ->orderBy('buy_medicine.id', 'desc') // Order by ID in descending order
            ->get();

        // Return the results to the view
        return view('vaccines.medicine_purchases_report', compact('BuyMedicine'));
    }
    public function medicine_stock_report()
    {
        $medicine = Medicine::all();
        return view('vaccines.medicine_stock_report', compact('medicine'));
    }


    public function edit_medicine($id)
    {
        $medicine = Medicine::findOrFail($id);
        $foodUnit = FoodUnit::all(); // Assuming you have this model for units
        return view('vaccines.edit_medicine', compact('medicine', 'foodUnit'));
    }

    public function update_medicine(Request $request, $id)
    {
        $medicine = Medicine::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|numeric',
            'unit' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $medicine->update($validatedData);

        return redirect()->route('medicine_stock_report')->with('success', 'Medicine updated successfully');
    }

    public function delete_medicine($id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();

        return redirect()->route('medicine_stock_report')->with('success', 'Medicine deleted successfully');
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
            'vaccine_name' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('flash_message', 'Please Fillup all Inputs.');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color', 'warning');
        }

        try {
            $bug = 0;
            $insert = Vaccines::create($input);

            Expense::create([
                'purpose_id' => 13,
                'date' => date("Y-m-d"),
                'amount' => $request->price,
                'note' => $request->note,
                'created_by' => 1,
            ]);
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
        }

        if ($bug == 0) {
            Session::flash('flash_message', 'New data Successfully Saved !');
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
        $data = Vaccines::findOrFail($id);
        $input = $request->all();
        $validator = Validator::make($input, [
            'vaccine_name' => 'required',
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
        $data = Vaccines::findOrFail($id);
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

    public function medicine_list_edit($id)
    {
        $medicine = Medicine::findOrFail($id);
        return view('vaccines.medicine-edit', compact('medicine'));
    }

    public function medicine_list_update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $medicine = Medicine::findOrFail($id);
        $medicine->update($validated);

        $medicine = Medicine::whereNull('unit')->get();
        return view('vaccines.medicine-list', compact('medicine'));
    }

    public function medicine_list_destroy($id)
    {
        $medicine = Medicine::findOrFail($id);
        $medicine->delete();

        $medicine = Medicine::whereNull('unit')->get();
        return view('vaccines.medicine-list', compact('medicine'));
    }
}
