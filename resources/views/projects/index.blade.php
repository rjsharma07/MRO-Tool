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
                <table id="pTable" class="table">
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
                            <th class="span-cols-status">Status</th>
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
                             mins
                            </td>
                            <td>
                            @if(isset($calculated_ir[$index]) && $calculated_ir)
                                {{$calculated_ir[$index]}}
                            @else
                                0
                            @endif
                             %
                            </td>
                            <td>{{$project->cpi}}</td>
                            <td>{{$project->survey_visited_count}}</td>
                            <td>{{$project->completes_count}} / {{$project->required_completes}}</td>
                            <td class="span-cols-status">
                                <select class="project-status" data-projectid="{{$project->pki_project_id}}" data-cui="{{$project->cui}}">
                                    @foreach($projectstatuses as $status)
                                        <option value="{{$status->pki_projectstatus_id}}" {{ ( $status->pki_projectstatus_id == $project->fki_projectstatus_id) ? 'selected' : '' }}>{{$status->status}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td id="projectActions" class="span-cols">
                                <button class="btn btn-custom-view project-id" data-projectid="{{$project->pki_project_id}}">View</button>
                                <a href="{{route('projects.edit', $project->pki_project_id)}}" class="btn btn-custom-edit">Edit</a>
                                <!-- <form method="POST" action="{{route('projects.remove')}}">
                                    @csrf
                                    <input type="hidden" name="project_id" value="{{$project->pki_project_id}}">
                                    <input type="submit" class="btn btn-danger" value="Remove" onclick="alert('Are you sure you want to remove this project?')">
                                </form> -->
                                @if($project->fki_projectstatus_id == 5)
                                <button id="costAction" class="btn btn-success" data-cui="{{$project->cui}}">Cost</button>
                                @endif
                            </td>
                            </tr>
                        </a>
                        @endforeach
                    @endif
                    </tbody>
                </table>
                
            </div>
        </div>

        <!-------------- Add Project Modal -------------->
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
                                <form class="addProjectForm" method="POST" action="{{route('projects.store')}}">
                                @csrf
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Enter Project Name" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="subject" class="form-control" placeholder="Enter Project Subject Line" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <select class="" name="fki_client_id" required>
                                                @foreach($clients as $client)
                                                    <option value="{{$client->pki_client_id}}">{{$client->client}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <select class="" name="fki_user_id" required>
                                                @foreach($users as $user)
                                                    <option value="{{$user->pki_user_id}}">{{$user->name}}</option>
                                                @endforeach    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check radio-group">
                                        <div class="row">
                                            <div class="col-md-12"><p>Redirects</p></div>
                                            <div class="col-md-6">
                                                <div class="form-radio-custom">
                                                    <input type="radio" class="form-check" name="security" value="0">
                                                    <label>Alpha Secure</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-radio-custom">
                                                    <input type="radio" class="form-check" name="security" value="1">
                                                    <label>Unique Redirect</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-check radio-group">
                                        <div class="row">
                                            <div class="col-md-12"><p>Security</p></div>
                                            <div class="col-md-6">
                                                <div class="form-radio-custom">
                                                    <input type="checkbox" class="form-check" name="unique_ip">
                                                    <label>Unique IP</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-radio-custom">
                                                    <input type="checkbox" class="form-check" name="unique_pid">
                                                    <label>Unique PID</label>
                                                </div>
                                            </div>
                                        </div>
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
        <!-------------- Ids Recieved Project Modal -------------->
        <div id="idsModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button id="close-id-btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="idsForm">
                            <div id="allIds" class="row">
                                
                            </div>
                            <div class="row">
                                <div class="form-group form-group-custom">
                                    <label>Enter Ids Received</label>
                                    <textarea id="idsText" class="form-control" name="ids_received" rows="4"></textarea>
                                </div>
                                <button id="idsSubmit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <p id="idsStatus"></p>
                        <div id="notCheckedData"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-------------- Project Details Modal -------------->
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
        </div>

        <!-------------- Project Cost Modal -------------->
        <div id="costModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Costing</h5>
                        <button id="close-cost-btn" type="button" class="close modal-custom-btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="cost-outer">
                            <div class="cost-head">
                                <div class="row">
                                    <div class="col-md-12"><p><strong>CUI no. -</strong> <span id="cuiCost"></span></p></div>
                                    <div class="col-md-12"><p><strong>Ids Received at -</strong> <span id="costDate"></span></p></div>
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                    <th>Project</th>
                                    <th>CPI</th>
                                    <th>Completes</th>
                                    <th>Cost(in $)</th>
                                </thead>
                                <tbody id="costouter">

                                </tbody>
                            </table>
                        </div>
                        <div class="total-cost">
                            <p><strong>Total -</strong> <span id="totalCost"></span>$</p>
                        </div>
                    </div>
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
            var cui = $(this).attr('data-cui');
            var status = $(this).val();
            $('#allIds').html('');
            $.ajax({
                type:'POST',
                url: '{{ url('api/project/updateStatus').'/' }}' + projectId,
                data:{fki_projectstatus_id:status, cui: cui},
                success:function(response){
                    if(response.data.cuiProjects){
                        if(response.data.cuiProjects.length > 0){
                            $('#idsModal').show();
                            $.each(response.data.cuiProjects, function (key, value) {
                                let html = '<div class="col-md-6"><input type="checkbox" name="ids" id="'+value.pki_project_id+'"><span class="project_ids">'+value.name+'</span></div>';
                                $('#allIds').append(html);
                            });
                        }
                    }
                }
            });
        });

        $('#idsSubmit').on('click', function(e  ) {
            e.preventDefault();
            $('#notCheckedData').html('');
            var project_ids = [];
            var ids_received = $('#idsText').val();
            $("input:checkbox[name=ids]:checked").each(function () {
                project_ids.push($(this).attr("id"));
            });
            $.ajax({
                type:'POST',
                url: '{{ url('api/project/saveReceivedIds')}}',
                data:{project_ids:project_ids, ids_received: ids_received},
                success:function(response){
                    console.log(response);
                    $('#idsStatus').html(response.message);
                    if(response.data){
                        $.each(response.data, function (key, value) {
                            let html = '<p><strong>Project - '+ value.project +'</strong></p><p>'+ value.respondent_id +'<p>';
                            $('#notCheckedData').append(html);
                        });
                    } else {
                    }
                    if(response.status == 1){
                        $('#idsModal').hide();
                    }
                }
            });
        });

        $('#costAction').on('click', function(e  ) {
            e.preventDefault();
            $('#costouter').html('');
            $('#cuiCost').html('');
            $('#costDate').html('');
            $('#totalCost').html('');
            var cui = $(this).attr('data-cui');
            $.ajax({
                url: '{{ url('api/getProjectIds').'/' }}' + cui
            }).done(function (response) {
                console.log(response);
                if(response.data){
                    $('#costModal').show();
                    $('#cuiCost').html(cui);
                    $('#costDate').html(response.data.updated);
                    $.each(response.data.details, function (key, value) {
                        let html = '<tr><td>'+ value.project +'</td><td>'+ value.cpi +'</td><td>'+ value.completes +'</td><td>'+ value.cost +'</td></tr>';
                        $('#costouter').append(html);
                    });
                    $('#totalCost').html(response.data.total_cost);
                }
            });
        });
    </script>
</x-app-layout>
