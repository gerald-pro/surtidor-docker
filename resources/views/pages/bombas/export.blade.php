<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Combustible</th>
        <th>Descripcion</th>
        <th>Estado</th>

    </tr>
    </thead>
    <tbody>
    @foreach($bombas as $bomba)
        <tr>
            <td>{{ $bomba->id }}</td>
            <td>{{ $bomba->codigo}}</td>
            <td>{{ $bomba->nombre}}</td>
            <td>{{ $bomba->combustible}}</td>
            <td>{{ $bomba->descripcion}}</td>
            <td>{{ $bomba->estado}}</td>

        </tr>
    @endforeach
    </tbody>
</table>