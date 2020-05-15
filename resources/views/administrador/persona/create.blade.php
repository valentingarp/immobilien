@extends('layouts.admin')
@section('contenido')
<div class="accordion" id="accordionExample" style="padding: 5px">
  <div class="card">
<!--**************HEADER MENU NAV*************-->
    <div class="card-header" id="headingOne" style="padding: 0px;box-shadow: 0 -2px 0px 0px rgba(115,115,115,0.4);">
      <div style="padding: 10px">
        <div style="float: left;color: #7B7B7B">
          <span><a href="{{URL::to('home')}}"><i class="fas fa-home"></i></a> </span> /
          <span><a href="{{URL::to('administrador/persona')}}">Persona</a></span> /
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
      <h4 style="margin-top: 0px"><i class="fas fa-user-edit"></i> Registrar persona</h4>
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
        
  {!!Form::open(array('url'=>'administrador/persona','method'=>'POST','autocomplete'=>'off','files'=>true,'class'=>'formcreate'))!!}
            {{Form::token()}}
            	<div class="form-group row">
					<label for="Nombre" class="col-sm-2 col-form-label">Personería:</label>
					<div class="col-sm-4">
						<select name="personeria" id="selpersoneria" class="form-control">
							
							<option value="1">NATURAL</option>
							
						</select>
					</div>
					<label for="Nombre" class="col-sm-2 col-form-label">Tipo persona:</label>
					<div class="col-sm-4">
						<select name="tipopersona" id="" class="form-control">
							<?php for($i=0;$i<sizeof($tipopersona);$i++){
								?>
							<option value="{{$tipopersona[$i]->nid_tipopersona}}">{{$tipopersona[$i]->cpersona}}</option>
								<?php
							}?>
						</select>
					</div>
				</div>

				<div id="razonrow" style="display: none">
					<div class="form-group row">
						<label for="Nombre" class="col-sm-2 col-form-label">* Razon Social:</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" placeholder="Razon social" name="razonsocial" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" id="idrazon">
						</div>
					</div>
				</div>
				<div id="nombresape">
				<div class="form-group row">
					<label for="Nombre" class="col-sm-2 col-form-label">* Nombres:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" placeholder="Nombre" name="cnombre" required="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" id="idnombre">
					</div>
				</div>
				<div class="form-group row" id="paternorow">
					<label for="Nombre" class="col-sm-2 col-form-label">* Apellido paterno:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" placeholder="Apellido paterno" name="cpaterno" required="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" id="idapaterno">
					</div>
				</div>
				<div class="form-group row" id="maternorow">
					<label for="Nombre" class="col-sm-2 col-form-label">* Apellido materno:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" placeholder="Apellido materno" name="cmaterno" required="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" id="idamaterno">
					</div>
				</div>
				</div>

				<div class="form-group row">
					<label for="Nombre" class="col-sm-2 col-form-label">* Fecha de nacimiento:</label>
					<div class="col-sm-4">
						<input type="date" class="form-control" name="dfnacimento" required="">
					</div>
					<select id="selectdniii" onchange="selectdni(this.value)" class="form-control col-sm-2" name="tipodocumento">
						<?php for($i=0;$i<sizeof($doc);$i++){
							?>
						<option value="{{$doc[$i]->nvalor}}">* {{$doc[$i]->cdescripcion}}</option>
							<?php
						}?>
					</select>
					<div class="col-sm-4">
						<input type="number" class="form-control" placeholder="Número de documento" name="numero_de_documento" onKeyPress="if(this.value.length==8) return false;" required="" onwheel="this.blur()" id="numerodoc">
					</div>
				</div>
				<div class="form-group row">
					<label for="Nombre" class="col-sm-2 col-form-label">N° celular:</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" placeholder="Número de celular" name="ccelular" onwheel="this.blur()">
					</div>
					<label for="Nombre" class="col-sm-2 col-form-label">N° teléfono:</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" placeholder="Número de teléfono" name="ctelefono" onwheel="this.blur()">
					</div>
				</div>
				<div class="form-group row">
					<label for="Nombre" class="col-sm-2 col-form-label">* Dirección:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" placeholder="Calle N° 000" name="cdomicilio" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required="">
					</div>
				</div>
				<div class="form-group row">
					<label for="Nombre" class="col-sm-2 col-form-label">Referencia:</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" placeholder="Referencia" name="creferencia" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">
					</div>
					<label for="Nombre" class="col-sm-2 col-form-label">* Ciudad:</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" placeholder="Nombre de la Ciudad" name="ciudad" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required="">
					</div>
				</div>
				
				<div class="form-group row">
					<label for="Nombre" class="col-sm-2 col-form-label">* Región:</label>
					<div class="col-sm-4">
						<select name="region_domicilio" id="regiondo" class="form-control" required="">
			              <option value="">========== seleccione =========</option>
			              <?php for($i=0;$i<sizeof($regiones);$i++){
			                ?>
			              <option value="{{$regiones[$i]->cubigeo_regions}}">{{$regiones[$i]->nomregion}}</option>
			                <?php
			              }?>
			            </select>
					</div>
					<label for="Nombre" class="col-sm-2 col-form-label">* Provincia:</label>
					<div class="col-sm-4">
						<select name="provincia_domicilio" id="provinciado" class="form-control" required="">
			              <option value="">========== seleccione =========</option>
			            </select>
					</div>
				</div>
				<div class="form-group row">
					<label for="Nombre" class="col-sm-2 col-form-label">* Distrito:</label>
					<div class="col-sm-4">
						<select name="distrito_domicilio" id="distritodo" class="form-control" required="">
			              <option value="">========== seleccione =========</option>
			            </select>
					</div>
					<label for="Nombre" class="col-sm-2 col-form-label">Correo:</label>
					<div class="col-sm-4">
						<input type="email" class="form-control" placeholder="Correo personal" name="ccorreo">
					</div>
				</div>

				<div class="form-group row">
					<label  class="col-sm-2 col-form-label">* Sexo:</label>
					<div class="col-md-4">
					<select name="sexo" required="" class="form-control">
						<option value="">========= SELECCIONE ========</option>
						<?php for($i=0;$i<sizeof($sex);$i++){
							?>
						<option value="{{$sex[$i]->nvalor}}"> {{$sex[$i]->cdescripcion}}</option>
							<?php
						}?>
					</select>
				 	</div>
		        	<label  class="col-sm-2 col-form-label">* Servicio:</label>
					<div class="col-md-4">
					<select name="servicio" required="" class="form-control">
						<option value="">========= SELECCIONE ========</option>
						<?php for($i=0;$i<sizeof($servicio);$i++){
							?>
						<option value="{{$servicio[$i]->nid_servicio}}"> {{$servicio[$i]->cservicio}}</option>
							<?php
						}?>
					</select>
				 	</div>
		        </div>	

