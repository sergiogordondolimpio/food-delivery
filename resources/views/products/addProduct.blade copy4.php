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
                      <input name="title" id="title" type="text" class="form-control" placeholder="Enter title" value="{{ old('title') }}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter description...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input name="price" id="price" type="text" class="form-control" placeholder="Enter price" value="{{ old('price') }}">
                        @error('price')
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
                    <input type="hidden" name="previewTitle" id="previewTitle">
                    <input type="hidden" name="previewDescription" id="previewDescription">
                    <input type="hidden" name="previewPrice" id="previewPrice">
                    
                </form>
            </div>
            <div class="col card p-4 m-4">
                <div class="card" style="width: 25rem;">
                    <img id="previewFile" class="card-img-top" src="{{asset($filePreview)}}" alt="Card image cap">
                    <div class="card-body">
                        @if ($errors)
                            <h2 id="previewTitleCard" class="card-title">{{old('previewTitle')}}  </h2>
                            <p id="previewDescriptionCard" class="card-text"> {{old('previewDescription')}} </p>
                            <p id="previewPriceCard" class="font-weight-bold text-right h4">$ {{old('previewPrice')}}</p>
                            <a href="#" class="btn btn-primary btn-sm">Add cart</a>  
                            @else
                            
                            <h2 id="previewTitleCard" class="card-title">{{old('previewTitle')}}  </h2>
                            <p id="previewDescriptionCard" class="card-text"> {{old('previewDescription')}} </p>
                            <p id="previewPriceCard" class="font-weight-bold text-right h4">$ {{old('previewPrice')}}</p>
                            <a href="#" class="btn btn-primary btn-sm">Add cart</a>  
                        @endif
                    </div>
                </div>  
            </div>
        </div>
    </div>

    @include('/components/footer')

    <script language="javascript" type="text/javascript">

        function setItemsForm(){
            if({!! json_encode($reload) !!} == 'true'){
                document.getElementById('title').value = {!! json_encode($titlePreview) !!}
                document.getElementById('description').value = {!! json_encode($descriptionPreview) !!}
                var price = {!! json_encode($pricePreview) !!}.split(" ");
                document.getElementById('price').value = price[1]
            }else{
                //document.getElementById('previewTitleCard').innerHTML = 'Card Title'
                //document.getElementById('previewDescriptionCard').innerHTML = "Some quick example text to build on the card title and make up the bulk of the card's content."
                //document.getElementById('previewPriceCard').innerHTML = '$ 1.10'
            }
           

            console.log({!! json_encode($reload) !!})
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
            document.getElementById("previewTitle").value =  document.getElementById("title").value;
            document.getElementById("previewDescription").value =  document.getElementById("description").value;
            document.getElementById("previewPrice").value =  document.getElementById("price").value;
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

        function setVariablesPreview(){

        }
    </script>
</body>
</html>