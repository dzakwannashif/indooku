@extends('layouts.master')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Category Tables</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">

            <a href=" {{ route('product.tampilanStore') }}">
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
                                <th class="border-top-0">No</th>
                                <th class="border-top-0">Name</th>
                                <th class="border-top-0">Price</th>
                                <th class="border-top-0">Stock</th>
                                <th class="border-top-0">Image</th>
                                <th class="border-top-0">Description</th>
                                <th class="border-top-0">Category</th>
                                <th class="border-top-0">Created At</th>
                                <th class="border-top-0">Updated At</th>
                                <th class="border-top-0">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product as $i)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $i->name }}</td>
                                    <td>{{ $i->price }}</td>
                                    <td>{{ $i->stock }}</td>
                                    <td><img src="{{ asset('uploads') . '/' . $i->image }}" alt="{{ $i->image }}"
                                            style="height:200px">
                                    </td>
                                    <td>{{ $i->description }}</td>
                                    <td>{{ $i->category->name }}</td>
                                    <td>{{ $i->created_at }}</td>
                                    <td>{{ $i->updated_at }}</td>
                                    <td>
                                        <div>
                                            <a href="">
                                                <button style="background-color: rgb(234, 234, 0)">
                                                    <p style="color:white">Edit</p>
                                                </button>
                                            </a>
                                        </div>
                                        <div>
                                            <a href="">
                                                <button style="background-color: rgb(228, 0, 0)">
                                                    <p style="color:white">Delete</p>
                                                </button>
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
