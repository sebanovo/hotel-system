@role('Administrador')
    @includeIf('sistema.dashboards.administrador')
    @elserole('Recepcionista')
    @includeIf('sistema.dashboards.recepcionista')
    @elserole('Cliente')
    @includeIf('sistema.dashboards.cliente', ['habitaciones' => $habitaciones, 'servicios' => $servicios])
@else
    <p>No hay un panel asignado</p>
@endrole
