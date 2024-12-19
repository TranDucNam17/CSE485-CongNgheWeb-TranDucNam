<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Issue</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-4">
        <h2>Create New Issue</h2>
        <form action="{{ route('issues.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="computer_id">Computer</label>
                <select name="computer_id" id="computer_id" class="form-control" required>
                    <option value="">Select a computer</option>
                    @foreach ($computers as $computer)
                        <option value="{{ $computer->id }}">{{ $computer->computer_name }} - {{ $computer->model }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="reported_by">Reported By</label>
                <input type="text" name="reported_by" id="reported_by" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="reported_date">Reported Date</label>
                <input type="date" name="reported_date" id="reported_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="urgency">Urgency</label>
                <select name="urgency" id="urgency" class="form-control" required>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="Open">Open</option>
                    <option value="In Progress">In Progress</option>
                    <option value="Resolved">Resolved</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Create Issue</button>
        </form>
    </div>
</body>
</html>
