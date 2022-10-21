@extends('layout.app')

@section('roleActive-css')

    <style>
        .roleActive{
            background: white;
            border-radius:8px;
        }
    </style>

@endsection

@section('index-css')
        <!-- css needed for tables -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
 
        <!-- my css -->
        <link rel="stylesheet" href="{{ asset('/css/index.css') }}"/>
        <link rel="stylesheet" href="{{ asset('/css/role.css') }}"/>
@endsection

@section('content')

<div class="GIM-membersCreate" style="width: 50.6%; margin-top: 9.5%;">

    <div class="my-custom-row d-flex flex-row justify-content-between " >
        <div class="col-4 align-self-end">
            <h1 class="view-gym-members">Edit Role</h1>
        </div>
        <div class="col-4 align-self-end d-flex justify-content-end" >
            <a href="{{route('admin.roles.index')}}" class="add-member-bg text-sm">
                <div class="add-member">Back</div>
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.roles.update', $role->id)}}">
        <div class="GIM-roleContainer" style="margin-bottom: 5%;">
            <div class="GIM-roleContainer-input">
                    @csrf
                    @method('PUT')
                <div class="">
                    <div class="GIM-membersCreate-formAllignment">
                        <div class="roles-form">
                            <label for="name" class="role-name">Role Name</label>
                            <div class="role-input">
                                <input type="text" id="name" name="name"
                                value="{{$role->name}}">
                            </div>
                            @error('name') <span>{{$message}}</span> @enderror
                        </div>
                    </div>
                    <div class="GIM-membersCreate-formAllignment">
                        <div class="GIM-roleContainer-button button">
                            <button type="submit" class="btn-design">Update Role</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="permissions-role">
        <h2 class="view-gym-members">Role Permissions</h2>
            <div class="GIM-roleContainer" style="margin-bottom: 5%;">
                <div class="GIM-roleContainer-input">
                        <div class="GIM-membersCreate-formAllignment">
                            @if($role->permissions)
                                @foreach($role->permissions as $role->permission)
                                <form method="POST" action="{{route('admin.roles.permissions.revoke', [$role->id, $role->permission->id ])}}" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <label for="roletype">Current Permission:  </label>
                                        <button type="submit" class="roleTypePerm">{{$role->permission->name}}</button>
                                        </form>
                                @endforeach
                            @endif
                        </div>
                    <br>
                        <div>
                        <form method="POST" action="{{ route('admin.roles.permissions', $role->id)}}">
                            @csrf
                                <div>
                                <label for="permission" class="role-name">Permission:</label>
                                <select id="permission" name="permission" autocomplete="permission-name" class="role-input">
                                    @foreach($permissions as $permission)
                                    <option value="{{$permission->name}}">{{$permission->name}}</option>
                                    @endforeach
                                </select>
                                @error('name') <span>{{$message}}</span> @enderror
                                </div>
                                <div class="GIM-membersCreate-formAllignment" style="margin-top: 3%;">
                                    <div class="permissionButton">
                                        <button type="submit" class="btn-design">Update Permission</button>
                                    </div>
                                </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>

</div>

@endsection