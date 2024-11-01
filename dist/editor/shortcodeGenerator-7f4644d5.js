/*! For license information please see shortcodeGenerator-7f4644d5.js.LICENSE.txt */
(window.wpackiowpqEformeditorJsonp=window.wpackiowpqEformeditorJsonp||[]).push([[3],{0:function(e,t){e.exports=window.React},1:function(e,t,o){"use strict";o.d(t,"b",(function(){return i})),o.d(t,"c",(function(){return l})),o.d(t,"i",(function(){return c})),o.d(t,"g",(function(){return d})),o.d(t,"d",(function(){return s})),o.d(t,"a",(function(){return m})),o.d(t,"f",(function(){return b})),o.d(t,"h",(function(){return h})),o.d(t,"e",(function(){return u}));var r=o(3),a=o(23),n=o.n(a);o(65),o(10),o(0);function i(e,t,o){const r={};return t&&Object.keys(t).forEach((o=>{r[`${e}--${o}`]=!!t[o]})),n()(e,o,r)}function l(e,t,o){return n()(`${e}__${t}`,o)}function c(e,t,o={},a){const n=Object(r.f)().breakpoints;return i(t,{...o,"size-mobile":!0,"size-tablet":e.width>=n.tablet,"size-desktop":e.width>=n.desktop,"size-desktopHd":e.width>=n.desktopHd},a)}function d(e,t="px"){return`${e}${t}`}function s(e,t,o){const r=[...e];return o&&r.push(...o),`${function(e,t){return e.map((e=>`${e} ${t}`)).join(", ")}(e,t)}; will-change: ${r.join(", ")};`}const m=r.c`
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
`,b=r.c`
	appearance: none;
	box-sizing: content-box;
`,h=(r.c`
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
		font-size: ${e=>d(e.theme.fz.large5/e.theme.fz.base,"em")};
		line-height: 1.2;
	}
	h2 {
		font-size: ${e=>d(e.theme.fz.large3/e.theme.fz.base,"em")};
	}
	h3 {
		font-size: ${e=>d(e.theme.fz.large2/e.theme.fz.base,"em")};
	}
	h4 {
		font-size: ${e=>d(e.theme.fz.large1/e.theme.fz.base,"em")};
	}
	h5 {
		font-size: ${e=>d(e.theme.fz.small1/e.theme.fz.base,"em")};
	}
	h6 {
		font-size: ${e=>d(e.theme.fz.small2/e.theme.fz.base,"em")};
	}
	/* Tables */
	table {
		margin-top: ${e=>d(e.theme.gutter)};
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
		height: ${e=>d(e.theme.gutter/2)};
	}
`,f=(r.c`
	${p}
	${g};
`,r.c`
	overflow-y: scroll;
	&::-webkit-scrollbar {
		background-color: ${e=>e.theme.backgroundHover};
		width: ${e=>d(e.theme.gutter/2)};
	}
`);r.c`
	${f};
	${g};
`,r.c`
	overflow: scroll;
	&::-webkit-scrollbar {
		background-color: ${e=>e.theme.backgroundHover};
		&:horizontal {
			height: ${e=>d(e.theme.gutter/2)};
		}
		&:vertical {
			width: ${e=>d(e.theme.gutter/2)};
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
`},11:function(e,t,o){"use strict";let r,a,n,i,l,c,d,s,m,b,h,u,g,p,f,$,E,O,y,w,C,j,x,v,k,B,S,T,F,A,N,R,L,H,I,_,z,D,P,M;o.d(t,"a",(function(){return O})),o.d(t,"b",(function(){return C})),o.d(t,"c",(function(){return A})),o.d(t,"d",(function(){return N})),o.d(t,"e",(function(){return R})),o.d(t,"f",(function(){return H})),function(e){e.AFTER="AFTER",e.BEFORE="BEFORE"}(r||(r={})),function(e){e.BLANK="BLANK",e.POPUP="POPUP",e.SELF="SELF"}(a||(a={})),function(e){e.HIDE_FIELDS="HIDE_FIELDS",e.HIDE_PAGES="HIDE_PAGES",e.SET_VALUE_OF="SET_VALUE_OF",e.SHOW_FIELDS="SHOW_FIELDS",e.SHOW_PAGES="SHOW_PAGES"}(n||(n={})),function(e){e.ALWAYS="ALWAYS",e.AUTO="AUTO",e.OFF="OFF"}(i||(i={})),function(e){e.CONTAINS="CONTAINS",e.ENDS_WITH="ENDS_WITH",e.EQUALS_TO="EQUALS_TO",e.GREATER_THAN="GREATER_THAN",e.LESS_THAN="LESS_THAN",e.STARTS_WITH="STARTS_WITH"}(l||(l={})),function(e){e.LENGTH="LENGTH",e.VALUE="VALUE"}(c||(c={})),function(e){e.IS="IS",e.ISNOT="ISNOT"}(d||(d={})),function(e){e.AND="AND",e.OR="OR"}(s||(s={})),function(e){e.CHOICE="CHOICE",e.DESIGN="DESIGN",e.INPUT="INPUT",e.SECURITY="SECURITY"}(m||(m={})),function(e){e.NEXT_ON_ALL_VALID="NEXT_ON_ALL_VALID",e.NONE="NONE",e.ONLY_WHEN_ALL_VALID="ONLY_WHEN_ALL_VALID"}(b||(b={})),function(e){e.ONETIME="ONETIME",e.SUBSCRIPTION="SUBSCRIPTION"}(h||(h={})),function(e){e.PERCENTAGE="PERCENTAGE",e.VALUE="VALUE"}(u||(u={})),function(e){e.FIXED="FIXED",e.LOCAL="LOCAL",e.SCROLL="SCROLL"}(g||(g={})),function(e){e.BORDER_BOX="BORDER_BOX",e.CONTENT_BOX="CONTENT_BOX",e.PADDING_BOX="PADDING_BOX"}(p||(p={})),function(e){e.REPEAT_BOTH="REPEAT_BOTH",e.REPEAT_NONE="REPEAT_NONE",e.REPEAT_X="REPEAT_X",e.REPEAT_Y="REPEAT_Y"}(f||(f={})),function(e){e.LOGGED_IN="LOGGED_IN",e.LOGGED_OUT="LOGGED_OUT",e.NONE="NONE"}($||($={})),function(e){e.CENTER="CENTER",e.JUSTIFY="JUSTIFY",e.LEFT="LEFT",e.RIGHT="RIGHT"}(E||(E={})),function(e){e.DEFAULT="DEFAULT",e.LARGE="LARGE",e.SMALL="SMALL"}(O||(O={})),function(e){e.SIZE1="SIZE1",e.SIZE2="SIZE2",e.SIZE3="SIZE3",e.SIZE4="SIZE4",e.SIZE5="SIZE5",e.SIZE6="SIZE6"}(y||(y={})),function(e){e.H1="H1",e.H2="H2",e.H3="H3",e.H4="H4",e.H5="H5",e.H6="H6",e.P="P"}(w||(w={})),function(e){e.NONE="NONE",e.PRESET="PRESET",e.REGEXP="REGEXP",e.STRING="STRING"}(C||(C={})),function(e){e.EQUALS_TO="EQUALS_TO",e.GREATER_THAN="GREATER_THAN",e.LESS_THAN="LESS_THAN"}(j||(j={})),function(e){e.AUTO="AUTO",e.FOUR="FOUR",e.ONE="ONE",e.THREE="THREE",e.TWO="TWO"}(x||(x={})),function(e){e.CURSOR="CURSOR",e.OFFSET="OFFSET"}(v||(v={})),function(e){e.META="META",e.NONE="NONE",e.URL="URL"}(k||(k={})),function(e){e.CONDITIONAL="CONDITIONAL",e.FLAT="FLAT",e.NONE="NONE",e.PORTAL="PORTAL",e.SCOREPERCENTAGE="SCOREPERCENTAGE",e.SCORETOTAL="SCORETOTAL",e.SUBMISSION="SUBMISSION"}(B||(B={})),function(e){e.ALL="ALL",e.OWNED="OWNED",e.SHARED="SHARED",e.TRASHED="TRASHED"}(S||(S={})),function(e){e.PERCENTAGE="PERCENTAGE",e.VALUE="VALUE"}(T||(T={})),function(e){e.ADD="ADD",e.SUBTRACT="SUBTRACT"}(F||(F={})),function(e){e.MULTIPLE="MULTIPLE",e.SINGLE="SINGLE"}(A||(A={})),function(e){e.FIXED="FIXED",e.FLUID="FLUID"}(N||(N={})),function(e){e.CENTER="CENTER",e.LEFT="LEFT",e.RIGHT="RIGHT"}(R||(R={})),function(e){e.HORIZONTAL="HORIZONTAL",e.INLINE="INLINE",e.VERTICAL="VERTICAL"}(L||(L={})),function(e){e.BOXY="BOXY",e.MATERIAL="MATERIAL"}(H||(H={})),function(e){e.BOTTOM="BOTTOM",e.TOP="TOP"}(I||(I={})),function(e){e.DAY="DAY",e.MONTH="MONTH",e.WEEK="WEEK"}(_||(_={})),function(e){e.NONE="NONE",e.OVERALL="OVERALL",e.PAGE_SPECIFIC="PAGE_SPECIFIC"}(z||(z={})),function(e){e.NOT_TRASHED="NOT_TRASHED",e.TRASHED="TRASHED"}(D||(D={})),function(e){e.ALL="ALL",e.EMAIL="EMAIL",e.INTEGER="INTEGER",e.NOLETTER="NOLETTER",e.NONUMBER="NONUMBER",e.NUMBER="NUMBER",e.PHONE="PHONE",e.URL="URL"}(P||(P={})),function(e){e.FULL="FULL",e.HALF="HALF",e.MANUAL="MANUAL",e.ONEFOURTH="ONEFOURTH",e.ONETHIRD="ONETHIRD",e.THREEFOURTH="THREEFOURTH",e.TWOTHIRD="TWOTHIRD"}(M||(M={}))},127:function(e,t,o){o(102),e.exports=o(138)},138:function(e,t,o){"use strict";o.r(t);var r=o(0),a=o.n(r),n=o(42),i=o.n(n),l=o(150),c=(o(97),o(11));o(62),o(60);var d=o(70),s=o(14),m=o(7),b=o(61),h=o(48),u=o(116);const g=Object(r.createContext)(!1);function p(e){const t=e.cssHandles,o=Object(r.useState)([]),n=Object(s.a)(o,2),i=n[0],l=n[1];return Object(r.useEffect)((()=>{const e=[];t&&"undefined"!=typeof window&&t.forEach((t=>{const o=document.querySelector(`#${t}-css`);if(o){const a=o.getAttribute("href");var r;if(a)e.push({id:t,href:a,media:null!==(r=o.getAttribute("media"))&&void 0!==r?r:"all"})}})),l(e)}),[t]),a.a.createElement(a.a.Fragment,null,i.map((e=>a.a.createElement("link",{key:e.id,rel:"stylesheet",href:e.href,media:e.media}))))}function f(){const e="undefined"!=typeof WPEFormGraphQLApp?WPEFormGraphQLApp:{customCSS:void 0,customStyleLinks:void 0},t=e.customCSS,o=e.customStyleLinks;return a.a.createElement(a.a.Fragment,null,t?a.a.createElement("style",{type:"text/css",dangerouslySetInnerHTML:{__html:t}}):null,o?o.map((e=>a.a.createElement("link",{rel:"stylesheet",href:e,key:e}))):null)}function $(e){const t=e.children,o=e.inShadow,n=e.cssHandles,i=Object(r.useState)(!1),l=Object(s.a)(i,2),c=l[0],d=l[1];return Object(r.useEffect)((()=>{d(!0)}),[]),a.a.createElement(g.Provider,{value:o},c?a.a.createElement(a.a.Fragment,null,a.a.createElement(f,null),o?a.a.createElement(p,{cssHandles:n}):null):null,t)}$.LinkAllAssets=function(e){const t=e.body,o=void 0!==t&&t,n=e.head,i=void 0===n||n,l=Object(r.useState)([]),c=Object(s.a)(l,2),d=c[0],m=c[1];return Object(r.useEffect)((()=>{const e=[];let t;const r='link[rel="stylesheet"]';t=i&&o?document.querySelectorAll(r):i?document.head.querySelectorAll(r):document.body.querySelectorAll(r),t.length&&t.forEach((t=>{const o=t.getAttribute("href");var r,a;o&&e.push({id:null!==(r=t.getAttribute("id"))&&void 0!==r?r:Object(u.a)(),href:o,media:null!==(a=t.getAttribute("media"))&&void 0!==a?a:"all"})})),m(e)}),[o,i]),a.a.createElement(a.a.Fragment,null,d.map((e=>a.a.createElement("link",{key:e.id,rel:"stylesheet",href:e.href,media:e.media}))))};var E=o(29),O=o(32),y=o(30),w=o(73),C=o(19),j=o(3),x=o(23),v=o.n(x),k=o(59),B=o(1),S=o(17),T=o(10);const F="wpeform-component-button",A=Object(B.c)(F,"inner"),N=Object(B.c)(F,"icon"),R=Object(B.c)(F,"text"),L=Object(B.c)(F,"bounce"),H=j.d.div`
	position: absolute;
	left: 0;
	top: 0;
	bottom: 0;
	right: 0;
	display: flex;
	align-items: center;
	justify-content: center;
`,I=j.e`
	0% {
			width: 0;
			opacity: .1
	}

	20% {
			width: 0;
			opacity: .5
	}

	to {
			width: 100%;
			opacity: 0
	}
`,_=j.e`
	0%, 80%, 100% {
			transform: scale(0);
	}
	40% {
			transform: scale(1.0);
	}
`,z=j.d.div`
	position: absolute;
	height: 0.5em;
	left: 0;
	bottom: 0;
	width: 100%;
	background-color: rgba(0, 0, 0, 0.05);
`,D=Object(j.d)(C.animated.div)`
	will-change: width;
	position: absolute;
	height: 0.5em;
	left: 0;
	bottom: 0;
	background-color: rgba(0, 0, 0, 0.15);

	&.active {
		&::before {
			position: absolute;
			top: 0;
			right: 0;
			bottom: 0;
			left: 0;
			background: rgb(255, 255, 255);
			opacity: 0;
			animation: ${I} 1.6s cubic-bezier(0.23, 1, 0.32, 1)
				infinite;
			content: '';
		}
	}
`,P=Object(j.d)(C.animated.div)`
	width: 3em;
	display: flex;
	align-items: center;
	justify-content: center;
	will-change: opacity, transform;
	position: relative;
	.${S.a} {
		font-size: 1.5em;
	}
`,M=j.d.div`
	width: 3em;
	display: flex;
	align-items: center;
	justify-content: space-between;
	transform: translateY(-0.25em);
	position: relative;
	top: 2px; /** Visual adjustment */
	.${L} {
		width: 0.75em;
		height: 0.75em;
		border-radius: 100%;
		display: inline-block;
		background-color: rgba(255, 255, 255, 0.7);
		animation: ${_} 1.4s infinite ease-in-out both;

		&.one {
			animation-delay: -0.32s;
		}
		&.two {
			animation-delay: -0.16s;
		}
	}
`,U=j.d.button`
	${B.a};
	overflow: hidden;
	position: relative;
	display: inline-flex;
	justify-content: center;
	align-items: center;
	max-width: 100%;
	line-height: 1.2;
	cursor: pointer;
	text-decoration: none;

	&:disabled {
		opacity: 0.5;
		cursor: not-allowed;
	}

	.${N} {
		margin-right: 0.25em;
		width: 1.2em;
		text-align: center;
		line-height: 1;
		display: inline-flex;
		justify-content: center;
		align-items: center;

		&.${N}--after {
			margin-left: 0.25em;
			margin-right: 0;
		}
	}

	&.${F}--no-label {
		.${N} {
			margin-left: 0;
			margin-right: 0;
		}
	}

	.${A} {
		display: flex;
		align-items: center;
		justify-content: center;
		flex-flow: row nowrap;
		overflow: hidden;
	}

	.${R} {
		max-width: 100%;
		white-space: pre;
		text-overflow: ellipsis;
	}

	&.${F}--has-icon {
		.${R} {
			max-width: calc(100% - 1.25em);
		}
	}

	&.${F}--is-loading {
		opacity: 1;
		.${A} {
			opacity: 0;
		}
	}

	&:active:not(:disabled) {
		outline: none;
		.${A} {
			transform: scale(0.97);
			transform-origin: center center;
		}
	}

	/** Rounded */
	border-radius: ${e=>Object(B.g)(e.theme.borderRadiusBase)};
	&.${F}--rounded {
		border-radius: ${e=>Object(B.g)(1.2*e.theme.controlHeightBase/2)};
	}

	/** Sizes */
	padding: 0 1.75em;
	height: ${e=>Object(B.g)(1.2*e.theme.controlHeightBase)};
	font-size: ${e=>Object(B.g)(e.theme.fz.base)};
	&.${F}--size-LARGE {
		height: ${e=>Object(B.g)(1.4*e.theme.controlHeightBase)};
		font-size: ${e=>Object(B.g)(e.theme.fz.large1)};
		padding: 0 1.75em;

		&.${F}--rounded {
			border-radius: ${e=>Object(B.g)(1.4*e.theme.controlHeightBase/2)};
		}
	}
	&.${F}--size-SMALL {
		height: ${e=>Object(B.g)(e.theme.controlHeightBase)};
		font-size: ${e=>Object(B.g)(e.theme.fz.small1)};
		padding: 0 1em;
		&.${F}--rounded {
			border-radius: ${e=>Object(B.g)(e.theme.controlHeightBase/2)};
		}
	}
	&.${F}--size-TINY {
		height: ${e=>Object(B.g)(.8*e.theme.controlHeightBase)};
		font-size: ${e=>Object(B.g)(e.theme.fz.small1)};
		padding: 0 0.8em;
		&.${F}--rounded {
			border-radius: ${e=>Object(B.g)(.4*e.theme.controlHeightBase)};
		}
	}

	/** Generic Animations */
	${z} {
		background-color: ${e=>Object(T.c)(.8,e.theme.borderColorBase)};
	}
	${D} {
		background-color: ${e=>Object(T.c)(.5,e.theme.borderColorBase)};
	}
	.${L} {
		background-color: ${e=>Object(T.c)(.5,e.theme.borderColorBase)};
	}
	${P} {
		color: ${e=>Object(T.c)(.5,e.theme.borderColorBase)};
	}
	&.${F}--colorful {
		${z} {
			background-color: ${e=>Object(T.a)(.05,e.theme.primaryLightColor)};
		}
		${D} {
			background-color: ${e=>e.theme.primaryDarkColor};
		}
		.${L} {
			background-color: ${e=>e.theme.primaryDarkColor};
		}
		${P} {
			color: ${e=>e.theme.primaryDarkColor};
		}
	}

	/** Styles, we have hard-dependency on the register for performance */
	/** Otherwise if we pass css prop, then a new class is created for every buttons */
	&.${F}--style-flat {
		background-color: ${e=>e.theme.backgroundShade};
		color: ${e=>e.theme.textColor};
		box-shadow: ${e=>e.theme.boxShadowNoneFocus};
		border: 1px solid ${e=>e.theme.backgroundShade};
		transition: ${e=>Object(B.d)(["background-color","color","box-shadow","border-color"],e.theme.transitionControl)};

		&:not(:disabled):hover,
		&:not(:disabled):focus,
		&:not(:disabled):active {
			background-color: ${e=>e.theme.backgroundHover};
			border-color: ${e=>e.theme.backgroundHover};
			color: ${e=>e.theme.headingColor};
		}

		&:not(:disabled):focus,
		&:not(:disabled):active {
			border-color: ${e=>e.theme.primaryColor};
		}
		&:not(:disabled):not(:active):focus {
			box-shadow: ${e=>e.theme.boxShadowControlFocus};
		}

		&.${F}--colorful {
			background-color: ${e=>e.theme.primaryColor};
			border-color: ${e=>e.theme.primaryColor};
			color: ${e=>e.theme.primaryBgText};

			&:not(:disabled):hover,
			&:not(:disabled):focus,
			&:not(:disabled):active {
				background-color: ${e=>e.theme.primaryLightColor};
				border-color: ${e=>e.theme.primaryLightColor};
				color: ${e=>e.theme.primaryBgText};
			}

			&:not(:disabled):focus,
			&:not(:disabled):active {
				border-color: ${e=>e.theme.primaryColor};
			}
		}
	}
	&.${F}--style-3d {
		background-color: ${e=>e.theme.backgroundShade};
		color: ${e=>e.theme.textColor};
		box-shadow: ${e=>e.theme.boxShadowNoneFocus};
		border: 1px solid ${e=>e.theme.backgroundShade};
		border-bottom: 0.1875em solid ${e=>e.theme.borderColorBase};
		transition: ${e=>Object(B.d)(["background-color","color","box-shadow","border-color"],e.theme.transitionControl)};

		&:not(:disabled):hover,
		&:not(:disabled):focus,
		&:not(:disabled):active {
			background-color: ${e=>e.theme.backgroundHover};
			border-color: ${e=>e.theme.backgroundHover};
			border-bottom-color: ${e=>e.theme.borderColorSplit};
			color: ${e=>e.theme.headingColor};
		}

		&:not(:disabled):focus,
		&:not(:disabled):active {
			border-color: ${e=>e.theme.primaryColor};
		}
		&:not(:disabled):not(:active):focus {
			box-shadow: ${e=>e.theme.boxShadowControlFocus};
		}

		&:not(:disabled):active {
			border-bottom-width: 1px;
		}

		&.${F}--colorful {
			background-color: ${e=>e.theme.primaryColor};
			border-color: ${e=>e.theme.primaryColor};
			border-bottom-color: ${e=>e.theme.primaryDarkColor};
			color: ${e=>e.theme.primaryBgText};

			&:not(:disabled):hover,
			&:not(:disabled):focus,
			&:not(:disabled):active {
				background-color: ${e=>e.theme.primaryLightColor};
				border-color: ${e=>e.theme.primaryLightColor};
				border-bottom-color: ${e=>e.theme.primaryColor};
				color: ${e=>e.theme.primaryBgText};
			}

			&:not(:disabled):focus,
			&:not(:disabled):active {
				border-color: ${e=>e.theme.primaryDarkColor};
			}
		}
	}
	&.${F}--style-gradient {
		background-color: ${e=>Object(T.a)(.1,e.theme.backgroundShade)};
		background-image: linear-gradient(
			to bottom,
			${e=>e.theme.backgroundHover},
			${e=>Object(T.a)(.1,e.theme.backgroundShade)}
		);
		background-size: 100% 150%;
		background-position: bottom 0 left 0;
		color: ${e=>e.theme.textColor};
		box-shadow: ${e=>e.theme.boxShadowNoneFocus};
		border: 1px solid ${e=>e.theme.borderColorBase};
		transition: ${e=>Object(B.d)(["background-position","color","box-shadow","border-color"],e.theme.transitionControl)};

		&:not(:disabled):hover,
		&:not(:disabled):focus,
		&:not(:disabled):active {
			background-position: top 0 left 0;
			color: ${e=>e.theme.headingColor};
		}

		&:not(:disabled):focus,
		&:not(:disabled):active {
			border-color: ${e=>e.theme.primaryColor};
		}
		&:not(:disabled):not(:active):focus {
			box-shadow: ${e=>e.theme.boxShadowControlFocus};
		}

		&.${F}--colorful {
			background-color: ${e=>e.theme.primaryColor};
			background-image: linear-gradient(
				to bottom,
				${e=>e.theme.primaryLightColor},
				${e=>Object(T.a)(.1,e.theme.primaryColor)}
			);
			border-color: ${e=>e.theme.primaryDarkColor};
			color: ${e=>e.theme.primaryBgText};

			&:not(:disabled):hover,
			&:not(:disabled):focus,
			&:not(:disabled):active {
				background-color: ${e=>e.theme.primaryColor};
				border-color: ${e=>e.theme.primaryDarkColor};
				color: ${e=>e.theme.primaryBgText};
			}

			&:not(:disabled):focus,
			&:not(:disabled):active {
				border-color: ${e=>e.theme.primaryDarkColor};
			}
		}
	}
	&.${F}--style-outline {
		background-color: ${e=>e.theme.appBackgroundColor};
		color: ${e=>e.theme.textColor};
		box-shadow: ${e=>e.theme.boxShadowNoneFocus};
		border: 2px solid ${e=>e.theme.borderColorBase};
		transition: ${e=>Object(B.d)(["background-color","color","box-shadow","border-color"],e.theme.transitionControl)};

		&:not(:disabled):hover,
		&:not(:disabled):focus,
		&:not(:disabled):active {
			border-color: ${e=>e.theme.borderColorSplit};
			color: ${e=>e.theme.headingColor};
		}

		&:not(:disabled):focus,
		&:not(:disabled):active {
			border-color: ${e=>e.theme.primaryColor};
		}
		&:not(:disabled):not(:active):focus {
			box-shadow: ${e=>e.theme.boxShadowControlFocus};
		}

		&.${F}--colorful {
			border-color: ${e=>e.theme.primaryColor};
			color: ${e=>e.theme.primaryDarkColor};
			background-color: ${e=>e.theme.primaryBackgroundColor};

			&:not(:disabled):hover,
			&:not(:disabled):focus,
			&:not(:disabled):active {
				border-color: ${e=>e.theme.primaryLightColor};
			}

			&:not(:disabled):focus,
			&:not(:disabled):active {
				border-color: ${e=>e.theme.primaryDarkColor};
				color: ${e=>e.theme.primaryDarkColor};
			}
		}
	}
	&.${F}--style-transparent {
		background-color: ${e=>Object(T.c)(1,e.theme.backgroundHover)};
		color: ${e=>e.theme.textColor};
		box-shadow: none;
		border: 0 none;
		transition: ${e=>Object(B.d)(["background-color","color"],e.theme.transitionControl)};

		&:not(:disabled):hover,
		&:not(:disabled):focus,
		&:not(:disabled):active {
			background-color: ${e=>e.theme.backgroundHover};
			color: ${e=>e.theme.headingColor};
		}

		&:not(:disabled):focus,
		&:not(:disabled):active {
			background-color: ${e=>e.theme.backgroundHover};
		}
		&:not(:disabled):not(:active):focus {
			background-color: ${e=>e.theme.backgroundHover};
		}

		&.${F}--colorful {
			background-color: ${e=>Object(T.c)(1,e.theme.primaryBackgroundColor)};

			&:not(:disabled):hover,
			&:not(:disabled):focus,
			&:not(:disabled):active {
				background-color: ${e=>e.theme.primaryBackgroundColor};
			}

			&:not(:disabled):focus,
			&:not(:disabled):active {
				background-color: ${e=>e.theme.primaryBackgroundColor};
				color: ${e=>e.theme.primaryDarkColor};
			}
		}
	}
`;j.d.div`
	display: flex;
	flex-flow: row wrap;
	align-items: center;
	justify-content: center;
	> .${F} {
		flex: 0 0 auto;
		margin: ${e=>Object(B.g)(e.theme.gutter/4)};
	}
`;function G(e){const t=e.loadedState,o=Object(j.f)(),r=Object(C.useSpring)({from:{opacity:0,transform:"scale(0, 0) translate(0, -0.25em)"},config:o.springConfigGeneral,to:{opacity:1,transform:"scale(1, 1) translate(0, -0.25em)"}});return a.a.createElement(P,{style:r},a.a.createElement(S.b,{iconClass:"error"===t?"fas fa-exclamation":"fas fa-check"}))}function W(e){const t=e.loadingDone,o=e.loadedState,n=Object(j.f)(),i=Object(r.useState)(0),l=Object(s.a)(i,2),c=l[0],d=l[1],m=Object(C.useSpring)({width:`${c}%`,config:n.springConfigSlow});return Object(r.useEffect)((()=>{let e=!0;if(t)return d(100),()=>{e=!1};d(24);const o=window.setInterval((()=>{e&&d((e=>e<24?24:e<50?50:e<86?86:96))}),3e3);return()=>{e=!1,window.clearInterval(o)}}),[t]),a.a.createElement(H,null,a.a.createElement(z,null),a.a.createElement(D,{style:m,className:t?"":"active"}),t?a.a.createElement(G,{loadedState:o}):a.a.createElement(M,null,a.a.createElement("div",{className:v()(L,"one")}),a.a.createElement("div",{className:v()(L,"two")}),a.a.createElement("div",{className:v()(L,"three")})))}function X(e){const t=e.size,o=void 0===t?c.a.DEFAULT:t,r=e.style,n=e.rounded,i=void 0!==n&&n,l=e.colorful,d=void 0===l||l,m=e.children,b=e.icon,h=e.disabled,u=void 0!==h&&h,g=e.iconPosition,p=void 0===g?"before":g,f=e.onClick,$=e.className,E=e.loading,O=e.loadingDone,y=void 0!==O&&O,w=e.loadedState,C=void 0===w?"success":w,j=e.asLink,x=void 0!==j&&j,v=e.href,T=e.linkTarget,L=void 0===T?"_self":T,H=e.title,I=Object(k.a)({darkBg:!!d&&"outline"!==r}),_=Object(s.a)(I,2),z=_[0],D=_[1],P=Object(B.b)(F,{rounded:i,colorful:d,[`size-${o}`]:!0,[`style-${r}`]:!0,"has-icon":!!b,"is-loading":!!E,"no-label":!m},$),M=a.a.createElement(a.a.Fragment,null,D,a.a.createElement("span",{className:A},b&&"before"===p?a.a.createElement("span",{className:Object(B.b)(N,{before:!0})},a.a.createElement(S.b,{iconClass:b})):null,m?a.a.createElement("span",{className:R},m):null,b&&"after"===p?a.a.createElement("span",{className:Object(B.b)(N,{after:!0})},a.a.createElement(S.b,{iconClass:b})):null),E?a.a.createElement(W,{loadingDone:y,loadedState:C,colorful:d}):null);return x&&v?a.a.createElement(U,{as:"a",href:v,className:P,onClick:e=>{z(e)},target:L,title:H},M):a.a.createElement(U,{type:"button",className:P,onClick:e=>{e.preventDefault(),z(e),f&&f(e)},disabled:u||!0===E,title:H},M)}const Y=window.top.tinymce;function V(e){const t=Object(r.useState)(""),o=Object(s.a)(t,2),n=o[0],i=o[1];return a.a.createElement(a.a.Fragment,null,a.a.createElement(w.a,{value:n,onChange:i}),a.a.createElement(E.a,null,a.a.createElement(X,{onClick:()=>{if(""===n)return;const e=`[wpeform_form id="${n}"]`;Y.activeEditor.insertContent(e),Y.activeEditor.windowManager.close()},style:"3d",colorful:!0,disabled:""===n,size:c.a.SMALL},Object(m.__)("INSERT SHORTCODE","wp-eform"))))}var q=o(68);const Z=window.top.tinymce;function Q(e){return a.a.createElement(a.a.Fragment,null,a.a.createElement(E.a,null,q.b),a.a.createElement(E.a,null,a.a.createElement(X,{onClick:()=>{Z.activeEditor.insertContent("[wpeform_summary]"),Z.activeEditor.windowManager.close()},style:"3d",colorful:!0,size:c.a.SMALL},Object(m.__)("INSERT SHORTCODE","wp-eform"))))}var J=o(69);const K=window.top.tinymce;function ee(e){return a.a.createElement(a.a.Fragment,null,a.a.createElement(E.a,null,J.b),a.a.createElement(E.a,null,a.a.createElement(X,{onClick:()=>{K.activeEditor.insertContent("[wpeform_userportal]"),K.activeEditor.windowManager.close()},style:"3d",colorful:!0,size:c.a.SMALL},Object(m.__)("INSERT SHORTCODE","wp-eform"))))}const te=[{label:Object(m.__)("Insert a form","wp-eform"),plain:Object(m.__)("Insert a form","wp-eform"),value:"form"},{label:Object(m.__)("Embed summary page shortcode","wp-eform"),plain:Object(m.__)("Embed summary page shortcode","wp-eform"),value:"summary"},{label:Object(m.__)("Embed user portal page shortcode","wp-eform"),plain:Object(m.__)("Embed user portal page shortcode","wp-eform"),value:"user-portal"}];function oe(e){const t=e.cssHandles,o=e.inShadow,n=Object(r.useState)(""),i=Object(s.a)(n,2),l=i[0],d=i[1];return a.a.createElement($,{inShadow:o,cssHandles:t},a.a.createElement(O.a,null,a.a.createElement(h.a,{width:"600px"},a.a.createElement(y.a,{heading:Object(m.__)("Generate Shortcode","wp-eform")},a.a.createElement(E.a,{label:Object(m.__)("Select a purpose","wp-eform")},(e=>a.a.createElement(b.a,{id:e,mode:c.c.SINGLE,controlType:c.f.BOXY,placeholder:Object(m.__)("please select a purpose","wp-eform"),items:te,value:""===l?[]:[l],showSearch:!1,onChange:e=>{e.length?d(e[0]):d("")}}))),"form"===l?a.a.createElement(V,null):"summary"===l?a.a.createElement(Q,null):"user-portal"===l?a.a.createElement(ee,null):null))))}document.addEventListener("DOMContentLoaded",(()=>{document.querySelectorAll(".wp-eform-shortcodegenerator-holder").forEach((e=>{const t=function(e){const t=e.dataset.cssHandles;let o=[];try{const e=JSON.parse(null!=t?t:"");Array.isArray(e)&&(o=e.filter((e=>"string"==typeof e)))}catch(e){}return o}(e),o=a.a.createElement(l.a,{client:d.a},a.a.createElement(oe,{inShadow:!0,cssHandles:t}));e.innerHTML?i.a.hydrate(o,e):i.a.render(o,e)}))}))},17:function(e,t,o){"use strict";o.d(t,"a",(function(){return s})),o.d(t,"b",(function(){return b}));var r=o(0),a=o.n(r),n=o(3),i=o(23),l=o.n(i),c=o(49),d=o(82);const s="wpeform-icon",m=n.d.span`
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
	${c.a.css()}
`;function b(e){const t=e.iconClass,o=e.children,n=void 0===o?null:o,i=e.component,c=e.className,b=e.title;let h=!1;const u=[];let g="";if(null!=t&&t.startsWith("fas ")||null!=t&&t.startsWith("fab ")||null!=t&&t.startsWith("far ")){const e=t.split(" ");e.length>=2&&e[1]&&(u.push(e[0]),u.push(e[1].replace("fa-","")),h=!0,e.length>2&&(g=e.slice(2).join(" ")))}return a.a.createElement(m,{role:"img","aria-hidden":!e["aria-label"]||void 0,"aria-label":e["aria-label"],className:l()(s,h?g:t,{"is-fallback-antd":!!i,anticon:!!i},c),title:b},i?Object(r.createElement)(i,{}):h?a.a.createElement(d.a,{icon:u}):n)}},29:function(e,t,o){"use strict";o.d(t,"a",(function(){return u}));var r=o(0),a=o.n(r),n=o(3),i=o(33),l=o(1),c=o(31);const d="wpeform-blockcomponent-label",s=Object(l.c)(d,"label"),m=Object(l.c)(d,"body"),b=n.d.div`
	padding: ${e=>Object(l.g)(e.theme.gutter)};
	border-bottom: 1px solid ${e=>e.theme.borderColorSplit};

	&:last-child {
		border-bottom: 0 none;
	}

	> .${m} > .${c.a} {
		padding: 0;
	}
`,h=n.d.label`
	display: block;
	margin: 0 0 ${e=>Object(l.g)(e.theme.gutter/2)} 0;
	padding: 0;
	color: ${e=>e.theme.headingColor};
	font-size: ${e=>Object(l.g)(e.theme.fz.small1)};
	line-height: 1;
	font-weight: 600;
	text-transform: uppercase;
`;function u(e){const t=e.label,o=e.children,r=Object(i.c)();return a.a.createElement(b,{className:d},t?a.a.createElement(h,{htmlFor:r,className:s},t):null,a.a.createElement("div",{className:m},"function"==typeof o?o(r):o))}},30:function(e,t,o){"use strict";o.d(t,"a",(function(){return O}));var r=o(7),a=o(0),n=o.n(a),i=o(1),l=o(3),c=o(10);const d="wpeform-blockcomponent-panel",s=Object(i.c)(d,"heading"),m=Object(i.c)(d,"title"),b=Object(i.c)(d,"titlecontent"),h=Object(i.c)(d,"titleseparator"),u=Object(i.c)(d,"body"),g=l.d.div`
	background-color: ${e=>e.theme.appBackgroundColor};
	margin: 0;
	padding: 0;
	border-radius: ${e=>Object(i.g)(e.theme.borderRadiusBase)};
`,p=l.d.div`
	background-color: ${e=>e.theme.primaryColor};
	padding: ${e=>Object(i.g)(e.theme.gutter/2)}
		${e=>Object(i.g)(e.theme.gutter)};
	border-top-left-radius: ${e=>Object(i.g)(e.theme.borderRadiusBase)};
	border-top-right-radius: ${e=>Object(i.g)(e.theme.borderRadiusBase)};
`,f=l.d.h3`
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
`,$=l.d.span`
	text-transform: none;
	color: ${e=>Object(c.b)(.5,e.theme.primaryColor)};
	font-size: 12px;
`,E=l.d.div`
	border: 1px solid ${e=>e.theme.borderColorSplit};
	border-top: 0 none;
	border-bottom-left-radius: ${e=>Object(i.g)(e.theme.borderRadiusBase)};
	border-bottom-right-radius: ${e=>Object(i.g)(e.theme.borderRadiusBase)};
`;function O(e){return n.a.createElement(g,{className:d},n.a.createElement(p,{className:s},n.a.createElement(f,{className:m},n.a.createElement("span",{className:b},e.heading),n.a.createElement($,{className:h},Object(r.__)("WPEForm","wp-eform")))),n.a.createElement(E,{className:u},e.children))}},31:function(e,t,o){"use strict";o.d(t,"a",(function(){return l})),o.d(t,"b",(function(){return d}));var r=o(0),a=o.n(r),n=o(3),i=o(1);const l="wpeform-blockcomponent-feedback",c=n.d.div`
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
`;function d(e){const t=e.children;return a.a.createElement(c,{className:l},t)}},32:function(e,t,o){"use strict";o.d(t,"a",(function(){return l}));var r=o(0),a=o.n(r),n=o(3),i=o(62);function l(e){const t=e.children;return a.a.createElement(n.a,{theme:i.a.getItem("wp").config},t)}},33:function(e,t,o){"use strict";o.d(t,"a",(function(){return i})),o.d(t,"c",(function(){return l})),o.d(t,"b",(function(){return c}));var r=o(14),a=o(0),n=o(116);function i(){const e=Object(a.useRef)(!1);return Object(a.useEffect)((()=>(e.current=!0,()=>{e.current=!1})),[]),e}function l(){const e=Object(a.useState)(n.a);return Object(r.a)(e,1)[0]}function c(e){const t=Object(a.useRef)();return Object(a.useEffect)((()=>{t.current=e}),[e]),t.current}},42:function(e,t){e.exports=window.ReactDOM},47:function(e,t,o){"use strict";o.d(t,"a",(function(){return n}));var r=o(43),a=o(116);class n{constructor(e,t=null){Object(r.a)(this,"collections",{}),Object(r.a)(this,"collectionOrder",[]),Object(r.a)(this,"changeCallbacks",[]),Object(r.a)(this,"collector",null),this.name=e,this.collector=t}subscribeToChanges(e){const t=Object(a.a)();return this.changeCallbacks.push({id:t,callback:e}),t}unsubscribeFromChanges(e){this.changeCallbacks=this.changeCallbacks.filter((t=>t.id!==e))}addItem(e,t,o){if(this.collections[e])throw new Error(`Collection ${this.name} with item ${e} already exists.`);this.collections[e]=this.collector?this.collector(t):t,o?function(e,t,o){-1===o?e.push(t):e.splice(o,0,t)}(this.collectionOrder,e,o):this.collectionOrder.push(e)}replaceItem(e,t){if(!this.collections[e])throw new Error(`Collection ${this.name} with item ${e} does not exist.`);this.collections[e]=this.collector?this.collector(t):t,this.changeCallbacks.forEach((t=>{t.callback(e)}))}addWithoutCollector(e,t){if(this.collections[e])throw new Error(`Collection ${this.name} with item ${e} already exists.`);this.collections[e]=t,this.collectionOrder.push(e)}getItem(e){if(!this.collections[e])throw new Error(`Collection ${this.name} does not have item ${e}.`);return this.collections[e]}hasItem(e){return!!this.collections[e]}deleteItem(e){const t=this.collectionOrder.findIndex((t=>t===e));if(-1===t)throw new Error(`Collection ${this.name} does not have item ${e}.`);this.collectionOrder.splice(t,1),delete this.collections[e]}getItems(e=[],t=[],o){return this.collectionOrder.filter((r=>!(o&&!o(this.collections[r],r))&&function(e,t=[],o=[]){return!(t.length&&!t.includes(e)||o.length&&o.includes(e))}(r,e,t))).map((e=>({id:e,item:this.collections[e]})))}resetItems(){this.collectionOrder=[],this.collections={}}}},48:function(e,t,o){"use strict";o.d(t,"b",(function(){return g})),o.d(t,"a",(function(){return w}));var r=o(0),a=o.n(r),n=o(65),i=o.n(n),l=o(3),c=o(1),d=o(11),s=o(42);const m="wpeform-responsive-container",b=Object(r.createContext)({height:0,width:0});const h=Object(r.createContext)({current:null});const u=Object(r.createContext)({current:null});function g(){return Object(r.useContext)(u)}const p=l.c`
	max-width: 100%;
	width: 100%;
	margin: 0 auto;
`,f=l.c`
	@media screen and (min-width: ${e=>Object(c.g)(e.theme.breakpoints.tablet)}) {
		max-width: ${e=>Object(c.g)(e.theme.breakpoints.tablet)};
	}
	@media screen and (min-width: ${e=>Object(c.g)(e.theme.breakpoints.desktop)}) {
		max-width: ${e=>Object(c.g)(e.theme.breakpoints.desktop)};
	}
	@media screen and (min-width: ${e=>Object(c.g)(e.theme.breakpoints.desktopHd)}) {
		max-width: ${e=>Object(c.g)(e.theme.breakpoints.desktopHd)};
	}
`,$=l.d.div`
	${p};
`,E=l.d.div`
	${c.a};
	font-family: ${e=>e.theme.fontFamilyBody};
	margin: 0 auto;
	max-width: ${e=>{var t;return null!==(t=e.width)&&void 0!==t?t:"100%"}};
	width: 100%;
	color: ${e=>e.theme.textColor};
`,O=l.d.div`
	padding: ${e=>e.noVerticalPadding?0:Object(c.g)(e.theme.gutter)}
		${e=>e.noHorizontalPadding?0:Object(c.g)(e.theme.gutter)};
	margin: 0 auto;
	max-width: 1440px;

	&.${m}--layout-FIXED {
		${$} {
			${f};
		}
	}
`,y={height:960,width:480};function w(e){const t=e.children,o=e.width,n=void 0===o?"100%":o,l=e.containerLayout,s=void 0===l?d.d.FIXED:l,g=e.noHorizontalPadding,p=void 0!==g&&g,f=e.noVerticalPadding,y=void 0!==f&&f,w=Object(r.useRef)(null),C=Object(r.useRef)(null),j=i()(C),x=Object(c.i)(j,m,{[`layout-${s}`]:!0});return a.a.createElement(O,{noHorizontalPadding:p,noVerticalPadding:y,className:x,ref:w},a.a.createElement($,null,a.a.createElement(E,{ref:C,width:n},a.a.createElement(u.Provider,{value:w},a.a.createElement(b.Provider,{value:j},a.a.createElement(h.Provider,{value:C},t))))))}w.Ssr=function(e){const t=e.children,o=e.width,n=void 0===o?"100%":o,i=e.containerLayout,l=void 0===i?d.d.FIXED:i,s=e.noHorizontalPadding,u=void 0!==s&&s,g=e.noVerticalPadding,p=void 0!==g&&g,f=Object(r.useRef)(null),w=Object(c.i)(y,m,{[`layout-${l}`]:!0});return a.a.createElement(O,{noHorizontalPadding:u,noVerticalPadding:p,className:w},a.a.createElement($,null,a.a.createElement(E,{ref:f,width:n},a.a.createElement(b.Provider,{value:y},a.a.createElement(h.Provider,{value:f},t)))))},w.Portal=function(e){var t;const o=e.children,r=g();return Object(s.createPortal)(o,null!==(t=r.current)&&void 0!==t?t:document.body)}},59:function(e,t,o){"use strict";o.d(t,"a",(function(){return h}));var r=o(14),a=o(0),n=o.n(a),i=o(3),l=o(10),c=o(19),d=o(1),s=o(33);const m=Object(i.d)(c.animated.span)`
	display: block;
	position: absolute;
	border-radius: 50%;
	will-change: opacity, transform;
	pointer-events: none;
`;function b(e){const t=e.onRest,o=e.width,r=e.height,a=e.left,s=e.top,b=e.darkBg,h=Object(i.f)(),u=Object(c.useSpring)({from:{opacity:.4,transform:"scale(0.4)"},to:{opacity:0,transform:"scale(12)"},onRest:t,config:{tension:280,friction:110,clamp:!0}});return n.a.createElement(m,{style:{width:Object(d.g)(o),height:Object(d.g)(r),left:Object(d.g)(a),top:Object(d.g)(s),backgroundColor:b?Object(l.c)(.5,h.primaryBgText):h.primaryLightColor,...u}})}function h({darkBg:e}={darkBg:!1}){const t=Object(a.useState)([]),o=Object(r.a)(t,2),i=o[0],l=o[1],c=Object(s.a)();return[t=>{const o=t.currentTarget.getBoundingClientRect(),r=o.left,a=o.top,n=t.clientX-r,i=t.clientY-a,d=Math.min(t.currentTarget.clientWidth/4,100),s=Math.min(t.currentTarget.clientHeight/4,100),m=Math.max(d,s),b=t.timeStamp;l((t=>[...t,{key:b,width:m,height:m,left:n-m/2,top:i-m/2,onRest:()=>{c.current&&l((e=>e.filter((e=>e.key!==b))))},darkBg:e}]))},i.map((e=>n.a.createElement(b,e)))]}},60:function(e,t,o){"use strict";function r(e,t,o=0){const r=Number.parseInt(e,10);return!Number.isNaN(r)&&Number.isFinite(r)&&r>o?r:t}function a(e,t=0){let o;return o="string"==typeof e?Number.parseFloat(e):"number"==typeof e?e:t,Number.isFinite(o)||(o=t),o}o.d(t,"b",(function(){return r})),o.d(t,"a",(function(){return a}))},61:function(e,t,o){"use strict";o.d(t,"a",(function(){return Te}));var r=o(35),a=o(14),n=o(0),i=o.n(n),l=o(23),c=o.n(l),d=o(85),s=o.n(d),m=o(7),b=o(1),h=o(11),u=o(17),g=o(3),p=o(19),f=o(10);const $="wpeform-component-dropdown",E=Object(b.c)($,"button"),O=Object(b.c)($,"dd-container"),y=768,w=g.b`
body {
	&.${$}-is-open-mod-body {
		overflow: hidden;
		@media screen and (min-width: ${Object(b.g)(y)}) {
			overflow: unset;
		}
	}
}
`,C=g.d.span`
	color: ${e=>e.theme.greyLightColor};
	flex: 0 0 1em;
	height: ${e=>Object(b.g)(e.theme.controlHeightBase)};
	width: 1em;
	display: flex;
	align-items: center;
	justify-content: center;
`,j=g.d.span`
	padding: 0 ${e=>Object(b.g)(e.theme.controlHeightBase/2)} 0
		${e=>Object(b.g)(e.theme.controlHeightBase/4)};
	width: calc(100% - 2em);
	overflow: hidden;
	white-space: nowrap;
	text-overflow: ellipsis;
	flex: 1 0 auto;
`,x=g.d.div`
	${b.a};
	position: relative;
	&.${$}--align-LEFT {
		${j} {
			text-align: left;
		}
	}
	&.${$}--align-CENTER {
		${j} {
			text-align: center;
		}
	}
	&.${$}--align-RIGHT {
		${j} {
			text-align: right;
		}
	}
`,v=g.d.span`
	line-height: 1;
	height: 1em;
	transform: rotate(0deg);
	transform-origin: center center;
	transition: ${e=>Object(b.d)(["transform","color"],e.theme.transitionControl)};
`,k=g.d.span`
	color: ${e=>e.theme.greyLightColor};
	position: relative;
	flex: 0 0 1em;
	height: ${e=>Object(b.g)(e.theme.controlHeightBase)};
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
		left: ${e=>Object(b.g)(e.theme.controlHeightBase/-4)};
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
	transition: ${e=>Object(b.d)(["transform"],e.theme.transitionBeizer)};
`,S=g.d.button`
	${b.a};
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
	height: ${e=>Object(b.g)(e.theme.controlHeightBase)};
	border-radius: ${e=>Object(b.g)(e.theme.borderRadiusBase)};
	font-size: ${e=>Object(b.g)(e.theme.fz.base)};
	box-shadow: 0 0 0 0 transparent;
	color: ${e=>e.theme.textColor};
	padding: 0 ${e=>Object(b.g)(e.theme.controlHeightBase/4)};
	border: 1px solid ${e=>e.theme.borderColorBase};
	box-shadow: ${e=>e.theme.boxShadowNoneFocus};
	transition: ${e=>Object(b.d)(["border-color","box-shadow"],e.theme.transitionControl)};

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

	&.${E}--is-open {
		border-color: ${e=>e.theme.primaryColor};
		box-shadow: ${e=>e.theme.boxShadowControlFocus};
		${v} {
			transform: rotate(180deg);
		}
	}

	&.${E}--is-empty {
		${j} {
			color: ${e=>e.theme.textColorSecondary};
		}
	}

	&.${E}--has-error {
		border-color: ${e=>e.theme.borderColorError};

		&:hover {
			border-color: ${e=>e.theme.borderColorError};
		}

		&:active,
		&:focus {
			border-color: ${e=>e.theme.borderColorError};
			box-shadow: ${e=>e.theme.boxShadowControlFocusError};
		}

		${C} {
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
	&.${E}--type-MATERIAL {
		border: 0 none;
		border-bottom: 2px solid ${e=>e.theme.borderColorBase};
		border-radius: ${e=>Object(b.g)(e.theme.borderRadiusBase)}
			${e=>Object(b.g)(e.theme.borderRadiusBase)} 0 0;
		box-shadow: none;
		background-color: ${e=>e.theme.backgroundControl};
		transition: ${e=>Object(b.d)(["background-color"],e.theme.transitionControl)};

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
			&.${E}--is-open
			+ ${B} {
			transform: scaleX(1);
		}

		&.${E}--has-error {
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
	&.${E}--size-SMALL {
		height: ${e=>Object(b.g)(.8*e.theme.controlHeightBase)};
		padding: ${e=>Object(b.g)(e.theme.controlHeightBase/8)};
		/* font-size: ${e=>Object(b.g)(e.theme.fz.small1)}; */
		${j} {
			padding: 0 ${e=>Object(b.g)(e.theme.controlHeightBase/3)} 0
				${e=>Object(b.g)(e.theme.controlHeightBase/8)};
		}
		${k} {
			height: ${e=>Object(b.g)(.8*e.theme.controlHeightBase)};
			&::before {
				left: ${e=>Object(b.g)(e.theme.controlHeightBase/-6)};
			}
		}
	}
	&.${E}--size-LARGE {
		height: ${e=>Object(b.g)(1.2*e.theme.controlHeightBase)};
		padding: ${e=>Object(b.g)(e.theme.controlHeightBase/4)};
		${k} {
			height: ${e=>Object(b.g)(1.2*e.theme.controlHeightBase)};
		}
	}
`,T=g.d.div`
	${b.a};
	font-size: ${e=>Object(b.g)(e.theme.fz.base)};
	font-family: ${e=>e.theme.fontFamilyBody};
	position: fixed;
	z-index: 999997;
	min-width: 300px;

	padding: 0;
	perspective: 200px;

	&.${O}--size-SMALL {
		min-width: 130px;
	}

	/** Reverse position to bottom for smaller screens */
	@media screen and (max-width: ${Object(b.g)(767)}) {
		left: ${e=>Object(b.g)(2*e.theme.gutter)};
		right: ${e=>Object(b.g)(2*e.theme.gutter)};
		bottom: 0;
		width: auto !important;
		top: auto !important;
		min-width: 100px !important;
	}

	/** We position this w.r.t screen width and not container width */
	@media screen and (min-width: ${Object(b.g)(y)}) {
		width: ${e=>Object(b.g)(e.width||300)};
		left: ${e=>Object(b.g)(e.left||0)};
		right: auto;
		bottom: auto;
	}
`,F=Object(g.d)(p.animated.div)`
	border: 1px solid ${e=>e.theme.borderColorSplit};
	border-radius: ${e=>Object(b.g)(e.theme.borderRadiusBase)};
	background-color: ${e=>e.theme.appBackgroundColor};
	box-shadow: ${e=>e.theme.boxShadow12dp};
	overflow: hidden;
	will-change: transform, opacity;

	/** Reverse position to bottom for smaller screens */
	@media screen and (max-width: ${Object(b.g)(767)}) {
		border-bottom: 0 none;
		transform-origin: bottom center !important;
		border-bottom-right-radius: 0;
		border-bottom-left-radius: 0;
	}
`,A=g.d.div`
	padding: 0;
	border-bottom-left-radius: ${e=>Object(b.g)(e.theme.borderRadiusBase)};
	border-bottom-right-radius: ${e=>Object(b.g)(e.theme.borderRadiusBase)};
	max-height: calc(
		70vh - ${e=>Object(b.g)(2.5*e.theme.controlHeightBase)}
	);
	overflow-y: auto;
	overflow-x: hidden;
	/** We position this w.r.t screen width and not container width */
	@media screen and (min-width: ${Object(b.g)(y)}) {
		max-height: calc(
			60vh - ${e=>Object(b.g)(2.5*e.theme.controlHeightBase)}
		);
	}
`,N=g.d.div`
	${b.a};
	padding: ${e=>Object(b.g)(e.theme.gutter)};
	min-height: 150px;
`,R=g.d.div`
	margin: 0;
	margin-bottom: ${e=>Object(b.g)(e.theme.gutter/2)};
	&:last-child {
		margin-bottom: 0;
	}
`,L=g.d.label`
	margin: 0;
	margin-bottom: ${e=>Object(b.g)(e.theme.gutter/4)};
	display: block;
	font-size: ${e=>Object(b.g)(e.theme.fz.small1)};
	font-weight: bold;
	text-transform: uppercase;
	color: ${e=>e.theme.textColorSecondary};
`,H=Object(g.d)(p.animated.div)`
	position: fixed;
	z-index: 999996;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;
	background-color: rgba(255, 255, 255, 0.75);
	will-change: opacity;

	@media screen and (min-width: ${Object(b.g)(y)}) {
		display: none;
	}
`,I=g.d.div`
	padding: 0;
	margin: 0;
`,_=g.d.span`
	height: ${e=>Object(b.g)(.4*e.theme.controlHeightBase)};
	width: ${e=>Object(b.g)(.4*e.theme.controlHeightBase)};
	flex: 0 0 ${e=>Object(b.g)(.4*e.theme.controlHeightBase)};
	border-radius: ${e=>Object(b.g)(.2*e.theme.controlHeightBase)};
	font-size: ${e=>Object(b.g)(.2*e.theme.controlHeightBase)};
	background-color: ${e=>e.theme.borderColorSplit};
	color: ${e=>e.theme.primaryBgText};
	margin: 0 ${e=>Object(b.g)(e.theme.gutter/2)} 0 0;
	display: flex;
	align-items: center;
	justify-content: center;
	transition: ${e=>Object(b.d)(["background-color","opacity"],e.theme.transitionControl)};
`,z=g.d.span`
	flex: 1 0
		calc(100% - ${e=>Object(b.g)(.4*e.theme.controlHeightBase)});
	width: calc(
		100% - ${e=>Object(b.g)(.4*e.theme.controlHeightBase)}
	);
	text-align: left;
	text-transform: uppercase;
	line-height: 1;
	font-weight: bold;
`,D=g.d.button`
	position: relative;
	width: 100%;
	min-height: ${e=>Object(b.g)(.8*e.theme.controlHeightBase)};
	padding: 0 ${e=>Object(b.g)(e.theme.gutter/2)};
	border-radius: 0;
	border: 0 none;
	outline: none;
	color: ${e=>e.theme.textColorSecondary};
	background-color: ${e=>e.theme.appBackgroundColor};
	font-size: ${e=>Object(b.g)(e.theme.fz.small2)};
	display: flex;
	flex-flow: row nowrap;
	justify-content: flex-start;
	align-items: center;
	text-align: left;
	cursor: pointer;
	transition: ${e=>Object(b.d)(["background-color","color"],e.theme.transitionControl)};
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
		transition: ${e=>Object(b.d)(["color"],e.theme.transitionControl)};
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
	padding: ${e=>Object(b.g)(e.theme.gutter/4)} 0;

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
`;var U=o(55),G=o(59),W=o(33);const X=`body.${$}-is-open-mod-body {\n\toverflow: hidden;\n}\n@media screen and (min-width: ${Object(b.g)(y)}) {\n\tbody.${$}-is-open-mod-body {\n\t\toverflow: unset;\n\t}\n}`;var Y=o(48);function V(e){const t=e.isOpen,o=e.closePortal,r=e.dropdownButtonRect,l=e.size,d=e.dropdownButtonRef,s=e.styleProps,m=e.children,h=e.minMenuWidth,u=Object(n.useState)({top:0,topBleeding:!1,rightBleeding:!1}),p=Object(a.a)(u,2),f=p[0],E=p[1],w=Object(g.f)(),C=Object(n.useRef)(null),j=Object(U.a)(C,{observe:window.innerWidth>=y}),x=Object(Y.b)();Object(n.useLayoutEffect)((()=>{t&&setTimeout((()=>{C.current&&C.current.focus()}),400),t?document.body.classList.add(`${$}-is-open-mod-body`):document.body.classList.remove(`${$}-is-open-mod-body`)}),[C,t]),Object(n.useLayoutEffect)((()=>{const e=()=>{E({top:0,rightBleeding:!1,topBleeding:!1})};if(window.innerWidth<y)e();else if(r&&j){let e=r.bottom+w.gutter/2;const t=window.innerHeight,o=j.height;let a=!1;e+o>t&&(e=r.top-o-w.gutter/2,e<w.gutter/2&&(e=w.gutter/2),a=!0);const n=window.innerWidth,i=j.width;let l=!1;r.left+i+w.gutter>n&&(l=!0),E({top:e,topBleeding:a,rightBleeding:l})}else e()}),[r,j,w.gutter]),Object(n.useEffect)((()=>{if(t){const e=e=>{var t,o;const r=e.target;return!(document.body.contains(r)||!x.current||x.current.contains(r))||(e.target===C.current||(null===(t=C.current)||void 0===t?void 0:t.contains(e.target))||e.target===d.current||(null===(o=d.current)||void 0===o?void 0:o.contains(e.target)))},t=t=>{t.target.shadowRoot||e(t)||o()},r=t=>{e(t)||o()},a=x.current;return window.addEventListener("click",t),a&&a.addEventListener("click",r),()=>{window.removeEventListener("click",t),a&&a.removeEventListener("click",r)}}return()=>{}}),[o,t,x,d]),Object(n.useEffect)((()=>{if(t){const e=e=>{"Escape"===e.key&&o()};return document.addEventListener("keyup",e),()=>{document.removeEventListener("keyup",e)}}return()=>{}}),[o,t]);const v=Object(b.b)(O,{[`size-${l}`]:!0});let k,B=null==r?void 0:r.width;return h&&B&&B<h&&(B=h),r&&j&&(k=f.rightBleeding?r.left-(j.width-r.width):r.left),i.a.createElement(Y.a.Portal,null,i.a.createElement(H,{style:{opacity:s.opacity}}),i.a.createElement(T,{style:{top:Object(b.g)(f.top)},left:k,width:B,ref:C,tabIndex:0,className:v},i.a.createElement(F,{style:s,className:c()({"is-bleeding":f.topBleeding})},m)))}function q(e){const t=e.closePortal,o=e.isOpen,r=e.menu,a=e.size,n=e.dropdownButtonRef,l=e.minMenuWidth,c=function(e,t){const o=Object(U.a)(t,{observe:e&&window.innerWidth>=y}),r=Object(g.f)();return{dropdownContainerTransitions:Object(p.useTransition)(e,{from:{transform:window.innerWidth<y?"translate3d(0, 50px, -50px)":"translate3d(0, 50px, 0)",opacity:0},reverse:e,enter:{opacity:1,transform:"translate3d(0, 0, 0)"},leave:{opacity:0},config:r.springConfigStiff}),dropdownButtonRect:o}}(o,n),d=c.dropdownContainerTransitions,s=c.dropdownButtonRect;return d(((e,c)=>c&&i.a.createElement("div",null,i.a.createElement(V,{isOpen:o,closePortal:t,size:a,dropdownButtonRect:s,dropdownButtonRef:n,styleProps:e,minMenuWidth:l},r(t)))))}const Z=["prefix","controlType","controlAlignment","size","className","disabled","buttonLabel","passiveButton","menu","onClose","onOpen","hasError","minMenuWidth","loading"];function Q(e){const t=e.prefix,o=e.controlType,l=void 0===o?h.f.BOXY:o,c=e.controlAlignment,d=void 0===c?h.e.LEFT:c,s=e.size,m=void 0===s?h.a.DEFAULT:s,g=e.className,p=e.disabled,f=e.buttonLabel,O=e.passiveButton,y=void 0!==O&&O,T=e.menu,F=e.onClose,A=e.onOpen,N=e.hasError,R=void 0!==N&&N,L=e.minMenuWidth,H=e.loading,I=void 0!==H&&H,_=Object(r.a)(e,Z),z=function(e,t){const o=Object(n.useRef)(null),r=Object(n.useState)(!1),i=Object(a.a)(r,2),l=i[0],c=i[1],d=Object(n.useCallback)((()=>{c(!1),o.current&&o.current.focus()}),[]),s=Object(n.useCallback)((()=>{c((e=>!e))}),[]),m=Object(W.b)(l);Object(n.useEffect)((()=>{!0===m&&!1===l&&e?e():!1===m&&!0===l&&t&&t()}),[l,m,e,t]);const b=Object(G.a)(),h=Object(a.a)(b,2),u=h[0],g=h[1];return Object(n.useEffect)((()=>{const e=`${$}--global-style`;if(document.head.querySelector(`style#${e}`))return()=>{};const t=document.createElement("style");return t.setAttribute("id",e),t.innerHTML=X,document.head.appendChild(t),()=>{const t=document.head.querySelector(`style#${e}`);t&&t.remove()}}),[]),{isOpen:l,closePortal:d,togglePortal:s,dropdownButtonRef:o,addRipple:u,ripples:g}}(F,A),D=z.isOpen,P=z.closePortal,M=z.togglePortal,U=z.dropdownButtonRef,Y=z.addRipple,V=z.ripples,Q=Object(b.b)($,{"is-open":D,[`type-${l}`]:!0,[`align-${d}`]:"string"!=typeof f},g),J=Object(b.b)(E,{"is-empty":y,"is-open":D,[`type-${l}`]:!0,"has-error":R,[`size-${m}`]:!0});return i.a.createElement(x,{className:Q},i.a.createElement(w,null),i.a.createElement(S,Object.assign({type:"button",disabled:p||I,className:J,ref:U,onClick:e=>{Y(e),M()}},_),V,t||I?i.a.createElement(C,null,I?i.a.createElement(u.b,{iconClass:"fas fa-spinner fa-pulse"}):t):null,i.a.createElement(j,null,f),i.a.createElement(k,null,i.a.createElement(v,null,i.a.createElement(u.b,{iconClass:"fas fa-chevron-down"})))),l===h.f.MATERIAL?i.a.createElement(B,null):null,i.a.createElement(q,{closePortal:P,isOpen:D,menu:T,size:m,dropdownButtonRef:U,minMenuWidth:L}))}Q.Widget=N,Q.FormControl=R,Q.Label=L,Q.Menu=I,Q.MenuItem=function(e){const t=e.children,o=e.active,r=e.onClick;return i.a.createElement(D,{className:c()({"is-active":o}),onClick:e=>{e.preventDefault(),r()}},i.a.createElement(_,null,i.a.createElement(u.b,{iconClass:"fas fa-check"})),i.a.createElement(z,null,t))},Q.SplitMenu=P,Q.SplitMenuColumn=M,Q.ScrollableItems=A;var J=o(149),K=o(86),ee=o(63);const te=new(o(47).a)("EForm Masks");te.addItem("us-phone-number",{name:Object(m.__)("US phone number","wp-eform"),mask:"+1 (000) 000-0000",placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform"),overrideInputType:"tel",title:Object(m.__)("Mobile or telephone number.","wp-eform")}),te.addItem("us-ssn",{name:Object(m.__)("US Social Security Number (SSN)","wp-eform"),mask:"000 00 0000",placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform"),overrideInputType:"tel",title:Object(m.__)("Digits only","wp-eform")}),te.addItem("us-zip",{name:Object(m.__)("US Zip code","wp-eform"),mask:"00000",placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform"),overrideInputType:"tel",title:Object(m.__)("Digits only","wp-eform")}),te.addItem("date-mm-dd-yy",{name:Object(m.__)("Date MM-DD-YY","wp-eform"),mask:"00-00-00",overrideInputType:"tel",placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform")}),te.addItem("date-yyyy-mm-dd",{name:Object(m.__)("Date YYYY-MM-DD","wp-eform"),mask:"0000-00-00",overrideInputType:"tel",placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform")}),te.addItem("date-dd/mm/yy",{name:Object(m.__)("Date DD/MM/YY","wp-eform"),mask:"00/00/00",overrideInputType:"tel",placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform")}),te.addItem("twitter-url",{name:Object(m.__)("Twitter URL","wp-eform"),mask:`https://twitter.com/*[${"*".repeat(50)}]`,placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform")}),te.addItem("facebook-url",{name:Object(m.__)("Facebook URL","wp-eform"),mask:`https://f\\acebook.com/*[${"*".repeat(50)}]`,placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform")}),te.addItem("instagram-url",{name:Object(m.__)("Instagram URL","wp-eform"),mask:`https://inst\\agr\\am.com/*[${"*".repeat(50)}]`,placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform")}),te.addItem("url",{name:Object(m.__)("General URL","wp-eform"),mask:`http[a]://[${"*".repeat(255)}]`,placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform")}),te.addItem("rgb-hex-color",{name:Object(m.__)("RGB or HEX color code","wp-eform"),mask:[{mask:"RGB,RGB,RGB",blocks:{RGB:{mask:ee.a.MaskedRange,from:0,to:255}}},{mask:/^#[0-9a-f]{0,6}$/i}],placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform")}),te.addItem("rgb-color",{name:Object(m.__)("RGB color code","wp-eform"),mask:[{mask:"RGB,RGB,RGB",blocks:{RGB:{mask:ee.a.MaskedRange,from:0,to:255}}}],placeholder:Object(m._x)("_","wp-eform-mask-placeholder","wp-eform")});var oe=o(60);const re="wpeform-control-text",ae=g.d.div`
	position: absolute;
	height: 2px;
	bottom: 0;
	left: 0;
	right: 0;
	transform-origin: 50% 50%;
	background-color: ${e=>e.theme.primaryColor};
	pointer-events: none;
	transform: scaleX(0);
	transition: ${e=>Object(b.d)(["transform"],e.theme.transitionBeizer)};
`,ne=g.d.input`
	${b.a};
	${b.f};
	display: block;
	width: 100%;
	height: ${e=>Object(b.g)(e.theme.controlHeightBase)};
	border-radius: ${e=>Object(b.g)(e.theme.borderRadiusBase)};
	font-size: ${e=>Object(b.g)(e.theme.fz.base)};
	box-shadow: 0 0 0 0 transparent;
	color: ${e=>e.theme.textColor};
	padding: ${e=>Object(b.g)(e.theme.controlHeightBase/4)};
	border: 1px solid ${e=>e.theme.borderColorBase};
	background-color: ${e=>e.theme.appBackgroundColor};
	box-shadow: ${e=>e.theme.boxShadowNoneFocus};
	transition: ${e=>Object(b.d)(["border-color","box-shadow"],e.theme.transitionControl)};

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
		border-radius: ${e=>Object(b.g)(e.theme.borderRadiusBase)}
			${e=>Object(b.g)(e.theme.borderRadiusBase)} 0 0;
		box-shadow: none;
		background-color: ${e=>e.theme.backgroundControl};
		transition: ${e=>Object(b.d)(["background-color"],e.theme.transitionControl)};

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
			+ ${ae},
			&:active
			+ ${ae},
			&:focus
			+ ${ae} {
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

			+ ${ae} {
				background-color: ${e=>e.theme.borderColorError};
			}
		}

		&:disabled {
			background-color: ${e=>e.theme.disabledBackgroundColor};
			color: ${e=>e.theme.disabledColor};
			border-color: ${e=>e.theme.disabledColor};
			cursor: not-allowed;
			+ ${ae} {
				transform: scaleX(0);
				background-color: ${e=>e.theme.disabledColor};
			}
		}

		&:read-only {
			background-color: ${e=>e.theme.disabledBackgroundColor};
			border-color: ${e=>e.theme.disabledColor};
			+ ${ae} {
				transform: scaleX(0);
				background-color: ${e=>e.theme.disabledColor};
			}
		}
	}

	/** SIZES */
	&.${re}__input--size-SMALL {
		height: ${e=>Object(b.g)(.8*e.theme.controlHeightBase)};
		padding: ${e=>Object(b.g)(e.theme.controlHeightBase/8)};
		font-size: ${e=>Object(b.g)(e.theme.fz.small1)};
	}
	&.${re}__input--size-LARGE {
		height: ${e=>Object(b.g)(1.2*e.theme.controlHeightBase)};
		padding: ${e=>Object(b.g)(e.theme.controlHeightBase/4)};
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
	font-size: ${e=>Object(b.g)(e.theme.fz.base)};

	color: ${e=>e.theme.textColorSecondary};
	transition: ${e=>Object(b.d)(["top","left","bottom","font-size"],e.theme.transitionControl)};

	> * {
		margin: 0;
		padding: 0;
		max-width: 100%;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
`,le=g.d.div`
	position: absolute;
	top: 0;
	left: ${e=>Object(b.g)(e.theme.controlHeightBase/4)};
	bottom: 0;
	display: flex;
	align-items: center;
	justify-content: center;
	/** So that we can click through it to the input */
	pointer-events: none;
	color: ${e=>e.theme.greyLightColor};
`,ce=g.d.div`
	${b.a};
	position: relative;
	padding: 0;

	/** Position the default placeholder */
	${ie} {
		top: ${e=>Object(b.g)(e.theme.controlHeightBase/4)};
		left: ${e=>Object(b.g)(e.theme.controlHeightBase/4)};
		right: ${e=>Object(b.g)(e.theme.controlHeightBase/4)};
		bottom: ${e=>Object(b.g)(e.theme.controlHeightBase/4)};
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
		${ne} {
			/** [gutter + prefix + gutter] where gutter is controlHeightBase / 4 & prefix is fz.base */
			padding-left: ${e=>Object(b.g)(e.theme.fz.base+e.theme.controlHeightBase/4*2)};
		}
		${ie} {
			left: ${e=>Object(b.g)(e.theme.fz.base+e.theme.controlHeightBase/4*2)};
		}
		&.${re}--size-SMALL {
			${ne} {
				/** [gutter + prefix + gutter] where gutter is controlHeightBase / 8 & prefix is fz.base */
				padding-left: ${e=>Object(b.g)(e.theme.fz.base+e.theme.controlHeightBase/8*2+4)};
			}
			${ie} {
				left: ${e=>Object(b.g)(e.theme.fz.base+e.theme.controlHeightBase/8*2)};
			}
		}

		&.${re}--has-error {
			${le} {
				color: ${e=>e.theme.errorColor};
			}
		}
	}

	/** Changes when focused */
	&.${re}--is-focused, &.${re}--is-not-empty {
		${ie} {
			top: ${e=>Object(b.g)(e.theme.controlHeightBase/2*-1)};
			left: 0;
			bottom: ${e=>Object(b.g)(e.theme.controlHeightBase)};
			font-size: ${e=>Object(b.g)(e.theme.fz.small1)};
		}
	}
`,de=["id","onChange","value","prefix","placeholder","controlType","controlAlignment","disabled","readOnly","hasError","type","masks","onBlur","innerRef","className","size"],se=Object(K.a)((({inputRef:e,...t})=>i.a.createElement(ne,Object.assign({},t,{ref:e}))));function me(e){const t=e.id,o=e.onChange,l=e.value,c=e.prefix,d=e.placeholder,s=e.controlType,m=void 0===s?h.f.BOXY:s,u=e.controlAlignment,g=void 0===u?h.e.LEFT:u,p=e.disabled,f=void 0!==p&&p,$=e.readOnly,E=void 0!==$&&$,O=e.hasError,y=void 0!==O&&O,w=e.type,C=void 0===w?"text":w,j=e.masks,x=e.onBlur,v=e.innerRef,k=e.className,B=e.size,S=void 0===B?h.a.DEFAULT:B,T=Object(r.a)(e,de);let F,A=C;const N=Object(n.useState)(!1),R=Object(a.a)(N,2),L=R[0],H=R[1],I=Object(n.useState)(l),_=Object(a.a)(I,2),z=_[0],D=_[1],P=Object(J.a)(((e,t)=>{t(e)}),300),M=e=>{if("number"===C){let t=Object(oe.a)(e,0);void 0!==T.min&&t<T.min&&(t=T.min),void 0!==T.max&&t>T.max&&(t=T.max),e=t.toString()}D(e),P(e,o)};Object(n.useEffect)((()=>{D(l)}),[l]);const U=Object(b.b)(re,{"has-prefix":!!c,"is-not-empty":""!==l,"is-focused":L,[`type-${m}`]:!0,"has-error":y,[`align-${g}`]:!0,[`size-${S}`]:!0},k);let G,W=!1,X=j?j.placeholder:"_";if(j&&j.maskType!==h.b.NONE)if(j.maskType===h.b.STRING)G=j.maskString||"",W=!0;else if(j.maskType===h.b.REGEXP)G=[],j.maskRegExps.forEach((e=>{G.push({mask:new RegExp(e.pattern,e.caseSensitive?"i":void 0),lazy:!j.alwaysShowMask&&!L})})),W=!0;else{const e=j.maskPreset||"";if(te.hasItem(e)){const t=te.getItem(e);G=t.mask,t.overrideInputType&&(A=t.overrideInputType),F=t.title,t.placeholder&&(X=t.placeholder),W=!0}}const Y=Object(b.b)(Object(b.c)(re,"input"),{[`type-${m}`]:!0,"has-error":y,[`size-${S}`]:!0});return i.a.createElement(ce,{className:U},c?i.a.createElement(le,null,c):null,"string"!=typeof d&&(!W||W&&j&&!j.alwaysShowMask)?i.a.createElement(ie,null,d):null,W&&G&&j?i.a.createElement(se,{mask:G,radix:".",unmask:!1,inputRef:v,onAccept:e=>{M(e)},overwrite:!0,value:z,onFocus:()=>{H(!0)},onBlur:e=>{H(!1),P.cancel(),o(z),null==x||x(e)},disabled:f,readOnly:E,lazy:!j.alwaysShowMask&&!L,placeholderChar:X,placeholder:"string"==typeof d?d:void 0,title:F,type:A}):i.a.createElement(ne,Object.assign({id:t,type:C,className:Y,value:z,onChange:e=>{M(e.target.value)},onFocus:()=>{H(!0)},onBlur:e=>{H(!1),P.cancel(),o(z),null==x||x(e)},disabled:f,readOnly:E,placeholder:"string"==typeof d?d:void 0,ref:v},T)),m===h.f.MATERIAL?i.a.createElement(ae,null):null)}const be="wpeform-control-select",he=Object(b.c)(be,"search"),ue=Object(b.c)(be,"menu"),ge=g.d.div`
	display: flex;
	flex-flow: row nowrap;
	align-items: center;
	justify-content: flex-start;
	overflow-x: auto;
`,pe=g.d.button`
	${b.a};
	color: ${e=>e.theme.textColor};
	padding: ${e=>Object(b.g)(e.theme.gutter/4)};
	background-color: ${e=>e.theme.backgroundControl};
	border: 0 none;
	border-radius: ${e=>Object(b.g)(e.theme.borderRadiusBase)};
	cursor: pointer;
	flex: 0 0 ${e=>Object(b.g)(3*e.theme.controlHeightBase/4)};
	width: ${e=>Object(b.g)(3*e.theme.controlHeightBase/4)};
	transition: ${e=>Object(b.d)(["background-color","color"],e.theme.transitionControl)};

	&:hover,
	&:active,
	&:focus {
		background-color: ${e=>e.theme.errorBackgroundColor};
		color: ${e=>e.theme.errorColor};
	}
`,fe=g.d.div`
	padding: ${e=>Object(b.g)(e.theme.gutter/2)};
	margin: 0;
	border-bottom: 1px solid ${e=>e.theme.borderColorSplit};
	display: flex;
	flex-flow: row nowrap;
	${pe} {
		flex: 0 0 ${e=>Object(b.g)(e.theme.controlHeightBase)};
		margin-left: auto;
		width: ${e=>Object(b.g)(e.theme.controlHeightBase)};
		height: ${e=>Object(b.g)(e.theme.controlHeightBase)};
	}
`,$e=g.d.div`
	flex: 0 0
		calc(
			100% -
				${e=>Object(b.g)(e.theme.controlHeightBase+e.theme.gutter/2)}
		);
	width: calc(
		100% -
			${e=>Object(b.g)(e.theme.controlHeightBase+e.theme.gutter/2)}
	);
`,Ee=g.d.div`
	margin: 0;
	padding: ${e=>Object(b.g)(e.theme.gutter/4)};
	border-top: 1px solid ${e=>e.theme.borderColorSplit};
	border-bottom-left-radius: ${e=>Object(b.g)(e.theme.borderRadiusBase)};
	border-bottom-right-radius: ${e=>Object(b.g)(e.theme.borderRadiusBase)};
`,Oe=g.d.div`
	font-size: ${e=>Object(b.g)(e.theme.fz.small1)};
	border-radius: ${e=>Object(b.g)(e.theme.borderRadiusBase)};
	margin: ${e=>Object(b.g)(e.theme.gutter/4)};
	padding: 0 0 0 ${e=>Object(b.g)(e.theme.gutter/4)};
	flex: 0 0 auto;
	background-color: ${e=>e.asPlaceholder?"transparent":e.theme.backgroundControl};
	display: flex;
	align-items: center;
	justify-content: flex-start;
	color: ${e=>e.asPlaceholder?e.theme.disabledColor:e.theme.textColor};
	max-width: 250px;

	span {
		padding: ${e=>Object(b.g)(e.theme.gutter/4)};
		max-width: calc(
			100% -
				${e=>e.asPlaceholder?"0px":Object(b.g)(3*e.theme.controlHeightBase/4)}
		);
		flex: 0 0 auto;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
	}
`,ye=g.d.div`
	padding: ${e=>Object(b.g)(2*e.theme.gutter)}
		${e=>Object(b.g)(e.theme.gutter/2)};
	color: ${e=>e.theme.greyLightColor};
	font-size: ${e=>Object(b.g)(e.theme.fz.small1)};
	width: 100%;
	text-align: center;
`,we=g.d.div`
	width: 100%;
	flex: 0 0 100%;
	margin: 0 0 ${e=>Object(b.g)(e.theme.gutter/2)} 0;
	font-size: ${e=>Object(b.g)(e.theme.fz.large8)};
	color: ${e=>e.theme.disabledColor};
	.${u.a} {
		display: block;
		margin: 0 auto;
	}
`,Ce=g.d.p`
	width: 100%;
	flex: 0 0 100%;
	margin: 0;
	padding: 0;
`,je=g.d.span`
	flex: 0 0 calc(100% - ${e=>Object(b.g)(e.theme.controlHeightBase)});
`,xe=g.d.span`
	margin-left: auto;
	flex: 0 0 ${e=>Object(b.g)(e.theme.controlHeightBase/2)};
	width: ${e=>Object(b.g)(e.theme.controlHeightBase/2)};
	height: ${e=>Object(b.g)(e.theme.controlHeightBase/2)};
	background-color: ${e=>e.theme.borderColorSplit};
	color: ${e=>e.theme.primaryBgText};
	display: flex;
	align-items: center;
	justify-content: center;
	opacity: 0;
	font-size: ${e=>Object(b.g)(.25*e.theme.controlHeightBase)};
	border-radius: 50%;
	transition: ${e=>Object(b.d)(["opacity","background-color"],e.theme.transitionControl)};
`,ve=g.d.button`
	${b.a};
	display: flex;
	width: 100%;
	align-items: center;
	justify-content: flex-start;
	text-align: left;
	background-color: ${e=>e.theme.appBackgroundColor};
	color: ${e=>e.theme.textColorSecondary};
	font-size: ${e=>Object(b.g)(e.theme.fz.base)};
	padding: ${e=>Object(b.g)(e.theme.gutter/2)}
		${e=>Object(b.g)(e.theme.gutter)};
	outline: none;
	border: 0 none;
	cursor: pointer;
	transition: ${e=>Object(b.d)(["background-color","color"],e.theme.transitionControl)};

	&.is-active {
		color: ${e=>e.theme.textColor};
		${xe} {
			background-color: ${e=>e.theme.successColor};
			opacity: 0.8;
		}
	}

	&:hover {
		${xe} {
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
		transition: ${e=>Object(b.d)(["color"],e.theme.transitionControl)};
	}
`,ke=g.d.div`
	&.${ue}--size-SMALL {
		${$e} {
			flex-basis: calc(
				100% -
					${e=>Object(b.g)(.8*e.theme.controlHeightBase+e.theme.gutter/4)}
			);
			width: calc(
				100% -
					${e=>Object(b.g)(.8*e.theme.controlHeightBase+e.theme.gutter/4)}
			);
		}
		${pe} {
			height: ${e=>Object(b.g)(.8*e.theme.controlHeightBase)};
			width: ${e=>Object(b.g)(.8*e.theme.controlHeightBase)};
			flex-basis: ${e=>Object(b.g)(.8*e.theme.controlHeightBase)};
			font-size: ${e=>Object(b.g)(e.theme.fz.small1)};
		}
		${ve} {
			font-size: ${e=>Object(b.g)(e.theme.fz.base)};
			padding: ${e=>Object(b.g)(e.theme.gutter/4)}
				${e=>Object(b.g)(e.theme.gutter/2)};
		}
		${xe} {
			flex-basis: ${e=>Object(b.g)(.4*e.theme.controlHeightBase)};
			width: ${e=>Object(b.g)(.4*e.theme.controlHeightBase)};
			height: ${e=>Object(b.g)(.4*e.theme.controlHeightBase)};
			font-size: ${e=>Object(b.g)(.2*e.theme.controlHeightBase)};
		}
		${je} {
			flex-basis: calc(
				100% - ${e=>Object(b.g)(.6*e.theme.controlHeightBase)}
			);
		}
		${Ee} {
			padding-top: 0;
			padding-bottom: 0;
		}
	}
`,Be=["items","placeholder","showSearch","searchPlaceholder","emptyResultPlaceholder","value","mode","onChange","controlType","controlAlignment","className","canClear","onBlur","size"];function Se(e){const t=e.showSearch,o=e.searchPlaceholder,r=void 0===o?Object(m.__)("Search items","wp-eform"):o,l=e.emptyResultPlaceholder,d=void 0===l?Object(m.__)("No items found","wp-eform"):l,g=e.items,p=e.value,f=e.onChange,$=e.toggleValue,E=e.itemsInValue,O=e.controlType,y=e.closePortal,w=e.placeholder,C=e.size,j=e.canClear,x=void 0===j||j,v=e.mode,k=Object(n.useState)(""),B=Object(a.a)(k,2),S=B[0],T=B[1],F=Object(n.useRef)(null),A=Object(n.useMemo)((()=>""!==S?g.filter((e=>s()(S.toLowerCase(),e.plain.toLowerCase()))):g),[S,g]);return i.a.createElement(ke,{className:Object(b.b)(ue,{[`size-${C}`]:!0})},t?i.a.createElement(fe,null,i.a.createElement($e,null,i.a.createElement(me,{size:C,innerRef:F,className:he,value:S,onChange:T,prefix:i.a.createElement(u.b,{iconClass:"fas fa-search"}),placeholder:r,controlType:O})),i.a.createElement(pe,{type:"button",onClick:e=>{e.preventDefault(),y()}},i.a.createElement(u.b,{iconClass:"fas fa-times"}))):null,i.a.createElement(Q.ScrollableItems,null,A.length?A.map((e=>i.a.createElement(ve,{key:e.value,className:c()({"is-active":p.includes(e.value)}),onClick:t=>{t.preventDefault(),$(e.value),v===h.c.SINGLE&&y()}},i.a.createElement(je,null,e.label),i.a.createElement(xe,null,i.a.createElement(u.b,{iconClass:"fas fa-check"}))))):i.a.createElement(ye,null,i.a.createElement(we,null,i.a.createElement(u.b,{iconClass:"fas fa-box-open"})),i.a.createElement(Ce,null,d))),x?i.a.createElement(Ee,null,i.a.createElement(ge,null,E.length?E.map((e=>i.a.createElement(Oe,{key:e.value},i.a.createElement("span",null,e.label),i.a.createElement(pe,{type:"button",onClick:t=>{t.preventDefault(),f(p.filter((t=>t!==e.value)))}},i.a.createElement(u.b,{iconClass:"fas fa-times"}))))):i.a.createElement(Oe,{asPlaceholder:!0},i.a.createElement("span",null,w)))):null)}function Te(e){const t=e.items,o=e.placeholder,a=e.showSearch,l=void 0===a||a,c=e.searchPlaceholder,d=e.emptyResultPlaceholder,s=e.value,m=e.mode,u=e.onChange,g=e.controlType,p=void 0===g?h.f.BOXY:g,f=e.controlAlignment,$=void 0===f?h.e.LEFT:f,E=e.className,O=e.canClear,y=void 0===O||O,w=e.onBlur,C=e.size,j=void 0===C?h.a.DEFAULT:C,x=Object(r.a)(e,Be),v=t.filter((e=>s&&s.includes(e.value))),k=Object(n.useCallback)((e=>{if(s.includes(e)){if(m===h.c.SINGLE)return;u(s.filter((t=>t!==e)))}else m===h.c.MULTIPLE?u([...s,e]):u([e])}),[s,m,u]),B=null===s||!s.length,S=Object(b.b)(be,{"is-empty":B,[`type-${p}`]:!0,[`mode-${m}`]:!0,[`align-${$}`]:"string"!=typeof o},E),T=v.length?v.map((e=>e.plain)).join(", "):o;return i.a.createElement(Q,Object.assign({buttonLabel:T,menu:e=>i.a.createElement(Se,{showSearch:l,emptyResultPlaceholder:d,items:t,itemsInValue:v,onChange:u,searchPlaceholder:c,placeholder:o,toggleValue:k,value:s,controlType:p,closePortal:e,size:j,canClear:y,mode:m}),className:S,controlAlignment:$,controlType:p,onClose:w,passiveButton:B,size:j},x))}},62:function(e,t,o){"use strict";o.d(t,"a",(function(){return w}));var r=o(47),a=o(19),n=o(10),i=o(1);const l={neutrals:{"050":"#F5F7FA",100:"#E4E7EB",200:"#CBD2D9",300:"#9AA5B1",400:"#7B8794",500:"#616E7C",600:"#52606D",700:"#3E4C59",800:"#323F4B",900:"#1F2933"},red:{"050":"#FFE3E3",100:"#FFBDBD",200:"#FF9B9B",300:"#F86A6A",400:"#EF4E4E",500:"#E12D39",600:"#CF1124",700:"#AB091E",800:"#8A041A",900:"#610316"},green:{"050":"#E3F9E5",100:"#C1F2C7",200:"#91E697",300:"#51CA58",400:"#31B237",500:"#18981D",600:"#0F8613",700:"#0E7817",800:"#07600E",900:"#014807"},yellow:{"050":"#FFFBEA",100:"#FFF3C4",200:"#FCE588",300:"#FADB5F",400:"#F7C948",500:"#F0B429",600:"#DE911D",700:"#CB6E17",800:"#B44D12",900:"#8D2B0B"}},c={fontFamilyBody:"--apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif",fontFamilyHeading:"--apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif",fontFamilyMono:'"SFMono-Regular", Consolas, "Liberation Mono", Menlo, Courier, monospace',fz:{small2:12,small1:14,base:16,large1:18,large2:20,large3:24,large4:30,large5:36,large6:48,large7:60,large8:72},boldHeading:!0,italicHeading:!1,borderRadiusBase:4,gutter:20,controlHeightBase:40,boxShadowBase:"0 2px 8px rgba(0, 0, 0, .15)",boxShadowElevationOne:"0 1px 3px rgba(0, 0, 0, 0.01), 0 1px 2px rgba(0, 0, 0, 0.06)",boxShadowHover:"0 3px 6px rgba(0,0,0,0.01), 0 3px 6px rgba(0,0,0,0.06)",boxShadowBottom:"0 2px 3px rgba(0, 0, 0, 0.01), 0 2px 2px rgba(0, 0, 0, 0.06)",boxShadowTop:"0 -1px 2px rgba(0, 0, 0, 0.01), 0 -2px 6px rgba(0, 0, 0, 0.06)",boxShadowRight:"1px 0 3px 0 rgba(0,0,0,0.01), 1px 0 2px 0 rgba(0,0,0,0.06)",boxShadowInset:"inset -1px 0 3px 0 rgba(0, 0, 0, 0.01), inset -2px 2px 6px 0 rgba(0,0,0,0.06)",boxShadowNoneFocus:"0 0 0 0 transparent",boxShadow1dp:"0 1px 1px 0 rgba(0,0,0,0.14), 0 2px 1px -1px rgba(0,0,0,0.12), 0 1px 3px 0 rgba(0,0,0,0.20)",boxShadow2dp:"0 2px 2px 0 rgba(0,0,0,0.14), 0 3px 1px -2px rgba(0,0,0,0.12), 0 1px 5px 0 rgba(0,0,0,0.20)",boxShadow3dp:"0 3px 4px 0 rgba(0,0,0,0.14), 0 3px 3px -2px rgba(0,0,0,0.12), 0 1px 8px 0 rgba(0,0,0,0.20)",boxShadow4dp:"0 4px 5px 0 rgba(0,0,0,0.14), 0 1px 10px 0 rgba(0,0,0,0.12), 0 2px 4px -1px rgba(0,0,0,0.20)",boxShadow6dp:"0 6px 10px 0 rgba(0,0,0,0.14), 0 1px 18px 0 rgba(0,0,0,0.12), 0 3px 5px -1px rgba(0,0,0,0.20)",boxShadow8dp:"0 8px 10px 1px rgba(0,0,0,0.14), 0 3px 14px 2px rgba(0,0,0,0.12), 0 5px 5px -3px rgba(0,0,0,0.20)",boxShadow9dp:"0 9px 12px 1px rgba(0,0,0,0.14), 0 3px 16px 2px rgba(0,0,0,0.12), 0 5px 6px -3px rgba(0,0,0,0.20)",boxShadow12dp:"0 12px 17px 2px rgba(0,0,0,0.14), 0 5px 22px 4px rgba(0,0,0,0.12), 0 7px 8px -4px rgba(0,0,0,0.20)",boxShadow16dp:"0 16px 24px 2px rgba(0,0,0,0.14), 0 6px 30px 5px rgba(0,0,0,0.12), 0 8px 10px -5px rgba(0,0,0,0.20)",boxShadow24dp:"0 24px 38px 3px rgba(0,0,0,0.14), 0 9px 46px 8px rgba(0,0,0,0.12), 0 11px 15px -7px rgba(0,0,0,0.20)",transition:"300ms ease-out",transitionControl:"200ms ease-out",transitionBeizer:"300ms cubic-bezier(0.755, 0.05, 0.855, 0.06)",springConfigGeneral:a.config.gentle,springConfigStiff:a.config.stiff,springConfigSlow:a.config.slow,breakpoints:{tablet:600,desktop:984,desktopHd:1200}};function d(e){var t,o,r,a,d,s;const m=null!==(t=e.neutrals)&&void 0!==t?t:l.neutrals,b=null!==(o=e.red)&&void 0!==o?o:l.red,h=null!==(r=e.green)&&void 0!==r?r:l.green,u=null!==(a=e.yellow)&&void 0!==a?a:l.yellow;return{successColor:h[600],warningColor:u[500],errorColor:b[600],errorBackgroundColor:b["050"],successBackgroundColor:h["050"],warningBackgroundColor:u["050"],primaryLightColor:e.primary[400],primaryColor:e.primary[500],primaryDarkColor:e.primary[700],primaryBackgroundColor:e.primary["050"],primaryBgText:"#ffffff",accentColor:null!==(d=null===(s=e.accent)||void 0===s?void 0:s[700])&&void 0!==d?d:e.primary[800],greyLightColor:m[400],greyColor:m[500],greyDarkColor:m[700],greyBgText:"#ffffff",backgroundShade:m["050"],backgroundControl:Object(n.b)(.05,m[100]),backgroundHover:Object(n.a)(.05,m["050"]),appBackgroundColor:"#ffffff",linkColor:e.primary[500],headingColor:m[800],textColor:m[900],textColorSecondary:m[500],darkTextColor:m[900],lightTextColor:m["050"],disabledColor:m[200],disabledBackgroundColor:Object(n.b)(.05,m[100]),borderColorBase:m[300],borderColorSplit:m[200],borderColorLight:m[100],backgroundSelected:m[100],borderColorError:b[300],boxShadowControlFocus:`0 0 0 ${Object(i.g)(3)} ${Object(n.c)(.8,e.primary[500])}`,boxShadowControlFocusError:`0 0 0 ${Object(i.g)(3)} ${Object(n.c)(.8,b[500])}`,boxShadowControlFocusSuccess:`0 0 0 ${Object(i.g)(3)} ${Object(n.c)(.8,h[500])}`,boxShadowFocus:`0 0 0 2px ${Object(n.c)(.5,e.primary[500])}`,...c,dark:{successColor:h[300],warningColor:u[300],errorColor:b[300],errorBackgroundColor:b[900],successBackgroundColor:h[900],warningBackgroundColor:u[900],primaryBackgroundColor:e.primary[800],backgroundShade:m[800],backgroundControl:Object(n.b)(.05,m[700]),backgroundHover:Object(n.a)(.05,m[800]),appBackgroundColor:m[900],linkColor:e.primary[200],headingColor:m[200],textColor:m["050"],textColorSecondary:m[200],darkTextColor:m[100],lightTextColor:m[700],disabledColor:m[600],disabledBackgroundColor:Object(n.b)(.04,m[900]),borderColorBase:m[500],borderColorSplit:m[600],borderColorLight:m[700],backgroundSelected:m[700],borderColorError:b[600],boxShadowControlFocus:`0 0 0 ${Object(i.g)(3)} ${Object(n.c)(.8,e.primary[500])}`,boxShadowControlFocusError:`0 0 0 ${Object(i.g)(3)} ${Object(n.c)(.8,b[500])}`,boxShadowControlFocusSuccess:`0 0 0 ${Object(i.g)(3)} ${Object(n.c)(.8,h[500])}`,boxShadowFocus:`0 0 0 2px ${Object(n.c)(.5,e.primary[500])}`}}}const s=d({primary:{"050":"#E6F6FF",100:"#BAE3FF",200:"#7CC4FA",300:"#47A3F3",400:"#2186EB",500:"#0967D2",600:"#0552B5",700:"#03449E",800:"#01337D",900:"#002159"},accent:{700:"#099AA4"}}),m=d({primary:{"050":"#EFFCF6",100:"#C6F7E2",200:"#8EEDC7",300:"#65D6AD",400:"#3EBD93",500:"#27AB83",600:"#199473",700:"#147D64",800:"#0C6B58",900:"#014D40"},accent:{700:"#421987"}}),b=d({primary:{"050":"#c5d9ed",100:"#f0f0f1",200:"#72aee6",300:"#4f94d4",400:"#3582c4",500:"#2271b1",600:"#135e96",700:"#0a4b78",800:"#043959",900:"#01263a"},neutrals:{"050":"#dcdcde",100:"#c3c4c7",200:"#a7aaad",300:"#8c8f94",400:"#787c82",500:"#646970",600:"#50575e",700:"#3c434a",800:"#2c3338",900:"#1d2327"},red:{"050":"#facfd2",100:"#ffabaf",200:"#ff8085",300:"#f86368",400:"#e65054",500:"#d63638",600:"#b32d2e",700:"#8a2424",800:"#691c1c",900:"#451313"},green:{"050":"#b8e6bf",100:"#68de7c",200:"#1ed14b",300:"#00ba37",400:"#00a32a",500:"#008a20",600:"#007017",700:"#005c12",800:"#00450c",900:"#003008"},yellow:{"050":"#f5e6ab",100:"#f2d675",200:"#f0c33c",300:"#dba617",400:"#bd8600",500:"#996800",600:"#755100",700:"#614200",800:"#4a3200",900:"#362400"}}),h=d({primary:{"050":"#FFEBEE",100:"#FFCDD2",200:"#EF9A9A",300:"#E57373",400:"#F44336",500:"#E53935",600:"#E53935",700:"#D32F2F",800:"#C62828",900:"#B71C1C"},accent:{700:"#D50000"}}),u=d({primary:{"050":"#FCE4EC",100:"#F8BBD0",200:"#F48FB1",300:"#F06292",400:"#E91E63",500:"#D81B60",600:"#D81B60",700:"#C2185B",800:"#AD1457",900:"#880E4F"},accent:{700:"#C51162"}}),g=d({primary:{"050":"#F3E5F5",100:"#E1BEE7",200:"#CE93D8",300:"#BA68C8",400:"#AB47BC",500:"#9C27B0",600:"#8E24AA",700:"#7B1FA2",800:"#6A1B9A",900:"#4A148C"},accent:{700:"#AA00FF"}}),p=d({primary:{"050":"#EDE7F6",100:"#D1C4E9",200:"#B39DDB",300:"#9575CD",400:"#7E57C2",500:"#673AB7",600:"#5E35B1",700:"#512DA8",800:"#4527A0",900:"#311B92"},accent:{700:"#6200EA"}}),f=d({primary:{"050":"#E8EAF6",100:"#C5CAE9",200:"#9FA8DA",300:"#7986CB",400:"#5C6BC0",500:"#3F51B5",600:"#3949AB",700:"#303F9F",800:"#283593",900:"#1A237E"},accent:{700:"#304FFE"}}),$=d({primary:{"050":"#E3F2FD",100:"#BBDEFB",200:"#90CAF9",300:"#64B5F6",400:"#2196F3",500:"#1E88E5",600:"#1E88E5",700:"#1976D2",800:"#1565C0",900:"#0D47A1"},accent:{700:"#2962FF"}}),E=d({primary:{"050":"#EFEBE9",100:"#D7CCC8",200:"#BCAAA4",300:"#A1887F",400:"#8D6E63",500:"#795548",600:"#6D4C41",700:"#5D4037",800:"#4E342E",900:"#3E2723"}}),O=d({primary:{"050":"#FAFAFA",100:"#F5F5F5",200:"#EEEEEE",300:"#E0E0E0",400:"#9E9E9E",500:"#757575",600:"#757575",700:"#616161",800:"#424242",900:"#212121"}}),y=d({primary:{"050":"#ECEFF1",100:"#CFD8DC",200:"#B0BEC5",300:"#90A4AE",400:"#78909C",500:"#607D8B",600:"#546E7A",700:"#455A64",800:"#37474F",900:"#263238"}}),w=new r.a("WPEForm Themes");w.addItem("vividblue",{name:"Vivid Blue",config:s}),w.addItem("teal",{name:"Teal",config:m}),w.addItem("wp",{name:"WordPress 5.7 Palette",config:b}),w.addItem("materialblue",{name:"Material Blue",config:$}),w.addItem("materialbluegray",{name:"Material Blue Gray",config:y}),w.addItem("materialbrown",{name:"Material Brown",config:E}),w.addItem("materialdeeppurple",{name:"Material Deep Purple",config:p}),w.addItem("materialgray",{name:"Material Gray",config:O}),w.addItem("materialindigo",{name:"Material Indigo",config:f}),w.addItem("materialpink",{name:"Material Pink",config:u}),w.addItem("materialpurple",{name:"Material Purple",config:g}),w.addItem("materialred",{name:"Material Red",config:h})},68:function(e,t,o){"use strict";o.d(t,"b",(function(){return d})),o.d(t,"a",(function(){return s}));var r=o(0),a=o.n(r),n=o(7),i=o(30),l=o(31),c=o(32);const d=a.a.createElement(l.b,null,a.a.createElement("p",null,Object(n.__)("No further configuration is necessary. You can change configuration from WPEForm → Settings page.","wp-eform")),a.a.createElement("p",{className:"muted"},Object(n.__)("Make sure to set this page as Summary page under WPEForm → Settings.","wp-eform")));function s(e){const t=e.blockProps;return a.a.createElement("div",t,a.a.createElement(c.a,null,a.a.createElement(i.a,{heading:Object(n.__)("Summary page","wp-eform")},d)))}},69:function(e,t,o){"use strict";o.d(t,"b",(function(){return d})),o.d(t,"a",(function(){return s}));var r=o(0),a=o.n(r),n=o(7),i=o(30),l=o(31),c=o(32);const d=a.a.createElement(l.b,null,a.a.createElement("p",null,Object(n.__)("No further configuration is necessary. You can change configuration from WPEForm → Settings page.","wp-eform")),a.a.createElement("p",{className:"muted"},Object(n.__)("Make sure to set this page as User portal page under WPEForm → Settings.","wp-eform")));function s(e){const t=e.blockProps;return a.a.createElement("div",t,a.a.createElement(c.a,null,a.a.createElement(i.a,{heading:Object(n.__)("User portal page","wp-eform")},d)))}},7:function(e,t){e.exports=window.wp.i18n},70:function(e,t,o){"use strict";(function(e){o.d(t,"a",(function(){return c}));var r=o(115),a=o(114),n=o(113);const i=new r.a({addTypename:!0,resultCaching:!0,typePolicies:{FormElementConfigMcqOptionType:{keyFields:!1},CategoryType:{keyFields:["id"]},FormType:{keyFields:["id"]},IntegrationCustomDataType:{keyFields:!1},FormPaymentsCouponItemType:{keyFields:!1},FormScoreItemType:{keyFields:!1},FormScoreDesignationType:{keyFields:!1},FormScoreTotalRedirectionItemType:{keyFields:!1},FormScorePercentageRedirectionItemType:{keyFields:!1},FormScoreConditionalRedirectionItemType:{keyFields:!1},ConditionalEventType:{keyFields:!1},FormStructureType:{keyFields:!1},FormElementType:{keyFields:!1},FormElementAppearanceWidthType:{keyFields:!1},FormElementConfigButtonType:{keyFields:!1},ElementScoreConditionType:{keyFields:!1},FormElementConfigMaskRegExpType:{keyFields:!1},FormPoolType:{keyFields:!1},ConditionalType:{keyFields:!1},ConditionalConsequenceType:{keyFields:!1},User:{keyFields:["id"]},FormLimitationMessageType:{keyFields:!1},FormNodeType:{keyFields:["id"]},FormMetaPaymentGatewayType:{keyFields:!1},FormIntegrationMailChimpListItemType:{keyFields:!1},SubmissionType:{keyFields:["id"]},FormSubmissionElementType:{keyFields:!1},SubmissionNodeType:{keyFields:["id"]},SubmissionMetaOwnerType:{keyFields:!1},FormMetaOwnerType:{keyFields:!1},SubmissionMetaCategoryType:{keyFields:!1},FormMetaCategoryType:{keyFields:!1}}});"undefined"!=typeof window&&(window.wpeformApolloCache=i);let l="/graphql";try{"string"==typeof e.env.WPEFORM_GQL_URI&&(l=e.env.WPEFORM_GQL_URI)}catch(e){}"undefined"!=typeof WPEFormGraphQLApp&&(l=WPEFormGraphQLApp.gqlUri);const c=new a.a({cache:i,link:new n.a({uri:l})})}).call(this,o(78))},73:function(e,t,o){"use strict";o.d(t,"a",(function(){return A}));var r=o(0),a=o.n(r),n=o(7),i=o(151),l=o(152),c=o(61),d=o(11),s=o(10),m=o(3),b=o(1);const h="wpeform-component-skeleton",u=Object(b.c)(h,"gutter"),g=m.d.div`
	${b.a};
	&.${h}--large {
		margin-bottom: ${e=>Object(b.g)(e.theme.gutter)};
	}
	&.${h}--small {
		margin-bottom: ${e=>Object(b.g)(e.theme.gutter/2)};
	}
	&.${h}--para {
		margin-bottom: ${e=>Object(b.g)(.75*e.theme.fz.base)};
	}
	&.${h}--h1 {
		margin-bottom: ${e=>Object(b.g)(1.5*e.theme.fz.large5*.6)};
	}
	&.${h}--h2 {
		margin-bottom: ${e=>Object(b.g)(1.5*e.theme.fz.large3*.6)};
	}
	&.${h}--h3 {
		margin-bottom: ${e=>Object(b.g)(1.5*e.theme.fz.large2*.6)};
	}
	&.${h}--h4 {
		margin-bottom: ${e=>Object(b.g)(1.5*e.theme.fz.base*.6)};
	}
	&.${h}--h5 {
		margin-bottom: ${e=>Object(b.g)(1.5*e.theme.fz.small1*.6)};
	}
	&.${h}--h6 {
		margin-bottom: ${e=>Object(b.g)(1.5*e.theme.fz.small2*.6)};
	}
	&.${h}--mb {
		margin-bottom: ${e=>{var t;return Object(b.g)(null!==(t=e.marginBottom)&&void 0!==t?t:0)}};
	}
	&:last-child {
		margin-bottom: 0;
	}
	&.${h}--inline {
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
		${e=>Object(s.a)(.01,e.theme.backgroundControl)} 25%,
		${e=>Object(s.a)(.05,e.theme.backgroundControl)} 37%,
		${e=>Object(s.a)(.01,e.theme.backgroundControl)} 63%
	);
	background-size: 400% 100%;
	animation: ${p} 1.4s ease infinite;
	will-change: background-position;
	&.${u}--shape-rectangle {
		border-radius: ${e=>Object(b.g)(e.theme.borderRadiusBase)};
	}
	&.${u}--shape-circle {
		border-radius: 50%;
	}
	max-width: 100%;
	&.${u}--color-darker {
		background-image: linear-gradient(
			90deg,
			${e=>Object(s.a)(.03,e.theme.backgroundControl)} 25%,
			${e=>Object(s.a)(.08,e.theme.backgroundControl)} 37%,
			${e=>Object(s.a)(.03,e.theme.backgroundControl)} 63%
		);
	}
	&.${u}--inline {
		display: inline-block;
		vertical-align: middle;
	}
`;function $(e){const t=e.height,o=e.shape,r=e.width,n=e.className,i=e.marginBottom,l=e.color,c=void 0===l?"normal":l,d=e.inline,s=void 0!==d&&d,m={};"string"==typeof i?m[`${i}`]=!0:"number"==typeof i&&(m.mb=!0),m.inline=s;const p=Object(b.b)(h,m,n),$=Object(b.b)(u,{[`shape-${o}`]:!0,[`color-${c}`]:!0,inline:s},n);return a.a.createElement(g,{className:p,marginBottom:"number"==typeof i?i:void 0},a.a.createElement(f,{className:$,style:{width:"number"==typeof r?Object(b.g)(r):r,height:"number"==typeof t?Object(b.g)(t):t}}))}function E(e){const t=Object(m.f)(),o=e.width,r=e.className,n=e.marginBottom,i=e.inline;return a.a.createElement($,{marginBottom:"number"==typeof n?n:"para",width:o,height:1.5*t.fz.base,shape:"rectangle",className:r,inline:i})}function O(e){const t=Object(m.f)(),o=e.width,r=e.level,n=e.className,i=e.marginBottom;let l=1.5*t.fz.large5;return 2===r?l=1.5*t.fz.large3:3===r?l=1.5*t.fz.large2:4===r?l=1.5*t.fz.large1:5===r?l=1.5*t.fz.small1:6===r&&(l=1.5*t.fz.small2),a.a.createElement($,{marginBottom:"number"==typeof i?i:`h${r}`,width:o,height:l,shape:"rectangle",className:n})}function y(e){const t=e.className,o=Object(m.f)(),r=Object(b.e)(.7*o.controlHeightBase);return a.a.createElement($,{height:r,width:r,className:t,shape:"rectangle"})}function w(e){const t=e.className,o=Object(m.f)(),r=Object(b.e)(.7*o.controlHeightBase);return a.a.createElement($,{height:r,width:r,className:t,shape:"circle"})}const C=m.d.div`
	display: flex;
	flex-flow: row nowrap;
	align-items: center;
	justify-content: flex-start;
`,j=m.d.div`
	flex: 0 0
		${e=>Object(b.g)(Object(b.e)(.7*e.theme.controlHeightBase))};
	margin: 0 ${e=>Object(b.g)(e.theme.gutter/2)} 0 0;
`,x=m.d.div`
	flex: 1 0 auto;
`,v=Object(b.c)(h,"mcq-option");const k=Object(b.c)(h,"label"),B=m.d.div`
	margin: 0 0 ${e=>Object(b.g)(e.theme.gutter/2)} 0;
`;$.Paragraph=E,$.Heading=O,$.Avatar=function(e){return a.a.createElement($,Object.assign({},e,{width:e.height,shape:"circle"}))},$.Checkbox=y,$.Radio=w,$.Text=function(e){const t=Object(m.f)();return a.a.createElement($,Object.assign({height:t.controlHeightBase,shape:"rectangle",width:"100%"},e))},$.Textarea=function(e){const t=Object(m.f)();return a.a.createElement($,Object.assign({height:4*t.controlHeightBase,shape:"rectangle",width:"100%"},e))},$.MCQOption=function(e){const t=Object(m.f)(),o=e.className,r=e.type,n=e.width,i=t.fz.base;return a.a.createElement(C,{className:Object(b.b)(v,{[`type-${r}`]:!0},o)},a.a.createElement(j,null,"radio"===r?a.a.createElement(w,null):a.a.createElement(y,null)),a.a.createElement(x,null,a.a.createElement($,{shape:"rectangle",height:i,width:n})))},$.Label=function(e){const t=Object(m.f)(),o=e.titleWidth,r=e.subtitleWidth,n=e.className;return a.a.createElement(B,{className:Object(b.b)(k,void 0,n)},a.a.createElement(E,{width:o,marginBottom:t.gutter/4}),a.a.createElement(O,{width:r,marginBottom:t.fz.base-t.fz.small2,level:6}))};var S=o(17),T=o(29);const F=i.a`
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
`;function A(e){const t=Object(l.a)(F),o=t.data,i=t.loading,s=t.error,m=e.value,b=e.onChange,h=e.label,u=void 0===h?Object(n.__)("Select a Form","wp-eform"):h,g=Object(r.useMemo)((()=>{var e;return null!=o&&null!==(e=o.forms)&&void 0!==e&&e.edges.length?o.forms.edges.map((e=>({label:e.node.name,plain:e.node.name,value:e.node.id}))):[]}),[o]);return a.a.createElement(T.a,{label:u},(e=>s?Object(n.__)("Could not load forms. Please refresh the page.","wp-eform"):i?a.a.createElement($.Text,null):a.a.createElement(c.a,{items:g,mode:d.c.SINGLE,onChange:e=>{e[0]?b(e[0]):b("")},value:""===m?[]:[m],placeholder:Object(n.__)("please select a form","wp-eform"),controlType:d.f.BOXY,id:e,prefix:a.a.createElement(S.b,{iconClass:"fas fa-clipboard"})})))}}},[[127,0,1,4]]]);
//# sourceMappingURL=shortcodeGenerator-7f4644d5.js.map