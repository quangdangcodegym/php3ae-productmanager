<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.layout')

@section('title', 'Product index use include Page')
@section('content')
<h1 class="text-center">List Products</h1>
<div class="row justify-content-between mb-sm-5">
    <div class="col-sm-2 row ps-1">
        <a href="{{ route('products.create')}}"><button class="btn btn-primary col-12">Create</button></a>
    </div>
    <div class="col-sm-6 row">
        <div class="col-sm-7 px-sm-0">
            <input class="form-control col-12" type="text" placeholder="Search..." />
        </div>
        <div class="col-sm-5">
            <button class="btn btn-primary col-12">Search</button>
        </div>
    </div>
</div>
<div style="max-height: calc(100vh - 70px - 70px); overflow: auto;">
    @if(session('msg') && session('msgAction'))
    <!-- <div class="alert alert-danger">{{ session('msg') }}</div> -->
    <script>
        var msgAction = '{{ session("msgAction") }}';
        var msg = '{{ session("msg") }}';
        window.onload = function() {
            Swal.fire({
                position: 'top-end',
                icon: msgAction == 'success' ? 'success' : 'error',
                title: msg,
                showConfirmButton: false,
                timer: 1500
            })
        }
    </script>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Status</th>
            <th>Price</th>
            <th>Categories</th>
            <th>Action</th>
        </tr>
        <tbody>
            @if (!empty($products) && count($products) > 0)
            @foreach($products as $p)
            <tr>
                <td>{{ $p->id}}</td>
                <td>{{ $p->name}}</td>
                <td>{{ $p->description}}</td>
                <td>{{ $p->status ? 'TRUE' : 'FALSE'}}</td>
                <td>{{ $p->price}}</td>
                <td>
                    {{ $p->category->name}}
                </td>
                <td>
                    <a href="{{ route('products.edit', ['id' => $p->id ])}}" class="btn btn-primary">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    <a onclick="handleTrash('{{ $p->id}}', '{{$p->name}}')" href="javascript:void(0)" class="btn btn-secondary">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>
@endsection


@push('my-scripts')
<script>
    function showSwal(msgAction, msg) {
        Swal.fire({
            position: 'top-end',
            icon: msgAction == 'success' ? 'success' : 'error',
            title: msg,
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            if (msgAction == 'success') {
                window.location.assign("/products");
            }
        })
    }

    function handleTrash(id, name) {
        Swal.fire({
            title: 'Are you sure delete?',
            text: name,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                var theUrl = "/products/" + id;
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


                var xmlHttp = new XMLHttpRequest();
                xmlHttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        showSwal('success', 'Delete product successfully');

                    } else {
                        showSwal('error', 'Can not delete products');
                    }
                };
                xmlHttp.open("DELETE", theUrl, false); // false for synchronous request
                xmlHttp.setRequestHeader("X-CSRF-TOKEN", csrfToken);
                xmlHttp.send(null);
                return xmlHttp.responseText;
            }
        })
    }
</script>
@endpush