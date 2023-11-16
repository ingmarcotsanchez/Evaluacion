<div class="modal fade" id="modalcrearUsuario" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="usuario_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="usu_id" id="usu_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="usu_usuario">Usuario</label>
                                <input type="text" class="form-control" name="usu_usuario" id="usu_usuario" placeholder="Ingrese un usuario">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="usu_nombre">Nombre</label>
                                <input type="text" class="form-control" name="usu_nombre" id="usu_nombre" placeholder="Ingrese un Nombre">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="usu_apellidos">Apellidos</label>
                                <input type="text" class="form-control" name="usu_apellidos" id="usu_apellidos" placeholder="Ingrese los Apellidos">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="usu_email">Correo Electrónico</label>
                                <input type="email" class="form-control" name="usu_email" id="usu_email" placeholder="Ingrese un Correo">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="usu_clave">Contraseña</label>
                                <input type="email" class="form-control" name="usu_clave" id="usu_clave" placeholder="Ingrese un password">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="car_id">Carrera</label>
                                <select class="form-control select2" style="width:100%" name="car_id" id="car_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="usu_pensum">Pensum</label>
                                <input type="text" class="form-control" name="usu_pensum" id="usu_pensum" placeholder="Ingrese un Correo">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="per_id">Periodo</label>
                                <select class="form-control select2" style="width:100%" name="per_id" id="per_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="rol_id">Rol</label>
                                <select class="form-control select2" style="width:100%" name="rol_id" id="rol_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="usu_direccion">Dirección</label>
                                <input type="text" class="form-control" name="usu_direccion" id="usu_direccion" placeholder="Ingrese su Dirección">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="usu_tel">Teléfono</label>
                                <input type="text" class="form-control" name="usu_tel" id="usu_tel" placeholder="Ingrese su Celular">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="usu_sede">Sede</label>
                                <select class="form-control select2" style="width:100%" name="usu_sede" id="usu_sede" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value="B">Bogotá</option>
                                    <option value="G">Girardot</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="action" value="add" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>