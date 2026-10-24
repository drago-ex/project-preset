// these JS + SCSS will be automatically available after installing the package
// the full Bootstrap (drago-application and drago-component import it too) registers the data attributes of all
// components, e.g. the navbar collapse; a bootstrap/js/dist/* copy beside it would register them twice
import 'bootstrap';
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

// "Reply" under a blog comment puts "#2 Name " into the comment form, which links the comment when it is shown
document.addEventListener('click', (event) => {
	const link = event.target.closest('[data-comment-reply]');
	const textarea = document.querySelector('#comment-form textarea');
	if (!link || !textarea) {
		return;
	}

	event.preventDefault();
	const value = textarea.value.trimEnd();
	textarea.value = (value ? value + '\n' : '') + link.dataset.commentReply;
	textarea.scrollIntoView({ block: 'center', behavior: 'smooth' });
	textarea.focus({ preventScroll: true });
	textarea.setSelectionRange(textarea.value.length, textarea.value.length);
});

registerNajaExtensions(
	Spinner,
	SubmitButtonDisable,
	ToastHandler,
	BootstrapDropdowns,
	TexyToolbar
);
