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
                <form id="addProductForm" action="/addProduct" method="POST" enctype="multipart/form-data">
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
                        <input id="image" type="file" class="form-control-file">
                        <input type="hidden" name="file" id="file">
                    </div>
                    <button onclick="getNameFilePreview()" type="button" class="btn btn-primary" >Add</button>
                    <button onclick="submitToPreview()" type="button" class="btn btn-primary">Preview</button>
                </form>
            </div>
            <div class="col card p-4 m-4">
                <div class="card" style="width: 25rem;">
                    <img id="previewFile" class="card-img-top" src="{{asset($filePreview)}}" alt="Card image cap">
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

    <script language="javascript" type="text/javascript">
        function getNameFile(){
            $path = document.getElementById("image").value
            $elements = $path.split('\\')
            $fileName = $elements.pop();
            return $fileName
        }
        function getNameFilePreview(){
            $path = document.getElementById("previewFile").getAttribute('src');
            $elements = $path.split('/')
            $fileName = $elements.pop()
            return $fileName
        }
        function submitToHome()
        {
            document.getElementById("addProductForm").action ="/home";
            //document.getElementById("addProductForm").method ="get";
            document.getElementById("file").value = getNameFilePreview();
            document.getElementById("addProductForm").submit();
            //document.getElementById("adProductForm").action ="mailerPDF.php";
        }    
        function submitToPreview()
        {
            document.getElementById("file").value = getNameFilePreview();
            document.getElementById("addProductForm").submit();
        }    
    </script>
</body>
</html>