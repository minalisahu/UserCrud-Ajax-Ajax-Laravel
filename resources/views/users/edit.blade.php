@extends('layouts.app')

@section('content')


<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header py-3">
                <h4 class="m-0 font-weight-bold text-primary float-left">{{__('Edit User')}} :: {{$user->name ??''}}</h4>
                <div class="action-button float-right">
                    <a href="{{route('home')}}" class="btn btn-sm btn-dark"><i class="fa fa-list">{{__('List')}}</i></a>
                </div>
            </div>
            <form action="javascript:void(0);" id="editUser" enctype="multipart/form-data">
            @method('PUT')
                <div class="card-body">
                    @csrf
                    @include ('users.form', ['user' => $user])
                </div>
                <div class="card-footer text-right p-2">
                    <button class="btn btn-primary"  onclick="updateUser('{{csrf_token()}}','{{route('user.update')}}','{{$user->id}}')">{{__('Update')}}</button>
                </div>
            </form>


        </div>
    </div>
</div>
@endsection

