<div class="modal fade" id="modalcrearREvaEstudiante" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="revaestudiante_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="rea_id" id="rea_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="pea_id">Pregunta</label>
                                <select class="form-control select2" style="width:100%" name="pea_id" id="pea_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="rea_respuesta">Respuesta</label>
                                <input type="text" class="form-control" name="rea_respuesta" id="rea_respuesta" placeholder="Ingrese una Pregunta">
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