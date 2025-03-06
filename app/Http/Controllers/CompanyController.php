<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{

    public function index() {
        try {
            $companies = Company::where('delete_status', 1)->paginate('3');

            return response()->json([
                'status' => 'success',
                'data' => $companies,
            ]);
        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    public function show($id) {
        try {
            $company = Company::where('delete_status', 1)->find($id);

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

    public function destory($id) {
        try {
            $company = Company::find($id);
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
