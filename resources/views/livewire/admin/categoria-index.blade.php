<div class="mt-3">
    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "¡Éxito!",
                text: "{{ session('success') }}"
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "{{ session('error') }}"
            })
        </script>
    @endif
    <!-- formulario -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit mr-2"></i>
                Registrar Categoria
            </h3>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" name="name" placeholder="Escriba el nombre"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <input type="text" class="form-control" name="description"
                                placeholder="Escriba una descrición" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="color">Color</label>
                            <input type="color" class="form-control" name="color" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </div>

    {{-- tabla de cursos --}}
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title text-center">
                <i class="fas fa-table mr-2"></i>
                Tabla de categorias
            </h3>
        </div>
        <div class="card-body">
            <table id="categoria" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Color</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $categorias)
                        <tr>
                            <td>{{ $categorias->id }}</td>
                            <td>{{ $categorias->name }}</td>
                            <td>{{ $categorias->description }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="d-inline-block rounded-circle mr-2"
                                        style="width: 24px; height: 24px; background-color: {{ $categorias->color }};"></span>
                                </div>
                            </td>
                            <td width="10px">
                                <a href="" class="btn btn-warning" data-toggle="modal"
                                    data-target="#editModal{{ $categorias->id }}"><i class="fas fa-edit"></i></a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('admin.categoria.destroy', $categorias->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <!-- Modal de edición -->
                        <div class="modal fade" id="editModal{{ $categorias->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="editModal{{ $categorias->id }}Label" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModal{{ $categorias->id }}Label">Editar
                                            categoria</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.categoria.update', $categorias->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <!-- Campos del formulario de edición -->
                                            <div class="form-group">
                                                <label for="name{{ $categorias->id }}">Nombre</label>
                                                <input type="text" class="form-control" name="name"
                                                    id="name{{ $categorias->id }}" value="{{ $categorias->name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="description{{ $categorias->id }}">Descripción</label>
                                                <input type="text" class="form-control" name="description"
                                                    id="description{{ $categorias->id }}"
                                                    value="{{ $categorias->description }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="color{{ $categorias->id }}">Color</label>
                                                <input type="color" class="form-control" name="color"
                                                    id="color{{ $categorias->id }}" value="{{ $categorias->color }}">
                                            </div>
                                            <!-- Otros campos del formulario -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
