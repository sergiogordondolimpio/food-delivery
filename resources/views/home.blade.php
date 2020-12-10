<!DOCTYPE html>
<html lang="en">
    @include('/components/head')
<body>

    @include('/components/nav')
    
    <div class="d-flex justify-content-center">
        <div class="row justify-content-center">
            @for ($j = 0; $j < 12; $j++)
            <div class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center mt-5">
                <div class="card" style="width: 300px;">
                    <img class="card-img-top" style="width: 100%;" src="{{asset('storage/docs/food-image1.PNG')}}" alt="Card image cap">
                    <div class="card-body">
                        <h2 class="card-title">Card title</h2>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <p class="font-weight-bold text-right h4">$ 1.00.</p>
                        <a href="#" class="btn btn-primary btn-sm">Add cart</a>
                    </div>
                </div>
            </div>    
            @endfor
        </div>
    </div>

    @include('/components/footer')
</body>
</html>