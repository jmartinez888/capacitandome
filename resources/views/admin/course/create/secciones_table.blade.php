<thead class="table-success">
    <tr>
        <th style="width: 5%">#</th>
        <th style="width: 65%">SECCIÓN</th>
        <th style="width: 30%" class="text-center">ACCIÓN</th>
    </tr>
</thead>
<tbody>
    @foreach ($curso->Secciones as $key => $seccion)
        <tr id="tr_{{ $seccion->idseccion }}">
            <td style="vertical-align: middle">{{ $key+1 }}</td>
            <td style="vertical-align: middle">{{ $seccion->titulo }}</td>
            <td style="vertical-align: middle" class="text-center">
                <a href="{{ asset('/admin/course/secciones/clases/' . $seccion->idseccion)  }}" class="btn btn-light-info font-weight-bold btn-sm my-1" data-toggle="tooltip" data-placement="top" title="Ver clases"><i class="fas fa-book-reader p-0"></i></a>
                <a href="javascript:void(0)" onclick="editar({{ $seccion->idseccion }})" class="btn btn-light-warning font-weight-bold btn-sm my-1" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit p-0"></i></a>

                {{-- <a href="javascript:void(0)" onclick="desactivar({{ $seccion->idseccion }})" class="btn btn-light-danger font-weight-bold btn-sm my-1" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash p-0"></i></a> --}}

                @if($seccion->estado == 1)
                    <a href="javascript:void(0)" onclick="cambiarEstadoSeccion({{ $seccion->idseccion }}, 0, {{ $seccion->idcurso }})" class="btn btn-light-danger font-weight-bold btn-sm my-1" data-toggle="tooltip" data-placement="top" title="Deshabilitar"><i class="fas fa-times p-0"></i></a>
                @else
                    <a href="javascript:void(0)" onclick="cambiarEstadoSeccion({{ $seccion->idseccion }}, 1, {{ $seccion->idcurso }})" class="btn btn-light-success font-weight-bold btn-sm my-1" data-toggle="tooltip" data-placement="top" title="Habilitar"><i class="fas fa-check p-0"></i></a>
                @endif
            </td>
        </tr>
    @endforeach

    @if (count($curso->Secciones) == 0)
        <tr>
            <td style="vertical-align: middle" class="text-center" colspan="3">Aún no hay secciones creadas...</td>
        </tr>
    @endif
</tbody>