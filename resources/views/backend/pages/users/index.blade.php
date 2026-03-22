@extends('backend.layouts.master')

@section('title', 'User List')

@section('content')
<div class="row column1">
    <div class="col-md-12">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="row w-100 align-items-center m-0">
                    <div class="col-md-3 p-0">
                        <div class="heading1 margin_0">
                            <h2>User Management</h2>
                        </div>
                    </div>
                    <div class="col-md-6 p-0">
                        <form action="{{ route('user.index') }}" method="GET" class="d-flex align-items-center">
                            <input type="text" name="search" class="form-control rounded-pill mr-2" placeholder="Search by name, email or phone..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="col-md-3 text-right p-0">
                        <a href="{{ route('user.create') }}" class="btn btn-primary rounded-pill px-4 btn-sm"><i class="fa fa-plus"></i> Add New User</a>
                    </div>
                </div>
            </div>
            <div class="table_section padding_infor_info">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                
                <div class="table-responsive-sm">
                    <table class="table table-hover align-middle">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Profile</th>
                                <th>Name & Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="user_img"><img class="img-responsive rounded-circle" src="{{ $user->profile_image }}" alt="#" style="width: 45px; height: 45px; object-fit: cover;" /></div>
                                </td>
                                <td>
                                    <strong>{{ $user->name }}</strong><br>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </td>
                                <td>
                                    @foreach($user->roles as $role)
                                    <span class="badge badge-primary px-2 py-1">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @if($user->status == 'active')
                                        <span class="badge badge-success px-2 py-1">Active</span>
                                    @elseif($user->status == 'inactive')
                                        <span class="badge badge-warning px-2 py-1 text-dark">Inactive</span>
                                    @else
                                        <span class="badge badge-danger px-2 py-1">Suspended</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('user.show', $user->id) }}" class="btn btn-light btn-sm" title="View Profile"><i class="fa fa-eye text-primary"></i></a>
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-light btn-sm" title="Edit"><i class="fa fa-edit text-warning"></i></a>
                                        
                                        @if(!$user->hasRole('Super Admin'))
                                        <button type="button" class="btn btn-light btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <form action="{{ route('user.status', $user->id) }}" method="POST">
                                                @csrf
                                                @if($user->status != 'active')
                                                <input type="hidden" name="status" value="active">
                                                <button type="submit" class="dropdown-item"><i class="fa fa-check text-success"></i> Activate</button>
                                                @else
                                                <input type="hidden" name="status" value="suspended">
                                                <button type="submit" class="dropdown-item"><i class="fa fa-ban text-danger"></i> Suspend</button>
                                                @endif
                                            </form>
                                            <div class="dropdown-divider"></div>
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fa fa-trash"></i> Delete User</button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
