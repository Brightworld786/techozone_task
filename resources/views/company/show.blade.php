@extends('layouts.app')
@section('content')
    <div class="content-wrapper" style="min-height: 1345.31px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>View Company Details</h1>
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
                                <h3 class="card-title">Create Company</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="" action="" enctype="">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Name</label>
                                            <input type="name" value="{{ $company->name }}" name="name"
                                                class="form-control" id="name" readonly>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">Email address</label>
                                            <input type="email" name="email" value="{{ $company->email }}"
                                                class="form-control" id="email" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="logo">logo</label><br>
                                            <img src="{{ url(\Storage::disk('public')->url($company->logo)) }}"
                                            width="30%" height="70">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="website">Website</label>
                                            <input type="website" value="{{ $company->website }}" name="website"
                                                class="form-control" id="website" readonly>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <a href="{{route('company.index')}}" class="btn btn-info">GO Back <i
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
