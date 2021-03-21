<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendors') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="table-outer bg-white overflow-hidden shadow-sm sm:rounded-lg vendordetails-outer">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table">
                        <div class="bg-custom">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Vendor</th>
                                    <th scope="col">Project</th>
                                    <th scope="col">CPI</th>
                                    <th scope="col">Required Completes</th>
                                    <th scope="col">Completes</th>
                                    <th scope="col">Complete Url</th>
                                    <th scope="col">Disqualify Url</th>
                                    <th scope="col">Quotafull Url</th>
                                    <th scope="col">Quality Term Url</th>
                                    <th scope="col">Updated At</th> 
                                </tr>
                            </thead>
                        </div>
                        <tbody>
                        @if($vendordetails)
                            @foreach($vendordetails as $vendordetail)
                                <tr>
                                    <td>{{$vendordetail->pki_vendordetail_id}}</th>
                                    <td>{{$vendordetail->vendor}}</td>
                                    <td>
                                        {{$vendordetail->project_name}}
                                    </td>
                                    <td>
                                        {{$vendordetail->cpi}}
                                    </td>
                                    <td>
                                        {{$vendordetail->required_completes}}
                                    </td>
                                    <td>
                                        {{$vendordetail->completes}}
                                    </td>
                                    <td>{{$vendordetail->complete_url}}</td>
                                    <td>{{$vendordetail->disqualify_url}}</td>
                                    <td>{{$vendordetail->quotafull_url}}</td>
                                    <td>{{$vendordetail->quality_term_url}}</td>
                                    <td>{{$vendordetail->updated->format('d/m/Y h:m:i A')}}</td>
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
