@extends('Role.layout')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Role</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('role.index') }}"> Back</a>
        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


    <form class="mx-auto" enctype="multipart/form-data" action="{{ route('employee.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>First Name: </label>
            <input type="text" name="" class="form-control custom-input" placeholder="Enter first name" />
        </div>
        <div class="form-group">
            <label> Last Name: </label>
            <input type="text" name="" class="form-control custom-input" placeholder="Enter last name" />
        </div>
        <div class="form-group">

            <label> Email: </label>
            <input type="email" name="" class="form-control custom-input" placeholder="Enter email address" />
        </div>
        <div class="form-group">
            <label> Profile Image: </label>
            <input class="form-control form-control-lg" id="formFileLg" type="file" accept="image/*"
                placeholder="Profile image">
        </div>
        <div class="form-group">

            <label> Date Of Birth: </label>
            <input type="date" name="" class="form-control custom-input" placeholder="Enter birth date" />
        </div>
        <div class="form-group">
            <label> Current Address: </label>
            <textarea class="form-control custom-input custom-textarea" placeholder="Enter current address"></textarea>
        </div>

        <div class="form-group">
            <input class="form-check-input" type="checkbox" onchange="getValueCheckbox(this.checked)" />
            permenant address same as current address
        </div>
        <div class="form-group">
            <label> Permenant Address: </label>
            <textarea id="paddress" class="form-control custom-input custom-textarea"
                placeholder="Enter permenant address"></textarea>
        </div>
        <div class="form-group">
            <label> Role:</label>

            <select multiple="multiple" placeholder="Hello  im from placeholder" class=" search-box-open-up" required>
                <option selected value="volvo">Volvo</option>
                <option value="saab">Saab</option>
                <option value="mercedes">Mercedes</option>
                <option value="audi">Audi</option>
                <option value="bmw">BMW</option>
            </select>
        </div>
        <button class="form-control primary-btn">Submit</button>

</form>
@endsection
