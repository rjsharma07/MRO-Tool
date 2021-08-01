<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl custom-nav-head leading-tight">
        <i class="fa fa-user"></i>{{ __('Vendors') }}
        </h2>
        <div class="btn-panel">
            <span id="addVendor">Add Vendor</span>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="table-outer bg-white overflow-hidden shadow-sm sm:rounded-lg vendordetails-outer">
            <div class="p-6 bg-white border-b border-gray-200">
                <table id="vTable" class="table">
                    <div class="bg-custom">
                        <thead>
                            <tr>
                                <th scope="col">Vendor</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Billing Address</th>
                                <th scope="col">Complete Url</th>
                                <th scope="col">Disqualify Url</th>
                                <th scope="col">Quotafull Url</th>
                                <th scope="col">Quality Term Url</th>
                                <th scope="col" class="span-cols">Actions</th>
                            </tr>
                        </thead>
                    </div>
                    <tbody>
                    @if($vendors)
                        @foreach($vendors as $vendor)
                            <tr>
                                <td>{{$vendor->vendor}}</td>
                                <td>{{$vendor->email}}</td>
                                <td>
                                @if(isset($vendor->phone))
                                    {{$vendor->phone}}
                                @else
                                    --
                                @endif
                                </td>
                                <td>
                                @if(isset($vendor->billing_address))
                                    {{$vendor->billing_address}}
                                @else
                                    --
                                @endif
                                </td>
                                <td>{{$vendor->complete_url}}</td>
                                <td>{{$vendor->disqualify_url}}</td>
                                <td>{{$vendor->quotafull_url}}</td>
                                <td>{{$vendor->quality_term_url}}</td>
                                <td class="span-cols">
                                    <a href="{{route('vendors.edit', $vendor->pki_vendor_id)}}" class="btn btn-custom-edit">Edit</a>
                                    <form method="POST" action="{{route('vendors.remove')}}">
                                        @csrf
                                        <input type="hidden" name="vendor_id" value="{{$vendor->pki_vendor_id}}">
                                        <input type="submit" class="btn btn-danger" value="Remove" onclick="alert('Are you sure you want to remove this vendor?')">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>  
    </div>
    <div id="vendorModal" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Vendor</h5>
                        <button id="close-vendor-btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{route('vendors.store')}}">
                        @csrf
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Vendor Name</label>
                                        <input type="text" name="vendor" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">    
                                    <div class="col-sm-12">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">    
                                    <div class="col-sm-12">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">    
                                    <div class="col-sm-12">
                                        <label>Billing Address</label>
                                        <textarea class="form-control" name="address" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Complete Url</label>
                                        <input type="text" name="complete_url" class="form-control" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <label>Disqualify Url</label>
                                        <input type="text" name="disqualify_url" class="form-control" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <label>Quotafull Url</label>
                                        <input type="text" name="quotafull_url" class="form-control" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <label>Quality Term Url</label>
                                        <input type="text" name="quality_term_url" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="submit" value="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>
</x-app-layout>
