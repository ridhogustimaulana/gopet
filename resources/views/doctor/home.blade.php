@extends('doctor.app')

@section('content')
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-5 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Home</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                </ol>
            </div>
        </div>
    </div>
    {{--<div class="d-flex justify-content-center">--}}
        {{--{!! QrCode::size(500)->generate(Auth::user()->id); !!}--}}
    {{--</div>--}}
    <div class="d-flex justify-content-center">
        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(500)->generate(Auth::user()->id)) !!} ">
    </div>
    <div class="d-flex justify-content-center">
    <h3>Scan this QRCode to get Doctor ID</h3>
    </div>
@endsection