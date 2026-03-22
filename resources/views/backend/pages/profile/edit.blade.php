@extends('backend.layouts.master')

@section('title', 'My Profile')

@section('content')
<div class="row column1">
    <div class="col-md-4">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>Profile Preview</h2>
                </div>
            </div>
            <div class="padding_infor_info text-center">
                <div class="profile_img mb-3">
                    <img src="{{ $user->profile_image }}" id="preview_image" class="img-responsive rounded-circle border p-1" alt="#" style="width: 150px; height: 150px; object-fit: cover;" />
                </div>
                <h4>{{ $user->name }}</h4>
                <p class="text-muted">{{ $user->roles->pluck('name')->first() }}</p>
                <hr>
                <div class="text-left">
                    <p><strong><i class="fa fa-envelope mr-2"></i></strong> {{ $user->email }}</p>
                    <p><strong><i class="fa fa-phone mr-2"></i></strong> {{ $user->phone ?? 'Not set' }}</p>
                    <p><strong><i class="fa fa-map-marker mr-2"></i></strong> {{ $user->address ?? 'Not set' }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>Edit Profile</h2>
                </div>
            </div>
            <div class="padding_infor_info">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Full Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Email Address</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Phone Number</label>
                                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" placeholder="e.g. +880123456789">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" value="{{ old('address', $user->address) }}" placeholder="Your City/Country">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label>Short Bio</label>
                                <textarea name="bio" class="form-control" rows="3" placeholder="Tell something about yourself...">{{ old('bio', $user->bio) }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label>Skills (Comma separated)</label>
                                <input type="text" name="skills_input" class="form-control" value="{{ is_array($user->skills) ? implode(', ', $user->skills) : '' }}" placeholder="PHP, Laravel, React, etc.">
                                <small class="text-muted">Separate each skill with a comma.</small>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-4">
                                <label>Change Profile Image</label>
                                <input type="file" name="profile_image" id="image_input" class="form-control-file border p-2 w-100 rounded">
                            </div>
                        </div>
                    </div>

                    <div class="form-group text-right">
                        <button type="submit" class="btn btn-success px-5 rounded-pill shadow-sm">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Password Update Section -->
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>Update Password</h2>
                </div>
            </div>
            <div class="padding_infor_info">
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>Current Password</label>
                                <input type="password" name="current_password" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>New Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>Confirm Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-right mt-2">
                        <button type="submit" class="btn btn-dark px-5 rounded-pill shadow-sm">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Preview image before upload
    document.getElementById('image_input').onchange = function (evt) {
        const [file] = this.files;
        if (file) {
            document.getElementById('preview_image').src = URL.createObjectURL(file);
        }
    }
</script>
@endpush
@endsection
