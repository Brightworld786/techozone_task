<?php

namespace App\Repositories;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function index()
    {
        $companies = Company::orderBy('created_at', 'desc')->paginate(10);
        return $companies;
    }

    public function create($request)
    {
        $path = isset($request->logo) ? Storage::disk('public')->put('company', $request->logo) : null;
        $company = Company::create([
            'name' => isset($request->name) ? $request->name : null,
            'email' => isset($request->email) ? $request->email : null,
            'logo' => $path,
            'website' => isset($request->website) ? $request->website : null
        ]);
        $details = [
            'title' => 'Mail from Techozone.com',
            'body' => 'your company is registered by techozone'
        ];
        // dd($details);
        // Mail::to($request->email)->send(new \App\Mail\SendMailToCompany($details));
        
        return $company;
    }

    public function update($request, $id)
    {
        $company = Company::find($id);
        $path = isset($request->logo) ? Storage::disk('public')->put('company', $request->logo) : null;
        $data = [
            'name' => isset($request->name) ? $request->name : $company->name,
            'email' => isset($request->email) ? $request->email : $company->email,
            'website' => isset($request->website) ? $request->website : $company->website
        ];
        if($path != null) {
            $data['logo'] = $path;
        }
        $updated_company = $company->update($data);
        
        return $updated_company;
        
    }

    public function destroy($id)
    {
        $company =  Company::find($id);
        return $company;
    }
}
