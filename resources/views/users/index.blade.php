@extends('master')
@section('title', 'Users Management')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <h4>Users Management</h4>
            </div>
        </div>
        <div class="card-body">
            <a href="{{ url('users/create') }}" class="btn btn-sm btn-success">
                Create user
            </a>
            @if (session()->has('message'))
                <div class="{{ session()->get('class') }}">
                    {{ session()->get('message') }}
                </div>
            @endif
            <table class="table table-stripped table-bordered table-hover text-center mt-2">
                <thead>
                    <tr>
                        <th>ID #</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>create_at</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ url("/users/{$user->id}/edit") }}" class="btn btn-warning btn-sm">Edit</a>
                                <button role="button" data-id="{{ $user->id }}"
                                    class="btn btn-danger btn-sm btn-delete">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end">
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts');
    <script>
        $(document).ready(function() {
            $('.btn-delete').on('click', (e) => {
                let id = $(e.currentTarget).data('id');
                let url = "/users/" + id + "/delete";
                alertify.confirm("Are you sure for delete this user ?",
                    function() {
                        axios.delete(url).then(response => {
                            console.log(response);
                            alertify
                                .alert("Data Deleted.", () => {
                                    window.location.href = '/users';
                                });
                        })
                    },
                    function() {
                        alertify.error('Cancel');
                    });
            })
        })
    </script>
@endsection
