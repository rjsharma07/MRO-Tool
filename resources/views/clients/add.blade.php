<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Client') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="project-form">
                <form method="POST" action="{{route('clients.store')}}">
                @csrf
                    <div class="form-group">
                        <div class="col-sm-6"> 
                            <label>Client Name</label>
                            <input type="text" class="form-control" name="client" placeholder="Enter Client Name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <label>Country</label>
                            <input type="text" class="form-control" name="country" placeholder="Enter Country">
                        </div>
                        <div class="col-sm-6">
                            <label for="pir">Currency</label>
                            <input type="text" class="form-control" id="pir" placeholder="Enter Incidence Rate">
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
                    <button type="submit" name="submit" class="btn btn-primary">Save Project</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>