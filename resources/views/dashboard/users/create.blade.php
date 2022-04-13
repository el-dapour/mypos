@extends('dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header" style="margin-bottom: 20px;">
            <h1>
                @lang('site.users')
                <small>@lang('site.control_panel')</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.home') }}"><i class="fa fa-dashboard"></i>@lang('site.dashboard')</a></li>
                <li><a href="{{ route('dashboard.users.index') }}">@lang('site.users')</a></li>
                <li class="active">@lang('site.add')</li>
            </ol>
        </section>
        <!-- general form elements -->
    <div class="col-xs-12">
        <div class="box box-primary ">
            <div class="box-header with-border">
                <h3 class="box-title">@lang('site.add')</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            @include('dashboard.include.error')
            <form action="{{ route('dashboard.users.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group">
                        <label>@lang('site.first_name')</label>
                        <input type="text" class="form-control" name="first_name" placeholder="@lang('site.first_name')">
                    </div>
                    <div class="form-group">
                        <label>@lang('site.last_name')</label>
                        <input type="text" class="form-control" name="last_name" placeholder="@lang('site.last_name')">
                    </div>
                    <div class="form-group">
                        <input type="file" accept="image/*" onchange="loadFile(event)" name="image" class="form-group">
                        <img id="output" src="{{ asset('uploads/users_images/default.png') }}" width="100px" class="img-thumbnail"/>
                        <script>
                            var loadFile = function(event) {
                                var output = document.getElementById('output');
                                output.src = URL.createObjectURL(event.target.files[0]);
                                output.onload = function() {
                                    URL.revokeObjectURL(output.src) // free memory
                                }
                            };
                        </script>
                    </div> <!-- image Div-->
                    <div class="form-group">
                        <label>@lang('site.email')</label>
                        <input type="email" class="form-control" name="email" placeholder="@lang('site.email')">
                    </div>
                    <div class="form-group">
                        <label>@lang('site.password')</label>
                        <input type="password" class="form-control" name="password" placeholder="@lang('site.password')">
                    </div>
                    <div class="form-group">
                        <label>@lang('site.password_confirmation')</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="@lang('site.password_confirmation')">
                    </div>
                    <h2 class="page-header">@lang('site.permissions')</h2>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Custom Tabs -->
                            <div class="nav-tabs-custom">
                                @php
                                    $models = ['users','categories','products','clients','orders'];
                                    $maps = ['create','read','update','delete'];
                                @endphp
                                <ul class="nav nav-tabs">
                                    @foreach($models as $index=>$model)
                                        <li class="{{ $index == 0 ? 'active' : '' }}"><a href="#{{ $model }}" data-toggle="tab">@lang('site.' . $model)</a></li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach($models as $index=>$model)
                                        <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ $model }}">
                                            <div class="checkbox">
                                                @foreach($maps as $map)
                                                    <label><input type="checkbox" name="permissions[]" value="{{$map. '_' .$model }}">@lang('site.' . $map)</label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary"><i style="margin-left: 5px;" class="fa fa-plus"></i>@lang('site.add')</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
