@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="border mt-3 admin-panel-shadow">
        <div class="text-secondary fw-bold admin-panel-heading pt-3 pb-3 bg-lisht">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                Set New Category
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
        <hr>
        <div class="p-3">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <div class="border p-3">
                        <div class="alert alert-success" style="display:none"></div>
                        <form action="{{route('add-category')}}" method="post" id="add-category-form">
                            @csrf
                            <div class="mb-3">
                                    <div class="form-group">
                                        <label for="category" class="form-label">Category Name</label>
                                        <input type="text" name="name" id="category" class="form-control">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <!-- <input type="submit" value="Save Question" class="btn btn-primary float-right"> -->
                                    <button type="submit" id="btn-add-category" class="btn btn-primary float-right">Save Category</button>
                                    <div class="clearfix"></div>
                                </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </div>
    </div>
</div>
@endsection