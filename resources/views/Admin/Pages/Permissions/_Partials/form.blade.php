<div class="form-group">
  <label for="name">Permissão</label>
  <input type="text" value="{{$permission->name ?? old('name')}}" class="form-control" name="name" id="name" aria-describedby="nameHelp" placeholder="nome da permissão">
  <small id="nameHelp" class="form-text text-muted">informe o nome da permissão</small>
</div>
<div class="form-group">
  <label for="description">Descrição</label>
  <input type="text" value="{{$permission->description ?? old('description')}}" class="form-control" name="description" id="description" aria-describedby="descHelp" placeholder="descrição do perfil">
  <small id="descHelp" class="form-text text-muted">descrição</small>
</div>