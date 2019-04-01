<div class="modal modal-default fade in" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div style="font-size: 2em; text-align: center; margin: auto;">
                        <span style=" color: black;"><p>Añadir nuevo Recurso</p></span>
                    </div>
                
                        <div class="modal-body">
                            <div class="col-md-12">
                            <label for="categoria">Categoría</label>
                            <select class="form-control" id="categoria" name="RecCarte" required>
                                <option value="">Seleccione...</option>
                                <option>Foto</option>
                                <option>Video</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="tipo">Tipo</label>
                            <select class="form-control" id="tipo" name="RecTipo" required>
                                <option value="">Seleccione...</option>
                                <option>Cargue</option>
                                <option>Descargue</option>
                                <option>Pesaje</option>
                                <option>Reempacado</option>
                                <option>Mezclado</option>
                                <option>Destruccion</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="recursoinputext">Archivos</label>
                            <input type="file" class="form-control" id="recursoinputext" name="RecSrc[]" accept=".jpg, .jpeg, .png, .mp4" multiple required>
                        </div>
                        <div class="col-md-12">
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary pull-right">Guardar</button>
                                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div> 
                        <input hidden value="1" name="number">
                </div>
            </div>
        </div>
    </div>
</div>