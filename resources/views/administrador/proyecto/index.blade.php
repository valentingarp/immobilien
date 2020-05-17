@extends('layouts.admin')
@section('contenido')
<div class="accordion" id="accordionExample" style="padding: 5px">
  <div class="card">
<!--**************HEADER MENU NAV*************-->
    <div class="card-header" id="headingOne" style="padding: 0px;box-shadow: 0 -2px 0px 0px rgba(115,115,115,0.4);">
      <div style="padding: 10px">
        <div style="float: left;color: #7B7B7B">
          <span><a href="{{URL::to('home')}}"><i class="fas fa-home"></i></a> </span> /
          <span>Proyecto</span>
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
      <h3><strong style="border-bottom: 2px solid #D9D9DD;padding-bottom: 4px;">Proyecto</strong> <a href="{{URL::to('administrador/proyecto/create')}}"><button class="btn btn-default bg-secondary">Nuevo <i class="fas fa-plus-square"></i></button></a></h3>
   </div>
   <div class="col-md-6">
     <h3>@include('administrador.proyecto.search')</h3>
   </div> 
</div>

<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
   <table class="table table-bordered table-sm table-striped">
     <thead class="bg-secondary">
       <tr>
         <th style="text-align: center;">N°</th>
         <th>Proyecto</th>
         <th>cliente</th>
         <th>Celular</th>
         <th colspan="3">Opciones</th>
       </tr>
     </thead>   
     <tbody>
       <?php for($i=0;$i<sizeof($proyecto);$i++){
        ?>
        <tr>
          <th style="text-align: center;">{{$i+$first}}</th>
          <td>{{$proyecto[$i]->cproyecto}}</td>
          <td>{{$proyecto[$i]->cnombre.' '.$proyecto[$i]->capaterno.' '.$proyecto[$i]->camaterno}}</td>
          <td>{{$proyecto[$i]->ccelular}}</td>
          <td></td>
        </tr>
        <?php
       }?>
     </tbody>
    </table>
    </div>
  </div>  
</div>

{{ $proyecto->links() }}

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
    title: 'Cliente registrado',
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
  title: 'Cliente actualizado',
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
    title: 'Cliente eliminado',
    showConfirmButton: false,
    timer: 1500
})
  <?php  
}?>

</script>
@endpush