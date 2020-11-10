<table>
    <thead>
    <tr>
        <th>Title</th>
        <th>Comment</th>
        <th>Time spent</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($entries as $row)
        <tr>
            <td>{{ $row->title }}</td>
            <td>{{ $row->comment }}</td>
            <td>{{ $row->timespent }}</td>
        </tr>
    @endforeach
        <tr>
            <td>Total</td>
            <td></td>
            <td>131</td>
        </tr>
    </tbody>
    <tfoot>
</table>
