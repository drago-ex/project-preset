// these JS + SCSS will be automatically available after installing the package
import 'bootstrap/js/dist/collapse';
import { registerNajaExtensions } from './core/base.js';
import Spinner from './naja/spinner.js';
import { ThemeSwitcher } from 'theme-switcher-compostrap';

// drago-ex extensions
import { SubmitButtonDisable } from 'drago-form';
import { ToastHandler } from 'drago-application';
import { BootstrapDropdowns } from 'drago-component';
import TexyToolbar from 'drago-texy-toolbar';
import { initCopyCode } from 'drago-texy-toolbar/copy-code';

// page styles
import './front.scss';

new ThemeSwitcher().initialize();
document.addEventListener('DOMContentLoaded', () => initCopyCode({ label: 'Copy' }));

registerNajaExtensions(
	Spinner,
	SubmitButtonDisable,
	ToastHandler,
	BootstrapDropdowns,
	TexyToolbar
);
