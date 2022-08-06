 @extends('layouts.app')
 @section('content')
     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1>Dasboard</h1>
                     </div>
                     
                 </div>
             </div><!-- /.container-fluid -->
         </section>

         <!-- Main content -->
         {{-- <section class="content">

      <!-- /.container-fluid -->
    </section> --}}
         <!-- /.content -->
         <section class="content">
             <div class="container-fluid">
                 <div class="row">
                     <div class="col-lg-3 col-6">
                         <!-- small box -->
                         <div class="small-box bg-info">
                          <div class="inner">
                            <h3>{{App\Models\Company::count()}}</h3>
            
                            <p>Total Companies</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                          </div>
                          {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                        </div>
                     </div>
                     <!-- ./col -->
                     <div class="col-lg-3 col-6">
                         <!-- small box -->
                         <div class="small-box bg-success">
                             <div class="inner">
                                 <h3>{{App\Models\Employee::count()}}<sup style="font-size: 20px"></sup></h3>

                                 <p>Total Employess</p>
                             </div>
                             <div class="icon">
                                 <i class="ion ion-person-add"></i>
                             </div>
                             {{-- <a href="#" class="small-box-footer">More info <i
                                     class="fas fa-arrow-circle-right"></i></a> --}}
                         </div>
                     </div>
                     <!-- ./col -->
                     <div class="col-lg-3 col-6">
                         <!-- small box -->
                         <div class="small-box bg-warning">
                             <div class="inner">
                                 <h3>0</h3>

                                 <p>Nothing</p>
                             </div>
                             <div class="icon">
                                 {{-- <i class="ion ion-person-add"></i> --}}
                             </div>
                             {{-- <a href="#" class="small-box-footer">More info <i
                                     class="fas fa-arrow-circle-right"></i></a> --}}
                         </div>
                     </div>
                     <!-- ./col -->
                     <div class="col-lg-3 col-6">
                         <!-- small box -->
                         <div class="small-box bg-danger">
                             <div class="inner">
                                 <h3>0</h3>

                                 <p>Nothing</p>
                             </div>
                             <div class="icon">
                                 {{-- <i class="ion ion-pie-graph"></i> --}}
                             </div>
                             {{-- <a href="#" class="small-box-footer">More info <i --}}
                                     {{-- class="fas fa-arrow-circle-right"></i></a> --}}
                         </div>
                     </div>
                     <!-- ./col -->
                 </div>
             </div>
         </section>
     </div>
 @endsection
