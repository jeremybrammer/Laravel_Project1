@extends('layouts.app')

<!-- Custom Styles -->
<link href="{{ asset('css/custom.css') }}" rel="stylesheet" />

@section('content')
    <div class="container" id="allListingsContainer" ng-controller="HouseListingController" ng-init="init();" style="visibility: hidden;">
        {{-- @if(auth()->user()) --}}
        <div class="row text-center">
            <div class="col-sm-6 pull-left" style="margin-bottom: 5px;">

            </div>
            <div class="col-sm-6 pull-right" style="margin-bottom: 5px;">
                <a href="{{ route('houses.index') }}" role="button" class="btn btn-primary">Manage My Listings</a>
            </div>
        </div>
        {{-- @endif --}}
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- START Search Bar -->
                <div class="input-group" ng-controller="HouseListingSearchBarController" ng-init="initSearchBar();">
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-outline-secondary">@{{ houseListingSearchBarSelectedOption }}</button>
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a
                                class="dropdown-item"
                                href="#"
                                ng-repeat="(key, searchOption) in houseListingSearchBarOptions"
                                ng-click="setHouseListingSearchBarSelectedOption(key);"
                            >
                                @{{ searchOption }}
                            </a>
                        </div>
                    </div>
                    <input
                        type="text"
                        class="form-control"
                        ng-disabled="searchInputFieldEnabled === false"
                        ng-model="searchValue"
                    />
                    <button
                        type="button"
                        class="btn btn-secondary"
                        ng-click="searchListings(houseListingSearchBarSelectedOptionKey, searchValue)"
                    >Search</button>
                </div>
                <!-- END Search Bar -->

                <!-- START Google Map -->
                {{-- <div ng-controller="GoogleMapsController" ng-init="initializeGoogleMap()">
                    <div id="map" style="height: 300px;"></div>
                    <div id="panorama" style="height: 300px;"></div>
                </div> --}}
                <!-- END Google Map -->

                <div class="card" ng-show="!isLoading">
                    <div class="card-header">All Houses for Sale</div>
                    <div class="card-body">

                        <!-- START Angular.js displays data -->
                        <ul class="house_listing" ng-if="pageListings.length > 0">
                            <li ng-repeat="(key, house) in pageListings">
                                <div class="house_list_item_panel panel panel-default container">
                                    <div class="panel-heading row">
                                        <span class="col-sm-8" style="padding: 0;">
                                            <a href="@{{ APP_URL + '/houses/' + house.id }}">
                                                @{{ house.address_street }},
                                                @{{ house.address_city }} @{{ house.address_state }},
                                                @{{ house.address_zip }}
                                            </a>
                                        </span>
                                        <span class="col-sm-4" style="text-align: right; padding: 0;">
                                            @{{ (house.sold) ? 'Sold' : '$' + house.price }}
                                        </span>
                                    </div>
                                    <div class="panel-body row">
                                        <p class="col-sm-12">@{{ house.description }}</p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <p ng-if="pageListings.length < 1">No listings found.</p>
                    <!-- END Angular.js displays data -->

                    <!-- START Laravel displays data -->
                    <?php /*
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
                        </ul>
                    @else
                        <p>Bummer...there aren't any listings yet! :(</p>
                    @endif
                    */ ?>
                    <!-- END Laravel displays data -->

                    </div>
                </div>

                <!-- START loading pane -->
                <div class="row justify-content-center" ng-show="isLoading">
                    <img src="{{ asset('images/loading.gif') }}" width="200px" />
                </div>
                <!-- END loading pane -->

            </div>
        </div>
    </div>

@endsection
