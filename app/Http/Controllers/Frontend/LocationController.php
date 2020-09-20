<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    //
    public function index() {
    	$citys = \DB::table('locations')->where('type', 1)->get();
        $viewMA = [
            'citys' => $citys
        ];
        return view('frontend.pages.shopping.index', $viewMA);
    	// return view('welcome', compact('citys'));
    }

    public function getLocation(Request $request) {
    	$parentID = $request->parent;
		if ($parentID) {
			# code...
			$locations = DB::table('locations')
			->where('parent_id', $parentID)
			->get();
			return response(['data' => $locations]);
		}
    }
}
