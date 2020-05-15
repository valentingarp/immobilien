@extends('layouts.admin')
@section('contenido')
<div class="accordion" id="accordionExample" style="padding: 5px">
  <div class="card">
<!--**************HEADER MENU NAV*************-->
    <div class="card-header" id="headingOne" style="padding: 0px;box-shadow: 0 -2px 0px 0px rgba(115,115,115,0.4);">
      <div style="padding: 10px">
        <div style="float: left;color: #7B7B7B">
          <span><a href="{{URL::to('home')}}"><i class="fas fa-home"></i></a> </span> /
          <span><a href="{{URL::to('administrador/proyecto')}}">Proyecto</a></span> /
          <span>Registrar</span>
        </div>
        <div  style="float: right;">
        <p data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="color: #2C8BCC"><i class="far fa-window-minimize"></i></p>        
        </div> 
      </div>     
    </div>
<!--**************FIN HEADER MENU NAV*************-->
<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
  <div class="card-body" style="border-bottom: 1px solid #C0C0C0">
<!--**************BODY MAIN*************-->
<div class="row">
  <div class="col-md-6">
      <h4 style="margin-top: 0px"><i class="fas fa-user-edit"></i> Registrar Proyecto</h4>
   </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
  <div class="col-md-12">
        
  {!!Form::open(array('url'=>'administrador/proyecto','method'=>'POST','autocomplete'=>'off','files'=>true,'class'=>'formcreate'))!!}
            {{Form::token()}}


		<div id="nombresape">
				<div class="form-group row">
					<label for="Nombre" class="col-sm-2 col-form-label">* Nombre del Proyecto:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" placeholder="Nombre" name="cnombre" required="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" id="idnombre">
					</div>
				</div>
		</div>

				<div class="form-group row">
					<label for="Nombre" class="col-sm-2 col-form-label">* Proceso:</label>
					<div class="col-sm-4">
						<select name="region_domicilio" id="regiondo" class="form-control" required="">
			              <option value="">========== seleccione =========</option>
			              <?php for($i=0;$i<sizeof($proser);$i++){
			                ?>
			              <option value="{{$proser[$i]->nid_procesoservicio}}">{{$proser[$i]->cproceso}}</option>
			                <?php
			              }?>
			            </select>
					</div>
					<label for="Nombre" class="col-sm-2 col-form-label">* Servicio:</label>
					<div class="col-sm-4">
						<select name="provincia_domicilio" id="provinciado" class="form-control" required="">
			              <option value="">========== seleccione =========</option>
			            </select>
					</div>
				</div>
				<div class="form-group row">
					<label for="Nombre" class="col-sm-2 col-form-label">* Etapa:</label>
					<div class="col-sm-4">
						<select name="distrito_domicilio" id="distritodo" class="form-control" required="">
			              <option value="">========== seleccione =========</option>
			            </select>
					</div>

				</div>

<br>
				<div class="row">
					<div class="offset-sm-5 col-sm-2">
						<button type="submit" class="btn" style="background: #B90D0D;color: #FFFFFF"><i class="far fa-save"></i> GUARDAR</button>
					</div>
				</div>
			</form>

  </div>  
</div>


</div>
<!--**************BODY MAIN*************-->
</div>
</div>
</div>
@endsection

@push('scripts')
<script>
	$('.formcreate').on('submit',function(){
    	$("#pageloader").fadeIn();    
  	});


	  //SELECT DINAMICOS
  /*-------------------regiones de domicilio---------------*/
	$('#regiondo').on('change',function(e){
	  console.log(e);
	  var region_id = e.target.value;
	  $.get('/administrador/json_provincia?region_id=' + region_id,function(data){
	    $('#provinciado').empty();
	    $('#provinciado').append('<option value="" selected="true">====== Seleccione =====</option>');
	    $.each(data,function(create,provinciaObj){
	      $('#provinciado').append('<option value="'+provinciaObj.cubigeo_provinces+'">'+provinciaObj.nomprovincia+'</option>')
	    });
	  });
	  
	});

	$('#provinciado').on('change',function(e){
	  console.log(e);
	  var provincia_id = e.target.value;
	  $.get('/administrador/json_distrito?provincia_id=' + provincia_id,function(data){
	    $('#distritodo').empty();
	    $('#distritodo').append('<option value="" selected="true">====== Seleccione =====</option>');
	    $.each(data,function(create,distritoObj){
	      $('#distritodo').append('<option value="'+distritoObj.cubigeo_districts+'">'+distritoObj.nomdistrito+'</option>')
	    });
	  });
	  
	});
	/*-------------------FIN--regiones de domicilio---------------*/
</script>
@endpush