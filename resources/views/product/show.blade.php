<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
</head>

<body>
    <div class="container mt-5 mb-5">
        <a href="{{ route('product.index') }}" class="btn btn-md btn-success mb-3">BACK</a>
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <img src="{{ asset('/storage/product/' . $product->image) }}" class="rounded" alt=""
                            width="150px" />
                    </div>
                </div>
            </div>
        </div>
        <div class="com-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h3>{{ $product->title }}</h3>
                    <hr />
                    <p>{{ 'Rp' . number_format($product->price, 2, ',', ',') }}</p>
                    <code>
                        <p>{!! $product->description !!}</p>
                    </code>
                    <hr />
                    <p>Stock :{{ $product->stock }}</p>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous">
    </script>
</body>

</html>
