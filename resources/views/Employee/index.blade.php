<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form | Html</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/icon/fb.ico">
    <!-- all css start -->
    <link href="./assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="./assets/css/style.css" type="text/css" rel="stylesheet" />
    <link href="./assets/css/responsive.css" type="text/css" rel="stylesheet" />
    <!-- all css end -->
</head>

<body>

    <!-- form start -->
    <section class="fomr-controls py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Employees</h2>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('employee.create') }}"> Create New Employee</a>
                    </div>
                </div>
            </div>

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <div class="row">
                <div class="col-12 mt-5">
                    <div class="table-responsive custom-table">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>

                                    </th>
                                    <th>
                                        first name
                                    </th>
                                    <th>
                                        first name
                                    </th>
                                    <th>
                                        email address
                                    </th>

                                    <th>
                                        birth date
                                    </th>
                                    <th>
                                        current address
                                    </th>
                                    <th>
                                        permanent address
                                    </th>
                                    <th>
                                        role
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                <tr>
                                    <td>
                                        <div class="profile-img">
                                            <img src="{{ url('images/profile/'. $employee['profile_image_name']) }}" class="img-fluid w-100 h-100" alt="">
                                        </div>
                                    </td>
                                    <td>
                                        {{ $employee['first_name']}}
                                    </td>
                                    <td>
                                        {{ $employee['last_name'] }}
                                    </td>
                                    <td>
                                        {{ $employee['email'] }}
                                    </td>

                                    <td>
                                        {{ $employee['date_of_birth'] }}
                                    </td>
                                    <td>
                                        {{ $employee['current_address'] }}
                                    </td>
                                        @if(isset($employee['pAddress']) && $employee['pAddress'] != null )
                                            <td> {{ $employee['pAddress'] }} </td>
                                        @else
                                            <td> - </td>
                                        @endif
                                    <td>
                                        @if(isset($employee['roles']) && !empty($employee['roles']))
                                        @foreach ($employee['roles'] as $role)
                                           - {{ $role['guard_name'] }} </br>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="cursor-pointer">
                                                <a class="btn btn-primary" href="{{ route('employee.edit', $employee['id']) }}">Edit</a>
                                            </div>
                                            <form method="post" action="{{route('employee.destroy',$employee['id'])}}">
                                                @method('delete')
                                                @csrf
                                                <div class="cursor-pointer">

                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>

                                                </div>

                                            </form>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- form end -->
    <!-- all scripts start -->
    <script src="./assets/js/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/custom.js"></script>
    <!-- all scripts end -->
</body>

</html>
