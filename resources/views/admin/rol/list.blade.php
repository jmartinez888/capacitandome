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
                        <i class="fas fa-clipboard-list mr-1"></i> ROLES DEL SISTEMA
                    </h5>
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->

            <div class="d-flex align-items-center">
                {{-- <a href="/admin/courses" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i class="la la-book"></i> CURSO</a> --}}
                <a href="{{ route('admin_inicio') }}" class="btn btn-light-primary font-weight-bolder btn-sm mr-2"><i
                        class="la la-home"></i> INICIO</a>

                <a href="{{ route('admin_personas') }}" class="btn btn-light-primary font-weight-bolder btn-sm"><i
                        class="fas fa-list"></i> PERSONA</a>
            </div>
        </div>
    </div>
@endsection

@section('contenido')
    <div class="container">
        <div class="card card-custom">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card card-custom gutter-b">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">Lista de roles</h3>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-head-custom" id="tablaRoles">
                                        @include('admin.rol.table_rol')
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-custom gutter-b">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="card-label">Ingresar nuevo rol</h3>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <form action="{{ route('admin.crearEditar.roles') }} " method="post">
                                            @csrf

                                            <input type="hidden" name="idrol" id="idrol" value="">

                                            {{-- Mensajes de éxito o error --}}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @if (Session::has('success'))
                                                        <div class="alert alert-custom alert-success fade show"
                                                            role="alert">
                                                            <div class="alert-icon"><i class="la la-check"></i></div>
                                                            <div class="alert-text">{{ Session::get('success') }}</div>
                                                            <div class="alert-close">
                                                                <button type="button" class="close" data-dismiss="alert"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true"><i
                                                                            class="ki ki-close"></i></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if (Session::has('error'))
                                                        <div class="alert alert-custom alert-danger fade show"
                                                            role="alert">
                                                            <div class="alert-icon"><i class="la la-close"></i></div>
                                                            <div class="alert-text">{{ Session::get('error') }}</div>
                                                            <div class="alert-close">
                                                                <button type="button" class="close" data-dismiss="alert"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true"><i
                                                                            class="ki ki-close"></i></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group mb-4">
                                                        <label for="name" class="text-primary">Rol <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="name"
                                                            id="name" placeholder="Nombre del rol...">
                                                        @if ($errors->first('name'))
                                                            <span class="form-text text-danger"
                                                                id="errorRol">{{ $errors->first('name') }}</span>
                                                        @endif
                                                    </div>

                                                    <div id="permisos">
                                                        @include('admin.rol.lista_permisos')
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 text-center">
                                                    <button type="button" onclick="limpiar()"
                                                        class="btn btn-secondary font-weight-bold mr-2"><i
                                                            class="la la-close"></i> LIMPIAR</button>
                                                    <button type="submit" class="btn btn-primary font-weight-bold mr-2"><i
                                                            class="la la-plus-circle"></i> GUARDAR</button>
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
        </div>
    </div>
@endsection

@section('modal')
@endsection

@section('script')
    <script src="{{ asset('/recursos/admin/assets/js/pages/features/miscellaneous/toastr.js') }}"></script>

    <script>
        function limpiar() {
            $('#name').val('');
            $('#name').removeClass('is-invalid');
            $("#errorRol").html('');
            const checkboxes = document.querySelectorAll("input[type='checkbox']");
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });
            
            toastr.info('Formulario reseteado.');
        }

        function mostrarRoles(idrol) {
            $.get("/admin/roles/mostrarRol/" + idrol, function name(respuesta) {
                respuesta = JSON.parse(respuesta);

                console.log(respuesta);

                $("#idrol").val(respuesta.id);
                $('#name').val(respuesta.name);
                listarPermisos(idrol);
            })
        }

        // function listarPermisos(idrol) {
        //     $.get("/admin/roles/listarPermisos/"+idrol, function name(respuesta) {
        //         respuesta = JSON.parse(respuesta);

        //         console.log(respuesta);
        //     })
        // }

        function listarPermisos(idrol) {
            $.get(`/admin/roles/listarPermisos/${idrol}`, function(data, textStatus, jqXHR) {
                $("#permisos").html(data);

                //$('[data-toggle="tooltip"]').tooltip();
            });
        }

        function listarRoles() {
            $.get(`/admin/roles/obtener`, function(data, textStatus, jqXHR) {
                $("#tablaRoles").html(data);

                $('[data-toggle="tooltip"]').tooltip();
            });
        }

        function listarRoles() {
            $.get(`/admin/roles/obtener`, function(data, textStatus, jqXHR) {
                $("#tablaRoles").html(data);

                $('[data-toggle="tooltip"]').tooltip();
            });
        }

        function cambiarEstadoRol(idrol, estado) {
            Swal.fire({
                title: '¿Seguro que quiere cambiar el estado de este registro?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f64e60',
                confirmButtonText: 'Si, cambiar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.get(`/admin/roles/cambiarEstado/${idrol}/${estado}`, function(data, status) {
                        data = JSON.parse(data);
                        console.log(data);

                        if (data.status == true) {
                            Swal.fire('Estado cambiado', '', 'success');
                            listarRoles();
                        } else {
                            alert('Ocurrio un error, se refescara la página');
                            location.reload();
                        }
                    });
                } else {}
            });
        }
    </script>
@endsection
