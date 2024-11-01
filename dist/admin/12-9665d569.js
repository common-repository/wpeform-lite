/*! For license information please see 12-9665d569.js.LICENSE.txt */
(window.wpackiowpqEformadminJsonp=window.wpackiowpqEformadminJsonp||[]).push([[12],{1034:function(e,t,n){"use strict";n.d(t,"a",(function(){return W})),n.d(t,"b",(function(){return U})),n.d(t,"c",(function(){return N})),n.d(t,"d",(function(){return a})),n.d(t,"e",(function(){return r})),n.d(t,"f",(function(){return O})),n.d(t,"g",(function(){return k})),n.d(t,"h",(function(){return u})),n.d(t,"i",(function(){return G})),n.d(t,"j",(function(){return X})),n.d(t,"k",(function(){return Y})),n.d(t,"l",(function(){return p})),n.d(t,"m",(function(){return Q})),n.d(t,"n",(function(){return h})),n.d(t,"o",(function(){return K})),n.d(t,"p",(function(){return Z})),n.d(t,"q",(function(){return b})),n.d(t,"r",(function(){return J}));var o=n(6),i=n(1035);function r(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function s(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,o)}return n}function a(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?s(Object(n),!0).forEach((function(t){r(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):s(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}const c={pointer:{start:"down",change:"move",end:"up"},mouse:{start:"down",change:"move",end:"up"},touch:{start:"start",change:"move",end:"end"},gesture:{start:"start",change:"change",end:"end"}};function l(e){return e?e[0].toUpperCase()+e.slice(1):""}const d=["enter","leave"];function u(e,t="",n=!1){const o=c[e],i=o&&o[t]||t;return"on"+l(e)+l(i)+(function(e=!1,t){return e&&!d.includes(t)}(n,i)?"Capture":"")}const m=["gotpointercapture","lostpointercapture"];function h(e){let t=e.substring(2).toLowerCase();const n=!!~t.indexOf("passive");n&&(t=t.replace("passive",""));const o=m.includes(t)?"capturecapture":"capture",i=!!~t.indexOf(o);return i&&(t=t.replace("capture","")),{device:t,capture:i,passive:n}}function b(e,t=""){const n=c[e];return e+(n&&n[t]||t)}function p(e){return"touches"in e}function f(e){return p(e)?"touch":"pointerType"in e?e.pointerType:"mouse"}function g(e){return p(e)?function(e){return"touchend"===e.type||"touchcancel"===e.type?e.changedTouches:e.targetTouches}(e)[0]:e}function j(e,t){const n=t.clientX-e.clientX,o=t.clientY-e.clientY,i=(t.clientX+e.clientX)/2,r=(t.clientY+e.clientY)/2,s=Math.hypot(n,o);return{angle:-180*Math.atan2(n,o)/Math.PI,distance:s,origin:[i,r]}}function O(e){return function(e){return Array.from(e.touches).filter((t=>{var n,o;return t.target===e.currentTarget||(null===(n=e.currentTarget)||void 0===n||null===(o=n.contains)||void 0===o?void 0:o.call(n,t.target))}))}(e).map((e=>e.identifier))}function v(e,t){const n=Array.from(e.touches).filter((e=>t.includes(e.identifier))),i=Object(o.a)(n,2);return j(i[0],i[1])}function w(e){const t=g(e);return p(e)?t.identifier:t.pointerId}function y(e){const t=g(e);return[t.clientX,t.clientY]}function x(e){let t=e.deltaX,n=e.deltaY,o=e.deltaMode;return 1===o?(t*=40,n*=40):2===o&&(t*=800,n*=800),[t,n]}function C(e,...t){return"function"==typeof e?e(...t):e}function _(){}function k(...e){return 0===e.length?_:1===e.length?e[0]:function(){let t;for(const n of e)t=n.apply(this,arguments)||t;return t}}function S(e,t){return Object.assign({},t,e||{})}class E{constructor(e,t,n){this.ctrl=e,this.args=t,this.key=n,this.state||(this.state={},this.computeValues([0,0]),this.computeInitial(),this.init&&this.init(),this.reset())}get state(){return this.ctrl.state[this.key]}set state(e){this.ctrl.state[this.key]=e}get shared(){return this.ctrl.state.shared}get eventStore(){return this.ctrl.gestureEventStores[this.key]}get timeoutStore(){return this.ctrl.gestureTimeoutStores[this.key]}get config(){return this.ctrl.config[this.key]}get sharedConfig(){return this.ctrl.config.shared}get handler(){return this.ctrl.handlers[this.key]}reset(){const e=this.state,t=this.shared,n=this.ingKey,o=this.args;t[n]=e._active=e.active=e._blocked=e._force=!1,e._step=[!1,!1],e.intentional=!1,e._movement=[0,0],e._distance=[0,0],e._direction=[0,0],e._delta=[0,0],e._bounds=[[-1/0,1/0],[-1/0,1/0]],e.args=o,e.axis=void 0,e.memo=void 0,e.elapsedTime=0,e.direction=[0,0],e.distance=[0,0],e.overflow=[0,0],e._movementBound=[!1,!1],e.velocity=[0,0],e.movement=[0,0],e.delta=[0,0],e.timeStamp=0}start(e){const t=this.state,n=this.config;t._active||(this.reset(),this.computeInitial(),t._active=!0,t.target=e.target,t.currentTarget=e.currentTarget,t.lastOffset=n.from?C(n.from,t):t.offset,t.offset=t.lastOffset),t.startTime=t.timeStamp=e.timeStamp}computeValues(e){const t=this.state;t._values=e,t.values=this.config.transform(e)}computeInitial(){const e=this.state;e._initial=e._values,e.initial=e.values}compute(e){const t=this.state,n=this.config,r=this.shared;t.args=this.args;let s=0;if(e&&(t.event=e,n.preventDefault&&e.cancelable&&t.event.preventDefault(),t.type=e.type,r.touches=this.ctrl.pointerIds.size||this.ctrl.touchIds.size,r.locked=!!document.pointerLockElement,Object.assign(r,function(e){const t={};if("buttons"in e&&(t.buttons=e.buttons),"shiftKey"in e){const n=e.shiftKey,o=e.altKey,i=e.metaKey,r=e.ctrlKey;Object.assign(t,{shiftKey:n,altKey:o,metaKey:i,ctrlKey:r})}return t}(e)),r.down=r.pressed=r.buttons%2==1||r.touches>0,s=e.timeStamp-t.timeStamp,t.timeStamp=e.timeStamp,t.elapsedTime=t.timeStamp-t.startTime),t._active){const e=t._delta.map(Math.abs);i.a.addTo(t._distance,e)}this.axisIntent&&this.axisIntent(e);const a=Object(o.a)(t._movement,2),c=a[0],l=a[1],d=Object(o.a)(n.threshold,2),u=d[0],m=d[1],h=t._step,b=t.values;if(n.hasCustomTransform?(!1===h[0]&&(h[0]=Math.abs(c)>=u&&b[0]),!1===h[1]&&(h[1]=Math.abs(l)>=m&&b[1])):(!1===h[0]&&(h[0]=Math.abs(c)>=u&&Math.sign(c)*u),!1===h[1]&&(h[1]=Math.abs(l)>=m&&Math.sign(l)*m)),t.intentional=!1!==h[0]||!1!==h[1],!t.intentional)return;const p=[0,0];if(n.hasCustomTransform){const e=Object(o.a)(b,2),t=e[0],n=e[1];p[0]=!1!==h[0]?t-h[0]:0,p[1]=!1!==h[1]?n-h[1]:0}else p[0]=!1!==h[0]?c-h[0]:0,p[1]=!1!==h[1]?l-h[1]:0;this.restrictToAxis&&!t._blocked&&this.restrictToAxis(p);const f=t.offset,g=t._active&&!t._blocked||t.active;g&&(t.first=t._active&&!t.active,t.last=!t._active&&t.active,t.active=r[this.ingKey]=t._active,e&&(t.first&&("bounds"in n&&(t._bounds=C(n.bounds,t)),this.setup&&this.setup()),t.movement=p,this.computeOffset()));const j=Object(o.a)(t.offset,2),O=j[0],v=j[1],w=Object(o.a)(t._bounds,2),y=Object(o.a)(w[0],2),x=y[0],_=y[1],k=Object(o.a)(w[1],2),S=k[0],E=k[1];t.overflow=[O<x?-1:O>_?1:0,v<S?-1:v>E?1:0],t._movementBound[0]=!!t.overflow[0]&&(!1===t._movementBound[0]?t._movement[0]:t._movementBound[0]),t._movementBound[1]=!!t.overflow[1]&&(!1===t._movementBound[1]?t._movement[1]:t._movementBound[1]);const I=t._active&&n.rubberband||[0,0];if(t.offset=Object(i.b)(t._bounds,t.offset,I),t.delta=i.a.sub(t.offset,f),this.computeMovement(),g&&(!t.last||s>32)){t.delta=i.a.sub(t.offset,f);const e=t.delta.map(Math.abs);i.a.addTo(t.distance,e),t.direction=t.delta.map(Math.sign),t._direction=t._delta.map(Math.sign),!t.first&&s>0&&(t.velocity=[e[0]/s,e[1]/s])}}emit(){const e=this.state,t=this.shared,n=this.config;if(e._active||this.clean(),(e._blocked||!e.intentional)&&!e._force&&!n.triggerAllEvents)return;const o=this.handler(a(a(a({},t),e),{},{[this.aliasKey]:e.values}));void 0!==o&&(e.memo=o)}clean(){this.eventStore.clean(),this.timeoutStore.clean()}}class I extends E{constructor(...e){super(...e),r(this,"aliasKey","xy")}reset(){super.reset(),this.state.axis=void 0}init(){this.state.offset=[0,0],this.state.lastOffset=[0,0]}computeOffset(){this.state.offset=i.a.add(this.state.lastOffset,this.state.movement)}computeMovement(){this.state.movement=i.a.sub(this.state.offset,this.state.lastOffset)}axisIntent(e){const t=this.state,n=this.config;if(!t.axis&&e){const o="object"==typeof n.axisThreshold?n.axisThreshold[f(e)]:n.axisThreshold;t.axis=function([e,t],n){const o=Math.abs(e),i=Math.abs(t);return o>i&&o>n?"x":i>o&&i>n?"y":void 0}(t._movement,o)}t._blocked=(n.lockDirection||!!n.axis)&&!t.axis||!!n.axis&&n.axis!==t.axis}restrictToAxis(e){if(this.config.axis||this.config.lockDirection)switch(this.state.axis){case"x":e[1]=0;break;case"y":e[0]=0}}}const T=e=>e,F={enabled:(e=!0)=>e,eventOptions:(e,t,n)=>a(a({},n.shared.eventOptions),e),preventDefault:(e=!1)=>e,triggerAllEvents:(e=!1)=>e,rubberband(e=0){switch(e){case!0:return[.15,.15];case!1:return[0,0];default:return i.a.toVector(e)}},from:e=>"function"==typeof e?e:null!=e?i.a.toVector(e):void 0,transform(e,t,n){const o=e||n.shared.transform;return this.hasCustomTransform=!!o,o||T},threshold:e=>i.a.toVector(e,0)};const P=a(a({},F),{},{axis(e,t,{axis:n}){if(this.lockDirection="lock"===n,!this.lockDirection)return n},axisThreshold:(e=0)=>e,bounds(e={}){if("function"==typeof e)return t=>P.bounds(e(t));if("current"in e)return()=>e.current;if("function"==typeof HTMLElement&&e instanceof HTMLElement)return e;const t=e.left,n=void 0===t?-1/0:t,o=e.right,i=void 0===o?1/0:o,r=e.top,s=void 0===r?-1/0:r,a=e.bottom;return[[n,i],[s,void 0===a?1/0:a]]}}),M={ArrowRight:(e=1)=>[10*e,0],ArrowLeft:(e=1)=>[-10*e,0],ArrowUp:(e=1)=>[0,-10*e],ArrowDown:(e=1)=>[0,10*e]};const B="undefined"!=typeof window&&window.document&&window.document.createElement;function L(){return B&&"ontouchstart"in window||B&&window.navigator.maxTouchPoints>1}const N={isBrowser:B,gesture:function(){try{return"constructor"in GestureEvent}catch(e){return!1}}(),touch:L(),touchscreen:L(),pointer:B&&"onpointerdown"in window,pointerLock:B&&"exitPointerLock"in window.document},R={mouse:0,touch:0,pen:8},A=a(a({},P),{},{device(e,t,{pointer:{touch:n=!1,lock:o=!1,mouse:i=!1}={}}){return this.pointerLock=o&&N.pointerLock,N.touch&&n?"touch":this.pointerLock?"mouse":N.pointer&&!i?"pointer":N.touch?"touch":"mouse"},preventScrollAxis(e,t,{preventScroll:n}){if(this.preventScrollDelay="number"==typeof n?n:n||void 0===n&&e?250:void 0,N.touchscreen&&!1!==n)return e||(void 0!==n?"y":void 0)},pointerCapture(e,t,{pointer:{capture:n=!0,buttons:o=1,keys:i=!0}={}}){return this.pointerButtons=o,this.keys=i,!this.pointerLock&&"pointer"===this.device&&n},threshold(e,t,{filterTaps:n=!1,tapsThreshold:o=3,axis:r}){const s=i.a.toVector(e,n?o:r?1:0);return this.filterTaps=n,this.tapsThreshold=o,s},swipe({velocity:e=.5,distance:t=50,duration:n=250}={}){return{velocity:this.transform(i.a.toVector(e)),distance:this.transform(i.a.toVector(t)),duration:n}},delay(e=0){switch(e){case!0:return 180;case!1:return 0;default:return e}},axisThreshold:e=>e?a(a({},R),e):R});function D(e){const t=Object(o.a)(e.overflow,2),n=t[0],i=t[1],r=Object(o.a)(e._delta,2),s=r[0],a=r[1],c=Object(o.a)(e._direction,2),l=c[0],d=c[1];(n<0&&s>0&&l<0||n>0&&s<0&&l>0)&&(e._movement[0]=e._movementBound[0]),(i<0&&a>0&&d<0||i>0&&a<0&&d>0)&&(e._movement[1]=e._movementBound[1])}const z=a(a({},F),{},{device(e,t,{shared:n,pointer:{touch:o=!1}={}}){if(n.target&&!N.touch&&N.gesture)return"gesture";if(N.touch&&o)return"touch";if(N.touchscreen){if(N.pointer)return"pointer";if(N.touch)return"touch"}},bounds(e,t,{scaleBounds:n={},angleBounds:o={}}){const i=e=>{const t=S(C(n,e),{min:-1/0,max:1/0});return[t.min,t.max]},r=e=>{const t=S(C(o,e),{min:-1/0,max:1/0});return[t.min,t.max]};return"function"!=typeof n&&"function"!=typeof o?[i(),r()]:e=>[i(e),r(e)]},threshold(e,t,n){this.lockDirection="lock"===n.axis;return i.a.toVector(e,this.lockDirection?[.1,3]:0)},modifierKey:e=>void 0===e?"ctrlKey":e,pinchOnWheel:(e=!0)=>e});const H=a(a({},P),{},{mouseOnly:(e=!0)=>e});const V=P;const $=P;const q=a(a({},P),{},{mouseOnly:(e=!0)=>e}),U=new Map,W=new Map;function K(e){U.set(e.key,e.engine),W.set(e.key,e.resolver)}const G={key:"drag",engine:class extends I{constructor(...e){super(...e),r(this,"ingKey","dragging")}reset(){super.reset();const e=this.state;e._pointerId=void 0,e._pointerActive=!1,e._keyboardActive=!1,e._preventScroll=!1,e._delayed=!1,e.swipe=[0,0],e.tap=!1,e.canceled=!1,e.cancel=this.cancel.bind(this)}setup(){const e=this.state;if(e._bounds instanceof HTMLElement){const t=e._bounds.getBoundingClientRect(),n=e.currentTarget.getBoundingClientRect(),o={left:t.left-n.left+e.offset[0],right:t.right-n.right+e.offset[0],top:t.top-n.top+e.offset[1],bottom:t.bottom-n.bottom+e.offset[1]};e._bounds=P.bounds(o)}}cancel(){const e=this.state;e.canceled||(e.canceled=!0,e._active=!1,setTimeout((()=>{this.compute(),this.emit()}),0))}setActive(){this.state._active=this.state._pointerActive||this.state._keyboardActive}clean(){this.pointerClean(),this.state._pointerActive=!1,this.state._keyboardActive=!1,super.clean()}pointerDown(e){const t=this.config,n=this.state;if(null!=e.buttons&&(Array.isArray(t.pointerButtons)?!t.pointerButtons.includes(e.buttons):-1!==t.pointerButtons&&t.pointerButtons!==e.buttons))return;const o=this.ctrl.setEventIds(e);t.pointerCapture&&e.target.setPointerCapture(e.pointerId),o&&o.size>1&&n._pointerActive||(this.start(e),this.setupPointer(e),n._pointerId=w(e),n._pointerActive=!0,this.computeValues(y(e)),this.computeInitial(),t.preventScrollAxis&&"mouse"!==f(e)?(n._active=!1,this.setupScrollPrevention(e)):t.delay>0?(this.setupDelayTrigger(e),t.triggerAllEvents&&(this.compute(e),this.emit())):this.startPointerDrag(e))}startPointerDrag(e){const t=this.state;t._active=!0,t._preventScroll=!0,t._delayed=!1,this.compute(e),this.emit()}pointerMove(e){const t=this.state,n=this.config;if(!t._pointerActive)return;if(t.type===e.type&&e.timeStamp===t.timeStamp)return;const o=w(e);if(void 0!==t._pointerId&&o!==t._pointerId)return;const r=y(e);return document.pointerLockElement===e.target?t._delta=[e.movementX,e.movementY]:(t._delta=i.a.sub(r,t._values),this.computeValues(r)),i.a.addTo(t._movement,t._delta),this.compute(e),t._delayed&&t.intentional?(this.timeoutStore.remove("dragDelay"),t.active=!1,void this.startPointerDrag(e)):n.preventScrollAxis&&!t._preventScroll?t.axis?t.axis===n.preventScrollAxis||"xy"===n.preventScrollAxis?(t._active=!1,void this.clean()):(this.timeoutStore.remove("startPointerDrag"),void this.startPointerDrag(e)):void 0:void this.emit()}pointerUp(e){this.ctrl.setEventIds(e);try{this.config.pointerCapture&&e.target.hasPointerCapture(e.pointerId)&&e.target.releasePointerCapture(e.pointerId)}catch(e){0}const t=this.state,n=this.config;if(!t._active||!t._pointerActive)return;const i=w(e);if(void 0!==t._pointerId&&i!==t._pointerId)return;this.state._pointerActive=!1,this.setActive(),this.compute(e);const r=Object(o.a)(t._distance,2),s=r[0],a=r[1];if(t.tap=s<=n.tapsThreshold&&a<=n.tapsThreshold,t.tap&&n.filterTaps)t._force=!0;else{const e=Object(o.a)(t.direction,2),i=e[0],r=e[1],s=Object(o.a)(t.velocity,2),a=s[0],c=s[1],l=Object(o.a)(t.movement,2),d=l[0],u=l[1],m=Object(o.a)(n.swipe.velocity,2),h=m[0],b=m[1],p=Object(o.a)(n.swipe.distance,2),f=p[0],g=p[1],j=n.swipe.duration;t.elapsedTime<j&&(Math.abs(a)>h&&Math.abs(d)>f&&(t.swipe[0]=i),Math.abs(c)>b&&Math.abs(u)>g&&(t.swipe[1]=r))}this.emit()}pointerClick(e){!this.state.tap&&e.detail>0&&(e.preventDefault(),e.stopPropagation())}setupPointer(e){const t=this.config,n=t.device;t.pointerLock&&e.currentTarget.requestPointerLock(),t.pointerCapture||(this.eventStore.add(this.sharedConfig.window,n,"change",this.pointerMove.bind(this)),this.eventStore.add(this.sharedConfig.window,n,"end",this.pointerUp.bind(this)),this.eventStore.add(this.sharedConfig.window,n,"cancel",this.pointerUp.bind(this)))}pointerClean(){this.config.pointerLock&&document.pointerLockElement===this.state.currentTarget&&document.exitPointerLock()}preventScroll(e){this.state._preventScroll&&e.cancelable&&e.preventDefault()}setupScrollPrevention(e){this.state._preventScroll=!1,function(e){"persist"in e&&"function"==typeof e.persist&&e.persist()}(e);const t=this.eventStore.add(this.sharedConfig.window,"touch","change",this.preventScroll.bind(this),{passive:!1});this.eventStore.add(this.sharedConfig.window,"touch","end",t),this.eventStore.add(this.sharedConfig.window,"touch","cancel",t),this.timeoutStore.add("startPointerDrag",this.startPointerDrag.bind(this),this.config.preventScrollDelay,e)}setupDelayTrigger(e){this.state._delayed=!0,this.timeoutStore.add("dragDelay",(()=>{this.state._step=[0,0],this.startPointerDrag(e)}),this.config.delay)}keyDown(e){const t=M[e.key];if(t){const n=this.state,o=e.shiftKey?10:e.altKey?.1:1;this.start(e),n._delta=t(o),n._keyboardActive=!0,i.a.addTo(n._movement,n._delta),this.compute(e),this.emit()}}keyUp(e){e.key in M&&(this.state._keyboardActive=!1,this.setActive(),this.compute(e),this.emit())}bind(e){const t=this.config.device;e(t,"start",this.pointerDown.bind(this)),this.config.pointerCapture&&(e(t,"change",this.pointerMove.bind(this)),e(t,"end",this.pointerUp.bind(this)),e(t,"cancel",this.pointerUp.bind(this)),e("lostPointerCapture","",this.pointerUp.bind(this))),this.config.keys&&(e("key","down",this.keyDown.bind(this)),e("key","up",this.keyUp.bind(this))),this.config.filterTaps&&e("click","",this.pointerClick.bind(this),{capture:!0,passive:!1})}},resolver:A},Y={key:"hover",engine:class extends I{constructor(...e){super(...e),r(this,"ingKey","hovering")}enter(e){this.config.mouseOnly&&"mouse"!==e.pointerType||(this.start(e),this.computeValues(y(e)),this.compute(e),this.emit())}leave(e){if(this.config.mouseOnly&&"mouse"!==e.pointerType)return;const t=this.state;if(!t._active)return;t._active=!1;const n=y(e);t._movement=t._delta=i.a.sub(n,t._values),this.computeValues(n),this.compute(e),t.delta=t.movement,this.emit()}bind(e){e("pointer","enter",this.enter.bind(this)),e("pointer","leave",this.leave.bind(this))}},resolver:q},Q={key:"move",engine:class extends I{constructor(...e){super(...e),r(this,"ingKey","moving")}move(e){this.config.mouseOnly&&"mouse"!==e.pointerType||(this.state._active?this.moveChange(e):this.moveStart(e),this.timeoutStore.add("moveEnd",this.moveEnd.bind(this)))}moveStart(e){this.start(e),this.computeValues(y(e)),this.compute(e),this.computeInitial(),this.emit()}moveChange(e){if(!this.state._active)return;const t=y(e),n=this.state;n._delta=i.a.sub(t,n._values),i.a.addTo(n._movement,n._delta),this.computeValues(t),this.compute(e),this.emit()}moveEnd(e){this.state._active&&(this.state._active=!1,this.compute(e),this.emit())}bind(e){e("pointer","change",this.move.bind(this)),e("pointer","leave",this.moveEnd.bind(this))}},resolver:H},X={key:"pinch",engine:class extends E{constructor(...e){super(...e),r(this,"ingKey","pinching"),r(this,"aliasKey","da")}init(){this.state.offset=[1,0],this.state.lastOffset=[1,0],this.state._pointerEvents=new Map}reset(){super.reset();const e=this.state;e._touchIds=[],e.canceled=!1,e.cancel=this.cancel.bind(this),e.turns=0}computeOffset(){const e=this.state,t=e.type,n=e.movement,o=e.lastOffset;this.state.offset="wheel"===t?i.a.add(n,o):[(1+n[0])*o[0],n[1]+o[1]]}computeMovement(){const e=this.state,t=e.offset,n=e.lastOffset;this.state.movement=[t[0]/n[0],t[1]-n[1]]}axisIntent(){const e=this.state,t=Object(o.a)(e._movement,2),n=t[0],i=t[1];if(!e.axis){const t=30*Math.abs(n)-Math.abs(i);t<0?e.axis="angle":t>0&&(e.axis="scale")}}restrictToAxis(e){this.config.lockDirection&&("scale"===this.state.axis?e[1]=0:"angle"===this.state.axis&&(e[0]=0))}cancel(){const e=this.state;e.canceled||setTimeout((()=>{e.canceled=!0,e._active=!1,this.compute(),this.emit()}),0)}touchStart(e){this.ctrl.setEventIds(e);const t=this.state,n=this.ctrl.touchIds;if(t._active&&t._touchIds.every((e=>n.has(e))))return;if(n.size<2)return;this.start(e),t._touchIds=Array.from(n).slice(0,2);const o=v(e,t._touchIds);this.pinchStart(e,o)}pointerStart(e){if(null!=e.buttons&&e.buttons%2!=1)return;this.ctrl.setEventIds(e),e.target.setPointerCapture(e.pointerId);const t=this.state,n=t._pointerEvents,o=this.ctrl.pointerIds;if(t._active&&Array.from(n.keys()).every((e=>o.has(e))))return;if(n.size<2&&n.set(e.pointerId,e),t._pointerEvents.size<2)return;this.start(e);const i=j(...Array.from(n.values()));this.pinchStart(e,i)}pinchStart(e,t){this.state.origin=t.origin,this.computeValues([t.distance,t.angle]),this.computeInitial(),this.compute(e),this.emit()}touchMove(e){if(!this.state._active)return;const t=v(e,this.state._touchIds);this.pinchMove(e,t)}pointerMove(e){const t=this.state._pointerEvents;if(t.has(e.pointerId)&&t.set(e.pointerId,e),!this.state._active)return;const n=j(...Array.from(t.values()));this.pinchMove(e,n)}pinchMove(e,t){const n=this.state,o=n._values[1],i=t.angle-o;let r=0;Math.abs(i)>270&&(r+=Math.sign(i)),this.computeValues([t.distance,t.angle-360*r]),n.origin=t.origin,n.turns=r,n._movement=[n._values[0]/n._initial[0]-1,n._values[1]-n._initial[1]],this.compute(e),this.emit()}touchEnd(e){this.ctrl.setEventIds(e),this.state._active&&this.state._touchIds.some((e=>!this.ctrl.touchIds.has(e)))&&(this.state._active=!1,this.compute(e),this.emit())}pointerEnd(e){const t=this.state;this.ctrl.setEventIds(e);try{e.target.releasePointerCapture(e.pointerId)}catch(e){}t._pointerEvents.has(e.pointerId)&&t._pointerEvents.delete(e.pointerId),t._active&&t._pointerEvents.size<2&&(t._active=!1,this.compute(e),this.emit())}gestureStart(e){e.cancelable&&e.preventDefault();const t=this.state;t._active||(this.start(e),this.computeValues([e.scale,e.rotation]),t.origin=[e.clientX,e.clientY],this.compute(e),this.emit())}gestureMove(e){if(e.cancelable&&e.preventDefault(),!this.state._active)return;const t=this.state;this.computeValues([e.scale,e.rotation]),t.origin=[e.clientX,e.clientY];const n=t._movement;t._movement=[e.scale-1,e.rotation],t._delta=i.a.sub(t._movement,n),this.compute(e),this.emit()}gestureEnd(e){this.state._active&&(this.state._active=!1,this.compute(e),this.emit())}wheel(e){const t=this.config.modifierKey;t&&!e[t]||(this.state._active?this.wheelChange(e):this.wheelStart(e),this.timeoutStore.add("wheelEnd",this.wheelEnd.bind(this)))}wheelStart(e){this.start(e),this.wheelChange(e)}wheelChange(e){"uv"in e||e.cancelable&&e.preventDefault();const t=this.state;t._delta=[-x(e)[1]/100*t.offset[0],0],i.a.addTo(t._movement,t._delta),D(t),this.state.origin=[e.clientX,e.clientY],this.compute(e),this.emit()}wheelEnd(){this.state._active&&(this.state._active=!1,this.compute(),this.emit())}bind(e){const t=this.config.device;t&&(e(t,"start",this[t+"Start"].bind(this)),e(t,"change",this[t+"Move"].bind(this)),e(t,"end",this[t+"End"].bind(this)),e(t,"cancel",this[t+"End"].bind(this))),this.config.pinchOnWheel&&e("wheel","",this.wheel.bind(this),{passive:!1})}},resolver:z},Z={key:"scroll",engine:class extends I{constructor(...e){super(...e),r(this,"ingKey","scrolling")}scroll(e){this.state._active||this.start(e),this.scrollChange(e),this.timeoutStore.add("scrollEnd",this.scrollEnd.bind(this))}scrollChange(e){e.cancelable&&e.preventDefault();const t=this.state,n=function(e){var t,n;const o=e.currentTarget,i=o.scrollX,r=o.scrollY,s=o.scrollLeft,a=o.scrollTop;return[null!==(t=null!=i?i:s)&&void 0!==t?t:0,null!==(n=null!=r?r:a)&&void 0!==n?n:0]}(e);t._delta=i.a.sub(n,t._values),i.a.addTo(t._movement,t._delta),this.computeValues(n),this.compute(e),this.emit()}scrollEnd(){this.state._active&&(this.state._active=!1,this.compute(),this.emit())}bind(e){e("scroll","",this.scroll.bind(this))}},resolver:V},J={key:"wheel",engine:class extends I{constructor(...e){super(...e),r(this,"ingKey","wheeling")}wheel(e){this.state._active||this.start(e),this.wheelChange(e),this.timeoutStore.add("wheelEnd",this.wheelEnd.bind(this))}wheelChange(e){const t=this.state;t._delta=x(e),i.a.addTo(t._movement,t._delta),D(t),this.compute(e),this.emit()}wheelEnd(){this.state._active&&(this.state._active=!1,this.compute(),this.emit())}bind(e){e("wheel","",this.wheel.bind(this))}},resolver:$}},1035:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return a}));var o=n(6);const i={toVector:(e,t)=>(void 0===e&&(e=t),Array.isArray(e)?e:[e,e]),add:(e,t)=>[e[0]+t[0],e[1]+t[1]],sub:(e,t)=>[e[0]-t[0],e[1]-t[1]],addTo(e,t){e[0]+=t[0],e[1]+=t[1]},subTo(e,t){e[0]-=t[0],e[1]-=t[1]}};function r(e,t,n){return 0===t||Math.abs(t)===1/0?Math.pow(e,5*n):e*t*n/(t+n*e)}function s(e,t,n,o=.15){return 0===o?function(e,t,n){return Math.max(t,Math.min(e,n))}(e,t,n):e<t?-r(t-e,n-t,o)+t:e>n?+r(e-n,n-t,o)+n:e}function a(e,[t,n],[i,r]){const a=Object(o.a)(e,2),c=Object(o.a)(a[0],2),l=c[0],d=c[1],u=Object(o.a)(a[1],2),m=u[0],h=u[1];return[s(t,l,d,i),s(n,m,h,r)]}},1036:function(e,t,n){"use strict";n.d(t,"c",(function(){return v})),n.d(t,"b",(function(){return O})),n.d(t,"a",(function(){return _}));var o=n(15),i=n(0),r=n(7),s=n(1092),a=n(98),c=(n(8),n(1043)),l=n(1041),d=n(1);const u=Object(i.createContext)(void 0);var m=n(443),h=n(21),b=n(2),p=n(1066),f=n(29);n(281);const g=m.a.getItems()[0].item.config,j=Object(i.createContext)(void 0);function O(e){var t,n,o,i,r,s,a,c,l,d,u,m,h,b,p,f;return{scheme:null==e||null===(t=e.theme)||void 0===t?void 0:t.scheme,baseFont:null==e||null===(n=e.typography)||void 0===n?void 0:n.baseFont,boldHeading:null==e||null===(o=e.typography)||void 0===o?void 0:o.headFontBold,italicHeading:null==e||null===(i=e.typography)||void 0===i?void 0:i.headFontItalic,headFamily:null==e||null===(r=e.typography)||void 0===r?void 0:r.headFamily,headFamilyCustom:null==e||null===(s=e.typography)||void 0===s?void 0:s.headFamilyCustom,bodyFamily:null==e||null===(a=e.typography)||void 0===a?void 0:a.bodyFamily,bodyFamilyCustom:null==e||null===(c=e.typography)||void 0===c?void 0:c.bodyFamilyCustom,customPrimaryColor:null==e||null===(l=e.theme)||void 0===l?void 0:l.customColorPrimary,customSecondaryColor:null==e||null===(d=e.theme)||void 0===d?void 0:d.customColorSecondary,customBackgroundColor:null==e||null===(u=e.theme)||void 0===u?void 0:u.customColorBg,customTextColor:null==e||null===(m=e.theme)||void 0===m?void 0:m.customColorText,css:null==e||null===(h=e.theme)||void 0===h?void 0:h.css,maxWidth:null==e||null===(b=e.appearance)||void 0===b?void 0:b.maxWidth,containerLayout:null==e||null===(p=e.appearance)||void 0===p?void 0:p.containerLayout,darkMode:null==e||null===(f=e.theme)||void 0===f?void 0:f.darkMode}}function v(e){return Object(i.useMemo)((()=>O(e)),[e])}function w(e){const t=Object(i.useState)((()=>!1)),n=Object(o.a)(t,2),r=n[0];n[1];Object(i.useEffect)((()=>()=>{}),[]);const s=Object(i.useContext)(j);return Object(i.useMemo)((()=>{const t=null!=e?e:{},n=t.baseFont,i=t.bodyFamily,r=t.boldHeading,s=t.customBackgroundColor,a=t.customPrimaryColor,c=t.customSecondaryColor,l=t.customTextColor,d=t.headFamily,u=t.italicHeading,j=t.scheme;t.darkMode;let O=Object(h.c)(g);j&&m.a.hasItem(j)&&(O=Object(h.c)(m.a.getItem(j).config)),n&&16!==n&&n>=12&&(O={...O,controlHeightBase:Object(b.g)(2.5*n),borderRadiusBase:Object(b.g)(.25*n),gutter:Math.min(Math.max(Object(b.g)(1.25*n),10),40),fz:{small2:Math.ceil(.75*n),small1:Math.ceil(.875*n),base:n,large1:Math.ceil(1.125*n),large2:Math.ceil(1.25*n),large3:Math.ceil(1.5*n),large4:Math.ceil(1.875*n),large5:Math.ceil(2.25*n),large6:Math.ceil(3*n),large7:Math.ceil(3.75*n),large8:Math.ceil(4.5*n)}});const v=[];if(O.boldHeading=!!r,O.italicHeading=!!u,d){let t="inherit";if("custom"===d){var w;t=null!==(w=null==e?void 0:e.headFamilyCustom)&&void 0!==w?w:"inherit"}else{const e=Object(p.a)(d),n=Object(o.a)(e,2),i=n[0],r=n[1];t=i,r&&v.push(r)}O.fontFamilyHeading=t}if(i){let t="inherit";if("custom"===i){var y;t=null!==(y=null==e?void 0:e.bodyFamilyCustom)&&void 0!==y?y:"inherit"}else{const e=Object(p.a)(i),n=Object(o.a)(e,2),r=n[0],s=n[1];t=r,s&&v.push(s)}O.fontFamilyBody=t}const x=f.b,C=f.d;return a&&(O.primaryColor=a,O.primaryDarkColor=x(.1,a),O.primaryLightColor=C(.1,a),O.accentColor=Object(f.a)(a),O.primaryBgText=Object(f.d)(.7,a),O.primaryBackgroundColor=C(.6,a),O.linkColor=a,O.boxShadowFocus=`0 0 0 2px ${Object(f.e)(.5,a)}`,O.boxShadowControlFocus=`0 0 0 ${Object(b.n)(3)} ${Object(f.e)(.8,a)}`),c&&(O.borderColorBase=c,O.borderColorSplit=C(.1,c),O.disabledColor=C(.28,c),O.disabledBackgroundColor=C(.45,c),O.backgroundControl=C(.44,c),console.log(O.backgroundControl),O.backgroundShade=Object(f.c)(.01,C(.4,c)),O.backgroundHover=Object(f.c)(.01,C(.42,c))),s&&(O.appBackgroundColor=s),l&&(O.textColor=l,O.textColorSecondary=C(.4,l),O.headingColor=C(.1,l)),[O,Object(h.a)(v)]}),[e,r,s])}function y(e){const t=new r.a;let n;try{Object(s.renderToString)(Object(d.jsx)(r.b,{sheet:t.instance,children:Object(d.jsx)(d.Fragment,{children:e})})),n=t.getStyleElement()}catch(e){console.log(e),n=null}finally{t.seal()}return n}function x(e){const t=e.children,n=e.ssr,o=e.mode,i=e.themeStyle,s=e.widthOverride,c=e.containerLayoutOverride,l=e.theme;return Object(d.jsx)(r.c,{theme:l,children:n?Object(d.jsx)(a.a.Ssr,{width:null!=s?s:null==i?void 0:i.maxWidth,containerLayout:null!=c?c:null==i?void 0:i.containerLayout,noHorizontalPadding:"preview"===o,noVerticalPadding:"preview"===o,children:t}):Object(d.jsx)(a.a,{width:null!=s?s:null==i?void 0:i.maxWidth,containerLayout:null!=c?c:null==i?void 0:i.containerLayout,noHorizontalPadding:"preview"===o,noVerticalPadding:"preview"===o,children:t})})}function C(e){const t=e.children,n=Object(i.useContext)(u);return Object(d.jsx)(r.b,{target:n,children:Object(d.jsx)(d.Fragment,{children:t})})}function _(e){const t=e.mode,n=e.themeStyle,r=e.ssr,s=void 0!==r&&r,a=w(n),u=Object(o.a)(a,2),m=u[0],h=u[1],b=null==n?void 0:n.css,p=Object(c.b)();Object(i.useEffect)((()=>{p&&"undefined"!=typeof window&&h&&h.length&&h.forEach((e=>{const t=Object(l.d)(e);if(!document.head.querySelector(`#${t}`)){const n=document.createElement("link");n.setAttribute("href",e),n.setAttribute("id",t),n.setAttribute("rel","stylesheet"),document.head.append(n)}}))}),[h,p]);const f=Object(d.jsx)(x,{theme:m,...e}),g=Object(i.useState)(!1),j=Object(o.a)(g,2),O=j[0],v=j[1];return Object(i.useEffect)((()=>{v(!0)}),[]),Object(d.jsxs)(d.Fragment,{children:[p&&O?h.map((e=>Object(d.jsx)("link",{rel:"stylesheet",href:e},e))):null,b&&"live"===t?Object(d.jsx)("style",{type:"text/css",dangerouslySetInnerHTML:{__html:b}}):null,s?Object(d.jsxs)(d.Fragment,{children:[y(f),Object(d.jsx)("div",{className:"wpeform-root-slot__react-app",children:f})]}):Object(d.jsx)(C,{children:f})]})}},1038:function(e,t,n){"use strict";n.d(t,"a",(function(){return h}));var o=n(42),i=n(52),r=(n(0),n(83)),s=n(7),a=n(10),c=n.n(a),l=n(1);const d=["history","location","match","staticContext","to","transparent","className"],u=["onClick","transparent","className"],m=Object(s.f)(i.a).withConfig({displayName:"StyledLink__StyledLinkButton",componentId:"sc-1fap3y6-0"})(["&.wpeform-ghosted-button{border:0 none;box-shadow:none;&:hover{background-color:",";color:",";}}"],(e=>e.theme.backgroundHover),(e=>e.theme.textColor));function h(e){const t=e.onClick,n=e.transparent,i=e.className,r=Object(o.a)(e,u);return Object(l.jsx)(m,{className:c()(i,{"wpeform-ghosted-button":n}),...r,onClick:e=>{e.preventDefault(),t()}})}t.b=Object(r.o)((function(e){const t=e.history,n=(e.location,e.match,e.staticContext,e.to),i=e.transparent,r=e.className,s=Object(o.a)(e,d);return Object(l.jsx)(m,{className:c()(r,{"wpeform-ghosted-button":i}),...s,onClick:e=>{e.preventDefault(),t.push(n)}})}))},1039:function(e,t,n){"use strict";n.d(t,"a",(function(){return r}));n(0),n(8);var o=n(1036);n.d(t,"c",(function(){return o.c})),n.d(t,"b",(function(){return o.b}));var i=n(1);function r(e){const t=e.children,n=e.themeStyle,r=e.widthOverride,s=e.containerLayoutOverride,a=e.mode,c=void 0===a?"live":a,l=e.ssr,d=void 0!==l&&l;return Object(i.jsx)(o.a,{themeStyle:n,mode:c,containerLayoutOverride:s,widthOverride:r,ssr:d,children:t})}},1040:function(e,t,n){"use strict";var o=n(1034);n.d(t,"a",(function(){return o.i})),n.d(t,"b",(function(){return o.k})),n.d(t,"c",(function(){return o.m})),n.d(t,"d",(function(){return o.j})),n.d(t,"e",(function(){return o.o})),n.d(t,"f",(function(){return o.p})),n.d(t,"g",(function(){return o.r}))},1041:function(e,t,n){"use strict";n.d(t,"b",(function(){return i})),n.d(t,"a",(function(){return r})),n.d(t,"e",(function(){return s})),n.d(t,"c",(function(){return a})),n.d(t,"d",(function(){return c}));var o=n(3);function i(e,t,n=Object(o.__)("Anonymous","wp-eform")){const i=[];return e&&i.push(e),t&&i.push(t),i.length?i.join(" "):n}function r(e){const t=Math.floor(e/3600),n=e%3600,i=Math.floor(n/60),r=n%60;return t>0?Object(o.sprintf)(Object(o._x)("%1$s, %2$s, %3$s","format-time-from-seconds","wp-eform"),Object(o.sprintf)(Object(o._n)("%d hour","%d hours",t,"wp-eform"),t),Object(o.sprintf)(Object(o._n)("%d minute","%d minutes",i,"wp-eform"),i),Object(o.sprintf)(Object(o._n)("%d second","%d seconds",r,"wp-eform"),r)):i>0?Object(o.sprintf)(Object(o._x)("%1$s, %2$s","format-time-from-seconds","wp-eform"),Object(o.sprintf)(Object(o._n)("%d minute","%d minutes",i,"wp-eform"),i),Object(o.sprintf)(Object(o._n)("%d second","%d seconds",r,"wp-eform"),r)):Object(o.sprintf)(Object(o._n)("%d second","%d seconds",r,"wp-eform"),r)}function s(e,t,n="…"){return e.length<=t?e:e.substring(0,t+1)+n}const a=/%%([^%%]+)%%/;function c(...e){return e.join(" ").normalize("NFD").replace(/[\u0300-\u036f]/g,"").toLowerCase().trim().replace(/[^a-z0-9 ]/g,"").replace(/\s+/g,"-")}},1042:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));var o=n(439);function i(){o.a.evict({id:"ROOT_QUERY",fieldName:"forms"}),o.a.evict({id:"ROOT_QUERY",fieldName:"form"}),o.a.evict({id:"ROOT_QUERY",fieldName:"categories"}),o.a.evict({id:"ROOT_QUERY",fieldName:"category"}),o.a.evict({id:"ROOT_QUERY",fieldName:"submissions"}),o.a.evict({id:"ROOT_QUERY",fieldName:"submission"}),o.a.evict({id:"ROOT_QUERY",fieldName:"formMeta"}),o.a.evict({id:"ROOT_QUERY",fieldName:"submissionMeta"}),o.a.evict({id:"ROOT_QUERY",fieldName:"siteSettings"}),o.a.gc()}},1043:function(e,t,n){"use strict";n.d(t,"b",(function(){return l})),n.d(t,"a",(function(){return u}));var o=n(15),i=n(0),r=n(359),s=n(1);const a=Object(i.createContext)(!1);function c(e){const t=e.cssHandles,n=Object(i.useState)([]),r=Object(o.a)(n,2),a=r[0],c=r[1];return Object(i.useEffect)((()=>{const e=[];t&&"undefined"!=typeof window&&t.forEach((t=>{const n=document.querySelector(`#${t}-css`);if(n){const i=n.getAttribute("href");var o;if(i)e.push({id:t,href:i,media:null!==(o=n.getAttribute("media"))&&void 0!==o?o:"all"})}})),c(e)}),[t]),Object(s.jsx)(s.Fragment,{children:a.map((e=>Object(s.jsx)("link",{rel:"stylesheet",href:e.href,media:e.media},e.id)))})}function l(){return Object(i.useContext)(a)}function d(){const e="undefined"!=typeof WPEFormGraphQLApp?WPEFormGraphQLApp:{customCSS:void 0,customStyleLinks:void 0},t=e.customCSS,n=e.customStyleLinks;return Object(s.jsxs)(s.Fragment,{children:[t?Object(s.jsx)("style",{type:"text/css",dangerouslySetInnerHTML:{__html:t}}):null,n?n.map((e=>Object(s.jsx)("link",{rel:"stylesheet",href:e},e))):null]})}function u(e){const t=e.children,n=e.inShadow,r=e.cssHandles,l=Object(i.useState)(!1),u=Object(o.a)(l,2),m=u[0],h=u[1];return Object(i.useEffect)((()=>{h(!0)}),[]),Object(s.jsxs)(a.Provider,{value:n,children:[m?Object(s.jsxs)(s.Fragment,{children:[Object(s.jsx)(d,{}),n?Object(s.jsx)(c,{cssHandles:r}):null]}):null,t]})}u.LinkAllAssets=function(e){const t=e.body,n=void 0!==t&&t,a=e.head,c=void 0===a||a,l=Object(i.useState)([]),d=Object(o.a)(l,2),u=d[0],m=d[1];return Object(i.useEffect)((()=>{const e=[];let t;const o='link[rel="stylesheet"]';t=c&&n?document.querySelectorAll(o):c?document.head.querySelectorAll(o):document.body.querySelectorAll(o),t.length&&t.forEach((t=>{const n=t.getAttribute("href");var o,i;n&&e.push({id:null!==(o=t.getAttribute("id"))&&void 0!==o?o:Object(r.a)(),href:n,media:null!==(i=t.getAttribute("media"))&&void 0!==i?i:"all"})})),m(e)}),[n,c]),Object(s.jsx)(s.Fragment,{children:u.map((e=>Object(s.jsx)("link",{rel:"stylesheet",href:e.href,media:e.media},e.id)))})}},1044:function(e,t,n){"use strict";n.d(t,"a",(function(){return j}));var o=n(442),i=n(1071),r=(n(0),n(7)),s=n(3),a=n(365),c=n(2),l=n(1038),d=n(1);const u=r.f.header.withConfig({displayName:"PageHeader__PageHeaderWrap",componentId:"sc-1gousn5-0"})(["display:flex;flex-flow:row wrap;align-items:center;justify-content:flex-start;background-color:",";margin-bottom:",";box-shadow:",";border-radius:",";padding:",";padding-bottom:0;.eform-admin-page-header__styledlink{margin-right:",";text-transform:uppercase;}"],(e=>e.theme.appBackgroundColor),(e=>Object(c.n)(e.theme.gutter)),(e=>e.theme.boxShadowElevationOne),(e=>Object(c.n)(e.theme.borderRadiusBase)),(e=>Object(c.n)(e.theme.gutter)),(e=>Object(c.n)(e.theme.gutter/2))),m=r.f.div.withConfig({displayName:"PageHeader__PageHeaderTitleWrap",componentId:"sc-1gousn5-1"})(["display:flex;flex-flow:row nowrap;align-items:center;margin-right:",";margin-bottom:",";flex:0 0 auto;"],(e=>Object(c.n)(e.theme.gutter)),(e=>Object(c.n)(e.theme.gutter))),h=r.f.h2.withConfig({displayName:"PageHeader__PageHeaderTitle",componentId:"sc-1gousn5-2"})(["margin:0;padding:0;font-size:",";color:",";font-weight:bold;"],(e=>Object(c.n)(e.theme.fz.base)),(e=>e.theme.textColor)),b=r.f.h4.withConfig({displayName:"PageHeader__PageHeaderSubtitle",componentId:"sc-1gousn5-3"})(["margin:0;padding:0;margin-bottom:",";flex:1 1 auto;font-size:",";color:",";font-weight:normal;font-style:italic;"],(e=>Object(c.n)(e.theme.gutter)),(e=>Object(c.n)(e.theme.fz.small1)),(e=>e.theme.greyLightColor)),p=r.f.div.withConfig({displayName:"PageHeader__PageControlLeft",componentId:"sc-1gousn5-4"})(["margin:0;padding:0;margin-bottom:",";flex:1 1 auto;max-width:100%;"],(e=>Object(c.n)(e.theme.gutter))),f=r.f.div.withConfig({displayName:"PageHeader__PageControlRight",componentId:"sc-1gousn5-5"})(["margin:0 0 "," auto;padding:0;flex:0 0 auto;"],(e=>Object(c.n)(e.theme.gutter))),g={transparent:!0,shape:"circle",size:"small",className:"eform-admin-page-header__styledlink eform-admin-page-header__styledlink--back"};function j(e){const t=e.title,n=e.subTitle,r=e.backLink,c=e.newLink,j=e.backLabel,O=void 0===j?Object(s.__)("Back","wp-eform"):j,v=e.newLabel,w=void 0===v?Object(s.__)("Add New","wp-eform"):v,y=e.controlLeft,x=e.controlRight,C=Object(a.useLastLocation)();let _;return _=null===r?null:C?`${C.pathname}${C.search}`:r,Object(d.jsxs)(u,{className:"eform-admin-page-header",children:[Object(d.jsxs)(m,{children:[_?Object(d.jsx)(l.b,{...g,to:_,title:O,children:Object(d.jsx)(i.a,{})}):null,c?Object(d.jsxs)(l.b,{size:"small",className:"eform-admin-page-header__styledlink eform-admin-page-header__styledlink--new",to:c,type:"primary",children:[Object(d.jsx)(o.a,{})," ",w]}):null,Object(d.jsx)(h,{children:t})]}),n?Object(d.jsx)(b,{children:n}):null,y?Object(d.jsx)(p,{children:y}):null,x?Object(d.jsx)(f,{children:x}):null]})}},1045:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return r}));var o=n(1189);const i=o.a`
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
`},1061:function(e,t,n){},1062:function(e,t){},1063:function(e,t,n){"use strict";n.d(t,"a",(function(){return w}));var o=n(1189);const i=o.a`
	fragment FCaptchaSubmission on FormElementCaptchaSubmissionElementValueType {
		encrypted
		solved
	}
`;var r=n(1045),s=n(1046),a=n(1047),c=n(1048),l=n(1049),d=n(1050),u=n(1051),m=n(1052),h=n(1053),b=n(1054),p=n(1055),f=n(1056),g=n(1057),j=n(1058),O=n(1059),v=n(1060);const w=o.a`
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
	${h.b}
	${b.b}
	${p.b}
	${f.b}
	${g.b}
	${j.b}
	${O.b}
	${v.b}
`},1064:function(e,t,n){"use strict";n.d(t,"a",(function(){return jt})),n.d(t,"b",(function(){return ke}));var o=n(52),i=n(1101),r=n(115),s=n(87),a=n(15),c=n(0),l=n(18),d=n(3),u=n(358),m=n(283),h=n(114),b=n(2);function p(e){return c.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),c.createElement("path",{d:"M322.342 0c-104.562 0-189.63 85.233-189.63 190 0 36.143 10.128 69.958 27.684 98.754C60.874 367.13 49.879 378.143 46.17 381.857l-27.662 27.716c-23.349 23.395-23.349 61.459 0 84.854 11.674 11.696 27.01 17.545 42.343 17.545 15.334 0 30.67-5.849 42.343-17.545l27.662-27.716c3.687-3.694 14.71-14.741 92.469-114.733C252.164 369.741 286.078 380 322.342 380c28.493 0 55.893-6.181 81.44-18.371 9.954-4.749 14.18-16.684 9.44-26.656-4.74-9.973-16.653-14.21-26.604-9.457C366.474 335.127 344.849 340 322.342 340c-82.548 0-149.707-67.29-149.707-150S239.794 40 322.342 40c82.55 0 149.708 67.29 149.708 150 0 27.091-7.279 53.631-21.05 76.75-5.65 9.484-2.557 21.763 6.91 27.424 9.467 5.661 21.72 2.561 27.37-6.924 17.463-29.315 26.693-62.943 26.693-97.25 0-104.767-85.069-190-189.63-190zM102.63 438.426l-27.662 27.716c-7.783 7.799-20.446 7.799-28.23 0-7.782-7.798-7.782-20.485 0-28.283l27.663-27.716c4.946-4.956 25.989-23.249 110.264-89.625a191.924 191.924 0 007.024 7.064c-66.028 84.902-84.157 105.932-89.06 110.844zm320.465-292.18c4.388 10.133-.253 21.911-10.366 26.309a19.86 19.86 0 01-7.936 1.657c-7.713 0-15.055-4.504-18.32-12.044C375.377 136.552 350.205 120 322.342 120c-11.025 0-19.962-8.954-19.962-20s8.937-20 19.961-20c43.777 0 83.325 26.003 100.753 66.246z"}))}n.p;function f(e){return c.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),c.createElement("path",{d:"M244 492c0 11.047-8.953 20-20 20H100c-44.113 0-80-35.887-80-80V210c0-11.047 8.953-20 20-20s20 8.953 20 20v222c0 22.055 17.945 40 40 40h124c11.047 0 20 8.953 20 20zM512 60v60c0 11.047-8.953 20-20 20v147c0 11.047-8.953 20-20 20s-20-8.953-20-20V140H20c-11.047 0-20-8.953-20-20V60C0 26.918 26.914 0 60 0h392c33.086 0 60 26.918 60 60zM40 100h432V60c0-11.027-8.973-20-20-20H60c-11.027 0-20 8.973-20 20v40zm260 120c11.047 0 20-8.953 20-20s-8.953-20-20-20h-90c-11.047 0-20 8.953-20 20s8.953 20 20 20h90zm208.363 183.504a19.986 19.986 0 010 22.996c-.703 1-3.11 4.41-4.61 6.297-6.698 8.426-22.378 28.148-44.194 45.558C431.586 500.68 402.8 512 374 512c-28.8 0-57.586-11.32-85.559-33.645-21.816-17.41-37.496-37.136-44.191-45.558-1.496-1.883-3.91-5.297-4.613-6.297a20 20 0 010-22.996c.703-1.004 3.117-4.418 4.617-6.305 6.691-8.418 22.371-28.14 44.187-45.554C316.414 329.32 345.2 318 374 318c28.8 0 57.586 11.32 85.559 33.645 21.816 17.41 37.496 37.136 44.191 45.558 1.5 1.887 3.91 5.297 4.613 6.3zM466.645 415c-31.801-37.832-62.938-57-92.645-57-29.707 0-60.844 19.168-92.64 57 31.796 37.832 62.937 57 92.64 57 29.703 0 60.844-19.164 92.645-57zM375 377c-20.988 0-38 17.012-38 38s17.012 38 38 38 38-17.012 38-38-17.012-38-38-38z"}))}n.p;function g(e){return c.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),c.createElement("path",{d:"M492 352c11.046 0 20-8.954 20-20V80c0-44.112-35.888-80-80-80H80C35.888 0 0 35.888 0 80v352c0 44.112 35.888 80 80 80h352c44.112 0 80-35.888 80-80 0-11.046-8.954-20-20-20s-20 8.954-20 20c0 22.056-17.944 40-40 40h-76v-78h36c11.046 0 20-8.954 20-20s-8.954-20-20-20h-36v-78h116v56c0 11.046 8.954 20 20 20zM156 472H80c-22.056 0-40-17.944-40-40v-38h116v78zm0-118H40v-78h116v78zm0-118H40v-78h116v78zm0-118H40V80c0-22.056 17.944-40 40-40h76v78zm160 354H196v-78h120v78zm0-118H196v-78h120v78zm0-118H196v-78h120v78zm0-118H196V40h120v78zm40-78h76c22.056 0 40 17.944 40 40v38H356V40zm0 196v-78h116v78H356z"}))}n.p;var j=n(7),O=n(29),v=n(53),w=n(31);const y="wpeform-data-table",x=j.f.header.withConfig({displayName:"styled__DataHeader",componentId:"sc-ugqkdl-0"})(["margin:0 0 "," 0;border-radius:",";margin:0 0 "," 0;background-color:",";box-shadow:",";padding:"," 0;display:flex;flex-flow:row wrap;max-width:100%;.","__row-bottom,.","__row-top{flex:0 0 100%;display:flex;flex-flow:row nowrap;align-items:center;max-width:100%;overflow-x:auto;padding:"," ",";.","__header-search{flex:1 1 auto;max-width:400px;}}.","__row-top{.","__header-bulk-actions{margin-right:16px;}}.","__header-cb{flex:0 0 auto;}.","__header-title{padding:0 ",";font-weight:700;font-size:",";color:",";flex:0 1 auto;text-transform:uppercase;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:200px;}.","__header-controls{margin-left:auto;display:flex;flex-flow:row nowrap;flex:0 0 auto;align-items:center;> *{margin-left:4px;}}.","__views{.ant-btn{font-size:14px;}}"],(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>Object(b.n)(e.theme.gutter/2)),(e=>e.theme.appBackgroundColor),(e=>e.theme.boxShadowElevationOne),(e=>Object(b.n)(e.theme.gutter/2)),y,y,(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.gutter)),y,y,y,y,y,(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.fz.base)),(e=>e.theme.headingColor),y,y),C=j.f.label.withConfig({displayName:"styled__SplitMenuItem",componentId:"sc-ugqkdl-1"})(["padding:8px 12px;display:flex;align-items:center;color:",";font-size:",";font-weight:",";text-transform:uppercase;cursor:pointer;background-color:transparent;transition:background-color ",",color ",";&:hover{background-color:",";}.ant-checkbox-wrapper,.ant-radio-wrapper{margin-right:",";display:inline-flex;align-items:center;justify-content:center;.ant-radio,.ant-checkbox{top:0;}}"],(e=>e.selected?e.theme.textColor:e.theme.textColorSecondary),(e=>Object(b.n)(e.theme.fz.small2)),(e=>e.selected?700:600),(e=>e.theme.transition),(e=>e.theme.transition),(e=>e.theme.backgroundHover),(e=>Object(b.n)(e.theme.gutter/2))),_=j.f.div.withConfig({displayName:"styled__SplitMenu",componentId:"sc-ugqkdl-2"})(["width:300px;display:flex;flex-flow:row nowrap;align-items:stretch;border-radius:",";background-color:",";box-shadow:",";overflow:hidden;"],(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>e.theme.appBackgroundColor),(e=>e.theme.boxShadowBase)),k=j.f.div.withConfig({displayName:"styled__SplitMenuColumn",componentId:"sc-ugqkdl-3"})(["width:150px;flex:1 0 150px;&:last-of-type{border-left:1px solid ",";}"],(e=>e.theme.borderColorSplit)),S=j.f.div.withConfig({displayName:"styled__FilterMenu",componentId:"sc-ugqkdl-4"})(["width:250px;padding:",";border-radius:",";background-color:",";box-shadow:",";.ant-select{width:100%;}"],(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>e.theme.appBackgroundColor),(e=>e.theme.boxShadowBase)),E=j.f.div.withConfig({displayName:"styled__FilterMenuItem",componentId:"sc-ugqkdl-5"})(["margin:0 0 "," 0;&:last-of-type{margin-bottom:0;}"],(e=>Object(b.n)(e.theme.gutter/4))),I=j.f.ul.withConfig({displayName:"styled__DataList",componentId:"sc-ugqkdl-6"})(["list-style:none;margin:0;padding:0;"]),T=j.f.div.withConfig({displayName:"styled__DataListItemInner",componentId:"sc-ugqkdl-7"})(["margin:0;padding:",";border-radius:",";display:flex;flex-flow:row nowrap;align-items:stretch;justify-content:flex-start;position:relative;&::after{border:12px solid ",";content:'';position:absolute;bottom:-1px;right:-1px;display:block;transition:",";}"],(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>Object(O.e)(1,e.theme.primaryColor)),(e=>Object(b.f)(["border-color"],e.theme.transition))),F=Object(j.f)(v.animated.li).withConfig({displayName:"styled__DataListItem",componentId:"sc-ugqkdl-8"})(["list-style:none;overflow:hidden;margin:0 0 "," 0;background-color:",";padding:0;will-change:opacity,transform,max-height,box-shadow,border-color;border-radius:",";box-shadow:",";border:1px solid ",";&:last-of-type{margin-bottom:0;}transition:",";&:hover{box-shadow:",";}&.is-selected{box-shadow:",";}&:focus,&.focused{outline:none;border-color:",";","{position:relative;outline:none;z-index:1;&::after{border-right-color:",";border-bottom-color:",";}}}&.is-header{box-shadow:",";&:hover{box-shadow:",";}}"],(e=>Object(b.n)(e.theme.gutter)),(e=>e.theme.appBackgroundColor),(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>e.theme.boxShadowElevationOne),(e=>Object(O.e)(1,e.theme.primaryColor)),(e=>Object(b.e)(["box-shadow","border-color"],e.theme.transition)),(e=>e.theme.boxShadow1dp),(e=>e.theme.boxShadow2dp),(e=>Object(O.e)(0,e.theme.primaryColor)),T,(e=>Object(O.e)(0,e.theme.primaryColor)),(e=>Object(O.e)(0,e.theme.primaryColor)),(e=>e.theme.boxShadowElevationOne),(e=>e.theme.boxShadowElevationOne)),P=j.f.div.withConfig({displayName:"styled__DataListItemCb",componentId:"sc-ugqkdl-9"})(["flex:0 0 auto;margin:0 "," 0 0;.ant-skeleton-avatar{height:20px;width:20px;border-radius:",";}"],(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.borderRadiusBase))),M=j.f.div.withConfig({displayName:"styled__DataListItemContent",componentId:"sc-ugqkdl-10"})(["flex:0 0 auto;width:calc(100% - 30px);.ant-skeleton-content{.ant-skeleton-title{margin:0 0 "," 0;height:",";}.ant-skeleton-paragraph{margin:0;}}"],(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(1.5*e.theme.fz.base))),B=j.f.footer.withConfig({displayName:"styled__DataFooter",componentId:"sc-ugqkdl-11"})(["padding:"," ",";margin:"," 0 0 0;border-radius:",";background-color:",";box-shadow:",";text-align:right;"],(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>e.theme.appBackgroundColor),(e=>e.theme.boxShadowElevationOne)),L=j.f.aside.withConfig({displayName:"styled__PreviewContainer",componentId:"sc-ugqkdl-12"})(["flex:0 0 calc(100% - ",");width:calc(100% - ",");padding:0;margin-left:",";"],(e=>Object(b.n)(400+e.theme.gutter)),(e=>Object(b.n)(400+e.theme.gutter)),(e=>Object(b.n)(e.theme.gutter))),N=j.f.div.withConfig({displayName:"styled__PreviewStickContainer",componentId:"sc-ugqkdl-13"})(["box-shadow:",";border-radius:",";background-color:",";position:sticky;top:",";"],(e=>e.theme.boxShadowElevationOne),(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>e.theme.appBackgroundColor),(e=>Object(b.n)(e.theme.gutter+h.f[2].navbarHeight))),R=j.f.div.withConfig({displayName:"styled__PreviewContent",componentId:"sc-ugqkdl-14"})(["height:calc( 100vh - "," );overflow-y:auto;",";padding:",";padding-bottom:270px;"],(e=>Object(b.n)(2*e.theme.gutter+h.f[2].navbarHeight+(e.hasToolbar?53:0))),w.w,(e=>e.hasPadding?Object(b.n)(e.theme.gutter):0)),A=j.f.div.withConfig({displayName:"styled__PreviewToolbar",componentId:"sc-ugqkdl-15"})(["height:",";border-bottom:1px solid ",";padding:"," ",";display:flex;flex-flow:row nowrap;align-items:center;justify-content:center;.to-left,.to-right{flex:0 0 auto;}.to-left{h4.heading{display:inline-block;padding:"," ",";background-color:",";color:",";font-weight:bold;font-size:",";border-radius:",";margin:0 "," 0 0;text-transform:uppercase;font-family:",";code{color:",";text-transform:none;}}}.to-right{margin:0 0 0 auto;padding:0 0 0 ",";}"],(e=>Object(b.n)(e.theme.gutter+33)),(e=>e.theme.borderColorSplit),(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.gutter/4)),(e=>Object(b.n)(e.theme.gutter)),(e=>e.theme.backgroundShade),(e=>e.theme.headingColor),(e=>Object(b.n)(e.theme.fz.small2)),(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>Object(b.n)(e.theme.gutter/2)),(e=>e.theme.fontFamilyMono),(e=>e.theme.errorColor),(e=>Object(b.n)(e.theme.gutter/2))),D=j.f.div.withConfig({displayName:"styled__PreviewEmptyPlaceholder",componentId:"sc-ugqkdl-16"})(["padding:50px 0;max-width:300px;margin:0 auto;"]),z=j.f.section.withConfig({displayName:"styled__DataTableColumns",componentId:"sc-ugqkdl-17"})(["display:flex;flex-flow:row nowrap;align-items:stretch;"]),H=j.f.div.withConfig({displayName:"styled__PreviewHeader",componentId:"sc-ugqkdl-18"})(["display:flex;flex-flow:row nowrap;width:100%;align-items:flex-start;justify-content:flex-start;max-width:100%;"]),V=j.f.h3.withConfig({displayName:"styled__PreviewTitle",componentId:"sc-ugqkdl-19"})(["",";margin:0;padding:0 "," 0 0;font-size:",";font-weight:700;color:",";flex:0 1 auto;.ant-skeleton-content{width:150px;.ant-skeleton-title{margin:0;}}"],b.m,(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.fz.base)),(e=>e.theme.headingColor)),$=j.f.div.withConfig({displayName:"styled__PreviewMeta",componentId:"sc-ugqkdl-20"})(["margin:0 0 0 auto;padding:0;font-size:",";font-weight:400;color:",";flex:0 0 auto;line-height:",";.ant-skeleton-content{.ant-skeleton-title{margin:0;}}"],(e=>Object(b.n)(e.theme.fz.small1)),(e=>e.theme.textColorSecondary),(e=>Object(b.n)(1.5715*e.theme.fz.base))),q=j.f.div.withConfig({displayName:"styled__PreviewData",componentId:"sc-ugqkdl-21"})(["margin:"," 0 0 0;font-size:",";color:",";p{font-size:",";line-height:1.5;}a,button{",";color:",";font-weight:600;&:hover{text-decoration:underline;}}em{font-style:italic;color:",";}strong{font-weight:600;color:",";border-bottom:2px dashed ",";}code{color:",";font-family:",";}p{margin:0 0 "," 0;&:last-child{margin-bottom:0;}}.user-input{word-break:break-all;hyphens:auto;}"],(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.fz.base)),(e=>e.theme.textColor),(e=>Object(b.n)(e.theme.fz.base)),b.a,(e=>e.theme.primaryDarkColor),(e=>e.theme.textColorSecondary),(e=>e.theme.headingColor),(e=>e.theme.borderColorBase),(e=>e.theme.errorColor),(e=>e.theme.fontFamilyMono),(e=>Object(b.n)(e.theme.gutter/2))),U=j.f.div.withConfig({displayName:"styled__PreviewActions",componentId:"sc-ugqkdl-22"})(["margin:"," "," 0;.ant-btn,.ant-skeleton{margin:",";}"],(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.gutter/-4)),(e=>Object(b.n)(e.theme.gutter/4))),W=j.f.div.withConfig({displayName:"styled__Preview",componentId:"sc-ugqkdl-23"})(["width:100%;&.is-header{","{text-transform:uppercase;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}","{.ant-pagination-simple .ant-pagination-simple-pager input{width:40px;text-align:right;}}}"],V,$),K=j.f.main.withConfig({displayName:"styled__DataContainer",componentId:"sc-ugqkdl-24"})(["flex:1 0 ",";max-width:100%;","{.","__row-top{flex-basis:",";flex-grow:",";.","__filters-sorter{margin-left:",";}}.","__row-bottom{margin-left:",";flex-basis:",";.","__view-mode{margin-right:",";}.","__header-pagination{","{padding-right:",";padding-left:",";min-width:120px;.ant-skeleton-content{width:80px;.ant-skeleton-title{margin:0;width:100% !important;}.ant-skeleton-paragraph{display:none;}}}}}}"],(e=>"table"===e.displayMode?"100%":"400px"),x,y,(e=>"table"===e.displayMode?"540px":"100%"),(e=>"table"===e.displayMode?1:0),y,(e=>"table"===e.displayMode?"12px":"auto"),y,(e=>"table"===e.displayMode?"auto":"0px"),(e=>"table"===e.displayMode?"auto":"100%"),y,(e=>"table"===e.displayMode?"16px":"0"),y,V,(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.gutter/2))),G=j.f.span.withConfig({displayName:"styled__DDBadge",componentId:"sc-ugqkdl-25"})(["display:inline-flex;padding:0.4em 0.5em;margin:0 0.6em 0 0;font-size:10px;line-height:1;font-weight:bold;min-width:3em;align-items:center;justify-content:center;font-variant-numeric:tabular-nums;background-color:",";border-radius:4em;color:",";position:relative;top:-2px;"],(e=>e.theme.borderColorSplit),(e=>e.theme.headingColor)),Y=j.f.div.withConfig({displayName:"styled__TableContainer",componentId:"sc-ugqkdl-26"})(["margin:"," 0 0 0;padding:",";background-color:",";border-radius:",";box-shadow:",";"],(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.gutter)),(e=>e.theme.appBackgroundColor),(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>e.theme.boxShadowElevationOne)),Q=j.f.div.withConfig({displayName:"styled__TableScroller",componentId:"sc-ugqkdl-27"})(["max-width:100%;min-height:300px;border:1px solid ",";border-radius:",";",";"],(e=>e.theme.borderColorSplit),(e=>Object(b.n)(e.theme.borderRadiusBase)),b.q),X=j.f.table.withConfig({displayName:"styled__Table",componentId:"sc-ugqkdl-28"})(["width:100%;border-collapse:separate;border-spacing:0px;border:0 none;font-size:",";vertical-align:top;table-layout:fixed;"],(e=>Object(b.n)(e.theme.fz.small1))),Z=Object(b.d)(y,"table-cell"),J=Object(j.f)(v.animated.tr).withConfig({displayName:"styled__Tr",componentId:"sc-ugqkdl-29"})(["background-color:",";.","--cb,.","--actionButtons{background-color:",";}&:nth-child(2n){background-color:",";.","--cb,.","--actionButtons{background-color:",";}}&:hover{background-color:",";.","--cb,.","--actionButtons{background-color:",";}}transition:",";"],(e=>e.theme.appBackgroundColor),Z,Z,(e=>e.theme.appBackgroundColor),(e=>e.theme.backgroundControl),Z,Z,(e=>e.theme.backgroundControl),(e=>e.theme.backgroundHover),Z,Z,(e=>e.theme.backgroundHover),(e=>Object(b.f)(["background-color"],e.theme.transitionControl))),ee=Object(j.e)(["width:200px;vertical-align:baseline;text-align:left;.ant-skeleton-title{margin:0;}.ant-skeleton-content .ant-skeleton-title{height:",";display:inline-block;vertical-align:middle;}.ant-skeleton-paragraph,.ant-skeleton-title + .ant-skeleton-paragraph{margin:0;display:none;}&.","--cb{position:sticky;left:0;z-index:100;border-right:1px solid ",";box-shadow:1px 0 2px 0 rgb(0 0 0 / 1%),2px 0 3px 0 rgb(0 0 0 / 6%);}&.","--actionButtons{position:sticky;right:0;z-index:100;border-left:1px solid ",";box-shadow:-1px 0 2px 0 rgb(0 0 0 / 1%),-2px 0 3px 0 rgb(0 0 0 / 6%);}transition:",";&:not(.","--actionButtons){",";a{color:",";text-decoration:underline;&:hover{text-decoration:none;}}button{text-align:left;background:transparent;border:0 none;outline:none;padding:0;cursor:pointer;display:inline;color:",";font-weight:400;font-style:normal;text-decoration:underline;&:hover{text-decoration:none;}}}"],(e=>Object(b.n)(1.5*e.theme.fz.base)),Z,(e=>e.theme.borderColorSplit),Z,(e=>e.theme.borderColorSplit),(e=>Object(b.f)(["background-color"],e.theme.transitionControl)),Z,b.m,(e=>e.theme.primaryDarkColor),(e=>e.theme.primaryDarkColor)),te=j.f.th.withConfig({displayName:"styled__Th",componentId:"sc-ugqkdl-30"})(["",";padding:"," ",";font-weight:bold;color:",";border-bottom:1px solid ",";&.","--number{text-align:right;font-variant-numeric:tabular-nums;width:8em;}&.","--cb{padding:"," ",";width:",";.ant-skeleton{height:20px;width:20px;display:block;margin:0;}.ant-skeleton-avatar{height:20px;width:20px;border-radius:",";}}&.","--actionButtons{text-align:right;width:300px;}&.","--primary{width:300px;",";}"],ee,(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.gutter)),(e=>e.theme.headingColor),(e=>e.theme.borderColorSplit),Z,Z,(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(.75*e.theme.gutter)),(e=>Object(b.n)(1.5*e.theme.gutter+20)),(e=>Object(b.n)(e.theme.borderRadiusBase)),Z,Z,b.m),ne=j.f.td.withConfig({displayName:"styled__Td",componentId:"sc-ugqkdl-31"})(["",";padding:"," ",";color:",";border-bottom:1px solid ",";&.","--number{text-align:right;font-variant-numeric:tabular-nums;width:8em;}&.","--actionButtons{width:300px;text-align:right;.ant-btn-group{text-align:left;}}"],ee,(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.gutter)),(e=>e.theme.textColor),(e=>e.theme.borderColorSplit),Z,Z),oe=j.f.thead.withConfig({displayName:"styled__Thead",componentId:"sc-ugqkdl-32"})(["","{","{position:sticky;top:0;z-index:100;background-color:",";font-size:",";color:",";&:not(.","--element){text-transform:uppercase;}vertical-align:middle;&.","--cb{z-index:101;}&.","--actionButtons{z-index:101;}}background-color:",";.","--cb,.","--actionButtons{background-color:",";}}"],J,te,(e=>e.theme.backgroundShade),(e=>Object(b.n)(e.theme.fz.small2)),(e=>e.theme.textColorSecondary),Z,Z,Z,(e=>e.theme.backgroundShade),Z,Z,(e=>e.theme.backgroundShade)),ie=j.f.tbody.withConfig({displayName:"styled__Tbody",componentId:"sc-ugqkdl-33"})([""]),re=j.f.div.withConfig({displayName:"styled__UserInput",componentId:"sc-ugqkdl-34"})(["",";",";"],b.v,b.m),se=j.f.span.withConfig({displayName:"styled__MutedText",componentId:"sc-ugqkdl-35"})(["color:",";opacity:0.75;font-weight:400;font-size:",";"],(e=>e.theme.textColorSecondary),(e=>Object(b.n)(e.theme.fz.small1))),ae=j.f.div.withConfig({displayName:"styled__DataTableContainer",componentId:"sc-ugqkdl-36"})(["background-color:",";border-radius:",";&:fullscreen{","{height:calc( 100vh - "," );}",",",",","{border-radius:0;}}"],(e=>e.theme.backgroundShade),(e=>Object(b.n)(e.theme.borderRadiusBase)),Q,(e=>Object(b.n)(4*e.theme.gutter+72+52)),x,Y,B),ce=j.f.div.withConfig({displayName:"styled__AntMenuItem",componentId:"sc-ugqkdl-37"})(["padding:"," 0;display:flex;flex-flow:row nowrap;align-items:center;justify-content:flex-start;font-size:",";text-transform:uppercase;> .anticon{font-size:",";color:",";margin:0 "," 0 0;}> .ant-btn{display:block;background-color:transparent;border:0 none;margin:0;padding:0;color:inherit;height:22px;width:100%;transition:none;text-align:left;}"],(e=>Object(b.n)(e.theme.gutter/6)),(e=>Object(b.n)(e.theme.fz.small1)),(e=>Object(b.n)(e.theme.fz.small1)),(e=>e.theme.textColorSecondary),(e=>Object(b.n)(e.theme.gutter/2)));var le=n(453),de=n(284),ue=n(1173),me=n(83),he=n(244),be=n(439),pe=n(36),fe=n(21);n(66);function ge(e,t){if("SET_CURRENT_PAGE"===t.type)return{...e,selectedRows:[],currentPage:t.payload.currentPage,previewItemId:null,canTrailItems:!0};if("SET_ITEMS_PER_PAGE"===t.type)return{...e,selectedRows:[],currentPage:1,itemsPerPage:t.payload.itemsPerPage,previewItemId:null,canTrailItems:!0};if("SET_LAST_CLICKED_ITEM_ID"===t.type)return{...e,lastClickedItemId:t.payload.lastClickedItemId};if("SET_PREVIEW_ITEM_ID"===t.type)return{...e,previewItemId:t.payload.previewItemId};if("SET_VIEW"===t.type)return{...e,selectedRows:[],currentPage:1,currentView:t.payload.currentView,filters:t.payload.filters,previewItemId:null,canTrailItems:!0};if("SET_ORDERBY"===t.type)return{...e,selectedRows:[],orderBy:t.payload.orderBy,previewItemId:null,canTrailItems:!0};if("SET_ORDERDIR"===t.type)return{...e,selectedRows:[],orderDir:t.payload.orderDir,previewItemId:null,canTrailItems:!0};if("SET_SEARCH"===t.type)return{...e,selectedRows:[],currentPage:1,search:t.payload.search,previewItemId:null,canTrailItems:!0};if("SET_SELECTED_ROWS"===t.type){const n={...e};return t.payload.selectedRows&&(n.selectedRows=t.payload.selectedRows),t.payload.lastClickedItemId&&(n.lastClickedItemId=t.payload.lastClickedItemId),n}return"SET_FILTERS"===t.type?{...e,selectedRows:[],currentPage:1,filters:t.payload.filters,previewItemId:null,canTrailItems:!0}:"SET_CAN_TRAIL_ITEMS"===t.type?{...e,canTrailItems:t.payload.canTrailItems}:"SET_DISPLAY_MODE"===t.type?{...e,displayMode:t.payload.displayMode}:"SET_STATE"===t.type?t.payload:e}function je(e,t){const n=Object(c.useReducer)(ge,t,e),o=Object(a.a)(n,2);return[o[0],o[1]]}function Oe(e,t){"string"==typeof e.currentView&&""!==e.currentView&&(t.currentView=e.currentView),t.currentPage=Object(pe.d)(e.currentPage,t.currentPage),t.itemsPerPage=e.itemsPerPage?Object(pe.d)(e.itemsPerPage,10):t.itemsPerPage,t.search=e.search?e.search:t.search,t.orderBy=e.orderBy?e.orderBy.toString():t.orderBy,t.orderDir=e.orderDir?e.orderDir.toString():t.orderDir,t.previewItemId=e.previewItemId?e.previewItemId.toString():t.previewItemId,t.displayMode=e.displayMode&&"table"===e.displayMode?"table":"preview"===e.displayMode?"preview":t.displayMode,t.filters&&null!=t.filters&&Object.keys(t.filters).forEach((n=>{var o;t.filters[n]=e[n]?null===(o=e[n])||void 0===o?void 0:o.toString():t.filters[n]}))}function ve(e){const t=e.initialFilters,n=e.initialOrderBy,o=e.initialOrderDir,i=e.initialView,r=e.initialDisplayMode,s=void 0===r?"preview":r;return{currentPage:1,currentView:i,filters:Object(fe.c)(t),itemsPerPage:20,lastClickedItemId:null,orderBy:n,orderDir:o,previewItemId:null,search:"",selectedRows:[],canTrailItems:!0,displayMode:s}}function we(e){const t=e.currentView,n=e.currentPage,o=e.search,i=e.orderBy,r=e.orderDir,s=e.itemsPerPage,a=e.previewItemId,c={currentView:t,currentPage:n,search:o,orderBy:i,orderDir:r,itemsPerPage:s,previewItemId:null!=a?a:"",displayMode:e.displayMode};return null!=e.filters&&Object.keys(e.filters).forEach((t=>{var n;c[t]=null!==(n=e.filters[t])&&void 0!==n?n:""})),c}const ye=Object(c.createContext)((()=>{}));const xe="wpeform-datatable-items-per-page",Ce="wpeform-datatable-display-mode";function _e(e){const t=e.location,n=e.initialDisplayMode,o=void 0===n?"preview":n,i=ve(e);let r=20;try{r=Object(pe.d)(window.localStorage.getItem(xe),20)}catch(e){}i.itemsPerPage=r;let s,a=o;try{a=window.localStorage.getItem(Ce),["preview","table"].includes(a)||(a=o)}catch(e){}i.displayMode=a;try{s=he.parse(t.search)}catch{s={}}return Oe(s,i),i}function ke(e){const t=Object(me.k)(),n=je(_e,{...e,location:t.location}),o=Object(a.a)(n,2),i=o[0],r=o[1];return Object(c.useEffect)((()=>{const e=i.itemsPerPage,n=i.displayMode,o=we(i),r=`?${he.stringify(o)}`;t.location.search!==r&&t.replace({search:r}),window.localStorage.setItem(xe,e.toString()),window.localStorage.setItem(Ce,n)}),[i,t]),[i,r]}const Se=Object(c.createContext)([]);function Ee(){return Object(c.useContext)(Se)}const Ie=Object(c.createContext)(void 0);function Te(){return Object(c.useContext)(Ie)}function Fe(e){e.forEach((e=>{be.a.evict({id:"ROOT_QUERY",fieldName:e}),be.a.gc()}))}var Pe=n(1);const Me=j.f.div.withConfig({displayName:"MutationButton__PopConfirmContainer",componentId:"sc-ppnfrf-0"})(["max-width:300px;"]);var Be=n(198);var Le=n(444),Ne=n(359),Re=n(50),Ae=n(10),De=n.n(Ae);function ze(e,t,n,o="preview"){const i=Object(j.h)();return Object(v.useTransition)(e,{keys:t,from:{opacity:0,transform:"preview"===o?"translate(0px, -30px)":"translate(-20px, 0x)",maxHeight:"400px"},enter:{opacity:1,transform:"translate(0px, 0px)",maxHeight:"400px"},leave:{opacity:0,transform:"translate(20px, 0px)",maxHeight:"0px"},config:{...i.springConfigGeneral,clamp:!0},trail:n.canTrailItems?125:void 0})}function He(e){const t=e.items,n=e.state,o=e.dispatch,i=e.generateItemRow,r=e.getItemId,s=e.handleCb,a=ze(t,r,n);return Object(Pe.jsx)(Pe.Fragment,{children:a(((e,t)=>{var a;const c=r(t),l=n.selectedRows.includes(c);return Object(Pe.jsx)(F,{style:{opacity:e.opacity,transform:e.transform,maxHeight:null===(a=e.maxHeight)||void 0===a?void 0:a.to((e=>"400px"===e?"none":e))},tabIndex:0,role:"button",className:De()({focused:n.previewItemId===c,"is-selected":l}),onClick:e=>{o({type:"SET_PREVIEW_ITEM_ID",payload:{previewItemId:c}})},onKeyDown:e=>{"Enter"!==e.code&&"Space"!==e.code||o({type:"SET_PREVIEW_ITEM_ID",payload:{previewItemId:c}})},children:Object(Pe.jsxs)(T,{children:[Object(Pe.jsx)(P,{children:Object(Pe.jsx)(Le.a,{checked:l,value:c,onChange:s,id:null!=c?c:void 0,onClick:e=>{e.stopPropagation()}})}),Object(Pe.jsx)(M,{children:i(t)})]})})}))})}function Ve(e){const t=e.items,n=e.state,i=e.handleCb,r=e.getItemId,s=e.renderTableCell,a=e.tableModeColumns,c=e.masterCb,l=ze(t,r,n,"table");if(!s)throw new Error("No table cells renderer.");if(!a)throw new Error("No table cells to render.");return Object(Pe.jsx)(Y,{children:Object(Pe.jsx)(Q,{children:Object(Pe.jsxs)(X,{children:[Object(Pe.jsx)(oe,{children:Object(Pe.jsxs)(J,{children:[Object(Pe.jsx)(te,{className:Object(b.c)(Z,{cb:!0}),children:c}),a.map((({value:e,label:t,type:n="text",width:o,title:i},r)=>Object(Pe.jsx)(te,{className:Object(b.c)(Z,{[n]:!0,primary:0===r}),style:{width:o?Object(b.n)(o):void 0},title:i,children:t},e)))]})}),Object(Pe.jsx)(ie,{children:l(((e,t)=>{var c;const l=r(t),d=n.selectedRows.includes(l);return Object(Pe.jsxs)(J,{style:{opacity:e.opacity,transform:e.transform,maxHeight:null===(c=e.maxHeight)||void 0===c?void 0:c.to((e=>"400px"===e?"none":e))},children:[Object(Pe.jsx)(te,{className:Object(b.c)(Z,{cb:!0}),children:Object(Pe.jsx)(Le.a,{checked:d,value:l,onChange:i,id:null!=l?l:void 0})}),a.map(((e,i)=>{let r=s(t,e,n.currentView);const a=e.type,c=void 0===a?"text":a,l=e.value,d=e.width,u=Object(b.c)(Z,{[c]:!0,primary:0===i});return"actionButtons"===c&&(r=Object(Pe.jsx)(o.a.Group,{children:r})),0===i?Object(Pe.jsx)(te,{className:u,style:{width:d?Object(b.n)(d):void 0},children:r},l):Object(Pe.jsx)(ne,{className:u,style:{width:d?Object(b.n)(d):void 0},children:r},l)}))]})}))})]})})})}var $e=n(243);function qe(){return Object(Pe.jsx)(F,{children:Object(Pe.jsxs)(T,{children:[Object(Pe.jsx)(P,{children:Object(Pe.jsx)($e.a.Avatar,{shape:"square",size:"small",active:!0})}),Object(Pe.jsx)(M,{children:Object(Pe.jsxs)(W,{children:[Object(Pe.jsxs)(H,{children:[Object(Pe.jsx)(V,{children:Object(Pe.jsx)($e.a,{paragraph:{rows:0},title:{width:"90%"},active:!0})}),Object(Pe.jsx)($,{children:Object(Pe.jsx)($e.a,{paragraph:{rows:0},title:{width:"58px"},active:!0})})]}),Object(Pe.jsx)(q,{children:Object(Pe.jsx)($e.a,{paragraph:{rows:2},title:!1,active:!0})}),Object(Pe.jsxs)(U,{children:[Object(Pe.jsx)($e.a.Button,{size:"small",active:!0,style:{width:"80px"}}),Object(Pe.jsx)($e.a.Button,{size:"small",active:!0,style:{width:"50px"}}),Object(Pe.jsx)($e.a.Button,{size:"small",active:!0,style:{width:"70px"}})]})]})})]})})}function Ue(e){const t=e.itemsPerPage;return Object(Pe.jsx)(Pe.Fragment,{children:Array.from({length:t}).map(((e,t)=>Object(Pe.jsx)(qe,{},t)))})}const We=Object(Pe.jsx)($e.a.Avatar,{shape:"square",size:"small",active:!0}),Ke=j.f.div.withConfig({displayName:"TableSkeleton__ActionButtonsContainer",componentId:"sc-fbatpy-0"})(["display:flex;flex-flow:row nowrap;align-items:center;justify-content:flex-end;> *{margin:0 2px;}"]);function Ge(e){const t=e.tableModeColumns;return Object(Pe.jsxs)(J,{children:[Object(Pe.jsx)(te,{className:Object(b.c)(Z,{cb:!0}),children:We}),t.map(((e,t)=>{const n=e.type,o=void 0===n?"text":n,i=e.value,r=e.width,s=Object(b.c)(Z,{[o]:!0,primary:0===t});let a=Object(Pe.jsx)($e.a,{paragraph:{rows:0},title:{width:r?Object(b.n)(r-40):"80px"},active:!0});return 0===t&&(a=Object(Pe.jsx)($e.a,{paragraph:{rows:0},title:{width:r?Object(b.n)(r-40):"220px"},active:!0})),"actionButtons"===o&&(a=Object(Pe.jsxs)(Ke,{children:[Object(Pe.jsx)($e.a.Button,{active:!0,size:"small",shape:"square"}),Object(Pe.jsx)($e.a.Button,{active:!0,size:"small",shape:"square"}),Object(Pe.jsx)($e.a.Button,{active:!0,size:"small",shape:"square"})]})),0===t?Object(Pe.jsx)(te,{className:s,style:{width:r?Object(b.n)(r):void 0},children:a},i):Object(Pe.jsx)(ne,{className:s,style:{width:r?Object(b.n)(r):void 0},children:a},i)}))]})}function Ye(e){const t=e.itemsPerPage,n=e.tableModeColumns;return Object(Pe.jsx)(Y,{children:Object(Pe.jsx)(Q,{children:Object(Pe.jsxs)(X,{children:[Object(Pe.jsx)(oe,{children:Object(Pe.jsxs)(J,{children:[Object(Pe.jsx)(te,{className:Object(b.c)(Z,{cb:!0}),children:We}),n.map((({value:e,label:t,type:n="text",width:o},i)=>Object(Pe.jsx)(te,{className:Object(b.c)(Z,{[n]:!0,primary:0===i}),style:{width:o?Object(b.n)(o):void 0},children:t},e)))]})}),Object(Pe.jsx)(ie,{children:Array.from({length:t}).map(((e,t)=>Object(Pe.jsx)(Ge,{tableModeColumns:n},t)))})]})})})}function Qe(e){var t;const n=e.masterCbId,o=e.items,r=e.loadingData,s=e.totalItems,a=e.itemNamePlural,c=e.itemNameSingular,l=e.state,d=e.dispatch,u=e.displayMode,m=Object(h.d)("desktopHd");return Object(Pe.jsxs)(Pe.Fragment,{children:["preview"===u||"table"===u&&m?r&&!o?Object(Pe.jsx)(V,{as:"div",children:Object(Pe.jsx)($e.a,{active:!0,paragraph:{rows:0}})}):Object(Pe.jsx)(V,{title:s>1||0===s?a:c,children:Object(Pe.jsx)("label",{htmlFor:n,children:0===(null==o?void 0:o.length)?Object(Pe.jsx)(Pe.Fragment,{children:"0 "}):Object(Pe.jsxs)(Pe.Fragment,{children:[1+(l.currentPage-1)*l.itemsPerPage,"-",(null!==(t=null==o?void 0:o.length)&&void 0!==t?t:0)+(l.currentPage-1)*l.itemsPerPage," ","/ ",s," "]})})}):null,Object(Pe.jsx)($,{children:Object(Pe.jsx)(i.a,{simple:!0,current:l.currentPage,onChange:e=>{d({type:"SET_CURRENT_PAGE",payload:{currentPage:e}})},total:s,pageSize:l.itemsPerPage})})]})}function Xe(e){const t=e.items,n=e.getItemId,o=e.state,i=e.dispatch,s=e.generateItemRow,l=e.totalItems,d=e.itemNameSingular,u=e.itemNamePlural,m=e.loadingData,h=e.emptyText,b=e.displayMode,p=e.renderTableCell,f=e.tableModeColumns,g=Object(c.useMemo)((()=>t?t.map((e=>n(e))):[]),[t,n]),j=o.lastClickedItemId,O=Object(c.useCallback)((e=>{e.target.checked?i({type:"SET_SELECTED_ROWS",payload:{selectedRows:g}}):i({type:"SET_SELECTED_ROWS",payload:{selectedRows:[]}})}),[i,g]),v=!!g.length&&g.every((e=>o.selectedRows.includes(e))),w=!!g.length&&g.some((e=>o.selectedRows.includes(e)))&&!v,y=Object(c.useCallback)((e=>{const t=e.target.value;let n=[...o.selectedRows];if(e.nativeEvent.shiftKey&&j&&g.includes(j)&&g.includes(t)){const o=g.findIndex((e=>e===j)),i=g.findIndex((e=>e===t)),r=Math.min(o,i),s=Math.max(o,i)+1,a=g.slice(r,s);e.target.checked?a.forEach((e=>{n.includes(e)||n.push(e)})):n=n.filter((e=>!a.includes(e)))}else e.target.checked&&!n.includes(t)?n.push(t):!e.target.checked&&n.includes(t)&&Object(Re.d)(n,t);i({type:"SET_SELECTED_ROWS",payload:{selectedRows:n,lastClickedItemId:t}})}),[o.selectedRows,i,g,j]),x=Object(c.useState)((()=>Object(Ne.a)())),C=Object(a.a)(x,1)[0],_=Object(Pe.jsx)(Le.a,{indeterminate:w,checked:v,onChange:O,id:C}),k=`${o.currentPage}${o.currentView}${JSON.stringify(o.filters)}${o.orderBy}${o.orderDir}${o.search}`;return Object(Pe.jsxs)(I,{as:"preview"===b?"ul":"div",children:["preview"===b?Object(Pe.jsx)(F,{className:"is-header",children:Object(Pe.jsxs)(T,{children:[Object(Pe.jsx)(P,{children:_}),Object(Pe.jsx)(M,{children:Object(Pe.jsx)(W,{className:"is-header",children:Object(Pe.jsx)(H,{children:Object(Pe.jsx)(Qe,{masterCbId:C,dispatch:i,itemNamePlural:u,itemNameSingular:d,items:t,loadingData:m,state:o,totalItems:l,displayMode:b})})})})]})}):null,m&&!t?"preview"===b?Object(Pe.jsx)(Ue,{itemsPerPage:o.itemsPerPage}):Object(Pe.jsx)(Ye,{itemsPerPage:o.itemsPerPage,tableModeColumns:f}):t&&t.length?"preview"===b?Object(Pe.jsx)(He,{items:t,getItemId:n,dispatch:i,generateItemRow:s,handleCb:y,state:o},k):Object(Pe.jsx)(Ve,{items:t,getItemId:n,handleCb:y,state:o,masterCb:_,renderTableCell:p,tableModeColumns:f},k):Object(Pe.jsx)(F,{children:Object(Pe.jsxs)(T,{children:[Object(Pe.jsx)(P,{}),Object(Pe.jsx)(M,{children:Object(Pe.jsx)(W,{children:Object(Pe.jsx)(q,{children:Object(Pe.jsx)(D,{children:Object(Pe.jsx)(r.a,{image:r.a.PRESENTED_IMAGE_SIMPLE,description:h})})})})})]})})]})}var Ze=n(57),Je=n(363),et=n(1122),tt=n(166),nt=n(239);function ot(e){return c.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),c.createElement("path",{d:"M215.116 511.916h-.405c-32.682-.216-60.292-28.608-60.292-62.001V190.96c0-23.558 13.344-44.39 34.826-54.365 21.373-9.926 45.754-6.813 63.796 8.095l127.324 94.817c8.859 6.598 10.693 19.127 4.096 27.986-6.597 8.859-19.127 10.694-27.986 4.096l-127.768-95.147a20.126 20.126 0 01-.959-.761c-9.12-7.701-18.881-4.094-21.655-2.806-2.738 1.272-11.673 6.334-11.673 18.086v258.955c0 12.886 10.833 21.937 20.555 22 4.097.028 8.888-.603 14.516-8.425l64.903-93.859a20.002 20.002 0 0116.433-8.625l106.576-.091c10.207-.526 16.529-8.203 18.851-14.672 1.499-4.174 2.961-12.112-4.09-18.383-8.254-7.34-8.995-19.981-1.655-28.235 7.341-8.255 19.982-8.995 28.236-1.655 17.46 15.526 23.267 39.204 15.155 61.793-8.64 24.059-30.35 40.206-55.31 41.139-.243.009-.486.014-.729.014l-96.525.082-59.042 85.384c-.058.084-.116.167-.176.25-11.821 16.546-28.067 25.283-47.002 25.283zm-36.865-399.494c9.619-5.43 13.015-17.629 7.584-27.249l-35-62c-5.43-9.618-17.628-13.015-27.249-7.584-9.619 5.43-13.015 17.629-7.584 27.249l35 62c3.676 6.512 10.455 10.171 17.435 10.171 3.33 0 6.707-.833 9.814-2.587zm-43.389 45.318c4.271-10.186-.523-21.907-10.709-26.178l-62-26c-10.184-4.271-21.906.523-26.178 10.709-4.271 10.186.523 21.907 10.709 26.178l62 26a19.926 19.926 0 007.726 1.562c7.817 0 15.241-4.611 18.452-12.271zm125.641-64.752l21-67C284.807 15.447 278.94 4.225 268.4.922c-10.542-3.305-21.763 2.562-25.066 13.103l-21 67c-3.304 10.541 2.563 21.763 13.103 25.066 1.991.624 4.006.921 5.988.921 8.509 0 16.398-5.475 19.078-14.024zm54.716 49.166l52-38c8.918-6.517 10.865-19.03 4.348-27.948s-19.03-10.864-27.948-4.348l-52 38c-8.918 6.517-10.865 19.03-4.348 27.948 3.917 5.36 9.998 8.201 16.164 8.201 4.094 0 8.226-1.253 11.784-3.853zM65.017 267.506l56-23c10.217-4.197 15.098-15.881 10.902-26.099-4.196-10.218-15.88-15.098-26.099-10.902l-56 23c-10.217 4.197-15.098 15.881-10.902 26.099 3.175 7.73 10.638 12.406 18.508 12.406a19.929 19.929 0 007.591-1.504z"}))}n.p;function it(e){const t=e.bulkActions,n=e.dispatch,i=e.isDoingBulk,r=0===e.state.selectedRows.length||i||0===t.length,s=Te(),a=Ee();return Object(Pe.jsx)("div",{className:Object(b.d)(y,"header-bulk-actions"),children:Object(Pe.jsx)(Je.a,{disabled:r,overlay:Object(Pe.jsx)(nt.a,{children:t.map((e=>Object(Pe.jsx)(nt.a.Item,{danger:e.danger,onClick:()=>{n({type:"SET_PREVIEW_ITEM_ID",payload:{previewItemId:null}}),n({type:"SET_CAN_TRAIL_ITEMS",payload:{canTrailItems:!1}}),e.onClick().then((()=>{n({type:"SET_SELECTED_ROWS",payload:{selectedRows:[]}}),s&&s(),Fe(a)})).catch((()=>{}))},children:e.title},e.id)))}),trigger:["click"],children:Object(Pe.jsxs)(o.a,{size:"small",type:r?"dashed":"default",disabled:i,className:Object(b.d)(y,"bulk-action"),children:[i?Object(Pe.jsx)(et.a,{indicator:Object(Pe.jsx)(tt.a,{style:{fontSize:"14px",marginRight:"8px"},spin:!0})}):Object(Pe.jsxs)(Pe.Fragment,{children:[Object(Pe.jsx)(l.b,{component:ot})," "]}),Object(d.__)("BULK ACTION","wp-eform")]})})})}var rt=n(456),st=n(176);function at(e){return c.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),c.createElement("path",{d:"M492 .103H20c-11.046 0-20 8.954-20 20 0 77.49 22.928 145.332 72.155 213.502 30.712 42.531 85.808 73.844 113.845 87.866v121.426a20.002 20.002 0 0011.2 17.96l100 49a19.995 19.995 0 0019.383-.989A20.002 20.002 0 00326 491.897v-82.425c0-11.046-8.954-20-20-20s-20 8.954-20 20v50.353l-60-29.4V308.897a20 20 0 00-11.65-18.173c-37.338-17.156-85.782-47.322-109.766-80.536C64.849 155.163 44.258 100.64 40.597 40.103h430.806c-3.661 60.536-24.252 115.06-63.987 170.085-25.348 35.103-73.046 65.879-109.072 80.807-10.204 4.229-15.049 15.928-10.82 26.133 4.228 10.204 15.927 15.049 26.133 10.82 38.221-15.838 94.204-50.049 126.188-94.343C489.072 165.435 512 97.593 512 20.103c0-11.046-8.954-20-20-20z"}))}n.p;function ct(e){return c.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),c.createElement("path",{d:"M366.996 512c-11.047 0-20-8.953-20-20V175.992h-85.992c-15.777 0-29.895-9.433-35.969-24.035-6.097-14.66-2.812-31.398 8.367-42.648l91.094-91.633C335.828 6.277 350.922 0 366.996 0s31.168 6.277 42.5 17.676l91.094 91.633c11.183 11.246 14.469 27.988 8.37 42.648-6.073 14.602-20.194 24.035-35.972 24.035H451c-11.047 0-20-8.953-20-20s8.953-20 20-20h19.71L381.13 45.88A19.797 19.797 0 00366.996 40a19.804 19.804 0 00-14.133 5.879l-89.582 90.113h83.715c22.059 0 40 17.946 40 40V492c0 11.043-8.953 20-20 20zm-222.008 0c-16.074 0-31.168-6.277-42.5-17.676l-91.093-91.633c-11.184-11.25-14.47-27.988-8.368-42.648 6.07-14.602 20.192-24.04 35.97-24.04h85.991V20c0-11.047 8.953-20 20-20s20 8.953 20 20v316.008c0 22.055-17.945 40-40 40H41.273l89.582 90.113A19.804 19.804 0 00144.988 472c5.344 0 10.364-2.09 14.133-5.879l89.582-90.113h-19.71c-11.048 0-20-8.953-20-20s8.952-20 20-20h21.987c15.778 0 29.895 9.433 35.97 24.035 6.097 14.66 2.816 31.402-8.368 42.648l-91.094 91.633C176.156 505.723 161.063 512 144.988 512z"}))}n.p;var lt=n(1067);function dt(e){const t=e.renderFilters,n=e.state,i=e.dispatch,r=e.orderBys,s=e.resetFilters,u=r.find((e=>e.id===n.orderBy)),m=Object(c.useState)(!1),h=Object(a.a)(m,2),p=h[0],f=h[1],g=Object(c.useState)(!1),j=Object(a.a)(g,2),O=j[0],v=j[1],w=!function(e,t){let n=!0;return Object.keys(t).forEach((o=>{e[o]!==t[o]&&(n=!1)})),n}(n.filters,s);return Object(Pe.jsxs)("div",{className:Object(b.d)(y,"header-controls",Object(b.d)(y,"filters-sorter")),children:[void 0!==t?Object(Pe.jsxs)(o.a.Group,{size:"small",children:[Object(Pe.jsx)(Je.a,{arrow:!0,visible:O,onVisibleChange:e=>v(e),overlay:Object(Pe.jsx)(S,{children:t}),trigger:["click"],placement:"bottomRight",children:Object(Pe.jsxs)(o.a,{size:"small",type:"default",children:[Object(Pe.jsx)(l.b,{component:at})," ",Object(d.__)("FILTER","wp-eform")]})}),Object(Pe.jsx)(st.a,{placement:"top",title:Object(d.__)("clear all filters.","wp-eform"),children:Object(Pe.jsx)(o.a,{size:"small",type:"default",danger:!0,disabled:!w,onClick:e=>{e.preventDefault(),i({type:"SET_FILTERS",payload:{filters:s}})},children:Object(Pe.jsx)(l.b,{component:lt.a})})})]}):null,Object(Pe.jsx)(st.a,{placement:"top",title:Object(d.__)("Sort by and order","wp-eform"),children:Object(Pe.jsx)(Je.a,{arrow:!0,visible:p,onVisibleChange:e=>f(e),overlay:Object(Pe.jsxs)(_,{children:[Object(Pe.jsx)(k,{children:r.map((e=>{const t=e.id;return Object(Pe.jsxs)(C,{selected:n.orderBy===t,children:[Object(Pe.jsx)(rt.a,{checked:n.orderBy===t,onChange:e=>{e.target.checked&&i({type:"SET_ORDERBY",payload:{orderBy:t}})}})," ",e.title]},t)}))}),Object(Pe.jsx)(k,{children:null!=u&&u.sorter?Object(Pe.jsxs)(Pe.Fragment,{children:[Object(Pe.jsxs)(C,{selected:"ascend"===n.orderDir,children:[Object(Pe.jsx)(rt.a,{checked:"ascend"===n.orderDir,onChange:e=>{e.target.checked&&i({type:"SET_ORDERDIR",payload:{orderDir:"ascend"}})}})," ",Object(d.__)("Ascending","wp-eform")]}),Object(Pe.jsxs)(C,{selected:"descend"===n.orderDir,children:[Object(Pe.jsx)(rt.a,{checked:"descend"===n.orderDir,onChange:e=>{e.target.checked&&i({type:"SET_ORDERDIR",payload:{orderDir:"descend"}})}})," ",Object(d.__)("Descending","wp-eform")]})]}):null})]}),trigger:["click"],placement:"bottomRight",children:Object(Pe.jsx)(o.a,{size:"small",type:"default",children:Object(Pe.jsx)(l.b,{component:ct})})})})]})}var ut=n(205),mt=n(1106);function ht(e){const t=e.views,n=e.dispatch,i=e.currentView,r=e.resetFilters;return Object(Pe.jsx)(o.a.Group,{size:"small",className:Object(b.d)(y,"views"),children:t.map((e=>{const t=Object(Pe.jsx)(o.a,{size:"small",type:e.id===(null==i?void 0:i.id)?"primary":"dashed",danger:!!e.danger&&e.id===(null==i?void 0:i.id),onClick:t=>{t.preventDefault(),n({type:"SET_VIEW",payload:{currentView:e.id,filters:r}})},children:e.title},e.id);return e.help?Object(Pe.jsx)(st.a,{title:e.help,placement:"bottom",children:t},e.id):t}))})}function bt(e){var t;const n=e.views,i=e.dispatch,r=e.currentView,s=e.resetFilters;return Object(Pe.jsx)(Je.a,{overlay:Object(Pe.jsx)(nt.a,{children:n.map((e=>Object(Pe.jsx)(nt.a.Item,{danger:!!e.danger&&e.id===(null==r?void 0:r.id),onClick:()=>{i({type:"SET_VIEW",payload:{currentView:e.id,filters:s}})},children:e.ddLabel},e.id)))}),trigger:["click"],children:Object(Pe.jsxs)(o.a,{size:"small",type:"default",style:{minWidth:"122px"},icon:Object(Pe.jsx)(l.b,{component:mt.a}),children:[null!==(t=null==r?void 0:r.ddLabel)&&void 0!==t?t:Object(d.__)("View Mode","wp-eform"),Object(Pe.jsx)(ut.a,{})]})})}function pt(e){const t=e.views,n=e.state,o=e.dispatch,i=e.resetFilters,r=e.displayMode,s=t.find((e=>e.id===n.currentView)),a=Object(h.d)("tablet"),c=Object(h.d)("desktopHd");return Object(Pe.jsx)("div",{className:Object(b.d)(y,"header-controls",Object(b.d)(y,"view-mode")),children:"table"===r?c?Object(Pe.jsx)(ht,{dispatch:o,resetFilters:i,views:t,currentView:s}):Object(Pe.jsx)(bt,{dispatch:o,resetFilters:i,views:t,currentView:s}):a?Object(Pe.jsx)(ht,{dispatch:o,resetFilters:i,views:t,currentView:s}):Object(Pe.jsx)(bt,{dispatch:o,resetFilters:i,views:t,currentView:s})})}function ft(e){return c.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),c.createElement("path",{d:"M511.867 330.25c-.015-15.5-9.285-29.348-23.613-35.273-14.313-5.918-30.625-2.672-41.567 8.27l-57.59 57.589-104.902-104.828 104.848-104.906c15.586-15.598 15.582-40.965-.008-56.555L334.48 39.992l117.47.051h.01c5.34 0 10.364 2.082 14.142 5.86a19.865 19.865 0 015.855 14.152l-.078 117.336-10.961-10.961c-7.813-7.809-20.473-7.809-28.277 0-7.813 7.808-7.813 20.468-.004 28.277l14.05 14.05c10.942 10.942 27.258 14.184 41.567 8.266 14.328-5.925 23.598-19.77 23.613-35.277l.082-121.664c.012-16.039-6.226-31.121-17.57-42.46C483.047 6.288 467.984.05 451.984.05h-.043L330.246 0c-15.484.016-29.324 9.3-35.258 23.648-5.937 14.36-2.699 30.711 8.254 41.665l57.516 57.515-104.852 104.91L151.07 122.977c-15.593-15.582-40.96-15.575-56.55.011l-54.403 54.403-.078-117.328a19.862 19.862 0 015.856-14.153c3.777-3.777 8.796-5.855 14.16-5.855h.011l117.446-.063-11.086 11.09c-7.809 7.809-7.809 20.469 0 28.277 7.808 7.813 20.472 7.813 28.281 0l14.047-14.046c10.953-10.954 14.191-27.31 8.254-41.665C211.074 9.301 197.234.016 181.718 0L60.07.063h-.035c-16.023 0-31.09 6.242-42.422 17.574C6.273 28.977.035 44.055.047 60.09l.082 121.664c.016 15.5 9.285 29.348 23.613 35.273 14.313 5.914 30.625 2.672 41.567-8.27l57.492-57.491 104.832 104.757-104.754 104.809c-15.586 15.594-15.582 40.965.008 56.55l54.5 54.5-117.375.126h-.024c-5.34 0-10.36-2.082-14.136-5.86a19.835 19.835 0 01-5.856-14.16l.121-117.375 10.961 10.961c7.813 7.809 20.473 7.809 28.281 0 7.809-7.808 7.809-20.472 0-28.281l-14.05-14.047c-10.942-10.941-27.254-14.187-41.563-8.27C9.414 300.903.145 314.75.13 330.25L0 451.945c-.016 16.051 6.223 31.137 17.57 42.485C28.902 505.762 43.965 512 59.988 512h.063l121.699-.129c15.5-.016 29.344-9.285 35.27-23.613 5.921-14.309 2.675-30.625-8.266-41.567l-57.586-57.586 104.754-104.812 104.906 104.832c15.594 15.582 40.961 15.574 56.547-.012l54.504-54.504.121 117.38a19.841 19.841 0 01-5.855 14.16 19.865 19.865 0 01-14.141 5.859h-.02l-117.379-.125 10.965-10.961c7.809-7.809 7.809-20.473 0-28.281-7.808-7.809-20.472-7.809-28.28 0l-14.048 14.046c-10.941 10.942-14.187 27.258-8.27 41.567 5.926 14.332 19.77 23.601 35.274 23.617l121.695.129h.067c16.02 0 31.086-6.238 42.418-17.57 11.347-11.348 17.586-26.438 17.566-42.485l-.125-121.695z"}))}n.p;function gt(e){const t=e.containerRef,n=Object(c.useState)(!!document.fullscreenElement),i=Object(a.a)(n,2),r=i[0],s=i[1];return Object(c.useEffect)((()=>{const e=()=>{document.fullscreenElement?s(!0):s(!1)};return document.addEventListener("fullscreenchange",e),()=>document.removeEventListener("fullscreenchange",e)}),[]),document.documentElement.requestFullscreen?Object(Pe.jsx)("div",{className:Object(b.d)(y,"header-controls"),children:Object(Pe.jsx)(st.a,{title:r?Object(d.__)("Exit fullscreen mode.","wp-eform"):Object(d.__)("Enter fullscreen mode.","wp-eform"),children:Object(Pe.jsx)(o.a,{size:"small",type:"dashed",onClick:e=>{var n;(e.preventDefault(),document.fullscreenElement)?document.exitFullscreen():null===(n=t.current)||void 0===n||n.requestFullscreen()},children:Object(Pe.jsx)(l.b,{component:r?lt.a:ft})})})}):null}function jt(e){const t=e.loadingData,n=e.totalItems,o=e.items,f=e.getItemId,g=e.resetFilters,j=void 0===g?{}:g,O=e.generatePreview,v=e.generateItemRow,w=e.itemNamePlural,C=e.itemNameSingular,_=e.state,k=e.dispatch,S=e.views,E=e.renderFilters,I=e.orderBys,T=e.bulkActions,F=e.isDoingBulk,P=e.emptyText,M=e.evictFieldNames,A=e.onMutation,H=e.tableModeColumns,V=e.renderTableCell,$=Object(h.d)("desktop"),q=Object(c.useState)(_.search),U=Object(a.a)(q,2),W=U[0],G=U[1],Y=Object(c.useState)(null!=n?n:0),Q=Object(a.a)(Y,2),X=Q[0],Z=Q[1];Object(c.useEffect)((()=>{void 0!==n&&Z(n)}),[n]);const J=Object(u.a)(((e,t)=>{t({type:"SET_SEARCH",payload:{search:e}})}),500),ee=Object(c.useCallback)((e=>{const t=e.target.value;G(t),J(t,k)}),[J,k]);Object(c.useEffect)((()=>{G(_.search)}),[_.search]);const te=Object(c.useRef)(null),ne="table"===_.displayMode&&V&&H&&$?"table":"preview";return Object(Pe.jsx)(ye.Provider,{value:k,children:Object(Pe.jsx)(Se.Provider,{value:M,children:Object(Pe.jsx)(Ie.Provider,{value:A,children:Object(Pe.jsxs)(ae,{className:y,ref:te,children:[Object(Pe.jsxs)(z,{children:[Object(Pe.jsxs)(K,{displayMode:ne,children:[Object(Pe.jsxs)(x,{children:[Object(Pe.jsxs)("div",{className:Object(b.d)(y,"row-top"),children:["table"===ne?Object(Pe.jsx)(it,{isDoingBulk:F,bulkActions:T,state:_,dispatch:k}):null,Object(Pe.jsx)("div",{className:Object(b.d)(y,"header-search"),children:Object(Pe.jsx)(s.a,{type:"search",placeholder:Object(d.__)("search items","wp-eform"),prefix:Object(Pe.jsx)(l.b,{component:p}),size:"small",value:W,onChange:ee,allowClear:!0})}),Object(Pe.jsx)(dt,{renderFilters:E,state:_,dispatch:k,orderBys:I,resetFilters:j})]}),Object(Pe.jsxs)("div",{className:Object(b.d)(y,"row-bottom"),children:["table"===ne?Object(Pe.jsx)(gt,{containerRef:te}):null,"preview"===ne?Object(Pe.jsx)(it,{isDoingBulk:F,bulkActions:T,state:_,dispatch:k}):null,Object(Pe.jsx)(pt,{views:S,state:_,dispatch:k,resetFilters:j,displayMode:ne}),"table"===ne?Object(Pe.jsx)("div",{className:Object(b.d)(y,"header-controls",Object(b.d)(y,"header-pagination")),children:Object(Pe.jsx)(Qe,{dispatch:k,itemNamePlural:w,itemNameSingular:C,loadingData:t,state:_,totalItems:X,items:o,displayMode:ne})}):null]})]}),Object(Pe.jsx)(Xe,{loadingData:t,state:_,dispatch:k,generateItemRow:v,getItemId:f,items:o,itemNamePlural:w,itemNameSingular:C,totalItems:X,emptyText:P,displayMode:ne,tableModeColumns:H,renderTableCell:V})]}),$&&"preview"===ne?Object(Pe.jsx)(L,{children:Object(Pe.jsx)(N,{children:"trashed"===_.currentView?Object(Pe.jsx)(R,{children:Object(Pe.jsx)(D,{children:Object(Pe.jsx)(r.a,{description:Object(d.__)("Please untrash the item to see the preview.","wp-eform")})})}):_.previewItemId?O(_.previewItemId):Object(Pe.jsx)(R,{children:Object(Pe.jsx)(D,{children:Object(Pe.jsx)(r.a,{description:Object(d.__)("Please select an item from the list and the preview will show up here.","wp-eform")})})})})}):null]}),Object(Pe.jsx)(B,{children:Object(Pe.jsx)(i.a,{size:"default",showLessItems:!0,showSizeChanger:!0,current:_.currentPage,onChange:e=>{k({type:"SET_CURRENT_PAGE",payload:{currentPage:e}}),te.current&&Object(m.a)(te.current,{verticalOffset:-140})},total:X,pageSize:_.itemsPerPage,onShowSizeChange:(e,t)=>{k({type:"SET_ITEMS_PER_PAGE",payload:{itemsPerPage:t}})}})})]})})})})}jt.FilterMenuItem=E,jt.Preview=W,jt.PreviewHeader=H,jt.PreviewMeta=$,jt.PreviewTitle=V,jt.PreviewData=q,jt.PreviewActions=U,jt.PreviewContent=R,jt.PreviewToolbar=A,jt.ActionButton=function(e){return Object(Pe.jsx)(o.a,{type:"default",...e,size:"small"})},jt.MutationButton=function(e){const t=e.danger,n=void 0!==t&&t,i=e.mutation,r=e.variables,s=e.children,l=e.popconfirm,u=Object(c.useContext)(ye),m=Ee(),h=Te(),b=Object(ue.a)(i,{variables:r}),p=Object(a.a)(b,2),f=p[0],g=p[1].loading,j=()=>{u({type:"SET_CAN_TRAIL_ITEMS",payload:{canTrailItems:!1}}),f().then((()=>{h&&h(),Fe(m)})).catch((e=>{de.b.error(e.message||Object(d.__)("Some error occured. Please retry!","wp-eform"))}))};return l?Object(Pe.jsx)(le.a,{title:Object(Pe.jsx)(Me,{children:l}),onConfirm:j,okText:Object(d.__)("YES","wp-eform"),cancelText:Object(d.__)("NO","wp-eform"),children:Object(Pe.jsx)(o.a,{type:"default",size:"small",danger:n,loading:g,onClick:e=>{e.stopPropagation()},children:s})}):Object(Pe.jsx)(o.a,{type:"default",size:"small",danger:n,onClick:e=>{e.preventDefault(),e.stopPropagation(),j()},loading:g,children:s})},jt.RouterLinkButton=function(e){return Object(Pe.jsx)(Be.Link,{...e,className:"ant-btn ant-btn-default ant-btn-sm"})},jt.AnchorButton=function(e){return Object(Pe.jsx)("a",{...e,className:"ant-btn ant-btn-default ant-btn-sm"})},jt.Empty=function(e){return Object(Pe.jsx)(D,{children:Object(Pe.jsx)(r.a,{description:e.children})})},jt.DisplayModeUI=function(e){const t=e.state.displayMode;return Object(h.d)("desktop")?Object(Pe.jsxs)(Ze.b,{value:t,onChange:t=>{e.dispatch({type:"SET_DISPLAY_MODE",payload:{displayMode:t}})},children:[Object(Pe.jsxs)(Ze.b.Button,{size:"small",value:"table",children:[Object(Pe.jsx)(l.b,{component:g})," ",Object(d.__)("TABLE","wp-eform")]}),Object(Pe.jsxs)(Ze.b.Button,{size:"small",value:"preview",children:[Object(Pe.jsx)(l.b,{component:f})," ",Object(d.__)("LIST","wp-eform")]})]}):null},jt.Badge=G,jt.UserInput=re,jt.MutedText=se,jt.AntMenuItem=ce},1066:function(e,t,n){"use strict";n.d(t,"b",(function(){return i})),n.d(t,"a",(function(){return r}));var o=n(3);const i=new(n(148).a)("EForm Fonts");function r(e){if(!i.hasItem(e))return["inherit",null];const t=i.getItem(e);return[t.fontFamily,t.enqueue]}i.addItem("inherit",{name:Object(o.__)("Inherit from theme","wp-eform"),fontFamily:"inherit",enqueue:null}),i.addItem("system",{name:Object(o.__)("System UI","wp-eform"),fontFamily:'-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"',enqueue:null}),i.addItem("systemMono",{name:Object(o.__)("System UI Mono","wp-eform"),fontFamily:"'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, Courier, monospace",enqueue:null}),i.addItem("custom",{name:Object(o.__)("Custom Font","wp-eform"),fontFamily:"",enqueue:null}),i.addItem("alegreya",{name:"Alegreya",fontFamily:"'Alegreya', serif",enqueue:"https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("b612",{name:"B612",fontFamily:"'B612', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=B612:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("titilliumweb",{name:"Titillium Web",fontFamily:"'Titillium Web', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("vollkorn",{name:"Vollkorn",fontFamily:"'Vollkorn', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("ibmplexsans",{name:"IBM Plex Sans",fontFamily:"'IBM Plex Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"}),i.addItem("crimsontext",{name:"Crimson Text",fontFamily:"'Crimson Text', serif",enqueue:"https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap"}),i.addItem("karla",{name:"Karla",fontFamily:"'Karla', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("lora",{name:"Lora",fontFamily:"'Lora', serif",enqueue:"https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"}),i.addItem("playfairdisplay",{name:"Playfair Display",fontFamily:"'Playfair Display', serif",enqueue:"https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("archivo",{name:"Archivo",fontFamily:"'Archivo', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"}),i.addItem("spectral",{name:"Spectral",fontFamily:"'Spectral', serif",enqueue:"https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"}),i.addItem("roboto",{name:"Roboto",fontFamily:"'Roboto', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"}),i.addItem("montserrat",{name:"Montserrat",fontFamily:"'Montserrat', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("rubik",{name:"Rubik",fontFamily:"'Rubik', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("sourcesanspro",{name:"Source Sans Pro",fontFamily:"'Source Sans Pro', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap"}),i.addItem("cormorant",{name:"Cormorant",fontFamily:"'Cormorant', serif",enqueue:"https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"}),i.addItem("worksans",{name:"Work Sans",fontFamily:"'Work Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("arvo",{name:"Arvo",fontFamily:"'Arvo', serif",enqueue:"https://fonts.googleapis.com/css2?family=Arvo:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("lato",{name:"Lato",fontFamily:"'Lato', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"}),i.addItem("ubuntu",{name:"Ubuntu",fontFamily:"'Ubuntu', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"}),i.addItem("ptserif",{name:"PT Serif",fontFamily:"'PT Serif', serif",enqueue:"https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("ptsans",{name:"PT Sans",fontFamily:"'PT Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("poppins",{name:"Poppins",fontFamily:"'Poppins', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("firasans",{name:"Fira Sans",fontFamily:"'Fira Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("nunito",{name:"Nunito",fontFamily:"'Nunito', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("exo2",{name:"Exo 2",fontFamily:"'Exo 2', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("opensans",{name:"Open Sans",fontFamily:"'Open Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap"}),i.addItem("merriweather",{name:"Merriweather",fontFamily:"'Merriweather', serif",enqueue:"https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"}),i.addItem("notosans",{name:"Noto Sans",fontFamily:"'Noto Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("spacemono",{name:"Space Mono",fontFamily:"'Space Mono', monospace",enqueue:"https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("librefranklin",{name:"Libre Franklin",fontFamily:"'Libre Franklin', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("alegreyasans",{name:"Alegreya Sans",fontFamily:"'Alegreya Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&display=swap"}),i.addItem("chivo",{name:"Chivo",fontFamily:"'Chivo', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Chivo:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"}),i.addItem("sourceserifpro",{name:"Source Serif Pro",fontFamily:"'Source Serif Pro', serif",enqueue:"https://fonts.googleapis.com/css2?family=Source+Serif+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap"}),i.addItem("archivonarrow",{name:"Archivo Narrow",fontFamily:"'Archivo Narrow', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Archivo+Narrow:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"}),i.addItem("prozalibre",{name:"Proza Libre",fontFamily:"'Proza Libre', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Proza+Libre:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap"}),i.addItem("cabin",{name:"cabin",fontFamily:"'Cabin', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"}),i.addItem("raleway",{name:"Raleway",fontFamily:"'Raleway', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("anonymouspro",{name:"Anonymous Pro",fontFamily:"'Anonymous Pro', monospace",enqueue:"https://fonts.googleapis.com/css2?family=Anonymous+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap"})},1067:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));var o=n(0);function i(e){return o.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),o.createElement("path",{d:"M357.14 181.14l-73.355 73.36 73.356 73.36c7.812 7.808 7.812 20.472 0 28.28A19.929 19.929 0 01343 362a19.929 19.929 0 01-14.14-5.86l-73.36-73.355-73.36 73.356A19.929 19.929 0 01168 362a19.929 19.929 0 01-14.14-5.86c-7.813-7.808-7.813-20.472 0-28.28l73.355-73.36-73.356-73.36c-7.812-7.808-7.812-20.472 0-28.28 7.809-7.813 20.473-7.813 28.282 0l73.359 73.355 73.36-73.356c7.808-7.812 20.472-7.812 28.28 0 7.813 7.809 7.813 20.473 0 28.282zm79.88-106.16C388.668 26.63 324.379 0 256 0S123.332 26.629 74.98 74.98C26.63 123.332 0 187.621 0 256s26.629 132.668 74.98 181.02C123.332 485.37 187.621 512 256 512c46.813 0 92.617-12.758 132.46-36.895 9.45-5.722 12.47-18.02 6.747-27.464-5.723-9.45-18.023-12.47-27.469-6.746C334.145 461.242 295.504 472 256 472c-119.102 0-216-96.898-216-216S136.898 40 256 40s216 96.898 216 216c0 42.59-12.664 84.043-36.625 119.887-6.14 9.18-3.672 21.601 5.512 27.742 9.18 6.137 21.601 3.672 27.742-5.512C497 355.676 512 306.531 512 256c0-68.379-26.629-132.668-74.98-181.02z"}))}n.p},1069:function(e,t,n){"use strict";n.d(t,"a",(function(){return u}));n(0);var o=n(3),i=n(7),r=n(8),s=n(147),a=n(2),c=n(364),l=n(1039),d=n(1);i.f.div.withConfig({displayName:"GenericApolloError__ButtonContainer",componentId:"sc-10t13a5-0"})(["margin:"," ",";"],(e=>Object(a.n)(e.theme.gutter)),(e=>Object(a.n)(e.theme.gutter/-2)));function u(e){const t=e.children,n=e.themeStyle,i=e.error,a=e.retry,u=e.title,m=e.hideReload,h=void 0!==m&&m,b=e.retryLabel,p=e.widthOverride,f=e.ssr,g=void 0!==f&&f,j=e.type,O=void 0===j?"500":j;return Object(d.jsx)(l.a,{themeStyle:n,widthOverride:p,ssr:g,children:Object(d.jsx)(c.a,{type:O,title:u,description:Object(d.jsxs)(d.Fragment,{children:[t,i?Object(d.jsxs)(d.Fragment,{children:[Object(d.jsx)("p",{children:Object(o.__)("More information on the error can be found below.","wp-eform")}),Object(d.jsx)("p",{children:i.message})]}):null]}),footer:!h||a?Object(d.jsxs)(d.Fragment,{children:[h?null:Object(d.jsx)(s.b,{style:"3d",size:r.o.SMALL,onClick:()=>{window.location.reload()},children:Object(o.__)("RELOAD PAGE","wp-eform")}),a?Object(d.jsx)(s.b,{style:"3d",size:r.o.SMALL,onClick:a,colorful:!1,children:null!=b?b:Object(o.__)("RETRY WITHOUT RELOAD","wp-eform")}):null]}):null})})}},1070:function(e,t,n){"use strict";n.d(t,"a",(function(){return b}));n(0);var o=n(7),i=n(438),r=n(2),s=n(1078),a=n(1);const c=o.f.div.withConfig({displayName:"SubmissionSkeleton__SkeletonContainer",componentId:"sc-1eq1qk1-0"})([""," margin:0 auto;"],r.b);function l(){const e=Object(o.h)();return Object(a.jsxs)(a.Fragment,{children:[Object(a.jsx)(i.b,{shape:"rectangle",height:32+e.gutter/2,width:"100%",marginBottom:"small"}),Object(a.jsx)(i.b,{shape:"rectangle",height:2,width:"100%",marginBottom:"large"})]})}function d(){return Object(a.jsxs)(a.Fragment,{children:[Object(a.jsx)(l,{}),Object(a.jsx)(i.b,{shape:"rectangle",height:167,width:"100%",marginBottom:"large"})]})}const u=[52,36,49,65,42,63,86,38,75,57,43,51,85,72,44,55,45,59,75,76];function m(e){const t=Object(o.h)(),n=e.widthSet,r=u[n%u.length-1];return Object(a.jsxs)(a.Fragment,{children:[Object(a.jsx)(i.b,{shape:"rectangle",width:`${r}%`,height:1.5*t.fz.base,marginBottom:"small"}),Object(a.jsx)(i.b,{shape:"rectangle",width:"100%",height:92,marginBottom:"large"}),Object(a.jsx)(i.b,{shape:"rectangle",width:"100%",height:2,marginBottom:"large"})]})}function h(e){const t=Object(o.h)(),n=[];for(let t=0;t<e.controls;t++)n.push(Object(a.jsx)(m,{widthSet:t+1},t));return Object(a.jsxs)(a.Fragment,{children:[Object(a.jsx)(i.b,{shape:"rectangle",height:1.5*t.fz.small1+t.gutter/6,width:"100%",marginBottom:t.gutter/6}),Object(a.jsx)(i.b,{shape:"rectangle",height:1,width:"100%",marginBottom:"large"}),n]})}function b(e){const t=e.panels,n=void 0===t?2:t,o=e.controls,i=void 0===o?5:o,r=[];for(let e=0;e<n;e++)r.push(Object(a.jsx)(h,{controls:0===e?i:3},e));return Object(a.jsx)(c,{className:"wpeform-component-submissionskeleton",children:Object(a.jsxs)(s.a,{children:[Object(a.jsx)(d,{}),r]})})}b.PreviewToolbar=l},1072:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));const o=n(1189).a`
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
`},1077:function(e,t,n){"use strict";n(8)},1078:function(e,t,n){"use strict";n.d(t,"a",(function(){return a}));n(0);var o=n(7),i=n(2),r=n(1);const s=o.f.div.withConfig({displayName:"Wrapper__Container",componentId:"sc-cwluc8-0"})(["",";font-family:",";padding:",";background-color:",";border-radius:",";border:1px solid ",";"],i.b,(e=>e.theme.fontFamilyBody),(e=>Object(i.n)(e.theme.gutter)),(e=>e.theme.appBackgroundColor),(e=>Object(i.n)(e.theme.borderRadiusBase)),(e=>e.theme.borderColorLight));function a(e){return Object(r.jsx)(s,{children:e.children})}},1079:function(e,t,n){"use strict";n.d(t,"a",(function(){return y}));var o=n(1189);const i=o.a`
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
`;var c=n(1047),l=n(1048),d=n(1049),u=n(1050),m=n(1051),h=n(1052),b=n(1053),p=n(1054),f=n(1055),g=n(1056),j=n(1057),O=n(1058),v=n(1059),w=n(1060);const y=o.a`
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
	${h.a}
	${b.a}
	${p.a}
	${f.a}
	${g.a}
	${j.a}
	${O.a}
	${v.a}
	${w.a}
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
`},1085:function(e,t,n){"use strict";n.d(t,"useGesture",(function(){return c}));var o=n(1040),i=n(0),r=n.n(i),s=n(1086);n(1061),n(1062);function a(e,t={},n,o){const i=r.a.useMemo((()=>new s.a(e)),[]);if(i.applyHandlers(e,o),i.applyConfig(t,n),r.a.useEffect(i.effect.bind(i)),r.a.useEffect((()=>i.clean.bind(i)),[]),void 0===t.target)return i.bind.bind(i)}function c(e,t){return([o.a,o.d,o.f,o.g,o.c,o.b].forEach(o.e),function(e,t){const n=Object(s.b)(e,t||{}),o=n.handlers,i=n.nativeHandlers;return a(o,n.config,void 0,i)})(e,t||{})}},1086:function(e,t,n){"use strict";n.d(t,"a",(function(){return u})),n.d(t,"b",(function(){return f}));var o=n(6),i=n(1034);function r(e,t){if(null==e)return{};var n,o,i=function(e,t){if(null==e)return{};var n,o,i={},r=Object.keys(e);for(o=0;o<r.length;o++)n=r[o],t.indexOf(n)>=0||(i[n]=e[n]);return i}(e,t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);for(o=0;o<r.length;o++)n=r[o],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(i[n]=e[n])}return i}const s={target(e){if(e)return()=>"current"in e?e.current:e},enabled:(e=!0)=>e,window:(e=(i.c.isBrowser?window:void 0))=>e,eventOptions:({passive:e=!0,capture:t=!1}={})=>({passive:e,capture:t}),transform:e=>e},a=["target","eventOptions","window","enabled","transform"];function c(e={},t){const n={};for(const r of Object.entries(t)){var i=Object(o.a)(r,2);const t=i[0],s=i[1];switch(typeof s){case"function":n[t]=s.call(n,e[t],t,e);break;case"object":n[t]=c(e[t],s);break;case"boolean":s&&(n[t]=e[t])}}return n}class l{constructor(e,t){Object(i.e)(this,"_listeners",new Set),this._ctrl=e,this._gestureKey=t}add(e,t,n,o,r){const s=this._listeners,a=Object(i.q)(t,n),c=this._gestureKey?this._ctrl.config[this._gestureKey].eventOptions:{},l=Object(i.d)(Object(i.d)({},c),r);e.addEventListener(a,o,l);const d=()=>{e.removeEventListener(a,o,l),s.delete(d)};return s.add(d),d}clean(){this._listeners.forEach((e=>e())),this._listeners.clear()}}class d{constructor(){Object(i.e)(this,"_timeouts",new Map)}add(e,t,n=140,...o){this.remove(e),this._timeouts.set(e,window.setTimeout(t,n,...o))}remove(e){const t=this._timeouts.get(e);t&&window.clearTimeout(t)}clean(){this._timeouts.forEach((e=>{window.clearTimeout(e)})),this._timeouts.clear()}}class u{constructor(e){Object(i.e)(this,"gestures",new Set),Object(i.e)(this,"_targetEventStore",new l(this)),Object(i.e)(this,"gestureEventStores",{}),Object(i.e)(this,"gestureTimeoutStores",{}),Object(i.e)(this,"handlers",{}),Object(i.e)(this,"config",{}),Object(i.e)(this,"pointerIds",new Set),Object(i.e)(this,"touchIds",new Set),Object(i.e)(this,"state",{shared:{shiftKey:!1,metaKey:!1,ctrlKey:!1,altKey:!1}}),function(e,t){t.drag&&m(e,"drag");t.wheel&&m(e,"wheel");t.scroll&&m(e,"scroll");t.move&&m(e,"move");t.pinch&&m(e,"pinch");t.hover&&m(e,"hover")}(this,e)}setEventIds(e){return Object(i.l)(e)?(this.touchIds=new Set(Object(i.f)(e)),this.touchIds):"pointerId"in e?("pointerup"===e.type||"pointercancel"===e.type?this.pointerIds.delete(e.pointerId):"pointerdown"===e.type&&this.pointerIds.add(e.pointerId),this.pointerIds):void 0}applyHandlers(e,t){this.handlers=e,this.nativeHandlers=t}applyConfig(e,t){this.config=function(e,t,n={}){const o=e,l=o.target,d=o.eventOptions,u=o.window,m=o.enabled,h=o.transform,b=r(o,a);if(n.shared=c({target:l,eventOptions:d,window:u,enabled:m,transform:h},s),t){const e=i.a.get(t);n[t]=c(Object(i.d)({shared:n.shared},b),e)}else for(const e in b){const t=i.a.get(e);t&&(n[e]=c(Object(i.d)({shared:n.shared},b[e]),t))}return n}(e,t,this.config)}clean(){this._targetEventStore.clean();for(const e of this.gestures)this.gestureEventStores[e].clean(),this.gestureTimeoutStores[e].clean()}effect(){return this.config.shared.target&&this.bind(),()=>this._targetEventStore.clean()}bind(...e){const t=this.config.shared,n={};let o;if(!t.target||(o=t.target(),o)){if(t.enabled){for(const t of this.gestures){const r=this.config[t],s=h(n,r.eventOptions,!!o);if(r.enabled){new(i.b.get(t))(this,e,t).bind(s)}}const r=h(n,t.eventOptions,!!o);for(const t in this.nativeHandlers)r(t,"",(n=>this.nativeHandlers[t](Object(i.d)(Object(i.d)({},this.state.shared),{},{event:n,args:e}))),void 0,!0)}for(const e in n)n[e]=Object(i.g)(...n[e]);if(!o)return n;for(const e in n){const t=Object(i.n)(e),r=t.device,s=t.capture,a=t.passive;this._targetEventStore.add(o,r,"",n[e],{capture:s,passive:a})}}}}function m(e,t){e.gestures.add(t),e.gestureEventStores[t]=new l(e,t),e.gestureTimeoutStores[t]=new d}const h=(e,t,n)=>(o,r,s,a={},c=!1)=>{var l,d;const u=null!==(l=a.capture)&&void 0!==l?l:t.capture,m=null!==(d=a.passive)&&void 0!==d?d:t.passive;let h=c?o:Object(i.h)(o,r,u);n&&m&&(h+="Passive"),e[h]=e[h]||[],e[h].push(s)},b=/^on(Drag|Wheel|Scroll|Move|Pinch|Hover)/;function p(e,t,n,o,r,s){if(!e.has(n))return;if(!i.b.has(o))return void 0;const a=n+"Start",c=n+"End";r[o]=e=>{let o;return e.first&&a in t&&t[a](e),n in t&&(o=t[n](e)),e.last&&c in t&&t[c](e),o},s[o]=s[o]||{}}function f(e,t){const n=function(e){const t={},n={},o=new Set;for(let i in e)b.test(i)?(o.add(RegExp.lastMatch),n[i]=e[i]):t[i]=e[i];return[n,t,o]}(e),i=Object(o.a)(n,3),r=i[0],s=i[1],a=i[2],c={};return p(a,r,"onDrag","drag",c,t),p(a,r,"onWheel","wheel",c,t),p(a,r,"onScroll","scroll",c,t),p(a,r,"onPinch","pinch",c,t),p(a,r,"onMove","move",c,t),p(a,r,"onHover","hover",c,t),{handlers:c,config:t,nativeHandlers:s}}},1087:function(e,t,n){"use strict";n.d(t,"a",(function(){return Ot}));var o=n(42),i=n(0),r=n(15),s=n(3),a=n(10),c=n.n(a),l=n(53),d=n(162),u=n.n(d),m=n(7),h=n(283),b=n(1085),p=n(2),f=n(18),g=n(287),j=n(29),O=n(1);const v="wpeform-component-progressbar",w=Object(p.d)(v,"bar"),y=Object(m.g)(["0%{width:0;opacity:0.1;}20%{width:0;opacity:0.5;}100%{width:100%;opacity:0;}"]),x=Object(m.f)(l.animated.div).withConfig({displayName:"Progressbar__AnimatedTabsProgress",componentId:"sc-70ygvj-0"})(["will-change:width;background-color:",";height:",";position:relative;&.","--is-active{&::before{position:absolute;top:0;right:0;bottom:0;left:0;background:",";opacity:0;animation:"," 2.4s cubic-bezier(0.23,1,0.32,1) infinite;content:'';}}"],(e=>e.theme.primaryColor),(e=>Object(p.n)(.25*e.theme.controlHeightBase)),w,(e=>e.theme.primaryBgText),y),C=Object(m.f)(l.animated.span).withConfig({displayName:"Progressbar__ProgressLabel",componentId:"sc-70ygvj-1"})(["margin:0;padding:0;color:",";font-size:",";line-height:1;font-weight:bold;position:absolute;right:0.2em;"],(e=>e.theme.textColorSecondary),(e=>Object(p.n)(e.theme.fz.small2))),_=m.f.div.withConfig({displayName:"Progressbar__ProgressContainer",componentId:"sc-70ygvj-2"})(["height:",";background-color:",";overflow:hidden;width:100%;"],(e=>Object(p.n)(.25*e.theme.controlHeightBase)),(e=>Object(j.d)(.05,e.theme.disabledColor))),k=m.f.div.withConfig({displayName:"Progressbar__ProgressbarWrapper",componentId:"sc-70ygvj-3"})(["",";position:relative;&.","--is-bottom-rounded{","{border-bottom-left-radius:",";border-bottom-right-radius:",";}}&.","--is-top-rounded{","{border-top-left-radius:",";border-top-right-radius:",";}}&.","--is-bottom-rounded.","--is-top-rounded{",",",",","::before{border-radius:",";}}&.","--label-position-top{","{top:-1.2em;}}&.","--label-position-bottom{","{bottom:-1.2em;}}"],p.b,v,_,(e=>Object(p.n)(e.theme.borderRadiusBase)),(e=>Object(p.n)(e.theme.borderRadiusBase)),v,_,(e=>Object(p.n)(e.theme.borderRadiusBase)),(e=>Object(p.n)(e.theme.borderRadiusBase)),v,v,_,x,x,(e=>Object(p.n)(.25*e.theme.controlHeightBase)),v,C,v,C);function S(e){const t=e.width,n=e.active,o=void 0!==n&&n,i=e.isBottomRounded,r=void 0!==i&&i,s=e.isTopRounded,a=void 0!==s&&s,c=e.showLabel,d=void 0===c||c,u=e.precision,h=void 0===u?2:u,b=e.labelPosition,f=void 0===b?"top":b,g=Object(m.h)(),j=Object(l.useSpring)({from:{width:"0%"},to:{width:`${t}%`},config:{...g.springConfigSlow,clamp:!0}}),y=Object(l.useSpring)({number:t,from:{number:0},config:{...g.springConfigSlow,clamp:!0}});return Object(O.jsxs)(k,{className:Object(p.c)(v,{"is-bottom-rounded":r,"is-top-rounded":a,"is-active":o,[`label-position-${f}`]:!0}),children:[Object(O.jsx)(_,{children:Object(O.jsx)(x,{style:j,className:Object(p.c)(w,{"is-active":!!o}),"aria-valuenow":t,"aria-valuemin":0,"aria-valuemax":100})}),d?Object(O.jsx)(C,{children:y.number.to((e=>`${e.toFixed(h)}%`))}):null]})}var E=n(8),I=n(36),T=n(361),F=n(66);const P="wpeform-component-tabs",M=Object(p.d)(P,"nav-button"),B=Object(p.d)(P,"button"),L=Object(p.d)(P,"button-icon"),N=Object(p.d)(P,"button-label"),R=Object(p.d)(P,"button-label-title"),A=Object(p.d)(P,"button-label-subtitle"),D=m.f.div.withConfig({displayName:"styled__TabsContainer",componentId:"sc-1t0opj6-0"})(["",";box-shadow:",";border-radius:",";overflow-anchor:none;background-color:",";"],p.b,(e=>e.theme.boxShadow4dp),(e=>Object(p.n)(e.theme.borderRadiusBase)),(e=>e.theme.appBackgroundColor)),z=m.f.nav.withConfig({displayName:"styled__TabsNavigation",componentId:"sc-1t0opj6-1"})(["background-color:",";border-top-left-radius:",";border-top-right-radius:",";overflow:hidden;display:flex;flex-flow:row nowrap;align-items:stretch;width:100%;position:relative;z-index:2;.","{padding:0;justify-content:center;position:absolute;left:0;top:0;flex:0 0 ",";width:",";height:100%;z-index:1;background-color:transparent;background-image:linear-gradient( to right,",","," 50%,"," 100% );&::before{position:absolute;pointer-events:none;content:'';display:block;top:0;left:0;width:100%;height:100%;background-color:",";opacity:0;transition:",";}&:disabled{opacity:0;pointer-events:none;}.","{position:relative;}.","{font-size:",";}&.right{background-image:linear-gradient( to left,",","," 50%,"," 100% );left:auto;right:0;}&:hover,&:focus{background-color:transparent;&::before{opacity:1;}}&:active{.","{transform:scale(0.8);}}}"],(e=>e.theme.primaryLightColor),(e=>Object(p.n)(e.theme.borderRadiusBase)),(e=>Object(p.n)(e.theme.borderRadiusBase)),M,(e=>Object(p.n)(.75*e.theme.gutter)),(e=>Object(p.n)(.75*e.theme.gutter)),(e=>e.theme.primaryLightColor),(e=>e.theme.primaryLightColor),(e=>Object(j.e)(1,e.theme.primaryLightColor)),(e=>e.theme.primaryColor),(e=>Object(p.f)(["opacity"],e.theme.transitionControl)),N,R,(e=>Object(p.n)(e.theme.fz.small2)),(e=>e.theme.primaryLightColor),(e=>e.theme.primaryLightColor),(e=>Object(j.e)(1,e.theme.primaryLightColor)),N),H=Object(m.f)(l.animated.div).withConfig({displayName:"styled__TabsScroller",componentId:"sc-1t0opj6-2"})(["flex:1 0 auto;width:100%;will-change:transform;touch-action:pan-y;"]),V=(Object(m.f)(l.animated.div).withConfig({displayName:"styled__AnimatedTabPanel",componentId:"sc-1t0opj6-3"})(["will-change:opacity,position,transform;"]),m.f.div.withConfig({displayName:"styled__TabsNavButtonsContainer",componentId:"sc-1t0opj6-4"})(["display:flex;flex-flow:row nowrap;touch-action:pan-y;"])),$=m.f.button.withConfig({displayName:"styled__TabButton",componentId:"sc-1t0opj6-5"})(["font-family:",";position:relative;overflow:hidden;flex:0 0 auto;display:flex;align-items:center;justify-content:flex-start;padding:"," ",";min-height:",";border:0 none;margin:0;outline:none;border-radius:0;background-color:",";cursor:pointer;color:",";text-align:left;transition:",";&.","--active{background-color:",";color:",";}&:hover{background-color:",";}&:focus{background-color:",";color:",";}&:active{.","{transform:scale(0.97);transform-origin:center center;}}.","{font-size:",";margin:0 "," 0 0;flex:0 0 auto;}.","{flex:0 0 auto;display:flex;flex-flow:column nowrap;}.","{font-size:",";font-weight:",";line-height:1;white-space:nowrap;}.","{font-size:",";font-style:",";line-height:1;white-space:nowrap;margin:0;}"],(e=>e.theme.fontFamilyHeading),(e=>Object(p.n)(e.theme.gutter/2)),(e=>Object(p.n)(e.theme.gutter)),(e=>Object(p.n)(1.25*e.theme.controlHeightBase)),(e=>e.theme.primaryLightColor),(e=>Object(j.e)(.3,e.theme.primaryBgText)),(e=>Object(p.f)(["background-color","color"],e.theme.transitionControl)),B,(e=>e.theme.primaryColor),(e=>e.theme.primaryBgText),(e=>e.theme.primaryColor),(e=>e.theme.primaryColor),(e=>e.theme.primaryBgText),N,L,(e=>Object(p.n)(e.theme.fz.large3)),(e=>Object(p.n)(e.theme.gutter/2)),N,R,(e=>Object(p.n)(e.theme.fz.large1)),(e=>e.theme.boldHeading?"500":"normal"),A,(e=>Object(p.n)(e.theme.fz.small2)),(e=>e.theme.italicHeading?"italic":"normal")),q=m.f.div.withConfig({displayName:"styled__TabPanel",componentId:"sc-1t0opj6-6"})(["position:relative;overflow:hidden;&:focus{outline:none;}"]),U=m.f.footer.withConfig({displayName:"styled__TabFooter",componentId:"sc-1t0opj6-7"})(["overflow:hidden;border-bottom-left-radius:",";border-bottom-right-radius:",";"],(e=>Object(p.n)(e.theme.borderRadiusBase)),(e=>Object(p.n)(e.theme.borderRadiusBase))),W=m.f.aside.withConfig({displayName:"styled__StopwatchContainer",componentId:"sc-1t0opj6-8"})(["padding:0 "," ",";"],(e=>Object(p.n)(1.5*e.theme.gutter)),(e=>Object(p.n)(.5*e.theme.gutter))),K=m.f.span.withConfig({displayName:"styled__StopwatchClock",componentId:"sc-1t0opj6-9"})(["display:block;font-size:",";color:",";font-weight:bold;line-height:1;"],(e=>Object(p.n)(e.theme.fz.large3)),(e=>e.theme.textColorSecondary)),G=m.f.span.withConfig({displayName:"styled__StopwatchStamp",componentId:"sc-1t0opj6-10"})(["display:block;font-size:",";line-height:1;color:",";"],(e=>Object(p.n)(e.theme.fz.small2)),(e=>e.theme.textColorSecondary));function Y(e){const t=e.title,n=e.subtitle,o=e.icon,i=e.onClick,s=e.active,a=e.className,c=e.id,l=e.disabled,d=Object(g.a)({darkBg:!0}),u=Object(r.a)(d,2),m=u[0],h=u[1];return Object(O.jsxs)($,{id:c,disabled:l,className:Object(p.c)(B,{active:!!s},a),onClick:e=>{e.preventDefault(),m(e),i()},type:"button",children:[h,o?Object(O.jsx)("span",{className:L,children:Object(O.jsx)(f.b,{iconClass:o})}):null,Object(O.jsxs)("span",{className:N,children:[Object(O.jsx)("span",{className:R,children:t}),n?Object(O.jsx)("span",{className:A,children:n}):null]})]})}function Q(e){var t;const n=e.currentTab,o=e.tabs,s=e.onTabChange,a=Object(m.h)(),d=Object(i.useRef)(null),h=u()(d),p=Object(i.useState)({leftDisabled:!0,rightDisabled:!1,left:0}),g=Object(r.a)(p,2),j=g[0],v=g[1],w=Object(l.useSpring)((()=>({from:{transform:"translateX(0px)"},to:{transform:`translateX(${-1*j.left}px)`},config:{...a.springConfigStiff,clamp:!0}}))),y=Object(r.a)(w,2),x=y[0],C=y[1];Object(i.useEffect)((()=>{C.start({transform:`translateX(${-1*j.left}px)`})}),[j.left,C]);const _=(e,t)=>{if(!d.current)return;let n=0;d.current.querySelectorAll("button").forEach((e=>{n+=e.offsetWidth}));const o=d.current.offsetWidth;let i=j.left-e;if(n<o?i=0:(i<0&&(i=0),i>n-o&&(i=n-o)),t){let e=!1,t=!1;0===i&&(e=!0),i+o>=n&&(t=!0),v({left:i,leftDisabled:e,rightDisabled:t})}else C.start({transform:`translateX(${-1*i}px)`})},k=Object(i.useCallback)(((e,t,n)=>{v({left:e,leftDisabled:t,rightDisabled:n})}),[]);Object(b.useGesture)({onDrag(e){const t=e.movement,n=e.down;_(t[0],!n)},onWheel(e){const t=e.event,n=e.movement;Math.abs(t.deltaX)<=Math.abs(t.deltaY)||(t.preventDefault(),t.stopPropagation(),_(n[0],!0))}},{target:null!==(t=d.current)&&void 0!==t?t:void 0,eventOptions:{passive:!1},drag:{filterTaps:!0}});const S=Object(i.useCallback)((e=>{if(!d.current)return;let t=0,n=0,o=!1,i=0;d.current.querySelectorAll("button").forEach((r=>{i+=r.offsetWidth,o||(r.getAttribute("id")===`tab-item-${e}`?(o=!0,n=r.offsetWidth):t+=r.offsetWidth)}));const r=d.current.offsetWidth;if(i<=r)return void k(0,!0,!0);if(t+n<=r)return void k(0,!0,!1);let s=t+n-r+90;n+90>r&&(s=t-.75*a.gutter),s<0&&(s=0),s>i-r&&(s=i-r),k(s,!1,s+r>=i)}),[a.gutter,k]);return Object(i.useLayoutEffect)((()=>{S(n)}),[n,S,h.width]),Object(O.jsxs)(z,{children:[Object(O.jsx)(Y,{className:M,title:Object(O.jsx)(f.b,{iconClass:"fas fa-angle-left"}),onClick:()=>{_(150,!0)},disabled:j.leftDisabled}),Object(O.jsx)(H,{style:x,children:Object(O.jsx)(V,{ref:d,children:o.map((e=>Object(O.jsx)(Y,{onClick:()=>{s(e.id)},active:n===e.id,id:`tab-item-${e.id}`,icon:e.icon,subtitle:e.subtitle,title:e.title},e.id)))})}),Object(O.jsx)(Y,{className:c()(M,"right"),title:Object(O.jsx)(f.b,{iconClass:"fas fa-angle-right"}),onClick:()=>{_(-150,!0)},disabled:j.rightDisabled})]})}function X(e){const t=e.stopwatchStartTime,n=Object(i.useState)(0),o=Object(r.a)(n,2),a=o[0],c=o[1];Object(i.useEffect)((()=>{const e=()=>{const e=Math.abs(Date.now()-t);c(e)},n=setInterval(e,1e3);return e(),()=>{clearInterval(n)}}),[t]);const l=Object(I.c)(a),d=l.hours,u=l.minutes,m=l.seconds;return Object(O.jsxs)(W,{children:[Object(O.jsx)(K,{children:Object(s.sprintf)(Object(s._x)("%s:%s:%s","timer","wp-eform"),d,u,m)}),Object(O.jsx)(G,{children:Object(s.sprintf)(Object(s.__)("time elapsed since %s","wp-eform"),Object(T.e)(t).format("LTS"))})]})}function Z(e){const t=e.currentTab,n=e.onTabChange,o=e.tabs,r=e.children,s=e.className,a=e.scrollOnTabChange,c=void 0===a||a,l=e.tabScrollOffset,d=void 0===l?-100:l,u=e.footer,m=e.showProgressBar,b=void 0===m||m,f=e.showProgressLabel,g=void 0===f||f,j=e.showTabs,v=void 0===j||j,w=e.progressBarPosition,y=void 0===w?E.E.TOP:w,x=e.progressBarPrecision,C=void 0===x?2:x,_=e.forceProgress,k=e.stopwatchStartTime,I=Object(i.useRef)(null),T=Object(i.useRef)(null),M=Object(i.useRef)(!0);let B=o.findIndex((e=>e.id===t));-1===B&&(B=0);const L=_||B/(o.length||1)*100;return Object(i.useLayoutEffect)((()=>{M.current?M.current=!1:(T.current&&T.current.focus({preventScroll:!0}),c&&I.current&&Object(h.a)(I.current,{verticalOffset:d,cancelOnUserAction:!0,elementToScroll:Object(F.f)(I.current)[0]}))}),[t,c,d]),Object(O.jsxs)(D,{ref:I,className:Object(p.c)(P,{"has-footer":!!u},s),children:[v?Object(O.jsx)(Q,{currentTab:t,onTabChange:n,tabs:o}):null,b&&y===E.E.TOP?Object(O.jsx)(S,{width:L,labelPosition:"bottom",isTopRounded:!v,precision:C,showLabel:g}):null,Object(O.jsx)(q,{tabIndex:0,ref:T,children:r}),k?Object(O.jsx)(X,{stopwatchStartTime:k}):null,b&&y===E.E.BOTTOM?Object(O.jsx)(S,{width:L,isBottomRounded:!u,labelPosition:"top",precision:C,showLabel:g}):null,u?Object(O.jsx)(U,{children:u}):null]})}var J=n(448),ee=n(147);const te="wpeform-component-animatedsvg",ne=Object(p.d)(te,"svg"),oe=Object(m.f)(l.animated.path).withConfig({displayName:"AnimatedSvg__AnimatedPathFill",componentId:"sc-1crsfqd-0"})(["will-change:opacity,transform;"]),ie=Object(m.f)(l.animated.path).withConfig({displayName:"AnimatedSvg__AnimatedPathStroke",componentId:"sc-1crsfqd-1"})(["stroke-dasharray:65 66;will-change:stroke-dashoffset;"]),re=m.f.div.withConfig({displayName:"AnimatedSvg__Container",componentId:"sc-1crsfqd-2"})(["",";display:inline-flex;align-items:center;justify-content:center;.","{height:1em;width:1em;display:block;}"],p.b,ne);function se(e,t=2){const n=Object(l.useTrail)(t,(n=>({from:{strokeDashoffset:66},strokeDashoffset:0,config:n===t-1?e.springConfigSlow:{...e.springConfigGeneral,clamp:!0}})));return[Object(r.a)(n,1)[0],Object(l.useSpring)({from:{opacity:0,transform:"translate(0px, 0px)"},opacity:1,transform:"translate(2px, 2px)",config:e.springConfigSlow,delay:500})]}function ae(e){const t=e.colorfulBg,n=Object(m.h)(),o=se(n,2),i=Object(r.a)(o,2),s=i[0],a=i[1];return Object(O.jsx)(O.Fragment,{children:Object(O.jsxs)("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",className:ne,children:[Object(O.jsx)(oe,{style:a,stroke:t?n.successBackgroundColor:n.successColor,fill:t?n.successColor:n.successBackgroundColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"0",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(O.jsx)(ie,{strokeDashoffset:s[1].strokeDashoffset,stroke:t?n.successBackgroundColor:n.successColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(O.jsx)(ie,{strokeDashoffset:s[0].strokeDashoffset,stroke:t?n.successBackgroundColor:n.successColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M8.25 9.5L10.75 12L15.75 7"})]})})}function ce(e){const t=e.colorfulBg,n=Object(m.h)(),o=se(n,3),i=Object(r.a)(o,2),s=i[0],a=i[1];return Object(O.jsx)(O.Fragment,{children:Object(O.jsxs)("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",className:ne,children:[Object(O.jsx)(oe,{style:a,stroke:t?n.warningBackgroundColor:n.warningColor,fill:t?n.warningColor:n.warningBackgroundColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"0",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(O.jsx)(ie,{strokeDashoffset:s[2].strokeDashoffset,stroke:t?n.warningBackgroundColor:n.warningColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(O.jsx)(ie,{strokeDashoffset:s[0].strokeDashoffset,stroke:t?n.warningBackgroundColor:n.warningColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M11.99 13H12.01"}),Object(O.jsx)(ie,{strokeDashoffset:s[1].strokeDashoffset,stroke:t?n.warningBackgroundColor:n.warningColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M12 6V10"})]})})}function le(e){const t=e.colorfulBg,n=Object(m.h)(),o=se(n,3),i=Object(r.a)(o,2),s=i[0],a=i[1];return Object(O.jsx)(O.Fragment,{children:Object(O.jsxs)("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",className:ne,children:[Object(O.jsx)(oe,{style:a,stroke:t?n.errorBackgroundColor:n.errorColor,fill:t?n.errorColor:n.errorBackgroundColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"0",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(O.jsx)(ie,{strokeDashoffset:s[2].strokeDashoffset,stroke:t?n.errorBackgroundColor:n.errorColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(O.jsx)(ie,{strokeDashoffset:s[0].strokeDashoffset,stroke:t?n.errorBackgroundColor:n.errorColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M14.5 7L9.5 12"}),Object(O.jsx)(ie,{strokeDashoffset:s[1].strokeDashoffset,stroke:t?n.errorBackgroundColor:n.errorColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M9.5 7L14.5 12"})]})})}function de(e){const t=e.colorfulBg,n=Object(m.h)(),o=se(n,3),i=Object(r.a)(o,2),s=i[0],a=i[1];return Object(O.jsx)(O.Fragment,{children:Object(O.jsxs)("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",className:ne,children:[Object(O.jsx)(oe,{style:a,stroke:t?n.primaryBackgroundColor:n.primaryLightColor,fill:t?n.primaryLightColor:n.primaryBackgroundColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"0",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(O.jsx)(ie,{strokeDashoffset:s[2].strokeDashoffset,stroke:t?n.primaryBackgroundColor:n.primaryLightColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(O.jsx)(ie,{strokeDashoffset:s[0].strokeDashoffset,stroke:t?n.primaryBackgroundColor:n.primaryLightColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M16.99 13H17"}),Object(O.jsx)(ie,{strokeDashoffset:s[1].strokeDashoffset,stroke:t?n.primaryBackgroundColor:n.primaryLightColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M12.99 13H13"})]})})}function ue(e){const t=e.colorfulBg,n=e.type,o=e.className;return Object(O.jsx)(re,{className:Object(p.c)(te,{[`type-${n}`]:!0,colorfulBg:t},o),children:"error"===n?Object(O.jsx)(le,{colorfulBg:t}):"warning"===n?Object(O.jsx)(ce,{colorfulBg:t}):"success"===n?Object(O.jsx)(ae,{colorfulBg:t}):Object(O.jsx)(de,{colorfulBg:t})})}var me=n(98);const he="wpeform-component-actionfeedback",be=Object(p.d)(he,"title"),pe=Object(p.d)(he,"content"),fe=Object(p.d)(he,"footer"),ge=Object(p.d)(he,"icon"),je=m.f.div.withConfig({displayName:"ActionFeedback__IconContainer",componentId:"sc-irmrcs-0"})(["font-size:",";margin:0 0 "," 0;will-change:opacity,transform;display:flex;"],(e=>Object(p.n)(1.25*e.theme.fz.large8)),(e=>Object(p.n)(2*e.theme.gutter))),Oe=Object(m.f)(l.animated.h3).withConfig({displayName:"ActionFeedback__Title",componentId:"sc-irmrcs-1"})(["color:",";font-size:",";font-weight:bold;margin:0 0 "," 0;line-height:1.2;will-change:opacity,transform;"],(e=>e.theme.headingColor),(e=>Object(p.n)(e.theme.fz.large3)),(e=>Object(p.n)(e.theme.gutter))),ve=Object(m.f)(l.animated.article).withConfig({displayName:"ActionFeedback__Content",componentId:"sc-irmrcs-2"})(["",";will-change:opacity,transform;"],p.p),we=Object(m.f)(l.animated.footer).withConfig({displayName:"ActionFeedback__Footer",componentId:"sc-irmrcs-3"})(["color:",";font-size:",";margin:"," 0 0 0;will-change:opacity,transform;"],(e=>e.theme.textColorSecondary),(e=>Object(p.n)(e.theme.fz.small1)),(e=>Object(p.n)(e.theme.gutter))),ye=m.f.aside.withConfig({displayName:"ActionFeedback__Container",componentId:"sc-irmrcs-4"})(["",";margin:"," 0;padding:0 ",";&.","--size-tablet{","{font-size:",";}","{font-size:",";}}"],p.b,(e=>Object(p.n)(e.theme.gutter)),(e=>Object(p.n)(e.theme.gutter)),he,je,(e=>Object(p.n)(1.5*e.theme.fz.large8)),Oe,(e=>Object(p.n)(e.theme.fz.large4)));function xe(e){const t=e.type,n=e.title,o=e.children,s=e.className,a=e.scrollOnMount,c=void 0===a||a,d=e.scrollOffset,u=void 0===d?-100:d,b=e.footer,f=Object(m.h)(),g=Object(l.useTrail)(b?3:2,(e=>({from:{opacity:0,transform:"translate(0px, 20px)"},opacity:1,transform:"translate(0px, 0px)",config:0===e?f.springConfigGeneral:f.springConfigSlow,delay:500}))),j=Object(r.a)(g,1)[0],v=Object(p.u)(Object(me.c)(),he,{[`type-${t}`]:!0},s),w=Object(i.useRef)(!0),y=Object(i.useRef)(null);return Object(i.useLayoutEffect)((()=>{w.current&&(w.current=!1,c&&y.current&&Object(h.a)(y.current,{verticalOffset:u,cancelOnUserAction:!0,elementToScroll:Object(F.f)(y.current)[0]}))}),[c,u]),Object(O.jsxs)(ye,{className:v,ref:y,children:[Object(O.jsx)(je,{className:ge,children:Object(O.jsx)(ue,{type:t,colorfulBg:!1})}),Object(O.jsx)(Oe,{style:j[0],className:be,children:n}),Object(O.jsx)(ve,{style:j[1],className:pe,children:o}),b?Object(O.jsx)(we,{style:j[2],className:fe,children:b}):null]})}var Ce=n(366),_e=n(127),ke=n(34),Se=n(108),Ee=n(360),Ie=(n(199),n(447)),Te=n(218),Fe=n(216);function Pe(e){return e===E.k.BORDER_BOX?"border-box":e===E.k.CONTENT_BOX?"content-box":e===E.k.PADDING_BOX?"padding-box":"border-box"}const Me=m.f.div.withConfig({displayName:"Page__PageBgContainer",componentId:"sc-19bqagh-0"})(["",";background-image:",";background-size:",";background-position:",";background-repeat:",";background-origin:",";background-clip:",";background-attachment:",";"],p.b,(e=>{var t;return null!==(t=e.bg)&&void 0!==t&&t.backgroundImage?`url("${e.bg.backgroundImage}")`:"none"}),(e=>{var t,n;return null!==(t=null===(n=e.bg)||void 0===n?void 0:n.backgroundSize)&&void 0!==t?t:"auto"}),(e=>{var t,n;return null!==(t=null===(n=e.bg)||void 0===n?void 0:n.backgroundPosition)&&void 0!==t?t:"0% 0%"}),(e=>{var t,n;return(n=null===(t=e.bg)||void 0===t?void 0:t.backgroundRepeat)===E.l.REPEAT_BOTH?"repeat":n===E.l.REPEAT_NONE?"no-repeat":n===E.l.REPEAT_X?"repeat-x":n===E.l.REPEAT_Y?"repeat-y":"no-repeat"}),(e=>{var t;return Pe(null===(t=e.bg)||void 0===t?void 0:t.backgroundOrigin)}),(e=>{var t;return Pe(null===(t=e.bg)||void 0===t?void 0:t.backgroundClip)}),(e=>{var t,n;return(n=null===(t=e.bg)||void 0===t?void 0:t.backgroundAttachment)===E.j.FIXED?"fixed":n===E.j.LOCAL?"local":"scroll"}));function Be(){var e,t;const n=Object(Se.l)(),o=Object(Ee.i)(Ee.b),a=n.structures.find((e=>e.id===o)),c=Object(Ee.i)(Ee.d),l=Object(Se.j)(),d=Object(Ee.j)();let u;if(Object(i.useEffect)((()=>{var e,t;if(!c)return()=>{};if(null!==(e=n.styles)&&void 0!==e&&null!==(t=e.pagination)&&void 0!==t&&t.autoProgress){var o;let e=!0;const t=setTimeout((()=>{var t,o;if(e)if(l.canNext){const e=d.getState().elements,t=Object(Fe.f)(a,n.elements,e),o=Object(Fe.a)(e,t);Object(r.a)(o,1)[0]&&l.goNext()}else null!==(t=n.styles)&&void 0!==t&&null!==(o=t.pagination)&&void 0!==o&&o.autoSubmit&&l.canSubmit&&l.submit()}),null!==(o=n.styles.pagination.autoProgressDelay)&&void 0!==o?o:100);return()=>{e=!1,clearTimeout(t)}}return()=>{}}),[c,n,d,l,a]),a){const e=a.children;u=Object(O.jsx)(Te.a,{elements:e,emptyMessage:Object(s.__)("This page is empty.","wp-eform")})}else u=Object(O.jsx)(Ie.a,{icon:Object(O.jsx)(f.b,{iconClass:"fas fa-envelope-open"}),children:Object(s.__)("This page does not exist. Kindly navigate away from it.","wp-eform")});return Object(O.jsx)(Me,{bg:null!==(e=n.styles)&&void 0!==e&&null!==(t=e.customBackground)&&void 0!==t&&t.enabled?n.styles.customBackground:void 0,className:"wpeform-form-page",children:u})}n(286);var Le=n(33);const Ne={message:Object(s.__)("Some error has occured.","wp-eform"),dynamicAnchors:null,mentions:null,id:"unknown"};function Re(e){var t;const n=e.limitationMessage,o=Object(i.useMemo)((()=>[]),[]),r=Object(ke.n)(n.mentions),a=Object(ke.m)(n.dynamicAnchors),c=Object(ke.l)(n.message);return Object(O.jsx)(ke.f,{mode:"multiline",nodes:c||Object(Le.a)(Object(s.sprintf)(Object(s.__)("There has been some error related to %s.","wp-eform"),null!==(t=n.id)&&void 0!==t?t:"unknown")),excludeMentionsCharacters:o,additionalMentions:r,additionalDynamicAnchorTags:a})}function Ae(e){const t=e.messageJson,n=Object(i.useMemo)((()=>{try{const e=JSON.parse(null!=t?t:"");return"object"==typeof e&&void 0!==e.dynamicAnchors&&void 0!==e.mentions&&void 0!==e.message?e:Ne}catch(e){return Ne}}),[t]),o=function(){const e=Object(Se.l)().elements;return Object(i.useCallback)((t=>{var n;return e[t]?Object(O.jsx)("strong",{children:Object(O.jsx)(ke.d,{currentElementId:null,nodes:Object(Le.c)(null===(n=e[t].appearance)||void 0===n?void 0:n.title),mode:"singleline"})}):null}),[e])}();return Object(O.jsx)(ke.c,{mentions:o,children:Object(O.jsx)(Re,{limitationMessage:n})})}var De=n(367),ze=n.n(De),He=n(175);function Ve(e){const t=e.time,n=e.onDone,o=Object(He.d)(t,n),i=Object(I.c)(1e3*o,"number"),r=i.hours,a=i.minutes,c=i.seconds;return Object(O.jsxs)("span",{className:"wpeform-component-inlinecountdown",children:[r>0?Object(s.sprintf)(Object(s._n)("%d hour, ","%d hours, ",r,"wp-eform"),r):null,r>0||a>0?Object(s.sprintf)(Object(s._n)("%d minute, ","%d minutes, ",a,"wp-eform"),a):null,Object(s.sprintf)(Object(s._n)("%d second","%d seconds",c,"wp-eform"),c)]})}var $e=n(437),qe=(n(120),n(1077),n(368));function Ue(e,t,n){if(!t)return"";const o=t.reduce(((e,t)=>(e[t.scoreId]=t,e)),{}),i="percentage"===n?e.scorePercentageLogic:e.scoreTotalLogic;let r="";return i.forEach((e=>{if(!e.scoreId||!o[e.scoreId]||!o[e.scoreId].has)return;const t=o[e.scoreId],i="percentage"===n?t.obtained/t.outof*100:t.obtained;i<=e.to&&i>=e.from&&(r=e.url)})),r}function We(e){const t=e.config,n=e.submissionLink,o=e.scoreData;let r=t.url;const a=Object(Ee.i)(Ee.c),c=Object(Se.l)();t.type===E.v.FLAT?r=t.url:t.type===E.v.PORTAL?r=WPEFormGraphQLApp.userPortal:t.type===E.v.SUBMISSION?r=null!=n?n:t.url:t.type===E.v.CONDITIONAL?r=function(e,t,n){let o="";return e.forEach((e=>{Object(qe.b)(e.events,t,n)&&(o=e.url)})),o}(t.conditionalLogic,a,c.elements):t.type===E.v.SCOREPERCENTAGE?r=Ue(t,o,"percentage"):t.type===E.v.SCORETOTAL&&(r=Ue(t,o,"total")),""===r&&(r=t.url);const l=ze()(r),d=Object(i.useCallback)((()=>{t.iframeRedirect&&window.top&&window.top!==window.self?window.top.location.href=r:window.location.href=r}),[t.iframeRedirect,r]);Object($e.c)(d,t.delay,!l);const u=Object(i.useMemo)((()=>({"%REDIRECT_LINK%":r})),[r]);return l?Object(O.jsx)(ke.d,{mode:"multiline",nodes:Object(ke.g)(t.message),currentElementId:null,additionalMentions:{"::redirectDelay::":Object(O.jsx)(Ve,{time:t.delay})},additionalAnchors:u}):Object(O.jsx)("p",{children:Object(s.sprintf)(Object(s.__)("ERROR: The URL %s is invalid and cannot redirect. Please contact the site administrator for help.","wp-eform"),r)})}function Ke(e){const t=e.reset,n=e.delay,o=e.message;return Object($e.c)(t,n),Object(O.jsx)(ke.d,{mode:"singleline",nodes:Object(ke.g)(o),currentElementId:null,additionalMentions:{"::kioskResetTime::":Object(O.jsx)(Ve,{time:n})}})}const Ge="wpeform-component-timer",Ye=Object(m.f)(l.animated.div).withConfig({displayName:"Timer__TimerProgressContainer",componentId:"sc-1d2zn5q-0"})(["position:absolute;left:0;right:0;top:0;height:",";will-change:background-color;"],(e=>Object(p.n)(e.theme.controlHeightBase/8))),Qe=Object(m.f)(l.animated.div).withConfig({displayName:"Timer__TimerProgressAnimator",componentId:"sc-1d2zn5q-1"})(["will-change:width;position:absolute;right:0;top:0;height:",";background-color:",";max-width:100%;"],(e=>Object(p.n)(e.theme.controlHeightBase/8)),(e=>Object(j.b)(.1,e.theme.backgroundShade))),Xe=m.f.div.withConfig({displayName:"Timer__TimerIconContainer",componentId:"sc-1d2zn5q-2"})(["flex:0 0 ",";margin:0 "," 0 0;height:",";width:",";font-size:",";line-height:1;display:flex;align-items:center;justify-content:center;color:",";"],(e=>Object(p.n)(.8*e.theme.controlHeightBase)),(e=>Object(p.n)(e.theme.gutter/2)),(e=>Object(p.n)(.8*e.theme.controlHeightBase)),(e=>Object(p.n)(.8*e.theme.controlHeightBase)),(e=>Object(p.n)(.8*e.theme.controlHeightBase)),(e=>Object(j.b)(.1,e.theme.backgroundShade)));function Ze(){return Object(O.jsx)(Xe,{children:Object(O.jsx)(f.b,{iconClass:"fas fa-clock"})})}const Je=m.f.div.withConfig({displayName:"Timer__TimerMainContainer",componentId:"sc-1d2zn5q-3"})(["width:calc( 100% - "," );flex:0 0 calc(100% - ",");"],(e=>Object(p.n)(.8*e.theme.controlHeightBase)),(e=>Object(p.n)(.8*e.theme.controlHeightBase))),et=m.f.div.withConfig({displayName:"Timer__TimerClockContainer",componentId:"sc-1d2zn5q-4"})(["display:flex;flex-flow:row nowrap;align-items:center;"]),tt=m.f.div.withConfig({displayName:"Timer__TimeContainer",componentId:"sc-1d2zn5q-5"})(["font-size:",";font-weight:bold;line-height:1.2;color:",";font-variant-numeric:tabular-nums;small{font-size:",";font-weight:normal;}"],(e=>Object(p.n)(e.theme.fz.large2)),(e=>e.theme.headingColor),(e=>Object(p.n)(e.theme.fz.small2))),nt=m.f.div.withConfig({displayName:"Timer__TickContainer",componentId:"sc-1d2zn5q-6"})(["font-size:",";margin:0 ",";line-height:1.2;"],(e=>Object(p.n)(e.theme.fz.large1)),(e=>Object(p.n)(e.theme.gutter/5))),ot=m.f.div.withConfig({displayName:"Timer__TimerMessage",componentId:"sc-1d2zn5q-7"})(["font-size:",";color:",";margin:0;padding:0;",";.","{",";}"],(e=>Object(p.n)(e.theme.fz.small2)),(e=>e.theme.textColorSecondary),p.s,ke.a,p.s),it=m.f.div.withConfig({displayName:"Timer__TimerWrapper",componentId:"sc-1d2zn5q-8"})(["display:flex;align-items:center;flex-flow:row nowrap;padding:",";padding-top:",";"],(e=>Object(p.n)(e.theme.gutter/2)),(e=>Object(p.n)(e.theme.gutter/2+e.theme.controlHeightBase/8))),rt=m.f.div.withConfig({displayName:"Timer__TimerContainer",componentId:"sc-1d2zn5q-9"})(["",";font-family:",";background-color:",";position:relative;&.","--hidden{display:none;}@media screen and (min-width:","){","{padding:",";padding-top:",";}","{flex-basis:",";margin-right:",";height:",";width:",";font-size:",";}","{width:calc( 100% - "," );flex-basis:calc( 100% - "," );}","{font-size:",";small{font-size:",";}}","{font-size:",";}","{font-size:",";}}"],p.b,(e=>e.theme.fontFamilyBody),(e=>e.theme.backgroundShade),Ge,(e=>Object(p.n)(e.theme.breakpoints.tablet)),it,(e=>Object(p.n)(e.theme.gutter)),(e=>Object(p.n)(e.theme.gutter+e.theme.controlHeightBase/8)),Xe,(e=>Object(p.n)(1.2*e.theme.controlHeightBase)),(e=>Object(p.n)(e.theme.gutter)),(e=>Object(p.n)(1.2*e.theme.controlHeightBase)),(e=>Object(p.n)(1.2*e.theme.controlHeightBase)),(e=>Object(p.n)(1.2*e.theme.controlHeightBase)),Je,(e=>Object(p.n)(1.2*e.theme.controlHeightBase)),(e=>Object(p.n)(1.2*e.theme.controlHeightBase)),tt,(e=>Object(p.n)(e.theme.fz.large3)),(e=>Object(p.n)(e.theme.fz.small1)),nt,(e=>Object(p.n)(e.theme.fz.large2)),ot,(e=>Object(p.n)(e.theme.fz.small1))),st=m.f.div.withConfig({displayName:"Timer__Placeholder",componentId:"sc-1d2zn5q-10"})(["height:",";@media screen and (min-width:","){height:",";}"],(e=>Object(p.n)(e.theme.gutter+e.theme.controlHeightBase/8+1.2*e.theme.fz.large2+1.2*e.theme.fz.small2+10)),(e=>Object(p.n)(e.theme.breakpoints.tablet)),(e=>Object(p.n)(2*e.theme.gutter+e.theme.controlHeightBase/8+1.2*e.theme.fz.large3+1.2*e.theme.fz.small1+10))),at=m.f.div.withConfig({displayName:"Timer__Portal",componentId:"sc-1d2zn5q-11"})(["position:fixed;bottom:0;left:0;width:100%;z-index:999995;"]);function ct(e){const t=e.time,n=e.onDone,o=e.message,r=e.showUI,a=e.width,c=void 0===a?"100%":a,d=e.containerLayout,u=void 0===d?E.A.FIXED:d,h=Object(He.d)(t,n),b=Object(m.h)(),f=h/t*100,g=Object(l.useSpring)({from:{backgroundColor:b.successColor},to:{backgroundColor:f>60?b.successColor:f>20?b.warningColor:b.errorColor},config:b.springConfigSlow}),j=Object(l.useSpring)({from:{width:"0%"},to:{width:`${Object(p.n)(100-f,"%")}`},config:b.springConfigSlow}),v=Object(I.c)(1e3*h,"string"),w=v.hours,y=v.minutes,x=v.seconds,C=Object(p.c)(Ge,{hidden:!r}),_=Object(i.useMemo)((()=>Object(I.c)(1e3*t,"number")),[t]).hours;return Object(O.jsx)(rt,{className:C,children:Object(O.jsx)(me.a,{width:c,containerLayout:u,noHorizontalPadding:!0,noVerticalPadding:!0,children:Object(O.jsxs)(it,{children:[Object(O.jsx)(Ye,{style:g,children:Object(O.jsx)(Qe,{style:j})}),Object(O.jsx)(Ze,{}),Object(O.jsxs)(Je,{children:[Object(O.jsxs)(et,{children:[_>0?Object(O.jsxs)(O.Fragment,{children:[Object(O.jsxs)(tt,{children:[w,Object(O.jsx)("small",{children:Object(s._x)("h","hours short form","wp-eform")})]}),Object(O.jsx)(nt,{children:":"})]}):null,Object(O.jsxs)(tt,{children:[y,Object(O.jsx)("small",{children:Object(s._x)("m","minutes short form","wp-eform")})]}),Object(O.jsx)(nt,{children:":"}),Object(O.jsxs)(tt,{children:[x,Object(O.jsx)("small",{children:Object(s._x)("s","seconds short form","wp-eform")})]})]}),o?Object(O.jsx)(ot,{children:o}):null]})]})})})}ct.Placeholder=st,ct.Portal=at;var lt=n(281);function dt(e){const t=e.timerConfig,n=e.currentPageConfig,o=e.goNext,r=e.canSubmit,s=e.submit,a=e.submitting,c=e.width,l=e.containerLayout,d=Object(ke.l)(null==t?void 0:t.timerMessage),u=Object(i.useCallback)((()=>{0}),[r,o,s,t,a]);if(!t||!n)return null;if(t.submitTimer===E.G.NONE)return null;let m,h;if(t.submitTimer===E.G.OVERALL?(m=t.timeLimit,h="overall"):(m=n.config.timer,h=n.id),!m||m<0)return null;const b=t.showTimer&&!a&&Object(lt.a)("starter");return Object(O.jsxs)(O.Fragment,{children:[b?Object(O.jsx)(ct.Placeholder,{}):null,Object(O.jsx)(me.a.Portal,{children:Object(O.jsx)(ct.Portal,{children:Object(O.jsx)(ct,{showUI:b,time:m,message:d?Object(O.jsx)(ke.d,{nodes:d,currentElementId:null,mode:"singleline"}):void 0,onDone:u,width:c,containerLayout:l},h)})})]})}var ut=n(450),mt=n(449);const ht=m.f.div.withConfig({displayName:"Remarks__Container",componentId:"sc-123x1v6-0"})(["padding:",";border-radius:",";background-color:",";margin:0 0 "," 0;"],(e=>Object(p.n)(e.theme.gutter)),(e=>Object(p.n)(e.theme.borderRadiusBase)),(e=>e.theme.backgroundShade),(e=>Object(p.n)(e.theme.gutter)));function bt(){const e=Object(He.c)(),t=Object(Ee.i)(Ee.e),n=Object(Ee.h)(),o=Object(i.useCallback)((e=>{n({type:"SET_REMARKS",payload:{remarks:e}})}),[n]);return Object(O.jsx)(ht,{children:Object(O.jsx)(ut.a,{title:Object(s.__)("Administrator Remarks","wp-eform"),subtitle:Object(s.__)("this will show up in submission summary.","wp-eform"),id:`${e}-remarks`,children:Object(O.jsx)(mt.a,{value:t,onChange:o})})})}function pt(e){var t,n,o,a,c,l,d,u,m,h,b,p,f,g,j,v,w,y,x,C,_,k,S,I,T,F,P,M,B,L,N,R,A,D,z,H,V,$,q,U,W,K,G,Y,Q,X,te,ne,oe,ie,re,se,ae,ce,le,de,ue,me,he,be,pe,fe,ge,je,Oe,ve,we,ye,Ie,Te,Pe,Me,Le,Ne,De,ze,He,Ve,$e,qe,Ue,Ge,Ye,Qe,Xe,Ze,Je,et,tt,nt,ot,it,rt,st,at,ct,lt,ut,mt,ht,pt,ft,gt,jt;const Ot=e.activePage,vt=e.onActivePageChange,wt=e.onSubmit,yt=e.submitting,xt=e.submitted,Ct=e.submittedState,_t=e.submissionError,kt=e.onReset,St=e.onErrorRetry,Et=e.limitations,It=e.mutationData,Tt=e.notices,Ft=e.initialData,Pt=Object(Ee.h)(),Mt=Object(Ee.j)(),Bt=Object(Se.m)(),Lt=Object(Se.l)(),Nt=Object(Ee.i)(Ee.b),Rt=Object(Ee.i)(Ee.g),At=Object(Ee.i)(Ee.f),Dt=Object(i.useState)(!1),zt=Object(r.a)(Dt,2),Ht=zt[0],Vt=zt[1],$t=Object(i.useState)(null),qt=Object(r.a)($t,2),Ut=qt[0],Wt=qt[1],Kt=Object(Se.n)(),Gt=Object(Se.i)();Object(i.useEffect)((()=>{Wt(null),Vt(!1),Pt({type:"SET_ELEMENTS_AND_STARTTIME",payload:{structures:Object(Fe.e)(Lt),elements:Object(Fe.d)(Lt,Bt,!0,Ft),formData:Lt,formMeta:Bt,conditionalsMap:Gt,fullReset:"preview"===Kt||"listview"===Kt}})}),[Pt,Bt,Lt,Gt,Ft,Kt]);const Yt=Object(i.useMemo)((()=>Lt.structures.filter((e=>{if("preview"===Kt)return!0;const t=Rt[e.id];return!t||!t.conditionallyHidden})).map((e=>({id:e.id,title:e.config.title,subtitle:e.config.subtitle,icon:e.config.icon||void 0})))),[Lt.structures,Kt,Rt]);Object(i.useEffect)((()=>{!Yt.find((e=>e.id===Nt))&&Yt.length&&Pt({type:"SET_CURRENT_PAGE",payload:Yt[0].id})}),[Yt,Nt,Pt]);const Qt=("newsubmission"===Kt||"useredit"===Kt)&&(null===(t=Lt.settings)||void 0===t||null===(n=t.timer)||void 0===n?void 0:n.submitTimer)!==E.G.NONE,Xt=Object(i.useMemo)((()=>Lt.structures.find((e=>e.id===Nt))),[Nt,Lt.structures]),Zt=Yt.findIndex((e=>e.id===Nt)),Jt=0===Zt?null:Yt[Zt-1]?Yt[Zt-1].id:null,en=Yt[Zt+1]?Yt[Zt+1].id:Nt,tn=Object(i.useCallback)(((e,t=!1)=>{var n,o;const i=()=>{Pt({type:"SET_CURRENT_PAGE",payload:e}),vt&&vt(e)};if("preview"===Kt||(null===(n=Lt.styles)||void 0===n||null===(o=n.pagination)||void 0===o?void 0:o.paginationRestriction)===E.i.NONE)return void i();if(Qt&&e===en&&t)return i(),Vt(!1),void Wt(null);const s=Mt.getState().elements,a=Object(Fe.f)(Xt,Lt.elements,s),c=Object(Fe.a)(s,a),l=Object(r.a)(c,2),d=l[0],u=l[1];if(Yt.findIndex((t=>t.id===e))<Zt){var m,h,b,p;if(Qt)return;if(null!==(m=Lt.styles)&&void 0!==m&&null!==(h=m.pagination)&&void 0!==h&&h.blockPreviousNavigation)return;return(null===(b=Lt.styles)||void 0===b||null===(p=b.pagination)||void 0===p?void 0:p.paginationRestriction)!==E.i.ONLY_WHEN_ALL_VALID||d?(Vt(!1),Wt(null),Pt({type:"SET_CURRENT_PAGE",payload:e}),void(vt&&vt(e))):(Vt(!0),void Wt(u))}if(d)return Vt(!1),Wt(null),Pt({type:"SET_CURRENT_PAGE",payload:en}),void(vt&&vt(en));Vt(!0),Wt(u)}),[vt,Kt,Xt,Zt,Pt,Lt,Mt,Yt,en,Qt]);Object(i.useEffect)((()=>{Ot&&Ot!==Nt&&Pt({type:"SET_CURRENT_PAGE",payload:Ot})}),[Pt,Ot,Nt]);const nn=!(Qt||!Jt||null!==(o=Lt.styles)&&void 0!==o&&null!==(a=o.pagination)&&void 0!==a&&a.blockPreviousNavigation||yt),on=Object(i.useCallback)((()=>{Jt&&tn(Jt)}),[Jt,tn]),rn=en!==Nt&&!yt,sn=Object(i.useCallback)(((e=!1)=>{tn(en,e)}),[tn,en]),an=en===Nt&&!yt,cn=Object(i.useCallback)(((e=!1)=>{if(Qt&&e)return void wt(Mt);const t=Mt.getState().elements,n=Object(Fe.f)(Xt,Lt.elements,t),o=Object(Fe.a)(t,n),i=Object(r.a)(o,2),s=i[0],a=i[1];if(!s)return Vt(!0),void Wt(a);wt(Mt)}),[Xt,Lt,Mt,wt,Qt]),ln=(!yt||yt&&xt)&&!Qt,dn=Object(i.useCallback)((()=>{Pt({type:"SET_ELEMENTS_AND_STARTTIME",payload:{structures:Object(Fe.e)(Lt),elements:Object(Fe.d)(Lt,Bt,!0),formData:Lt,formMeta:Bt,conditionalsMap:Gt,fullReset:!0}}),Wt(null),Vt(!1);const e=Yt[0].id;Pt({type:"SET_CURRENT_PAGE",payload:e}),vt&&vt(e),kt&&kt()}),[Pt,Lt,Bt,vt,Yt,kt,Gt]),un=Object(i.useCallback)((()=>{var e,t;window.confirm((null===(e=Lt.styles)||void 0===e||null===(t=e.pagination)||void 0===t?void 0:t.resetMessage)||Object(s.__)("This will reset the form. Action cannot be undone, are you sure?","wp-eform"))&&dn()}),[dn,Lt]),mn=Object(i.useMemo)((()=>({canNext:rn,canPrevious:nn,canSubmit:an,goNext:sn,goPrevious:on,submit:cn,canReset:ln,reset:un,submitting:yt,submitted:xt,submittedState:Ct})),[rn,nn,an,sn,on,cn,ln,un,yt,xt,Ct]),hn=null!==(c=Lt.styles)&&void 0!==c&&null!==(l=c.pagination)&&void 0!==l&&l.barlike?"flat":null!==(d=null===(u=Lt.styles)||void 0===u||null===(m=u.pagination)||void 0===m?void 0:m.style)&&void 0!==d?d:"flat",bn=null!==(h=null===(b=Lt.styles)||void 0===b||null===(p=b.pagination)||void 0===p?void 0:p.size)&&void 0!==h?h:E.o.DEFAULT,pn=null!==(f=null===(g=Lt.styles)||void 0===g||null===(j=g.pagination)||void 0===j?void 0:j.colored)&&void 0!==f&&f,fn=null===(v=Lt.styles)||void 0===v||null===(w=v.pagination)||void 0===w?void 0:w.rounded;let gn=Object(O.jsx)(ee.b,{style:hn,size:bn,colorful:pn,icon:null===(y=Lt.styles)||void 0===y||null===(x=y.pagination)||void 0===x?void 0:x.prevIcon,iconPosition:(null===(C=Lt.styles)||void 0===C||null===(_=C.pagination)||void 0===_?void 0:_.prevIconPosition)===E.a.BEFORE?"before":"after",onClick:on,rounded:fn,disabled:!nn,children:null===(k=Lt.styles)||void 0===k||null===(S=k.pagination)||void 0===S?void 0:S.prevLabel});const jn="newsubmission"===Kt||"preview"===Kt||"listview"===Kt?"new":"update",On="new"===jn?null===(I=Lt.styles)||void 0===I||null===(T=I.pagination)||void 0===T?void 0:T.submitIconPosition:null===(F=Lt.styles)||void 0===F||null===(P=F.pagination)||void 0===P?void 0:P.updateIconPosition;let vn=Object(O.jsx)(ee.b,{style:hn,size:bn,colorful:pn,icon:"new"===jn?null===(M=Lt.styles)||void 0===M||null===(B=M.pagination)||void 0===B?void 0:B.submitIcon:null===(L=Lt.styles)||void 0===L||null===(N=L.pagination)||void 0===N?void 0:N.updateIcon,iconPosition:On===E.a.BEFORE?"before":"after",onClick:()=>{cn()},rounded:fn,disabled:!an,loading:yt,loadingDone:xt,loadedState:"success"===Ct?"success":"error",children:"new"===jn?null===(R=Lt.styles)||void 0===R||null===(A=R.pagination)||void 0===A?void 0:A.submitLabel:null===(D=Lt.styles)||void 0===D||null===(z=D.pagination)||void 0===z?void 0:z.updateLabel}),wn=Object(O.jsx)(ee.b,{style:hn,size:bn,colorful:pn,icon:null===(H=Lt.styles)||void 0===H||null===(V=H.pagination)||void 0===V?void 0:V.nextIcon,iconPosition:(null===($=Lt.styles)||void 0===$||null===(q=$.pagination)||void 0===q?void 0:q.nextIconPosition)===E.a.BEFORE?"before":"after",onClick:()=>{sn()},rounded:fn,disabled:!rn,children:null===(U=Lt.styles)||void 0===U||null===(W=U.pagination)||void 0===W?void 0:W.nextLabel}),yn=null!==(K=Lt.styles)&&void 0!==K&&null!==(G=K.pagination)&&void 0!==G&&G.showResetButton?Object(O.jsx)(ee.b,{style:hn,size:bn,colorful:pn,icon:null===(Y=Lt.styles)||void 0===Y||null===(Q=Y.pagination)||void 0===Q?void 0:Q.resetIcon,iconPosition:(null===(X=Lt.styles)||void 0===X||null===(te=X.pagination)||void 0===te?void 0:te.resetIconPosition)===E.a.BEFORE?"before":"after",onClick:un,rounded:fn,disabled:!ln,children:null===(ne=Lt.styles)||void 0===ne||null===(oe=ne.pagination)||void 0===oe?void 0:oe.resetLabel}):null;null!==(ie=Lt.styles)&&void 0!==ie&&null!==(re=ie.pagination)&&void 0!==re&&re.hideWhenNotRelevant&&(nn||(gn=null),rn?vn=null:wn=null,ln||(yn=null)),1===Lt.structures.length&&(wn=null,gn=null);let xn=null;var Cn,_n,kn,Sn;yt&&xt&&"success"===Ct&&"newsubmission"===Kt&&((null===(Cn=Lt.styles)||void 0===Cn||null===(_n=Cn.redirection)||void 0===_n?void 0:_n.type)!==E.v.NONE?xn=Object(O.jsx)(We,{config:Lt.styles.redirection,submissionLink:null==It?void 0:It.submissionLink,scoreData:null==It?void 0:It.scoreData}):!0===(null===(kn=Lt.styles)||void 0===kn||null===(Sn=kn.formBehavior)||void 0===Sn?void 0:Sn.kioskMode)&&(xn=Object(O.jsx)(Ke,{reset:dn,delay:Lt.styles.formBehavior.kioskTime,message:Lt.styles.formBehavior.kioskMessage})));return Object(O.jsx)(O.Fragment,{children:yt&&xt?Object(O.jsx)(xe,{type:"success"===Ct?"success":"error",title:"success"===Ct?Object(O.jsx)(ke.d,{mode:"singleline",nodes:Object(ke.g)("useredit"===Kt?null===(se=Lt.styles)||void 0===se||null===(ae=se.formBehavior)||void 0===ae?void 0:ae.updateSubject:"adminedit"===Kt?Object(s.__)("The submission has been updated.","wp-eform"):null===(ce=Lt.styles)||void 0===ce||null===(le=ce.formBehavior)||void 0===le?void 0:le.subject),currentElementId:null}):Object(O.jsx)(ke.d,{mode:"singleline",nodes:Object(ke.g)(null!==(de=null===(ue=Lt.styles)||void 0===ue||null===(me=ue.formBehavior)||void 0===me?void 0:me.errorSubject)&&void 0!==de?de:Object(s.__)("Oops, we have encountered an error!","wp-eform")),currentElementId:null}),footer:xn,children:"success"===Ct?Object(O.jsx)(ke.d,{currentElementId:null,mode:"multiline",nodes:Object(ke.g)("useredit"===Kt?null===(he=Lt.styles)||void 0===he||null===(be=he.formBehavior)||void 0===be?void 0:be.updateMessage:"adminedit"===Kt?Object(s.__)("We have also sent an email to the user about this update.","wp-eform"):null===(pe=Lt.styles)||void 0===pe||null===(fe=pe.formBehavior)||void 0===fe?void 0:fe.message)}):Object(O.jsxs)(O.Fragment,{children:["submissionValidationLogic"===(null==_t||null===(ge=_t.graphQLErrors[0])||void 0===ge||null===(je=ge.extensions)||void 0===je?void 0:je.category)?Object(O.jsx)(Ae,{messageJson:null!==(Oe=null==_t||null===(ve=_t.graphQLErrors[0])||void 0===ve?void 0:ve.message)&&void 0!==Oe?Oe:""}):null==_t?void 0:_t.message,St?Object(O.jsx)("p",{children:Object(O.jsx)(ee.b,{size:bn,style:hn,colorful:pn,icon:null!==(we=null===(ye=Lt.styles)||void 0===ye||null===(Ie=ye.formBehavior)||void 0===Ie?void 0:Ie.errorRetryButtonIcon)&&void 0!==we?we:"fas fa-sync-alt",iconPosition:(null===(Te=Lt.styles)||void 0===Te||null===(Pe=Te.formBehavior)||void 0===Pe?void 0:Pe.errorRetryButtonIconPosition)===E.a.AFTER?"after":"before",onClick:St,rounded:fn,children:null!==(Me=null===(Le=Lt.styles)||void 0===Le||null===(Ne=Le.formBehavior)||void 0===Ne?void 0:Ne.errorRetryButtonLabel)&&void 0!==Me?Me:Object(s.__)("RETRY","wp-eform")})}):null]})}):Object(O.jsx)(Se.d.Provider,{value:Ht,children:Object(O.jsx)(Se.a.Provider,{value:Ut,children:Object(O.jsx)(Se.c.Provider,{value:mn,children:Et&&Et.length>0&&"newsubmission"===Kt?Et.map((e=>Object(O.jsx)(_e.a.Bottom,{children:Object(O.jsx)(Ce.a,{type:"error",icon:"fas fa-times",dismissable:!1,children:Object(O.jsx)(Re,{limitationMessage:e})})},e.id))):Object(O.jsxs)(O.Fragment,{children:["adminedit"===Kt?Object(O.jsx)(bt,{}):null,Tt&&Tt.length&&"newsubmission"===Kt?Tt.map((e=>Object(O.jsx)(_e.a.Bottom,{children:Object(O.jsx)(Ce.a,{type:"regular",icon:"fas fa-exclamation",dismissable:!0,children:Object(O.jsx)(Re,{limitationMessage:e})})},e.id))):null,Object(O.jsxs)("form",{method:"post",action:"",autoComplete:null!==(De=Lt.styles)&&void 0!==De&&null!==(ze=De.formBehavior)&&void 0!==ze&&ze.disabledAutoComplete?"off":"on",onSubmit:e=>{e.preventDefault()},children:[Object(O.jsx)(Z,{showTabs:null===(He=Lt.styles)||void 0===He||null===(Ve=He.pagination)||void 0===Ve?void 0:Ve.showTabs,currentTab:Nt,onTabChange:tn,showProgressBar:null===($e=Lt.styles)||void 0===$e||null===(qe=$e.pagination)||void 0===qe?void 0:qe.showProgressBar,showProgressLabel:null===(Ue=Lt.styles)||void 0===Ue||null===(Ge=Ue.pagination)||void 0===Ge?void 0:Ge.showProgressLabel,forceProgress:yt?100:void 0,progressBarPosition:null===(Ye=Lt.styles)||void 0===Ye||null===(Qe=Ye.pagination)||void 0===Qe?void 0:Qe.progressBarPosition,progressBarPrecision:null===(Xe=Lt.styles)||void 0===Xe||null===(Ze=Xe.pagination)||void 0===Ze?void 0:Ze.progressDecimalPoint,scrollOnTabChange:null===(Je=Lt.styles)||void 0===Je||null===(et=Je.pagination)||void 0===et?void 0:et.autoScroll,tabScrollOffset:void 0!==(null===(tt=Lt.styles)||void 0===tt||null===(nt=tt.pagination)||void 0===nt?void 0:nt.scrollOffset)?-1*Lt.styles.pagination.scrollOffset:-100,tabs:Yt,stopwatchStartTime:null!==(ot=Lt.settings)&&void 0!==ot&&null!==(it=ot.timer)&&void 0!==it&&it.recordSubmissionTime&&Lt.settings.timer.showStopwatch?At:void 0,footer:null!==(rt=Lt.styles)&&void 0!==rt&&null!==(st=rt.pagination)&&void 0!==st&&st.panelEnabled?Object(O.jsxs)(J.a,{align:null!==(at=null===(ct=Lt.styles)||void 0===ct||null===(lt=ct.pagination)||void 0===lt?void 0:lt.alignment)&&void 0!==at?at:E.n.RIGHT,type:null!==(ut=Lt.styles)&&void 0!==ut&&null!==(mt=ut.pagination)&&void 0!==mt&&mt.barlike?"navbar":"regular",colorful:pn,hasGutterOnregular:!0,children:[gn,vn,wn,yn]}):null,children:Object(O.jsx)(Be,{})}),"newsubmission"===Kt||"useredit"===Kt?Object(O.jsx)(dt,{timerConfig:null===(ht=Lt.settings)||void 0===ht?void 0:ht.timer,currentPageConfig:Xt,goNext:sn,submit:cn,canSubmit:an,width:null===(pt=Lt.styles)||void 0===pt||null===(ft=pt.appearance)||void 0===ft?void 0:ft.maxWidth,containerLayout:null===(gt=Lt.styles)||void 0===gt||null===(jt=gt.appearance)||void 0===jt?void 0:jt.containerLayout,submitting:yt}):null]})]})})})})})}function ft(e){const t=e.children,n=e.mutationData,o=function(e){var t;const n=Object(Ee.i)(Ee.c),o=Object(Se.l)(),r=o.elements,s=null===(t=o.settings)||void 0===t?void 0:t.score,a=Object(i.useMemo)((()=>{var t;return e?{"::fName::":e.fName,"::lName::":e.lName,"::email::":e.email,"::phone::":e.phone,"::submissionId::":e.token,"::formName::":null!==(t=o.name)&&void 0!==t?t:""}:null}),[e,o.name]);return Object(i.useCallback)((t=>Object(ke.i)(t,n,r,a,s,null==e?void 0:e.scoreData)),[n,r,e,s,a])}(n),r=Object(i.useMemo)((()=>{const e={};return e["%FORM_LINK%"]=window.location.href,null!=n&&n.submissionLink&&(e["%SUBMISSION_LINK%"]=n.submissionLink),e}),[n]);return Object(O.jsx)(ke.c,{mentions:o,children:Object(O.jsx)(ke.b,{dynamicAnchors:r,children:t})})}var gt=n(1036);const jt=["formData","formMeta","mode","initialData","activePage","onActivePageChange","mutationData","formHeader"];function Ot(e){const t=e.formData,n=e.formMeta,r=e.mode,s=e.initialData,a=e.activePage,c=e.onActivePageChange,l=e.mutationData,d=e.formHeader,u=void 0===d?null:d,m=Object(o.a)(e,jt),h=t.styles,b=Object(gt.c)(h),p=Object(i.useMemo)((()=>{const e={};return t.conditionals.forEach((t=>{t.events.forEach((n=>{e[n.fieldid]||(e[n.fieldid]=[]),e[n.fieldid].includes(t.id)||e[n.fieldid].push(t.id)}))})),e}),[t]);return Object(O.jsx)(Ee.a,{initialData:null!=s?s:{...Fe.c,currentPage:null!=a?a:t.structures&&t.structures.length?t.structures[0].id:"",startTime:Date.now()},children:Object(O.jsx)(Se.e.Provider,{value:t,children:Object(O.jsx)(Se.f.Provider,{value:n,children:Object(O.jsx)(Se.g.Provider,{value:r,children:Object(O.jsx)(Se.b.Provider,{value:p,children:Object(O.jsx)(ft,{mutationData:l,children:Object(O.jsxs)(gt.a,{themeStyle:b,mode:"preview"!==r?"live":"preview",children:[u,Object(O.jsx)(pt,{activePage:a,onActivePageChange:c,...m,mutationData:l,initialData:s})]})})})})})})})}},1088:function(e,t,n){"use strict";n.d(t,"a",(function(){return m}));var o=n(1189);const i=o.a`
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
`},1090:function(e,t,n){var o=n(1108),i=n(1110),r=n(1111),s=n(1112);e.exports=function(e,t,n){return Array.isArray(e)||(e=[e]),s(e.map((function(e){return r(e)?function(e,t,n){var s=0,a=0;if(""===e)return e;if(!e||!r(e))throw new TypeError("First argument to react-string-replace#replaceString must be a string");var c=t;o(c)||(c=new RegExp("("+i(c)+")","gi"));for(var l=e.split(c),d=1,u=l.length;d<u;d+=2)a=l[d].length,s+=l[d-1].length,l[d]=n(l[d],d,s),s+=a;return l}(e,t,n):e})))}},1093:function(e,t,n){"use strict";n.d(t,"a",(function(){return u}));n(0);var o=n(3),i=n(147),r=n(8),s=n(289),a=n(364),c=n(1039),l=n(1);function d(e){const t=e.lastError,n=e.resetError,s=e.themeStyle;return Object(l.jsx)(c.a,{themeStyle:s,children:Object(l.jsx)(a.a,{type:"client",title:Object(o.__)("Something went wrong","wp-eform"),description:Object(l.jsxs)(l.Fragment,{children:[Object(l.jsx)("p",{children:Object(o.__)("There was an error in the application. Reloading the page might fix it.","wp-eform")}),t&&t.toString?Object(l.jsxs)(l.Fragment,{children:[Object(l.jsx)("p",{children:Object(o.__)("More information on the error can be found below.","wp-eform")}),Object(l.jsx)("p",{children:t.toString()})]}):null]}),footer:Object(l.jsxs)(l.Fragment,{children:[Object(l.jsx)(i.b,{onClick:()=>{window.location.reload()},style:"3d",size:r.o.SMALL,children:Object(o.__)("RELOAD PAGE","wp-eform")}),Object(l.jsx)(i.b,{onClick:()=>{n()},style:"3d",size:r.o.SMALL,colorful:!1,children:Object(o.__)("RETRY WITHOUT RELOAD","wp-eform")})]})})})}function u(e){const t=e.children,n=e.themeStyle;return Object(l.jsx)(s.a,{fallback:(e,t)=>Object(l.jsx)(d,{resetError:e,lastError:t,themeStyle:n}),children:t})}},1094:function(e,t,n){"use strict";n.d(t,"b",(function(){return g})),n.d(t,"a",(function(){return j}));var o=n(1189),i=n(1080),r=n(1081),s=n(1082),a=n(1088),c=n(1083),l=n(1079),d=n(1063),u=n(1072),m=n(1073),h=n(1074),b=n(1075),p=n(1076),f=n(1084);const g=o.a`
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
	${h.a}
	${b.a}
	${p.a}
	# Structure Fragments
	${f.a}
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
`},1095:function(e,t,n){"use strict";n.d(t,"a",(function(){return I}));n(0);var o=n(7),i=n(29),r=n(438),s=n(2),a=n(127),c=n(8),l=n(165),d=n(1070),u=n(1);const m=o.f.div.withConfig({displayName:"FormSkeleton__SkeletonWrapper",componentId:"sc-1xvkpmg-0"})(["",";"],s.b),h=o.f.div.withConfig({displayName:"FormSkeleton__SkeletonContainer",componentId:"sc-1xvkpmg-1"})(["margin:0 auto;box-shadow:",";border-radius:",";overflow:hidden;"],(e=>e.theme.boxShadow4dp),(e=>Object(s.n)(e.theme.borderRadiusBase))),b=o.f.div.withConfig({displayName:"FormSkeleton__SkeletonTabsContainer",componentId:"sc-1xvkpmg-2"})(["background-color:",";width:100%;overflow:hidden;border-top-left-radius:",";border-top-right-radius:",";padding:0 "," 0 0;"],(e=>Object(i.d)(.003,e.theme.backgroundControl)),(e=>Object(s.n)(e.theme.borderRadiusBase)),(e=>Object(s.n)(e.theme.borderRadiusBase)),(e=>Object(s.n)(e.theme.gutter))),p=o.f.div.withConfig({displayName:"FormSkeleton__SkeletonTabsButtonsContainer",componentId:"sc-1xvkpmg-3"})(["height:",";overflow:hidden;display:flex;flex-flow:row nowrap;align-items:center;"],(e=>Object(s.n)(1.25*e.theme.controlHeightBase))),f=o.f.div.withConfig({displayName:"FormSkeleton__TabButtonContainer",componentId:"sc-1xvkpmg-4"})(["display:flex;flex-flow:row nowrap;width:150px;padding:0 ",";align-items:center;justify-content:flex-start;"],(e=>Object(s.n)(e.theme.gutter))),g=o.f.div.withConfig({displayName:"FormSkeleton__TabButtonIcon",componentId:"sc-1xvkpmg-5"})(["flex:0 0 ",";width:",";margin:0 "," 0 0;"],(e=>Object(s.n)(e.theme.fz.large3)),(e=>Object(s.n)(e.theme.fz.large3)),(e=>Object(s.n)(e.theme.gutter/2))),j=o.f.div.withConfig({displayName:"FormSkeleton__TabButtonLabels",componentId:"sc-1xvkpmg-6"})(["flex:0 0 calc( 100% - "," );display:flex;flex-flow:column nowrap;justify-content:space-between;align-items:flex-start;"],(e=>Object(s.n)(e.theme.gutter/2+e.theme.fz.large3)));function O(){const e=Object(o.h)();return Object(u.jsxs)(f,{children:[Object(u.jsx)(g,{children:Object(u.jsx)(r.b.Avatar,{height:e.fz.large3,color:"darker"})}),Object(u.jsxs)(j,{children:[Object(u.jsx)(r.b,{height:e.fz.large1,shape:"rectangle",width:"50px",marginBottom:.25*e.gutter,color:"darker"}),Object(u.jsx)(r.b,{height:e.fz.small2,shape:"rectangle",width:"90px",color:"darker"})]})]})}const v=[{title:48,subtitle:68},{title:33,subtitle:68},{title:36,subtitle:68},{title:31,subtitle:62},{title:29,subtitle:61},{title:36,subtitle:61},{title:36,subtitle:51},{title:21,subtitle:57},{title:32,subtitle:56},{title:33,subtitle:59},{title:24,subtitle:58},{title:37,subtitle:52},{title:22,subtitle:60},{title:21,subtitle:54},{title:29,subtitle:59},{title:25,subtitle:56},{title:37,subtitle:55},{title:38,subtitle:63},{title:43,subtitle:68},{title:49,subtitle:53}],w=[[172,128,140,149],[197,167,74,137],[145,108,140,166],[178,101,108,148],[140,194,114,105],[138,123,170,115],[148,107,129,165],[129,192,140,137],[109,186,175,81],[87,166,68,154],[194,199,110,193],[133,75,93,86],[114,108,173,82],[154,126,98,110],[168,196,183,106],[92,147,170,178],[92,144,138,70],[112,119,149,116],[172,187,114,162],[153,107,150,153]];function y(e){const t=e.widthSet,n=w[t%w.length-1];return Object(u.jsxs)(l.a,{columns:c.s.ONE,controlAlignment:c.B.LEFT,children:[Object(u.jsx)(l.a.Item,{children:Object(u.jsx)(r.b.MCQOption,{type:"radio",width:n[0]})}),Object(u.jsx)(l.a.Item,{children:Object(u.jsx)(r.b.MCQOption,{type:"radio",width:n[1]})})]})}function x(e){const t=e.widthSet,n=w[t%w.length-1];return Object(u.jsxs)(l.a,{columns:c.s.ONE,controlAlignment:c.B.LEFT,children:[Object(u.jsx)(l.a.Item,{children:Object(u.jsx)(r.b.MCQOption,{type:"checkbox",width:n[0]})}),Object(u.jsx)(l.a.Item,{children:Object(u.jsx)(r.b.MCQOption,{type:"checkbox",width:n[1]})}),Object(u.jsx)(l.a.Item,{children:Object(u.jsx)(r.b.MCQOption,{type:"checkbox",width:n[2]})}),Object(u.jsx)(l.a.Item,{children:Object(u.jsx)(r.b.MCQOption,{type:"checkbox",width:n[3]})})]})}function C(e){const t=e.widthSet,n=v[t%v.length-1],o=n.title,i=n.subtitle;return Object(u.jsx)(r.b.Label,{titleWidth:`${o}%`,subtitleWidth:`${i}%`})}function _(e){const t=e.type,n=e.widthSet;return Object(u.jsx)(a.a.Item,{columnSize:c.J.FULL,widths:[],children:Object(u.jsxs)(a.a.Gutter,{children:[Object(u.jsx)(C,{widthSet:n}),"checkbox"===t?Object(u.jsx)(x,{widthSet:n}):"radio"===t?Object(u.jsx)(y,{widthSet:n}):"input"===t?Object(u.jsx)(r.b.Text,{}):Object(u.jsx)(r.b.Textarea,{})]})})}function k(e){const t=e.panels,n=void 0===t?3:t,o=[];if(n>=1)for(let e=0;e<n;e++)o.push(Object(u.jsx)(O,{},e));else o.push(Object(u.jsx)(O,{},"1"));return Object(u.jsx)(b,{children:Object(u.jsx)(p,{children:o})})}function S(e){const t=e.controls,n=void 0===t?5:t,o=[];return n<1&&o.push(Object(u.jsx)(_,{widthSet:1,type:"radio"},"0")),n>=1&&o.push(Object(u.jsx)(_,{widthSet:1,type:"radio"},"1")),n>=2&&o.push(Object(u.jsx)(_,{widthSet:2,type:"input"},"2")),n>=3&&o.push(Object(u.jsx)(_,{widthSet:3,type:"checkbox"},"3")),n>=4&&o.push(Object(u.jsx)(_,{widthSet:4,type:"textarea"},"4")),n>=5&&o.push(Object(u.jsx)(_,{widthSet:5,type:"radio"},"5")),Object(u.jsx)(u.Fragment,{children:o})}const E=o.f.div.withConfig({displayName:"FormSkeleton__SkeletonTabsPanelContainer",componentId:"sc-1xvkpmg-7"})(["background-color:",";border-bottom-left-radius:",";border-bottom-right-radius:",";"],(e=>e.theme.appBackgroundColor),(e=>Object(s.n)(e.theme.borderRadiusBase)),(e=>Object(s.n)(e.theme.borderRadiusBase)));function I({panels:e=3,controls:t=5,hasEditHeader:n=!1}){return Object(u.jsxs)(m,{className:"wpeform-component-formskeleton",children:[n?Object(u.jsx)(d.a.PreviewToolbar,{}):null,Object(u.jsxs)(h,{children:[Object(u.jsx)(k,{panels:e}),Object(u.jsx)(E,{children:Object(u.jsx)(a.a,{children:Object(u.jsx)(S,{controls:Math.max(2,t)})})})]})]})}I.FormControl=_},1098:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));var o=n(0);function i(e){return o.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),o.createElement("path",{d:"M492 241c11.047 0 20-8.953 20-20v-61c0-44.113-35.887-80-80-80H160c-44.113 0-80 35.887-80 80v272c0 44.113 35.887 80 80 80h201.516c5.32 0 10.421-2.121 14.175-5.89l130.485-131.114A19.993 19.993 0 00512 360.891V321c0-11.047-8.953-20-20-20s-20 8.953-20 20v19.89h-60.11c-38.6 0-70 31.4-70 70V472H160c-22.055 0-40-17.945-40-40V160c0-22.055 17.945-40 40-40h272c22.055 0 40 17.945 40 40v61c0 11.047 8.953 20 20 20zm-80.11 139.89h31.989l-61.988 62.286V410.89c0-16.543 13.457-30 30-30zM80 40c-22.055 0-40 17.945-40 40v313c0 11.047-8.953 20-20 20s-20-8.953-20-20V80C0 35.887 35.887 0 80 0h312c11.047 0 20 8.953 20 20s-8.953 20-20 20H80zm331 160c0 11.047-8.953 20-20 20H200c-11.047 0-20-8.953-20-20s8.953-20 20-20h191c11.047 0 20 8.953 20 20zm-20 100H200c-11.047 0-20-8.953-20-20s8.953-20 20-20h191c11.047 0 20 8.953 20 20s-8.953 20-20 20zm-110 40c11.047 0 20 8.953 20 20s-8.953 20-20 20h-81c-11.047 0-20-8.953-20-20s8.953-20 20-20h81z"}))}n.p},1099:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));var o=n(0);function i(e){return o.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),o.createElement("path",{d:"M269.586 96.562l-142.804 142.56a19.999 19.999 0 00-5.007 8.342l-23.912 78.725a20 20 0 0024.475 25.087l80.725-22.362a20.008 20.008 0 008.793-5.122l142.57-142.363c23.276-22.335 23.275-62.519 0-84.854-23.394-23.394-61.459-23.396-84.84-.013zm-82.271 195.206l-40.61 11.25 11.886-39.131 107.097-106.913 28.288 28.288-106.661 106.506zm138.837-138.636l-3.871 3.865-28.284-28.284 3.861-3.854c7.797-7.799 20.486-7.799 28.283 0 7.799 7.797 7.799 20.485.011 28.273zM472 312V80c0-22.056-17.944-40-40-40H80c-22.056 0-40 17.944-40 40v352c0 22.056 17.944 40 40 40h352c22.056 0 40-17.944 40-40H117c-26.536-1.056-26.516-38.953 0-40h375c11.046 0 20 8.954 20 20v20c0 44.112-35.888 80-80 80H80c-44.112 0-80-35.888-80-80V80C0 35.888 35.888 0 80 0h352c44.112 0 80 35.888 80 80v232c-1.056 26.536-38.953 26.516-40 0z"}))}n.p},1100:function(e,t,n){"use strict";n.d(t,"b",(function(){return i})),n.d(t,"a",(function(){return r}));var o=n(1189);const i=o.a`
	fragment FSubmissionData on SubmissionType {
		id
		token
		fName
		lName
		email
		phone
		score
		maxScore
		scoreData {
			scoreId
			has
			obtained
			outof
		}
		paymentData
		submissionLink
	}
`,r=o.a`
	mutation CreateSubmission(
		$formId: ID!
		$urlTrack: String
		$referer: String
		$elements: [FormSubmissionElementInput!]!
		$time: Int
	) {
		createSubmission(
			data: {
				formId: $formId
				urlTrack: $urlTrack
				referer: $referer
				elements: $elements
				time: $time
			}
		) {
			...FSubmissionData
		}
	}
	${i}
`},1106:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));var o=n(0);function i(e){return o.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),o.createElement("path",{d:"M458.388 432.002c0 44.113-35.887 80-80 80H132.5c-44.113 0-80-35.887-80-80V119c0-44.113 35.887-80 80-80h3.801c8.531-22.758 30.5-39 56.2-39 33.086 0 60 26.914 60 60v141c0 33.087-26.914 60.001-60 60.001-33.087 0-60-26.914-60-60v-62c0-11.047 8.952-20 20-20 11.046 0 20 8.953 20 20v62c0 11.027 8.972 20 20 20 11.027 0 20-8.973 20-20V60c0-11.028-8.973-20-20-20-9.352 0-17.2 6.46-19.38 15.144.243 1.25.38 2.535.38 3.855 0 5.778-2.465 10.969-6.383 14.617C163.469 77.535 158.278 80 152.5 80c-2.175 0-4.261-.36-6.222-1H132.5c-22.054 0-40 17.946-40 40v313.002c0 22.054 17.946 40 40 40h245.892c22.055 0 40-17.946 40-40 0-11.047 8.953-20 20-20 11.043 0 19.996 8.953 19.996 20zm-306.888-50c-11.047 0-20 8.953-20 20 0 11.046 8.953 20 20 20h146c11.048 0 20.001-8.954 20.001-20 0-11.047-8.953-20-20-20h-146zm226.001-61c0-11.048-8.953-20-20-20h-206c-11.048 0-20 8.952-20 20 0 11.046 8.952 20 20 20h206c11.047 0 20-8.954 20-20zM378.388 39h-66.887c-11.047 0-20 8.953-20 20s8.953 20 20 20h66.887c22.059 0 40 17.946 40 40v213.001c0 11.047 8.957 20 20 20 11.047 0 20-8.953 20-20v-213c0-44.114-35.887-80-80-80z"}))}n.p},1108:function(e,t,n){var o=n(1109),i=n(627),r=n(628),s=r&&r.isRegExp,a=s?i(s):o;e.exports=a},1109:function(e,t,n){var o=n(241),i=n(242);e.exports=function(e){return i(e)&&"[object RegExp]"==o(e)}},1110:function(e,t,n){var o=n(247),i=/[\\^$.*+?()[\]{}|]/g,r=RegExp(i.source);e.exports=function(e){return(e=o(e))&&r.test(e)?e.replace(i,"\\$&"):e}},1111:function(e,t,n){var o=n(241),i=n(177),r=n(242);e.exports=function(e){return"string"==typeof e||!i(e)&&r(e)&&"[object String]"==o(e)}},1112:function(e,t,n){var o=n(1113);e.exports=function(e){return(null==e?0:e.length)?o(e,1):[]}},1113:function(e,t,n){var o=n(626),i=n(1114);e.exports=function e(t,n,r,s,a){var c=-1,l=t.length;for(r||(r=i),a||(a=[]);++c<l;){var d=t[c];n>0&&r(d)?n>1?e(d,n-1,r,s,a):o(a,d):s||(a[a.length]=d)}return a}},1114:function(e,t,n){var o=n(290),i=n(454),r=n(177),s=o?o.isConcatSpreadable:void 0;e.exports=function(e){return r(e)||i(e)||!!(s&&e&&e[s])}},1118:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));var o=n(0);function i(e){return o.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),o.createElement("path",{d:"M175.995 471.988h-31.22c-20.778 0-37.877-15.575-39.823-36.247L80.83 122.997h310.33l-5.127 66.46c-.85 11.013 7.39 20.629 18.403 21.479.523.04 1.043.06 1.56.06 10.346 0 19.109-7.974 19.918-18.463l5.364-69.536h20.711c11.046 0 20-8.954 20-20 0-11.045-8.954-20-20-20H330.991V59.999C330.991 26.915 304.076 0 270.993 0h-69.998c-33.083 0-59.999 26.915-59.999 59.998v23H20c-11.046 0-20 8.954-20 20 0 11.045 8.954 19.999 20 19.999h20.71l24.373 315.978.023.278a79.82 79.82 0 0025.73 51.814 79.818 79.818 0 0053.937 20.919h31.222c11.046 0 20-8.954 20-20 0-11.045-8.954-19.998-20-19.998zm5-411.99c0-11.027 8.972-19.999 20-19.999h69.998c11.028 0 20 8.972 20 20v22.999H180.994v-23zm54.999 251.994c-11.046 0-20-8.954-20-20V182.995c0-11.045 8.954-20 20-20s20 8.955 20 20v108.997c0 11.046-8.954 20-20 20zm91.246-148.957c11.023.689 19.401 10.184 18.712 21.207l-2 32c-.662 10.598-9.467 18.752-19.941 18.752-.42 0-.841-.013-1.267-.04-11.024-.689-19.402-10.184-18.713-21.208l2-31.999c.69-11.023 10.186-19.405 21.209-18.712zm-161.263 19.087l10 228.928c.481 11.035-8.073 20.372-19.108 20.854-.297.013-.593.019-.888.019-10.644 0-19.497-8.389-19.966-19.127l-10-228.928c-.481-11.034 8.074-20.371 19.108-20.853 11.032-.5 20.372 8.073 20.854 19.107zm280.315 266.242c-21.262 21.258-44.113 34.106-67.92 38.19a20.162 20.162 0 01-3.405.29c-9.561 0-18.016-6.878-19.687-16.621-1.868-10.887 5.444-21.226 16.33-23.093 15.494-2.657 31.106-11.76 46.403-27.053 42.088-42.078 51.458-110.13 53.457-143.526-33.457 2.057-101.647 11.507-143.556 53.405-18.911 18.906-28.044 37.529-27.92 56.932.031 5.018.717 9.787 1.755 14.216 25.612-26.255 53.716-48.434 84.117-66.329 9.52-5.605 21.777-2.429 27.38 7.09 5.603 9.52 2.43 21.778-7.09 27.38-52.801 31.08-96.379 74.71-133.224 133.379-3.799 6.049-10.304 9.366-16.956 9.366a19.91 19.91 0 01-10.617-3.065c-9.354-5.875-12.175-18.22-6.3-27.573 10.229-16.288 21.098-31.642 32.577-46.051-5.356-11.472-11.512-27.974-11.64-48.158-.192-30.228 13.145-58.984 39.638-85.472 69.365-69.348 188.074-65.794 193.094-65.606 10.994.406 19.596 9.616 19.252 20.611-.004.121-.01.241-.015.361.309 15.715.025 125.646-65.673 191.327z"}))}n.p},1123:function(e,t,n){"use strict";n.d(t,"b",(function(){return i})),n.d(t,"a",(function(){return r}));var o=n(8);function i(e,t){return"owned"===e?o.w.OWNED:"shared"===e?o.w.SHARED:"trashed"===e?o.w.TRASHED:t?o.w.ALL:o.w.OWNED}function r(e,t){return t&&["all","trashed"].includes(e)||"shared"===e}},1124:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));var o=n(0);function i(e){return o.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),o.createElement("path",{d:"M262.839 127.75c0 11.025-8.937 19.962-19.961 19.962H101.265c-11.024 0-19.96-8.937-19.96-19.962 0-11.024 8.936-19.96 19.96-19.96h141.613c11.023 0 19.96 8.936 19.96 19.96zm-19.961 59.884H101.265c-11.024 0-19.96 8.936-19.96 19.96 0 11.025 8.936 19.962 19.96 19.962h141.613c11.024 0 19.96-8.937 19.96-19.961 0-11.025-8.937-19.961-19.96-19.961zm-80.732 79.844h-60.88c-11.025 0-19.962 8.936-19.962 19.96 0 11.025 8.937 19.962 19.961 19.962h60.881c11.025 0 19.961-8.937 19.961-19.961 0-11.025-8.936-19.961-19.96-19.961zm309.396 64.873V160.612c0-22.013-17.909-39.922-39.922-39.922h-87.828v67.942h59.772c11.024 0 19.96 8.936 19.96 19.96 0 11.025-8.936 19.962-19.96 19.962h-59.772v39.922h59.772c11.024 0 19.96 8.936 19.96 19.96 0 11.025-8.936 19.962-19.96 19.962h-59.772v39.922h59.772c11.024 0 19.96 8.936 19.96 19.96 0 11.025-8.936 19.962-19.96 19.962h-68.89c-13.362 25.442-40.033 42.849-70.707 42.856l-65.89.016v.967c0 22.013 17.908 39.922 39.921 39.922H431.62c22.013 0 39.922-17.909 39.922-39.922 0-11.024 8.937-19.96 19.961-19.96 11.025 0 19.961 8.936 19.961 19.96 0 44.026-35.818 79.844-79.844 79.844H237.998c-44.026 0-79.844-35.818-79.844-79.844v-.957l-77.828.019h-.02c-21.325 0-41.37-8.3-56.452-23.38C8.77 392.684.462 372.63.462 351.3V79.844C.462 35.818 36.28 0 80.306 0h183.641c44.026 0 79.845 35.818 79.845 79.844v.924h87.828c44.026 0 79.844 35.818 79.844 79.844v171.739c0 11.024-8.936 19.96-19.961 19.96-11.024 0-19.961-8.936-19.961-19.96zM303.87 79.844c0-22.013-17.91-39.922-39.923-39.922H80.307c-22.014 0-39.923 17.909-39.923 39.922V351.3c0 10.666 4.154 20.691 11.696 28.232 7.54 7.539 17.564 11.69 28.226 11.69h.01l183.64-.045c22.008-.005 39.913-17.914 39.913-39.922V79.844z"}))}n.p},1134:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));var o=n(0);function i(e){return o.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),o.createElement("path",{d:"M493.526 116.458c-11.29-11.263-26.301-17.465-42.267-17.465H60.742c-15.967 0-30.976 6.202-42.267 17.465-23.306 23.251-23.306 61.08 0 84.328l195.258 194.789c11.65 11.622 26.949 17.433 42.255 17.433 15.314 0 30.637-5.822 42.309-17.464l128.229-128.486c7.764-7.779 7.736-20.364-.062-28.11-7.798-7.744-20.413-7.716-28.177.064L270.088 367.466c-7.768 7.75-20.408 7.75-28.176 0L46.652 172.677c-7.769-7.75-7.769-20.359 0-28.109a19.823 19.823 0 0114.09-5.822h390.517a19.819 19.819 0 0114.09 5.822c7.769 7.75 7.769 20.36 0 28.11-7.781 7.761-7.781 20.346 0 28.108 7.78 7.763 20.396 7.763 28.177 0 23.305-23.25 23.305-61.079 0-84.328z"}))}n.p},1135:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));var o=n(0);function i(e){return o.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),o.createElement("path",{d:"M156.84 263.348c-9.621-9.641-12.461-23.993-7.246-36.57 5.21-12.56 17.36-20.676 30.953-20.676h54.512L235 76.098c-.004-11.043 8.945-20.004 19.992-20.008H255c11.043 0 19.996 8.95 20 19.992l.059 130.016c-.008 22.437-17.196 40.004-39.13 40.004h-39.784l52.964 53.035c2.489 2.492 5.395 2.863 6.907 2.863 1.511 0 4.418-.371 6.906-2.863l56.215-56.282c-5.465-3.57-9.075-9.742-9.075-16.753 0-11.047 8.954-20 20-20h1.438c13.59 0 25.738 8.117 30.95 20.68a33.46 33.46 0 01-7.24 36.562l-63.987 64.062c-9.399 9.41-21.907 14.594-35.207 14.594-13.305 0-25.805-5.184-35.207-14.598l-63.97-64.054zM432 0h-39c-11.047 0-20 8.953-20 20s8.953 20 20 20h39c22.055 0 40 17.945 40 40v172c0 11.047 8.953 20 20 20s20-8.953 20-20V80c0-44.113-35.887-80-80-80zm80 352v80c0 44.113-35.887 80-80 80H80c-44.113 0-80-35.887-80-80V80C0 35.887 35.887 0 80 0h42c11.047 0 20 8.953 20 20s-8.953 20-20 20H80c-22.055 0-40 17.945-40 40v252h54.945c29.278 0 56.453 14.543 72.696 38.906A47.276 47.276 0 00207.055 392h96.89a47.276 47.276 0 0039.414-21.094C359.602 346.543 386.777 332 416.055 332H492c11.047 0 20 8.953 20 20zm-40 80v-60h-55.945a47.276 47.276 0 00-39.414 21.094C360.398 417.457 333.223 432 303.945 432h-96.89c-29.278 0-56.453-14.543-72.696-38.906A47.276 47.276 0 0094.945 372H40v60c0 22.055 17.945 40 40 40h352c22.055 0 40-17.945 40-40z"}))}n.p},1136:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));var o=n(0);function i(e){return o.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),o.createElement("path",{d:"M493.714 237.714c-10.099 0-18.285 8.187-18.285 18.286v164.571c0 30.297-24.56 54.858-54.858 54.858H91.43c-30.297 0-54.858-24.56-54.858-54.858V91.43c0-30.297 24.56-54.858 54.858-54.858H256c10.099 0 18.286-8.186 18.286-18.285C274.286 8.186 266.099 0 256 0H91.429C40.934 0 0 40.934 0 91.429V420.57A91.429 91.429 0 0091.429 512H420.57c50.496 0 91.43-40.934 91.43-91.429V256c0-10.099-8.187-18.286-18.286-18.286z"}),o.createElement("path",{d:"M365.714 36.571h83.932L243.017 243.017a18.286 18.286 0 000 25.966 18.286 18.286 0 0025.966 0L475.429 62.537v83.749c0 10.099 8.186 18.285 18.285 18.285 10.1 0 18.286-8.186 18.286-18.285v-128a18.287 18.287 0 00-5.303-12.983A18.287 18.287 0 00493.714 0h-128c-10.099 0-18.285 8.187-18.285 18.286 0 10.099 8.186 18.285 18.285 18.285z"}))}n.p},1153:function(e,t){e.exports=function(e,t,n,o){var i=new Blob(void 0!==o?[o,e]:[e],{type:n||"application/octet-stream"});if(void 0!==window.navigator.msSaveBlob)window.navigator.msSaveBlob(i,t);else{var r=window.URL&&window.URL.createObjectURL?window.URL.createObjectURL(i):window.webkitURL.createObjectURL(i),s=document.createElement("a");s.style.display="none",s.href=r,s.setAttribute("download",t),void 0===s.download&&s.setAttribute("target","_blank"),document.body.appendChild(s),s.click(),setTimeout((function(){document.body.removeChild(s),window.URL.revokeObjectURL(r)}),200)}}},1154:function(e,t,n){"use strict";n.d(t,"a",(function(){return l}));var o=n(13),i=n(0),r=n(1029),s=n(1129),a=n(1104),c=["refetch","reobserve","fetchMore","updateQuery","startPolling","subscribeToMore"];function l(e,t){var n=Object(s.a)(Object(a.a)(t&&t.client),e),l=Object(i.useRef)(),d=l.current?Object(r.a)(t,l.current):t,u=n.useQuery(Object(o.a)(Object(o.a)({},d),{skip:!l.current})),m=u.observable.options.initialFetchPolicy||n.getDefaultFetchPolicy(),h=Object.assign(u,{called:!!l.current}),b=Object(i.useMemo)((function(){for(var e={},t=function(t){var o=h[t];e[t]=function(){return l.current||(l.current=Object.create(null),n.forceUpdate()),o.apply(this,arguments)}},o=0,i=c;o<i.length;o++){t(i[o])}return e}),[]);return Object.assign(h,b),[Object(i.useCallback)((function(e){l.current=e?Object(o.a)(Object(o.a)({},e),{fetchPolicy:e.fetchPolicy||m}):{fetchPolicy:m};var t=n.asyncUpdate().then((function(e){return Object.assign(e,b)}));return t.catch((function(){})),t}),[]),h]}},1163:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return De}));var o=n(15),i=n(0),r=n.n(i),s=n(1189),a=n(1129),c=n(3),l=n(83),d=n(18),u=n(446),m=n(1064),h=n(1044),b=n(440),p=n(245),f=n(8),g=n(282),j=n(1123),O=n(176),v=n(363),w=n(239),y=n(284),x=n(1090),C=n.n(x),_=n(1104),k=n(1153),S=n.n(k),E=n(1041),I=n(361),T=n(1042),F=n(1098),P=n(1099),M=n(1134),B=n(1118),L=n(1135),N=n(1124);function R(e){return i.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),i.createElement("path",{d:"M207.024 479.4a20.11 20.11 0 01-3.077-.236c-56.263-8.688-107.862-37.305-145.291-80.58C20.83 354.851 0 298.885 0 240.997c0-64.373 25.068-124.893 70.587-170.411C116.105 25.067 176.625 0 240.998 0c58.657 0 115.185 21.322 159.17 60.038 43.578 38.357 71.858 91.015 79.628 148.27 1.485 10.946-6.183 21.022-17.128 22.508-10.953 1.485-21.022-6.184-22.508-17.127-13.438-99.02-99.06-173.69-199.162-173.69C130.168 40 40 130.168 40 241c0 98.27 73.105 183.664 170.05 198.633 10.916 1.686 18.4 11.9 16.713 22.818-1.525 9.88-10.041 16.95-19.74 16.95zm-25.788-149.355l74-75a20 20 0 005.762-14.047V92c0-11.046-8.954-20-20-20s-20 8.954-20 20v140.793l-68.236 69.159c-7.758 7.863-7.673 20.526.19 28.284a19.936 19.936 0 0014.046 5.763 19.943 19.943 0 0014.238-5.953zm330.429 71.581c2.004-10.862-5.176-21.293-16.04-23.297-10.861-2.003-21.292 5.176-23.296 16.04-8.3 44.98-47.588 77.628-93.419 77.628-52.382 0-94.999-42.617-94.999-95 0-52.382 42.617-94.999 95-94.999a95.24 95.24 0 0125.62 3.49c10.64 2.971 21.671-3.246 24.642-13.884s-3.246-21.67-13.884-24.642A135.278 135.278 0 00378.91 242c-74.438 0-134.999 60.56-134.999 135 0 74.438 60.56 134.999 135 134.999 65.122 0 120.953-46.42 132.754-110.372zm-108.08 10.087l87.394-86.501c7.85-7.77 7.916-20.433.145-28.284-7.77-7.851-20.433-7.916-28.284-.145l-83.858 83.001-25.93-25.93c-7.81-7.81-20.473-7.81-28.283 0-7.81 7.812-7.811 20.474 0 28.284l29.448 29.448c6.812 6.812 15.78 10.22 24.75 10.22 8.907 0 17.82-3.362 24.618-10.093z"}))}n.p;var A=n(1136),D=n(130),z=n(1154),H=n(7),V=n(2),$=n(441);function q(e){return i.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),i.createElement("path",{d:"M376.98 242c-74.439 0-135 60.561-135 135s60.561 135 135 135 135-60.561 135-135-60.56-135-135-135zm0 230c-52.383 0-95-42.617-95-95s42.617-95 95-95 95 42.617 95 95-42.616 95-95 95zm60-95c0 11.046-8.954 20-20 20h-20v20c0 11.046-8.954 20-20 20s-20-8.954-20-20v-20h-20c-11.046 0-20-8.954-20-20s8.954-20 20-20h20v-20c0-11.046 8.954-20 20-20s20 8.954 20 20v20h20c11.046 0 20 8.954 20 20zm-210.215 85.452c-1.526 9.883-10.042 16.951-19.741 16.951-1.015 0-2.043-.077-3.077-.237-56.263-8.688-107.862-37.305-145.292-80.58C20.831 354.854 0 298.889 0 241c0-64.374 25.068-124.894 70.587-170.413C116.106 25.068 176.626 0 241 0c58.657 0 115.185 21.322 159.17 60.038 43.579 38.358 71.859 91.016 79.629 148.272 1.485 10.945-6.183 21.022-17.129 22.508-10.944 1.48-21.022-6.183-22.508-17.128C426.724 114.67 341.102 40 241 40 130.168 40 40 130.168 40 241c0 98.271 73.106 183.666 170.052 198.635 10.916 1.685 18.399 11.901 16.713 22.817zM241 72c11.046 0 20 8.954 20 20v149l-5.763 14.047-74 75A19.939 19.939 0 01166.999 336a19.933 19.933 0 01-14.046-5.764c-7.863-7.758-7.948-20.421-.19-28.283L221 232.794V92c0-11.046 8.954-20 20-20z"}))}n.p;var U=n(1);const W=H.f.table.withConfig({displayName:"UpdateLog__Table",componentId:"sc-18eqyem-0"})(["border:0 none;border-collapse:collapse;width:100%;font-size:",";text-align:left;table-layout:fixed;thead{background-color:",";tr{border-bottom:1px solid ",";}th{text-transform:uppercase;font-size:",";color:",";}}th{color:",";font-weight:bold;}th,td{padding:"," ",";&.td-icon,&.th-icon{color:",";width:70px;font-size:",";font-variant-numeric:tabular-nums;}&.td-icon{font-size:",";font-weight:bold;font-family:",";}&.td-date{width:220px;}&.td-uid{font-variant-numeric:tabular-nums;text-align:right;width:100px;}&.td-uname{text-align:right;width:180px;}}tbody{tr{background-color:",";border-bottom:1px solid ",";transition:",";&:nth-child(2n){background-color:",";}&:hover{background-color:",";}&.empty-date{background-color:",";}}}"],(e=>Object(V.n)(e.theme.fz.base)),(e=>e.theme.backgroundShade),(e=>e.theme.borderColorBase),(e=>Object(V.n)(e.theme.fz.small2)),(e=>e.theme.textColorSecondary),(e=>e.theme.headingColor),(e=>Object(V.n)(e.theme.gutter/2)),(e=>Object(V.n)(e.theme.gutter)),(e=>e.theme.textColorSecondary),(e=>Object(V.n)(e.theme.fz.small1)),(e=>Object(V.n)(e.theme.fz.small2)),(e=>e.theme.fontFamilyMono),(e=>e.theme.appBackgroundColor),(e=>e.theme.borderColorSplit),(e=>Object(V.f)(["background-color"],e.theme.transitionControl)),(e=>e.theme.backgroundControl),(e=>e.theme.backgroundHover),(e=>e.theme.appBackgroundColor)),K=H.f.div.withConfig({displayName:"UpdateLog__Container",componentId:"sc-18eqyem-1"})(["max-width:100%;min-height:250px;overflow-x:auto;"]),G=s.a`
	query FormUpdateLogQuery($id: ID!) {
		form(id: $id) {
			id
			created
			owner {
				id
				username
			}
			updateLogs {
				updateDate
				userId
				userName
			}
		}
	}
`;function Y(e){var t,n;const r=e.state,s=r.visible,a=r.formId,l=e.updateState,u=Object(z.a)(G,{fetchPolicy:"no-cache"}),m=Object(o.a)(u,2),h=m[0],b=m[1],p=b.data,f=b.loading,j=b.error;Object(i.useEffect)((()=>{s&&a&&h({variables:{id:a}})}),[h,a,s]);const v=null!=p&&p.form.created?I.e.utc(p.form.created,I.g).local():null;return Object(U.jsx)(D.a,{title:Object(c.__)("UPDATE LOG","wp-eform"),visible:s,onOk:()=>{l({visible:!1,formId:void 0})},onCancel:()=>{l({visible:!1,formId:void 0})},okText:Object(c.__)("OK","wp-eform"),cancelButtonProps:{style:{display:"none"}},width:"650px",children:Object(U.jsx)(K,{children:s&&a?j?Object(U.jsx)(g.a,{description:j.message,type:"500",to:()=>{window.location.reload()},title:Object(c.__)("Could not load update logs","wp-eform"),buttonLabel:Object(c.__)("Reload","wp-eform")}):f||!p?Object(U.jsx)($.a,{}):Object(U.jsxs)(W,{children:[Object(U.jsx)("thead",{children:Object(U.jsxs)("tr",{children:[Object(U.jsx)("th",{className:"th-icon",children:Object(U.jsx)(d.b,{component:R})}),Object(U.jsx)("th",{className:"th-on td-date",children:Object(c.__)("On","wp-eform")}),Object(U.jsx)("th",{className:"td-uid",children:Object(c.__)("User Id","wp-eform")}),Object(U.jsx)("th",{className:"td-uname",children:Object(c.__)("User Name","wp-eform")})]})}),Object(U.jsxs)("tbody",{children:[p.form.updateLogs.length?p.form.updateLogs.map(((e,t)=>{const n=I.e.utc(e.updateDate,I.g).local();return Object(U.jsxs)("tr",{children:[Object(U.jsxs)("td",{className:"td-icon",children:["#",p.form.updateLogs.length-t]}),Object(U.jsx)("td",{className:"td-date",children:Object(U.jsx)(O.a,{title:n.fromNow(),children:Object(U.jsx)("span",{children:n.format(I.c)})})}),Object(U.jsx)("td",{className:"td-uid",children:e.userId}),Object(U.jsx)("td",{className:"td-uname",children:e.userName})]},t.toString())})):null,v?Object(U.jsxs)("tr",{className:"created",children:[Object(U.jsx)("th",{className:"th-icon",children:Object(U.jsx)(O.a,{title:Object(c.__)("created on","wp-eform"),children:Object(U.jsx)(d.b,{component:q})})}),Object(U.jsx)("td",{className:"td-date",children:Object(U.jsx)(O.a,{title:v.fromNow(),children:Object(U.jsx)("span",{children:v.format(I.c)})})}),Object(U.jsx)("td",{className:"td-uid",children:null===(t=p.form.owner)||void 0===t?void 0:t.id}),Object(U.jsx)("td",{className:"td-uname",children:null===(n=p.form.owner)||void 0===n?void 0:n.username})]}):null]})]}):Object(U.jsx)($.a,{})})})}const Q=Object(p.g)(),X=s.a`
	mutation TrashForm($id: ID!) {
		trashForm(id: $id)
	}
`,Z=s.a`
	mutation UntrashForm($id: ID!) {
		untrashForm(id: $id)
	}
`,J=s.a`
	mutation DeleteForm($id: ID!) {
		deleteForm(id: $id)
	}
`;function ee(e){const t=e.id;return Object(U.jsxs)(m.a.MutationButton,{danger:!0,mutation:X,variables:{id:t},children:[Object(U.jsx)(d.b,{component:u.a}),Object(U.jsx)("span",{children:Object(c.__)("TRASH","wp-eform")})]})}function te(e){const t=e.id;return Object(U.jsxs)(m.a.MutationButton,{mutation:Z,variables:{id:t},children:[Object(U.jsx)(d.b,{component:B.a}),Object(U.jsx)("span",{children:Object(c.__)("UNTRASH","wp-eform")})]})}function ne(e){const t=e.id;return Object(U.jsxs)(m.a.MutationButton,{danger:!0,mutation:J,variables:{id:t},popconfirm:Object(c.__)("The form once deleted cannot be restored. Are you sure?","wp-eform"),children:[Object(U.jsx)(d.b,{component:u.a}),Object(c.__)("DELETE","wp-eform")]})}const oe=s.a`
	query ExportForm($id: ID!) {
		exportForm(id: $id)
	}
`,ie=s.a`
	mutation DuplicateForm($id: ID!) {
		duplicateForm(id: $id)
	}
`;function re(e){const t=e.currentView,n=e.item,o=e.path,i=e.setUpdateLogState,r=Object(_.a)(),s=Object(l.k)();return Object(U.jsx)(U.Fragment,{children:"trashed"===t?Object(U.jsxs)(U.Fragment,{children:[Object(U.jsx)(te,{id:n.node.id}),Object(U.jsx)(ne,{id:n.node.id})]}):Object(U.jsxs)(U.Fragment,{children:[Object(U.jsxs)(m.a.AnchorButton,{target:"_blank",href:`${WPEFormAdminApp.formPreviewUrl}${WPEFormAdminApp.isPrettyPermalink?`${n.node.id}/?from_admin=true`:`%2F${n.node.id}&from_admin=true`}`,children:[Object(U.jsx)(d.b,{component:A.a}),Object(U.jsx)("span",{children:Object(c.__)("VIEW","wp-eform")})]}),n.node.submissionCount>0?Object(U.jsxs)(m.a.RouterLinkButton,{to:`/submissions?formId=${n.node.id}&currentView=${t}`,children:[Object(U.jsx)(d.b,{component:F.a}),Object(U.jsx)("span",{children:Object(c.__)("SUBMISSIONS","wp-eform")})]}):null,Object(U.jsxs)(m.a.RouterLinkButton,{to:`${o}/edit/${n.node.id}`,children:[Object(U.jsx)(d.b,{component:P.a}),Object(U.jsx)("span",{children:Object(c.__)("EDIT","wp-eform")})]}),"shared"!==t?Object(U.jsx)(ee,{id:n.node.id}):null,Object(U.jsx)(v.a,{overlay:Object(U.jsxs)(w.a,{children:[Object(U.jsx)(w.a.Item,{onClick:e=>{e.domEvent.stopPropagation();const t=`wpeform-export-form-${n.node.id}`;y.b.loading({content:Object(c.__)("Exporting form, please wait...","wp-eform"),key:t,duration:0}),r.query({query:oe,fetchPolicy:"no-cache",variables:{id:n.node.id}}).then((e=>{var t,o;e.data&&!e.error?(S()(e.data.exportForm,`form-${n.node.id}-${Object(E.d)(n.node.name)}.json`),y.b.success(Object(c.__)("Successfully downloaded export code of form.","wp-eform"))):y.b.error(null!==(t=null===(o=e.error)||void 0===o?void 0:o.message)&&void 0!==t?t:Object(c.__)("Some error has occured.","wp-eform"),10)})).catch((e=>{var t;y.b.error(null!==(t=e.message)&&void 0!==t?t:Object(c.__)("Could not download the export code. Please check network connection and try again.","wp-eform"),10)})).finally((()=>{y.b.destroy(t)}))},children:Object(U.jsxs)(m.a.AntMenuItem,{children:[Object(U.jsx)(d.b,{component:L.a}),Object(U.jsx)("span",{children:Object(c.__)("DOWNLOAD FORM","wp-eform")})]})},"export"),Object(U.jsx)(w.a.Item,{onClick:e=>{e.domEvent.stopPropagation();const t=`wpeform-duplicate-form-${n.node.id}`;y.b.loading({content:Object(c.__)("Duplicating form, please wait...","wp-eform"),key:t,duration:0}),r.mutate({mutation:ie,fetchPolicy:"no-cache",variables:{id:n.node.id}}).then((e=>{var t,n;(Object(T.a)(),e.data&&!e.errors)?(y.b.success(Object(c.__)("Successfully duplicated the form. Redirecting...","wp-eform")),s.push(`/forms/edit/${null===(n=e.data)||void 0===n?void 0:n.duplicateForm}`)):null!==(t=e.errors)&&void 0!==t&&t.length?e.errors.forEach((e=>{y.b.error(e.message)})):y.b.error(Object(c.__)("Some error has occured","wp-eform"),10)})).catch((e=>{var t;y.b.error(null!==(t=e.message)&&void 0!==t?t:Object(c.__)("Could not duplicate the form. Please check network connection and try again.","wp-eform"),10)})).finally((()=>{y.b.destroy(t)}))},children:Object(U.jsxs)(m.a.AntMenuItem,{children:[Object(U.jsx)(d.b,{component:N.a}),Object(U.jsx)("span",{children:Object(c.__)("DUPLICATE FORM","wp-eform")})]})},"duplicate"),Object(U.jsx)(w.a.Item,{onClick:e=>{e.domEvent.stopPropagation(),i({visible:!0,formId:n.node.id})},children:Object(U.jsxs)(m.a.AntMenuItem,{children:[Object(U.jsx)(d.b,{component:R}),Object(U.jsx)("span",{children:Object(c.__)("UPDATE LOG","wp-eform")})]})},"update-log")]}),arrow:!0,placement:"bottomLeft",trigger:["click"],children:Object(U.jsx)(m.a.ActionButton,{onClick:e=>{e.stopPropagation()},children:Object(U.jsx)(d.b,{component:M.a})})})]})})}function se(e){const t=e.item,n=e.state,o=e.dispatch,i=e.setUpdateLogState,s=Object(l.n)().path,a=I.e.utc(t.node.created,I.g).local();let d=null;const u=[Object(c._x)("Created by %%USER%% %%CREATEDATE%%.","forms-list-meta","wp-eform")];t.node.updated!==I.f&&(u.push(Object(c._x)("Last updated %%UPDATEDATE%%.","forms-list-meta","wp-eform")),d=I.e.utc(t.node.updated,I.g).local()),t.node.viewCount>0&&u.push(Object(c.sprintf)(Object(c._n)("It has been visited %1$d time.","It has been visited %1$d times.",t.node.viewCount,"wp-eform"),t.node.viewCount));const h=C()(u.join(" "),/%%([^%%]+)%%/,((e,i)=>{switch(e.toUpperCase()){case"USER":return Q===t.node.owner.id.toString()?Object(U.jsx)("span",{children:Object(c.__)("you","wp-eform")},i):Object(U.jsx)("button",{className:"user-input",type:"button",onClick:e=>{e.preventDefault(),o({type:"SET_FILTERS",payload:{filters:{...n.filters,owner:t.node.owner.id}}})},children:t.node.owner.username},i);case"CREATEDATE":return Object(U.jsx)(O.a,{title:a.format("LLL"),children:Object(U.jsx)("span",{children:a.fromNow()})},i);case"UPDATEDATE":if(d)return Object(U.jsx)(O.a,{title:d.format("LLL"),children:Object(U.jsx)("span",{children:d.fromNow()})},i)}return Object(U.jsxs)(r.a.Fragment,{children:["%%",e,"%%"]},i)}));return Object(U.jsxs)(m.a.Preview,{children:[Object(U.jsxs)(m.a.PreviewHeader,{children:[Object(U.jsx)(m.a.PreviewTitle,{children:Object(U.jsx)("label",{htmlFor:t.node.id.toString(),children:""!==t.node.name?t.node.name:Object(c.__)("Untitled form","wp-eform")})}),Object(U.jsx)(m.a.PreviewMeta,{children:Object(c.sprintf)(Object(c._n)("%1$d Submission","%1$d Submissions",t.node.submissionCount,"wp-eform"),t.node.submissionCount)})]}),Object(U.jsx)(m.a.PreviewData,{children:h}),t.node.categories.length?Object(U.jsx)("p",{style:{margin:"10px 0 0 0"},children:Object(U.jsxs)(m.a.MutedText,{children:[Object(c.__)("Filed under: ","wp-eform"),t.node.categories.map((e=>Object(U.jsx)(m.a.ActionButton,{size:"small",title:Object(c.__)("View forms only from this category","wp-eform"),onClick:t=>{o({type:"SET_FILTERS",payload:{filters:{...n.filters,category:e.id}}})},style:{margin:"4px 0",display:"block"},children:e.title},e.id)))]})}):null,Object(U.jsx)(m.a.PreviewActions,{children:Object(U.jsx)(re,{item:t,currentView:n.currentView,path:s,setUpdateLogState:i})})]})}var ae=n(437),ce=n(1173),le=n(358),de=(n(244),n(1094)),ue=n(1100),me=(n(286),n(1077),n(216)),he=n(1069),be=n(1095),pe=n(1043),fe=n(1087),ge=n(66),je=n(1039),Oe=n(1093);n(281);function ve(e){var t,n;const r=e.id,s=e.panels,l=void 0===s?2:s,d=e.controls,u=void 0===d?3:d,m=e.themeStyle,h=e.mode,b=void 0===h?"newsubmission":h,p=e.inShadow,f=void 0!==p&&p,g=e.cssHandles,j=void 0===g?[]:g,O=e.ssr,v=void 0!==O&&O,w=e.increaseViewCount,y=void 0!==w&&w;Object(i.useEffect)((()=>{const e=Object(ge.c)();if(e.includes("from_admin=true")){const t=e.replace("?from_admin=true","").replace("from_admin=true","");window.history.replaceState(null,document.title,t)}}),[]);const x=Object(a.b)(de.a,{fetchPolicy:"cache-first",variables:{id:r,increaseViewCount:y}}),C=x.data,_=x.loading,k=x.error,S=x.refetch,E=Object(le.a)(((e,t)=>{t({id:e})}),500);Object(i.useEffect)((()=>{const e=e=>{e.data&&"wpeform:: refresh form"===e.data&&(ge.e.l("refreshing form"),E(r,S))};return window.addEventListener("message",e),()=>{window.removeEventListener("message",e)}}),[r,E,S]);const I=Object(ce.a)(ue.a,{fetchPolicy:"no-cache"}),T=Object(o.a)(I,2),F=T[0],P=T[1],M=Object(i.useMemo)((()=>null),[C]),B=Object(i.useCallback)(((e,t)=>F({variables:{formId:r,elements:e,referer:window.location.href,time:t,urlTrack:M}})),[r,F,M]),L=Object(i.useMemo)((()=>C?Object(me.b)(C):null),[C]),N=Object(me.j)(B,L,"preview"!==b&&"listview"!==b),R=N.submitting,A=N.submitted,D=N.reset,z=N.submit,H=N.submittedState,V=Object(U.jsx)(pe.a,{inShadow:f,cssHandles:j,children:Object(U.jsx)(je.a,{themeStyle:m,ssr:v,children:"listview"===b||"preview"===b?Object(U.jsx)($.a,{}):Object(U.jsx)(be.a,{panels:l,controls:u})})});return _?V:k?Object(U.jsx)(pe.a,{inShadow:f,cssHandles:j,children:Object(U.jsx)(he.a,{ssr:v,themeStyle:m,retry:()=>{S({id:r})},error:k,title:Object(c.__)("A server side error has occured","wp-eform"),children:Object(U.jsx)("p",{children:Object(c.__)("There was an error trying to fetch form data from the server. Try refreshing the page to see if that resolves it.","wp-eform")})})}):Object(U.jsx)(pe.a,{inShadow:f,cssHandles:j,children:Object(U.jsx)(Oe.a,{themeStyle:m,children:Object(U.jsx)(fe.a,{formData:L,formMeta:C.formMeta,mode:b,submitting:R,submitted:A,submittedState:H,onReset:D,onSubmit:z,submissionError:P&&P.error?P.error:void 0,mutationData:null!==(t=null===(n=P.data)||void 0===n?void 0:n.createSubmission)&&void 0!==t?t:void 0,limitations:null==C?void 0:C.form.limitations,notices:null==C?void 0:C.form.notices,onErrorRetry:D})})})}function we(e){const t=e.state,n=Object(ae.d)(t.previewItemId);return Object(U.jsx)(m.a.PreviewContent,{ref:n,hasPadding:!0,children:Object(U.jsx)(ve,{id:t.previewItemId?t.previewItemId.toString():"0",mode:"listview",inShadow:!1},t.previewItemId)})}var ye=n(1128);const xe=s.a`
	mutation TrashForms($ids: [ID!]!) {
		trashForms(ids: $ids)
	}
`,Ce=s.a`
	mutation UntrashForms($ids: [ID!]!) {
		untrashForms(ids: $ids)
	}
`,_e=s.a`
	mutation DeleteForms($ids: [ID!]!) {
		deleteForms(ids: $ids)
	}
`;const ke=[{value:"name",label:Object(c.__)("Form Name","wp-eform")},{value:"created",label:Object(c.__)("Created","wp-eform"),width:200},{value:"updated",label:Object(c.__)("Updated","wp-eform"),width:200},{value:"owner",label:Object(c.__)("Owner","wp-eform"),width:100},{value:"viewCount",label:Object(c.__)("Form Visits","wp-eform"),type:"number",width:140},{value:"submissionCount",label:Object(c.__)("Submissions","wp-eform"),type:"number",width:140},{value:"categories",label:Object(c.__)("Categories","wp-eform"),width:140},{value:"action",label:Object(c.__)("Actions","wp-eform"),type:"actionButtons",width:420}];var Se=n(161);const Ee=Object(p.d)(),Ie=Object(p.g)();function Te(e){var t,n,o,i,r;const s=e.state,a=e.dispatch,l=e.filterData;return Object(U.jsxs)(U.Fragment,{children:[Object(U.jsx)(m.a.FilterMenuItem,{children:Object(U.jsx)(Se.a,{size:"small",value:null!==(t=s.filters.category)&&void 0!==t?t:void 0,style:{width:"100%"},allowClear:!0,onClear:()=>{a({type:"SET_FILTERS",payload:{filters:{...s.filters,category:null}}})},showSearch:!0,placeholder:Object(c.__)("Category","wp-eform"),onSelect:e=>{a({type:"SET_FILTERS",payload:{filters:{...s.filters,category:e}}})},filterOption:(e,t)=>{var n,o;if(!t)return!1;const i=t.props.value,r=(null==l?void 0:l.formMeta)&&(null==l||null===(n=l.formMeta)||void 0===n||null===(o=n.categories)||void 0===o?void 0:o.find((e=>e.id===i)));return!!(r&&r.title&&r.title.toLowerCase().includes(e.toLowerCase()))},children:null==l||null===(n=l.formMeta)||void 0===n?void 0:n.categories.map((e=>{var t;return Object(U.jsxs)(Se.a.Option,{value:e.id,title:null!==(t=e.title)&&void 0!==t?t:"",children:[Object(U.jsx)(m.a.Badge,{children:e.total})," ",e.title||Object(c.__)("Deleted","wp-eform")]},e.id)}))})}),Object(j.a)(s.currentView,Ee)?Object(U.jsx)(m.a.FilterMenuItem,{children:Object(U.jsx)(Se.a,{size:"small",value:null!==(o=s.filters.owner)&&void 0!==o?o:void 0,style:{width:"100%"},allowClear:!0,onClear:()=>{a({type:"SET_FILTERS",payload:{filters:{...s.filters,owner:null}}})},showSearch:!0,placeholder:Object(c.__)("Owner","wp-eform"),onSelect:e=>{a({type:"SET_FILTERS",payload:{filters:{category:s.filters.category,owner:e}}})},filterOption:(e,t)=>{var n,o,i;if(!t)return!1;const r=t.props.value,s=(null==l?void 0:l.formMeta)&&(null==l||null===(n=l.formMeta)||void 0===n?void 0:n.owners)&&(null==l||null===(o=l.formMeta)||void 0===o||null===(i=o.owners)||void 0===i?void 0:i.find((e=>e.id===r)));return!!(s&&s.username&&s.username.toLowerCase().includes(e.toLowerCase()))},children:null==l||null===(i=l.formMeta)||void 0===i||null===(r=i.owners)||void 0===r?void 0:r.map((e=>Object(U.jsxs)(Se.a.Option,{value:e.id,children:[Object(U.jsx)(m.a.Badge,{children:e.total}),e.username||Object(c.__)("Ghost","wp-eform"),e.id===Ie?Object(c.__)(" (you)","wp-eform"):null]},e.id)))})}):null]})}const Fe=s.a`
	query FormsListQuery($pagination: PaginationInput, $filter: FormFilterInput) {
		forms(filter: $filter, pagination: $pagination) {
			totalCount
			edges {
				node {
					id
					created
					name
					owner {
						username
						id
					}
					submissionCount
					viewCount
					updated
					categories {
						id
						title
					}
				}
			}
		}
	}
`,Pe=Object(p.d)(),Me=Object(p.g)(),Be=[{id:"owned",title:Object(c.__)("OWNED","wp-eform"),ddLabel:Object(c.__)("OWNED","wp-eform"),help:Object(c.__)("Forms created by you.","wp-eform")},{id:"shared",title:Object(c.__)("SHARED","wp-eform"),ddLabel:Object(c.__)("SHARED","wp-eform"),help:Object(c.__)("Forms shared with you by other users.","wp-eform")}];Pe&&Be.push({id:"all",title:Object(c.__)("ALL","wp-eform"),ddLabel:Object(c.__)("ALL","wp-eform"),help:Object(c.__)("All forms from all users, you can access this because you are an administrator.","wp-eform")}),Be.push({id:"trashed",title:Object(U.jsx)(d.b,{component:u.a}),ddLabel:Object(c.__)("TRASHED","wp-eform"),help:Object(c.__)("Trashed forms.","wp-eform"),danger:!0});const Le=[{id:"id",sorter:!0,title:Object(c.__)("Form Id","wp-eform")},{id:"name",sorter:!0,title:Object(c.__)("Form Name","wp-eform")},{id:"created",sorter:!0,title:Object(c.__)("Created","wp-eform")},{id:"submissionCount",sorter:!0,title:Object(c.__)("Total Entries","wp-eform")},{id:"viewCount",sorter:!0,title:Object(c.__)("Form Visits","wp-eform")},{id:"ownerid",sorter:!0,title:Object(c.__)("Form Owner","wp-eform")}],Ne={category:null,owner:Pe?null:Me};function Re(e){var t,n;const r=e.filterData,s=e.state,d=e.dispatch,u=e.onMutation,h=Object(a.b)(Fe,{fetchPolicy:"cache-and-network",variables:{filter:{owner:"owned"===s.currentView||"shared"===s.currentView?Me:s.filters.owner?s.filters.owner.toString():null,category:s.filters.category,search:s.search,resourceView:Object(j.b)(s.currentView,Pe)},pagination:{with:f.t.OFFSET,page:s.currentPage,orderby:s.orderBy,["ascend"===s.orderDir?"last":"first"]:s.itemsPerPage}}}),p=h.data,O=h.loading,v=h.error,w=function(e){const t=e.selectedRows,n=Object(ce.a)(xe,{variables:{ids:t}}),i=Object(o.a)(n,2),r=i[0],s=i[1].loading,a=Object(ce.a)(Ce,{variables:{ids:t}}),l=Object(o.a)(a,2),d=l[0],u=l[1].loading,m=Object(ce.a)(_e,{variables:{ids:t}}),h=Object(o.a)(m,2),b=h[0],p=h[1].loading,f=s||u||p,g=[];return"trashed"===e.currentView?(g.push({id:"untrash",danger:!1,onClick:()=>d().catch((e=>{y.b.error(e.message||Object(c.__)("Something went wrong when untrashing the forms.","wp-eform"))})),title:Object(c.__)("UNTRASH","wp-eform")}),g.push({id:"delete",danger:!0,onClick:()=>new Promise(((e,t)=>{D.a.confirm({title:Object(c.__)("Dangerous operation ahead","wp-eform"),content:Object(U.jsx)("p",{style:{fontSize:"16px"},children:Object(c.__)("Forms once deleted permanently, cannot be restored. Are you sure?","wp-eform")}),okButtonProps:{danger:!0},okText:Object(c.__)("YES","wp-eform"),cancelText:Object(c.__)("CANCEL","wp-eform"),onCancel:()=>{D.a.destroyAll(),t()},onOk:()=>{e(b().catch((e=>{y.b.error(e.message||Object(c.__)("Something went wrong when deleting the forms.","wp-eform"))})))},icon:Object(U.jsx)(ye.a,{})})})),title:Object(c.__)("DELETE","wp-eform")})):"all"!==e.currentView&&"owned"!==e.currentView||g.push({id:"trash",danger:!0,onClick:()=>r().catch((e=>{y.b.error(e.message||Object(c.__)("Something went wrong when trashing the forms.","wp-eform"))})),title:Object(c.__)("TRASH","wp-eform")}),[g,f]}(s),x=Object(o.a)(w,2),C=x[0],_=x[1];let k=Object(c.__)("No forms found.","wp-eform");""!==s.search||null!=s.filters.owner&&s.filters.owner!==Me&&!Pe||null!=s.filters.category?k=Object(c.__)("No forms found, please clear some of the filters.","wp-eform"):"shared"===s.currentView?k=Object(c.__)("No forms shared with you.","wp-eform"):"trashed"===s.currentView&&(k=Object(c.__)("Trash is empty.","wp-eform"));const S=Object(i.useState)({visible:!1,formId:void 0}),E=Object(o.a)(S,2),T=E[0],F=E[1],P=function(e,t,n){const o=Object(l.n)().path;return Object(i.useCallback)(((i,r,s)=>{switch(r.value){case"name":return Object(U.jsx)("label",{htmlFor:i.node.id,children:i.node.name});case"viewCount":return Object(U.jsx)("span",{children:i.node.viewCount});case"submissionCount":return Object(U.jsx)("span",{children:i.node.submissionCount});case"created":return Object(U.jsx)("span",{children:I.e.utc(i.node.created).local().format(I.c)});case"updated":return Object(U.jsx)("span",{children:I.e.utc(i.node.updated).local().format(I.c)});case"owner":return Object(U.jsx)("span",{children:i.node.owner.username});case"action":return Object(U.jsx)(re,{currentView:s,path:o,item:i,setUpdateLogState:e});case"categories":return i.node.categories.map((e=>Object(U.jsx)("a",{role:"button",href:"#",title:Object(c.__)("View forms only from this category","wp-eform"),onClick:o=>{o.preventDefault(),n({type:"SET_FILTERS",payload:{filters:{...t.filters,category:e.id}}})},style:{margin:"4px 0",display:"block"},children:e.title},e.id)));default:return Object(U.jsx)("span",{children:Object(c.__)("Unknown","wp-eform")})}}),[o,e,t,n])}(F,s,d);return Object(U.jsx)(U.Fragment,{children:v&&!O?Object(U.jsx)(b.a,{children:Object(U.jsx)(g.a,{description:v.message,type:"500",to:()=>{window.location.reload()},title:Object(c.__)("Server Error","wp-eform"),buttonLabel:Object(c.__)("Reload","wp-eform")})}):Object(U.jsxs)(b.a,{minimal:!0,children:[Object(U.jsx)(m.a,{emptyText:k,evictFieldNames:["forms","formMeta","submissionMeta"],state:s,dispatch:d,views:Be,onMutation:u,renderFilters:Object(U.jsx)(Te,{state:s,dispatch:d,filterData:r}),resetFilters:Ne,orderBys:Le,items:null==p||null===(t=p.forms)||void 0===t?void 0:t.edges,generatePreview:()=>Object(U.jsx)(we,{state:s}),generateItemRow:e=>Object(U.jsx)(se,{state:s,dispatch:d,item:e,setUpdateLogState:F}),getItemId:e=>e.node.id,totalItems:null==p||null===(n=p.forms)||void 0===n?void 0:n.totalCount,loadingData:O,itemNamePlural:Object(c.__)("forms","wp-eform"),itemNameSingular:Object(c.__)("form","wp-eform"),isDoingBulk:_,bulkActions:C,tableModeColumns:ke,renderTableCell:P}),Object(U.jsx)(Y,{state:T,updateState:F})]})})}const Ae=s.a`
	query FormMetaForFilter($viewMode: ResourceViewModeEnum) {
		formMeta(resourceView: $viewMode) {
			categories {
				id
				title
				total
			}
			owners {
				id
				username
				total
			}
		}
	}
`;function De(){const e=Object(m.b)({initialFilters:Ne,initialView:"owned",initialOrderBy:"id",initialOrderDir:"descend"}),t=Object(o.a)(e,2),n=t[0],r=t[1],s=Object(i.useMemo)((()=>({viewMode:Object(j.b)(n.currentView,Pe)})),[n.currentView]),d=Object(a.b)(Ae,{fetchPolicy:"no-cache",variables:s}),u=d.loading,p=d.data,f=d.error,O=d.refetch,v=Object(i.useCallback)((()=>{O(s)}),[O,s]),w=Object(l.n)().path;return Object(U.jsxs)(U.Fragment,{children:[Object(U.jsx)(h.a,{title:Object(c.__)("Forms","wp-eform"),newLink:`${w}/new`,controlRight:Object(U.jsx)(m.a.DisplayModeUI,{state:n,dispatch:r}),backLink:null}),f&&!u?Object(U.jsx)(b.a,{children:Object(U.jsx)(g.a,{description:f.message,type:"500",to:()=>{window.location.reload()},title:Object(c.__)("Server Error","wp-eform"),buttonLabel:Object(c.__)("Reload","wp-eform")})}):Object(U.jsx)(Re,{filterData:p,state:n,dispatch:r,onMutation:v})]})}}}]);
//# sourceMappingURL=12-9665d569.js.map