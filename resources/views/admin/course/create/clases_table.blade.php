<thead class="table-primary">
    <tr>
        <th style="width: 5%">#</th>
        <th style="width: 70%">CLASES</th>
        <th style="width: 25%">ACCIÓN</th>
    </tr>
</thead>
<tbody>
    @foreach ($seccion->Clases as $key => $clase)
        <tr id="tr_{{ $clase->idclase }}">
            <td>{{ $key+1 }}</td>
            <td>{{ $clase->titulo }}</td>
            <td>
                <a href="javascript:void(0)" onclick="editar({{ $clase->idclase }})" class="btn btn-light-warning font-weight-bold btn-sm" data-toggle="tooltip" data-placement="top" title="Editar">
                    <i class="fas fa-edit p-0"></i>
                </a>

                {{-- <a href="javascript:void(0)" onclick="desactivar({{ $clase->idclase }})" class="btn btn-light-danger font-weight-bold btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar">
                    <i class="fas fa-times p-0"></i>
                </a> --}}
            
                @if($clase->estado == 1)
                    <a href="javascript:void(0)" onclick="cambiarEstadoclase({{ $clase->idclase }}, 0, {{ $clase->idseccion }})" class="btn btn-light-danger font-weight-bold btn-sm my-1" data-toggle="tooltip" data-placement="top" title="Deshabilitar"><i class="fas fa-times p-0"></i></a>
                @else
                    <a href="javascript:void(0)" onclick="cambiarEstadoclase({{ $clase->idclase }}, 1, {{ $clase->idseccion }})" class="btn btn-light-success font-weight-bold btn-sm my-1" data-toggle="tooltip" data-placement="top" title="Habilitar"><i class="fas fa-check p-0"></i></a>
                @endif
            </td>
        </tr>
    @endforeach

    @if (count($seccion->Clases) == 0)
        <tr>
            <td class="text-center" colspan="3">Aún no hay clases creadas...</td>
        </tr>
    @endif                                               

    {{-- <tr>
        <td colspan="3"> Sin registros de secciones...</td>
    </tr> --}}
</tbody>