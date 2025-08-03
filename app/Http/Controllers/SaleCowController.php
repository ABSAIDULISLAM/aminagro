<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Shed;
use App\Models\Calf;
use App\Models\Animal;
use App\Models\SaleCow;
use App\Models\SaleCowDtls;
use App\Models\SaleCowPayment;
use App\Models\Earning;
use App\Models\Buyer;
use Validator;
use Response;
use Session;
use DB;

class SaleCowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index(Request $request)
{
    $query = SaleCow::where('branch_id', Session::get('branch_id'))
        ->orderBy('date', 'desc');

    // Apply date range filter if provided
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $query->whereBetween('date', [
            $request->start_date,
            $request->end_date
        ]);
    }

    $data['allData'] = $query->paginate(50);

    // Pass the filter values back to view to maintain them in the form
    $data['start_date'] = $request->start_date;
    $data['end_date'] = $request->end_date;

    return view('sale-cow.list', $data);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['buyer'] = Buyer::all();
        return view('sale-cow.form', $data);
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

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'sale_date' => 'required',
            'customer_name' => 'required',
            'total_price' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('status_color', 'warning')
                ->with('flash_message', 'Please fill up all inputs.');
        }

        // Fetch the buyer
        $buyer = Buyer::where('id', $input['customer_name'])->first();

        if (!$buyer) {
            return redirect()->back()
                ->with('status_color', 'danger')
                ->with('flash_message', 'Buyer not found.');
        }

        // Check if the buyer has enough balance
        $requestedBalanceFromBuyer = $request->user_balance;
        if ($buyer->balance < $requestedBalanceFromBuyer) {
            return redirect()->back()
                ->with('status_color', 'warning')
                ->with('flash_message', 'Insufficient balance.');
        }

        // Deduct the requested balance from the buyer's balance
        $buyer->balance -= $requestedBalanceFromBuyer;
        $buyer->save();
        $input['customer_name'] = $buyer->name;
        // Prepare the input data for SaleCow
        $input['date'] = date('Y-m-d', strtotime($request->sale_date));
        $input['branch_id'] = Session::get('branch_id');

        // Add the requested balance to total_paid and subtract from due
        $input['total_paid'] = ($input['total_paid'] ?? 0) + $requestedBalanceFromBuyer;
        $input['due'] = ($input['total_price'] ?? 0) - $input['total_paid'];

        try {
            $bug = 0;

            // Create the SaleCow record
            $insert = SaleCow::create($input);

            // Process cow details
            foreach ($input['cowdtls'] as $dataDtls) {
                $saleDtls = $dataDtls;
                $saleDtls['sale_id'] = $insert->id;
                SaleCowDtls::create($saleDtls);

                // Update sale status in Animal or Calf table
                if ($saleDtls['cow_type'] == 1) {
                    Animal::where('id', $saleDtls['cow_id'])->update(['sale_status' => 1]);
                } else {
                    Calf::where('id', $saleDtls['cow_id'])->update(['sale_status' => 1]);
                }

                // Update shed status
                Shed::where('id', $saleDtls['shed_no'])->update(['status' => 0]);
            }

            // Create SaleCowPayment record
            $saleAmountDtls['sale_id'] = $insert->id;
            $saleAmountDtls['date'] = $input['date'];
            $saleAmountDtls['pay_amount'] = $input['total_paid'];
            SaleCowPayment::create($saleAmountDtls);

            // Create Earning record
            Earning::create([
                'purpose_id' => 4,
                'date' => $input['date'],
                'amount' => $input['total_paid'],
            ]);
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
        }

        // Handle success or error
        if ($bug == 0) {
            Session::flash('flash_message', 'New data successfully saved!');
            return redirect('sale-cow')->with('status_color', 'success');
        } else {
            Session::flash('flash_message', 'Something went wrong!');
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
        $data['single_data'] = SaleCow::findOrFail($id);
        $data['buyer'] = Buyer::all();
        return view('sale-cow.form', $data);
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
        $data = SaleCow::findOrFail($id);
        $input  = $request->all();
        $validator = Validator::make($request->all(), [
                    'sale_date' => 'required',
                    'customer_name' => 'required',
                    'customer_number' => 'required',
                    'total_price' => 'required',
                ]);

        if($validator->fails()){
            Session::flash('flash_message','Please Fillup all Inputs.');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }

        $input['date'] = date('Y-m-d', strtotime($request->sale_date));

        try{
            $bug=0;
            $data->update($input);

            //Delete Old One
            $oldSaleDtls = SaleCowDtls::where('sale_id', $id)->get();
            foreach($oldSaleDtls as $oldSaleDtlsData){
                if($oldSaleDtlsData->cow_type==1){
                    Animal::where('id', $oldSaleDtlsData->cow_id)->update(['sale_status'=>0]);
                }else{
                    Calf::where('id', $oldSaleDtlsData->cow_id)->update(['sale_status'=>0]);
                }
                Shed::where('id', $oldSaleDtlsData->shed_no)->update(['status'=>1]);

            }
            SaleCowDtls::where('sale_id', $id)->delete();
            // Create New Row
            foreach($input['cowdtls'] as $dataDtls){
                $saleDtls = $dataDtls;
                $saleDtls['sale_id'] = $data->id;
                SaleCowDtls::create($saleDtls);
                if($saleDtls['cow_type']==1){
                    Animal::where('id', $saleDtls['cow_id'])->update(['sale_status'=>1]);
                }else{
                    Calf::where('id', $saleDtls['cow_id'])->update(['sale_status'=>1]);
                }
                Shed::where('id', $saleDtls['shed_no'])->update(['status'=>0]);
            }

        }catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
            Session::flash('flash_message','New data Successfully Saved !');
            return redirect('sale-cow')->with('status_color','success');
        }else{
            Session::flash('flash_message','Something Error Found !');
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
    $data = SaleCow::findOrFail($id);
    try{
        $bug=0;
        $saledtls = SaleCowDtls::where('sale_id', $id)->get();

        // Process each sale detail
        foreach($saledtls as $saledtlsData){
            if($saledtlsData['cow_type']==1){
                Animal::where('id', $saledtlsData['cow_id'])->update(['sale_status'=>0]);
            }else{
                Calf::where('id', $saledtlsData['cow_id'])->update(['sale_status'=>0]);
            }
            Shed::where('id', $saledtlsData['sale_id'])->update(['status'=>0]);
        }

        // Delete related records
        SaleCowPayment::where('sale_id', $id)->delete();
        SaleCowDtls::where('sale_id', $id)->delete();  // Add this line to delete sale details
        $data->delete();
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

    public function loadCowCalf(Request $request)
    {
        if($request->cowtype==1){
            $data = Animal::leftJoin('sheds', 'sheds.id', 'animals.shade_no')
                    ->where('animals.branch_id', Session::get('branch_id'))
                    ->where('animals.sale_status', 0)
                    ->select('animals.*', 'sheds.shed_number')->get();
        }else{
            $data = Calf::leftJoin('sheds', 'sheds.id', 'calf.shade_no')
                    ->where('calf.branch_id', Session::get('branch_id'))
                    ->where('calf.sale_status', 0)
                    ->select('calf.*', 'sheds.shed_number')->get();
        }

        foreach($data as $info){
            if(!empty($info->pictures) && file_exists("storage/app/public/uploads/animal/".explode('_', $info->pictures)[0])){
                $info->pictures="storage/app/public/uploads/animal/".trim(explode('_', $info->pictures)[0]);
            }
            else{
                $info->pictures = 'public/custom/img/noImage.jpg';
            }
        }
        return Response::json($data);
    }

	public function printInvoice(Request $request){
		if(!empty($request->id)){
			//invoice create here
			$data['single_data'] = SaleCow::findOrFail($request->id);
			return view('invoice.sale', $data);
		} else {
			die('Invalid Request.');
		}
	}
}
