@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary float-left">{{__('New User')}}</h4>
                <div class="action-button float-right">
                    <a href="{{route('home')}}" class="btn btn-sm btn-dark"><i class="fa fa-list">{{__('List')}}</i></a>
                </div>
            </div>
            <form action="javascript:void(0);" id="addNewUser" enctype="multipart/form-data">
               <div class="alert alert-danger d-none"></div>
                <div class="card-body">
                    @csrf
                    @include ('users.form', ['user' => null])
                </div>
                <div class="card-footer text-right p-2">
                    <button class="btn btn-primary"  onclick="storeUser('{{csrf_token()}}','{{route('user.store')}}')">{{__('Create')}}</button>
                </div>
            </form>


        </div>
    </div>
</div>
@endsection

