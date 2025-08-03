<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Animal;
use App\Models\BeefCollection;
use App\Models\Buyer;
use App\Models\SellBeef;
use App\Models\FoodUnit;
use App\Models\Earning;
use Validator;
use Session;

class BeefController extends Controller
{
    public function index()
    {
       $animal = Animal::all();
       $unit = FoodUnit::all();
       return view('beef.index', compact('animal','unit'));
    }
    
    public function beefsave(Request $request){
        $this->validate($request, [
        'date' => 'required',
        'cow' => 'required',
        'qty' => 'required',
        'unit' => 'required',
        'description' => 'required',
    ]);

    BeefCollection::create([
        'cow' => $request->cow,
        'qty' => $request->qty,
        'quantity' => $request->quantity,
        'unit' => $request->unit,
        'details' => $request->description,
        'date' => $request->date,
    ]);
    
    Session::flash('success', 'successfully added!');
    return redirect()->route('beef');
    }
    
    public function beef_in_stock(){
        $BeefCollection = BeefCollection::all();
        return view('beef.beef-in-stock', compact('BeefCollection'));
    }
    
    public function beef_in_stock_by_date(Request $request){
    $this->validate($request, [
        'fdate' => 'required|date',
        'tdate' => 'required|date',
    ]);
    
    $fromDate = $request->fdate;
    $toDate = $request->tdate;
    
    $BeefCollection = DB::table('beef_collection')
        ->select('beef_collection.*')
        ->whereBetween('beef_collection.date', [$fromDate, $toDate])
        ->get();
    
    return view('beef.beef-in-stock', compact('BeefCollection'));
    }
    
    public function beef_collection_edit($id)
    {
        $animal = Animal::all();
        $beef = DB::table('beef_collection')->where('id', $id)->first();
        if (!$beef) {
        return redirect()->route('beef_in_stock')->with('error', 'Record not found.');
    }
    return view('beef.edit-beef-collection', compact('beef','animal'));
    }
    
    public function beef_collection_update(Request $request, $id)
    {
    $this->validate($request, [
        'cow' => 'required',
        'qty' => 'required',
        'description' => 'required',
        'date' => 'required',
    ]);

    DB::table('beef_collection')
        ->where('id', $id)
        ->update([
            'cow' => $request->cow,
            'qty' => $request->qty,
            'details' => $request->description,
            'date' => $request->date,
        ]);
    return redirect()->route('beef_in_stock')->with('success', 'Record updated successfully.');
    }
    
    public function beef_collection_destroy($id){
        DB::table('beef_collection')->where('id', $id)->delete();
        return redirect()->route('beef_in_stock')->with('success', 'Record deleted successfully.');
    }

    public function beff_sell(){
        $buyer = Buyer::all();
        return view('beef.beff_sell', compact('buyer'));
    }
    
    public function sellbeefsave(Request $request)
    {
    $request->validate([
        'customer' => 'required', 
        'date' => 'required',
        'qty' => 'required|numeric',
        'price' => 'required',
        'total_price' => 'required',
        'due_price' => 'required',
    ]);

    SellBeef::create([
        'customer' => $request->customer,
        'date' => $request->date,
        'qty' => $request->qty,
        'price' => $request->price,
        'total_price' => $request->total_price,
        'due' => $request->due_price,
        'branch' =>  Session::get('branch_id'),
    ]);
  
      Earning::create([
        'purpose_id' => 1,
        'date' => $request->date,
        'amount' => $request->price,
    ]);
    // Redirect with a success message
    return redirect()->route('beff_sell')->with('success', 'Beef sale saved successfully!');
    }
    
    public function due_collect(){
    $branchId = Session::get('branch_id');
     $sellbeef = DB::table('sell_beef')
    ->join('buyer', 'sell_beef.customer', '=', 'buyer.id')
    ->join('branchs', 'sell_beef.branch', '=', 'branchs.id')
    ->select(
        'sell_beef.*',
        'buyer.name as buyer_name',
        'branchs.branch_name as branch_name' 
    )
    ->where('sell_beef.branch', $branchId) 
    ->get();
     return view('beef.due_collect', compact('sellbeef'));
    }
    
