@extends('layouts.app')
@section('content')
    <div class="content-wrapper" style="min-height: 1345.31px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Employee</h1>
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
                            <form method="POST" action="{{ route('employee.store') }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="name">First Name</label>
                                            <input type="name" name="first_name" class="form-control" id="first_name"
                                                placeholder="Enter first name" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="name">last Name</label>
                                            <input type="name" name="last_name" class="form-control" id="last_name"
                                                placeholder="Enter last name" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="website">Email</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                placeholder="Enter email">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Select Company</label>
                                            <select id="company" name="company_id"
                                                class="form-control form-control-select2" data-fouc required>
                                                <option disabled selected>Select company</option>
                                                @foreach (App\Models\Company::all() as $company)
                                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="phone">phone</label>
                                            <input type="phone" name="phone" class="form-control" id="phone"
                                                placeholder="Enter phone number">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">DataTable with default features</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Company</th>
                                    <th>Phone</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $key => $employee)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $employee->first_name }}</td>
                                        <td>{{ $employee->last_name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->company->name }}</td>
                                        <td>{{ !empty($employee->phone) ? $employee->phone : 'not given' }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-info btn-sm"
                                                href="{{ route('employee.show', $employee->id) }}"><i
                                                    class="fa fa-user"></i></a>

                                            <button class="btn btn-primary btn-sm edit-btn" data-toggle="modal"
                                                data-target="#edit_modal" data-id="{{ $employee->id }}"
                                                data-first_name="{{ $employee->first_name }}"
                                                data-last_name="{{ $employee->last_name }}"
                                                data-email="{{ $employee->email }}"
                                                data-company="{{ $employee->company->name }}"
                                                data-phone="{{ !empty($employee->phone) ? $employee->phone : 'not given' }}"><i
                                                    class="fa fa-edit"></i></button>

                                            <form action="{{ route('employee.destroy', $employee->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    {{ $employees->links() }}
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>

    @if (isset($employee))
        <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Employee Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="updateForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $employee->id }}" id="modal_id" name="id">

                            <div class="form-group">
                                <label for="first_name" class="col-form-label">First Name:</label>
                                <input type="text" name="first_name" class="form-control" id="modal_first_name">
                            </div>
                            <div class="form-group">
                                <label for="last_name" class="col-form-label">Last Name:</label>
                                <input type="text" name="last_name" class="form-control" id="modal_last_name">
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email:</label>
                                <input class="form-control" name="email" id="modal_email">
                            </div>
                            <div class="form-group">
                                <label>Select Company</label>
                                <select id="company" name="company_id" id="modal_company_id"
                                    class="form-control form-control-select2" data-fouc required>
                                    @foreach (App\Models\Company::all() as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="col-form-label">Phone:</label>
                                <input class="form-control" name="phone" id="modal_phone">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
@stop

@section('script')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {

            $('.edit-btn').click(function(e) {
                console.log($(this).data('id'));
                let id = $(this).data('id');
                let first_name = $(this).data('first_name');
                let last_name = $(this).data('last_name');
                let email = $(this).data('email');
                let phone = $(this).data('phone');
                let company = $(this).data('company');

                $('#modal_id').val(id);
                $('#modal_first_name').val(first_name);
                $('#modal_last_name').val(last_name);
                $('#modal_email').val(email);
                $('#modal_phone').val(phone);
                $('#modal_company_id').val(company);
                $('#updateForm').attr('action', '{{ route('employee.update', '') }}' + '/' + id);
            });
        });
    </script>
@stop
