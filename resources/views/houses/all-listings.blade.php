@extends('layouts.app')

<!-- Custom Styles -->
<link href="{{ asset('css/custom.css') }}" rel="stylesheet" />

@section('content')
    <div class="container">
        {{-- @if(auth()->user()) --}}
        <div class="row text-center">
            <div class="col-sm-6 pull-left" style="margin-bottom: 5px;"></div>
            <div class="col-sm-6 pull-right" style="margin-bottom: 5px;">
                <a href="{{ route('houses.index') }}" role="button" class="btn btn-primary">Manage My Listings</a>
            </div>
        </div>
        {{-- @endif --}}
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">All Houses for Sale</div>
                    <div class="card-body">
                        <ul class="house_listing">
                        @if($houses->count() > 0)
                            @foreach($houses as $house)
                                <li>
                                    <div class="house_list_item_panel panel panel-default container">
                                        <div class="panel-heading row">
                                            <span class="col-sm-8" style="padding: 0;">
                                                <a href="{{ route('houses.show', $house->id) }}">
                                                    {{ $house->address_street }},
                                                    {{ $house->address_city }} {{ $house->address_state }},
                                                    {{ $house->address_zip }}
                                                </a>
                                            </span>
                                            <span class="col-sm-4" style="text-align: right; padding: 0;">
                                                @if($house->sold)
                                                    <span>Sold</span>
                                                @else
                                                    <span>${{ $house->price }}</span>
                                                @endif
                                            </span>
                                        </div>
                                        <div class="panel-body row">
                                            <p class="col-sm-12">{{ $house->description }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <p>Bummer...there aren't any listings yet! :(</p>
                        @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
