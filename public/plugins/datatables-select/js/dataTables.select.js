(function( factory ){
	if ( typeof define === 'function' && define.amd ) {
		define( ['jquery', 'datatables.net'], function ( $ ) {
			return factory( $, window, document );
		} );
	}
	else if ( typeof exports === 'object' ) {
		module.exports = function (root, $) {
			if ( ! root ) {
				root = window;
			}
			if ( ! $ || ! $.fn.dataTable ) {
				$ = require('datatables.net')(root, $).$;
			}
			return factory( $, root, root.document );
		};
	}
	else {
		factory( jQuery, window, document );
	}
}(function( $, window, document, undefined ) {
'use strict';
var DataTable = $.fn.dataTable;
DataTable.select = {};
DataTable.select.version = '1.3.1';
DataTable.select.init = function ( dt ) {
	var ctx = dt.settings()[0];
	var init = ctx.oInit.select;
	var defaults = DataTable.defaults.select;
	var opts = init === undefined ?
		defaults :
		init;
	var items = 'row';
	var style = 'api';
	var blurable = false;
	var toggleable = true;
	var info = true;
	var selector = 'td, th';
	var className = 'selected';
	var setStyle = false;
	ctx._select = {};
	if ( opts === true ) {
		style = 'os';
		setStyle = true;
	}
	else if ( typeof opts === 'string' ) {
		style = opts;
		setStyle = true;
	}
	else if ( $.isPlainObject( opts ) ) {
		if ( opts.blurable !== undefined ) {
			blurable = opts.blurable;
		}
		if ( opts.toggleable !== undefined ) {
			toggleable = opts.toggleable;
		}
		if ( opts.info !== undefined ) {
			info = opts.info;
		}
		if ( opts.items !== undefined ) {
			items = opts.items;
		}
		if ( opts.style !== undefined ) {
			style = opts.style;
			setStyle = true;
		}
		else {
			style = 'os';
			setStyle = true;
		}
		if ( opts.selector !== undefined ) {
			selector = opts.selector;
		}
		if ( opts.className !== undefined ) {
			className = opts.className;
		}
	}
	dt.select.selector( selector );
	dt.select.items( items );
	dt.select.style( style );
	dt.select.blurable( blurable );
	dt.select.toggleable( toggleable );
	dt.select.info( info );
	ctx._select.className = className;
	$.fn.dataTable.ext.order['select-checkbox'] = function ( settings, col ) {
		return this.api().column( col, {order: 'index'} ).nodes().map( function ( td ) {
			if ( settings._select.items === 'row' ) {
				return $( td ).parent().hasClass( settings._select.className );
			} else if ( settings._select.items === 'cell' ) {
				return $( td ).hasClass( settings._select.className );
			}
			return false;
		});
	};
	if ( ! setStyle && $( dt.table().node() ).hasClass( 'selectable' ) ) {
		dt.select.style( 'os' );
	}
};
function cellRange( dt, idx, last )
{
	var indexes;
	var columnIndexes;
	var rowIndexes;
	var selectColumns = function ( start, end ) {
		if ( start > end ) {
			var tmp = end;
			end = start;
			start = tmp;
		}
		var record = false;
		return dt.columns( ':visible' ).indexes().filter( function (i) {
			if ( i === start ) {
				record = true;
			}
			if ( i === end ) { 
				record = false;
				return true;
			}
			return record;
		} );
	};
	var selectRows = function ( start, end ) {
		var indexes = dt.rows( { search: 'applied' } ).indexes();
		if ( indexes.indexOf( start ) > indexes.indexOf( end ) ) {
			var tmp = end;
			end = start;
			start = tmp;
		}
		var record = false;
		return indexes.filter( function (i) {
			if ( i === start ) {
				record = true;
			}
			if ( i === end ) {
				record = false;
				return true;
			}
			return record;
		} );
	};
	if ( ! dt.cells( { selected: true } ).any() && ! last ) {
		columnIndexes = selectColumns( 0, idx.column );
		rowIndexes = selectRows( 0 , idx.row );
	}
	else {
		columnIndexes = selectColumns( last.column, idx.column );
		rowIndexes = selectRows( last.row , idx.row );
	}
	indexes = dt.cells( rowIndexes, columnIndexes ).flatten();
	if ( ! dt.cells( idx, { selected: true } ).any() ) {
		dt.cells( indexes ).select();
	}
	else {
		dt.cells( indexes ).deselect();
	}
}
function disableMouseSelection( dt )
{
	var ctx = dt.settings()[0];
	var selector = ctx._select.selector;
	$( dt.table().container() )
		.off( 'mousedown.dtSelect', selector )
		.off( 'mouseup.dtSelect', selector )
		.off( 'click.dtSelect', selector );
	$('body').off( 'click.dtSelect' + _safeId(dt.table().node()) );
}
function enableMouseSelection ( dt )
{
	var container = $( dt.table().container() );
	var ctx = dt.settings()[0];
	var selector = ctx._select.selector;
	var matchSelection;
	container
		.on( 'mousedown.dtSelect', selector, function(e) {
			if ( e.shiftKey || e.metaKey || e.ctrlKey ) {
				container
					.css( '-moz-user-select', 'none' )
					.one('selectstart.dtSelect', selector, function () {
						return false;
					} );
			}
			if ( window.getSelection ) {
				matchSelection = window.getSelection();
			}
		} )
		.on( 'mouseup.dtSelect', selector, function() {
			container.css( '-moz-user-select', '' );
		} )
		.on( 'click.dtSelect', selector, function ( e ) {
			var items = dt.select.items();
			var idx;
			if ( matchSelection ) {
				var selection = window.getSelection();
				if ( ! selection.anchorNode || $(selection.anchorNode).closest('table')[0] === dt.table().node() ) {
					if ( selection !== matchSelection ) {
						return;
					}
				}
			}
			var ctx = dt.settings()[0];
			var wrapperClass = $.trim(dt.settings()[0].oClasses.sWrapper).replace(/ +/g, '.');
			if ( $(e.target).closest('div.'+wrapperClass)[0] != dt.table().container() ) {
				return;
			}
			var cell = dt.cell( $(e.target).closest('td, th') );
			if ( ! cell.any() ) {
				return;
			}
			var event = $.Event('user-select.dt');
			eventTrigger( dt, event, [ items, cell, e ] );
			if ( event.isDefaultPrevented() ) {
				return;
			}
			var cellIndex = cell.index();
			if ( items === 'row' ) {
				idx = cellIndex.row;
				typeSelect( e, dt, ctx, 'row', idx );
			}
			else if ( items === 'column' ) {
				idx = cell.index().column;
				typeSelect( e, dt, ctx, 'column', idx );
			}
			else if ( items === 'cell' ) {
				idx = cell.index();
				typeSelect( e, dt, ctx, 'cell', idx );
			}
			ctx._select_lastCell = cellIndex;
		} );
	$('body').on( 'click.dtSelect' + _safeId(dt.table().node()), function ( e ) {
		if ( ctx._select.blurable ) {
			if ( $(e.target).parents().filter( dt.table().container() ).length ) {
				return;
			}
			if ( $(e.target).parents('html').length === 0 ) {
			 	return;
			}
			if ( $(e.target).parents('div.DTE').length ) {
				return;
			}
			clear( ctx, true );
		}
	} );
}
function eventTrigger ( api, type, args, any )
{
	if ( any && ! api.flatten().length ) {
		return;
	}
	if ( typeof type === 'string' ) {
		type = type +'.dt';
	}
	args.unshift( api );
	$(api.table().node()).trigger( type, args );
}
function info ( api )
{
	var ctx = api.settings()[0];
	if ( ! ctx._select.info || ! ctx.aanFeatures.i ) {
		return;
	}
	if ( api.select.style() === 'api' ) {
		return;
	}
	var rows    = api.rows( { selected: true } ).flatten().length;
	var columns = api.columns( { selected: true } ).flatten().length;
	var cells   = api.cells( { selected: true } ).flatten().length;
	var add = function ( el, name, num ) {
		el.append( $('<span class="select-item"/>').append( api.i18n(
			'select.'+name+'s',
			{ _: '%d '+name+'s selected', 0: '', 1: '1 '+name+' selected' },
			num
		) ) );
	};
	$.each( ctx.aanFeatures.i, function ( i, el ) {
		el = $(el);
		var output  = $('<span class="select-info"/>');
		add( output, 'row', rows );
		add( output, 'column', columns );
		add( output, 'cell', cells  );
		var exisiting = el.children('span.select-info');
		if ( exisiting.length ) {
			exisiting.remove();
		}
		if ( output.text() !== '' ) {
			el.append( output );
		}
	} );
}
function init ( ctx ) {
	var api = new DataTable.Api( ctx );
	ctx.aoRowCreatedCallback.push( {
		fn: function ( row, data, index ) {
			var i, ien;
			var d = ctx.aoData[ index ];
			if ( d._select_selected ) {
				$( row ).addClass( ctx._select.className );
			}
			for ( i=0, ien=ctx.aoColumns.length ; i<ien ; i++ ) {
				if ( ctx.aoColumns[i]._select_selected || (d._selected_cells && d._selected_cells[i]) ) {
					$(d.anCells[i]).addClass( ctx._select.className );
				}
			}
		},
		sName: 'select-deferRender'
	} );
	api.on( 'preXhr.dt.dtSelect', function () {
		var rows = api.rows( { selected: true } ).ids( true ).filter( function ( d ) {
			return d !== undefined;
		} );
		var cells = api.cells( { selected: true } ).eq(0).map( function ( cellIdx ) {
			var id = api.row( cellIdx.row ).id( true );
			return id ?
				{ row: id, column: cellIdx.column } :
				undefined;
		} ).filter( function ( d ) {
			return d !== undefined;
		} );
		api.one( 'draw.dt.dtSelect', function () {
			api.rows( rows ).select();
			if ( cells.any() ) {
				cells.each( function ( id ) {
					api.cells( id.row, id.column ).select();
				} );
			}
		} );
	} );
	api.on( 'draw.dtSelect.dt select.dtSelect.dt deselect.dtSelect.dt info.dt', function () {
		info( api );
	} );
	api.on( 'destroy.dtSelect', function () {
		disableMouseSelection( api );
		api.off( '.dtSelect' );
	} );
}
function rowColumnRange( dt, type, idx, last )
{
	var indexes = dt[type+'s']( { search: 'applied' } ).indexes();
	var idx1 = $.inArray( last, indexes );
	var idx2 = $.inArray( idx, indexes );
	if ( ! dt[type+'s']( { selected: true } ).any() && idx1 === -1 ) {
		indexes.splice( $.inArray( idx, indexes )+1, indexes.length );
	}
	else {
		if ( idx1 > idx2 ) {
			var tmp = idx2;
			idx2 = idx1;
			idx1 = tmp;
		}
		indexes.splice( idx2+1, indexes.length );
		indexes.splice( 0, idx1 );
	}
	if ( ! dt[type]( idx, { selected: true } ).any() ) {
		dt[type+'s']( indexes ).select();
	}
	else {
		indexes.splice( $.inArray( idx, indexes ), 1 );
		dt[type+'s']( indexes ).deselect();
	}
}
function clear( ctx, force )
{
	if ( force || ctx._select.style === 'single' ) {
		var api = new DataTable.Api( ctx );
		api.rows( { selected: true } ).deselect();
		api.columns( { selected: true } ).deselect();
		api.cells( { selected: true } ).deselect();
	}
}
function typeSelect ( e, dt, ctx, type, idx )
{
	var style = dt.select.style();
	var toggleable = dt.select.toggleable();
	var isSelected = dt[type]( idx, { selected: true } ).any();
	if ( isSelected && ! toggleable ) {
		return;
	}
	if ( style === 'os' ) {
		if ( e.ctrlKey || e.metaKey ) {
			dt[type]( idx ).select( ! isSelected );
		}
		else if ( e.shiftKey ) {
			if ( type === 'cell' ) {
				cellRange( dt, idx, ctx._select_lastCell || null );
			}
			else {
				rowColumnRange( dt, type, idx, ctx._select_lastCell ?
					ctx._select_lastCell[type] :
					null
				);
			}
		}
		else {
			var selected = dt[type+'s']( { selected: true } );
			if ( isSelected && selected.flatten().length === 1 ) {
				dt[type]( idx ).deselect();
			}
			else {
				selected.deselect();
				dt[type]( idx ).select();
			}
		}
	} else if ( style == 'multi+shift' ) {
		if ( e.shiftKey ) {
			if ( type === 'cell' ) {
				cellRange( dt, idx, ctx._select_lastCell || null );
			}
			else {
				rowColumnRange( dt, type, idx, ctx._select_lastCell ?
					ctx._select_lastCell[type] :
					null
				);
			}
		}
		else {
			dt[ type ]( idx ).select( ! isSelected );
		}
	}
	else {
		dt[ type ]( idx ).select( ! isSelected );
	}
}
function _safeId( node ) {
	return node.id.replace(/[^a-zA-Z0-9\-\_]/g, '-');
}
$.each( [
	{ type: 'row', prop: 'aoData' },
	{ type: 'column', prop: 'aoColumns' }
], function ( i, o ) {
	DataTable.ext.selector[ o.type ].push( function ( settings, opts, indexes ) {
		var selected = opts.selected;
		var data;
		var out = [];
		if ( selected !== true && selected !== false ) {
			return indexes;
		}
		for ( var i=0, ien=indexes.length ; i<ien ; i++ ) {
			data = settings[ o.prop ][ indexes[i] ];
			if ( (selected === true && data._select_selected === true) ||
			     (selected === false && ! data._select_selected )
			) {
				out.push( indexes[i] );
			}
		}
		return out;
	} );
} );
DataTable.ext.selector.cell.push( function ( settings, opts, cells ) {
	var selected = opts.selected;
	var rowData;
	var out = [];
	if ( selected === undefined ) {
		return cells;
	}
	for ( var i=0, ien=cells.length ; i<ien ; i++ ) {
		rowData = settings.aoData[ cells[i].row ];
		if ( (selected === true && rowData._selected_cells && rowData._selected_cells[ cells[i].column ] === true) ||
		     (selected === false && ( ! rowData._selected_cells || ! rowData._selected_cells[ cells[i].column ] ) )
		) {
			out.push( cells[i] );
		}
	}
	return out;
} );
var apiRegister = DataTable.Api.register;
var apiRegisterPlural = DataTable.Api.registerPlural;
apiRegister( 'select()', function () {
	return this.iterator( 'table', function ( ctx ) {
		DataTable.select.init( new DataTable.Api( ctx ) );
	} );
} );
apiRegister( 'select.blurable()', function ( flag ) {
	if ( flag === undefined ) {
		return this.context[0]._select.blurable;
	}
	return this.iterator( 'table', function ( ctx ) {
		ctx._select.blurable = flag;
	} );
} );
apiRegister( 'select.toggleable()', function ( flag ) {
	if ( flag === undefined ) {
		return this.context[0]._select.toggleable;
	}
	return this.iterator( 'table', function ( ctx ) {
		ctx._select.toggleable = flag;
	} );
} );
apiRegister( 'select.info()', function ( flag ) {
	if ( info === undefined ) {
		return this.context[0]._select.info;
	}
	return this.iterator( 'table', function ( ctx ) {
		ctx._select.info = flag;
	} );
} );
apiRegister( 'select.items()', function ( items ) {
	if ( items === undefined ) {
		return this.context[0]._select.items;
	}
	return this.iterator( 'table', function ( ctx ) {
		ctx._select.items = items;
		eventTrigger( new DataTable.Api( ctx ), 'selectItems', [ items ] );
	} );
} );
apiRegister( 'select.style()', function ( style ) {
	if ( style === undefined ) {
		return this.context[0]._select.style;
	}
	return this.iterator( 'table', function ( ctx ) {
		ctx._select.style = style;
		if ( ! ctx._select_init ) {
			init( ctx );
		}
		var dt = new DataTable.Api( ctx );
		disableMouseSelection( dt );
		if ( style !== 'api' ) {
			enableMouseSelection( dt );
		}
		eventTrigger( new DataTable.Api( ctx ), 'selectStyle', [ style ] );
	} );
} );
apiRegister( 'select.selector()', function ( selector ) {
	if ( selector === undefined ) {
		return this.context[0]._select.selector;
	}
	return this.iterator( 'table', function ( ctx ) {
		disableMouseSelection( new DataTable.Api( ctx ) );
		ctx._select.selector = selector;
		if ( ctx._select.style !== 'api' ) {
			enableMouseSelection( new DataTable.Api( ctx ) );
		}
	} );
} );
apiRegisterPlural( 'rows().select()', 'row().select()', function ( select ) {
	var api = this;
	if ( select === false ) {
		return this.deselect();
	}
	this.iterator( 'row', function ( ctx, idx ) {
		clear( ctx );
		ctx.aoData[ idx ]._select_selected = true;
		$( ctx.aoData[ idx ].nTr ).addClass( ctx._select.className );
	} );
	this.iterator( 'table', function ( ctx, i ) {
		eventTrigger( api, 'select', [ 'row', api[i] ], true );
	} );
	return this;
} );
apiRegisterPlural( 'columns().select()', 'column().select()', function ( select ) {
	var api = this;
	if ( select === false ) {
		return this.deselect();
	}
	this.iterator( 'column', function ( ctx, idx ) {
		clear( ctx );
		ctx.aoColumns[ idx ]._select_selected = true;
		var column = new DataTable.Api( ctx ).column( idx );
		$( column.header() ).addClass( ctx._select.className );
		$( column.footer() ).addClass( ctx._select.className );
		column.nodes().to$().addClass( ctx._select.className );
	} );
	this.iterator( 'table', function ( ctx, i ) {
		eventTrigger( api, 'select', [ 'column', api[i] ], true );
	} );
	return this;
} );
apiRegisterPlural( 'cells().select()', 'cell().select()', function ( select ) {
	var api = this;
	if ( select === false ) {
		return this.deselect();
	}
	this.iterator( 'cell', function ( ctx, rowIdx, colIdx ) {
		clear( ctx );
		var data = ctx.aoData[ rowIdx ];
		if ( data._selected_cells === undefined ) {
			data._selected_cells = [];
		}
		data._selected_cells[ colIdx ] = true;
		if ( data.anCells ) {
			$( data.anCells[ colIdx ] ).addClass( ctx._select.className );
		}
	} );
	this.iterator( 'table', function ( ctx, i ) {
		eventTrigger( api, 'select', [ 'cell', api[i] ], true );
	} );
	return this;
} );
apiRegisterPlural( 'rows().deselect()', 'row().deselect()', function () {
	var api = this;
	this.iterator( 'row', function ( ctx, idx ) {
		ctx.aoData[ idx ]._select_selected = false;
		$( ctx.aoData[ idx ].nTr ).removeClass( ctx._select.className );
	} );
	this.iterator( 'table', function ( ctx, i ) {
		eventTrigger( api, 'deselect', [ 'row', api[i] ], true );
	} );
	return this;
} );
apiRegisterPlural( 'columns().deselect()', 'column().deselect()', function () {
	var api = this;
	this.iterator( 'column', function ( ctx, idx ) {
		ctx.aoColumns[ idx ]._select_selected = false;
		var api = new DataTable.Api( ctx );
		var column = api.column( idx );
		$( column.header() ).removeClass( ctx._select.className );
		$( column.footer() ).removeClass( ctx._select.className );
		api.cells( null, idx ).indexes().each( function (cellIdx) {
			var data = ctx.aoData[ cellIdx.row ];
			var cellSelected = data._selected_cells;
			if ( data.anCells && (! cellSelected || ! cellSelected[ cellIdx.column ]) ) {
				$( data.anCells[ cellIdx.column  ] ).removeClass( ctx._select.className );
			}
		} );
	} );
	this.iterator( 'table', function ( ctx, i ) {
		eventTrigger( api, 'deselect', [ 'column', api[i] ], true );
	} );
	return this;
} );
apiRegisterPlural( 'cells().deselect()', 'cell().deselect()', function () {
	var api = this;
	this.iterator( 'cell', function ( ctx, rowIdx, colIdx ) {
		var data = ctx.aoData[ rowIdx ];
		data._selected_cells[ colIdx ] = false;
		if ( data.anCells && ! ctx.aoColumns[ colIdx ]._select_selected ) {
			$( data.anCells[ colIdx ] ).removeClass( ctx._select.className );
		}
	} );
	this.iterator( 'table', function ( ctx, i ) {
		eventTrigger( api, 'deselect', [ 'cell', api[i] ], true );
	} );
	return this;
} );
function i18n( label, def ) {
	return function (dt) {
		return dt.i18n( 'buttons.'+label, def );
	};
}
function namespacedEvents ( config ) {
	var unique = config._eventNamespace;
	return 'draw.dt.DT'+unique+' select.dt.DT'+unique+' deselect.dt.DT'+unique;
}
function enabled ( dt, config ) {
	if ( $.inArray( 'rows', config.limitTo ) !== -1 && dt.rows( { selected: true } ).any() ) {
		return true;
	}
	if ( $.inArray( 'columns', config.limitTo ) !== -1 && dt.columns( { selected: true } ).any() ) {
		return true;
	}
	if ( $.inArray( 'cells', config.limitTo ) !== -1 && dt.cells( { selected: true } ).any() ) {
		return true;
	}
	return false;
}
var _buttonNamespace = 0;
$.extend( DataTable.ext.buttons, {
	selected: {
		text: i18n( 'selected', 'Selected' ),
		className: 'buttons-selected',
		limitTo: [ 'rows', 'columns', 'cells' ],
		init: function ( dt, node, config ) {
			var that = this;
			config._eventNamespace = '.select'+(_buttonNamespace++);
			dt.on( namespacedEvents(config), function () {
				that.enable( enabled(dt, config) );
			} );
			this.disable();
		},
		destroy: function ( dt, node, config ) {
			dt.off( config._eventNamespace );
		}
	},
	selectedSingle: {
		text: i18n( 'selectedSingle', 'Selected single' ),
		className: 'buttons-selected-single',
		init: function ( dt, node, config ) {
			var that = this;
			config._eventNamespace = '.select'+(_buttonNamespace++);
			dt.on( namespacedEvents(config), function () {
				var count = dt.rows( { selected: true } ).flatten().length +
				            dt.columns( { selected: true } ).flatten().length +
				            dt.cells( { selected: true } ).flatten().length;
				that.enable( count === 1 );
			} );
			this.disable();
		},
		destroy: function ( dt, node, config ) {
			dt.off( config._eventNamespace );
		}
	},
	selectAll: {
		text: i18n( 'selectAll', 'Select all' ),
		className: 'buttons-select-all',
		action: function () {
			var items = this.select.items();
			this[ items+'s' ]().select();
		}
	},
	selectNone: {
		text: i18n( 'selectNone', 'Deselect all' ),
		className: 'buttons-select-none',
		action: function () {
			clear( this.settings()[0], true );
		},
		init: function ( dt, node, config ) {
			var that = this;
			config._eventNamespace = '.select'+(_buttonNamespace++);
			dt.on( namespacedEvents(config), function () {
				var count = dt.rows( { selected: true } ).flatten().length +
				            dt.columns( { selected: true } ).flatten().length +
				            dt.cells( { selected: true } ).flatten().length;
				that.enable( count > 0 );
			} );
			this.disable();
		},
		destroy: function ( dt, node, config ) {
			dt.off( config._eventNamespace );
		}
	}
} );
$.each( [ 'Row', 'Column', 'Cell' ], function ( i, item ) {
	var lc = item.toLowerCase();
	DataTable.ext.buttons[ 'select'+item+'s' ] = {
		text: i18n( 'select'+item+'s', 'Select '+lc+'s' ),
		className: 'buttons-select-'+lc+'s',
		action: function () {
			this.select.items( lc );
		},
		init: function ( dt ) {
			var that = this;
			dt.on( 'selectItems.dt.DT', function ( e, ctx, items ) {
				that.active( items === lc );
			} );
		}
	};
} );
$(document).on( 'preInit.dt.dtSelect', function (e, ctx) {
	if ( e.namespace !== 'dt' ) {
		return;
	}
	DataTable.select.init( new DataTable.Api( ctx ) );
} );
return DataTable.select;
}));
