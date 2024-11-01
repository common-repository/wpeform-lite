/*! For license information please see 37-01245995.js.LICENSE.txt */
(window.wpackiowpqEformadminJsonp=window.wpackiowpqEformadminJsonp||[]).push([[37],{1037:function(e,t,n){"use strict";n.d(t,"a",(function(){return b})),n.d(t,"b",(function(){return O}));var r=n(0),a=n.n(r);function l(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function i(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,r)}return n}function o(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?i(Object(n),!0).forEach((function(t){l(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):i(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function c(e,t){if(null==e)return{};var n,r,a=function(e,t){if(null==e)return{};var n,r,a={},l=Object.keys(e);for(r=0;r<l.length;r++)n=l[r],t.indexOf(n)>=0||(a[n]=e[n]);return a}(e,t);if(Object.getOwnPropertySymbols){var l=Object.getOwnPropertySymbols(e);for(r=0;r<l.length;r++)n=l[r],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(a[n]=e[n])}return a}var s=a.a.createContext({}),u=function(e){var t=a.a.useContext(s),n=t;return e&&(n="function"==typeof e?e(t):o(o({},t),e)),n},b=function(e){var t=u(e.components);return a.a.createElement(s.Provider,{value:t},e.children)},p={inlineCode:"code",wrapper:function(e){var t=e.children;return a.a.createElement(a.a.Fragment,{},t)}},m=a.a.forwardRef((function(e,t){var n=e.components,r=e.mdxType,l=e.originalType,i=e.parentName,s=c(e,["components","mdxType","originalType","parentName"]),b=u(n),m=r,O=b["".concat(i,".").concat(m)]||b[m]||p[m]||l;return n?a.a.createElement(O,o(o({ref:t},s),{},{components:n})):a.a.createElement(O,o({ref:t},s))}));function O(e,t){var n=arguments,r=t&&t.mdxType;if("string"==typeof e||r){var l=n.length,i=new Array(l);i[0]=m;var o={};for(var c in t)hasOwnProperty.call(t,c)&&(o[c]=t[c]);o.originalType=e,o.mdxType="string"==typeof e?e:r,i[1]=o;for(var s=2;s<l;s++)i[s]=n[s];return a.a.createElement.apply(null,i)}return a.a.createElement.apply(null,n)}m.displayName="MDXCreateElement"},1192:function(e,t,n){"use strict";n.r(t),n.d(t,"frontMatter",(function(){return o})),n.d(t,"default",(function(){return s}));n(0);var r=n(1037),a=n.p+"admin/assets/interface-ss-13e53cc9.png",l=n.p+"admin/assets/attributes-ss-3ec7b0e6.png",i=n.p+"admin/assets/validation-type-ss-bcb5ee8c.png";const o={slug:"wpeform-textarea-element-documentation",title:"Add and configure Multi Line Input Element in WPEForm",menuName:"Multi Line Input",featuredImage:"../multi-line-element.png",type:"input",order:0,neededPlan:"free"},c={frontMatter:o};function s({components:e,...t}){return Object(r.b)("wrapper",Object.assign({},c,t,{components:e,mdxType:"MDXLayout"}),Object(r.b)("p",null,"Multi line input is the ",Object(r.b)("inlineCode",{parentName:"p"},"textarea")," element with advanced styling and features.\nIt lets you collect multi line text input from user."),Object(r.b)("h3",null,"CHANGING PLACEHOLDER AND ICON"),Object(r.b)("p",null,"From ",Object(r.b)("strong",{parentName:"p"},"INTERFACE")," tab, you can change the text input placeholder and icon."),Object(r.b)("p",null,Object(r.b)("img",{src:a,alt:"Interface Screenshot"})),Object(r.b)("p",null,Object(r.b)("strong",{parentName:"p"},"NOTE"),": If you have set Layout to ",Object(r.b)("strong",{parentName:"p"},"INLINE")," from ",Object(r.b)("strong",{parentName:"p"},"APPEARANCE")," then the\nelement title will be used as placeholder instead."),Object(r.b)("h3",null,"PREFIL AND DEFAULTS"),Object(r.b)("p",null,"From ",Object(r.b)("strong",{parentName:"p"},"ATTRIBUTES")," you can set default values and URL/META based prefils. Here\nis an example of URL parameter based prefil."),Object(r.b)("p",null,Object(r.b)("img",{src:l,alt:"Attributes Screenshot"})),Object(r.b)("p",null,"With the above settings, you can navigate to the URL with\n",Object(r.b)("inlineCode",{parentName:"p"},"?input=Coming+from+frontpage")," then ",Object(r.b)("inlineCode",{parentName:"p"},'"Coming from frontpage"')," will be set as\ndefault value. If the parameter is not present, the the value"),Object(r.b)("pre",null,Object(r.b)("code",{parentName:"pre"},"Unknown address.\nPlease contact over email.\n")),Object(r.b)("p",null,"will be set instead."),Object(r.b)("p",null,"The logic is same with Meta based prefil."),Object(r.b)("h3",null,"SCORE"),Object(r.b)("p",null,"Multi line input allows for automated scoring. Based on some condition, score\ncan be added to any of the outcomes. All comparisons are ",Object(r.b)("em",{parentName:"p"},"case insensitive")," and\nthe search happens on all the lines."),Object(r.b)("ol",null,Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"EQUAL TO")," - Works for string and numeric value, if user input and given\nvalue are equal."),Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"CONTAINING")," - Works for string value only. If user input contains the\ngiven value."),Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"STARTING WITH")," - Works for string value only. If user input is starting\nwith the given value."),Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"ENDING WITH")," - Works for string value only. If user input is ending with\nthe given value."),Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"GREATER THAN")," - Works for numeric value only, if user input is greater\nthan the given value."),Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"LESS THAN")," - Works for numeric value only, if user input is less than the\ngiven value.")),Object(r.b)("h3",null,"NUMERIC VALUE"),Object(r.b)("p",null,"Will try to parse the user input for a numeric value (in float). If it is\ninvalid then ",Object(r.b)("inlineCode",{parentName:"p"},"0")," will be used instead."),Object(r.b)("h3",null,"CONDITIONAL EVENT"),Object(r.b)("h4",null,"VALUE BASED"),Object(r.b)("p",null,"Value based comparison is same as score condition."),Object(r.b)("ol",null,Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"EQUAL TO")," - Works for string and numeric value, if user input and given\nvalue are equal."),Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"CONTAINING")," - Works for string value only. If user input contains the\ngiven value."),Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"STARTING WITH")," - Works for string value only. If user input is starting\nwith the given value."),Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"ENDING WITH")," - Works for string value only. If user input is ending with\nthe given value."),Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"GREATER THAN")," - Works for numeric value only, if user input is greater\nthan the given value."),Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"LESS THAN")," - Works for numeric value only, if user input is less than the\ngiven value.")),Object(r.b)("h4",null,"LENGTH BASED"),Object(r.b)("p",null,"The length of the characters of the user input is compared against the given\nvalue."),Object(r.b)("ol",null,Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"EQUAL TO")," - If input character length is equal to the given value."),Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"GREATER THAN")," - If input character length is greater than the given value."),Object(r.b)("li",{parentName:"ol"},Object(r.b)("strong",{parentName:"li"},"LESS THAN")," - If input character length is less than the given value.")),Object(r.b)("h3",null,"VALIDATION"),Object(r.b)("p",null,"Multi line input has a very advanced validation system. You can access it from\n",Object(r.b)("strong",{parentName:"p"},"VALIDATION")," tab."),Object(r.b)("p",null,Object(r.b)("img",{src:i,alt:"Validation Screenshot"})),Object(r.b)("p",null,"Following validations are available."),Object(r.b)("ul",null,Object(r.b)("li",{parentName:"ul"},Object(r.b)("strong",{parentName:"li"},"Type")," - Choose from a preset value of type to filter with."),Object(r.b)("li",{parentName:"ul"},Object(r.b)("strong",{parentName:"li"},"Minimum length")," - When type is set to string type inputs, you can specify\nthe minimum length required."),Object(r.b)("li",{parentName:"ul"},Object(r.b)("strong",{parentName:"li"},"Maximum length")," - When type is set to string type inputs, you can specify\nthe maximum length required.")))}s.isMDXComponent=!0}}]);
//# sourceMappingURL=37-01245995.js.map