<thead style="">
    <tr>
        <th style="width: 5%">N°</th>
        <th style="width: 60%">TITULO</th>
        <th style="width: 30%" class="text-center">ESTADO</th>
        <th style="width: 15%" class="text-center"><i class="fa fa-cogs"></i></th>
    </tr>
</thead>

@php
    $autoi = 1;
@endphp

<tbody>
    @foreach ($temas as $item)
        <tr id="tr_{{ $item->idcurso_tema }}">
            <td style="vertical-align: middle;">{{ $autoi++ }}.</td>
            <td style="vertical-align: middle;">{{ $item->temas }}</td>
            
            @if($item->estado == 1)
                <td class="text-center" style="vertical-align: middle;">
                    <a href="javascript:void(0)" onclick="cambiarEstadoTemas({{$item->idcurso_tema}}, 0, {{$item->curso->idcurso}})" 
                        class="btn btn-success text-white font-weight-bold btn-sm" data-toggle="tooltip" 
                        data-placement="top" title="" data-original-title="Deshabilitar">
                        Habilitado <i class="fas fa-check ml-1"></i>
                    </a>
                </td>
            @else
                <td class="text-center" style="vertical-align: middle;">
                    <a href="javascript:void(0)" onclick="cambiarEstadoTemas({{$item->idcurso_tema}}, 1, {{$item->curso->idcurso}})" 
                        class="btn btn-danger text-white font-weight-bold btn-sm" data-toggle="tooltip" 
                        data-placement="top" title="" data-original-title="Habilitar">
                        Deshabilitado <i class="fas fa-times ml-1"></i>
                    </a>
                </td>
            @endif

            <td class="text-center" style="vertical-align: middle;">
                <a href="javascript:" onclick="mostrarTemas({{ $item->idcurso_tema }})" 
                    class="btn btn-light-warning font-weight-bold btn-sm" data-toggle="tooltip" 
                    data-placement="top" data-original-title="Editar curso"><i class="fas fa-edit p-0"></i>
                </a>
                {{-- <a href="javascript:void(0)" onclick="eliminartemas({{$item->idcurso_tema}})" 
                    class="btn btn-light-danger font-weight-bold btn-sm" data-toggle="tooltip" 
                    data-placement="top" title="" data-original-title="Eliminar curso"><i class="fas fa-trash p-0"></i>
                </a> --}}
            </td>
        </tr>
    @endforeach
    
    @if (count($temas) == 0)
        <tr><td class="text-center" colspan="3">Aún no hay temas registrados...</td></tr>
    @endif
</tbody>