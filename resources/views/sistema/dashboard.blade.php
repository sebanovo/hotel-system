@role('Administrador')
    @includeIf('dashboards.administrador')
    @elserole('Recepcionista')
    @includeIf('dashboards.recepcionista')
    @elserole('Cliente')
    @includeIf('dashboards.cliente')
@else
    <p>No hay un panel asignado</p>
@endrole
