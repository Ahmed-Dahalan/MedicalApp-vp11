@extends('cms.parant')
@section('title',__('cms.permission'))
@section('page-name',__('cms.index'))
@section('main-page',__('cms.permission'))
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
                        <h3 class="card-title">{{__('cms.permission')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>User Type</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{$permission->id}}</td>
                                    <td>{{$permission->name}}</td>
                                    <td><span class="badge bg-info">{{$permission->guard_name}}</span></td>
                                    <td>{{$permission->created_at}}</td>
                                    <td>{{$permission->updated_at}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('permissions.edit',$permission->id)}}" class="btn btn-warning"
                                                style="margin-right: 10px; border-radius: 10%">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="confirmDelete('{{$permission->id}}' , this)"
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
        axios.delete('/cms/admin/permissions/'+id, {
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