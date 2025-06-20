@role('Administrador')
    @includeIf('sistema.dashboards.administrador')
    @elserole('Recepcionista')
    @includeIf('sistema.dashboards.recepcionista')
    @elserole('Cliente')
    @includeIf('sistema.dashboards.cliente', ['habitaciones' => $habitaciones])
@else
    <p>No hay un panel asignado</p>
@endrole
