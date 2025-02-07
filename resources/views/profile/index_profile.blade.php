<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
</head>
<body>
    <p>Name : {{ $user->name }}</p>
    <p>User Email : {{ $user->email }}</p>
    <p>Phone : {{ $user->phone }}</p>
    <p>Role : {{ $user->is_admin ? 'Admin' : 'Member' }}</p>

    <form action="{{ route('profile.update', $user->id) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <label for="name">Nama</label>
        <br>
        <input type="text" name="name" value="{{ $user->name }}">
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="New Password">
        <br>
        <label for="password_confirmation">Password Confirmation</label>
        <input type="password" name="password_confirmation" placeholder="Confirm Password">
        <button type="submit">Update Profile</button>
    </form>
</body>
</html>