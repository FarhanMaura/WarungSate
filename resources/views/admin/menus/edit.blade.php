@extends('layouts.admin')

@section('title', 'Edit Menu')

@section('content')
<div class="card">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name:</label>
                <input type="text" name="name" value="{{ $menu->name }}" class="form-control" placeholder="Name">
            </div>
            <div class="form-group">
                <label>Description:</label>
                <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $menu->description }}</textarea>
            </div>
            <div class="form-group">
                <label>Price:</label>
                <input type="number" name="price" value="{{ $menu->price }}" class="form-control" placeholder="Price">
            </div>
            <div class="form-group">
                <label>Category:</label>
                <select name="category" class="form-control">
                    <option value="Food" {{ $menu->category == 'Food' ? 'selected' : '' }}>Food</option>
                    <option value="Drink" {{ $menu->category == 'Drink' ? 'selected' : '' }}>Drink</option>
                    <option value="Snack" {{ $menu->category == 'Snack' ? 'selected' : '' }}>Snack</option>
                </select>
            </div>
            <div class="form-group">
                <label>Image:</label>
                <input type="file" name="image" class="form-control">
                @if($menu->image)
                    <img src="/images/{{ $menu->image }}" width="100px" class="mt-2">
                @endif
            </div>
            <div class="form-group">
                <label>Availability:</label>
                <select name="is_available" class="form-control">
                    <option value="1" {{ $menu->is_available ? 'selected' : '' }}>Available</option>
                    <option value="0" {{ !$menu->is_available ? 'selected' : '' }}>Unavailable</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a class="btn btn-secondary" href="{{ route('menus.index') }}">Back</a>
        </form>
    </div>
</div>
@endsection
