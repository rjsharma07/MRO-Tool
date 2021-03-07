<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Countries') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="btn-panel">
                <a href="{{route('countries.create')}}" class="btn btn-primary">Add Country</a>
            </div>
            <div class="table-outer bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table">
                        <div class="bg-custom">
                            <thead>
                                <tr>
                                <th scope="col">Country Id</th>
                                <th scope="col">Country</th>
                                <th scope="col">Created At</th> 
                                </tr>
                            </thead>
                        </div>
                        <tbody>
                        @if($countries)
                            @foreach($countries as $country)
                                <tr>
                                    <td>{{$country->pki_country_id}}</th>
                                    <td>{{$country->country}}</td>
                                    <td>{{$country->created->format('d/m/Y')}}</td>
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
