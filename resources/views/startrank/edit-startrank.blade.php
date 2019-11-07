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
        <form action="{{ url('update-startrank') }}" method="POST" id="startrank-form" class="startrank-form" name="startrank-form" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" class="username" name="username" value="{{ $startrank->username }}"  >
            </div>
            
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" class="description" name="description" value="{{ $startrank->description }}" >
            </div>
            
            <div class="form-group">
                <label for="like">Like:</label>
                <input type="text" id="like" class="like" name="like" value="{{ $startrank->like }}" >
            </div>
            
            <div class="form-group">
                <label for="dislike">Dislike:</label>
                <input type="text" id="dislike" class="dislike" name="dislike" value="{{ $startrank->dislike }}" >
            </div>

            <div class="form-group">
                <label for="picture">Picture:</label>
                <input type="file" id="picture" class="picture" name="picture" value="{{ $startrank->picture }}" >
            </div>

            <div class="form-group">
                {{-- <label for="id">id:</label> --}}
                <input type="hidden" id="id" class="id" name="id" value="{{ $id }}" >
            </div>
            
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>

</body>
</html>
