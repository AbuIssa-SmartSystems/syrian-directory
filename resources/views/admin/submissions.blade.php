<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Submissions Queue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #0b0f19;
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            background-color: #161b22;
            border: 1px solid #30363d;
            border-radius: 12px;
        }

        .table {
            color: #fff;
        }

        .table th,
        .table td {
            border-color: #30363d;
            vertical-align: middle;
        }
    </style>
</head>

<body class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="fa-solid fa-list-check text-success me-2"></i> Pending Portal Submissions</h2>
            <a href="{{ url('/dashboard') }}" class="btn btn-outline-light btn-sm rounded-pill px-3">Back to
                Dashboard</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="format">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card p-4 shadow-lg">
            @if (isset($submissions) && $submissions->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Entity Name</th>
                                <th>Official URL</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($submissions as $submission)
                                <tr>
                                    <td><strong>{{ $submission->entity_name }}</strong></td>
                                    <td><a href="{{ $submission->official_url }}" target="_blank"
                                            class="text-success">{{ $submission->official_url }}</a></td>
                                    <td><span class="badge bg-secondary">{{ $submission->category_name }}</span></td>
                                    <td>{{ $submission->description }}</td>
                                    <td>
                                        <form action="{{ url('/admin/submissions/' . $submission->id . '/approve') }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm rounded-pill px-3"><i
                                                    class="fa-solid fa-check me-1"></i> Approve</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5 text-muted">
                    <i class="fa-solid fa-box-open fa-3x mb-3"></i>
                    <p class="fs-5">No pending submissions found.</p>
                </div>
            @endif
        </div>
    </div>
</body>

</html>
