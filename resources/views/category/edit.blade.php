@extends('layouts.master')

@section('content')
    <div class="container-fluid">



        <h1 class="h3 mb-2 text-gray-800">Update Data Karyawan</h1>
        <a href="{{ route('category.data') }}" class="btn btn-primary">Back</a>


        <div class="card shadow mb-4 mt-2">

            <div class="card-body">
                <form method="POST" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="nameCreate">Nama Category:</label>
                        <input type="text" name="name" value="{{ $category->name }}" id="nameCreate"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
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
