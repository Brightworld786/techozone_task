<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\Employee;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function index()
    {
        $employees = Employee::with(['company'=>function($query){
            $query->withTrashed();
        }])->latest()->paginate(10);
        
        return $employees;
    }

    public function create($request)
    {
        $employee=  Employee::create([
            'first_name' => isset($request->first_name) ? $request->first_name : null,
            'last_name' => isset($request->last_name) ? $request->last_name : null,
            'email' => isset($request->email) ? $request->email : null,
            'company_id' => isset($request->company_id) ? $request->company_id : null,
            'phone' => isset($request->phone) ? $request->phone : null,
        ]);
        $details = [
            'title' => 'Mail from Techozone.com',
            'body' => 'you are register as an employee in company'
        ];
        // Mail::to($request->email)->send(new \App\Mail\SendMailToCompany($details));

        return $employee;
    }

    public function show($id)
    {
        $employee = Employee::where('id', $id)->with(['company' => function ($query) {
            $query->withTrashed();
        }])->first();
        return $employee;
    }

    public function update($request, $id)
    {

        $employee = Employee::find($id);

        $data = [
            'first_name' => isset($request->first_name) ? $request->first_name : $employee->first_name,
            'last_name' => isset($request->last_name) ? $request->last_name :  $employee->last_name,
            'email' => isset($request->email) ? $request->email : $employee->email,
            'phone' => isset($request->phone) ? $request->phone : $employee->phone,
            'company_id' => isset($request->company_id) ? $request->company_id : $employee->company_id,
        ];

        $updated_employee = $employee->update($data);
        return $updated_employee;
        
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        return $employee;
    }
}
