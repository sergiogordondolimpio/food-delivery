<!DOCTYPE html>
<html lang="en">
<head>
    @include('/components/head')</head>
<body onload="setItemsForm()">

    @include('/components/nav')

    <div class="container">
        <div class="row">
            <div class="col-sm-6 card p-4 m-4">
                <form id="addProductForm" action="/update" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label>Title</label>
                      <input name="title" id="title" type="text" class="form-control" placeholder="Enter title" value="{{ old('title')}}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @if ($message == 'The title has already been taken.')
                                <script>
                                    $(document).ready(function(){
                                        $("#updateModal").modal();
                                    });
                                </script>
                            @endif
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter description...">{{ old('description')}}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input name="price" id="price" type="text" class="form-control" placeholder="Enter price" value="{{ old('price')}}">
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Select Image</label>
                        <input id="image" name="image" type="file" class="form-control-file">
                        <input type="hidden" name="file" id="file">
                    </div>
                    <button onclick="submitToHome()" type="button" class="btn btn-primary" >Add</button>
                    <button onclick="submitToPreview()" type="button" class="btn btn-primary">Preview</button>
                    <button  type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            <div class="col card p-4 m-4">
                <div class="card" style="width: 25rem;">
                    <img id="previewFile" class="card-img-top" src="{{asset($filePreview)}}" alt="Card image cap">
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

    @include('/components/footer')

    <div class="modal fade" id="updateModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="staticBackdropLabel">Seems the product already exists</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h5>The title alreade exists. Do you want to update the product?</h5>
            </div>

            <div class="modal-footer">
                <label class="text-danger">If you want to update, please Select image again if you want to change it and press the button Update</label>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>

    <script language="javascript" type="text/javascript">

        function setItemsForm(){
            if({!! json_encode($reload) !!} == 'true'){
                document.getElementById('title').value = {!! json_encode($titlePreview) !!}
                document.getElementById('description').value = {!! json_encode($descriptionPreview) !!}
                var price = {!! json_encode($pricePreview) !!}.split(" ");
                document.getElementById('price').value = price[1]
                document.getElementById('file').value = getNameFilePreview()
            }
            //console.log({!! json_encode($titlePreview) !!})
        }

        /* get the name of the file in the form, whithout all 
            before of / and the fake path
            for example: http://www.web.com/nombre.png
            get: nombre.png
        */
        function getNameFile($name){
            $path = document.getElementById($name).value
            $elements = $path.split('\\')
            $fileName = $elements.pop();
            return $fileName
        }

        /* get the name of the file in the preview card
            in src
        */
        function getNameFilePreview(){
            $path = document.getElementById("previewFile").getAttribute('src');
            $elements = $path.split('/')
            $fileName = $elements.pop()
            return $fileName
        }

        /* change the link of the action of the form, adding 
            /home. this going to save the Product in the database
        */
        function submitToHome()
        {
            document.getElementById("addProductForm").action ="/home";
            //document.getElementById("addProductForm").method ="get";
            document.getElementById("file").value = getNameFilePreview();
            document.getElementById("addProductForm").submit();
            //document.getElementById("adProductForm").action ="mailerPDF.php";
        }    

        /* get the name of the file in the preview card and do 
            the submit without change the url action
        */
        function submitToPreview()
        {
            if (document.getElementById("image").value){
                document.getElementById("file").value = 'storageImage';
            }else{
                document.getElementById("file").value = getNameFilePreview();
            }
            document.getElementById("addProductForm").action ="/addProduct";
            document.getElementById("addProductForm").submit();
        }    

   

    </script>
</body>
</html>