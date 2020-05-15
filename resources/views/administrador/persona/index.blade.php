@extends('layouts.admin')
@section('contenido')
<div class="accordion" id="accordionExample" style="padding: 5px">
  <div class="card">
<!--**************HEADER MENU NAV*************-->
    <div class="card-header" id="headingOne" style="padding: 0px;box-shadow: 0 -2px 0px 0px rgba(115,115,115,0.4);">
      <div style="padding: 10px">
        <div style="float: left;color: #7B7B7B">
          <span><a href="{{URL::to('home')}}"><i class="fas fa-home"></i></a> </span> /
          <span>Persona</span>
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
      <h3><strong style="border-bottom: 2px solid #D9D9DD;padding-bottom: 4px;">Persona</strong> <a href="{{URL::to('administrador/persona/create')}}"><button class="btn btn-default bg-secondary">Nuevo <i class="fas fa-plus-square"></i></button></a></h3>
   </div>
   <div class="col-md-6">
     <h3>@include('administrador.persona.search')</h3>
   </div> 
</div>

<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
   <table class="table table-bordered table-sm table-striped">
     <thead class="bg-secondary">
       <tr>
         <th style="text-align: center;">N°</th>
         <th>Nombres</th>
         <th>Apellidos</th>
         <th>Correo</th>
         <th>Celular</th>
         <th>DNI</th>
         <th colspan="3">Opciones</th>
       </tr>
     </thead>   
     <tbody>
       <?php for($i=0;$i<sizeof($persona);$i++){
        ?>
        <tr>
          <th style="text-align: center;">{{$i+$first}}</th>
          <td>{{$persona[$i]->cnombre}}</td>
          <td>{{$persona[$i]->capaterno.' '.$persona[$i]->camaterno}}</td>
          <td>{{$persona[$i]->ccorreo}}</td>
          <td>{{$persona[$i]->ccelular}}</td>
          <td>{{$persona[$i]->cdocnro}}</td>
          <td style="text-align: center;">
            <a href="{{URL::action('Administrador\PersonaController@show',$persona[$i]->nid_persona)}}"><button class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="right" title="Mostrar"><i class="far fa-eye"></i></button></a>
          </td>
          <td style="text-align: center;">
            <a href="{{URL::action('Administrador\PersonaController@edit',$persona[$i]->nid_persona)}}"><button class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="right" title="Editar"><i class="fas fa-user-edit"></i></button></a>
          </td>
          <td style="text-align: center;">
            <span data-toggle="tooltip" data-placement="right" title="Eliminar"><button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModaldel{{$i}}"><i class="far fa-trash-alt"></i></button></span>
              <!--*****************MODAL ELIMINAR*************-->
                <div class="modal fade modal-slide-in-right" aria-hidden="true"
                role="dialog" tabindex="-1" id="myModaldel{{$i}}">
                {{Form::Open(array('action'=>array('Administrador\PersonaController@destroy',$persona[$i]->nid_persona),'method'=>'delete'))}}
                  {{Form::token()}}
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" style="background-color: #C83B3B;color: #FFFFFF">
                        <h4 class="modal-title"><i class="fas fa-exclamation-triangle"></i> ELIMINAR:  {{$persona[$i]->cnombre}}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                      </div>
                      <div class="modal-body">
                        <strong>Confirmar para eliminar</strong>
                      </div>
                      <div class="modal-footer">
                      <input type="hidden" name="id_producto" value="{{$persona[$i]->nid_persona}}">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>                        
                        <button type="submit" class="btn btn-danger" name="eliminar">Confirmar</button>
                      </div>
                    </div>
                  </div>
                  {{Form::Close()}}
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

{{ $persona->links() }}

</div>
<!--**************BODY MAIN*************-->
</div>
</div>
</div>
@endsection

@push('scripts')
<script>
  <?php if(isset($info) and $info == 1){
  ?>
    Swal.fire({
    position: 'center',
    type: 'success',
    title: 'Persona registrado',
    showConfirmButton: false,
    timer: 1500
})
  <?php  
}?>

<?php if(isset($info) and $info == 2){
  ?>
    Swal.fire({
  position: 'center',
  type: 'success',
  title: 'Persona actualizado',
  showConfirmButton: false,
  timer: 1500
})
  <?php  
}?>


<?php if(isset($info) and $info == 3){
  ?>
    Swal.fire({
    position: 'center',
    type: 'success',
    title: 'Persona eliminado',
    showConfirmButton: false,
    timer: 1500
})
  <?php  
}?>

</script>
@endpush