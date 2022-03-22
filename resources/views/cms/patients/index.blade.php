@extends('cms.parant')
@section('title',__('cms.patients'))
@section('page-name',__('cms.index'))
@section('main-page',__('cms.patients'))
@section('small-page-name',__('cms.index'))
@section('styles')

@endsection
@section('main-content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.patients')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Ensurance Number</th>
                                    <th>National Number</th>
                                    <th>Mobile</th>
                                    <th>birth Date</th>
                                    <th>Email</th>
                                    <th>{{__('cms.permission')}}</th>
                                    <th>Gender</th>
                                    <th style="width: 40px">Active</th>
                                    <th>City</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($patients as $patient)
                                <tr>
                                    <td>{{$patient->id}}</td>
                                    <td>{{$patient->f_name}}</td>
                                    <td>
                                        {{$patient->l_name}}
                                    </td>
                                    <td>{{$patient->ensurance_num}}</td>
                                    <td>{{$patient->national_num}}</td>
                                    <td>{{$patient->mobile}}</td>
                                    <td>{{$patient->birth_date}}</td>
                                    <td>{{$patient->email}}</td>
                                    <td><a class="btn btn-app bg-info" href="{{route('patient.edit_permissions',$patient->id)}}">
                                            <span class="badge bg-purple">{{$patient->permissions_count}}</span>
                                            <i class="fas fa-users"></i> {{__('cms.permission')}}
                                        </a></td>
                                    <td><span
                                            class="badge @if($patient->gender) bg-success @else bg-warning @endif">{{$patient->gender_type}}</span>
                                    </td>
                                    <td><span
                                            class="badge @if($patient->active) bg-success @else bg-danger @endif">{{$patient->active_status}}</span>
                                    </td>
                                    <td>{{$patient->city->name_en}}</td>
                                    <td>{{$patient->created_at}}</td>
                                    <td>{{$patient->updated_at}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('patients.edit',$patient->id)}}" class="btn btn-warning"
                                                style="margin-right: 10px; border-radius: 10%">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="confirmDelete('{{$patient->id}}' , this)"
                                                class="btn btn-danger" style="border-radius: 10%">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    </div>
                </div>
                <!-- /.card -->
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function confirmDelete(id , element){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
        perFormDelete(id , element);
        }
        })
    }
    function perFormDelete(id , element){
        axios.delete('/cms/admin/patients/'+id, {
        })
        .then(function (response) {
        console.log(response);
        toastr.success(response.data.massege);
        element.closest('tr').remove();
        })
        .catch(function (error) {
        console.log(error);
        toastr.error(error.response.data.massege);
        });
    }
</script>
@endsection