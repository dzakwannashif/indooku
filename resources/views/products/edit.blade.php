@extends('layouts.master')

@section('content')
    <div class="container-fluid">



        <h1 class="h3 mb-2 text-gray-800">Update Data Product</h1>
        <a href="{{ route('product.data') }}" class="btn btn-primary">Back</a>


        <div class="card shadow mb-4 mt-2">

            <div class="card-body">
                <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="image_create">Foto Barang:</label>
                        <input type="file" name="image" id="image_create"
                            class="form-control @error('image') is-invalid @enderror" value="{{ $product->image }}">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name_create">Name:</label>
                        <input type="text" name="name" id="name_create"
                            class="form-control @error('name') is-invalid @enderror" value="{{ $product->name }}">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stock_create">Stock:</label>
                        <input type="stock" name="stock" id="stock_create"
                            class="form-control @error('stock') is-invalid @enderror" value="{{ $product->stock }}">
                        @error('stock')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price_create">Price:</label>
                        <input type="" name="price" id="price_create"
                            class="form-control @error('price') is-invalid @enderror" value="{{ $product->price }}">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description_create">Description:</label>
                        <input type="" name="description" id="description_create"
                            class="form-control @error('description') is-invalid @enderror"
                            value="{{ $product->description }}">
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_create">Category:</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                            @foreach ($category as $i)
                                @if ($i->id == $product->category_id)
                                    <option selected value="{{ $i->id }}">{{ $i->name }}</option>
                                @else
                                    <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endif
                            @endforeach
                        </select>

                        @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save fa-fw"></i> SIMPAN
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
