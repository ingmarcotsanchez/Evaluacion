<div class="modal fade" id="modalcrearRInsEstudiante" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="rinsestudiante_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="rei_id" id="rei_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="pei_id">Pregunta</label>
                                <select class="form-control select2" style="width:100%" name="pei_id" id="pei_id" data-placeholder="Seleccione">
                                
                                    <option label="Seleccione"></option>

                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="rei_respuesta">Respuesta</label>
                                <input type="text" class="form-control" name="rei_respuesta" id="rei_respuesta" placeholder="Ingrese una Pregunta">
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