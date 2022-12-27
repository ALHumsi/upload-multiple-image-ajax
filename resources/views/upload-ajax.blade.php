<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body class="antialiased">
<div class="container">
    <div class="row">
        <div class="col-sm-12 m-5">

            <h2 class="text-center bg-success text-white p-3">Upload Multi Image Using Laravel & Ajax</h2>
            <hr>

            @if(session()->has('success'))
                <div class="alert alert-success alert-block" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">x</button>
                    <strong>{{ session()->get('success') }}</strong>
                </div>

            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong>There were some problems with your input.<br><br>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            @endif

            <form id="uploadImages" enctype="multipart/form-data">
                <div id="errors"></div>
                {{ csrf_field() }}
                <div class="form-group">
                    <label>Select Images</label>
                    <input type="file" name="images[]" multiple class="form-control" accept="image/*">
                </div>
                <div class="form-group">
                    <input type="submit" value="save" class="btn btn-success">
                </div>
            </form>

            <div class="container">
                <div class="row">
                    <div class="col-sm-12 m-5">



                    </div>

                    <div class="row show-images">
                        @foreach($images as $image)
                            <div class="col-sm-4 p-3">
                                <div class="card-border">
                                    <img src="{{ asset('uploads/'.$image->image) }}" class="card-img-top" alt="...">
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
<script>
    $("#uploadImages").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(jQuery('#uploadImages')[0]);

        $.ajax({
            url : "{{ url('/store-images') }}",
            type : "POST",
            data : formData,
            contentType : false,
            processData : false,
            success : function(data)
            {
                $("#errors").html('');
                $("#errors").append("<p class='alert alert-success'>Added Successfully</p>")
                $(".show-images").html('');
                $(".show-images").html(data);
            },
            error : function(xhr, status, error)
            {
                $("#errors").html('');
                $.each(xhr.responseJSON.errors, function(key, item) {
                  $("#errors").append("<p class='alert alert-danger'>"+item+"</p>")
                })
            }
        })
    });
</script>
</body>
</html>
