@inject('viewPagos','App\Pagos')
@inject('viewUsers','App\Models\User')
@extends('layouts.app')
@section('title','Todas los medicos')
@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header">


    <div class="row">
      <!-- The Modal -->
      <div class="modal fade" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" style="color: #009E60;"><i class="fa fa-money"></i> Registro de Pagos </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                 {!! Form::open(['route'=>('pagos.store'),'method'=>'POST','files'=>true]) !!}
                 <input type="hidden" name="IdCita" value="{{ $viewDatos->id }}">
                 <input type="hidden" id="saldo" value="{{ $viewDatos->Saldo }}">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <small style="font-size: 11pt;">s/. Monto</small>
                            <input type="number" name="Monto" class="form-control" style="text-transform: capitalize"  value="" required="" placeholder="Monto" min="0" max="10000" step="0.1" id="monto">   
                            </div>         
                        </div>
                        <hr>
                        <div class="row">
                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <button class="btn btn-success" style="margin-right: 5px;" id="btnguardar"> <i class="fa fa-check"></i> Guardar</button>
                          <button type="button" class="btn btn-dark" data-dismiss="modal"><i class="fa fa-remove"></i> Cancelar</button>
                      </div>
                        </div>  
                    </div>
                </div>
                {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
    </div>
    <!-- =============================================================================== -->
        <div class="row" >
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <a href="{{ route('pagos.index') }}" class="btn btn-link"><i class="fa fa-reply"></i> Volver </a>
            </div>
            @if($viewDatos->Pagado<$viewDatos->Costo)
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <button class="btn btn-primary" data-toggle="modal" data-target="#myModal" type="button">
                    <i class="fa fa-plus"></i> Cobrar 
                </button>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <table class="table" style="">
                    <tr>
                        <td> <b>Paciente:</b> </td>
                        <?php $nombre=mb_strtoupper($viewPaciente->name); ?>
                        <td><i>DNI  {{ $viewPaciente->NumDocu }} </i>- {{ $nombre }}</td>
                    </tr>
                    <tr>
                        <td> <b>Enfermedad:</b> </td>
                        <td>{{ $viewDatos->Enfermedad }}</td>
                    </tr>
                    <tr>
                        <td> <b>Tratamiento:</b> </td>
                        <td>{{ $viewTratemiento->Tratamientos }}</td>
                    </tr>
                    <tr>
                        <td> <b>Medico:</b> </td>
                        <td>{{ $viewMedico->Nombres }} {{ $viewMedico->Apellidos }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <table class="table" style="">
                    <tr>
                        <td> <b>Estado:</b> </td>
                        <?php $nombre=mb_strtoupper($viewPaciente->name); ?>
                        <td>
                        @if($viewDatos->Estadopago=='Aplicado')
                            <small style="font-weight: bold;color: #048B60;"><i class="fa fa-money"></i> Aplicado</small>  
                        @else
                            <small style="font-weight: bold;color: #D1220B;"><i class="fa fa-spinner"></i> Pendiente</small> 
                        @endif
                        </td>
                    </tr>
                    <tr>
                        <td> <b>Costo:</b> </td>
                        <td>$ {{ $viewDatos->Costo }}</td>
                    </tr>
                    <tr>
                        <td> <b>Pagado:</b> </td>
                        <td>
                            @if($viewDatos->Pagado==0)
                                <span style="color: #F01A1A;font-weight: bold;">$ {{ $viewDatos->Pagado }}</span>
                            @elseif($viewDatos->Pagado >0 && $viewDatos->Pagado < $viewDatos->Costo)
                                <span style="color: #EFA10A;font-weight: bold;">$ {{ $viewDatos->Pagado }}</span>
                            @else
                            <span style="color: #05B411;font-weight: bold;">$ {{ $viewDatos->Pagado }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr> 
                        <td> <b>Saldo:</b> </td>
                        <td>
                            @if($viewDatos->Pagado==0)
                                <span style="color: #F01A1A;font-weight: bold;">$ {{ $viewDatos->Saldo }}</span>
                            @elseif($viewDatos->Pagado >0 && $viewDatos->Pagado < $viewDatos->Costo)
                                <span style="color: #F01A1A;font-weight: bold;">$ {{ $viewDatos->Saldo }}</span>
                            @else
                                <span style="color: #05B411;font-weight: bold;">{{ $viewDatos->Saldo }}</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

        </div>


                </div>
                <div class="card-body">            


<div class="row">   
<table class="table table-striped" style="border-width: 1px;border-style: dashed;border-color: #01578E;">
    <thead style="background-color: #E0E8FD;color: #01578E;">
        <th style="text-align: center;">#</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Monto</th>
        <th>Recibió</th>
    </thead>
    <tbody>
        @foreach($viewPagos::where('IdCita',$viewDatos->id)->get() as $pago)
        <?php  
            $f=date_create($pago->created_at);
            $tf=date_format($f,'d/m/Y');
            $th=date_format($f,'H:i:s');
        ?>
            <tr>
                <td style="text-align: center;color: #048281;">
                    <i class="fa fa-money"></i>
                </td>
                <td>{{ $tf }}</td>
                <td>{{ $th }}</td>
                <td>$ {{ $pago->Monto }}</td>
                <td>
                    @foreach($viewUsers::where('id',$pago->IdUsuario)->get() as $usu)
                        {{ $usu->name }}
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>


<br>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
$( document ).ready(function() {

$('#monto').keyup(function(){ costos(); });
$('#monto').change(function(){ costos(); });

function costos(){
    var monto=$('#monto').val();
    var saldo=$('#saldo').val(); 
    if (Number(monto) > Number(saldo)) {
        $('#monto').css('border-color','#E71010');
        $('#btnguardar').prop('disabled',true);
    }else{
        $('#monto').css('border-color','#9A9B9A');
        $('#btnguardar').prop('disabled',false);
    }
}

});
</script>
</div>



@endsection
