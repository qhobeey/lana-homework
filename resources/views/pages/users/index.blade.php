@extends('layouts.app')

@section('content')
   <div class="container p80">
       <div class="row">
            <a href="{{route('backend.users.add')}}" class="btn btn-primary add-btn">Add new user</a>
       </div>
        <div class="row">
            <h3>List of users </h3>
            <a href="{{ route('logout') }}">Logout</a>
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="/profiles/{{$user->profile}}" alt="" style="width: 45px; height: 45px" class="rounded-circle" />
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1">{{$user->name}}</p>
                                            <p class="text-muted mb-0">{{$user->email}}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$user->username}}</p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">{{$user->email}}</p>
                                </td>
                                <td>
                                    <a href="{{route('backend.users.edit', [$user->userid])}}" class="btn btn-link btn-sm btn-rounded">
                                        Edit
                                    </a> | 
                                    <a onclick="return confirm('This action cannot be reversed.')" href="{{route('backend.users.delete', [$user->userid])}}" class="btn btn-link btn-sm btn-rounded">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>No users data available.</td>
                            </tr>
                        @endforelse
                        
                    </tbody>
                </table>
        </div>
        
   </div>
@endsection