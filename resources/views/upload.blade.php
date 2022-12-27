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

            <h2 class="text-center bg-success text-white p-3">Upload Multi Image Using Laravel</h2>
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

            <form action="{{ url('/upload-images') }}" method="POST" enctype="multipart/form-data">
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
</body>
</html>
