<!DOCTYPE html>
<html>
<head>
    <title>Workspace Invitation</title>
</head>
<body>
    <h1>You have been invited to join the workspace: {{ $workspaceName }}</h1>
    <p>Hello,</p>
    <p>You have been invited to collaborate in the workspace "{{ $workspaceName }}".</p>
    <p>Please click the link below to accept the invitation:</p>
    <a href="{{ url('/workspaces') }}">Accept Invitation</a>
    <p>Thank you!</p>
</body>
</html>