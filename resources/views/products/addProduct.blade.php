@extends('layouts/app')

@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-sm-6 card p-4 m-4">
            <form id="addProductForm" action="add" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                <label>Title</label>
                <input name="title" id="title" type="text" class="form-control" placeholder="Enter title" value="{{$title}}">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter description...">{{$description}}</textarea>
                    @error('description')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input name="price" id="price" type="text" class="form-control" placeholder="Enter price" value="{{$price}}">
                    @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Select Image</label>
                    <input id="image" name="image" type="file" class="form-control-file">
                </div>
                <input type="hidden" name="id" value="{{$id}}">
                <input type="hidden" name="imagePreview" value="{{$imagePreview}}">
                <input type="hidden" name="titlePreview" value="{{$titlePreview}}">
                <input type="hidden" name="descriptionPreview" value="{{$descriptionPreview}}">
                <input type="hidden" name="pricePreview" value="{{$pricePreview}}">

                @if ($id == 'error')
                <div class="alert alert-danger">The title do not exist, please select ADD button</div>
                @endif
                <button type="submit" type="button" class="btn btn-primary" value="preview" name="submitButton">Preview</button>
                @if ($id)
                    @if ($id == 'error')
                        <button type="submit" type="button" class="btn btn-primary" value="add" name="submitButton">Add</button>
                    @else
                        <button  type="submit" class="btn btn-primary" value="update" name="submitButton">Update</button>
                    @endif
                @else
                    <button type="submit" type="button" class="btn btn-primary" value="add" name="submitButton">Add</button>
                @endif
            </form>
        </div>
        <div class="col card p-4 m-4">
            <div class="card" style="width: 25rem;">
                <img id="previewFile" class="card-img-top" src="{{asset($imagePreview)}}" alt="Card image cap">
                <div class="card-body">
                    <h2 id="previewTitle" class="card-title">{{ $titlePreview }}</h2>
                    <p id="previewDescription" class="card-text">{!! nl2br(e($descriptionPreview)) !!}</p>
                    <p id="previewPrice" class="font-weight-bold text-right h4">{{ $pricePreview }}</p>
                    <a href="#" class="btn btn-primary btn-sm">Add cart</a>
                </div>
            </div>  
        </div>
    </div>
</div>


@endsection
