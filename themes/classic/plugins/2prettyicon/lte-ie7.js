/* Load this script using conditional IE comments if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'icomoon\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-pretty' : '&#xe003;',
			'icon-star' : '&#xe004;',
			'icon-stats' : '&#xe006;',
			'icon-truck' : '&#xe007;',
			'icon-airplane' : '&#xe008;',
			'icon-thumbs-up' : '&#xe009;',
			'icon-thumbs-up-2' : '&#xe00a;',
			'icon-earth' : '&#xe00b;',
			'icon-flag' : '&#xe00c;',
			'icon-globe' : '&#xe00d;',
			'icon-star-2' : '&#xe002;',
			'icon-chat253' : '&#xe000;',
			'icon-people' : '&#xe00e;',
			'icon-star-3' : '&#xe00f;',
			'icon-quote' : '&#xe010;',
			'icon-quote-2' : '&#xe011;',
			'icon-tag' : '&#xe012;',
			'icon-tag-2' : '&#xe013;',
			'icon-cabinet' : '&#xe014;',
			'icon-cabinet-2' : '&#xe015;',
			'icon-file' : '&#xe016;',
			'icon-file-2' : '&#xe017;',
			'icon-file-3' : '&#xe018;',
			'icon-phone' : '&#xe019;',
			'icon-files' : '&#xe01a;',
			'icon-tablet' : '&#xe01b;',
			'icon-window' : '&#xe01c;',
			'icon-monitor' : '&#xe01d;',
			'icon-ipod' : '&#xe01e;',
			'icon-tv' : '&#xe01f;',
			'icon-camera' : '&#xe020;',
			'icon-camera-2' : '&#xe021;',
			'icon-camera-3' : '&#xe022;',
			'icon-film' : '&#xe023;',
			'icon-film-2' : '&#xe024;',
			'icon-film-3' : '&#xe025;',
			'icon-microphone' : '&#xe026;',
			'icon-microphone-2' : '&#xe027;',
			'icon-microphone-3' : '&#xe029;',
			'icon-drink' : '&#xe028;',
			'icon-drink-2' : '&#xe02a;',
			'icon-inbox' : '&#xe02b;',
			'icon-download' : '&#xe02c;',
			'icon-upload' : '&#xe02d;',
			'icon-inbox-2' : '&#xe02e;',
			'icon-checkmark' : '&#xe02f;',
			'icon-checkmark-2' : '&#xe030;',
			'icon-cancel' : '&#xe031;',
			'icon-plus' : '&#xe032;',
			'icon-cancel-2' : '&#xe033;',
			'icon-plus-2' : '&#xe034;',
			'icon-minus' : '&#xe035;',
			'icon-minus-2' : '&#xe036;',
			'icon-notice' : '&#xe037;',
			'icon-notice-2' : '&#xe038;',
			'icon-cog' : '&#xe039;',
			'icon-cog-2' : '&#xe03a;',
			'icon-cogs' : '&#xe03b;',
			'icon-warning' : '&#xe03c;',
			'icon-picture' : '&#xe03d;',
			'icon-pictures' : '&#xe03e;',
			'icon-pictures-2' : '&#xe03f;',
			'icon-chronometer' : '&#xe040;',
			'icon-time' : '&#xe041;',
			'icon-headphones' : '&#xe042;',
			'icon-checkmark-3' : '&#xe043;',
			'icon-cancel-3' : '&#xe044;',
			'icon-position' : '&#xe045;',
			'icon-site-map' : '&#xe046;',
			'icon-site-map-2' : '&#xe047;',
			'icon-cloud' : '&#xe048;',
			'icon-upload-2' : '&#xe049;',
			'icon-chart' : '&#xe04a;',
			'icon-chart-2' : '&#xe04b;',
			'icon-location' : '&#xe04c;',
			'icon-download-2' : '&#xe04d;',
			'icon-basket' : '&#xe04e;',
			'icon-map' : '&#xe04f;',
			'icon-phone-2' : '&#xe050;',
			'icon-image' : '&#xe051;',
			'icon-medal' : '&#xe052;',
			'icon-key' : '&#xe053;',
			'icon-locked' : '&#xe054;',
			'icon-unlocked' : '&#xe055;',
			'icon-locked-2' : '&#xe056;',
			'icon-unlocked-2' : '&#xe057;',
			'icon-magnifier' : '&#xe058;',
			'icon-stack' : '&#xe059;',
			'icon-stack-2' : '&#xe05a;',
			'icon-stack-3' : '&#xe05b;',
			'icon-archive' : '&#xe05c;',
			'icon-megaphone' : '&#xe05d;',
			'icon-cube' : '&#xe05e;',
			'icon-box' : '&#xe05f;',
			'icon-box-2' : '&#xe060;',
			'icon-grid' : '&#xe061;',
			'icon-grid-2' : '&#xe062;',
			'icon-list' : '&#xe063;',
			'icon-list-2' : '&#xe064;',
			'icon-layout' : '&#xe065;',
			'icon-layout-2' : '&#xe066;',
			'icon-layout-3' : '&#xe067;',
			'icon-layout-4' : '&#xe068;',
			'icon-layout-5' : '&#xe069;',
			'icon-tools' : '&#xe06a;',
			'icon-layout-6' : '&#xe06b;',
			'icon-screwdriver' : '&#xe06c;',
			'icon-paint' : '&#xe06d;',
			'icon-brush' : '&#xe06e;',
			'icon-comments' : '&#xe06f;',
			'icon-chat' : '&#xe070;',
			'icon-equalizer' : '&#xe071;',
			'icon-resize' : '&#xe072;',
			'icon-resize-2' : '&#xe073;',
			'icon-resize-3' : '&#xe074;',
			'icon-download-3' : '&#xe075;',
			'icon-calculator' : '&#xe076;',
			'icon-library' : '&#xe077;',
			'icon-stats-2' : '&#xe078;',
			'icon-stats-3' : '&#xe079;',
			'icon-address-book' : '&#xe07a;',
			'icon-address-book-2' : '&#xe07b;',
			'icon-envelope' : '&#xe07c;',
			'icon-envelope-2' : '&#xe07d;',
			'icon-music' : '&#xe07e;',
			'icon-male' : '&#xe07f;',
			'icon-female' : '&#xe080;',
			'icon-heart' : '&#xe081;',
			'icon-info' : '&#xe082;',
			'icon-info-2' : '&#xe083;',
			'icon-cloudy' : '&#xe084;',
			'icon-paper-plane' : '&#xe085;',
			'icon-expand' : '&#xe086;',
			'icon-collapse' : '&#xe087;',
			'icon-pop-out' : '&#xe088;',
			'icon-pop-in' : '&#xe089;',
			'icon-pictures-3' : '&#xe08a;',
			'icon-zip' : '&#xe08b;',
			'icon-zip-2' : '&#xe08c;',
			'icon-locked-heart' : '&#xe08d;',
			'icon-heart-2' : '&#xe08e;',
			'icon-heart-3' : '&#xe08f;',
			'icon-switch' : '&#xe090;',
			'icon-tags' : '&#xe091;',
			'icon-cart' : '&#xe001;',
			'icon-bubbles' : '&#xe005;',
			'icon-bubbles-2' : '&#xe092;',
			'icon-spinner' : '&#xe093;',
			'icon-heart-4' : '&#xe094;',
			'icon-happy' : '&#xe095;',
			'icon-happy-2' : '&#xe096;',
			'icon-smiley' : '&#xe097;',
			'icon-smiley-2' : '&#xe098;',
			'icon-tongue' : '&#xe099;',
			'icon-tongue-2' : '&#xe09a;',
			'icon-sad' : '&#xe09b;',
			'icon-sad-2' : '&#xe09c;',
			'icon-wink' : '&#xe09d;',
			'icon-wink-2' : '&#xe09e;',
			'icon-grin' : '&#xe09f;',
			'icon-grin-2' : '&#xe0a0;',
			'icon-cool' : '&#xe0a1;',
			'icon-cool-2' : '&#xe0a2;',
			'icon-angry' : '&#xe0a3;',
			'icon-evil' : '&#xe0a4;',
			'icon-shocked' : '&#xe0a5;',
			'icon-confused' : '&#xe0a6;',
			'icon-confused-2' : '&#xe0a7;',
			'icon-neutral' : '&#xe0a8;',
			'icon-neutral-2' : '&#xe0a9;',
			'icon-wondering' : '&#xe0aa;',
			'icon-wondering-2' : '&#xe0ab;',
			'icon-paragraph-left' : '&#xe0ac;',
			'icon-paragraph-right' : '&#xe0ad;',
			'icon-paragraph-center' : '&#xe0ae;',
			'icon-paragraph-left-2' : '&#xe0af;',
			'icon-paragraph-center-2' : '&#xe0b0;',
			'icon-paragraph-justify' : '&#xe0b1;',
			'icon-paragraph-right-2' : '&#xe0b2;',
			'icon-paragraph-justify-2' : '&#xe0b3;',
			'icon-indent-decrease' : '&#xe0b4;',
			'icon-location-2' : '&#xe0b5;',
			'icon-heart-5' : '&#xe0b6;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, c, el;
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