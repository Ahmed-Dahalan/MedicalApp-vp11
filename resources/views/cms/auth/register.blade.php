<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('cms/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('cms/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">
</head>

<body class="hold-transition register-page">
  <div class="register-box" style="width: 500px">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Register a new membership</p>

        <form id="create-form">
          @csrf
          <div class="card-body row">
            <div class="form-group col-6">
              <label for="f_name">{{__('cms.f_name')}}</label>
              <input type="text" class="form-control" id="f_name" name="f_name" placeholder="{{__('cms.f_name')}}"
                value="{{old('f_name')}}">
            </div>
            <div class="form-group col-6">
              <label for="l_name">{{__('cms.l_name')}}</label>
              <input type="text" class="form-control" id="l_name" name="l_name" placeholder="{{__('cms.l_name')}}"
                value="{{old('l_name')}}">
            </div>
            <div class="form-group col-6">
              <label for="ensurance_num">{{__('cms.ensurance_num')}}</label>
              <input type="text" class="form-control" id="ensurance_num" name="ensurance_num"
                placeholder="{{__('cms.ensurance_num')}}" value="{{old('ensurance_num')}}">
            </div>
            <div class="form-group col-6">
              <label for="national_num">{{__('cms.national_num')}}</label>
              <input type="text" class="form-control" id="national_num" name="national_num"
                placeholder="{{__('cms.national_num')}}" value="{{old('national_num')}}">
            </div>
            <div class="form-group col-6">
              <label for="mibile">{{__('cms.mobile')}}</label>
              <input type="text" class="form-control" id="mobile" name="mobile" placeholder="{{__('cms.mobile')}}"
                value="{{old('mobile')}}">
            </div>
            <div class="form-group col-6">
              <label for="email">{{__('cms.email')}}</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="{{__('cms.email')}}"
                value="{{old('email')}}">
            </div>
            <div class="form-group col-6">
              <label for="birth_date">{{__('cms.birth_date')}}</label>
              <input type="date" class="form-control" id="birth_date" name="birth_date"
                placeholder="{{__('cms.birth_date')}}" value="{{old('birth_date')}}">
            </div>
            <div class="form-group col-6">
              <label for="city_id">{{__('cms.cities')}}</label>
              <select class="form-control cities" style="width: 100%;" id="city_id" name="city_id">
                @foreach ($cities as $city){
                <option value="{{$city->id}}">{{$city->name_en}}</option>
                }

                @endforeach
              </select>
            </div>
            <div class="form-group col-6">
              <label for="gender">{{__('cms.gender')}}</label>
              <select class="form-control gender" style="width: 100%;" id="gender" name="gender">
                <option value="M">{{__('cms.male')}}</option>
                <option value="F">{{__('cms.female')}}</option>
              </select>
            </div>
            <div class="form-group col-12">
              <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                <input type="checkbox" class="custom-control-input" id="active_cheakbox" name="active" value="on">
                <label class="custom-control-label" for="active_cheakbox">{{__('cms.active')}}</label>
              </div>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="button" onclick="perFormStore()" class="btn btn-primary">{{__('cms.save')}}</button>
          </div>
        </form>
        <a href="{{route('auth.login','patient')}}" class="text-center">I already have a membership</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
  <script>
    $('.cities').select2({
      theme: 'bootstrap4'
      });
      $('.gender').select2({
      theme: 'bootstrap4'
      })
      function perFormStore(){
          axios.post('/cms/register', {
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
</body>

</html>