<?php
namespace App\Repositories\Interfaces;

interface CompanyRepositoryInterface{

     public function index();

     public function create($request);

     public function update($request,$company);

     public function destroy($id);

}