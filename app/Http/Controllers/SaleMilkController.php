<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\CollectMilk;
use App\Models\SaleMilk;
use App\Models\MilkDueCollections;
use App\Models\Supplier;
use App\Models\SpoiledMilk;
use App\Models\Earning;
use Validator;
use Session;
use DB;
use Auth;
use Response;

class SaleMilkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index(Request $request)
{
    $query = SaleMilk::leftJoin('users', 'users.id', 'sale_milk.added_by')
             ->leftJoin('users_type', 'users_type.id','users.user_type')
             ->where('sale_milk.branch_id', Session::get('branch_id'))
             ->select('sale_milk.*', 'users.name as sold_by','users_type.user_type');
    
    // Date range filter
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('sale_milk.date', [
            $request->start_date,
            $request->end_date
        ]);
    }
    
    // Payment status filter
    if ($request->filled('payment_status')) {
        if ($request->payment_status == 'paid') {
            $query->whereHas('collectPayments', function($q) {
                $q->selectRaw('SUM(pay_amount) as total_paid')
                  ->havingRaw('total_paid >= sale_milk.total_amount');
            });
        } elseif ($request->payment_status == 'due') {
            $query->where(function($q) {
                $q->doesntHave('collectPayments')
                  ->orWhereHas('collectPayments', function($q) {
                      $q->selectRaw('SUM(pay_amount) as total_paid')
                        ->havingRaw('total_paid < sale_milk.total_amount');
                  });
            });
        }
    }
    
    // Search functionality
    if ($request->filled('search')) {
        $searchTerm = $request->search;
        $query->where(function($q) use ($searchTerm) {
            $q->where('sale_milk.milk_account_number', 'LIKE', "%{$searchTerm}%")
              ->orWhere('sale_milk.name', 'LIKE', "%{$searchTerm}%")
              ->orWhere('sale_milk.contact', 'LIKE', "%{$searchTerm}%")
              ->orWhere('sale_milk.email', 'LIKE', "%{$searchTerm}%")
              ->orWhere('sale_milk.id', 'LIKE', "%{$searchTerm}%")
              ->orWhere('users.name', 'LIKE', "%{$searchTerm}%");
        });
    }
    
    $data['allData'] = $query->orderBy('sale_milk.id', 'desc')->paginate(40)->appends($request->except('page'));
    
    $data['milkData'] = CollectMilk::where('branch_id', Session::get('branch_id'))
                       ->orderBy('date', 'desc')->get();
                       
    $data['supplierArr'] = Supplier::where('branch_id', Session::get('branch_id'))
                          ->orderBy('name', 'asc')->get();
                           
    return view('sale-milk.list', $data);
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
		$validator = Validator::make($request->all(), [
                    'milk_account_number' => 'required',
                    'name' => 'required',
                    'litter' => 'required',
                    'rate' => 'required',
                    'total_amount' => 'required',
                ]);

        if($validator->fails()){
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) { 
                $plainErrorText .= $value[0].". ";
            }
            Session::flash('flash_message', $plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');;
        }
                
        $input = $request->all();
        $input['date'] = date('Y-m-d');
        $input['branch_id'] = Session::get('branch_id');
		$input['added_by'] = Auth::user()->id;
		
        try{
            $bug=0;
            $objInsert = SaleMilk::create($input);
			if($objInsert->id){
				//insert data into due payment table
				$payment = array();
				$payment['sale_id'] = $objInsert->id;
				$payment['date'] = date('Y-m-d');
				$payment['pay_amount'] = $input['paid'];
				MilkDueCollections::create($payment);
				
        		 Earning::create([
                'purpose_id' => 2,
                'date' => date('Y-m-d'),
                'amount' => $input['paid'],
                ]);
			}
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }
        if($bug==0){
            if(isset($input['save'])){
				Session::flash('flash_message','Save Information Successfully.');
            	return redirect()->back()->with('status_color','success');
			} else {
				Session::flash('flash_message','Save Information Successfully.');
            	return redirect('sale-milk-invoice/'.$objInsert->id)->with('status_color','success');	
			}
        }else{
            Session::flash('flash_message','Something Error Found.');
            return redirect()->back()->with('status_color','danger');
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
        $data = SaleMilk::findOrFail($id);
        $validator = Validator::make($request->all(), [
                    'milk_account_number' => 'required',
                    'name' => 'required',
                    'litter' => 'required',
                    'rate' => 'required',
                    'total_amount' => 'required',
                ]);

        if($validator->fails()){
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) { 
                $plainErrorText .= $value[0].". ";
            }
            Session::flash('flash_message', $plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');;
        }
                
        $input = $request->all();
        
        try{
            $bug=0;
            $data->update($input);
        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
            Session::flash('flash_message','Data Successfully Updated.');
            return redirect()->back()->with('status_color','warning');
        }else{
            Session::flash('flash_message','Something Error Found.');
            return redirect()->back()->with('status_color','danger');
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
        $data = SaleMilk::findOrFail($id);
        try{
            $bug=0;
            $delete = $data->delete();
			MilkDueCollections::where('sale_id', $id)->delete();
        }
        catch(\Exception $e)
        {
            $bug=$e->errorInfo[1];
        }

        if($bug==0){

            Session::flash('flash_message','Data Successfully Deleted !');
            return redirect()->back()->with('status_color','danger');

        }else{

            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
	
	public function getStockStatus(Request $request){
		$data = array();
		if($request->id){			
			$data = SaleMilk::Where('milk_account_number',$request->id)
				->where('sale_milk.branch_id', Session::get('branch_id'))
				->select([DB::raw("SUM(litter) as total_sold"), DB::raw("SUM(paid) as total_paid"), DB::raw("SUM(due) as total_due")])
				->groupBy('milk_account_number')
				->first();
			if(!empty($data)){
				$data = $data->toArray();
			}
		}
		return Response::json(array(
            'success' => true,
         	'data'   => $data
         )); 
		
	}
	
	public function printInvoice(Request $request){
		if(!empty($request->id)){
			//invoice create here
			$data['sale_paid_amount'] = 0;
			$data['sale_due_amount'] = 0;
			$data['single_data'] = SaleMilk::findOrFail($request->id);
			$data['sale_paid_amount'] = $data['single_data']->collectPayments()->sum('pay_amount');
			if(!empty($data['sale_paid_amount'])){
				$data['sale_due_amount'] = (float)$data['single_data']->total_amount - (float)$data['sale_paid_amount'];
			}
			return view('invoice.milk-sale', $data);
		} else {
			die('Invalid Request.');
		}
	}
	
	public function add_sale_milk(){
    $data['allData'] = SaleMilk::leftJoin('users', 'users.id', 'sale_milk.added_by')
    ->leftJoin('users_type', 'users_type.id','users.user_type')
    ->where('sale_milk.branch_id', Session::get('branch_id'))
    ->select('sale_milk.*', 'users.name as sold_by','users_type.user_type')
    ->orderBy('sale_milk.id', 'desc')->paginate(40);
    
    $data['milkData'] = CollectMilk::where('branch_id', Session::get('branch_id'))
    ->orderBy('date', 'desc')->get();
    
    $data['supplierArr'] = Supplier::where('branch_id', Session::get('branch_id'))
    ->orderBy('name', 'asc')->get();
							   
        return view('sale-milk.add-milk-sell', $data);
	}
	
public function handleRequest(Request $request)
{
    $account = $request->input('account'); 
    $spoiledMilk = SpoiledMilk::where('account', $account)->first();
    $collectMilk = CollectMilk::where('account_number', $account)->sum('liter');

    $saleMilk = SaleMilk::where('milk_account_number', $account)->sum('litter');
    $saleMilk = $saleMilk ?: 0;
    
    if ($spoiledMilk) {
        $spoiledMilkQuantity = $spoiledMilk->quantity;
    } else {
        $spoiledMilkQuantity = 0;
    }
    $remainingQuantity = $collectMilk - $saleMilk - $spoiledMilkQuantity;

    return response()->json([
        'success' => true,
        'remaining_quantity' => $remainingQuantity
    ]);

    return response()->json(['success' => false, 'message' => 'No data found for this account.']);
}

    
	
	public function spoiled_milk(){
	    $data['CollectMilk'] = CollectMilk::all();
	    return view('sale-milk.spoiled-milk', $data);
	}
	
	public function save_spoiled_milk(Request $request){
	    
	    $this->validate($request, [
        'qty' => 'required',
        'account' => 'required',
        'date' => 'required',
        'price' => 'required',
        'description' => 'required',
    ]);

    SpoiledMilk::create([
        'quantity' => $request->qty,
        'account' => $request->account,
        'date' => $request->date,
        'price' => $request->price,
        'description' => $request->description,
    ]);
    
    Session::flash('success', 'Spoiled milk added successfully!');
    return redirect()->route('spoiled_milk');
	}
	
	public function spoiled_milk_list(){
	    $data['SpoiledMilk'] = SpoiledMilk::all();
	    return view('sale-milk.spoiled-milk-list', $data);
	}
	
	
	// Add these new methods to your controller

public function spoiled_milk_edit($id) {
    $data['CollectMilk'] = CollectMilk::all();
    $data['spoiledMilk'] = SpoiledMilk::findOrFail($id);
    return view('sale-milk.spoiled-milk-edit', $data);
}

public function spoiled_milk_update(Request $request, $id) {
    $request->validate([
        // 'account' => 'required',
        'quantity' => 'required|numeric',
        'price' => 'required|numeric',
        // Add other validation rules
    ]);

    $spoiledMilk = SpoiledMilk::findOrFail($id);
    $spoiledMilk->update($request->all());

    return redirect()->route('spoiled_milk_list')->with('success', 'Record updated successfully');
}

public function spoiled_milk_destroy($id) {
    $spoiledMilk = SpoiledMilk::findOrFail($id);
    $spoiledMilk->delete();

    return redirect()->route('spoiled_milk_list')->with('success', 'Record deleted successfully');
}

	
	public function spoiled_milk_by_date(Request $request){
	     $this->validate($request, [
        'fdate' => 'required|date',
        'tdate' => 'required|date',
    ]);
    $fromDate = $request->fdate;
    $toDate = $request->tdate;
    $data['SpoiledMilk'] = SpoiledMilk::whereBetween('date', [$fromDate, $toDate])->get();
    return view('sale-milk.spoiled-milk-list', $data);
	}
}
