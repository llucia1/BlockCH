<div class="table-responsive">

    <table class="table">

        <thead>
            <tr>
                <th>Concepto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th><strong> Total </strong></th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td>{{ $course->name }}</td>
                <td>1</td>
                <td>{{ $course->amount }}€</td>
                <td><strong>{{ $course->amount }}€</strong></td>
            </tr>

            @if( $discount > 0 )

                <tr>
                    <td></td>
                    <td><strong>Descuento:</strong></td>
                    <td>{{$discount}}€</td>
                    <td><strong>{{ $course->amount - $discount }}</strong>€</td>
                </tr>

            @endif

        </tbody>

    </table>

    <div class="mt-3">
        <button onclick="window.location.href = '{{ route('new-account.setredsys',$token) }}'" type="button" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Finalizar</button>
    </div>

</div>