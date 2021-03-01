<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container-fluid">
        <div class="py-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Project</th>
                            <th scope="col">Client</th>
                            <th scope="col">Type</th>
                            <th scope="col">LOI</th>
                            <th scope="col">IR</th>
                            <th scope="col">CPI</th>
                            <th scope="col">Currency</th>
                            <th scope="col">Required Completes</th>  
                            <th scope="col">Status</th>  
                            </tr>
                        </thead>
                        <tbody>
                        @if($projects)
                            @foreach($projects as $project)
                            <a href="{{ url('projects') }}/{{$project->id}}">
                                <tr>
                                <th scope="row">{{$project->name}}</th>
                                <td>{{$project->client}}</td>
                                <td>{{$project->type}}</td>
                                <td>{{$project->loi}}</td>
                                <td>{{$project->ir}}</td>
                                <td>{{$project->cpi}}</td>
                                <td>{{$project->currency}}</td>
                                <td>{{$project->required_completes}}</td>
                                <td>
                                    <select selected="{{$project->status}}">
                                        <option value="1">Live</option>
                                        <option value="2">Pause</option>
                                        <option value="3">Close</option>
                                    </select>
                                </td>
                                </tr>
                            </a>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
