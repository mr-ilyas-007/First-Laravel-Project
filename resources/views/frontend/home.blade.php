@extends('frontend.layout.app')

@section('title')
    Laravel App
@endsection

@section('content')

        <div class="div-left text-center">
            <img class="bus-img img-fluid"
                src="https://img.freepik.com/free-vector/colorful-welcome-lettering-modern-banner-invitation_1017-50216.jpg?ga=GA1.1.2014325892.1716616269&semt=ais_hybrid"
                alt="Welcome Image" style="max-height: 300px; max-width: 100%; opacity:100%; mix-blend-mode:multiply; magrin:0">
        </div>

        <div class="div-right text-center text-white">
            <h1 class="display-4 animated fadeInDown ">Hello!!</h1>
            <h3 class="animated fadeInUp">Welcome to this Website. <br>Lorem ipsum dolor sit, amet consectetur adipisicing elit. <br>
                Unde illo culpa blanditiis nulla esse eum corporis facere velit amet porro.</h3>

            {{-- <div class="mt-4">
                <a href="/register" class="btn btn-light btn-lg mx-2 animated pulse">Create Account</a>
                <span class="text-white mx-2 ">OR</span>
                <a href="/login" class="btn btn-light btn-lg mx-2 animated pulse">Login</a>
            </div> --}}
        </div>
@endsection
