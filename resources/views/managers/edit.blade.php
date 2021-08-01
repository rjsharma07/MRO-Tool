<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl custom-nav-head leading-tight">
        <i class="fa fa-edit"></i>{{ __('Edit User') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="project-form">
                <form method="POST" action="{{route('managers.update')}}">
                @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4"> 
                                <label>Name</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}">
                            </div>
                            <div class="col-sm-4"> 
                                <label>Email/Username</label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="pki_user_id" value="{{$user->pki_user_id}}">
                    <button id="submit" type="submit" name="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>