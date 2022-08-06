<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    private $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepositoryInterface)
    {
        $this->companyRepository = $companyRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = $this->companyRepository->index();
        return view('company.create', compact('companies'));
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
            'name' => 'required|max:400',
            'email' => 'required|email|unique:employees,email',
            'logo' => 'nullable',
            'website' => 'nullable|string|min:8'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {

            DB::beginTransaction();
            $company = Company::where('name', $request->name)->where('email', $request->email)->first();
            if (!empty($company)) {
                toastr()->warning('Company already exists');
                return redirect()->back();
            } else {
                $company = $this->companyRepository->create($request);
                if (!empty($company)) {
                    toastr()->success('Company added successfully');
                    DB::commit();
                }
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            return redirect()->back()->with('message', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('company.show')->with('company', $company);
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
    public function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $company = $this->companyRepository->update($request, $id);
            if (!empty($company) || $company == true) {
                DB::commit();
                toastr()->info('Company updated successfully');
                return redirect()->back();
            }
            toastr()->info('Company not found');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            return redirect()->back()->with('message', $e->getMessage());
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
        try {
            DB::beginTransaction();
            $company = $this->companyRepository->destroy($id);
            if (!empty($company)) {
                $company->delete();
                DB::commit();
                toastr()->info('Company deleted successfully');
                return redirect()->back();
            } else {
                toastr()->info('Company not found');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            // dd($e);
            DB::rollBack();
            Log::debug($e->getMessage());
            return redirect()->back()->with('message', $e->getMessage());
        }
    }
}
