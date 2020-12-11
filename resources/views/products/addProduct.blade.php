<!DOCTYPE html>
<html lang="en">
<head>
    @include('/components/head')</head>
<body onload="setItemsForm()">

    @include('/components/nav')

    <div class="container">
        <div class="row">
            <div class="col-sm-6 card p-4 m-4">
                <form id="addProductForm" action="/addProduct" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label>Title</label>
                      <input name="title" id="title" type="text" class="form-control" placeholder="Enter title" value="{{ old('title')}}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                            <script>
                                $(document).ready(function(){
                                    $("#updateModal").modal();
                                });
                            </script>
                        @enderror
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
                        <input type="hidden" name="file" id="file">
                    </div>
                    <button onclick="submitToHome()" type="button" class="btn btn-primary" >Add</button>
                    <button onclick="submitToPreview()" type="button" class="btn btn-primary">Preview</button>
                </form>
            </div>
            <div class="col card p-4 m-4">
                <div class="card" style="width: 25rem;">
                    <img id="previewFile" class="card-img-top" src="{{asset($filePreview)}}" alt="Card image cap">
                    <div class="card-body">
                        <h2 id="previewTitle" class="card-title"> {{ $titlePreview }} </h2>
                        <p id="previewDescription" class="card-text"> {!! nl2br(e($descriptionPreview)) !!} </p>
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
              <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              The title alreade exists. Do you want to update the product?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button onclick="submitToUpdate()" type="button" class="btn btn-primary">Update</button>
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

            }
            //console.log({!! json_encode($titlePreview) !!})
        }

        /* get the name of the file in the form, whithout all 
            before of / and the fake path
            for example: http://www.web.com/nombre.png
            get: nombre.png
        */
        function getNameFile(){
            $path = document.getElementById("image").value
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
            
            document.getElementById("addProductForm").submit();
        }    

        function submitToUpdate()
        {
            document.getElementById("addProductForm").action ="/update";
            document.getElementById("file").value = getNameFilePreview();
            document.getElementById("addProductForm").submit();
        }  

    </script>
</body>
</html>