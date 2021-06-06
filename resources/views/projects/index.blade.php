<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl custom-nav-head leading-tight">
        <i class="fas fa-poll"></i> {{ __('Projects') }}
        </h2>
        <div class="btn-panel">
            <span id="addProject">Add Project</span>
        </div>
    </x-slot>
    <div class="container-fluid">
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
                            <th scope="col">Hits</th>
                            <th scope="col">Completes</th>
                            <th class="span-cols">Status</th>
                            <th class="span-cols">Actions</th>
                            </tr>
                        </thead>
                    </div>
                    <tbody>
                    @if(count($projects) > 0)
                        @foreach($projects as $index => $project)
                        <a href="javascript:void(0);">
                            <tr>
                            <th scope="row"><a href="{{route('projects.edit', $project->pki_project_id)}}">{{$project->name}}</a></th>
                            <td>{{$project->client}}</td>
                            <td>{{$project->country}}</td>
                            <td>{{$project->manager}}</td>
                            <td>
                            @if(isset($calculated_loi[$index]) && $calculated_loi)
                                {{$calculated_loi[$index]}}
                            @else
                                0
                            @endif
                            </td>
                            <td>
                            @if(isset($calculated_ir[$index]) && $calculated_ir)
                                {{$calculated_ir[$index]}}
                            @else
                                0
                            @endif
                            </td>
                            <td>{{$project->cpi}}</td>
                            <td>{{$project->survey_visited_count}}</td>
                            <td>{{$project->completes_count}} / {{$project->required_completes}}</td>
                            <td class="span-cols">
                                <select class="project-status" data-projectid="{{$project->pki_project_id}}">
                                    @foreach($projectstatuses as $status)
                                        <option value="{{$status->pki_projectstatus_id}}" {{ ( $status->pki_projectstatus_id == $project->fki_projectstatus_id) ? 'selected' : '' }}>{{$status->status}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td class="span-cols">
                                <button class="btn btn-custom-view project-id" data-projectid="{{$project->pki_project_id}}">View</button>
                                <a href="{{route('projects.edit', $project->pki_project_id)}}" class="btn btn-custom-edit">Edit</a>
                                <form method="POST" action="{{route('projects.remove')}}">
                                    @csrf
                                    <input type="hidden" name="project_id" value="{{$project->pki_project_id}}">
                                    <input type="submit" class="btn btn-danger" value="Remove" onclick="alert('Are you sure you want to remove this project?')">
                                </form>
                            </td>
                            </tr>
                        </a>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                
            </div>
        </div>
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
                            <a id="new-cui-tab" class="nav-link active" href="#">New CUI</a>
                        </li>
                        <li class="nav-item">
                            <a id="existing-cui-tab" class="nav-link" href="#">Existing CUI</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane active" id="new-cui" role="tabpanel" aria-labelledby="home-tab">
                            <form method="POST" action="{{route('projects.store')}}">
                            @csrf
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="subject" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <select class="" name="fki_client_id" required>
                                    @foreach($clients as $client)
                                        <option value="{{$client->pki_client_id}}">{{$client->client}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="" name="fki_user_id" required>
                                    @foreach($users as $user)
                                        <option value="{{$user->pki_user_id}}">{{$user->name}}</option>
                                    @endforeach    
                                    </select>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check" name="security" value="0">
                                    <label>Alpha Secure</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check" name="security" value="1">
                                    <label>Unique Redirect</label>
                                </div>
                                <div class="modal-footer">
                                <button type="submit" name="submit" value="submit" class="btn btn-primary">Create</button>
                                    <button type="button" class="btn btn-secondary close-btn-bottom" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="existing-cui" role="tabpanel" aria-labelledby="profile-tab">
                            <form method="POST" action="{{route('projects.store')}}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="cui_name" class="form-control" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="existingSubmit" class="btn btn-primary">Create</button>
                                    <button type="button" class="btn btn-secondary close-btn-bottom" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div id="detailModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Project Details - <span id="head-id"></span></h5>
                <button id="close-detail-btn" type="button" class="close modal-custom-btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="details-outer">
                    
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.project-id').on('click', function() {
            var projectId = $(this).attr('data-projectid');
            $('#details-cont').html('');
            $.ajax({
                url: '{{ url('api/project').'/' }}' + projectId
            }).done(function (response) {
                console.log(response);
                var html = '<p>Name - '+response.data.name+'</p><p>Subject Line - '+response.data.subject+'</p><p>Quoted LOI - '+response.data.loi+'</p><p>Quoted IR - '+response.data.ir+'</p><p>Quoted CPI - '+response.data.cpi+'</p><p>Project Manager - '+response.data.user_name+'</p>';
                $('#head-id').append(response.data.pki_project_id);
                $('#detailModal').show();
                $('#details-outer').html(html);
            });
        });
        $('#close-detail-btn').on('click', function() {
            $('#detailModal').hide();
        });


        $('.project-status').on('change', function() {
            var projectId = $(this).attr('data-projectid');
            var status = $(this).val();
            $.ajax({
                type:'POST',
                url: '{{ url('api/project/updateStatus').'/' }}' + projectId,
                data:{fki_projectstatus_id:status},
                success:function(data){
                    console.log(data);
                }
            });
        });
    </script>
</x-app-layout>
