<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Country') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="project-form">
                <form method="POST" action="{{route('countries.store')}}">
                @csrf
                    <div class="form-group">
                        <div class="col-sm-6"> 
                            <label>Country</label>
                            <input type="text" class="form-control" name="country" placeholder="Enter Country" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label>Language</label>
                            <input type="text" class="form-control" name="language" placeholder="Enter Language">
                        </div>
                        <div class="col-sm-6">
                            <label>Currency</label>
                            <input type="text" class="form-control" placeholder="Enter Currency">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>