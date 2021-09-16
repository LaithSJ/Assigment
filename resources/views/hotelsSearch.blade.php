@extends('layouts.app')
@section('body')
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-10 mt-5">
                <h1 class="text-center">Search And Find A Very Cheap Hotels</h1>
                <div class="mb-3 mt-5">
                    <form id="searchForm">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>Search for hotels by city name</label>
                                <input type="text" class="form-control" id="cities" placeholder="City Name" >
                                <small><i>To test this assigment use one this city ( Amman )</i></small>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Date From</label>
                                <input type="date" class="datepickers form-control" id="fromDate" placeholder="Date From" >
                            </div>
                            <div class="form-group col-md-2">
                                <label>Date To</label>
                                <input type="date" class="datepickers form-control" id="toDate" placeholder="Date From" >
                            </div>
                            <div class="form-group col-md-2">
                                <label>Adults Number</label>
                                <select class="form-control" id="numberOfAdults">
                                    <option value="1" selected>1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>Search Now</label>
                                <button class="btn btn-primary form-control"   type="button" id="search">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-10 mt-5" >
                <div class="d-none" id="error"></div>
            </div>
            <div class="col-lg-10 mt-5 d-none" id="hotels">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Provider</th>
                            <th scope="col">Hotel Name</th>
                            <th scope="col">Fare Per Night</th>
                            <th scope="col">Hotel Amenities</th>
                        </tr>
                    </thead>
                    <tbody id="hotelsBody">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
