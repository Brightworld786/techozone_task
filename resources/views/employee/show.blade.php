@extends('layouts.app')
@section('content')
    <div class="content-wrapper" style="min-height: 1345.31px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>View Employee Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            {{-- <li class="breadcrumb-item active">Add Company</li> --}}
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Create Employee</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="name">First Name</label>
                                            <input type="name" value="{{ $employee->first_name }}" name="first_name"
                                                class="form-control" id="first_name" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="last_name">Last Name</label>
                                            <input type="last_name" value="{{ $employee->last_name }}" name="last_name"
                                                class="form-control" id="last_name" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="email">Email address</label>
                                            <input type="email" name="email" value="{{ $employee->email }}"
                                                class="form-control" id="email" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="phone">Phone</label>
                                            <input type="phone" value="{{ $employee->phone }}" name="phone"
                                                class="form-control" id="phone" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                         <div class="form-group col-md-6" >
                                            <label for="company">Company</label>
                                            <input type="company" value="{{ $employee->company->name }}" name="company"
                                                class="form-control" id="company" readonly>
                                         </div>

                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <a href="{{route('employee.index')}}" class="btn btn-info">GO Back <i
                                            class="icon-paperplane ml-2"></i></a>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
