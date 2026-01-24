@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
            <div class="col-md-4">
            <div class="card p-3">
                <div class="text-center profile-avatar-container">
                    <img id="avatar-preview" src="{{ $user->avatar_url ?? ('https://www.gravatar.com/avatar/' . md5(strtolower(trim($user->email))) . '?s=120&d=identicon') }}" alt="avatar" class="rounded-circle mb-3" style="width:120px;height:120px;object-fit:cover;">
                    <h5>{{ $user->name }}</h5>
                    <p class="text-muted">{{ $user->email }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card p-3">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->has('error'))
                    <div class="alert alert-danger">{{ $errors->first('error') }}</div>
                @endif

                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                        @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Avatar (optional)</label>
                        <input type="file" name="avatar" class="form-control">
                        @error('avatar') <div class="text-danger">{{ $message }}</div> @enderror
                    </div>

                    <button class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
