@extends('layouts.app')

<!-- Custom Styles -->
{{-- <link href="{{ asset('css/custom.css') }}" rel="stylesheet" /> --}}

@section('content')
    <div class="container">
        <div class="row text-center" style="padding: 5px;">
            <div class="col-sm-6 pull-left" style="margin-bottom: 5px;">
                <a href="{{ URL::previous() }}" role="button" class="btn btn-primary">Go Back</a>
            </div>
            <div class="col-sm-6 pull-right" style="margin-bottom: 5px;"></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="panel-heading row">
                            <span class="col-sm-8" style="padding: 0;">
                                {{ $house->address_street }},
                                {{ $house->address_city }} {{ $house->address_state }},
                                {{ $house->address_zip }}
                            </span>
                            <span class="col-sm-4" style="text-align: right; padding: 0;">
                                @if($house->sold)
                                    <span>Sold</span>
                                @else
                                    <span>${{ $house->price }}</span>
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="col-sm-12">{{ $house->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
