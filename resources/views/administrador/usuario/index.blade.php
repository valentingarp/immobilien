@extends('layouts.admin')
@section('contenido')
<div class="accordion" id="accordionExample" style="padding: 5px">
  <div class="card">
<!--**************HEADER MENU NAV*************-->
    <div class="card-header" id="headingOne" style="padding: 0px;box-shadow: 0 -2px 0px 0px rgba(115,115,115,0.4);">
      <div style="padding: 10px">
        <div style="float: left;color: #7B7B7B">
          <span><a href="{{URL::to('home')}}"><i class="fas fa-home"></i></a> </span> /
          <span>Usuarios</span>
        </div>
        <div  style="float: right;">
        <p data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="color: #2C8BCC"><i class="far fa-window-minimize"></i></p>        
        </div>
      </div>     
    </div>
    <!--**************FIN HEADER MENU NAV*************-->
    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
<!--**************BODY MAIN*************-->
      <div class="card-body">

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
    <div class="col-md-6">
      <h4><strong style="border-bottom: 2px solid #D9D9DD;padding-bottom: 4px;">Gestionar Usuario</strong></h4>
    </div>
    <div class="col-md-6">
      @include('administrador.usuario.search')
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="table-responsive">
      <table class="table table-bordered table-sm table-striped table-hover">
        <thead class="bg-secondary">
          <tr>
            <th style="text-align: center;">N°</th>
            <th>Nombres y apellidos</th>
            <th>Tipo usuario</th>
            <th>Usuario</th>
            <th colspan="3">Opciones</th>
          </tr>
        </thead>
        <tbody>
          <?php for($i=0;$i<sizeof($user);$i++){
            ?>
          <tr>
            <th style="text-align: center;">{{$i+$first}}</th>
            <td>{{$user[$i]->name}}</td>
            <td>{{$user[$i]->cusuario}}</td>
            <td>{{$user[$i]->email}}</td>
            <td style="text-align: center">
              <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#update{{$i}}"><i class="far fa-edit"></i> Cambiar</button>
              <!--********************MODAL ACTUALIZAR*************-->
              <div class="modal fade" id="update{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background: #D8A200;color: #FFFFFF">
                      <h5 class="modal-title" id="exampleModalLabel"><i class="far fa-edit"></i> Actualizar usuario</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="" method="POST">
                    {{Form::token()}}
                    <div class="modal-body">
                      <div class="form-group row">
                        <label for="" class="col-form-label col-md-4">Nombres</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" name="nombres" value="{{$user[$i]->name}}" disabled="">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="" class="col-form-label col-md-4">Tipo usuario</label>
                        <div class="col-md-8">
                          <select name="tipouser" id="" class="form-control">
                            <?php for($t=0;$t<sizeof($tipouser);$t++){
                              if ($tipouser[$t]->nid_tipousuario == $user[$i]->nid_tipousuario) {
                                ?>
                              <option value="{{$tipouser[$t]->nid_tipousuario}}" selected="">{{$tipouser[$t]->cusuario}}</option>
                                <?php
                              }else{
                                ?>
                              <option value="{{$tipouser[$t]->nid_tipousuario}}">{{$tipouser[$t]->cusuario}}</option>
                                <?php
                              }
                            }?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="" class="col-form-label col-md-4">Usuario</label>
                        <div class="col-md-8">
                          <input type="text" name="usuario" class="form-control" value="{{$user[$i]->email}}" minlength="6" required="">
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" name="iduser" value="{{$user[$i]->id}}">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-danger" name="btnupdate">GUARDAR CAMBIO</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <!--********************FIN MODAL ACTUALIZAR*************-->
            </td>
            <td style="text-align: center">
              <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#updateclave{{$i}}"><i class="fas fa-key"></i> Reset clave</button>

               <!--********************MODAL ACTUALIZAR*************-->
              <div class="modal fade" id="updateclave{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background: #60AEC4;color: #FFFFFF">
                      <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-key"></i> Resetear clave</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="" method="POST">
                    {{Form::token()}}
                    <div class="modal-body">
                      <div class="form-group row">
                        <label for="" class="col-form-label col-md-4">Nombres</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" value="{{$user[$i]->name}}" readonly="">
                        </div>
                      </div>
                      

                      <div class="form-group row">
                        <label for="" class="col-form-label col-md-4">Usuario</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" value="{{$user[$i]->email}}" readonly="">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="" class="col-form-label col-md-4">Nueva clave</label>
                        <div class="col-md-8">
                          <input type="password" name="clave" class="form-control" placeholder="......" minlength="6">
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <input type="hidden" name="iduser" value="{{$user[$i]->id}}">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-danger" name="btnupdateclave">ACTUALIZAR CLAVE</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
              <!--********************FIN MODAL ACTUALIZAR*************-->
            </td>
            <td style="text-align: center">
              <form action="" method="POST">
              {{Form::token()}}
              <?php if($user[$i]->nestado == 1){
                ?>
                <button type="submit" name="disabled" class="btn btn-success btn-sm"><i class="far fa-thumbs-up"></i> Habilitado</button>
                <?php
              }else{
                ?>
                <button type="submit" name="enabled" class="btn btn-danger btn-sm"><i class="far fa-thumbs-down"></i> Deshabilit</button>
                <?php
              }?>
              <input type="hidden" name="iduser" value="{{$user[$i]->id}}">
              </form>
            </td>
          </tr>
            <?php
          }?>
        </tbody>
      </table>
      </div> 
      {{ $user->links() }}
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
  <?php if(isset($info) and $info == 1){
  ?>
    Swal.fire({
    position: 'center',
    type: 'success',
    title: 'Usuario actualizado',
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
  title: 'Clave actualizada',
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
    title: 'Usuario deshabilitado',
    showConfirmButton: false,
    timer: 1500
})
  <?php  
}?>

<?php if(isset($info) and $info == 4){
  ?>
    Swal.fire({
    position: 'center',
    type: 'success',
    title: 'Usuario habilitado',
    showConfirmButton: false,
    timer: 1500
})
  <?php  
}?>

</script>
@endpush