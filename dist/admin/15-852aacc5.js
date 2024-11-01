/*! For license information please see 15-852aacc5.js.LICENSE.txt */
(window.wpackiowpqEformadminJsonp=window.wpackiowpqEformadminJsonp||[]).push([[15],{1034:function(e,t,n){"use strict";n.d(t,"a",(function(){return U})),n.d(t,"b",(function(){return W})),n.d(t,"c",(function(){return A})),n.d(t,"d",(function(){return a})),n.d(t,"e",(function(){return s})),n.d(t,"f",(function(){return v})),n.d(t,"g",(function(){return S})),n.d(t,"h",(function(){return u})),n.d(t,"i",(function(){return Y})),n.d(t,"j",(function(){return X})),n.d(t,"k",(function(){return G})),n.d(t,"l",(function(){return b})),n.d(t,"m",(function(){return Q})),n.d(t,"n",(function(){return h})),n.d(t,"o",(function(){return K})),n.d(t,"p",(function(){return Z})),n.d(t,"q",(function(){return f})),n.d(t,"r",(function(){return J}));var o=n(6),i=n(1035);function s(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function r(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var o=Object.getOwnPropertySymbols(e);t&&(o=o.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,o)}return n}function a(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?r(Object(n),!0).forEach((function(t){s(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):r(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}const c={pointer:{start:"down",change:"move",end:"up"},mouse:{start:"down",change:"move",end:"up"},touch:{start:"start",change:"move",end:"end"},gesture:{start:"start",change:"change",end:"end"}};function l(e){return e?e[0].toUpperCase()+e.slice(1):""}const d=["enter","leave"];function u(e,t="",n=!1){const o=c[e],i=o&&o[t]||t;return"on"+l(e)+l(i)+(function(e=!1,t){return e&&!d.includes(t)}(n,i)?"Capture":"")}const m=["gotpointercapture","lostpointercapture"];function h(e){let t=e.substring(2).toLowerCase();const n=!!~t.indexOf("passive");n&&(t=t.replace("passive",""));const o=m.includes(t)?"capturecapture":"capture",i=!!~t.indexOf(o);return i&&(t=t.replace("capture","")),{device:t,capture:i,passive:n}}function f(e,t=""){const n=c[e];return e+(n&&n[t]||t)}function b(e){return"touches"in e}function p(e){return b(e)?"touch":"pointerType"in e?e.pointerType:"mouse"}function g(e){return b(e)?function(e){return"touchend"===e.type||"touchcancel"===e.type?e.changedTouches:e.targetTouches}(e)[0]:e}function j(e,t){const n=t.clientX-e.clientX,o=t.clientY-e.clientY,i=(t.clientX+e.clientX)/2,s=(t.clientY+e.clientY)/2,r=Math.hypot(n,o);return{angle:-180*Math.atan2(n,o)/Math.PI,distance:r,origin:[i,s]}}function v(e){return function(e){return Array.from(e.touches).filter((t=>{var n,o;return t.target===e.currentTarget||(null===(n=e.currentTarget)||void 0===n||null===(o=n.contains)||void 0===o?void 0:o.call(n,t.target))}))}(e).map((e=>e.identifier))}function O(e,t){const n=Array.from(e.touches).filter((e=>t.includes(e.identifier))),i=Object(o.a)(n,2);return j(i[0],i[1])}function y(e){const t=g(e);return b(e)?t.identifier:t.pointerId}function w(e){const t=g(e);return[t.clientX,t.clientY]}function x(e){let t=e.deltaX,n=e.deltaY,o=e.deltaMode;return 1===o?(t*=40,n*=40):2===o&&(t*=800,n*=800),[t,n]}function C(e,...t){return"function"==typeof e?e(...t):e}function k(){}function S(...e){return 0===e.length?k:1===e.length?e[0]:function(){let t;for(const n of e)t=n.apply(this,arguments)||t;return t}}function _(e,t){return Object.assign({},t,e||{})}class F{constructor(e,t,n){this.ctrl=e,this.args=t,this.key=n,this.state||(this.state={},this.computeValues([0,0]),this.computeInitial(),this.init&&this.init(),this.reset())}get state(){return this.ctrl.state[this.key]}set state(e){this.ctrl.state[this.key]=e}get shared(){return this.ctrl.state.shared}get eventStore(){return this.ctrl.gestureEventStores[this.key]}get timeoutStore(){return this.ctrl.gestureTimeoutStores[this.key]}get config(){return this.ctrl.config[this.key]}get sharedConfig(){return this.ctrl.config.shared}get handler(){return this.ctrl.handlers[this.key]}reset(){const e=this.state,t=this.shared,n=this.ingKey,o=this.args;t[n]=e._active=e.active=e._blocked=e._force=!1,e._step=[!1,!1],e.intentional=!1,e._movement=[0,0],e._distance=[0,0],e._direction=[0,0],e._delta=[0,0],e._bounds=[[-1/0,1/0],[-1/0,1/0]],e.args=o,e.axis=void 0,e.memo=void 0,e.elapsedTime=0,e.direction=[0,0],e.distance=[0,0],e.overflow=[0,0],e._movementBound=[!1,!1],e.velocity=[0,0],e.movement=[0,0],e.delta=[0,0],e.timeStamp=0}start(e){const t=this.state,n=this.config;t._active||(this.reset(),this.computeInitial(),t._active=!0,t.target=e.target,t.currentTarget=e.currentTarget,t.lastOffset=n.from?C(n.from,t):t.offset,t.offset=t.lastOffset),t.startTime=t.timeStamp=e.timeStamp}computeValues(e){const t=this.state;t._values=e,t.values=this.config.transform(e)}computeInitial(){const e=this.state;e._initial=e._values,e.initial=e.values}compute(e){const t=this.state,n=this.config,s=this.shared;t.args=this.args;let r=0;if(e&&(t.event=e,n.preventDefault&&e.cancelable&&t.event.preventDefault(),t.type=e.type,s.touches=this.ctrl.pointerIds.size||this.ctrl.touchIds.size,s.locked=!!document.pointerLockElement,Object.assign(s,function(e){const t={};if("buttons"in e&&(t.buttons=e.buttons),"shiftKey"in e){const n=e.shiftKey,o=e.altKey,i=e.metaKey,s=e.ctrlKey;Object.assign(t,{shiftKey:n,altKey:o,metaKey:i,ctrlKey:s})}return t}(e)),s.down=s.pressed=s.buttons%2==1||s.touches>0,r=e.timeStamp-t.timeStamp,t.timeStamp=e.timeStamp,t.elapsedTime=t.timeStamp-t.startTime),t._active){const e=t._delta.map(Math.abs);i.a.addTo(t._distance,e)}this.axisIntent&&this.axisIntent(e);const a=Object(o.a)(t._movement,2),c=a[0],l=a[1],d=Object(o.a)(n.threshold,2),u=d[0],m=d[1],h=t._step,f=t.values;if(n.hasCustomTransform?(!1===h[0]&&(h[0]=Math.abs(c)>=u&&f[0]),!1===h[1]&&(h[1]=Math.abs(l)>=m&&f[1])):(!1===h[0]&&(h[0]=Math.abs(c)>=u&&Math.sign(c)*u),!1===h[1]&&(h[1]=Math.abs(l)>=m&&Math.sign(l)*m)),t.intentional=!1!==h[0]||!1!==h[1],!t.intentional)return;const b=[0,0];if(n.hasCustomTransform){const e=Object(o.a)(f,2),t=e[0],n=e[1];b[0]=!1!==h[0]?t-h[0]:0,b[1]=!1!==h[1]?n-h[1]:0}else b[0]=!1!==h[0]?c-h[0]:0,b[1]=!1!==h[1]?l-h[1]:0;this.restrictToAxis&&!t._blocked&&this.restrictToAxis(b);const p=t.offset,g=t._active&&!t._blocked||t.active;g&&(t.first=t._active&&!t.active,t.last=!t._active&&t.active,t.active=s[this.ingKey]=t._active,e&&(t.first&&("bounds"in n&&(t._bounds=C(n.bounds,t)),this.setup&&this.setup()),t.movement=b,this.computeOffset()));const j=Object(o.a)(t.offset,2),v=j[0],O=j[1],y=Object(o.a)(t._bounds,2),w=Object(o.a)(y[0],2),x=w[0],k=w[1],S=Object(o.a)(y[1],2),_=S[0],F=S[1];t.overflow=[v<x?-1:v>k?1:0,O<_?-1:O>F?1:0],t._movementBound[0]=!!t.overflow[0]&&(!1===t._movementBound[0]?t._movement[0]:t._movementBound[0]),t._movementBound[1]=!!t.overflow[1]&&(!1===t._movementBound[1]?t._movement[1]:t._movementBound[1]);const E=t._active&&n.rubberband||[0,0];if(t.offset=Object(i.b)(t._bounds,t.offset,E),t.delta=i.a.sub(t.offset,p),this.computeMovement(),g&&(!t.last||r>32)){t.delta=i.a.sub(t.offset,p);const e=t.delta.map(Math.abs);i.a.addTo(t.distance,e),t.direction=t.delta.map(Math.sign),t._direction=t._delta.map(Math.sign),!t.first&&r>0&&(t.velocity=[e[0]/r,e[1]/r])}}emit(){const e=this.state,t=this.shared,n=this.config;if(e._active||this.clean(),(e._blocked||!e.intentional)&&!e._force&&!n.triggerAllEvents)return;const o=this.handler(a(a(a({},t),e),{},{[this.aliasKey]:e.values}));void 0!==o&&(e.memo=o)}clean(){this.eventStore.clean(),this.timeoutStore.clean()}}class E extends F{constructor(...e){super(...e),s(this,"aliasKey","xy")}reset(){super.reset(),this.state.axis=void 0}init(){this.state.offset=[0,0],this.state.lastOffset=[0,0]}computeOffset(){this.state.offset=i.a.add(this.state.lastOffset,this.state.movement)}computeMovement(){this.state.movement=i.a.sub(this.state.offset,this.state.lastOffset)}axisIntent(e){const t=this.state,n=this.config;if(!t.axis&&e){const o="object"==typeof n.axisThreshold?n.axisThreshold[p(e)]:n.axisThreshold;t.axis=function([e,t],n){const o=Math.abs(e),i=Math.abs(t);return o>i&&o>n?"x":i>o&&i>n?"y":void 0}(t._movement,o)}t._blocked=(n.lockDirection||!!n.axis)&&!t.axis||!!n.axis&&n.axis!==t.axis}restrictToAxis(e){if(this.config.axis||this.config.lockDirection)switch(this.state.axis){case"x":e[1]=0;break;case"y":e[0]=0}}}const T=e=>e,I={enabled:(e=!0)=>e,eventOptions:(e,t,n)=>a(a({},n.shared.eventOptions),e),preventDefault:(e=!1)=>e,triggerAllEvents:(e=!1)=>e,rubberband(e=0){switch(e){case!0:return[.15,.15];case!1:return[0,0];default:return i.a.toVector(e)}},from:e=>"function"==typeof e?e:null!=e?i.a.toVector(e):void 0,transform(e,t,n){const o=e||n.shared.transform;return this.hasCustomTransform=!!o,o||T},threshold:e=>i.a.toVector(e,0)};const M=a(a({},I),{},{axis(e,t,{axis:n}){if(this.lockDirection="lock"===n,!this.lockDirection)return n},axisThreshold:(e=0)=>e,bounds(e={}){if("function"==typeof e)return t=>M.bounds(e(t));if("current"in e)return()=>e.current;if("function"==typeof HTMLElement&&e instanceof HTMLElement)return e;const t=e.left,n=void 0===t?-1/0:t,o=e.right,i=void 0===o?1/0:o,s=e.top,r=void 0===s?-1/0:s,a=e.bottom;return[[n,i],[r,void 0===a?1/0:a]]}}),P={ArrowRight:(e=1)=>[10*e,0],ArrowLeft:(e=1)=>[-10*e,0],ArrowUp:(e=1)=>[0,-10*e],ArrowDown:(e=1)=>[0,10*e]};const L="undefined"!=typeof window&&window.document&&window.document.createElement;function B(){return L&&"ontouchstart"in window||L&&window.navigator.maxTouchPoints>1}const A={isBrowser:L,gesture:function(){try{return"constructor"in GestureEvent}catch(e){return!1}}(),touch:B(),touchscreen:B(),pointer:L&&"onpointerdown"in window,pointerLock:L&&"exitPointerLock"in window.document},N={mouse:0,touch:0,pen:8},D=a(a({},M),{},{device(e,t,{pointer:{touch:n=!1,lock:o=!1,mouse:i=!1}={}}){return this.pointerLock=o&&A.pointerLock,A.touch&&n?"touch":this.pointerLock?"mouse":A.pointer&&!i?"pointer":A.touch?"touch":"mouse"},preventScrollAxis(e,t,{preventScroll:n}){if(this.preventScrollDelay="number"==typeof n?n:n||void 0===n&&e?250:void 0,A.touchscreen&&!1!==n)return e||(void 0!==n?"y":void 0)},pointerCapture(e,t,{pointer:{capture:n=!0,buttons:o=1,keys:i=!0}={}}){return this.pointerButtons=o,this.keys=i,!this.pointerLock&&"pointer"===this.device&&n},threshold(e,t,{filterTaps:n=!1,tapsThreshold:o=3,axis:s}){const r=i.a.toVector(e,n?o:s?1:0);return this.filterTaps=n,this.tapsThreshold=o,r},swipe({velocity:e=.5,distance:t=50,duration:n=250}={}){return{velocity:this.transform(i.a.toVector(e)),distance:this.transform(i.a.toVector(t)),duration:n}},delay(e=0){switch(e){case!0:return 180;case!1:return 0;default:return e}},axisThreshold:e=>e?a(a({},N),e):N});function R(e){const t=Object(o.a)(e.overflow,2),n=t[0],i=t[1],s=Object(o.a)(e._delta,2),r=s[0],a=s[1],c=Object(o.a)(e._direction,2),l=c[0],d=c[1];(n<0&&r>0&&l<0||n>0&&r<0&&l>0)&&(e._movement[0]=e._movementBound[0]),(i<0&&a>0&&d<0||i>0&&a<0&&d>0)&&(e._movement[1]=e._movementBound[1])}const H=a(a({},I),{},{device(e,t,{shared:n,pointer:{touch:o=!1}={}}){if(n.target&&!A.touch&&A.gesture)return"gesture";if(A.touch&&o)return"touch";if(A.touchscreen){if(A.pointer)return"pointer";if(A.touch)return"touch"}},bounds(e,t,{scaleBounds:n={},angleBounds:o={}}){const i=e=>{const t=_(C(n,e),{min:-1/0,max:1/0});return[t.min,t.max]},s=e=>{const t=_(C(o,e),{min:-1/0,max:1/0});return[t.min,t.max]};return"function"!=typeof n&&"function"!=typeof o?[i(),s()]:e=>[i(e),s(e)]},threshold(e,t,n){this.lockDirection="lock"===n.axis;return i.a.toVector(e,this.lockDirection?[.1,3]:0)},modifierKey:e=>void 0===e?"ctrlKey":e,pinchOnWheel:(e=!0)=>e});const z=a(a({},M),{},{mouseOnly:(e=!0)=>e});const $=M;const q=M;const V=a(a({},M),{},{mouseOnly:(e=!0)=>e}),W=new Map,U=new Map;function K(e){W.set(e.key,e.engine),U.set(e.key,e.resolver)}const Y={key:"drag",engine:class extends E{constructor(...e){super(...e),s(this,"ingKey","dragging")}reset(){super.reset();const e=this.state;e._pointerId=void 0,e._pointerActive=!1,e._keyboardActive=!1,e._preventScroll=!1,e._delayed=!1,e.swipe=[0,0],e.tap=!1,e.canceled=!1,e.cancel=this.cancel.bind(this)}setup(){const e=this.state;if(e._bounds instanceof HTMLElement){const t=e._bounds.getBoundingClientRect(),n=e.currentTarget.getBoundingClientRect(),o={left:t.left-n.left+e.offset[0],right:t.right-n.right+e.offset[0],top:t.top-n.top+e.offset[1],bottom:t.bottom-n.bottom+e.offset[1]};e._bounds=M.bounds(o)}}cancel(){const e=this.state;e.canceled||(e.canceled=!0,e._active=!1,setTimeout((()=>{this.compute(),this.emit()}),0))}setActive(){this.state._active=this.state._pointerActive||this.state._keyboardActive}clean(){this.pointerClean(),this.state._pointerActive=!1,this.state._keyboardActive=!1,super.clean()}pointerDown(e){const t=this.config,n=this.state;if(null!=e.buttons&&(Array.isArray(t.pointerButtons)?!t.pointerButtons.includes(e.buttons):-1!==t.pointerButtons&&t.pointerButtons!==e.buttons))return;const o=this.ctrl.setEventIds(e);t.pointerCapture&&e.target.setPointerCapture(e.pointerId),o&&o.size>1&&n._pointerActive||(this.start(e),this.setupPointer(e),n._pointerId=y(e),n._pointerActive=!0,this.computeValues(w(e)),this.computeInitial(),t.preventScrollAxis&&"mouse"!==p(e)?(n._active=!1,this.setupScrollPrevention(e)):t.delay>0?(this.setupDelayTrigger(e),t.triggerAllEvents&&(this.compute(e),this.emit())):this.startPointerDrag(e))}startPointerDrag(e){const t=this.state;t._active=!0,t._preventScroll=!0,t._delayed=!1,this.compute(e),this.emit()}pointerMove(e){const t=this.state,n=this.config;if(!t._pointerActive)return;if(t.type===e.type&&e.timeStamp===t.timeStamp)return;const o=y(e);if(void 0!==t._pointerId&&o!==t._pointerId)return;const s=w(e);return document.pointerLockElement===e.target?t._delta=[e.movementX,e.movementY]:(t._delta=i.a.sub(s,t._values),this.computeValues(s)),i.a.addTo(t._movement,t._delta),this.compute(e),t._delayed&&t.intentional?(this.timeoutStore.remove("dragDelay"),t.active=!1,void this.startPointerDrag(e)):n.preventScrollAxis&&!t._preventScroll?t.axis?t.axis===n.preventScrollAxis||"xy"===n.preventScrollAxis?(t._active=!1,void this.clean()):(this.timeoutStore.remove("startPointerDrag"),void this.startPointerDrag(e)):void 0:void this.emit()}pointerUp(e){this.ctrl.setEventIds(e);try{this.config.pointerCapture&&e.target.hasPointerCapture(e.pointerId)&&e.target.releasePointerCapture(e.pointerId)}catch(e){0}const t=this.state,n=this.config;if(!t._active||!t._pointerActive)return;const i=y(e);if(void 0!==t._pointerId&&i!==t._pointerId)return;this.state._pointerActive=!1,this.setActive(),this.compute(e);const s=Object(o.a)(t._distance,2),r=s[0],a=s[1];if(t.tap=r<=n.tapsThreshold&&a<=n.tapsThreshold,t.tap&&n.filterTaps)t._force=!0;else{const e=Object(o.a)(t.direction,2),i=e[0],s=e[1],r=Object(o.a)(t.velocity,2),a=r[0],c=r[1],l=Object(o.a)(t.movement,2),d=l[0],u=l[1],m=Object(o.a)(n.swipe.velocity,2),h=m[0],f=m[1],b=Object(o.a)(n.swipe.distance,2),p=b[0],g=b[1],j=n.swipe.duration;t.elapsedTime<j&&(Math.abs(a)>h&&Math.abs(d)>p&&(t.swipe[0]=i),Math.abs(c)>f&&Math.abs(u)>g&&(t.swipe[1]=s))}this.emit()}pointerClick(e){!this.state.tap&&e.detail>0&&(e.preventDefault(),e.stopPropagation())}setupPointer(e){const t=this.config,n=t.device;t.pointerLock&&e.currentTarget.requestPointerLock(),t.pointerCapture||(this.eventStore.add(this.sharedConfig.window,n,"change",this.pointerMove.bind(this)),this.eventStore.add(this.sharedConfig.window,n,"end",this.pointerUp.bind(this)),this.eventStore.add(this.sharedConfig.window,n,"cancel",this.pointerUp.bind(this)))}pointerClean(){this.config.pointerLock&&document.pointerLockElement===this.state.currentTarget&&document.exitPointerLock()}preventScroll(e){this.state._preventScroll&&e.cancelable&&e.preventDefault()}setupScrollPrevention(e){this.state._preventScroll=!1,function(e){"persist"in e&&"function"==typeof e.persist&&e.persist()}(e);const t=this.eventStore.add(this.sharedConfig.window,"touch","change",this.preventScroll.bind(this),{passive:!1});this.eventStore.add(this.sharedConfig.window,"touch","end",t),this.eventStore.add(this.sharedConfig.window,"touch","cancel",t),this.timeoutStore.add("startPointerDrag",this.startPointerDrag.bind(this),this.config.preventScrollDelay,e)}setupDelayTrigger(e){this.state._delayed=!0,this.timeoutStore.add("dragDelay",(()=>{this.state._step=[0,0],this.startPointerDrag(e)}),this.config.delay)}keyDown(e){const t=P[e.key];if(t){const n=this.state,o=e.shiftKey?10:e.altKey?.1:1;this.start(e),n._delta=t(o),n._keyboardActive=!0,i.a.addTo(n._movement,n._delta),this.compute(e),this.emit()}}keyUp(e){e.key in P&&(this.state._keyboardActive=!1,this.setActive(),this.compute(e),this.emit())}bind(e){const t=this.config.device;e(t,"start",this.pointerDown.bind(this)),this.config.pointerCapture&&(e(t,"change",this.pointerMove.bind(this)),e(t,"end",this.pointerUp.bind(this)),e(t,"cancel",this.pointerUp.bind(this)),e("lostPointerCapture","",this.pointerUp.bind(this))),this.config.keys&&(e("key","down",this.keyDown.bind(this)),e("key","up",this.keyUp.bind(this))),this.config.filterTaps&&e("click","",this.pointerClick.bind(this),{capture:!0,passive:!1})}},resolver:D},G={key:"hover",engine:class extends E{constructor(...e){super(...e),s(this,"ingKey","hovering")}enter(e){this.config.mouseOnly&&"mouse"!==e.pointerType||(this.start(e),this.computeValues(w(e)),this.compute(e),this.emit())}leave(e){if(this.config.mouseOnly&&"mouse"!==e.pointerType)return;const t=this.state;if(!t._active)return;t._active=!1;const n=w(e);t._movement=t._delta=i.a.sub(n,t._values),this.computeValues(n),this.compute(e),t.delta=t.movement,this.emit()}bind(e){e("pointer","enter",this.enter.bind(this)),e("pointer","leave",this.leave.bind(this))}},resolver:V},Q={key:"move",engine:class extends E{constructor(...e){super(...e),s(this,"ingKey","moving")}move(e){this.config.mouseOnly&&"mouse"!==e.pointerType||(this.state._active?this.moveChange(e):this.moveStart(e),this.timeoutStore.add("moveEnd",this.moveEnd.bind(this)))}moveStart(e){this.start(e),this.computeValues(w(e)),this.compute(e),this.computeInitial(),this.emit()}moveChange(e){if(!this.state._active)return;const t=w(e),n=this.state;n._delta=i.a.sub(t,n._values),i.a.addTo(n._movement,n._delta),this.computeValues(t),this.compute(e),this.emit()}moveEnd(e){this.state._active&&(this.state._active=!1,this.compute(e),this.emit())}bind(e){e("pointer","change",this.move.bind(this)),e("pointer","leave",this.moveEnd.bind(this))}},resolver:z},X={key:"pinch",engine:class extends F{constructor(...e){super(...e),s(this,"ingKey","pinching"),s(this,"aliasKey","da")}init(){this.state.offset=[1,0],this.state.lastOffset=[1,0],this.state._pointerEvents=new Map}reset(){super.reset();const e=this.state;e._touchIds=[],e.canceled=!1,e.cancel=this.cancel.bind(this),e.turns=0}computeOffset(){const e=this.state,t=e.type,n=e.movement,o=e.lastOffset;this.state.offset="wheel"===t?i.a.add(n,o):[(1+n[0])*o[0],n[1]+o[1]]}computeMovement(){const e=this.state,t=e.offset,n=e.lastOffset;this.state.movement=[t[0]/n[0],t[1]-n[1]]}axisIntent(){const e=this.state,t=Object(o.a)(e._movement,2),n=t[0],i=t[1];if(!e.axis){const t=30*Math.abs(n)-Math.abs(i);t<0?e.axis="angle":t>0&&(e.axis="scale")}}restrictToAxis(e){this.config.lockDirection&&("scale"===this.state.axis?e[1]=0:"angle"===this.state.axis&&(e[0]=0))}cancel(){const e=this.state;e.canceled||setTimeout((()=>{e.canceled=!0,e._active=!1,this.compute(),this.emit()}),0)}touchStart(e){this.ctrl.setEventIds(e);const t=this.state,n=this.ctrl.touchIds;if(t._active&&t._touchIds.every((e=>n.has(e))))return;if(n.size<2)return;this.start(e),t._touchIds=Array.from(n).slice(0,2);const o=O(e,t._touchIds);this.pinchStart(e,o)}pointerStart(e){if(null!=e.buttons&&e.buttons%2!=1)return;this.ctrl.setEventIds(e),e.target.setPointerCapture(e.pointerId);const t=this.state,n=t._pointerEvents,o=this.ctrl.pointerIds;if(t._active&&Array.from(n.keys()).every((e=>o.has(e))))return;if(n.size<2&&n.set(e.pointerId,e),t._pointerEvents.size<2)return;this.start(e);const i=j(...Array.from(n.values()));this.pinchStart(e,i)}pinchStart(e,t){this.state.origin=t.origin,this.computeValues([t.distance,t.angle]),this.computeInitial(),this.compute(e),this.emit()}touchMove(e){if(!this.state._active)return;const t=O(e,this.state._touchIds);this.pinchMove(e,t)}pointerMove(e){const t=this.state._pointerEvents;if(t.has(e.pointerId)&&t.set(e.pointerId,e),!this.state._active)return;const n=j(...Array.from(t.values()));this.pinchMove(e,n)}pinchMove(e,t){const n=this.state,o=n._values[1],i=t.angle-o;let s=0;Math.abs(i)>270&&(s+=Math.sign(i)),this.computeValues([t.distance,t.angle-360*s]),n.origin=t.origin,n.turns=s,n._movement=[n._values[0]/n._initial[0]-1,n._values[1]-n._initial[1]],this.compute(e),this.emit()}touchEnd(e){this.ctrl.setEventIds(e),this.state._active&&this.state._touchIds.some((e=>!this.ctrl.touchIds.has(e)))&&(this.state._active=!1,this.compute(e),this.emit())}pointerEnd(e){const t=this.state;this.ctrl.setEventIds(e);try{e.target.releasePointerCapture(e.pointerId)}catch(e){}t._pointerEvents.has(e.pointerId)&&t._pointerEvents.delete(e.pointerId),t._active&&t._pointerEvents.size<2&&(t._active=!1,this.compute(e),this.emit())}gestureStart(e){e.cancelable&&e.preventDefault();const t=this.state;t._active||(this.start(e),this.computeValues([e.scale,e.rotation]),t.origin=[e.clientX,e.clientY],this.compute(e),this.emit())}gestureMove(e){if(e.cancelable&&e.preventDefault(),!this.state._active)return;const t=this.state;this.computeValues([e.scale,e.rotation]),t.origin=[e.clientX,e.clientY];const n=t._movement;t._movement=[e.scale-1,e.rotation],t._delta=i.a.sub(t._movement,n),this.compute(e),this.emit()}gestureEnd(e){this.state._active&&(this.state._active=!1,this.compute(e),this.emit())}wheel(e){const t=this.config.modifierKey;t&&!e[t]||(this.state._active?this.wheelChange(e):this.wheelStart(e),this.timeoutStore.add("wheelEnd",this.wheelEnd.bind(this)))}wheelStart(e){this.start(e),this.wheelChange(e)}wheelChange(e){"uv"in e||e.cancelable&&e.preventDefault();const t=this.state;t._delta=[-x(e)[1]/100*t.offset[0],0],i.a.addTo(t._movement,t._delta),R(t),this.state.origin=[e.clientX,e.clientY],this.compute(e),this.emit()}wheelEnd(){this.state._active&&(this.state._active=!1,this.compute(),this.emit())}bind(e){const t=this.config.device;t&&(e(t,"start",this[t+"Start"].bind(this)),e(t,"change",this[t+"Move"].bind(this)),e(t,"end",this[t+"End"].bind(this)),e(t,"cancel",this[t+"End"].bind(this))),this.config.pinchOnWheel&&e("wheel","",this.wheel.bind(this),{passive:!1})}},resolver:H},Z={key:"scroll",engine:class extends E{constructor(...e){super(...e),s(this,"ingKey","scrolling")}scroll(e){this.state._active||this.start(e),this.scrollChange(e),this.timeoutStore.add("scrollEnd",this.scrollEnd.bind(this))}scrollChange(e){e.cancelable&&e.preventDefault();const t=this.state,n=function(e){var t,n;const o=e.currentTarget,i=o.scrollX,s=o.scrollY,r=o.scrollLeft,a=o.scrollTop;return[null!==(t=null!=i?i:r)&&void 0!==t?t:0,null!==(n=null!=s?s:a)&&void 0!==n?n:0]}(e);t._delta=i.a.sub(n,t._values),i.a.addTo(t._movement,t._delta),this.computeValues(n),this.compute(e),this.emit()}scrollEnd(){this.state._active&&(this.state._active=!1,this.compute(),this.emit())}bind(e){e("scroll","",this.scroll.bind(this))}},resolver:$},J={key:"wheel",engine:class extends E{constructor(...e){super(...e),s(this,"ingKey","wheeling")}wheel(e){this.state._active||this.start(e),this.wheelChange(e),this.timeoutStore.add("wheelEnd",this.wheelEnd.bind(this))}wheelChange(e){const t=this.state;t._delta=x(e),i.a.addTo(t._movement,t._delta),R(t),this.compute(e),this.emit()}wheelEnd(){this.state._active&&(this.state._active=!1,this.compute(),this.emit())}bind(e){e("wheel","",this.wheel.bind(this))}},resolver:q}},1035:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return a}));var o=n(6);const i={toVector:(e,t)=>(void 0===e&&(e=t),Array.isArray(e)?e:[e,e]),add:(e,t)=>[e[0]+t[0],e[1]+t[1]],sub:(e,t)=>[e[0]-t[0],e[1]-t[1]],addTo(e,t){e[0]+=t[0],e[1]+=t[1]},subTo(e,t){e[0]-=t[0],e[1]-=t[1]}};function s(e,t,n){return 0===t||Math.abs(t)===1/0?Math.pow(e,5*n):e*t*n/(t+n*e)}function r(e,t,n,o=.15){return 0===o?function(e,t,n){return Math.max(t,Math.min(e,n))}(e,t,n):e<t?-s(t-e,n-t,o)+t:e>n?+s(e-n,n-t,o)+n:e}function a(e,[t,n],[i,s]){const a=Object(o.a)(e,2),c=Object(o.a)(a[0],2),l=c[0],d=c[1],u=Object(o.a)(a[1],2),m=u[0],h=u[1];return[r(t,l,d,i),r(n,m,h,s)]}},1036:function(e,t,n){"use strict";n.d(t,"c",(function(){return O})),n.d(t,"b",(function(){return v})),n.d(t,"a",(function(){return k}));var o=n(15),i=n(0),s=n(7),r=n(1092),a=n(98),c=(n(8),n(1043)),l=n(1041),d=n(1);const u=Object(i.createContext)(void 0);var m=n(443),h=n(21),f=n(2),b=n(1066),p=n(29);n(281);const g=m.a.getItems()[0].item.config,j=Object(i.createContext)(void 0);function v(e){var t,n,o,i,s,r,a,c,l,d,u,m,h,f,b,p;return{scheme:null==e||null===(t=e.theme)||void 0===t?void 0:t.scheme,baseFont:null==e||null===(n=e.typography)||void 0===n?void 0:n.baseFont,boldHeading:null==e||null===(o=e.typography)||void 0===o?void 0:o.headFontBold,italicHeading:null==e||null===(i=e.typography)||void 0===i?void 0:i.headFontItalic,headFamily:null==e||null===(s=e.typography)||void 0===s?void 0:s.headFamily,headFamilyCustom:null==e||null===(r=e.typography)||void 0===r?void 0:r.headFamilyCustom,bodyFamily:null==e||null===(a=e.typography)||void 0===a?void 0:a.bodyFamily,bodyFamilyCustom:null==e||null===(c=e.typography)||void 0===c?void 0:c.bodyFamilyCustom,customPrimaryColor:null==e||null===(l=e.theme)||void 0===l?void 0:l.customColorPrimary,customSecondaryColor:null==e||null===(d=e.theme)||void 0===d?void 0:d.customColorSecondary,customBackgroundColor:null==e||null===(u=e.theme)||void 0===u?void 0:u.customColorBg,customTextColor:null==e||null===(m=e.theme)||void 0===m?void 0:m.customColorText,css:null==e||null===(h=e.theme)||void 0===h?void 0:h.css,maxWidth:null==e||null===(f=e.appearance)||void 0===f?void 0:f.maxWidth,containerLayout:null==e||null===(b=e.appearance)||void 0===b?void 0:b.containerLayout,darkMode:null==e||null===(p=e.theme)||void 0===p?void 0:p.darkMode}}function O(e){return Object(i.useMemo)((()=>v(e)),[e])}function y(e){const t=Object(i.useState)((()=>!1)),n=Object(o.a)(t,2),s=n[0];n[1];Object(i.useEffect)((()=>()=>{}),[]);const r=Object(i.useContext)(j);return Object(i.useMemo)((()=>{const t=null!=e?e:{},n=t.baseFont,i=t.bodyFamily,s=t.boldHeading,r=t.customBackgroundColor,a=t.customPrimaryColor,c=t.customSecondaryColor,l=t.customTextColor,d=t.headFamily,u=t.italicHeading,j=t.scheme;t.darkMode;let v=Object(h.c)(g);j&&m.a.hasItem(j)&&(v=Object(h.c)(m.a.getItem(j).config)),n&&16!==n&&n>=12&&(v={...v,controlHeightBase:Object(f.g)(2.5*n),borderRadiusBase:Object(f.g)(.25*n),gutter:Math.min(Math.max(Object(f.g)(1.25*n),10),40),fz:{small2:Math.ceil(.75*n),small1:Math.ceil(.875*n),base:n,large1:Math.ceil(1.125*n),large2:Math.ceil(1.25*n),large3:Math.ceil(1.5*n),large4:Math.ceil(1.875*n),large5:Math.ceil(2.25*n),large6:Math.ceil(3*n),large7:Math.ceil(3.75*n),large8:Math.ceil(4.5*n)}});const O=[];if(v.boldHeading=!!s,v.italicHeading=!!u,d){let t="inherit";if("custom"===d){var y;t=null!==(y=null==e?void 0:e.headFamilyCustom)&&void 0!==y?y:"inherit"}else{const e=Object(b.a)(d),n=Object(o.a)(e,2),i=n[0],s=n[1];t=i,s&&O.push(s)}v.fontFamilyHeading=t}if(i){let t="inherit";if("custom"===i){var w;t=null!==(w=null==e?void 0:e.bodyFamilyCustom)&&void 0!==w?w:"inherit"}else{const e=Object(b.a)(i),n=Object(o.a)(e,2),s=n[0],r=n[1];t=s,r&&O.push(r)}v.fontFamilyBody=t}const x=p.b,C=p.d;return a&&(v.primaryColor=a,v.primaryDarkColor=x(.1,a),v.primaryLightColor=C(.1,a),v.accentColor=Object(p.a)(a),v.primaryBgText=Object(p.d)(.7,a),v.primaryBackgroundColor=C(.6,a),v.linkColor=a,v.boxShadowFocus=`0 0 0 2px ${Object(p.e)(.5,a)}`,v.boxShadowControlFocus=`0 0 0 ${Object(f.n)(3)} ${Object(p.e)(.8,a)}`),c&&(v.borderColorBase=c,v.borderColorSplit=C(.1,c),v.disabledColor=C(.28,c),v.disabledBackgroundColor=C(.45,c),v.backgroundControl=C(.44,c),console.log(v.backgroundControl),v.backgroundShade=Object(p.c)(.01,C(.4,c)),v.backgroundHover=Object(p.c)(.01,C(.42,c))),r&&(v.appBackgroundColor=r),l&&(v.textColor=l,v.textColorSecondary=C(.4,l),v.headingColor=C(.1,l)),[v,Object(h.a)(O)]}),[e,s,r])}function w(e){const t=new s.a;let n;try{Object(r.renderToString)(Object(d.jsx)(s.b,{sheet:t.instance,children:Object(d.jsx)(d.Fragment,{children:e})})),n=t.getStyleElement()}catch(e){console.log(e),n=null}finally{t.seal()}return n}function x(e){const t=e.children,n=e.ssr,o=e.mode,i=e.themeStyle,r=e.widthOverride,c=e.containerLayoutOverride,l=e.theme;return Object(d.jsx)(s.c,{theme:l,children:n?Object(d.jsx)(a.a.Ssr,{width:null!=r?r:null==i?void 0:i.maxWidth,containerLayout:null!=c?c:null==i?void 0:i.containerLayout,noHorizontalPadding:"preview"===o,noVerticalPadding:"preview"===o,children:t}):Object(d.jsx)(a.a,{width:null!=r?r:null==i?void 0:i.maxWidth,containerLayout:null!=c?c:null==i?void 0:i.containerLayout,noHorizontalPadding:"preview"===o,noVerticalPadding:"preview"===o,children:t})})}function C(e){const t=e.children,n=Object(i.useContext)(u);return Object(d.jsx)(s.b,{target:n,children:Object(d.jsx)(d.Fragment,{children:t})})}function k(e){const t=e.mode,n=e.themeStyle,s=e.ssr,r=void 0!==s&&s,a=y(n),u=Object(o.a)(a,2),m=u[0],h=u[1],f=null==n?void 0:n.css,b=Object(c.b)();Object(i.useEffect)((()=>{b&&"undefined"!=typeof window&&h&&h.length&&h.forEach((e=>{const t=Object(l.d)(e);if(!document.head.querySelector(`#${t}`)){const n=document.createElement("link");n.setAttribute("href",e),n.setAttribute("id",t),n.setAttribute("rel","stylesheet"),document.head.append(n)}}))}),[h,b]);const p=Object(d.jsx)(x,{theme:m,...e}),g=Object(i.useState)(!1),j=Object(o.a)(g,2),v=j[0],O=j[1];return Object(i.useEffect)((()=>{O(!0)}),[]),Object(d.jsxs)(d.Fragment,{children:[b&&v?h.map((e=>Object(d.jsx)("link",{rel:"stylesheet",href:e},e))):null,f&&"live"===t?Object(d.jsx)("style",{type:"text/css",dangerouslySetInnerHTML:{__html:f}}):null,r?Object(d.jsxs)(d.Fragment,{children:[w(p),Object(d.jsx)("div",{className:"wpeform-root-slot__react-app",children:p})]}):Object(d.jsx)(C,{children:p})]})}},1038:function(e,t,n){"use strict";n.d(t,"a",(function(){return h}));var o=n(42),i=n(52),s=(n(0),n(83)),r=n(7),a=n(10),c=n.n(a),l=n(1);const d=["history","location","match","staticContext","to","transparent","className"],u=["onClick","transparent","className"],m=Object(r.f)(i.a).withConfig({displayName:"StyledLink__StyledLinkButton",componentId:"sc-1fap3y6-0"})(["&.wpeform-ghosted-button{border:0 none;box-shadow:none;&:hover{background-color:",";color:",";}}"],(e=>e.theme.backgroundHover),(e=>e.theme.textColor));function h(e){const t=e.onClick,n=e.transparent,i=e.className,s=Object(o.a)(e,u);return Object(l.jsx)(m,{className:c()(i,{"wpeform-ghosted-button":n}),...s,onClick:e=>{e.preventDefault(),t()}})}t.b=Object(s.o)((function(e){const t=e.history,n=(e.location,e.match,e.staticContext,e.to),i=e.transparent,s=e.className,r=Object(o.a)(e,d);return Object(l.jsx)(m,{className:c()(s,{"wpeform-ghosted-button":i}),...r,onClick:e=>{e.preventDefault(),t.push(n)}})}))},1039:function(e,t,n){"use strict";n.d(t,"a",(function(){return s}));n(0),n(8);var o=n(1036);n.d(t,"c",(function(){return o.c})),n.d(t,"b",(function(){return o.b}));var i=n(1);function s(e){const t=e.children,n=e.themeStyle,s=e.widthOverride,r=e.containerLayoutOverride,a=e.mode,c=void 0===a?"live":a,l=e.ssr,d=void 0!==l&&l;return Object(i.jsx)(o.a,{themeStyle:n,mode:c,containerLayoutOverride:r,widthOverride:s,ssr:d,children:t})}},1040:function(e,t,n){"use strict";var o=n(1034);n.d(t,"a",(function(){return o.i})),n.d(t,"b",(function(){return o.k})),n.d(t,"c",(function(){return o.m})),n.d(t,"d",(function(){return o.j})),n.d(t,"e",(function(){return o.o})),n.d(t,"f",(function(){return o.p})),n.d(t,"g",(function(){return o.r}))},1041:function(e,t,n){"use strict";n.d(t,"b",(function(){return i})),n.d(t,"a",(function(){return s})),n.d(t,"e",(function(){return r})),n.d(t,"c",(function(){return a})),n.d(t,"d",(function(){return c}));var o=n(3);function i(e,t,n=Object(o.__)("Anonymous","wp-eform")){const i=[];return e&&i.push(e),t&&i.push(t),i.length?i.join(" "):n}function s(e){const t=Math.floor(e/3600),n=e%3600,i=Math.floor(n/60),s=n%60;return t>0?Object(o.sprintf)(Object(o._x)("%1$s, %2$s, %3$s","format-time-from-seconds","wp-eform"),Object(o.sprintf)(Object(o._n)("%d hour","%d hours",t,"wp-eform"),t),Object(o.sprintf)(Object(o._n)("%d minute","%d minutes",i,"wp-eform"),i),Object(o.sprintf)(Object(o._n)("%d second","%d seconds",s,"wp-eform"),s)):i>0?Object(o.sprintf)(Object(o._x)("%1$s, %2$s","format-time-from-seconds","wp-eform"),Object(o.sprintf)(Object(o._n)("%d minute","%d minutes",i,"wp-eform"),i),Object(o.sprintf)(Object(o._n)("%d second","%d seconds",s,"wp-eform"),s)):Object(o.sprintf)(Object(o._n)("%d second","%d seconds",s,"wp-eform"),s)}function r(e,t,n="…"){return e.length<=t?e:e.substring(0,t+1)+n}const a=/%%([^%%]+)%%/;function c(...e){return e.join(" ").normalize("NFD").replace(/[\u0300-\u036f]/g,"").toLowerCase().trim().replace(/[^a-z0-9 ]/g,"").replace(/\s+/g,"-")}},1042:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));var o=n(439);function i(){o.a.evict({id:"ROOT_QUERY",fieldName:"forms"}),o.a.evict({id:"ROOT_QUERY",fieldName:"form"}),o.a.evict({id:"ROOT_QUERY",fieldName:"categories"}),o.a.evict({id:"ROOT_QUERY",fieldName:"category"}),o.a.evict({id:"ROOT_QUERY",fieldName:"submissions"}),o.a.evict({id:"ROOT_QUERY",fieldName:"submission"}),o.a.evict({id:"ROOT_QUERY",fieldName:"formMeta"}),o.a.evict({id:"ROOT_QUERY",fieldName:"submissionMeta"}),o.a.evict({id:"ROOT_QUERY",fieldName:"siteSettings"}),o.a.gc()}},1043:function(e,t,n){"use strict";n.d(t,"b",(function(){return l})),n.d(t,"a",(function(){return u}));var o=n(15),i=n(0),s=n(359),r=n(1);const a=Object(i.createContext)(!1);function c(e){const t=e.cssHandles,n=Object(i.useState)([]),s=Object(o.a)(n,2),a=s[0],c=s[1];return Object(i.useEffect)((()=>{const e=[];t&&"undefined"!=typeof window&&t.forEach((t=>{const n=document.querySelector(`#${t}-css`);if(n){const i=n.getAttribute("href");var o;if(i)e.push({id:t,href:i,media:null!==(o=n.getAttribute("media"))&&void 0!==o?o:"all"})}})),c(e)}),[t]),Object(r.jsx)(r.Fragment,{children:a.map((e=>Object(r.jsx)("link",{rel:"stylesheet",href:e.href,media:e.media},e.id)))})}function l(){return Object(i.useContext)(a)}function d(){const e="undefined"!=typeof WPEFormGraphQLApp?WPEFormGraphQLApp:{customCSS:void 0,customStyleLinks:void 0},t=e.customCSS,n=e.customStyleLinks;return Object(r.jsxs)(r.Fragment,{children:[t?Object(r.jsx)("style",{type:"text/css",dangerouslySetInnerHTML:{__html:t}}):null,n?n.map((e=>Object(r.jsx)("link",{rel:"stylesheet",href:e},e))):null]})}function u(e){const t=e.children,n=e.inShadow,s=e.cssHandles,l=Object(i.useState)(!1),u=Object(o.a)(l,2),m=u[0],h=u[1];return Object(i.useEffect)((()=>{h(!0)}),[]),Object(r.jsxs)(a.Provider,{value:n,children:[m?Object(r.jsxs)(r.Fragment,{children:[Object(r.jsx)(d,{}),n?Object(r.jsx)(c,{cssHandles:s}):null]}):null,t]})}u.LinkAllAssets=function(e){const t=e.body,n=void 0!==t&&t,a=e.head,c=void 0===a||a,l=Object(i.useState)([]),d=Object(o.a)(l,2),u=d[0],m=d[1];return Object(i.useEffect)((()=>{const e=[];let t;const o='link[rel="stylesheet"]';t=c&&n?document.querySelectorAll(o):c?document.head.querySelectorAll(o):document.body.querySelectorAll(o),t.length&&t.forEach((t=>{const n=t.getAttribute("href");var o,i;n&&e.push({id:null!==(o=t.getAttribute("id"))&&void 0!==o?o:Object(s.a)(),href:n,media:null!==(i=t.getAttribute("media"))&&void 0!==i?i:"all"})})),m(e)}),[n,c]),Object(r.jsx)(r.Fragment,{children:u.map((e=>Object(r.jsx)("link",{rel:"stylesheet",href:e.href,media:e.media},e.id)))})}},1044:function(e,t,n){"use strict";n.d(t,"a",(function(){return j}));var o=n(442),i=n(1071),s=(n(0),n(7)),r=n(3),a=n(365),c=n(2),l=n(1038),d=n(1);const u=s.f.header.withConfig({displayName:"PageHeader__PageHeaderWrap",componentId:"sc-1gousn5-0"})(["display:flex;flex-flow:row wrap;align-items:center;justify-content:flex-start;background-color:",";margin-bottom:",";box-shadow:",";border-radius:",";padding:",";padding-bottom:0;.eform-admin-page-header__styledlink{margin-right:",";text-transform:uppercase;}"],(e=>e.theme.appBackgroundColor),(e=>Object(c.n)(e.theme.gutter)),(e=>e.theme.boxShadowElevationOne),(e=>Object(c.n)(e.theme.borderRadiusBase)),(e=>Object(c.n)(e.theme.gutter)),(e=>Object(c.n)(e.theme.gutter/2))),m=s.f.div.withConfig({displayName:"PageHeader__PageHeaderTitleWrap",componentId:"sc-1gousn5-1"})(["display:flex;flex-flow:row nowrap;align-items:center;margin-right:",";margin-bottom:",";flex:0 0 auto;"],(e=>Object(c.n)(e.theme.gutter)),(e=>Object(c.n)(e.theme.gutter))),h=s.f.h2.withConfig({displayName:"PageHeader__PageHeaderTitle",componentId:"sc-1gousn5-2"})(["margin:0;padding:0;font-size:",";color:",";font-weight:bold;"],(e=>Object(c.n)(e.theme.fz.base)),(e=>e.theme.textColor)),f=s.f.h4.withConfig({displayName:"PageHeader__PageHeaderSubtitle",componentId:"sc-1gousn5-3"})(["margin:0;padding:0;margin-bottom:",";flex:1 1 auto;font-size:",";color:",";font-weight:normal;font-style:italic;"],(e=>Object(c.n)(e.theme.gutter)),(e=>Object(c.n)(e.theme.fz.small1)),(e=>e.theme.greyLightColor)),b=s.f.div.withConfig({displayName:"PageHeader__PageControlLeft",componentId:"sc-1gousn5-4"})(["margin:0;padding:0;margin-bottom:",";flex:1 1 auto;max-width:100%;"],(e=>Object(c.n)(e.theme.gutter))),p=s.f.div.withConfig({displayName:"PageHeader__PageControlRight",componentId:"sc-1gousn5-5"})(["margin:0 0 "," auto;padding:0;flex:0 0 auto;"],(e=>Object(c.n)(e.theme.gutter))),g={transparent:!0,shape:"circle",size:"small",className:"eform-admin-page-header__styledlink eform-admin-page-header__styledlink--back"};function j(e){const t=e.title,n=e.subTitle,s=e.backLink,c=e.newLink,j=e.backLabel,v=void 0===j?Object(r.__)("Back","wp-eform"):j,O=e.newLabel,y=void 0===O?Object(r.__)("Add New","wp-eform"):O,w=e.controlLeft,x=e.controlRight,C=Object(a.useLastLocation)();let k;return k=null===s?null:C?`${C.pathname}${C.search}`:s,Object(d.jsxs)(u,{className:"eform-admin-page-header",children:[Object(d.jsxs)(m,{children:[k?Object(d.jsx)(l.b,{...g,to:k,title:v,children:Object(d.jsx)(i.a,{})}):null,c?Object(d.jsxs)(l.b,{size:"small",className:"eform-admin-page-header__styledlink eform-admin-page-header__styledlink--new",to:c,type:"primary",children:[Object(d.jsx)(o.a,{})," ",y]}):null,Object(d.jsx)(h,{children:t})]}),n?Object(d.jsx)(f,{children:n}):null,w?Object(d.jsx)(b,{children:w}):null,x?Object(d.jsx)(p,{children:x}):null]})}},1045:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return s}));var o=n(1189);const i=o.a`
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
`,s=o.a`
	fragment FCheckboxSubmission on FormElementCheckboxSubmissionElementValueType {
		selected
		other
	}
`},1046:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return s}));var o=n(1189);const i=o.a`
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
`,s=o.a`
	fragment FDropdownSubmission on FormElementDropdownSubmissionElementValueType {
		selected
		other
	}
`},1047:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return s}));var o=n(1189);const i=o.a`
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
`,s=o.a`
	fragment FRadioSubmission on FormElementRadioSubmissionElementValueType {
		other
		selected
	}
`},1048:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return s}));var o=n(1189);const i=o.a`
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
`,s=o.a`
	fragment FTextSubmission on FormElementTextSubmissionElementValueType {
		input
	}
`},1049:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return s}));var o=n(1189);const i=o.a`
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
`,s=o.a`
	fragment FTextareaSubmission on FormElementTextareaSubmissionElementValueType {
		input
	}
`},1050:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return s}));var o=n(1189);const i=o.a`
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
`,s=o.a`
	fragment FToggleSubmission on FormElementToggleSubmissionElementValueType {
		selected
	}
`},1051:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return s}));var o=n(1189);const i=o.a`
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
`,s=o.a`
	fragment FSliderSubmission on FormElementSliderSubmissionElementValueType {
		selected
	}
`},1052:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return s}));var o=n(1189);const i=o.a`
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
`,s=o.a`
	fragment FRangeSubmission on FormElementRangeSubmissionElementValueType {
		maxSelected
		minSelected
	}
`},1053:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return s}));var o=n(1189);const i=o.a`
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
`,s=o.a`
	fragment FMathcalcSubmission on FormElementMathcalcSubmissionElementValueType {
		output
	}
`},1054:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return s}));var o=n(1189);const i=o.a`
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
`,s=o.a`
	fragment FRatingSubmission on FormElementRatingSubmissionElementValueType {
		feedback
		selected
	}
`},1055:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return s}));var o=n(1189);const i=o.a`
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
`,s=o.a`
	fragment FMatrixchoiceSubmission on FormElementMatrixchoiceSubmissionElementValueType {
		selected {
			columns
			rowId
		}
	}
`},1056:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return s}));var o=n(1189);const i=o.a`
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
`,s=o.a`
	fragment FSortableSubmission on FormElementSortableSubmissionElementValueType {
		order
	}
`},1057:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return s}));var o=n(1189);const i=o.a`
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
`,s=o.a`
	fragment FDatetimeinputSubmission on FormElementDatetimeinputSubmissionElementValueType {
		input
	}
`},1058:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return s}));var o=n(1189);const i=o.a`
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
`,s=o.a`
	fragment FMatrixinputSubmission on FormElementMatrixinputSubmissionElementValueType {
		input {
			columnId
			rowId
			value
		}
	}
`},1059:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return s}));var o=n(1189);const i=o.a`
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
`,s=o.a`
	fragment FSinglecheckboxSubmission on FormElementSinglecheckboxSubmissionElementValueType {
		selected
	}
`},1060:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return s}));var o=n(1189);const i=o.a`
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
`,s=o.a`
	fragment FAddressSubmission on FormElementAddressSubmissionElementValueType {
		city
		country
		fieldOne
		fieldTwo
		state
		zip
	}
`},1061:function(e,t,n){},1062:function(e,t){},1063:function(e,t,n){"use strict";n.d(t,"a",(function(){return y}));var o=n(1189);const i=o.a`
	fragment FCaptchaSubmission on FormElementCaptchaSubmissionElementValueType {
		encrypted
		solved
	}
`;var s=n(1045),r=n(1046),a=n(1047),c=n(1048),l=n(1049),d=n(1050),u=n(1051),m=n(1052),h=n(1053),f=n(1054),b=n(1055),p=n(1056),g=n(1057),j=n(1058),v=n(1059),O=n(1060);const y=o.a`
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
	${s.b}
	${r.b}
	${c.b}
	${l.b}
	${d.b}
	${u.b}
	${m.b}
	${h.b}
	${f.b}
	${b.b}
	${p.b}
	${g.b}
	${j.b}
	${v.b}
	${O.b}
`},1066:function(e,t,n){"use strict";n.d(t,"b",(function(){return i})),n.d(t,"a",(function(){return s}));var o=n(3);const i=new(n(148).a)("EForm Fonts");function s(e){if(!i.hasItem(e))return["inherit",null];const t=i.getItem(e);return[t.fontFamily,t.enqueue]}i.addItem("inherit",{name:Object(o.__)("Inherit from theme","wp-eform"),fontFamily:"inherit",enqueue:null}),i.addItem("system",{name:Object(o.__)("System UI","wp-eform"),fontFamily:'-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"',enqueue:null}),i.addItem("systemMono",{name:Object(o.__)("System UI Mono","wp-eform"),fontFamily:"'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, Courier, monospace",enqueue:null}),i.addItem("custom",{name:Object(o.__)("Custom Font","wp-eform"),fontFamily:"",enqueue:null}),i.addItem("alegreya",{name:"Alegreya",fontFamily:"'Alegreya', serif",enqueue:"https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("b612",{name:"B612",fontFamily:"'B612', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=B612:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("titilliumweb",{name:"Titillium Web",fontFamily:"'Titillium Web', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("vollkorn",{name:"Vollkorn",fontFamily:"'Vollkorn', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("ibmplexsans",{name:"IBM Plex Sans",fontFamily:"'IBM Plex Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"}),i.addItem("crimsontext",{name:"Crimson Text",fontFamily:"'Crimson Text', serif",enqueue:"https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap"}),i.addItem("karla",{name:"Karla",fontFamily:"'Karla', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("lora",{name:"Lora",fontFamily:"'Lora', serif",enqueue:"https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"}),i.addItem("playfairdisplay",{name:"Playfair Display",fontFamily:"'Playfair Display', serif",enqueue:"https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("archivo",{name:"Archivo",fontFamily:"'Archivo', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"}),i.addItem("spectral",{name:"Spectral",fontFamily:"'Spectral', serif",enqueue:"https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"}),i.addItem("roboto",{name:"Roboto",fontFamily:"'Roboto', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"}),i.addItem("montserrat",{name:"Montserrat",fontFamily:"'Montserrat', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("rubik",{name:"Rubik",fontFamily:"'Rubik', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("sourcesanspro",{name:"Source Sans Pro",fontFamily:"'Source Sans Pro', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap"}),i.addItem("cormorant",{name:"Cormorant",fontFamily:"'Cormorant', serif",enqueue:"https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"}),i.addItem("worksans",{name:"Work Sans",fontFamily:"'Work Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("arvo",{name:"Arvo",fontFamily:"'Arvo', serif",enqueue:"https://fonts.googleapis.com/css2?family=Arvo:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("lato",{name:"Lato",fontFamily:"'Lato', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"}),i.addItem("ubuntu",{name:"Ubuntu",fontFamily:"'Ubuntu', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"}),i.addItem("ptserif",{name:"PT Serif",fontFamily:"'PT Serif', serif",enqueue:"https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("ptsans",{name:"PT Sans",fontFamily:"'PT Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("poppins",{name:"Poppins",fontFamily:"'Poppins', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("firasans",{name:"Fira Sans",fontFamily:"'Fira Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("nunito",{name:"Nunito",fontFamily:"'Nunito', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("exo2",{name:"Exo 2",fontFamily:"'Exo 2', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("opensans",{name:"Open Sans",fontFamily:"'Open Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap"}),i.addItem("merriweather",{name:"Merriweather",fontFamily:"'Merriweather', serif",enqueue:"https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"}),i.addItem("notosans",{name:"Noto Sans",fontFamily:"'Noto Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("spacemono",{name:"Space Mono",fontFamily:"'Space Mono', monospace",enqueue:"https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),i.addItem("librefranklin",{name:"Libre Franklin",fontFamily:"'Libre Franklin', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("alegreyasans",{name:"Alegreya Sans",fontFamily:"'Alegreya Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&display=swap"}),i.addItem("chivo",{name:"Chivo",fontFamily:"'Chivo', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Chivo:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"}),i.addItem("sourceserifpro",{name:"Source Serif Pro",fontFamily:"'Source Serif Pro', serif",enqueue:"https://fonts.googleapis.com/css2?family=Source+Serif+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap"}),i.addItem("archivonarrow",{name:"Archivo Narrow",fontFamily:"'Archivo Narrow', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Archivo+Narrow:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"}),i.addItem("prozalibre",{name:"Proza Libre",fontFamily:"'Proza Libre', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Proza+Libre:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap"}),i.addItem("cabin",{name:"cabin",fontFamily:"'Cabin', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"}),i.addItem("raleway",{name:"Raleway",fontFamily:"'Raleway', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),i.addItem("anonymouspro",{name:"Anonymous Pro",fontFamily:"'Anonymous Pro', monospace",enqueue:"https://fonts.googleapis.com/css2?family=Anonymous+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap"})},1069:function(e,t,n){"use strict";n.d(t,"a",(function(){return u}));n(0);var o=n(3),i=n(7),s=n(8),r=n(147),a=n(2),c=n(364),l=n(1039),d=n(1);i.f.div.withConfig({displayName:"GenericApolloError__ButtonContainer",componentId:"sc-10t13a5-0"})(["margin:"," ",";"],(e=>Object(a.n)(e.theme.gutter)),(e=>Object(a.n)(e.theme.gutter/-2)));function u(e){const t=e.children,n=e.themeStyle,i=e.error,a=e.retry,u=e.title,m=e.hideReload,h=void 0!==m&&m,f=e.retryLabel,b=e.widthOverride,p=e.ssr,g=void 0!==p&&p,j=e.type,v=void 0===j?"500":j;return Object(d.jsx)(l.a,{themeStyle:n,widthOverride:b,ssr:g,children:Object(d.jsx)(c.a,{type:v,title:u,description:Object(d.jsxs)(d.Fragment,{children:[t,i?Object(d.jsxs)(d.Fragment,{children:[Object(d.jsx)("p",{children:Object(o.__)("More information on the error can be found below.","wp-eform")}),Object(d.jsx)("p",{children:i.message})]}):null]}),footer:!h||a?Object(d.jsxs)(d.Fragment,{children:[h?null:Object(d.jsx)(r.b,{style:"3d",size:s.o.SMALL,onClick:()=>{window.location.reload()},children:Object(o.__)("RELOAD PAGE","wp-eform")}),a?Object(d.jsx)(r.b,{style:"3d",size:s.o.SMALL,onClick:a,colorful:!1,children:null!=f?f:Object(o.__)("RETRY WITHOUT RELOAD","wp-eform")}):null]}):null})})}},1070:function(e,t,n){"use strict";n.d(t,"a",(function(){return f}));n(0);var o=n(7),i=n(438),s=n(2),r=n(1078),a=n(1);const c=o.f.div.withConfig({displayName:"SubmissionSkeleton__SkeletonContainer",componentId:"sc-1eq1qk1-0"})([""," margin:0 auto;"],s.b);function l(){const e=Object(o.h)();return Object(a.jsxs)(a.Fragment,{children:[Object(a.jsx)(i.b,{shape:"rectangle",height:32+e.gutter/2,width:"100%",marginBottom:"small"}),Object(a.jsx)(i.b,{shape:"rectangle",height:2,width:"100%",marginBottom:"large"})]})}function d(){return Object(a.jsxs)(a.Fragment,{children:[Object(a.jsx)(l,{}),Object(a.jsx)(i.b,{shape:"rectangle",height:167,width:"100%",marginBottom:"large"})]})}const u=[52,36,49,65,42,63,86,38,75,57,43,51,85,72,44,55,45,59,75,76];function m(e){const t=Object(o.h)(),n=e.widthSet,s=u[n%u.length-1];return Object(a.jsxs)(a.Fragment,{children:[Object(a.jsx)(i.b,{shape:"rectangle",width:`${s}%`,height:1.5*t.fz.base,marginBottom:"small"}),Object(a.jsx)(i.b,{shape:"rectangle",width:"100%",height:92,marginBottom:"large"}),Object(a.jsx)(i.b,{shape:"rectangle",width:"100%",height:2,marginBottom:"large"})]})}function h(e){const t=Object(o.h)(),n=[];for(let t=0;t<e.controls;t++)n.push(Object(a.jsx)(m,{widthSet:t+1},t));return Object(a.jsxs)(a.Fragment,{children:[Object(a.jsx)(i.b,{shape:"rectangle",height:1.5*t.fz.small1+t.gutter/6,width:"100%",marginBottom:t.gutter/6}),Object(a.jsx)(i.b,{shape:"rectangle",height:1,width:"100%",marginBottom:"large"}),n]})}function f(e){const t=e.panels,n=void 0===t?2:t,o=e.controls,i=void 0===o?5:o,s=[];for(let e=0;e<n;e++)s.push(Object(a.jsx)(h,{controls:0===e?i:3},e));return Object(a.jsx)(c,{className:"wpeform-component-submissionskeleton",children:Object(a.jsxs)(r.a,{children:[Object(a.jsx)(d,{}),s]})})}f.PreviewToolbar=l},1072:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));const o=n(1189).a`
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
`},1077:function(e,t,n){"use strict";n(8)},1078:function(e,t,n){"use strict";n.d(t,"a",(function(){return a}));n(0);var o=n(7),i=n(2),s=n(1);const r=o.f.div.withConfig({displayName:"Wrapper__Container",componentId:"sc-cwluc8-0"})(["",";font-family:",";padding:",";background-color:",";border-radius:",";border:1px solid ",";"],i.b,(e=>e.theme.fontFamilyBody),(e=>Object(i.n)(e.theme.gutter)),(e=>e.theme.appBackgroundColor),(e=>Object(i.n)(e.theme.borderRadiusBase)),(e=>e.theme.borderColorLight));function a(e){return Object(s.jsx)(r,{children:e.children})}},1079:function(e,t,n){"use strict";n.d(t,"a",(function(){return w}));var o=n(1189);const i=o.a`
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
`;var s=n(1045),r=n(1046);const a=o.a`
	fragment FHeadingConfig on FormElementHeadingConfigType {
		interface {
			divider
			icon
			showTop
			size
			tag
		}
	}
`;var c=n(1047),l=n(1048),d=n(1049),u=n(1050),m=n(1051),h=n(1052),f=n(1053),b=n(1054),p=n(1055),g=n(1056),j=n(1057),v=n(1058),O=n(1059),y=n(1060);const w=o.a`
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
	${s.a}
	${r.a}
	${a}
	${c.a}
	${l.a}
	${d.a}
	${u.a}
	${m.a}
	${h.a}
	${f.a}
	${b.a}
	${p.a}
	${g.a}
	${j.a}
	${v.a}
	${O.a}
	${y.a}
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
`},1085:function(e,t,n){"use strict";n.d(t,"useGesture",(function(){return c}));var o=n(1040),i=n(0),s=n.n(i),r=n(1086);n(1061),n(1062);function a(e,t={},n,o){const i=s.a.useMemo((()=>new r.a(e)),[]);if(i.applyHandlers(e,o),i.applyConfig(t,n),s.a.useEffect(i.effect.bind(i)),s.a.useEffect((()=>i.clean.bind(i)),[]),void 0===t.target)return i.bind.bind(i)}function c(e,t){return([o.a,o.d,o.f,o.g,o.c,o.b].forEach(o.e),function(e,t){const n=Object(r.b)(e,t||{}),o=n.handlers,i=n.nativeHandlers;return a(o,n.config,void 0,i)})(e,t||{})}},1086:function(e,t,n){"use strict";n.d(t,"a",(function(){return u})),n.d(t,"b",(function(){return p}));var o=n(6),i=n(1034);function s(e,t){if(null==e)return{};var n,o,i=function(e,t){if(null==e)return{};var n,o,i={},s=Object.keys(e);for(o=0;o<s.length;o++)n=s[o],t.indexOf(n)>=0||(i[n]=e[n]);return i}(e,t);if(Object.getOwnPropertySymbols){var s=Object.getOwnPropertySymbols(e);for(o=0;o<s.length;o++)n=s[o],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(i[n]=e[n])}return i}const r={target(e){if(e)return()=>"current"in e?e.current:e},enabled:(e=!0)=>e,window:(e=(i.c.isBrowser?window:void 0))=>e,eventOptions:({passive:e=!0,capture:t=!1}={})=>({passive:e,capture:t}),transform:e=>e},a=["target","eventOptions","window","enabled","transform"];function c(e={},t){const n={};for(const s of Object.entries(t)){var i=Object(o.a)(s,2);const t=i[0],r=i[1];switch(typeof r){case"function":n[t]=r.call(n,e[t],t,e);break;case"object":n[t]=c(e[t],r);break;case"boolean":r&&(n[t]=e[t])}}return n}class l{constructor(e,t){Object(i.e)(this,"_listeners",new Set),this._ctrl=e,this._gestureKey=t}add(e,t,n,o,s){const r=this._listeners,a=Object(i.q)(t,n),c=this._gestureKey?this._ctrl.config[this._gestureKey].eventOptions:{},l=Object(i.d)(Object(i.d)({},c),s);e.addEventListener(a,o,l);const d=()=>{e.removeEventListener(a,o,l),r.delete(d)};return r.add(d),d}clean(){this._listeners.forEach((e=>e())),this._listeners.clear()}}class d{constructor(){Object(i.e)(this,"_timeouts",new Map)}add(e,t,n=140,...o){this.remove(e),this._timeouts.set(e,window.setTimeout(t,n,...o))}remove(e){const t=this._timeouts.get(e);t&&window.clearTimeout(t)}clean(){this._timeouts.forEach((e=>{window.clearTimeout(e)})),this._timeouts.clear()}}class u{constructor(e){Object(i.e)(this,"gestures",new Set),Object(i.e)(this,"_targetEventStore",new l(this)),Object(i.e)(this,"gestureEventStores",{}),Object(i.e)(this,"gestureTimeoutStores",{}),Object(i.e)(this,"handlers",{}),Object(i.e)(this,"config",{}),Object(i.e)(this,"pointerIds",new Set),Object(i.e)(this,"touchIds",new Set),Object(i.e)(this,"state",{shared:{shiftKey:!1,metaKey:!1,ctrlKey:!1,altKey:!1}}),function(e,t){t.drag&&m(e,"drag");t.wheel&&m(e,"wheel");t.scroll&&m(e,"scroll");t.move&&m(e,"move");t.pinch&&m(e,"pinch");t.hover&&m(e,"hover")}(this,e)}setEventIds(e){return Object(i.l)(e)?(this.touchIds=new Set(Object(i.f)(e)),this.touchIds):"pointerId"in e?("pointerup"===e.type||"pointercancel"===e.type?this.pointerIds.delete(e.pointerId):"pointerdown"===e.type&&this.pointerIds.add(e.pointerId),this.pointerIds):void 0}applyHandlers(e,t){this.handlers=e,this.nativeHandlers=t}applyConfig(e,t){this.config=function(e,t,n={}){const o=e,l=o.target,d=o.eventOptions,u=o.window,m=o.enabled,h=o.transform,f=s(o,a);if(n.shared=c({target:l,eventOptions:d,window:u,enabled:m,transform:h},r),t){const e=i.a.get(t);n[t]=c(Object(i.d)({shared:n.shared},f),e)}else for(const e in f){const t=i.a.get(e);t&&(n[e]=c(Object(i.d)({shared:n.shared},f[e]),t))}return n}(e,t,this.config)}clean(){this._targetEventStore.clean();for(const e of this.gestures)this.gestureEventStores[e].clean(),this.gestureTimeoutStores[e].clean()}effect(){return this.config.shared.target&&this.bind(),()=>this._targetEventStore.clean()}bind(...e){const t=this.config.shared,n={};let o;if(!t.target||(o=t.target(),o)){if(t.enabled){for(const t of this.gestures){const s=this.config[t],r=h(n,s.eventOptions,!!o);if(s.enabled){new(i.b.get(t))(this,e,t).bind(r)}}const s=h(n,t.eventOptions,!!o);for(const t in this.nativeHandlers)s(t,"",(n=>this.nativeHandlers[t](Object(i.d)(Object(i.d)({},this.state.shared),{},{event:n,args:e}))),void 0,!0)}for(const e in n)n[e]=Object(i.g)(...n[e]);if(!o)return n;for(const e in n){const t=Object(i.n)(e),s=t.device,r=t.capture,a=t.passive;this._targetEventStore.add(o,s,"",n[e],{capture:r,passive:a})}}}}function m(e,t){e.gestures.add(t),e.gestureEventStores[t]=new l(e,t),e.gestureTimeoutStores[t]=new d}const h=(e,t,n)=>(o,s,r,a={},c=!1)=>{var l,d;const u=null!==(l=a.capture)&&void 0!==l?l:t.capture,m=null!==(d=a.passive)&&void 0!==d?d:t.passive;let h=c?o:Object(i.h)(o,s,u);n&&m&&(h+="Passive"),e[h]=e[h]||[],e[h].push(r)},f=/^on(Drag|Wheel|Scroll|Move|Pinch|Hover)/;function b(e,t,n,o,s,r){if(!e.has(n))return;if(!i.b.has(o))return void 0;const a=n+"Start",c=n+"End";s[o]=e=>{let o;return e.first&&a in t&&t[a](e),n in t&&(o=t[n](e)),e.last&&c in t&&t[c](e),o},r[o]=r[o]||{}}function p(e,t){const n=function(e){const t={},n={},o=new Set;for(let i in e)f.test(i)?(o.add(RegExp.lastMatch),n[i]=e[i]):t[i]=e[i];return[n,t,o]}(e),i=Object(o.a)(n,3),s=i[0],r=i[1],a=i[2],c={};return b(a,s,"onDrag","drag",c,t),b(a,s,"onWheel","wheel",c,t),b(a,s,"onScroll","scroll",c,t),b(a,s,"onPinch","pinch",c,t),b(a,s,"onMove","move",c,t),b(a,s,"onHover","hover",c,t),{handlers:c,config:t,nativeHandlers:r}}},1087:function(e,t,n){"use strict";n.d(t,"a",(function(){return vt}));var o=n(42),i=n(0),s=n(15),r=n(3),a=n(10),c=n.n(a),l=n(53),d=n(162),u=n.n(d),m=n(7),h=n(283),f=n(1085),b=n(2),p=n(18),g=n(287),j=n(29),v=n(1);const O="wpeform-component-progressbar",y=Object(b.d)(O,"bar"),w=Object(m.g)(["0%{width:0;opacity:0.1;}20%{width:0;opacity:0.5;}100%{width:100%;opacity:0;}"]),x=Object(m.f)(l.animated.div).withConfig({displayName:"Progressbar__AnimatedTabsProgress",componentId:"sc-70ygvj-0"})(["will-change:width;background-color:",";height:",";position:relative;&.","--is-active{&::before{position:absolute;top:0;right:0;bottom:0;left:0;background:",";opacity:0;animation:"," 2.4s cubic-bezier(0.23,1,0.32,1) infinite;content:'';}}"],(e=>e.theme.primaryColor),(e=>Object(b.n)(.25*e.theme.controlHeightBase)),y,(e=>e.theme.primaryBgText),w),C=Object(m.f)(l.animated.span).withConfig({displayName:"Progressbar__ProgressLabel",componentId:"sc-70ygvj-1"})(["margin:0;padding:0;color:",";font-size:",";line-height:1;font-weight:bold;position:absolute;right:0.2em;"],(e=>e.theme.textColorSecondary),(e=>Object(b.n)(e.theme.fz.small2))),k=m.f.div.withConfig({displayName:"Progressbar__ProgressContainer",componentId:"sc-70ygvj-2"})(["height:",";background-color:",";overflow:hidden;width:100%;"],(e=>Object(b.n)(.25*e.theme.controlHeightBase)),(e=>Object(j.d)(.05,e.theme.disabledColor))),S=m.f.div.withConfig({displayName:"Progressbar__ProgressbarWrapper",componentId:"sc-70ygvj-3"})(["",";position:relative;&.","--is-bottom-rounded{","{border-bottom-left-radius:",";border-bottom-right-radius:",";}}&.","--is-top-rounded{","{border-top-left-radius:",";border-top-right-radius:",";}}&.","--is-bottom-rounded.","--is-top-rounded{",",",",","::before{border-radius:",";}}&.","--label-position-top{","{top:-1.2em;}}&.","--label-position-bottom{","{bottom:-1.2em;}}"],b.b,O,k,(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>Object(b.n)(e.theme.borderRadiusBase)),O,k,(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>Object(b.n)(e.theme.borderRadiusBase)),O,O,k,x,x,(e=>Object(b.n)(.25*e.theme.controlHeightBase)),O,C,O,C);function _(e){const t=e.width,n=e.active,o=void 0!==n&&n,i=e.isBottomRounded,s=void 0!==i&&i,r=e.isTopRounded,a=void 0!==r&&r,c=e.showLabel,d=void 0===c||c,u=e.precision,h=void 0===u?2:u,f=e.labelPosition,p=void 0===f?"top":f,g=Object(m.h)(),j=Object(l.useSpring)({from:{width:"0%"},to:{width:`${t}%`},config:{...g.springConfigSlow,clamp:!0}}),w=Object(l.useSpring)({number:t,from:{number:0},config:{...g.springConfigSlow,clamp:!0}});return Object(v.jsxs)(S,{className:Object(b.c)(O,{"is-bottom-rounded":s,"is-top-rounded":a,"is-active":o,[`label-position-${p}`]:!0}),children:[Object(v.jsx)(k,{children:Object(v.jsx)(x,{style:j,className:Object(b.c)(y,{"is-active":!!o}),"aria-valuenow":t,"aria-valuemin":0,"aria-valuemax":100})}),d?Object(v.jsx)(C,{children:w.number.to((e=>`${e.toFixed(h)}%`))}):null]})}var F=n(8),E=n(36),T=n(361),I=n(66);const M="wpeform-component-tabs",P=Object(b.d)(M,"nav-button"),L=Object(b.d)(M,"button"),B=Object(b.d)(M,"button-icon"),A=Object(b.d)(M,"button-label"),N=Object(b.d)(M,"button-label-title"),D=Object(b.d)(M,"button-label-subtitle"),R=m.f.div.withConfig({displayName:"styled__TabsContainer",componentId:"sc-1t0opj6-0"})(["",";box-shadow:",";border-radius:",";overflow-anchor:none;background-color:",";"],b.b,(e=>e.theme.boxShadow4dp),(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>e.theme.appBackgroundColor)),H=m.f.nav.withConfig({displayName:"styled__TabsNavigation",componentId:"sc-1t0opj6-1"})(["background-color:",";border-top-left-radius:",";border-top-right-radius:",";overflow:hidden;display:flex;flex-flow:row nowrap;align-items:stretch;width:100%;position:relative;z-index:2;.","{padding:0;justify-content:center;position:absolute;left:0;top:0;flex:0 0 ",";width:",";height:100%;z-index:1;background-color:transparent;background-image:linear-gradient( to right,",","," 50%,"," 100% );&::before{position:absolute;pointer-events:none;content:'';display:block;top:0;left:0;width:100%;height:100%;background-color:",";opacity:0;transition:",";}&:disabled{opacity:0;pointer-events:none;}.","{position:relative;}.","{font-size:",";}&.right{background-image:linear-gradient( to left,",","," 50%,"," 100% );left:auto;right:0;}&:hover,&:focus{background-color:transparent;&::before{opacity:1;}}&:active{.","{transform:scale(0.8);}}}"],(e=>e.theme.primaryLightColor),(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>Object(b.n)(e.theme.borderRadiusBase)),P,(e=>Object(b.n)(.75*e.theme.gutter)),(e=>Object(b.n)(.75*e.theme.gutter)),(e=>e.theme.primaryLightColor),(e=>e.theme.primaryLightColor),(e=>Object(j.e)(1,e.theme.primaryLightColor)),(e=>e.theme.primaryColor),(e=>Object(b.f)(["opacity"],e.theme.transitionControl)),A,N,(e=>Object(b.n)(e.theme.fz.small2)),(e=>e.theme.primaryLightColor),(e=>e.theme.primaryLightColor),(e=>Object(j.e)(1,e.theme.primaryLightColor)),A),z=Object(m.f)(l.animated.div).withConfig({displayName:"styled__TabsScroller",componentId:"sc-1t0opj6-2"})(["flex:1 0 auto;width:100%;will-change:transform;touch-action:pan-y;"]),$=(Object(m.f)(l.animated.div).withConfig({displayName:"styled__AnimatedTabPanel",componentId:"sc-1t0opj6-3"})(["will-change:opacity,position,transform;"]),m.f.div.withConfig({displayName:"styled__TabsNavButtonsContainer",componentId:"sc-1t0opj6-4"})(["display:flex;flex-flow:row nowrap;touch-action:pan-y;"])),q=m.f.button.withConfig({displayName:"styled__TabButton",componentId:"sc-1t0opj6-5"})(["font-family:",";position:relative;overflow:hidden;flex:0 0 auto;display:flex;align-items:center;justify-content:flex-start;padding:"," ",";min-height:",";border:0 none;margin:0;outline:none;border-radius:0;background-color:",";cursor:pointer;color:",";text-align:left;transition:",";&.","--active{background-color:",";color:",";}&:hover{background-color:",";}&:focus{background-color:",";color:",";}&:active{.","{transform:scale(0.97);transform-origin:center center;}}.","{font-size:",";margin:0 "," 0 0;flex:0 0 auto;}.","{flex:0 0 auto;display:flex;flex-flow:column nowrap;}.","{font-size:",";font-weight:",";line-height:1;white-space:nowrap;}.","{font-size:",";font-style:",";line-height:1;white-space:nowrap;margin:0;}"],(e=>e.theme.fontFamilyHeading),(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(1.25*e.theme.controlHeightBase)),(e=>e.theme.primaryLightColor),(e=>Object(j.e)(.3,e.theme.primaryBgText)),(e=>Object(b.f)(["background-color","color"],e.theme.transitionControl)),L,(e=>e.theme.primaryColor),(e=>e.theme.primaryBgText),(e=>e.theme.primaryColor),(e=>e.theme.primaryColor),(e=>e.theme.primaryBgText),A,B,(e=>Object(b.n)(e.theme.fz.large3)),(e=>Object(b.n)(e.theme.gutter/2)),A,N,(e=>Object(b.n)(e.theme.fz.large1)),(e=>e.theme.boldHeading?"500":"normal"),D,(e=>Object(b.n)(e.theme.fz.small2)),(e=>e.theme.italicHeading?"italic":"normal")),V=m.f.div.withConfig({displayName:"styled__TabPanel",componentId:"sc-1t0opj6-6"})(["position:relative;overflow:hidden;&:focus{outline:none;}"]),W=m.f.footer.withConfig({displayName:"styled__TabFooter",componentId:"sc-1t0opj6-7"})(["overflow:hidden;border-bottom-left-radius:",";border-bottom-right-radius:",";"],(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>Object(b.n)(e.theme.borderRadiusBase))),U=m.f.aside.withConfig({displayName:"styled__StopwatchContainer",componentId:"sc-1t0opj6-8"})(["padding:0 "," ",";"],(e=>Object(b.n)(1.5*e.theme.gutter)),(e=>Object(b.n)(.5*e.theme.gutter))),K=m.f.span.withConfig({displayName:"styled__StopwatchClock",componentId:"sc-1t0opj6-9"})(["display:block;font-size:",";color:",";font-weight:bold;line-height:1;"],(e=>Object(b.n)(e.theme.fz.large3)),(e=>e.theme.textColorSecondary)),Y=m.f.span.withConfig({displayName:"styled__StopwatchStamp",componentId:"sc-1t0opj6-10"})(["display:block;font-size:",";line-height:1;color:",";"],(e=>Object(b.n)(e.theme.fz.small2)),(e=>e.theme.textColorSecondary));function G(e){const t=e.title,n=e.subtitle,o=e.icon,i=e.onClick,r=e.active,a=e.className,c=e.id,l=e.disabled,d=Object(g.a)({darkBg:!0}),u=Object(s.a)(d,2),m=u[0],h=u[1];return Object(v.jsxs)(q,{id:c,disabled:l,className:Object(b.c)(L,{active:!!r},a),onClick:e=>{e.preventDefault(),m(e),i()},type:"button",children:[h,o?Object(v.jsx)("span",{className:B,children:Object(v.jsx)(p.b,{iconClass:o})}):null,Object(v.jsxs)("span",{className:A,children:[Object(v.jsx)("span",{className:N,children:t}),n?Object(v.jsx)("span",{className:D,children:n}):null]})]})}function Q(e){var t;const n=e.currentTab,o=e.tabs,r=e.onTabChange,a=Object(m.h)(),d=Object(i.useRef)(null),h=u()(d),b=Object(i.useState)({leftDisabled:!0,rightDisabled:!1,left:0}),g=Object(s.a)(b,2),j=g[0],O=g[1],y=Object(l.useSpring)((()=>({from:{transform:"translateX(0px)"},to:{transform:`translateX(${-1*j.left}px)`},config:{...a.springConfigStiff,clamp:!0}}))),w=Object(s.a)(y,2),x=w[0],C=w[1];Object(i.useEffect)((()=>{C.start({transform:`translateX(${-1*j.left}px)`})}),[j.left,C]);const k=(e,t)=>{if(!d.current)return;let n=0;d.current.querySelectorAll("button").forEach((e=>{n+=e.offsetWidth}));const o=d.current.offsetWidth;let i=j.left-e;if(n<o?i=0:(i<0&&(i=0),i>n-o&&(i=n-o)),t){let e=!1,t=!1;0===i&&(e=!0),i+o>=n&&(t=!0),O({left:i,leftDisabled:e,rightDisabled:t})}else C.start({transform:`translateX(${-1*i}px)`})},S=Object(i.useCallback)(((e,t,n)=>{O({left:e,leftDisabled:t,rightDisabled:n})}),[]);Object(f.useGesture)({onDrag(e){const t=e.movement,n=e.down;k(t[0],!n)},onWheel(e){const t=e.event,n=e.movement;Math.abs(t.deltaX)<=Math.abs(t.deltaY)||(t.preventDefault(),t.stopPropagation(),k(n[0],!0))}},{target:null!==(t=d.current)&&void 0!==t?t:void 0,eventOptions:{passive:!1},drag:{filterTaps:!0}});const _=Object(i.useCallback)((e=>{if(!d.current)return;let t=0,n=0,o=!1,i=0;d.current.querySelectorAll("button").forEach((s=>{i+=s.offsetWidth,o||(s.getAttribute("id")===`tab-item-${e}`?(o=!0,n=s.offsetWidth):t+=s.offsetWidth)}));const s=d.current.offsetWidth;if(i<=s)return void S(0,!0,!0);if(t+n<=s)return void S(0,!0,!1);let r=t+n-s+90;n+90>s&&(r=t-.75*a.gutter),r<0&&(r=0),r>i-s&&(r=i-s),S(r,!1,r+s>=i)}),[a.gutter,S]);return Object(i.useLayoutEffect)((()=>{_(n)}),[n,_,h.width]),Object(v.jsxs)(H,{children:[Object(v.jsx)(G,{className:P,title:Object(v.jsx)(p.b,{iconClass:"fas fa-angle-left"}),onClick:()=>{k(150,!0)},disabled:j.leftDisabled}),Object(v.jsx)(z,{style:x,children:Object(v.jsx)($,{ref:d,children:o.map((e=>Object(v.jsx)(G,{onClick:()=>{r(e.id)},active:n===e.id,id:`tab-item-${e.id}`,icon:e.icon,subtitle:e.subtitle,title:e.title},e.id)))})}),Object(v.jsx)(G,{className:c()(P,"right"),title:Object(v.jsx)(p.b,{iconClass:"fas fa-angle-right"}),onClick:()=>{k(-150,!0)},disabled:j.rightDisabled})]})}function X(e){const t=e.stopwatchStartTime,n=Object(i.useState)(0),o=Object(s.a)(n,2),a=o[0],c=o[1];Object(i.useEffect)((()=>{const e=()=>{const e=Math.abs(Date.now()-t);c(e)},n=setInterval(e,1e3);return e(),()=>{clearInterval(n)}}),[t]);const l=Object(E.c)(a),d=l.hours,u=l.minutes,m=l.seconds;return Object(v.jsxs)(U,{children:[Object(v.jsx)(K,{children:Object(r.sprintf)(Object(r._x)("%s:%s:%s","timer","wp-eform"),d,u,m)}),Object(v.jsx)(Y,{children:Object(r.sprintf)(Object(r.__)("time elapsed since %s","wp-eform"),Object(T.e)(t).format("LTS"))})]})}function Z(e){const t=e.currentTab,n=e.onTabChange,o=e.tabs,s=e.children,r=e.className,a=e.scrollOnTabChange,c=void 0===a||a,l=e.tabScrollOffset,d=void 0===l?-100:l,u=e.footer,m=e.showProgressBar,f=void 0===m||m,p=e.showProgressLabel,g=void 0===p||p,j=e.showTabs,O=void 0===j||j,y=e.progressBarPosition,w=void 0===y?F.E.TOP:y,x=e.progressBarPrecision,C=void 0===x?2:x,k=e.forceProgress,S=e.stopwatchStartTime,E=Object(i.useRef)(null),T=Object(i.useRef)(null),P=Object(i.useRef)(!0);let L=o.findIndex((e=>e.id===t));-1===L&&(L=0);const B=k||L/(o.length||1)*100;return Object(i.useLayoutEffect)((()=>{P.current?P.current=!1:(T.current&&T.current.focus({preventScroll:!0}),c&&E.current&&Object(h.a)(E.current,{verticalOffset:d,cancelOnUserAction:!0,elementToScroll:Object(I.f)(E.current)[0]}))}),[t,c,d]),Object(v.jsxs)(R,{ref:E,className:Object(b.c)(M,{"has-footer":!!u},r),children:[O?Object(v.jsx)(Q,{currentTab:t,onTabChange:n,tabs:o}):null,f&&w===F.E.TOP?Object(v.jsx)(_,{width:B,labelPosition:"bottom",isTopRounded:!O,precision:C,showLabel:g}):null,Object(v.jsx)(V,{tabIndex:0,ref:T,children:s}),S?Object(v.jsx)(X,{stopwatchStartTime:S}):null,f&&w===F.E.BOTTOM?Object(v.jsx)(_,{width:B,isBottomRounded:!u,labelPosition:"top",precision:C,showLabel:g}):null,u?Object(v.jsx)(W,{children:u}):null]})}var J=n(448),ee=n(147);const te="wpeform-component-animatedsvg",ne=Object(b.d)(te,"svg"),oe=Object(m.f)(l.animated.path).withConfig({displayName:"AnimatedSvg__AnimatedPathFill",componentId:"sc-1crsfqd-0"})(["will-change:opacity,transform;"]),ie=Object(m.f)(l.animated.path).withConfig({displayName:"AnimatedSvg__AnimatedPathStroke",componentId:"sc-1crsfqd-1"})(["stroke-dasharray:65 66;will-change:stroke-dashoffset;"]),se=m.f.div.withConfig({displayName:"AnimatedSvg__Container",componentId:"sc-1crsfqd-2"})(["",";display:inline-flex;align-items:center;justify-content:center;.","{height:1em;width:1em;display:block;}"],b.b,ne);function re(e,t=2){const n=Object(l.useTrail)(t,(n=>({from:{strokeDashoffset:66},strokeDashoffset:0,config:n===t-1?e.springConfigSlow:{...e.springConfigGeneral,clamp:!0}})));return[Object(s.a)(n,1)[0],Object(l.useSpring)({from:{opacity:0,transform:"translate(0px, 0px)"},opacity:1,transform:"translate(2px, 2px)",config:e.springConfigSlow,delay:500})]}function ae(e){const t=e.colorfulBg,n=Object(m.h)(),o=re(n,2),i=Object(s.a)(o,2),r=i[0],a=i[1];return Object(v.jsx)(v.Fragment,{children:Object(v.jsxs)("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",className:ne,children:[Object(v.jsx)(oe,{style:a,stroke:t?n.successBackgroundColor:n.successColor,fill:t?n.successColor:n.successBackgroundColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"0",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(v.jsx)(ie,{strokeDashoffset:r[1].strokeDashoffset,stroke:t?n.successBackgroundColor:n.successColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(v.jsx)(ie,{strokeDashoffset:r[0].strokeDashoffset,stroke:t?n.successBackgroundColor:n.successColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M8.25 9.5L10.75 12L15.75 7"})]})})}function ce(e){const t=e.colorfulBg,n=Object(m.h)(),o=re(n,3),i=Object(s.a)(o,2),r=i[0],a=i[1];return Object(v.jsx)(v.Fragment,{children:Object(v.jsxs)("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",className:ne,children:[Object(v.jsx)(oe,{style:a,stroke:t?n.warningBackgroundColor:n.warningColor,fill:t?n.warningColor:n.warningBackgroundColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"0",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(v.jsx)(ie,{strokeDashoffset:r[2].strokeDashoffset,stroke:t?n.warningBackgroundColor:n.warningColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(v.jsx)(ie,{strokeDashoffset:r[0].strokeDashoffset,stroke:t?n.warningBackgroundColor:n.warningColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M11.99 13H12.01"}),Object(v.jsx)(ie,{strokeDashoffset:r[1].strokeDashoffset,stroke:t?n.warningBackgroundColor:n.warningColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M12 6V10"})]})})}function le(e){const t=e.colorfulBg,n=Object(m.h)(),o=re(n,3),i=Object(s.a)(o,2),r=i[0],a=i[1];return Object(v.jsx)(v.Fragment,{children:Object(v.jsxs)("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",className:ne,children:[Object(v.jsx)(oe,{style:a,stroke:t?n.errorBackgroundColor:n.errorColor,fill:t?n.errorColor:n.errorBackgroundColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"0",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(v.jsx)(ie,{strokeDashoffset:r[2].strokeDashoffset,stroke:t?n.errorBackgroundColor:n.errorColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(v.jsx)(ie,{strokeDashoffset:r[0].strokeDashoffset,stroke:t?n.errorBackgroundColor:n.errorColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M14.5 7L9.5 12"}),Object(v.jsx)(ie,{strokeDashoffset:r[1].strokeDashoffset,stroke:t?n.errorBackgroundColor:n.errorColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M9.5 7L14.5 12"})]})})}function de(e){const t=e.colorfulBg,n=Object(m.h)(),o=re(n,3),i=Object(s.a)(o,2),r=i[0],a=i[1];return Object(v.jsx)(v.Fragment,{children:Object(v.jsxs)("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",className:ne,children:[Object(v.jsx)(oe,{style:a,stroke:t?n.primaryBackgroundColor:n.primaryLightColor,fill:t?n.primaryLightColor:n.primaryBackgroundColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"0",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(v.jsx)(ie,{strokeDashoffset:r[2].strokeDashoffset,stroke:t?n.primaryBackgroundColor:n.primaryLightColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(v.jsx)(ie,{strokeDashoffset:r[0].strokeDashoffset,stroke:t?n.primaryBackgroundColor:n.primaryLightColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M16.99 13H17"}),Object(v.jsx)(ie,{strokeDashoffset:r[1].strokeDashoffset,stroke:t?n.primaryBackgroundColor:n.primaryLightColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M12.99 13H13"})]})})}function ue(e){const t=e.colorfulBg,n=e.type,o=e.className;return Object(v.jsx)(se,{className:Object(b.c)(te,{[`type-${n}`]:!0,colorfulBg:t},o),children:"error"===n?Object(v.jsx)(le,{colorfulBg:t}):"warning"===n?Object(v.jsx)(ce,{colorfulBg:t}):"success"===n?Object(v.jsx)(ae,{colorfulBg:t}):Object(v.jsx)(de,{colorfulBg:t})})}var me=n(98);const he="wpeform-component-actionfeedback",fe=Object(b.d)(he,"title"),be=Object(b.d)(he,"content"),pe=Object(b.d)(he,"footer"),ge=Object(b.d)(he,"icon"),je=m.f.div.withConfig({displayName:"ActionFeedback__IconContainer",componentId:"sc-irmrcs-0"})(["font-size:",";margin:0 0 "," 0;will-change:opacity,transform;display:flex;"],(e=>Object(b.n)(1.25*e.theme.fz.large8)),(e=>Object(b.n)(2*e.theme.gutter))),ve=Object(m.f)(l.animated.h3).withConfig({displayName:"ActionFeedback__Title",componentId:"sc-irmrcs-1"})(["color:",";font-size:",";font-weight:bold;margin:0 0 "," 0;line-height:1.2;will-change:opacity,transform;"],(e=>e.theme.headingColor),(e=>Object(b.n)(e.theme.fz.large3)),(e=>Object(b.n)(e.theme.gutter))),Oe=Object(m.f)(l.animated.article).withConfig({displayName:"ActionFeedback__Content",componentId:"sc-irmrcs-2"})(["",";will-change:opacity,transform;"],b.p),ye=Object(m.f)(l.animated.footer).withConfig({displayName:"ActionFeedback__Footer",componentId:"sc-irmrcs-3"})(["color:",";font-size:",";margin:"," 0 0 0;will-change:opacity,transform;"],(e=>e.theme.textColorSecondary),(e=>Object(b.n)(e.theme.fz.small1)),(e=>Object(b.n)(e.theme.gutter))),we=m.f.aside.withConfig({displayName:"ActionFeedback__Container",componentId:"sc-irmrcs-4"})(["",";margin:"," 0;padding:0 ",";&.","--size-tablet{","{font-size:",";}","{font-size:",";}}"],b.b,(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.gutter)),he,je,(e=>Object(b.n)(1.5*e.theme.fz.large8)),ve,(e=>Object(b.n)(e.theme.fz.large4)));function xe(e){const t=e.type,n=e.title,o=e.children,r=e.className,a=e.scrollOnMount,c=void 0===a||a,d=e.scrollOffset,u=void 0===d?-100:d,f=e.footer,p=Object(m.h)(),g=Object(l.useTrail)(f?3:2,(e=>({from:{opacity:0,transform:"translate(0px, 20px)"},opacity:1,transform:"translate(0px, 0px)",config:0===e?p.springConfigGeneral:p.springConfigSlow,delay:500}))),j=Object(s.a)(g,1)[0],O=Object(b.u)(Object(me.c)(),he,{[`type-${t}`]:!0},r),y=Object(i.useRef)(!0),w=Object(i.useRef)(null);return Object(i.useLayoutEffect)((()=>{y.current&&(y.current=!1,c&&w.current&&Object(h.a)(w.current,{verticalOffset:u,cancelOnUserAction:!0,elementToScroll:Object(I.f)(w.current)[0]}))}),[c,u]),Object(v.jsxs)(we,{className:O,ref:w,children:[Object(v.jsx)(je,{className:ge,children:Object(v.jsx)(ue,{type:t,colorfulBg:!1})}),Object(v.jsx)(ve,{style:j[0],className:fe,children:n}),Object(v.jsx)(Oe,{style:j[1],className:be,children:o}),f?Object(v.jsx)(ye,{style:j[2],className:pe,children:f}):null]})}var Ce=n(366),ke=n(127),Se=n(34),_e=n(108),Fe=n(360),Ee=(n(199),n(447)),Te=n(218),Ie=n(216);function Me(e){return e===F.k.BORDER_BOX?"border-box":e===F.k.CONTENT_BOX?"content-box":e===F.k.PADDING_BOX?"padding-box":"border-box"}const Pe=m.f.div.withConfig({displayName:"Page__PageBgContainer",componentId:"sc-19bqagh-0"})(["",";background-image:",";background-size:",";background-position:",";background-repeat:",";background-origin:",";background-clip:",";background-attachment:",";"],b.b,(e=>{var t;return null!==(t=e.bg)&&void 0!==t&&t.backgroundImage?`url("${e.bg.backgroundImage}")`:"none"}),(e=>{var t,n;return null!==(t=null===(n=e.bg)||void 0===n?void 0:n.backgroundSize)&&void 0!==t?t:"auto"}),(e=>{var t,n;return null!==(t=null===(n=e.bg)||void 0===n?void 0:n.backgroundPosition)&&void 0!==t?t:"0% 0%"}),(e=>{var t,n;return(n=null===(t=e.bg)||void 0===t?void 0:t.backgroundRepeat)===F.l.REPEAT_BOTH?"repeat":n===F.l.REPEAT_NONE?"no-repeat":n===F.l.REPEAT_X?"repeat-x":n===F.l.REPEAT_Y?"repeat-y":"no-repeat"}),(e=>{var t;return Me(null===(t=e.bg)||void 0===t?void 0:t.backgroundOrigin)}),(e=>{var t;return Me(null===(t=e.bg)||void 0===t?void 0:t.backgroundClip)}),(e=>{var t,n;return(n=null===(t=e.bg)||void 0===t?void 0:t.backgroundAttachment)===F.j.FIXED?"fixed":n===F.j.LOCAL?"local":"scroll"}));function Le(){var e,t;const n=Object(_e.l)(),o=Object(Fe.i)(Fe.b),a=n.structures.find((e=>e.id===o)),c=Object(Fe.i)(Fe.d),l=Object(_e.j)(),d=Object(Fe.j)();let u;if(Object(i.useEffect)((()=>{var e,t;if(!c)return()=>{};if(null!==(e=n.styles)&&void 0!==e&&null!==(t=e.pagination)&&void 0!==t&&t.autoProgress){var o;let e=!0;const t=setTimeout((()=>{var t,o;if(e)if(l.canNext){const e=d.getState().elements,t=Object(Ie.f)(a,n.elements,e),o=Object(Ie.a)(e,t);Object(s.a)(o,1)[0]&&l.goNext()}else null!==(t=n.styles)&&void 0!==t&&null!==(o=t.pagination)&&void 0!==o&&o.autoSubmit&&l.canSubmit&&l.submit()}),null!==(o=n.styles.pagination.autoProgressDelay)&&void 0!==o?o:100);return()=>{e=!1,clearTimeout(t)}}return()=>{}}),[c,n,d,l,a]),a){const e=a.children;u=Object(v.jsx)(Te.a,{elements:e,emptyMessage:Object(r.__)("This page is empty.","wp-eform")})}else u=Object(v.jsx)(Ee.a,{icon:Object(v.jsx)(p.b,{iconClass:"fas fa-envelope-open"}),children:Object(r.__)("This page does not exist. Kindly navigate away from it.","wp-eform")});return Object(v.jsx)(Pe,{bg:null!==(e=n.styles)&&void 0!==e&&null!==(t=e.customBackground)&&void 0!==t&&t.enabled?n.styles.customBackground:void 0,className:"wpeform-form-page",children:u})}n(286);var Be=n(33);const Ae={message:Object(r.__)("Some error has occured.","wp-eform"),dynamicAnchors:null,mentions:null,id:"unknown"};function Ne(e){var t;const n=e.limitationMessage,o=Object(i.useMemo)((()=>[]),[]),s=Object(Se.n)(n.mentions),a=Object(Se.m)(n.dynamicAnchors),c=Object(Se.l)(n.message);return Object(v.jsx)(Se.f,{mode:"multiline",nodes:c||Object(Be.a)(Object(r.sprintf)(Object(r.__)("There has been some error related to %s.","wp-eform"),null!==(t=n.id)&&void 0!==t?t:"unknown")),excludeMentionsCharacters:o,additionalMentions:s,additionalDynamicAnchorTags:a})}function De(e){const t=e.messageJson,n=Object(i.useMemo)((()=>{try{const e=JSON.parse(null!=t?t:"");return"object"==typeof e&&void 0!==e.dynamicAnchors&&void 0!==e.mentions&&void 0!==e.message?e:Ae}catch(e){return Ae}}),[t]),o=function(){const e=Object(_e.l)().elements;return Object(i.useCallback)((t=>{var n;return e[t]?Object(v.jsx)("strong",{children:Object(v.jsx)(Se.d,{currentElementId:null,nodes:Object(Be.c)(null===(n=e[t].appearance)||void 0===n?void 0:n.title),mode:"singleline"})}):null}),[e])}();return Object(v.jsx)(Se.c,{mentions:o,children:Object(v.jsx)(Ne,{limitationMessage:n})})}var Re=n(367),He=n.n(Re),ze=n(175);function $e(e){const t=e.time,n=e.onDone,o=Object(ze.d)(t,n),i=Object(E.c)(1e3*o,"number"),s=i.hours,a=i.minutes,c=i.seconds;return Object(v.jsxs)("span",{className:"wpeform-component-inlinecountdown",children:[s>0?Object(r.sprintf)(Object(r._n)("%d hour, ","%d hours, ",s,"wp-eform"),s):null,s>0||a>0?Object(r.sprintf)(Object(r._n)("%d minute, ","%d minutes, ",a,"wp-eform"),a):null,Object(r.sprintf)(Object(r._n)("%d second","%d seconds",c,"wp-eform"),c)]})}var qe=n(437),Ve=(n(120),n(1077),n(368));function We(e,t,n){if(!t)return"";const o=t.reduce(((e,t)=>(e[t.scoreId]=t,e)),{}),i="percentage"===n?e.scorePercentageLogic:e.scoreTotalLogic;let s="";return i.forEach((e=>{if(!e.scoreId||!o[e.scoreId]||!o[e.scoreId].has)return;const t=o[e.scoreId],i="percentage"===n?t.obtained/t.outof*100:t.obtained;i<=e.to&&i>=e.from&&(s=e.url)})),s}function Ue(e){const t=e.config,n=e.submissionLink,o=e.scoreData;let s=t.url;const a=Object(Fe.i)(Fe.c),c=Object(_e.l)();t.type===F.v.FLAT?s=t.url:t.type===F.v.PORTAL?s=WPEFormGraphQLApp.userPortal:t.type===F.v.SUBMISSION?s=null!=n?n:t.url:t.type===F.v.CONDITIONAL?s=function(e,t,n){let o="";return e.forEach((e=>{Object(Ve.b)(e.events,t,n)&&(o=e.url)})),o}(t.conditionalLogic,a,c.elements):t.type===F.v.SCOREPERCENTAGE?s=We(t,o,"percentage"):t.type===F.v.SCORETOTAL&&(s=We(t,o,"total")),""===s&&(s=t.url);const l=He()(s),d=Object(i.useCallback)((()=>{t.iframeRedirect&&window.top&&window.top!==window.self?window.top.location.href=s:window.location.href=s}),[t.iframeRedirect,s]);Object(qe.c)(d,t.delay,!l);const u=Object(i.useMemo)((()=>({"%REDIRECT_LINK%":s})),[s]);return l?Object(v.jsx)(Se.d,{mode:"multiline",nodes:Object(Se.g)(t.message),currentElementId:null,additionalMentions:{"::redirectDelay::":Object(v.jsx)($e,{time:t.delay})},additionalAnchors:u}):Object(v.jsx)("p",{children:Object(r.sprintf)(Object(r.__)("ERROR: The URL %s is invalid and cannot redirect. Please contact the site administrator for help.","wp-eform"),s)})}function Ke(e){const t=e.reset,n=e.delay,o=e.message;return Object(qe.c)(t,n),Object(v.jsx)(Se.d,{mode:"singleline",nodes:Object(Se.g)(o),currentElementId:null,additionalMentions:{"::kioskResetTime::":Object(v.jsx)($e,{time:n})}})}const Ye="wpeform-component-timer",Ge=Object(m.f)(l.animated.div).withConfig({displayName:"Timer__TimerProgressContainer",componentId:"sc-1d2zn5q-0"})(["position:absolute;left:0;right:0;top:0;height:",";will-change:background-color;"],(e=>Object(b.n)(e.theme.controlHeightBase/8))),Qe=Object(m.f)(l.animated.div).withConfig({displayName:"Timer__TimerProgressAnimator",componentId:"sc-1d2zn5q-1"})(["will-change:width;position:absolute;right:0;top:0;height:",";background-color:",";max-width:100%;"],(e=>Object(b.n)(e.theme.controlHeightBase/8)),(e=>Object(j.b)(.1,e.theme.backgroundShade))),Xe=m.f.div.withConfig({displayName:"Timer__TimerIconContainer",componentId:"sc-1d2zn5q-2"})(["flex:0 0 ",";margin:0 "," 0 0;height:",";width:",";font-size:",";line-height:1;display:flex;align-items:center;justify-content:center;color:",";"],(e=>Object(b.n)(.8*e.theme.controlHeightBase)),(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(.8*e.theme.controlHeightBase)),(e=>Object(b.n)(.8*e.theme.controlHeightBase)),(e=>Object(b.n)(.8*e.theme.controlHeightBase)),(e=>Object(j.b)(.1,e.theme.backgroundShade)));function Ze(){return Object(v.jsx)(Xe,{children:Object(v.jsx)(p.b,{iconClass:"fas fa-clock"})})}const Je=m.f.div.withConfig({displayName:"Timer__TimerMainContainer",componentId:"sc-1d2zn5q-3"})(["width:calc( 100% - "," );flex:0 0 calc(100% - ",");"],(e=>Object(b.n)(.8*e.theme.controlHeightBase)),(e=>Object(b.n)(.8*e.theme.controlHeightBase))),et=m.f.div.withConfig({displayName:"Timer__TimerClockContainer",componentId:"sc-1d2zn5q-4"})(["display:flex;flex-flow:row nowrap;align-items:center;"]),tt=m.f.div.withConfig({displayName:"Timer__TimeContainer",componentId:"sc-1d2zn5q-5"})(["font-size:",";font-weight:bold;line-height:1.2;color:",";font-variant-numeric:tabular-nums;small{font-size:",";font-weight:normal;}"],(e=>Object(b.n)(e.theme.fz.large2)),(e=>e.theme.headingColor),(e=>Object(b.n)(e.theme.fz.small2))),nt=m.f.div.withConfig({displayName:"Timer__TickContainer",componentId:"sc-1d2zn5q-6"})(["font-size:",";margin:0 ",";line-height:1.2;"],(e=>Object(b.n)(e.theme.fz.large1)),(e=>Object(b.n)(e.theme.gutter/5))),ot=m.f.div.withConfig({displayName:"Timer__TimerMessage",componentId:"sc-1d2zn5q-7"})(["font-size:",";color:",";margin:0;padding:0;",";.","{",";}"],(e=>Object(b.n)(e.theme.fz.small2)),(e=>e.theme.textColorSecondary),b.s,Se.a,b.s),it=m.f.div.withConfig({displayName:"Timer__TimerWrapper",componentId:"sc-1d2zn5q-8"})(["display:flex;align-items:center;flex-flow:row nowrap;padding:",";padding-top:",";"],(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.gutter/2+e.theme.controlHeightBase/8))),st=m.f.div.withConfig({displayName:"Timer__TimerContainer",componentId:"sc-1d2zn5q-9"})(["",";font-family:",";background-color:",";position:relative;&.","--hidden{display:none;}@media screen and (min-width:","){","{padding:",";padding-top:",";}","{flex-basis:",";margin-right:",";height:",";width:",";font-size:",";}","{width:calc( 100% - "," );flex-basis:calc( 100% - "," );}","{font-size:",";small{font-size:",";}}","{font-size:",";}","{font-size:",";}}"],b.b,(e=>e.theme.fontFamilyBody),(e=>e.theme.backgroundShade),Ye,(e=>Object(b.n)(e.theme.breakpoints.tablet)),it,(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.gutter+e.theme.controlHeightBase/8)),Xe,(e=>Object(b.n)(1.2*e.theme.controlHeightBase)),(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(1.2*e.theme.controlHeightBase)),(e=>Object(b.n)(1.2*e.theme.controlHeightBase)),(e=>Object(b.n)(1.2*e.theme.controlHeightBase)),Je,(e=>Object(b.n)(1.2*e.theme.controlHeightBase)),(e=>Object(b.n)(1.2*e.theme.controlHeightBase)),tt,(e=>Object(b.n)(e.theme.fz.large3)),(e=>Object(b.n)(e.theme.fz.small1)),nt,(e=>Object(b.n)(e.theme.fz.large2)),ot,(e=>Object(b.n)(e.theme.fz.small1))),rt=m.f.div.withConfig({displayName:"Timer__Placeholder",componentId:"sc-1d2zn5q-10"})(["height:",";@media screen and (min-width:","){height:",";}"],(e=>Object(b.n)(e.theme.gutter+e.theme.controlHeightBase/8+1.2*e.theme.fz.large2+1.2*e.theme.fz.small2+10)),(e=>Object(b.n)(e.theme.breakpoints.tablet)),(e=>Object(b.n)(2*e.theme.gutter+e.theme.controlHeightBase/8+1.2*e.theme.fz.large3+1.2*e.theme.fz.small1+10))),at=m.f.div.withConfig({displayName:"Timer__Portal",componentId:"sc-1d2zn5q-11"})(["position:fixed;bottom:0;left:0;width:100%;z-index:999995;"]);function ct(e){const t=e.time,n=e.onDone,o=e.message,s=e.showUI,a=e.width,c=void 0===a?"100%":a,d=e.containerLayout,u=void 0===d?F.A.FIXED:d,h=Object(ze.d)(t,n),f=Object(m.h)(),p=h/t*100,g=Object(l.useSpring)({from:{backgroundColor:f.successColor},to:{backgroundColor:p>60?f.successColor:p>20?f.warningColor:f.errorColor},config:f.springConfigSlow}),j=Object(l.useSpring)({from:{width:"0%"},to:{width:`${Object(b.n)(100-p,"%")}`},config:f.springConfigSlow}),O=Object(E.c)(1e3*h,"string"),y=O.hours,w=O.minutes,x=O.seconds,C=Object(b.c)(Ye,{hidden:!s}),k=Object(i.useMemo)((()=>Object(E.c)(1e3*t,"number")),[t]).hours;return Object(v.jsx)(st,{className:C,children:Object(v.jsx)(me.a,{width:c,containerLayout:u,noHorizontalPadding:!0,noVerticalPadding:!0,children:Object(v.jsxs)(it,{children:[Object(v.jsx)(Ge,{style:g,children:Object(v.jsx)(Qe,{style:j})}),Object(v.jsx)(Ze,{}),Object(v.jsxs)(Je,{children:[Object(v.jsxs)(et,{children:[k>0?Object(v.jsxs)(v.Fragment,{children:[Object(v.jsxs)(tt,{children:[y,Object(v.jsx)("small",{children:Object(r._x)("h","hours short form","wp-eform")})]}),Object(v.jsx)(nt,{children:":"})]}):null,Object(v.jsxs)(tt,{children:[w,Object(v.jsx)("small",{children:Object(r._x)("m","minutes short form","wp-eform")})]}),Object(v.jsx)(nt,{children:":"}),Object(v.jsxs)(tt,{children:[x,Object(v.jsx)("small",{children:Object(r._x)("s","seconds short form","wp-eform")})]})]}),o?Object(v.jsx)(ot,{children:o}):null]})]})})})}ct.Placeholder=rt,ct.Portal=at;var lt=n(281);function dt(e){const t=e.timerConfig,n=e.currentPageConfig,o=e.goNext,s=e.canSubmit,r=e.submit,a=e.submitting,c=e.width,l=e.containerLayout,d=Object(Se.l)(null==t?void 0:t.timerMessage),u=Object(i.useCallback)((()=>{0}),[s,o,r,t,a]);if(!t||!n)return null;if(t.submitTimer===F.G.NONE)return null;let m,h;if(t.submitTimer===F.G.OVERALL?(m=t.timeLimit,h="overall"):(m=n.config.timer,h=n.id),!m||m<0)return null;const f=t.showTimer&&!a&&Object(lt.a)("starter");return Object(v.jsxs)(v.Fragment,{children:[f?Object(v.jsx)(ct.Placeholder,{}):null,Object(v.jsx)(me.a.Portal,{children:Object(v.jsx)(ct.Portal,{children:Object(v.jsx)(ct,{showUI:f,time:m,message:d?Object(v.jsx)(Se.d,{nodes:d,currentElementId:null,mode:"singleline"}):void 0,onDone:u,width:c,containerLayout:l},h)})})]})}var ut=n(450),mt=n(449);const ht=m.f.div.withConfig({displayName:"Remarks__Container",componentId:"sc-123x1v6-0"})(["padding:",";border-radius:",";background-color:",";margin:0 0 "," 0;"],(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>e.theme.backgroundShade),(e=>Object(b.n)(e.theme.gutter)));function ft(){const e=Object(ze.c)(),t=Object(Fe.i)(Fe.e),n=Object(Fe.h)(),o=Object(i.useCallback)((e=>{n({type:"SET_REMARKS",payload:{remarks:e}})}),[n]);return Object(v.jsx)(ht,{children:Object(v.jsx)(ut.a,{title:Object(r.__)("Administrator Remarks","wp-eform"),subtitle:Object(r.__)("this will show up in submission summary.","wp-eform"),id:`${e}-remarks`,children:Object(v.jsx)(mt.a,{value:t,onChange:o})})})}function bt(e){var t,n,o,a,c,l,d,u,m,h,f,b,p,g,j,O,y,w,x,C,k,S,_,E,T,I,M,P,L,B,A,N,D,R,H,z,$,q,V,W,U,K,Y,G,Q,X,te,ne,oe,ie,se,re,ae,ce,le,de,ue,me,he,fe,be,pe,ge,je,ve,Oe,ye,we,Ee,Te,Me,Pe,Be,Ae,Re,He,ze,$e,qe,Ve,We,Ye,Ge,Qe,Xe,Ze,Je,et,tt,nt,ot,it,st,rt,at,ct,lt,ut,mt,ht,bt,pt,gt,jt;const vt=e.activePage,Ot=e.onActivePageChange,yt=e.onSubmit,wt=e.submitting,xt=e.submitted,Ct=e.submittedState,kt=e.submissionError,St=e.onReset,_t=e.onErrorRetry,Ft=e.limitations,Et=e.mutationData,Tt=e.notices,It=e.initialData,Mt=Object(Fe.h)(),Pt=Object(Fe.j)(),Lt=Object(_e.m)(),Bt=Object(_e.l)(),At=Object(Fe.i)(Fe.b),Nt=Object(Fe.i)(Fe.g),Dt=Object(Fe.i)(Fe.f),Rt=Object(i.useState)(!1),Ht=Object(s.a)(Rt,2),zt=Ht[0],$t=Ht[1],qt=Object(i.useState)(null),Vt=Object(s.a)(qt,2),Wt=Vt[0],Ut=Vt[1],Kt=Object(_e.n)(),Yt=Object(_e.i)();Object(i.useEffect)((()=>{Ut(null),$t(!1),Mt({type:"SET_ELEMENTS_AND_STARTTIME",payload:{structures:Object(Ie.e)(Bt),elements:Object(Ie.d)(Bt,Lt,!0,It),formData:Bt,formMeta:Lt,conditionalsMap:Yt,fullReset:"preview"===Kt||"listview"===Kt}})}),[Mt,Lt,Bt,Yt,It,Kt]);const Gt=Object(i.useMemo)((()=>Bt.structures.filter((e=>{if("preview"===Kt)return!0;const t=Nt[e.id];return!t||!t.conditionallyHidden})).map((e=>({id:e.id,title:e.config.title,subtitle:e.config.subtitle,icon:e.config.icon||void 0})))),[Bt.structures,Kt,Nt]);Object(i.useEffect)((()=>{!Gt.find((e=>e.id===At))&&Gt.length&&Mt({type:"SET_CURRENT_PAGE",payload:Gt[0].id})}),[Gt,At,Mt]);const Qt=("newsubmission"===Kt||"useredit"===Kt)&&(null===(t=Bt.settings)||void 0===t||null===(n=t.timer)||void 0===n?void 0:n.submitTimer)!==F.G.NONE,Xt=Object(i.useMemo)((()=>Bt.structures.find((e=>e.id===At))),[At,Bt.structures]),Zt=Gt.findIndex((e=>e.id===At)),Jt=0===Zt?null:Gt[Zt-1]?Gt[Zt-1].id:null,en=Gt[Zt+1]?Gt[Zt+1].id:At,tn=Object(i.useCallback)(((e,t=!1)=>{var n,o;const i=()=>{Mt({type:"SET_CURRENT_PAGE",payload:e}),Ot&&Ot(e)};if("preview"===Kt||(null===(n=Bt.styles)||void 0===n||null===(o=n.pagination)||void 0===o?void 0:o.paginationRestriction)===F.i.NONE)return void i();if(Qt&&e===en&&t)return i(),$t(!1),void Ut(null);const r=Pt.getState().elements,a=Object(Ie.f)(Xt,Bt.elements,r),c=Object(Ie.a)(r,a),l=Object(s.a)(c,2),d=l[0],u=l[1];if(Gt.findIndex((t=>t.id===e))<Zt){var m,h,f,b;if(Qt)return;if(null!==(m=Bt.styles)&&void 0!==m&&null!==(h=m.pagination)&&void 0!==h&&h.blockPreviousNavigation)return;return(null===(f=Bt.styles)||void 0===f||null===(b=f.pagination)||void 0===b?void 0:b.paginationRestriction)!==F.i.ONLY_WHEN_ALL_VALID||d?($t(!1),Ut(null),Mt({type:"SET_CURRENT_PAGE",payload:e}),void(Ot&&Ot(e))):($t(!0),void Ut(u))}if(d)return $t(!1),Ut(null),Mt({type:"SET_CURRENT_PAGE",payload:en}),void(Ot&&Ot(en));$t(!0),Ut(u)}),[Ot,Kt,Xt,Zt,Mt,Bt,Pt,Gt,en,Qt]);Object(i.useEffect)((()=>{vt&&vt!==At&&Mt({type:"SET_CURRENT_PAGE",payload:vt})}),[Mt,vt,At]);const nn=!(Qt||!Jt||null!==(o=Bt.styles)&&void 0!==o&&null!==(a=o.pagination)&&void 0!==a&&a.blockPreviousNavigation||wt),on=Object(i.useCallback)((()=>{Jt&&tn(Jt)}),[Jt,tn]),sn=en!==At&&!wt,rn=Object(i.useCallback)(((e=!1)=>{tn(en,e)}),[tn,en]),an=en===At&&!wt,cn=Object(i.useCallback)(((e=!1)=>{if(Qt&&e)return void yt(Pt);const t=Pt.getState().elements,n=Object(Ie.f)(Xt,Bt.elements,t),o=Object(Ie.a)(t,n),i=Object(s.a)(o,2),r=i[0],a=i[1];if(!r)return $t(!0),void Ut(a);yt(Pt)}),[Xt,Bt,Pt,yt,Qt]),ln=(!wt||wt&&xt)&&!Qt,dn=Object(i.useCallback)((()=>{Mt({type:"SET_ELEMENTS_AND_STARTTIME",payload:{structures:Object(Ie.e)(Bt),elements:Object(Ie.d)(Bt,Lt,!0),formData:Bt,formMeta:Lt,conditionalsMap:Yt,fullReset:!0}}),Ut(null),$t(!1);const e=Gt[0].id;Mt({type:"SET_CURRENT_PAGE",payload:e}),Ot&&Ot(e),St&&St()}),[Mt,Bt,Lt,Ot,Gt,St,Yt]),un=Object(i.useCallback)((()=>{var e,t;window.confirm((null===(e=Bt.styles)||void 0===e||null===(t=e.pagination)||void 0===t?void 0:t.resetMessage)||Object(r.__)("This will reset the form. Action cannot be undone, are you sure?","wp-eform"))&&dn()}),[dn,Bt]),mn=Object(i.useMemo)((()=>({canNext:sn,canPrevious:nn,canSubmit:an,goNext:rn,goPrevious:on,submit:cn,canReset:ln,reset:un,submitting:wt,submitted:xt,submittedState:Ct})),[sn,nn,an,rn,on,cn,ln,un,wt,xt,Ct]),hn=null!==(c=Bt.styles)&&void 0!==c&&null!==(l=c.pagination)&&void 0!==l&&l.barlike?"flat":null!==(d=null===(u=Bt.styles)||void 0===u||null===(m=u.pagination)||void 0===m?void 0:m.style)&&void 0!==d?d:"flat",fn=null!==(h=null===(f=Bt.styles)||void 0===f||null===(b=f.pagination)||void 0===b?void 0:b.size)&&void 0!==h?h:F.o.DEFAULT,bn=null!==(p=null===(g=Bt.styles)||void 0===g||null===(j=g.pagination)||void 0===j?void 0:j.colored)&&void 0!==p&&p,pn=null===(O=Bt.styles)||void 0===O||null===(y=O.pagination)||void 0===y?void 0:y.rounded;let gn=Object(v.jsx)(ee.b,{style:hn,size:fn,colorful:bn,icon:null===(w=Bt.styles)||void 0===w||null===(x=w.pagination)||void 0===x?void 0:x.prevIcon,iconPosition:(null===(C=Bt.styles)||void 0===C||null===(k=C.pagination)||void 0===k?void 0:k.prevIconPosition)===F.a.BEFORE?"before":"after",onClick:on,rounded:pn,disabled:!nn,children:null===(S=Bt.styles)||void 0===S||null===(_=S.pagination)||void 0===_?void 0:_.prevLabel});const jn="newsubmission"===Kt||"preview"===Kt||"listview"===Kt?"new":"update",vn="new"===jn?null===(E=Bt.styles)||void 0===E||null===(T=E.pagination)||void 0===T?void 0:T.submitIconPosition:null===(I=Bt.styles)||void 0===I||null===(M=I.pagination)||void 0===M?void 0:M.updateIconPosition;let On=Object(v.jsx)(ee.b,{style:hn,size:fn,colorful:bn,icon:"new"===jn?null===(P=Bt.styles)||void 0===P||null===(L=P.pagination)||void 0===L?void 0:L.submitIcon:null===(B=Bt.styles)||void 0===B||null===(A=B.pagination)||void 0===A?void 0:A.updateIcon,iconPosition:vn===F.a.BEFORE?"before":"after",onClick:()=>{cn()},rounded:pn,disabled:!an,loading:wt,loadingDone:xt,loadedState:"success"===Ct?"success":"error",children:"new"===jn?null===(N=Bt.styles)||void 0===N||null===(D=N.pagination)||void 0===D?void 0:D.submitLabel:null===(R=Bt.styles)||void 0===R||null===(H=R.pagination)||void 0===H?void 0:H.updateLabel}),yn=Object(v.jsx)(ee.b,{style:hn,size:fn,colorful:bn,icon:null===(z=Bt.styles)||void 0===z||null===($=z.pagination)||void 0===$?void 0:$.nextIcon,iconPosition:(null===(q=Bt.styles)||void 0===q||null===(V=q.pagination)||void 0===V?void 0:V.nextIconPosition)===F.a.BEFORE?"before":"after",onClick:()=>{rn()},rounded:pn,disabled:!sn,children:null===(W=Bt.styles)||void 0===W||null===(U=W.pagination)||void 0===U?void 0:U.nextLabel}),wn=null!==(K=Bt.styles)&&void 0!==K&&null!==(Y=K.pagination)&&void 0!==Y&&Y.showResetButton?Object(v.jsx)(ee.b,{style:hn,size:fn,colorful:bn,icon:null===(G=Bt.styles)||void 0===G||null===(Q=G.pagination)||void 0===Q?void 0:Q.resetIcon,iconPosition:(null===(X=Bt.styles)||void 0===X||null===(te=X.pagination)||void 0===te?void 0:te.resetIconPosition)===F.a.BEFORE?"before":"after",onClick:un,rounded:pn,disabled:!ln,children:null===(ne=Bt.styles)||void 0===ne||null===(oe=ne.pagination)||void 0===oe?void 0:oe.resetLabel}):null;null!==(ie=Bt.styles)&&void 0!==ie&&null!==(se=ie.pagination)&&void 0!==se&&se.hideWhenNotRelevant&&(nn||(gn=null),sn?On=null:yn=null,ln||(wn=null)),1===Bt.structures.length&&(yn=null,gn=null);let xn=null;var Cn,kn,Sn,_n;wt&&xt&&"success"===Ct&&"newsubmission"===Kt&&((null===(Cn=Bt.styles)||void 0===Cn||null===(kn=Cn.redirection)||void 0===kn?void 0:kn.type)!==F.v.NONE?xn=Object(v.jsx)(Ue,{config:Bt.styles.redirection,submissionLink:null==Et?void 0:Et.submissionLink,scoreData:null==Et?void 0:Et.scoreData}):!0===(null===(Sn=Bt.styles)||void 0===Sn||null===(_n=Sn.formBehavior)||void 0===_n?void 0:_n.kioskMode)&&(xn=Object(v.jsx)(Ke,{reset:dn,delay:Bt.styles.formBehavior.kioskTime,message:Bt.styles.formBehavior.kioskMessage})));return Object(v.jsx)(v.Fragment,{children:wt&&xt?Object(v.jsx)(xe,{type:"success"===Ct?"success":"error",title:"success"===Ct?Object(v.jsx)(Se.d,{mode:"singleline",nodes:Object(Se.g)("useredit"===Kt?null===(re=Bt.styles)||void 0===re||null===(ae=re.formBehavior)||void 0===ae?void 0:ae.updateSubject:"adminedit"===Kt?Object(r.__)("The submission has been updated.","wp-eform"):null===(ce=Bt.styles)||void 0===ce||null===(le=ce.formBehavior)||void 0===le?void 0:le.subject),currentElementId:null}):Object(v.jsx)(Se.d,{mode:"singleline",nodes:Object(Se.g)(null!==(de=null===(ue=Bt.styles)||void 0===ue||null===(me=ue.formBehavior)||void 0===me?void 0:me.errorSubject)&&void 0!==de?de:Object(r.__)("Oops, we have encountered an error!","wp-eform")),currentElementId:null}),footer:xn,children:"success"===Ct?Object(v.jsx)(Se.d,{currentElementId:null,mode:"multiline",nodes:Object(Se.g)("useredit"===Kt?null===(he=Bt.styles)||void 0===he||null===(fe=he.formBehavior)||void 0===fe?void 0:fe.updateMessage:"adminedit"===Kt?Object(r.__)("We have also sent an email to the user about this update.","wp-eform"):null===(be=Bt.styles)||void 0===be||null===(pe=be.formBehavior)||void 0===pe?void 0:pe.message)}):Object(v.jsxs)(v.Fragment,{children:["submissionValidationLogic"===(null==kt||null===(ge=kt.graphQLErrors[0])||void 0===ge||null===(je=ge.extensions)||void 0===je?void 0:je.category)?Object(v.jsx)(De,{messageJson:null!==(ve=null==kt||null===(Oe=kt.graphQLErrors[0])||void 0===Oe?void 0:Oe.message)&&void 0!==ve?ve:""}):null==kt?void 0:kt.message,_t?Object(v.jsx)("p",{children:Object(v.jsx)(ee.b,{size:fn,style:hn,colorful:bn,icon:null!==(ye=null===(we=Bt.styles)||void 0===we||null===(Ee=we.formBehavior)||void 0===Ee?void 0:Ee.errorRetryButtonIcon)&&void 0!==ye?ye:"fas fa-sync-alt",iconPosition:(null===(Te=Bt.styles)||void 0===Te||null===(Me=Te.formBehavior)||void 0===Me?void 0:Me.errorRetryButtonIconPosition)===F.a.AFTER?"after":"before",onClick:_t,rounded:pn,children:null!==(Pe=null===(Be=Bt.styles)||void 0===Be||null===(Ae=Be.formBehavior)||void 0===Ae?void 0:Ae.errorRetryButtonLabel)&&void 0!==Pe?Pe:Object(r.__)("RETRY","wp-eform")})}):null]})}):Object(v.jsx)(_e.d.Provider,{value:zt,children:Object(v.jsx)(_e.a.Provider,{value:Wt,children:Object(v.jsx)(_e.c.Provider,{value:mn,children:Ft&&Ft.length>0&&"newsubmission"===Kt?Ft.map((e=>Object(v.jsx)(ke.a.Bottom,{children:Object(v.jsx)(Ce.a,{type:"error",icon:"fas fa-times",dismissable:!1,children:Object(v.jsx)(Ne,{limitationMessage:e})})},e.id))):Object(v.jsxs)(v.Fragment,{children:["adminedit"===Kt?Object(v.jsx)(ft,{}):null,Tt&&Tt.length&&"newsubmission"===Kt?Tt.map((e=>Object(v.jsx)(ke.a.Bottom,{children:Object(v.jsx)(Ce.a,{type:"regular",icon:"fas fa-exclamation",dismissable:!0,children:Object(v.jsx)(Ne,{limitationMessage:e})})},e.id))):null,Object(v.jsxs)("form",{method:"post",action:"",autoComplete:null!==(Re=Bt.styles)&&void 0!==Re&&null!==(He=Re.formBehavior)&&void 0!==He&&He.disabledAutoComplete?"off":"on",onSubmit:e=>{e.preventDefault()},children:[Object(v.jsx)(Z,{showTabs:null===(ze=Bt.styles)||void 0===ze||null===($e=ze.pagination)||void 0===$e?void 0:$e.showTabs,currentTab:At,onTabChange:tn,showProgressBar:null===(qe=Bt.styles)||void 0===qe||null===(Ve=qe.pagination)||void 0===Ve?void 0:Ve.showProgressBar,showProgressLabel:null===(We=Bt.styles)||void 0===We||null===(Ye=We.pagination)||void 0===Ye?void 0:Ye.showProgressLabel,forceProgress:wt?100:void 0,progressBarPosition:null===(Ge=Bt.styles)||void 0===Ge||null===(Qe=Ge.pagination)||void 0===Qe?void 0:Qe.progressBarPosition,progressBarPrecision:null===(Xe=Bt.styles)||void 0===Xe||null===(Ze=Xe.pagination)||void 0===Ze?void 0:Ze.progressDecimalPoint,scrollOnTabChange:null===(Je=Bt.styles)||void 0===Je||null===(et=Je.pagination)||void 0===et?void 0:et.autoScroll,tabScrollOffset:void 0!==(null===(tt=Bt.styles)||void 0===tt||null===(nt=tt.pagination)||void 0===nt?void 0:nt.scrollOffset)?-1*Bt.styles.pagination.scrollOffset:-100,tabs:Gt,stopwatchStartTime:null!==(ot=Bt.settings)&&void 0!==ot&&null!==(it=ot.timer)&&void 0!==it&&it.recordSubmissionTime&&Bt.settings.timer.showStopwatch?Dt:void 0,footer:null!==(st=Bt.styles)&&void 0!==st&&null!==(rt=st.pagination)&&void 0!==rt&&rt.panelEnabled?Object(v.jsxs)(J.a,{align:null!==(at=null===(ct=Bt.styles)||void 0===ct||null===(lt=ct.pagination)||void 0===lt?void 0:lt.alignment)&&void 0!==at?at:F.n.RIGHT,type:null!==(ut=Bt.styles)&&void 0!==ut&&null!==(mt=ut.pagination)&&void 0!==mt&&mt.barlike?"navbar":"regular",colorful:bn,hasGutterOnregular:!0,children:[gn,On,yn,wn]}):null,children:Object(v.jsx)(Le,{})}),"newsubmission"===Kt||"useredit"===Kt?Object(v.jsx)(dt,{timerConfig:null===(ht=Bt.settings)||void 0===ht?void 0:ht.timer,currentPageConfig:Xt,goNext:rn,submit:cn,canSubmit:an,width:null===(bt=Bt.styles)||void 0===bt||null===(pt=bt.appearance)||void 0===pt?void 0:pt.maxWidth,containerLayout:null===(gt=Bt.styles)||void 0===gt||null===(jt=gt.appearance)||void 0===jt?void 0:jt.containerLayout,submitting:wt}):null]})]})})})})})}function pt(e){const t=e.children,n=e.mutationData,o=function(e){var t;const n=Object(Fe.i)(Fe.c),o=Object(_e.l)(),s=o.elements,r=null===(t=o.settings)||void 0===t?void 0:t.score,a=Object(i.useMemo)((()=>{var t;return e?{"::fName::":e.fName,"::lName::":e.lName,"::email::":e.email,"::phone::":e.phone,"::submissionId::":e.token,"::formName::":null!==(t=o.name)&&void 0!==t?t:""}:null}),[e,o.name]);return Object(i.useCallback)((t=>Object(Se.i)(t,n,s,a,r,null==e?void 0:e.scoreData)),[n,s,e,r,a])}(n),s=Object(i.useMemo)((()=>{const e={};return e["%FORM_LINK%"]=window.location.href,null!=n&&n.submissionLink&&(e["%SUBMISSION_LINK%"]=n.submissionLink),e}),[n]);return Object(v.jsx)(Se.c,{mentions:o,children:Object(v.jsx)(Se.b,{dynamicAnchors:s,children:t})})}var gt=n(1036);const jt=["formData","formMeta","mode","initialData","activePage","onActivePageChange","mutationData","formHeader"];function vt(e){const t=e.formData,n=e.formMeta,s=e.mode,r=e.initialData,a=e.activePage,c=e.onActivePageChange,l=e.mutationData,d=e.formHeader,u=void 0===d?null:d,m=Object(o.a)(e,jt),h=t.styles,f=Object(gt.c)(h),b=Object(i.useMemo)((()=>{const e={};return t.conditionals.forEach((t=>{t.events.forEach((n=>{e[n.fieldid]||(e[n.fieldid]=[]),e[n.fieldid].includes(t.id)||e[n.fieldid].push(t.id)}))})),e}),[t]);return Object(v.jsx)(Fe.a,{initialData:null!=r?r:{...Ie.c,currentPage:null!=a?a:t.structures&&t.structures.length?t.structures[0].id:"",startTime:Date.now()},children:Object(v.jsx)(_e.e.Provider,{value:t,children:Object(v.jsx)(_e.f.Provider,{value:n,children:Object(v.jsx)(_e.g.Provider,{value:s,children:Object(v.jsx)(_e.b.Provider,{value:b,children:Object(v.jsx)(pt,{mutationData:l,children:Object(v.jsxs)(gt.a,{themeStyle:f,mode:"preview"!==s?"live":"preview",children:[u,Object(v.jsx)(bt,{activePage:a,onActivePageChange:c,...m,mutationData:l,initialData:r})]})})})})})})})}},1088:function(e,t,n){"use strict";n.d(t,"a",(function(){return m}));var o=n(1189);const i=o.a`
	fragment FConfigStyleAppearance on FormStylesAppearanceType {
		containerLayout
		maxWidth
		controlType
		controlAlignment
		controlLayout
	}
`,s=o.a`
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
`,r=o.a`
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
	${s}
	${r}
	${a}
	${c}
	${l}
	${d}
	${u}
`},1089:function(e,t,n){"use strict";n.d(t,"a",(function(){return l})),n.d(t,"b",(function(){return h}));var o=n(0),i=n(7),s=n(36),r=n(21),a=n(2),c=n(1);const l="wpeform-component-graphskeleton",d=i.f.div.withConfig({displayName:"GraphSkeleton__Container",componentId:"sc-tm906v-0"})(["display:flex;flex-flow:row nowrap;max-width:100%;overflow:hidden;min-height:50px;align-items:flex-end;justify-content:space-between;"]),u=Object(i.g)(["0%{height:14%;}50%{height:100%;}100%{height:14%;}"]),m=i.f.div.withConfig({displayName:"GraphSkeleton__Bar",componentId:"sc-tm906v-1"})(["margin:0 1px;background-color:",";flex:0 0 auto;animation:"," 2300ms infinite;"],(e=>e.theme.backgroundShade),u);function h(e){const t=e.barWidth,n=void 0===t?6:t,i=e.bars,u=void 0===i?4:i,h=e.color,f=e.height,b=void 0===f?70:f,p=e.type,g=void 0===p?"bar":p,j=e.className,v={width:Object(a.n)(n)};h&&(v.backgroundColor=h);const O=Object(o.useMemo)((()=>Array.from({length:10}).map((()=>Object(s.h)(100,1e3)))),[]),y=Object(o.useMemo)((()=>Array.from({length:10}).map((()=>Object(s.h)(200,300)))),[]);return Object(c.jsx)(d,{className:Object(a.c)(l,{[`type-${g}`]:!0},j),style:{height:Object(a.n)(b)},children:Array.from({length:u}).map(((e,t)=>{const n=2300+Object(r.i)(t,y),o=-1*t*Object(r.i)(t,O);return Object(c.jsx)(m,{style:{...v,animationDuration:`${n}ms`,WebkitAnimationDuration:`${n}ms`,MozAnimationDuration:`${n}ms`,animationDelay:`${o}ms`,WebkitAnimationDelay:`${o}ms`,MozAnimationDelay:`${o}ms`}},t)}))})}},1091:function(e,t,n){"use strict";n.d(t,"b",(function(){return l}));var o=n(7),i=n(1102),s=n(1065);n.d(t,"a",(function(){return s.a})),n.d(t,"c",(function(){return s.b}));var r=n(361),a=n(1089);const c={datetime:"MMM D, YYYY, h:mm:ss a",millisecond:"h:mm:ss.SSS a",second:"h:mm:ss a",minute:"h:mm a",hour:"hA",day:"MMM D",week:"ll",month:"MMM YYYY",quarter:"[Q]Q - YYYY",year:"YYYY"};i.b._date.override({_id:"dayjs",formats:()=>c,parse(e,t){const n=typeof e;return null===e||"undefined"===n?null:"string"===n&&"string"==typeof t?Object(r.e)(e,t).isValid()?Object(r.e)(e,t).valueOf():null:e instanceof r.e?null:Object(r.e)(e).isValid()?Object(r.e)(e).valueOf():null},format:(e,t)=>Object(r.e)(e).format(t),add:(e,t,n)=>Object(r.e)(e).add(t,n).valueOf(),diff:(e,t,n)=>Object(r.e)(e).diff(Object(r.e)(t),n),startOf(e,t,n){if("isoWeek"===t){const t="number"==typeof n&&n>0&&n<7?n:1;return Object(r.e)(e).isoWeekday(t).startOf("day").valueOf()}return Object(r.e)(e).startOf(t).valueOf()},endOf:(e,t)=>Object(r.e)(e).endOf(t).valueOf()});const l=o.f.div.withConfig({displayName:"chartjs__ChartContainer",componentId:"sc-d85kru-0"})(["position:relative;width:100%;margin:0 auto;min-height:400px;display:flex;align-items:flex-end;.","{flex:0 0 100%;}"],a.a)},1093:function(e,t,n){"use strict";n.d(t,"a",(function(){return u}));n(0);var o=n(3),i=n(147),s=n(8),r=n(289),a=n(364),c=n(1039),l=n(1);function d(e){const t=e.lastError,n=e.resetError,r=e.themeStyle;return Object(l.jsx)(c.a,{themeStyle:r,children:Object(l.jsx)(a.a,{type:"client",title:Object(o.__)("Something went wrong","wp-eform"),description:Object(l.jsxs)(l.Fragment,{children:[Object(l.jsx)("p",{children:Object(o.__)("There was an error in the application. Reloading the page might fix it.","wp-eform")}),t&&t.toString?Object(l.jsxs)(l.Fragment,{children:[Object(l.jsx)("p",{children:Object(o.__)("More information on the error can be found below.","wp-eform")}),Object(l.jsx)("p",{children:t.toString()})]}):null]}),footer:Object(l.jsxs)(l.Fragment,{children:[Object(l.jsx)(i.b,{onClick:()=>{window.location.reload()},style:"3d",size:s.o.SMALL,children:Object(o.__)("RELOAD PAGE","wp-eform")}),Object(l.jsx)(i.b,{onClick:()=>{n()},style:"3d",size:s.o.SMALL,colorful:!1,children:Object(o.__)("RETRY WITHOUT RELOAD","wp-eform")})]})})})}function u(e){const t=e.children,n=e.themeStyle;return Object(l.jsx)(r.a,{fallback:(e,t)=>Object(l.jsx)(d,{resetError:e,lastError:t,themeStyle:n}),children:t})}},1094:function(e,t,n){"use strict";n.d(t,"b",(function(){return g})),n.d(t,"a",(function(){return j}));var o=n(1189),i=n(1080),s=n(1081),r=n(1082),a=n(1088),c=n(1083),l=n(1079),d=n(1063),u=n(1072),m=n(1073),h=n(1074),f=n(1075),b=n(1076),p=n(1084);const g=o.a`
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
	${s.a}
	${r.a}
	# Style Fragments
	${a.a}
	# Elements Fragments
	${c.a}
	${l.a}
	# Element generic fragments
	${u.a}
	${m.a}
	${h.a}
	${f.a}
	${b.a}
	# Structure Fragments
	${p.a}
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
`},1095:function(e,t,n){"use strict";n.d(t,"a",(function(){return E}));n(0);var o=n(7),i=n(29),s=n(438),r=n(2),a=n(127),c=n(8),l=n(165),d=n(1070),u=n(1);const m=o.f.div.withConfig({displayName:"FormSkeleton__SkeletonWrapper",componentId:"sc-1xvkpmg-0"})(["",";"],r.b),h=o.f.div.withConfig({displayName:"FormSkeleton__SkeletonContainer",componentId:"sc-1xvkpmg-1"})(["margin:0 auto;box-shadow:",";border-radius:",";overflow:hidden;"],(e=>e.theme.boxShadow4dp),(e=>Object(r.n)(e.theme.borderRadiusBase))),f=o.f.div.withConfig({displayName:"FormSkeleton__SkeletonTabsContainer",componentId:"sc-1xvkpmg-2"})(["background-color:",";width:100%;overflow:hidden;border-top-left-radius:",";border-top-right-radius:",";padding:0 "," 0 0;"],(e=>Object(i.d)(.003,e.theme.backgroundControl)),(e=>Object(r.n)(e.theme.borderRadiusBase)),(e=>Object(r.n)(e.theme.borderRadiusBase)),(e=>Object(r.n)(e.theme.gutter))),b=o.f.div.withConfig({displayName:"FormSkeleton__SkeletonTabsButtonsContainer",componentId:"sc-1xvkpmg-3"})(["height:",";overflow:hidden;display:flex;flex-flow:row nowrap;align-items:center;"],(e=>Object(r.n)(1.25*e.theme.controlHeightBase))),p=o.f.div.withConfig({displayName:"FormSkeleton__TabButtonContainer",componentId:"sc-1xvkpmg-4"})(["display:flex;flex-flow:row nowrap;width:150px;padding:0 ",";align-items:center;justify-content:flex-start;"],(e=>Object(r.n)(e.theme.gutter))),g=o.f.div.withConfig({displayName:"FormSkeleton__TabButtonIcon",componentId:"sc-1xvkpmg-5"})(["flex:0 0 ",";width:",";margin:0 "," 0 0;"],(e=>Object(r.n)(e.theme.fz.large3)),(e=>Object(r.n)(e.theme.fz.large3)),(e=>Object(r.n)(e.theme.gutter/2))),j=o.f.div.withConfig({displayName:"FormSkeleton__TabButtonLabels",componentId:"sc-1xvkpmg-6"})(["flex:0 0 calc( 100% - "," );display:flex;flex-flow:column nowrap;justify-content:space-between;align-items:flex-start;"],(e=>Object(r.n)(e.theme.gutter/2+e.theme.fz.large3)));function v(){const e=Object(o.h)();return Object(u.jsxs)(p,{children:[Object(u.jsx)(g,{children:Object(u.jsx)(s.b.Avatar,{height:e.fz.large3,color:"darker"})}),Object(u.jsxs)(j,{children:[Object(u.jsx)(s.b,{height:e.fz.large1,shape:"rectangle",width:"50px",marginBottom:.25*e.gutter,color:"darker"}),Object(u.jsx)(s.b,{height:e.fz.small2,shape:"rectangle",width:"90px",color:"darker"})]})]})}const O=[{title:48,subtitle:68},{title:33,subtitle:68},{title:36,subtitle:68},{title:31,subtitle:62},{title:29,subtitle:61},{title:36,subtitle:61},{title:36,subtitle:51},{title:21,subtitle:57},{title:32,subtitle:56},{title:33,subtitle:59},{title:24,subtitle:58},{title:37,subtitle:52},{title:22,subtitle:60},{title:21,subtitle:54},{title:29,subtitle:59},{title:25,subtitle:56},{title:37,subtitle:55},{title:38,subtitle:63},{title:43,subtitle:68},{title:49,subtitle:53}],y=[[172,128,140,149],[197,167,74,137],[145,108,140,166],[178,101,108,148],[140,194,114,105],[138,123,170,115],[148,107,129,165],[129,192,140,137],[109,186,175,81],[87,166,68,154],[194,199,110,193],[133,75,93,86],[114,108,173,82],[154,126,98,110],[168,196,183,106],[92,147,170,178],[92,144,138,70],[112,119,149,116],[172,187,114,162],[153,107,150,153]];function w(e){const t=e.widthSet,n=y[t%y.length-1];return Object(u.jsxs)(l.a,{columns:c.s.ONE,controlAlignment:c.B.LEFT,children:[Object(u.jsx)(l.a.Item,{children:Object(u.jsx)(s.b.MCQOption,{type:"radio",width:n[0]})}),Object(u.jsx)(l.a.Item,{children:Object(u.jsx)(s.b.MCQOption,{type:"radio",width:n[1]})})]})}function x(e){const t=e.widthSet,n=y[t%y.length-1];return Object(u.jsxs)(l.a,{columns:c.s.ONE,controlAlignment:c.B.LEFT,children:[Object(u.jsx)(l.a.Item,{children:Object(u.jsx)(s.b.MCQOption,{type:"checkbox",width:n[0]})}),Object(u.jsx)(l.a.Item,{children:Object(u.jsx)(s.b.MCQOption,{type:"checkbox",width:n[1]})}),Object(u.jsx)(l.a.Item,{children:Object(u.jsx)(s.b.MCQOption,{type:"checkbox",width:n[2]})}),Object(u.jsx)(l.a.Item,{children:Object(u.jsx)(s.b.MCQOption,{type:"checkbox",width:n[3]})})]})}function C(e){const t=e.widthSet,n=O[t%O.length-1],o=n.title,i=n.subtitle;return Object(u.jsx)(s.b.Label,{titleWidth:`${o}%`,subtitleWidth:`${i}%`})}function k(e){const t=e.type,n=e.widthSet;return Object(u.jsx)(a.a.Item,{columnSize:c.J.FULL,widths:[],children:Object(u.jsxs)(a.a.Gutter,{children:[Object(u.jsx)(C,{widthSet:n}),"checkbox"===t?Object(u.jsx)(x,{widthSet:n}):"radio"===t?Object(u.jsx)(w,{widthSet:n}):"input"===t?Object(u.jsx)(s.b.Text,{}):Object(u.jsx)(s.b.Textarea,{})]})})}function S(e){const t=e.panels,n=void 0===t?3:t,o=[];if(n>=1)for(let e=0;e<n;e++)o.push(Object(u.jsx)(v,{},e));else o.push(Object(u.jsx)(v,{},"1"));return Object(u.jsx)(f,{children:Object(u.jsx)(b,{children:o})})}function _(e){const t=e.controls,n=void 0===t?5:t,o=[];return n<1&&o.push(Object(u.jsx)(k,{widthSet:1,type:"radio"},"0")),n>=1&&o.push(Object(u.jsx)(k,{widthSet:1,type:"radio"},"1")),n>=2&&o.push(Object(u.jsx)(k,{widthSet:2,type:"input"},"2")),n>=3&&o.push(Object(u.jsx)(k,{widthSet:3,type:"checkbox"},"3")),n>=4&&o.push(Object(u.jsx)(k,{widthSet:4,type:"textarea"},"4")),n>=5&&o.push(Object(u.jsx)(k,{widthSet:5,type:"radio"},"5")),Object(u.jsx)(u.Fragment,{children:o})}const F=o.f.div.withConfig({displayName:"FormSkeleton__SkeletonTabsPanelContainer",componentId:"sc-1xvkpmg-7"})(["background-color:",";border-bottom-left-radius:",";border-bottom-right-radius:",";"],(e=>e.theme.appBackgroundColor),(e=>Object(r.n)(e.theme.borderRadiusBase)),(e=>Object(r.n)(e.theme.borderRadiusBase)));function E({panels:e=3,controls:t=5,hasEditHeader:n=!1}){return Object(u.jsxs)(m,{className:"wpeform-component-formskeleton",children:[n?Object(u.jsx)(d.a.PreviewToolbar,{}):null,Object(u.jsxs)(h,{children:[Object(u.jsx)(S,{panels:e}),Object(u.jsx)(F,{children:Object(u.jsx)(a.a,{children:Object(u.jsx)(_,{controls:Math.max(2,t)})})})]})]})}E.FormControl=k},1098:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));var o=n(0);function i(e){return o.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),o.createElement("path",{d:"M492 241c11.047 0 20-8.953 20-20v-61c0-44.113-35.887-80-80-80H160c-44.113 0-80 35.887-80 80v272c0 44.113 35.887 80 80 80h201.516c5.32 0 10.421-2.121 14.175-5.89l130.485-131.114A19.993 19.993 0 00512 360.891V321c0-11.047-8.953-20-20-20s-20 8.953-20 20v19.89h-60.11c-38.6 0-70 31.4-70 70V472H160c-22.055 0-40-17.945-40-40V160c0-22.055 17.945-40 40-40h272c22.055 0 40 17.945 40 40v61c0 11.047 8.953 20 20 20zm-80.11 139.89h31.989l-61.988 62.286V410.89c0-16.543 13.457-30 30-30zM80 40c-22.055 0-40 17.945-40 40v313c0 11.047-8.953 20-20 20s-20-8.953-20-20V80C0 35.887 35.887 0 80 0h312c11.047 0 20 8.953 20 20s-8.953 20-20 20H80zm331 160c0 11.047-8.953 20-20 20H200c-11.047 0-20-8.953-20-20s8.953-20 20-20h191c11.047 0 20 8.953 20 20zm-20 100H200c-11.047 0-20-8.953-20-20s8.953-20 20-20h191c11.047 0 20 8.953 20 20s-8.953 20-20 20zm-110 40c11.047 0 20 8.953 20 20s-8.953 20-20 20h-81c-11.047 0-20-8.953-20-20s8.953-20 20-20h81z"}))}n.p},1100:function(e,t,n){"use strict";n.d(t,"b",(function(){return i})),n.d(t,"a",(function(){return s}));var o=n(1189);const i=o.a`
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
`,s=o.a`
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
`},1107:function(e,t,n){"use strict";n.d(t,"a",(function(){return i})),n.d(t,"b",(function(){return s}));n(8);var o=n(88);n(108);function i(e,t){const n=!!o.wpEFormElementFrontCollection.hasItem(e.type)&&o.wpEFormElementFrontCollection.getItem(e.type);return!!n&&(!!n.getAnswerValue&&n.getAnswerValue(e,t))}function s(e,t){const n=!!o.wpEFormElementFrontCollection.hasItem(e.type)&&o.wpEFormElementFrontCollection.getItem(e.type);return!!n&&(!!n.getDisplayValue&&n.getDisplayValue(e,t))}},1119:function(e,t,n){"use strict";n.d(t,"a",(function(){return ge}));var o=n(0),i=n(1129),s=n(3),r=n(8),a=n(1189),c=n(1094),l=n(1063);const d=a.a`
	query SubmissionWithForm($id: ID, $token: ID) {
		submission(id: $id, token: $token) {
			id
			form {
				...FFormForSubmission
			}
			fName
			lName
			email
			phone
			elements {
				id
				conditionallyHidden
				scores {
					has
					obtained
					outof
					scoreId
				}
				value {
					...FAllElementSubmission
				}
			}
			ip
			score
			maxScore
			scoreData {
				scoreId
				has
				obtained
				outof
			}
			urlTrack
			created
			lastUpdated
			adminRemarks
			user {
				id
				firstName
				lastName
				email
				username
			}
			referer
			paid
			time
			token
			submissionLink
			downloadLink
			printLink
			paymentData
			canUserEdit
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
	${c.b}
	${l.a}
`;a.a`
	query UserPortalData {
		me {
			averageScore
			email
			firstName
			id
			lastName
			logoutLink
			submissionsCount
			username
			avatarUrl
		}
		submissionMeta(asAdmin: false, resourceView: OWNED) {
			forms {
				formId
				formName
				total
			}
			categories {
				id
				title
				total
			}
		}
	}
`,a.a`
	query UserPortalSubmissionsData(
		$pagination: PaginationInput!
		$filter: SubmissionFilterInput!
	) {
		submissions(pagination: $pagination, filter: $filter) {
			totalCount
			edges {
				node {
					adminRemarks
					canUserEdit
					created
					elements {
						conditionallyHidden
						id
						scores {
							has
							obtained
							outof
							scoreId
						}
						value {
							...FAllElementSubmission
						}
					}
					email
					fName
					formId
					formName
					id
					ip
					lastUpdated
					lName
					maxScore
					paid
					paymentData
					percentageScore
					phone
					referer
					score
					submissionLink
					downloadLink
					time
					token
					urlTrack
					scoreData {
						has
						obtained
						outof
						scoreId
					}
				}
			}
		}
	}
	${l.a}
`;var u=n(1069),m=n(1093),h=n(1039),f=n(1095),b=n(1070),p=n(441),g=n(1043),j=n(15),v=n(1173),O=n(216),y=(n(199),n(120)),w=(n(108),n(88)),x=n(21),C=n(1);const k=Object(o.createContext)({__typename:"SubmissionType",adminRemarks:"",created:"",elements:[],email:"",fName:"",form:{__typename:"FormType",conditionals:[],elements:[],id:"",limitations:[],name:"",notices:[],pools:[],structures:[],styles:null,settings:null},id:"",ip:"",lName:"",lastUpdated:"",maxScore:0,paid:!1,paymentData:"",phone:"",referer:"",score:0,scoreData:[],submissionLink:"",time:0,token:"",urlTrack:"",user:null,canUserEdit:!1,downloadLink:null,printLink:null});function S(e,t=!0){return Object(o.useMemo)((()=>{if(!e)return[{},{}];const n=e.formMeta,o=e.submission;if(!o)return[{},{}];const i=o.form.elements.map((e=>{var t;return{...e,config:null!==(t=e.config)&&void 0!==t?t:{}}})),s=Object(y.b)(i),r=o.elements.map((e=>{var n,o;const i={errors:[],touched:!1,type:null!==(n=null===(o=s[e.id])||void 0===o?void 0:o.type)&&void 0!==n?n:"unknown",...e};return t&&(i.conditionallyHidden=!1),i})),a=Object(x.m)(Object(y.b)(r),"__typename"),c=Object.keys(s);c.forEach((e=>{const t=s[e];if(!a[t.id]&&n){const e=t.type;var o;if(w.wpEFormElementFrontCollection.hasItem(e))a[t.id]={conditionallyHidden:(null===(o=t.appearance)||void 0===o?void 0:o.initiallyHidden)||!1,id:t.id,type:e,touched:!1,scores:[],...Object(O.g)(n,t,!1)}}}));return Object.keys(a).forEach((e=>{c.includes(e)||delete a[e]})),[a,s]}),[e,t])}function _(){return Object(o.useContext)(k)}const F=Object(o.createContext)({});function E(){return Object(o.useContext)(F)}const T=Object(o.createContext)({});function I(){return Object(o.useContext)(T)}function M(e){const t=e.submissionWithFormData,n=e.children,o=S(t,!1),i=Object(j.a)(o,2),s=i[0],r=i[1];return Object(C.jsx)(k.Provider,{value:t.submission,children:Object(C.jsx)(F.Provider,{value:r,children:Object(C.jsx)(T.Provider,{value:s,children:n})})})}var P=n(1100);const L=a.a`
	mutation UpdateSubmission(
		$id: ID
		$token: ID
		$data: SubmissionInput!
		$remarks: String
	) {
		updateSubmission(data: $data, id: $id, token: $token, remarks: $remarks) {
			...FSubmissionData
		}
	}
	${P.b}
`;var B=n(1042),A=n(1087),N=n(7),D=n(1090),R=n.n(D),H=n(2),z=n(18);const $=N.f.header.withConfig({displayName:"CancelEditHeader__Container",componentId:"sc-1bkxsiw-0"})(["",";margin:0 0 "," 0;padding:"," 0;border-bottom:2px solid ",";display:flex;align-items:center;justify-content:flex-start;"],H.b,(e=>Object(H.n)(e.theme.gutter)),(e=>Object(H.n)(e.theme.gutter/2)),(e=>e.theme.borderColorBase)),q=N.f.button.withConfig({displayName:"CancelEditHeader__CancelButton",componentId:"sc-1bkxsiw-1"})(["margin:0 0 0 auto;border:0 none;cursor:pointer;background-color:",";height:",";width:",";padding:0;display:flex;align-items:center;justify-content:center;font-size:",";border-radius:",";color:",";outline:none;transition:",";&:hover,&:focus{color:",";background-color:",";}&:active{color:",";background-color:",";}"],(e=>e.theme.appBackgroundColor),(e=>Object(H.n)(.8*e.theme.controlHeightBase)),(e=>Object(H.n)(.8*e.theme.controlHeightBase)),(e=>Object(H.n)(.35*e.theme.controlHeightBase)),(e=>Object(H.n)(e.theme.borderRadiusBase)),(e=>e.theme.textColorSecondary),(e=>Object(H.f)(["background-color","color"],e.theme.transitionControl)),(e=>e.theme.textColor),(e=>e.theme.backgroundHover),(e=>e.theme.textColor),(e=>e.theme.backgroundControl)),V=N.f.h4.withConfig({displayName:"CancelEditHeader__Heading",componentId:"sc-1bkxsiw-2"})(["font-family:",";line-height:1.5;margin:0;padding:0;width:calc( 100% - "," );font-size:",";color:",";margin:0;padding:0;font-weight:normal;strong{color:",";font-weight:bold;}"],(e=>e.theme.fontFamilyHeading),(e=>Object(H.n)(.8*e.theme.controlHeightBase+4)),(e=>Object(H.n)(e.theme.fz.base)),(e=>e.theme.textColorSecondary),(e=>e.theme.headingColor));function W(e){const t=e.onUserCancelEdit,n=e.submissionWithFormData,o=Object(s._x)("Editing submission on %%FORM%%","wpeform-useredit-heading","wp-eform"),i=R()(o,/%%([^%%]+)%%/,((e,t)=>{var o,i;switch(e){case"TOKEN":return Object(C.jsx)("strong",{children:null===(o=n.submission)||void 0===o?void 0:o.token},t);case"FORM":return Object(C.jsx)("strong",{children:null===(i=n.submission)||void 0===i?void 0:i.form.name},t);default:return Object(C.jsxs)("span",{children:["%%",e,"%%"]},t)}}));return Object(C.jsxs)($,{className:"wpeform-useredit-header",children:[Object(C.jsx)(V,{children:i}),Object(C.jsx)(q,{type:"button",onClick:e=>{e.preventDefault(),t&&t()},title:Object(s.__)("Cancel edit","wp-eform"),children:Object(C.jsx)(z.b,{"aria-label":Object(s.__)("Cancel edit","wp-eform"),iconClass:"fas fa-times"})})]})}function U(e){var t,n,i,r,a,c;const l=e.mode,d=e.submissionWithFormData,m=e.onAfterEdit,f=e.onUserCancelEdit,b=Object(v.a)(L,{fetchPolicy:"no-cache"}),p=Object(j.a)(b,2),g=p[0],y=p[1],w=Object(o.useCallback)(((e,t,n)=>{var o,i,s,r;return g({variables:{data:{elements:e,formId:null!==(o=null==d||null===(i=d.submission)||void 0===i?void 0:i.form.id)&&void 0!==o?o:"0",time:"adminedit"===l?void 0:t},id:"adminedit"===l?null==d||null===(s=d.submission)||void 0===s?void 0:s.id:void 0,token:"adminedit"!==l?null==d||null===(r=d.submission)||void 0===r?void 0:r.token:void 0,remarks:"adminedit"===l?n:void 0}}).then((e=>("adminedit"===l&&Object(B.a)(),m&&m(),e)))}),[l,null==d||null===(t=d.submission)||void 0===t?void 0:t.form.id,null==d||null===(n=d.submission)||void 0===n?void 0:n.id,null==d||null===(i=d.submission)||void 0===i?void 0:i.token,g,m]),x=Object(o.useMemo)((()=>{var e;return null!=d&&null!==(e=d.submission)&&void 0!==e&&e.form?Object(O.b)({form:d.submission.form,formMeta:d.formMeta}):null}),[d]),k=Object(O.j)(w,x,!0),_=k.submitting,F=k.submitted,E=k.reset,T=k.submit,I=k.submittedState,M=S(d),P=Object(j.a)(M,1)[0],N=Object(o.useMemo)((()=>Object.keys(P).length&&null!=d&&d.submission?{structures:{},currentPage:null!=x&&x.structures&&x.structures.length?x.structures[0].id:"",startTime:Date.now(),formId:d.submission.form.id,elements:P,remarks:d.submission.adminRemarks}:O.c),[P,d,null==x?void 0:x.structures]),D=Object(h.c)(null==d||null===(r=d.submission)||void 0===r?void 0:r.form.styles);return null!=d&&d.submission&&d.formMeta?"useredit"!==l||d.submission.canUserEdit?Object(C.jsx)(A.a,{initialData:N,formData:x,formMeta:d.formMeta,mode:l,submitting:_,submitted:F,submittedState:I,onReset:E,onSubmit:T,submissionError:y&&y.error?y.error:void 0,mutationData:null!==(a=null===(c=y.data)||void 0===c?void 0:c.updateSubmission)&&void 0!==a?a:void 0,onErrorRetry:E,formHeader:"useredit"===l&&f?Object(C.jsx)(W,{submissionWithFormData:d,onUserCancelEdit:f}):null}):Object(C.jsx)(u.a,{title:Object(s.__)("You cannot edit the submission","wp-eform"),type:"403",retry:f,retryLabel:Object(s.__)("GO BACK TO PREVIEW","wp-eform"),hideReload:!0,themeStyle:D,children:Object(C.jsx)("p",{children:Object(s.__)("It is not possible to edit this submission. Only managers can make changes to the data. If you think this is a mistake, kindly contact the site administrator.","wp-eform")})}):Object(C.jsx)(u.a,{themeStyle:D,title:Object(s.__)("Could not get submission data","wp-eform"),children:Object(C.jsx)("p",{children:Object(s.__)("There was some problem retrieving submission. Please reload the page and try again.","wp-eform")})})}var K=n(1036),Y=(n(281),n(34));function G(e){const t=e.children,n=_(),i=E(),s=I(),r=Object(o.useMemo)((()=>({"::fName::":n.fName,"::lName::":n.lName,"::email::":n.email,"::phone::":n.phone})),[n]),a=Object(o.useCallback)((e=>{var t;return Object(Y.i)(e,s,i,r,null===(t=n.form.settings)||void 0===t?void 0:t.score,n.scoreData)}),[i,s,r,n]),c=Object(o.useMemo)((()=>{const e={};return e["%FORM_LINK%"]=window.location.href,n.submissionLink&&(e["%SUBMISSION_LINK%"]=n.submissionLink),e}),[n]);return Object(C.jsx)(Y.c,{mentions:a,children:Object(C.jsx)(Y.b,{dynamicAnchors:c,children:t})})}var Q=n(361);const X=N.f.header.withConfig({displayName:"PreviewHeader__Container",componentId:"sc-1tyk7ac-0"})(["color:",";padding:"," 0;border-bottom:2px solid ",";margin:0 0 "," 0;display:flex;align-items:center;flex-flow:row wrap;"],(e=>e.theme.textColorSecondary),(e=>Object(H.n)(e.theme.gutter/2)),(e=>e.theme.borderColorBase),(e=>Object(H.n)(e.theme.gutter))),Z=N.f.h4.withConfig({displayName:"PreviewHeader__DateHeading",componentId:"sc-1tyk7ac-1"})(["font-size:",";color:",";margin:0;padding:0;font-weight:bold;span{color:",";font-weight:normal;}flex:0 0 auto;"],(e=>Object(H.n)(e.theme.fz.base)),(e=>e.theme.headingColor),(e=>e.theme.textColorSecondary)),J=N.f.aside.withConfig({displayName:"PreviewHeader__Controls",componentId:"sc-1tyk7ac-2"})(["margin:0 0 0 auto;display:flex;align-items:center;justify-content:center;@media print{display:none;}button{margin:0 2px;border:0 none;cursor:pointer;background-color:",";height:",";width:",";padding:0;display:flex;align-items:center;justify-content:center;font-size:",";border-radius:",";color:",";outline:none;transition:",";&:hover,&:focus{color:",";background-color:",";}&:active{color:",";background-color:",";}}"],(e=>e.theme.appBackgroundColor),(e=>Object(H.n)(.8*e.theme.controlHeightBase)),(e=>Object(H.n)(.8*e.theme.controlHeightBase)),(e=>Object(H.n)(.35*e.theme.controlHeightBase)),(e=>Object(H.n)(e.theme.borderRadiusBase)),(e=>e.theme.textColorSecondary),(e=>Object(H.f)(["background-color","color"],e.theme.transitionControl)),(e=>e.theme.textColor),(e=>e.theme.backgroundHover),(e=>e.theme.textColor),(e=>e.theme.backgroundControl));function ee({mode:e,canUserEdit:t,onUserEdit:n,printLink:o,downloadLink:i}){const r=_(),a=Q.e.utc(r.created,Q.g).local();return Object(C.jsxs)(X,{children:[Object(C.jsxs)(Z,{children:[a.format(Q.b)," ",Object(C.jsxs)("span",{children:[Object(s.__)("at","wp-eform")," ",a.format(Q.d)]})]}),Object(C.jsxs)(J,{children:[o?Object(C.jsx)("button",{title:Object(s.__)("Print submission","wp-eform"),type:"button",onClick:e=>{e.preventDefault();const t=window.open(o,"popup","width=600px&height=600px");t&&t.addEventListener("load",(()=>{t.print()}),!1)},children:Object(C.jsx)(z.b,{iconClass:"fas fa-print","aria-label":Object(s.__)("Print Submission","wp-eform")})}):null,i?Object(C.jsx)("button",{title:Object(s.__)("Download submission as PDF","wp-eform"),onClick:e=>{e.preventDefault(),window.open(i,"_blank")},type:"button",children:Object(C.jsx)(z.b,{iconClass:"fas fa-file-download","aria-label":Object(s.__)("Download submission as PDF","wp-eform")})}):null,"user"===e&&t?Object(C.jsx)("button",{title:Object(s.__)("Edit Submission","wp-eform"),onClick:e=>{e.preventDefault(),n&&n()},type:"button",children:Object(C.jsx)(z.b,{iconClass:"fas fa-edit","aria-label":Object(s.__)("Edit Submission","wp-eform")})}):null]})]})}var te=n(36),ne=n(1041);const oe=N.f.div.withConfig({displayName:"Metadata__Container",componentId:"sc-n1sjbx-0"})(["margin:0 0 "," 0;background-color:",";padding:",";border-radius:",";table{border-collapse:collapse;border:0 none;margin:0;padding:0;vertical-align:top;tr,td,th{border:0 none;vertical-align:top;}td,th{padding:",";color:",";font-size:",";text-align:left;}th{font-weight:bold;min-width:120px;@media screen and (min-width:768px){min-width:170px;}}td{width:calc(100% - 120px);@media screen and (min-width:768px){width:calc(100% - 170px);}",";}code{font-family:",";background-color:transparent;padding:0;margin:0;}a{color:",";text-decoration:underline;",";&:hover{text-decoration:none;}}}"],(e=>Object(H.n)(e.theme.gutter)),(e=>e.theme.backgroundShade),(e=>Object(H.n)(.75*e.theme.gutter)),(e=>Object(H.n)(e.theme.borderRadiusBase)),(e=>Object(H.n)(e.theme.gutter/4)),(e=>e.theme.textColor),(e=>Object(H.n)(e.theme.fz.base)),H.m,(e=>e.theme.fontFamilyMono),(e=>e.theme.linkColor),H.m),ie=N.f.div.withConfig({displayName:"Metadata__UserInput",componentId:"sc-n1sjbx-1"})(["",";margin:0;padding:0;"],H.v);function se(){var e,t,n,o,i,r;const a=_(),c=Q.e.utc(a.created).local(),l=a.lastUpdated;return Object(C.jsx)(oe,{children:Object(C.jsx)("table",{children:Object(C.jsxs)("tbody",{children:[Object(C.jsxs)("tr",{children:[Object(C.jsx)("th",{children:Object(s.__)("Form","wp-eform")}),Object(C.jsx)("td",{children:a.form.name})]}),Object(C.jsxs)("tr",{children:[Object(C.jsx)("th",{children:Object(s.__)("Submission Id","wp-eform")}),Object(C.jsx)("td",{children:Object(C.jsx)("code",{children:a.token})})]}),Object(C.jsxs)("tr",{children:[Object(C.jsx)("th",{children:Object(s.__)("Created On","wp-eform")}),Object(C.jsx)("td",{children:c.format(Q.c)})]}),l&&l!==Q.f?Object(C.jsxs)("tr",{children:[Object(C.jsx)("th",{children:Object(s.__)("Updated On","wp-eform")}),Object(C.jsx)("td",{children:Q.e.utc(l).local().format(Q.c)})]}):null,(a.score||a.maxScore)&&null!==(e=a.form.settings)&&void 0!==e&&null!==(t=e.score)&&void 0!==t&&t.scoreLists.length?Object(C.jsxs)("tr",{children:[Object(C.jsx)("th",{children:Object(C.jsx)(Y.f,{nodes:Object(Y.g)(a.form.settings.score.scoreLists[0].outcomeName),mode:"singleline"})}),Object(C.jsx)("td",{children:Object(s.sprintf)(Object(s._x)("%s / %s","submission-summary-score","wp-eform"),Object(te.a)(null!==(n=a.score)&&void 0!==n?n:0,null!==(o=a.form.settings.score.precision)&&void 0!==o?o:2),Object(te.a)(null!==(i=a.maxScore)&&void 0!==i?i:0,null!==(r=a.form.settings.score.precision)&&void 0!==r?r:2))})]}):null,a.submissionLink?Object(C.jsxs)("tr",{children:[Object(C.jsx)("th",{children:Object(s.__)("Record","wp-eform")}),Object(C.jsx)("td",{children:Object(C.jsx)("a",{href:a.submissionLink,children:a.submissionLink})})]}):null,a.adminRemarks?Object(C.jsxs)("tr",{children:[Object(C.jsx)("th",{children:Object(s.__)("Remarks","wp-eform")}),Object(C.jsx)("td",{children:Object(C.jsx)(ie,{children:a.adminRemarks})})]}):null,a.time?Object(C.jsxs)("tr",{children:[Object(C.jsx)("th",{children:Object(s.__)("Duration","wp-eform")}),Object(C.jsx)("td",{children:Object(ne.a)(a.time)})]}):null]})})})}var re=n(1107),ae=n(86);const ce=Object(o.createContext)({scores:[],precision:2});function le(e){var t,n,i,s,r;const a=e.children,c=_(),l=null===(t=c.form.settings)||void 0===t||null===(n=t.score)||void 0===n?void 0:n.scoreLists,d=null!==(i=null===(s=c.form.settings)||void 0===s||null===(r=s.score)||void 0===r?void 0:r.precision)&&void 0!==i?i:2,u=Object(o.useMemo)((()=>{const e=l?l.map((e=>{const t=Object(Y.g)(e.outcomeDescription);return{scoreId:e.id,title:Object(C.jsx)(Y.f,{nodes:Object(Y.g)(e.outcomeName),mode:"singleline"}),description:Object(Y.k)(t)?void 0:Object(C.jsx)(Y.f,{nodes:t,mode:"multiline"})}})):[];return{precision:d,scores:e}}),[l,d]);return Object(C.jsx)(ce.Provider,{value:u,children:a})}function de(e){var t,n,i;const s=e.element,r=e.submission,a=Object(Y.l)(null===(t=s.appearance)||void 0===t?void 0:t.answerDescription),c=Object(o.useContext)(ce),l=[];c.scores.forEach((e=>{const t=r.scores.find((t=>t.scoreId===e.scoreId));t&&t.has&&l.push({scoreId:e.scoreId,obtained:t.obtained,outof:t.outof,title:e.title,description:e.description})}));const d=Object(re.a)(s,r.value);if(!1===d)return null;const u=Object(Y.g)(null===(n=s.appearance)||void 0===n?void 0:n.subtitle);return Object(C.jsx)(ae.a,{title:Object(C.jsx)(Y.f,{nodes:Object(Y.g)(null===(i=s.appearance)||void 0===i?void 0:i.title),mode:"singleline"}),subtitle:Object(Y.k)(u)?void 0:Object(C.jsx)(Y.f,{nodes:u,mode:"singleline"}),answerDescription:a?Object(C.jsx)(Y.f,{nodes:a,mode:"multiline"}):void 0,answer:d,scorePrecision:c.precision,scores:l})}const ue=N.f.h2.withConfig({displayName:"PagePreview__Heading",componentId:"sc-srmz56-0"})(["",";font-size:",";color:",";font-weight:bold;font-family:",";margin:0 0 "," 0;padding:0 0 "," 0;border-bottom:2px solid ",";text-transform:uppercase;@media print{break-after:avoid;}"],H.b,(e=>Object(H.n)(e.theme.fz.small1)),(e=>e.theme.textColorSecondary),(e=>e.theme.fontFamilyHeading),(e=>Object(H.n)(e.theme.gutter)),(e=>Object(H.n)(e.theme.gutter/3)),(e=>e.theme.borderColorSplit)),me=N.f.section.withConfig({displayName:"PagePreview__Container",componentId:"sc-srmz56-1"})(["",";margin:0 0 "," 0;"],H.b,(e=>Object(H.n)(e.theme.gutter)));function he(e){const t=e.currentPage,n=t.config.title,o=Object(Y.l)(n),i=E(),s=I(),r=Object(O.f)(t,i,s).filter((e=>{const t=i[e],n=w.wpEFormElementFrontCollection.hasItem(t.type)?w.wpEFormElementFrontCollection.getItem(t.type):null;return!!n&&!!n.getAnswerValue}));return r.length?Object(C.jsxs)(me,{children:[o?Object(C.jsx)(ue,{children:Object(C.jsx)(Y.f,{nodes:o,mode:"singleline"})}):null,r.map((e=>Object(C.jsx)(de,{element:i[e],submission:s[e]},e)))]}):null}var fe=n(1078);n(1065),n(29),n(127),n(33),n(1091);N.f.h5.withConfig({displayName:"ScoreData__DesignationHeading",componentId:"sc-kuwa45-0"})(["color:",";font-size:",";font-weight:bold;margin:0 0 "," 0;"],(e=>e.theme.headingColor),(e=>Object(H.n)(e.theme.fz.base)),(e=>Object(H.n)(.5*e.theme.gutter))),N.f.div.withConfig({displayName:"ScoreData__DesignationDescription",componentId:"sc-kuwa45-1"})(["color:",";font-size:",";margin:0 0 "," 0;padding:0 0 "," 0;border-bottom:1px dashed ",";&:last-child{border-bottom:0 none;margin-bottom:0;padding-bottom:0;}"],(e=>e.theme.textColor),(e=>Object(H.n)(e.theme.fz.base)),(e=>Object(H.n)(e.theme.gutter)),(e=>Object(H.n)(e.theme.gutter)),(e=>e.theme.borderColorLight)),N.f.div.withConfig({displayName:"ScoreData__Container",componentId:"sc-kuwa45-2"})(["background-color:",";margin:0 0 "," 0;"],(e=>e.theme.appBackgroundColor),(e=>Object(H.n)(e.theme.gutter)));function be(e){var t,n;const o=e.submissionWithFormData,i=e.mode,a=e.onUserEdit,c=Object(K.c)(null==o||null===(t=o.submission)||void 0===t?void 0:t.form.styles);if(null==o||!o.submission)return Object(C.jsx)(u.a,{title:Object(s.__)("Could not get submission data","wp-eform"),children:Object(C.jsx)("p",{children:Object(s.__)("There was some problem retrieving submission. Please reload the page and try again.","wp-eform")})});return Object(C.jsx)(M,{submissionWithFormData:o,children:Object(C.jsx)(G,{children:Object(C.jsx)(le,{children:Object(C.jsx)(K.a,{themeStyle:c,mode:"live",widthOverride:"768px",containerLayoutOverride:r.A.FLUID,children:Object(C.jsxs)(fe.a,{children:[Object(C.jsx)(ee,{mode:i,canUserEdit:null!==(n=o.submission.canUserEdit)&&void 0!==n&&n,onUserEdit:a,downloadLink:o.submission.downloadLink,printLink:o.submission.printLink}),Object(C.jsx)(se,{}),null,o.submission.form.structures.map((e=>Object(C.jsx)(he,{currentPage:e},e.id)))]})})})})})}function pe(e){const t=e.data,n=e.mode,o=e.onUserEdit;return Object(C.jsx)(be,{submissionWithFormData:t,mode:n,onUserEdit:o})}function ge(e){const t=e.mode,n=e.id,a=void 0===n?null:n,c=e.token,l=void 0===c?null:c,j=e.panels,v=e.controls,O=e.themeStyle,y=e.onUserEdit,w=e.onUserCancelEdit,x=e.onAfterEdit,k=e.inShadow,S=void 0!==k&&k,_=e.cssHandles,F=void 0===_?[]:_,E=e.onReEnterSubmissionId,T=Object(i.b)(d,{fetchPolicy:"cache-first",variables:{id:a,token:l}}),I=T.data,M=T.loading,P=T.error,L=T.refetch,B=Object(o.useCallback)((()=>{L({id:a,token:l}),x&&x()}),[a,l,L,x]),A="userpreview"===t||"adminpreview"===t,N=Object(C.jsx)(g.a,{inShadow:S,cssHandles:F,children:Object(C.jsx)(h.a,{themeStyle:O,mode:"live",widthOverride:A?"768px":void 0,containerLayoutOverride:A?r.A.FLUID:void 0,children:"adminpreview"===t||"adminedit"===t?Object(C.jsx)(p.a,{}):A?Object(C.jsx)(b.a,{panels:j,controls:v}):Object(C.jsx)(f.a,{panels:j,controls:v,hasEditHeader:"useredit"===t})})});return P?Object(C.jsx)(g.a,{inShadow:S,cssHandles:F,children:Object(C.jsx)(u.a,{themeStyle:O,retry:null!=E?E:B,error:P,title:Object(s.__)("The submission could not be found","wp-eform"),widthOverride:"768px",retryLabel:E?Object(s.__)("RE ENTER SUBMISSION ID","wp-eform"):Object(s.__)("RETRY WITHOUT RELOAD","wp-eform"),children:Object(C.jsx)("p",{children:Object(s.__)("There was an error trying to fetch submission data from the server. Try refreshing the page to see if that resolves it.","wp-eform")})})}):M&&!I?N:Object(C.jsx)(g.a,{inShadow:S,cssHandles:F,children:Object(C.jsx)(m.a,{themeStyle:O,children:A?Object(C.jsx)(pe,{data:I,mode:"userpreview"===t?"user":"admin",onUserEdit:y}):Object(C.jsx)(U,{submissionWithFormData:I,mode:"adminedit"===t?"adminedit":"useredit",onAfterEdit:B,onUserCancelEdit:w})})})}},1160:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return u}));n(0);var o=n(3),i=n(18),s=n(440),r=n(1044),a=n(1119),c=n(1098),l=n(1038),d=n(1);function u(e){const t=e.match.params.submissionId;return Object(d.jsxs)(d.Fragment,{children:[Object(d.jsx)(r.a,{title:Object(o.__)("Edit Submission","wp-eform"),backLink:"/submissions",controlRight:Object(d.jsx)(l.b,{to:`/submissions/view/${t}`,type:"dashed",size:"small",icon:Object(d.jsx)(i.b,{component:c.a}),children:Object(o.__)("PREVIEW","wp-eform")})}),Object(d.jsx)(s.a,{children:Object(d.jsx)(a.a,{mode:"adminedit",id:t})})]})}}}]);
//# sourceMappingURL=15-852aacc5.js.map