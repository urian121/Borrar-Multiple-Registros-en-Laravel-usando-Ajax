<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link type="text/css" rel="shortcut icon" href="{{ asset ('img/logo-mywebsite-urian-viera.svg') }}"/>
    <title>Borrar Multiple Registro en Laravel con Ajax :: WebDeveloper Urian Viera</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}"> <!----Creando mi Token --->
    <style>
      #total{
        color: coral;
        text-align: center;
      }  
      table tr th{
          background:rgba(0, 0, 0, .6);
          color: azure;
      }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top" style="background-color: #563d7c !important;">
    <span class="navbar-brand">
        <img src="{{ asset ('img/logo-mywebsite-urian-viera.svg') }}" alt="Web Developer Urian Viera" width="120">
        Web Developer Urian Viera
    </span>
</nav>


<div class="container top">
    <h3 class="text-center mt-5"><br> Como Borrar Múltiple Registros usando Checkbox con Laravel y Ajax ... </h3>
    <hr>

    <h3 id="total"> 
       <span> Total de Alumnos </span>
       <strong> ({{ $totalAlumnos->count() }}) </strong>
    </h3> 
    <button style="float: right;" class="btn btn-danger btn-sm borrarAll" data-url="{{ url('DeleteMultiple') }}">Borrar Alumnos</button>
    
    <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
        <tr>
            <th>#</th>
            <th>Nombre del Alumno</th>
            <th>Edad</th>
            <th>Sexo </th>
        </tr>
        @if($alumnos->count())
            @foreach($alumnos as $alumno)
                <tr id="id{{ $alumno->id }}">
                    <td>
                        <input type="checkbox" class="delete_checkbox" data-id="{{$alumno->id}}">
                        <em>{{ $alumno->id }}</em>
                    </td>
                    <td>{{ $alumno->name }}</td>
                    <td>{{ $alumno->edad }}</td>
                    <td>{{ $alumno->sexo }}</td>
                </tr>
            @endforeach
        @endif
    </table>
    </div>

</div>






<script src="{{ asset('js/jquery-3.5.1.js') }}"></script>  
<script src="{{ asset('js/bootstrap.min.js') }}"></script> 
<script type="text/javascript">
$(document).ready(function () {
    $('.borrarAll').on('click', function(e) {
    
        var idsArray = [];
        $("input:checkbox[class=delete_checkbox]:checked").each(function () {
            idsArray.push($(this).attr('data-id'));
        });
    
        console.log(idsArray);
    
        var join_selected_values = idsArray.join(",");
        console.log(join_selected_values);
    
        if(idsArray.length > 0){
        $.ajax({
            url: $(this).data('url'),
            type: 'DELETE',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: 'ids='+join_selected_values,
            success: function (data) {

                if (data['msjtotal'] ) {
                $.each(idsArray,function(indice,id) {
                    var fila = $("#id" + id).remove(); //Oculto las filas eliminadas
                });
    
                //alert(data['mensaje']);
                $('#total').html(data.msjtotal);
                }else {
                  //  console.log('Error, no se Eliminaron los Alumnos .. ' + data['error']);
                }
            },
           
        });
        }
    });
    
});
</script>

</body>
</html>