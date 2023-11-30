<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    
    public function cView() {
        $customers = Customer::all();
        return view('customers.cView', ['customers' => $customers]);
    }
    
    public function CustomerRegistration() {
        return view('customers.CustomerRegistration');
    }

    public function store(Request $request) {
        //dd( $request );
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'contact' => ['required', 'regex:/^[0-9]{10}$/'],
        ]);
    
        $newCustomer = Customer::create($data);
    
        return redirect(route('customer.cView'));
    }

    public function edit(Customer $customer) {
        //dd($customer);
        return view('customers.cEdit', ['customer' => $customer]);
    }

    public function update(Customer $customer, Request $request ) {
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'contact' => ['required', 'regex:/^[0-9]{10}$/'],
        ]);

        $customer -> update($data);

        return redirect(route('customer.cView'))->with('success', 'Customer Updated Successfully');

    }

    public function delete(Customer $customer) {
        $customer -> delete();
        return redirect(route('customer.cView'))->with('success', 'Customer Deleted Successfully');
    }

}
