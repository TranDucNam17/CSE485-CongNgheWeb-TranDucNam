<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Delete</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h3>Are you sure you want to delete this issue?</h3>
        <form action="{{ route('confirmDelete', $issue->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Yes, Delete</button>
            <a href="{{ route('issues.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
