<!DOCTYPE html>
<html>
<head>
    <title>Member Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .details {
            margin: 20px 0;
        }
        .details th, .details td {
            text-align: left;
            padding: 8px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Member Details</h1>
    </div>
    <table class="details" border="1" cellspacing="0" cellpadding="5" width="100%">
        <tr>
            <th>ID</th>
            <td>{{ $member->id }}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{ $member->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $member->email }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $member->status ? 'Active' : 'Inactive' }}</td>
        </tr>
        <tr>
            <th>Created At</th>
            <td>{{ $member->created_at }}</td>
        </tr>
    </table>
</body>
</html>
