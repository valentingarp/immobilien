{!! Form::open(array('url'=>'administrador/usuario','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group row">
	<div class="col-sm-12">    
    <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="search">Búsqueda: </span>
      </div>
     	<input type="text" class="form-control" name="search" value="{{$nombres}}" placeholder="Nombres ó usuario">
      <span class="input-group-append">
        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> BUSCAR</button>
      </span>
    </div>
  </div>
</div>
{{Form::close()}}