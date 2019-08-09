<div class="modal modal-default fade in create" id="createrank" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<div style="font-size: 5em; color: green; text-align: center; margin: auto;">
					<i class="fas fa-plus-circle"></i>
					<span style="font-size: 0.3em; color: black;"><p>Rango de la tarifa</p></span>
				</div> 
			</div>
			<div class="modal-header">
				<div class="form-group col-md-12">
					<label for="ranktarifa" data-placement="auto" data-trigger="hover" data-html="true" data-toggle="popover" title="<b>Rango</b>" data-content="Escriba el rango al que le asignara la tarifa">
						<i style="font-size: 1.8rem; color: Dodgerblue;" class="fas fa-info-circle fa-2x fa-spin"></i>
						Rango
					</label>
					<small class="help-block with-errors">*</small>
					<input type="number" class="form-control" id="ranktarifa" required>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal" aria-label="Close" class="btn btn-success pull-right">{{ trans('adminlte_lang::message.add') }}</button>
			</div>
		</div>
	</div>
</div>