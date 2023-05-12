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
                        <i class="fa fa-users mr-1"></i> COMUNIDAD ESTUDIANTIL
                    </h5>
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->

            <div class="d-flex align-items-center">
                {{-- <a href="/admin/courses" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="la la-book"></i> CURSO</a> --}}

                <a href="{{ route('admin_course_list') }}" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="la la-book"></i> CURSO</a>

                <a href="{{ route('admin_inicio') }}" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="la la-home"></i> INICIO</a>
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

                            <span class="text-muted font-weight-bold"><i class="far fa-calendar-alt"></i> {{ date('d-m-Y', strtotime($curso->fecha_inicio)) }} | <i class="far fa-calendar-alt"></i> {{ date('d-m-Y', strtotime($curso->fecha_final)) }}</span>
                            <!--end::Title-->
                        </div>
                        <!--end::Info-->
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-custom gutter-b">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">Comunidad estudiantil a cual va dirigido el curso:</h3>
                                </div>
                            </div>

                            <div class="card-body">                            
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
                                    <div class="col-lg-7">
                                        <div class="table-responsive mt-5">
                                            <table class="table table-bordered table-head-custom" id="tablaComunidad">
                                                @include('admin.course.recursos.comunidad.crud_comunidad_table')
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-lg-5">
                                        <form action="{{route('guardEditarComunidad')}}" method="post" id="frm-certificacion" autocomplete="off">
                                                @csrf
                                                <input type="hidden" name="idcomunidad_estudiantil" id="idcomunidad_estudiantil" value="">
                                                <input type="hidden" name="idcurso" id="idcurso" value="{{$curso->idcurso}}">
                                                <div class="form-group">
                                                    <label for="comunidad_estudiantil">Ingrese comunidad estudiantil</label>
                                                    <input type="text" name="comunidad_estudiantil" id="comunidad_estudiantil" class="form-control {{ $errors->first('comunidad_estudiantil') ? 'is-invalid' : '' }}" placeholder="Ingrese comunidad.">
                                                    @if ($errors->first('comunidad_estudiantil'))
                                                        <span class="form-text text-danger" id="errorTitulo">{{ $errors->first('comunidad_estudiantil') }}</span>
                                                    @endif
                                                </div>
                                                <button type="button" onclick="limpiar()" class="btn btn-secondary font-weight-bold mr-2"><i class="la la-close"></i> LIMPIAR</button>
                                                <button type="submit" class="btn btn-primary font-weight-bold mr-2"><i class="la la-plus-circle"></i> GUARDAR</button>
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
        function mostrarComunidad(idcomunidad) {
            $.get("/admin/mostrarcomunidad/"+idcomunidad, function(respuesta) {
                respuesta = JSON.parse(respuesta);
                $("#idcomunidad_estudiantil").val(respuesta.idcomunidad);
                $('#comunidad_estudiantil').val(respuesta.comunidad);
            })
        }

        function limpiar() {
            $('#idcomunidad_estudiantil').val('');
            $('#comunidad_estudiantil').val('');
            $("#comunidad_estudiantil").removeClass('is-invalid');
            $("#errorTitulo").html('');
            toastr.info('Formulario reseteado.')
        }

        function listarComunidad(idcurso) {            
            $.get(`/admin/obtener/comunidad/${idcurso}`, function (data, textStatus, jqXHR) {
                $("#tablaComunidad").html(data);

                $('[data-toggle="tooltip"]').tooltip();
            });
        }

        function cambiarEstadoComunidad(idcomunidad, estado, idcurso) {
            Swal.fire({
                title: '¿Seguro que quiere cambiar el estado de este registro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f64e60',
                confirmButtonText: '¡Si, cambiar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.get(`/admin/cambiarEstadoComunidad/${idcomunidad}/${estado}`, function (data, status) {
                        data = JSON.parse(data);
                        console.log(data);
                        console.log(idcurso);
                        if (data.status == true) {
                            Swal.fire('Estado cambiado', '', 'success');
                            listarComunidad(idcurso);
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