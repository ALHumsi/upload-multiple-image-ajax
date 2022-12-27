@foreach($images as $image)
    <div class="col-sm-4 p-3">
        <div class="card-border">
            <img src="{{ asset('uploads/'.$image->image) }}" class="card-img-top" alt="...">
        </div>
    </div>
@endforeach
