<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vendor Details') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="btn-panel">
                <a class="btn btn-primary" href="{{route('vendordetails.edit', $vendor->pki_vendordetail_id)}}">Edit Vendor</a>
            </div>
            <div class="project-form">
                <form method="POST" action="{{route('vendordetails.update')}}">
                @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6"> 
                                <label>Vendor Name</label>
                                <input type="text" readonly class="form-control" name="vendor" value="{{$vendor->vendor}}">
                            </div>
                            <div class="col-sm-6"> 
                                <label>Project</label>
                                <input type="text" class="form-control" name="v_project" value="{{$project->name}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4"> 
                                <label>CPI</label>
                                <input type="text" readonly  class="form-control" name="cpi" value="{{$vendor->cpi}}">
                            </div>
                            <div class="col-sm-4"> 
                                <label>Required Completes</label>
                                <input type="text" class="form-control" name="required_completes" value="{{$vendor->required_completes}}" readonly>
                            </div>
                            <div class="col-sm-4"> 
                                <label>Completes</label>
                                <input type="text" class="form-control" name="completes" value="{{$vendor->completes}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-8"> 
                                <label>Survey Link</label>
                                <input type="text" readonly class="form-control" name="survey_url" value="{{$vendor->survey_url}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-8"> 
                                <label>Complete Url</label>
                                <input type="text" readonly  class="form-control" name="complete_url" placeholder="Enter Complete Url" value="{{$vendor->complete_url}}">
                            </div>
                            <div class="col-sm-8"> 
                                <label>Disqualify Url</label>
                                <input type="text" readonly class="form-control" name="disqualify_url" placeholder="Enter Disqualify Url" value="{{$vendor->disqualify_url}}">
                            </div>
                            <div class="col-sm-8"> 
                                <label>Quotafull Url</label>
                                <input type="text" readonly class="form-control" name="quotafull_url" placeholder="Enter Quotafull Url" value="{{$vendor->quotafull_url}}">
                            </div>
                            <div class="col-sm-8"> 
                                <label>Quality Term Url</label>
                                <input type="text" readonly class="form-control" name="quality_term_url" placeholder="Enter Quality Term Url" value="{{$vendor->quality_term_url}}">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="vendordetail_id" value="{{$vendor->pki_vendordetail_id}}">
                </form>
            </div>
        </div>
    </div>
</x-app-layout>