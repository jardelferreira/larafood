<div class="form-group">
  <label for="name">Categoria</label>
  <input type="text" value="{{$category->name ?? old('name')}}" class="form-control" name="name" id="name" aria-describedby="nameHelp" placeholder="nome do Categoria">
  <small id="nameHelp" class="form-text text-muted">informe o nome do Categoria</small>
</div>
<div class="form-group">
  <label for="description">Descrição</label>
<textarea class="form-control" name="description" id="description" rows="3">{{$category->description ?? ""}}</textarea>
</div>