@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <h1>Edit User</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="form-group">
                    <label>Nama</label>
                    <input name="name" class="form-control" value="{{ old('name', $user->name) }}">
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>NIP</label>
                    <input name="email" type="text" class="form-control" value="{{ old('email', $user->email) }}">
                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Password (opsional)</label>
                    <input name="password" type="password" class="form-control">
                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input name="password_confirmation" type="password" class="form-control">
                </div>

                <button class="btn btn-success">Update</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@stop
