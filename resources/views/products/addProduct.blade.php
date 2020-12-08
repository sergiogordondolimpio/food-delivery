<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Food Delivery</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    <script src="{{ asset('/js/app.js') }}"></script>
</head>
<body>

    @include('/components/nav')

    <div class="container">
        <div class="row">
            <div class="col-sm-6 card p-4 m-4">
                <form action="/addProduct" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label>Title</label>
                      <input name="title" id="title" type="text" class="form-control" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter description..."></textarea>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input name="price" id="price" type="number" class="form-control" placeholder="Enter price">
                    </div>
                    <div class="form-group">
                        <label>Select Image</label>
                        <input name="file" id="image" type="file" class="form-control-file">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                    <a class="btn btn-primary" href="/addProduct">Preview</a>
                </form>
            </div>
            <div class="col card p-4 m-4">
                <div class="card" style="width: 25rem;">
                    <img class="card-img-top" src="{{asset($filePreview)}}" alt="Card image cap">
                    <div class="card-body">
                        <h2 id="previewTitle" class="card-title"> {{ $titlePreview }} </h2>
                        <p id="previewDescription" class="card-text"> {{ $descriptionPreview }} </p>
                        <p id="previewPrice" class="font-weight-bold text-right h4">{{ $pricePreview }}</p>
                        <a href="#" class="btn btn-primary btn-sm">Add cart</a>
                    </div>
                </div>  
            </div>
        </div>
    </div>

    @include('/components/footer')

    <script>
        function preview(){
            document.getElementById("previewDescription").innerHTML = document.getElementById("description").value
            document.getElementById("previewPrice").innerHTML = "$ " + document.getElementById("price").value
        }
    </script>
</body>
</html>