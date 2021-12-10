@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary float-left">{{__('Users')}}</h4>
                    <div class="action-button float-right">
                       <a href="{{route('user.create')}}" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i>{{__('Add User')}}</a>
                    </div>
                </div>
                <div class="card-body  p-1">
                    @if (session('success_message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success_message') }}
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered mb-0" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Birth')}}</th>
                                    <th>{{__('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody id="userListing">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</div>
<script>
fetchData();

function fetchData() {
    var xml = new XMLHttpRequest();
    xml.onreadystatechange = function() {
        if (this.status == 200 && this.readyState == 4) {
            var output = this.response;

            if (output) {
                var data = JSON.parse(output);
                console.log(data);
                viewData(data['data']);
            } else {
                alert("Fail to upload");
            }
        }
    };
    xml.open('GET', 'user-list', true);
    xml.send();
}

function viewData(data) {
    var s = ``;
    var options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    if (data.length > 0) {
        for (var i in data) {
            var d = new Date(data[i]['created_at']);
            var id = data[i]['id'];
            s += "<tr>";
            s += "<td>" + data[i]['name'] + "</td>";
            s += "<td>" + data[i]['email'] + "</td>";
            s += "<td>" + d.toLocaleDateString("en-IN", options) + "</td>";
            s += `<td> 
                   <a href="javascript:void(0);" onclick='show(`+JSON.stringify(data[i])+`)' class="btn btn-sm btn-warning">Show</a>
                    <a href="`+id+`/edit" class="btn btn-sm btn-primary">Edit</a>
                    <a href="`+id+`/delete" onclick="return confirm('are you sure to delete?')" class="btn btn-sm btn-danger">Delete</a>
                </td>`;
            s += "</tr>";
        }
    }
    document.getElementById('userListing').innerHTML = s;
}
</script>
@endsection