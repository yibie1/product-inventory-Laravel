<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Product</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-4">Edit Product</h1>
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity in Stock</label>
                <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price per Item</label>
                <input type="number" name="price" step="0.01" value="{{ $product->price }}" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
        <br />
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </div>
</body>
</html>
