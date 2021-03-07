<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Currencies') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="project-form">
                <form method="POST" action="{{route('currencies.store')}}">
                @csrf
                    <div class="form-group">
                        <div class="col-sm-6"> 
                            <label>Currency</label>
                            <input type="text" class="form-control" name="currency" placeholder="Enter Currency" required>
                        </div>
                        <div class="col-sm-6"> 
                            <label>Value</label>
                            <input type="text" class="form-control" name="cvalue" placeholder="Enter Current Value" required>
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