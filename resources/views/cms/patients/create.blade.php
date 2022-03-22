@extends('cms.parant')
@section('title',__('cms.create'))
@section('page-name',__('cms.index'))
@section('main-page',__('cms.create'))
@section('small-page-name',__('cms.create'))
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
                        <h3 class="card-title">{{__('cms.create_patient')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create-form">
                        @csrf
                        <div class="card-body row">
                            <div class="form-group col-4">
                                <label for="f_name">{{__('cms.f_name')}}</label>
                                <input type="text" class="form-control" id="f_name" name="f_name"
                                    placeholder="{{__('cms.f_name')}}" value="{{old('f_name')}}">
                            </div>
                            <div class="form-group col-4">
                                <label for="l_name">{{__('cms.l_name')}}</label>
                                <input type="text" class="form-control" id="l_name" name="l_name"
                                    placeholder="{{__('cms.l_name')}}" value="{{old('l_name')}}">
                            </div>
                            <div class="form-group col-4">
                                <label for="ensurance_num">{{__('cms.ensurance_num')}}</label>
                                <input type="text" class="form-control" id="ensurance_num" name="ensurance_num"
                                    placeholder="{{__('cms.ensurance_num')}}" value="{{old('ensurance_num')}}">
                            </div>
                            <div class="form-group col-4">
                                <label for="national_num">{{__('cms.national_num')}}</label>
                                <input type="text" class="form-control" id="national_num" name="national_num"
                                    placeholder="{{__('cms.national_num')}}" value="{{old('national_num')}}">
                            </div>
                            <div class="form-group col-4">
                                <label for="mibile">{{__('cms.mobile')}}</label>
                                <input type="text" class="form-control" id="mobile" name="mobile"
                                    placeholder="{{__('cms.mobile')}}" value="{{old('mobile')}}">
                            </div>
                            <div class="form-group col-4">
                                <label for="email">{{__('cms.email')}}</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="{{__('cms.email')}}" value="{{old('email')}}">
                            </div>
                            <div class="form-group col-4">
                                <label for="birth_date">{{__('cms.birth_date')}}</label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date"
                                    placeholder="{{__('cms.birth_date')}}" value="{{old('birth_date')}}">
                            </div>
                            <div class="form-group col-4">
                                <label for="city_id">{{__('cms.cities')}}</label>
                                <select class="form-control cities" style="width: 100%;" id="city_id" name="city_id">
                                    @foreach ($cities as $city){
                                    <option value="{{$city->id}}">{{$city->name_en}}</option>
                                    }

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label for="gender">{{__('cms.gender')}}</label>
                                <select class="form-control gender" style="width: 100%;" id="gender" name="gender">
                                    <option value="M">{{__('cms.male')}}</option>
                                    <option value="F">{{__('cms.female')}}</option>
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <div
                                    class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" class="custom-control-input" id="active_cheakbox"
                                        name="active" value="on">
                                    <label class="custom-control-label"
                                        for="active_cheakbox">{{__('cms.active')}}</label>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
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
    $('.cities').select2({
    theme: 'bootstrap4'
    });
    $('.gender').select2({
    theme: 'bootstrap4'
    })
    function perFormStore(){
        axios.post('/cms/admin/patients', {
        f_name: document.getElementById('f_name').value,
        l_name: document.getElementById('l_name').value,
        ensurance_num: document.getElementById('ensurance_num').value,
        national_num: document.getElementById('national_num').value,
        mobile: document.getElementById('mobile').value,
        email: document.getElementById('email').value,
        birth_date: document.getElementById('birth_date').value,
        city_id: document.getElementById('city_id').value,
        gender: document.getElementById('gender').value,
        active: document.getElementById('active_cheakbox').value,
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