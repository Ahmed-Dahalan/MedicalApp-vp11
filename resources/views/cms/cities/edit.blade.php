@extends('cms.parant')
@section('title',__('cms.dashboard'))
@section('styles')

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
                        <h3 class="card-title">{{__('cms.edit_city')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{route('cities.update',$city->id)}}">
                        @csrf
                        @method('PUT')
                        @if ($errors->any())

                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>

                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if (session()->has('massege'))


                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> {{__('massege/cms.success')}}!</h5>
                            {{session('massege')}}
                        </div>
                        @endif
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name_en_input">{{__('cms.name_en')}}</label>
                                <input type="text" class="form-control" id="name_en_input" name="name_en"
                                    placeholder="{{__('cms.name_en')}}" value="{{old('name_en') ?? $city->name_en}}">
                            </div>
                            <div class="form-group">
                                <label for="name_ar_input">{{__('cms.name_ar')}}</label>
                                <input type="text" class="form-control" id="name_ar_input" name="name_ar"
                                    placeholder="{{__('cms.name_ar')}}" value="{{old('name_ar') ?? $city->name_ar}}">
                            </div>
                            <div class="form-group">
                                <div
                                    class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" class="custom-control-input" id="active_cheakbox"
                                        name="active" @if ($city->active) checked @endif>
                                    <label class="custom-control-label"
                                        for="active_cheakbox">{{__('cms.active')}}</label>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{__('cms.save')}}</button>
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

@endsection