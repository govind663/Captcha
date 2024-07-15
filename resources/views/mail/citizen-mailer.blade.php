<!DOCTYPE html>
<html>

<head>
    <title>Welcome to Our Platform</title>
</head>

<body>
    <h1>Hi...!</h1>
    <p>Your registration details are as follows:</p>
    <p>Name : - {{ $citizenDetails->name }}</p>
    <p>Email : - {{ $citizenDetails->email }}</p>
    <p>Password : - {{ $citizenDetails->password }}</p>
    <p>Thank you for registering with us.</p>
    <p>We are excited to have you on board.</p>
</body>

</html>
