@extends('layouts.app')

<!-- Custom Styles -->
<link href="{{ asset('css/custom.css') }}" rel="stylesheet" />

@section('content')
    <div class="container">
        <div class="row text-center" style="padding: 5px;">
            <div class="col-sm-6 pull-left" style="margin-bottom: 5px;">
                <a href="{{ route('all-listings') }}" role="button" class="btn btn-primary">Back to All Listings</a>
            </div>
            <div class="col-sm-6 pull-right" style="margin-bottom: 5px;">
                <a href="{{ route('create-listing') }}" role="button" class="btn btn-primary">Create New Listing</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">All Houses for Sale</div>
                    <div class="card-body">

                        <x-flash-message />

                        <ul class="house_listing">
                        @foreach($houses as $house)
                            <li>
                                <div class="house_list_item_panel panel panel-default container">
                                    <div class="panel-heading row">
                                        <span class="col-sm-8" style="padding: 0;">
                                            {{-- <a href="{{ route('houses/details') }}"> --}}
                                            <a href="">
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
                                    <div class="panel-body">
                                        <div class="row">
                                            <p class="col-sm-12">{{ $house->description }}</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 text-right" style="padding: 0;">
                                                <a href="{{ route('house.edit', $house->id) }}" role="button" class="btn btn-primary">Edit</a>

                                                <!-- Start Delete functionality -->
                                                <button
                                                    type="button"
                                                    class="btn btn-primary"
                                                    onclick="
                                                        if(confirm('Are you sure you would like to delete this listing?')){
                                                            event.preventDefault();
                                                            document.getElementById('form-delete-listing-{{ $house->id }}').submit();
                                                        }
                                                    "
                                                >Delete</button>
                                                <form
                                                    method="post"
                                                    action="{{ route('house.delete', $house->id) }}"
                                                    id="{{ 'form-delete-listing-' . $house->id }}"
                                                    style="display: none;"
                                                >
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                                <!-- End Delete functionality -->

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
