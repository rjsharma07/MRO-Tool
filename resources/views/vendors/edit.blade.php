<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl custom-nav-head leading-tight">
        <i class="fa fa-edit"></i> {{ __('Edit Vendor') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="project-form">
                <form method="POST" action="{{route('vendors.update')}}">
                @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4"> 
                                <label>Name</label>
                                <input id="vendor" type="text" class="form-control" name="vendor" value="{{$vendor->vendor}}">
                            </div>
                            <div class="col-sm-4"> 
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{$vendor->email}}">
                            </div>
                            <div class="col-sm-4"> 
                                <label>Phone</label>
                                <input id="phone" type="text" class="form-control" name="phone" value="{{$vendor->phone}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-8"> 
                                <label>Billing Address</label>
                                <textarea class="form-control" name="address" rows="5">{{$vendor->billing_address}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-8"> 
                                <label>Complete Url</label>
                                <input id="complete_url" type="text" class="form-control" name="complete_url" placeholder="Enter Complete Url" value="{{$vendor->complete_url}}">
                            </div>
                            <div class="col-sm-8"> 
                                <label>Disqualify Url</label>
                                <input id="disqualify_url" type="text" class="form-control" name="disqualify_url" placeholder="Enter Disqualify Url" value="{{$vendor->disqualify_url}}">
                            </div>
                            <div class="col-sm-8"> 
                                <label>Quotafull Url</label>
                                <input id="quotafull_url" type="text" class="form-control" name="quotafull_url" placeholder="Enter Quotafull Url" value="{{$vendor->quotafull_url}}">
                            </div>
                            <div class="col-sm-8"> 
                                <label>Quality Term Url</label>
                                <input id="quality_term_url" type="text" class="form-control" name="quality_term_url" placeholder="Enter Quality Term Url" value="{{$vendor->quality_term_url}}">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="pki_vendor_id" value="{{$vendor->pki_vendor_id}}">
                    <button id="submit" type="submit" name="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>