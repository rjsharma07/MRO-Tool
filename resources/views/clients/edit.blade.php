<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl custom-nav-head leading-tight">
        <i class="fa fa-edit"></i>{{ __('Edit Client') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="project-form">
                <form method="POST" action="{{route('clients.update')}}">
                @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4"> 
                                <label>Client Name</label>
                                <input id="client" type="text" class="form-control" name="client" value="{{$client->client}}">
                            </div>
                            <div class="col-sm-4"> 
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{$client->email}}">
                            </div>
                            <div class="col-sm-4"> 
                                <label>Phone</label>
                                <input id="phone" type="text" class="form-control" name="phone" value="{{$client->phone}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-8"> 
                                <label>Address</label>
                                <textarea class="form-control" name="address" rows="5">{{$client->billing_address}}</textarea>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="pki_client_id" value="{{$client->pki_client_id}}">
                    <button id="submit" type="submit" name="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>