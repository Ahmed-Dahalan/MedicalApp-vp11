@extends('cms.parant')
@section('title',__('cms.edit'))
@section('page-name',__('cms.index'))
@section('main-page',__('cms.edit'))
@section('small-page-name',__('cms.edit'))
@section('styles')
<link rel="stylesheet" href="{{asset('cms/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endsection
@section('main-content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.edit')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create-form">
                        @csrf
                        <div class="card-body row">
                            <div class="form-group col-4">
                                <label for="city_id">{{__('cms.roles')}}</label>
                                <select class="form-control roles" style="width: 100%;" id="role_id" name="role_id">
                                    @foreach ($roles as $role){
                                    <option value="{{$role->id}}" @if ($role->id == $adminRole->id) selected
                                        @endif>{{$role->name}}
                                    </option>
                                    }

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="name">{{__('cms.name')}}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{__('cms.name')}}" value="{{$admin->name}}">
                            </div>
                            <div class="form-group col-4">
                                <label for="email">{{__('cms.email')}}</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="{{__('cms.email')}}" value="{{$admin->email}}">
                            </div>

                            <div class="card-footer col-12">
                                <button type="button" onclick="perFormUpdate()"
                                    class="btn btn-primary">{{__('cms.save')}}</button>
                            </div>
                    </form>
                </div>
                <!-- /.card -->

            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('scripts')
<script src="{{asset('cms/plugins/select2/js/select2.full.min.js')}}"></script>
<script>
    $('.roles').select2({
    theme: 'bootstrap4'
    });
    function perFormUpdate(){
        axios.put('/cms/admin/admins/{{$admin->id}}', {
        role_id:document.getElementById('role_id').value,
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        })
        .then(function (response) {
        console.log(response);
        toastr.success(response.data.massege);
        Window.location.href = '/cms/admin/admins'
        })
        .catch(function (error) {
        console.log(error);
        toastr.error(error.response.data.massege);
        });
    }
</script>
@endsection