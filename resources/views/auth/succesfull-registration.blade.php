<!DOCTYPE html>
<html lang="en">
<head>
    @include('/components/head')</head>
<body>

    @include('/components/nav')

    <div class="row justify-content-md-center mt-5 ">
        <h1>Succesfull registration</h1><br>
        <h3>{{$name}}</h3><br>
        <h3>{{$email}}</h3><br>
        <h3>{{$telephone}}</h3>
    </div>

</body>