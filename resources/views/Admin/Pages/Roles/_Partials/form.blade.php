<div class="form-group">
  <label for="name">Regras</label>
  <input type="text" value="{{$role->name ?? old('name')}}" class="form-control" name="name" id="name" aria-describedby="nameHelp" placeholder="nome do perfil">
  <small id="nameHelp" class="form-text text-muted">informe o nome do perfil</small>
</div>
<div class="form-group">
  <label for="description">Descrição</label>
  <input type="text" value="{{$role->description ?? old('description')}}" class="form-control" name="description" id="description" aria-describedby="descHelp" placeholder="descrição do perfil">
  <small id="descHelp" class="form-text text-muted">descrição</small>
</div>