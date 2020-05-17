@extends('layouts.admin')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="offset-md-1 col-md-10">
            <br><br>
            <div class="card">
                <div class="card-header bg-secondary"><i class="fas fa-lock nav-icon"></i> Cambiar contraseña</div>
                <div class="card-body">
                    <h4><i class="fas fa-user-tie"></i> {{Auth::user()->name}}</h4>
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
                    <button type="submit" class="btn btn-primary" id="btnguardar"><i class="fa fa-lock"></i> Actualizar </button>
                  </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
        
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $('#claveuno').tooltip('hide');
        $('#clavedos').tooltip('hide');
    });

    $('#clavedos').keydown(function(){
        //primero se comprueba que el usuario no sea dni
        var dni = $('#usuario').val();
        var claveuno = $('#claveuno').val();
        if (claveuno == dni) {
            $('#claveuno').tooltip('show');
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
