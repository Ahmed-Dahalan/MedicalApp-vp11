@extends('cms.parant')
@section('title',__('cms.cities'))
@section('page-name',__('cms.index'))
@section('main-page',__('cms.cities'))
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
                        <h3 class="card-title">{{__('cms.cities')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>NAME (EN)</th>
                                    <th>NAME (AR)</th>
                                    <th style="width: 40px">Action</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cities as $city)
                                <tr>
                                    <td>{{$city->id}}</td>
                                    <td>{{$city->name_en}}</td>
                                    <td>
                                        {{$city->name_ar}}
                                    </td>
                                    <td><span
                                            class="badge @if($city->active) bg-success @else bg-danger @endif">{{$city->active_status}}</span>
                                    </td>
                                    <td>{{$city->created_at}}</td>
                                    <td>{{$city->updated_at}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('cities.edit',$city->id)}}" class="btn btn-warning"
                                                style="margin-right: 10px; border-radius: 10%">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{route('cities.destroy',$city->id)}}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" style="border-radius: 10%">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
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

@endsection