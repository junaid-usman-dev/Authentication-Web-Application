<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> --}}
</head>
<body>

    <div class="container">
        <h2>Create Post</h2>

        <form action="{{ url('store-post') }}" method="POST" id="post-form" class="post-form" name="post-form" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" class="form-control" class="username" name="username" placeholder="Username"  >
            </div>
            
            <div class="form-group">
                <label for="description" >Description:</label>
                <input type="text" id="description" class="form-control" name="description" placeholder="Description" >
            </div>
            
            <div class="form-group">
                <label for="like">Like:</label>
                <input type="text" id="like" class="form-control" name="like" placeholder="Like In Number" >
            </div>
            
            <div class="form-group">
                <label for="dislike">Dislike:</label>
                <input type="text" id="dislike" class="form-control" name="dislike" placeholder="Dislike In Numbers" >
            </div>

            <div class="form-group">
                <label for="view">View:</label>
                <input type="text" id="view" class="form-control" name="view" placeholder="Views in Number" >
            </div>

            <div class="form-group">
                <label for="comment">Comment:</label>
                <input type="text" id="comment" class="form-control" name="comment" placeholder="Comment in Number" >
            </div>

            <div class="form-group">
                <label for="star">Star:</label>
                <input type="text" id="star" class="form-control" name="star" placeholder="Star in Number" >
            </div>

            <div class="form-group">
                <label for="picture">Picture:</label>
                <input type="file" id="picture" class="form-control" name="picture" placeholder="Picture" >
            </div>

            <div class="checkbox">
                <label><input type="checkbox" name="remember"> Remember me</label>
            </div>
            
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>

</body>
</html>
