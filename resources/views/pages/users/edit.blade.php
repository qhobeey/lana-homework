@extends('layouts.app')

@section('content')
<div class="container p80">
    <div class="row">
         <a href="{{route('backend.users')}}" class="btn btn-primary add-btn">All Users</a>
    </div>

    <div class="row">
        <h3>Edit user</h3>
        <form method="POST" enctype="multipart/form-data" action="{{route('backend.users.edit', [$user->userid])}}">
            @foreach (['alert-danger', 'alert-warning', 'alert-success', 'alert-info'] as $msg)
                @if (Session::has($msg))
                    <div class="alert {{ $msg }} alert-dismissible fade show" role="alert">
                        {{ Session::get($msg) }}

                    </div>
                @endif
            @endforeach
            @csrf
            <!-- Name input -->
            <div class="form-outline mb-4">
              <input type="text" name="name" value="{{$user->name}}" required id="form4Example1" class="form-control" />
              <label class="form-label" for="form4Example1">Name</label>
            </div>
            <div class="form-outline mb-4">
              <input type="text" name="username" value="{{$user->username}}" required id="form4Example1" class="form-control" />
              <label class="form-label" for="form4Example1">Username</label>
            </div>
          
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" name="email" value="{{$user->email}}" required id="form4Example2" class="form-control" />
              <label class="form-label" for="form4Example2">Email address</label>
            </div>
            <div class="form-outline mb-4">
              <input type="password" name="password" id="form4Example2" class="form-control" />
              <label class="form-label" for="form4Example2">Password</label>
            </div>
            <img src="/profiles/{{$user->profile}}" class="pfile">
            <div class="form-outline mb-4">
              <input type="file" name="profile_pic" id="form4Example2" class="form-control" />
              <label class="form-label" for="form4Example2">Profile Photo</label>
            </div>
          
            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4 add-btn">Send</button>
        </form>
    </div>
</div>

@endsection
