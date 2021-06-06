<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl custom-nav-head leading-tight">
        <i class="fa fa-user"></i>{{ __('Vendor Details') }}
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
                                    <th scope="col">Survey Link</th>
                                    <th colspan="2" class="span-cols">Status</th>
                                    <th colspan="2" class="span-cols">Actions</th> 
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
                                    <a href="{{route('projects.edit', $vendordetail->project_id)}}" title="Click to view project">{{$vendordetail->project_name}}</a>
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
                                    <td>
                                        <button class="btn btn-primary" onclick="copySurveyUrl('surveyUrl{{$vendordetail->pki_vendordetail_id}}')">Copy</button>
                                        <input id="surveyUrl{{$vendordetail->pki_vendordetail_id}}" class="input-copy" type="text" value="{{$vendordetail->survey_url}}" aria-hidden="true">
                                    </td>
                                    <td colspan="2" class="span-cols">
                                        <select class="vproject-status project-status" data-id="{{$vendordetail->pki_vendordetail_id}}">
                                            @foreach($projectstatuses as $status)
                                                <option value="{{$status->pki_projectstatus_id}}" {{ ( $status->pki_projectstatus_id == $vendordetail->fki_projectstatus_id) ? 'selected' : '' }}>{{$status->status}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td colspan="2" class="span-cols">
                                        <button class="btn btn-custom-view vendordetail-id" data-vendordetailid="{{$vendordetail->pki_vendordetail_id}}">View</button>
                                        <a href="{{route('vendordetails.edit', $vendordetail->pki_vendordetail_id)}}" class="btn btn-custom-edit" title="Click to edit vendor details">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
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
        </div>
    </div>
    <script>
        $('.vendordetail-id').on('click', function() {
            var vendordetailId = $(this).attr('data-vendordetailid');
            $('#vdetails-outer').html('');
            $.ajax({
                url: '{{ url('api/project').'/' }}' + vendordetailId
            }).done(function (response) {
                var html = '<p>Project - '+response.data.project_name+'</p><p>CPI - ' + response.data.cpi + '</p><p>Required Completes - '+response.data.required_completes+'</p><p>Completes - '+response.data.completes+'</p><p>Survey Url - '+response.data.survey_url+'</p><p>Complete Url - '+response.data.vendor_complete_url+'</p><p>Disqualify Url - '+response.data.vendor_disqualify_url+'</p><p>Quotafull Url - '+response.data.vendor_quotafull_url+'</p><p>Quality Term Url - '+response.data.vendor_quality_term_url+'</p>';
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

        function copySurveyUrl(id) {
            /* Get the text field */
            var copySurveyUrl = document.getElementById(id);
            copySurveyUrl.focus();
            /* Select the text field */
            copySurveyUrl.select();
            copySurveyUrl.setSelectionRange(0, 99999);
            /* Copy the text inside the text field */
            document.execCommand("copy");
        }
    </script>
</x-app-layout>
