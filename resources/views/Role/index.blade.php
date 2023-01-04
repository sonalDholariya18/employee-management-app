@extends('Role.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Roles</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('role.create') }}"> Create New Role</a>
        </div>
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
            <form action="{{ route('role.destroy', $role->id) }}" method="POST">

                {{-- <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a> --}}

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
