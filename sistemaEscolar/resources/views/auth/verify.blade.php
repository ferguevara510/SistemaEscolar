@extends('layouts.footer')
@extends('layouts.app')

@section('content')

<link href="{{ asset('/css/registro.css') }}" rel="stylesheet">

<div>
    <p class="titulo">SEF > Verificacion</p>
</div>

<div class="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="color-tarjeta">
                
                <div class="card-body form-group form-registro">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
