<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Crud Generator</title>
    <style>
        .button_style{
            display: flex;
            align-items: center;
            justify-content: space-between
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-6 col-md-12" style="margin-top: 80px;">
                <div class="card">
                    <div class="card-header button_style">
                        <h3 class="card-title">Employee Lists</h3>
                        <a href="{{ route('employee.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add New</a>
                    </div>
                    <div class="card-body">
                      <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>#Sl</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Actione</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->id }}</td>
                                    <td>{{ $employee->name }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>{{ $employee->phone }}</td>
                                    <td>{{ $employee->address }}</td>
                                    <td>
                                        <a href="{{ route('employee.edit', ['id' => $employee->id]) }}" class="btn btn-info">Edit</a>
                                        <a rel="{{ $employee->id }}" rel1="employee/destroy" href="javascript:" style='margin-right: 5px' class="btn btn-sm btn-danger deleteRecord">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" style="text-align: center">No Data Found</td>
                                    </tr>
                                @endforelse
                               
                            </tbody>
                      </table>
                    </div>
                  </div>
            </div>
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <script>
        $(document).on('click','.deleteRecord', function(e){
            e.preventDefault();
            var id = $(this).attr('rel');
            var deleteFunction = $(this).attr('rel1');
            swal({
                    title: "Are You Sure?",
                    text: "You will not be able to recover this record again",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, Delete It"
                },
                function(){
                    $.ajax({
                        type: "delete",
                        url: deleteFunction+'/'+id,
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: {id:id},
                        success: function (data) {
    
                            if(data.flash_message_success) {
                                $('#success_message').html('<div class="alert alert-success">\n' +
                                    '<button class="close" data-dismiss="alert">×</button>\n' +
                                    '<strong>Success! '+data.flash_message_success+'</strong> ' +
                                    '</div>');
                            }

                            location.reload();
                        }
                    });
                });
        });
    </script>
</body>
</html>