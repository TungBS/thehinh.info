<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AutoCompleteController extends Controller
{
    //
    public function index()
    {
        return view('jqueryAutocomplete.search');
    }
 
    public function search(Request $request)
    {
          $search = $request->get('term');
      
          $result = Product::where('pro_name','like','%'.$search.'%')->get();
 
          return response()->json($result);
            
    } 
}