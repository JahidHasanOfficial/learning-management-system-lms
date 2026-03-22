@extends('backend.layouts.master')

@section('title', 'User Details')

@section('content')
<div class="row column1">
    <div class="col-md-4">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>User Photo</h2>
                </div>
            </div>
            <div class="padding_infor_info text-center">
                <div class="profile_img mb-3">
                    <img src="{{ $user->profile_image }}" class="img-responsive rounded-circle border p-1" alt="#" style="width: 150px; height: 150px; object-fit: cover;" />
                </div>
                <h4>{{ $user->name }}</h4>
                <p>
                    @foreach($user->roles as $role)
                    <span class="badge badge-primary">{{ $role->name }}</span>
                    @endforeach
                </p>
                <hr>
                <div class="text-left">
                    <p><strong><i class="fa fa-circle mr-2 {{ $user->status == 'active' ? 'text-success' : 'text-danger' }}"></i> Status:</strong> {{ ucfirst($user->status) }}</p>
                    <p><strong><i class="fa fa-envelope mr-2"></i> Email:</strong> {{ $user->email }}</p>
                    <p><strong><i class="fa fa-phone mr-2"></i> Phone:</strong> {{ $user->phone ?? 'N/A' }}</p>
                    <p><strong><i class="fa fa-map-marker mr-2"></i> Address:</strong> {{ $user->address ?? 'N/A' }}</p>
                    <p><strong><i class="fa fa-calendar mr-2"></i> Joined:</strong> {{ $user->created_at->format('d M, Y') }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0">
                    <h2>Professional Background</h2>
                </div>
            </div>
            <div class="padding_infor_info">
                <div class="mb-4">
                    <h5 class="text-primary"><i class="fa fa-info-circle mr-2"></i> About / Bio</h5>
                    <p class="mt-2">{{ $user->bio ?? 'No bio provided.' }}</p>
                </div>
                <hr>
                <div class="mb-4">
                    <h5 class="text-primary"><i class="fa fa-wrench mr-2"></i> Skills & Expertise</h5>
                    <div class="mt-3">
                        @if($user->skills && count($user->skills) > 0)
                            @foreach($user->skills as $skill)
                            <span class="badge badge-info px-3 py-2 mr-2 mb-2" style="font-size: 14px;">{{ $skill }}</span>
                            @endforeach
                        @else
                            <p class="text-muted">No skills listed.</p>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="text-right mt-4">
                    <a href="{{ route('user.index') }}" class="btn btn-secondary px-4">Back to List</a>
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning px-4">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
