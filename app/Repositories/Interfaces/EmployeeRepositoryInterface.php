<?php
namespace App\Repositories\Interfaces;

interface EmployeeRepositoryInterface{

     public function index();

     public function create($request);

     public function update($request,$employee);

     public function destroy($id);

     public function show($id);

}