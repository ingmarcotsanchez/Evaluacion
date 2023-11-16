<div class="modal fade" id="modalcrearCarrera" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="titulo_modal" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" id="carrera_form">
                <div class="modal-body">
                    
                    <input type="hidden" name="car_id" id="car_id">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="car_snies">SNIES</label>
                                <input type="text" class="form-control" name="car_snies" id="car_snies" placeholder="Ingrese el Peso">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="car_nombre">Nombre</label>
                                <input type="text" class="form-control" name="car_nombre" id="car_nombre" placeholder="Ingrese el Alfanumerico">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="car_tipo">Tipo</label>
                                <select class="form-control select2" style="width:100%" name="car_tipo" id="car_tipo" data-placeholder="Seleccione">
                                    <option label="Seleccione"></option>
                                    <option value="TP">Técnico Profesional</option>
                                    <option value="TL">Técnico Laboral</option>
                                    <option value="PP">Profesional</option>
                                    <option value="ES">Especialización</option>
                                    <option value="MA">Maestría</option>
                                    <option value="AI">Asistentes e Itinerantes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="car_sede">Sede</label>
                                <select class="form-control select2" style="width:100%" name="car_sede" id="car_sede" data-placeholder="Seleccione">
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
