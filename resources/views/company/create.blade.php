@extends('layouts.app')
@section('content')
    <div class="content-wrapper" style="min-height: 1345.31px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Company</h1>
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
                            <form method="POST" action="{{ route('company.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="name">Name</label>
                                            <input type="name" name="name" class="form-control" id="name"
                                                placeholder="Enter company name" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">Email address</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                placeholder="Enter email" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="logo">logo</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="logo"
                                                        id="logo">
                                                    <label class="custom-file-label" for="logo">Choose
                                                        company logo</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">Upload</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="website">Website</label>
                                            <input type="website" name="website" class="form-control" id="website"
                                                placeholder="Enter company website">
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
                        <h3 class="card-title">DataTable of all companies</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Company Name</th>
                                    <th>Company Email</th>
                                    <th>Company Logo</th>
                                    <th>Company website link</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $key => $company)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->email }}</td>
                                        <td>
                                            @if ($company->logo && \Storage::disk('public')->exists($company->logo))
                                                {{-- {{ dd(url(\Storage::disk('local')->url($company->logo)))}} --}}
                                                <img src="{{ url(\Storage::disk('public')->url($company->logo)) }}"
                                                    width="75">
                                            @endif
                                        </td>
                                        <td>{{ !empty($company->website) ? $company->website : 'not given' }}</td>

                                        <td class="text-center">
                                            <a class="btn btn-info btn-sm"
                                                href="{{ route('company.show', $company->id) }}"><i
                                                    class="fa fa-user"></i></a>

                                            <button class="btn btn-primary btn-sm edit-btn" data-toggle="modal"
                                                data-target="#edit_modal" data-id="{{ $company->id }}"
                                                data-name="{{ $company->name }}" data-email="{{ $company->email }}"
                                                data-website="{{ !empty($company->website) ? $company->website : 'not given' }}"
                                                data-logo={{ $company->logo }}><i class="fa fa-edit"></i></button>

                                            
                                                <form action="{{ route('company.destroy', $company->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <div class="">
                                <tfoot>
                                    <tr>
                                        {{ $companies->links() }}
                                    </tr>
                                </tfoot>
                            </div>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div>

    @if (isset($company))
        <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Company Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="updateForm" method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <input type="hidden" value="{{ $company->id }}" id="modal_id" name="id">

                            <div class="form-group">
                                <label for="name" class="col-form-label">Name:</label>
                                <input type="text" name="name" class="form-control" id="modal_name">
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email:</label>
                                <input class="form-control" name="email" id="modal_email">
                            </div>
                            <div class="form-group">
                                <label for="logo">logo</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="logo" id="modal_logo">
                                        <label class="custom-file-label" for="logo">Choose
                                            company logo</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="website" class="col-form-label">Website:</label>
                                <input class="form-control" name="website" id="modal_website">
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
                let id = $(this).data('id');
                let name = $(this).data('name');
                let email = $(this).data('email');
                let website = $(this).data('website');
                let logo = $(this).data('logo');

                $('#modal_id').val(id);
                $('#modal_name').val(name);
                $('#modal_email').val(email);
                $('#modal_website').val(website);
                $('#modal-logo').attr('src', logo);
                $('#updateForm').attr('action', '{{ route('company.update', '') }}' + '/' + id);
            });


        });
    </script>
@stop
