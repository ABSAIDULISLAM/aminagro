<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Pond;
use App\Models\HatcheryExpenseCategory;
use App\Models\FishStocking;
use App\Models\FishHarvest;
use App\Models\Buyer;
use App\Models\FishSell;
use App\Models\Earning;
use Validator;
use Session;

class PondController extends Controller
{
    public function add_pond()
    {
        return view('pond.add_pond');
    }
    
    
    public function AddPondSave(Request $request)
    {
        $this->validate($request, [
        'pond_name' => 'required',
        'address' => 'required',
    ]);

    Pond::create([
        'name' => $request->pond_name,
        'address' => $request->address,
    ]);
    Session::flash('success', 'Pond added successfully!');
    return redirect()->route('add_pond');
    }
    
    
    public function pond_list()
    {
        $pond = Pond::all();
        return view('pond.pond-list', compact('pond'));
    }
    
    
    public function add_hatchery_expense_category()
    {
        return view('pond.add-hatchery-expense-category');
    }
    
    
    public function add_hatchery_expense_category_save(Request $request)
    {
         $this->validate($request, [
        'name' => 'required',
    ]);

    HatcheryExpenseCategory::create([
        'name' => $request->name,
    ]);
    Session::flash('success', 'Category added successfully!');
    return redirect()->route('add_hatchery_expense_category');
    }
    
    
    public function hatchery_expense_category_list()
    {
        $HatcheryExpenseCategory = HatcheryExpenseCategory::all();
        return view('pond.hatchery-expense-category-list', compact('HatcheryExpenseCategory'));
    }
    
    
    public function add_fish_stocking()
    {
        $pond = Pond::all();
        return view('pond.add_fish_stocking', compact('pond'));
    }
    
    
    public function save_fish_stocking(Request $request)
    {
         $this->validate($request, [
        'pond' => 'required',
        'name' => 'required',
        'qty' => 'required',
        'price' => 'required',
        'date' => 'required',
    ]);

    FishStocking::create([
        'pond' => $request->pond,
        'fish_name' => $request->name,
        'qty' => $request->qty,
        'price' => $request->price,
        'date' => $request->date,
    ]);
    Session::flash('success', 'Fish added successfully!');
    return redirect()->route('add_fish_stocking');
    }
    
    
    public function fish_stocking_report()
    {
        $FishStocking = DB::table('fish_stocking')
    ->join('pond', 'fish_stocking.pond', '=', 'pond.id')
    ->select('fish_stocking.*', 'pond.name as pond_name')
    ->get();
        return view('pond.fish_stocking_report', compact('FishStocking'));
    }
    
    public function edit($id)
    {
    $FishStocking = DB::table('fish_stocking')
        ->join('pond', 'fish_stocking.pond', '=', 'pond.id')
        ->select('fish_stocking.*', 'pond.name as pond_name')
        ->where('fish_stocking.id', $id)
        ->first();
    $ponds = DB::table('pond')->get();

    return view('pond.edit_fish_stocking', compact('FishStocking', 'ponds'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'pond' => 'required|exists:pond,id',
        'fish_name' => 'required|string',
        'qty' => 'required|integer',
        'price' => 'required|numeric',
        'date' => 'required|date',
    ]);
    DB::table('fish_stocking')
        ->where('id', $id)
        ->update([
            'pond' => $request->pond,
            'fish_name' => $request->fish_name,
            'qty' => $request->qty,
            'price' => $request->price,
            'date' => $request->date,
        ]);

    return redirect()->route('fish_stocking_report')->with('success', 'Fish stocking record updated successfully!');
    }

    public function destroy($id)
    {
    DB::table('fish_stocking')->where('id', $id)->delete();

    return redirect()->route('fish_stocking_report')->with('success', 'Fish stocking record deleted successfully!');
    }
    
    
    public function fish_stocking_report_by_date(Request $request)
    {
    $this->validate($request, [
        'fdate' => 'required|date',
        'tdate' => 'required|date',
    ]);

    $fromDate = $request->fdate;
    $toDate = $request->tdate;

    $FishStocking = DB::table('fish_stocking')
        ->join('pond', 'fish_stocking.pond', '=', 'pond.id')
        ->select('fish_stocking.*', 'pond.name as pond_name');

    if ($fromDate && $toDate) {
        $FishStocking->whereBetween('fish_stocking.date', [$fromDate, $toDate]);
    }

    $FishStocking = $FishStocking->get();

    return view('pond.fish_stocking_report', compact('FishStocking'));
    }
    
    
    public function fish_harvest(){
         $pond = Pond::all();
         $fish = FishStocking::all();
         return view('pond.fish_harvest', compact('pond','fish'));
    }
    
    
    public function save_fish_harvest(Request $request){
        $request->validate([
        'pond' => 'required',
        'name' => 'required',
        'qty' => 'required',
        'total_price' => 'required',
        'date' => 'required',
    ]);
        FishHarvest::create([
        'pond' => $request->pond,
        'name' => $request->name,
        'qty' => $request->qty,
        'price' => $request->price,
        'due_price' => $request->due_price,
        'pay_amount' => $request->pay_amount,
        'total_price' => $request->total_price,
        'date' => $request->date,
    ]);

    return redirect()->route('fish_harvest')->with('success', 'Fish stocking added successfully!');
    }
    
