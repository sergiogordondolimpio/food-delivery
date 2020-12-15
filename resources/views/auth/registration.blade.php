<!DOCTYPE html>
<html lang="en">
<head>
    @include('/components/head')</head>
<body>

    @include('/components/nav')

    <div class="row justify-content-md-center mt-5 ">
        <div class="card p-4" style="width: 25rem">
            
                <form id="registrationForm" action="/registered" method="POST">
                    @csrf
                    <div class="form-group">
                      <label>Name*</label>
                      <input name="name" id="name" type="text" class="form-control" placeholder="Enter name" value="{{ old('name')}}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label>E-mail*</label>
                      <input name="email" id="email" type="text" class="form-control" placeholder="Enter E-mail" value="{{ old('email')}}">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label>Password*</label>
                      <input name="password" id="password" type="text" class="form-control" placeholder="Enter password" value="{{ old('password')}}">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label>Telephone number</label>
                      <input name="telephone" id="telephone" type="text" class="form-control" placeholder="Enter phone number" value="{{ old('telephone')}}">
                        @error('telephone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="submit" class="btn btn-primary" >Register</button>
                    <a href="/home"> <button type="button" class="btn btn-primary">Back</button> </a>
                    <a href="/login">Are you already register?</a>
                </form>
     
        </div>
    </div>

