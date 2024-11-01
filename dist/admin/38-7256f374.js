/*! For license information please see 38-7256f374.js.LICENSE.txt */
(window.wpackiowpqEformadminJsonp=window.wpackiowpqEformadminJsonp||[]).push([[38],{1037:function(e,t,n){"use strict";n.d(t,"a",(function(){return p})),n.d(t,"b",(function(){return f}));var r=n(0),a=n.n(r);function l(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function o(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function c(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?o(Object(n),!0).forEach((function(t){l(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):o(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function i(e,t){if(null==e)return{};var n,r,a=function(e,t){if(null==e)return{};var n,r,a={},l=Object.keys(e);for(r=0;r<l.length;r++)n=l[r],t.indexOf(n)>=0||(a[n]=e[n]);return a}(e,t);if(Object.getOwnPropertySymbols){var l=Object.getOwnPropertySymbols(e);for(r=0;r<l.length;r++)n=l[r],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(a[n]=e[n])}return a}var b=a.a.createContext({}),u=function(e){var t=a.a.useContext(b),n=t;return e&&(n="function"==typeof e?e(t):c(c({},t),e)),n},p=function(e){var t=u(e.components);return a.a.createElement(b.Provider,{value:t},e.children)},s={inlineCode:"code",wrapper:function(e){var t=e.children;return a.a.createElement(a.a.Fragment,{},t)}},m=a.a.forwardRef((function(e,t){var n=e.components,r=e.mdxType,l=e.originalType,o=e.parentName,b=i(e,["components","mdxType","originalType","parentName"]),p=u(n),m=r,f=p["".concat(o,".").concat(m)]||p[m]||s[m]||l;return n?a.a.createElement(f,c(c({ref:t},b),{},{components:n})):a.a.createElement(f,c({ref:t},b))}));function f(e,t){var n=arguments,r=t&&t.mdxType;if("string"==typeof e||r){var l=n.length,o=new Array(l);o[0]=m;var c={};for(var i in t)hasOwnProperty.call(t,i)&&(c[i]=t[i]);c.originalType=e,c.mdxType="string"==typeof e?e:r,o[1]=c;for(var b=2;b<l;b++)o[b]=n[b];return a.a.createElement.apply(null,o)}return a.a.createElement.apply(null,n)}m.displayName="MDXCreateElement"},1195:function(e,t,n){"use strict";n.r(t),n.d(t,"frontMatter",(function(){return o})),n.d(t,"default",(function(){return i}));n(0);var r=n(1037),a=n.p+"admin/assets/interface-ss-0097f230.png",l=n.p+"admin/assets/attributes-ss-c52b55bd.png";const o={slug:"wpeform-toggle-element-documentation",title:"Add and configure Toggle Option Element in WPEForm",menuName:"Toggle Option",featuredImage:"../image.png",type:"choice",order:0,neededPlan:"starter"},c={frontMatter:o};function i({components:e,...t}){return Object(r.b)("wrapper",Object.assign({},c,t,{components:e,mdxType:"MDXLayout"}),Object(r.b)("p",null,"Toggle option is great for on/off type user input. It can either be selected or\nnot selected."),Object(r.b)("h3",null,"CHANGING LABELS AND ICONS"),Object(r.b)("p",null,"On and off state labels and icons can be changed through the ",Object(r.b)("strong",{parentName:"p"},"INTERFACE")," tab."),Object(r.b)("p",null,Object(r.b)("img",{src:a,alt:"Interface Screenshot"})),Object(r.b)("ul",null,Object(r.b)("li",{parentName:"ul"},"The labels are used in recall and in summary page."),Object(r.b)("li",{parentName:"ul"},"Icons are shown in the toggle UI.")),Object(r.b)("h3",null,"PREFIL AND DEFAULTS"),Object(r.b)("p",null,"From ",Object(r.b)("strong",{parentName:"p"},"ATTRIBUTES")," you can set default values and URL/META based prefils. Here\nis an example of URL parameter based prefil."),Object(r.b)("p",null,Object(r.b)("img",{src:l,alt:"Attributes Screenshot"})),Object(r.b)("p",null,"With the above settings, you can navigate to the URL with ",Object(r.b)("inlineCode",{parentName:"p"},"?toggle=true")," then\nthe toggle will be enabled by default. The value can be either of the\nfollowings:"),Object(r.b)("ul",null,Object(r.b)("li",{parentName:"ul"},Object(r.b)("inlineCode",{parentName:"li"},"true")," - Set the toggle element enabled."),Object(r.b)("li",{parentName:"ul"},Object(r.b)("inlineCode",{parentName:"li"},"false")," - Set the toggle element disabled.")),Object(r.b)("p",null,"Any other value is rejected and falls back to the default value."),Object(r.b)("p",null,"For meta based prefil, the user metadata must have a value that matches with the\nactive/inactive label of the element."),Object(r.b)("h3",null,"SCORE"),Object(r.b)("p",null,"Toggle element allows for automated score. The value can be compared with the\nuser input."),Object(r.b)("ol",null,Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"EQUAL TO")," - Works when user input is same as given value (either selected\nor unselected).")),Object(r.b)("h3",null,"NUMERIC VALUE"),Object(r.b)("p",null,"When the toggle element is enabled, it has a numeric value of ",Object(r.b)("inlineCode",{parentName:"p"},"1"),", otherwise it\nis ",Object(r.b)("inlineCode",{parentName:"p"},"0"),"."),Object(r.b)("h3",null,"CONDITIONAL EVENT"),Object(r.b)("p",null,"Only ",Object(r.b)("strong",{parentName:"p"},"VALUE")," based events are considered. It can either be ",Object(r.b)("strong",{parentName:"p"},"EQUAL TO")," the\nselected state or unselected state (just like score)."))}i.isMDXComponent=!0}}]);
//# sourceMappingURL=38-7256f374.js.map