    public function fish_harvest_list(){
        $FishHarvest = DB::table('fish_harvest')
    ->join('pond', 'fish_harvest.pond', '=', 'pond.id')
    ->select('fish_harvest.*', 'pond.name as pond_name')
    ->get();
        return view('pond.fish_harvest_list', compact('FishHarvest'));
    }
    
    public function fish_harvest_edit($id)
    {
    $FishHarvest = DB::table('fish_harvest')
        ->join('pond', 'fish_harvest.pond', '=', 'pond.id')
        ->select('fish_harvest.*', 'pond.name as pond_name')
        ->where('fish_harvest.id', $id)
        ->first();
    $ponds = DB::table('pond')->get();

    return view('pond.edit_fish_harvest', compact('FishHarvest', 'ponds'));
    }
    
    public function fish_harvest_update(Request $request, $id)
    {
    $request->validate([
        'pond' => 'required',
        'name' => 'required',
        'qty' => 'required',
        'total_price' => 'required',
        'date' => 'required',
    ]);
    DB::table('fish_harvest')
        ->where('id', $id)
        ->update([
        'pond' => $request->pond,
        'name' => $request->name,
        'qty' => $request->qty,
        'price' => $request->price,
        'due_price' => $request->due_price,
        'pay_amount' => $request->pay_amount,
        'total_price' => $request->total_price,
        'date' => $request->date,
        ]);

    return redirect()->route('fish_harvest_list')->with('success', 'Fish harvest record updated successfully!');
    }
    
    public function fish_harvest_destroy($id)
    {
    DB::table('fish_harvest')->where('id', $id)->delete();

    return redirect()->route('fish_harvest_list')->with('success', 'Fish harvest record deleted successfully!');
    }
    
    public function fish_harvest_report_by_date(Request $request)
    {
    $this->validate($request, [
        'fdate' => 'required|date',
        'tdate' => 'required|date',
    ]);

    $fromDate = $request->fdate;
    $toDate = $request->tdate;

    $FishHarvest = DB::table('fish_harvest')
        ->join('pond', 'fish_harvest.pond', '=', 'pond.id')
        ->select('fish_harvest.*', 'pond.name as pond_name');

    if ($fromDate && $toDate) {
        $FishHarvest->whereBetween('fish_harvest.date', [$fromDate, $toDate]);
    }

    $FishHarvest = $FishHarvest->get();

    return view('pond.fish_harvest_list', compact('FishStocking'));
    }
    
    public function fish_sell(){
        $pond = Pond::all();
        $Buyer = Buyer::all();
        $fish = FishStocking::all();
        return view('pond.add-fish-sell', compact('pond','Buyer','fish'));
    }
    
    public function fish_sell_save(Request $request){
        $this->validate($request, [
        'pond' => 'required',
        'buyer' => 'required',
        'fish_name' => 'required',
        'qty' => 'required',
        'unit' => 'required',
        'price' => 'required',
        'date' => 'required',
        'paid_amount' => 'required',
    ]);

    FishSell::create([
        'pond' => $request->pond,
        'buyer' => $request->buyer,
        'fish_name' => $request->fish_name,
        'qty' => $request->qty,
        'unit' => $request->unit,
        'price' => $request->price,
        'total_price' => $request->price * $request->qty,
        'paid_amount' => $request->paid_amount,
        'date' => $request->date,
    ]);
    
        $buyer = Buyer::where('id', $request->buyer)->first();
        $updateBalance = $buyer->balance -= $request->price * $request->qty;
        $buyer->save();
    
         Earning::create([
        'purpose_id' => 3,
        'date' => $request->date,
        'amount' => $request->price,
    ]);
    Session::flash('success', 'Fish sell added successfully!');
    return redirect()->route('fish_sell');
    }
    
