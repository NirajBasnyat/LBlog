@extends('layouts.auth')

@section('content')
    <div class="account-pages pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Free Register</h5>
                                        <p>Create free account on<br> {{$setting->full_name ?? 'CMS'}} </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div>
                                <a href="#">
                                    <div class="avatar-md profile-user-wid mb-1">
                                            <span class="avatar-title rounded-circle bg-light">
                                                @if(!is_null($setting) && !is_null($setting->image))
                                                    <img src="{{$setting->image}}" alt="" class="rounded-circle" height="70" width="70">
                                                @else
                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Flag_of_Nepal.svg/800px-Flag_of_Nepal.svg.png" alt=""
                                                         class="rounded-circle" height="70" width="70">
                                                @endif
                                            </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                <form class="form-horizontal" action="{{route('register')}}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="name" class="form-label">{{ __('Name') }}</label>
                                        <input id="name" type="text"
                                               class="form-control @error('name') is-invalid @enderror" name="name"
                                               value="{{ old('name') }}" autocomplete="name" autofocus
                                               placeholder="enter name">

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                                        <input id="email" type="email"
                                               class="form-control @error('email') is-invalid @enderror" name="email"
                                               value="{{ old('email') }}" autocomplete="email" autofocus
                                               placeholder="enter email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="userpassword" class="form-label">{{ __('Password') }}</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input id="userpassword" type="password"
                                                   class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password"
                                                   placeholder="Enter password" aria-describedby="password-addon">
                                            <button class="btn btn-light" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input id="password-confirm" type="password"
                                                   class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                                                   autocomplete="current-password"
                                                   placeholder="Enter password" aria-describedby="password-addon">
                                            <button class="btn btn-light" type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>

                                            @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mt-2 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">{{__('Register')}}</button>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="text-center">
                        <div>
                            <p>Already have an account ? <a href="{{route('login')}}" class="fw-medium text-primary"> {{__('Login')}}</a></p>
                            <p> {{now()->format('Y')}} {!! $setting->footer_text ?: '© Code Alchemy' !!}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
