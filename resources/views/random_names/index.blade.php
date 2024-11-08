<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Random Names</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    @if(Auth::check())
    <div class="d-flex justify-content-end" style="position: fixed; top: 10px; right: 10px;">
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>
    @endif
    <div class="container mt-5">
        <h1>CRUD Random Names</h1>

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

        <center>
            <h3 class="mt-4" style="color: blue;">Names and Target Name Lists</h3>
        </center><br>

        <div class="row">
            <div class="col-md-6">
                <h4>Names List || Total Data: {{ $names->count() }}</h4>
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
                            <form action="{{ route('add-to-target', $name->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Add to Target</button>
                            </form>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-6">
                <h4>Target Name List</h4>
                <ul class="list-group">
                    @foreach ($targetNames as $targetName)
                    <li class="list-group-item d-flex justify-content-between align-items-center" style="height: 35px;"> <!-- Mengatur tinggi item daftar -->
                        <span>{{ $loop->iteration }}. {{ $targetName->name_pilihan }}</span>
                        <form action="{{ route('delete-from-target', $targetName->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
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