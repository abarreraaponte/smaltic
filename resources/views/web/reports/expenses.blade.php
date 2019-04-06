@extends('web.layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col col-md-12">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap mb-2">
                    <div>
                        <a class="h5"><i class="fas fa-calendar-check"></i> {{ __('Reporte de Gastos') }}</a>
                    </div>
                    <div>
                        <a class="btn btn-dark" href="/web/reports"><i class="fas fa-list"></i> Volver</a>
                        <a class="btn btn-success" href="#" onclick="exportdata()"><i class="fas fa-file-excel"></i>Exportar a Excel</a>
                        <form id="exporttoexcel" method="post" action="/web/reports/expenses/export">
                            @csrf
                            @if($date_from != null)
                                <input type="hidden" name="date_from" value="{{ $date_from }}">
                            @endif
                            @if($date_until != null)
                                <input type="hidden" name="date_until" value="{{ $date_until }}">
                            @endif
                            @if(request()->old('categories') != null)
                                @foreach(request()->old('categories') as $key => $value)
                                    <input type="hidden" name="categories[]" value="{{ $value }}">
                                @endforeach
                            @endif
                            @if(request()->old('payment_statuses') != null)
                                @foreach(request()->old('payment_statuses') as $key => $value)
                                    <input type="hidden" name="payment_statuses[]" value="{{ $value }}">
                                @endforeach
                            @endif
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="table-responsive table-hover">
                            @include('web.reports.expenses-table')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('list_scripts')
    <script>
        function exportdata() {
            swal({
                title: "{{ 'Estás seguro que deseas exportar esta información?' }}",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#38C172',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Exportar',
                cancelButtonText: "No, Cancelar"
            }).then((result) => {
                    if (result.value) {
                        event.preventDefault();
                        document.getElementById('exporttoexcel').submit();
                    }
                }
            )
        }
    </script>
@endpush
