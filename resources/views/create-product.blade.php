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
        <h2>Create Products</h2>
        <form action="{{ url('store-product') }}" method="POST" id="product-form" class="product-form" name="product-form" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" class="title" name="title" placeholder="Product Title"  >
            </div>
            
            <div class="form-group">
                <label for="short-description">Short Description:</label>
                <input type="text" id="short-description" class="short-description" name="short-description" placeholder="Short Description" >
            </div>
            
            <div class="form-group">
                <label for="long-description">Long Description:</label>
                <input type="text" id="long-description" class="long-description" name="long-description" placeholder="Long Description" >
            </div>
            
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" id="category" class="category" name="category" placeholder="Category" >
            </div>

            <div class="form-group">
                <label for="squ">SQU:</label>
                <input type="text" id="squ" class="squ" name="squ" placeholder="SQU" >
            </div>

            <div class="form-group">
                <label for="type">Type:</label>
                <select name="type" id="type" class="type">
                    <option value="variable">Variable</option>
                    <option value="feature">Feature</option>
                    <option value="sale">Sale</option>
                    <option value="option1">Option 1</option>
                    <option value="option2">Option 2</option>
                </select>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" id="price" class="price" name="price" placeholder="Price" >
            </div>

            <div class="form-group">
                <label for="sale-price">Sale Price:</label>
                <input type="text" id="sale-price" class="sale-price" name="sale-price" placeholder="Sale Price" >
            </div>

            <div class="form-group">
                <label for="discount-percentage">Discount Percentage:</label>
                <input type="text" id="discount-percentage" class="discount-percentage" name="discount-percentage" placeholder="Discount Percentage" >
            </div>

            <div class="form-group">
                <label for="brand">Brand:</label>
                <input type="text" id="brand" class="brand" name="brand" placeholder="Brand" >
            </div>

            <div class="form-group">
                <label for="picture">Picture:</label>
                <input type="file" id="picture" class="picture" name="picture" placeholder="Picture" >
            </div>

            <div class="form-group">
                <label for="picture">Available:</label>
                <input type="text" id="available" class="available" name="available" placeholder="1 or 0" >
            </div>

            <div class="checkbox">
                <label><input type="checkbox" name="remember"> Remember me</label>
            </div>
            
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>

</body>
</html>
