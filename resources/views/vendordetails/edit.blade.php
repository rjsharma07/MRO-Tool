<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl custom-nav-head leading-tight">
        <i class="fa fa-edit"></i>{{ __('Edit') }}
        </h2>
        <div class="btn-panel">
            <span id="enableVendorEdit">Enable Editing</span>
            <span id="disableVendorEdit">Disable Editing</span>
        </div>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="project-form">
                <form method="POST" action="{{route('vendordetails.update')}}">
                @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4"> 
                                <label>Vendor Name</label>
                                <input id="vendor" type="text" class="form-control" name="vendor" value="{{$vendor[0]->vendor}}" readonly>
                            </div>
                            <div class="col-sm-4"> 
                                <label>Project</label>
                                <input type="text" class="form-control" name="v_project" value="{{$vendor[0]->project_name}}" readonly>
                            </div>
                            <div class="col-sm-4"> 
                                <label>CPI</label>
                                <input id="v_cpi" type="text" class="form-control" name="cpi" value="{{$vendor[0]->cpi}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3"> 
                                <label>Required Completes</label>
                                <input id="v_required_completes" type="text" class="form-control" name="required_completes" value="{{$vendor[0]->required_completes}}" readonly>
                            </div>
                            <div class="col-sm-2"> 
                                <label>Completes</label>
                                <input type="text" class="form-control" name="completes" value="{{$vendor[0]->completes}}" readonly>
                            </div>
                            <div class="col-sm-2"> 
                                <label>Disqualifies</label>
                                <input type="text" class="form-control" name="completes" value="{{$vendor[0]->disqualify_count}}" readonly>
                            </div>
                            <div class="col-sm-2"> 
                                <label>Quotafulls</label>
                                <input type="text" class="form-control" name="completes" value="{{$vendor[0]->quota_full_count}}" readonly>
                            </div>
                            <div class="col-sm-2"> 
                                <label>Quality Terms</label>
                                <input type="text" class="form-control" name="completes" value="{{$vendor[0]->qulity_term_count}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-8"> 
                                <label>Survey Link</label>
                                <input type="text" class="form-control" name="survey_url" value="{{$vendor[0]->survey_url}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-8"> 
                                <label>Complete Url</label>
                                <input id="v_complete_url" type="text" class="form-control" name="complete_url" placeholder="Enter Complete Url" value="{{$vendor[0]->complete_url}}" readonly>
                            </div>
                            <div class="col-sm-8"> 
                                <label>Disqualify Url</label>
                                <input id="v_disqualify_url" type="text" class="form-control" name="disqualify_url" placeholder="Enter Disqualify Url" value="{{$vendor[0]->disqualify_url}}" readonly>
                            </div>
                            <div class="col-sm-8"> 
                                <label>Quotafull Url</label>
                                <input id="v_quotafull_url" type="text" class="form-control" name="quotafull_url" placeholder="Enter Quotafull Url" value="{{$vendor[0]->quotafull_url}}" readonly>
                            </div>
                            <div class="col-sm-8"> 
                                <label>Quality Term Url</label>
                                <input id="v_quality_term_url" type="text" class="form-control" name="quality_term_url" placeholder="Enter Quality Term Url" value="{{$vendor[0]->quality_term_url}}" readonly>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="vendordetail_id" value="{{$vendor[0]->pki_vendordetail_id}}">
                    <button id="vsubmit" type="submit" name="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>