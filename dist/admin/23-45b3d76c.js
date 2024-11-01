/*! For license information please see 23-45b3d76c.js.LICENSE.txt */
(window.wpackiowpqEformadminJsonp=window.wpackiowpqEformadminJsonp||[]).push([[23],{1037:function(e,t,n){"use strict";n.d(t,"a",(function(){return b})),n.d(t,"b",(function(){return O}));var r=n(0),o=n.n(r);function a(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function l(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function i(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?l(Object(n),!0).forEach((function(t){a(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):l(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function c(e,t){if(null==e)return{};var n,r,o=function(e,t){if(null==e)return{};var n,r,o={},a=Object.keys(e);for(r=0;r<a.length;r++)n=a[r],t.indexOf(n)>=0||(o[n]=e[n]);return o}(e,t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);for(r=0;r<a.length;r++)n=a[r],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(o[n]=e[n])}return o}var s=o.a.createContext({}),p=function(e){var t=o.a.useContext(s),n=t;return e&&(n="function"==typeof e?e(t):i(i({},t),e)),n},b=function(e){var t=p(e.components);return o.a.createElement(s.Provider,{value:t},e.children)},u={inlineCode:"code",wrapper:function(e){var t=e.children;return o.a.createElement(o.a.Fragment,{},t)}},m=o.a.forwardRef((function(e,t){var n=e.components,r=e.mdxType,a=e.originalType,l=e.parentName,s=c(e,["components","mdxType","originalType","parentName"]),b=p(n),m=r,O=b["".concat(l,".").concat(m)]||b[m]||u[m]||a;return n?o.a.createElement(O,i(i({ref:t},s),{},{components:n})):o.a.createElement(O,i({ref:t},s))}));function O(e,t){var n=arguments,r=t&&t.mdxType;if("string"==typeof e||r){var a=n.length,l=new Array(a);l[0]=m;var i={};for(var c in t)hasOwnProperty.call(t,c)&&(i[c]=t[c]);i.originalType=e,i.mdxType="string"==typeof e?e:r,l[1]=i;for(var s=2;s<a;s++)l[s]=n[s];return o.a.createElement.apply(null,l)}return o.a.createElement.apply(null,n)}m.displayName="MDXCreateElement"},1116:function(e,t,n){"use strict";t.a=n.p+"admin/assets/numeric-ss-bef5b835.png"},1131:function(e,t,n){"use strict";t.a=n.p+"admin/assets/interface-ss-1e97050a.png"},1132:function(e,t,n){"use strict";t.a=n.p+"admin/assets/attribute-ss-bb91269c.png"},1178:function(e,t,n){"use strict";n.r(t),n.d(t,"frontMatter",(function(){return i})),n.d(t,"default",(function(){return s}));n(0);var r=n(1037),o=n(1131),a=n(1132),l=n(1116);const i={slug:"wpeform-checkbox-element-documentation",title:"Add and configure Multiple Options Element in WPEForm",menuName:"Multiple Options",featuredImage:"../multiple-option-element.png",type:"choice",order:0,neededPlan:"free"},c={frontMatter:i};function s({components:e,...t}){return Object(r.b)("wrapper",Object.assign({},c,t,{components:e,mdxType:"MDXLayout"}),Object(r.b)("p",null,"Select multiple options from a list of options. This is the\n",Object(r.b)("inlineCode",{parentName:"p"},'input[type="checkbox"]')," element with advanced styling. Use this when you have\nsmall number of options the user could select from. For larger options, use the\nDropdown element."),Object(r.b)("h3",null,"INTERFACE"),Object(r.b)("p",null,Object(r.b)("img",{src:o.a,alt:"Interface Screenshot"})),Object(r.b)("p",null,"From interface, you can set the options of the checkbox element. Scroll to the\n",Object(r.b)("strong",{parentName:"p"},"Options")," control and add your options through the interface. There are also a\nfew interesting configuration available here."),Object(r.b)("ul",null,Object(r.b)("li",{parentName:"ul"},Object(r.b)("strong",{parentName:"li"},"Shuffle order")," - Enable this to shuffle the option list when presenting to\nthe form. Useful for quizzes."),Object(r.b)("li",{parentName:"ul"},Object(r.b)("strong",{parentName:"li"},"Column size")," - By default options render next to each other, taking up\nspace as required. You can change this behavior here.")),Object(r.b)("h3",null,"PREFIL AND DEFAULTS"),Object(r.b)("p",null,"From ",Object(r.b)("strong",{parentName:"p"},"ATTRIBUTES")," you can set default values and URL/META based prefils. Here\nis an example of URL parameter based prefil."),Object(r.b)("p",null,Object(r.b)("img",{src:a.a,alt:"Attributes Screenshot"})),Object(r.b)("p",null,"With the above settings, you can navigate to the URL with\n",Object(r.b)("inlineCode",{parentName:"p"},"?mo1=Option+1&mo2=Option+2")," to have ",Object(r.b)("em",{parentName:"p"},"Option 1")," and ",Object(r.b)("em",{parentName:"p"},"Option 2")," pre-selected. Do\nnote, the match is against the text of the option label, all lowercased. If not\npresent, then ",Object(r.b)("em",{parentName:"p"},"Option 1")," and ",Object(r.b)("em",{parentName:"p"},"Option 4")," will be selected by default."),Object(r.b)("h3",null,"SCORE"),Object(r.b)("p",null,"Multiple Options element allows for automated scoring. Based on some condition,\nscore can be added to any of the outcomes. Two things to note:"),Object(r.b)("ol",null,Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"EQUAL TO")," - Will be true only when the given option(s) are selected, no\nmore, no less."),Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"CONTAINS")," - Will be true when the given option(s) or more are selected by\nthe user, not less.")),Object(r.b)("h3",null,"NUMERIC VALUE"),Object(r.b)("p",null,Object(r.b)("img",{src:l.a,alt:"Numeric value in option Screenshot"})),Object(r.b)("p",null,"Options can have numeric values assigned to them. These values are recalled when\nused in ",Object(r.b)("strong",{parentName:"p"},"Mathematical Output")," element. If more than one option is selected,\nthen the sum of the selected options are used. See the screenshot to know how to\nadd a numeric value from ",Object(r.b)("strong",{parentName:"p"},"INTERFACE"),"."),Object(r.b)("h3",null,"CONDITIONAL EVENT"),Object(r.b)("h4",null,"VALUE BASED"),Object(r.b)("ol",null,Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"EQUAL TO")," - Will be true only when the given option(s) are selected, no\nmore, no less."),Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"CONTAINS")," - Will be true when the given option(s) or more are selected by\nthe user, not less.")),Object(r.b)("h4",null,"LENGTH BASED"),Object(r.b)("p",null,"Will be true when number of option(s) selected by the user matches given value."))}s.isMDXComponent=!0}}]);
//# sourceMappingURL=23-45b3d76c.js.map