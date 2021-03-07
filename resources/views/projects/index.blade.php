<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="btn-panel">
                <button id="addProject" class="btn btn-primary">Add Project</button>
            </div>
            <div class="table-outer bg-white overflow-hidden shadow-sm sm:rounded-lg">
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
        <div class="row">
            <div id="projectModal" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button id="close-btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul class="nav nav-pills nav-fill">
                            <li class="nav-item">
                                <a id="new-epo-tab" class="nav-link active" href="#">Active</a>
                            </li>
                            <li class="nav-item">
                                <a id="existing-epo-tab" class="nav-link" href="#">Link</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane active" id="new-epo" role="tabpanel" aria-labelledby="home-tab">
                                <form method="POST" action="">
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="subject" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <select class="" name="client" required>
                                            <option value="A">Client A</option>
                                            <option value="B">Client B</option>
                                            <option value="C">Client C</option>
                                            <option value="D">Client D</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="" name="manager" required>
                                            <option value="X">Project Manager X</option>
                                            <option value="Y">Project Manager Y</option>
                                            <option value="Z">Project Manager Z</option>
                                        </select>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check" name="security" value="alpha">
                                        <label>Alpha Secure</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check" name="security" value="unique">
                                        <label>Unique Redirect</label>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary">Add Project</button>
                                        <button type="button" class="btn btn-secondary close-btn-bottom" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="existing-epo" role="tabpanel" aria-labelledby="profile-tab">
                            <form>
                                <div class="form-group">
                                    <input type="text" name="epo_name" class="form-control" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary">Add Project</button>
                                    <button type="button" class="btn btn-secondary close-btn-bottom" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
