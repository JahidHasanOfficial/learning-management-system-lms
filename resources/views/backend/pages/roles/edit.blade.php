@extends('backend.layouts.master')

@section('title', 'Edit Role')

@section('content')
<div class="row column1">
    <div class="col-md-12">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0 text-capitalize">
                    <h2>Edit Role: {{ $role->name }}</h2>
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

                <form action="{{ route('role.update', $role->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group mb-4">
                        <label for="name">Role Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Role Name" required value="{{ old('name', $role->name) }}" {{ $role->name == 'Super Admin' ? 'readonly' : '' }}>
                    </div>

                    <div class="form-group">
                        <label class="mb-3 d-block"><strong>Permissions</strong></label>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkAll">
                                    <label class="custom-control-label" for="checkAll">Select All</label>
                                </div>
                            </div>
                            
                            @foreach($permission_groups as $group => $permissions)
                            <div class="col-md-4 mb-4">
                                <div class="card bg-light border-0">
                                    <div class="card-header bg-dark text-white text-capitalize py-1 px-3">
                                        {{ $group }}
                                    </div>
                                    <div class="card-body p-3">
                                        @foreach($permissions as $perm)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="permissions[]" value="{{ $perm->name }}" class="custom-control-input permission-checkbox" id="perm_{{ $perm->id }}" @if($role->hasPermissionTo($perm->name)) checked @endif>
                                            <label class="custom-control-label" for="perm_{{ $perm->id }}">{{ str_replace($group.'.', '', $perm->name) }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group text-right">
                        <a href="{{ route('role.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-success px-5">Update Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $('#checkAll').on('click', function() {
        $('.permission-checkbox').prop('checked', $(this).prop('checked'));
    });
</script>
@endpush
@endsection
