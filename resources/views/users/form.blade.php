@extends('master')
@section('title', isset($user->page) ? $user->page : 'form')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4>Users Create</h4>
            </div>
        </div>
        <div class="card-body">
            <a href="{{ url('/users') }}">Back</a>
            <form action="{{ empty($user->id) ? url('/users/store') : url("/users/$user->id/update") }}" method="POST">
                @if (!empty($user->id))
                    @method('put')
                @endif
                @csrf
                <div class="form-row">
                    <div class="col-md-12 mt-2">
                        <input type="text" class="form-control form-control-sm" name="name" placeholder="Your name"
                            value="{{ old('name', $user->name) }}">
                        @error('name')
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('name') }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-2">
                        <input type="password" class="form-control form-control-sm" name="password"
                            placeholder="Your password" value="{{ old('password', $user->password) }}">
                        @error('password')
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('password') }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-2">
                        <input type="email" class="form-control form-control-sm" name="email" placeholder="Your email"
                            value="{{ old('email', $user->email) }}">
                        @error('email')
                            <div class="invalid-feedback d-block">
                                {{ $errors->first('email') }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-12 mt-2">
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-sm btn-success btn-block">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
