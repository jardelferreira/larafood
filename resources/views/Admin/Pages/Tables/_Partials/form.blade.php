<div class="form-group">
  <label for="identify">Mesa</label>
  <input type="text" value="{{$table->identify ?? old('identify')}}" class="form-control" name="identify" id="identify" aria-describedby="identifyHelp" placeholder="identificador da Mesa">
  <small id="identifyHelp" class="form-text text-muted">informe o identificador da Mesa</small>
</div>
<div class="form-group">
  <label for="description">Descrição</label>
<textarea class="form-control" name="description" id="description" rows="3">{{$table->description ?? ""}}</textarea>
</div>