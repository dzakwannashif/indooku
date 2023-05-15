@extends('layouts.master')

@section('content')
    <div class="container-fluid">



        <h1 class="h3 mb-2 text-gray-800">Tambah Data Karyawan</h1>
        <a href="{{ route('product.data') }}" class="btn btn-primary">Back</a>


        <div class="card shadow mb-4 mt-2">

            <div class="card-body">
                <form method="POST" action="#" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="image_create">Foto Barang:</label>
                        <input type="file" name="image" id="image_create"
                            class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name_create">Name:</label>
                        <input type="text" name="name" id="name_create"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stock_create">Stock:</label>
                        <input type="stock" name="stock" id="stock_create"
                            class="form-control @error('stock') is-invalid @enderror">
                        @error('stock')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price_create">Price:</label>
                        <input type="" name="price" id="price_create"
                            class="form-control @error('price') is-invalid @enderror">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="desc_create">Description:</label>
                        <input type="" name="description" id="desc_create"
                            class="form-control @error('desc') is-invalid @enderror">
                        @error('desc')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_create">Category:</label>
                        <select class="form-control @error('category_id') is-invalid @enderror" name="category">
                            @foreach ($category as $i)
                                <option value="{{ $i->id }}">{{ $i->name }}</option>
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
