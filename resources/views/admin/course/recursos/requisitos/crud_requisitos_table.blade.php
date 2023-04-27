<thead style="">
    <tr>
        <th style="width: 5%">N°</th>
        <th style="width: 50%">TITULO</th>
        <th style="width: 40%" class="text-center">Estado</th>
        <th style="width: 5%;" class="text-center"><i class="fa fa-cogs"></i></th>
    </tr>
</thead>

@php
    $autoi = 1;
@endphp

<tbody>
    @foreach ($requisitos as $item)
        <tr id="tr_{{ $item->idrequisitos }}">
            <td style="vertical-align: middle;">{{ $autoi++ }}.</td>
            <td style="vertical-align: middle;">{{ $item->requisitos }}</td>

            @if($item->estado == 1)
                <td class="text-center" style="vertical-align: middle;">
                    <a href="javascript:void(0)" onclick="cambiarEstadoRequisitos({{$item->idrequisitos}}, 0, {{$item->curso->idcurso}})" 
                    class="btn btn-success text-white font-weight-bold btn-sm" data-toggle="tooltip" 
                    data-placement="top" title="" data-original-title="Deshabilitar">
                    Habilitado <i class="fas fa-check ml-1"></i>
                    </a>
                </td>
            @else
                <td class="text-center" style="vertical-align: middle;">
                    <a href="javascript:void(0)" onclick="cambiarEstadoRequisitos({{$item->idrequisitos}}, 1,   {{$item->curso->idcurso}})" 
                    class="btn btn-danger text-white font-weight-bold btn-sm" data-toggle="tooltip" 
                    data-placement="top" title="" data-original-title="Habilitar">
                    Deshabilitado <i class="fas fa-times ml-1"></i>
                    </a>
                </td>
            @endif

            <td class="text-center" style="vertical-align: middle;">
                <a href="javascript:" onclick="mostrarRequisitos({{ $item->idrequisitos }})" 
                    class="btn btn-light-warning font-weight-bold btn-sm" data-toggle="tooltip" 
                    data-placement="top" data-original-title="Editar requisito"><i class="fas fa-edit p-0"></i>
                </a>
                {{-- <a href="javascript:void(0)" onclick="eliminarRequisitos({{$item->idrequisitos}})" 
                    class="btn btn-light-danger font-weight-bold btn-sm" data-toggle="tooltip" 
                    data-placement="top" title="" data-original-title="Eliminar curso"><i class="fas fa-trash p-0"></i>
                </a> --}}
            </td>
        </tr>
    @endforeach

    @if (count($requisitos) == 0)
        <tr><td class="text-center" colspan="3">Aún no hay requisitos registrados...</td></tr>
    @endif
</tbody>