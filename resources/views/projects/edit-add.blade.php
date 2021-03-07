<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="project-form">
                <div class="col-md-12">
                    <form>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6"> 
                                    <label>Project Name</label>
                                    <input type="text" class="form-control" name="name" aria-describedby="projectNameHelp" value="{{$project->name}}" readonly>
                                </div>
                                <div class="col-sm-6"> 
                                    <select name="fki_client_id" readonly>
                                        @foreach($clients as $client)
                                        <option value="{{$client->fki_client_id}}" {{ ( $client->pki_client_id == $project->fki_client_id) ? 'selected' : '' }}>{{$client->client}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Subject</label>
                                    <input type="text" class="form-control" value="{{$project->subject}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="pir">Incidence Rate</label>
                                    <input type="text" class="form-control" name="ir" placeholder="Enter Incidence Rate">
                                </div>
                                <div class="col-sm-6">    
                                    <label>Length of Interview</label>
                                    <input type="text" class="form-control" name="loi" placeholder="Enter Length of Interview">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6"> 
                                    <label for="pcpi">CPI</label>
                                    <input type="text" class="form-control" name="cpi" placeholder="Enter CPI">
                                </div>
                                <div class="col-sm-6"> 
                                    <label for="prcompletes">Required Completes</label>
                                    <input type="text" class="form-control" name="completes" placeholder="Enter Required Completes">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="ptype">Type</label>
                                    <select id="ptype" name="type" class="form-control">
                                        <option value="b2b">B2B</option>
                                        <option value="b2c">B2C</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <label for="pcurrency">Type</label>
                                    <select id="pcurrency" name="fki_currency_id" class="form-control">
                                    @foreach($currencies as $currency)
                                        <option value="{{$currency->pki_currency_id}}">{{$currency->currency}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="psurveyl">Survey Link</label>
                                <input type="text" class="form-control" name="survey_url" placeholder="Enter Survey Link">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="pcompletel">Complete</label>
                                <input type="text" class="form-control" name="complete_url" placeholder="Enter Survey Complete Redirect">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="psurveyl">Disqualify</label>
                                <input type="text" class="form-control" name="disqualify_url" placeholder="Enter Disqualify Redirect ">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="pquotal">Quotafull</label>
                                <input type="text" class="form-control" name="quotafull_url" placeholder="Enter Quotafull Redirect">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="pqualityl">Quality Team</label>
                                <input type="text" class="form-control" name="quality_url" placeholder="Enter Quality Team Redirect">
                            </div>
                        </div>
                        <!-- <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="security">
                            <label class="form-check-label">Security</label>
                        </div> -->
                        <button type="submit" class="btn btn-primary">Save Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>