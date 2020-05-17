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
						<select name="proceso" id="procesodo" class="form-control" required="">
			              <option value="">========== seleccione =========</option>
			              <?php for($i=0;$i<sizeof($proser);$i++){
			                ?>
			              <option value="{{$proser[$i]->nid_proceso}}">{{$proser[$i]->cproceso}}</option>
			                <?php
			              }?>
			            </select>
					</div>
					<label for="Nombre" class="col-sm-2 col-form-label">* Servicio:</label>
					<div class="col-sm-4">
						<select name="servicio" id="serviciodo" class="form-control" required="">
			              <option value="">========== seleccione =========</option>
			            </select>
					</div>
				</div>
				<div class="form-group row">
					<label for="Nombre" class="col-sm-2 col-form-label">* Actividad:</label>
					<div class="col-sm-4">
						<select name="actividad" id="actdo" class="form-control" required="">
			              <option value="">========== seleccione =========</option>
			            </select>
					</div>



					<label for="Nombre" class="col-sm-2 col-form-label">* Estado:</label>
					<div class="col-sm-4">
						<select name="estado" id="procesodo" class="form-control" required="">
			              <option value="">========== seleccione =========</option>
			              <?php for($i=0;$i<sizeof($estadoproyecto);$i++){
			                ?>
			              <option value="{{$estadoproyecto[$i]->nid_estadoproyecto}}">{{$estadoproyecto[$i]->cestadoproyecto}}</option>
			                <?php
			              }?>
			            </select>
					</div>

				</div>

			<div class="form-group row">
					<label for="Nombre" class="col-sm-2 col-form-label">* Cliente:</label>
					<div class="col-sm-4">
						<input type="text" id="Idcliente" class="form-control" required="" placeholder="Buscar cliente">
						  	<div id="list_cliente" class="col-md-2" >
					    	
					    	</div> 
					</div>
					<div class="col-sm-1">
						<a href="#" title="Limpiar" id="Idlimpiar"><i class="fas fa-eraser text-danger" style="font-size: 15pt;"></i></a>
					</div>

					<input type="hidden" id="input_idpersona" name="nid_persona">

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
  /*-------------------procesos y servicios actividades etapa---------------*/
	$('#procesodo').on('change',function(e){
	  console.log(e);
	  var proceso_id = e.target.value;
	  $.get('/administrador/json_servicio?proceso_id=' + proceso_id,function(data){
	    $('#serviciodo').empty();
	    $('#serviciodo').append('<option value="" selected="true">====== Seleccione =====</option>');
	    $.each(data,function(create,servicioObj){
	      $('#serviciodo').append('<option value="'+servicioObj.nid_procesoservicio+'">'+servicioObj.cservicio+'</option>')
	    });
	  });
	  
	});


	$('#serviciodo').on('change',function(e){
	  console.log(e);
	  var proser_id = e.target.value;
	  $.get('/administrador/json_actividad?proser_id=' + proser_id,function(data){
	    $('#actdo').empty();
	    $('#actdo').append('<option value="" selected="true">====== Seleccione =====</option>');
	    $.each(data,function(create,actividadObj){
	      $('#actdo').append('<option value="'+actividadObj.nid_servicioactividad+'">'+actividadObj.cactividad+'</option>')
	    });
	  });
	  
	});





	/*-------------------FIN-----------------*/

$(document).ready(function(){//alert('this');
	$('#Idcliente').keyup(function(){//alert('aca');
		var query = $(this).val();
		if (query != '') {
			var _token = $('input[name="_token"]').val();
			$.ajax({
				url:"{{route('administrador.proyecto.create')}}",
				method:"POST",
				data:{query:query,_token:_token},
				success:function(data){
					$('#list_cliente').fadeIn();
					$('#list_cliente').html(data);
				}
			});
		}
	});

	$(document).on('click','.idlist',function(){
		var texto = $(this).text();
		var string = texto.split(' ');
		var idestudiante = string[0];

		$('#Idcliente').val(string[1]+' '+string[2]+' '+string[3]);
		$('#input_idpersona').val(string[0]);
		$('#list_dni').fadeOut();
		$("#Idcliente").prop("readonly",true);
	});
	
	$(document).click(function() {
    	$('#iddropdownmenu').fadeOut(300);
	});

	$(document).on('click','#Idlimpiar',function(){
		//alert('aca');
		$('#Idcliente').val('');
		$("#Idcliente").prop("readonly",false);
		$('#input_idpersona').val();
	});	
});
</script>
@endpush