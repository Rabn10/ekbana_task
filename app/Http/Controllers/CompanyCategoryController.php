<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyCategory;

class CompanyCategoryController extends Controller
{
    public function index() {
        try {
            $category = CompanyCategory::where('delete_status', 1)->paginate('2');

            return response()->json([
                'status' => 'success',
                'data' => $category,
            ]);
        }
        catch(Exception $e) {
           throw $e; 
        }
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'title' => 'required'
            ]);

            $category = new CompanyCategory();
            $category->title = $request->title;
            $category->save();

            return response()->json([
                'status' => 'success',
                'message' => 'category created successfully',
                'data' => $category,
            ]);
        }
        catch(Exception $e) {
           throw $e; 
        }
    }

    public function show($id) {
        try {
            $category = CompanyCategory::where('delete_status', 1)->find($id);

            return response()->json([
                'status' => 'success',
                'data' => $category,
            ]);

        }
        catch(Exception $e) {
           throw $e; 
        }
    }

    public function update(Request $request, $id) {
        try {
            $request->validate([
                'title' => 'required'
            ]);
            $category = CompanyCategory::find($id);
            $category->title = $request->title;
            $category->save();

            return response()->json([
                'status' => 'success',
                'message' => 'category updated successfully',
                'data' => $category,
            ]);
        }
        catch(Exception $e) {
           throw $e; 
        }
    }

    public function destroy($id) {
        try {
            $category = CompanyCategory::find($id);
            $category->delete_status = 0;
            $category->save();

            return response()->json([
                'status' => 'success',
                'message' => 'category deleted successfully',
                'data' => $category,
            ]);
        }
        catch(Exception $e) {
           throw $e; 
        }
    }
}
