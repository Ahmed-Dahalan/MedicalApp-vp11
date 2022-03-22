@extends('cms.parant')
@section('title',__('cms.permissions'))
@section('page-name',__('cms.index'))
@section('main-page',__('cms.permissions'))
@section('small-page-name',__('cms.index'))
@section('styles')
<link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endsection
@section('main-content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.permissions')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>User Type</th>
                                    <th>sigined</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{$permission->name}}</td>
                                    <td><span class="badge bg-info">{{$permission->guard_name}}</span></td>
                                    <td>
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox"
                                                    onchange="UpdaterolePermission({{$permission->id}})"
                                                    id="permission_{{$permission->id}}" @if ($permission->assigned)
                                                checked @endif>
                                                <label for="permission_{{$permission->id}}">
                                                </label>
                                            </div>
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
@section('scripts') <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function UpdaterolePermission(permissionId){
        axios.post('/cms/admin/roles/permissions',{
            role_id: '{{$role->id}}',
            permission_id : permissionId,
        })
        .then(function (response) {
        console.log(response);
        toastr.success(response.data.massege);
        })
        .catch(function (error) {
        console.log(error);
        toastr.error(error.response.data.massege);
        });
    }
</script>
@endsection