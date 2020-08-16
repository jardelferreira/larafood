<div class="form-group">
  <label for="plan_id">Plano</label>
  <select class="form-control" name="plan_id" id="plan_id">
    @foreach ($plans as $plan)
    <option value="{{$plan->id}}">{{$plan->name}}</option>
    @endforeach
  </select>
</div>
<div class="form-group">
  <label for="name">Tenant</label>
  <input type="text" value="{{$tenant->name ?? old('name')}}" class="form-control" name="name" id="name" aria-describedby="nameHelp" placeholder="nome do Tenant">
  <small id="nameHelp" class="form-text text-muted">informe o título do Tenant</small>
</div>

<div class="form-group">
  <label for="cnpj">Descrição</label>
<textarea class="form-control" name="cnpj" id="cnpj" rows="3">{{$tenant->cnpj ?? ""}}</textarea>
</div>
<div class="form-group">
  <label for="email">E-mail</label>
  <input type="email" value="{{$tenant->email ?? ''}}"class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="company@mail.com">
  <small id="emailHelpId" class="form-text text-muted">Informe seu e-mail</small>
</div>
<div class="form-group">
  <label for="logo">Imagem</label>
  <img style="width: 70px; height: 50px;" src="{{asset("storage/$tenant->logo")}}" alt="{{$tenant->name}}" >
  <input type="file" class="form-control-file" name="logo" id="logo" placeholder="Imagem" aria-describedby="logoHelp">
  <small id="logoHelp" class="form-text text-muted">selecione uma imagem</small>
</div>