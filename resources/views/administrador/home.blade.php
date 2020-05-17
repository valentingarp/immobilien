@extends('layouts.admin')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="offset-md-1 col-md-10">
            <div class="card">
                <div class="card-header">BIENVENIDO AL SISTEMA - IMMOBILIEN</div>
                <div class="card-body">
                    <h3>BIENVENIDO: {{Auth::user()->name}}</h3>
                </div>
            </div>
        </div>
    </div>
        
</div>


<!-- Modal -->
<div class="modal fade" id="modalreset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar contraseña</h5>
        <button type="button" class="close" data-dismiss="#" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" id="formulario">
        {{Form::token()}}
      <div class="modal-body">
        <div class="form-group row">
            <label for="" class="col-md-4 col-form-label">USUARIO DNI:</label>
            <div class="col-md-8">
                <input type="text" disabled="" class="form-control" value="{{Auth::user()->email}}" id="usuario">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-md-4 col-form-label">Nueva Clave:</label>
            <div class="col-md-8">
                <input type="password" name="claveuno" class="form-control" placeholder="Digite nueva clave" id="claveuno"  minlength="6" required="" autocomplete="off" data-toggle="tooltip" data-placement="right" title="La clave no puede ser el usuario">
            </div>
        </div>
        <div class="form-group row">
            <label for="" class="col-md-4 col-form-label">Repetir Nueva Clave:</label>
            <div class="col-md-8">
                <input type="password" name="clavedos" class="form-control" placeholder="Repite nueva clave" id="clavedos"  minlength="6" required="" autocomplete="off" data-toggle="tooltip" data-placement="right" title="Claves no coinciden">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-secondary" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                   {{ __('Salir') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
        <button type="submit" class="btn btn-primary" id="btnguardar"><i class="fa fa-lock"></i> Actualizar</button>
      </div>
      </form>
    </div>
  </div>
</div>


<?php if($changepass == 1){
    ?>
@push('scripts')
<script>
    $('#modalreset').modal('show');
</script>
@endpush
    <?php
}?>

@endsection

@push('scripts')
<script>
    $('#clavedos').keydown(function(){
        //primero se comprueba que el usuario no sea dni
        var dni = $('#usuario').val();
        var claveuno = $('#claveuno').val();
        if (claveuno == dni) {
            $('#claveuno').tooltip('show')
            $('#claveuno').css('border-color','#FF4343');
            document.getElementById('btnguardar').disabled = true;
            //alert('no puede ser dni');
        }
        else{
            $('#claveuno').css('border-color','#FFFFFF');
            document.getElementById('btnguardar').disabled = false;
        }
    });

    function validarcontrasena(){
        var claveuno = $('#claveuno').val();
        var clavedos = $('#clavedos').val();
        if (claveuno == clavedos) {
            return true;
        }else{
            return false;
        }
    }

    $('#formulario').submit(function(){
        var rpt = validarcontrasena();
        if (rpt) {
            return true;
        }
        $('#claveuno').css('border-color','#FF4343');
        $('#clavedos').css('border-color','#FF4343');
        $('#clavedos').tooltip('show');
        return false;
    });

<?php if(isset($info) and $info == 0){
    ?>
    alert('Clave no puede ser el usuario.');
    <?php
    }
 if(isset($info) and $info == 1){
    ?>
    alert('Claves no coinciden.');
    <?php
}
if(isset($info) and $info == 2){
    ?>
    alert('Clave en uso, ingrese nueva clave.');
    <?php
}
?>
</script>
@endpush
