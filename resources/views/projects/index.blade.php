<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="container-fluid">
        <div class="py-12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table">
                        <div class="bg-custom">
                            <thead>
                                <tr>
                                <th scope="col">Project Name</th>
                                <th scope="col">Client Name</th>
                                <th scope="col">Country</th>
                                <th scope="col">Manager</th>
                                <th scope="col">LOI</th>
                                <th scope="col">IR</th>
                                <th scope="col">CPI</th>
                                <th scope="col">Completes</th>  
                                <th scope="col">Hits</th>
                                <th scope="col">Status</th>
                                <th scope="col">Last Complete</th>
                                <th scope="col">Actions</th> 
                                </tr>
                            </thead>
                        </div>
                        <tbody>
                        @if($projects)
                            @foreach($projects as $project)
                            <a href="javascript:void(0);">
                                <tr>
                                <th scope="row">{{$project->name}}</th>
                                <td>{{$project->client}}</td>
                                <td>{{$project->country}}</td>
                                <td>{{$project->manager}}</td>
                                <td>{{$project->loi}}</td>
                                <td>{{$project->ir}}</td>
                                <td>{{$project->cpi}}</td>
                                <td>{{$project->completes}} / {{$project->required_completes}}</td>
                                <td>{{$project->hits}}</td>
                                <td>{{$project->status}}</td>
                                <td>{{$project->last_complete}}</td>
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
