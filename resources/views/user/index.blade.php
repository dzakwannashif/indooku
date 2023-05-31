@extends('layouts.master')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Users Tables</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">

            {{-- <a href=" {{ route('product.tampilanStore') }}">
                <div style="padding: 20px">
                    <button style="background-color: aqua; border-radius: 15px;">
                        <p style="margin-top: 16px; font-size:16px">
                            Create a new Table
                        </p>
                    </button>
                </div>
            </a> --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="border-top-0">No</th>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">Email</th>
                                <th class="border-top-0">Roles</th>
                                <th class="border-top-0">Images</th>
                                <th class="border-top-0">Created At</th>
                                <th class="border-top-0">Updated At</th>
                                <th class="border-top-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $i)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $i->name }}</td>
                                    <td>{{ $i->email }}</td>
                                    <td>{{ $i->roles->first()->name }}</td>
                                    <td><img src="{{ asset('uploads') . '/' . $i->image }}" alt="{{ $i->image }}"
                                            style="height:200px">
                                    </td>
                                    <td>{{ $i->created_at }}</td>
                                    <td>{{ $i->updated_at }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('user.tampilanEdit', $i->id) }}" class="btn btn-warning">
                                                Edit
                                            </a>
                                        </div>
                                        <div>
                                            <a href="" onclick="return confirm('yakin akan menghapus data ini?')"
                                                class="btn btn-danger">
                                                Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
