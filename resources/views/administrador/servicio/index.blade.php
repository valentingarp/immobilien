@extends('layouts.admin')
@section('contenido')
<div class="accordion" id="accordionExample" style="padding: 5px">
  <div class="card">
<!--**************HEADER MENU NAV*************-->
    <div class="card-header" id="headingOne" style="padding: 0px;box-shadow: 0 -2px 0px 0px rgba(115,115,115,0.4);">
      <div style="padding: 10px">
        <div style="float: left;color: #7B7B7B">
          <span><a href="{{URL::to('home')}}"><i class="fas fa-home"></i></a> </span> /
          <span>Servicio </span>
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
    <h3><strong style="border-bottom: 2px solid #D9D9DD;padding-bottom: 4px;">SERVICIO</strong> <a href="" data-toggle="modal" data-target="#createservicio"><button class="btn btn-default bg-secondary" >Nuevo <i class="fas fa-plus-square"></i></button></a></h3>
  </div>
  <div class="col-md-6">
     <h3>@include('administrador.servicio.search')</h3>
  </div>
</div>
<br>

<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
      <table class="table table-sm table-bordered">
        <thead class="bg-secondary">
          <tr>
            <th>N°</th>
            <th>Servicio</th>
            <th >Opciones </th>
          </tr>
        </thead>
        <tbody>
          <?php for($i=0;$i<sizeof($servicio);$i++){
            ?>
          <tr>
            <th>{{$i+1}}</th>
            <td>{{$servicio[$i]->cservicio}}</td>              
            <td style="text-align: center;">

            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal{{$i}}"> <span data-toggle="tooltip" data-placement="left" title="Editar"><i class="fas fa-edit"></i></span></button>

<!--***********MODAL UPDATE*******-->
              <div class="modal fade" id="myModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              {!!Form::model($servicio,['method'=>'PATCH','action'=>['Administrador\ServicioController@update',$servicio[$i]->nid_servicio],'class'=>'form-horizontal'])!!}
                    {{Form::token()}}
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header bg-secondary">
                      <h5 class="modal-title" id="myModalLabel">EDITAR SERVICIO</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                      
                    </div>
                    <div class="modal-body">
                      <div class="form-group row">
                        <label for="" class="col-form-label col-md-4 text-left">Servicio:</label>
                        <div class="col-md-8">
                          <input type="text" value="{{$servicio[$i]->cservicio}}" name="cservicio" class="form-control" style="text-transform: uppercase" onKeyUp="this.value=this.value.toUpperCase();">  
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default bg-secondary" data-dismiss="modal">CERRAR</button>
                      <button type="submit" class="btn btn-danger">GUARDAR CAMBIOS</button>
                    </div>
                  </div>
                  </div>
                {{Form::close()}}                
                </div>            
           
            <!--***********FIN****MODAL UPDATE*******-->
                <span data-toggle="tooltip" data-placement="right" title="Eliminar"><button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModaldel{{$i}}"><i class="far fa-trash-alt"></i></button></span>
              <!--*****************MODAL ELIMINAR*************-->
                <div class="modal fade modal-slide-in-right" aria-hidden="true"
                role="dialog" tabindex="-1" id="myModaldel{{$i}}">

                {{Form::Open(array('action'=>array('Administrador\ServicioController@destroy',$servicio[$i]->nid_servicio),'method'=>'delete'))}}
                
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" style="background-color: #C83B3B;color: #FFFFFF">
                        <h4 class="modal-title"><i class="fas fa-exclamation-triangle"></i> ELIMINAR SERVICIO:  {{$servicio[$i]->cservicio}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                      </div>
                      <div class="modal-body">
                        <strong>Confirmar para eliminar</strong>
                      </div>
                      <div class="modal-footer">
                      <input type="hidden" name="nid_aula" value="{{$servicio[$i]->nid_servicio}}">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                        
                        <button type="submit" class="btn btn-danger" name="eliminar">Confirmar</button>
                      </div>
                    </div>
                  </div>
                 {{Form::close()}}
                </div>
                <!--*****************FIN***MODAL ELIMINAR*************-->
      
            </td>

          </tr>
            <?php
          }?>
        </tbody>

      </table>

    </div>
  </div>
</div>


<div class="modal fade" id="createservicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   {!!Form::open(array('url'=>'administrador/servicio','method'=>'POST','autocomplete'=>'off'))!!}
  {{Form::token()}}
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-secondary" >
        <h5 class="modal-title" id="exampleModalLabel">CREAR SERVICIO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
          <div class="form-group row">
          <label for="Nombre" class="col-sm-3 col-form-label">Servicio:</label>
          <div class="col-sm-9">
             <input type="text" class="form-control" name="cservicio" placeholder="Servicio">
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn" style="background: #b90d0d;color: #FFFFFF"><i class="far fa-save"></i> GUARDAR</button>
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

</script>
@endpush
@endsection