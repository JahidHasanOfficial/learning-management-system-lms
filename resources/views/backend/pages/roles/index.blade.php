@extends('backend.layouts.master')

@section('title', 'Role List')

@section('content')
<div class="row column1">
    <div class="col-md-12">
        <div class="white_shd full margin_bottom_30">
            <div class="full graph_head">
                <div class="heading1 margin_0 d-flex justify-content-between w-100">
                    <h2>Role List</h2>
                    <a href="{{ route('role.create') }}" class="btn btn-primary btn-sm">Create New Role</a>
                </div>
            </div>
            <div class="table_section padding_infor_info">
                <div class="table-responsive-sm">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Role Name</th>
                                <th>Permissions</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach($role->permissions as $perm)
                                    <span class="badge badge-info">{{ $perm->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('role.edit', $role->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                    
                                    @if($role->name != 'Super Admin')
                                    <form action="{{ route('role.destroy', $role->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
