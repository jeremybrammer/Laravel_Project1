@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row text-center">
        <div class="col-sm-6 pull-left" style="margin-bottom: 5px;">
            <a href="{{ route('houses.index') }}" role="button" class="btn btn-primary">Back to My Listings</a>
        </div>
        <div class="col-sm-6 pull-right" style="margin-bottom: 5px;"></div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create House Sale Listing</div>

                <div class="card-body">

                    <x-flash-message />

                    <form method="post" action="{{ route('houses.store') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Street Address</span>
                            </div>
                            <input type="text" class="form-control" name="address_street" />
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">City</span>
                            </div>
                            <input type="text" class="form-control" name="address_city" />
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">State</span>
                            </div>
                            <select class="selectpicker" name="address_state">
                                <option value="" selected="selected"></option>
                                <option value="AL">Alabama</option>
                                <option value="AK">Alaska</option>
                                <option value="AZ">Arizona</option>
                                <option value="AR">Arkansas</option>
                                <option value="CA">California</option>
                                <option value="CO">Colorado</option>
                                <option value="CT">Connecticut</option>
                                <option value="DE">Delaware</option>
                                <option value="DC">District Of Columbia</option>
                                <option value="FL">Florida</option>
                                <option value="GA">Georgia</option>
                                <option value="HI">Hawaii</option>
                                <option value="ID">Idaho</option>
                                <option value="IL">Illinois</option>
                                <option value="IN">Indiana</option>
                                <option value="IA">Iowa</option>
                                <option value="KS">Kansas</option>
                                <option value="KY">Kentucky</option>
                                <option value="LA">Louisiana</option>
                                <option value="ME">Maine</option>
                                <option value="MD">Maryland</option>
                                <option value="MA">Massachusetts</option>
                                <option value="MI">Michigan</option>
                                <option value="MN">Minnesota</option>
                                <option value="MS">Mississippi</option>
                                <option value="MO">Missouri</option>
                                <option value="MT">Montana</option>
                                <option value="NE">Nebraska</option>
                                <option value="NV">Nevada</option>
                                <option value="NH">New Hampshire</option>
                                <option value="NJ">New Jersey</option>
                                <option value="NM">New Mexico</option>
                                <option value="NY">New York</option>
                                <option value="NC">North Carolina</option>
                                <option value="ND">North Dakota</option>
                                <option value="OH">Ohio</option>
                                <option value="OK">Oklahoma</option>
                                <option value="OR">Oregon</option>
                                <option value="PA">Pennsylvania</option>
                                <option value="RI">Rhode Island</option>
                                <option value="SC">South Carolina</option>
                                <option value="SD">South Dakota</option>
                                <option value="TN">Tennessee</option>
                                <option value="TX">Texas</option>
                                <option value="UT">Utah</option>
                                <option value="VT">Vermont</option>
                                <option value="VA">Virginia</option>
                                <option value="WA">Washington</option>
                                <option value="WV">West Virginia</option>
                                <option value="WI">Wisconsin</option>
                                <option value="WY">Wyoming</option>
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Zip Code</span>
                            </div>
                            <input type="text" class="form-control" name="address_zip" />
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Price $</span>
                            </div>
                            <input type="text" class="form-control" name="price" />
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Description</span>
                            </div>
                            <textarea class="form-control" name="description"></textarea>
                        </div>

                        {{-- <div>
                            <span>
                                <input type="radio" name="sold" id="for_sale" value="for sale" checked="checked" />
                                <label for="for_sale">For Sale</label>
                            </span>
                            <span style="margin-left: 15px;">
                                <input type="radio" name="sold" id="is_sold" value="sold" />
                                <label for="is_sold">Sold</label>
                            </span>
                        </div> --}}

                        <input type="submit" class="btn btn-primary" value="Create Listing" />
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
