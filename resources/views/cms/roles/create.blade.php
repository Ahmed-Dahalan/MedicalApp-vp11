@extends('cms.parant')
@section('title',__('cms.create_role'))
@section('page-name',__('cms.index'))
@section('main-page',__('cms.create_role'))
@section('small-page-name',__('cms.create-role'))
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
                        <h3 class="card-title">{{__('cms.create_role')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create-form">
                        @csrf
                        <div class="card-body row">
                            <div class="form-group col-4">
                                <label for="name">{{__('cms.name')}}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{__('cms.name')}}" value="{{old('f_name')}}">
                            </div>
                            <div class="form-group col-4">
                                <label for="gender">{{__('cms.user_type')}}</label>
                                <select class="form-control user_type" style="width: 100%;" id="guard_name" name="guard_name">
                                    <option value="admin">{{__('cms.Admins')}}</option>
                                    <option value="user">{{__('cms.patients')}}</option>
                                </select>
                            </div>

                            <div class="card-footer col-12">
                                <button type="button" onclick="perFormStore()"
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
    $('.user_type').select2({
    theme: 'bootstrap4'
    });
    function perFormStore(){
        axios.post('/cms/admin/roles', {
        name: document.getElementById('name').value,
        guard_name: document.getElementById('guard_name').value,
        })
        .then(function (response) {
        console.log(response);
        toastr.success(response.data.massege);
        document.getElementById('create-form').reset();
        })
        .catch(function (error) {
        console.log(error);
        toastr.error(error.response.data.massege);
        });
    }
</script>
@endsection