<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl custom-nav-head leading-tight">
        <i class="fa fa-user"></i>{{ __('Users') }}
        </h2>
        <div class="btn-panel">
            <span id="addUser">Add User</span>
        </div>
    </x-slot>

    <div class="container-fluid">
        <div class="table-outer bg-white overflow-hidden shadow-sm sm:rounded-lg vendordetails-outer">
            <div class="p-6 bg-white border-b border-gray-200">
                <table id="cTable" class="table">
                    <div class="bg-custom">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                    </div>
                    <tbody>
                    @if($users)
                        @foreach($users as $user)
                            @if($user->fki_role_id != 1)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td class="span-cols">
                                    <a href="{{route('managers.edit', $user->pki_user_id)}}" class="btn btn-custom-edit">Edit</a>
                                    <form method="POST" action="{{route('managers.remove')}}">
                                        @csrf
                                        <input type="hidden" name="pki_user_id" value="{{$user->pki_user_id}}">
                                        <input type="submit" class="btn btn-danger" value="Remove" onclick="alert('Are you sure you want to remove this user?')">
                                    </form>
                                </td>
                            </tr>
                            @endif
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>    
    </div>
    <div id="userModal" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button id="close-user-btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('managers.store')}}">
                @csrf
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">    
                            <div class="col-sm-12">
                                <label>Email/Username</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">    
                            <div class="col-sm-12">
                                <label>Password</label>
                                <input type="email" name="password" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submit" value="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>
</x-app-layout>
