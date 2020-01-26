<table class="table table-responsive">

    <thead>
        <tr>
        <th>#</th>
        <th>Bloque</th>
        <th>Hash</th>
        <th>Previous Hash</th>
        <th></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($blocks as $block)
            @if($verifityBlock[$block->hash])
            <tr>
            @else
            <tr style="background-color: red;">
            @endif
                <td>{{$block->id}}</td>
                <!--<td>{{$block->data}}</td>-->
                <td>{{$block->index}}</td>
                <td>{{$block->hash}}</td>
                <td>{{$block->previous_hash}}</td>
                <td>{{$block->created_at}}</td>
                <td>
                    <a href="{{ route('blockchain.showblock',$block->id) }}" class="btn btn-gradient-success btn-fw">Ver</a>
                </td>
            </tr>
        @endforeach
    </tbody>
    
</table>