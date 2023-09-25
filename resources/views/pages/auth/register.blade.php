@extends('layout.layout')
@section('title', 'Register')

@section('content')

    <!-- Section: Design Block -->
    <div class="d-flex vh-100">
        <div class="m-auto">
            <!-- Jumbotron -->
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
                                    <form action="{{ route('auth.register.create') }}" method="post">
                                        @csrf
                                        <!-- 2 column grid layout with text inputs for the first and last names -->
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="form-outline">
                                                    <input type="text" id="first_name" name="first_name"
                                                        class="form-control" />
                                                    <label class="form-label" for="first_name">First name</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-outline">
                                                    <input type="text" id="last_name" name="last_name"
                                                        class="form-control" />
                                                    <label class="form-label" for="last_name">Last name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Email input -->
                                        <div class="form-outline mb-3">
                                            <input type="email" id="email" name="email" class="form-control" />
                                            <label class="form-label" for="email">Email address</label>
                                        </div>

                                        <!-- Password input -->
                                        <div class="form-outline mb-3">
                                            <input type="password" id="password" name="password" class="form-control" />
                                            <label class="form-label" for="password">Password</label>
                                        </div>

                                        {{--                                    <!-- Checkbox --> --}}
                                        {{--                                    <div class="form-check d-flex justify-content-center mb-4"> --}}
                                        {{--                                        <input class="form-check-input me-2" type="checkbox" value="" --}}
                                        {{--                                               id="form2Example33" checked/> --}}
                                        {{--                                        <label class="form-check-label" for="form2Example33"> --}}
                                        {{--                                            Subscribe to our newsletter --}}
                                        {{--                                        </label> --}}
                                        {{--                                    </div> --}}

                                        <!-- Submit button -->
                                        <button type="submit" class="btn btn-primary btn-block mb-5">
                                            Sign up
                                        </button>
                                    </form>
                                    <a href="{{ route('auth.login') }}" class="link">have account? login
                                        here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Jumbotron -->
        </div>
    </div>
    <!-- Section: Design Block -->

@endsection
