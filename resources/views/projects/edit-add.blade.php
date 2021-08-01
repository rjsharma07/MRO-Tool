<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl custom-nav-head leading-tight">
        <i class="fa fa-edit"></i>{{ __('Edit') }}
        </h2>
        <div id="project-btn-panel" class="btn-panel">
            <span id="enableEdit">Enable Editing</span>
            <span id="disableEdit">Disable Editing</span>
        </div>
        <div id="vendor-btn-panel" class="btn-panel">
            <span id="addVendorDetail">Add Vendor Detail</span>
        </div>
    </x-slot>
    <div class="secondary-menu-outer">
        <div class="container-fluid">
            <div class="row">
                
                <div class="menu-itm"><a id="projectData" href="javascript:void(0);">Project</a></div>
            
                <div class="menu-itm"><a id="vendorsData" href="javascript:void(0);">Vendor</a></div>

                <div class="menu-itm"><a id="reportsData" href="javascript:void(0);">Reports</a></div>

                <div class="menu-itm"><a id="reportsData" href="javascript:void(0);">Invoice</a></div>

            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div id="projectdetails" class="active">
            <div class="project-form">
                <div class="col-md-12">
                    <form action="{{route('projects.update')}}" method="POST">
                    @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>Project Details</h3>
                                </div>
                                <div class="col-sm-4"> 
                                    <label>Project ID</label>
                                    <input id="projectId" type="text" class="form-control" value="{{$project->pki_project_id}}" readonly>
                                </div>
                                <div class="col-sm-4"> 
                                    <label>Project Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$project->name}}" readonly>
                                </div>
                                <div class="col-sm-4">
                                    <label>Subject</label>
                                    <input type="text" class="form-control" value="{{$project->subject}}" readonly>
                                </div>
                                <div class="col-sm-4"> 
                                    <label>Client</label>
                                    <select id="fki_client_id" class="form-control" name="fki_client_id" disabled>
                                        @foreach($clients as $client)
                                            <option value="{{$client->fki_client_id}}" {{ ( $client->pki_client_id == $project->fki_client_id) ? 'selected' : '' }}>{{$client->client}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Type</label>
                                    <select id="type" name="type" class="form-control" disabled>
                                        <option value="b2b">B2B</option>
                                        <option value="b2c">B2C</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Country</label>
                                    <select id="fki_country_id" name="fki_country_id" class="form-control" disabled>
                                    @foreach($countries as $country)
                                        <option value="{{$country->pki_country_id}}" {{ ( $country->pki_country_id == $project->fki_country_id) ? 'selected' : '' }}>{{$country->country}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="pir">Incidence Rate</label>
                                    <input id="ir" type="text" class="form-control" name="ir" placeholder="Enter Incidence Rate" value="{{$project->ir}}" readonly>
                                </div>
                                <div class="col-sm-4">    
                                    <label>Length of Interview</label>
                                    <input id="loi" type="text" class="form-control" name="loi" placeholder="Enter Length of Interview" value="{{$project->loi}}" readonly>
                                </div>
                                <div class="col-sm-4"> 
                                    <label for="pcpi">CPI</label>
                                    <input id="cpi" type="text" class="form-control" name="cpi" placeholder="Enter CPI" value="{{$project->cpi}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>Completes</h3>
                                </div>
                                <div class="col-sm-4"> 
                                    <label for="prcompletes">Required Completes</label>
                                    <input id="required_completes" type="text" class="form-control" name="required_completes" placeholder="Enter Required Completes" value="{{$project->required_completes}}" readonly>
                                </div>
                                <div class="col-sm-4"> 
                                    <label for="prcompletes">Completes</label>
                                    <input type="text" class="form-control" name="completes" value="{{$project->completes_count}}" readonly>
                                </div>
                                <div class="col-sm-4"> 
                                    <label for="prcompletes">Disqualify</label>
                                    <input type="text" class="form-control" name="completes" value="{{$project->disqualify_count}}" readonly>
                                </div>
                                <div class="col-sm-4"> 
                                    <label for="prcompletes">Quotafull</label>
                                    <input type="text" class="form-control" name="completes" value="{{$project->quota_full_count}}" readonly>
                                </div>
                                <div class="col-sm-4"> 
                                    <label for="prcompletes">Quality Term</label>
                                    <input type="text" class="form-control" name="completes" value="{{$project->quality_term_count}}" readonly>
                                </div>
                                <div class="col-sm-4"> 
                                    <label for="prcompletes">Total Hits</label>
                                    <input type="text" class="form-control" name="hits" value="{{$project->hits}}" readonly>
                                </div>
                                <!-- <div class="col-sm-3"> 
                                    <label for="prcompletes">In Survey</label>
                                    <input type="text" class="form-control" name="in_survey">
                                </div> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>Survey Links</h3>
                                </div>
                                <div class="col-sm-12">
                                    <label for="psurveyl">Live Survey Link</label>
                                    <input id="client_survey_url" type="text" class="form-control" name="client_survey_url" value="{{$project->client_survey_url}}" placeholder="Enter Survey Link" readonly>
                                </div>
                                <div class="col-sm-12">
                                    <label for="psurveyl">Test Survey Link</label>
                                    <input id="test_survey_url" type="text" class="form-control" name="client_survey_url" value="{{$project->client_survey_url}}" placeholder="Enter Survey Link" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>Redirects</h3>
                                </div>
                                <div class="col-sm-12">
                                    <label for="pcompletel">Complete</label>
                                    <input type="text" class="form-control" name="complete_url" value="{{$project->complete_url}}" placeholder="Enter Survey Complete Redirect" readonly>
                                </div>
                                <div class="col-sm-12">
                                    <label for="psurveyl">Disqualify</label>
                                    <input type="text" class="form-control" name="disqualify_url" value="{{$project->disqualify_url}}" placeholder="Enter Disqualify Redirect" readonly>
                                </div>
                                <div class="col-sm-12">
                                    <label for="pquotal">Quotafull</label>
                                    <input type="text" class="form-control" name="quotafull_url" value="{{$project->quotafull_url}}" placeholder="Enter Quotafull Redirect" readonly>
                                </div>
                                <div class="col-sm-12">
                                    <label for="pqualityl">Quality Team</label>
                                    <input type="text" class="form-control" name="quality_url" value="{{$project->quality_term_url}}" placeholder="Enter Quality Team Redirect" readonly>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="pki_project_id" value="{{$project->pki_project_id}}"/>
                        <button id="psubmit" type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div id="vendordetails" class="table-outer bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table id="vdTable" class="table">
                    <div class="bg-custom">
                        <thead>
                            <tr>
                                <th scope="col">Vendor</th>
                                <th scope="col">Project</th>
                                <th scope="col">CPI</th>
                                <th scope="col">LOI</th>
                                <th scope="col">IR</th>
                                <th scope="col">Completes</th>
                                <th scope="col">Survey Link</th>
                                <th class="span-cols v-span-cols">Status</th>
                                <th class="span-cols v-span-cols">Actions</th> 
                            </tr>
                        </thead>
                    </div>
                    <tbody>
                    @if($vendordetails)
                        @foreach($vendordetails as $index => $vendordetail)
                            <tr>
                                <td>{{$vendordetail->vendor}}</td>
                                <td>
                                    {{$vendordetail->project_name}}
                                </td>
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
                                <td>
                                    {{$vendordetail->cpi}}
                                </td>
                                <td>
                                    {{$vendordetail->completes_count}}/{{$vendordetail->required_completes}}
                                </td>
                                <td>
                                    <div class="copy-url-cont">
                                        <button class="btn btn-primary" onclick="copySurveyUrl('surveyUrl{{$vendordetail->pki_vendordetail_id}}')">Copy Link</button>
                                        <input id="surveyUrl{{$vendordetail->pki_vendordetail_id}}" class="input-copy" type="text" value="{{$vendordetail->survey_url}}" aria-hidden="true">
                                        <span id="flash_surveyUrl{{$vendordetail->pki_vendordetail_id}}" class="flash-copy">Survey link copied successfully!</span>
                                    </div>
                                </td>
                                <td class="span-cols v-span-cols">
                                    <select class="vproject-status project-status" data-id="{{$vendordetail->pki_vendordetail_id}}">
                                        @foreach($projectstatuses as $status)
                                            <option value="{{$status->pki_projectstatus_id}}" {{ ( $status->pki_projectstatus_id == $vendordetail->fki_projectstatus_id) ? 'selected' : '' }}>{{$status->status}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="span-cols v-span-cols">
                                    <button class="btn btn-custom-view vendordetail-id" data-vendordetailid="{{$vendordetail->pki_vendordetail_id}}">View</button>
                                    <a href="{{route('vendordetails.edit', $vendordetail->pki_vendordetail_id)}}" class="btn btn-custom-edit" title="Click to edit vendor details">Edit</a>
                                    <!-- <form method="POST" action="{{route('vendordetails.remove')}}">
                                        @csrf
                                        <input type="hidden" name="vendordetail_id" value="{{$vendordetail->pki_vendordetail_id}}">
                                        <input type="submit" class="btn btn-danger" value="Remove" onclick="alert('Are you sure you want to remove this project?')">
                                    </form> -->
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div id="addVendorDetailModal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Vendor</h5>
                    <button id="close-vendordetail-btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('vendordetails.store')}}">
                    @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Vendor</label>
                                    <select class="form-control" name="fki_vendor_id">
                                        @foreach($vendors as $vendor)
                                            <option value="{{$vendor->pki_vendor_id}}">{{$vendor->vendor}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">    
                                <div class="col-sm-6">
                                    <label>CPI</label>
                                    <input type="text" name="cpi" class="form-control" required>
                                </div>
                                <div class="col-sm-6">
                                    <label>Required Completes/Hits</label>
                                    <input type="text" name="required_completes" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="radio" class="form-check" name="survey_check" value="0">
                                <label>Hits</label>
                                <input type="radio" class="form-check" name="survey_check" value="1">
                                <label>Complete</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="fki_project_id" value="{{$project->pki_project_id}}" />
                            <button type="submit" name="submit" value="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>    
                </div>
            </div>
        </div>
    </div>
    <div id="vendorDetailModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Vendor Details - <span id="vhead-id"></span></h5>
                <button id="vclose-detail-btn" type="button" class="close modal-custom-btn" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="vdetails-outer">
                    
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.vendordetail-id').on('click', function() {
            var vendordetailId = $(this).attr('data-vendordetailid');
            $('#vdetails-outer').html('');
            $.ajax({
                url: '{{ url('api/vendor').'/' }}' + vendordetailId
            }).done(function (response) {
                console.log(response);
                var html = '<p><strong>Project</strong> - '+response.data.project_name+'</p><p><strong>CPI</strong> - ' + response.data.cpi + '</p><p><strong>Required Completes</strong> - '+response.data.required_completes+'</p><p><strong>Completes</strong> - '+response.data.completes_count+'</p><p><strong>Survey Url</strong> - '+response.data.survey_url+'</p><p><strong>Complete Url</strong> - '+response.data.complete_url+'</p><p><strong>Disqualify Url</strong> - '+response.data.disqualify_url+'</p><p><strong>Quotafull Url</strong> - '+response.data.quotafull_url+'</p><p><strong>Quality Term Url</strong> - '+response.data.quality_term_url+'</p>';
                $('#head-id').append(response.data.pki_project_id);
                $('#vendorDetailModal').show();
                $('#vdetails-outer').html(html);
            });
        });
        $('#vclose-detail-btn').on('click', function() {
            $('#vendorDetailModal').hide();
        });


        $('.vproject-status').on('change', function() {
            var vendordetailId = $(this).attr('data-id');
            var status = $(this).val();
            $.ajax({
                type:'POST',
                url: '{{ url('api/vendorDetail/updateStatus').'/' }}' + vendordetailId,
                data:{fki_projectstatus_id:status},
                success:function(data){
                    console.log(data);
                }
            });
        });

        if (window.location.hash == '#vendordetails') {
            $('#projectdetails').removeClass('active');
            $('#project-btn-panel').hide();
            $('#vendor-btn-panel').show();
            $('#vendordetails').addClass('active');
        }

        function copySurveyUrl(id) {
            /* Get the text field */
            var copySurveyUrl = document.getElementById(id);
            var flash = document.getElementById('flash_'+id);
            copySurveyUrl.focus();
            /* Select the text field */
            copySurveyUrl.select();
            copySurveyUrl.setSelectionRange(0, 99999);
            /* Copy the text inside the text field */
            document.execCommand("copy");
            flash.style.visibility = "visible";
            flash.style.opacity = 1;

            setTimeout(function(){
                flash.style.visibility = "hidden";
                flash.style.opacity = 0;
            }, 3000 );
        }
    </script>
</x-app-layout>