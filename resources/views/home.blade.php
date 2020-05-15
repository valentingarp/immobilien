@extends('layouts.admin')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Persona</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <i class="fas fa-adjust" style="color: #FFFFFF"></i>
                    You are logged in!
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Servicios</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <i class="fas fa-adjust" style="color: #FFFFFF"></i>
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
   
</div>
<template v-if="menu==0">
    <h3></h3>
</template>
<template v-if="menu==1">
    <h4></h4>
</template>
@endsection
