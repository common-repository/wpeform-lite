/*! For license information please see 16-c9c1dfe8.js.LICENSE.txt */
(window.wpackiowpqEformadminJsonp=window.wpackiowpqEformadminJsonp||[]).push([[16],{1034:function(e,t,n){"use strict";n.d(t,"a",(function(){return U})),n.d(t,"b",(function(){return W})),n.d(t,"c",(function(){return A})),n.d(t,"d",(function(){return a})),n.d(t,"e",(function(){return r})),n.d(t,"f",(function(){return v})),n.d(t,"g",(function(){return S})),n.d(t,"h",(function(){return u})),n.d(t,"i",(function(){return Y})),n.d(t,"j",(function(){return Q})),n.d(t,"k",(function(){return G})),n.d(t,"l",(function(){return p})),n.d(t,"m",(function(){return X})),n.d(t,"n",(function(){return f})),n.d(t,"o",(function(){return K})),n.d(t,"p",(function(){return Z})),n.d(t,"q",(function(){return h})),n.d(t,"r",(function(){return J}));var o=n(6),i=n(1035);function r(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function s(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,o)}return n}function a(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?s(Object(n),!0).forEach((function(t){r(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):s(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}const c={pointer:{start:"down",change:"move",end:"up"},mouse:{start:"down",change:"move",end:"up"},touch:{start:"start",change:"move",end:"end"},gesture:{start:"start",change:"change",end:"end"}};function l(e){return e?e[0].toUpperCase()+e.slice(1):""}const d=["enter","leave"];function u(e,t="",n=!1){const o=c[e],i=o&&o[t]||t;return"on"+l(e)+l(i)+(function(e=!1,t){return e&&!d.includes(t)}(n,i)?"Capture":"")}const m=["gotpointercapture","lostpointercapture"];function f(e){let t=e.substring(2).toLowerCase();const n=!!~t.indexOf("passive");n&&(t=t.replace("passive",""));const o=m.includes(t)?"capturecapture":"capture",i=!!~t.indexOf(o);return i&&(t=t.replace("capture","")),{device:t,capture:i,passive:n}}function h(e,t=""){const n=c[e];return e+(n&&n[t]||t)}function p(e){return"touches"in e}function b(e){return p(e)?"touch":"pointerType"in e?e.pointerType:"mouse"}function g(e){return p(e)?function(e){return"touchend"===e.type||"touchcancel"===e.type?e.changedTouches:e.targetTouches}(e)[0]:e}function j(e,t){const n=t.clientX-e.clientX,o=t.clientY-e.clientY,i=(t.clientX+e.clientX)/2,r=(t.clientY+e.clientY)/2,s=Math.hypot(n,o);return{angle:-180*Math.atan2(n,o)/Math.PI,distance:s,origin:[i,r]}}function v(e){return function(e){return Array.from(e.touches).filter((t=>{var n,o;return t.target===e.currentTarget||(null===(n=e.currentTarget)||void 0===n||null===(o=n.contains)||void 0===o?void 0:o.call(n,t.target))}))}(e).map((e=>e.identifier))}function y(e,t){const n=Array.from(e.touches).filter((e=>t.includes(e.identifier))),i=Object(o.a)(n,2);return j(i[0],i[1])}function O(e){const t=g(e);return p(e)?t.identifier:t.pointerId}function w(e){const t=g(e);return[t.clientX,t.clientY]}function C(e){let t=e.deltaX,n=e.deltaY,o=e.deltaMode;return 1===o?(t*=40,n*=40):2===o&&(t*=800,n*=800),[t,n]}function x(e,...t){return"function"==typeof e?e(...t):e}function _(){}function S(...e){return 0===e.length?_:1===e.length?e[0]:function(){let t;for(const n of e)t=n.apply(this,arguments)||t;return t}}function k(e,t){return Object.assign({},t,e||{})}class F{constructor(e,t,n){this.ctrl=e,this.args=t,this.key=n,this.state||(this.state={},this.computeValues([0,0]),this.computeInitial(),this.init&&this.init(),this.reset())}get state(){return this.ctrl.state[this.key]}set state(e){this.ctrl.state[this.key]=e}get shared(){return this.ctrl.state.shared}get eventStore(){return this.ctrl.gestureEventStores[this.key]}get timeoutStore(){return this.ctrl.gestureTimeoutStores[this.key]}get config(){return this.ctrl.config[this.key]}get sharedConfig(){return this.ctrl.config.shared}get handler(){return this.ctrl.handlers[this.key]}reset(){const e=this.state,t=this.shared,n=this.ingKey,o=this.args;t[n]=e._active=e.active=e._blocked=e._force=!1,e._step=[!1,!1],e.intentional=!1,e._movement=[0,0],e._distance=[0,0],e._direction=[0,0],e._delta=[0,0],e._bounds=[[-1/0,1/0],[-1/0,1/0]],e.args=o,e.axis=void 0,e.memo=void 0,e.elapsedTime=0,e.direction=[0,0],e.distance=[0,0],e.overflow=[0,0],e._movementBound=[!1,!1],e.velocity=[0,0],e.movement=[0,0],e.delta=[0,0],e.timeStamp=0}start(e){const t=this.state,n=this.config;t._active||(this.reset(),this.computeInitial(),t._active=!0,t.target=e.target,t.currentTarget=e.currentTarget,t.lastOffset=n.from?x(n.from,t):t.offset,t.offset=t.lastOffset),t.startTime=t.timeStamp=e.timeStamp}computeValues(e){const t=this.state;t._values=e,t.values=this.config.transform(e)}computeInitial(){const e=this.state;e._initial=e._values,e.initial=e.values}compute(e){const t=this.state,n=this.config,r=this.shared;t.args=this.args;let s=0;if(e&&(t.event=e,n.preventDefault&&e.cancelable&&t.event.preventDefault(),t.type=e.type,r.touches=this.ctrl.pointerIds.size||this.ctrl.touchIds.size,r.locked=!!document.pointerLockElement,Object.assign(r,function(e){const t={};if("buttons"in e&&(t.buttons=e.buttons),"shiftKey"in e){const n=e.shiftKey,o=e.altKey,i=e.metaKey,r=e.ctrlKey;Object.assign(t,{shiftKey:n,altKey:o,metaKey:i,ctrlKey:r})}return t}(e)),r.down=r.pressed=r.buttons%2==1||r.touches>0,s=e.timeStamp-t.timeStamp,t.timeStamp=e.timeStamp,t.elapsedTime=t.timeStamp-t.startTime),t._active){const e=t._delta.map(Math.abs);i.a.addTo(t._distance,e)}this.axisIntent&&this.axisIntent(e);const a=Object(o.a)(t._movement,2),c=a[0],l=a[1],d=Object(o.a)(n.threshold,2),u=d[0],m=d[1],f=t._step,h=t.values;if(n.hasCustomTransform?(!1===f[0]&&(f[0]=Math.abs(c)>=u&&h[0]),!1===f[1]&&(f[1]=Math.abs(l)>=m&&h[1])):(!1===f[0]&&(f[0]=Math.abs(c)>=u&&Math.sign(c)*u),!1===f[1]&&(f[1]=Math.abs(l)>=m&&Math.sign(l)*m)),t.intentional=!1!==f[0]||!1!==f[1],!t.intentional)return;const p=[0,0];if(n.hasCustomTransform){const e=Object(o.a)(h,2),t=e[0],n=e[1];p[0]=!1!==f[0]?t-f[0]:0,p[1]=!1!==f[1]?n-f[1]:0}else p[0]=!1!==f[0]?c-f[0]:0,p[1]=!1!==f[1]?l-f[1]:0;this.restrictToAxis&&!t._blocked&&this.restrictToAxis(p);const b=t.offset,g=t._active&&!t._blocked||t.active;g&&(t.first=t._active&&!t.active,t.last=!t._active&&t.active,t.active=r[this.ingKey]=t._active,e&&(t.first&&("bounds"in n&&(t._bounds=x(n.bounds,t)),this.setup&&this.setup()),t.movement=p,this.computeOffset()));const j=Object(o.a)(t.offset,2),v=j[0],y=j[1],O=Object(o.a)(t._bounds,2),w=Object(o.a)(O[0],2),C=w[0],_=w[1],S=Object(o.a)(O[1],2),k=S[0],F=S[1];t.overflow=[v<C?-1:v>_?1:0,y<k?-1:y>F?1:0],t._movementBound[0]=!!t.overflow[0]&&(!1===t._movementBound[0]?t._movement[0]:t._movementBound[0]),t._movementBound[1]=!!t.overflow[1]&&(!1===t._movementBound[1]?t._movement[1]:t._movementBound[1]);const T=t._active&&n.rubberband||[0,0];if(t.offset=Object(i.b)(t._bounds,t.offset,T),t.delta=i.a.sub(t.offset,b),this.computeMovement(),g&&(!t.last||s>32)){t.delta=i.a.sub(t.offset,b);const e=t.delta.map(Math.abs);i.a.addTo(t.distance,e),t.direction=t.delta.map(Math.sign),t._direction=t._delta.map(Math.sign),!t.first&&s>0&&(t.velocity=[e[0]/s,e[1]/s])}}emit(){const e=this.state,t=this.shared,n=this.config;if(e._active||this.clean(),(e._blocked||!e.intentional)&&!e._force&&!n.triggerAllEvents)return;const o=this.handler(a(a(a({},t),e),{},{[this.aliasKey]:e.values}));void 0!==o&&(e.memo=o)}clean(){this.eventStore.clean(),this.timeoutStore.clean()}}class T extends F{constructor(...e){super(...e),r(this,"aliasKey","xy")}reset(){super.reset(),this.state.axis=void 0}init(){this.state.offset=[0,0],this.state.lastOffset=[0,0]}computeOffset(){this.state.offset=i.a.add(this.state.lastOffset,this.state.movement)}computeMovement(){this.state.movement=i.a.sub(this.state.offset,this.state.lastOffset)}axisIntent(e){const t=this.state,n=this.config;if(!t.axis&&e){const o="object"==typeof n.axisThreshold?n.axisThreshold[b(e)]:n.axisThreshold;t.axis=function([e,t],n){const o=Math.abs(e),i=Math.abs(t);return o>i&&o>n?"x":i>o&&i>n?"y":void 0}(t._movement,o)}t._blocked=(n.lockDirection||!!n.axis)&&!t.axis||!!n.axis&&n.axis!==t.axis}restrictToAxis(e){if(this.config.axis||this.config.lockDirection)switch(this.state.axis){case"x":e[1]=0;break;case"y":e[0]=0}}}const E=e=>e,I={enabled:(e=!0)=>e,eventOptions:(e,t,n)=>a(a({},n.shared.eventOptions),e),preventDefault:(e=!1)=>e,triggerAllEvents:(e=!1)=>e,rubberband(e=0){switch(e){case!0:return[.15,.15];case!1:return[0,0];default:return i.a.toVector(e)}},from:e=>"function"==typeof e?e:null!=e?i.a.toVector(e):void 0,transform(e,t,n){const o=e||n.shared.transform;return this.hasCustomTransform=!!o,o||E},threshold:e=>i.a.toVector(e,0)};const P=a(a({},I),{},{axis(e,t,{axis:n}){if(this.lockDirection="lock"===n,!this.lockDirection)return n},axisThreshold:(e=0)=>e,bounds(e={}){if("function"==typeof e)return t=>P.bounds(e(t));if("current"in e)return()=>e.current;if("function"==typeof HTMLElement&&e instanceof HTMLElement)return e;const t=e.left,n=void 0===t?-1/0:t,o=e.right,i=void 0===o?1/0:o,r=e.top,s=void 0===r?-1/0:r,a=e.bottom;return[[n,i],[s,void 0===a?1/0:a]]}}),M={ArrowRight:(e=1)=>[10*e,0],ArrowLeft:(e=1)=>[-10*e,0],ArrowUp:(e=1)=>[0,-10*e],ArrowDown:(e=1)=>[0,10*e]};const L="undefined"!=typeof window&&window.document&&window.document.createElement;function B(){return L&&"ontouchstart"in window||L&&window.navigator.maxTouchPoints>1}const A={isBrowser:L,gesture:function(){try{return"constructor"in GestureEvent}catch(e){return!1}}(),touch:B(),touchscreen:B(),pointer:L&&"onpointerdown"in window,pointerLock:L&&"exitPointerLock"in window.document},N={mouse:0,touch:0,pen:8},R=a(a({},P),{},{device(e,t,{pointer:{touch:n=!1,lock:o=!1,mouse:i=!1}={}}){return this.pointerLock=o&&A.pointerLock,A.touch&&n?"touch":this.pointerLock?"mouse":A.pointer&&!i?"pointer":A.touch?"touch":"mouse"},preventScrollAxis(e,t,{preventScroll:n}){if(this.preventScrollDelay="number"==typeof n?n:n||void 0===n&&e?250:void 0,A.touchscreen&&!1!==n)return e||(void 0!==n?"y":void 0)},pointerCapture(e,t,{pointer:{capture:n=!0,buttons:o=1,keys:i=!0}={}}){return this.pointerButtons=o,this.keys=i,!this.pointerLock&&"pointer"===this.device&&n},threshold(e,t,{filterTaps:n=!1,tapsThreshold:o=3,axis:r}){const s=i.a.toVector(e,n?o:r?1:0);return this.filterTaps=n,this.tapsThreshold=o,s},swipe({velocity:e=.5,distance:t=50,duration:n=250}={}){return{velocity:this.transform(i.a.toVector(e)),distance:this.transform(i.a.toVector(t)),duration:n}},delay(e=0){switch(e){case!0:return 180;case!1:return 0;default:return e}},axisThreshold:e=>e?a(a({},N),e):N});function D(e){const t=Object(o.a)(e.overflow,2),n=t[0],i=t[1],r=Object(o.a)(e._delta,2),s=r[0],a=r[1],c=Object(o.a)(e._direction,2),l=c[0],d=c[1];(n<0&&s>0&&l<0||n>0&&s<0&&l>0)&&(e._movement[0]=e._movementBound[0]),(i<0&&a>0&&d<0||i>0&&a<0&&d>0)&&(e._movement[1]=e._movementBound[1])}const $=a(a({},I),{},{device(e,t,{shared:n,pointer:{touch:o=!1}={}}){if(n.target&&!A.touch&&A.gesture)return"gesture";if(A.touch&&o)return"touch";if(A.touchscreen){if(A.pointer)return"pointer";if(A.touch)return"touch"}},bounds(e,t,{scaleBounds:n={},angleBounds:o={}}){const i=e=>{const t=k(x(n,e),{min:-1/0,max:1/0});return[t.min,t.max]},r=e=>{const t=k(x(o,e),{min:-1/0,max:1/0});return[t.min,t.max]};return"function"!=typeof n&&"function"!=typeof o?[i(),r()]:e=>[i(e),r(e)]},threshold(e,t,n){this.lockDirection="lock"===n.axis;return i.a.toVector(e,this.lockDirection?[.1,3]:0)},modifierKey:e=>void 0===e?"ctrlKey":e,pinchOnWheel:(e=!0)=>e});const z=a(a({},P),{},{mouseOnly:(e=!0)=>e});const H=P;const q=P;const V=a(a({},P),{},{mouseOnly:(e=!0)=>e}),W=new Map,U=new Map;function K(e){W.set(e.key,e.engine),U.set(e.key,e.resolver)}const Y={key:"drag",engine:class extends T{constructor(...e){super(...e),r(this,"ingKey","dragging")}reset(){super.reset();const e=this.state;e._pointerId=void 0,e._pointerActive=!1,e._keyboardActive=!1,e._preventScroll=!1,e._delayed=!1,e.swipe=[0,0],e.tap=!1,e.canceled=!1,e.cancel=this.cancel.bind(this)}setup(){const e=this.state;if(e._bounds instanceof HTMLElement){const t=e._bounds.getBoundingClientRect(),n=e.currentTarget.getBoundingClientRect(),o={left:t.left-n.left+e.offset[0],right:t.right-n.right+e.offset[0],top:t.top-n.top+e.offset[1],bottom:t.bottom-n.bottom+e.offset[1]};e._bounds=P.bounds(o)}}cancel(){const e=this.state;e.canceled||(e.canceled=!0,e._active=!1,setTimeout((()=>{this.compute(),this.emit()}),0))}setActive(){this.state._active=this.state._pointerActive||this.state._keyboardActive}clean(){this.pointerClean(),this.state._pointerActive=!1,this.state._keyboardActive=!1,super.clean()}pointerDown(e){const t=this.config,n=this.state;if(null!=e.buttons&&(Array.isArray(t.pointerButtons)?!t.pointerButtons.includes(e.buttons):-1!==t.pointerButtons&&t.pointerButtons!==e.buttons))return;const o=this.ctrl.setEventIds(e);t.pointerCapture&&e.target.setPointerCapture(e.pointerId),o&&o.size>1&&n._pointerActive||(this.start(e),this.setupPointer(e),n._pointerId=O(e),n._pointerActive=!0,this.computeValues(w(e)),this.computeInitial(),t.preventScrollAxis&&"mouse"!==b(e)?(n._active=!1,this.setupScrollPrevention(e)):t.delay>0?(this.setupDelayTrigger(e),t.triggerAllEvents&&(this.compute(e),this.emit())):this.startPointerDrag(e))}startPointerDrag(e){const t=this.state;t._active=!0,t._preventScroll=!0,t._delayed=!1,this.compute(e),this.emit()}pointerMove(e){const t=this.state,n=this.config;if(!t._pointerActive)return;if(t.type===e.type&&e.timeStamp===t.timeStamp)return;const o=O(e);if(void 0!==t._pointerId&&o!==t._pointerId)return;const r=w(e);return document.pointerLockElement===e.target?t._delta=[e.movementX,e.movementY]:(t._delta=i.a.sub(r,t._values),this.computeValues(r)),i.a.addTo(t._movement,t._delta),this.compute(e),t._delayed&&t.intentional?(this.timeoutStore.remove("dragDelay"),t.active=!1,void this.startPointerDrag(e)):n.preventScrollAxis&&!t._preventScroll?t.axis?t.axis===n.preventScrollAxis||"xy"===n.preventScrollAxis?(t._active=!1,void this.clean()):(this.timeoutStore.remove("startPointerDrag"),void this.startPointerDrag(e)):void 0:void this.emit()}pointerUp(e){this.ctrl.setEventIds(e);try{this.config.pointerCapture&&e.target.hasPointerCapture(e.pointerId)&&e.target.releasePointerCapture(e.pointerId)}catch(e){0}const t=this.state,n=this.config;if(!t._active||!t._pointerActive)return;const i=O(e);if(void 0!==t._pointerId&&i!==t._pointerId)return;this.state._pointerActive=!1,this.setActive(),this.compute(e);const r=Object(o.a)(t._distance,2),s=r[0],a=r[1];if(t.tap=s<=n.tapsThreshold&&a<=n.tapsThreshold,t.tap&&n.filterTaps)t._force=!0;else{const e=Object(o.a)(t.direction,2),i=e[0],r=e[1],s=Object(o.a)(t.velocity,2),a=s[0],c=s[1],l=Object(o.a)(t.movement,2),d=l[0],u=l[1],m=Object(o.a)(n.swipe.velocity,2),f=m[0],h=m[1],p=Object(o.a)(n.swipe.distance,2),b=p[0],g=p[1],j=n.swipe.duration;t.elapsedTime<j&&(Math.abs(a)>f&&Math.abs(d)>b&&(t.swipe[0]=i),Math.abs(c)>h&&Math.abs(u)>g&&(t.swipe[1]=r))}this.emit()}pointerClick(e){!this.state.tap&&e.detail>0&&(e.preventDefault(),e.stopPropagation())}setupPointer(e){const t=this.config,n=t.device;t.pointerLock&&e.currentTarget.requestPointerLock(),t.pointerCapture||(this.eventStore.add(this.sharedConfig.window,n,"change",this.pointerMove.bind(this)),this.eventStore.add(this.sharedConfig.window,n,"end",this.pointerUp.bind(this)),this.eventStore.add(this.sharedConfig.window,n,"cancel",this.pointerUp.bind(this)))}pointerClean(){this.config.pointerLock&&document.pointerLockElement===this.state.currentTarget&&document.exitPointerLock()}preventScroll(e){this.state._preventScroll&&e.cancelable&&e.preventDefault()}setupScrollPrevention(e){this.state._preventScroll=!1,function(e){"persist"in e&&"function"==typeof e.persist&&e.persist()}(e);const t=this.eventStore.add(this.sharedConfig.window,"touch","change",this.preventScroll.bind(this),{passive:!1});this.eventStore.add(this.sharedConfig.window,"touch","end",t),this.eventStore.add(this.sharedConfig.window,"touch","cancel",t),this.timeoutStore.add("startPointerDrag",this.startPointerDrag.bind(this),this.config.preventScrollDelay,e)}setupDelayTrigger(e){this.state._delayed=!0,this.timeoutStore.add("dragDelay",(()=>{this.state._step=[0,0],this.startPointerDrag(e)}),this.config.delay)}keyDown(e){const t=M[e.key];if(t){const n=this.state,o=e.shiftKey?10:e.altKey?.1:1;this.start(e),n._delta=t(o),n._keyboardActive=!0,i.a.addTo(n._movement,n._delta),this.compute(e),this.emit()}}keyUp(e){e.key in M&&(this.state._keyboardActive=!1,this.setActive(),this.compute(e),this.emit())}bind(e){const t=this.config.device;e(t,"start",this.pointerDown.bind(this)),this.config.pointerCapture&&(e(t,"change",this.pointerMove.bind(this)),e(t,"end",this.pointerUp.bind(this)),e(t,"cancel",this.pointerUp.bind(this)),e("lostPointerCapture","",this.pointerUp.bind(this))),this.config.keys&&(e("key","down",this.keyDown.bind(this)),e("key","up",this.keyUp.bind(this))),this.config.filterTaps&&e("click","",this.pointerClick.bind(this),{capture:!0,passive:!1})}},resolver:R},G={key:"hover",engine:class extends T{constructor(...e){super(...e),r(this,"ingKey","hovering")}enter(e){this.config.mouseOnly&&"mouse"!==e.pointerType||(this.start(e),this.computeValues(w(e)),this.compute(e),this.emit())}leave(e){if(this.config.mouseOnly&&"mouse"!==e.pointerType)return;const t=this.state;if(!t._active)return;t._active=!1;const n=w(e);t._movement=t._delta=i.a.sub(n,t._values),this.computeValues(n),this.compute(e),t.delta=t.movement,this.emit()}bind(e){e("pointer","enter",this.enter.bind(this)),e("pointer","leave",this.leave.bind(this))}},resolver:V},X={key:"move",engine:class extends T{constructor(...e){super(...e),r(this,"ingKey","moving")}move(e){this.config.mouseOnly&&"mouse"!==e.pointerType||(this.state._active?this.moveChange(e):this.moveStart(e),this.timeoutStore.add("moveEnd",this.moveEnd.bind(this)))}moveStart(e){this.start(e),this.computeValues(w(e)),this.compute(e),this.computeInitial(),this.emit()}moveChange(e){if(!this.state._active)return;const t=w(e),n=this.state;n._delta=i.a.sub(t,n._values),i.a.addTo(n._movement,n._delta),this.computeValues(t),this.compute(e),this.emit()}moveEnd(e){this.state._active&&(this.state._active=!1,this.compute(e),this.emit())}bind(e){e("pointer","change",this.move.bind(this)),e("pointer","leave",this.moveEnd.bind(this))}},resolver:z},Q={key:"pinch",engine:class extends F{constructor(...e){super(...e),r(this,"ingKey","pinching"),r(this,"aliasKey","da")}init(){this.state.offset=[1,0],this.state.lastOffset=[1,0],this.state._pointerEvents=new Map}reset(){super.reset();const e=this.state;e._touchIds=[],e.canceled=!1,e.cancel=this.cancel.bind(this),e.turns=0}computeOffset(){const e=this.state,t=e.type,n=e.movement,o=e.lastOffset;this.state.offset="wheel"===t?i.a.add(n,o):[(1+n[0])*o[0],n[1]+o[1]]}computeMovement(){const e=this.state,t=e.offset,n=e.lastOffset;this.state.movement=[t[0]/n[0],t[1]-n[1]]}axisIntent(){const e=this.state,t=Object(o.a)(e._movement,2),n=t[0],i=t[1];if(!e.axis){const t=30*Math.abs(n)-Math.abs(i);t<0?e.axis="angle":t>0&&(e.axis="scale")}}restrictToAxis(e){this.config.lockDirection&&("scale"===this.state.axis?e[1]=0:"angle"===this.state.axis&&(e[0]=0))}cancel(){const e=this.state;e.canceled||setTimeout((()=>{e.canceled=!0,e._active=!1,this.compute(),this.emit()}),0)}touchStart(e){this.ctrl.setEventIds(e);const t=this.state,n=this.ctrl.touchIds;if(t._active&&t._touchIds.every((e=>n.has(e))))return;if(n.size<2)return;this.start(e),t._touchIds=Array.from(n).slice(0,2);const o=y(e,t._touchIds);this.pinchStart(e,o)}pointerStart(e){if(null!=e.buttons&&e.buttons%2!=1)return;this.ctrl.setEventIds(e),e.target.setPointerCapture(e.pointerId);const t=this.state,n=t._pointerEvents,o=this.ctrl.pointerIds;if(t._active&&Array.from(n.keys()).every((e=>o.has(e))))return;if(n.size<2&&n.set(e.pointerId,e),t._pointerEvents.size<2)return;this.start(e);const i=j(...Array.from(n.values()));this.pinchStart(e,i)}pinchStart(e,t){this.state.origin=t.origin,this.computeValues([t.distance,t.angle]),this.computeInitial(),this.compute(e),this.emit()}touchMove(e){if(!this.state._active)return;const t=y(e,this.state._touchIds);this.pinchMove(e,t)}pointerMove(e){const t=this.state._pointerEvents;if(t.has(e.pointerId)&&t.set(e.pointerId,e),!this.state._active)return;const n=j(...Array.from(t.values()));this.pinchMove(e,n)}pinchMove(e,t){const n=this.state,o=n._values[1],i=t.angle-o;let r=0;Math.abs(i)>270&&(r+=Math.sign(i)),this.computeValues([t.distance,t.angle-360*r]),n.origin=t.origin,n.turns=r,n._movement=[n._values[0]/n._initial[0]-1,n._values[1]-n._initial[1]],this.compute(e),this.emit()}touchEnd(e){this.ctrl.setEventIds(e),this.state._active&&this.state._touchIds.some((e=>!this.ctrl.touchIds.has(e)))&&(this.state._active=!1,this.compute(e),this.emit())}pointerEnd(e){const t=this.state;this.ctrl.setEventIds(e);try{e.target.releasePointerCapture(e.pointerId)}catch(e){}t._pointerEvents.has(e.pointerId)&&t._pointerEvents.delete(e.pointerId),t._active&&t._pointerEvents.size<2&&(t._active=!1,this.compute(e),this.emit())}gestureStart(e){e.cancelable&&e.preventDefault();const t=this.state;t._active||(this.start(e),this.computeValues([e.scale,e.rotation]),t.origin=[e.clientX,e.clientY],this.compute(e),this.emit())}gestureMove(e){if(e.cancelable&&e.preventDefault(),!this.state._active)return;const t=this.state;this.computeValues([e.scale,e.rotation]),t.origin=[e.clientX,e.clientY];const n=t._movement;t._movement=[e.scale-1,e.rotation],t._delta=i.a.sub(t._movement,n),this.compute(e),this.emit()}gestureEnd(e){this.state._active&&(this.state._active=!1,this.compute(e),this.emit())}wheel(e){const t=this.config.modifierKey;t&&!e[t]||(this.state._active?this.wheelChange(e):this.wheelStart(e),this.timeoutStore.add("wheelEnd",this.wheelEnd.bind(this)))}wheelStart(e){this.start(e),this.wheelChange(e)}wheelChange(e){"uv"in e||e.cancelable&&e.preventDefault();const t=this.state;t._delta=[-C(e)[1]/100*t.offset[0],0],i.a.addTo(t._movement,t._delta),D(t),this.state.origin=[e.clientX,e.clientY],this.compute(e),this.emit()}wheelEnd(){this.state._active&&(this.state._active=!1,this.compute(),this.emit())}bind(e){const t=this.config.device;t&&(e(t,"start",this[t+"Start"].bind(this)),e(t,"change",this[t+"Move"].bind(this)),e(t,"end",this[t+"End"].bind(this)),e(t,"cancel",this[t+"End"].bind(this))),this.config.pinchOnWheel&&e("wheel","",this.wheel.bind(this),{passive:!1})}},resolver:$},Z={key:"scroll",engine:class extends T{constructor(...e){super(...e),r(this,"ingKey","scrolling")}scroll(e){this.state._active||this.start(e),this.scrollChange(e),this.timeoutStore.add("scrollEnd",this.scrollEnd.bind(this))}scrollChange(e){e.cancelable&&e.preventDefault();const t=this.state,n=function(e){var t,n;const o=e.currentTarget,i=o.scrollX,r=o.scrollY,s=o.scrollLeft,a=o.scrollTop;return[null!==(t=null!=i?i:s)&&void 0!==t?t:0,null!==(n=null!=r?r:a)&&void 0!==n?n:0]}(e);t._delta=i.a.sub(n,t._values),i.a.addTo(t._movement,t._delta),this.computeValues(n),this.compute(e),this.emit()}scrollEnd(){this.state._active&&(this.state._active=!1,this.compute(),this.emit())}bind(e){e("scroll","",this.scroll.bind(this))}},resolver:H},J={key:"wheel",engine:class extends T{constructor(...e){super(...e),r(this,"ingKey","wheeling")}wheel(e){this.state._active||this.start(e),this.wheelChange(e),this.timeoutStore.add("wheelEnd",this.wheelEnd.bind(this))}wheelChange(e){const t=this.state;t._delta=C(e),i.a.addTo(t._movement,t._delta),D(t),this.compute(e),this.emit()}wheelEnd(){this.state._active&&(this.state._active=!1,this.compute(),this.emit())}bind(e){e("wheel","",this.wheel.bind(this))}},resolver:q}},1035:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return a}));var o=n(6);const i={toVector:(e,t)=>(void 0===e&&(e=t),Array.isArray(e)?e:[e,e]),add:(e,t)=>[e[0]+t[0],e[1]+t[1]],sub:(e,t)=>[e[0]-t[0],e[1]-t[1]],addTo(e,t){e[0]+=t[0],e[1]+=t[1]},subTo(e,t){e[0]-=t[0],e[1]-=t[1]}};function r(e,t,n){return 0===t||Math.abs(t)===1/0?Math.pow(e,5*n):e*t*n/(t+n*e)}function s(e,t,n,o=.15){return 0===o?function(e,t,n){return Math.max(t,Math.min(e,n))}(e,t,n):e<t?-r(t-e,n-t,o)+t:e>n?+r(e-n,n-t,o)+n:e}function a(e,[t,n],[i,r]){const a=Object(o.a)(e,2),c=Object(o.a)(a[0],2),l=c[0],d=c[1],u=Object(o.a)(a[1],2),m=u[0],f=u[1];return[s(t,l,d,i),s(n,m,f,r)]}},1036:function(e,t,n){"use strict";n.d(t,"c",(function(){return y})),n.d(t,"b",(function(){return v})),n.d(t,"a",(function(){return _}));var o=n(15),i=n(0),r=n(7),s=n(1092),a=n(98),c=(n(8),n(1043)),l=n(1041),d=n(1);const u=Object(i.createContext)(void 0);var m=n(443),f=n(21),h=n(2),p=n(1066),b=n(29);n(281);const g=m.a.getItems()[0].item.config,j=Object(i.createContext)(void 0);function v(e){var t,n,o,i,r,s,a,c,l,d,u,m,f,h,p,b;return{scheme:null==e||null===(t=e.theme)||void 0===t?void 0:t.scheme,baseFont:null==e||null===(n=e.typography)||void 0===n?void 0:n.baseFont,boldHeading:null==e||null===(o=e.typography)||void 0===o?void 0:o.headFontBold,italicHeading:null==e||null===(i=e.typography)||void 0===i?void 0:i.headFontItalic,headFamily:null==e||null===(r=e.typography)||void 0===r?void 0:r.headFamily,headFamilyCustom:null==e||null===(s=e.typography)||void 0===s?void 0:s.headFamilyCustom,bodyFamily:null==e||null===(a=e.typography)||void 0===a?void 0:a.bodyFamily,bodyFamilyCustom:null==e||null===(c=e.typography)||void 0===c?void 0:c.bodyFamilyCustom,customPrimaryColor:null==e||null===(l=e.theme)||void 0===l?void 0:l.customColorPrimary,customSecondaryColor:null==e||null===(d=e.theme)||void 0===d?void 0:d.customColorSecondary,customBackgroundColor:null==e||null===(u=e.theme)||void 0===u?void 0:u.customColorBg,customTextColor:null==e||null===(m=e.theme)||void 0===m?void 0:m.customColorText,css:null==e||null===(f=e.theme)||void 0===f?void 0:f.css,maxWidth:null==e||null===(h=e.appearance)||void 0===h?void 0:h.maxWidth,containerLayout:null==e||null===(p=e.appearance)||void 0===p?void 0:p.containerLayout,darkMode:null==e||null===(b=e.theme)||void 0===b?void 0:b.darkMode}}function y(e){return Object(i.useMemo)((()=>v(e)),[e])}function O(e){const t=Object(i.useState)((()=>!1)),n=Object(o.a)(t,2),r=n[0];n[1];Object(i.useEffect)((()=>()=>{}),[]);const s=Object(i.useContext)(j);return Object(i.useMemo)((()=>{const t=null!=e?e:{},n=t.baseFont,i=t.bodyFamily,r=t.boldHeading,s=t.customBackgroundColor,a=t.customPrimaryColor,c=t.customSecondaryColor,l=t.customTextColor,d=t.headFamily,u=t.italicHeading,j=t.scheme;t.darkMode;let v=Object(f.c)(g);j&&m.a.hasItem(j)&&(v=Object(f.c)(m.a.getItem(j).config)),n&&16!==n&&n>=12&&(v={...v,controlHeightBase:Object(h.g)(2.5*n),borderRadiusBase:Object(h.g)(.25*n),gutter:Math.min(Math.max(Object(h.g)(1.25*n),10),40),fz:{small2:Math.ceil(.75*n),small1:Math.ceil(.875*n),base:n,large1:Math.ceil(1.125*n),large2:Math.ceil(1.25*n),large3:Math.ceil(1.5*n),large4:Math.ceil(1.875*n),large5:Math.ceil(2.25*n),large6:Math.ceil(3*n),large7:Math.ceil(3.75*n),large8:Math.ceil(4.5*n)}});const y=[];if(v.boldHeading=!!r,v.italicHeading=!!u,d){let t="inherit";if("custom"===d){var O;t=null!==(O=null==e?void 0:e.headFamilyCustom)&&void 0!==O?O:"inherit"}else{const e=Object(p.a)(d),n=Object(o.a)(e,2),i=n[0],r=n[1];t=i,r&&y.push(r)}v.fontFamilyHeading=t}if(i){let t="inherit";if("custom"===i){var w;t=null!==(w=null==e?void 0:e.bodyFamilyCustom)&&void 0!==w?w:"inherit"}else{const e=Object(p.a)(i),n=Object(o.a)(e,2),r=n[0],s=n[1];t=r,s&&y.push(s)}v.fontFamilyBody=t}const C=b.b,x=b.d;return a&&(v.primaryColor=a,v.primaryDarkColor=C(.1,a),v.primaryLightColor=x(.1,a),v.accentColor=Object(b.a)(a),v.primaryBgText=Object(b.d)(.7,a),v.primaryBackgroundColor=x(.6,a),v.linkColor=a,v.boxShadowFocus=`0 0 0 2px ${Object(b.e)(.5,a)}`,v.boxShadowControlFocus=`0 0 0 ${Object(h.n)(3)} ${Object(b.e)(.8,a)}`),c&&(v.borderColorBase=c,v.borderColorSplit=x(.1,c),v.disabledColor=x(.28,c),v.disabledBackgroundColor=x(.45,c),v.backgroundControl=x(.44,c),console.log(v.backgroundControl),v.backgroundShade=Object(b.c)(.01,x(.4,c)),v.backgroundHover=Object(b.c)(.01,x(.42,c))),s&&(v.appBackgroundColor=s),l&&(v.textColor=l,v.textColorSecondary=x(.4,l),v.headingColor=x(.1,l)),[v,Object(f.a)(y)]}),[e,r,s])}function w(e){const t=new r.a;let n;try{Object(s.renderToString)(Object(d.jsx)(r.b,{sheet:t.instance,children:Object(d.jsx)(d.Fragment,{children:e})})),n=t.getStyleElement()}catch(e){console.log(e),n=null}finally{t.seal()}return n}function C(e){const t=e.children,n=e.ssr,o=e.mode,i=e.themeStyle,s=e.widthOverride,c=e.containerLayoutOverride,l=e.theme;return Object(d.jsx)(r.c,{theme:l,children:n?Object(d.jsx)(a.a.Ssr,{width:null!=s?s:null==i?void 0:i.maxWidth,containerLayout:null!=c?c:null==i?void 0:i.containerLayout,noHorizontalPadding:"preview"===o,noVerticalPadding:"preview"===o,children:t}):Object(d.jsx)(a.a,{width:null!=s?s:null==i?void 0:i.maxWidth,containerLayout:null!=c?c:null==i?void 0:i.containerLayout,noHorizontalPadding:"preview"===o,noVerticalPadding:"preview"===o,children:t})})}function x(e){const t=e.children,n=Object(i.useContext)(u);return Object(d.jsx)(r.b,{target:n,children:Object(d.jsx)(d.Fragment,{children:t})})}function _(e){const t=e.mode,n=e.themeStyle,r=e.ssr,s=void 0!==r&&r,a=O(n),u=Object(o.a)(a,2),m=u[0],f=u[1],h=null==n?void 0:n.css,p=Object(c.b)();Object(i.useEffect)((()=>{p&&"undefined"!=typeof window&&f&&f.length&&f.forEach((e=>{const t=Object(l.d)(e);if(!document.head.querySelector(`#${t}`)){const n=document.createElement("link");n.setAttribute("href",e),n.setAttribute("id",t),n.setAttribute("rel","stylesheet"),document.head.append(n)}}))}),[f,p]);const b=Object(d.jsx)(C,{theme:m,...e}),g=Object(i.useState)(!1),j=Object(o.a)(g,2),v=j[0],y=j[1];return Object(i.useEffect)((()=>{y(!0)}),[]),Object(d.jsxs)(d.Fragment,{children:[p&&v?f.map((e=>Object(d.jsx)("link",{rel:"stylesheet",href:e},e))):null,h&&"live"===t?Object(d.jsx)("style",{type:"text/css",dangerouslySetInnerHTML:{__html:h}}):null,s?Object(d.jsxs)(d.Fragment,{children:[w(b),Object(d.jsx)("div",{className:"wpeform-root-slot__react-app",children:b})]}):Object(d.jsx)(x,{children:b})]})}},1038:function(e,t,n){"use strict";n.d(t,"a",(function(){return f}));var o=n(42),i=n(52),r=(n(0),n(83)),s=n(7),a=n(10),c=n.n(a),l=n(1);const d=["history","location","match","staticContext","to","transparent","className"],u=["onClick","transparent","className"],m=Object(s.f)(i.a).withConfig({displayName:"StyledLink__StyledLinkButton",componentId:"sc-1fap3y6-0"})(["&.wpeform-ghosted-button{border:0 none;box-shadow:none;&:hover{background-color:",";color:",";}}"],(e=>e.theme.backgroundHover),(e=>e.theme.textColor));function f(e){const t=e.onClick,n=e.transparent,i=e.className,r=Object(o.a)(e,u);return Object(l.jsx)(m,{className:c()(i,{"wpeform-ghosted-button":n}),...r,onClick:e=>{e.preventDefault(),t()}})}t.b=Object(r.o)((function(e){const t=e.history,n=(e.location,e.match,e.staticContext,e.to),i=e.transparent,r=e.className,s=Object(o.a)(e,d);return Object(l.jsx)(m,{className:c()(r,{"wpeform-ghosted-button":i}),...s,onClick:e=>{e.preventDefault(),t.push(n)}})}))},1040:function(e,t,n){"use strict";var o=n(1034);n.d(t,"a",(function(){return o.i})),n.d(t,"b",(function(){return o.k})),n.d(t,"c",(function(){return o.m})),n.d(t,"d",(function(){return o.j})),n.d(t,"e",(function(){return o.o})),n.d(t,"f",(function(){return o.p})),n.d(t,"g",(function(){return o.r}))},1041:function(e,t,n){"use strict";n.d(t,"b",(function(){return i})),n.d(t,"a",(function(){return r})),n.d(t,"e",(function(){return s})),n.d(t,"c",(function(){return a})),n.d(t,"d",(function(){return c}));var o=n(3);function i(e,t,n=Object(o.__)("Anonymous","wp-eform")){const i=[];return e&&i.push(e),t&&i.push(t),i.length?i.join(" "):n}function r(e){const t=Math.floor(e/3600),n=e%3600,i=Math.floor(n/60),r=n%60;return t>0?Object(o.sprintf)(Object(o._x)("%1$s, %2$s, %3$s","format-time-from-seconds","wp-eform"),Object(o.sprintf)(Object(o._n)("%d hour","%d hours",t,"wp-eform"),t),Object(o.sprintf)(Object(o._n)("%d minute","%d minutes",i,"wp-eform"),i),Object(o.sprintf)(Object(o._n)("%d second","%d seconds",r,"wp-eform"),r)):i>0?Object(o.sprintf)(Object(o._x)("%1$s, %2$s","format-time-from-seconds","wp-eform"),Object(o.sprintf)(Object(o._n)("%d minute","%d minutes",i,"wp-eform"),i),Object(o.sprintf)(Object(o._n)("%d second","%d seconds",r,"wp-eform"),r)):Object(o.sprintf)(Object(o._n)("%d second","%d seconds",r,"wp-eform"),r)}function s(e,t,n="…"){return e.length<=t?e:e.substring(0,t+1)+n}const a=/%%([^%%]+)%%/;function c(...e){return e.join(" ").normalize("NFD").replace(/[\u0300-\u036f]/g,"").toLowerCase().trim().replace(/[^a-z0-9 ]/g,"").replace(/\s+/g,"-")}},1042:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));var o=n(439);function i(){o.a.evict({id:"ROOT_QUERY",fieldName:"forms"}),o.a.evict({id:"ROOT_QUERY",fieldName:"form"}),o.a.evict({id:"ROOT_QUERY",fieldName:"categories"}),o.a.evict({id:"ROOT_QUERY",fieldName:"category"}),o.a.evict({id:"ROOT_QUERY",fieldName:"submissions"}),o.a.evict({id:"ROOT_QUERY",fieldName:"submission"}),o.a.evict({id:"ROOT_QUERY",fieldName:"formMeta"}),o.a.evict({id:"ROOT_QUERY",fieldName:"submissionMeta"}),o.a.evict({id:"ROOT_QUERY",fieldName:"siteSettings"}),o.a.gc()}},1043:function(e,t,n){"use strict";n.d(t,"b",(function(){return l})),n.d(t,"a",(function(){return u}));var o=n(15),i=n(0),r=n(359),s=n(1);const a=Object(i.createContext)(!1);function c(e){const t=e.cssHandles,n=Object(i.useState)([]),r=Object(o.a)(n,2),a=r[0],c=r[1];return Object(i.useEffect)((()=>{const e=[];t&&"undefined"!=typeof window&&t.forEach((t=>{const n=document.querySelector(`#${t}-css`);if(n){const i=n.getAttribute("href");var o;if(i)e.push({id:t,href:i,media:null!==(o=n.getAttribute("media"))&&void 0!==o?o:"all"})}})),c(e)}),[t]),Object(s.jsx)(s.Fragment,{children:a.map((e=>Object(s.jsx)("link",{rel:"stylesheet",href:e.href,media:e.media},e.id)))})}function l(){return Object(i.useContext)(a)}function d(){const e="undefined"!=typeof WPEFormGraphQLApp?WPEFormGraphQLApp:{customCSS:void 0,customStyleLinks:void 0},t=e.customCSS,n=e.customStyleLinks;return Object(s.jsxs)(s.Fragment,{children:[t?Object(s.jsx)("style",{type:"text/css",dangerouslySetInnerHTML:{__html:t}}):null,n?n.map((e=>Object(s.jsx)("link",{rel:"stylesheet",href:e},e))):null]})}function u(e){const t=e.children,n=e.inShadow,r=e.cssHandles,l=Object(i.useState)(!1),u=Object(o.a)(l,2),m=u[0],f=u[1];return Object(i.useEffect)((()=>{f(!0)}),[]),Object(s.jsxs)(a.Provider,{value:n,children:[m?Object(s.jsxs)(s.Fragment,{children:[Object(s.jsx)(d,{}),n?Object(s.jsx)(c,{cssHandles:r}):null]}):null,t]})}u.LinkAllAssets=function(e){const t=e.body,n=void 0!==t&&t,a=e.head,c=void 0===a||a,l=Object(i.useState)([]),d=Object(o.a)(l,2),u=d[0],m=d[1];return Object(i.useEffect)((()=>{const e=[];let t;const o='link[rel="stylesheet"]';t=c&&n?document.querySelectorAll(o):c?document.head.querySelectorAll(o):document.body.querySelectorAll(o),t.length&&t.forEach((t=>{const n=t.getAttribute("href");var o,i;n&&e.push({id:null!==(o=t.getAttribute("id"))&&void 0!==o?o:Object(r.a)(),href:n,media:null!==(i=t.getAttribute("media"))&&void 0!==i?i:"all"})})),m(e)}),[n,c]),Object(s.jsx)(s.Fragment,{children:u.map((e=>Object(s.jsx)("link",{rel:"stylesheet",href:e.href,media:e.media},e.id)))})}},1044:function(e,t,n){"use strict";n.d(t,"a",(function(){return j}));var o=n(442),i=n(1071),r=(n(0),n(7)),s=n(3),a=n(365),c=n(2),l=n(1038),d=n(1);const u=r.f.header.withConfig({displayName:"PageHeader__PageHeaderWrap",componentId:"sc-1gousn5-0"})(["display:flex;flex-flow:row wrap;align-items:center;justify-content:flex-start;background-color:",";margin-bottom:",";box-shadow:",";border-radius:",";padding:",";padding-bottom:0;.eform-admin-page-header__styledlink{margin-right:",";text-transform:uppercase;}"],(e=>e.theme.appBackgroundColor),(e=>Object(c.n)(e.theme.gutter)),(e=>e.theme.boxShadowElevationOne),(e=>Object(c.n)(e.theme.borderRadiusBase)),(e=>Object(c.n)(e.theme.gutter)),(e=>Object(c.n)(e.theme.gutter/2))),m=r.f.div.withConfig({displayName:"PageHeader__PageHeaderTitleWrap",componentId:"sc-1gousn5-1"})(["display:flex;flex-flow:row nowrap;align-items:center;margin-right:",";margin-bottom:",";flex:0 0 auto;"],(e=>Object(c.n)(e.theme.gutter)),(e=>Object(c.n)(e.theme.gutter))),f=r.f.h2.withConfig({displayName:"PageHeader__PageHeaderTitle",componentId:"sc-1gousn5-2"})(["margin:0;padding:0;font-size:",";color:",";font-weight:bold;"],(e=>Object(c.n)(e.theme.fz.base)),(e=>e.theme.textColor)),h=r.f.h4.withConfig({displayName:"PageHeader__PageHeaderSubtitle",componentId:"sc-1gousn5-3"})(["margin:0;padding:0;margin-bottom:",";flex:1 1 auto;font-size:",";color:",";font-weight:normal;font-style:italic;"],(e=>Object(c.n)(e.theme.gutter)),(e=>Object(c.n)(e.theme.fz.small1)),(e=>e.theme.greyLightColor)),p=r.f.div.withConfig({displayName:"PageHeader__PageControlLeft",componentId:"sc-1gousn5-4"})(["margin:0;padding:0;margin-bottom:",";flex:1 1 auto;max-width:100%;"],(e=>Object(c.n)(e.theme.gutter))),b=r.f.div.withConfig({displayName:"PageHeader__PageControlRight",componentId:"sc-1gousn5-5"})(["margin:0 0 "," auto;padding:0;flex:0 0 auto;"],(e=>Object(c.n)(e.theme.gutter))),g={transparent:!0,shape:"circle",size:"small",className:"eform-admin-page-header__styledlink eform-admin-page-header__styledlink--back"};function j(e){const t=e.title,n=e.subTitle,r=e.backLink,c=e.newLink,j=e.backLabel,v=void 0===j?Object(s.__)("Back","wp-eform"):j,y=e.newLabel,O=void 0===y?Object(s.__)("Add New","wp-eform"):y,w=e.controlLeft,C=e.controlRight,x=Object(a.useLastLocation)();let _;return _=null===r?null:x?`${x.pathname}${x.search}`:r,Object(d.jsxs)(u,{className:"eform-admin-page-header",children:[Object(d.jsxs)(m,{children:[_?Object(d.jsx)(l.b,{...g,to:_,title:v,children:Object(d.jsx)(i.a,{})}):null,c?Object(d.jsxs)(l.b,{size:"small",className:"eform-admin-page-header__styledlink eform-admin-page-header__styledlink--new",to:c,type:"primary",children:[Object(d.jsx)(o.a,{})," ",O]}):null,Object(d.jsx)(f,{children:t})]}),n?Object(d.jsx)(h,{children:n}):null,w?Object(d.jsx)(p,{children:w}):null,C?Object(d.jsx)(b,{children:C}):null]})}},1045:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return r}));var o=n(1189);const i=o.a`
	fragment FCheckboxConfig on FormElementCheckboxConfigType {
		interface {
			icon
			columns
			options {
				...FElemInterfaceOptionsConfig
			}
			others
			othersId
			othersPlaceholder
			shuffle
		}
		score {
			...FElemScoreConfig
		}
		attributes {
			...FElemAttributeConfig
		}
		validation {
			required
			filters {
				...FElemValidationFiltersConfig
			}
		}
	}
`,r=o.a`
	fragment FCheckboxSubmission on FormElementCheckboxSubmissionElementValueType {
		selected
		other
	}
`},1046:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return r}));var o=n(1189);const i=o.a`
	fragment FDropdownConfig on FormElementDropdownConfigType {
		interface {
			icon
			placeholder
			showSearch
			searchPlaceholder
			emptySearchResultNotice
			options {
				...FElemInterfaceOptionsConfig
			}
			othersId
			others
			othersPlaceholder
			shuffle
		}
		attributes {
			...FElemAttributeConfig
		}
		score {
			...FElemScoreConfig
		}
		validation {
			filters {
				...FElemValidationFiltersConfig
			}
			required
			selectType
		}
	}
`,r=o.a`
	fragment FDropdownSubmission on FormElementDropdownSubmissionElementValueType {
		selected
		other
	}
`},1047:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return r}));var o=n(1189);const i=o.a`
	fragment FRadioConfig on FormElementRadioConfigType {
		interface {
			columns
			icon
			othersId
			options {
				...FElemInterfaceOptionsConfig
			}
			others
			othersPlaceholder
			shuffle
		}
		attributes {
			...FElemAttributeConfig
		}
		score {
			...FElemScoreConfig
		}
		validation {
			required
		}
	}
`,r=o.a`
	fragment FRadioSubmission on FormElementRadioSubmissionElementValueType {
		other
		selected
	}
`},1048:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return r}));var o=n(1189);const i=o.a`
	fragment FTextConfig on FormElementTextConfigType {
		interface {
			icon
			placeholder
		}
		attributes {
			...FElemAttributeConfig
		}
		score {
			...FElemScoreConfig
		}
		validation {
			filters {
				...FElemValidationFiltersConfig
			}
			masks {
				...FElemValidationMasks
			}
			required
		}
	}
`,r=o.a`
	fragment FTextSubmission on FormElementTextSubmissionElementValueType {
		input
	}
`},1049:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return r}));var o=n(1189);const i=o.a`
	fragment FTextareaConfig on FormElementTextareaConfigType {
		interface {
			icon
			placeholder
		}
		attributes {
			...FElemAttributeConfig
		}
		score {
			...FElemScoreConfig
		}
		validation {
			required
			filters {
				...FElemValidationFiltersConfig
			}
		}
	}
`,r=o.a`
	fragment FTextareaSubmission on FormElementTextareaSubmissionElementValueType {
		input
	}
`},1050:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return r}));var o=n(1189);const i=o.a`
	fragment FToggleConfig on FormElementToggleConfigType {
		interface {
			activeIcon
			activeLabel
			inactiveIcon
			inactiveLabel
		}
		score {
			...FElemScoreConfig
		}
		attributes {
			...FElemAttributeConfig
		}
		validation {
			required
		}
	}
`,r=o.a`
	fragment FToggleSubmission on FormElementToggleSubmissionElementValueType {
		selected
	}
`},1051:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return r}));var o=n(1189);const i=o.a`
	fragment FSliderConfig on FormElementSliderConfigType {
		score {
			...FElemScoreConfig
		}
		attributes {
			...FElemAttributeConfig
		}
		interface {
			customMarks {
				index
				label
				markId
			}
			max
			min
			precision
			showFreeInput
			showMarks
			step
		}
	}
`,r=o.a`
	fragment FSliderSubmission on FormElementSliderSubmissionElementValueType {
		selected
	}
`},1052:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return r}));var o=n(1189);const i=o.a`
	fragment FRangeConfig on FormElementRangeConfigType {
		score {
			...FElemScoreConfig
		}
		attributes {
			...FElemAttributeConfig
		}
		interface {
			customMarks {
				index
				label
				markId
			}
			max
			min
			precision
			separator
			showFreeInput
			showMarks
			step
		}
	}
`,r=o.a`
	fragment FRangeSubmission on FormElementRangeSubmissionElementValueType {
		maxSelected
		minSelected
	}
`},1053:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return r}));var o=n(1189);const i=o.a`
	fragment FMathcalcConfig on FormElementMathcalcConfigType {
		interface {
			decimalSeparator
			formula
			precision
			prefix
			suffix
			type
			thousandsSeparator
		}
	}
`,r=o.a`
	fragment FMathcalcSubmission on FormElementMathcalcSubmissionElementValueType {
		output
	}
`},1054:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return r}));var o=n(1189);const i=o.a`
	fragment FRatingConfig on FormElementRatingConfigType {
		interface {
			compareWith
			customItems {
				icon
				itemId
			}
			customRatingIcon
			feedbackLabel
			feedbackWhen
			ratingMax
			showFeedback
			type
		}
		validation {
			required
		}
		score {
			...FElemScoreConfig
		}
		attributes {
			...FElemAttributeConfig
		}
	}
`,r=o.a`
	fragment FRatingSubmission on FormElementRatingSubmissionElementValueType {
		feedback
		selected
	}
`},1055:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return r}));var o=n(1189);const i=o.a`
	fragment FMatrixchoiceConfig on FormElementMatrixchoiceConfigType {
		validation {
			required
		}
		attributes {
			...FElemAttributeConfig
		}
		score {
			...FElemScoreConfig
		}
		interface {
			columns {
				itemId
				label
				num
				width
			}
			rows {
				itemId
				label
				num
				width
			}
			icon
			multiple
			rowHeadingWidth
			tableType
		}
	}
`,r=o.a`
	fragment FMatrixchoiceSubmission on FormElementMatrixchoiceSubmissionElementValueType {
		selected {
			columns
			rowId
		}
	}
`},1056:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return r}));var o=n(1189);const i=o.a`
	fragment FSortableConfig on FormElementSortableConfigType {
		attributes {
			...FElemAttributeConfig
		}
		score {
			...FElemScoreConfig
		}
		interface {
			items {
				itemId
				label
			}
			lockVertically
			shuffle
		}
	}
`,r=o.a`
	fragment FSortableSubmission on FormElementSortableSubmissionElementValueType {
		order
	}
`},1057:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return r}));var o=n(1189);const i=o.a`
	fragment FDatetimeinputConfig on FormElementDatetimeinputConfigType {
		validation {
			required
			maxValue
			minValue
		}
		attributes {
			...FElemAttributeConfig
		}
		score {
			...FElemScoreConfig
		}
		interface {
			dateTimeSeparator
			format
			icon
			showInputLabels
			timeType
			type
			hideSeconds
		}
	}
`,r=o.a`
	fragment FDatetimeinputSubmission on FormElementDatetimeinputSubmissionElementValueType {
		input
	}
`},1058:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return r}));var o=n(1189);const i=o.a`
	fragment FMatrixinputConfig on FormElementMatrixinputConfigType {
		validation {
			required
		}
		attributes {
			...FElemAttributeConfig
		}
		score {
			...FElemScoreConfig
		}
		interface {
			columns {
				itemId
				label
				num
				width
			}
			rows {
				itemId
				label
				num
				width
			}
			icon
			multiline
			rowHeadingWidth
			tableType
		}
	}
`,r=o.a`
	fragment FMatrixinputSubmission on FormElementMatrixinputSubmissionElementValueType {
		input {
			columnId
			rowId
			value
		}
	}
`},1059:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return r}));var o=n(1189);const i=o.a`
	fragment FSinglecheckboxConfig on FormElementSinglecheckboxConfigType {
		interface {
			icon
		}
		score {
			...FElemScoreConfig
		}
		attributes {
			...FElemAttributeConfig
		}
		validation {
			required
		}
	}
`,r=o.a`
	fragment FSinglecheckboxSubmission on FormElementSinglecheckboxSubmissionElementValueType {
		selected
	}
`},1060:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return r}));var o=n(1189);const i=o.a`
	fragment FAddressConfig on FormElementAddressConfigType {
		validation {
			required
		}
		attributes {
			...FElemAttributeConfig
		}
		interface {
			cityPlaceholder
			countryPlaceholder
			disableIcons
			fieldOne
			fieldOnePlaceholder
			fieldTwo
			fieldTwoPlaceholder
			restrictCountries
			showCity
			showCountry
			showState
			showZip
			statePlaceholder
			zipPlaceholder
		}
	}
`,r=o.a`
	fragment FAddressSubmission on FormElementAddressSubmissionElementValueType {
		city
		country
		fieldOne
		fieldTwo
		state
		zip
	}
`},1061:function(e,t,n){},1062:function(e,t){},1063:function(e,t,n){"use strict";n.d(t,"a",(function(){return O}));var o=n(1189);const i=o.a`
	fragment FCaptchaSubmission on FormElementCaptchaSubmissionElementValueType {
		encrypted
		solved
	}
`;var r=n(1045),s=n(1046),a=n(1047),c=n(1048),l=n(1049),d=n(1050),u=n(1051),m=n(1052),f=n(1053),h=n(1054),p=n(1055),b=n(1056),g=n(1057),j=n(1058),v=n(1059),y=n(1060);const O=o.a`
	fragment FAllElementSubmission on FormSubmissionElementValueType {
		captcha {
			...FCaptchaSubmission
		}
		radio {
			...FRadioSubmission
		}
		checkbox {
			...FCheckboxSubmission
		}
		dropdown {
			...FDropdownSubmission
		}
		text {
			...FTextSubmission
		}
		textarea {
			...FTextareaSubmission
		}
		toggle {
			...FToggleSubmission
		}
		slider {
			...FSliderSubmission
		}
		range {
			...FRangeSubmission
		}
		mathcalc {
			...FMathcalcSubmission
		}
		rating {
			...FRatingSubmission
		}
		matrixchoice {
			...FMatrixchoiceSubmission
		}
		sortable {
			...FSortableSubmission
		}
		datetimeinput {
			...FDatetimeinputSubmission
		}
		matrixinput {
			...FMatrixinputSubmission
		}
		singlecheckbox {
			...FSinglecheckboxSubmission
		}
		address {
			...FAddressSubmission
		}
	}
	# Submission Fragments
	${i}
	${a.b}
	${r.b}
	${s.b}
	${c.b}
	${l.b}
	${d.b}
	${u.b}
	${m.b}
	${f.b}
	${h.b}
	${p.b}
	${b.b}
	${g.b}
	${j.b}
	${v.b}
	${y.b}
`},1066:function(e,t,n){"use strict";n.d(t,"b",(function(){return i})),n.d(t,"a",(function(){return r}));var o=n(3);const i=new(n(148).a)("EForm Fonts");function r(e){if(!i.hasItem(e))return["inherit",null];const t=i.getItem(e);return[t.fontFamily,t.enqueue]}i.addItem("inherit",{name:Object(o.__)("Inherit from theme","wp-eform"),fontFamily:"inherit",enqueue:null}),i.addItem("system",{name:Object(o.__)("System UI","wp-eform"),fontFamily:'-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"',enqueue:null}),i.addItem("systemMono",{name:Object(o.__)("System UI Mono","wp-eform"),fontFamily:"'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, Courier, monospace",enqueue:null}),i.addItem("custom",{name:Object(o.__)("Custom Font","wp-eform"),fontFamily:"",enqueue:null}),i.addItem("alegreya",{name:"Alegreya",fontFamily:"'Alegreya', serif",enqueue:"https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("b612",{name:"B612",fontFamily:"'B612', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=B612:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("titilliumweb",{name:"Titillium Web",fontFamily:"'Titillium Web', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("vollkorn",{name:"Vollkorn",fontFamily:"'Vollkorn', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("ibmplexsans",{name:"IBM Plex Sans",fontFamily:"'IBM Plex Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"}),i.addItem("crimsontext",{name:"Crimson Text",fontFamily:"'Crimson Text', serif",enqueue:"https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap"}),i.addItem("karla",{name:"Karla",fontFamily:"'Karla', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("lora",{name:"Lora",fontFamily:"'Lora', serif",enqueue:"https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"}),i.addItem("playfairdisplay",{name:"Playfair Display",fontFamily:"'Playfair Display', serif",enqueue:"https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("archivo",{name:"Archivo",fontFamily:"'Archivo', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"}),i.addItem("spectral",{name:"Spectral",fontFamily:"'Spectral', serif",enqueue:"https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"}),i.addItem("roboto",{name:"Roboto",fontFamily:"'Roboto', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"}),i.addItem("montserrat",{name:"Montserrat",fontFamily:"'Montserrat', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("rubik",{name:"Rubik",fontFamily:"'Rubik', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("sourcesanspro",{name:"Source Sans Pro",fontFamily:"'Source Sans Pro', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap"}),i.addItem("cormorant",{name:"Cormorant",fontFamily:"'Cormorant', serif",enqueue:"https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"}),i.addItem("worksans",{name:"Work Sans",fontFamily:"'Work Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("arvo",{name:"Arvo",fontFamily:"'Arvo', serif",enqueue:"https://fonts.googleapis.com/css2?family=Arvo:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("lato",{name:"Lato",fontFamily:"'Lato', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"}),i.addItem("ubuntu",{name:"Ubuntu",fontFamily:"'Ubuntu', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"}),i.addItem("ptserif",{name:"PT Serif",fontFamily:"'PT Serif', serif",enqueue:"https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("ptsans",{name:"PT Sans",fontFamily:"'PT Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("poppins",{name:"Poppins",fontFamily:"'Poppins', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("firasans",{name:"Fira Sans",fontFamily:"'Fira Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("nunito",{name:"Nunito",fontFamily:"'Nunito', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("exo2",{name:"Exo 2",fontFamily:"'Exo 2', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("opensans",{name:"Open Sans",fontFamily:"'Open Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap"}),i.addItem("merriweather",{name:"Merriweather",fontFamily:"'Merriweather', serif",enqueue:"https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"}),i.addItem("notosans",{name:"Noto Sans",fontFamily:"'Noto Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("spacemono",{name:"Space Mono",fontFamily:"'Space Mono', monospace",enqueue:"https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("librefranklin",{name:"Libre Franklin",fontFamily:"'Libre Franklin', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("alegreyasans",{name:"Alegreya Sans",fontFamily:"'Alegreya Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&display=swap"}),i.addItem("chivo",{name:"Chivo",fontFamily:"'Chivo', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Chivo:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"}),i.addItem("sourceserifpro",{name:"Source Serif Pro",fontFamily:"'Source Serif Pro', serif",enqueue:"https://fonts.googleapis.com/css2?family=Source+Serif+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap"}),i.addItem("archivonarrow",{name:"Archivo Narrow",fontFamily:"'Archivo Narrow', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Archivo+Narrow:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"}),i.addItem("prozalibre",{name:"Proza Libre",fontFamily:"'Proza Libre', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Proza+Libre:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap"}),i.addItem("cabin",{name:"cabin",fontFamily:"'Cabin', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"}),i.addItem("raleway",{name:"Raleway",fontFamily:"'Raleway', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("anonymouspro",{name:"Anonymous Pro",fontFamily:"'Anonymous Pro', monospace",enqueue:"https://fonts.googleapis.com/css2?family=Anonymous+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap"})},1072:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));const o=n(1189).a`
	fragment FElemAttributeConfig on FormElementConfigAttributesType {
		defaultValue
		prefilParameter
		prefilType
		readonly
	}
`},1073:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));const o=n(1189).a`
	fragment FElemInterfaceOptionsConfig on FormElementConfigMcqOptionType {
		answerDescription
		id
		label
		num
	}
`},1074:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));const o=n(1189).a`
	fragment FElemScoreConfig on FormElementConfigScoreType {
		scoreConditions {
			compareWith
			condition
			id
			operation
			scoreId
			scoreOperation
			scoreValue
		}
	}
`},1075:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));const o=n(1189).a`
	fragment FElemValidationFiltersConfig on FormElementConfigFiltersType {
		type
		minItems
		maxItems
		minString
		maxString
		minNum
		maxNum
	}
`},1076:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));const o=n(1189).a`
	fragment FElemValidationMasks on FormElementConfigMasksType {
		alwaysShowMask
		maskPreset
		maskRegExps {
			caseSensitive
			id
			pattern
		}
		maskString
		maskType
		placeholder
	}
`},1077:function(e,t,n){"use strict";n(8)},1079:function(e,t,n){"use strict";n.d(t,"a",(function(){return w}));var o=n(1189);const i=o.a`
	fragment FButtonsConfig on FormElementButtonsConfigType {
		attributes {
			open
			popupHeight
			popupWidth
		}
		buttons {
			id
			icon
			iconPosition
			label
			link
		}
		interface {
			alignment
			colored
			size
			style
			rounded
		}
	}
`;var r=n(1045),s=n(1046);const a=o.a`
	fragment FHeadingConfig on FormElementHeadingConfigType {
		interface {
			divider
			icon
			showTop
			size
			tag
		}
	}
`;var c=n(1047),l=n(1048),d=n(1049),u=n(1050),m=n(1051),f=n(1052),h=n(1053),p=n(1054),b=n(1055),g=n(1056),j=n(1057),v=n(1058),y=n(1059),O=n(1060);const w=o.a`
	fragment FAllElementConfig on FormElementConfigType {
		buttons {
			...FButtonsConfig
		}
		checkbox {
			...FCheckboxConfig
		}
		dropdown {
			...FDropdownConfig
		}
		heading {
			...FHeadingConfig
		}
		radio {
			...FRadioConfig
		}
		text {
			...FTextConfig
		}
		textarea {
			...FTextareaConfig
		}
		toggle {
			...FToggleConfig
		}
		slider {
			...FSliderConfig
		}
		range {
			...FRangeConfig
		}
		mathcalc {
			...FMathcalcConfig
		}
		rating {
			...FRatingConfig
		}
		matrixchoice {
			...FMatrixchoiceConfig
		}
		sortable {
			...FSortableConfig
		}
		datetimeinput {
			...FDatetimeinputConfig
		}
		matrixinput {
			...FMatrixinputConfig
		}
		singlecheckbox {
			...FSinglecheckboxConfig
		}
		address {
			...FAddressConfig
		}
	}
	${i}
	${r.a}
	${s.a}
	${a}
	${c.a}
	${l.a}
	${d.a}
	${u.a}
	${m.a}
	${f.a}
	${h.a}
	${p.a}
	${b.a}
	${g.a}
	${j.a}
	${v.a}
	${y.a}
	${O.a}
`},1080:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));const o=n(1189).a`
	fragment FConfigConditionals on ConditionalType {
		id
		events {
			id
			fieldid
			has
			operation
			operator
			value
			relation
		}
		consequences {
			id
			action
			fieldsToShow
			fieldsToHide
			fieldToSet
			value
			pagesToShow
			pagesToHide
		}
	}
`},1081:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));const o=n(1189).a`
	fragment FConfigSettingsTImer on FormSettingsTimerType {
		recordSubmissionTime
		showStopwatch
		submitTimer
		showTimer
		timeLimit
		timerMessage
	}
`},1082:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));const o=n(1189).a`
	fragment FConfigSettingsScore on FormSettingsScoreType {
		precision
		scoreLists {
			id
			name
			color
			outcomeName
			outcomeDescription
		}
		designations {
			description
			from
			fromToType
			id
			name
			scoreCategory
			to
		}
	}
`},1083:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));const o=n(1189).a`
	fragment FElementAppearance on FormElementAppearanceType {
		title
		subtitle
		description
		overrideControlAppearance
		controlType
		controlAlignment
		controlLayout
		hint
		hintIcon
		hintLabel
		answerDescription
		columnSize
		basicWidth
		widths {
			id
			containerMinWidth
			elementWidth
		}
		initiallyHidden
		className
	}
`},1084:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));const o=n(1189).a`
	fragment FStructure on FormStructureType {
		id
		config {
			title
			subtitle
			icon
			timer
			initiallyHidden
		}
		children
	}
`},1085:function(e,t,n){"use strict";n.d(t,"useGesture",(function(){return c}));var o=n(1040),i=n(0),r=n.n(i),s=n(1086);n(1061),n(1062);function a(e,t={},n,o){const i=r.a.useMemo((()=>new s.a(e)),[]);if(i.applyHandlers(e,o),i.applyConfig(t,n),r.a.useEffect(i.effect.bind(i)),r.a.useEffect((()=>i.clean.bind(i)),[]),void 0===t.target)return i.bind.bind(i)}function c(e,t){return([o.a,o.d,o.f,o.g,o.c,o.b].forEach(o.e),function(e,t){const n=Object(s.b)(e,t||{}),o=n.handlers,i=n.nativeHandlers;return a(o,n.config,void 0,i)})(e,t||{})}},1086:function(e,t,n){"use strict";n.d(t,"a",(function(){return u})),n.d(t,"b",(function(){return b}));var o=n(6),i=n(1034);function r(e,t){if(null==e)return{};var n,o,i=function(e,t){if(null==e)return{};var n,o,i={},r=Object.keys(e);for(o=0;o<r.length;o++)n=r[o],t.indexOf(n)>=0||(i[n]=e[n]);return i}(e,t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);for(o=0;o<r.length;o++)n=r[o],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(i[n]=e[n])}return i}const s={target(e){if(e)return()=>"current"in e?e.current:e},enabled:(e=!0)=>e,window:(e=(i.c.isBrowser?window:void 0))=>e,eventOptions:({passive:e=!0,capture:t=!1}={})=>({passive:e,capture:t}),transform:e=>e},a=["target","eventOptions","window","enabled","transform"];function c(e={},t){const n={};for(const r of Object.entries(t)){var i=Object(o.a)(r,2);const t=i[0],s=i[1];switch(typeof s){case"function":n[t]=s.call(n,e[t],t,e);break;case"object":n[t]=c(e[t],s);break;case"boolean":s&&(n[t]=e[t])}}return n}class l{constructor(e,t){Object(i.e)(this,"_listeners",new Set),this._ctrl=e,this._gestureKey=t}add(e,t,n,o,r){const s=this._listeners,a=Object(i.q)(t,n),c=this._gestureKey?this._ctrl.config[this._gestureKey].eventOptions:{},l=Object(i.d)(Object(i.d)({},c),r);e.addEventListener(a,o,l);const d=()=>{e.removeEventListener(a,o,l),s.delete(d)};return s.add(d),d}clean(){this._listeners.forEach((e=>e())),this._listeners.clear()}}class d{constructor(){Object(i.e)(this,"_timeouts",new Map)}add(e,t,n=140,...o){this.remove(e),this._timeouts.set(e,window.setTimeout(t,n,...o))}remove(e){const t=this._timeouts.get(e);t&&window.clearTimeout(t)}clean(){this._timeouts.forEach((e=>{window.clearTimeout(e)})),this._timeouts.clear()}}class u{constructor(e){Object(i.e)(this,"gestures",new Set),Object(i.e)(this,"_targetEventStore",new l(this)),Object(i.e)(this,"gestureEventStores",{}),Object(i.e)(this,"gestureTimeoutStores",{}),Object(i.e)(this,"handlers",{}),Object(i.e)(this,"config",{}),Object(i.e)(this,"pointerIds",new Set),Object(i.e)(this,"touchIds",new Set),Object(i.e)(this,"state",{shared:{shiftKey:!1,metaKey:!1,ctrlKey:!1,altKey:!1}}),function(e,t){t.drag&&m(e,"drag");t.wheel&&m(e,"wheel");t.scroll&&m(e,"scroll");t.move&&m(e,"move");t.pinch&&m(e,"pinch");t.hover&&m(e,"hover")}(this,e)}setEventIds(e){return Object(i.l)(e)?(this.touchIds=new Set(Object(i.f)(e)),this.touchIds):"pointerId"in e?("pointerup"===e.type||"pointercancel"===e.type?this.pointerIds.delete(e.pointerId):"pointerdown"===e.type&&this.pointerIds.add(e.pointerId),this.pointerIds):void 0}applyHandlers(e,t){this.handlers=e,this.nativeHandlers=t}applyConfig(e,t){this.config=function(e,t,n={}){const o=e,l=o.target,d=o.eventOptions,u=o.window,m=o.enabled,f=o.transform,h=r(o,a);if(n.shared=c({target:l,eventOptions:d,window:u,enabled:m,transform:f},s),t){const e=i.a.get(t);n[t]=c(Object(i.d)({shared:n.shared},h),e)}else for(const e in h){const t=i.a.get(e);t&&(n[e]=c(Object(i.d)({shared:n.shared},h[e]),t))}return n}(e,t,this.config)}clean(){this._targetEventStore.clean();for(const e of this.gestures)this.gestureEventStores[e].clean(),this.gestureTimeoutStores[e].clean()}effect(){return this.config.shared.target&&this.bind(),()=>this._targetEventStore.clean()}bind(...e){const t=this.config.shared,n={};let o;if(!t.target||(o=t.target(),o)){if(t.enabled){for(const t of this.gestures){const r=this.config[t],s=f(n,r.eventOptions,!!o);if(r.enabled){new(i.b.get(t))(this,e,t).bind(s)}}const r=f(n,t.eventOptions,!!o);for(const t in this.nativeHandlers)r(t,"",(n=>this.nativeHandlers[t](Object(i.d)(Object(i.d)({},this.state.shared),{},{event:n,args:e}))),void 0,!0)}for(const e in n)n[e]=Object(i.g)(...n[e]);if(!o)return n;for(const e in n){const t=Object(i.n)(e),r=t.device,s=t.capture,a=t.passive;this._targetEventStore.add(o,r,"",n[e],{capture:s,passive:a})}}}}function m(e,t){e.gestures.add(t),e.gestureEventStores[t]=new l(e,t),e.gestureTimeoutStores[t]=new d}const f=(e,t,n)=>(o,r,s,a={},c=!1)=>{var l,d;const u=null!==(l=a.capture)&&void 0!==l?l:t.capture,m=null!==(d=a.passive)&&void 0!==d?d:t.passive;let f=c?o:Object(i.h)(o,r,u);n&&m&&(f+="Passive"),e[f]=e[f]||[],e[f].push(s)},h=/^on(Drag|Wheel|Scroll|Move|Pinch|Hover)/;function p(e,t,n,o,r,s){if(!e.has(n))return;if(!i.b.has(o))return void 0;const a=n+"Start",c=n+"End";r[o]=e=>{let o;return e.first&&a in t&&t[a](e),n in t&&(o=t[n](e)),e.last&&c in t&&t[c](e),o},s[o]=s[o]||{}}function b(e,t){const n=function(e){const t={},n={},o=new Set;for(let i in e)h.test(i)?(o.add(RegExp.lastMatch),n[i]=e[i]):t[i]=e[i];return[n,t,o]}(e),i=Object(o.a)(n,3),r=i[0],s=i[1],a=i[2],c={};return p(a,r,"onDrag","drag",c,t),p(a,r,"onWheel","wheel",c,t),p(a,r,"onScroll","scroll",c,t),p(a,r,"onPinch","pinch",c,t),p(a,r,"onMove","move",c,t),p(a,r,"onHover","hover",c,t),{handlers:c,config:t,nativeHandlers:s}}},1087:function(e,t,n){"use strict";n.d(t,"a",(function(){return vt}));var o=n(42),i=n(0),r=n(15),s=n(3),a=n(10),c=n.n(a),l=n(53),d=n(162),u=n.n(d),m=n(7),f=n(283),h=n(1085),p=n(2),b=n(18),g=n(287),j=n(29),v=n(1);const y="wpeform-component-progressbar",O=Object(p.d)(y,"bar"),w=Object(m.g)(["0%{width:0;opacity:0.1;}20%{width:0;opacity:0.5;}100%{width:100%;opacity:0;}"]),C=Object(m.f)(l.animated.div).withConfig({displayName:"Progressbar__AnimatedTabsProgress",componentId:"sc-70ygvj-0"})(["will-change:width;background-color:",";height:",";position:relative;&.","--is-active{&::before{position:absolute;top:0;right:0;bottom:0;left:0;background:",";opacity:0;animation:"," 2.4s cubic-bezier(0.23,1,0.32,1) infinite;content:'';}}"],(e=>e.theme.primaryColor),(e=>Object(p.n)(.25*e.theme.controlHeightBase)),O,(e=>e.theme.primaryBgText),w),x=Object(m.f)(l.animated.span).withConfig({displayName:"Progressbar__ProgressLabel",componentId:"sc-70ygvj-1"})(["margin:0;padding:0;color:",";font-size:",";line-height:1;font-weight:bold;position:absolute;right:0.2em;"],(e=>e.theme.textColorSecondary),(e=>Object(p.n)(e.theme.fz.small2))),_=m.f.div.withConfig({displayName:"Progressbar__ProgressContainer",componentId:"sc-70ygvj-2"})(["height:",";background-color:",";overflow:hidden;width:100%;"],(e=>Object(p.n)(.25*e.theme.controlHeightBase)),(e=>Object(j.d)(.05,e.theme.disabledColor))),S=m.f.div.withConfig({displayName:"Progressbar__ProgressbarWrapper",componentId:"sc-70ygvj-3"})(["",";position:relative;&.","--is-bottom-rounded{","{border-bottom-left-radius:",";border-bottom-right-radius:",";}}&.","--is-top-rounded{","{border-top-left-radius:",";border-top-right-radius:",";}}&.","--is-bottom-rounded.","--is-top-rounded{",",",",","::before{border-radius:",";}}&.","--label-position-top{","{top:-1.2em;}}&.","--label-position-bottom{","{bottom:-1.2em;}}"],p.b,y,_,(e=>Object(p.n)(e.theme.borderRadiusBase)),(e=>Object(p.n)(e.theme.borderRadiusBase)),y,_,(e=>Object(p.n)(e.theme.borderRadiusBase)),(e=>Object(p.n)(e.theme.borderRadiusBase)),y,y,_,C,C,(e=>Object(p.n)(.25*e.theme.controlHeightBase)),y,x,y,x);function k(e){const t=e.width,n=e.active,o=void 0!==n&&n,i=e.isBottomRounded,r=void 0!==i&&i,s=e.isTopRounded,a=void 0!==s&&s,c=e.showLabel,d=void 0===c||c,u=e.precision,f=void 0===u?2:u,h=e.labelPosition,b=void 0===h?"top":h,g=Object(m.h)(),j=Object(l.useSpring)({from:{width:"0%"},to:{width:`${t}%`},config:{...g.springConfigSlow,clamp:!0}}),w=Object(l.useSpring)({number:t,from:{number:0},config:{...g.springConfigSlow,clamp:!0}});return Object(v.jsxs)(S,{className:Object(p.c)(y,{"is-bottom-rounded":r,"is-top-rounded":a,"is-active":o,[`label-position-${b}`]:!0}),children:[Object(v.jsx)(_,{children:Object(v.jsx)(C,{style:j,className:Object(p.c)(O,{"is-active":!!o}),"aria-valuenow":t,"aria-valuemin":0,"aria-valuemax":100})}),d?Object(v.jsx)(x,{children:w.number.to((e=>`${e.toFixed(f)}%`))}):null]})}var F=n(8),T=n(36),E=n(361),I=n(66);const P="wpeform-component-tabs",M=Object(p.d)(P,"nav-button"),L=Object(p.d)(P,"button"),B=Object(p.d)(P,"button-icon"),A=Object(p.d)(P,"button-label"),N=Object(p.d)(P,"button-label-title"),R=Object(p.d)(P,"button-label-subtitle"),D=m.f.div.withConfig({displayName:"styled__TabsContainer",componentId:"sc-1t0opj6-0"})(["",";box-shadow:",";border-radius:",";overflow-anchor:none;background-color:",";"],p.b,(e=>e.theme.boxShadow4dp),(e=>Object(p.n)(e.theme.borderRadiusBase)),(e=>e.theme.appBackgroundColor)),$=m.f.nav.withConfig({displayName:"styled__TabsNavigation",componentId:"sc-1t0opj6-1"})(["background-color:",";border-top-left-radius:",";border-top-right-radius:",";overflow:hidden;display:flex;flex-flow:row nowrap;align-items:stretch;width:100%;position:relative;z-index:2;.","{padding:0;justify-content:center;position:absolute;left:0;top:0;flex:0 0 ",";width:",";height:100%;z-index:1;background-color:transparent;background-image:linear-gradient( to right,",","," 50%,"," 100% );&::before{position:absolute;pointer-events:none;content:'';display:block;top:0;left:0;width:100%;height:100%;background-color:",";opacity:0;transition:",";}&:disabled{opacity:0;pointer-events:none;}.","{position:relative;}.","{font-size:",";}&.right{background-image:linear-gradient( to left,",","," 50%,"," 100% );left:auto;right:0;}&:hover,&:focus{background-color:transparent;&::before{opacity:1;}}&:active{.","{transform:scale(0.8);}}}"],(e=>e.theme.primaryLightColor),(e=>Object(p.n)(e.theme.borderRadiusBase)),(e=>Object(p.n)(e.theme.borderRadiusBase)),M,(e=>Object(p.n)(.75*e.theme.gutter)),(e=>Object(p.n)(.75*e.theme.gutter)),(e=>e.theme.primaryLightColor),(e=>e.theme.primaryLightColor),(e=>Object(j.e)(1,e.theme.primaryLightColor)),(e=>e.theme.primaryColor),(e=>Object(p.f)(["opacity"],e.theme.transitionControl)),A,N,(e=>Object(p.n)(e.theme.fz.small2)),(e=>e.theme.primaryLightColor),(e=>e.theme.primaryLightColor),(e=>Object(j.e)(1,e.theme.primaryLightColor)),A),z=Object(m.f)(l.animated.div).withConfig({displayName:"styled__TabsScroller",componentId:"sc-1t0opj6-2"})(["flex:1 0 auto;width:100%;will-change:transform;touch-action:pan-y;"]),H=(Object(m.f)(l.animated.div).withConfig({displayName:"styled__AnimatedTabPanel",componentId:"sc-1t0opj6-3"})(["will-change:opacity,position,transform;"]),m.f.div.withConfig({displayName:"styled__TabsNavButtonsContainer",componentId:"sc-1t0opj6-4"})(["display:flex;flex-flow:row nowrap;touch-action:pan-y;"])),q=m.f.button.withConfig({displayName:"styled__TabButton",componentId:"sc-1t0opj6-5"})(["font-family:",";position:relative;overflow:hidden;flex:0 0 auto;display:flex;align-items:center;justify-content:flex-start;padding:"," ",";min-height:",";border:0 none;margin:0;outline:none;border-radius:0;background-color:",";cursor:pointer;color:",";text-align:left;transition:",";&.","--active{background-color:",";color:",";}&:hover{background-color:",";}&:focus{background-color:",";color:",";}&:active{.","{transform:scale(0.97);transform-origin:center center;}}.","{font-size:",";margin:0 "," 0 0;flex:0 0 auto;}.","{flex:0 0 auto;display:flex;flex-flow:column nowrap;}.","{font-size:",";font-weight:",";line-height:1;white-space:nowrap;}.","{font-size:",";font-style:",";line-height:1;white-space:nowrap;margin:0;}"],(e=>e.theme.fontFamilyHeading),(e=>Object(p.n)(e.theme.gutter/2)),(e=>Object(p.n)(e.theme.gutter)),(e=>Object(p.n)(1.25*e.theme.controlHeightBase)),(e=>e.theme.primaryLightColor),(e=>Object(j.e)(.3,e.theme.primaryBgText)),(e=>Object(p.f)(["background-color","color"],e.theme.transitionControl)),L,(e=>e.theme.primaryColor),(e=>e.theme.primaryBgText),(e=>e.theme.primaryColor),(e=>e.theme.primaryColor),(e=>e.theme.primaryBgText),A,B,(e=>Object(p.n)(e.theme.fz.large3)),(e=>Object(p.n)(e.theme.gutter/2)),A,N,(e=>Object(p.n)(e.theme.fz.large1)),(e=>e.theme.boldHeading?"500":"normal"),R,(e=>Object(p.n)(e.theme.fz.small2)),(e=>e.theme.italicHeading?"italic":"normal")),V=m.f.div.withConfig({displayName:"styled__TabPanel",componentId:"sc-1t0opj6-6"})(["position:relative;overflow:hidden;&:focus{outline:none;}"]),W=m.f.footer.withConfig({displayName:"styled__TabFooter",componentId:"sc-1t0opj6-7"})(["overflow:hidden;border-bottom-left-radius:",";border-bottom-right-radius:",";"],(e=>Object(p.n)(e.theme.borderRadiusBase)),(e=>Object(p.n)(e.theme.borderRadiusBase))),U=m.f.aside.withConfig({displayName:"styled__StopwatchContainer",componentId:"sc-1t0opj6-8"})(["padding:0 "," ",";"],(e=>Object(p.n)(1.5*e.theme.gutter)),(e=>Object(p.n)(.5*e.theme.gutter))),K=m.f.span.withConfig({displayName:"styled__StopwatchClock",componentId:"sc-1t0opj6-9"})(["display:block;font-size:",";color:",";font-weight:bold;line-height:1;"],(e=>Object(p.n)(e.theme.fz.large3)),(e=>e.theme.textColorSecondary)),Y=m.f.span.withConfig({displayName:"styled__StopwatchStamp",componentId:"sc-1t0opj6-10"})(["display:block;font-size:",";line-height:1;color:",";"],(e=>Object(p.n)(e.theme.fz.small2)),(e=>e.theme.textColorSecondary));function G(e){const t=e.title,n=e.subtitle,o=e.icon,i=e.onClick,s=e.active,a=e.className,c=e.id,l=e.disabled,d=Object(g.a)({darkBg:!0}),u=Object(r.a)(d,2),m=u[0],f=u[1];return Object(v.jsxs)(q,{id:c,disabled:l,className:Object(p.c)(L,{active:!!s},a),onClick:e=>{e.preventDefault(),m(e),i()},type:"button",children:[f,o?Object(v.jsx)("span",{className:B,children:Object(v.jsx)(b.b,{iconClass:o})}):null,Object(v.jsxs)("span",{className:A,children:[Object(v.jsx)("span",{className:N,children:t}),n?Object(v.jsx)("span",{className:R,children:n}):null]})]})}function X(e){var t;const n=e.currentTab,o=e.tabs,s=e.onTabChange,a=Object(m.h)(),d=Object(i.useRef)(null),f=u()(d),p=Object(i.useState)({leftDisabled:!0,rightDisabled:!1,left:0}),g=Object(r.a)(p,2),j=g[0],y=g[1],O=Object(l.useSpring)((()=>({from:{transform:"translateX(0px)"},to:{transform:`translateX(${-1*j.left}px)`},config:{...a.springConfigStiff,clamp:!0}}))),w=Object(r.a)(O,2),C=w[0],x=w[1];Object(i.useEffect)((()=>{x.start({transform:`translateX(${-1*j.left}px)`})}),[j.left,x]);const _=(e,t)=>{if(!d.current)return;let n=0;d.current.querySelectorAll("button").forEach((e=>{n+=e.offsetWidth}));const o=d.current.offsetWidth;let i=j.left-e;if(n<o?i=0:(i<0&&(i=0),i>n-o&&(i=n-o)),t){let e=!1,t=!1;0===i&&(e=!0),i+o>=n&&(t=!0),y({left:i,leftDisabled:e,rightDisabled:t})}else x.start({transform:`translateX(${-1*i}px)`})},S=Object(i.useCallback)(((e,t,n)=>{y({left:e,leftDisabled:t,rightDisabled:n})}),[]);Object(h.useGesture)({onDrag(e){const t=e.movement,n=e.down;_(t[0],!n)},onWheel(e){const t=e.event,n=e.movement;Math.abs(t.deltaX)<=Math.abs(t.deltaY)||(t.preventDefault(),t.stopPropagation(),_(n[0],!0))}},{target:null!==(t=d.current)&&void 0!==t?t:void 0,eventOptions:{passive:!1},drag:{filterTaps:!0}});const k=Object(i.useCallback)((e=>{if(!d.current)return;let t=0,n=0,o=!1,i=0;d.current.querySelectorAll("button").forEach((r=>{i+=r.offsetWidth,o||(r.getAttribute("id")===`tab-item-${e}`?(o=!0,n=r.offsetWidth):t+=r.offsetWidth)}));const r=d.current.offsetWidth;if(i<=r)return void S(0,!0,!0);if(t+n<=r)return void S(0,!0,!1);let s=t+n-r+90;n+90>r&&(s=t-.75*a.gutter),s<0&&(s=0),s>i-r&&(s=i-r),S(s,!1,s+r>=i)}),[a.gutter,S]);return Object(i.useLayoutEffect)((()=>{k(n)}),[n,k,f.width]),Object(v.jsxs)($,{children:[Object(v.jsx)(G,{className:M,title:Object(v.jsx)(b.b,{iconClass:"fas fa-angle-left"}),onClick:()=>{_(150,!0)},disabled:j.leftDisabled}),Object(v.jsx)(z,{style:C,children:Object(v.jsx)(H,{ref:d,children:o.map((e=>Object(v.jsx)(G,{onClick:()=>{s(e.id)},active:n===e.id,id:`tab-item-${e.id}`,icon:e.icon,subtitle:e.subtitle,title:e.title},e.id)))})}),Object(v.jsx)(G,{className:c()(M,"right"),title:Object(v.jsx)(b.b,{iconClass:"fas fa-angle-right"}),onClick:()=>{_(-150,!0)},disabled:j.rightDisabled})]})}function Q(e){const t=e.stopwatchStartTime,n=Object(i.useState)(0),o=Object(r.a)(n,2),a=o[0],c=o[1];Object(i.useEffect)((()=>{const e=()=>{const e=Math.abs(Date.now()-t);c(e)},n=setInterval(e,1e3);return e(),()=>{clearInterval(n)}}),[t]);const l=Object(T.c)(a),d=l.hours,u=l.minutes,m=l.seconds;return Object(v.jsxs)(U,{children:[Object(v.jsx)(K,{children:Object(s.sprintf)(Object(s._x)("%s:%s:%s","timer","wp-eform"),d,u,m)}),Object(v.jsx)(Y,{children:Object(s.sprintf)(Object(s.__)("time elapsed since %s","wp-eform"),Object(E.e)(t).format("LTS"))})]})}function Z(e){const t=e.currentTab,n=e.onTabChange,o=e.tabs,r=e.children,s=e.className,a=e.scrollOnTabChange,c=void 0===a||a,l=e.tabScrollOffset,d=void 0===l?-100:l,u=e.footer,m=e.showProgressBar,h=void 0===m||m,b=e.showProgressLabel,g=void 0===b||b,j=e.showTabs,y=void 0===j||j,O=e.progressBarPosition,w=void 0===O?F.E.TOP:O,C=e.progressBarPrecision,x=void 0===C?2:C,_=e.forceProgress,S=e.stopwatchStartTime,T=Object(i.useRef)(null),E=Object(i.useRef)(null),M=Object(i.useRef)(!0);let L=o.findIndex((e=>e.id===t));-1===L&&(L=0);const B=_||L/(o.length||1)*100;return Object(i.useLayoutEffect)((()=>{M.current?M.current=!1:(E.current&&E.current.focus({preventScroll:!0}),c&&T.current&&Object(f.a)(T.current,{verticalOffset:d,cancelOnUserAction:!0,elementToScroll:Object(I.f)(T.current)[0]}))}),[t,c,d]),Object(v.jsxs)(D,{ref:T,className:Object(p.c)(P,{"has-footer":!!u},s),children:[y?Object(v.jsx)(X,{currentTab:t,onTabChange:n,tabs:o}):null,h&&w===F.E.TOP?Object(v.jsx)(k,{width:B,labelPosition:"bottom",isTopRounded:!y,precision:x,showLabel:g}):null,Object(v.jsx)(V,{tabIndex:0,ref:E,children:r}),S?Object(v.jsx)(Q,{stopwatchStartTime:S}):null,h&&w===F.E.BOTTOM?Object(v.jsx)(k,{width:B,isBottomRounded:!u,labelPosition:"top",precision:x,showLabel:g}):null,u?Object(v.jsx)(W,{children:u}):null]})}var J=n(448),ee=n(147);const te="wpeform-component-animatedsvg",ne=Object(p.d)(te,"svg"),oe=Object(m.f)(l.animated.path).withConfig({displayName:"AnimatedSvg__AnimatedPathFill",componentId:"sc-1crsfqd-0"})(["will-change:opacity,transform;"]),ie=Object(m.f)(l.animated.path).withConfig({displayName:"AnimatedSvg__AnimatedPathStroke",componentId:"sc-1crsfqd-1"})(["stroke-dasharray:65 66;will-change:stroke-dashoffset;"]),re=m.f.div.withConfig({displayName:"AnimatedSvg__Container",componentId:"sc-1crsfqd-2"})(["",";display:inline-flex;align-items:center;justify-content:center;.","{height:1em;width:1em;display:block;}"],p.b,ne);function se(e,t=2){const n=Object(l.useTrail)(t,(n=>({from:{strokeDashoffset:66},strokeDashoffset:0,config:n===t-1?e.springConfigSlow:{...e.springConfigGeneral,clamp:!0}})));return[Object(r.a)(n,1)[0],Object(l.useSpring)({from:{opacity:0,transform:"translate(0px, 0px)"},opacity:1,transform:"translate(2px, 2px)",config:e.springConfigSlow,delay:500})]}function ae(e){const t=e.colorfulBg,n=Object(m.h)(),o=se(n,2),i=Object(r.a)(o,2),s=i[0],a=i[1];return Object(v.jsx)(v.Fragment,{children:Object(v.jsxs)("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",className:ne,children:[Object(v.jsx)(oe,{style:a,stroke:t?n.successBackgroundColor:n.successColor,fill:t?n.successColor:n.successBackgroundColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"0",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(v.jsx)(ie,{strokeDashoffset:s[1].strokeDashoffset,stroke:t?n.successBackgroundColor:n.successColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(v.jsx)(ie,{strokeDashoffset:s[0].strokeDashoffset,stroke:t?n.successBackgroundColor:n.successColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M8.25 9.5L10.75 12L15.75 7"})]})})}function ce(e){const t=e.colorfulBg,n=Object(m.h)(),o=se(n,3),i=Object(r.a)(o,2),s=i[0],a=i[1];return Object(v.jsx)(v.Fragment,{children:Object(v.jsxs)("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",className:ne,children:[Object(v.jsx)(oe,{style:a,stroke:t?n.warningBackgroundColor:n.warningColor,fill:t?n.warningColor:n.warningBackgroundColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"0",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(v.jsx)(ie,{strokeDashoffset:s[2].strokeDashoffset,stroke:t?n.warningBackgroundColor:n.warningColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(v.jsx)(ie,{strokeDashoffset:s[0].strokeDashoffset,stroke:t?n.warningBackgroundColor:n.warningColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M11.99 13H12.01"}),Object(v.jsx)(ie,{strokeDashoffset:s[1].strokeDashoffset,stroke:t?n.warningBackgroundColor:n.warningColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M12 6V10"})]})})}function le(e){const t=e.colorfulBg,n=Object(m.h)(),o=se(n,3),i=Object(r.a)(o,2),s=i[0],a=i[1];return Object(v.jsx)(v.Fragment,{children:Object(v.jsxs)("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",className:ne,children:[Object(v.jsx)(oe,{style:a,stroke:t?n.errorBackgroundColor:n.errorColor,fill:t?n.errorColor:n.errorBackgroundColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"0",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(v.jsx)(ie,{strokeDashoffset:s[2].strokeDashoffset,stroke:t?n.errorBackgroundColor:n.errorColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(v.jsx)(ie,{strokeDashoffset:s[0].strokeDashoffset,stroke:t?n.errorBackgroundColor:n.errorColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M14.5 7L9.5 12"}),Object(v.jsx)(ie,{strokeDashoffset:s[1].strokeDashoffset,stroke:t?n.errorBackgroundColor:n.errorColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M9.5 7L14.5 12"})]})})}function de(e){const t=e.colorfulBg,n=Object(m.h)(),o=se(n,3),i=Object(r.a)(o,2),s=i[0],a=i[1];return Object(v.jsx)(v.Fragment,{children:Object(v.jsxs)("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",className:ne,children:[Object(v.jsx)(oe,{style:a,stroke:t?n.primaryBackgroundColor:n.primaryLightColor,fill:t?n.primaryLightColor:n.primaryBackgroundColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"0",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(v.jsx)(ie,{strokeDashoffset:s[2].strokeDashoffset,stroke:t?n.primaryBackgroundColor:n.primaryLightColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(v.jsx)(ie,{strokeDashoffset:s[0].strokeDashoffset,stroke:t?n.primaryBackgroundColor:n.primaryLightColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M16.99 13H17"}),Object(v.jsx)(ie,{strokeDashoffset:s[1].strokeDashoffset,stroke:t?n.primaryBackgroundColor:n.primaryLightColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M12.99 13H13"})]})})}function ue(e){const t=e.colorfulBg,n=e.type,o=e.className;return Object(v.jsx)(re,{className:Object(p.c)(te,{[`type-${n}`]:!0,colorfulBg:t},o),children:"error"===n?Object(v.jsx)(le,{colorfulBg:t}):"warning"===n?Object(v.jsx)(ce,{colorfulBg:t}):"success"===n?Object(v.jsx)(ae,{colorfulBg:t}):Object(v.jsx)(de,{colorfulBg:t})})}var me=n(98);const fe="wpeform-component-actionfeedback",he=Object(p.d)(fe,"title"),pe=Object(p.d)(fe,"content"),be=Object(p.d)(fe,"footer"),ge=Object(p.d)(fe,"icon"),je=m.f.div.withConfig({displayName:"ActionFeedback__IconContainer",componentId:"sc-irmrcs-0"})(["font-size:",";margin:0 0 "," 0;will-change:opacity,transform;display:flex;"],(e=>Object(p.n)(1.25*e.theme.fz.large8)),(e=>Object(p.n)(2*e.theme.gutter))),ve=Object(m.f)(l.animated.h3).withConfig({displayName:"ActionFeedback__Title",componentId:"sc-irmrcs-1"})(["color:",";font-size:",";font-weight:bold;margin:0 0 "," 0;line-height:1.2;will-change:opacity,transform;"],(e=>e.theme.headingColor),(e=>Object(p.n)(e.theme.fz.large3)),(e=>Object(p.n)(e.theme.gutter))),ye=Object(m.f)(l.animated.article).withConfig({displayName:"ActionFeedback__Content",componentId:"sc-irmrcs-2"})(["",";will-change:opacity,transform;"],p.p),Oe=Object(m.f)(l.animated.footer).withConfig({displayName:"ActionFeedback__Footer",componentId:"sc-irmrcs-3"})(["color:",";font-size:",";margin:"," 0 0 0;will-change:opacity,transform;"],(e=>e.theme.textColorSecondary),(e=>Object(p.n)(e.theme.fz.small1)),(e=>Object(p.n)(e.theme.gutter))),we=m.f.aside.withConfig({displayName:"ActionFeedback__Container",componentId:"sc-irmrcs-4"})(["",";margin:"," 0;padding:0 ",";&.","--size-tablet{","{font-size:",";}","{font-size:",";}}"],p.b,(e=>Object(p.n)(e.theme.gutter)),(e=>Object(p.n)(e.theme.gutter)),fe,je,(e=>Object(p.n)(1.5*e.theme.fz.large8)),ve,(e=>Object(p.n)(e.theme.fz.large4)));function Ce(e){const t=e.type,n=e.title,o=e.children,s=e.className,a=e.scrollOnMount,c=void 0===a||a,d=e.scrollOffset,u=void 0===d?-100:d,h=e.footer,b=Object(m.h)(),g=Object(l.useTrail)(h?3:2,(e=>({from:{opacity:0,transform:"translate(0px, 20px)"},opacity:1,transform:"translate(0px, 0px)",config:0===e?b.springConfigGeneral:b.springConfigSlow,delay:500}))),j=Object(r.a)(g,1)[0],y=Object(p.u)(Object(me.c)(),fe,{[`type-${t}`]:!0},s),O=Object(i.useRef)(!0),w=Object(i.useRef)(null);return Object(i.useLayoutEffect)((()=>{O.current&&(O.current=!1,c&&w.current&&Object(f.a)(w.current,{verticalOffset:u,cancelOnUserAction:!0,elementToScroll:Object(I.f)(w.current)[0]}))}),[c,u]),Object(v.jsxs)(we,{className:y,ref:w,children:[Object(v.jsx)(je,{className:ge,children:Object(v.jsx)(ue,{type:t,colorfulBg:!1})}),Object(v.jsx)(ve,{style:j[0],className:he,children:n}),Object(v.jsx)(ye,{style:j[1],className:pe,children:o}),h?Object(v.jsx)(Oe,{style:j[2],className:be,children:h}):null]})}var xe=n(366),_e=n(127),Se=n(34),ke=n(108),Fe=n(360),Te=(n(199),n(447)),Ee=n(218),Ie=n(216);function Pe(e){return e===F.k.BORDER_BOX?"border-box":e===F.k.CONTENT_BOX?"content-box":e===F.k.PADDING_BOX?"padding-box":"border-box"}const Me=m.f.div.withConfig({displayName:"Page__PageBgContainer",componentId:"sc-19bqagh-0"})(["",";background-image:",";background-size:",";background-position:",";background-repeat:",";background-origin:",";background-clip:",";background-attachment:",";"],p.b,(e=>{var t;return null!==(t=e.bg)&&void 0!==t&&t.backgroundImage?`url("${e.bg.backgroundImage}")`:"none"}),(e=>{var t,n;return null!==(t=null===(n=e.bg)||void 0===n?void 0:n.backgroundSize)&&void 0!==t?t:"auto"}),(e=>{var t,n;return null!==(t=null===(n=e.bg)||void 0===n?void 0:n.backgroundPosition)&&void 0!==t?t:"0% 0%"}),(e=>{var t,n;return(n=null===(t=e.bg)||void 0===t?void 0:t.backgroundRepeat)===F.l.REPEAT_BOTH?"repeat":n===F.l.REPEAT_NONE?"no-repeat":n===F.l.REPEAT_X?"repeat-x":n===F.l.REPEAT_Y?"repeat-y":"no-repeat"}),(e=>{var t;return Pe(null===(t=e.bg)||void 0===t?void 0:t.backgroundOrigin)}),(e=>{var t;return Pe(null===(t=e.bg)||void 0===t?void 0:t.backgroundClip)}),(e=>{var t,n;return(n=null===(t=e.bg)||void 0===t?void 0:t.backgroundAttachment)===F.j.FIXED?"fixed":n===F.j.LOCAL?"local":"scroll"}));function Le(){var e,t;const n=Object(ke.l)(),o=Object(Fe.i)(Fe.b),a=n.structures.find((e=>e.id===o)),c=Object(Fe.i)(Fe.d),l=Object(ke.j)(),d=Object(Fe.j)();let u;if(Object(i.useEffect)((()=>{var e,t;if(!c)return()=>{};if(null!==(e=n.styles)&&void 0!==e&&null!==(t=e.pagination)&&void 0!==t&&t.autoProgress){var o;let e=!0;const t=setTimeout((()=>{var t,o;if(e)if(l.canNext){const e=d.getState().elements,t=Object(Ie.f)(a,n.elements,e),o=Object(Ie.a)(e,t);Object(r.a)(o,1)[0]&&l.goNext()}else null!==(t=n.styles)&&void 0!==t&&null!==(o=t.pagination)&&void 0!==o&&o.autoSubmit&&l.canSubmit&&l.submit()}),null!==(o=n.styles.pagination.autoProgressDelay)&&void 0!==o?o:100);return()=>{e=!1,clearTimeout(t)}}return()=>{}}),[c,n,d,l,a]),a){const e=a.children;u=Object(v.jsx)(Ee.a,{elements:e,emptyMessage:Object(s.__)("This page is empty.","wp-eform")})}else u=Object(v.jsx)(Te.a,{icon:Object(v.jsx)(b.b,{iconClass:"fas fa-envelope-open"}),children:Object(s.__)("This page does not exist. Kindly navigate away from it.","wp-eform")});return Object(v.jsx)(Me,{bg:null!==(e=n.styles)&&void 0!==e&&null!==(t=e.customBackground)&&void 0!==t&&t.enabled?n.styles.customBackground:void 0,className:"wpeform-form-page",children:u})}n(286);var Be=n(33);const Ae={message:Object(s.__)("Some error has occured.","wp-eform"),dynamicAnchors:null,mentions:null,id:"unknown"};function Ne(e){var t;const n=e.limitationMessage,o=Object(i.useMemo)((()=>[]),[]),r=Object(Se.n)(n.mentions),a=Object(Se.m)(n.dynamicAnchors),c=Object(Se.l)(n.message);return Object(v.jsx)(Se.f,{mode:"multiline",nodes:c||Object(Be.a)(Object(s.sprintf)(Object(s.__)("There has been some error related to %s.","wp-eform"),null!==(t=n.id)&&void 0!==t?t:"unknown")),excludeMentionsCharacters:o,additionalMentions:r,additionalDynamicAnchorTags:a})}function Re(e){const t=e.messageJson,n=Object(i.useMemo)((()=>{try{const e=JSON.parse(null!=t?t:"");return"object"==typeof e&&void 0!==e.dynamicAnchors&&void 0!==e.mentions&&void 0!==e.message?e:Ae}catch(e){return Ae}}),[t]),o=function(){const e=Object(ke.l)().elements;return Object(i.useCallback)((t=>{var n;return e[t]?Object(v.jsx)("strong",{children:Object(v.jsx)(Se.d,{currentElementId:null,nodes:Object(Be.c)(null===(n=e[t].appearance)||void 0===n?void 0:n.title),mode:"singleline"})}):null}),[e])}();return Object(v.jsx)(Se.c,{mentions:o,children:Object(v.jsx)(Ne,{limitationMessage:n})})}var De=n(367),$e=n.n(De),ze=n(175);function He(e){const t=e.time,n=e.onDone,o=Object(ze.d)(t,n),i=Object(T.c)(1e3*o,"number"),r=i.hours,a=i.minutes,c=i.seconds;return Object(v.jsxs)("span",{className:"wpeform-component-inlinecountdown",children:[r>0?Object(s.sprintf)(Object(s._n)("%d hour, ","%d hours, ",r,"wp-eform"),r):null,r>0||a>0?Object(s.sprintf)(Object(s._n)("%d minute, ","%d minutes, ",a,"wp-eform"),a):null,Object(s.sprintf)(Object(s._n)("%d second","%d seconds",c,"wp-eform"),c)]})}var qe=n(437),Ve=(n(120),n(1077),n(368));function We(e,t,n){if(!t)return"";const o=t.reduce(((e,t)=>(e[t.scoreId]=t,e)),{}),i="percentage"===n?e.scorePercentageLogic:e.scoreTotalLogic;let r="";return i.forEach((e=>{if(!e.scoreId||!o[e.scoreId]||!o[e.scoreId].has)return;const t=o[e.scoreId],i="percentage"===n?t.obtained/t.outof*100:t.obtained;i<=e.to&&i>=e.from&&(r=e.url)})),r}function Ue(e){const t=e.config,n=e.submissionLink,o=e.scoreData;let r=t.url;const a=Object(Fe.i)(Fe.c),c=Object(ke.l)();t.type===F.v.FLAT?r=t.url:t.type===F.v.PORTAL?r=WPEFormGraphQLApp.userPortal:t.type===F.v.SUBMISSION?r=null!=n?n:t.url:t.type===F.v.CONDITIONAL?r=function(e,t,n){let o="";return e.forEach((e=>{Object(Ve.b)(e.events,t,n)&&(o=e.url)})),o}(t.conditionalLogic,a,c.elements):t.type===F.v.SCOREPERCENTAGE?r=We(t,o,"percentage"):t.type===F.v.SCORETOTAL&&(r=We(t,o,"total")),""===r&&(r=t.url);const l=$e()(r),d=Object(i.useCallback)((()=>{t.iframeRedirect&&window.top&&window.top!==window.self?window.top.location.href=r:window.location.href=r}),[t.iframeRedirect,r]);Object(qe.c)(d,t.delay,!l);const u=Object(i.useMemo)((()=>({"%REDIRECT_LINK%":r})),[r]);return l?Object(v.jsx)(Se.d,{mode:"multiline",nodes:Object(Se.g)(t.message),currentElementId:null,additionalMentions:{"::redirectDelay::":Object(v.jsx)(He,{time:t.delay})},additionalAnchors:u}):Object(v.jsx)("p",{children:Object(s.sprintf)(Object(s.__)("ERROR: The URL %s is invalid and cannot redirect. Please contact the site administrator for help.","wp-eform"),r)})}function Ke(e){const t=e.reset,n=e.delay,o=e.message;return Object(qe.c)(t,n),Object(v.jsx)(Se.d,{mode:"singleline",nodes:Object(Se.g)(o),currentElementId:null,additionalMentions:{"::kioskResetTime::":Object(v.jsx)(He,{time:n})}})}const Ye="wpeform-component-timer",Ge=Object(m.f)(l.animated.div).withConfig({displayName:"Timer__TimerProgressContainer",componentId:"sc-1d2zn5q-0"})(["position:absolute;left:0;right:0;top:0;height:",";will-change:background-color;"],(e=>Object(p.n)(e.theme.controlHeightBase/8))),Xe=Object(m.f)(l.animated.div).withConfig({displayName:"Timer__TimerProgressAnimator",componentId:"sc-1d2zn5q-1"})(["will-change:width;position:absolute;right:0;top:0;height:",";background-color:",";max-width:100%;"],(e=>Object(p.n)(e.theme.controlHeightBase/8)),(e=>Object(j.b)(.1,e.theme.backgroundShade))),Qe=m.f.div.withConfig({displayName:"Timer__TimerIconContainer",componentId:"sc-1d2zn5q-2"})(["flex:0 0 ",";margin:0 "," 0 0;height:",";width:",";font-size:",";line-height:1;display:flex;align-items:center;justify-content:center;color:",";"],(e=>Object(p.n)(.8*e.theme.controlHeightBase)),(e=>Object(p.n)(e.theme.gutter/2)),(e=>Object(p.n)(.8*e.theme.controlHeightBase)),(e=>Object(p.n)(.8*e.theme.controlHeightBase)),(e=>Object(p.n)(.8*e.theme.controlHeightBase)),(e=>Object(j.b)(.1,e.theme.backgroundShade)));function Ze(){return Object(v.jsx)(Qe,{children:Object(v.jsx)(b.b,{iconClass:"fas fa-clock"})})}const Je=m.f.div.withConfig({displayName:"Timer__TimerMainContainer",componentId:"sc-1d2zn5q-3"})(["width:calc( 100% - "," );flex:0 0 calc(100% - ",");"],(e=>Object(p.n)(.8*e.theme.controlHeightBase)),(e=>Object(p.n)(.8*e.theme.controlHeightBase))),et=m.f.div.withConfig({displayName:"Timer__TimerClockContainer",componentId:"sc-1d2zn5q-4"})(["display:flex;flex-flow:row nowrap;align-items:center;"]),tt=m.f.div.withConfig({displayName:"Timer__TimeContainer",componentId:"sc-1d2zn5q-5"})(["font-size:",";font-weight:bold;line-height:1.2;color:",";font-variant-numeric:tabular-nums;small{font-size:",";font-weight:normal;}"],(e=>Object(p.n)(e.theme.fz.large2)),(e=>e.theme.headingColor),(e=>Object(p.n)(e.theme.fz.small2))),nt=m.f.div.withConfig({displayName:"Timer__TickContainer",componentId:"sc-1d2zn5q-6"})(["font-size:",";margin:0 ",";line-height:1.2;"],(e=>Object(p.n)(e.theme.fz.large1)),(e=>Object(p.n)(e.theme.gutter/5))),ot=m.f.div.withConfig({displayName:"Timer__TimerMessage",componentId:"sc-1d2zn5q-7"})(["font-size:",";color:",";margin:0;padding:0;",";.","{",";}"],(e=>Object(p.n)(e.theme.fz.small2)),(e=>e.theme.textColorSecondary),p.s,Se.a,p.s),it=m.f.div.withConfig({displayName:"Timer__TimerWrapper",componentId:"sc-1d2zn5q-8"})(["display:flex;align-items:center;flex-flow:row nowrap;padding:",";padding-top:",";"],(e=>Object(p.n)(e.theme.gutter/2)),(e=>Object(p.n)(e.theme.gutter/2+e.theme.controlHeightBase/8))),rt=m.f.div.withConfig({displayName:"Timer__TimerContainer",componentId:"sc-1d2zn5q-9"})(["",";font-family:",";background-color:",";position:relative;&.","--hidden{display:none;}@media screen and (min-width:","){","{padding:",";padding-top:",";}","{flex-basis:",";margin-right:",";height:",";width:",";font-size:",";}","{width:calc( 100% - "," );flex-basis:calc( 100% - "," );}","{font-size:",";small{font-size:",";}}","{font-size:",";}","{font-size:",";}}"],p.b,(e=>e.theme.fontFamilyBody),(e=>e.theme.backgroundShade),Ye,(e=>Object(p.n)(e.theme.breakpoints.tablet)),it,(e=>Object(p.n)(e.theme.gutter)),(e=>Object(p.n)(e.theme.gutter+e.theme.controlHeightBase/8)),Qe,(e=>Object(p.n)(1.2*e.theme.controlHeightBase)),(e=>Object(p.n)(e.theme.gutter)),(e=>Object(p.n)(1.2*e.theme.controlHeightBase)),(e=>Object(p.n)(1.2*e.theme.controlHeightBase)),(e=>Object(p.n)(1.2*e.theme.controlHeightBase)),Je,(e=>Object(p.n)(1.2*e.theme.controlHeightBase)),(e=>Object(p.n)(1.2*e.theme.controlHeightBase)),tt,(e=>Object(p.n)(e.theme.fz.large3)),(e=>Object(p.n)(e.theme.fz.small1)),nt,(e=>Object(p.n)(e.theme.fz.large2)),ot,(e=>Object(p.n)(e.theme.fz.small1))),st=m.f.div.withConfig({displayName:"Timer__Placeholder",componentId:"sc-1d2zn5q-10"})(["height:",";@media screen and (min-width:","){height:",";}"],(e=>Object(p.n)(e.theme.gutter+e.theme.controlHeightBase/8+1.2*e.theme.fz.large2+1.2*e.theme.fz.small2+10)),(e=>Object(p.n)(e.theme.breakpoints.tablet)),(e=>Object(p.n)(2*e.theme.gutter+e.theme.controlHeightBase/8+1.2*e.theme.fz.large3+1.2*e.theme.fz.small1+10))),at=m.f.div.withConfig({displayName:"Timer__Portal",componentId:"sc-1d2zn5q-11"})(["position:fixed;bottom:0;left:0;width:100%;z-index:999995;"]);function ct(e){const t=e.time,n=e.onDone,o=e.message,r=e.showUI,a=e.width,c=void 0===a?"100%":a,d=e.containerLayout,u=void 0===d?F.A.FIXED:d,f=Object(ze.d)(t,n),h=Object(m.h)(),b=f/t*100,g=Object(l.useSpring)({from:{backgroundColor:h.successColor},to:{backgroundColor:b>60?h.successColor:b>20?h.warningColor:h.errorColor},config:h.springConfigSlow}),j=Object(l.useSpring)({from:{width:"0%"},to:{width:`${Object(p.n)(100-b,"%")}`},config:h.springConfigSlow}),y=Object(T.c)(1e3*f,"string"),O=y.hours,w=y.minutes,C=y.seconds,x=Object(p.c)(Ye,{hidden:!r}),_=Object(i.useMemo)((()=>Object(T.c)(1e3*t,"number")),[t]).hours;return Object(v.jsx)(rt,{className:x,children:Object(v.jsx)(me.a,{width:c,containerLayout:u,noHorizontalPadding:!0,noVerticalPadding:!0,children:Object(v.jsxs)(it,{children:[Object(v.jsx)(Ge,{style:g,children:Object(v.jsx)(Xe,{style:j})}),Object(v.jsx)(Ze,{}),Object(v.jsxs)(Je,{children:[Object(v.jsxs)(et,{children:[_>0?Object(v.jsxs)(v.Fragment,{children:[Object(v.jsxs)(tt,{children:[O,Object(v.jsx)("small",{children:Object(s._x)("h","hours short form","wp-eform")})]}),Object(v.jsx)(nt,{children:":"})]}):null,Object(v.jsxs)(tt,{children:[w,Object(v.jsx)("small",{children:Object(s._x)("m","minutes short form","wp-eform")})]}),Object(v.jsx)(nt,{children:":"}),Object(v.jsxs)(tt,{children:[C,Object(v.jsx)("small",{children:Object(s._x)("s","seconds short form","wp-eform")})]})]}),o?Object(v.jsx)(ot,{children:o}):null]})]})})})}ct.Placeholder=st,ct.Portal=at;var lt=n(281);function dt(e){const t=e.timerConfig,n=e.currentPageConfig,o=e.goNext,r=e.canSubmit,s=e.submit,a=e.submitting,c=e.width,l=e.containerLayout,d=Object(Se.l)(null==t?void 0:t.timerMessage),u=Object(i.useCallback)((()=>{0}),[r,o,s,t,a]);if(!t||!n)return null;if(t.submitTimer===F.G.NONE)return null;let m,f;if(t.submitTimer===F.G.OVERALL?(m=t.timeLimit,f="overall"):(m=n.config.timer,f=n.id),!m||m<0)return null;const h=t.showTimer&&!a&&Object(lt.a)("starter");return Object(v.jsxs)(v.Fragment,{children:[h?Object(v.jsx)(ct.Placeholder,{}):null,Object(v.jsx)(me.a.Portal,{children:Object(v.jsx)(ct.Portal,{children:Object(v.jsx)(ct,{showUI:h,time:m,message:d?Object(v.jsx)(Se.d,{nodes:d,currentElementId:null,mode:"singleline"}):void 0,onDone:u,width:c,containerLayout:l},f)})})]})}var ut=n(450),mt=n(449);const ft=m.f.div.withConfig({displayName:"Remarks__Container",componentId:"sc-123x1v6-0"})(["padding:",";border-radius:",";background-color:",";margin:0 0 "," 0;"],(e=>Object(p.n)(e.theme.gutter)),(e=>Object(p.n)(e.theme.borderRadiusBase)),(e=>e.theme.backgroundShade),(e=>Object(p.n)(e.theme.gutter)));function ht(){const e=Object(ze.c)(),t=Object(Fe.i)(Fe.e),n=Object(Fe.h)(),o=Object(i.useCallback)((e=>{n({type:"SET_REMARKS",payload:{remarks:e}})}),[n]);return Object(v.jsx)(ft,{children:Object(v.jsx)(ut.a,{title:Object(s.__)("Administrator Remarks","wp-eform"),subtitle:Object(s.__)("this will show up in submission summary.","wp-eform"),id:`${e}-remarks`,children:Object(v.jsx)(mt.a,{value:t,onChange:o})})})}function pt(e){var t,n,o,a,c,l,d,u,m,f,h,p,b,g,j,y,O,w,C,x,_,S,k,T,E,I,P,M,L,B,A,N,R,D,$,z,H,q,V,W,U,K,Y,G,X,Q,te,ne,oe,ie,re,se,ae,ce,le,de,ue,me,fe,he,pe,be,ge,je,ve,ye,Oe,we,Te,Ee,Pe,Me,Be,Ae,De,$e,ze,He,qe,Ve,We,Ye,Ge,Xe,Qe,Ze,Je,et,tt,nt,ot,it,rt,st,at,ct,lt,ut,mt,ft,pt,bt,gt,jt;const vt=e.activePage,yt=e.onActivePageChange,Ot=e.onSubmit,wt=e.submitting,Ct=e.submitted,xt=e.submittedState,_t=e.submissionError,St=e.onReset,kt=e.onErrorRetry,Ft=e.limitations,Tt=e.mutationData,Et=e.notices,It=e.initialData,Pt=Object(Fe.h)(),Mt=Object(Fe.j)(),Lt=Object(ke.m)(),Bt=Object(ke.l)(),At=Object(Fe.i)(Fe.b),Nt=Object(Fe.i)(Fe.g),Rt=Object(Fe.i)(Fe.f),Dt=Object(i.useState)(!1),$t=Object(r.a)(Dt,2),zt=$t[0],Ht=$t[1],qt=Object(i.useState)(null),Vt=Object(r.a)(qt,2),Wt=Vt[0],Ut=Vt[1],Kt=Object(ke.n)(),Yt=Object(ke.i)();Object(i.useEffect)((()=>{Ut(null),Ht(!1),Pt({type:"SET_ELEMENTS_AND_STARTTIME",payload:{structures:Object(Ie.e)(Bt),elements:Object(Ie.d)(Bt,Lt,!0,It),formData:Bt,formMeta:Lt,conditionalsMap:Yt,fullReset:"preview"===Kt||"listview"===Kt}})}),[Pt,Lt,Bt,Yt,It,Kt]);const Gt=Object(i.useMemo)((()=>Bt.structures.filter((e=>{if("preview"===Kt)return!0;const t=Nt[e.id];return!t||!t.conditionallyHidden})).map((e=>({id:e.id,title:e.config.title,subtitle:e.config.subtitle,icon:e.config.icon||void 0})))),[Bt.structures,Kt,Nt]);Object(i.useEffect)((()=>{!Gt.find((e=>e.id===At))&&Gt.length&&Pt({type:"SET_CURRENT_PAGE",payload:Gt[0].id})}),[Gt,At,Pt]);const Xt=("newsubmission"===Kt||"useredit"===Kt)&&(null===(t=Bt.settings)||void 0===t||null===(n=t.timer)||void 0===n?void 0:n.submitTimer)!==F.G.NONE,Qt=Object(i.useMemo)((()=>Bt.structures.find((e=>e.id===At))),[At,Bt.structures]),Zt=Gt.findIndex((e=>e.id===At)),Jt=0===Zt?null:Gt[Zt-1]?Gt[Zt-1].id:null,en=Gt[Zt+1]?Gt[Zt+1].id:At,tn=Object(i.useCallback)(((e,t=!1)=>{var n,o;const i=()=>{Pt({type:"SET_CURRENT_PAGE",payload:e}),yt&&yt(e)};if("preview"===Kt||(null===(n=Bt.styles)||void 0===n||null===(o=n.pagination)||void 0===o?void 0:o.paginationRestriction)===F.i.NONE)return void i();if(Xt&&e===en&&t)return i(),Ht(!1),void Ut(null);const s=Mt.getState().elements,a=Object(Ie.f)(Qt,Bt.elements,s),c=Object(Ie.a)(s,a),l=Object(r.a)(c,2),d=l[0],u=l[1];if(Gt.findIndex((t=>t.id===e))<Zt){var m,f,h,p;if(Xt)return;if(null!==(m=Bt.styles)&&void 0!==m&&null!==(f=m.pagination)&&void 0!==f&&f.blockPreviousNavigation)return;return(null===(h=Bt.styles)||void 0===h||null===(p=h.pagination)||void 0===p?void 0:p.paginationRestriction)!==F.i.ONLY_WHEN_ALL_VALID||d?(Ht(!1),Ut(null),Pt({type:"SET_CURRENT_PAGE",payload:e}),void(yt&&yt(e))):(Ht(!0),void Ut(u))}if(d)return Ht(!1),Ut(null),Pt({type:"SET_CURRENT_PAGE",payload:en}),void(yt&&yt(en));Ht(!0),Ut(u)}),[yt,Kt,Qt,Zt,Pt,Bt,Mt,Gt,en,Xt]);Object(i.useEffect)((()=>{vt&&vt!==At&&Pt({type:"SET_CURRENT_PAGE",payload:vt})}),[Pt,vt,At]);const nn=!(Xt||!Jt||null!==(o=Bt.styles)&&void 0!==o&&null!==(a=o.pagination)&&void 0!==a&&a.blockPreviousNavigation||wt),on=Object(i.useCallback)((()=>{Jt&&tn(Jt)}),[Jt,tn]),rn=en!==At&&!wt,sn=Object(i.useCallback)(((e=!1)=>{tn(en,e)}),[tn,en]),an=en===At&&!wt,cn=Object(i.useCallback)(((e=!1)=>{if(Xt&&e)return void Ot(Mt);const t=Mt.getState().elements,n=Object(Ie.f)(Qt,Bt.elements,t),o=Object(Ie.a)(t,n),i=Object(r.a)(o,2),s=i[0],a=i[1];if(!s)return Ht(!0),void Ut(a);Ot(Mt)}),[Qt,Bt,Mt,Ot,Xt]),ln=(!wt||wt&&Ct)&&!Xt,dn=Object(i.useCallback)((()=>{Pt({type:"SET_ELEMENTS_AND_STARTTIME",payload:{structures:Object(Ie.e)(Bt),elements:Object(Ie.d)(Bt,Lt,!0),formData:Bt,formMeta:Lt,conditionalsMap:Yt,fullReset:!0}}),Ut(null),Ht(!1);const e=Gt[0].id;Pt({type:"SET_CURRENT_PAGE",payload:e}),yt&&yt(e),St&&St()}),[Pt,Bt,Lt,yt,Gt,St,Yt]),un=Object(i.useCallback)((()=>{var e,t;window.confirm((null===(e=Bt.styles)||void 0===e||null===(t=e.pagination)||void 0===t?void 0:t.resetMessage)||Object(s.__)("This will reset the form. Action cannot be undone, are you sure?","wp-eform"))&&dn()}),[dn,Bt]),mn=Object(i.useMemo)((()=>({canNext:rn,canPrevious:nn,canSubmit:an,goNext:sn,goPrevious:on,submit:cn,canReset:ln,reset:un,submitting:wt,submitted:Ct,submittedState:xt})),[rn,nn,an,sn,on,cn,ln,un,wt,Ct,xt]),fn=null!==(c=Bt.styles)&&void 0!==c&&null!==(l=c.pagination)&&void 0!==l&&l.barlike?"flat":null!==(d=null===(u=Bt.styles)||void 0===u||null===(m=u.pagination)||void 0===m?void 0:m.style)&&void 0!==d?d:"flat",hn=null!==(f=null===(h=Bt.styles)||void 0===h||null===(p=h.pagination)||void 0===p?void 0:p.size)&&void 0!==f?f:F.o.DEFAULT,pn=null!==(b=null===(g=Bt.styles)||void 0===g||null===(j=g.pagination)||void 0===j?void 0:j.colored)&&void 0!==b&&b,bn=null===(y=Bt.styles)||void 0===y||null===(O=y.pagination)||void 0===O?void 0:O.rounded;let gn=Object(v.jsx)(ee.b,{style:fn,size:hn,colorful:pn,icon:null===(w=Bt.styles)||void 0===w||null===(C=w.pagination)||void 0===C?void 0:C.prevIcon,iconPosition:(null===(x=Bt.styles)||void 0===x||null===(_=x.pagination)||void 0===_?void 0:_.prevIconPosition)===F.a.BEFORE?"before":"after",onClick:on,rounded:bn,disabled:!nn,children:null===(S=Bt.styles)||void 0===S||null===(k=S.pagination)||void 0===k?void 0:k.prevLabel});const jn="newsubmission"===Kt||"preview"===Kt||"listview"===Kt?"new":"update",vn="new"===jn?null===(T=Bt.styles)||void 0===T||null===(E=T.pagination)||void 0===E?void 0:E.submitIconPosition:null===(I=Bt.styles)||void 0===I||null===(P=I.pagination)||void 0===P?void 0:P.updateIconPosition;let yn=Object(v.jsx)(ee.b,{style:fn,size:hn,colorful:pn,icon:"new"===jn?null===(M=Bt.styles)||void 0===M||null===(L=M.pagination)||void 0===L?void 0:L.submitIcon:null===(B=Bt.styles)||void 0===B||null===(A=B.pagination)||void 0===A?void 0:A.updateIcon,iconPosition:vn===F.a.BEFORE?"before":"after",onClick:()=>{cn()},rounded:bn,disabled:!an,loading:wt,loadingDone:Ct,loadedState:"success"===xt?"success":"error",children:"new"===jn?null===(N=Bt.styles)||void 0===N||null===(R=N.pagination)||void 0===R?void 0:R.submitLabel:null===(D=Bt.styles)||void 0===D||null===($=D.pagination)||void 0===$?void 0:$.updateLabel}),On=Object(v.jsx)(ee.b,{style:fn,size:hn,colorful:pn,icon:null===(z=Bt.styles)||void 0===z||null===(H=z.pagination)||void 0===H?void 0:H.nextIcon,iconPosition:(null===(q=Bt.styles)||void 0===q||null===(V=q.pagination)||void 0===V?void 0:V.nextIconPosition)===F.a.BEFORE?"before":"after",onClick:()=>{sn()},rounded:bn,disabled:!rn,children:null===(W=Bt.styles)||void 0===W||null===(U=W.pagination)||void 0===U?void 0:U.nextLabel}),wn=null!==(K=Bt.styles)&&void 0!==K&&null!==(Y=K.pagination)&&void 0!==Y&&Y.showResetButton?Object(v.jsx)(ee.b,{style:fn,size:hn,colorful:pn,icon:null===(G=Bt.styles)||void 0===G||null===(X=G.pagination)||void 0===X?void 0:X.resetIcon,iconPosition:(null===(Q=Bt.styles)||void 0===Q||null===(te=Q.pagination)||void 0===te?void 0:te.resetIconPosition)===F.a.BEFORE?"before":"after",onClick:un,rounded:bn,disabled:!ln,children:null===(ne=Bt.styles)||void 0===ne||null===(oe=ne.pagination)||void 0===oe?void 0:oe.resetLabel}):null;null!==(ie=Bt.styles)&&void 0!==ie&&null!==(re=ie.pagination)&&void 0!==re&&re.hideWhenNotRelevant&&(nn||(gn=null),rn?yn=null:On=null,ln||(wn=null)),1===Bt.structures.length&&(On=null,gn=null);let Cn=null;var xn,_n,Sn,kn;wt&&Ct&&"success"===xt&&"newsubmission"===Kt&&((null===(xn=Bt.styles)||void 0===xn||null===(_n=xn.redirection)||void 0===_n?void 0:_n.type)!==F.v.NONE?Cn=Object(v.jsx)(Ue,{config:Bt.styles.redirection,submissionLink:null==Tt?void 0:Tt.submissionLink,scoreData:null==Tt?void 0:Tt.scoreData}):!0===(null===(Sn=Bt.styles)||void 0===Sn||null===(kn=Sn.formBehavior)||void 0===kn?void 0:kn.kioskMode)&&(Cn=Object(v.jsx)(Ke,{reset:dn,delay:Bt.styles.formBehavior.kioskTime,message:Bt.styles.formBehavior.kioskMessage})));return Object(v.jsx)(v.Fragment,{children:wt&&Ct?Object(v.jsx)(Ce,{type:"success"===xt?"success":"error",title:"success"===xt?Object(v.jsx)(Se.d,{mode:"singleline",nodes:Object(Se.g)("useredit"===Kt?null===(se=Bt.styles)||void 0===se||null===(ae=se.formBehavior)||void 0===ae?void 0:ae.updateSubject:"adminedit"===Kt?Object(s.__)("The submission has been updated.","wp-eform"):null===(ce=Bt.styles)||void 0===ce||null===(le=ce.formBehavior)||void 0===le?void 0:le.subject),currentElementId:null}):Object(v.jsx)(Se.d,{mode:"singleline",nodes:Object(Se.g)(null!==(de=null===(ue=Bt.styles)||void 0===ue||null===(me=ue.formBehavior)||void 0===me?void 0:me.errorSubject)&&void 0!==de?de:Object(s.__)("Oops, we have encountered an error!","wp-eform")),currentElementId:null}),footer:Cn,children:"success"===xt?Object(v.jsx)(Se.d,{currentElementId:null,mode:"multiline",nodes:Object(Se.g)("useredit"===Kt?null===(fe=Bt.styles)||void 0===fe||null===(he=fe.formBehavior)||void 0===he?void 0:he.updateMessage:"adminedit"===Kt?Object(s.__)("We have also sent an email to the user about this update.","wp-eform"):null===(pe=Bt.styles)||void 0===pe||null===(be=pe.formBehavior)||void 0===be?void 0:be.message)}):Object(v.jsxs)(v.Fragment,{children:["submissionValidationLogic"===(null==_t||null===(ge=_t.graphQLErrors[0])||void 0===ge||null===(je=ge.extensions)||void 0===je?void 0:je.category)?Object(v.jsx)(Re,{messageJson:null!==(ve=null==_t||null===(ye=_t.graphQLErrors[0])||void 0===ye?void 0:ye.message)&&void 0!==ve?ve:""}):null==_t?void 0:_t.message,kt?Object(v.jsx)("p",{children:Object(v.jsx)(ee.b,{size:hn,style:fn,colorful:pn,icon:null!==(Oe=null===(we=Bt.styles)||void 0===we||null===(Te=we.formBehavior)||void 0===Te?void 0:Te.errorRetryButtonIcon)&&void 0!==Oe?Oe:"fas fa-sync-alt",iconPosition:(null===(Ee=Bt.styles)||void 0===Ee||null===(Pe=Ee.formBehavior)||void 0===Pe?void 0:Pe.errorRetryButtonIconPosition)===F.a.AFTER?"after":"before",onClick:kt,rounded:bn,children:null!==(Me=null===(Be=Bt.styles)||void 0===Be||null===(Ae=Be.formBehavior)||void 0===Ae?void 0:Ae.errorRetryButtonLabel)&&void 0!==Me?Me:Object(s.__)("RETRY","wp-eform")})}):null]})}):Object(v.jsx)(ke.d.Provider,{value:zt,children:Object(v.jsx)(ke.a.Provider,{value:Wt,children:Object(v.jsx)(ke.c.Provider,{value:mn,children:Ft&&Ft.length>0&&"newsubmission"===Kt?Ft.map((e=>Object(v.jsx)(_e.a.Bottom,{children:Object(v.jsx)(xe.a,{type:"error",icon:"fas fa-times",dismissable:!1,children:Object(v.jsx)(Ne,{limitationMessage:e})})},e.id))):Object(v.jsxs)(v.Fragment,{children:["adminedit"===Kt?Object(v.jsx)(ht,{}):null,Et&&Et.length&&"newsubmission"===Kt?Et.map((e=>Object(v.jsx)(_e.a.Bottom,{children:Object(v.jsx)(xe.a,{type:"regular",icon:"fas fa-exclamation",dismissable:!0,children:Object(v.jsx)(Ne,{limitationMessage:e})})},e.id))):null,Object(v.jsxs)("form",{method:"post",action:"",autoComplete:null!==(De=Bt.styles)&&void 0!==De&&null!==($e=De.formBehavior)&&void 0!==$e&&$e.disabledAutoComplete?"off":"on",onSubmit:e=>{e.preventDefault()},children:[Object(v.jsx)(Z,{showTabs:null===(ze=Bt.styles)||void 0===ze||null===(He=ze.pagination)||void 0===He?void 0:He.showTabs,currentTab:At,onTabChange:tn,showProgressBar:null===(qe=Bt.styles)||void 0===qe||null===(Ve=qe.pagination)||void 0===Ve?void 0:Ve.showProgressBar,showProgressLabel:null===(We=Bt.styles)||void 0===We||null===(Ye=We.pagination)||void 0===Ye?void 0:Ye.showProgressLabel,forceProgress:wt?100:void 0,progressBarPosition:null===(Ge=Bt.styles)||void 0===Ge||null===(Xe=Ge.pagination)||void 0===Xe?void 0:Xe.progressBarPosition,progressBarPrecision:null===(Qe=Bt.styles)||void 0===Qe||null===(Ze=Qe.pagination)||void 0===Ze?void 0:Ze.progressDecimalPoint,scrollOnTabChange:null===(Je=Bt.styles)||void 0===Je||null===(et=Je.pagination)||void 0===et?void 0:et.autoScroll,tabScrollOffset:void 0!==(null===(tt=Bt.styles)||void 0===tt||null===(nt=tt.pagination)||void 0===nt?void 0:nt.scrollOffset)?-1*Bt.styles.pagination.scrollOffset:-100,tabs:Gt,stopwatchStartTime:null!==(ot=Bt.settings)&&void 0!==ot&&null!==(it=ot.timer)&&void 0!==it&&it.recordSubmissionTime&&Bt.settings.timer.showStopwatch?Rt:void 0,footer:null!==(rt=Bt.styles)&&void 0!==rt&&null!==(st=rt.pagination)&&void 0!==st&&st.panelEnabled?Object(v.jsxs)(J.a,{align:null!==(at=null===(ct=Bt.styles)||void 0===ct||null===(lt=ct.pagination)||void 0===lt?void 0:lt.alignment)&&void 0!==at?at:F.n.RIGHT,type:null!==(ut=Bt.styles)&&void 0!==ut&&null!==(mt=ut.pagination)&&void 0!==mt&&mt.barlike?"navbar":"regular",colorful:pn,hasGutterOnregular:!0,children:[gn,yn,On,wn]}):null,children:Object(v.jsx)(Le,{})}),"newsubmission"===Kt||"useredit"===Kt?Object(v.jsx)(dt,{timerConfig:null===(ft=Bt.settings)||void 0===ft?void 0:ft.timer,currentPageConfig:Qt,goNext:sn,submit:cn,canSubmit:an,width:null===(pt=Bt.styles)||void 0===pt||null===(bt=pt.appearance)||void 0===bt?void 0:bt.maxWidth,containerLayout:null===(gt=Bt.styles)||void 0===gt||null===(jt=gt.appearance)||void 0===jt?void 0:jt.containerLayout,submitting:wt}):null]})]})})})})})}function bt(e){const t=e.children,n=e.mutationData,o=function(e){var t;const n=Object(Fe.i)(Fe.c),o=Object(ke.l)(),r=o.elements,s=null===(t=o.settings)||void 0===t?void 0:t.score,a=Object(i.useMemo)((()=>{var t;return e?{"::fName::":e.fName,"::lName::":e.lName,"::email::":e.email,"::phone::":e.phone,"::submissionId::":e.token,"::formName::":null!==(t=o.name)&&void 0!==t?t:""}:null}),[e,o.name]);return Object(i.useCallback)((t=>Object(Se.i)(t,n,r,a,s,null==e?void 0:e.scoreData)),[n,r,e,s,a])}(n),r=Object(i.useMemo)((()=>{const e={};return e["%FORM_LINK%"]=window.location.href,null!=n&&n.submissionLink&&(e["%SUBMISSION_LINK%"]=n.submissionLink),e}),[n]);return Object(v.jsx)(Se.c,{mentions:o,children:Object(v.jsx)(Se.b,{dynamicAnchors:r,children:t})})}var gt=n(1036);const jt=["formData","formMeta","mode","initialData","activePage","onActivePageChange","mutationData","formHeader"];function vt(e){const t=e.formData,n=e.formMeta,r=e.mode,s=e.initialData,a=e.activePage,c=e.onActivePageChange,l=e.mutationData,d=e.formHeader,u=void 0===d?null:d,m=Object(o.a)(e,jt),f=t.styles,h=Object(gt.c)(f),p=Object(i.useMemo)((()=>{const e={};return t.conditionals.forEach((t=>{t.events.forEach((n=>{e[n.fieldid]||(e[n.fieldid]=[]),e[n.fieldid].includes(t.id)||e[n.fieldid].push(t.id)}))})),e}),[t]);return Object(v.jsx)(Fe.a,{initialData:null!=s?s:{...Ie.c,currentPage:null!=a?a:t.structures&&t.structures.length?t.structures[0].id:"",startTime:Date.now()},children:Object(v.jsx)(ke.e.Provider,{value:t,children:Object(v.jsx)(ke.f.Provider,{value:n,children:Object(v.jsx)(ke.g.Provider,{value:r,children:Object(v.jsx)(ke.b.Provider,{value:p,children:Object(v.jsx)(bt,{mutationData:l,children:Object(v.jsxs)(gt.a,{themeStyle:h,mode:"preview"!==r?"live":"preview",children:[u,Object(v.jsx)(pt,{activePage:a,onActivePageChange:c,...m,mutationData:l,initialData:s})]})})})})})})})}},1088:function(e,t,n){"use strict";n.d(t,"a",(function(){return m}));var o=n(1189);const i=o.a`
	fragment FConfigStyleAppearance on FormStylesAppearanceType {
		containerLayout
		maxWidth
		controlType
		controlAlignment
		controlLayout
	}
`,r=o.a`
	fragment FConfigStylePagination on FormStylesPaginationType {
		# TABS and PROGRESS Bar
		showTabs
		showProgressBar
		progressDecimalPoint
		progressBarPosition
		showProgressLabel
		# SCROLL Behavior
		autoProgress
		autoProgressDelay
		autoScroll
		scrollOffset
		autoSubmit
		blockPreviousNavigation
		paginationRestriction
		# Buttons Panel
		panelEnabled
		alignment
		size
		style
		rounded
		colored
		barlike
		nextLabel
		nextIcon
		nextIconPosition
		prevLabel
		prevIcon
		prevIconPosition
		submitLabel
		submitIcon
		submitIconPosition
		updateLabel
		updateIcon
		updateIconPosition
		showResetButton
		resetLabel
		resetMessage
		resetIcon
		resetIconPosition
		hideWhenNotRelevant
	}
`,s=o.a`
	fragment FConfigStyleCustomBackground on FormStylesCustomBackgroundType {
		backgroundImage
		backgroundClip
		backgroundAttachment
		backgroundOrigin
		backgroundPosition
		backgroundRepeat
		backgroundSize
		enabled
	}
`,a=o.a`
	fragment FConfigStyleTheme on FormStylesThemeType {
		css
		customColorBg
		customColorPrimary
		customColorSecondary
		customColorText
		scheme
		darkMode
	}
`,c=o.a`
	fragment FConfigStyleTypography on FormStylesTypographyType {
		baseFont
		bodyFamily
		bodyFamilyCustom
		headFamily
		headFamilyCustom
		headFontBold
		headFontItalic
	}
`,l=o.a`
	fragment FConfigStyleFormBehavior on FormStylesFormBehaviorType {
		disabledAutoComplete
		subject
		message
		updateSubject
		updateMessage
		kioskMode
		kioskMessage
		kioskTime
		errorSubject
		errorRetryButtonLabel
		errorRetryButtonIcon
		errorRetryButtonIconPosition
	}
`,d=o.a`
	fragment FConfigStyleRedirection on FormStylesRedirectionType {
		type
		url
		delay
		message
		iframeRedirect
		scoreTotalLogic {
			id
			scoreId
			url
			from
			to
		}
		scorePercentageLogic {
			id
			scoreId
			url
			from
			to
		}
		conditionalLogic {
			id
			url
			events {
				fieldid
				has
				id
				operation
				operator
				relation
				value
			}
		}
	}
`,u=o.a`
	fragment FConfigStyleTracking on FormStylesTrackingType {
		urlTracking
		urlTrackId
	}
`,m=o.a`
	fragment FConfigStyles on FormStylesType {
		appearance {
			...FConfigStyleAppearance
		}
		pagination {
			...FConfigStylePagination
		}
		customBackground {
			...FConfigStyleCustomBackground
		}
		theme {
			...FConfigStyleTheme
		}
		typography {
			...FConfigStyleTypography
		}
		formBehavior {
			...FConfigStyleFormBehavior
		}
		redirection {
			...FConfigStyleRedirection
		}
		tracking {
			...FConfigStyleTracking
		}
	}
	${i}
	${r}
	${s}
	${a}
	${c}
	${l}
	${d}
	${u}
`},1094:function(e,t,n){"use strict";n.d(t,"b",(function(){return g})),n.d(t,"a",(function(){return j}));var o=n(1189),i=n(1080),r=n(1081),s=n(1082),a=n(1088),c=n(1083),l=n(1079),d=n(1063),u=n(1072),m=n(1073),f=n(1074),h=n(1075),p=n(1076),b=n(1084);const g=o.a`
	fragment FFormForSubmission on FormType {
		limitations {
			id
			message
			dynamicAnchors
			mentions
		}
		notices {
			id
			message
			dynamicAnchors
			mentions
		}
		elements {
			appearance {
				...FElementAppearance
			}
			children
			id
			type
			config {
				...FAllElementConfig
			}
			extras
		}
		conditionals {
			...FConfigConditionals
		}
		id
		name
		pools {
			id
			name
			children
		}
		settings {
			timer {
				...FConfigSettingsTImer
			}
			score {
				...FConfigSettingsScore
			}
		}
		structures {
			...FStructure
		}
		styles {
			...FConfigStyles
		}
	}
	# Conditionals fragments
	${i.a}
	# Settings Fragments
	${r.a}
	${s.a}
	# Style Fragments
	${a.a}
	# Elements Fragments
	${c.a}
	${l.a}
	# Element generic fragments
	${u.a}
	${m.a}
	${f.a}
	${h.a}
	${p.a}
	# Structure Fragments
	${b.a}
`,j=o.a`
	query FormForSubmission($id: ID!, $increaseViewCount: Boolean) {
		form(id: $id, increaseViewCount: $increaseViewCount) {
			...FFormForSubmission
		}
		# Query for available elements
		formMeta {
			elements {
				type
				defaultDataValue {
					...FAllElementSubmission
				}
			}
		}
	}
	# Form for submission fragment
	${g}
	# Submission Fragments
	${d.a}
`},1117:function(e,t,n){"use strict";n.d(t,"a",(function(){return s}));var o=n(7),i=n(2);const r=o.f.div.withConfig({displayName:"FormWrap",componentId:"sc-4pzp29-0"})(["max-width:",";.ant-form-item-label{font-weight:bold;> label{height:auto;margin:0 0 "," 0;}}.ant-form-item-label{label::after{display:none;}.ant-form-item-required::before{display:none !important;}.ant-form-item-required::after{display:inline-block;margin-right:4px;color:",";font-size:16px;font-family:SimSun,sans-serif;line-height:1;content:'*';}}.ant-input-prefix{color:",";}.ant-divider-inner-text{color:",";}.ant-row.ant-form-item{margin-bottom:",";}"],(e=>e.maxWidth?Object(i.n)(e.maxWidth):"none"),(e=>Object(i.n)(e.theme.gutter/4)),(e=>e.theme.errorColor),(e=>e.theme.borderColorBase),(e=>e.theme.textColorSecondary),(e=>Object(i.n)(e.theme.gutter)));t.b=r;const s=o.f.h3.withConfig({displayName:"FormWrap__FormTitle",componentId:"sc-4pzp29-1"})(["color:",";text-transform:uppercase;margin:0 0 "," 0;font-weight:bold;font-size:",";border-bottom:2px solid ",";padding:0 0 "," 0;"],(e=>e.theme.textColorSecondary),(e=>Object(i.n)(e.theme.gutter)),(e=>Object(i.n)(e.theme.fz.small1)),(e=>e.theme.borderColorBase),(e=>Object(i.n)(e.theme.gutter/2)))},1120:function(e,t,n){"use strict";var o=n(9),i=n(0),r={icon:{tag:"svg",attrs:{viewBox:"64 64 896 896",focusable:"false"},children:[{tag:"path",attrs:{d:"M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448 448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372 372 166.6 372 372-166.6 372-372 372z"}},{tag:"path",attrs:{d:"M623.6 316.7C593.6 290.4 554 276 512 276s-81.6 14.5-111.6 40.7C369.2 344 352 380.7 352 420v7.6c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V420c0-44.1 43.1-80 96-80s96 35.9 96 80c0 31.1-22 59.6-56.1 72.7-21.2 8.1-39.2 22.3-52.1 40.9-13.1 19-19.9 41.8-19.9 64.9V620c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8v-22.7a48.3 48.3 0 0130.9-44.8c59-22.7 97.1-74.7 97.1-132.5.1-39.3-17.1-76-48.3-103.3zM472 732a40 40 0 1080 0 40 40 0 10-80 0z"}}]},name:"question-circle",theme:"outlined"},s=n(41),a=function(e,t){return i.createElement(s.a,Object(o.a)(Object(o.a)({},e),{},{ref:t,icon:r}))};a.displayName="QuestionCircleOutlined";t.a=i.forwardRef(a)},1125:function(e,t,n){"use strict";n.d(t,"b",(function(){return i})),n.d(t,"c",(function(){return r})),n.d(t,"a",(function(){return s}));var o=n(1189);const i=o.a`
	mutation NewForm(
		$name: String!
		$integrations: FormIntegrationsInput
		$payments: FormPaymentsInput
		$permissions: FormPermissionsInput
		$settings: FormSettingsInput
		$styles: FormStylesInput
		$structures: [FormStructureInput!]!
		$elements: [FormElementInput!]!
		$pools: [FormPoolInput!]!
		$conditionals: [ConditionalInput!]!
		$categories: [ID!]!
		$editors: [ID!]!
	) {
		createForm(
			data: {
				name: $name
				integrations: $integrations
				payments: $payments
				permissions: $permissions
				settings: $settings
				styles: $styles
				structures: $structures
				elements: $elements
				pools: $pools
				conditionals: $conditionals
				categories: $categories
				editors: $editors
			}
		) {
			id
		}
	}
`,r=o.a`
	mutation UpdateForm($id: ID!, $data: FormInput!) {
		updateForm(id: $id, data: $data) {
			id
		}
	}
`,s=o.a`
	mutation ImportForm($data: String!) {
		importForm(data: $data)
	}
`},1127:function(e,t,n){"use strict";n.d(t,"a",(function(){return c}));var o=n(0),i=n(30),r=n(1188),s=n(13);const a=e=>{var t=e.name,n=e.showValidateSuccess,a=e.showInitialErrorAfterTouched,c=void 0!==a&&a,l=e.children,d=e.validate,u=Object(s.e)(e,["name","showValidateSuccess","showInitialErrorAfterTouched","children","validate"]);return o.createElement(i.b,{name:t,validate:d},(({form:{errors:e={},touched:s={},initialErrors:a={}}})=>{const d=Object(i.e)(e,t,void 0),m=Object(i.e)(a,t,void 0);let f=Object(i.e)(s,t,!1);Array.isArray(f)&&(f=0===f.length||f.reduce(((e,t)=>e||t),!1));const h=void 0!==d&&f,p=void 0!==m,b=!d&&f,g=h||p&&(!f||c);return o.createElement(r.a.Item,Object.assign({htmlFor:t,id:t,validateStatus:h||p&&!f?"error":b&&n?"success":void 0,hasFeedback:b,help:g?o.createElement(o.Fragment,null,h&&o.createElement("li",null,d),p&&(!f||c)&&o.createElement("li",null,m)):null},u),l)}))};function c(e){return o.createElement(i.b,null,(({form:{handleReset:t,handleSubmit:n}})=>o.createElement(r.a,Object.assign({onReset:t,onFinish:n},e))))}c.Item=a},1165:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return ae}));var o=n(115),i=n(4),r=n(5),s=n(10),a=n.n(s),c=n(0),l=n(146),d=function(e,t){var n={};for(var o in e)Object.prototype.hasOwnProperty.call(e,o)&&t.indexOf(o)<0&&(n[o]=e[o]);if(null!=e&&"function"==typeof Object.getOwnPropertySymbols){var i=0;for(o=Object.getOwnPropertySymbols(e);i<o.length;i++)t.indexOf(o[i])<0&&Object.prototype.propertyIsEnumerable.call(e,o[i])&&(n[o[i]]=e[o[i]])}return n},u=function(e){var t,n=c.useContext(l.b),o=n.getPrefixCls,s=n.direction,u=e.prefixCls,m=e.type,f=void 0===m?"horizontal":m,h=e.orientation,p=void 0===h?"center":h,b=e.orientationMargin,g=e.className,j=e.children,v=e.dashed,y=e.plain,O=d(e,["prefixCls","type","orientation","orientationMargin","className","children","dashed","plain"]),w=o("divider",u),C=p.length>0?"-".concat(p):p,x=!!j,_="left"===p&&null!=b,S="right"===p&&null!=b,k=a()(w,"".concat(w,"-").concat(f),(t={},Object(r.a)(t,"".concat(w,"-with-text"),x),Object(r.a)(t,"".concat(w,"-with-text").concat(C),x),Object(r.a)(t,"".concat(w,"-dashed"),!!v),Object(r.a)(t,"".concat(w,"-plain"),!!y),Object(r.a)(t,"".concat(w,"-rtl"),"rtl"===s),Object(r.a)(t,"".concat(w,"-no-default-orientation-margin-left"),_),Object(r.a)(t,"".concat(w,"-no-default-orientation-margin-right"),S),t),g),F=Object(i.a)(Object(i.a)({},_&&{marginLeft:b}),S&&{marginRight:b});return c.createElement("div",Object(i.a)({className:k},O,{role:"separator"}),j&&"vertical"!==f&&c.createElement("span",{className:"".concat(w,"-inner-text"),style:F},j))},m=n(15),f=n(3),h=n(7),p=n(1117),b=n(1044),g=n(440),j=n(2),v=n(114),y=n(52),O=n(9),w={icon:{tag:"svg",attrs:{viewBox:"64 64 896 896",focusable:"false"},children:[{tag:"path",attrs:{d:"M938 458.8l-29.6-312.6c-1.5-16.2-14.4-29-30.6-30.6L565.2 86h-.4c-3.2 0-5.7 1-7.6 2.9L88.9 557.2a9.96 9.96 0 000 14.1l363.8 363.8c1.9 1.9 4.4 2.9 7.1 2.9s5.2-1 7.1-2.9l468.3-468.3c2-2.1 3-5 2.8-8zM459.7 834.7L189.3 564.3 589 164.6 836 188l23.4 247-399.7 399.7zM680 256c-48.5 0-88 39.5-88 88s39.5 88 88 88 88-39.5 88-88-39.5-88-88-88zm0 120c-17.7 0-32-14.3-32-32s14.3-32 32-32 32 14.3 32 32-14.3 32-32 32z"}}]},name:"tag",theme:"outlined"},C=n(41),x=function(e,t){return c.createElement(C.a,Object(O.a)(Object(O.a)({},e),{},{ref:t,icon:w}))};x.displayName="TagOutlined";var _=c.forwardRef(x),S=n(284),k=n(83),F=n(1127),T=n(1032),E=n(30),I=n(72),P=n(1173),M=n(1125),L=(n(8),n(1042)),B=n(1);const A={formName:""};function N(e){const t=e.mutating,n=e.setMutating,o=Object(k.k)(),i=Object(P.a)(M.b),r=Object(m.a)(i,1)[0];return Object(B.jsx)(E.d,{onSubmit:e=>{n(!0);const t="wpeform-fresh-form";return S.b.loading({key:t,content:Object(f.__)("Creating an empty form, please wait...","wp-eform"),duration:0}),r({variables:{name:e.formName,structures:[],elements:[],pools:[],conditionals:[],categories:[],editors:[]}}).then((({data:e,errors:t})=>{t?t.forEach((e=>{S.b.error(e.message)})):(S.b.success(Object(f.__)("Successfully created the form, redirecting.","wp-eform")),Object(L.a)(),o.push(`/forms/edit/${e.createForm.id}`))})).catch((e=>{var t;S.b.error(null!==(t=e.message)&&void 0!==t?t:Object(f.__)("Something went wrong and we could not create the form.","wp-eform"))})).finally((()=>{S.b.destroy(t),n(!1)}))},initialValues:A,validationSchema:I.c().shape({formName:I.d().min(3,Object(f.__)("minimum of 3 characters in length.","wp-eform")).required(Object(f.__)("You must enter a form name.","wp-eform"))}),children:({submitForm:e,submitCount:n,isValid:o,isSubmitting:i})=>Object(B.jsxs)(F.a,{children:[Object(B.jsx)(F.a.Item,{required:!0,name:"formName",showValidateSuccess:!0,label:Object(f.__)("Form Name","wp-eform"),children:Object(B.jsx)(T.a,{placeholder:Object(f.__)("enter form name here","wp-eform"),prefix:Object(B.jsx)(_,{}),name:"formName"})}),Object(B.jsx)(y.a,{block:!0,type:"primary",onClick:t=>{t.preventDefault(),e()},disabled:n>0&&!o||t,loading:i,children:Object(f.__)("START FRESH","wp-eform")})]})})}var R=n(435),D=n(1189),$=n(1129),z=n(1094),H=n(1063),q=n(282),V=n(441),W=n(281),U=n(1087),K=n(216);const Y=D.a`
	mutation CreateFormFromTemplate($id: ID!) {
		createFormFromTemplate(templateId: $id)
	}
`,G=D.a`
	query NewFormWithFormTemplates {
		formTemplates {
			categoryId
			categoryName
			templates {
				templateId
				name
				plan
			}
		}
	}
`,X=D.a`
	query NewFormFromTemplatePreview($id: ID!) {
		previewFormTemplate(templateId: $id) {
			...FFormForSubmission
		}
		# Query for available elements
		formMeta {
			elements {
				type
				defaultDataValue {
					...FAllElementSubmission
				}
			}
		}
	}
	# Form for submission fragment
	${z.b}
	# Submission Fragments
	${H.a}
`,Q={formCategory:void 0,formTemplate:void 0};function Z(e){const t=e.mutating,n=e.setMutating,o=e.setTemplateId,i=Object($.b)(G),r=i.loading,s=i.data,a=i.error,c=i.refetch,l=Object(k.k)(),d=Object(P.a)(Y),u=Object(m.a)(d,1)[0];return Object(B.jsx)(E.d,{onSubmit:e=>{if(!e.formTemplate)return void S.b.error(Object(f.__)("Please select a template.","wp-eform"));n(!0);const t=`wpeform-template-form-${e.formTemplate}`;return S.b.loading({content:Object(f.__)("Creating form from template, please wait...","wp-eform"),key:t,duration:0}),u({variables:{id:e.formTemplate}}).then((({data:e,errors:t})=>{t?t.forEach((e=>{S.b.error(e.message)})):(S.b.success(Object(f.__)("Successfully created the form, redirecting.","wp-eform")),Object(L.a)(),l.push(`/forms/edit/${e.createFormFromTemplate}`))})).catch((e=>{var t;S.b.error(null!==(t=e.message)&&void 0!==t?t:Object(f.__)("Something went wrong and we could not create the form.","wp-eform"))})).finally((()=>{S.b.destroy(t),n(!1)}))},initialValues:Q,validationSchema:I.c().shape({formCategory:I.d().required(Object(f.__)("You must select a category.","wp-eform")),formTemplate:I.d().required(Object(f.__)("You must select a template.","wp-eform"))}),children:({values:e,setFieldValue:n,submitForm:i,submitCount:l,isValid:d,isSubmitting:u,setFieldTouched:m})=>{var h,p;return Object(B.jsxs)(F.a,{children:[a?Object(B.jsx)(q.a,{type:"client",description:null!==(h=null==a?void 0:a.message)&&void 0!==h?h:Object(f.__)("Error fetching data.","wp-eform"),to:()=>{c()},buttonLabel:Object(f.__)("RETRY FETCH","wp-eform"),showRefresh:!0}):Object(B.jsxs)(B.Fragment,{children:[Object(B.jsx)(F.a.Item,{name:"formCategory",label:Object(f.__)("Form Template Category","wp-eform"),children:Object(B.jsx)(R.a,{name:"formCategory",placeholder:Object(f.__)("select category","wp-eform"),onBlur:()=>{n("formTemplate",void 0),m("formTemplate",!1),o("")},loading:r,children:null==s?void 0:s.formTemplates.map((({categoryId:e,categoryName:t})=>Object(B.jsx)(R.a.Option,{value:e,children:t},e)))})}),Object(B.jsx)(F.a.Item,{name:"formTemplate",label:Object(f.__)("Form Template","wp-eform"),children:Object(B.jsx)(R.a,{name:"formTemplate",placeholder:void 0!==e.formCategory?Object(f.__)("select template","wp-eform"):Object(f.__)("select category first","wp-eform"),onChange:e=>{o(e)},disabled:void 0===e.formCategory||r,loading:r,children:void 0!==e.formCategory?null==s||null===(p=s.formTemplates.find((t=>t.categoryId===e.formCategory)))||void 0===p?void 0:p.templates.map((({name:e,plan:t,templateId:n})=>Object(B.jsxs)(R.a.Option,{value:n,disabled:"free"!==t&&!Object(W.a)(t),children:["[",t,"] ",e]},n))):null})})]}),Object(B.jsx)(y.a,{block:!0,type:"primary",onClick:e=>{e.preventDefault(),i()},disabled:!e.formCategory||!e.formTemplate||l>0&&!d||t,loading:u,children:Object(f.__)("START WITH TEMPLATE","wp-eform")})]})}})}function J(e){const t=e.data,n=t.formMeta,o=t.previewFormTemplate,i=Object(c.useMemo)((()=>Object(K.b)({form:o,formMeta:n})),[n,o]);return Object(B.jsx)(U.a,{formData:i,formMeta:n,mode:"preview",onSubmit:()=>{S.b.error(Object(f.__)("Cannot submit form in preview mode.","wp-eform"))},submitting:!1,submitted:!1,submittedState:"success"})}Z.Preview=function(e){var t;const n=e.templateId,o=Object($.b)(X,{variables:{id:n},fetchPolicy:"no-cache"}),i=o.loading,r=o.data,s=o.error,a=o.refetch;return console.log(r),i?Object(B.jsx)(V.a,{}):s||!r?Object(B.jsx)(q.a,{type:"client",description:null!==(t=null==s?void 0:s.message)&&void 0!==t?t:Object(f.__)("Error fetching data.","wp-eform"),to:()=>{a()},buttonLabel:Object(f.__)("RETRY FETCH","wp-eform"),showRefresh:!0}):r.previewFormTemplate?Object(B.jsx)(J,{data:r}):Object(B.jsx)("p",{children:"Something went wrong and could not render the form."})};var ee=n(1104);const te=h.f.div.withConfig({displayName:"TextFileReader__Wrapper",componentId:"sc-1ignu3e-0"})(["border:1px solid ",";padding:",";border-radius:",";line-height:1;background-color:",";label{line-height:1;display:block;cursor:pointer;color:",";transition:color ",";font-size:",";span.eform-admin-textfilereader__highlight{transition:color ",";color:",";}&:hover{color:",";span.eform-admin-textfilereader__highlight{color:",";}}}"],(e=>e.theme.borderColorBase),(e=>Object(j.n)(e.theme.gutter/2)),(e=>Object(j.n)(e.theme.borderRadiusBase)),(e=>e.theme.backgroundHover),(e=>e.theme.textColorSecondary),(e=>e.theme.transition),(e=>Object(j.n)(e.theme.fz.small1)),(e=>e.theme.transition),(e=>e.theme.primaryColor),(e=>e.theme.primaryDarkColor),(e=>e.theme.primaryDarkColor)),ne=h.f.div.withConfig({displayName:"TextFileReader__ReaderWithTextArea",componentId:"sc-1ignu3e-1"})(["display:flex;flex-flow:row wrap;.ant-input{border-bottom-left-radius:0;border-bottom-right-radius:0;margin:0;width:100%;flex:0 0 100%;resize:none;font-family:Menlo,'Courier New',Courier,monospace;font-size:",";height:177px;}","{border-top:0 none;width:100%;flex:0 0 100%;border-top-left-radius:0;border-top-right-radius:0;}"],(e=>Object(j.n)(e.theme.fz.small1)),te);function oe(e){const t=Object(c.useState)(!1),n=Object(m.a)(t,2),o=n[0],i=n[1],r=Object(c.useState)(""),s=Object(m.a)(r,2),a=s[0],l=s[1],d=e.label,u=e.reuploadLabel,h=void 0===u?Object(f.__)("click to reupload.","wp-eform"):u;return FileReader&&File&&FileList&&window.Blob?Object(B.jsxs)(te,{className:"eform-admin-textfilereader",children:[Object(B.jsx)("input",{disabled:o,type:"file",name:e.name,id:e.name,accept:"text/plain, text/json, application/json",onChange:t=>{const n=t.target.files;if(n){i(!0);const t=new FileReader,o=n[0];t.onload=()=>{e.onChange(t.result),i(!1),l(o.name)},t.readAsText(o)}},value:"",style:{display:"none"}}),Object(B.jsx)("label",{htmlFor:e.name,children:""!==a?Object(B.jsxs)(B.Fragment,{children:[a," |"," ",Object(B.jsx)("span",{className:"eform-admin-textfilereader__highlight",children:h})]}):o?Object(f.__)("please wait...","wp-eform"):Object(B.jsxs)(B.Fragment,{children:[d," ",Object(B.jsxs)("span",{className:"eform-admin-textfilereader__highlight",children:[Object(f.__)("click here","wp-eform"),"."]})]})})]}):Object(B.jsx)(te,{className:"eform-admin-textfilereader",children:Object(f.__)("upload is not supported in this browser.","wp-eform")})}const ie={formCode:""};function re(e){const t=e.mutating,n=e.setMutating,o=Object(ee.a)(),i=Object(k.k)();return Object(B.jsx)(E.d,{onSubmit:e=>{n(!0);const t="wpeform-import-form";return S.b.loading({key:t,content:Object(f.__)("Importing the form, please wait...","wp-eform"),duration:0}),o.mutate({mutation:M.a,fetchPolicy:"no-cache",variables:{data:e.formCode}}).then((e=>{const t=e.data,n=e.errors;t&&!n?(S.b.success(Object(f.__)("Successfully imported the form, redirecting.","wp-eform")),Object(L.a)(),i.push(`/forms/edit/${t.importForm}`)):null!=n&&n.length?n.forEach((e=>{S.b.error(e.message)})):S.b.error(Object(f.__)("Could not import from the code.","wp-eform"))})).catch((e=>{var t;S.b.error(null!==(t=e.message)&&void 0!==t?t:Object(f.__)("Could not import from the code.","wp-eform"))})).finally((()=>{S.b.destroy(t),n(!1)}))},initialValues:ie,validationSchema:I.c().shape({formCode:I.d().required(Object(f.__)("You must upload the form import code.","wp-eform"))}),children:({values:e,setFieldValue:n,submitForm:o,submitCount:i,isValid:r,isSubmitting:s})=>Object(B.jsxs)(F.a,{children:[Object(B.jsx)(F.a.Item,{name:"formCode",label:Object(f.__)("Import Form","wp-eform"),children:Object(B.jsxs)(ne,{children:[Object(B.jsx)(T.a.TextArea,{name:"formCode",rows:4,placeholder:Object(f.__)("paste form export code here...","wp-eform")}),Object(B.jsx)(oe,{label:Object(f.__)("or to upload file","wp-eform"),name:"formFile",onChange:e=>{n("formCode",e)}})]})}),Object(B.jsx)(y.a,{block:!0,type:"primary",onClick:o,disabled:!e.formCode||i>0&&!r||t,loading:s,children:Object(f.__)("IMPORT FROM CODE","wp-eform")})]})})}const se=h.f.div.withConfig({displayName:"New__NewFormWrap",componentId:"sc-8e7ehz-0"})(["display:flex;flex-flow:row wrap;.wp-eform-admin-new-form__form{width:100%;flex:0 0 auto;padding:"," ",";}.wp-eform-admin-new-form__preview{padding:",";flex:0 0 auto;width:100%;}&.wp-eform-admin-new-form--tablet{.wp-eform-admin-new-form__form{max-width:400px;min-width:320px;width:50%;flex:0 1 50%;}.wp-eform-admin-new-form__preview{width:50%;flex:1 1 50%;}}"],(e=>Object(j.n)(e.theme.gutter/2)),(e=>Object(j.n)(e.theme.gutter)),(e=>Object(j.n)(e.theme.gutter)));function ae(e){const t=Object(v.c)("wp-eform-admin-new-form"),n=Object(c.useState)(!1),i=Object(m.a)(n,2),r=i[0],s=i[1],l=Object(c.useState)(""),d=Object(m.a)(l,2),h=d[0],j=d[1];return Object(B.jsxs)(B.Fragment,{children:[Object(B.jsx)(b.a,{title:Object(f.__)("New Form","wp-eform"),subTitle:Object(f.__)("Create a new form from scratch or template","wp-eform"),backLink:"/forms"}),Object(B.jsx)(g.a,{children:Object(B.jsxs)(se,{className:a()(t),children:[Object(B.jsxs)(p.b,{className:"wp-eform-admin-new-form__form",children:[Object(B.jsx)(p.a,{children:Object(f.__)("Create new form","wp-eform")}),Object(B.jsx)(N,{mutating:r,setMutating:s}),Object(B.jsx)(u,{type:"horizontal",dashed:!0,orientation:"center",children:Object(f.__)("OR","wp-eform")}),Object(B.jsx)(Z,{mutating:r,setMutating:s,setTemplateId:j}),Object(B.jsx)(u,{type:"horizontal",dashed:!0,orientation:"center",children:Object(f.__)("OR","wp-eform")}),Object(B.jsx)(re,{mutating:r,setMutating:s})]}),Object(B.jsx)("div",{className:"wp-eform-admin-new-form__preview",children:h?Object(B.jsx)(Z.Preview,{templateId:h},h):Object(B.jsx)(o.a,{description:Object(B.jsx)("p",{children:Object(f.__)("Form preview will show up here once you have selected a template.","wp-eform")})})})]})})]})}}}]);
//# sourceMappingURL=16-c9c1dfe8.js.map