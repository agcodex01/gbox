@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <form action="{{ route('staffs.update', $staff) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-header d-flex justify-content-between align-items-center">

                    <div>
                        <a href="{{ route('staffs.index') }}" class="btn border-right mr-2"><i class="fa fa-chevron-left"></i>
                            Back</a>
                        Edit Staff
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="font-weight-bold">Personal Info</h6>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" aria-describedby="nameHelp" name="name"
                                    value="{{ $staff->user?->name ?? old('name') }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-5">
                                <label for="role">Role</label>
                                <select name="role" id="role"
                                    class="form-control  @error('role') is-invalid @enderror">
                                    <option value="">Select a role</option>
                                    @foreach ($roles as $key => $value)
                                        <option value="{{ $key }}"
                                            @if ($staff->role == $key) selected @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <h6 class="font-weight-bold">Contact Info</h6>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" aria-describedby="emailHelp" name="email"
                                    value="{{ $staff->user?->email ?? old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" aria-describedby="phoneHelp" name="phone"
                                    value="{{ $staff->phone ?? old('phone') }}">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">

                            <h6 class="font-weight-bold">Credential</h6>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" aria-describedby="passwordHelp" name="password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    aria-describedby="password_confirmHelp" name="password_confirmation">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
