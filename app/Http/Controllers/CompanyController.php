<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\DB;


class CompanyController extends Controller
{
    public function index(Request $request) {
        try {
            $query = DB::table('companies as c')
                ->leftJoin('company_categories as cc', 'c.category_id', '=', 'cc.id')
                ->where('c.delete_status', 1)
                ->select('c.id', 'c.category_id', 'cc.title as category_title', 'c.title as company_title', 'c.description', 'c.image');

            if ($request->has('category_id')) {
                $query->where('c.category_id', $request->category_id);
            }
    
            $companies = $query->paginate(10);
    
            return response()->json([
                'status' => 'success',
                'data' => $companies,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    

    public function show($id) {
        try {
            $company = DB::table('companies as c')
                    ->leftjoin('company_categories as cc', 'c.category_id', '=', 'cc.id')
                    ->where('c.id', $id)
                    ->where('c.delete_status', 1)
                    ->select('c.id','c.category_id','cc.title as category_title','c.title as company_title','c.description','c.image')
                    ->first();

            return response()->json([
                'status' => 'success',
                'data' => $company,
            ]);
        }
        catch(\Exception $e) {
            throw $e;
        }
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'title' => 'required',
                'image' => 'mimes:jpeg,png,jpg|max:2048'
            ]);

            $company = new Company();
            $company->title = $request->title;
            $company->description = $request->description;
            $company->category_id = $request->category_id;
            $image = $request->file('image');
            if($image) {
                $company_name = $request->title;
                $imageName = $company_name.'_'. time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $company->image = $imageName;
            }
            $company->save();

            return response()->json([
                'status' => 'success',
                'message' => 'company created successfully',
                'data' => $company
            ]);
        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    public function update(Request $request, $id) {
        try {
            $request->validate([
                'title' => 'required',
                'image' => 'mimes:jpeg,png,jpg|max:2048'
            ]);
            $company = Company::find($id);
            $company->title = $request->title;
            $company->description = $request->description;
            $company->category_id = $request->category_id;
            $image = $request->file('image');
            if($image) {
                $company_name = $request->title;
                $imageName = $company_name.'_'. time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $company->image = $imageName;
            }
            $company->save();

            return response()->json([
                'status' => 'success',
                'message' => 'company updated successfully',
                'data' => $company
            ]);
        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    public function destroy($id) {
        // dd($id);
        try {
            $company = Company::find($id);
            if($company->image) {
                $image_path = public_path('images').'/'. $company->image;
                if(file_exists($image_path)) {
                    unlink($image_path);
                }
            }
            $company->delete_status = 0;
            $company->save();

            return response()->json([
                'status' => 'success',
                'message' => 'company deleted successfully',
                'data' => $company
            ]);
        }
        catch (\Exception $e) {
            throw $e;
        }
    }
}
