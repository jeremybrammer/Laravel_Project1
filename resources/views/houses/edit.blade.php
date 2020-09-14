@extends('layouts.app')

<!-- Custom Styles -->
{{-- <link href="{{ asset('css/custom.css') }}" rel="stylesheet" /> --}}

@section('content')
    <div class="container">
        <div class="row text-center" style="padding: 5px;">
            <div class="col-sm-6 pull-left" style="margin-bottom: 5px;">
                <a href="{{ route('houses.index') }}" role="button" class="btn btn-primary">Back to My Listings</a>
            </div>
            <div class="col-sm-6 pull-right" style="margin-bottom: 5px;"></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Listing</div>
                    <div class="card-body">

                        <x-flash-message />

                        <form method="post" action="{{ route('houses.update', $house->id) }}">
                            @csrf
                            @method('patch')

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Street Address</span>
                                </div>
                                <input type="text" class="form-control" name="address_street" value="{{ $house->address_street }}" />
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">City</span>
                                </div>
                                <input type="text" class="form-control" name="address_city" value="{{ $house->address_city }}" />
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">State</span>
                                </div>
                                <select class="selectpicker" name="address_state">
                                    <option value=""></option>
                                    <option value="AL" {{ ($house->address_state === 'AL') ? 'selected="selected"': '' }}>Alabama</option>
                                    <option value="AK" {{ ($house->address_state === 'AK') ? 'selected="selected"': '' }}>Alaska</option>
                                    <option value="AZ" {{ ($house->address_state === 'AZ') ? 'selected="selected"': '' }}>Arizona</option>
                                    <option value="AR" {{ ($house->address_state === 'AR') ? 'selected="selected"': '' }}>Arkansas</option>
                                    <option value="CA" {{ ($house->address_state === 'CA') ? 'selected="selected"': '' }}>California</option>
                                    <option value="CO" {{ ($house->address_state === 'CO') ? 'selected="selected"': '' }}>Colorado</option>
                                    <option value="CT" {{ ($house->address_state === 'CT') ? 'selected="selected"': '' }}>Connecticut</option>
                                    <option value="DE" {{ ($house->address_state === 'DE') ? 'selected="selected"': '' }}>Delaware</option>
                                    <option value="DC" {{ ($house->address_state === 'DC') ? 'selected="selected"': '' }}>District Of Columbia</option>
                                    <option value="FL" {{ ($house->address_state === 'FL') ? 'selected="selected"': '' }}>Florida</option>
                                    <option value="GA" {{ ($house->address_state === 'GA') ? 'selected="selected"': '' }}>Georgia</option>
                                    <option value="HI" {{ ($house->address_state === 'HI') ? 'selected="selected"': '' }}>Hawaii</option>
                                    <option value="ID" {{ ($house->address_state === 'ID') ? 'selected="selected"': '' }}>Idaho</option>
                                    <option value="IL" {{ ($house->address_state === 'IL') ? 'selected="selected"': '' }}>Illinois</option>
                                    <option value="IN" {{ ($house->address_state === 'IN') ? 'selected="selected"': '' }}>Indiana</option>
                                    <option value="IA" {{ ($house->address_state === 'IA') ? 'selected="selected"': '' }}>Iowa</option>
                                    <option value="KS" {{ ($house->address_state === 'KS') ? 'selected="selected"': '' }}>Kansas</option>
                                    <option value="KY" {{ ($house->address_state === 'KY') ? 'selected="selected"': '' }}>Kentucky</option>
                                    <option value="LA" {{ ($house->address_state === 'LA') ? 'selected="selected"': '' }}>Louisiana</option>
                                    <option value="ME" {{ ($house->address_state === 'ME') ? 'selected="selected"': '' }}>Maine</option>
                                    <option value="MD" {{ ($house->address_state === 'MD') ? 'selected="selected"': '' }}>Maryland</option>
                                    <option value="MA" {{ ($house->address_state === 'MA') ? 'selected="selected"': '' }}>Massachusetts</option>
                                    <option value="MI" {{ ($house->address_state === 'MI') ? 'selected="selected"': '' }}>Michigan</option>
                                    <option value="MN" {{ ($house->address_state === 'MN') ? 'selected="selected"': '' }}>Minnesota</option>
                                    <option value="MS" {{ ($house->address_state === 'MS') ? 'selected="selected"': '' }}>Mississippi</option>
                                    <option value="MO" {{ ($house->address_state === 'MO') ? 'selected="selected"': '' }}>Missouri</option>
                                    <option value="MT" {{ ($house->address_state === 'MT') ? 'selected="selected"': '' }}>Montana</option>
                                    <option value="NE" {{ ($house->address_state === 'NE') ? 'selected="selected"': '' }}>Nebraska</option>
                                    <option value="NV" {{ ($house->address_state === 'NV') ? 'selected="selected"': '' }}>Nevada</option>
                                    <option value="NH" {{ ($house->address_state === 'NH') ? 'selected="selected"': '' }}>New Hampshire</option>
                                    <option value="NJ" {{ ($house->address_state === 'NJ') ? 'selected="selected"': '' }}>New Jersey</option>
                                    <option value="NM" {{ ($house->address_state === 'NM') ? 'selected="selected"': '' }}>New Mexico</option>
                                    <option value="NY" {{ ($house->address_state === 'NY') ? 'selected="selected"': '' }}>New York</option>
                                    <option value="NC" {{ ($house->address_state === 'NC') ? 'selected="selected"': '' }}>North Carolina</option>
                                    <option value="ND" {{ ($house->address_state === 'ND') ? 'selected="selected"': '' }}>North Dakota</option>
                                    <option value="OH" {{ ($house->address_state === 'OH') ? 'selected="selected"': '' }}>Ohio</option>
                                    <option value="OK" {{ ($house->address_state === 'OK') ? 'selected="selected"': '' }}>Oklahoma</option>
                                    <option value="OR" {{ ($house->address_state === 'OR') ? 'selected="selected"': '' }}>Oregon</option>
                                    <option value="PA" {{ ($house->address_state === 'PA') ? 'selected="selected"': '' }}>Pennsylvania</option>
                                    <option value="RI" {{ ($house->address_state === 'RI') ? 'selected="selected"': '' }}>Rhode Island</option>
                                    <option value="SC" {{ ($house->address_state === 'SC') ? 'selected="selected"': '' }}>South Carolina</option>
                                    <option value="SD" {{ ($house->address_state === 'SD') ? 'selected="selected"': '' }}>South Dakota</option>
                                    <option value="TN" {{ ($house->address_state === 'TN') ? 'selected="selected"': '' }}>Tennessee</option>
                                    <option value="TX" {{ ($house->address_state === 'TX') ? 'selected="selected"': '' }}>Texas</option>
                                    <option value="UT" {{ ($house->address_state === 'UT') ? 'selected="selected"': '' }}>Utah</option>
                                    <option value="VT" {{ ($house->address_state === 'VT') ? 'selected="selected"': '' }}>Vermont</option>
                                    <option value="VA" {{ ($house->address_state === 'VA') ? 'selected="selected"': '' }}>Virginia</option>
                                    <option value="WA" {{ ($house->address_state === 'WA') ? 'selected="selected"': '' }}>Washington</option>
                                    <option value="WV" {{ ($house->address_state === 'WV') ? 'selected="selected"': '' }}>West Virginia</option>
                                    <option value="WI" {{ ($house->address_state === 'WI') ? 'selected="selected"': '' }}>Wisconsin</option>
                                    <option value="WY" {{ ($house->address_state === 'WY') ? 'selected="selected"': '' }}>Wyoming</option>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Zip Code</span>
                                </div>
                                <input type="text" class="form-control" name="address_zip" value="{{ $house->address_zip }}" />
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Price $</span>
                                </div>
                                <input type="text" class="form-control" name="price" value="{{ $house->price }}" />
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Description</span>
                                </div>
                                <textarea class="form-control" name="description">{{ $house->description }}</textarea>
                            </div>

                            <div>
                                <span>
                                    <input type="radio" name="sold" id="for_sale" value="0" {{ (!$house->sold) ? 'checked="checked"' : '' }} />
                                    <label for="for_sale">For Sale</label>
                                </span>
                                <span style="margin-left: 15px;">
                                    <input type="radio" name="sold" id="is_sold" value="1"  {{ ($house->sold) ? 'checked="checked"' : '' }} />
                                    <label for="is_sold">Sold</label>
                                </span>
                            </div>

                            <input type="submit" class="btn btn-primary" value="Create Listing" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
