<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use DB;
use Validator;
use Session;
use App\Models\ExpensePurpose;
use App\Models\Expense;
use App\Models\Expense_new;
use App\Models\PermanentExpense;
use App\Models\Animal;
use App\Models\Group;
use Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allPurpose = ExpensePurpose::where('branch_id', Session::get('branch_id'))->get();

        $query = Expense_new::leftJoin('expense_purpose', 'expenses_new.purpose_id', 'expense_purpose.id')
            ->leftJoin('users', 'expenses_new.created_by', 'users.id')
            ->leftJoin('users_type', 'users_type.id', 'users.user_type')
            ->where('expense_purpose.branch_id', Session::get('branch_id'))
            ->select('expenses_new.*', 'users.name as created_by', 'expense_purpose.purpose_name', 'users_type.user_type')
            ->orderBy('id', 'DESC');

        // Filter by purpose if selected
        if ($request->has('purpose_filter') && $request->purpose_filter != '') {
            $query->where('expenses_new.purpose_id', $request->purpose_filter);
        }

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('expense_purpose.purpose_name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('expenses_new.note', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('expenses_new.food', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('users.name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('expenses_new.amount', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Get totals for income (status = 1) and expenses (status = 0)
        $totalQuery = clone $query;
        $totalIncome = $totalQuery->where('expenses_new.status', 1)->sum('expenses_new.amount');

        $totalQuery = clone $query;
        $totalExpense = $totalQuery->where('expenses_new.status', 0)->sum('expenses_new.amount');

        $netAmount = $totalIncome - $totalExpense;

        $allData = $query->paginate(20)->appends($request->except('page'));

        return view('expenses.expense-list', compact('allPurpose', 'allData', 'totalIncome', 'totalExpense', 'netAmount'));
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
            'purpose_id' => 'required',
            'date' => 'required',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) {
                $plainErrorText .= $value[0] . ". ";
            }
            Session::flash('flash_message', $plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color', 'warning');;
        }

        $input = $request->all();
        $input['date'] = date('Y-m-d', strtotime($request->date));
        $input['created_by'] = Auth::user()->id;

        try {
            $bug = 0;
            Expense_new::create($input);
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
        }

        if ($bug == 0) {
            Session::flash('flash_message', 'Expense Successfully Added.');
            return redirect('expense-list')->with('status_color', 'success');
        } else {
            Session::flash('flash_message', 'Something Error Found.');
            return redirect('expense-list')->with('status_color', 'danger');
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
        $data = Expense::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'purpose_id' => 'required',
            'date' => 'required',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            $plainErrorText = "";
            $errorMessage = json_decode($validator->messages(), True);
            foreach ($errorMessage as $value) {
                $plainErrorText .= $value[0] . ". ";
            }
            Session::flash('flash_message', $plainErrorText);
            return redirect()->back()->withErrors($validator)->withInput()->with('status_color', 'warning');;
        }

        $input = $request->all();
        $input['date'] = date('Y-m-d', strtotime($request->date));
        try {
            $bug = 0;
            $data->update($input);
        } catch (\Exception $e) {
            $bug = $e->errorInfo[1];
        }

        if ($bug == 0) {
            Session::flash('flash_message', 'Expense Successfully Updated.');
            return redirect('expense-list')->with('status_color', 'warning');
        } else {
            Session::flash('flash_message', 'Something Error Found.');
            return redirect('expense-list')->with('status_color', 'danger');
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
        $data = Expense_new::findOrFail($id);
        $action = $data->delete();

        if ($action) {
            Session::flash('flash_message', 'Expense Successfully Deleted.');
            return redirect('expense-list')->with('status_color', 'danger');
        } else {
            Session::flash('flash_message', 'Something Error Found.');
            return redirect('expense-list')->with('status_color', 'danger');
        }
    }

    public function ledgers()
    {
        $ledger = DB::table('expenses')
            ->select(
                'date',
                'amount',
                DB::raw("'expense' as type"),
                'expense_purpose.purpose_name as tag'
            )
            ->join('expense_purpose', 'expenses.purpose_id', '=', 'expense_purpose.id')
            ->unionAll(
                DB::table('earning')
                    ->select(
                        'date',
                        'amount',
                        DB::raw("'Income' as type"),
                        'earning_purpose.purpose_name as tag'
                    )
                    ->join('earning_purpose', 'earning.purpose_id', '=', 'earning_purpose.id')
            )
            ->orderBy('date', 'asc')
            ->get();

        // Calculate totals
        $totalEarnings = $ledger->where('type', 'Income')->sum('amount');
        $totalExpenses = $ledger->where('type', 'expense')->sum('amount');
        $netBalance = $totalEarnings - $totalExpenses;

        return view('expenses.ledgers', compact('ledger', 'totalEarnings', 'totalExpenses', 'netBalance'));
    }

    public function ledgersbydate(Request $request)
    {
        // Validate the request
        $this->validate($request, [
            'fdate' => 'required|date',
            'tdate' => 'required|date|after_or_equal:fdate',
        ]);

        // Get the date range from the request
        $fromDate = $request->fdate;
        $toDate = $request->tdate;
        $type = $request->type; // Get the selected type from the dropdown

        // **Initialize Expenses Query**
        $expensesQuery = DB::table('expenses')
            ->select(
                'date',
                'amount',
                DB::raw("'Expense' as type"),
                'expense_purpose.purpose_name as tag'
            )
            ->join('expense_purpose', 'expenses.purpose_id', '=', 'expense_purpose.id')
            ->whereBetween('expenses.date', [$fromDate, $toDate]);

        // **Initialize Earnings Query**
        $earningsQuery = DB::table('earning')
            ->select(
                'date',
                'amount',
                DB::raw("'Income' as type"),
                'earning_purpose.purpose_name as tag'
            )
            ->join('earning_purpose', 'earning.purpose_id', '=', 'earning_purpose.id')
            ->whereBetween('earning.date', [$fromDate, $toDate]);

        // **Apply Type Filtering**
        if ($type == 'Income') {
            $ledger = $earningsQuery->orderBy('date', 'asc')->get(); // Get only income
        } elseif ($type == 'Expense') {
            $ledger = $expensesQuery->orderBy('date', 'asc')->get(); // Get only expenses
        } else {
            // Combine both queries for "All"
            $ledger = $expensesQuery->unionAll($earningsQuery)->orderBy('date', 'asc')->get();
        }

        // **Calculate Totals**
        $totalEarnings = $ledger->where('type', 'Income')->sum('amount');
        $totalExpenses = $ledger->where('type', 'Expense')->sum('amount');
        $netBalance = $totalEarnings - $totalExpenses;

        // **Pass data to the view**
        return view('expenses.ledgers', compact('ledger', 'totalEarnings', 'totalExpenses', 'netBalance', 'fromDate', 'toDate', 'type'));
    }

    public function downloadLedgerCSV(Request $request)
    {
        // **Determine Date Range**
        if (!empty($request->fdate) && !empty($request->tdate)) {
            $fromDate = $request->fdate;
            $toDate = $request->tdate;
        } else {
            // Get min and max dates across both tables
            $fromDate = DB::table('expenses')->min('date');
            $toDate = DB::table('expenses')->max('date');

            $earningMinDate = DB::table('earning')->min('date');
            $earningMaxDate = DB::table('earning')->max('date');

            // Ensure we include both tables
            if ($earningMinDate && (!$fromDate || $earningMinDate < $fromDate)) {
                $fromDate = $earningMinDate;
            }
            if ($earningMaxDate && (!$toDate || $earningMaxDate > $toDate)) {
                $toDate = $earningMaxDate;
            }

            // If no data exists in either table, use a default range
            if (!$fromDate || !$toDate) {
                $fromDate = '2000-01-01';
                $toDate = now()->format('Y-m-d');
            }
        }

        // **Get the Type Filter**
        $type = $request->type ?? 'All';

        // **Query for Expenses**
        $expensesQuery = DB::table('expenses')
            ->select(
                'date',
                'amount',
                DB::raw("'Expense' as type"),
                'expense_purpose.purpose_name as tag'
            )
            ->join('expense_purpose', 'expenses.purpose_id', '=', 'expense_purpose.id')
            ->whereBetween('expenses.date', [$fromDate, $toDate]);

        // **Query for Earnings**
        $earningsQuery = DB::table('earning')
            ->select(
                'date',
                'amount',
                DB::raw("'Income' as type"),
                'earning_purpose.purpose_name as tag'
            )
            ->join('earning_purpose', 'earning.purpose_id', '=', 'earning_purpose.id')
            ->whereBetween('earning.date', [$fromDate, $toDate]);

        // **Apply Type Filtering**
        if ($type == 'Income') {
            $ledger = $earningsQuery->orderBy('date', 'asc')->get();
        } elseif ($type == 'Expense') {
            $ledger = $expensesQuery->orderBy('date', 'asc')->get();
        } else {
            // Combine both queries for "All"
            $ledger = $expensesQuery->unionAll($earningsQuery)->orderBy('date', 'asc')->get();
        }

        // **Check if Data Exists**
        if ($ledger->isEmpty()) {
            return response()->json(['message' => 'No data available'], 404);
        }

        // **Calculate Totals**
        $totalEarnings = $ledger->where('type', 'Income')->sum('amount');
        $totalExpenses = $ledger->where('type', 'Expense')->sum('amount');
        $netBalance = $totalEarnings - $totalExpenses;

        // **Create CSV Content**
        $csvData = "Type,Date,Amount,Tag\n"; // CSV header
        foreach ($ledger as $entry) {
            $csvData .= "{$entry->type},{$entry->date},{$entry->amount},{$entry->tag}\n";
        }

        // **Add Totals to CSV**
        $csvData .= "\nTotal Earnings,{$totalEarnings}\n";
        $csvData .= "Total Expenses,{$totalExpenses}\n";
        $csvData .= "Net Balance,{$netBalance}\n";

        // **Set Filename**
        $fileName = "ledger_report_{$fromDate}_to_{$toDate}_{$type}.csv";

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        // **Return CSV File as Download**
        return Response::make($csvData, 200, $headers);
    }

    public function permanent_expense()
    {
        $PermanentExpense = PermanentExpense::all();

        $totalPermanentExpense = DB::table('permanent_expense')->get();
        $totalEarnings = DB::table('permanent_expense')
            ->where('status', 1)
            ->sum('price');
        $totalExpenses = DB::table('permanent_expense')
            ->where('status', 0)
            ->sum('price');
        $netEarnings = $totalExpenses - $totalEarnings;

        return view('expenses.permanent-expense', compact('PermanentExpense', 'totalPermanentExpense', 'totalEarnings', 'totalExpenses', 'netEarnings'));
    }

    public function add_permanent_expense()
    {
        return view('expenses.add-permanent-expense');
    }

    public function permanent_expense_distribute()
    {
        $data['animal'] = Animal::all();
        $data['groups'] = Group::with('animals')->get();


        return view('expenses.permanent_expense_distribute', $data);
    }
    public function expense_distribute()
    {
        $data['animal'] = Animal::all();
        $data['groups'] = Group::with('animals')->get();
        return view('expenses.expense_distribute', $data);
    }

    public function save_permanent_expense(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'date' => 'required',
            'price' => 'required',
        ]);

        PermanentExpense::create([
            'name' => $request->name,
            'date' => $request->date,
            'status' => $request->status,
            'description' => $request->description,
            'price' => $request->price,
        ]);
        if ($request->status == 1) {
            Expense::create([
                'purpose_id' => 11,
                'date' => $request->date,
                'amount' => $request->price,
                'note' => $request->description,
                'created_by' => 1,
            ]);
        }
        Session::flash('success', 'Permanent Expense added successfully!');
        return redirect()->route('add-permanent-expense');
    }

    public function save_permanent_expense_distribute(Request $request)
    {
        $this->validate($request, [
            'cow' => 'required|array',
            'date' => 'required',
            'price' => 'required',
        ]);

        foreach ($request->cow as $cowId) {
            PermanentExpense::create([
                'date' => $request->date,
                'status' => $request->status,
                'price' => $request->price,
                'cow' => $cowId,  // Use the individual cow ID, not the whole array
                'description' => "Expense on cow ID: " . $cowId,
            ]);
        }

        Session::flash('success', 'Permanent Expense added successfully!');
        return redirect()->route('permanent-expense-distribute');
    }
    public function save_expense_distribute(Request $request)
    {
        $this->validate($request, [
            'cow' => 'required|array',
            'date' => 'required',
            'price' => 'required',
        ]);
        foreach ($request->cow as $cowId) {
            Expense_new::create([
                'date' => $request->date,
                'status' => $request->status,
                'amount' => $request->price,
                'purpose_id' => 12,
                'note' => "Expense on cow ID: " . $cowId,
            ]);
        }

        Session::flash('success', 'Expense added successfully!');
        return redirect()->route('expense-distribute');
    }


    public function edit_permanent_expense($id)
    {
        $expense = PermanentExpense::findOrFail($id);
        return view('expenses.edit-permanent-expense', compact('expense'));
    }

    public function update_permanent_expense(Request $request, $id)
    {
        $this->validate($request, [
            'date' => 'required',
            'price' => 'required',
            'status' => 'required',
        ]);

        $expense = PermanentExpense::findOrFail($id);
        $expense->update([
            'date' => $request->date,
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'price' => $request->price,
        ]);

        Session::flash('success', 'Permanent Expense updated successfully!');
        return redirect()->route('permanent-expense');
    }

    public function delete_permanent_expense($id)
    {
        $expense = PermanentExpense::findOrFail($id);
        $expense->delete();

        Session::flash('success', 'Permanent Expense deleted successfully!');
        return redirect()->route('permanent-expense');
    }

    // public function total_report()
    // {
    //     $PermanentExpense = DB::table('animals')
    //         ->leftJoin('cow_sale_dtls', 'cow_sale_dtls.cow_id', '=', 'animals.id')
    //         ->select('animals.id', 'animals.DOB', 'animals.buying_price', 'cow_sale_dtls.price as sold_price')
    //         ->get();

    //     foreach ($PermanentExpense as $cow) {
    //         // --- Food Cost ---
    //         $food_cost = DB::table('cow_feed')
    //             ->join('cow_feed_dtls', 'cow_feed_dtls.feed_id', '=', 'cow_feed.id')
    //             ->join('cow_food', 'cow_food.food', '=', 'cow_feed_dtls.item_id')
    //             ->where('cow_feed.cow_id', $cow->id)
    //             ->sum(DB::raw('cow_feed_dtls.qty * cow_food.price'));

    //         // --- Vaccine Cost ---
    //         $vaccine_cost = DB::table('cow_vaccine_monitor')
    //             ->join('cow_vaccine_monitor_dtls', 'cow_vaccine_monitor_dtls.monitor_id', '=', 'cow_vaccine_monitor.id')
    //             ->join('vaccines', 'vaccines.id', '=', 'cow_vaccine_monitor_dtls.vaccine_id')
    //             ->where('cow_vaccine_monitor.cow_id', $cow->id)
    //             ->sum('vaccines.price');

    //         // --- Medicine Cost ---
    //         $medicine_cost = DB::table('cow_medicine_monitor')
    //             ->join('cow_medicine_monitor_dtls', 'cow_medicine_monitor_dtls.monitor_id', '=', 'cow_medicine_monitor.id')
    //             ->join('medicines', 'medicines.id', '=', 'cow_medicine_monitor_dtls.vaccine_id')
    //             ->where('cow_medicine_monitor.cow_id', $cow->id)
    //             ->sum('medicines.price');

    //         // --- Permanent Expense (Only status == 0) ---
    //         $permanent_expense = DB::table('permanent_expense')
    //             ->where('cow', $cow->id)
    //             ->where('status', 0)
    //             ->sum('price');

    //         // --- Total Calculation ---
    //         $total_expenses = $food_cost + $vaccine_cost + $medicine_cost + $permanent_expense;
    //         $total_cost = $cow->buying_price + $total_expenses;
    //         $profit = $cow->sold_price !== null ? $cow->sold_price - $total_cost : null;

    //         // Add to object
    //         $cow->total_expenses = $total_expenses;
    //         $cow->total_cost = $total_cost;
    //         $cow->profit = $profit;
    //         $cow->formatted_dob = date('d/m/Y', strtotime($cow->DOB));
    //     }

    //     return view('expenses.total-expense', compact('PermanentExpense'));
    // }

    public function total_report(Request $request)
    {
        $query = DB::table('animals')
            ->leftJoin('cow_sale_dtls', 'cow_sale_dtls.cow_id', '=', 'animals.id')
            ->select('animals.id', 'animals.DOB', 'animals.buying_price', 'animals.sale_status', 'cow_sale_dtls.price as sold_price');

        // Filter by status if given
        if ($request->has('status') && $request->status !== '') {
            $query->where('animals.sale_status', $request->status);
        }

        $PermanentExpense = $query->get();

        foreach ($PermanentExpense as $cow) {
            $food_cost = DB::table('cow_feed')
                ->join('cow_feed_dtls', 'cow_feed_dtls.feed_id', '=', 'cow_feed.id')
                ->join('cow_food', 'cow_food.food', '=', 'cow_feed_dtls.item_id')
                ->where('cow_feed.cow_id', $cow->id)
                ->sum(DB::raw('cow_feed_dtls.qty * cow_food.price'));

            $vaccine_cost = DB::table('cow_vaccine_monitor')
                ->join('cow_vaccine_monitor_dtls', 'cow_vaccine_monitor_dtls.monitor_id', '=', 'cow_vaccine_monitor.id')
                ->join('vaccines', 'vaccines.id', '=', 'cow_vaccine_monitor_dtls.vaccine_id')
                ->where('cow_vaccine_monitor.cow_id', $cow->id)
                ->sum('vaccines.price');

            $medicine_cost = DB::table('cow_medicine_monitor')
                ->join('cow_medicine_monitor_dtls', 'cow_medicine_monitor_dtls.monitor_id', '=', 'cow_medicine_monitor.id')
                ->join('medicines', 'medicines.id', '=', 'cow_medicine_monitor_dtls.vaccine_id')
                ->where('cow_medicine_monitor.cow_id', $cow->id)
                ->sum('medicines.price');

            $permanent_expense = DB::table('permanent_expense')
                ->where('cow', $cow->id)
                ->where('status', 0)
                ->sum('price');

            $total_expenses = $food_cost + $vaccine_cost + $medicine_cost + $permanent_expense;
            $total_cost = $cow->buying_price + $total_expenses;
            $profit = $cow->sold_price !== null ? $cow->sold_price - $total_cost : null;

            $cow->total_expenses = $total_expenses;
            $cow->total_cost = $total_cost;
            $cow->profit = $profit;
            $cow->formatted_dob = date('d/m/Y', strtotime($cow->DOB));
        }

        return view('expenses.total-expense', compact('PermanentExpense'));
    }
}
