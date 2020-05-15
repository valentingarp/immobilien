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
          <span>Detalle</span>
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
        <h4 style="margin-top: 0px"><i class="fas fa-user-edit"></i> Detalle Persona &nbsp;&nbsp;<a href="{{URL::to('administrador/persona/'.$persona[0]->nid_persona.'/edit')}}" style="font-size: 11pt">Editar</a></h4>
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

   <div class="form-group row">
          <label for="Nombre" class="col-sm-2 col-form-label">Personería:</label>
          <div class="col-sm-4">
            <select name="personeria" id="selpersoneria" class="form-control" disabled="">
              <option value="{{$persona[0]->npersoneria}}">{{$persona[0]->personeria}}</option>
            </select>
          </div>
          <label for="Nombre" class="col-sm-2 col-form-label">Tipo persona:</label>
          <div class="col-sm-4">
            <select name="tipopersona" id="" class="form-control" disabled="">
              <?php for($i=0;$i<sizeof($tipopersona);$i++){
                if ($persona[0]->nid_tipopersona == $tipopersona[$i]->nid_tipopersona) {
                  ?>
                <option value="{{$tipopersona[$i]->nid_tipopersona}}" selected="">{{$tipopersona[$i]->cpersona}}</option>
                  <?php
                }else{
                  ?>
                <option value="{{$tipopersona[$i]->nid_tipopersona}}">{{$tipopersona[$i]->cpersona}}</option>
                  <?php
                }
              }?>
            </select>
          </div>
        </div>
        <?php if($persona[0]->tipopersoneria == 2){ ?>

        <div id="razonrow" >
          <div class="form-group row">
            <label for="Nombre" class="col-sm-2 col-form-label">* Razon Social:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" placeholder="Razon social" name="razonsocial" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" id="idrazon" value="{{$persona[0]->cnombre}}" disabled="">
            </div>
          </div>
        </div>
        <?php }else{ ?>
        <div id="nombresape">
        <div class="form-group row">
          <label for="Nombre" class="col-sm-2 col-form-label">* Nombres:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Nombre" name="cnombre" required="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" id="idnombre" value="{{$persona[0]->cnombre}}" disabled="">
          </div>
        </div>
        <div class="form-group row" id="paternorow">
          <label for="Nombre" class="col-sm-2 col-form-label">* Apellido paterno:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Apellido paterno" name="cpaterno" required="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" id="idapaterno" value="{{$persona[0]->capaterno}}" disabled="">
          </div>
        </div>
        <div class="form-group row" id="maternorow">
          <label for="Nombre" class="col-sm-2 col-form-label">* Apellido materno:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Apellido materno" name="cmaterno" required="" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" id="idamaterno" value="{{$persona[0]->camaterno}}" disabled="">
          </div>
        </div>
        </div>
      
      <?php }?>

        <div class="form-group row">
          <label for="Nombre" class="col-sm-2 col-form-label">* Fecha de nacimiento:</label>
          <div class="col-sm-4">
            <input type="date" class="form-control" name="dfnacimento" required="" value="{{$persona[0]->dfnacimiento}}" disabled="">
          </div>
          <select id="selectdniii" onchange="selectdni(this.value)" class="form-control col-sm-2" name="tipodocumento" disabled="">
            <?php for($i=0;$i<sizeof($doc);$i++){
              if ($persona[0]->idtipodoc == $doc[$i]->nvalor) {
                ?>
              <option value="{{$doc[$i]->nvalor}}" selected="">{{$doc[$i]->cdescripcion}}</option>
                <?php
              }else{
                ?>
              <option value="{{$doc[$i]->nvalor}}">{{$doc[$i]->cdescripcion}}</option>    
                <?php
              }
            }?>
          </select>
          <div class="col-sm-4">
            <input type="number" class="form-control" placeholder="Número de documento" name="numero_de_documento" onKeyPress="if(this.value.length==8) return false;" required="" onwheel="this.blur()" id="numerodoc" value="{{$persona[0]->cdocnro}}" disabled="">
          </div>
        </div>
        <div class="form-group row">
          <label for="Nombre" class="col-sm-2 col-form-label">N° celular:</label>
          <div class="col-sm-4">
            <input type="number" class="form-control" placeholder="Número de celular" name="ccelular" onwheel="this.blur()" value="{{$persona[0]->ctelefono}}" disabled="">
          </div>
          <label for="Nombre" class="col-sm-2 col-form-label">N° teléfono:</label>
          <div class="col-sm-4">
            <input type="number" class="form-control" placeholder="Número de teléfono" name="ctelefono" onwheel="this.blur()" value="{{$persona[0]->ccelular}}" disabled="">
          </div>
        </div>
        <div class="form-group row">
          <label for="Nombre" class="col-sm-2 col-form-label">Dirección:</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Calle N° 000" name="cdomicilio" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required="" value="{{$persona[0]->cdomicilio}}" disabled="">
          </div>
        </div>
        <div class="form-group row">
          <label for="Nombre" class="col-sm-2 col-form-label">Referencia:</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" placeholder="Referencia" name="creferencia" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value="{{$persona[0]->creferencia}}" disabled="">
          </div>
          <label for="Nombre" class="col-sm-2 col-form-label">Ciudad:</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" placeholder="Nombre de la Ciudad" name="ciudad" style="text-transform: uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required="" value="{{$persona[0]->cciudad}}" disabled="">
          </div>
        </div>
        
        <div class="form-group row">
          <label for="Nombre" class="col-sm-2 col-form-label">Región:</label>
          <div class="col-sm-4">
            <select name="region_domicilio" id="regiondo" class="form-control" required="" disabled="">
                    <option value="">========== seleccione =========</option>
                    <?php for($i=0;$i<sizeof($regiones);$i++){
                      if ($persona[0]->cubigeo_regions == $regiones[$i]->cubigeo_regions) {
                        ?>
                      <option value="{{$regiones[$i]->cubigeo_regions}}" selected="">{{$regiones[$i]->nomregion}}</option>
                        <?php
                      }else{
                        ?>
                      <option value="{{$regiones[$i]->cubigeo_regions}}">{{$regiones[$i]->nomregion}}</option>
                        <?php
                      }
                    }?>
                  </select>
          </div>
          <label for="Nombre" class="col-sm-2 col-form-label">Provincia:</label>
          <div class="col-sm-4">
            <select name="provincia_domicilio" id="provinciado" class="form-control" required="" disabled="">
                    <option value="">========== seleccione =========</option>
                   
                      <option value="{{$persona[0]->cubigeo_provinces}}" selected="">{{$persona[0]->provincia}}</option>
                        
                  </select>
          </div>
        </div>
        <div class="form-group row">
          <label for="Nombre" class="col-sm-2 col-form-label">Distrito:</label>
          <div class="col-sm-4">
            <select name="distrito_domicilio" id="distritodo" class="form-control" required="" disabled="">
                    <option value="">========== seleccione =========</option>
                   
                      <option value="{{$persona[0]->cubigeo_districts}}" selected="">{{$persona[0]->distrito}}</option>
                      
                  </select>
          </div>
          <label for="Nombre" class="col-sm-2 col-form-label">Correo:</label>
          <div class="col-sm-4">
            <input type="email" class="form-control" placeholder="Correo personal" name="ccorreo" value="{{$persona[0]->ccorreo}}" disabled="">
          </div>
        </div>

        <div class="form-group row">
          <label  class="col-sm-2 col-form-label">
            <i class="fas fa-venus-mars" style="font-size: 14pt"></i>Sexo:</label>
          <div class="col-md-4">
          <select name="sexo" required="" class="form-control" disabled="">
            <option value="">========= SELECCIONE ========</option>
            <?php for($i=0;$i<sizeof($sex);$i++){
              if ($persona[0]->idsexo == $sex[$i]->nvalor) {
                ?>
              <option value="{{$sex[$i]->nvalor}}" selected=""> {{$sex[$i]->cdescripcion}}</option>
                <?php
              }else{
                ?>
              <option value="{{$sex[$i]->nvalor}}"> {{$sex[$i]->cdescripcion}}</option>
                <?php
              }
            }?>
          </select>
          </div>
              
            </div>  
        <br>
      
  </div>  
</div>

<!--**************BODY MAIN*************-->
</div>
</div>
</div>
</div>

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
@endsection