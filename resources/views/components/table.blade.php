<table class="table">
    <thead>
    <tr>
        <th scope="col">Sum</th>
        <th scope="col">Action</th>
        <th scope="col">Date Time</th>
    </tr>
    </thead>
    <tbody>
    @foreach($history as $item)
        <tr>
            <td>{{$item->value}}</td>
            <td>
                @if($item->is_win)
                    <span class="text-success">Win</span>
                @else
                    <span class="text-danger">Lose</span>
                @endif
            </td>
            <td>{{$item->created_at}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
