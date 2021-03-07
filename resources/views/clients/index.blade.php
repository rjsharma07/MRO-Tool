<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="btn-panel">
                <a href="{{route('clients.create')}}" class="btn btn-primary">Add Client</a>
            </div>
            <div class="table-outer bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table">
                        <div class="bg-custom">
                            <thead>
                                <tr>
                                <th scope="col">Client Id</th>
                                <th scope="col">Client Name</th>
                                <th scope="col">Country</th>
                                <th scope="col">Currency</th>
                                <th scope="col">Created At</th> 
                                </tr>
                            </thead>
                        </div>
                        <tbody>
                        @if($clients)
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{$client->pki_client_id}}</th>
                                    <td>{{$client->client}}</td>
                                    <td>
                                    @if($client->fki_country_id)
                                        {{$client->fki_country_id}}
                                    @else
                                        --
                                    @endif
                                    </td>
                                    <td>
                                    @if($client->fki_currency_id)
                                        {{$client->fki_currency_id}}
                                    @else
                                        --
                                    @endif
                                    </td>
                                    <td>{{$client->created->format('d/m/Y')}}</td>
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
