@include('components/head')

@include('components/nav')

@include('components/banner')

<body>
    <div class="container">
        row
    </div>
</body>

@for ($i = 0; $i < 12; $i++)
    @include('products/cardExamples')
@endfor

@include('components/footer')

