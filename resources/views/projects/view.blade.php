<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Project') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="project-form">
                <form>
                    <div class="row">
                        <div class="col-sm-6"> 
                            <label for="pname">Project Name</label>
                            <input type="text" class="form-control" id="pname" aria-describedby="projectNameHelp" value="{{$project->name}}" placeholder="Enter Project Name">
                        </div>
                        <div class="col-sm-6"> 
                            <label for="pclient">Client</label>
                            <input type="text" class="form-control" id="pclient" value="{{$project->client}}" placeholder="Enter Client">
                        </div>
                    </div>
                    <div class="row p-ud-15">
                        <div class="col-sm-12">
                            <label for="pdescription">Description</label>
                            <input type="text" class="form-control" id="pdescription" value="{{$project->description}}" placeholder="Enter Project Description">
                        </div>
                    </div>
                    <div class="row p-ud-15">
                        <div class="col-sm-6">
                            <label for="pir">Incidence Rate</label>
                            <input type="text" class="form-control" id="pir" value="{{$project->ir}}" placeholder="Enter Incidence Rate">
                        </div>
                        <div class="col-sm-6">    
                            <label for="client">Length of Interview</label>
                            <input type="text" class="form-control" id="ploi" value="{{$project->loi}}" placeholder="Enter Length of Interview">
                        </div>
                    </div>
                    <div class="row p-ud-15">
                        <div class="col-sm-6"> 
                            <label for="pcpi">CPI</label>
                            <input type="text" class="form-control" id="pcpi" value="{{$project->cpi}}" placeholder="Enter CPI">
                        </div>
                        <div class="col-sm-6"> 
                            <label for="prcompletes">Required Completes</label>
                            <input type="text" class="form-control" id="prcompletes" value="{{$project->required_completes}}" placeholder="Enter Required Completes">
                        </div>
                    </div>
                    <div class="row p-ud-15">
                        <div class="col-sm-6">
                            <label for="ptype">Type</label>
                            <select id="ptype" name="ptype" selected="{{$project->type}}" class="form-control">
                                <option value="b2b">B2B</option>
                                <option value="b2c">B2C</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="pcurrency">Type</label>
                            <select id="pcurrency" name="pcurrency" selected="{{$project->currency}}" class="form-control">
                                <option value="gbp">GBP</option>
                                <option value="usd">USD</option>
                                <option value="rupees">RUPEES</option>
                            </select>
                        </div>
                    </div>
                    <div class="row p-ud-15">
                        <div class="col-sm-12">
                            <label for="psurveyl">Survey Link</label>
                            <input type="text" class="form-control" id="psurveyl" placeholder="Enter Survey Link">
                        </div>
                    </div>
                    <div class="redirects">
                        <h3>Redirects</h3>
                        <div class="row p-ud-15">
                            <div class="col-sm-12">
                                <label for="pcompletel">Complete</label>
                                <input type="text" class="form-control" id="pcompletel" placeholder="Enter Survey Complete Redirect">
                            </div>
                        </div>
                        <div class="row p-ud-15">
                            <div class="col-sm-12">
                                <label for="psurveyl">Disqualify</label>
                                <input type="text" class="form-control" id="psurveyl" placeholder="Enter Disqualify Redirect ">
                            </div>
                        </div>
                        <div class="row p-ud-15">
                            <div class="col-sm-12">
                                <label for="pquotal">Quotafull</label>
                                <input type="text" class="form-control" id="pquotal" placeholder="Enter Quotafull Redirect">
                            </div>
                        </div>
                        <div class="row p-ud-15">
                            <div class="col-sm-12">
                                <label for="pqualityl">Quality Team</label>
                                <input type="text" class="form-control" id="pqualityl" placeholder="Enter Quality Team Redirect">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-check p-ud-15">
                        <input type="checkbox" class="form-check-input" id="psecurity">
                        <label class="form-check-label" for="psecurity">Security</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Project</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>