<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Product;
use App\Models\FreeIssue;

class FreeIssueController extends Controller
{
    
    public function fView() {
        $freeissue = FreeIssue::all();
        return view('freeissues.fView', ['freeissue' => $freeissue]);
        // return view('freeissues.fView');
    }

    public function FreeIssue() {
        $products = Product::all();
        return view('freeissues.FreeIssue', ['products' => $products]);
    }

    public function store(FreeIssue $freeissue,Request $request)
    {
        //dd( $request );

        $request->validate([
            'fIssue' => 'required|string',
            'type' => 'required|string',
            'pro' => ['required', Rule::unique('freeissues', 'pro')->ignore($freeissue->id)],
            'pQuan' => 'required|numeric',
            'fQuan' => 'nullable|numeric',
            'fQuan1' => 'nullable|numeric',
            'fQuan2' => 'nullable|numeric',
            'fQuan5' => 'nullable|string',
            'uLimit' => 'required|numeric'
        ], [
            'required' => 'The :attribute field is required.', 
            'numeric' => 'The :attribute must be a number.', 
            'unique' => 'The :attribute has already been taken.'
        ]);

        $fIssue =  $request->input('fIssue');
        $type =  $request->input('type');
        $pro =  $request->input('pro');
        $fPro = $request->input('pro');
        $pQuan =  $request->input('pQuan');
        $fQuan =  $request->input('fQuan');
        $fQuan1 =  $request->input('fQuan1');
        $fQuan2 =  $request->input('fQuan2');
        $fQuan5 =  $request->input('fQuan5');
        $lLimit =  $request->input('pQuan');
        $uLimit =  $request->input('uLimit');

        // Check for required fields
        if ($type == "Multiple") {
            $fQuan0 = $request->input('fQuan5'); // Get the value of fQuan5 for 'Multiple'
        } else {
            $fQuan0 = $request->input('fQuan'); // Default value for 'Flat'
        }

        // Create a FreeIssue model instance
        $freeIssue = new FreeIssue();
        
        // Assign other input data to the model attributes
        $freeIssue->fIssue = $fIssue;
        $freeIssue->type = $type;
        $freeIssue->pro = $pro;
        $freeIssue->fPro = $pro;
        $freeIssue->pQuan = $pQuan;
        $freeIssue->fQuan = $fQuan0; // Set the value of fQuan0 in the model
        $freeIssue->lLimit = $pQuan;
        $freeIssue->uLimit = $uLimit;

        // Save the model to the database
        $freeIssue->save();

        return redirect(route('freeissue.fView'))->with('success', 'Free Issue Added successfully');
        
    }



    public function edit(FreeIssue $freeissue) {
        //dd($customer);
        return view('freeissues.fEdit', ['freeissue' => $freeissue]);
    }

    public function update(FreeIssue $freeissue, Request $request) {
        // Validate incoming request if needed
    
        // Retrieve the specific FreeIssue record by its ID
        $freeIssueToUpdate = FreeIssue::find($freeissue->id);
    
        // Update the fields with the new values from the request
        $freeIssueToUpdate->fIssue = $request->input('fIssue');
        $freeIssueToUpdate->type = $request->input('type');
        $freeIssueToUpdate->pro = $request->input('pro');
        $freeIssueToUpdate->fPro = $request->input('fPro');
        $freeIssueToUpdate->pQuan = $request->input('pQuan');
        $freeIssueToUpdate->fQuan = $request->input('fQuan');
        $freeIssueToUpdate->uLimit = $request->input('uLimit');
    
        // Save the updated record to the database
        $freeIssueToUpdate->save();
    
        return redirect()->route('freeissue.fView')->with('success', 'Free Issue Updated Successfully');
    }

    public function delete(FreeIssue $freeissue) {
        $freeissue -> delete();
        return redirect(route('freeissue.fView'))->with('success', 'Free Issue Deleted Successfully');
    }

}
