@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}"> 
                 @csrf
                <div class="form-group">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                  <label class="label">Enter Your Email</label>
                  <div class="input-group">
                    <input type="text" placeholder="email"  id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
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
                  <button class="btn btn-primary submit-btn btn-block">Reset Password</button>
                </div>
    </form>
@endsection