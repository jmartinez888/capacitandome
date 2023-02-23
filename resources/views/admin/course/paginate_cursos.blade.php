<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-head-custom table-bordered">
            <thead>
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col">TÍTULO</th>
                    <th scope="col">T.CLASES</th>
                    <th scope="col">DURACIÓN</th>
                    <th scope="col">PRECIO</th>
                    <th scope="col">PLAN</th>
                    <th scope="col" class="text-center">ACCIÓN</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($cursos as $index => $curso)
                <tr id="tr_{{ $curso->idcurso }}">
                    <td scope="row">{{ $cursos->perPage()*($cursos->currentPage()-1)+($index+1)}}</td>
                    <td scope="row"><strong>{{ $curso->titulo }}</strong></td>
                    <td scope="row">{{ $curso->total_clases." clases" }}</td>
                    <td scope="row">{{ $curso->hora_duracion." horas" }}</td>
                    <td scope="row">s/.{{ $curso->precio }}</td>
                    <td scope="row">
                        @if ($curso->plan == 'gratis')
                            <span class="label font-weight-bold label-lg  label-light-warning label-inline">GRATIS</span>
                        @else
                            <span class="label font-weight-bold label-lg  label-light-success label-inline">PAGO</span>
                        @endif                        
                    </td>
                    <td scope="row" class="text-center">
                        <a href="{{ asset('admin/course/editar/' . $curso->idcurso ) }}" class="btn btn-light-warning font-weight-bold btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Editar"><i class="fas fa-edit p-0"></i></a>
                        <a href="javascript:void(0)" onclick="desactivar({{ $curso->idcurso }})" class="btn btn-light-danger font-weight-bold btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Deshabilitar"><i class="fas fa-times p-0"></i></a>
                        <a href="javascript:void(0)" onclick="mostrarModal({{ $curso->idcurso }})" class="btn btn-light-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Registrar recursos del curso"><i class="fas fa-plus-circle p-0"></i></a>
                    </td>
                </tr>
                @endforeach
    
                @if (count($cursos) <= 0)
                    <tr>
                        <td colspan="7">
                            <center>
                                NO HAY REGISTROS
                            </center>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12">
    {{ $cursos->links('vendor.pagination.paginate-admin') }}
</div>