<form method="post" action="{{ route('blockchain.store') }}" class="forms-sample">

    {{csrf_field()}}

    <div class="form-group">
        <label for="exampleSelectGender">Nuevo Chain</label>
        <select name="newChain" class="form-control" id="exampleSelectGender">
            <option value="0">NO</option>
            <option value="1">Si</option>
        </select>
    </div>

    <div class="form-group">
        <label for="exampleTextarea1">Data</label>
        <textarea name="data" class="form-control" id="exampleTextarea1" rows="4"></textarea>
    </div>

    <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>

</form>