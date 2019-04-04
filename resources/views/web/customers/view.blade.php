@extends('web.layouts.app')

@section('content')

<div class="container">
	<div class="row justify-content-center">
        <div class="col-md-12">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap mb-2">
                <div>
                    <a class="h5"><i class="fas fa-female"></i> {{ __('Ver Clienta:') . ' ' . $customer->name }} <span class="badge badge-dark ml-2">{{ 'Puntos:' . ' ' . $points }}</span> <span class="badge badge-info ml-2">{{ 'Descuentos Disponibles:' . ' ' . $available_discount_amount }}</span></a>
                </div>
                <div>
                    <a class="btn btn-success" href="{{ '/web/customers/' . $customer->getRouteKey() . '/job/create' }}"><i class="fas fa-comment-dollar"></i> {{ __('Nuevo Trabajo') }}</a>
                    <a href="{{ '/web/customers/' . $customer->getRouteKey() . '/edit' }}" class="btn btn-primary"><i class="fas fa-edit"></i> {{ __('Editar Cliente') }}</a>
                    <a href="/web/customers" class="btn btn-outline-primary"><i class="fas fa-list"></i> {{ __('Lista') }}</a>
                    <a href="#" class="btn btn-outline-warning" onclick="{{ 'deactivate' . $customer->id . '()' }}"><i class="fas fa-exclamation-triangle"></i></a>
                    <a href="#" class="btn btn-outline-danger" onclick="{{ 'delete' . $customer->id . '()' }}"><i class="fas fa-trash"></i></a>
                    <form id="{{ 'delete-record' . $customer->getRouteKey() }}" method="post" action="{{ '/web/customers/' . $customer->getRouteKey() }}">
                        <input name="_method" type="hidden" value="DELETE">
                        @csrf
                    </form>
                    <form id="{{ 'deactivate-record' . $customer->getRouteKey() }}" method="post" action="{{ '/web/customers/' . $customer->getRouteKey() . '/inactivate' }}">
                        <input name="_method" type="hidden" value="PUT">
                        @csrf
                    </form>
                </div>
            </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="mt-2">{{ __('Información Principal') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="order-md-1">

                            <div id="entity_data">
                                <div class="row mt-4">
                                    <div class="col-md-4 mb-3">
                                        <label for="name"><a class="text-danger">*</a> {{ __('Nombre') }}<span class="text-muted ml-1">{{ __('  (Obligatorio)') }}</span></label>
                                        <input type="text" class="form-control" id="name" value="{{ $customer->name }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="instagram"><i class="fab fa-instagram"></i> {{ __('Instagram') }}</label>
                                        <input type="text" class="form-control" id="instagram" value="{{ $customer->instagram }}" readonly>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="phone"><i class="fas fa-phone"></i> {{ __('Teléfono') }}</label>
                                        <input type="text" class="form-control" id="phone" value="{{ $customer->phone }}" readonly>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6 mb-3">
                                        <label for="source">{{ __('¿Cómo nos Conoce?') }}</label>
                                        <input type="text" class="form-control" id="source_id" @isset($customer->source->name)value="{{ $customer->source->name }}" @endisset readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="artist">{{ __('Artista Asignado por defecto') }}</label>
	                                    <input type="text" class="form-control" id="artist_id" @isset($customer->artist->name)value="{{ $customer->artist->name }}" @endisset readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    @include('web.customers.jobs')

</div>

@endsection

@section('ps_scripts')

@endsection

@push('form_scripts')

    <script>
        function {{ 'delete' . $customer->id . '()' }} {
            swal({
                title: "{{ __('Seguro que desea eliminar a la clienta?') . ' ' . $customer->getNameValue() }}",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#e84860',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Si, Borrar',
                cancelButtonText: "No, Cancelar"
            }).then((result) => {
                    if (result.value) {
                        event.preventDefault();
                        document.getElementById('{{ 'delete-record' . $customer->getRouteKey() }}').submit();
                    }
                }
            )
        }
    </script>

    <script>
        function {{ 'deactivate' . $customer->id . '()' }} {
            swal({
                title: "{{ __('Seguro que desea desactivar a la clienta?') . ' ' . $customer->getNameValue() }}",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#f6993f',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Si, Borrar',
                cancelButtonText: "No, Cancelar"
            }).then((result) => {
                    if (result.value) {
                        event.preventDefault();
                        document.getElementById('{{ 'deactivate-record' . $customer->getRouteKey() }}').submit();
                    }
                }
            )
        }
    </script>

@endpush
