const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
	 .js('resources/assets/js/app-landing.js', 'public/js/app-landing.js')
	 .sourceMaps()
	 .combine([
			 'node_modules/bootstrap/dist/css/bootstrap.min.css',
			 'node_modules/@fortawesome/fontawesome-free/css/all.css',
			 'node_modules/admin-lte/dist/css/AdminLTE.min.css',
			 'node_modules/admin-lte/dist/css/skins/_all-skins.css',
			 'node_modules/icheck/skins/square/blue.css',
			 'resources/assets/css/loader-dt.css'
	 ], 'public/css/all.css')
	 .combine([
			'resources/assets/css/app.css'
		], 'public/css/app.css')
	 .combine([
			 'node_modules/bootstrap/dist/css/bootstrap.min.css',
	 ], 'public/css/all-landing.css')
	 .combine([
				'node_modules/@fortawesome/fontawesome-free/css/all.css',
				'resources/assets/css/bootstrap-switch-personalizado.css',
				'node_modules/smartwizard/dist/css/smart_wizard.css',
				'node_modules/smartwizard/dist/css/smart_wizard_theme_arrows.css',
				'node_modules/inputmask/css/inputmask.css',
				'node_modules/select2/dist/css/select2.css',
				'node_modules/toastr/build/toastr.css'
		], 'public/css/dependencias.css')
	 .combine([
				'node_modules/chart.js/dist/Chart.css'
		], 'public/css/chart.css')
	 .combine([
				'node_modules/bootstrap-slider/dist/css/bootstrap-slider.css'
		], 'public/css/bootstrap-slider.css')
	 .combine([
				'node_modules/@fullcalendar/core/main.css',
				'node_modules/@fullcalendar/daygrid/main.css',
				'node_modules/@fullcalendar/timegrid/main.css'
		], 'public/css/fullcalendar.css')
	 .combine([
				'node_modules/datatables.net-dt/css/jquery.dataTables.css',
				'node_modules/datatables.net-autofill-dt/css/autoFill.dataTables.css',
				'node_modules/datatables.net-buttons-dt/css/buttons.dataTables.css',
				'node_modules/datatables.net-colreorder-dt/css/colReorder.dataTables.css',
				'node_modules/datatables.net-fixedcolumns-dt/css/fixedColumns.dataTables.css',
				'node_modules/datatables.net-fixedheader-dt/css/fixedHeader.dataTables.css',
				'node_modules/datatables.net-keytable-dt/css/keyTable.dataTables.css',
				'node_modules/datatables.net-responsive-dt/css/responsive.dataTables.css',
				'node_modules/datatables.net-scroller-dt/css/scroller.dataTables.css',
				'node_modules/datatables.net-select-dt/css/select.dataTables.css'
		], 'public/css/datatable-depen.css')
	 .combine([
				'node_modules/datatables.net-plugins/features/searchHighlight/dataTables.searchHighlight.css'
		], 'public/css/datatable-plugins.css')
	 .combine([
				'resources/assets/css/stilosPersonalizados.css',
				'resources/assets/css/stilosloading.css'
		], 'public/css/stilosPersonalizados.css')
	 .combine([
				'resources/assets/css/calendarioPersonalizado.css'
		], 'public/css/calendarioPersonalizado.css')
	 .scripts([
				'node_modules/@fortawesome/fontawesome-free/js/all.js',
				'resources/assets/js/bootstrap-switch.js',
				'node_modules/jquery-slimscroll/jquery.slimscroll.js',
				'node_modules/smartwizard/dist/js/jquery.smartWizard.js',
				'node_modules/inputmask/dist/inputmask/inputmask.js',
				'node_modules/inputmask/dist/inputmask/inputmask.extensions.js',
				'node_modules/inputmask/dist/inputmask/inputmask.numeric.extensions.js',
				'node_modules/inputmask/dist/inputmask/inputmask.date.extensions.js',
				'node_modules/inputmask/dist/inputmask/jquery.inputmask.js',
				'node_modules/inputmask/dist/jquery.inputmask.bundle.js',
				'node_modules/inputmask/dist/inputmask/bindings/inputmask.binding.js',
				'resources/js/validator.js',
				'node_modules/select2/dist/js/select2.full.js',
				'node_modules/jszip/dist/jszip.js',
				'node_modules/toastr/toastr.js',
				'resources/js/jquery.highlight.js'
		], 'public/js/dependencias.js')
	 .scripts([
				'node_modules/chart.js/dist/Chart.bundle.js',
				'node_modules/chart.js/dist/Chart.js'
		], 'public/js/chart.js')
	 .scripts([
			'node_modules/@fullcalendar/core/main.js',
			'node_modules/@fullcalendar/daygrid/main.js',
			'node_modules/@fullcalendar/timegrid/main.js',
			'node_modules/@fullcalendar/interaction/main.min.js',
			'node_modules/@fullcalendar/core/locales/es.js'
		], 'public/js/fullcalendar.js')
	 .scripts([
				'node_modules/datatables.net/js/jquery.dataTables.js',
				'node_modules/datatables.net-dt/js/dataTables.dataTables.js',
				'node_modules/datatables.net-buttons/js/dataTables.buttons.js',
				'node_modules/datatables.net-buttons/js/buttons.html5.js',
				'node_modules/datatables.net-buttons/js/buttons.flash.js',	
				'node_modules/datatables.net-buttons/js/buttons.colVis.js',
				'node_modules/datatables.net-colreorder/js/dataTables.colReorder.js',
				'node_modules/datatables.net-fixedcolumns/js/dataTables.fixedColumns.js',
				'node_modules/datatables.net-fixedheader/js/dataTables.fixedHeader.js',
				'node_modules/datatables.net-keytable/js/dataTables.keyTable.js',
				'node_modules/datatables.net-responsive/js/dataTables.responsive.js',
				'node_modules/datatables.net-rowgroup/js/dataTables.rowGroup.js',
				'node_modules/datatables.net-scroller/js/dataTables.scroller.js',
				'node_modules/datatables.net-select/js/dataTables.select.js',
				'node_modules/datatables.net-dt/css/jquery.dataTables.js',
				'node_modules/datatables.net-buttons-dt/js/buttons.dataTables.js',
				'node_modules/datatables.net-keytable-dt/js/keyTable.dataTables.js',
				'node_modules/datatables.net-scroller-dt/js/scroller.dataTables.js',
				'node_modules/datatables.net-select-dt/js/select.dataTables.js'
		], 'public/js/datatable-depen.js')
	 .scripts([
				// 'node_modules/datatables.net-plugins/pagination/input.js',
				// 'node_modules/datatables.net-plugins/filtering/row-based/range_dates.js',
				// 'node_modules/datatables.net-plugins/filtering/row-based/range_numbers.js',
				'node_modules/datatables.net-plugins/features/searchHighlight/dataTables.searchHighlight.js'
		], 'public/js/datatable-plugins.js')

	 // PACKAGE (ADMINLTE-LARAVEL) RESOURCES
	 .copy('resources/assets/img/','public/img/')
	 .copy('resources/assets/images/','public/images/')
	 // //VENDOR RESOURCES
	 // .copy('node_modules/font-awesome/fonts/*.*','public/fonts/')
	 // .copy('node_modules/ionicons/dist/fonts/*.*','public/fonts/')
	 // .copy('node_modules/bootstrap/fonts/*.*','public/fonts/')
	 // .copy('node_modules/admin-lte/dist/css/skins/*.*','public/css/skins')
	 // .copy('node_modules/admin-lte/dist/img','public/img')
	 // .copy('node_modules/admin-lte/plugins','public/plugins')
	 // .copy('node_modules/icheck/skins/square/blue.png','public/css')
	 // .copy('node_modules/icheck/skins/square/blue@2x.png','public/css')

	
if (mix.config.inProduction) {
	mix.version();
	mix.minify();
}
