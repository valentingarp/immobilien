{!! Form::open(array('url'=>'administrador/procesoservicio','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group row">
	<div class="col-sm-12">    
    <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="search">Proceso: </span>
      </div>
      <input type="text" aria-describedby="search" name="search" id="search" value="{{$search}}" class="form-control " placeholder="Buscar Proceso">
      <span class="input-group-append">
        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> BUSCAR</button>
      </span>
    </div>
  </div>
</div>
{{Form::close()}}