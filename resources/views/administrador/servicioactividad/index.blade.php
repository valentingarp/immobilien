@extends('layouts.admin')
@section('contenido')
<div class="accordion" id="accordionExample" style="padding: 5px">
  <div class="card">
<!--**************HEADER MENU NAV*************-->
    <div class="card-header" id="headingOne" style="padding: 0px;box-shadow: 0 -2px 0px 0px rgba(115,115,115,0.4);">
      <div style="padding: 10px">
        <div style="float: left;color: #7B7B7B">
          <span><a href="{{URL::to('home')}}"><i class="fas fa-home"></i></a> </span> /
          <span>Matriz de proceso </span>
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
    <h3><strong style="border-bottom: 2px solid #D9D9DD;padding-bottom: 4px;">Matriz de procesos</strong> <a href="" data-toggle="modal" data-target="#createproceso"></a></h3>
  </div>
  <div class="col-md-6">
     <h3>@include('administrador.servicioactividad.search')</h3>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <h2>
      Actividad &nbsp;&nbsp;<span data-toggle="tooltip" data-placement="right" title="Agregar servicios a este proceso" ><i class="fas fa-plus-circle text-primary" style="" data-toggle="modal" data-target="#modaladdacti"></i></span>
    </h2>
    <div class="table-responsive">
      <table class="table table-sm table-bordered">
        <thead class="bg-secondary">
          <tr>
            <th width="2%">N°</th>
            <th >Servicios</th>
            <?php for($e=0; $e < sizeof($etap); $e++){
              ?>
            <th>
              Etap. {{$etap[$e]->ncodetapa}}
            </th>
              <?php
            }?>
          </tr>
        </thead>
        <tbody>
          <?php for($i=0;$i<sizeof($proser);$i++){
            ?>
          <tr>
            <th>{{$i+1}}</th>
            <th >
              {{$proser[$i]->cservicio}}
            </th>
              <?php for($e = 0;$e<sizeof($etap);$e++){
                echo '<td>';
                for($a=0; $a < sizeof($actividad); $a++){
                if($proser[$i]->nid_procesoservicio == $actividad[$a]->nid_procesoservicio && $actividad[$a]->ncodetapa == $etap[$e]->ncodetapa){
                  ?>
                   <div class="jumbotron" style="padding-top:1px;padding-bottom: 5px;margin-bottom: 5px">
                    
                    <p class="lead" style="margin-bottom: 2px">{{$actividad[$a]->cactividad}}</p>                    
                    <a class="" href="#" role="button" data-toggle="modal" data-target="#modaledit{{$actividad[$a]->nid_servicioactividad}}"><i class="far fa-edit" data-toggle="tooltip" data-placement="top" title="Editar"></i></a>
                    <a class="" href="#" role="button" data-toggle="modal" data-target="#myModaldel{{$actividad[$a]->nid_servicioactividad}}"><i class="far fa-trash-alt" data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a>
                  </div>
                
                <!--***********MODAL UPDATE*******-->
              <div class="modal fade" id="modaledit{{$actividad[$a]->nid_servicioactividad}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              {!!Form::model($proceso,['method'=>'PATCH','action'=>['Administrador\ServicioActividadController@update',$actividad[$a]->nid_actividad],'class'=>'form-horizontal'])!!}
                    {{Form::token()}}
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-secondary">
                      <h5 class="modal-title" id="myModalLabel">Editar actividad</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                      
                    </div>
                    <div class="modal-body">
                      <div class="form-group row">
                        <label for="" class="col-form-label col-md-4 text-left">Actividad:</label>
                        <div class="col-md-8">
                          <textarea name="actividad" id="" cols="10" rows="2" class="form-control" required>{{$actividad[$a]->cactividad}}</textarea>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <?php if(isset($_GET['proceso'])){
                        ?>
                        <input type="hidden" name="proceso" value="{{$_GET['proceso']}}">
                          <?php
                        }?>
                      <button type="button" class="btn btn-default bg-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-danger">GUARDAR</button>
                    </div>
                  </div>
                  </div>
                {{Form::close()}}                
                </div>            
           
            <!--***********FIN****MODAL UPDATE*******-->

                  <!--*****************MODAL ELIMINAR*************-->
                <div class="modal fade modal-slide-in-right" aria-hidden="true"
                role="dialog" tabindex="-1" id="myModaldel{{$actividad[$a]->nid_servicioactividad}}">

                {{Form::Open(array('action'=>array('Administrador\ServicioActividadController@destroy',$actividad[$a]->nid_servicioactividad),'method'=>'delete'))}}
                
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" style="background-color: #C83B3B;color: #FFFFFF">
                        <h4 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Eiminar actividad</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                      </div>
                      <div class="modal-body">
                        <h5>{{$actividad[$a]->cactividad}}</h5>
                        <strong>Confirmar para eliminar</strong>
                      </div>
                      <div class="modal-footer">
                        <?php if(isset($_GET['proceso'])){
                        ?>
                        <input type="hidden" name="proceso" value="{{$_GET['proceso']}}">
                          <?php
                        }?>                        
                        <button type="button" class="btn btn-default bg-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger" name="eliminar">Confirmar</button>
                      </div>
                    </div>
                  </div>
                 {{Form::close()}}
                </div>
                <!--*****************FIN***MODAL ELIMINAR*************-->

                  <?php
                }
              }
              echo '</td>';
            }?> 
                      
          </tr>
            <?php
          }?>
        </tbody>

      </table>

    </div>
  </div>
