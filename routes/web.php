<?php

Route::get('/', function () {
    return redirect('/login');
});
Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('select-branch', 'DashboardController@selectBranch');
    Route::get('admin-proceed-to-dashboard/{id}', 'DashboardController@adminSelectedDashboard');
});
Route::group(['middleware' => ['auth', 'branch', 'user_role']], function () {
    Route::get('dashboard', 'DashboardController@index');
    Route::resource('branch', 'BranchController');
    Route::resource('user-type', 'UserTypeController');
    Route::resource('designation', 'DesignationController');
    Route::resource('human-resource', 'HumanResourceController');
    Route::get('user-list', 'HumanResourceController@userList');
    Route::resource('employee-salary', 'EmployeeSalaryController');
    Route::resource('colors', 'ColorController');

    Route::resource('groups', 'GroupController');

    Route::resource('animal-type', 'AnimalTypeController');
    Route::resource('vaccines', 'VaccinesController');
    Route::resource('sheds', 'ShedController');
    Route::resource('animal', 'AnimalController');
    Route::resource('calf', 'CalfController');
    Route::resource('expense-list', 'ExpenseController');
    Route::resource('expense-purpose', 'ExpensePurposeController');
    Route::resource('supplier', 'SupplierContoller');
    Route::get('search-supplier', 'SupplierContoller@supplierFilter');
    Route::resource('collect-milk', 'CollectMilkController');
    Route::resource('sale-milk', 'SaleMilkController');
    Route::resource('food-unit', 'FoodUnitController');
    Route::resource('food-item', 'FoodItemController');
    Route::resource('cow-feed', 'CowFeedController');
    Route::resource('monitoring-service', 'MonitoringServicesController');
    Route::resource('cow-monitor', 'CowMonitorController');
    Route::resource('expense-report', 'Report\OfficeExpensReportController');
    Route::get('get-expense-report', 'Report\OfficeExpensReportController@store');
    Route::resource('employee-salary-report', 'Report\EmployeeSalaryReportController');
    Route::resource('milk-collect-report', 'Report\MilkCollectReportControlller');
    Route::get('get-milk-collect-report', 'Report\MilkCollectReportControlller@store');
    Route::resource('milk-sale-report', 'Report\MilkSaleReportControlller');
    Route::get('get-milk-sale-report', 'Report\MilkSaleReportControlller@store');
    Route::resource('vaccine-monitor', 'CowVaccineMonitorController');
    Route::resource('vaccine-monitor-report', 'Report\CowVaccineMonitorReportController');
    Route::get('get-vaccine-monitor-report', 'Report\CowVaccineMonitorReportController@store');
    Route::get('vaccine-wise-monitoring-report', 'Report\CowVaccineMonitorReportController@vaccineWiseMonitoringReport');
    Route::get('get-vaccine-wise-monitoring-report', 'Report\CowVaccineMonitorReportController@getVaccineWiseMonitoringReport');

    Route::get('/medicine-monitor', 'CowMedicineMonitorController@index');
    Route::get('/medicine-monitor-create', 'CowMedicineMonitorController@create');
    Route::post('/medicine-monitor-store', 'CowMedicineMonitorController@store')->name('medicine-monitor-store');

    Route::resource('sale-cow', 'SaleCowController');
    Route::resource('cow-sale-report', 'Report\SaleCowReportController');
    Route::get('cow-sale-report-search', 'Report\SaleCowReportController@cowSaleReportSearch');
    Route::resource('sale-due-collection', 'SaleDueCollectionController');
    Route::resource('sale-milk-due-collection', 'MilkSaleDueCollectionController');
    Route::get('get-sale-history', 'SaleDueCollectionController@getSaleHistory');
    Route::get('get-milk-sale-history', 'MilkSaleDueCollectionController@getSaleHistory');
    Route::post('add-cow-sale-payment', 'SaleDueCollectionController@store');
    Route::post('add-milk-sale-payment', 'MilkSaleDueCollectionController@store');
    Route::resource('system', 'SystemController');
    Route::post('get-stock-status', 'SaleMilkController@getStockStatus');
    Route::post('get-vaccine-status', 'CowVaccineMonitorController@getVeccineStatus');
    Route::post('get-animal-details', 'CollectMilkController@getAnimalDetails');
    Route::get('sale-invoice/{id}', 'SaleCowController@printInvoice');
    Route::post('animal-details', 'CowVaccineMonitorController@getAnimalDetails');
    Route::post('animal-monitor-details', 'CowMonitorController@getAnimalDetails');
    Route::get('animal-statistics', 'AnimalStatisticsController@index');
    Route::post('animal-monitor-statistics', 'AnimalStatisticsController@getAnimalDetails');



    Route::post('animal-monitor-statistics-leg', 'AnimalStatisticsController@getAnimalDetails_leg');




    Route::resource('animal-pregnancy', 'AnimalPregnancyController');
    Route::post('animal-pregnancy-monitor', 'AnimalPregnancyController@getAnimalDetails');
    Route::get('animal-pregnancy-list', 'AnimalPregnancyController@animal_pregnancy_list');
    Route::get('sale-milk-invoice/{id}', 'SaleMilkController@printInvoice');
    Route::post('update-profile', 'UserTypeController@updateProfile');

Route::post('max-power-auto-action', 'MaxPowerController@MaxAutoPowerAction');
Route::post('max-power-action', 'MaxPowerController@MaxPowerAction');
Route::post('load-cow', 'CowFeedController@loadCow');
Route::post('load-cow-report', 'CowFeedController@loadCowReport');
Route::post('update-branch-status', 'BranchController@updateStatus');
Route::get('/add-branch', 'BranchController@addBranch');
Route::get('/food-stock-report', 'CowFeedController@FoodStockReport');
Route::get('/addFood', 'FoodItemController@addFood')->name('addFood');
Route::post('/addFoodsave', 'FoodItemController@addFoodSave')->name('addFoodsave');
Route::get('/mix-food', 'FoodItemController@mix_food')->name('mix_food');
Route::post('/mix-food-add', 'FoodItemController@mix_food_add')->name('mix-food-add');
Route::post('/cow-feed-search', 'CowFeedController@search')->name('search');
Route::post('/cow-feed-report-search', 'CowFeedController@CowFeedReportSearch')->name('CowFeedReportSearch');
Route::get('/cow-feed-report', 'CowFeedController@CowFeedReport')->name('CowFeedReport');

// Edit Route
Route::get('/cow-food/{id}/edit', 'CowFeedController@CowFeedReportEdit')->name('cow_food.edit');
Route::put('/cow-food/{id}/update', 'CowFeedController@CowFeedReportUpdate')->name('cow_food.update');


// Delete Route
Route::delete('/cow-feed/{id}/delete', 'CowFeedController@CowFeedReportDelete')->name('cow_food.delete');

Route::get('/cow-feed-stock-report', 'CowFeedController@CowFeedStockReport')->name('CowFeedStockReport');
Route::get('/add-animal-type', 'AnimalTypeController@addtype');
Route::get('/medicine', 'VaccinesController@medicine')->name('medicine');
Route::get('/medicine-list', 'VaccinesController@medicine_list')->name('medicine-list');
Route::get('/medicine-list/{id}', 'VaccinesController@medicine_list_edit')->name('medicine.edit');
Route::put('/medicine-list/{id}', 'VaccinesController@medicine_list_update')->name('medicine.update');
Route::delete('/medicine-list/{id}', 'VaccinesController@medicine_list_destroy')->name('medicine.destroy');
Route::get('/buy_medicine', 'VaccinesController@buy_medicine')->name('buy_medicine');
Route::get('/medicine-stock-report', 'VaccinesController@medicine_stock_report')->name('medicine_stock_report');



Route::get('/edit-medicine/{id}', 'VaccinesController@edit_medicine')->name('edit_medicine');
Route::post('/update-medicine/{id}', 'VaccinesController@update_medicine')->name('update_medicine');
Route::get('/delete-medicine/{id}', 'VaccinesController@delete_medicine')->name('delete_medicine');



Route::get('/medicine-purchases', 'VaccinesController@medicine_purchases')->name('medicine_purchases');
 Route::get('/medicine-purchases/{id}/edit', 'VaccinesController@editPurchase')->name('medicine_purchases.edit');
    Route::put('/medicine-purchases/{id}', 'VaccinesController@updatePurchase')->name('medicine_purchases.update');
    Route::delete('/medicine-purchases/{id}', 'VaccinesController@destroyPurchase')->name('medicine_purchases.destroy');
Route::get('/medicine_purchases_by_date', 'VaccinesController@medicine_purchases_by_date')->name('medicine_purchases_by_date');
Route::get('/medicine-purchases-report', 'VaccinesController@medicine_purchases_report')->name('medicine_purchases_report');
Route::get('/medicine_purchases_report_by_date', 'VaccinesController@medicine_purchases_report_by_date')->name('medicine_purchases_report_by_date');
Route::get('/add_buyer', 'BuyerController@index')->name('add_buyer');
Route::post('/buyersave', 'BuyerController@buyersave')->name('buyersave');
Route::get('/buer_list', 'BuyerController@buer_list')->name('buer_list');
Route::get('/buyer/edit/{id}', 'BuyerController@edit')->name('buyer.edit');
Route::post('/buyer/update/{id}', 'BuyerController@update')->name('buyer.update');
Route::delete('/buyer/delete/{id}', 'BuyerController@destroy')->name('buyer.destroy');
Route::get('/beef', 'BeefController@index')->name('beef');
Route::post('/beefsave', 'BeefController@beefsave')->name('beefsave');
Route::get('/beef-in-stock', 'BeefController@beef_in_stock')->name('beef_in_stock');
Route::get('/beef-in-stock-by-date', 'BeefController@beef_in_stock_by_date')->name('beef-in-stock-by-date');

Route::get('/beef-collection/{id}/edit', 'BeefController@beef_collection_edit')->name('beef_collection.edit');
Route::post('/beef-collection/{id}', 'BeefController@beef_collection_update')->name('beef_collection.update');
Route::delete('/beef-collection/{id}', 'BeefController@beef_collection_destroy')->name('beef_collection.destroy');

Route::get('/beff_sell', 'BeefController@beff_sell')->name('beff_sell');
Route::get('/due_collect', 'BeefController@due_collect')->name('due_collect');
Route::get('/sell-beef/{id}/edit', 'BeefController@due_collect_edit')->name('sell_beef.edit');
Route::post('/sell-beef/{id}', 'BeefController@due_collect_update')->name('sell_beef.update');
Route::get('/sell-beef-pay/{id}', 'BeefController@due_collect_pay')->name('sell_beef.pay');
Route::post('/sell-beef-pay-update/{id}', 'BeefController@due_collect_pay_update')->name('sell_beef.pay_update');
Route::delete('/sell-beef/{id}', 'BeefController@due_collect_destroy')->name('sell_beef.destroy');



Route::get('/due_collect_by_date', 'BeefController@due_collect_by_date')->name('due_collect_by_date');
Route::get('/add-collect-milk', 'CollectMilkController@add_collect_milk')->name('add_collect_milk');
Route::get('/add-sale-milk', 'SaleMilkController@add_sale_milk')->name('add_sale_milk');
Route::get('/spoiled-milk', 'SaleMilkController@spoiled_milk')->name('spoiled_milk');
Route::get('/spoiled-milk-list', 'SaleMilkController@spoiled_milk_list')->name('spoiled_milk_list');


Route::get('/spoiled-milk/{id}/edit', 'SaleMilkController@spoiled_milk_edit')->name('spoiled_milk.edit');
Route::put('/spoiled-milk/{id}', 'SaleMilkController@spoiled_milk_update')->name('spoiled_milk.update');
Route::delete('/spoiled-milk/{id}', 'SaleMilkController@spoiled_milk_destroy')->name('spoiled_milk.destroy');



Route::get('/spoiled_milk_by_date', 'SaleMilkController@spoiled_milk_by_date')->name('spoiled_milk_by_date');
Route::post('/save_spoiled_milk', 'SaleMilkController@save_spoiled_milk')->name('save_spoiled_milk');
Route::get('/ajax-test', 'SaleMilkController@handleRequest')->name('ajax-test');
Route::post('/sellbeefsave', 'BeefController@sellbeefsave')->name('sellbeefsave');
Route::get('/add-pond', 'PondController@add_pond')->name('add_pond');
Route::get('/pond-list', 'PondController@pond_list')->name('pond_list');
Route::get('/fish-stocking/{id}/edit', 'PondController@edit')->name('fish_stocking.edit');
Route::put('/fish-stocking/{id}', 'PondController@update')->name('fish_stocking.update');
Route::delete('/fish-stocking/{id}', 'PondController@destroy')->name('fish_stocking.destroy');
Route::get('/fish_stocking_report_by_date', 'PondController@fish_stocking_report_by_date')->name('fish_stocking_report_by_date');
Route::get('/fish_harvest', 'PondController@fish_harvest')->name('fish_harvest');
Route::post('/save_fish_harvest', 'PondController@save_fish_harvest')->name('save_fish_harvest');
Route::get('/fish_harvest_list', 'PondController@fish_harvest_list')->name('fish_harvest_list');
Route::get('/fish-harvest/{id}/edit', 'PondController@fish_harvest_edit')->name('fish_harvest.edit');
Route::put('/fish-harvest/{id}', 'PondController@fish_harvest_update')->name('fish_harvest.update');
Route::delete('/fish-harvest/{id}', 'PondController@fish_harvest_destroy')->name('fish_harvest.destroy');
Route::get('/fish_harvest_report_by_date', 'PondController@fish_harvest_report_by_date')->name('fish_harvest_report_by_date');
Route::get('/fish_sell', 'PondController@fish_sell')->name('fish_sell');
Route::post('/fish_sell_save', 'PondController@fish_sell_save')->name('fish_sell_save');
Route::get('/fish_sell_report', 'PondController@fish_sell_report')->name('fish_sell_report');
Route::get('/fish-sell/{id}/edit', 'PondController@editFishSell')->name('fish_sell.edit');
Route::post('/fish-sell/{id}', 'PondController@updateFishSell')->name('fish_sell.update');
Route::delete('/fish-sell/{id}', 'PondController@destroyFishSell')->name('fish_sell.destroy');
Route::get('/fish_sell_report_by_date', 'PondController@fish_sell_report_by_date')->name('fish_sell_report_by_date');
Route::get('/fish-sell-due-collection', 'PondController@fish_sell_due_collection')->name('fish-sell-due-collection');
Route::get('/getFishSellHistory', 'PondController@getFishSellHistory')->name('getFishSellHistory');
Route::get('/sale-fish-invoice/{id}', 'PondController@sale_fish_invoice')->name('sale-fish-invoice');
Route::get('/sale-fish-update-pay/{id}', 'PondController@sale_fish_update_pay')->name('sale-fish-update-pay');
Route::post('/sale_fish_update_pay_save/{id}', 'PondController@sale_fish_update_pay_save')->name('sale_fish_update_pay_save');

Route::get('/pay-advance-payment', 'EmployeeSalaryController@pay_advance_payment')->name('pay-advance-payment');
Route::get('/pay-advance-payment-list', 'EmployeeSalaryController@pay_advance_payment_list')->name('pay-advance-payment-list');
Route::post('/pay_advance_payment_save', 'EmployeeSalaryController@pay_advance_payment_save')->name('pay_advance_payment_save');

Route::get('/ledgers', 'ExpenseController@ledgers')->name('ledgers');
Route::get('/ledgersbydate', 'ExpenseController@ledgersbydate')->name('ledgersbydate');
Route::get('/download-ledger-csv', 'ExpenseController@downloadLedgerCSV')->name('ledger.download.csv');
Route::get('/permanent-expense', 'ExpenseController@permanent_expense')->name('permanent-expense');
Route::get('/permanent-expense-distribute', 'ExpenseController@permanent_expense_distribute')->name('permanent-expense-distribute');
Route::get('/expense-distribute', 'ExpenseController@expense_distribute')->name('expense-distribute');
Route::post('/save-permanent-expense-distribute', 'ExpenseController@save_permanent_expense_distribute')->name('save-permanent-expense-distribute');
Route::post('/save-expense-distribute', 'ExpenseController@save_expense_distribute')->name('save-expense-distribute');
Route::get('/add-permanent-expense', 'ExpenseController@add_permanent_expense')->name('add-permanent-expense');
Route::post('/save-permanent-expense', 'ExpenseController@save_permanent_expense')->name('save-permanent-expense');

Route::get('/edit-permanent-expense/{id}', 'ExpenseController@edit_permanent_expense')->name('edit-permanent-expense');
Route::put('/update-permanent-expense/{id}', 'ExpenseController@update_permanent_expense')->name('update-permanent-expense');
Route::delete('/delete-permanent-expense/{id}', 'ExpenseController@delete_permanent_expense')->name('delete-permanent-expense');
Route::get('/total-report', 'ExpenseController@total_report')->name('total-report');

Route::get('/dead-cow', 'AnimalController@DeadAnimal')->name('dead-cow');
Route::get('/add-dead-cow', 'AnimalController@AddDeadAnimal')->name('add-dead-cow');
Route::post('/save-dead-animal', 'AnimalController@SaveDeadAnimal')->name('save-dead-animal');
Route::get('/dead-calf', 'AnimalController@DeadCalf')->name('dead-calf');
Route::get('/add-dead-calf', 'AnimalController@AddDeadCalf')->name('add-dead-calf');
Route::post('/save-dead-calf', 'AnimalController@SaveDeadCalf')->name('save-dead-calf');
Route::get('/cow-ledger/{id}', 'AnimalController@cow_ledger')->name('cow-ledger');
Route::get('/sick-cow', 'AnimalController@SickCow')->name('sick-cow');
Route::get('/add-sick-cow', 'AnimalController@AddSickAnimal')->name('add-sick-cow');
Route::post('/save-sick-cow', 'AnimalController@SaveSickAnimal')->name('save-sick-animal');
Route::delete('/sick-cow/{id}', 'AnimalController@DestroySickAnimal')->name('sick-cow.destroy');


Route::get('/add-hatchery-expense-category', 'PondController@add_hatchery_expense_category')->name('add_hatchery_expense_category');
Route::post('/add-hatchery-expense-category-save', 'PondController@add_hatchery_expense_category_save')->name('add_hatchery_expense_category_save');
Route::get('/hatchery-expense-category-list', 'PondController@hatchery_expense_category_list')->name('hatchery_expense_category_list');
Route::get('/add-fish-stocking', 'PondController@add_fish_stocking')->name('add_fish_stocking');
Route::post('/save-fish-stocking', 'PondController@save_fish_stocking')->name('save_fish_stocking');
Route::get('/fish-stocking-report', 'PondController@fish_stocking_report')->name('fish_stocking_report');
Route::post('/AddPondSave', 'PondController@AddPondSave')->name('AddPondSave');
Route::post('/AddMedicine', 'VaccinesController@AddMedicine')->name('AddMedicine');
Route::post('/BuyMedicineSave', 'VaccinesController@BuyMedicineSave')->name('BuyMedicineSave');
Route::post('update-human-resource-status', 'HumanResourceController@updateStatus');
Route::post('load-cow-calf', 'SaleCowController@loadCowCalf');

Route::get('animal-group', 'AnimalGroupController@index')->name('animal-group');
Route::post('animal-group/store', 'AnimalGroupController@store')->name('animal-group.store');
Route::post('animal-group/update', 'AnimalGroupController@update')->name('animal-group.update');

Route::get('/get-cows-by-group/{group_id}', 'AnimalGroupController@getCowsByGroup');


});

/******************************************CLEAR ALL CACHE*************************************/

//Clear Cache facade value:
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});

//Reoptimized class loader:
Route::get('/optimize', function () {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});

//Route cache:
Route::get('/route-cache', function () {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function () {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function () {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function () {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
/******************************************************************************************************/
