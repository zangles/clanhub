@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-4 col-md-7 col-10">
            <section class="widget widget-login animated fadeInUp">
                <header>
                    <h3>ClanHub</h3>
                </header>
                <div class="widget-body">
                    <p class="widget-login-info">
                        Ingresa a la web
                    </p>
                    <form class="login-form mt-lg" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div role="group" class="form-group">
                            <label for="email" class="d-block">Email</label>
                            <div>
                                <div role="group" class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="la la-user text-white"></i>
                                        </div>
                                    </div>
                                    <input id="email" name="email" type="email" required="required" placeholder="Email" class="form-control input-transparent pl-3">
                                </div>
                            </div>
                        </div>
                        <div role="group" class="form-group">
                            <label for="password" class="d-block">Password</label>
                            <div>
                                <div role="group" class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="la la-lock text-white"></i>
                                        </div>
                                    </div>
                                    <input id="password" name="password" type="password" required="required" placeholder="Password" class="form-control input-transparent pl-3">
                                </div>
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="clearfix">
                            <div class="btn-toolbar">
                                <button class="btn btn-danger btn-block" type="submit">
                                        <span class="auth-btn-circle">
                                            <i class="la la-caret-right"></i>
                                        </span>
                                    Login</button>
                            </div>
                        </div>
                        <div class="group">
                            <div class="widget-login-info">
                                No tienes una cuenta? create una<br>
                                <a class="mr-n-lg" href="{{route('guest.registerform')}}">Crear cuenta</a>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
