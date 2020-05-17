@extends('layouts.admin')
@section('contenido')
<div class="accordion" id="accordionExample" style="padding: 5px">
  <div class="card">
<!--**************HEADER MENU NAV*************-->
    <div class="card-header" id="headingOne" style="padding: 0px;box-shadow: 0 -2px 0px 0px rgba(115,115,115,0.4);">
      <div style="padding: 10px">
        <div style="float: left;color: #7B7B7B">
          <span><a href="{{URL::to('home')}}"><i class="fas fa-home"></i></a> </span> /
          <span>Proceso </span>
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
    <h3><strong style="border-bottom: 2px solid #D9D9DD;padding-bottom: 4px;">PROCESO</strong> <a href="" data-toggle="modal" data-target="#createproceso"><button class="btn btn-default bg-secondary" >Nuevo <i class="fas fa-plus-square"></i></button></a></h3>
  </div>
  <div class="col-md-6">
     <h3>@include('administrador.proceso.search')</h3>
  </div>
</div>
<br>

<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
      <table class="table table-sm table-bordered">
        <thead class="bg-secondary">
          <tr>
            <th width="2%">N°</th>
            <th width="22%" colspan="2">Proceso</th>
            <th width="60%">Servicios </th>
            <th width="4%">Add serv.</th>
          </tr>
        </thead>
        <tbody>
          <?php for($i=0;$i<sizeof($proceso);$i++){
            ?>
          <tr>
            <th>{{$i+1}}</th>
            <td style="border-right:solid 1px #FFFFFF">{{$proceso[$i]->cproceso}}
            </td>
            <td >
               <a class="text-warning" data-toggle="modal" data-target="#myModal{{$i}}" > <span data-toggle="tooltip" data-placement="left" title="Editar proceso"><i class="fas fa-edit"></i></span></a>

<!--***********MODAL UPDATE*******-->
              <div class="modal fade" id="myModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              {!!Form::model($proceso,['method'=>'PATCH','action'=>['Administrador\ProcesoController@update',$proceso[$i]->nid_proceso],'class'=>'form-horizontal'])!!}
                    {{Form::token()}}
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-secondary">
                      <h5 class="modal-title" id="myModalLabel">EDITAR PROCESO</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                      
                    </div>
                    <div class="modal-body">
                      <div class="form-group row">
                        <label for="" class="col-form-label col-md-4 text-left">Proceso:</label>
                        <div class="col-md-8">
                          <input type="text" value="{{$proceso[$i]->cproceso}}" name="cproceso" class="form-control" style="text-transform: uppercase" onKeyUp="this.value=this.value.toUpperCase();" required="">  
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default bg-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-danger">GUARDAR</button>
                    </div>
                  </div>
                  </div>
                {{Form::close()}}                
                </div>            
           
            <!--***********FIN****MODAL UPDATE*******-->
                <span data-toggle="tooltip" data-placement="right" title="Eliminar proceso"><a class="text-danger" data-toggle="modal" data-target="#myModaldel{{$i}}"><i class="far fa-trash-alt"></i></a></span>
              <!--*****************MODAL ELIMINAR*************-->
                <div class="modal fade modal-slide-in-right" aria-hidden="true"
                role="dialog" tabindex="-1" id="myModaldel{{$i}}">

                {{Form::Open(array('action'=>array('Administrador\ProcesoController@destroy',$proceso[$i]->nid_proceso),'method'=>'delete'))}}
                
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" style="background-color: #C83B3B;color: #FFFFFF">
                        <h4 class="modal-title"><i class="fas fa-exclamation-triangle"></i> ELIMINAR SERVICIO:  {{$proceso[$i]->cproceso}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                      </div>
                      <div class="modal-body">
                        <strong>Confirmar para eliminar</strong>
                      </div>
                      <div class="modal-footer">
                      <input type="hidden" name="nid_aula" value="{{$proceso[$i]->nid_proceso}}">
                        <button type="button" class="btn btn-default bg-secondary" data-dismiss="modal">Cerrar</button>                        
                        <button type="submit" class="btn btn-danger" name="eliminar">Confirmar</button>
                      </div>
                    </div>
                  </div>
                 {{Form::close()}}
                </div>
                <!--*****************FIN***MODAL ELIMINAR*************-->
            </td>              
            <td style="text-align: center;">

              <?php $num = 1; for($j=0;$j<sizeof($proser);$j++){
                if ($proceso[$i]->nid_proceso == $proser[$j]->nid_proceso) {
                  ?>
                  <span class="d-block p-2 bg-success text-white" style="margin-bottom: 5px">
                    <h5 style="text-align:left;">{{$num}}. {{$proser[$j]->cservicio}}&nbsp;&nbsp; 
                       <span data-toggle="tooltip" data-placement="top" title="Editar servicio">
                        <i class="fas fa-edit text-white" data-toggle="modal" data-target="#editservi{{$j}}" style="font-size: 10pt"></i>
                      </span>
                      <!--*****************MODAL EDITAR SERVICIOS*************-->
                      <div class="modal fade modal-slide-in-right" aria-hidden="true"
                      role="dialog" tabindex="-1" id="editservi{{$j}}">
                      <form action="" method="post">
                      {{Form::token()}}
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header bg-secondary">
                              <h4 class="modal-title text-dark"><i class="fas fa-edit"></i> Editar servicio:  {{$proser[$j]->cservicio}}</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                              <div class="modal-body">
                              <div class="form-group row">
                              <label style="color: #4B4B4B" class="col-form-label col-md-4 text-left">Nombre:</label>
                              <div class="col-md-8">
                                <input type="text" value="{{$proser[$j]->cservicio}}" name="cservicio" class="form-control" placeholder="Servicio" required="">
                              </div>
                            </div>
                            </div>
                            <div class="modal-footer">
                            <input type="hidden" name="nid_servicio" value="{{$proser[$j]->nid_servicio}}">
                            <input type="hidden" name="nid_procesoservicio" value="{{$proser[$j]->nid_procesoservicio}}">
                              <button type="button" class="btn btn-default bg-secondary" data-dismiss="modal">Cerrar</button>
                              <button type="submit" class="btn btn-danger" name="editservicio">GUARDAR</button>
                            </div>
                          </div>
                        </div>
                       {{Form::close()}}
                      </div>
                      <!--*****************FIN***EDITAR SERVICIOS*************-->

                      <span data-toggle="tooltip" data-placement="top" title="Eliminar servicio">
                        <i class="far fa-trash-alt text-white" data-toggle="modal" data-target="#delservicio{{$j}}" style="font-size: 10pt"></i>
                      </span>
                        <!--*****************MODAL ELIMINAR SERVICIO*************-->
                        <div class="modal fade modal-slide-in-right" aria-hidden="true"
                        role="dialog" tabindex="-1" id="delservicio{{$j}}">

                        <form action="" method="post">
                        {{Form::token()}}
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header" style="background-color: #C83B3B;color: #FFFFFF">
                                <h4 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Eliminar servicio</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                              </div>
                              <div class="modal-body">
                                <p style="color: #646464">Eliminar el servicio <b>{{$proser[$j]->cservicio}}</b> del proceso {{$proser[$j]->cproceso}}</p>
                              </div>
                              <div class="modal-footer">
                              <input type="hidden" name="nid_procesoservicio" value="{{$proser[$j]->nid_procesoservicio}}">
                                <button type="button" class="btn btn-default bg-secondary" data-dismiss="modal">Cerrar</button>                        
                                <button type="submit" class="btn btn-danger" name="delservicio">Confirmar</button>
                              </div>
                            </div>
                          </div>
                         {{Form::close()}}
                        </div>
                        <!--*****************FIN***MODAL ELIMINAR SERVICIO*************-->
                    </h5>  
                  </span>
                  
                  <?php $num++;
                }
              }?>
      
            </td>
            <td style="text-align: center;">
             <span data-toggle="tooltip" data-placement="right" title="Agregar servicios a este proceso" ><i class="fas fa-plus-circle text-primary" style="font-size: 12pt" data-toggle="modal" data-target="#addservi{{$i}}"></i></span>
              <!--*****************MODAL ADD SERVICIOS*************-->
                <div class="modal fade modal-slide-in-right" aria-hidden="true"
                role="dialog" tabindex="-1" id="addservi{{$i}}">

                <form action="" method="post">
                {{Form::token()}}
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header bg-primary" >
                        <h4 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Agregar servicio.  {{$proceso[$i]->cproceso}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group row">
                        <label for="" class="col-form-label col-md-4 text-left">Nuevo servicio:</label>
                        <div class="col-md-8">
                          <input type="text" name="cservicio" class="form-control" placeholder="Servicio" required="">
                        </div>
                      </div>
                      </div>
                      <div class="modal-footer">
                      <input type="hidden" name="nid_proceso" value="{{$proceso[$i]->nid_proceso}}">
                        <button type="button" class="btn btn-default bg-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger" name="addservicio">Agregar</button>
                      </div>
                    </div>
                  </div>
                 {{Form::close()}}
                </div>
                <!--*****************FIN***MODAL SERVICIOS*************-->
            </td>

          </tr>
            <?php
          }?>
        </tbody>

      </table>

    </div>
  </div>
</div>


<div class="modal fade" id="createproceso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <form action="" method="post">
  {{Form::token()}}
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-secondary" >
        <h5 class="modal-title" id="exampleModalLabel">CREAR PROCESO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
        
          <div class="form-group row">
          <label for="Nombre" class="col-sm-3 col-form-label">Proceso:</label>
          <div class="col-sm-9">
             <input type="text" class="form-control" name="cproceso" placeholder="Proceso" required="">
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary bg-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn bg-danger" name="addproceso"><i class="far fa-save"></i> GUARDAR</button>
      </div>
    </div>
  </div>
  {{!!Form::close()!!}}
</div>

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