    public function due_collect_edit($id)
    {
    $buyer = Buyer::all();
    $sellbeef = DB::table('sell_beef')
        ->join('buyer', 'sell_beef.customer', '=', 'buyer.id')
        ->join('branchs', 'sell_beef.branch', '=', 'branchs.id')
        ->select(
            'sell_beef.*',
            'buyer.name as buyer_name',
            'branchs.branch_name as branch_name'
        )
        ->where('sell_beef.id', $id)
        ->first();
    if (!$sellbeef) {
        return redirect()->route('due_collect')->with('error', 'Record not found.');
    }
    return view('beef.edit-sell-beef', compact('sellbeef','buyer'));
    }
    
    public function due_collect_update(Request $request, $id)
    {
    $this->validate($request, [
        'customer' => 'required',
        'qty' => 'required',
        'price' => 'required',
        'total_price' => 'required',
        'due_price' => 'required',
    ]);

    DB::table('sell_beef')
        ->where('id', $id)
        ->update([
            'customer' => $request->customer,
            'qty' => $request->qty,
            'price' => $request->price,
            'total_price' => $request->total_price,
            'due' => $request->due_price,
            'branch' => Session::get('branch_id'),
        ]);

    return redirect()->route('due_collect')->with('success', 'Record updated successfully.');
    }

    public function due_collect_by_date(Request $request){
    $this->validate($request, [
        'fdate' => 'required|date',
        'tdate' => 'required|date',
    ]);

    $fromDate = $request->fdate;
    $toDate = $request->tdate;
    $branchId = Session::get('branch_id');
    $sellbeef = DB::table('sell_beef')
        ->join('buyer', 'sell_beef.customer', '=', 'buyer.id')
        ->join('branchs', 'sell_beef.branch', '=', 'branchs.id')
        ->select(
            'sell_beef.*',
            'buyer.name as buyer_name',
            'branchs.branch_name as branch_name' 
        )
        ->where('sell_beef.branch', $branchId)
        ->whereBetween('sell_beef.date', [$fromDate, $toDate])
        ->get();
         return view('beef.due_collect', compact('sellbeef'));
    }
    
    public function due_collect_pay($id){
    $sellbeef = DB::table('sell_beef')
    ->join('buyer', 'sell_beef.customer', '=', 'buyer.id')
    ->join('branchs', 'sell_beef.branch', '=', 'branchs.id')
    ->select(
        'sell_beef.*',
        'buyer.name as buyer_name',
        'branchs.branch_name as branch_name'
    )
    ->where('sell_beef.id', $id)
    ->first();

    if (!$sellbeef) {
        return redirect()->route('due_collect')->with('error', 'Record not found.');
    }
        return view('beef.pay', compact('sellbeef'));
    }
    
public function due_collect_pay_update(Request $request, $id)
{
    $this->validate($request, [
        'pay' => 'required|numeric',
    ]);

    $sellbeef = DB::table('sell_beef')
        ->where('id', $id)
        ->first();

    if (!$sellbeef) {
        return redirect()->route('due_collect')->with('error', 'Record not found.');
    }

    $currentTotalPrice = $sellbeef->total_price;
    $currentDue = $sellbeef->due;

    $pay = $request->pay;

    $newTotalPrice = $currentTotalPrice + $pay;
    $newDue = $currentDue - $pay;

    if ($newDue < 0) {
        return redirect()->route('due_collect')->with('error', 'Payment exceeds due amount.');
    }
    
    DB::table('sell_beef')
        ->where('id', $id)
        ->update([
            'total_price' => $newTotalPrice,
            'due' => $newDue,
        ]);
    return redirect()->route('due_collect')->with('success', 'Payment updated successfully.');
}
    
    
    public function due_collect_destroy($id)
    {
    DB::table('sell_beef')->where('id', $id)->delete();
    return redirect()->route('due_collect')->with('success', 'Record deleted successfully.');
    }
}
