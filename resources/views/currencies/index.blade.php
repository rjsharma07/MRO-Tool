<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Countries') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="btn-panel">
                <a href="{{route('currencies.create')}}" class="btn btn-primary">Add Currency</a>
            </div>
            <div class="table-outer bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table">
                        <div class="bg-custom">
                            <thead>
                                <tr>
                                <th scope="col">Currency Id</th>
                                <th scope="col">Currency</th>
                                <th scope="col">Created At</th> 
                                </tr>
                            </thead>
                        </div>
                        <tbody>
                        @if($currencies)
                            @foreach($currencies as $currency)
                                <tr>
                                    <td>{{$currency->pki_currency_id}}</th>
                                    <td>{{$currency->currency}}</td>
                                    <td>{{$currency->created->format('d/m/Y')}}</td>
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
