<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
</head>
<body>
    <h2>Welcome, {{ $user->first_name }}</h2>
    <p>Your login: {{ $user->email }}</p>
    <p>Your password: {{ $password }}</p>
    <a href="https:\\buukan.com\login">Go to system</a>
    <p>Please keep it secure and do not share it with anyone.</p>
</body>
</html>