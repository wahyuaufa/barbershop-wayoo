<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Name</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
        <h1>Add Random Names</h1>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <h3>Add New Name</h3>
        <form action="{{ route('random-names.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
                @error('name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Add Name</button>
        </form>

        <h3 class="mt-4">Upload CSV</h3>
        <form action="{{ route('random-names.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="csv_file">CSV File</label>
                <input type="file" name="csv_file" id="csv_file" class="form-control" required>
                @error('csv_file')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">*File hanya berisi kumpulan nama tidak memakai nama kolom.</small>
            </div>
            <button type="submit" class="btn btn-primary">Upload</button>
        </form>

       

        <div class="row">
            <div class="col-md-6">
                <h4>Names List || Total Data: {{ $names->count() }}
                <form action="{{ route('reset-names') }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you want to delete all names?');">
                        Reset
                    </button>
                </form>
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif</h4>
                <ul class="list-group">
                    @foreach ($names as $name)
                    <li class="list-group-item d-flex justify-content-between align-items-center" style="height: 35px;"> <!-- Mengatur tinggi item daftar -->
                        <span>{{ $loop->iteration }}. {{ $name->name }}</span>
                        <div>
                            <form action="{{ route('delete-name', $name->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                            </form>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>



    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>