<br>
		      
		        	<div class="form-group row">
					<label  class="col-sm-3 col-form-label"><i class="fas fa-user-secret" style="font-size: 14pt"></i> * PERMISO DE MÓDULOS:</label>
					<div class="col-md-4">
					<select name="tipousuario" required="" class="form-control">
						<option value="">========= SELECCIONE ========</option>
						<?php for($i=0;$i<sizeof($permiso);$i++){
							?>
						<option value="{{$permiso[$i]->nid_tipousuario}}">{{$permiso[$i]->cusuario}}</option>
							<?php
						}?>
					</select>
					</div>
				
					<label  class="offset-md-1 col-sm-2 col-form-label"><i class="fas fa-lock"></i> Usuario activo: &nbsp;&nbsp;<input type="radio" name="activo" checked="" value="1"></label>
					

					<label  class="col-sm-2 col-form-label"><i class="fas fa-unlock"></i> Usuario inactivo: &nbsp;&nbsp;<input type="radio" name="activo" value="0"></label>
				

					</div>
				

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

  	var input=  document.getElementById('numerodoc');
	function selectdni(selecvaldni){//alert(selecvaldni);
	  $('#numerodoc').val('');
	  $("#numerodoc").removeAttr("onKeypress");//retirar el onKeypress inicial de 8 digitos
	  if(selecvaldni == 1){//dni
	    input.addEventListener('input',function(){
	    if (this.value.length > 8) 
	      this.value = this.value.slice(0,8); 
	    });
	  }
	  if (selecvaldni == 2) {//Ruc
	    input.addEventListener('input',function(){
	    if (this.value.length > 12) 
	      this.value = this.value.slice(0,12); 
	    });
	  }
	  if(selecvaldni == 3){//pasaporte
	    input.addEventListener('input',function(){
	    if (this.value.length > 7) 
	      this.value = this.value.slice(0,7); 
	    });
	  }
	  
	}

	$('#selpersoneria').on('change',function(){
		var id = $(this).val();
		if (id == 1) {//natural
			$('#nombresape').css('display','block');
			$('#razonrow').css('display','none');

			$('#idrazon').prop("required", false);

			$('#idnombre').prop("required", true);
			$('#idapaterno').prop("required", true);
			$('#idamaterno').prop("required", true);
		}
		if (id == 2) {//juridica
			$('#razonrow').css('display','block');
			$('#nombresape').css('display','none');
			
			$('#idnombre').prop("required", false);
			$('#idapaterno').prop("required", false);
			$('#idamaterno').prop("required", false);

			$('#idrazon').prop("required", true);
		}
		
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