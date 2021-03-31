<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="btn-panel">
                <button id="addVendor" class="btn btn-primary">Add Vendor</button>
            </div>
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
                                    <input type="text" class="form-control" value="{{$project->pki_project_id}}" readonly>
                                </div>
                                <div class="col-sm-4"> 
                                    <label>Project Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$project->name}}">
                                </div>
                                <div class="col-sm-4">
                                    <label>Subject</label>
                                    <input type="text" class="form-control" value="{{$project->subject}}" readonly>
                                </div>
                                <div class="col-sm-4"> 
                                    <label>Client</label>
                                    <select class="form-control" name="fki_client_id" readonly>
                                        @foreach($clients as $client)
                                            <option value="{{$client->fki_client_id}}" {{ ( $client->pki_client_id == $project->fki_client_id) ? 'selected' : '' }}>{{$client->client}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Type</label>
                                    <select name="type" class="form-control">
                                        <option value="b2b">B2B</option>
                                        <option value="b2c">B2C</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label>Country</label>
                                    <select name="fki_country_id" class="form-control">
                                    @foreach($countries as $country)
                                        <option value="{{$country->pki_country_id}}">{{$country->country}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <label for="pir">Incidence Rate</label>
                                    <input type="text" class="form-control" name="ir" placeholder="Enter Incidence Rate" value="{{$project->ir}}">
                                </div>
                                <div class="col-sm-4">    
                                    <label>Length of Interview</label>
                                    <input type="text" class="form-control" name="loi" placeholder="Enter Length of Interview" value="{{$project->loi}}">
                                </div>
                                <div class="col-sm-4"> 
                                    <label for="pcpi">CPI</label>
                                    <input type="text" class="form-control" name="cpi" placeholder="Enter CPI" value="{{$project->cpi}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>Completes</h3>
                                </div>
                                <div class="col-sm-3"> 
                                    <label for="prcompletes">Required Completes</label>
                                    <input type="text" class="form-control" name="required_completes" placeholder="Enter Required Completes" value="{{$project->required_completes}}">
                                </div>
                                <div class="col-sm-3"> 
                                    <label for="prcompletes">Completes</label>
                                    <input type="text" class="form-control" name="completes" value="{{$project->complete_count}}">
                                </div>
                                <div class="col-sm-3"> 
                                    <label for="prcompletes">Total Hits</label>
                                    <input type="text" class="form-control" name="hits" value="{{$project->hits}}">
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
                                    <label for="psurveyl">Client Survey Link</label>
                                    <input type="text" class="form-control" name="client_survey_url" value="{{$project->client_survey_url}}" placeholder="Enter Survey Link">
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
                                    <input type="text" class="form-control" name="complete_url" value="{{$project->complete_url}}" placeholder="Enter Survey Complete Redirect">
                                </div>
                                <div class="col-sm-12">
                                    <label for="psurveyl">Disqualify</label>
                                    <input type="text" class="form-control" name="disqualify_url" value="{{$project->disqualify_url}}" placeholder="Enter Disqualify Redirect ">
                                </div>
                                <div class="col-sm-12">
                                    <label for="pquotal">Quotafull</label>
                                    <input type="text" class="form-control" name="quotafull_url" value="{{$project->quotafull_url}}" placeholder="Enter Quotafull Redirect">
                                </div>
                                <div class="col-sm-12">
                                    <label for="pqualityl">Quality Team</label>
                                    <input type="text" class="form-control" name="quality_url" value="{{$project->quality_term_url}}" placeholder="Enter Quality Team Redirect">
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="pki_project_id" value="{{$project->pki_project_id}}"/>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="vendorModal" class="modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Vendor</h5>
                        <button id="close-vendor-btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                        <input type="text" name="vendor" class="form-control">
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
                                        <label>Required Completes</label>
                                        <input type="text" name="required_completes" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Complete Url</label>
                                        <input type="text" name="complete_url" class="form-control" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <label>Disqualify Url</label>
                                        <input type="text" name="disqualify_url" class="form-control" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <label>Quotafull Url</label>
                                        <input type="text" name="quotafull_url" class="form-control" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <label>Quality Term Url</label>
                                        <input type="text" name="qualityterm_url" class="form-control" required>
                                    </div>
                                </div>
                            </div> -->
                            <div class="modal-footer">
                                <input type="hidden" name="fki_project_id" value="{{$project->pki_project_id}}" />
                                <button type="submit" name="submit" value="submit" class="btn btn-primary">Save</button>
                                <button id="close-vendor-bottom" type="button" class="btn btn-secondary close-btn-bottom" data-dismiss="modal">Close</button>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>