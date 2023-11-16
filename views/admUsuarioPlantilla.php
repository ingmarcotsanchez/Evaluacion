
<div class="modal fade" id="modalUsuario" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Cargar Excel</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label">Seleccionar Archivo: <span class="tx-danger">*</span></label>
                        <form enctype="multipart/form-data">
                            <!-- TODO: InputFile para subir archivo -->
                            <input id="upload" type=file name="files[]">
                        </form>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
                <button type="reset" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        
        </div>
    </div>
</div>
