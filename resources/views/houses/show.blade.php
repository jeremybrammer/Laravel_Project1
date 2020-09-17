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
                            <div class="col-sm-8" style="font-size: 0.8em;">Listed By: {{ $listedBy }}</div>
                            <span class="col-sm-4" style="text-align: right; padding: 0;">
                                @if($house->sold)
                                <span>Sold</span>
                                @else
                                <span>${{ $house->price }}</span>
                                @endif
                            </span>
                        </div>
                        <div class="col-sm-12" style="padding: 0;">
                            {{ $houseAddressString }}
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="col-sm-12">{{ $house->description }}</p>
                    </div>
                </div>

                <!-- START Google Map -->
                <div
                    ng-controller="HouseDetailsGoogleMapsController" ng-init="initializeGoogleMap('{{ $houseAddressString }}')">
                    <div id="map" style="height: 300px;"></div>
                    <div id="panorama" style="height: 200px;"></div>
                </div>
                <!-- END Google Map -->

            </div>
        </div>
    </div>
@endsection
