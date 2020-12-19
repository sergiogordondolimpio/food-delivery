<!DOCTYPE html>
<html lang="en">
<head>
    @include('/components/head')</head>
<body>

    @include('/components/nav')

    <div class="container">
        
                <form id="addProductForm" action="/api/add" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label>Title</label>
                      <input name="title" id="title" type="text" class="form-control" placeholder="Enter title" value="{{ old('title')}}">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter description...">{{ old('description')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input name="price" id="price" type="text" class="form-control" placeholder="Enter price" value="{{ old('price')}}">
                    </div>
                    <div class="form-group">
                        <label>Select Image</label>
                        <input id="image" name="image" type="file" class="form-control-file">
                        <input type="hidden" name="file" id="file" value="image6.png">
                    </div>
                    <button  type="submit" class="btn btn-primary">Add</button>
                </form>
        
    </div>

    
</body>
</html>