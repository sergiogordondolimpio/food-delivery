<!DOCTYPE html>
<html lang="en">
    @include('/components/head')
<body>

    @include('/components/nav')
    
    <div class="d-flex justify-content-center">
        <div class="row justify-content-center">
            @foreach ($products as $product)
                <div class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center mt-5">
                    <div class="card" style="width: 400px;">
                        <img class="card-img-top" style="width: 100%;" src="{{asset('storage/docs/'.$product->file)}}" alt="Card image cap">
                        <div class="card-body">
                            <h2 class="card-title"> {{ $product->title }} </h2>
                            <p class="card-text"> {{ $product->description }} </p>
                            <p class="font-weight-bold text-right h4"> {{ $product->price }} </p>
                            <a href="#" class="btn btn-primary btn-sm">Edit</a>
                            <a href="#" class="btn btn-primary btn-sm">Delete</a>
                        </div>
                    </div>
                </div>    
            @endforeach
        </div>
    </div>

    @include('/components/footer')
</body>
</html>