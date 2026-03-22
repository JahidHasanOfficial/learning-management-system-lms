@extends('backend.layouts.master')

@section('title', 'Edit User')

@section('content')
<div class="row column1">
    <div class="col-md-12">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>Edit User: {{ $user->name }}</h2>
                </div>
            </div>
            <div class="padding_infor_info">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="name">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Full Name" required value="{{ old('name', $user->name) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="email">Email Address <span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email" required value="{{ old('email', $user->email) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="password">New Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Leave blank to keep current">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="password_confirmation">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm New Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="roles">Assign Role <span class="text-danger">*</span></label>
                                <select name="roles[]" id="roles" class="form-control" multiple required @if($user->hasRole('Super Admin')) disabled @endif>
                                    @foreach($roles as $role)
                                    <option value="{{ $role->name }}" @if($user->hasRole($role->name)) selected @endif>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @if($user->hasRole('Super Admin'))
                                    <input type="hidden" name="roles[]" value="Super Admin">
                                    <small class="text-danger">Super Admin role cannot be changed.</small>
                                @else
                                    <small class="text-muted text-info">Hold Ctrl to select multiple roles.</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" @if($user->hasRole('Super Admin')) disabled @endif>
                                    <option value="active" @if($user->status == 'active') selected @endif>Active</option>
                                    <option value="inactive" @if($user->status == 'inactive') selected @endif>Inactive</option>
                                    <option value="suspended" @if($user->status == 'suspended') selected @endif>Suspended</option>
                                </select>
                                @if($user->hasRole('Super Admin'))
                                    <input type="hidden" name="status" value="active">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label for="profile_image">Profile Image</label>
                                <div class="mb-2">
                                    <img src="{{ $user->profile_image }}" alt="Current Profile" class="img-thumbnail rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                                </div>
                                <input type="file" name="profile_image" id="profile_image" class="form-control-file border p-2 w-100 rounded">
                                <small class="text-muted">Allowed types: png, jpg, jpeg. Max size: 2MB. Leave blank to keep current.</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-right">
                        <a href="{{ route('user.index') }}" class="btn btn-secondary px-4">Cancel</a>
                        <button type="submit" class="btn btn-warning px-5 rounded-pill shadow-sm">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
