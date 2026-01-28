import './bootstrap';
import $ from 'jquery';
window.$ = $;
window.jQuery = $;

// Admin profile avatar preview
document.addEventListener('DOMContentLoaded', function () {
	const avatarInput = document.querySelector('input[name="avatar"]');
	if (!avatarInput) return;

	const previewImg = document.querySelector('#avatar-preview');
	avatarInput.addEventListener('change', function (e) {
		const file = e.target.files[0];
		if (!file) return;
		if (!file.type.startsWith('image/')) return;

		const reader = new FileReader();
		reader.onload = function (ev) {
			if (previewImg) {
				previewImg.src = ev.target.result;
			} else {
				const img = document.createElement('img');
				img.id = 'avatar-preview';
				img.className = 'rounded-circle mb-3';
				img.style.width = '120px';
				img.style.height = '120px';
				img.style.objectFit = 'cover';
				img.src = ev.target.result;
				const container = document.querySelector('.profile-avatar-container');
				if (container) container.prepend(img);
			}
		};
		reader.readAsDataURL(file);
	});
});

// Header interactions: sidebar toggle, theme toggle, notifications/messages
document.addEventListener('DOMContentLoaded', function () {
	const sidebarToggle = document.getElementById('sidebarToggle');
	const wrapper = document.querySelector('.admin-wrapper');
	if (sidebarToggle && wrapper) {
		sidebarToggle.addEventListener('click', () => {
			wrapper.classList.toggle('sidebar-collapsed');
			localStorage.setItem('admin.sidebarCollapsed', wrapper.classList.contains('sidebar-collapsed'));
		});

		// restore state
		if (localStorage.getItem('admin.sidebarCollapsed') === 'true') {
			wrapper.classList.add('sidebar-collapsed');
		}
	}

	const themeToggle = document.getElementById('themeToggle');
	if (themeToggle) {
		themeToggle.addEventListener('click', () => {
			document.body.classList.toggle('light-theme');
			const isLight = document.body.classList.contains('light-theme');
			localStorage.setItem('admin.theme', isLight ? 'light' : 'dark');
			// set FA icon
			themeToggle.innerHTML = isLight ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
		});

		// restore theme
		const saved = localStorage.getItem('admin.theme');
		if (saved === 'light') {
			document.body.classList.add('light-theme');
			themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
		} else {
			themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
		}
	}

	// notifications/messages panels
	function setupPanel(btnId, panelId) {
		const btn = document.getElementById(btnId);
		const panel = document.getElementById(panelId);
		if (!btn || !panel) return;

		btn.addEventListener('click', (e) => {
			e.stopPropagation();
			panel.classList.toggle('d-block');
			panel.classList.toggle('d-none');
		});
	}

	setupPanel('notifBtn', 'notifPanel');
	setupPanel('msgBtn', 'msgPanel');

	// close panels when clicking outside
	document.addEventListener('click', () => {
		document.querySelectorAll('.dropdown-panel.d-block').forEach(p => {
			p.classList.remove('d-block');
			p.classList.add('d-none');
		});
	});

	// Sidebar rail hover and compact toggle
	const adminSidebar = document.getElementById('adminSidebar');
	const compactToggle = document.getElementById('sidebarCompactToggle');
	if (adminSidebar && wrapper) {
		adminSidebar.addEventListener('mouseenter', () => {
			if (!wrapper.classList.contains('sidebar-collapsed')) {
				wrapper.classList.add('sidebar-expanded');
				localStorage.setItem('admin.sidebarExpanded', 'true');
			}
		});

		adminSidebar.addEventListener('mouseleave', () => {
			wrapper.classList.remove('sidebar-expanded');
			localStorage.setItem('admin.sidebarExpanded', 'false');
		});

		// restore expanded state
		if (localStorage.getItem('admin.sidebarExpanded') === 'true') {
			wrapper.classList.add('sidebar-expanded');
		}
	}

	if (compactToggle && wrapper) {
		compactToggle.addEventListener('click', () => {
			wrapper.classList.toggle('sidebar-collapsed');
			// remove expanded when collapsed
			if (wrapper.classList.contains('sidebar-collapsed')) wrapper.classList.remove('sidebar-expanded');
			localStorage.setItem('admin.sidebarCollapsed', wrapper.classList.contains('sidebar-collapsed'));
		});
	}


	// submenu accordion behavior
	const railItems = document.querySelectorAll('.rail-item.has-children');
	railItems.forEach(item => {
		item.addEventListener('click', (e) => {
			e.preventDefault();
			e.stopPropagation();
			const isOpen = item.classList.contains('open');
			// close others
			document.querySelectorAll('.rail-item.has-children.open').forEach(i => {
				if (i !== item) i.classList.remove('open');
			});
			if (isOpen) {
				item.classList.remove('open');
			} else {
				item.classList.add('open');
			}
		});
	});

});

$(document).ready(function() {
    $('.vendor-fields').hide();
    $('#type').on('change', function() {
        let type = $(this).val();
        if(type === 'vendor') {
            $('.vendor-fields').show();
            $('.vendor-fields input').prop('required', true);
        } else {
            $('.vendor-fields').hide();
            $('.vendor-fields input').prop('required', false);
        }
    });
});

