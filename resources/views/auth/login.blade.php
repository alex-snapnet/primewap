@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}"> 
                 @csrf
                <div class="form-group">
                  <label class="label">Username</label>
                  <div class="input-group">
                    <input type="text" placeholder="Username"  id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    <div class="input-group-append">
                       @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                       @endif
                    </div>

                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Password</label>
                  <div class="input-group">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                    <div class="input-group-append">
                      @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block">Login</button><br>
                  <p class="text-center">Or</p>
                  <a style="color:white" role="button" onclick="window.location='{{ url('/auth/microsoft') }}'"  class="btn btn-danger submit-btn btn-block">Sign In With O365</a>
                </div>
                <div class="form-group d-flex justify-content-between">
                  <div class="form-check form-check-flat mt-0">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Keep me signed in
                    </label>
                  </div>
                  <a href="{{ route('password.request') }}" class="text-small forgot-password text-black">Forgot Password</a>
                </div>
                 
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Not a member ?</span>
                  <a href="{{url('register')}}" class="text-black text-small">Create new account</a>
                </div>
              </form>
              @endsection