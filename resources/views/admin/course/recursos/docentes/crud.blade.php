@extends('layouts.app_admin')

@section('styles')
@endsection

@section('subheader')
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-primary font-weight-bold my-1 mr-5">
                        <i class="fas fa-chalkboard-teacher mr-1"></i> DOCENTES DEL CURSO
                    </h5>
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->

            <div class="d-flex align-items-center">
                <a href="/admin/courses" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="la la-book"></i> CURSO</a>
                <a href="{{route('admin_inicio')}}" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="la la-home"></i> INICIO</a>
            </div>
        </div>
    </div>
@endsection

@section('contenido')
<div class="container">
    <div class="card card-custom">
        <div class="card-header">
            <div class="card-title">
                <div class="d-flex align-items-center">
                    <!--begin::Pic-->
                    <div class="flex-shrink-0 mr-4 symbol symbol-65 symbol-circle">
                        <img src="{{ asset('/storage/cursos/'.$curso->portada.'') }}" alt="image">
                    </div>
                    <!--end::Pic-->
                    <!--begin::Info-->
                    <div class="d-flex flex-column mr-auto">
                        <!--begin: Title-->
                        <a href="javascript:" class="card-title text-hover-primary font-weight-bolder font-size-h5 text-dark mb-1">{{$curso->titulo}}</a>
                        <span class="text-muted font-weight-bold"><i class="far fa-calendar-alt"></i> {{$curso->fecha_inicio}} | <i class="far fa-calendar-alt"></i> {{$curso->fecha_final}}</span>
                        <!--end::Title-->
                    </div>
                    <!--end::Info-->
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label">Lista de docentes</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tablaDocentes">
                                    @include('admin.course.recursos.docentes.crud_docentes_table')
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-custom gutter-b">
                                <div class="card-header">
                                 <div class="card-title">
                                  <h3 class="card-label">Seleccione un docente</h3>
                                 </div>
                                </div>

                                <div class="card-body">
                                    <form action="{{route('guardEditarDocentes')}}" method="post" id="">
                                        @csrf
                                        <input type="hidden" name="iddocentes" id="iddocentes" value="">
                                        <input type="hidden" name="idcurso" id="idcurso" value="{{$curso->idcurso}}">
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if(Session::has('success'))                                                        
                                                    <div class="alert alert-custom alert-success fade show" role="alert">
                                                        <div class="alert-icon"><i class="la la-check"></i></div>
                                                        <div class="alert-text">{{Session::get('success')}}</div>
                                                        <div class="alert-close">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                    
                                                @if(Session::has('error'))
                                                    <div class="alert alert-custom alert-danger fade show" role="alert">
                                                        <div class="alert-icon"><i class="la la-close"></i></div>
                                                        <div class="alert-text">{{Session::get('error')}}</div>
                                                        <div class="alert-close">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                                <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group mb-4">
                                                    <select class="form-control selectpicker {{ $errors->first('idpersona') ? 'error-select' : '' }}" id="idpersona" name="idpersona" data-live-search="true">
                                                        <option value="" selected disabled>Seleccione...</option>
                                                        @foreach ($personas as $index => $item)
                                                            <option value="{{ $item->idusuario }}">
                                                                {{ ($index+1).") ".$item->nombre." ".$item->apellidos}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->first('idpersona'))
                                                        <span class="form-text text-danger" id="errorTitulo">{{ $errors->first('idpersona') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12 text-center">
                                                <button type="button" onclick="limpiar()" class="btn btn-secondary font-weight-bold mr-2"><i class="la la-close"></i> LIMPIAR</button>
                                                <button type="submit" class="btn btn-primary font-weight-bold mr-2"><i class="la la-plus-circle"></i> GUARDAR</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Wizard-->
    </div>
</div>
@endsection

@section('modal')
@endsection

@section('script')
    <script src="{{ asset('/recursos/admin/assets/js/pages/features/miscellaneous/toastr.js') }}"></script>

    <script>
        function mostrarComunidad(iddocentes) {
            $.get("/admin/mostrardocentes/"+iddocentes, function(respuesta) {
                respuesta = JSON.parse(respuesta);
                $("#iddocentes").val(respuesta.iddocente);
                $('#idpersona').val(respuesta.idusuario);
                $('#idpersona').selectpicker('refresh');
                console.log(respuesta);
            })
        }

        function limpiar() {
            $("#iddocentes").val('');
            $('#idpersona').val('');
            $('#idpersona').selectpicker('refresh');
            $("#idpersona").removeClass('error-select');
            $("#errorTitulo").html('');

            toastr.info('Formulario reseteado.')
        }

        function listarDocentes(idcurso) {            
            $.get(`/admin/obtener/docentes/${idcurso}`, function (data, textStatus, jqXHR) {
                $("#tablaDocentes").html(data);

                $('[data-toggle="tooltip"]').tooltip();
            });
        }

        function cambiarEstadoDocente(iddocente, estado, idcurso) {
            Swal.fire({
                title: '¿Seguro que quiere cambiar el estado de este registro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f64e60',
                confirmButtonText: '¡Si, cambiar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.get(`/admin/cambiarEstadoDocente/${iddocente}/${estado}`, function (data, status) {
                        data = JSON.parse(data);
                        console.log(data);
                        console.log(idcurso);
                        if (data.status == true) {
                            Swal.fire('Estado cambiado', '', 'success');
                            listarDocentes(idcurso);
                        }else{
                            alert('Ocurrio un error, se refescara la página');
                            location.reload();
                        }
                    });
                }else{
                    
                }
            });
        }
    </script>
@endsection