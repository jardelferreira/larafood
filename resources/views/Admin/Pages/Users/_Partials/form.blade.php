<div class="form-group">
  <label for="name">Usuário</label>
  <input type="text" value="{{$user->name ?? old('name')}}" class="form-control" name="name" id="name" aria-describedby="nameHelp" placeholder="nome do Usuário">
  <small id="nameHelp" class="form-text text-muted">informe o nome do Usuário</small>
</div>
<div class="form-group">
  <label for="email">Email</label>
  <input type="text" value="{{$user->email ?? old('email')}}" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="seuemail@mail">
  <small id="emailHelp" class="form-text text-muted">Email</small>
</div>
<div class="form-group">
  <label for="password">Senha</label>
  <input type="text" value="{{$user->password ?? old('password')}}" class="form-control" name="password" id="password" aria-describedby="passwordHelp" placeholder="seupassword@mail">
  <small id="passwordHelp" class="form-text text-muted">Senha</small>
</div>
<div class="form-group">
  <label for="_password">confirmação de senha</label>
  <input type="text" value="{{$user->_password ?? old('_password')}}" class="form-control" name="_password" id="_password" aria-describedby="_passwordHelp" placeholder="seu_password@mail">
  <small id="_passwordHelp" class="form-text text-muted">confirmação de senha</small>
</div>