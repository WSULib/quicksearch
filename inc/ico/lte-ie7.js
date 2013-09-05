/* Load this script using conditional IE comments if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'bento\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-globe' : '&#x73;&#x69;&#x74;&#x65;',
			'icon-article' : '&#x61;&#x72;&#x74;&#x69;&#x63;&#x6c;&#x65;',
			'icon-server' : '&#x64;&#x61;&#x74;&#x61;&#x62;&#x61;&#x73;&#x65;',
			'icon-book' : '&#x62;&#x6f;&#x6f;&#x6b;',
			'icon-notebook' : '&#x6a;&#x6f;&#x75;&#x72;&#x6e;&#x61;&#x6c;',
			'icon-graduation' : '&#x63;&#x6f;&#x6d;&#x6d;&#x6f;&#x6e;',
			'icon-map' : '&#x67;&#x75;&#x69;&#x64;&#x65;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, html, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		attr = el.getAttribute('data-icon');
		if (attr) {
			addIcon(el, attr);
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
};