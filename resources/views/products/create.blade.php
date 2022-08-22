@extends('layouts.app')

@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color:white;">
                        <h1 class="card-title"> @if(isset($products)) Edit product @else Add product @endif</h1>
                        <a href="{{route('products.index')}}" class="btn btn-primary btn-sm ">Back</a>
                    </div>
                    <div class="card-body">
                        <div class="basic-form custom_file_input">
                            @if(isset($products))
                            <form action="{{route('products.update',$products->id)}}" method="POST"
                                enctype="multipart/form-data">
                                @method('put')
                                @else
                                <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
                                    @endif

                                    @csrf
                                    <div class="form-group row">
                                        <div
                                            class="form-group col-12 col-sm-6 {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label for="name">Name</label>
                                            <input id="name" @if(isset($products)) value="{{ $products->name }}" @endif
                                                class="form-control form-control-sm" type="text" name="name"
                                                placeholder="Name">
                                            @if($errors->has('name'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </em>
                                            @endif
                                        </div>

                                        <div
                                            class="form-group col-12 col-sm-6 {{ $errors->has('price') ? 'has-error' : '' }}">
                                            <label for="price">Price</label>
                                            <input id="price" @if(isset($products)) value="{{ $products->price }}"
                                                @endif class="form-control form-control-sm" type="float" name="price"
                                                placeholder="Price">
                                            @if($errors->has('price'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('price') }}
                                            </em>
                                            @endif
                                        </div>
                                        <br>
                                        <div class="col-xs-12 col-sm-6 col-md-6">
                                            <div class="form-group">
                                                <label>UPC:</label>
                                                <input id="upc" @if(isset($products)) value="{{ $products->upc }}"
                                                    @endif class="form-control form-control-sm" type="text" name="upc"
                                                    placeholder="Upc">
                                                @if($errors->has('upc'))
                                                <em class="invalid-feedback">
                                                    {{ $errors->first('upc') }}
                                                </em>
                                                @endif

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div
                                            class="form-group col-12 col-sm-6 {{ $errors->has('status') ? 'has-error' : '' }}">
                                            <label for="status">Status</label>
                                            <select class="form-control" name="status">
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>

                                        <div class="form-group row">
                                            <div
                                                class="form-group col-12 col-sm-6 {{ $errors->has('image') ? 'has-error' : '' }}">
                                                <label for="image">Image</label>
                                                <input id="image" class="form-control form-control-sm" type="file"
                                                    name="image" placeholder="Image">
                                                @if(isset($products))
                                                @if($products->image)
                                                <img src="{{asset('images/'.$products->image)}}" style="height:50px">
                                                @endif
                                                @endif
                                                @if($errors->has('image'))
                                                <em class="invalid-feedback">
                                                    {{ $errors->first('image') }}
                                                </em>
                                                @endif

                                            </div>

                                            <div class="form-group row">

                                                <div class="col-12 mt-3">
                                                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                                                </div>
                                            </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection