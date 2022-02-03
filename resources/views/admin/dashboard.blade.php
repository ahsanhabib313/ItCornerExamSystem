@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="border mt-3 admin-panel-shadow">
        <div class="text-secondary fw-bold admin-panel-heading pt-3 pb-3 bg-lisht">
            <div class="row">
                <div id="success" class="col-lg-12 text-center">
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif
                </div>
                <div class="col-lg-12 text-center">
                    Welcome To Admin Dashboard
                </div>
            </div>
        </div>
    </div>
</div>
@endsection