</div>


            <!--*****************MODAL ADD ACTIVIDAD*************-->
                <div class="modal fade modal-slide-in-right" aria-hidden="true"
                role="dialog" tabindex="-1" id="modaladdacti">

                <form action="" method="post">
                {{Form::token()}}
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header bg-primary" >
                        <h6 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Agregar una Actividad</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group row">
                        <label for="" class="col-form-label col-md-4 text-left">Servicio:</label>
                        <div class="col-md-8">
                          <select name="nid_procesoservicio" id="" class="form-control" required="">
                            <option value="">======= Seleccion ======</option>
                            <?php for($s=0;$s < sizeof($proser); $s++){
                              ?>
                            <option value="{{$proser[$s]->nid_procesoservicio}}">{{$proser[$s]->cservicio}}</option>
                              <?php
                            }?>
                          </select>
                        </div>
                      </div>
                        <div class="form-group row">
                        <label for="" class="col-form-label col-md-4 text-left">Etapa:</label>
                        <div class="col-md-8">
                          <select name="ncodetapa" id="" class="form-control" required="">
                            <option value="">======= Seleccion ======</option>
                            <?php for($e=0;$e < sizeof($etapas); $e++){
                              ?>
                            <option value="{{$etapas[$e]->nvalor}}">{{$etapas[$e]->cdescripcion}}</option>
                              <?php
                            }?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="" class="col-form-label col-md-4 text-left">Nueva Actividad:</label>
                        <div class="col-md-8">
                          <textarea name="cactividad" id="" cols="10" rows="3" class="form-control" placeholder="Nombre de la actividad" required=""></textarea>
                        </div>
                      </div>
                    
                      </div>
                      <div class="modal-footer">                  
                        <button type="button" class="btn btn-default bg-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger" name="addactividad">Agregar</button>
                      </div>
                    </div>
                  </div>
                 {{Form::close()}}
                </div>
                <!--*****************FIN***MODAL ACTIVIDAD*************-->

<!--**************BODY MAIN*************-->
</div>
</div>
</div>
@push('scripts')
<script>

  <?php if( (isset($info) and $info ==1) or (isset($_GET['info']) and $_GET['info'] == 1 )) {
  ?>
    Swal.fire({
    position: 'center',
    type: 'success',
    title: 'Hecho!',
    showConfirmButton: false,
    timer: 1500
    })
    <?php  
  }?>
</script>
@endpush
@endsection