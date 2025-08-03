<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Log; 
use App\User;
use App\Models\EmployeeSalary;
use App\Models\EmployeeSalaryAdvance;
use App\Models\Expense;
use DB;
use Session;
use Auth;
use Validator;
class EmployeeSalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $salaryList = EmployeeSalary::leftJoin('users','employee_salary.employee_id','users.id')
                                    ->where('users.branch_id', Session::get('branch_id'))
                                    ->select('employee_salary.*','users.name as employee_name','users.image')
                                    ->paginate(10);
        return view('employee-salary.salary-list',compact('salaryList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allEmployee = User::where('user_type', '!=', 1)
                       ->where('users.branch_id', Session::get('branch_id'))
                       ->get();
        return view('employee-salary.employee-salary',compact('allEmployee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
public function store(Request $request)
{
    // Validate request inputs
    $validator = Validator::make($request->all(), [
        'paydate' => 'required',
        'employee_id' => 'required',
        'year' => 'required',
        'month' => 'required',
        'salary' => 'required',
    ]);

    if ($validator->fails()) {
        // Convert validation errors into a readable message
        $plainErrorText = implode(" ", array_map(function ($value) {
            return $value[0];
        }, json_decode($validator->messages(), true)));

        // Store error message in session
        Session::flash('flash_message', $plainErrorText);
        return redirect()->back()->withErrors($validator)->withInput()->with('status_color', 'warning');
    }

    // Prepare input data
    $input = $request->all();
    $input['paydate'] = date('Y-m-d', strtotime($input['paydate']));
    $input['salary'] += $request->Pay_from_advance_payment ?? 0;
    
    $input['purpose_id'] = 15;
    $input['date'] = date('Y-m-d', strtotime($input['paydate']));
    $input['amount'] = $input['salary'] += $request->Pay_from_advance_payment ?? 0;
    $input['created_by'] = 1;

    try {
        // Initialize error tracking variable
        $bug = 0;

        // Insert employee salary record
        $insert = EmployeeSalary::create($input);
        $insertExpense = Expense::create($input);
        // Handle advance payment updates
        $payFromAdvance = $request->Pay_from_advance_payment ?? 0;
        $advancePay = $request->advance ?? 0;

        if ($insert) {
            $userId = $insert->employee_id;

            // Increase user's advance payment if applicable
            if ($advancePay > 0) {
                DB::table('users')->where('id', $userId)->increment('advance_payment', $advancePay);
            }

            // Deduct from advance payment if applicable
            if ($payFromAdvance > 0) {
                $user = DB::table('users')->where('id', $userId)->first();

                if ($user) {
                    if ($user->advance_payment >= $payFromAdvance) {
                        DB::table('users')->where('id', $userId)->decrement('advance_payment', $payFromAdvance);
                        
                        return redirect()->back()
                            ->with('status_color', 'success')
                            ->with('flash_message', 'Advance payment deducted successfully!');
                    } else {
                        return redirect()->back()
                            ->with('status_color', 'danger')
                            ->with('flash_message', 'Insufficient advance payment balance.');
                    }
                } else {
                    return redirect()->back()
                        ->with('status_color', 'danger')
                        ->with('flash_message', 'User not found.');
                }
            }
        }
    } catch (\Exception $e) {
        $bug = 1;
        Log::error('Error in Employee Salary Store: ' . $e->getMessage()); // Log error for debugging
    }

    // Success or failure message
    if ($bug == 0) {
        return redirect('employee-salary')->with([
            'status_color' => 'success',
            'flash_message' => 'Employee Successfully Added.',
        ]);
    } else {
        return redirect('employee-salary')->with([
            'status_color' => 'danger',
            'flash_message' => 'Something went wrong. Please try again.',
        ]);
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
        $allEmployee = User::where('user_type', '!=', 1)
                        ->where('users.branch_id', Session::get('branch_id'))
                        ->get();
        $employeeSalary = EmployeeSalary::findOrFail($id);
        return view('employee-salary.employee-salary',compact('allEmployee','employeeSalary'));
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
        $data=EmployeeSalary::findOrFail($id);

        $validator = Validator::make($request->all(), [
                    'paydate' => 'required',
                    'employee_id' => 'required',
                    'year' => 'required',
                    'month' => 'required',
                    'salary' => 'required',
                ]);

        if($validator->fails()){
            Session::flash('flash_message','Please Fillup all Valid Inputs.');
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color','warning');
        }

        $input=$request->all();
        $input['paydate'] = date('Y-m-d', strtotime($input['paydate']));

        try{
            $bug=0;
            $data->update($input);
        }
        catch(\Exception $e){
            $bug = $e->errorInfo[1];
        }

        if($bug==0){
            Session::flash('flash_message','Employee Salary Successfully Updated.');
            return redirect('employee-salary')->with('status_color','warning');
        }
        else{
            Session::flash('flash_message','Something Error Found.');
            return redirect('employee-salary')->with('status_color','danger');
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
        $data = EmployeeSalary::findOrFail($id);

        try{
            $bug=0;
            $delete = $data->delete();
        }
        catch(\Exception $e){
            $bug=$e->errorInfo[1];
        }

        if($bug==0){
            Session::flash('flash_message','Data Successfully Deleted !');
            return redirect('employee-salary')->with('status_color','danger');
        }else{
            Session::flash('flash_message','Something Error Found !');
            return redirect()->back()->with('status_color','danger');
        }
    }
    
    public function pay_advance_payment(){
        $allEmployee = User::where('user_type', '!=', 1)
                       ->where('users.branch_id', Session::get('branch_id'))
                       ->get();
        return view('employee-salary.pay-advance-payment',compact('allEmployee'));
    }
    
    public function pay_advance_payment_save(Request $request){
        $validator = Validator::make($request->all(), [
        'advance' => 'required',
        'date' => 'required',
        'employee_id' => 'required',
    ]);
    $input = $request->all();
    $insert = EmployeeSalaryAdvance::create($input);
    if($insert){
    DB::table('users')->where('id', $request->employee_id)->increment('advance_payment', $request->advance);
         
    return redirect()->back()->with('status_color', 'success')->with('flash_message', 'Advance payment added successfully!');
    }
    }
    
    public function pay_advance_payment_list(){
        $AdvanceSalary = EmployeeSalaryAdvance::join('users', 'employee_salary_advance_payment.employee_id', '=', 'users.id')
    ->select('employee_salary_advance_payment.*','users.name as user_name')
    ->get();
        return view('employee-salary.advance-payment-list',compact('AdvanceSalary'));
    }
}
