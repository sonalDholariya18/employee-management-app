@extends('Role.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="row">
            <div class="pull-left col">
                <h2>Roles</h2>
            </div>
        </div>
        <div class="row">
            <div class="pull-left col ">
                <a class="btn btn-success" href="{{ route('role.create') }}"> Create New Role</a>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('employee.index') }}">Back to Employee</a>
            </div>
        </div><br/>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Name</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($roles as $role)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $role->guard_name }}</td>
        <td>
            {{-- <form action="{{ route('role.destroy', $role->id) }}" method="POST"> --}}
            <form>
                <a class="btn btn-primary" href="{{ route('role.edit',$role->id) }}">Edit</a>
                {{--
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete</button> --}}
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $roles->links() !!}

@endsection
