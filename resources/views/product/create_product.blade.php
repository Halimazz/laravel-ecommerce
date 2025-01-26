<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('store_product') }}" method="post" enctype="multipart/form-data">

        @csrf   
        <input type="text" name="name" placeholder="Product Name">
        <input type="text" name="price" placeholder="Product Price">
        <input type="text" name="description" placeholder="Product Description">
        <input type="file" name="image" placeholder="Product Image">
        <input type="text" name="stock" placeholder="Product Stock">
        <button type="submit">Submit</button>
    
    </form>
    
</body>
</html>