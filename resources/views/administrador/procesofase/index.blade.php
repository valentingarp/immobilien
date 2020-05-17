@extends('layouts.admin')
@section('contenido')
<div class="accordion" id="accordionExample" style="padding: 5px">
  <div class="card">
<!--**************HEADER MENU NAV*************-->
    <div class="card-header" id="headingOne" style="padding: 0px;box-shadow: 0 -2px 0px 0px rgba(115,115,115,0.4);">
      <div style="padding: 10px">
        <div style="float: left;color: #7B7B7B">
          <span><a href="{{URL::to('home')}}"><i class="fas fa-home"></i></a> </span> /
          <span>Proceso Fase </span>
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
    <h3><strong style="border-bottom: 2px solid #D9D9DD;padding-bottom: 4px;">PROCESO FASE</strong>&nbsp;&nbsp;&nbsp; <a href="" data-toggle="modal" data-target="#asignarfase"><button class="btn btn-default bg-secondary" >Asignar <i class="fas fa-plus-square"></i></button></a></h3>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
      <table class="table table-sm table-striped table-bordered">
        <thead class="bg-secondary">
          <tr>
            <th>Proceso</th>
            <th>Fases</th>
            
          </tr>
        </thead>
        <tbody>
          <?php for($i=0;$i<sizeof($proceso);$i++){
            ?>
            <tr>
              <th>{{$proceso[$i]->cproceso}}</th>
              <td>
                <?php for($j=0;$j<sizeof($profase);$j++){
                  if($profase[$j]->nid_proceso == $proceso[$i]->nid_proceso){
                    ?>
                    
                    <button class="btn btn-secondary" style="margin-bottom: 2px">
                      <p style="margin-bottom: 0px"><i class="fas fa-chevron-circle-right"></i>
                      <strong>{{$profase[$j]->cfase}}</strong></p>
                      <p style="margin-bottom: 0px;float: right;">
                       <a href="#" data-toggle="modal" data-target="#myModalupd{{$profase[$j]->nid_procesofase}}" ><span  data-toggle="tooltip" data-placement="right" title="Editar" ><i class="fas fa-edit" style="color: #6FABD7"></i></span></a>
                       <a href="#" data-toggle="tooltip" data-placement="right" title="Eliminar"><span  data-toggle="modal" data-target="#myModaldel{{$profase[$j]->nid_procesofase}}"><i class="far fa-trash-alt" style="color: #DB8C8C"></i></span></a>
                       </p>
                    </button>


                    <!--*****************MODAL UPDATE*************-->
                    <div class="modal fade modal-slide-in-right" aria-hidden="true"role="dialog" tabindex="-1" id="myModalupd{{$profase[$j]->nid_procesofase}}">
                      <form action="" method="POST" class="formadddocente">
                          {{Form::token()}}
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header bg-secondary">
                              <h4 class="modal-title"><i class="fas fa-edit"></i> ACTUALIZAR FASE - PROCESO</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                                <label for="exampleFormControlSelect1">Proceso</label>
                                <select class="form-control" name="nid_proceso" disabled="">
                                  <?php for($p=0;$p<sizeof($proceso);$p++){
                                    if($proceso[$p]->nid_proceso == $profase[$j]->nid_proceso){
                                      ?>
                                    <option value="" selected="">{{$profase[$j]->cproceso}}</option>
                                      <?php
                                    }
                                  }?>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="exampleFormControlSelect1">Fase</label>
                                <select class="form-control" name="nid_fase" required="">
                                  <?php for($f=0;$f<sizeof($fase);$f++){
                                    if($fase[$f]->nid_fase == $profase[$j]->nid_fase){
                                    ?>
                                    <option value="{{$profase[$j]->nid_fase}}" selected="">{{$profase[$j]->cfase}}</option>
                                    <?php
                                    }else{
                                      ?>
                                    <option value="{{$fase[$f]->nid_fase}}">{{$fase[$f]->cfase}}</option>
                                      <?php
                                    }
                                  }?>
                                </select>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <input type="hidden" name="nid_procesofase" value="{{$profase[$j]->nid_procesofase}}">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="submit" class="btn btn-danger" name="updateprocfase" >Confirmar</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!--*****************FIN***MODAL UPDATE*************-->

                    <!--*****************MODAL ELIMINAR*************-->
                <div class="modal fade modal-slide-in-right" aria-hidden="true"
                role="dialog" tabindex="-1" id="myModaldel{{$profase[$j]->nid_procesofase}}">

                {{Form::Open(array('action'=>array('Administrador\ProcesoFaseController@destroy',$profase[$j]->nid_procesofase),'method'=>'delete'))}}
                
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header" style="background-color: #C83B3B;color: #FFFFFF">
                        <h4 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Retirar fase </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                      </div>
                      <div class="modal-body">
                        <p>Fase: {{$profase[$j]->cfase}} - Proceso: {{$proceso[$i]->cproceso}}</p>
                        <strong>Confirmar para retirar</strong>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger" name="eliminar">Confirmar</button>
                      </div>
                    </div>
                  </div>
                 {{Form::close()}}
                </div>
                <!--*****************FIN***MODAL ELIMINAR*************-->

                    <?php
                  }
                }?>
              </td>
            </tr>
            <?php
          }?>
        </tbody>
      </table>
    </div>
  </div>



        <!--*****************MODAL AGREGAR  DOCENTE*************-->
          <div class="modal fade modal-slide-in-right" aria-hidden="true"role="dialog" tabindex="-1" id="asignarfase">
            <form action="" method="POST" class="formadddocente">
                {{Form::token()}}
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header bg-secondary">
                    <h4 class="modal-title"><i class="fas fa-edit"></i> ASIGNAR PROCESO - FASE</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                  </div>
                  <div class="modal-body">
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Proceso</label>
                      <select class="form-control" name="nid_proceso" required="">
                        <option value="" selected="">==== seleccione ====</option>
                        <?php for($i=0;$i<sizeof($proceso);$i++){
                          ?>
                          <option value="{{$proceso[$i]->nid_proceso}}">{{$proceso[$i]->cproceso}}</option>
                          <?php
                        }?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleFormControlSelect1">Fase</label>
                      <select class="form-control" name="nid_fase" required="">
                        <option value="" selected="">==== seleccione ====</option>
                        <?php for($i=0;$i<sizeof($fase);$i++){
                          ?>
                          <option value="{{$fase[$i]->nid_fase}}">{{$fase[$i]->cfase}}</option>
                          <?php
                        }?>
                      </select>
                    </div>
                  </div>
                  <div class="modal-footer">
                   
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger" name="addprocfase" >Confirmar</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!--*****************FIN***MODAL AGREGAR DOCENTE*************-->

</div>


<!--**************BODY MAIN*************-->
</div>
</div>
</div>
@push('scripts')
<script>
<?php if(isset($info) and $info == 1){
  ?>
    Swal.fire({
    position: 'center',
    type: 'success',
    title: 'Nueva fase asignada',
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
  title: 'Proceso actualizado',
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
    title: 'Fase retirado',
    showConfirmButton: false,
    timer: 1500
})
  <?php  
}?>

</script>
@endpush
@endsection