    public function fish_sell_report(){
         $FishSell = DB::table('fish_sell')
    ->join('buyer', 'fish_sell.buyer', '=', 'buyer.id')
    ->join('pond', 'fish_sell.pond', '=', 'pond.id')
    ->select('fish_sell.*', 'buyer.name as buyer_name', 'pond.name as pond_name')
    ->get();
         return view('pond.fish_sell_report', compact('FishSell'));
    }
    
    public function editFishSell($id)
    {
    $FishSell = DB::table('fish_sell')
        ->join('buyer', 'fish_sell.buyer', '=', 'buyer.id')
        ->join('pond', 'fish_sell.pond', '=', 'pond.id')
        ->select('fish_sell.*', 'buyer.name as buyer_name', 'pond.name as pond_name')
        ->where('fish_sell.id', $id)
        ->first();

    $buyers = DB::table('buyer')->get();
    $ponds = DB::table('pond')->get();

    return view('pond.edit_fish_sell', compact('FishSell', 'buyers', 'ponds'));
    }

    public function updateFishSell(Request $request, $id)
    {
    $request->validate([
        'pond' => 'required|exists:pond,id',
        'buyer' => 'required|exists:buyer,id',
        'fish_name' => 'required|string',
        'qty' => 'required|integer',
        'price' => 'required|numeric',
        'date' => 'required|date',
        'paid_amount' => 'required',
    ]);

    DB::table('fish_sell')
        ->where('id', $id)
        ->update([
            'pond' => $request->pond,
            'buyer' => $request->buyer,
            'fish_name' => $request->fish_name,
            'qty' => $request->qty,
            'price' => $request->price,
            'total_price' => $request->price * $request->qty,
            'paid_amount' => $request->paid_amount,
            'date' => $request->date,
        ]);

    return redirect()->route('fish_sell_report')->with('success', 'Fish sell record updated successfully!');
    }

    public function destroyFishSell($id)
    {
    DB::table('fish_sell')->where('id', $id)->delete();

    return redirect()->route('fish_sell_report')->with('success', 'Fish sell record deleted successfully!');
    }
    
    public function fish_sell_report_by_date(Request $request)
    {

    $this->validate($request, [
        'fdate' => 'required|date',
        'tdate' => 'required|date',
    ]);

    $fromDate = $request->fdate;
    $toDate = $request->tdate;

    $FishSell = DB::table('fish_sell')
        ->join('buyer', 'fish_sell.buyer', '=', 'buyer.id')
        ->join('pond', 'fish_sell.pond', '=', 'pond.id')
        ->select('fish_sell.*', 'buyer.name as buyer_name', 'pond.name as pond_name');

    if ($fromDate && $toDate) {
        $FishSell->whereBetween('fish_sell.date', [$fromDate, $toDate]);
    }

    $FishSell = $FishSell->get();

    return view('pond.fish_sell_report', compact('FishSell'));
    }

    public function fish_sell_due_collection(){
        return view('pond.fish-sell-due-collection');
    }
    
    public function getFishSellHistory(Request $request)
    {
      	$ho = $data['allData'] = FishSell::Where('id', $request->invoice_id)->get();;
        $data['invoice_id'] = $request->invoice_id;

        return view('pond.fish-sell-due-collection', $data);
    }
    
    public function sale_fish_invoice(Request $request){
        	if(!empty($request->id)){
			//invoice create here
			$data['sale_paid_amount'] = 0;
			$data['sale_due_amount'] = 0;
			$data['single_data'] = FishSell::findOrFail($request->id);
			$data['sale_paid_amount'] = $data['single_data']->paid_amount;
			if(!empty($data['sale_paid_amount'])){
				$data['sale_due_amount'] = (float)$data['single_data']->total_price - (float)$data['sale_paid_amount'];
			}
			return view('invoice.fish-sale', $data);
		} else {
			die('Invalid Request.');
		}
    }
    
    public function sale_fish_update_pay($id){
       return view('pond.pay-due', ['id' => $id]);
    }
    
public function sale_fish_update_pay_save(Request $request, $id)
{
    $request->validate([
        'amount' => 'required|numeric|min:0',
    ]);
    $updateDue = FishSell::where('id', $id)->first();
    if (!$updateDue) {
        return redirect()->back()
            ->with('status_color', 'danger')
            ->with('flash_message', 'Record not found.');
    }
    $updateDue->paid_amount += $request->input('amount'); 
    $updateDue->save();
    return redirect()->back()
        ->with('status_color', 'success')
        ->with('flash_message', 'Payment saved successfully!');
}
}
