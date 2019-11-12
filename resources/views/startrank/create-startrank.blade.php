<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="container">
        <h2>Star Rank</h2>

        {{-- @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div>{{$error}}</div>
            @endforeach
        @endif --}}

        <form action="{{ url('store-startrank') }}" method="POST" id="starrank-form" class="starrank-form" name="starrank-form" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" class="form-control" name="username" placeholder="User Name"  >
            </div>
            @if ($errors->has('username'))
                <div class="error">{{ $errors->first('username') }}</div>
            @endif
            
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" class="form-control" name="description" placeholder="Description" >
            </div>
            @if ($errors->has('description'))
                <div class="error">{{ $errors->first('description') }}</div>
            @endif
            
            <div class="form-group">
                <label for="like">Like:</label>
                <input type="text" id="like" class="form-control" name="like" placeholder="Likes in Integer" >
            </div>
            
            <div class="form-group">
                <label for="dislike">Dislike:</label>
                <input type="text" id="dislike" class="form-control" name="dislike" placeholder="Dislike in Integer" >
            </div>

            <div class="form-group">
                <label for="picture">Picture:</label>
                <input type="file" id="picture" class="form-control" name="picture" placeholder="Picture" >
            </div>

            <div class="form-group">
                <label for="star">Star:</label>
                <input type="text" id="star" class="form-control" name="star" placeholder="Star in integer" >
            </div>
            
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>

</body>
</html>
