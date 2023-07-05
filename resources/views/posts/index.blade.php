<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>How to Use Soft Delete in Laravel</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>
    <body>
        <h1>jjjjj</h1>
        <div class="container">    
            <br />
            <h1 class="text-center text-primary">How to Use Soft Delete in Laravel</h1>
            <br />
            @if(session()->has('success'))

                <div class="alert alert-success">
                    {{ session()->get('success') }}
                </div>

            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col col-md-6">Sample Data</div>
                        <div class="col col-md-6 text-right">
                            @if(request()->has('view_deleted'))

                            <a href="{{ route('posts.index') }}" class="btn btn-info btn-sm">View All Post</a>

                            <a href="{{ route('posts.restore_all') }}" class="btn btn-success btn-sm">Restore All</a>

                            @else

                            <a href="{{ route('posts.index', ['view_deleted' => 'DeletedRecords']) }}" class="btn btn-primary btn-sm">View Deleted Post</a>

                            @endif
                            
                        </div>
                    </div>
                </div>
            
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($posts) > 0)
                                @foreach($posts as $row)

                                <tr>
                                    <td>{{ $row->id }}</td>
                                    <td>{{ $row->title }}</td>
                                    <td>{{ $row->description }}</td>
                                    <td>
                                        @if(request()->has('view_deleted'))

                                            <a href="{{ route('posts.restore', $row->id) }}" class="btn btn-success btn-sm">Restore</a>
                                        @else
                                            <form method="post" action="{{ route('posts.destroy', $row->id) }}">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE" />
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>

                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">No Post Found</td>
                                </tr>

                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
