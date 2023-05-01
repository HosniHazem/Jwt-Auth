<!doctype html>
<html>
<head>
    <title>Password Reset </title>
</head>

<body>
<h1>Welcome in Timdesk  {{ $user->name }} {{ $user->firstName }}!</h1>
Please click on the following link to reset your password.<br>
<a href='http://localhost:3000/reset/{{$token}}'>Reset my password</a>

</body>
</html>
