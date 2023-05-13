<table class="table border">
    <thead>
        <tr>
            @foreach ($headers as $header)
                <th scope="col">{{ $header }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($boards as $board)
            <tr>
                <td>{{ $board->code }}</td>
                <td>{{ $board->type }}</td>
                <td>{{ $board->getSize() }}</td>
                <td>{{ $board->stocks }}</td>
                <td>
                    <a href="{{ route('boards.edit', $board) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"
                        data-id="{{ $board->id }}"><i class="fa fa-trash"></i></a>
                </td>
            </tr>
        @endforeach
    </tbody>

</table>
