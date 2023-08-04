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
