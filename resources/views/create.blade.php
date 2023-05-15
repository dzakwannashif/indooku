{{-- @extends('layouts.master')

@section('content')
    <div class="container-fluid">



        <h1 class="h3 mb-2 text-gray-800">Tambah Data Karyawan</h1>
        <a href="{{ route('product.data') }}" class="btn btn-primary">Back</a>


        <div class="card shadow mb-4 mt-2">

            <div class="card-body">
                <form method="POST" action="#" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="photo_create">Foto diri:</label>
                        <input type="file" name="photo" id="photo_create"
                            class="form-control @error('photo') is-invalid @enderror">
                        @error('photo')
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
                        <label for="gender_create">Jenis Kelamin:</label>
                        <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>

                        @error('gender')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="birth_date_create">Tanggal Lahir:</label>
                        <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                            name="birth_date">
                        @error('birth_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="hire_date_create">Tanggal Diterima:</label>
                        <input type="date" class="form-control @error('hire_date') is-invalid @enderror"
                            name="hire_date">
                        @error('hire_date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="mobile_create">No HP:</label>
                        <input type="number" class="form-control @error('mobile') is-invalid @enderror" name="mobile">
                        @error('mobile')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="no_account_bank_create">No Rekening:</label>
                        <input type="number" class="form-control @error('no_account_bank') is-invalid @enderror"
                            name="no_account_bank">
                        @error('no_account_bank')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address_create">Alamat:</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address"></textarea>

                        @error('address')
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
@endsection --}}
