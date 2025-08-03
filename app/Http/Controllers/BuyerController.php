<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Buyer;
use Validator;
use Session;


class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('buyer.AddBuyer');
    }
    public function buyersave(Request $request){
    $this->validate($request, [
        'name' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'balance' => 'required',
    ]);

    Buyer::create([
        'name' => $request->name,
        'phone' => $request->phone,
        'address' => $request->address,
        'balance' => $request->balance,
    ]);
    Session::flash('success', 'Buyer added successfully!');
    return redirect()->route('add_buyer');
    }
    public function buer_list(){
        $buyer = Buyer::all();
        return view('buyer.list', compact('buyer'));
    }
    public function edit($id)
    {
    $buyer = Buyer::find($id);
    return view('buyer.edit', compact('buyer'));
    }
public function update(Request $request, $id)
{
    $this->validate($request, [
        'name' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'balance' => 'required',
    ]);
    $buyer = Buyer::find($id);
    $buyer->update([
        'name' => $request->name,
        'phone' => $request->phone,
        'address' => $request->address,
        'balance' => $request->balance,
    ]);
    Session::flash('success', 'Buyer updated successfully!');
    return redirect()->route('buer_list');
}
public function destroy($id)
{
    // Find the buyer by ID
    $buyer = Buyer::find($id);

    // Delete the buyer
    $buyer->delete();

    // Flash success message and redirect
    Session::flash('success', 'Buyer deleted successfully!');
    return redirect()->route('buer_list');
}
}
