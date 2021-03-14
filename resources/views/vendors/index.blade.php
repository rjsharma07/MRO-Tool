<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendors') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="btn-panel">
                <a href="{{route('vendors.create')}}" class="btn btn-primary">Add Vendor</a>
            </div>
            <div class="table-outer bg-white overflow-hidden shadow-sm sm:rounded-lg vendors-outer">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table">
                        <div class="bg-custom">
                            <thead>
                                <tr>
                                <th scope="col">Vendor Id</th>
                                <th scope="col">Vendor</th>
                                <th scope="col">Country</th>
                                <th scope="col">Currency</th>
                                <th scope="col">Complete Url</th>
                                <th scope="col">Disqualify Url</th>
                                <th scope="col">Quotafull Url</th>
                                <th scope="col">Quality Term Url</th>
                                <th scope="col">Updated At</th> 
                                </tr>
                            </thead>
                        </div>
                        <tbody>
                        @if($vendors)
                            @foreach($vendors as $vendor)
                                <tr>
                                    <td>{{$vendor->pki_vendor_id}}</th>
                                    <td>{{$vendor->vendor}}</td>
                                    <td>
                                    @if($vendor->fki_country_id)
                                        {{$vendor->fki_country_id}}
                                    @else
                                        --
                                    @endif
                                    </td>
                                    <td>
                                    @if($vendor->fki_currency_id)
                                        {{$vendor->fki_currency_id}}
                                    @else
                                        --
                                    @endif
                                    </td>
                                    <td>{{$vendor->complete_url}}</td>
                                    <td>{{$vendor->disqualify_url}}</td>
                                    <td>{{$vendor->quotafull_url}}</td>
                                    <td>{{$vendor->quality_term_url}}</td>
                                    <td>{{$vendor->updated->format('d/m/Y h:m:i A')}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
