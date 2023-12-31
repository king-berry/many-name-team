@extends('backend.layout')

@section('content')
<div class="content">
    <div class="container-fluid">
      @include('backend.note')
      <form action="admin/brands/{{$data->brand_id}}" method="POST">
        @method('PATCH')
        @csrf
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Sửa BỘ SƯU TẬP</h4>
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">Tên BỘ SƯU TẬP</label>
                      <input type="text" name="brand_name" value="{{$data->brand_name}}" class="form-control">
                      @error('brand_name')
                          <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">Từ Khóa</label>
                      <input type="text" name="brand_keyword" value="{{$data->brand_keyword}}" class="form-control">
                      @error('brand_keyword')
                          <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="bmd-label-floating">Mô Tả</label>
                      <input type="text" name="brand_description" value="{{$data->brand_description}}" class="form-control">
                      @error('brand_description')
                          <span class="text-danger">{{$message}}</span>
                      @enderror
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary pull-right">Sửa BỘ SƯU TẬP Decor</button>
          <a href="/admin/brands" class="btn btn-primary pull-right">Danh sách BỘ SƯU TẬP decor</a>
        <div class="clearfix"></div>
        </div>
      </div>
      </form>
    </div>
  </div>
@endsection
