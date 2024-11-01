/*! For license information please see blocks-2a3223cc.js.LICENSE.txt */
(window.wpackiowpqEformeditorJsonp=window.wpackiowpqEformeditorJsonp||[]).push([[2],{0:function(e,t){e.exports=window.React},1:function(e,t,o){"use strict";o.d(t,"b",(function(){return i})),o.d(t,"c",(function(){return c})),o.d(t,"i",(function(){return l})),o.d(t,"g",(function(){return s})),o.d(t,"d",(function(){return d})),o.d(t,"a",(function(){return m})),o.d(t,"f",(function(){return h})),o.d(t,"h",(function(){return b})),o.d(t,"e",(function(){return u}));var r=o(3),n=o(23),a=o.n(n);o(65),o(10),o(0);function i(e,t,o){const r={};return t&&Object.keys(t).forEach((o=>{r[`${e}--${o}`]=!!t[o]})),a()(e,o,r)}function c(e,t,o){return a()(`${e}__${t}`,o)}function l(e,t,o={},n){const a=Object(r.f)().breakpoints;return i(t,{...o,"size-mobile":!0,"size-tablet":e.width>=a.tablet,"size-desktop":e.width>=a.desktop,"size-desktopHd":e.width>=a.desktopHd},n)}function s(e,t="px"){return`${e}${t}`}function d(e,t,o){const r=[...e];return o&&r.push(...o),`${function(e,t){return e.map((e=>`${e} ${t}`)).join(", ")}(e,t)}; will-change: ${r.join(", ")};`}const m=r.c`
	box-sizing: border-box;
	*,
	*::before,
	*::after {
		box-sizing: border-box;
	}
	margin: 0;
	padding: 0;
	border: 0;
	outline: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
	background: transparent;
	line-height: 1.5;
	text-transform: none;
	background-color: transparent;

	&:focus {
		outline: 0;
	}
`,h=r.c`
	appearance: none;
	box-sizing: content-box;
`,b=(r.c`
	overflow: auto;
	vertical-align: top;
	resize: vertical;
`,r.c`
	p,
	ul,
	ol,
	blockquote,
	li,
	strong,
	em,
	u,
	div.para {
		line-height: 1.5;
		font-size: inherit;
	}

	ul {
		list-style: disc;
	}
	ol {
		list-style: decimal;
	}

	blockquote {
		margin: 0 0 0.75em 0.75em;
		padding: 0.625em;
		border-left: 4px solid ${e=>e.theme.borderColorSplit};
		font-style: italic;
	}

	/* Copy & Lists */
	p,
	div.para {
		margin: 0.75em 0 0 0;
		&:only-child {
			margin: 0;
		}
		&:first-child {
			margin-top: 0;
		}
	}
	ul,
	ol {
		margin: 0.75em 0 0.75em 2.5em;
		padding: 0;
	}

	div.para > div.para:last-child {
		margin: 0;
	}

	ul ul,
	ol ul,
	ul ol,
	ol ol {
		margin-top: 0;
		margin-bottom: 0;
	}
	blockquote {
		margin: 0.75em 0;
	}
	/* Headings */
	h1,
	h2,
	h3,
	h4,
	h5,
	h6 {
		margin: 0.6em 0 0 0;
		line-height: 1.2;
		clear: both;
	}
	h1 {
		font-size: ${e=>s(e.theme.fz.large5/e.theme.fz.base,"em")};
		line-height: 1.2;
	}
	h2 {
		font-size: ${e=>s(e.theme.fz.large3/e.theme.fz.base,"em")};
	}
	h3 {
		font-size: ${e=>s(e.theme.fz.large2/e.theme.fz.base,"em")};
	}
	h4 {
		font-size: ${e=>s(e.theme.fz.large1/e.theme.fz.base,"em")};
	}
	h5 {
		font-size: ${e=>s(e.theme.fz.small1/e.theme.fz.base,"em")};
	}
	h6 {
		font-size: ${e=>s(e.theme.fz.small2/e.theme.fz.base,"em")};
	}
	/* Tables */
	table {
		margin-top: ${e=>s(e.theme.gutter)};
		border-spacing: 0px;
		border-collapse: collapse;
		clear: both;
	}
	table td,
	table th {
		padding: 0;
		line-height: 1.5;
	}
	/* Code blocks */
	code {
		vertical-align: bottom;
		color: ${e=>e.theme.textColorSecondary};
	}
	pre {
		max-height: 300px;
		width: 100%;
		overflow: auto;
		margin: 0.75em 0 0 0;
		color: ${e=>e.theme.greyBgText};
		background-color: ${e=>e.theme.greyDarkColor};
		padding: 0.3125em;
		tab-size: 2;
		a {
			color: ${e=>e.theme.primaryBackgroundColor};
			&:hover {
				color: ${e=>e.theme.primaryLightColor};
			}
		}
	}
	pre,
	pre code {
		color: ${e=>e.theme.greyBgText};
		background-color: ${e=>e.theme.greyDarkColor};
		font-family: ${e=>e.theme.fontFamilyMono};
	}

	p,
	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	blockquote,
	table,
	pre {
		&:first-child {
			margin-top: 0;
		}
	}

	strong {
		font-weight: bold;
	}
	u {
		text-decoration: underline;
	}
	em {
		font-style: italic;
	}

	a {
		color: ${e=>e.theme.linkColor};
		text-decoration: underline;
		&:hover {
			color: ${e=>e.theme.primaryLightColor};
			text-decoration: none;
		}
	}
`);r.c`
	overflow-wrap: break-word;
	word-wrap: break-word;
	word-break: break-word;
	hyphens: auto;
`,r.c`
	max-width: ${e=>{var t;return null!==(t=e.maxWidth)&&void 0!==t?t:"100%"}};
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
`,r.c`
	white-space: pre-wrap;
	overflow-wrap: break-word;
`;function u(e){let t=Math.ceil(e);return t%2!=0&&(t+=1),t}const g=r.c`
	&::-webkit-scrollbar-thumb {
		background-color: ${e=>e.theme.borderColorSplit};
		&:hover,
		&:active {
			background-color: ${e=>e.theme.borderColorBase};
		}
	}
`,p=r.c`
	overflow-x: scroll;
	&::-webkit-scrollbar {
		background-color: ${e=>e.theme.backgroundHover};
		height: ${e=>s(e.theme.gutter/2)};
	}
`,f=(r.c`
	${p}
	${g};
`,r.c`
	overflow-y: scroll;
	&::-webkit-scrollbar {
		background-color: ${e=>e.theme.backgroundHover};
		width: ${e=>s(e.theme.gutter/2)};
	}
`);r.c`
	${f};
	${g};
`,r.c`
	overflow: scroll;
	&::-webkit-scrollbar {
		background-color: ${e=>e.theme.backgroundHover};
		&:horizontal {
			height: ${e=>s(e.theme.gutter/2)};
		}
		&:vertical {
			width: ${e=>s(e.theme.gutter/2)};
		}
	}
	&::-webkit-scrollbar-corner {
		background-color: ${e=>e.theme.backgroundHover};
	}
	${g};
`,r.c`
	border: 0;
	clip: rect(1px, 1px, 1px, 1px);
	clip-path: inset(50%);
	height: 1px;
	margin: -1px;
	overflow: hidden;
	padding: 0;
	position: absolute;
	width: 1px;
	word-wrap: normal !important;
`,r.c`
	text-align: left;
	background: transparent;
	border: 0 none;
	outline: none;
	margin: 0;
	padding: 0;
	cursor: pointer;
	display: inline;
	font-style: normal;
	text-decoration: none;
	border-radius: 0;
`},11:function(e,t,o){"use strict";let r,n,a,i,c,l,s,d,m,h,b,u,g,p,f,E,O,$,w,x,j,C,y,v,k,B,T,F,S,A,R,N,H,L,I,_,z,D,P,M;o.d(t,"a",(function(){return $})),o.d(t,"b",(function(){return j})),o.d(t,"c",(function(){return A})),o.d(t,"d",(function(){return R})),o.d(t,"e",(function(){return N})),o.d(t,"f",(function(){return L})),function(e){e.AFTER="AFTER",e.BEFORE="BEFORE"}(r||(r={})),function(e){e.BLANK="BLANK",e.POPUP="POPUP",e.SELF="SELF"}(n||(n={})),function(e){e.HIDE_FIELDS="HIDE_FIELDS",e.HIDE_PAGES="HIDE_PAGES",e.SET_VALUE_OF="SET_VALUE_OF",e.SHOW_FIELDS="SHOW_FIELDS",e.SHOW_PAGES="SHOW_PAGES"}(a||(a={})),function(e){e.ALWAYS="ALWAYS",e.AUTO="AUTO",e.OFF="OFF"}(i||(i={})),function(e){e.CONTAINS="CONTAINS",e.ENDS_WITH="ENDS_WITH",e.EQUALS_TO="EQUALS_TO",e.GREATER_THAN="GREATER_THAN",e.LESS_THAN="LESS_THAN",e.STARTS_WITH="STARTS_WITH"}(c||(c={})),function(e){e.LENGTH="LENGTH",e.VALUE="VALUE"}(l||(l={})),function(e){e.IS="IS",e.ISNOT="ISNOT"}(s||(s={})),function(e){e.AND="AND",e.OR="OR"}(d||(d={})),function(e){e.CHOICE="CHOICE",e.DESIGN="DESIGN",e.INPUT="INPUT",e.SECURITY="SECURITY"}(m||(m={})),function(e){e.NEXT_ON_ALL_VALID="NEXT_ON_ALL_VALID",e.NONE="NONE",e.ONLY_WHEN_ALL_VALID="ONLY_WHEN_ALL_VALID"}(h||(h={})),function(e){e.ONETIME="ONETIME",e.SUBSCRIPTION="SUBSCRIPTION"}(b||(b={})),function(e){e.PERCENTAGE="PERCENTAGE",e.VALUE="VALUE"}(u||(u={})),function(e){e.FIXED="FIXED",e.LOCAL="LOCAL",e.SCROLL="SCROLL"}(g||(g={})),function(e){e.BORDER_BOX="BORDER_BOX",e.CONTENT_BOX="CONTENT_BOX",e.PADDING_BOX="PADDING_BOX"}(p||(p={})),function(e){e.REPEAT_BOTH="REPEAT_BOTH",e.REPEAT_NONE="REPEAT_NONE",e.REPEAT_X="REPEAT_X",e.REPEAT_Y="REPEAT_Y"}(f||(f={})),function(e){e.LOGGED_IN="LOGGED_IN",e.LOGGED_OUT="LOGGED_OUT",e.NONE="NONE"}(E||(E={})),function(e){e.CENTER="CENTER",e.JUSTIFY="JUSTIFY",e.LEFT="LEFT",e.RIGHT="RIGHT"}(O||(O={})),function(e){e.DEFAULT="DEFAULT",e.LARGE="LARGE",e.SMALL="SMALL"}($||($={})),function(e){e.SIZE1="SIZE1",e.SIZE2="SIZE2",e.SIZE3="SIZE3",e.SIZE4="SIZE4",e.SIZE5="SIZE5",e.SIZE6="SIZE6"}(w||(w={})),function(e){e.H1="H1",e.H2="H2",e.H3="H3",e.H4="H4",e.H5="H5",e.H6="H6",e.P="P"}(x||(x={})),function(e){e.NONE="NONE",e.PRESET="PRESET",e.REGEXP="REGEXP",e.STRING="STRING"}(j||(j={})),function(e){e.EQUALS_TO="EQUALS_TO",e.GREATER_THAN="GREATER_THAN",e.LESS_THAN="LESS_THAN"}(C||(C={})),function(e){e.AUTO="AUTO",e.FOUR="FOUR",e.ONE="ONE",e.THREE="THREE",e.TWO="TWO"}(y||(y={})),function(e){e.CURSOR="CURSOR",e.OFFSET="OFFSET"}(v||(v={})),function(e){e.META="META",e.NONE="NONE",e.URL="URL"}(k||(k={})),function(e){e.CONDITIONAL="CONDITIONAL",e.FLAT="FLAT",e.NONE="NONE",e.PORTAL="PORTAL",e.SCOREPERCENTAGE="SCOREPERCENTAGE",e.SCORETOTAL="SCORETOTAL",e.SUBMISSION="SUBMISSION"}(B||(B={})),function(e){e.ALL="ALL",e.OWNED="OWNED",e.SHARED="SHARED",e.TRASHED="TRASHED"}(T||(T={})),function(e){e.PERCENTAGE="PERCENTAGE",e.VALUE="VALUE"}(F||(F={})),function(e){e.ADD="ADD",e.SUBTRACT="SUBTRACT"}(S||(S={})),function(e){e.MULTIPLE="MULTIPLE",e.SINGLE="SINGLE"}(A||(A={})),function(e){e.FIXED="FIXED",e.FLUID="FLUID"}(R||(R={})),function(e){e.CENTER="CENTER",e.LEFT="LEFT",e.RIGHT="RIGHT"}(N||(N={})),function(e){e.HORIZONTAL="HORIZONTAL",e.INLINE="INLINE",e.VERTICAL="VERTICAL"}(H||(H={})),function(e){e.BOXY="BOXY",e.MATERIAL="MATERIAL"}(L||(L={})),function(e){e.BOTTOM="BOTTOM",e.TOP="TOP"}(I||(I={})),function(e){e.DAY="DAY",e.MONTH="MONTH",e.WEEK="WEEK"}(_||(_={})),function(e){e.NONE="NONE",e.OVERALL="OVERALL",e.PAGE_SPECIFIC="PAGE_SPECIFIC"}(z||(z={})),function(e){e.NOT_TRASHED="NOT_TRASHED",e.TRASHED="TRASHED"}(D||(D={})),function(e){e.ALL="ALL",e.EMAIL="EMAIL",e.INTEGER="INTEGER",e.NOLETTER="NOLETTER",e.NONUMBER="NONUMBER",e.NUMBER="NUMBER",e.PHONE="PHONE",e.URL="URL"}(P||(P={})),function(e){e.FULL="FULL",e.HALF="HALF",e.MANUAL="MANUAL",e.ONEFOURTH="ONEFOURTH",e.ONETHIRD="ONETHIRD",e.THREEFOURTH="THREEFOURTH",e.TWOTHIRD="TWOTHIRD"}(M||(M={}))},121:function(e,t,o){o(102),e.exports=o(139)},139:function(e,t,o){"use strict";o.r(t);var r=o(0),n=o.n(r),a=o(87),i=o(7),c=o(88);function l(e){return r.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),r.createElement("path",{d:"M392 275.879H120c-22.055 0-40-17.945-40-40V196c0-22.055 17.945-40 40-40h272c22.055 0 40 17.945 40 40v39.879c0 22.055-17.945 40-40 40zM120 196h-.023l.023 39.879h272V196H120zm312-97c0-11.047-8.953-20-20-20H100c-11.047 0-20 8.953-20 20s8.953 20 20 20h312c11.047 0 20-8.953 20-20zm0 274c0-11.047-8.953-20-20-20H260c-11.047 0-20 8.953-20 20s8.953 20 20 20h152c11.047 0 20-8.953 20-20zm-272 59.758h-40c-22.055 0-40-17.945-40-40v-39.88c0-22.058 17.945-40 40-40h40c22.055 0 40 17.942 40 40v39.88c0 22.055-17.945 40-40 40zm-40-79.88h-.023l.023 39.88h40v-39.88h-40zM512 432c0-11.047-8.953-20-20-20s-20 8.953-20 20c0 22.055-17.945 40-40 40H80c-22.055 0-40-17.945-40-40V80c0-22.055 17.945-40 40-40h352c22.055 0 40 17.945 40 40v252c0 11.047 8.953 20 20 20s20-8.953 20-20V80c0-44.113-35.887-80-80-80H80C35.887 0 0 35.887 0 80v352c0 44.113 35.887 80 80 80h352c44.113 0 80-35.887 80-80z"}))}o.p;function s(e){return r.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),r.createElement("path",{d:"M173 492c0 11.047-8.953 20-20 20h-46c-44.113 0-80-35.887-80-80V80c0-44.113 35.887-80 80-80h245.89c44.11 0 80 35.887 80 80v119c0 11.047-8.956 20-20 20-11.046 0-20-8.953-20-20V80c0-22.055-17.945-40-40-40H107c-22.055 0-40 17.945-40 40v352c0 22.055 17.945 40 40 40h46c11.047 0 20 8.953 20 20zm179.887-352c0-11.047-8.953-20-20-20h-206c-11.043 0-20 8.953-20 20s8.957 20 20 20h206c11.047 0 20-8.953 20-20zM273 220c0-11.047-8.953-20-20-20H126.887c-11.043 0-20 8.953-20 20s8.957 20 20 20H253c11.047 0 20-8.953 20-20zm-146.113 60c-11.043 0-20 8.953-20 20s8.957 20 20 20H210c11.047 0 20-8.953 20-20s-8.953-20-20-20h-83.113zm348.922 217.121C468.113 506.578 456.758 512 444.652 512H249.348c-12.172 0-23.563-5.418-31.25-14.863-7.735-9.504-10.739-21.852-8.243-33.875 6.461-31.125 23.575-59.446 48.184-79.746a139.51 139.51 0 0130.422-19.086C276.359 350.684 269 332.672 269 312.965c0-43.012 34.988-78 78-78s78 34.988 78 78c0 19.707-7.36 37.719-19.46 51.465 10.858 5 21.1 11.394 30.42 19.086 24.118 19.894 41.032 47.492 47.782 77.879.156.527.29 1.058.403 1.601 2.507 12.094-.532 24.531-8.336 34.125zM309 312.965c0 20.953 17.047 38 38 38s38-17.047 38-38-17.047-38-38-38-38 17.047-38 38zm135.988 158.469a.139.139 0 01-.008-.04c-9.605-46.253-50.812-79.828-97.98-79.828-47.168 0-88.379 33.575-97.98 79.829-.09.449.218.593.218.597.008 0 .043.008.11.008h195.304c.012-.012.282-.215.336-.566z"}))}o.p;function d(e){return r.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),r.createElement("path",{d:"M492 241c11.047 0 20-8.953 20-20v-61c0-44.113-35.887-80-80-80H160c-44.113 0-80 35.887-80 80v272c0 44.113 35.887 80 80 80h201.516c5.32 0 10.421-2.121 14.175-5.89l130.485-131.114A19.993 19.993 0 00512 360.891V321c0-11.047-8.953-20-20-20s-20 8.953-20 20v19.89h-60.11c-38.6 0-70 31.4-70 70V472H160c-22.055 0-40-17.945-40-40V160c0-22.055 17.945-40 40-40h272c22.055 0 40 17.945 40 40v61c0 11.047 8.953 20 20 20zm-80.11 139.89h31.989l-61.988 62.286V410.89c0-16.543 13.457-30 30-30zM80 40c-22.055 0-40 17.945-40 40v313c0 11.047-8.953 20-20 20s-20-8.953-20-20V80C0 35.887 35.887 0 80 0h312c11.047 0 20 8.953 20 20s-8.953 20-20 20H80zm331 160c0 11.047-8.953 20-20 20H200c-11.047 0-20-8.953-20-20s8.953-20 20-20h191c11.047 0 20 8.953 20 20zm-20 100H200c-11.047 0-20-8.953-20-20s8.953-20 20-20h191c11.047 0 20 8.953 20 20s-8.953 20-20 20zm-110 40c11.047 0 20 8.953 20 20s-8.953 20-20 20h-81c-11.047 0-20-8.953-20-20s8.953-20 20-20h81z"}))}o.p;var m=o(17),h=o(89),b=o(68),u=o(69),g=o(150),p=o(70),f=o(30),E=o(32),O=o(73);function $(e){var t;const o=e.attributes,r=e.setAttributes;return n.a.createElement(f.a,{heading:Object(i.__)("Embed Form","wp-eform")},n.a.createElement(O.a,{value:null!==(t=o.formId)&&void 0!==t?t:"",onChange:e=>{r({formId:e})}}))}function w(e){const t=e.blockConfig,o=e.blockProps;return n.a.createElement(g.a,{client:p.a},n.a.createElement("div",o,n.a.createElement(E.a,null,n.a.createElement($,t))))}Object(a.registerBlockType)("wp-eform/form",{apiVersion:2,title:Object(i.__)("WPEForm - Insert Form","wp-eform"),icon:n.a.createElement(m.b,null,n.a.createElement(l,null)),category:"widgets",attributes:h.form.attributes,edit:e=>{const t=Object(c.useBlockProps)();return n.a.createElement(w,{blockConfig:e,blockProps:t})},save:()=>null}),Object(a.registerBlockType)("wp-eform/user-portal",{apiVersion:2,title:Object(i.__)("WPEForm - User Portal Page","wp-eform"),icon:n.a.createElement(m.b,null,n.a.createElement(s,null)),category:"widgets",attributes:h.userPortal.attributes,edit:e=>{const t=Object(c.useBlockProps)();return n.a.createElement(u.a,{blockConfig:e,blockProps:t})},save:()=>null}),Object(a.registerBlockType)("wp-eform/summary",{apiVersion:2,title:Object(i.__)("WPEForm - Summary Page","wp-eform"),icon:n.a.createElement(m.b,null,n.a.createElement(d,null)),category:"widgets",attributes:h.summary.attributes,edit:e=>{const t=Object(c.useBlockProps)();return n.a.createElement(b.a,{blockConfig:e,blockProps:t})},save:()=>null})},17:function(e,t,o){"use strict";o.d(t,"a",(function(){return d})),o.d(t,"b",(function(){return h}));var r=o(0),n=o.n(r),a=o(3),i=o(23),c=o.n(i),l=o(49),s=o(82);const d="wpeform-icon",m=a.d.span`
	color: inherit;
	font-size: 1em;
	height: 1em;
	width: 1em;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	font-weight: normal;
	font-style: normal;

	svg:not(.svg-inline--fa) {
		height: 1em;
		width: 1em;
		fill: currentColor;
		display: block;
	}
	${l.a.css()}
`;function h(e){const t=e.iconClass,o=e.children,a=void 0===o?null:o,i=e.component,l=e.className,h=e.title;let b=!1;const u=[];let g="";if(null!=t&&t.startsWith("fas ")||null!=t&&t.startsWith("fab ")||null!=t&&t.startsWith("far ")){const e=t.split(" ");e.length>=2&&e[1]&&(u.push(e[0]),u.push(e[1].replace("fa-","")),b=!0,e.length>2&&(g=e.slice(2).join(" ")))}return n.a.createElement(m,{role:"img","aria-hidden":!e["aria-label"]||void 0,"aria-label":e["aria-label"],className:c()(d,b?g:t,{"is-fallback-antd":!!i,anticon:!!i},l),title:h},i?Object(r.createElement)(i,{}):b?n.a.createElement(s.a,{icon:u}):a)}},29:function(e,t,o){"use strict";o.d(t,"a",(function(){return u}));var r=o(0),n=o.n(r),a=o(3),i=o(33),c=o(1),l=o(31);const s="wpeform-blockcomponent-label",d=Object(c.c)(s,"label"),m=Object(c.c)(s,"body"),h=a.d.div`
	padding: ${e=>Object(c.g)(e.theme.gutter)};
	border-bottom: 1px solid ${e=>e.theme.borderColorSplit};

	&:last-child {
		border-bottom: 0 none;
	}

	> .${m} > .${l.a} {
		padding: 0;
	}
`,b=a.d.label`
	display: block;
	margin: 0 0 ${e=>Object(c.g)(e.theme.gutter/2)} 0;
	padding: 0;
	color: ${e=>e.theme.headingColor};
	font-size: ${e=>Object(c.g)(e.theme.fz.small1)};
	line-height: 1;
	font-weight: 600;
	text-transform: uppercase;
`;function u(e){const t=e.label,o=e.children,r=Object(i.c)();return n.a.createElement(h,{className:s},t?n.a.createElement(b,{htmlFor:r,className:d},t):null,n.a.createElement("div",{className:m},"function"==typeof o?o(r):o))}},30:function(e,t,o){"use strict";o.d(t,"a",(function(){return $}));var r=o(7),n=o(0),a=o.n(n),i=o(1),c=o(3),l=o(10);const s="wpeform-blockcomponent-panel",d=Object(i.c)(s,"heading"),m=Object(i.c)(s,"title"),h=Object(i.c)(s,"titlecontent"),b=Object(i.c)(s,"titleseparator"),u=Object(i.c)(s,"body"),g=c.d.div`
	background-color: ${e=>e.theme.appBackgroundColor};
	margin: 0;
	padding: 0;
	border-radius: ${e=>Object(i.g)(e.theme.borderRadiusBase)};
`,p=c.d.div`
	background-color: ${e=>e.theme.primaryColor};
	padding: ${e=>Object(i.g)(e.theme.gutter/2)}
		${e=>Object(i.g)(e.theme.gutter)};
	border-top-left-radius: ${e=>Object(i.g)(e.theme.borderRadiusBase)};
	border-top-right-radius: ${e=>Object(i.g)(e.theme.borderRadiusBase)};
`,f=c.d.h3`
	color: ${e=>e.theme.primaryBgText} !important;
	font-size: 18px !important;
	line-height: 1 !important;
	margin: 0 !important;
	padding: 0 !important;
	font-weight: 600 !important;
	letter-spacing: 2px !important;
	text-transform: uppercase;
	display: flex;
	align-items: center;
	justify-content: space-between;
`,E=c.d.span`
	text-transform: none;
	color: ${e=>Object(l.b)(.5,e.theme.primaryColor)};
	font-size: 12px;
`,O=c.d.div`
	border: 1px solid ${e=>e.theme.borderColorSplit};
	border-top: 0 none;
	border-bottom-left-radius: ${e=>Object(i.g)(e.theme.borderRadiusBase)};
	border-bottom-right-radius: ${e=>Object(i.g)(e.theme.borderRadiusBase)};
`;function $(e){return a.a.createElement(g,{className:s},a.a.createElement(p,{className:d},a.a.createElement(f,{className:m},a.a.createElement("span",{className:h},e.heading),a.a.createElement(E,{className:b},Object(r.__)("WPEForm","wp-eform")))),a.a.createElement(O,{className:u},e.children))}},31:function(e,t,o){"use strict";o.d(t,"a",(function(){return c})),o.d(t,"b",(function(){return s}));var r=o(0),n=o.n(r),a=o(3),i=o(1);const c="wpeform-blockcomponent-feedback",l=a.d.div`
	padding: ${e=>Object(i.g)(e.theme.gutter)};
	font-size: ${e=>Object(i.g)(e.theme.fz.base)};
	color: ${e=>e.theme.textColor};
	font-family: ${e=>e.theme.fontFamilyBody} !important;

	.muted {
		color: ${e=>e.theme.textColorSecondary};
	}

	${i.h};

	p,
	div.para {
		font-family: ${e=>e.theme.fontFamilyBody} !important;
		margin: 0.75em 0 0 0 !important;
		&:only-child {
			margin: 0 !important;
		}
		&:first-child {
			margin-top: 0 !important;
		}
	}
`;function s(e){const t=e.children;return n.a.createElement(l,{className:c},t)}},32:function(e,t,o){"use strict";o.d(t,"a",(function(){return c}));var r=o(0),n=o.n(r),a=o(3),i=o(62);function c(e){const t=e.children;return n.a.createElement(a.a,{theme:i.a.getItem("wp").config},t)}},33:function(e,t,o){"use strict";o.d(t,"a",(function(){return i})),o.d(t,"c",(function(){return c})),o.d(t,"b",(function(){return l}));var r=o(14),n=o(0),a=o(116);function i(){const e=Object(n.useRef)(!1);return Object(n.useEffect)((()=>(e.current=!0,()=>{e.current=!1})),[]),e}function c(){const e=Object(n.useState)(a.a);return Object(r.a)(e,1)[0]}function l(e){const t=Object(n.useRef)();return Object(n.useEffect)((()=>{t.current=e}),[e]),t.current}},42:function(e,t){e.exports=window.ReactDOM},47:function(e,t,o){"use strict";o.d(t,"a",(function(){return a}));var r=o(43),n=o(116);class a{constructor(e,t=null){Object(r.a)(this,"collections",{}),Object(r.a)(this,"collectionOrder",[]),Object(r.a)(this,"changeCallbacks",[]),Object(r.a)(this,"collector",null),this.name=e,this.collector=t}subscribeToChanges(e){const t=Object(n.a)();return this.changeCallbacks.push({id:t,callback:e}),t}unsubscribeFromChanges(e){this.changeCallbacks=this.changeCallbacks.filter((t=>t.id!==e))}addItem(e,t,o){if(this.collections[e])throw new Error(`Collection ${this.name} with item ${e} already exists.`);this.collections[e]=this.collector?this.collector(t):t,o?function(e,t,o){-1===o?e.push(t):e.splice(o,0,t)}(this.collectionOrder,e,o):this.collectionOrder.push(e)}replaceItem(e,t){if(!this.collections[e])throw new Error(`Collection ${this.name} with item ${e} does not exist.`);this.collections[e]=this.collector?this.collector(t):t,this.changeCallbacks.forEach((t=>{t.callback(e)}))}addWithoutCollector(e,t){if(this.collections[e])throw new Error(`Collection ${this.name} with item ${e} already exists.`);this.collections[e]=t,this.collectionOrder.push(e)}getItem(e){if(!this.collections[e])throw new Error(`Collection ${this.name} does not have item ${e}.`);return this.collections[e]}hasItem(e){return!!this.collections[e]}deleteItem(e){const t=this.collectionOrder.findIndex((t=>t===e));if(-1===t)throw new Error(`Collection ${this.name} does not have item ${e}.`);this.collectionOrder.splice(t,1),delete this.collections[e]}getItems(e=[],t=[],o){return this.collectionOrder.filter((r=>!(o&&!o(this.collections[r],r))&&function(e,t=[],o=[]){return!(t.length&&!t.includes(e)||o.length&&o.includes(e))}(r,e,t))).map((e=>({id:e,item:this.collections[e]})))}resetItems(){this.collectionOrder=[],this.collections={}}}},48:function(e,t,o){"use strict";o.d(t,"b",(function(){return g})),o.d(t,"a",(function(){return x}));var r=o(0),n=o.n(r),a=o(65),i=o.n(a),c=o(3),l=o(1),s=o(11),d=o(42);const m="wpeform-responsive-container",h=Object(r.createContext)({height:0,width:0});const b=Object(r.createContext)({current:null});const u=Object(r.createContext)({current:null});function g(){return Object(r.useContext)(u)}const p=c.c`
	max-width: 100%;
	width: 100%;
	margin: 0 auto;
`,f=c.c`
	@media screen and (min-width: ${e=>Object(l.g)(e.theme.breakpoints.tablet)}) {
		max-width: ${e=>Object(l.g)(e.theme.breakpoints.tablet)};
	}
	@media screen and (min-width: ${e=>Object(l.g)(e.theme.breakpoints.desktop)}) {
		max-width: ${e=>Object(l.g)(e.theme.breakpoints.desktop)};
	}
	@media screen and (min-width: ${e=>Object(l.g)(e.theme.breakpoints.desktopHd)}) {
		max-width: ${e=>Object(l.g)(e.theme.breakpoints.desktopHd)};
	}
`,E=c.d.div`
	${p};
`,O=c.d.div`
	${l.a};
	font-family: ${e=>e.theme.fontFamilyBody};
	margin: 0 auto;
	max-width: ${e=>{var t;return null!==(t=e.width)&&void 0!==t?t:"100%"}};
	width: 100%;
	color: ${e=>e.theme.textColor};
`,$=c.d.div`
	padding: ${e=>e.noVerticalPadding?0:Object(l.g)(e.theme.gutter)}
		${e=>e.noHorizontalPadding?0:Object(l.g)(e.theme.gutter)};
	margin: 0 auto;
	max-width: 1440px;

	&.${m}--layout-FIXED {
		${E} {
			${f};
		}
	}
`,w={height:960,width:480};function x(e){const t=e.children,o=e.width,a=void 0===o?"100%":o,c=e.containerLayout,d=void 0===c?s.d.FIXED:c,g=e.noHorizontalPadding,p=void 0!==g&&g,f=e.noVerticalPadding,w=void 0!==f&&f,x=Object(r.useRef)(null),j=Object(r.useRef)(null),C=i()(j),y=Object(l.i)(C,m,{[`layout-${d}`]:!0});return n.a.createElement($,{noHorizontalPadding:p,noVerticalPadding:w,className:y,ref:x},n.a.createElement(E,null,n.a.createElement(O,{ref:j,width:a},n.a.createElement(u.Provider,{value:x},n.a.createElement(h.Provider,{value:C},n.a.createElement(b.Provider,{value:j},t))))))}x.Ssr=function(e){const t=e.children,o=e.width,a=void 0===o?"100%":o,i=e.containerLayout,c=void 0===i?s.d.FIXED:i,d=e.noHorizontalPadding,u=void 0!==d&&d,g=e.noVerticalPadding,p=void 0!==g&&g,f=Object(r.useRef)(null),x=Object(l.i)(w,m,{[`layout-${c}`]:!0});return n.a.createElement($,{noHorizontalPadding:u,noVerticalPadding:p,className:x},n.a.createElement(E,null,n.a.createElement(O,{ref:f,width:a},n.a.createElement(h.Provider,{value:w},n.a.createElement(b.Provider,{value:f},t)))))},x.Portal=function(e){var t;const o=e.children,r=g();return Object(d.createPortal)(o,null!==(t=r.current)&&void 0!==t?t:document.body)}},59:function(e,t,o){"use strict";o.d(t,"a",(function(){return b}));var r=o(14),n=o(0),a=o.n(n),i=o(3),c=o(10),l=o(19),s=o(1),d=o(33);const m=Object(i.d)(l.animated.span)`
	display: block;
	position: absolute;
	border-radius: 50%;
	will-change: opacity, transform;
	pointer-events: none;
`;function h(e){const t=e.onRest,o=e.width,r=e.height,n=e.left,d=e.top,h=e.darkBg,b=Object(i.f)(),u=Object(l.useSpring)({from:{opacity:.4,transform:"scale(0.4)"},to:{opacity:0,transform:"scale(12)"},onRest:t,config:{tension:280,friction:110,clamp:!0}});return a.a.createElement(m,{style:{width:Object(s.g)(o),height:Object(s.g)(r),left:Object(s.g)(n),top:Object(s.g)(d),backgroundColor:h?Object(c.c)(.5,b.primaryBgText):b.primaryLightColor,...u}})}function b({darkBg:e}={darkBg:!1}){const t=Object(n.useState)([]),o=Object(r.a)(t,2),i=o[0],c=o[1],l=Object(d.a)();return[t=>{const o=t.currentTarget.getBoundingClientRect(),r=o.left,n=o.top,a=t.clientX-r,i=t.clientY-n,s=Math.min(t.currentTarget.clientWidth/4,100),d=Math.min(t.currentTarget.clientHeight/4,100),m=Math.max(s,d),h=t.timeStamp;c((t=>[...t,{key:h,width:m,height:m,left:a-m/2,top:i-m/2,onRest:()=>{l.current&&c((e=>e.filter((e=>e.key!==h))))},darkBg:e}]))},i.map((e=>a.a.createElement(h,e)))]}},60:function(e,t,o){"use strict";function r(e,t,o=0){const r=Number.parseInt(e,10);return!Number.isNaN(r)&&Number.isFinite(r)&&r>o?r:t}function n(e,t=0){let o;return o="string"==typeof e?Number.parseFloat(e):"number"==typeof e?e:t,Number.isFinite(o)||(o=t),o}o.d(t,"b",(function(){return r})),o.d(t,"a",(function(){return n}))},61:function(e,t,o){"use strict";o.d(t,"a",(function(){return Fe}));var r=o(35),n=o(14),a=o(0),i=o.n(a),c=o(23),l=o.n(c),s=o(85),d=o.n(s),m=o(7),h=o(1),b=o(11),u=o(17),g=o(3),p=o(19),f=o(10);const E="wpeform-component-dropdown",O=Object(h.c)(E,"button"),$=Object(h.c)(E,"dd-container"),w=768,x=g.b`
body {
	&.${E}-is-open-mod-body {
		overflow: hidden;
		@media screen and (min-width: ${Object(h.g)(w)}) {
			overflow: unset;
		}
	}
}
`,j=g.d.span`
	color: ${e=>e.theme.greyLightColor};
	flex: 0 0 1em;
	height: ${e=>Object(h.g)(e.theme.controlHeightBase)};
	width: 1em;
	display: flex;
	align-items: center;
	justify-content: center;
`,C=g.d.span`
	padding: 0 ${e=>Object(h.g)(e.theme.controlHeightBase/2)} 0
		${e=>Object(h.g)(e.theme.controlHeightBase/4)};
	width: calc(100% - 2em);
	overflow: hidden;
	white-space: nowrap;
	text-overflow: ellipsis;
	flex: 1 0 auto;
`,y=g.d.div`
	${h.a};
	position: relative;
	&.${E}--align-LEFT {
		${C} {
			text-align: left;
		}
	}
	&.${E}--align-CENTER {
		${C} {
			text-align: center;
		}
	}
	&.${E}--align-RIGHT {
		${C} {
			text-align: right;
		}
	}
`,v=g.d.span`
	line-height: 1;
	height: 1em;
	transform: rotate(0deg);
	transform-origin: center center;
	transition: ${e=>Object(h.d)(["transform","color"],e.theme.transitionControl)};
`,k=g.d.span`
	color: ${e=>e.theme.greyLightColor};
	position: relative;
	flex: 0 0 1em;
	height: ${e=>Object(h.g)(e.theme.controlHeightBase)};
	width: 1em;
	display: flex;
	align-items: center;
	justify-content: center;
	margin: 0 0 0 auto;
	&::before {
		content: '';
		display: block;
		position: absolute;
		width: 1px;
		top: 18%;
		bottom: 18%;
		background-color: ${e=>e.theme.borderColorSplit};
		left: ${e=>Object(h.g)(e.theme.controlHeightBase/-4)};
	}
`,B=g.d.div`
	position: absolute;
	height: 2px;
	bottom: 0;
	left: 0;
	right: 0;
	transform-origin: 50% 50%;
	background-color: ${e=>e.theme.primaryColor};
	pointer-events: none;
	transform: scaleX(0);
	transition: ${e=>Object(h.d)(["transform"],e.theme.transitionBeizer)};
`,T=g.d.button`
	${h.a};
	cursor: pointer;
	text-align: left;
	background-color: ${e=>e.theme.appBackgroundColor};
	appearance: none;
	display: flex;
	align-items: center;
	justify-content: flex-start;
	width: 100%;
	position: relative;
	overflow: hidden;
	height: ${e=>Object(h.g)(e.theme.controlHeightBase)};
	border-radius: ${e=>Object(h.g)(e.theme.borderRadiusBase)};
	font-size: ${e=>Object(h.g)(e.theme.fz.base)};
	box-shadow: 0 0 0 0 transparent;
	color: ${e=>e.theme.textColor};
	padding: 0 ${e=>Object(h.g)(e.theme.controlHeightBase/4)};
	border: 1px solid ${e=>e.theme.borderColorBase};
	box-shadow: ${e=>e.theme.boxShadowNoneFocus};
	transition: ${e=>Object(h.d)(["border-color","box-shadow"],e.theme.transitionControl)};

	&:hover {
		color: ${e=>e.theme.textColor};
		border-color: ${e=>e.theme.primaryColor};
		${k} {
			color: ${e=>e.theme.textColor};
		}
	}

	&:active,
	&:focus {
		color: ${e=>e.theme.textColor};
		border-color: ${e=>e.theme.primaryColor};
		box-shadow: ${e=>e.theme.boxShadowControlFocus};
	}

	&.${O}--is-open {
		border-color: ${e=>e.theme.primaryColor};
		box-shadow: ${e=>e.theme.boxShadowControlFocus};
		${v} {
			transform: rotate(180deg);
		}
	}

	&.${O}--is-empty {
		${C} {
			color: ${e=>e.theme.textColorSecondary};
		}
	}

	&.${O}--has-error {
		border-color: ${e=>e.theme.borderColorError};

		&:hover {
			border-color: ${e=>e.theme.borderColorError};
		}

		&:active,
		&:focus {
			border-color: ${e=>e.theme.borderColorError};
			box-shadow: ${e=>e.theme.boxShadowControlFocusError};
		}

		${j} {
			color: ${e=>e.theme.errorColor};
		}
	}

	&:disabled {
		background-color: ${e=>e.theme.disabledBackgroundColor};
		color: ${e=>e.theme.disabledColor};
		border-color: ${e=>e.theme.disabledColor};
		cursor: not-allowed;
		box-shadow: none;
	}

	/** MATERIAL STYLE */
	&.${O}--type-MATERIAL {
		border: 0 none;
		border-bottom: 2px solid ${e=>e.theme.borderColorBase};
		border-radius: ${e=>Object(h.g)(e.theme.borderRadiusBase)}
			${e=>Object(h.g)(e.theme.borderRadiusBase)} 0 0;
		box-shadow: none;
		background-color: ${e=>e.theme.backgroundControl};
		transition: ${e=>Object(h.d)(["background-color"],e.theme.transitionControl)};

		&:hover {
			border-color: ${e=>e.theme.borderColorBase};
		}

		&:active,
		&:focus {
			background-color: ${e=>Object(f.c)(.5,e.theme.backgroundControl)};
			border-color: ${e=>e.theme.borderColorBase};
			box-shadow: none;
		}

		&:hover
			+ ${B},
			&:active
			+ ${B},
			&:focus
			+ ${B},
			&.${O}--is-open
			+ ${B} {
			transform: scaleX(1);
		}

		&.${O}--has-error {
			border-bottom-color: ${e=>e.theme.borderColorError};

			&:hover {
				border-bottom-color: ${e=>e.theme.borderColorError};
			}

			&:active,
			&:focus {
				border-bottom-color: ${e=>e.theme.borderColorError};
			}

			+ ${B} {
				background-color: ${e=>e.theme.borderColorError};
			}
		}

		&:disabled {
			background-color: ${e=>e.theme.disabledBackgroundColor};
			color: ${e=>e.theme.disabledColor};
			border-color: ${e=>e.theme.disabledColor};
			cursor: not-allowed;
			+ ${B} {
				transform: scaleX(0);
				background-color: ${e=>e.theme.disabledColor};
			}
		}
	}

	/** SIZES */
	&.${O}--size-SMALL {
		height: ${e=>Object(h.g)(.8*e.theme.controlHeightBase)};
		padding: ${e=>Object(h.g)(e.theme.controlHeightBase/8)};
		/* font-size: ${e=>Object(h.g)(e.theme.fz.small1)}; */
		${C} {
			padding: 0 ${e=>Object(h.g)(e.theme.controlHeightBase/3)} 0
				${e=>Object(h.g)(e.theme.controlHeightBase/8)};
		}
		${k} {
			height: ${e=>Object(h.g)(.8*e.theme.controlHeightBase)};
			&::before {
				left: ${e=>Object(h.g)(e.theme.controlHeightBase/-6)};
			}
		}
	}
	&.${O}--size-LARGE {
		height: ${e=>Object(h.g)(1.2*e.theme.controlHeightBase)};
		padding: ${e=>Object(h.g)(e.theme.controlHeightBase/4)};
		${k} {
			height: ${e=>Object(h.g)(1.2*e.theme.controlHeightBase)};
		}
	}
`,F=g.d.div`
	${h.a};
	font-size: ${e=>Object(h.g)(e.theme.fz.base)};
	font-family: ${e=>e.theme.fontFamilyBody};
	position: fixed;
	z-index: 999997;
	min-width: 300px;

	padding: 0;
	perspective: 200px;

	&.${$}--size-SMALL {
		min-width: 130px;
	}

	/** Reverse position to bottom for smaller screens */
	@media screen and (max-width: ${Object(h.g)(767)}) {
		left: ${e=>Object(h.g)(2*e.theme.gutter)};
		right: ${e=>Object(h.g)(2*e.theme.gutter)};
		bottom: 0;
		width: auto !important;
		top: auto !important;
		min-width: 100px !important;
	}

	/** We position this w.r.t screen width and not container width */
	@media screen and (min-width: ${Object(h.g)(w)}) {
		width: ${e=>Object(h.g)(e.width||300)};
		left: ${e=>Object(h.g)(e.left||0)};
		right: auto;
		bottom: auto;
	}
`,S=Object(g.d)(p.animated.div)`
	border: 1px solid ${e=>e.theme.borderColorSplit};
	border-radius: ${e=>Object(h.g)(e.theme.borderRadiusBase)};
	background-color: ${e=>e.theme.appBackgroundColor};
	box-shadow: ${e=>e.theme.boxShadow12dp};
	overflow: hidden;
	will-change: transform, opacity;

	/** Reverse position to bottom for smaller screens */
	@media screen and (max-width: ${Object(h.g)(767)}) {
		border-bottom: 0 none;
		transform-origin: bottom center !important;
		border-bottom-right-radius: 0;
		border-bottom-left-radius: 0;
	}
`,A=g.d.div`
	padding: 0;
	border-bottom-left-radius: ${e=>Object(h.g)(e.theme.borderRadiusBase)};
	border-bottom-right-radius: ${e=>Object(h.g)(e.theme.borderRadiusBase)};
	max-height: calc(
		70vh - ${e=>Object(h.g)(2.5*e.theme.controlHeightBase)}
	);
	overflow-y: auto;
	overflow-x: hidden;
	/** We position this w.r.t screen width and not container width */
	@media screen and (min-width: ${Object(h.g)(w)}) {
		max-height: calc(
			60vh - ${e=>Object(h.g)(2.5*e.theme.controlHeightBase)}
		);
	}
`,R=g.d.div`
	${h.a};
	padding: ${e=>Object(h.g)(e.theme.gutter)};
	min-height: 150px;
`,N=g.d.div`
	margin: 0;
	margin-bottom: ${e=>Object(h.g)(e.theme.gutter/2)};
	&:last-child {
		margin-bottom: 0;
	}
`,H=g.d.label`
	margin: 0;
	margin-bottom: ${e=>Object(h.g)(e.theme.gutter/4)};
	display: block;
	font-size: ${e=>Object(h.g)(e.theme.fz.small1)};
	font-weight: bold;
	text-transform: uppercase;
	color: ${e=>e.theme.textColorSecondary};
`,L=Object(g.d)(p.animated.div)`
	position: fixed;
	z-index: 999996;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;
	background-color: rgba(255, 255, 255, 0.75);
	will-change: opacity;

	@media screen and (min-width: ${Object(h.g)(w)}) {
		display: none;
	}
`,I=g.d.div`
	padding: 0;
	margin: 0;
`,_=g.d.span`
	height: ${e=>Object(h.g)(.4*e.theme.controlHeightBase)};
	width: ${e=>Object(h.g)(.4*e.theme.controlHeightBase)};
	flex: 0 0 ${e=>Object(h.g)(.4*e.theme.controlHeightBase)};
	border-radius: ${e=>Object(h.g)(.2*e.theme.controlHeightBase)};
	font-size: ${e=>Object(h.g)(.2*e.theme.controlHeightBase)};
	background-color: ${e=>e.theme.borderColorSplit};
	color: ${e=>e.theme.primaryBgText};
	margin: 0 ${e=>Object(h.g)(e.theme.gutter/2)} 0 0;
	display: flex;
	align-items: center;
	justify-content: center;
	transition: ${e=>Object(h.d)(["background-color","opacity"],e.theme.transitionControl)};
`,z=g.d.span`
	flex: 1 0
		calc(100% - ${e=>Object(h.g)(.4*e.theme.controlHeightBase)});
	width: calc(
		100% - ${e=>Object(h.g)(.4*e.theme.controlHeightBase)}
	);
	text-align: left;
	text-transform: uppercase;
	line-height: 1;
	font-weight: bold;
`,D=g.d.button`
	position: relative;
	width: 100%;
	min-height: ${e=>Object(h.g)(.8*e.theme.controlHeightBase)};
	padding: 0 ${e=>Object(h.g)(e.theme.gutter/2)};
	border-radius: 0;
	border: 0 none;
	outline: none;
	color: ${e=>e.theme.textColorSecondary};
	background-color: ${e=>e.theme.appBackgroundColor};
	font-size: ${e=>Object(h.g)(e.theme.fz.small2)};
	display: flex;
	flex-flow: row nowrap;
	justify-content: flex-start;
	align-items: center;
	text-align: left;
	cursor: pointer;
	transition: ${e=>Object(h.d)(["background-color","color"],e.theme.transitionControl)};
	${_} {
		opacity: 0.9;
	}
	&.is-active {
		color: ${e=>e.theme.textColor};
		background-color: ${e=>e.theme.backgroundControl};
		${_} {
			background-color: ${e=>e.theme.successColor};
			opacity: 0.8;
		}
	}

	&:hover {
		${_} {
			opacity: 1;
		}
	}

	&:hover,
	&:focus,
	&:active {
		background-color: ${e=>e.theme.backgroundHover};
		color: ${e=>e.theme.textColor};
	}

	&:focus:active {
		background-color: ${e=>e.theme.primaryBackgroundColor};
		transition: ${e=>Object(h.d)(["color"],e.theme.transitionControl)};
	}
`,P=g.d.div`
	display: flex;
	flex-flow: row wrap;
	padding: 0;
	margin: 0;
`,M=g.d.div`
	width: 100%;
	flex: 0 0 100%;
	border-bottom: 1px solid ${e=>e.theme.borderColorSplit};
	padding: ${e=>Object(h.g)(e.theme.gutter/4)} 0;

	&:last-child {
		border-bottom: 0 none;
	}
	@media screen and (min-width: 768px) {
		width: 50%;
		flex-basis: 50%;
		min-width: 100px;
		border-bottom: 0 none;
		border-right: 1px solid ${e=>e.theme.borderColorSplit};
		&:last-child {
			border-right: 0 none;
		}
	}
`;var U=o(55),G=o(59),W=o(33);const V=`body.${E}-is-open-mod-body {\n\toverflow: hidden;\n}\n@media screen and (min-width: ${Object(h.g)(w)}) {\n\tbody.${E}-is-open-mod-body {\n\t\toverflow: unset;\n\t}\n}`;var X=o(48);function Y(e){const t=e.isOpen,o=e.closePortal,r=e.dropdownButtonRect,c=e.size,s=e.dropdownButtonRef,d=e.styleProps,m=e.children,b=e.minMenuWidth,u=Object(a.useState)({top:0,topBleeding:!1,rightBleeding:!1}),p=Object(n.a)(u,2),f=p[0],O=p[1],x=Object(g.f)(),j=Object(a.useRef)(null),C=Object(U.a)(j,{observe:window.innerWidth>=w}),y=Object(X.b)();Object(a.useLayoutEffect)((()=>{t&&setTimeout((()=>{j.current&&j.current.focus()}),400),t?document.body.classList.add(`${E}-is-open-mod-body`):document.body.classList.remove(`${E}-is-open-mod-body`)}),[j,t]),Object(a.useLayoutEffect)((()=>{const e=()=>{O({top:0,rightBleeding:!1,topBleeding:!1})};if(window.innerWidth<w)e();else if(r&&C){let e=r.bottom+x.gutter/2;const t=window.innerHeight,o=C.height;let n=!1;e+o>t&&(e=r.top-o-x.gutter/2,e<x.gutter/2&&(e=x.gutter/2),n=!0);const a=window.innerWidth,i=C.width;let c=!1;r.left+i+x.gutter>a&&(c=!0),O({top:e,topBleeding:n,rightBleeding:c})}else e()}),[r,C,x.gutter]),Object(a.useEffect)((()=>{if(t){const e=e=>{var t,o;const r=e.target;return!(document.body.contains(r)||!y.current||y.current.contains(r))||(e.target===j.current||(null===(t=j.current)||void 0===t?void 0:t.contains(e.target))||e.target===s.current||(null===(o=s.current)||void 0===o?void 0:o.contains(e.target)))},t=t=>{t.target.shadowRoot||e(t)||o()},r=t=>{e(t)||o()},n=y.current;return window.addEventListener("click",t),n&&n.addEventListener("click",r),()=>{window.removeEventListener("click",t),n&&n.removeEventListener("click",r)}}return()=>{}}),[o,t,y,s]),Object(a.useEffect)((()=>{if(t){const e=e=>{"Escape"===e.key&&o()};return document.addEventListener("keyup",e),()=>{document.removeEventListener("keyup",e)}}return()=>{}}),[o,t]);const v=Object(h.b)($,{[`size-${c}`]:!0});let k,B=null==r?void 0:r.width;return b&&B&&B<b&&(B=b),r&&C&&(k=f.rightBleeding?r.left-(C.width-r.width):r.left),i.a.createElement(X.a.Portal,null,i.a.createElement(L,{style:{opacity:d.opacity}}),i.a.createElement(F,{style:{top:Object(h.g)(f.top)},left:k,width:B,ref:j,tabIndex:0,className:v},i.a.createElement(S,{style:d,className:l()({"is-bleeding":f.topBleeding})},m)))}function Z(e){const t=e.closePortal,o=e.isOpen,r=e.menu,n=e.size,a=e.dropdownButtonRef,c=e.minMenuWidth,l=function(e,t){const o=Object(U.a)(t,{observe:e&&window.innerWidth>=w}),r=Object(g.f)();return{dropdownContainerTransitions:Object(p.useTransition)(e,{from:{transform:window.innerWidth<w?"translate3d(0, 50px, -50px)":"translate3d(0, 50px, 0)",opacity:0},reverse:e,enter:{opacity:1,transform:"translate3d(0, 0, 0)"},leave:{opacity:0},config:r.springConfigStiff}),dropdownButtonRect:o}}(o,a),s=l.dropdownContainerTransitions,d=l.dropdownButtonRect;return s(((e,l)=>l&&i.a.createElement("div",null,i.a.createElement(Y,{isOpen:o,closePortal:t,size:n,dropdownButtonRect:d,dropdownButtonRef:a,styleProps:e,minMenuWidth:c},r(t)))))}const q=["prefix","controlType","controlAlignment","size","className","disabled","buttonLabel","passiveButton","menu","onClose","onOpen","hasError","minMenuWidth","loading"];function Q(e){const t=e.prefix,o=e.controlType,c=void 0===o?b.f.BOXY:o,l=e.controlAlignment,s=void 0===l?b.e.LEFT:l,d=e.size,m=void 0===d?b.a.DEFAULT:d,g=e.className,p=e.disabled,f=e.buttonLabel,$=e.passiveButton,w=void 0!==$&&$,F=e.menu,S=e.onClose,A=e.onOpen,R=e.hasError,N=void 0!==R&&R,H=e.minMenuWidth,L=e.loading,I=void 0!==L&&L,_=Object(r.a)(e,q),z=function(e,t){const o=Object(a.useRef)(null),r=Object(a.useState)(!1),i=Object(n.a)(r,2),c=i[0],l=i[1],s=Object(a.useCallback)((()=>{l(!1),o.current&&o.current.focus()}),[]),d=Object(a.useCallback)((()=>{l((e=>!e))}),[]),m=Object(W.b)(c);Object(a.useEffect)((()=>{!0===m&&!1===c&&e?e():!1===m&&!0===c&&t&&t()}),[c,m,e,t]);const h=Object(G.a)(),b=Object(n.a)(h,2),u=b[0],g=b[1];return Object(a.useEffect)((()=>{const e=`${E}--global-style`;if(document.head.querySelector(`style#${e}`))return()=>{};const t=document.createElement("style");return t.setAttribute("id",e),t.innerHTML=V,document.head.appendChild(t),()=>{const t=document.head.querySelector(`style#${e}`);t&&t.remove()}}),[]),{isOpen:c,closePortal:s,togglePortal:d,dropdownButtonRef:o,addRipple:u,ripples:g}}(S,A),D=z.isOpen,P=z.closePortal,M=z.togglePortal,U=z.dropdownButtonRef,X=z.addRipple,Y=z.ripples,Q=Object(h.b)(E,{"is-open":D,[`type-${c}`]:!0,[`align-${s}`]:"string"!=typeof f},g),J=Object(h.b)(O,{"is-empty":w,"is-open":D,[`type-${c}`]:!0,"has-error":N,[`size-${m}`]:!0});return i.a.createElement(y,{className:Q},i.a.createElement(x,null),i.a.createElement(T,Object.assign({type:"button",disabled:p||I,className:J,ref:U,onClick:e=>{X(e),M()}},_),Y,t||I?i.a.createElement(j,null,I?i.a.createElement(u.b,{iconClass:"fas fa-spinner fa-pulse"}):t):null,i.a.createElement(C,null,f),i.a.createElement(k,null,i.a.createElement(v,null,i.a.createElement(u.b,{iconClass:"fas fa-chevron-down"})))),c===b.f.MATERIAL?i.a.createElement(B,null):null,i.a.createElement(Z,{closePortal:P,isOpen:D,menu:F,size:m,dropdownButtonRef:U,minMenuWidth:H}))}Q.Widget=R,Q.FormControl=N,Q.Label=H,Q.Menu=I,Q.MenuItem=function(e){const t=e.children,o=e.active,r=e.onClick;return i.a.createElement(D,{className:l()({"is-active":o}),onClick:e=>{e.preventDefault(),r()}},i.a.createElement(_,null,i.a.createElement(u.b,{iconClass:"fas fa-check"})),i.a.createElement(z,null,t))},Q.SplitMenu=P,Q.SplitMenuColumn=M,Q.ScrollableItems=A;var J=o(149),K=o(86),ee=o(63);const te=new(o(47).a)("EForm Masks");te.addItem("us-phone-number",{name:Object(m.__)("US phone number","wp-eform"),mask:"+1 (000) 000-0000",placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform"),overrideInputType:"tel",title:Object(m.__)("Mobile or telephone number.","wp-eform")}),te.addItem("us-ssn",{name:Object(m.__)("US Social Security Number (SSN)","wp-eform"),mask:"000 00 0000",placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform"),overrideInputType:"tel",title:Object(m.__)("Digits only","wp-eform")}),te.addItem("us-zip",{name:Object(m.__)("US Zip code","wp-eform"),mask:"00000",placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform"),overrideInputType:"tel",title:Object(m.__)("Digits only","wp-eform")}),te.addItem("date-mm-dd-yy",{name:Object(m.__)("Date MM-DD-YY","wp-eform"),mask:"00-00-00",overrideInputType:"tel",placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform")}),te.addItem("date-yyyy-mm-dd",{name:Object(m.__)("Date YYYY-MM-DD","wp-eform"),mask:"0000-00-00",overrideInputType:"tel",placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform")}),te.addItem("date-dd/mm/yy",{name:Object(m.__)("Date DD/MM/YY","wp-eform"),mask:"00/00/00",overrideInputType:"tel",placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform")}),te.addItem("twitter-url",{name:Object(m.__)("Twitter URL","wp-eform"),mask:`https://twitter.com/*[${"*".repeat(50)}]`,placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform")}),te.addItem("facebook-url",{name:Object(m.__)("Facebook URL","wp-eform"),mask:`https://f\\acebook.com/*[${"*".repeat(50)}]`,placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform")}),te.addItem("instagram-url",{name:Object(m.__)("Instagram URL","wp-eform"),mask:`https://inst\\agr\\am.com/*[${"*".repeat(50)}]`,placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform")}),te.addItem("url",{name:Object(m.__)("General URL","wp-eform"),mask:`http[a]://[${"*".repeat(255)}]`,placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform")}),te.addItem("rgb-hex-color",{name:Object(m.__)("RGB or HEX color code","wp-eform"),mask:[{mask:"RGB,RGB,RGB",blocks:{RGB:{mask:ee.a.MaskedRange,from:0,to:255}}},{mask:/^#[0-9a-f]{0,6}$/i}],placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform")}),te.addItem("rgb-color",{name:Object(m.__)("RGB color code","wp-eform"),mask:[{mask:"RGB,RGB,RGB",blocks:{RGB:{mask:ee.a.MaskedRange,from:0,to:255}}}],placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform")});var oe=o(60);const re="wpeform-control-text",ne=g.d.div`
	position: absolute;
	height: 2px;
	bottom: 0;
	left: 0;
	right: 0;
	transform-origin: 50% 50%;
	background-color: ${e=>e.theme.primaryColor};
	pointer-events: none;
	transform: scaleX(0);
	transition: ${e=>Object(h.d)(["transform"],e.theme.transitionBeizer)};
`,ae=g.d.input`
	${h.a};
	${h.f};
	display: block;
	width: 100%;
	height: ${e=>Object(h.g)(e.theme.controlHeightBase)};
	border-radius: ${e=>Object(h.g)(e.theme.borderRadiusBase)};
	font-size: ${e=>Object(h.g)(e.theme.fz.base)};
	box-shadow: 0 0 0 0 transparent;
	color: ${e=>e.theme.textColor};
	padding: ${e=>Object(h.g)(e.theme.controlHeightBase/4)};
	border: 1px solid ${e=>e.theme.borderColorBase};
	background-color: ${e=>e.theme.appBackgroundColor};
	box-shadow: ${e=>e.theme.boxShadowNoneFocus};
	transition: ${e=>Object(h.d)(["border-color","box-shadow"],e.theme.transitionControl)};

	&:hover {
		color: ${e=>e.theme.textColor};
		border-color: ${e=>e.theme.primaryColor};
	}

	&:active,
	&:focus {
		color: ${e=>e.theme.textColor};
		border-color: ${e=>e.theme.primaryColor};
		box-shadow: ${e=>e.theme.boxShadowControlFocus};
	}

	&::placeholder {
		color: ${e=>e.theme.textColorSecondary};
	}

	&.${re}__input--has-error {
		border-color: ${e=>e.theme.borderColorError};

		&:hover {
			border-color: ${e=>e.theme.borderColorError};
		}

		&:active,
		&:focus {
			border-color: ${e=>e.theme.borderColorError};
			box-shadow: ${e=>e.theme.boxShadowControlFocusError};
		}
	}

	&:disabled {
		background-color: ${e=>e.theme.disabledBackgroundColor};
		color: ${e=>e.theme.disabledColor};
		border-color: ${e=>e.theme.disabledColor};
		cursor: not-allowed;
		box-shadow: none;
	}

	&:read-only {
		background-color: ${e=>e.theme.disabledBackgroundColor};
		border-color: ${e=>e.theme.disabledColor};
		box-shadow: none;
	}

	&.${re}__input--type-MATERIAL {
		border: 0 none;
		border-bottom: 2px solid ${e=>e.theme.borderColorBase};
		border-radius: ${e=>Object(h.g)(e.theme.borderRadiusBase)}
			${e=>Object(h.g)(e.theme.borderRadiusBase)} 0 0;
		box-shadow: none;
		background-color: ${e=>e.theme.backgroundControl};
		transition: ${e=>Object(h.d)(["background-color"],e.theme.transitionControl)};

		&:hover {
			border-color: ${e=>e.theme.borderColorBase};
		}

		&:active,
		&:focus {
			background-color: ${e=>Object(f.c)(.5,e.theme.backgroundControl)};
			border-color: ${e=>e.theme.borderColorBase};
			box-shadow: none;
		}

		&:hover
			+ ${ne},
			&:active
			+ ${ne},
			&:focus
			+ ${ne} {
			transform: scaleX(1);
		}

		&.${re}__input--has-error {
			border-bottom-color: ${e=>e.theme.borderColorError};

			&:hover {
				border-bottom-color: ${e=>e.theme.borderColorError};
			}

			&:active,
			&:focus {
				border-bottom-color: ${e=>e.theme.borderColorError};
			}

			+ ${ne} {
				background-color: ${e=>e.theme.borderColorError};
			}
		}

		&:disabled {
			background-color: ${e=>e.theme.disabledBackgroundColor};
			color: ${e=>e.theme.disabledColor};
			border-color: ${e=>e.theme.disabledColor};
			cursor: not-allowed;
			+ ${ne} {
				transform: scaleX(0);
				background-color: ${e=>e.theme.disabledColor};
			}
		}

		&:read-only {
			background-color: ${e=>e.theme.disabledBackgroundColor};
			border-color: ${e=>e.theme.disabledColor};
			+ ${ne} {
				transform: scaleX(0);
				background-color: ${e=>e.theme.disabledColor};
			}
		}
	}

	/** SIZES */
	&.${re}__input--size-SMALL {
		height: ${e=>Object(h.g)(.8*e.theme.controlHeightBase)};
		padding: ${e=>Object(h.g)(e.theme.controlHeightBase/8)};
		font-size: ${e=>Object(h.g)(e.theme.fz.small1)};
	}
	&.${re}__input--size-LARGE {
		height: ${e=>Object(h.g)(1.2*e.theme.controlHeightBase)};
		padding: ${e=>Object(h.g)(e.theme.controlHeightBase/4)};
	}

	&[type='number'] {
		&::-webkit-inner-spin-button,
		&::-webkit-outer-spin-button {
			appearance: none;
			margin: 0;
		}
	}
`,ie=g.d.div`
	position: absolute;
	display: flex;
	align-items: center;
	overflow: hidden;
	text-overflow: ellipsis;
	white-space: nowrap;
	/** So that we can click through it to the input */
	pointer-events: none;
	font-size: ${e=>Object(h.g)(e.theme.fz.base)};

	color: ${e=>e.theme.textColorSecondary};
	transition: ${e=>Object(h.d)(["top","left","bottom","font-size"],e.theme.transitionControl)};

	> * {
		margin: 0;
		padding: 0;
		max-width: 100%;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
`,ce=g.d.div`
	position: absolute;
	top: 0;
	left: ${e=>Object(h.g)(e.theme.controlHeightBase/4)};
	bottom: 0;
	display: flex;
	align-items: center;
	justify-content: center;
	/** So that we can click through it to the input */
	pointer-events: none;
	color: ${e=>e.theme.greyLightColor};
`,le=g.d.div`
	${h.a};
	position: relative;
	padding: 0;

	/** Position the default placeholder */
	${ie} {
		top: ${e=>Object(h.g)(e.theme.controlHeightBase/4)};
		left: ${e=>Object(h.g)(e.theme.controlHeightBase/4)};
		right: ${e=>Object(h.g)(e.theme.controlHeightBase/4)};
		bottom: ${e=>Object(h.g)(e.theme.controlHeightBase/4)};
	}
	&.${re}--align-LEFT {
		${ie} {
			text-align: left;
			justify-content: flex-start;
		}
	}
	&.${re}--align-CENTER {
		${ie} {
			text-align: center;
			justify-content: center;
		}
	}
	&.${re}--align-RIGHT {
		${ie} {
			text-align: right;
			justify-content: flex-end;
		}
	}

	&.${re}--has-prefix {
		${ae} {
			/** [gutter + prefix + gutter] where gutter is controlHeightBase / 4 & prefix is fz.base */
			padding-left: ${e=>Object(h.g)(e.theme.fz.base+e.theme.controlHeightBase/4*2)};
		}
		${ie} {
			left: ${e=>Object(h.g)(e.theme.fz.base+e.theme.controlHeightBase/4*2)};
		}
		&.${re}--size-SMALL {
			${ae} {
				/** [gutter + prefix + gutter] where gutter is controlHeightBase / 8 & prefix is fz.base */
				padding-left: ${e=>Object(h.g)(e.theme.fz.base+e.theme.controlHeightBase/8*2+4)};
			}
			${ie} {
				left: ${e=>Object(h.g)(e.theme.fz.base+e.theme.controlHeightBase/8*2)};
			}
		}

		&.${re}--has-error {
			${ce} {
				color: ${e=>e.theme.errorColor};
			}
		}
	}

	/** Changes when focused */
	&.${re}--is-focused, &.${re}--is-not-empty {
		${ie} {
			top: ${e=>Object(h.g)(e.theme.controlHeightBase/2*-1)};
			left: 0;
			bottom: ${e=>Object(h.g)(e.theme.controlHeightBase)};
			font-size: ${e=>Object(h.g)(e.theme.fz.small1)};
		}
	}
`,se=["id","onChange","value","prefix","placeholder","controlType","controlAlignment","disabled","readOnly","hasError","type","masks","onBlur","innerRef","className","size"],de=Object(K.a)((({inputRef:e,...t})=>i.a.createElement(ae,Object.assign({},t,{ref:e}))));function me(e){const t=e.id,o=e.onChange,c=e.value,l=e.prefix,s=e.placeholder,d=e.controlType,m=void 0===d?b.f.BOXY:d,u=e.controlAlignment,g=void 0===u?b.e.LEFT:u,p=e.disabled,f=void 0!==p&&p,E=e.readOnly,O=void 0!==E&&E,$=e.hasError,w=void 0!==$&&$,x=e.type,j=void 0===x?"text":x,C=e.masks,y=e.onBlur,v=e.innerRef,k=e.className,B=e.size,T=void 0===B?b.a.DEFAULT:B,F=Object(r.a)(e,se);let S,A=j;const R=Object(a.useState)(!1),N=Object(n.a)(R,2),H=N[0],L=N[1],I=Object(a.useState)(c),_=Object(n.a)(I,2),z=_[0],D=_[1],P=Object(J.a)(((e,t)=>{t(e)}),300),M=e=>{if("number"===j){let t=Object(oe.a)(e,0);void 0!==F.min&&t<F.min&&(t=F.min),void 0!==F.max&&t>F.max&&(t=F.max),e=t.toString()}D(e),P(e,o)};Object(a.useEffect)((()=>{D(c)}),[c]);const U=Object(h.b)(re,{"has-prefix":!!l,"is-not-empty":""!==c,"is-focused":H,[`type-${m}`]:!0,"has-error":w,[`align-${g}`]:!0,[`size-${T}`]:!0},k);let G,W=!1,V=C?C.placeholder:"_";if(C&&C.maskType!==b.b.NONE)if(C.maskType===b.b.STRING)G=C.maskString||"",W=!0;else if(C.maskType===b.b.REGEXP)G=[],C.maskRegExps.forEach((e=>{G.push({mask:new RegExp(e.pattern,e.caseSensitive?"i":void 0),lazy:!C.alwaysShowMask&&!H})})),W=!0;else{const e=C.maskPreset||"";if(te.hasItem(e)){const t=te.getItem(e);G=t.mask,t.overrideInputType&&(A=t.overrideInputType),S=t.title,t.placeholder&&(V=t.placeholder),W=!0}}const X=Object(h.b)(Object(h.c)(re,"input"),{[`type-${m}`]:!0,"has-error":w,[`size-${T}`]:!0});return i.a.createElement(le,{className:U},l?i.a.createElement(ce,null,l):null,"string"!=typeof s&&(!W||W&&C&&!C.alwaysShowMask)?i.a.createElement(ie,null,s):null,W&&G&&C?i.a.createElement(de,{mask:G,radix:".",unmask:!1,inputRef:v,onAccept:e=>{M(e)},overwrite:!0,value:z,onFocus:()=>{L(!0)},onBlur:e=>{L(!1),P.cancel(),o(z),null==y||y(e)},disabled:f,readOnly:O,lazy:!C.alwaysShowMask&&!H,placeholderChar:V,placeholder:"string"==typeof s?s:void 0,title:S,type:A}):i.a.createElement(ae,Object.assign({id:t,type:j,className:X,value:z,onChange:e=>{M(e.target.value)},onFocus:()=>{L(!0)},onBlur:e=>{L(!1),P.cancel(),o(z),null==y||y(e)},disabled:f,readOnly:O,placeholder:"string"==typeof s?s:void 0,ref:v},F)),m===b.f.MATERIAL?i.a.createElement(ne,null):null)}const he="wpeform-control-select",be=Object(h.c)(he,"search"),ue=Object(h.c)(he,"menu"),ge=g.d.div`
	display: flex;
	flex-flow: row nowrap;
	align-items: center;
	justify-content: flex-start;
	overflow-x: auto;
`,pe=g.d.button`
	${h.a};
	color: ${e=>e.theme.textColor};
	padding: ${e=>Object(h.g)(e.theme.gutter/4)};
	background-color: ${e=>e.theme.backgroundControl};
	border: 0 none;
	border-radius: ${e=>Object(h.g)(e.theme.borderRadiusBase)};
	cursor: pointer;
	flex: 0 0 ${e=>Object(h.g)(3*e.theme.controlHeightBase/4)};
	width: ${e=>Object(h.g)(3*e.theme.controlHeightBase/4)};
	transition: ${e=>Object(h.d)(["background-color","color"],e.theme.transitionControl)};

	&:hover,
	&:active,
	&:focus {
		background-color: ${e=>e.theme.errorBackgroundColor};
		color: ${e=>e.theme.errorColor};
	}
`,fe=g.d.div`
	padding: ${e=>Object(h.g)(e.theme.gutter/2)};
	margin: 0;
	border-bottom: 1px solid ${e=>e.theme.borderColorSplit};
	display: flex;
	flex-flow: row nowrap;
	${pe} {
		flex: 0 0 ${e=>Object(h.g)(e.theme.controlHeightBase)};
		margin-left: auto;
		width: ${e=>Object(h.g)(e.theme.controlHeightBase)};
		height: ${e=>Object(h.g)(e.theme.controlHeightBase)};
	}
`,Ee=g.d.div`
	flex: 0 0
		calc(
			100% -
				${e=>Object(h.g)(e.theme.controlHeightBase+e.theme.gutter/2)}
		);
	width: calc(
		100% -
			${e=>Object(h.g)(e.theme.controlHeightBase+e.theme.gutter/2)}
	);
`,Oe=g.d.div`
	margin: 0;
	padding: ${e=>Object(h.g)(e.theme.gutter/4)};
	border-top: 1px solid ${e=>e.theme.borderColorSplit};
	border-bottom-left-radius: ${e=>Object(h.g)(e.theme.borderRadiusBase)};
	border-bottom-right-radius: ${e=>Object(h.g)(e.theme.borderRadiusBase)};
`,$e=g.d.div`
	font-size: ${e=>Object(h.g)(e.theme.fz.small1)};
	border-radius: ${e=>Object(h.g)(e.theme.borderRadiusBase)};
	margin: ${e=>Object(h.g)(e.theme.gutter/4)};
	padding: 0 0 0 ${e=>Object(h.g)(e.theme.gutter/4)};
	flex: 0 0 auto;
	background-color: ${e=>e.asPlaceholder?"transparent":e.theme.backgroundControl};
	display: flex;
	align-items: center;
	justify-content: flex-start;
	color: ${e=>e.asPlaceholder?e.theme.disabledColor:e.theme.textColor};
	max-width: 250px;

	span {
		padding: ${e=>Object(h.g)(e.theme.gutter/4)};
		max-width: calc(
			100% -
				${e=>e.asPlaceholder?"0px":Object(h.g)(3*e.theme.controlHeightBase/4)}
		);
		flex: 0 0 auto;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}
`,we=g.d.div`
	padding: ${e=>Object(h.g)(2*e.theme.gutter)}
		${e=>Object(h.g)(e.theme.gutter/2)};
	color: ${e=>e.theme.greyLightColor};
	font-size: ${e=>Object(h.g)(e.theme.fz.small1)};
	width: 100%;
	text-align: center;
`,xe=g.d.div`
	width: 100%;
	flex: 0 0 100%;
	margin: 0 0 ${e=>Object(h.g)(e.theme.gutter/2)} 0;
	font-size: ${e=>Object(h.g)(e.theme.fz.large8)};
	color: ${e=>e.theme.disabledColor};
	.${u.a} {
		display: block;
		margin: 0 auto;
	}
`,je=g.d.p`
	width: 100%;
	flex: 0 0 100%;
	margin: 0;
	padding: 0;
`,Ce=g.d.span`
	flex: 0 0 calc(100% - ${e=>Object(h.g)(e.theme.controlHeightBase)});
`,ye=g.d.span`
	margin-left: auto;
	flex: 0 0 ${e=>Object(h.g)(e.theme.controlHeightBase/2)};
	width: ${e=>Object(h.g)(e.theme.controlHeightBase/2)};
	height: ${e=>Object(h.g)(e.theme.controlHeightBase/2)};
	background-color: ${e=>e.theme.borderColorSplit};
	color: ${e=>e.theme.primaryBgText};
	display: flex;
	align-items: center;
	justify-content: center;
	opacity: 0;
	font-size: ${e=>Object(h.g)(.25*e.theme.controlHeightBase)};
	border-radius: 50%;
	transition: ${e=>Object(h.d)(["opacity","background-color"],e.theme.transitionControl)};
`,ve=g.d.button`
	${h.a};
	display: flex;
	width: 100%;
	align-items: center;
	justify-content: flex-start;
	text-align: left;
	background-color: ${e=>e.theme.appBackgroundColor};
	color: ${e=>e.theme.textColorSecondary};
	font-size: ${e=>Object(h.g)(e.theme.fz.base)};
	padding: ${e=>Object(h.g)(e.theme.gutter/2)}
		${e=>Object(h.g)(e.theme.gutter)};
	outline: none;
	border: 0 none;
	cursor: pointer;
	transition: ${e=>Object(h.d)(["background-color","color"],e.theme.transitionControl)};

	&.is-active {
		color: ${e=>e.theme.textColor};
		${ye} {
			background-color: ${e=>e.theme.successColor};
			opacity: 0.8;
		}
	}

	&:hover {
		${ye} {
			opacity: 0.5;
		}
	}

	&:hover,
	&:focus,
	&:active {
		background-color: ${e=>e.theme.backgroundHover};
		color: ${e=>e.theme.textColor};
	}

	&:focus:active {
		background-color: ${e=>e.theme.primaryBackgroundColor};
		transition: ${e=>Object(h.d)(["color"],e.theme.transitionControl)};
	}
`,ke=g.d.div`
	&.${ue}--size-SMALL {
		${Ee} {
			flex-basis: calc(
				100% -
					${e=>Object(h.g)(.8*e.theme.controlHeightBase+e.theme.gutter/4)}
			);
			width: calc(
				100% -
					${e=>Object(h.g)(.8*e.theme.controlHeightBase+e.theme.gutter/4)}
			);
		}
		${pe} {
			height: ${e=>Object(h.g)(.8*e.theme.controlHeightBase)};
			width: ${e=>Object(h.g)(.8*e.theme.controlHeightBase)};
			flex-basis: ${e=>Object(h.g)(.8*e.theme.controlHeightBase)};
			font-size: ${e=>Object(h.g)(e.theme.fz.small1)};
		}
		${ve} {
			font-size: ${e=>Object(h.g)(e.theme.fz.base)};
			padding: ${e=>Object(h.g)(e.theme.gutter/4)}
				${e=>Object(h.g)(e.theme.gutter/2)};
		}
		${ye} {
			flex-basis: ${e=>Object(h.g)(.4*e.theme.controlHeightBase)};
			width: ${e=>Object(h.g)(.4*e.theme.controlHeightBase)};
			height: ${e=>Object(h.g)(.4*e.theme.controlHeightBase)};
			font-size: ${e=>Object(h.g)(.2*e.theme.controlHeightBase)};
		}
		${Ce} {
			flex-basis: calc(
				100% - ${e=>Object(h.g)(.6*e.theme.controlHeightBase)}
			);
		}
		${Oe} {
			padding-top: 0;
			padding-bottom: 0;
		}
	}
`,Be=["items","placeholder","showSearch","searchPlaceholder","emptyResultPlaceholder","value","mode","onChange","controlType","controlAlignment","className","canClear","onBlur","size"];function Te(e){const t=e.showSearch,o=e.searchPlaceholder,r=void 0===o?Object(m.__)("Search items","wp-eform"):o,c=e.emptyResultPlaceholder,s=void 0===c?Object(m.__)("No items found","wp-eform"):c,g=e.items,p=e.value,f=e.onChange,E=e.toggleValue,O=e.itemsInValue,$=e.controlType,w=e.closePortal,x=e.placeholder,j=e.size,C=e.canClear,y=void 0===C||C,v=e.mode,k=Object(a.useState)(""),B=Object(n.a)(k,2),T=B[0],F=B[1],S=Object(a.useRef)(null),A=Object(a.useMemo)((()=>""!==T?g.filter((e=>d()(T.toLowerCase(),e.plain.toLowerCase()))):g),[T,g]);return i.a.createElement(ke,{className:Object(h.b)(ue,{[`size-${j}`]:!0})},t?i.a.createElement(fe,null,i.a.createElement(Ee,null,i.a.createElement(me,{size:j,innerRef:S,className:be,value:T,onChange:F,prefix:i.a.createElement(u.b,{iconClass:"fas fa-search"}),placeholder:r,controlType:$})),i.a.createElement(pe,{type:"button",onClick:e=>{e.preventDefault(),w()}},i.a.createElement(u.b,{iconClass:"fas fa-times"}))):null,i.a.createElement(Q.ScrollableItems,null,A.length?A.map((e=>i.a.createElement(ve,{key:e.value,className:l()({"is-active":p.includes(e.value)}),onClick:t=>{t.preventDefault(),E(e.value),v===b.c.SINGLE&&w()}},i.a.createElement(Ce,null,e.label),i.a.createElement(ye,null,i.a.createElement(u.b,{iconClass:"fas fa-check"}))))):i.a.createElement(we,null,i.a.createElement(xe,null,i.a.createElement(u.b,{iconClass:"fas fa-box-open"})),i.a.createElement(je,null,s))),y?i.a.createElement(Oe,null,i.a.createElement(ge,null,O.length?O.map((e=>i.a.createElement($e,{key:e.value},i.a.createElement("span",null,e.label),i.a.createElement(pe,{type:"button",onClick:t=>{t.preventDefault(),f(p.filter((t=>t!==e.value)))}},i.a.createElement(u.b,{iconClass:"fas fa-times"}))))):i.a.createElement($e,{asPlaceholder:!0},i.a.createElement("span",null,x)))):null)}function Fe(e){const t=e.items,o=e.placeholder,n=e.showSearch,c=void 0===n||n,l=e.searchPlaceholder,s=e.emptyResultPlaceholder,d=e.value,m=e.mode,u=e.onChange,g=e.controlType,p=void 0===g?b.f.BOXY:g,f=e.controlAlignment,E=void 0===f?b.e.LEFT:f,O=e.className,$=e.canClear,w=void 0===$||$,x=e.onBlur,j=e.size,C=void 0===j?b.a.DEFAULT:j,y=Object(r.a)(e,Be),v=t.filter((e=>d&&d.includes(e.value))),k=Object(a.useCallback)((e=>{if(d.includes(e)){if(m===b.c.SINGLE)return;u(d.filter((t=>t!==e)))}else m===b.c.MULTIPLE?u([...d,e]):u([e])}),[d,m,u]),B=null===d||!d.length,T=Object(h.b)(he,{"is-empty":B,[`type-${p}`]:!0,[`mode-${m}`]:!0,[`align-${E}`]:"string"!=typeof o},O),F=v.length?v.map((e=>e.plain)).join(", "):o;return i.a.createElement(Q,Object.assign({buttonLabel:F,menu:e=>i.a.createElement(Te,{showSearch:c,emptyResultPlaceholder:s,items:t,itemsInValue:v,onChange:u,searchPlaceholder:l,placeholder:o,toggleValue:k,value:d,controlType:p,closePortal:e,size:C,canClear:w,mode:m}),className:T,controlAlignment:E,controlType:p,onClose:x,passiveButton:B,size:C},y))}},62:function(e,t,o){"use strict";o.d(t,"a",(function(){return x}));var r=o(47),n=o(19),a=o(10),i=o(1);const c={neutrals:{"050":"#F5F7FA",100:"#E4E7EB",200:"#CBD2D9",300:"#9AA5B1",400:"#7B8794",500:"#616E7C",600:"#52606D",700:"#3E4C59",800:"#323F4B",900:"#1F2933"},red:{"050":"#FFE3E3",100:"#FFBDBD",200:"#FF9B9B",300:"#F86A6A",400:"#EF4E4E",500:"#E12D39",600:"#CF1124",700:"#AB091E",800:"#8A041A",900:"#610316"},green:{"050":"#E3F9E5",100:"#C1F2C7",200:"#91E697",300:"#51CA58",400:"#31B237",500:"#18981D",600:"#0F8613",700:"#0E7817",800:"#07600E",900:"#014807"},yellow:{"050":"#FFFBEA",100:"#FFF3C4",200:"#FCE588",300:"#FADB5F",400:"#F7C948",500:"#F0B429",600:"#DE911D",700:"#CB6E17",800:"#B44D12",900:"#8D2B0B"}},l={fontFamilyBody:"--apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif",fontFamilyHeading:"--apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif",fontFamilyMono:'"SFMono-Regular", Consolas, "Liberation Mono", Menlo, Courier, monospace',fz:{small2:12,small1:14,base:16,large1:18,large2:20,large3:24,large4:30,large5:36,large6:48,large7:60,large8:72},boldHeading:!0,italicHeading:!1,borderRadiusBase:4,gutter:20,controlHeightBase:40,boxShadowBase:"0 2px 8px rgba(0, 0, 0, .15)",boxShadowElevationOne:"0 1px 3px rgba(0, 0, 0, 0.01), 0 1px 2px rgba(0, 0, 0, 0.06)",boxShadowHover:"0 3px 6px rgba(0,0,0,0.01), 0 3px 6px rgba(0,0,0,0.06)",boxShadowBottom:"0 2px 3px rgba(0, 0, 0, 0.01), 0 2px 2px rgba(0, 0, 0, 0.06)",boxShadowTop:"0 -1px 2px rgba(0, 0, 0, 0.01), 0 -2px 6px rgba(0, 0, 0, 0.06)",boxShadowRight:"1px 0 3px 0 rgba(0,0,0,0.01), 1px 0 2px 0 rgba(0,0,0,0.06)",boxShadowInset:"inset -1px 0 3px 0 rgba(0, 0, 0, 0.01), inset -2px 2px 6px 0 rgba(0,0,0,0.06)",boxShadowNoneFocus:"0 0 0 0 transparent",boxShadow1dp:"0 1px 1px 0 rgba(0,0,0,0.14), 0 2px 1px -1px rgba(0,0,0,0.12), 0 1px 3px 0 rgba(0,0,0,0.20)",boxShadow2dp:"0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.20)",boxShadow3dp:"0 3px 4px 0 rgba(0,0,0,0.14), 0 3px 3px -2px rgba(0,0,0,0.12), 0 1px 8px 0 rgba(0,0,0,0.20)",boxShadow4dp:"0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.20)",boxShadow6dp:"0 6px 10px 0 rgba(0,0,0,0.14), 0 1px 18px 0 rgba(0,0,0,0.12), 0 3px 5px -1px rgba(0,0,0,0.20)",boxShadow8dp:"0 8px 10px 1px rgba(0,0,0,0.14), 0 3px 14px 2px rgba(0,0,0,0.12), 0 5px 5px -3px rgba(0,0,0,0.20)",boxShadow9dp:"0 9px 12px 1px rgba(0,0,0,0.14), 0 3px 16px 2px rgba(0,0,0,0.12), 0 5px 6px -3px rgba(0,0,0,0.20)",boxShadow12dp:"0 12px 17px 2px rgba(0,0,0,0.14), 0 5px 22px 4px rgba(0,0,0,0.12), 0 7px 8px -4px rgba(0,0,0,0.20)",boxShadow16dp:"0 16px 24px 2px rgba(0,0,0,0.14), 0 6px 30px 5px rgba(0,0,0,0.12), 0 8px 10px -5px rgba(0,0,0,0.20)",boxShadow24dp:"0 24px 38px 3px rgba(0,0,0,0.14), 0 9px 46px 8px rgba(0,0,0,0.12), 0 11px 15px -7px rgba(0,0,0,0.20)",transition:"300ms ease-out",transitionControl:"200ms ease-out",transitionBeizer:"300ms cubic-bezier(0.755, 0.05, 0.855, 0.06)",springConfigGeneral:n.config.gentle,springConfigStiff:n.config.stiff,springConfigSlow:n.config.slow,breakpoints:{tablet:600,desktop:984,desktopHd:1200}};function s(e){var t,o,r,n,s,d;const m=null!==(t=e.neutrals)&&void 0!==t?t:c.neutrals,h=null!==(o=e.red)&&void 0!==o?o:c.red,b=null!==(r=e.green)&&void 0!==r?r:c.green,u=null!==(n=e.yellow)&&void 0!==n?n:c.yellow;return{successColor:b[600],warningColor:u[500],errorColor:h[600],errorBackgroundColor:h["050"],successBackgroundColor:b["050"],warningBackgroundColor:u["050"],primaryLightColor:e.primary[400],primaryColor:e.primary[500],primaryDarkColor:e.primary[700],primaryBackgroundColor:e.primary["050"],primaryBgText:"#ffffff",accentColor:null!==(s=null===(d=e.accent)||void 0===d?void 0:d[700])&&void 0!==s?s:e.primary[800],greyLightColor:m[400],greyColor:m[500],greyDarkColor:m[700],greyBgText:"#ffffff",backgroundShade:m["050"],backgroundControl:Object(a.b)(.05,m[100]),backgroundHover:Object(a.a)(.05,m["050"]),appBackgroundColor:"#ffffff",linkColor:e.primary[500],headingColor:m[800],textColor:m[900],textColorSecondary:m[500],darkTextColor:m[900],lightTextColor:m["050"],disabledColor:m[200],disabledBackgroundColor:Object(a.b)(.05,m[100]),borderColorBase:m[300],borderColorSplit:m[200],borderColorLight:m[100],backgroundSelected:m[100],borderColorError:h[300],boxShadowControlFocus:`0 0 0 ${Object(i.g)(3)} ${Object(a.c)(.8,e.primary[500])}`,boxShadowControlFocusError:`0 0 0 ${Object(i.g)(3)} ${Object(a.c)(.8,h[500])}`,boxShadowControlFocusSuccess:`0 0 0 ${Object(i.g)(3)} ${Object(a.c)(.8,b[500])}`,boxShadowFocus:`0 0 0 2px ${Object(a.c)(.5,e.primary[500])}`,...l,dark:{successColor:b[300],warningColor:u[300],errorColor:h[300],errorBackgroundColor:h[900],successBackgroundColor:b[900],warningBackgroundColor:u[900],primaryBackgroundColor:e.primary[800],backgroundShade:m[800],backgroundControl:Object(a.b)(.05,m[700]),backgroundHover:Object(a.a)(.05,m[800]),appBackgroundColor:m[900],linkColor:e.primary[200],headingColor:m[200],textColor:m["050"],textColorSecondary:m[200],darkTextColor:m[100],lightTextColor:m[700],disabledColor:m[600],disabledBackgroundColor:Object(a.b)(.04,m[900]),borderColorBase:m[500],borderColorSplit:m[600],borderColorLight:m[700],backgroundSelected:m[700],borderColorError:h[600],boxShadowControlFocus:`0 0 0 ${Object(i.g)(3)} ${Object(a.c)(.8,e.primary[500])}`,boxShadowControlFocusError:`0 0 0 ${Object(i.g)(3)} ${Object(a.c)(.8,h[500])}`,boxShadowControlFocusSuccess:`0 0 0 ${Object(i.g)(3)} ${Object(a.c)(.8,b[500])}`,boxShadowFocus:`0 0 0 2px ${Object(a.c)(.5,e.primary[500])}`}}}const d=s({primary:{"050":"#E6F6FF",100:"#BAE3FF",200:"#7CC4FA",300:"#47A3F3",400:"#2186EB",500:"#0967D2",600:"#0552B5",700:"#03449E",800:"#01337D",900:"#002159"},accent:{700:"#099AA4"}}),m=s({primary:{"050":"#EFFCF6",100:"#C6F7E2",200:"#8EEDC7",300:"#65D6AD",400:"#3EBD93",500:"#27AB83",600:"#199473",700:"#147D64",800:"#0C6B58",900:"#014D40"},accent:{700:"#421987"}}),h=s({primary:{"050":"#c5d9ed",100:"#f0f0f1",200:"#72aee6",300:"#4f94d4",400:"#3582c4",500:"#2271b1",600:"#135e96",700:"#0a4b78",800:"#043959",900:"#01263a"},neutrals:{"050":"#dcdcde",100:"#c3c4c7",200:"#a7aaad",300:"#8c8f94",400:"#787c82",500:"#646970",600:"#50575e",700:"#3c434a",800:"#2c3338",900:"#1d2327"},red:{"050":"#facfd2",100:"#ffabaf",200:"#ff8085",300:"#f86368",400:"#e65054",500:"#d63638",600:"#b32d2e",700:"#8a2424",800:"#691c1c",900:"#451313"},green:{"050":"#b8e6bf",100:"#68de7c",200:"#1ed14b",300:"#00ba37",400:"#00a32a",500:"#008a20",600:"#007017",700:"#005c12",800:"#00450c",900:"#003008"},yellow:{"050":"#f5e6ab",100:"#f2d675",200:"#f0c33c",300:"#dba617",400:"#bd8600",500:"#996800",600:"#755100",700:"#614200",800:"#4a3200",900:"#362400"}}),b=s({primary:{"050":"#FFEBEE",100:"#FFCDD2",200:"#EF9A9A",300:"#E57373",400:"#F44336",500:"#E53935",600:"#E53935",700:"#D32F2F",800:"#C62828",900:"#B71C1C"},accent:{700:"#D50000"}}),u=s({primary:{"050":"#FCE4EC",100:"#F8BBD0",200:"#F48FB1",300:"#F06292",400:"#E91E63",500:"#D81B60",600:"#D81B60",700:"#C2185B",800:"#AD1457",900:"#880E4F"},accent:{700:"#C51162"}}),g=s({primary:{"050":"#F3E5F5",100:"#E1BEE7",200:"#CE93D8",300:"#BA68C8",400:"#AB47BC",500:"#9C27B0",600:"#8E24AA",700:"#7B1FA2",800:"#6A1B9A",900:"#4A148C"},accent:{700:"#AA00FF"}}),p=s({primary:{"050":"#EDE7F6",100:"#D1C4E9",200:"#B39DDB",300:"#9575CD",400:"#7E57C2",500:"#673AB7",600:"#5E35B1",700:"#512DA8",800:"#4527A0",900:"#311B92"},accent:{700:"#6200EA"}}),f=s({primary:{"050":"#E8EAF6",100:"#C5CAE9",200:"#9FA8DA",300:"#7986CB",400:"#5C6BC0",500:"#3F51B5",600:"#3949AB",700:"#303F9F",800:"#283593",900:"#1A237E"},accent:{700:"#304FFE"}}),E=s({primary:{"050":"#E3F2FD",100:"#BBDEFB",200:"#90CAF9",300:"#64B5F6",400:"#2196F3",500:"#1E88E5",600:"#1E88E5",700:"#1976D2",800:"#1565C0",900:"#0D47A1"},accent:{700:"#2962FF"}}),O=s({primary:{"050":"#EFEBE9",100:"#D7CCC8",200:"#BCAAA4",300:"#A1887F",400:"#8D6E63",500:"#795548",600:"#6D4C41",700:"#5D4037",800:"#4E342E",900:"#3E2723"}}),$=s({primary:{"050":"#FAFAFA",100:"#F5F5F5",200:"#EEEEEE",300:"#E0E0E0",400:"#9E9E9E",500:"#757575",600:"#757575",700:"#616161",800:"#424242",900:"#212121"}}),w=s({primary:{"050":"#ECEFF1",100:"#CFD8DC",200:"#B0BEC5",300:"#90A4AE",400:"#78909C",500:"#607D8B",600:"#546E7A",700:"#455A64",800:"#37474F",900:"#263238"}}),x=new r.a("WPEForm Themes");x.addItem("vividblue",{name:"Vivid Blue",config:d}),x.addItem("teal",{name:"Teal",config:m}),x.addItem("wp",{name:"WordPress 5.7 Palette",config:h}),x.addItem("materialblue",{name:"Material Blue",config:E}),x.addItem("materialbluegray",{name:"Material Blue Gray",config:w}),x.addItem("materialbrown",{name:"Material Brown",config:O}),x.addItem("materialdeeppurple",{name:"Material Deep Purple",config:p}),x.addItem("materialgray",{name:"Material Gray",config:$}),x.addItem("materialindigo",{name:"Material Indigo",config:f}),x.addItem("materialpink",{name:"Material Pink",config:u}),x.addItem("materialpurple",{name:"Material Purple",config:g}),x.addItem("materialred",{name:"Material Red",config:b})},68:function(e,t,o){"use strict";o.d(t,"b",(function(){return s})),o.d(t,"a",(function(){return d}));var r=o(0),n=o.n(r),a=o(7),i=o(30),c=o(31),l=o(32);const s=n.a.createElement(c.b,null,n.a.createElement("p",null,Object(a.__)("No further configuration is necessary. You can change configuration from WPEForm → Settings page.","wp-eform")),n.a.createElement("p",{className:"muted"},Object(a.__)("Make sure to set this page as Summary page under WPEForm → Settings.","wp-eform")));function d(e){const t=e.blockProps;return n.a.createElement("div",t,n.a.createElement(l.a,null,n.a.createElement(i.a,{heading:Object(a.__)("Summary page","wp-eform")},s)))}},69:function(e,t,o){"use strict";o.d(t,"b",(function(){return s})),o.d(t,"a",(function(){return d}));var r=o(0),n=o.n(r),a=o(7),i=o(30),c=o(31),l=o(32);const s=n.a.createElement(c.b,null,n.a.createElement("p",null,Object(a.__)("No further configuration is necessary. You can change configuration from WPEForm → Settings page.","wp-eform")),n.a.createElement("p",{className:"muted"},Object(a.__)("Make sure to set this page as User portal page under WPEForm → Settings.","wp-eform")));function d(e){const t=e.blockProps;return n.a.createElement("div",t,n.a.createElement(l.a,null,n.a.createElement(i.a,{heading:Object(a.__)("User portal page","wp-eform")},s)))}},7:function(e,t){e.exports=window.wp.i18n},70:function(e,t,o){"use strict";(function(e){o.d(t,"a",(function(){return l}));var r=o(115),n=o(114),a=o(113);const i=new r.a({addTypename:!0,resultCaching:!0,typePolicies:{FormElementConfigMcqOptionType:{keyFields:!1},CategoryType:{keyFields:["id"]},FormType:{keyFields:["id"]},IntegrationCustomDataType:{keyFields:!1},FormPaymentsCouponItemType:{keyFields:!1},FormScoreItemType:{keyFields:!1},FormScoreDesignationType:{keyFields:!1},FormScoreTotalRedirectionItemType:{keyFields:!1},FormScorePercentageRedirectionItemType:{keyFields:!1},FormScoreConditionalRedirectionItemType:{keyFields:!1},ConditionalEventType:{keyFields:!1},FormStructureType:{keyFields:!1},FormElementType:{keyFields:!1},FormElementAppearanceWidthType:{keyFields:!1},FormElementConfigButtonType:{keyFields:!1},ElementScoreConditionType:{keyFields:!1},FormElementConfigMaskRegExpType:{keyFields:!1},FormPoolType:{keyFields:!1},ConditionalType:{keyFields:!1},ConditionalConsequenceType:{keyFields:!1},User:{keyFields:["id"]},FormLimitationMessageType:{keyFields:!1},FormNodeType:{keyFields:["id"]},FormMetaPaymentGatewayType:{keyFields:!1},FormIntegrationMailChimpListItemType:{keyFields:!1},SubmissionType:{keyFields:["id"]},FormSubmissionElementType:{keyFields:!1},SubmissionNodeType:{keyFields:["id"]},SubmissionMetaOwnerType:{keyFields:!1},FormMetaOwnerType:{keyFields:!1},SubmissionMetaCategoryType:{keyFields:!1},FormMetaCategoryType:{keyFields:!1}}});"undefined"!=typeof window&&(window.wpeformApolloCache=i);let c="/graphql";try{"string"==typeof e.env.WPEFORM_GQL_URI&&(c=e.env.WPEFORM_GQL_URI)}catch(e){}"undefined"!=typeof WPEFormGraphQLApp&&(c=WPEFormGraphQLApp.gqlUri);const l=new n.a({cache:i,link:new a.a({uri:c})})}).call(this,o(78))},73:function(e,t,o){"use strict";o.d(t,"a",(function(){return A}));var r=o(0),n=o.n(r),a=o(7),i=o(151),c=o(152),l=o(61),s=o(11),d=o(10),m=o(3),h=o(1);const b="wpeform-component-skeleton",u=Object(h.c)(b,"gutter"),g=m.d.div`
	${h.a};
	&.${b}--large {
		margin-bottom: ${e=>Object(h.g)(e.theme.gutter)};
	}
	&.${b}--small {
		margin-bottom: ${e=>Object(h.g)(e.theme.gutter/2)};
	}
	&.${b}--para {
		margin-bottom: ${e=>Object(h.g)(.75*e.theme.fz.base)};
	}
	&.${b}--h1 {
		margin-bottom: ${e=>Object(h.g)(1.5*e.theme.fz.large5*.6)};
	}
	&.${b}--h2 {
		margin-bottom: ${e=>Object(h.g)(1.5*e.theme.fz.large3*.6)};
	}
	&.${b}--h3 {
		margin-bottom: ${e=>Object(h.g)(1.5*e.theme.fz.large2*.6)};
	}
	&.${b}--h4 {
		margin-bottom: ${e=>Object(h.g)(1.5*e.theme.fz.base*.6)};
	}
	&.${b}--h5 {
		margin-bottom: ${e=>Object(h.g)(1.5*e.theme.fz.small1*.6)};
	}
	&.${b}--h6 {
		margin-bottom: ${e=>Object(h.g)(1.5*e.theme.fz.small2*.6)};
	}
	&.${b}--mb {
		margin-bottom: ${e=>{var t;return Object(h.g)(null!==(t=e.marginBottom)&&void 0!==t?t:0)}};
	}
	&:last-child {
		margin-bottom: 0;
	}
	&.${b}--inline {
		display: inline-block;
		margin-left: 0.25em;
		margin-right: 0.25em;
		vertical-align: middle;
		&:first-child {
			margin-left: 0;
		}
		&:last-child {
			margin-right: 0;
		}
	}
`,p=m.e`
	0% {
		background-position: 100% 50%;
	}

	100% {
		background-position: 0 50%;
	}
`,f=m.d.div`
	background-image: linear-gradient(
		90deg,
		${e=>Object(d.a)(.01,e.theme.backgroundControl)} 25%,
		${e=>Object(d.a)(.05,e.theme.backgroundControl)} 37%,
		${e=>Object(d.a)(.01,e.theme.backgroundControl)} 63%
	);
	background-size: 400% 100%;
	animation: ${p} 1.4s ease infinite;
	will-change: background-position;
	&.${u}--shape-rectangle {
		border-radius: ${e=>Object(h.g)(e.theme.borderRadiusBase)};
	}
	&.${u}--shape-circle {
		border-radius: 50%;
	}
	max-width: 100%;
	&.${u}--color-darker {
		background-image: linear-gradient(
			90deg,
			${e=>Object(d.a)(.03,e.theme.backgroundControl)} 25%,
			${e=>Object(d.a)(.08,e.theme.backgroundControl)} 37%,
			${e=>Object(d.a)(.03,e.theme.backgroundControl)} 63%
		);
	}
	&.${u}--inline {
		display: inline-block;
		vertical-align: middle;
	}
`;function E(e){const t=e.height,o=e.shape,r=e.width,a=e.className,i=e.marginBottom,c=e.color,l=void 0===c?"normal":c,s=e.inline,d=void 0!==s&&s,m={};"string"==typeof i?m[`${i}`]=!0:"number"==typeof i&&(m.mb=!0),m.inline=d;const p=Object(h.b)(b,m,a),E=Object(h.b)(u,{[`shape-${o}`]:!0,[`color-${l}`]:!0,inline:d},a);return n.a.createElement(g,{className:p,marginBottom:"number"==typeof i?i:void 0},n.a.createElement(f,{className:E,style:{width:"number"==typeof r?Object(h.g)(r):r,height:"number"==typeof t?Object(h.g)(t):t}}))}function O(e){const t=Object(m.f)(),o=e.width,r=e.className,a=e.marginBottom,i=e.inline;return n.a.createElement(E,{marginBottom:"number"==typeof a?a:"para",width:o,height:1.5*t.fz.base,shape:"rectangle",className:r,inline:i})}function $(e){const t=Object(m.f)(),o=e.width,r=e.level,a=e.className,i=e.marginBottom;let c=1.5*t.fz.large5;return 2===r?c=1.5*t.fz.large3:3===r?c=1.5*t.fz.large2:4===r?c=1.5*t.fz.large1:5===r?c=1.5*t.fz.small1:6===r&&(c=1.5*t.fz.small2),n.a.createElement(E,{marginBottom:"number"==typeof i?i:`h${r}`,width:o,height:c,shape:"rectangle",className:a})}function w(e){const t=e.className,o=Object(m.f)(),r=Object(h.e)(.7*o.controlHeightBase);return n.a.createElement(E,{height:r,width:r,className:t,shape:"rectangle"})}function x(e){const t=e.className,o=Object(m.f)(),r=Object(h.e)(.7*o.controlHeightBase);return n.a.createElement(E,{height:r,width:r,className:t,shape:"circle"})}const j=m.d.div`
	display: flex;
	flex-flow: row nowrap;
	align-items: center;
	justify-content: flex-start;
`,C=m.d.div`
	flex: 0 0
		${e=>Object(h.g)(Object(h.e)(.7*e.theme.controlHeightBase))};
	margin: 0 ${e=>Object(h.g)(e.theme.gutter/2)} 0 0;
`,y=m.d.div`
	flex: 1 0 auto;
`,v=Object(h.c)(b,"mcq-option");const k=Object(h.c)(b,"label"),B=m.d.div`
	margin: 0 0 ${e=>Object(h.g)(e.theme.gutter/2)} 0;
`;E.Paragraph=O,E.Heading=$,E.Avatar=function(e){return n.a.createElement(E,Object.assign({},e,{width:e.height,shape:"circle"}))},E.Checkbox=w,E.Radio=x,E.Text=function(e){const t=Object(m.f)();return n.a.createElement(E,Object.assign({height:t.controlHeightBase,shape:"rectangle",width:"100%"},e))},E.Textarea=function(e){const t=Object(m.f)();return n.a.createElement(E,Object.assign({height:4*t.controlHeightBase,shape:"rectangle",width:"100%"},e))},E.MCQOption=function(e){const t=Object(m.f)(),o=e.className,r=e.type,a=e.width,i=t.fz.base;return n.a.createElement(j,{className:Object(h.b)(v,{[`type-${r}`]:!0},o)},n.a.createElement(C,null,"radio"===r?n.a.createElement(x,null):n.a.createElement(w,null)),n.a.createElement(y,null,n.a.createElement(E,{shape:"rectangle",height:i,width:a})))},E.Label=function(e){const t=Object(m.f)(),o=e.titleWidth,r=e.subtitleWidth,a=e.className;return n.a.createElement(B,{className:Object(h.b)(k,void 0,a)},n.a.createElement(O,{width:o,marginBottom:t.gutter/4}),n.a.createElement($,{width:r,marginBottom:t.fz.base-t.fz.small2,level:6}))};var T=o(17),F=o(29);const S=i.a`
	query FormsForSelector {
		forms(
			filter: { resourceView: OWNED }
			pagination: { with: OFFSET, first: 9999, orderby: "id", page: 1 }
		) {
			edges {
				node {
					id
					name
				}
			}
		}
	}
`;function A(e){const t=Object(c.a)(S),o=t.data,i=t.loading,d=t.error,m=e.value,h=e.onChange,b=e.label,u=void 0===b?Object(a.__)("Select a Form","wp-eform"):b,g=Object(r.useMemo)((()=>{var e;return null!=o&&null!==(e=o.forms)&&void 0!==e&&e.edges.length?o.forms.edges.map((e=>({label:e.node.name,plain:e.node.name,value:e.node.id}))):[]}),[o]);return n.a.createElement(F.a,{label:u},(e=>d?Object(a.__)("Could not load forms. Please refresh the page.","wp-eform"):i?n.a.createElement(E.Text,null):n.a.createElement(l.a,{items:g,mode:s.c.SINGLE,onChange:e=>{e[0]?h(e[0]):h("")},value:""===m?[]:[m],placeholder:Object(a.__)("please select a form","wp-eform"),controlType:s.f.BOXY,id:e,prefix:n.a.createElement(T.b,{iconClass:"fas fa-clipboard"})})))}},87:function(e,t){e.exports=window.wp.blocks},88:function(e,t){e.exports=window.wp.blockEditor},89:function(e){e.exports=JSON.parse('{"form":{"name":"wp-eform/form","attributes":{"formId":{"type":"string","default":""}}},"userPortal":{"name":"wp-eform/user-portal","attributes":{}},"summary":{"name":"wp-eform/summary","attributes":{}}}')}},[[121,0,1]]]);
//# sourceMappingURL=blocks-2a3223cc.js.map