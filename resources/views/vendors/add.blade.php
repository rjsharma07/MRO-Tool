<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Vendor') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="project-form">
                <form method="POST" action="{{route('vendors.store')}}">
                @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6"> 
                                <label>Vendor Name</label>
                                <input type="text" class="form-control" name="vendor" placeholder="Enter Vendor Name" required>
                            </div>
                            <div class="col-sm-6"> 
                                <label>Reference Name</label>
                                <input type="text" class="form-control" name="reference_name" placeholder="Enter Vendor Reference Name" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Country</label>
                                <select name="fki_country_id" class="form-control">
                                    @foreach($countries as $country)
                                        <option value="{{$country->pki_country_id}}">{{$country->country}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>Currency</label>
                                <select name="fki_currency_id" class="form-control">
                                    @foreach($currencies as $currency)
                                        <option value="{{$currency->pki_currency_id}}">{{$currency->currency}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-8"> 
                                <label>Complete Url</label>
                                <input type="text" class="form-control" name="complete_url" placeholder="Enter Complete Url" required>
                            </div>
                            <div class="col-sm-8"> 
                                <label>Disqualify Url</label>
                                <input type="text" class="form-control" name="disqualify_url" placeholder="Enter Disqualify Url" required>
                            </div>
                            <div class="col-sm-8"> 
                                <label>Quotafull Url</label>
                                <input type="text" class="form-control" name="quotafull_url" placeholder="Enter Quotafull Url" required>
                            </div>
                            <div class="col-sm-8"> 
                                <label>Quality Term Url</label>
                                <input type="text" class="form-control" name="qualityterm_url" placeholder="Enter Quality Term Url" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Save Project</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>