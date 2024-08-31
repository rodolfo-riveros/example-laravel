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
                html: '<ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>'
            });
        </script>
    @endif
    <!-- formulario -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-edit mr-2"></i>
                Registro de un nuevo producto
            </h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.producto.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Categoría</label>
                            <select class="form-control" name="category_id" required>
                                <option selected disabled>Seleccione una opción</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nombre del producto</label>
                            <input type="text" class="form-control" name="name" placeholder="Nombre del producto" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <input type="text" class="form-control" name="description" placeholder="Escriba una descripción" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="text" class="form-control" name="precio" placeholder="Escriba el precio del producto" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="text" class="form-control" name="stock" placeholder="Escriba el stock del producto" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
        </div>
    </div>

    {{-- tabla de cursos--}}
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title text-center">
                <i class="fas fa-table mr-2"></i>
                Tabla de productos
            </h3>
        </div>
        <div class="card-body">
            <table id="producto" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Categoria</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->category->name }}</td>
                        <td>{{ $producto->name }}</td>
                        <td>{{ Str::limit($producto->description, 50) }}</td>
                        <td>{{ $producto->precio }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td width="10px">
                            <a href="" class="btn btn-warning" data-toggle="modal" data-target="#editModal{{ $producto->id }}"><i class="fas fa-edit"></i></a>
                        </td>
                        <td width="10px">
                            <form action="{{ route('admin.producto.destroy', $producto->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <!-- Modal de edición -->
                    <div class="modal fade" id="editModal{{ $producto->id }}" tabindex="-1" role="dialog" aria-labelledby="editModal{{ $producto->id }}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModal{{ $producto->id }}Label">Editar producto</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.producto.update', $producto->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Categoría</label>
                                            <select class="form-control" name="category_id">
                                                <option disabled>Seleccione una opción</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $producto->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="name{{ $producto->id }}">Nombre del producto</label>
                                            <input type="text" class="form-control" name="name" id="name{{ $producto->id }}" value="{{ $producto->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description{{ $producto->id }}">Descripción</label>
                                            <input type="text" class="form-control" name="description" id="description{{ $producto->id }}" value="{{ $producto->description }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="precio{{ $producto->id }}">Precio</label>
                                            <input type="text" class="form-control" name="precio" id="precio{{ $producto->id }}" value="{{ $producto->precio }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="stock{{ $producto->id }}">Stock</label>
                                            <input type="text" class="form-control" name="stock" id="stock{{ $producto->id }}" value="{{ $producto->stock }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="stock{{ $producto->id }}">Image</label>
                                            <input type="text" class="form-control" name="image" id="image{{ $producto->id }}" value="{{ $producto->image }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="stock{{ $producto->id }}">Manual</label>
                                            <input type="text" class="form-control" name="manual" id="manual{{ $producto->id }}" value="{{ $producto->manual}}" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
