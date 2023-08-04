<!-- resources/views/dashboard_home.blade.php -->
@extends('admin.layout')

@section('content')
<table class="table table-striped display"  id="myTable">
    <div class="form-group">
        <input type="text" class="form-control" id="searchInput" placeholder="Tìm theo SDT  ...">
    </div>
    <thead>
    <tr>
        <th scope="col">STT</th>
        <th scope="col">Tên đăng nhập</th>
        <th scope="col">SDT</th>
        <th scope="col">Số dư ví</th>
        <th scope="col">Đại lí</th>
        <th scope="col">Chức năng</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <th>{{ $user->id }}</th>
            <td>{{ $user->username }}</td>
            <td>{{ $user->phone ?? '...' }}</td>
            <td>{{ $user->balanceFormated() }}</td>
            <td>{{ $user->promo_code ?? "..." }}</td>
            <td>
                <div class="btn-group" role="group">
                    <a href="{{ route('admin.users.find', $user->id) }}" type="button" class="btn btn-outline-primary"><i class="fa-solid fa-magnifying-glass-arrow-right"></i></a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $users->links() }}
@endsection

@section('js')
    <script type="module">
        window.addEventListener('DOMContentLoaded', function () {
            $('#searchInput').on('keyup', function() {
                let searchTerm = $(this).val().toLowerCase();
                if (searchTerm.length >= 2) {
                    $.ajax({
                        url: "{{ route('admin.users.ajax') }}",
                        method: 'GET',
                        data: {
                            searchTerm: searchTerm
                        },
                        success: function(data) {
                            $('#myTable tbody').html(data);
                        }
                    });
                } else {
                    // If the search term is less than 2 characters, clear the table
                    $('#myTable tbody').empty();
                }
            });
        })
    </script>
@endsection
