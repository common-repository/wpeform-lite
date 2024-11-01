/*! For license information please see 36-53b70ce6.js.LICENSE.txt */
(window.wpackiowpqEformadminJsonp=window.wpackiowpqEformadminJsonp||[]).push([[36],{1037:function(e,t,n){"use strict";n.d(t,"a",(function(){return p})),n.d(t,"b",(function(){return O}));var a=n(0),r=n.n(a);function l(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function i(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function o(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?i(Object(n),!0).forEach((function(t){l(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):i(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function b(e,t){if(null==e)return{};var n,a,r=function(e,t){if(null==e)return{};var n,a,r={},l=Object.keys(e);for(a=0;a<l.length;a++)n=l[a],t.indexOf(n)>=0||(r[n]=e[n]);return r}(e,t);if(Object.getOwnPropertySymbols){var l=Object.getOwnPropertySymbols(e);for(a=0;a<l.length;a++)n=l[a],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(r[n]=e[n])}return r}var c=r.a.createContext({}),s=function(e){var t=r.a.useContext(c),n=t;return e&&(n="function"==typeof e?e(t):o(o({},t),e)),n},p=function(e){var t=s(e.components);return r.a.createElement(c.Provider,{value:t},e.children)},u={inlineCode:"code",wrapper:function(e){var t=e.children;return r.a.createElement(r.a.Fragment,{},t)}},m=r.a.forwardRef((function(e,t){var n=e.components,a=e.mdxType,l=e.originalType,i=e.parentName,c=b(e,["components","mdxType","originalType","parentName"]),p=s(n),m=a,O=p["".concat(i,".").concat(m)]||p[m]||u[m]||l;return n?r.a.createElement(O,o(o({ref:t},c),{},{components:n})):r.a.createElement(O,o({ref:t},c))}));function O(e,t){var n=arguments,a=t&&t.mdxType;if("string"==typeof e||a){var l=n.length,i=new Array(l);i[0]=m;var o={};for(var b in t)hasOwnProperty.call(t,b)&&(o[b]=t[b]);o.originalType=e,o.mdxType="string"==typeof e?e:a,i[1]=o;for(var c=2;c<l;c++)i[c]=n[c];return r.a.createElement.apply(null,i)}return r.a.createElement.apply(null,n)}m.displayName="MDXCreateElement"},1190:function(e,t,n){"use strict";n.r(t),n.d(t,"frontMatter",(function(){return b})),n.d(t,"default",(function(){return s}));n(0);var a=n(1037),r=n.p+"admin/assets/interface-eeac17a5.png",l=n.p+"admin/assets/attributes-ss-fe50ab7f.png",i=n.p+"admin/assets/mask-ss-5dc5af84.png",o=n.p+"admin/assets/validation-type-ss-9abcf9c4.png";const b={slug:"wpeform-text-element-documentation",title:"Add and configure Single Line Input Element in WPEForm",menuName:"Single Line Input",featuredImage:"../single-line-element.png",type:"input",order:0,neededPlan:"free"},c={frontMatter:b};function s({components:e,...t}){return Object(a.b)("wrapper",Object.assign({},c,t,{components:e,mdxType:"MDXLayout"}),Object(a.b)("p",null,"Single line input or simply a text input is the ",Object(a.b)("inlineCode",{parentName:"p"},'input[type="text"]')," element\nwith advanced features. It lets you collect text input from your users with a\nbunch of validation. This is also the same element used for"),Object(a.b)("ul",null,Object(a.b)("li",{parentName:"ul"},"First Name."),Object(a.b)("li",{parentName:"ul"},"Last Name."),Object(a.b)("li",{parentName:"ul"},"Email Address."),Object(a.b)("li",{parentName:"ul"},"Phone Number.")),Object(a.b)("p",null,"For the above element the validation is preset to accept only respective values."),Object(a.b)("h3",null,"CHANGING PLACEHOLDER AND ICON"),Object(a.b)("p",null,"From ",Object(a.b)("strong",{parentName:"p"},"INTERFACE")," tab, you can change the text input placeholder and icon."),Object(a.b)("p",null,Object(a.b)("img",{src:r,alt:"Interface Screenshot",title:"Interface Screenshot"})),Object(a.b)("p",null,Object(a.b)("strong",{parentName:"p"},"NOTE"),": If you have set Layout to ",Object(a.b)("strong",{parentName:"p"},"INLINE")," from ",Object(a.b)("strong",{parentName:"p"},"APPEARANCE")," then the\nelement title will be used as placeholder instead."),Object(a.b)("h3",null,"PREFIL AND DEFAULTS"),Object(a.b)("p",null,"From ",Object(a.b)("strong",{parentName:"p"},"ATTRIBUTES")," you can set default values and URL/META based prefils. Here\nis an example of URL parameter based prefil."),Object(a.b)("p",null,Object(a.b)("img",{src:l,alt:"Attributes Screenshot"})),Object(a.b)("p",null,"With the above settings, you can navigate to the URL with\n",Object(a.b)("inlineCode",{parentName:"p"},"?input=Coming+from+frontpage")," then ",Object(a.b)("inlineCode",{parentName:"p"},'"Coming from frontpage"')," will be set as\ndefault value. If the parameter is not present, the the value\n",Object(a.b)("inlineCode",{parentName:"p"},'"unknown referer"')," will be set instead."),Object(a.b)("p",null,"The logic is same with Meta based prefil."),Object(a.b)("h3",null,"SCORE"),Object(a.b)("p",null,"Single line input allows for automated scoring. Based on some condition, score\ncan be added to any of the outcomes. All comparisons are ",Object(a.b)("em",{parentName:"p"},"case insensitive"),"."),Object(a.b)("ol",null,Object(a.b)("li",{parentName:"ol"},Object(a.b)("strong",{parentName:"li"},"EQUAL TO")," - Works for string and numeric value, if user input and given\nvalue are equal."),Object(a.b)("li",{parentName:"ol"},Object(a.b)("strong",{parentName:"li"},"CONTAINING")," - Works for string value only. If user input contains the\ngiven value."),Object(a.b)("li",{parentName:"ol"},Object(a.b)("strong",{parentName:"li"},"STARTING WITH")," - Works for string value only. If user input is starting\nwith the given value."),Object(a.b)("li",{parentName:"ol"},Object(a.b)("strong",{parentName:"li"},"ENDING WITH")," - Works for string value only. If user input is ending with\nthe given value."),Object(a.b)("li",{parentName:"ol"},Object(a.b)("strong",{parentName:"li"},"GREATER THAN")," - Works for numeric value only, if user input is greater\nthan the given value."),Object(a.b)("li",{parentName:"ol"},Object(a.b)("strong",{parentName:"li"},"LESS THAN")," - Works for numeric value only, if user input is less than the\ngiven value.")),Object(a.b)("h3",null,"NUMERIC VALUE"),Object(a.b)("p",null,"Will try to parse the user input for a numeric value (in float). If it is\ninvalid then ",Object(a.b)("inlineCode",{parentName:"p"},"0")," will be used instead."),Object(a.b)("h3",null,"CONDITIONAL EVENT"),Object(a.b)("h4",null,"VALUE BASED"),Object(a.b)("p",null,"Value based comparison is same as score condition."),Object(a.b)("ol",null,Object(a.b)("li",{parentName:"ol"},Object(a.b)("strong",{parentName:"li"},"EQUAL TO")," - Works for string and numeric value, if user input and given\nvalue are equal."),Object(a.b)("li",{parentName:"ol"},Object(a.b)("strong",{parentName:"li"},"CONTAINING")," - Works for string value only. If user input contains the\ngiven value."),Object(a.b)("li",{parentName:"ol"},Object(a.b)("strong",{parentName:"li"},"STARTING WITH")," - Works for string value only. If user input is starting\nwith the given value."),Object(a.b)("li",{parentName:"ol"},Object(a.b)("strong",{parentName:"li"},"ENDING WITH")," - Works for string value only. If user input is ending with\nthe given value."),Object(a.b)("li",{parentName:"ol"},Object(a.b)("strong",{parentName:"li"},"GREATER THAN")," - Works for numeric value only, if user input is greater\nthan the given value."),Object(a.b)("li",{parentName:"ol"},Object(a.b)("strong",{parentName:"li"},"LESS THAN")," - Works for numeric value only, if user input is less than the\ngiven value.")),Object(a.b)("h4",null,"LENGTH BASED"),Object(a.b)("p",null,"The length of the characters of the user input is compared against the given\nvalue."),Object(a.b)("ol",null,Object(a.b)("li",{parentName:"ol"},Object(a.b)("strong",{parentName:"li"},"EQUAL TO")," - If input character length is equal to the given value."),Object(a.b)("li",{parentName:"ol"},Object(a.b)("strong",{parentName:"li"},"GREATER THAN")," - If input character length is greater than the given value."),Object(a.b)("li",{parentName:"ol"},Object(a.b)("strong",{parentName:"li"},"LESS THAN")," - If input character length is less than the given value.")),Object(a.b)("h3",null,"VALIDATION"),Object(a.b)("p",null,"Single line input has a very advanced validation system. You can access it from\n",Object(a.b)("strong",{parentName:"p"},"VALIDATION")," tab."),Object(a.b)("h4",null,"MASK"),Object(a.b)("p",null,"We use ",Object(a.b)("a",{parentName:"p",href:"https://imask.js.org/"},"imask.js")," under the hood and we have given some\ncommon masks. Here's how to set the input mask."),Object(a.b)("p",null,Object(a.b)("img",{src:i,alt:"Mask Screenshot"})),Object(a.b)("ul",null,Object(a.b)("li",{parentName:"ul"},"Set the ",Object(a.b)("strong",{parentName:"li"},"Mask type")," to your preferred value. More on individual values\nbelow."),Object(a.b)("li",{parentName:"ul"},"Set mask placeholder."),Object(a.b)("li",{parentName:"ul"},"If ",Object(a.b)("strong",{parentName:"li"},"Always show mask")," is enabled, mask placeholder is always shown, else it\nis shown on focus only.")),Object(a.b)("p",null,"Here are different types of mask."),Object(a.b)("p",null,Object(a.b)("strong",{parentName:"p"},"Choose from presets")),Object(a.b)("p",null,"We have included an ever increasing preset of complex masks. If your requirement\nis one of them, simply choose it and you are done. If you cannot figure out\nsomething do let us know and we will try our best to provide a mask for it."),Object(a.b)("p",null,Object(a.b)("strong",{parentName:"p"},"String mask")),Object(a.b)("p",null,"In string mask, the following characters are special:"),Object(a.b)("ul",null,Object(a.b)("li",{parentName:"ul"},Object(a.b)("inlineCode",{parentName:"li"},"0")," - any digit."),Object(a.b)("li",{parentName:"ul"},Object(a.b)("inlineCode",{parentName:"li"},"a")," - any letter."),Object(a.b)("li",{parentName:"ul"},Object(a.b)("inlineCode",{parentName:"li"},"*")," - any char."),Object(a.b)("li",{parentName:"ul"},Object(a.b)("inlineCode",{parentName:"li"},"[]")," - make input optional."),Object(a.b)("li",{parentName:"ul"},Object(a.b)("inlineCode",{parentName:"li"},"{}")," - include fixed part in unmasked value."),Object(a.b)("li",{parentName:"ul"},"`","`","` - prevent symbols shift back."),Object(a.b)("li",{parentName:"ul"},"other characters which are not in custom definitions are supposed to be fixed.")),Object(a.b)("p",null,"If definition character should be treated as fixed it should be escaped by ",Object(a.b)("inlineCode",{parentName:"p"},"\\"),"\n(E.g. ",Object(a.b)("inlineCode",{parentName:"p"},"\\0"),", ",Object(a.b)("inlineCode",{parentName:"p"},"\\a")," etc)."),Object(a.b)("p",null,"So a value of ",Object(a.b)("inlineCode",{parentName:"p"},"00-aaaa[aa]")," would accept ",Object(a.b)("inlineCode",{parentName:"p"},"56-abcd")," as well as ",Object(a.b)("inlineCode",{parentName:"p"},"56-abcdxy"),"."),Object(a.b)("p",null,"A more realistic example would be to formulate the Driver's License of New York.\nAccording to the documentation it is in the following format."),Object(a.b)("pre",null,Object(a.b)("code",{parentName:"pre"},"1Alpha+7Numeric or 1Alpha+18Numeric or 8Numeric or 9Numeric or 16 Numeric or\n8Alpha\n")),Object(a.b)("p",null,"So the String mask would be ",Object(a.b)("inlineCode",{parentName:"p"},"[aaaaaaaa][000000000000000000]"),"."),Object(a.b)("p",null,"Similarly the format of California is"),Object(a.b)("pre",null,Object(a.b)("code",{parentName:"pre"},"1Alpha+7Numeric\n")),Object(a.b)("p",null,"So the String mask would be ",Object(a.b)("inlineCode",{parentName:"p"},"a0000000"),"."),Object(a.b)("h4",null,"TYPE"),Object(a.b)("p",null,Object(a.b)("img",{src:o,alt:"Validation Screenshot"})),Object(a.b)("p",null,"Input type based validation is available when ",Object(a.b)("strong",{parentName:"p"},"Mask type")," is set to ",Object(a.b)("strong",{parentName:"p"},"None"),".\nThe following options are available."),Object(a.b)("ul",null,Object(a.b)("li",{parentName:"ul"},Object(a.b)("strong",{parentName:"li"},"Type")," - Choose from a preset value of type to filter with."),Object(a.b)("li",{parentName:"ul"},Object(a.b)("strong",{parentName:"li"},"Minimum length")," - When type is set to string type inputs, you can specify\nthe minimum length required."),Object(a.b)("li",{parentName:"ul"},Object(a.b)("strong",{parentName:"li"},"Maximum length")," - When type is set to string type inputs, you can specify\nthe maximum length required."),Object(a.b)("li",{parentName:"ul"},Object(a.b)("strong",{parentName:"li"},"Minimum value")," - When type is set to number type inputs, you can specify\nthe minimum value required."),Object(a.b)("li",{parentName:"ul"},Object(a.b)("strong",{parentName:"li"},"Maximum value")," - When type is set to number type inputs, you can specify\nthe maximum value required.")))}s.isMDXComponent=!0}}]);
//# sourceMappingURL=36-53b70ce6.js.map