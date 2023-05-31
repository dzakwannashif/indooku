@extends('layouts.master')

@section('content')
    <div class="container-fluid">



        <h1 class="h3 mb-2 text-gray-800">Update Data User</h1>
        <a href="{{ route('user.data') }}" class="btn btn-primary">Back</a>


        <div class="card shadow mb-4 mt-2">

            <div class="card-body">
                <form method="POST" action="{{ route('user.edit', $user->id) }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="image_create">Foto Profile:</label>
                        <input type="file" name="image" id="image_create"
                            class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nameCreate">Nama:</label>
                        <input type="text" name="name" value="{{ $user->name }}" id="nameCreate"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nameCreate">Email:</label>
                        <input type="text" name="email" value="{{ $user->email }}" id="nameCreate"
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_create">Roles:</label>
                        <select class="form-control @error('roles') is-invalid @enderror" name="roles">
                            @foreach ($roles as $i)
                                @if ($i->name == $user->roles->first()->name)
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
