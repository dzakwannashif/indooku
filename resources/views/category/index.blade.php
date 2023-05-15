@extends('layouts.master')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Category Tables</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">

            <a href="{{ route('category.tampilanStore') }}">
                <div style="padding: 20px">
                    <button style="background-color: aqua; border-radius: 15px;">
                        <p style="margin-top: 16px; font-size:16px">
                            Create a new Table
                        </p>
                    </button>
                </div>
            </a>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $i)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $i->name }}</td>
                                    <td>{{ $i->created_at }}</td>
                                    <td>{{ $i->updated_at }}</td>
                                    <td>
                                        <div>
                                            <a href="{{ route('category.tampilanEdit', $i->id) }}" class="btn btn-warning">
                                                Edit
                                            </a>
                                        </div>
                                        <div>
                                            <a href="{{ route('category.delete', $i->id) }}"
                                                onclick="return confirm('yakin akan menghapus data ini {{ $i->name }}?')"
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
