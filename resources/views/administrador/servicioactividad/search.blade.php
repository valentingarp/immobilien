{!! Form::open(array('url'=>'administrador/servicioactividad','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group row">
	<div class="col-sm-12">    
    <div class="input-group mb-3">
      <div class="input-group-prepend">
      <span class="input-group-text" id="search">Proceso: </span>
      </div>
      <select name="proceso" id="" class="form-control" onchange="form.submit()">
        <option value="">======== Seleccione ========</option>
        <?php for($i=0;$i<sizeof($procesos);$i++){
          if($proceso == $procesos[$i]->nid_proceso){
            ?>
            <option value="{{$procesos[$i]->nid_proceso}}" selected="">{{$procesos[$i]->cproceso}}</option>  
            <?php
          }else{
            ?>
            <option value="{{$procesos[$i]->nid_proceso}}">{{$procesos[$i]->cproceso}}</option>
            <?php
          }
        }?>
      </select>
      
    </div>
  </div>
</div>
{{Form::close()}}