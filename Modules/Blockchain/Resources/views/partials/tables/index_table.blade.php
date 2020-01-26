<table class="table">

    <thead>
        <tr>
        <th>#</th>
        <th>Cadena</th>
        <th>Creada</th>
        <th></th>
        </tr>
    </thead>

    <tbody>
        @foreach ($chains as $chain)
            <tr>
                <td>{{$chain->id}}</td>
                <td>{{$chain->data}}-{{$chain->id}}</td>
                <td>{{$chain->created_at}}</td>
                <td>
                    <a href="{{ route('blockchain.showblocks',$chain->hash) }}" class="btn btn-gradient-success btn-fw">Ver</a>
                </td>
            </tr>
        @endforeach
    </tbody>
    
</table>