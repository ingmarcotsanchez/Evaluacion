<div class="modal fade" id="modalcrearMatricula" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="matricula_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="matr_id" id="matr_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="mat_id">Materia</label>
                                <select class="form-control select2" style="width:100%" name="mat_id" id="mat_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="usu_id_est">Estudiante</label>
                                <select class="form-control select2" style="width:100%" name="usu_id_est" id="usu_id_est" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="grupo">Grupo</label>
                                <input type="text" class="form-control" name="grupo" id="grupo" placeholder="Ingrese el Grupo">
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-group">
                                <label for="usu_id_pro">Profesor</label>
                                <select class="form-control select2" style="width:100%" name="usu_id_pro" id="usu_id_pro" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

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
