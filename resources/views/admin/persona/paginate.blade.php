<div class="table-responsive">
    <table class="table table-bordered" id="">
        <thead>
            <tr>
                <th>N°</th>
                <th>Departamento</th>
                <th>Nombre y apellidos</th>
                <th>DNI</th>
                <th>Telefono</th>
                <th>Rol</th>
                <th>Usuario</th>
                <th>Acción</th>
            </tr>
        </thead>
        @php
            $autoi = 1;
        @endphp
        <tbody>
            @foreach ($personas as $index => $persona)
                <tr class="@if ($persona->estado == 0) fila-desactivada @endif">
                    <td class="align-middle">{{ $personas->perPage()*($personas->currentPage()-1)+($index+1) }}</td>
                    <td class="align-middle">{{ $persona->departamento }}</td>
                    <td class="align-middle">{{ $persona->nombre." ".$persona->apellidos }}</td>
                    <td class="align-middle">{{ $persona->dni }}</td>
                    <td class="align-middle">
                        <span class="font-weight-bolder d-block font-size-lg @if ($persona->estado == 0) text-white-75 @else text-dark-75 @endif">{{ $persona->telefono }}</span>
                    </td>
                    <td class="align-middle">
                        @if ($persona->idrol == 1)
                            <span class="label label-lg label-light-primary label-inline">Docente</span>
                        @else
                            <span class="label label-lg label-light-warning label-inline">Estudiante</span>
                        @endif
                    </td>
                    <td class="align-middle">
                        <span class="font-weight-bolder d-block font-size-lg @if ($persona->estado == 0) text-white-75 @else text-dark-75 @endif">{{ $persona->usuario }}</span>
                    </td>
                    <td class="align-middle">
                        <a href="{{ route('admin_personas_edit', [$persona->idpersona])  }}" 
                            class="btn btn-light-info font-weight-bold btn-sm my-1" data-toggle="tooltip" 
                            data-placement="top" data-original-title="Editar persona"><i class="fas fa-edit p-0"></i>
                        </a>

                        @if ($persona->estado == 1)
                            <a href="javascript:void(0)" onclick="cambiarEstadoPersona({{ $persona->idpersona }}, 0)" class="btn btn-light-danger font-weight-bold btn-sm my-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Eliminar persona"><i class="fas fa-trash p-0"></i></a>
                        @else
                            <a href="javascript:void(0)" onclick="cambiarEstadoPersona({{ $persona->idpersona }}, 1)" class="btn btn-light-succes border-white bg-white font-weight-bold btn-sm my-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Habilitar persona"><i class="fas fa-check p-0 text-primary"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@if (count($personas) == 0 && $search != "")
    <div class="alert alert-danger" role="alert">
        <h6>
            No existen resultados para : <strong>"{{$search}}"</strong>
        </h6>
    </div>
@endif
{{ $personas->links('vendor.pagination.paginate-admin') }}