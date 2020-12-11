<!DOCTYPE html>
<html lang="en">
    @include('/components/head')
<body>

    @include('/components/nav')
    
    <div class="d-flex justify-content-center">
        <div class="row justify-content-center">
            @for ($j = 0; $j < 12; $j++)
                @include('products/cardExample')
            @endfor
        </div>
    </div>

    @include('/components/footer')
</body>
</html>