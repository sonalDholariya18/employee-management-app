<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form | Html</title>
    <link rel="icon" type="image/x-icon" href="../../assets/images/icon/fb.ico">
    <!-- all css start -->
    <link href="../../assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="../../assets/css/style.css" type="text/css" rel="stylesheet" />
    <link href="../../assets/css/responsive.css" type="text/css" rel="stylesheet" />

    <link href="../../assets/css/sumoselect.min.css" type="text/css" rel="stylesheet" />
    <!-- all css end -->
</head>

<body>
    <!-- form start -->
    <section class="fomr-controls py-5">
        <div class="container">
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
            <div class="row">
                <div class="col-12">
                    <form class="mx-auto" enctype="multipart/form-data" action="{{ route('employee.update' , $employee->id) }}"
                        method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label>First Name: </label>
                            <input type="text" name="first_name" class="form-control custom-input"
                                placeholder="Enter first name" value="{{ $employee->first_name }}" />
                        </div>
                        <div class="form-group">
                            <label> Last Name: </label>
                            <input type="text" name="last_name" class="form-control custom-input"
                                placeholder="Enter last name" value="{{ $employee->last_name }}" />
                        </div>
                        <div class="form-group">

                            <label> Email: </label>
                            <input type="email" name="email" class="form-control custom-input"
                                placeholder="Enter email address" value="{{ $employee->email }}" />
                        </div>
                        <div class="form-group">
                            <label> Profile Image: </label>
                            <div class="profile-img">
                                <img src="{{ url('images/profile/'. $employee['profile_image_name']) }}" class="img-fluid w-100 h-100">
</div>
                            <input class="form-control form-control-lg" id="formFileLg" type="file" accept="image/*"
                                placeholder="Profile image" name="profile_image_name">

                        </div>
                        <div class="form-group">

                            <label> Date Of Birth: </label>
                            <input type="date" class="form-control custom-input" placeholder="Enter birth date"
                                name="date_of_birth" value="{{ $employee->date_of_birth }}"/>
                        </div>
                        <div class="form-group">
                            <label> Current Address: </label>
                            <textarea class="form-control custom-input custom-textarea"
                                placeholder="Enter current address" name="current_address">{{ $employee->current_address }}</textarea>
                        </div>

                        <div class="form-group">
                            <input class="form-check-input" type="checkbox" onchange="getValueCheckbox(this.checked)"
                                name="is_same_add" @if($employee->is_same_address == 1) checked @endif/>
                            permenant address same as current address
                        </div>
                        <div class="form-group">
                            <label> Permenant Address: </label>
                            <textarea id="paddress" class="form-control custom-input custom-textarea"
                                placeholder="Enter permenant address" name="p_address" >@if($employee->is_same_add == 0 && !empty($permanentAddress)) {{ $permanentAddress['address'] }} @endif</textarea>
                        </div>
                        <div class="form-group">
                            <label> Role:</label>

                            <select multiple="multiple" placeholder="Hello  im from placeholder"
                                class=" search-box-open-up" name="roles[]" required>
                                {{-- <option value="" selected>Select Role</option> --}}

                                @foreach ($roles as $role)
                                    <option value="{{ $role['id']}}" @if(in_array($role['id'], $empRolesArrKey)) selected @endif>{{ $role['guard_name']}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <button class="form-control primary-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- form end -->
    <!-- all scripts start -->
    <script src="../../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
    <script src="../../assets/js/custom.js"></script>
    <script src="../../assets/js/jquery.sumoselect.min.js"></script>

    <script type="text/javascript">
        // readio change event for address
           function getValueCheckbox(radio){
               if(radio == true){
                   $('#paddress').attr('disabled', 'disabled');
               }else{
                   $('#paddress').removeAttr('disabled');
               }
            }

            $(document).ready(function () {
if($("input[name='is_same_add']").is(':checked')){
    $('#paddress').attr('disabled', 'disabled');
}

                window.searchSelAll = $('.search-box-open-up').SumoSelect({ csvDispCount: 3, selectAll:false, search: false, searchText:'Enter here.', up:true });

            });
    </script>

    <!-- all scripts end -->
</body>

</html>
