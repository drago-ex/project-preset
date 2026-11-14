// these JS + SCSS will be automatically available after installing the package
import { registerNajaExtensions } from './core/base.js';
import { initAdminTheme } from './core/admin-theme.js';
import Spinner from './naja/spinner.js';
import GalleryCopy from './naja/gallery.js';
import PermissionToggle from './naja/permission-toggle.js';

// drago-ex extensions
import { SubmitButtonDisable, TomSelectHandler } from 'drago-form';
import { BootstrapComponents, BootstrapDropdowns } from 'drago-component';
import { ToastHandler } from 'drago-application';
import DataGrid from 'drago-datagrid';
import TexyToolbar from 'drago-texy-toolbar';

// compostrap: the checkboxes of the rows and the bar of the bulk actions of a datagrid
import { RowSelection } from 'compostrap/selection';

// compostrap: the calendar of the date filters of a datagrid (needs vanilla-calendar-pro)
import { Datepicker } from 'compostrap/datepicker';

// compostrap: the area to drop images on, of the gallery and of the main image of an article (the script marks it
// while a file is dragged over it, writes the names of the chosen files and sends the form of the gallery)
import { DropzoneInput } from 'compostrap/dropzone';

// page styles
import './admin.scss';

document.addEventListener('DOMContentLoaded', () => {
	initAdminTheme();
});

new DataGrid().initialize(naja);
RowSelection.init();
Datepicker.init();

// a dropzone is bound once, so the ones of a redrawn snippet (the form in an offcanvas) are bound after it
DropzoneInput.init();
naja.snippetHandler.addEventListener('afterUpdate', (event) => DropzoneInput.init(event.detail.snippet));
registerNajaExtensions(
	Spinner,
	SubmitButtonDisable,
	TomSelectHandler,
	BootstrapComponents,
	BootstrapDropdowns,
	ToastHandler,
	TexyToolbar,
	GalleryCopy,
	PermissionToggle
);
