<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row">

            <div class="col-6 col-md-12" style="margin-top: 80px;">

                <div id="success_message"></div>

                <div id="error_message"></div>

                <div class="card">
                    <div class="card-header button_style">
                        <h3 class="card-title">Employee Update</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" id="employee_edit">
                            @csrf
                            @method('PUT')

                            <input type="hidden" id="employee_id" value="{{ $employee->id }}">

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" value="{{ $employee->name }}" class="form-control" id="name" name="name" placeholder="Enter your name">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email"  value="{{ $employee->email }}" class="form-control" id="email" name="email" placeholder="Enter your email">
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text"  value="{{ $employee->phone }}" class="form-control" id="phone" name="phone" placeholder="Enter your phone">
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" rows="3" name="address"> value="{{ $employee->address }}"</textarea>
                            </div>

                            <div class="form-group text-end">
                                <a href="{{ route('employee') }}" class="btn btn-warning">Back</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                  </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {

            $("#employee_edit").on("submit",function (e) {
                e.preventDefault();

                var employee_id = $("#employee_id").val();

                var formData = new FormData( $("#employee_edit").get(0));

                $.ajax({
                    url : "{{ route('employee.update','') }}/"+employee_id,
                    type: "post",
                    data: formData,
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    cache: false,
                    error: function (err) {
                        if (err.status == 422) {

                            $.each(err.responseJSON.errors, function (i, error) {
                                var el = $(document).find('[name="'+i+'"]');
                                el.after($('<span class="valids" style="color: red;">'+error+'</span>'));
                            });
                        }
                    },
                    success: function (data) {
                        if(data.flash_message_success) {
                            $('#success_message').html('<div class="alert alert-success alert-dismissible fade show">\n' +
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">×</button>\n' +
                                '<strong>Success! '+data.flash_message_success+'</strong> ' +
                                '</div>');
                        }else {

                            $('#error_message').html('<div class="alert alert-error">\n' +
                                '<button class="close" data-dismiss="alert">×</button>\n' +
                                '<strong>Error! '+data.error+'</strong>' +
                                '</div>');
                        }

                        $("form").trigger("reset");

                        $('.form-group').find('.valids').hide();

                        window.location.href = "{{ route('employee')}}";
                    }
                });
            })
        })
    </script>
</body>
</html>