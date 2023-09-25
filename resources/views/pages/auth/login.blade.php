@extends('layout.layout')

@section('title', 'Login')
@section('content')

    <div class="vh-100 d-flex">
        <div class="m-auto">
            <div class="container">
                <div class="px-4 py-5 px-md-5 text-center text-lg-start">
                    <div class="container">
                        <div class="row gx-lg-5 align-items-center">
                            <div class="col-lg-6 mb-5 mb-lg-0">
                                <h1 class="my-5 display-3 fw-bold ls-tight">
                                    Mini article <br />
                                    <span class="text-primary">management system</span>
                                </h1>
                                <p style="color: hsl(217, 10%, 50.8%)">
                                    Fill creature Without form stars morning him in him make lights spirit their
                                    creeping land appear our from after. Lights was, forth moveth.
                                </p>
                            </div>

                            <div class="col-lg-6 mb-5 mb-lg-0">
                                <div class="card">
                                    <div class="card-body py-5 px-md-5">
                                        <form method="post" action="{{ route('auth.login_submit') }}">
                                            @csrf
                                            <!-- Email input -->
                                            <div class="form-outline mb-3">
                                                <input name="email" type="email" id="email" class="form-control" />
                                                <label class="form-label" for="email">Email address</label>
                                            </div>

                                            <!-- Password input -->
                                            <div class="form-outline mb-3">
                                                <input name="password" type="password" id="password"
                                                    class="form-control" />
                                                <label class="form-label" for="password">Password</label>
                                            </div>

                                            <!-- Checkbox -->
                                            <div class="form-check mb-3">
                                                <input class="form-check-input me-2" name="remember_me" type="checkbox"
                                                    value="true" id="remember_me" checked />
                                                <label class="form-check-label" for="remember_me">
                                                    remember me
                                                </label>
                                            </div>

                                            <!-- Submit button -->
                                            <button type="submit" class="btn btn-primary btn-block mb-5">
                                                Login
                                            </button>
                                        </form>
                                        <a href="{{ route('auth.register') }}" class="link">don't have account? register
                                            here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Jumbotron -->
        </div>

    </div>
@endsection
