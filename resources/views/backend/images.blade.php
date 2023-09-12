@extends('layouts.index')
@section('content')
    <h1>Image</h1>

    @include('backend.components.store')

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">NAME</th>
                <th scope="col">IMAGE</th>
                <th scope="col">UPDATE</th>
                <th scope="col">DELETE</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($images as $image)
                <tr valign="middle">
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$image->name}}</td>
                    <td>
                        <img width="50" src="{{ asset('storage/img/' . $image->src) }}" alt="{{ $image->desc }}">
                    </td>
                    <td>
                        @include('backend.components.update')
                    </td>
                    <td>
                        <form action="{{ route('images.destroy', $image->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
