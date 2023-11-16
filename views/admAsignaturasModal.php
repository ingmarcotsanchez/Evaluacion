<div class="modal fade" id="modalcrearAsignatura" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="asignatura_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="asig_id" id="asig_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="car_id">Carrera</label>
                                <select class="form-control select2" style="width:100%" name="car_id" id="car_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="mat_codigo">Código</label>
                                <input type="text" class="form-control" name="mat_codigo" id="mat_codigo" placeholder="Ingrese el Peso">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="mat_nombre">Nombre</label>
                                <input type="text" class="form-control" name="mat_nombre" id="mat_nombre" placeholder="Ingrese el Alfanumerico">
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
