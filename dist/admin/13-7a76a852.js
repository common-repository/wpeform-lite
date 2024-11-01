/*! For license information please see 13-7a76a852.js.LICENSE.txt */
(window.wpackiowpqEformadminJsonp=window.wpackiowpqEformadminJsonp||[]).push([[13,5],{1034:function(e,t,n){"use strict";n.d(t,"a",(function(){return W})),n.d(t,"b",(function(){return U})),n.d(t,"c",(function(){return B})),n.d(t,"d",(function(){return s})),n.d(t,"e",(function(){return r})),n.d(t,"f",(function(){return O})),n.d(t,"g",(function(){return k})),n.d(t,"h",(function(){return u})),n.d(t,"i",(function(){return Y})),n.d(t,"j",(function(){return J})),n.d(t,"k",(function(){return G})),n.d(t,"l",(function(){return p})),n.d(t,"m",(function(){return Q})),n.d(t,"n",(function(){return h})),n.d(t,"o",(function(){return K})),n.d(t,"p",(function(){return X})),n.d(t,"q",(function(){return b})),n.d(t,"r",(function(){return Z}));var i=n(6),o=n(1035);function r(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function a(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(e);t&&(i=i.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,i)}return n}function s(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?a(Object(n),!0).forEach((function(t){r(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):a(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}const c={pointer:{start:"down",change:"move",end:"up"},mouse:{start:"down",change:"move",end:"up"},touch:{start:"start",change:"move",end:"end"},gesture:{start:"start",change:"change",end:"end"}};function l(e){return e?e[0].toUpperCase()+e.slice(1):""}const d=["enter","leave"];function u(e,t="",n=!1){const i=c[e],o=i&&i[t]||t;return"on"+l(e)+l(o)+(function(e=!1,t){return e&&!d.includes(t)}(n,o)?"Capture":"")}const m=["gotpointercapture","lostpointercapture"];function h(e){let t=e.substring(2).toLowerCase();const n=!!~t.indexOf("passive");n&&(t=t.replace("passive",""));const i=m.includes(t)?"capturecapture":"capture",o=!!~t.indexOf(i);return o&&(t=t.replace("capture","")),{device:t,capture:o,passive:n}}function b(e,t=""){const n=c[e];return e+(n&&n[t]||t)}function p(e){return"touches"in e}function f(e){return p(e)?"touch":"pointerType"in e?e.pointerType:"mouse"}function g(e){return p(e)?function(e){return"touchend"===e.type||"touchcancel"===e.type?e.changedTouches:e.targetTouches}(e)[0]:e}function j(e,t){const n=t.clientX-e.clientX,i=t.clientY-e.clientY,o=(t.clientX+e.clientX)/2,r=(t.clientY+e.clientY)/2,a=Math.hypot(n,i);return{angle:-180*Math.atan2(n,i)/Math.PI,distance:a,origin:[o,r]}}function O(e){return function(e){return Array.from(e.touches).filter((t=>{var n,i;return t.target===e.currentTarget||(null===(n=e.currentTarget)||void 0===n||null===(i=n.contains)||void 0===i?void 0:i.call(n,t.target))}))}(e).map((e=>e.identifier))}function v(e,t){const n=Array.from(e.touches).filter((e=>t.includes(e.identifier))),o=Object(i.a)(n,2);return j(o[0],o[1])}function y(e){const t=g(e);return p(e)?t.identifier:t.pointerId}function w(e){const t=g(e);return[t.clientX,t.clientY]}function x(e){let t=e.deltaX,n=e.deltaY,i=e.deltaMode;return 1===i?(t*=40,n*=40):2===i&&(t*=800,n*=800),[t,n]}function C(e,...t){return"function"==typeof e?e(...t):e}function _(){}function k(...e){return 0===e.length?_:1===e.length?e[0]:function(){let t;for(const n of e)t=n.apply(this,arguments)||t;return t}}function S(e,t){return Object.assign({},t,e||{})}class E{constructor(e,t,n){this.ctrl=e,this.args=t,this.key=n,this.state||(this.state={},this.computeValues([0,0]),this.computeInitial(),this.init&&this.init(),this.reset())}get state(){return this.ctrl.state[this.key]}set state(e){this.ctrl.state[this.key]=e}get shared(){return this.ctrl.state.shared}get eventStore(){return this.ctrl.gestureEventStores[this.key]}get timeoutStore(){return this.ctrl.gestureTimeoutStores[this.key]}get config(){return this.ctrl.config[this.key]}get sharedConfig(){return this.ctrl.config.shared}get handler(){return this.ctrl.handlers[this.key]}reset(){const e=this.state,t=this.shared,n=this.ingKey,i=this.args;t[n]=e._active=e.active=e._blocked=e._force=!1,e._step=[!1,!1],e.intentional=!1,e._movement=[0,0],e._distance=[0,0],e._direction=[0,0],e._delta=[0,0],e._bounds=[[-1/0,1/0],[-1/0,1/0]],e.args=i,e.axis=void 0,e.memo=void 0,e.elapsedTime=0,e.direction=[0,0],e.distance=[0,0],e.overflow=[0,0],e._movementBound=[!1,!1],e.velocity=[0,0],e.movement=[0,0],e.delta=[0,0],e.timeStamp=0}start(e){const t=this.state,n=this.config;t._active||(this.reset(),this.computeInitial(),t._active=!0,t.target=e.target,t.currentTarget=e.currentTarget,t.lastOffset=n.from?C(n.from,t):t.offset,t.offset=t.lastOffset),t.startTime=t.timeStamp=e.timeStamp}computeValues(e){const t=this.state;t._values=e,t.values=this.config.transform(e)}computeInitial(){const e=this.state;e._initial=e._values,e.initial=e.values}compute(e){const t=this.state,n=this.config,r=this.shared;t.args=this.args;let a=0;if(e&&(t.event=e,n.preventDefault&&e.cancelable&&t.event.preventDefault(),t.type=e.type,r.touches=this.ctrl.pointerIds.size||this.ctrl.touchIds.size,r.locked=!!document.pointerLockElement,Object.assign(r,function(e){const t={};if("buttons"in e&&(t.buttons=e.buttons),"shiftKey"in e){const n=e.shiftKey,i=e.altKey,o=e.metaKey,r=e.ctrlKey;Object.assign(t,{shiftKey:n,altKey:i,metaKey:o,ctrlKey:r})}return t}(e)),r.down=r.pressed=r.buttons%2==1||r.touches>0,a=e.timeStamp-t.timeStamp,t.timeStamp=e.timeStamp,t.elapsedTime=t.timeStamp-t.startTime),t._active){const e=t._delta.map(Math.abs);o.a.addTo(t._distance,e)}this.axisIntent&&this.axisIntent(e);const s=Object(i.a)(t._movement,2),c=s[0],l=s[1],d=Object(i.a)(n.threshold,2),u=d[0],m=d[1],h=t._step,b=t.values;if(n.hasCustomTransform?(!1===h[0]&&(h[0]=Math.abs(c)>=u&&b[0]),!1===h[1]&&(h[1]=Math.abs(l)>=m&&b[1])):(!1===h[0]&&(h[0]=Math.abs(c)>=u&&Math.sign(c)*u),!1===h[1]&&(h[1]=Math.abs(l)>=m&&Math.sign(l)*m)),t.intentional=!1!==h[0]||!1!==h[1],!t.intentional)return;const p=[0,0];if(n.hasCustomTransform){const e=Object(i.a)(b,2),t=e[0],n=e[1];p[0]=!1!==h[0]?t-h[0]:0,p[1]=!1!==h[1]?n-h[1]:0}else p[0]=!1!==h[0]?c-h[0]:0,p[1]=!1!==h[1]?l-h[1]:0;this.restrictToAxis&&!t._blocked&&this.restrictToAxis(p);const f=t.offset,g=t._active&&!t._blocked||t.active;g&&(t.first=t._active&&!t.active,t.last=!t._active&&t.active,t.active=r[this.ingKey]=t._active,e&&(t.first&&("bounds"in n&&(t._bounds=C(n.bounds,t)),this.setup&&this.setup()),t.movement=p,this.computeOffset()));const j=Object(i.a)(t.offset,2),O=j[0],v=j[1],y=Object(i.a)(t._bounds,2),w=Object(i.a)(y[0],2),x=w[0],_=w[1],k=Object(i.a)(y[1],2),S=k[0],E=k[1];t.overflow=[O<x?-1:O>_?1:0,v<S?-1:v>E?1:0],t._movementBound[0]=!!t.overflow[0]&&(!1===t._movementBound[0]?t._movement[0]:t._movementBound[0]),t._movementBound[1]=!!t.overflow[1]&&(!1===t._movementBound[1]?t._movement[1]:t._movementBound[1]);const I=t._active&&n.rubberband||[0,0];if(t.offset=Object(o.b)(t._bounds,t.offset,I),t.delta=o.a.sub(t.offset,f),this.computeMovement(),g&&(!t.last||a>32)){t.delta=o.a.sub(t.offset,f);const e=t.delta.map(Math.abs);o.a.addTo(t.distance,e),t.direction=t.delta.map(Math.sign),t._direction=t._delta.map(Math.sign),!t.first&&a>0&&(t.velocity=[e[0]/a,e[1]/a])}}emit(){const e=this.state,t=this.shared,n=this.config;if(e._active||this.clean(),(e._blocked||!e.intentional)&&!e._force&&!n.triggerAllEvents)return;const i=this.handler(s(s(s({},t),e),{},{[this.aliasKey]:e.values}));void 0!==i&&(e.memo=i)}clean(){this.eventStore.clean(),this.timeoutStore.clean()}}class I extends E{constructor(...e){super(...e),r(this,"aliasKey","xy")}reset(){super.reset(),this.state.axis=void 0}init(){this.state.offset=[0,0],this.state.lastOffset=[0,0]}computeOffset(){this.state.offset=o.a.add(this.state.lastOffset,this.state.movement)}computeMovement(){this.state.movement=o.a.sub(this.state.offset,this.state.lastOffset)}axisIntent(e){const t=this.state,n=this.config;if(!t.axis&&e){const i="object"==typeof n.axisThreshold?n.axisThreshold[f(e)]:n.axisThreshold;t.axis=function([e,t],n){const i=Math.abs(e),o=Math.abs(t);return i>o&&i>n?"x":o>i&&o>n?"y":void 0}(t._movement,i)}t._blocked=(n.lockDirection||!!n.axis)&&!t.axis||!!n.axis&&n.axis!==t.axis}restrictToAxis(e){if(this.config.axis||this.config.lockDirection)switch(this.state.axis){case"x":e[1]=0;break;case"y":e[0]=0}}}const T=e=>e,F={enabled:(e=!0)=>e,eventOptions:(e,t,n)=>s(s({},n.shared.eventOptions),e),preventDefault:(e=!1)=>e,triggerAllEvents:(e=!1)=>e,rubberband(e=0){switch(e){case!0:return[.15,.15];case!1:return[0,0];default:return o.a.toVector(e)}},from:e=>"function"==typeof e?e:null!=e?o.a.toVector(e):void 0,transform(e,t,n){const i=e||n.shared.transform;return this.hasCustomTransform=!!i,i||T},threshold:e=>o.a.toVector(e,0)};const P=s(s({},F),{},{axis(e,t,{axis:n}){if(this.lockDirection="lock"===n,!this.lockDirection)return n},axisThreshold:(e=0)=>e,bounds(e={}){if("function"==typeof e)return t=>P.bounds(e(t));if("current"in e)return()=>e.current;if("function"==typeof HTMLElement&&e instanceof HTMLElement)return e;const t=e.left,n=void 0===t?-1/0:t,i=e.right,o=void 0===i?1/0:i,r=e.top,a=void 0===r?-1/0:r,s=e.bottom;return[[n,o],[a,void 0===s?1/0:s]]}}),N={ArrowRight:(e=1)=>[10*e,0],ArrowLeft:(e=1)=>[-10*e,0],ArrowUp:(e=1)=>[0,-10*e],ArrowDown:(e=1)=>[0,10*e]};const M="undefined"!=typeof window&&window.document&&window.document.createElement;function L(){return M&&"ontouchstart"in window||M&&window.navigator.maxTouchPoints>1}const B={isBrowser:M,gesture:function(){try{return"constructor"in GestureEvent}catch(e){return!1}}(),touch:L(),touchscreen:L(),pointer:M&&"onpointerdown"in window,pointerLock:M&&"exitPointerLock"in window.document},D={mouse:0,touch:0,pen:8},R=s(s({},P),{},{device(e,t,{pointer:{touch:n=!1,lock:i=!1,mouse:o=!1}={}}){return this.pointerLock=i&&B.pointerLock,B.touch&&n?"touch":this.pointerLock?"mouse":B.pointer&&!o?"pointer":B.touch?"touch":"mouse"},preventScrollAxis(e,t,{preventScroll:n}){if(this.preventScrollDelay="number"==typeof n?n:n||void 0===n&&e?250:void 0,B.touchscreen&&!1!==n)return e||(void 0!==n?"y":void 0)},pointerCapture(e,t,{pointer:{capture:n=!0,buttons:i=1,keys:o=!0}={}}){return this.pointerButtons=i,this.keys=o,!this.pointerLock&&"pointer"===this.device&&n},threshold(e,t,{filterTaps:n=!1,tapsThreshold:i=3,axis:r}){const a=o.a.toVector(e,n?i:r?1:0);return this.filterTaps=n,this.tapsThreshold=i,a},swipe({velocity:e=.5,distance:t=50,duration:n=250}={}){return{velocity:this.transform(o.a.toVector(e)),distance:this.transform(o.a.toVector(t)),duration:n}},delay(e=0){switch(e){case!0:return 180;case!1:return 0;default:return e}},axisThreshold:e=>e?s(s({},D),e):D});function z(e){const t=Object(i.a)(e.overflow,2),n=t[0],o=t[1],r=Object(i.a)(e._delta,2),a=r[0],s=r[1],c=Object(i.a)(e._direction,2),l=c[0],d=c[1];(n<0&&a>0&&l<0||n>0&&a<0&&l>0)&&(e._movement[0]=e._movementBound[0]),(o<0&&s>0&&d<0||o>0&&s<0&&d>0)&&(e._movement[1]=e._movementBound[1])}const A=s(s({},F),{},{device(e,t,{shared:n,pointer:{touch:i=!1}={}}){if(n.target&&!B.touch&&B.gesture)return"gesture";if(B.touch&&i)return"touch";if(B.touchscreen){if(B.pointer)return"pointer";if(B.touch)return"touch"}},bounds(e,t,{scaleBounds:n={},angleBounds:i={}}){const o=e=>{const t=S(C(n,e),{min:-1/0,max:1/0});return[t.min,t.max]},r=e=>{const t=S(C(i,e),{min:-1/0,max:1/0});return[t.min,t.max]};return"function"!=typeof n&&"function"!=typeof i?[o(),r()]:e=>[o(e),r(e)]},threshold(e,t,n){this.lockDirection="lock"===n.axis;return o.a.toVector(e,this.lockDirection?[.1,3]:0)},modifierKey:e=>void 0===e?"ctrlKey":e,pinchOnWheel:(e=!0)=>e});const H=s(s({},P),{},{mouseOnly:(e=!0)=>e});const V=P;const $=P;const q=s(s({},P),{},{mouseOnly:(e=!0)=>e}),U=new Map,W=new Map;function K(e){U.set(e.key,e.engine),W.set(e.key,e.resolver)}const Y={key:"drag",engine:class extends I{constructor(...e){super(...e),r(this,"ingKey","dragging")}reset(){super.reset();const e=this.state;e._pointerId=void 0,e._pointerActive=!1,e._keyboardActive=!1,e._preventScroll=!1,e._delayed=!1,e.swipe=[0,0],e.tap=!1,e.canceled=!1,e.cancel=this.cancel.bind(this)}setup(){const e=this.state;if(e._bounds instanceof HTMLElement){const t=e._bounds.getBoundingClientRect(),n=e.currentTarget.getBoundingClientRect(),i={left:t.left-n.left+e.offset[0],right:t.right-n.right+e.offset[0],top:t.top-n.top+e.offset[1],bottom:t.bottom-n.bottom+e.offset[1]};e._bounds=P.bounds(i)}}cancel(){const e=this.state;e.canceled||(e.canceled=!0,e._active=!1,setTimeout((()=>{this.compute(),this.emit()}),0))}setActive(){this.state._active=this.state._pointerActive||this.state._keyboardActive}clean(){this.pointerClean(),this.state._pointerActive=!1,this.state._keyboardActive=!1,super.clean()}pointerDown(e){const t=this.config,n=this.state;if(null!=e.buttons&&(Array.isArray(t.pointerButtons)?!t.pointerButtons.includes(e.buttons):-1!==t.pointerButtons&&t.pointerButtons!==e.buttons))return;const i=this.ctrl.setEventIds(e);t.pointerCapture&&e.target.setPointerCapture(e.pointerId),i&&i.size>1&&n._pointerActive||(this.start(e),this.setupPointer(e),n._pointerId=y(e),n._pointerActive=!0,this.computeValues(w(e)),this.computeInitial(),t.preventScrollAxis&&"mouse"!==f(e)?(n._active=!1,this.setupScrollPrevention(e)):t.delay>0?(this.setupDelayTrigger(e),t.triggerAllEvents&&(this.compute(e),this.emit())):this.startPointerDrag(e))}startPointerDrag(e){const t=this.state;t._active=!0,t._preventScroll=!0,t._delayed=!1,this.compute(e),this.emit()}pointerMove(e){const t=this.state,n=this.config;if(!t._pointerActive)return;if(t.type===e.type&&e.timeStamp===t.timeStamp)return;const i=y(e);if(void 0!==t._pointerId&&i!==t._pointerId)return;const r=w(e);return document.pointerLockElement===e.target?t._delta=[e.movementX,e.movementY]:(t._delta=o.a.sub(r,t._values),this.computeValues(r)),o.a.addTo(t._movement,t._delta),this.compute(e),t._delayed&&t.intentional?(this.timeoutStore.remove("dragDelay"),t.active=!1,void this.startPointerDrag(e)):n.preventScrollAxis&&!t._preventScroll?t.axis?t.axis===n.preventScrollAxis||"xy"===n.preventScrollAxis?(t._active=!1,void this.clean()):(this.timeoutStore.remove("startPointerDrag"),void this.startPointerDrag(e)):void 0:void this.emit()}pointerUp(e){this.ctrl.setEventIds(e);try{this.config.pointerCapture&&e.target.hasPointerCapture(e.pointerId)&&e.target.releasePointerCapture(e.pointerId)}catch(e){0}const t=this.state,n=this.config;if(!t._active||!t._pointerActive)return;const o=y(e);if(void 0!==t._pointerId&&o!==t._pointerId)return;this.state._pointerActive=!1,this.setActive(),this.compute(e);const r=Object(i.a)(t._distance,2),a=r[0],s=r[1];if(t.tap=a<=n.tapsThreshold&&s<=n.tapsThreshold,t.tap&&n.filterTaps)t._force=!0;else{const e=Object(i.a)(t.direction,2),o=e[0],r=e[1],a=Object(i.a)(t.velocity,2),s=a[0],c=a[1],l=Object(i.a)(t.movement,2),d=l[0],u=l[1],m=Object(i.a)(n.swipe.velocity,2),h=m[0],b=m[1],p=Object(i.a)(n.swipe.distance,2),f=p[0],g=p[1],j=n.swipe.duration;t.elapsedTime<j&&(Math.abs(s)>h&&Math.abs(d)>f&&(t.swipe[0]=o),Math.abs(c)>b&&Math.abs(u)>g&&(t.swipe[1]=r))}this.emit()}pointerClick(e){!this.state.tap&&e.detail>0&&(e.preventDefault(),e.stopPropagation())}setupPointer(e){const t=this.config,n=t.device;t.pointerLock&&e.currentTarget.requestPointerLock(),t.pointerCapture||(this.eventStore.add(this.sharedConfig.window,n,"change",this.pointerMove.bind(this)),this.eventStore.add(this.sharedConfig.window,n,"end",this.pointerUp.bind(this)),this.eventStore.add(this.sharedConfig.window,n,"cancel",this.pointerUp.bind(this)))}pointerClean(){this.config.pointerLock&&document.pointerLockElement===this.state.currentTarget&&document.exitPointerLock()}preventScroll(e){this.state._preventScroll&&e.cancelable&&e.preventDefault()}setupScrollPrevention(e){this.state._preventScroll=!1,function(e){"persist"in e&&"function"==typeof e.persist&&e.persist()}(e);const t=this.eventStore.add(this.sharedConfig.window,"touch","change",this.preventScroll.bind(this),{passive:!1});this.eventStore.add(this.sharedConfig.window,"touch","end",t),this.eventStore.add(this.sharedConfig.window,"touch","cancel",t),this.timeoutStore.add("startPointerDrag",this.startPointerDrag.bind(this),this.config.preventScrollDelay,e)}setupDelayTrigger(e){this.state._delayed=!0,this.timeoutStore.add("dragDelay",(()=>{this.state._step=[0,0],this.startPointerDrag(e)}),this.config.delay)}keyDown(e){const t=N[e.key];if(t){const n=this.state,i=e.shiftKey?10:e.altKey?.1:1;this.start(e),n._delta=t(i),n._keyboardActive=!0,o.a.addTo(n._movement,n._delta),this.compute(e),this.emit()}}keyUp(e){e.key in N&&(this.state._keyboardActive=!1,this.setActive(),this.compute(e),this.emit())}bind(e){const t=this.config.device;e(t,"start",this.pointerDown.bind(this)),this.config.pointerCapture&&(e(t,"change",this.pointerMove.bind(this)),e(t,"end",this.pointerUp.bind(this)),e(t,"cancel",this.pointerUp.bind(this)),e("lostPointerCapture","",this.pointerUp.bind(this))),this.config.keys&&(e("key","down",this.keyDown.bind(this)),e("key","up",this.keyUp.bind(this))),this.config.filterTaps&&e("click","",this.pointerClick.bind(this),{capture:!0,passive:!1})}},resolver:R},G={key:"hover",engine:class extends I{constructor(...e){super(...e),r(this,"ingKey","hovering")}enter(e){this.config.mouseOnly&&"mouse"!==e.pointerType||(this.start(e),this.computeValues(w(e)),this.compute(e),this.emit())}leave(e){if(this.config.mouseOnly&&"mouse"!==e.pointerType)return;const t=this.state;if(!t._active)return;t._active=!1;const n=w(e);t._movement=t._delta=o.a.sub(n,t._values),this.computeValues(n),this.compute(e),t.delta=t.movement,this.emit()}bind(e){e("pointer","enter",this.enter.bind(this)),e("pointer","leave",this.leave.bind(this))}},resolver:q},Q={key:"move",engine:class extends I{constructor(...e){super(...e),r(this,"ingKey","moving")}move(e){this.config.mouseOnly&&"mouse"!==e.pointerType||(this.state._active?this.moveChange(e):this.moveStart(e),this.timeoutStore.add("moveEnd",this.moveEnd.bind(this)))}moveStart(e){this.start(e),this.computeValues(w(e)),this.compute(e),this.computeInitial(),this.emit()}moveChange(e){if(!this.state._active)return;const t=w(e),n=this.state;n._delta=o.a.sub(t,n._values),o.a.addTo(n._movement,n._delta),this.computeValues(t),this.compute(e),this.emit()}moveEnd(e){this.state._active&&(this.state._active=!1,this.compute(e),this.emit())}bind(e){e("pointer","change",this.move.bind(this)),e("pointer","leave",this.moveEnd.bind(this))}},resolver:H},J={key:"pinch",engine:class extends E{constructor(...e){super(...e),r(this,"ingKey","pinching"),r(this,"aliasKey","da")}init(){this.state.offset=[1,0],this.state.lastOffset=[1,0],this.state._pointerEvents=new Map}reset(){super.reset();const e=this.state;e._touchIds=[],e.canceled=!1,e.cancel=this.cancel.bind(this),e.turns=0}computeOffset(){const e=this.state,t=e.type,n=e.movement,i=e.lastOffset;this.state.offset="wheel"===t?o.a.add(n,i):[(1+n[0])*i[0],n[1]+i[1]]}computeMovement(){const e=this.state,t=e.offset,n=e.lastOffset;this.state.movement=[t[0]/n[0],t[1]-n[1]]}axisIntent(){const e=this.state,t=Object(i.a)(e._movement,2),n=t[0],o=t[1];if(!e.axis){const t=30*Math.abs(n)-Math.abs(o);t<0?e.axis="angle":t>0&&(e.axis="scale")}}restrictToAxis(e){this.config.lockDirection&&("scale"===this.state.axis?e[1]=0:"angle"===this.state.axis&&(e[0]=0))}cancel(){const e=this.state;e.canceled||setTimeout((()=>{e.canceled=!0,e._active=!1,this.compute(),this.emit()}),0)}touchStart(e){this.ctrl.setEventIds(e);const t=this.state,n=this.ctrl.touchIds;if(t._active&&t._touchIds.every((e=>n.has(e))))return;if(n.size<2)return;this.start(e),t._touchIds=Array.from(n).slice(0,2);const i=v(e,t._touchIds);this.pinchStart(e,i)}pointerStart(e){if(null!=e.buttons&&e.buttons%2!=1)return;this.ctrl.setEventIds(e),e.target.setPointerCapture(e.pointerId);const t=this.state,n=t._pointerEvents,i=this.ctrl.pointerIds;if(t._active&&Array.from(n.keys()).every((e=>i.has(e))))return;if(n.size<2&&n.set(e.pointerId,e),t._pointerEvents.size<2)return;this.start(e);const o=j(...Array.from(n.values()));this.pinchStart(e,o)}pinchStart(e,t){this.state.origin=t.origin,this.computeValues([t.distance,t.angle]),this.computeInitial(),this.compute(e),this.emit()}touchMove(e){if(!this.state._active)return;const t=v(e,this.state._touchIds);this.pinchMove(e,t)}pointerMove(e){const t=this.state._pointerEvents;if(t.has(e.pointerId)&&t.set(e.pointerId,e),!this.state._active)return;const n=j(...Array.from(t.values()));this.pinchMove(e,n)}pinchMove(e,t){const n=this.state,i=n._values[1],o=t.angle-i;let r=0;Math.abs(o)>270&&(r+=Math.sign(o)),this.computeValues([t.distance,t.angle-360*r]),n.origin=t.origin,n.turns=r,n._movement=[n._values[0]/n._initial[0]-1,n._values[1]-n._initial[1]],this.compute(e),this.emit()}touchEnd(e){this.ctrl.setEventIds(e),this.state._active&&this.state._touchIds.some((e=>!this.ctrl.touchIds.has(e)))&&(this.state._active=!1,this.compute(e),this.emit())}pointerEnd(e){const t=this.state;this.ctrl.setEventIds(e);try{e.target.releasePointerCapture(e.pointerId)}catch(e){}t._pointerEvents.has(e.pointerId)&&t._pointerEvents.delete(e.pointerId),t._active&&t._pointerEvents.size<2&&(t._active=!1,this.compute(e),this.emit())}gestureStart(e){e.cancelable&&e.preventDefault();const t=this.state;t._active||(this.start(e),this.computeValues([e.scale,e.rotation]),t.origin=[e.clientX,e.clientY],this.compute(e),this.emit())}gestureMove(e){if(e.cancelable&&e.preventDefault(),!this.state._active)return;const t=this.state;this.computeValues([e.scale,e.rotation]),t.origin=[e.clientX,e.clientY];const n=t._movement;t._movement=[e.scale-1,e.rotation],t._delta=o.a.sub(t._movement,n),this.compute(e),this.emit()}gestureEnd(e){this.state._active&&(this.state._active=!1,this.compute(e),this.emit())}wheel(e){const t=this.config.modifierKey;t&&!e[t]||(this.state._active?this.wheelChange(e):this.wheelStart(e),this.timeoutStore.add("wheelEnd",this.wheelEnd.bind(this)))}wheelStart(e){this.start(e),this.wheelChange(e)}wheelChange(e){"uv"in e||e.cancelable&&e.preventDefault();const t=this.state;t._delta=[-x(e)[1]/100*t.offset[0],0],o.a.addTo(t._movement,t._delta),z(t),this.state.origin=[e.clientX,e.clientY],this.compute(e),this.emit()}wheelEnd(){this.state._active&&(this.state._active=!1,this.compute(),this.emit())}bind(e){const t=this.config.device;t&&(e(t,"start",this[t+"Start"].bind(this)),e(t,"change",this[t+"Move"].bind(this)),e(t,"end",this[t+"End"].bind(this)),e(t,"cancel",this[t+"End"].bind(this))),this.config.pinchOnWheel&&e("wheel","",this.wheel.bind(this),{passive:!1})}},resolver:A},X={key:"scroll",engine:class extends I{constructor(...e){super(...e),r(this,"ingKey","scrolling")}scroll(e){this.state._active||this.start(e),this.scrollChange(e),this.timeoutStore.add("scrollEnd",this.scrollEnd.bind(this))}scrollChange(e){e.cancelable&&e.preventDefault();const t=this.state,n=function(e){var t,n;const i=e.currentTarget,o=i.scrollX,r=i.scrollY,a=i.scrollLeft,s=i.scrollTop;return[null!==(t=null!=o?o:a)&&void 0!==t?t:0,null!==(n=null!=r?r:s)&&void 0!==n?n:0]}(e);t._delta=o.a.sub(n,t._values),o.a.addTo(t._movement,t._delta),this.computeValues(n),this.compute(e),this.emit()}scrollEnd(){this.state._active&&(this.state._active=!1,this.compute(),this.emit())}bind(e){e("scroll","",this.scroll.bind(this))}},resolver:V},Z={key:"wheel",engine:class extends I{constructor(...e){super(...e),r(this,"ingKey","wheeling")}wheel(e){this.state._active||this.start(e),this.wheelChange(e),this.timeoutStore.add("wheelEnd",this.wheelEnd.bind(this))}wheelChange(e){const t=this.state;t._delta=x(e),o.a.addTo(t._movement,t._delta),z(t),this.compute(e),this.emit()}wheelEnd(){this.state._active&&(this.state._active=!1,this.compute(),this.emit())}bind(e){e("wheel","",this.wheel.bind(this))}},resolver:$}},1035:function(e,t,n){"use strict";n.d(t,"a",(function(){return o})),n.d(t,"b",(function(){return s}));var i=n(6);const o={toVector:(e,t)=>(void 0===e&&(e=t),Array.isArray(e)?e:[e,e]),add:(e,t)=>[e[0]+t[0],e[1]+t[1]],sub:(e,t)=>[e[0]-t[0],e[1]-t[1]],addTo(e,t){e[0]+=t[0],e[1]+=t[1]},subTo(e,t){e[0]-=t[0],e[1]-=t[1]}};function r(e,t,n){return 0===t||Math.abs(t)===1/0?Math.pow(e,5*n):e*t*n/(t+n*e)}function a(e,t,n,i=.15){return 0===i?function(e,t,n){return Math.max(t,Math.min(e,n))}(e,t,n):e<t?-r(t-e,n-t,i)+t:e>n?+r(e-n,n-t,i)+n:e}function s(e,[t,n],[o,r]){const s=Object(i.a)(e,2),c=Object(i.a)(s[0],2),l=c[0],d=c[1],u=Object(i.a)(s[1],2),m=u[0],h=u[1];return[a(t,l,d,o),a(n,m,h,r)]}},1036:function(e,t,n){"use strict";n.d(t,"c",(function(){return v})),n.d(t,"b",(function(){return O})),n.d(t,"a",(function(){return _}));var i=n(15),o=n(0),r=n(7),a=n(1092),s=n(98),c=(n(8),n(1043)),l=n(1041),d=n(1);const u=Object(o.createContext)(void 0);var m=n(443),h=n(21),b=n(2),p=n(1066),f=n(29);n(281);const g=m.a.getItems()[0].item.config,j=Object(o.createContext)(void 0);function O(e){var t,n,i,o,r,a,s,c,l,d,u,m,h,b,p,f;return{scheme:null==e||null===(t=e.theme)||void 0===t?void 0:t.scheme,baseFont:null==e||null===(n=e.typography)||void 0===n?void 0:n.baseFont,boldHeading:null==e||null===(i=e.typography)||void 0===i?void 0:i.headFontBold,italicHeading:null==e||null===(o=e.typography)||void 0===o?void 0:o.headFontItalic,headFamily:null==e||null===(r=e.typography)||void 0===r?void 0:r.headFamily,headFamilyCustom:null==e||null===(a=e.typography)||void 0===a?void 0:a.headFamilyCustom,bodyFamily:null==e||null===(s=e.typography)||void 0===s?void 0:s.bodyFamily,bodyFamilyCustom:null==e||null===(c=e.typography)||void 0===c?void 0:c.bodyFamilyCustom,customPrimaryColor:null==e||null===(l=e.theme)||void 0===l?void 0:l.customColorPrimary,customSecondaryColor:null==e||null===(d=e.theme)||void 0===d?void 0:d.customColorSecondary,customBackgroundColor:null==e||null===(u=e.theme)||void 0===u?void 0:u.customColorBg,customTextColor:null==e||null===(m=e.theme)||void 0===m?void 0:m.customColorText,css:null==e||null===(h=e.theme)||void 0===h?void 0:h.css,maxWidth:null==e||null===(b=e.appearance)||void 0===b?void 0:b.maxWidth,containerLayout:null==e||null===(p=e.appearance)||void 0===p?void 0:p.containerLayout,darkMode:null==e||null===(f=e.theme)||void 0===f?void 0:f.darkMode}}function v(e){return Object(o.useMemo)((()=>O(e)),[e])}function y(e){const t=Object(o.useState)((()=>!1)),n=Object(i.a)(t,2),r=n[0];n[1];Object(o.useEffect)((()=>()=>{}),[]);const a=Object(o.useContext)(j);return Object(o.useMemo)((()=>{const t=null!=e?e:{},n=t.baseFont,o=t.bodyFamily,r=t.boldHeading,a=t.customBackgroundColor,s=t.customPrimaryColor,c=t.customSecondaryColor,l=t.customTextColor,d=t.headFamily,u=t.italicHeading,j=t.scheme;t.darkMode;let O=Object(h.c)(g);j&&m.a.hasItem(j)&&(O=Object(h.c)(m.a.getItem(j).config)),n&&16!==n&&n>=12&&(O={...O,controlHeightBase:Object(b.g)(2.5*n),borderRadiusBase:Object(b.g)(.25*n),gutter:Math.min(Math.max(Object(b.g)(1.25*n),10),40),fz:{small2:Math.ceil(.75*n),small1:Math.ceil(.875*n),base:n,large1:Math.ceil(1.125*n),large2:Math.ceil(1.25*n),large3:Math.ceil(1.5*n),large4:Math.ceil(1.875*n),large5:Math.ceil(2.25*n),large6:Math.ceil(3*n),large7:Math.ceil(3.75*n),large8:Math.ceil(4.5*n)}});const v=[];if(O.boldHeading=!!r,O.italicHeading=!!u,d){let t="inherit";if("custom"===d){var y;t=null!==(y=null==e?void 0:e.headFamilyCustom)&&void 0!==y?y:"inherit"}else{const e=Object(p.a)(d),n=Object(i.a)(e,2),o=n[0],r=n[1];t=o,r&&v.push(r)}O.fontFamilyHeading=t}if(o){let t="inherit";if("custom"===o){var w;t=null!==(w=null==e?void 0:e.bodyFamilyCustom)&&void 0!==w?w:"inherit"}else{const e=Object(p.a)(o),n=Object(i.a)(e,2),r=n[0],a=n[1];t=r,a&&v.push(a)}O.fontFamilyBody=t}const x=f.b,C=f.d;return s&&(O.primaryColor=s,O.primaryDarkColor=x(.1,s),O.primaryLightColor=C(.1,s),O.accentColor=Object(f.a)(s),O.primaryBgText=Object(f.d)(.7,s),O.primaryBackgroundColor=C(.6,s),O.linkColor=s,O.boxShadowFocus=`0 0 0 2px ${Object(f.e)(.5,s)}`,O.boxShadowControlFocus=`0 0 0 ${Object(b.n)(3)} ${Object(f.e)(.8,s)}`),c&&(O.borderColorBase=c,O.borderColorSplit=C(.1,c),O.disabledColor=C(.28,c),O.disabledBackgroundColor=C(.45,c),O.backgroundControl=C(.44,c),console.log(O.backgroundControl),O.backgroundShade=Object(f.c)(.01,C(.4,c)),O.backgroundHover=Object(f.c)(.01,C(.42,c))),a&&(O.appBackgroundColor=a),l&&(O.textColor=l,O.textColorSecondary=C(.4,l),O.headingColor=C(.1,l)),[O,Object(h.a)(v)]}),[e,r,a])}function w(e){const t=new r.a;let n;try{Object(a.renderToString)(Object(d.jsx)(r.b,{sheet:t.instance,children:Object(d.jsx)(d.Fragment,{children:e})})),n=t.getStyleElement()}catch(e){console.log(e),n=null}finally{t.seal()}return n}function x(e){const t=e.children,n=e.ssr,i=e.mode,o=e.themeStyle,a=e.widthOverride,c=e.containerLayoutOverride,l=e.theme;return Object(d.jsx)(r.c,{theme:l,children:n?Object(d.jsx)(s.a.Ssr,{width:null!=a?a:null==o?void 0:o.maxWidth,containerLayout:null!=c?c:null==o?void 0:o.containerLayout,noHorizontalPadding:"preview"===i,noVerticalPadding:"preview"===i,children:t}):Object(d.jsx)(s.a,{width:null!=a?a:null==o?void 0:o.maxWidth,containerLayout:null!=c?c:null==o?void 0:o.containerLayout,noHorizontalPadding:"preview"===i,noVerticalPadding:"preview"===i,children:t})})}function C(e){const t=e.children,n=Object(o.useContext)(u);return Object(d.jsx)(r.b,{target:n,children:Object(d.jsx)(d.Fragment,{children:t})})}function _(e){const t=e.mode,n=e.themeStyle,r=e.ssr,a=void 0!==r&&r,s=y(n),u=Object(i.a)(s,2),m=u[0],h=u[1],b=null==n?void 0:n.css,p=Object(c.b)();Object(o.useEffect)((()=>{p&&"undefined"!=typeof window&&h&&h.length&&h.forEach((e=>{const t=Object(l.d)(e);if(!document.head.querySelector(`#${t}`)){const n=document.createElement("link");n.setAttribute("href",e),n.setAttribute("id",t),n.setAttribute("rel","stylesheet"),document.head.append(n)}}))}),[h,p]);const f=Object(d.jsx)(x,{theme:m,...e}),g=Object(o.useState)(!1),j=Object(i.a)(g,2),O=j[0],v=j[1];return Object(o.useEffect)((()=>{v(!0)}),[]),Object(d.jsxs)(d.Fragment,{children:[p&&O?h.map((e=>Object(d.jsx)("link",{rel:"stylesheet",href:e},e))):null,b&&"live"===t?Object(d.jsx)("style",{type:"text/css",dangerouslySetInnerHTML:{__html:b}}):null,a?Object(d.jsxs)(d.Fragment,{children:[w(f),Object(d.jsx)("div",{className:"wpeform-root-slot__react-app",children:f})]}):Object(d.jsx)(C,{children:f})]})}},1038:function(e,t,n){"use strict";n.d(t,"a",(function(){return h}));var i=n(42),o=n(52),r=(n(0),n(83)),a=n(7),s=n(10),c=n.n(s),l=n(1);const d=["history","location","match","staticContext","to","transparent","className"],u=["onClick","transparent","className"],m=Object(a.f)(o.a).withConfig({displayName:"StyledLink__StyledLinkButton",componentId:"sc-1fap3y6-0"})(["&.wpeform-ghosted-button{border:0 none;box-shadow:none;&:hover{background-color:",";color:",";}}"],(e=>e.theme.backgroundHover),(e=>e.theme.textColor));function h(e){const t=e.onClick,n=e.transparent,o=e.className,r=Object(i.a)(e,u);return Object(l.jsx)(m,{className:c()(o,{"wpeform-ghosted-button":n}),...r,onClick:e=>{e.preventDefault(),t()}})}t.b=Object(r.o)((function(e){const t=e.history,n=(e.location,e.match,e.staticContext,e.to),o=e.transparent,r=e.className,a=Object(i.a)(e,d);return Object(l.jsx)(m,{className:c()(r,{"wpeform-ghosted-button":o}),...a,onClick:e=>{e.preventDefault(),t.push(n)}})}))},1039:function(e,t,n){"use strict";n.d(t,"a",(function(){return r}));n(0),n(8);var i=n(1036);n.d(t,"c",(function(){return i.c})),n.d(t,"b",(function(){return i.b}));var o=n(1);function r(e){const t=e.children,n=e.themeStyle,r=e.widthOverride,a=e.containerLayoutOverride,s=e.mode,c=void 0===s?"live":s,l=e.ssr,d=void 0!==l&&l;return Object(o.jsx)(i.a,{themeStyle:n,mode:c,containerLayoutOverride:a,widthOverride:r,ssr:d,children:t})}},1040:function(e,t,n){"use strict";var i=n(1034);n.d(t,"a",(function(){return i.i})),n.d(t,"b",(function(){return i.k})),n.d(t,"c",(function(){return i.m})),n.d(t,"d",(function(){return i.j})),n.d(t,"e",(function(){return i.o})),n.d(t,"f",(function(){return i.p})),n.d(t,"g",(function(){return i.r}))},1041:function(e,t,n){"use strict";n.d(t,"b",(function(){return o})),n.d(t,"a",(function(){return r})),n.d(t,"e",(function(){return a})),n.d(t,"c",(function(){return s})),n.d(t,"d",(function(){return c}));var i=n(3);function o(e,t,n=Object(i.__)("Anonymous","wp-eform")){const o=[];return e&&o.push(e),t&&o.push(t),o.length?o.join(" "):n}function r(e){const t=Math.floor(e/3600),n=e%3600,o=Math.floor(n/60),r=n%60;return t>0?Object(i.sprintf)(Object(i._x)("%1$s, %2$s, %3$s","format-time-from-seconds","wp-eform"),Object(i.sprintf)(Object(i._n)("%d hour","%d hours",t,"wp-eform"),t),Object(i.sprintf)(Object(i._n)("%d minute","%d minutes",o,"wp-eform"),o),Object(i.sprintf)(Object(i._n)("%d second","%d seconds",r,"wp-eform"),r)):o>0?Object(i.sprintf)(Object(i._x)("%1$s, %2$s","format-time-from-seconds","wp-eform"),Object(i.sprintf)(Object(i._n)("%d minute","%d minutes",o,"wp-eform"),o),Object(i.sprintf)(Object(i._n)("%d second","%d seconds",r,"wp-eform"),r)):Object(i.sprintf)(Object(i._n)("%d second","%d seconds",r,"wp-eform"),r)}function a(e,t,n="…"){return e.length<=t?e:e.substring(0,t+1)+n}const s=/%%([^%%]+)%%/;function c(...e){return e.join(" ").normalize("NFD").replace(/[\u0300-\u036f]/g,"").toLowerCase().trim().replace(/[^a-z0-9 ]/g,"").replace(/\s+/g,"-")}},1042:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));var i=n(439);function o(){i.a.evict({id:"ROOT_QUERY",fieldName:"forms"}),i.a.evict({id:"ROOT_QUERY",fieldName:"form"}),i.a.evict({id:"ROOT_QUERY",fieldName:"categories"}),i.a.evict({id:"ROOT_QUERY",fieldName:"category"}),i.a.evict({id:"ROOT_QUERY",fieldName:"submissions"}),i.a.evict({id:"ROOT_QUERY",fieldName:"submission"}),i.a.evict({id:"ROOT_QUERY",fieldName:"formMeta"}),i.a.evict({id:"ROOT_QUERY",fieldName:"submissionMeta"}),i.a.evict({id:"ROOT_QUERY",fieldName:"siteSettings"}),i.a.gc()}},1043:function(e,t,n){"use strict";n.d(t,"b",(function(){return l})),n.d(t,"a",(function(){return u}));var i=n(15),o=n(0),r=n(359),a=n(1);const s=Object(o.createContext)(!1);function c(e){const t=e.cssHandles,n=Object(o.useState)([]),r=Object(i.a)(n,2),s=r[0],c=r[1];return Object(o.useEffect)((()=>{const e=[];t&&"undefined"!=typeof window&&t.forEach((t=>{const n=document.querySelector(`#${t}-css`);if(n){const o=n.getAttribute("href");var i;if(o)e.push({id:t,href:o,media:null!==(i=n.getAttribute("media"))&&void 0!==i?i:"all"})}})),c(e)}),[t]),Object(a.jsx)(a.Fragment,{children:s.map((e=>Object(a.jsx)("link",{rel:"stylesheet",href:e.href,media:e.media},e.id)))})}function l(){return Object(o.useContext)(s)}function d(){const e="undefined"!=typeof WPEFormGraphQLApp?WPEFormGraphQLApp:{customCSS:void 0,customStyleLinks:void 0},t=e.customCSS,n=e.customStyleLinks;return Object(a.jsxs)(a.Fragment,{children:[t?Object(a.jsx)("style",{type:"text/css",dangerouslySetInnerHTML:{__html:t}}):null,n?n.map((e=>Object(a.jsx)("link",{rel:"stylesheet",href:e},e))):null]})}function u(e){const t=e.children,n=e.inShadow,r=e.cssHandles,l=Object(o.useState)(!1),u=Object(i.a)(l,2),m=u[0],h=u[1];return Object(o.useEffect)((()=>{h(!0)}),[]),Object(a.jsxs)(s.Provider,{value:n,children:[m?Object(a.jsxs)(a.Fragment,{children:[Object(a.jsx)(d,{}),n?Object(a.jsx)(c,{cssHandles:r}):null]}):null,t]})}u.LinkAllAssets=function(e){const t=e.body,n=void 0!==t&&t,s=e.head,c=void 0===s||s,l=Object(o.useState)([]),d=Object(i.a)(l,2),u=d[0],m=d[1];return Object(o.useEffect)((()=>{const e=[];let t;const i='link[rel="stylesheet"]';t=c&&n?document.querySelectorAll(i):c?document.head.querySelectorAll(i):document.body.querySelectorAll(i),t.length&&t.forEach((t=>{const n=t.getAttribute("href");var i,o;n&&e.push({id:null!==(i=t.getAttribute("id"))&&void 0!==i?i:Object(r.a)(),href:n,media:null!==(o=t.getAttribute("media"))&&void 0!==o?o:"all"})})),m(e)}),[n,c]),Object(a.jsx)(a.Fragment,{children:u.map((e=>Object(a.jsx)("link",{rel:"stylesheet",href:e.href,media:e.media},e.id)))})}},1044:function(e,t,n){"use strict";n.d(t,"a",(function(){return j}));var i=n(442),o=n(1071),r=(n(0),n(7)),a=n(3),s=n(365),c=n(2),l=n(1038),d=n(1);const u=r.f.header.withConfig({displayName:"PageHeader__PageHeaderWrap",componentId:"sc-1gousn5-0"})(["display:flex;flex-flow:row wrap;align-items:center;justify-content:flex-start;background-color:",";margin-bottom:",";box-shadow:",";border-radius:",";padding:",";padding-bottom:0;.eform-admin-page-header__styledlink{margin-right:",";text-transform:uppercase;}"],(e=>e.theme.appBackgroundColor),(e=>Object(c.n)(e.theme.gutter)),(e=>e.theme.boxShadowElevationOne),(e=>Object(c.n)(e.theme.borderRadiusBase)),(e=>Object(c.n)(e.theme.gutter)),(e=>Object(c.n)(e.theme.gutter/2))),m=r.f.div.withConfig({displayName:"PageHeader__PageHeaderTitleWrap",componentId:"sc-1gousn5-1"})(["display:flex;flex-flow:row nowrap;align-items:center;margin-right:",";margin-bottom:",";flex:0 0 auto;"],(e=>Object(c.n)(e.theme.gutter)),(e=>Object(c.n)(e.theme.gutter))),h=r.f.h2.withConfig({displayName:"PageHeader__PageHeaderTitle",componentId:"sc-1gousn5-2"})(["margin:0;padding:0;font-size:",";color:",";font-weight:bold;"],(e=>Object(c.n)(e.theme.fz.base)),(e=>e.theme.textColor)),b=r.f.h4.withConfig({displayName:"PageHeader__PageHeaderSubtitle",componentId:"sc-1gousn5-3"})(["margin:0;padding:0;margin-bottom:",";flex:1 1 auto;font-size:",";color:",";font-weight:normal;font-style:italic;"],(e=>Object(c.n)(e.theme.gutter)),(e=>Object(c.n)(e.theme.fz.small1)),(e=>e.theme.greyLightColor)),p=r.f.div.withConfig({displayName:"PageHeader__PageControlLeft",componentId:"sc-1gousn5-4"})(["margin:0;padding:0;margin-bottom:",";flex:1 1 auto;max-width:100%;"],(e=>Object(c.n)(e.theme.gutter))),f=r.f.div.withConfig({displayName:"PageHeader__PageControlRight",componentId:"sc-1gousn5-5"})(["margin:0 0 "," auto;padding:0;flex:0 0 auto;"],(e=>Object(c.n)(e.theme.gutter))),g={transparent:!0,shape:"circle",size:"small",className:"eform-admin-page-header__styledlink eform-admin-page-header__styledlink--back"};function j(e){const t=e.title,n=e.subTitle,r=e.backLink,c=e.newLink,j=e.backLabel,O=void 0===j?Object(a.__)("Back","wp-eform"):j,v=e.newLabel,y=void 0===v?Object(a.__)("Add New","wp-eform"):v,w=e.controlLeft,x=e.controlRight,C=Object(s.useLastLocation)();let _;return _=null===r?null:C?`${C.pathname}${C.search}`:r,Object(d.jsxs)(u,{className:"eform-admin-page-header",children:[Object(d.jsxs)(m,{children:[_?Object(d.jsx)(l.b,{...g,to:_,title:O,children:Object(d.jsx)(o.a,{})}):null,c?Object(d.jsxs)(l.b,{size:"small",className:"eform-admin-page-header__styledlink eform-admin-page-header__styledlink--new",to:c,type:"primary",children:[Object(d.jsx)(i.a,{})," ",y]}):null,Object(d.jsx)(h,{children:t})]}),n?Object(d.jsx)(b,{children:n}):null,w?Object(d.jsx)(p,{children:w}):null,x?Object(d.jsx)(f,{children:x}):null]})}},1045:function(e,t,n){"use strict";n.d(t,"a",(function(){return o})),n.d(t,"b",(function(){return r}));var i=n(1189);const o=i.a`
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
`,r=i.a`
	fragment FCheckboxSubmission on FormElementCheckboxSubmissionElementValueType {
		selected
		other
	}
`},1046:function(e,t,n){"use strict";n.d(t,"a",(function(){return o})),n.d(t,"b",(function(){return r}));var i=n(1189);const o=i.a`
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
`,r=i.a`
	fragment FDropdownSubmission on FormElementDropdownSubmissionElementValueType {
		selected
		other
	}
`},1047:function(e,t,n){"use strict";n.d(t,"a",(function(){return o})),n.d(t,"b",(function(){return r}));var i=n(1189);const o=i.a`
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
`,r=i.a`
	fragment FRadioSubmission on FormElementRadioSubmissionElementValueType {
		other
		selected
	}
`},1048:function(e,t,n){"use strict";n.d(t,"a",(function(){return o})),n.d(t,"b",(function(){return r}));var i=n(1189);const o=i.a`
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
`,r=i.a`
	fragment FTextSubmission on FormElementTextSubmissionElementValueType {
		input
	}
`},1049:function(e,t,n){"use strict";n.d(t,"a",(function(){return o})),n.d(t,"b",(function(){return r}));var i=n(1189);const o=i.a`
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
`,r=i.a`
	fragment FTextareaSubmission on FormElementTextareaSubmissionElementValueType {
		input
	}
`},1050:function(e,t,n){"use strict";n.d(t,"a",(function(){return o})),n.d(t,"b",(function(){return r}));var i=n(1189);const o=i.a`
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
`,r=i.a`
	fragment FToggleSubmission on FormElementToggleSubmissionElementValueType {
		selected
	}
`},1051:function(e,t,n){"use strict";n.d(t,"a",(function(){return o})),n.d(t,"b",(function(){return r}));var i=n(1189);const o=i.a`
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
`,r=i.a`
	fragment FSliderSubmission on FormElementSliderSubmissionElementValueType {
		selected
	}
`},1052:function(e,t,n){"use strict";n.d(t,"a",(function(){return o})),n.d(t,"b",(function(){return r}));var i=n(1189);const o=i.a`
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
`,r=i.a`
	fragment FRangeSubmission on FormElementRangeSubmissionElementValueType {
		maxSelected
		minSelected
	}
`},1053:function(e,t,n){"use strict";n.d(t,"a",(function(){return o})),n.d(t,"b",(function(){return r}));var i=n(1189);const o=i.a`
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
`,r=i.a`
	fragment FMathcalcSubmission on FormElementMathcalcSubmissionElementValueType {
		output
	}
`},1054:function(e,t,n){"use strict";n.d(t,"a",(function(){return o})),n.d(t,"b",(function(){return r}));var i=n(1189);const o=i.a`
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
`,r=i.a`
	fragment FRatingSubmission on FormElementRatingSubmissionElementValueType {
		feedback
		selected
	}
`},1055:function(e,t,n){"use strict";n.d(t,"a",(function(){return o})),n.d(t,"b",(function(){return r}));var i=n(1189);const o=i.a`
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
`,r=i.a`
	fragment FMatrixchoiceSubmission on FormElementMatrixchoiceSubmissionElementValueType {
		selected {
			columns
			rowId
		}
	}
`},1056:function(e,t,n){"use strict";n.d(t,"a",(function(){return o})),n.d(t,"b",(function(){return r}));var i=n(1189);const o=i.a`
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
`,r=i.a`
	fragment FSortableSubmission on FormElementSortableSubmissionElementValueType {
		order
	}
`},1057:function(e,t,n){"use strict";n.d(t,"a",(function(){return o})),n.d(t,"b",(function(){return r}));var i=n(1189);const o=i.a`
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
`,r=i.a`
	fragment FDatetimeinputSubmission on FormElementDatetimeinputSubmissionElementValueType {
		input
	}
`},1058:function(e,t,n){"use strict";n.d(t,"a",(function(){return o})),n.d(t,"b",(function(){return r}));var i=n(1189);const o=i.a`
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
`,r=i.a`
	fragment FMatrixinputSubmission on FormElementMatrixinputSubmissionElementValueType {
		input {
			columnId
			rowId
			value
		}
	}
`},1059:function(e,t,n){"use strict";n.d(t,"a",(function(){return o})),n.d(t,"b",(function(){return r}));var i=n(1189);const o=i.a`
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
`,r=i.a`
	fragment FSinglecheckboxSubmission on FormElementSinglecheckboxSubmissionElementValueType {
		selected
	}
`},1060:function(e,t,n){"use strict";n.d(t,"a",(function(){return o})),n.d(t,"b",(function(){return r}));var i=n(1189);const o=i.a`
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
`,r=i.a`
	fragment FAddressSubmission on FormElementAddressSubmissionElementValueType {
		city
		country
		fieldOne
		fieldTwo
		state
		zip
	}
`},1061:function(e,t,n){},1062:function(e,t){},1063:function(e,t,n){"use strict";n.d(t,"a",(function(){return y}));var i=n(1189);const o=i.a`
	fragment FCaptchaSubmission on FormElementCaptchaSubmissionElementValueType {
		encrypted
		solved
	}
`;var r=n(1045),a=n(1046),s=n(1047),c=n(1048),l=n(1049),d=n(1050),u=n(1051),m=n(1052),h=n(1053),b=n(1054),p=n(1055),f=n(1056),g=n(1057),j=n(1058),O=n(1059),v=n(1060);const y=i.a`
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
	${o}
	${s.b}
	${r.b}
	${a.b}
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
`},1064:function(e,t,n){"use strict";n.d(t,"a",(function(){return jt})),n.d(t,"b",(function(){return ke}));var i=n(52),o=n(1101),r=n(115),a=n(87),s=n(15),c=n(0),l=n(18),d=n(3),u=n(358),m=n(283),h=n(114),b=n(2);function p(e){return c.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),c.createElement("path",{d:"M322.342 0c-104.562 0-189.63 85.233-189.63 190 0 36.143 10.128 69.958 27.684 98.754C60.874 367.13 49.879 378.143 46.17 381.857l-27.662 27.716c-23.349 23.395-23.349 61.459 0 84.854 11.674 11.696 27.01 17.545 42.343 17.545 15.334 0 30.67-5.849 42.343-17.545l27.662-27.716c3.687-3.694 14.71-14.741 92.469-114.733C252.164 369.741 286.078 380 322.342 380c28.493 0 55.893-6.181 81.44-18.371 9.954-4.749 14.18-16.684 9.44-26.656-4.74-9.973-16.653-14.21-26.604-9.457C366.474 335.127 344.849 340 322.342 340c-82.548 0-149.707-67.29-149.707-150S239.794 40 322.342 40c82.55 0 149.708 67.29 149.708 150 0 27.091-7.279 53.631-21.05 76.75-5.65 9.484-2.557 21.763 6.91 27.424 9.467 5.661 21.72 2.561 27.37-6.924 17.463-29.315 26.693-62.943 26.693-97.25 0-104.767-85.069-190-189.63-190zM102.63 438.426l-27.662 27.716c-7.783 7.799-20.446 7.799-28.23 0-7.782-7.798-7.782-20.485 0-28.283l27.663-27.716c4.946-4.956 25.989-23.249 110.264-89.625a191.924 191.924 0 007.024 7.064c-66.028 84.902-84.157 105.932-89.06 110.844zm320.465-292.18c4.388 10.133-.253 21.911-10.366 26.309a19.86 19.86 0 01-7.936 1.657c-7.713 0-15.055-4.504-18.32-12.044C375.377 136.552 350.205 120 322.342 120c-11.025 0-19.962-8.954-19.962-20s8.937-20 19.961-20c43.777 0 83.325 26.003 100.753 66.246z"}))}n.p;function f(e){return c.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),c.createElement("path",{d:"M244 492c0 11.047-8.953 20-20 20H100c-44.113 0-80-35.887-80-80V210c0-11.047 8.953-20 20-20s20 8.953 20 20v222c0 22.055 17.945 40 40 40h124c11.047 0 20 8.953 20 20zM512 60v60c0 11.047-8.953 20-20 20v147c0 11.047-8.953 20-20 20s-20-8.953-20-20V140H20c-11.047 0-20-8.953-20-20V60C0 26.918 26.914 0 60 0h392c33.086 0 60 26.918 60 60zM40 100h432V60c0-11.027-8.973-20-20-20H60c-11.027 0-20 8.973-20 20v40zm260 120c11.047 0 20-8.953 20-20s-8.953-20-20-20h-90c-11.047 0-20 8.953-20 20s8.953 20 20 20h90zm208.363 183.504a19.986 19.986 0 010 22.996c-.703 1-3.11 4.41-4.61 6.297-6.698 8.426-22.378 28.148-44.194 45.558C431.586 500.68 402.8 512 374 512c-28.8 0-57.586-11.32-85.559-33.645-21.816-17.41-37.496-37.136-44.191-45.558-1.496-1.883-3.91-5.297-4.613-6.297a20 20 0 010-22.996c.703-1.004 3.117-4.418 4.617-6.305 6.691-8.418 22.371-28.14 44.187-45.554C316.414 329.32 345.2 318 374 318c28.8 0 57.586 11.32 85.559 33.645 21.816 17.41 37.496 37.136 44.191 45.558 1.5 1.887 3.91 5.297 4.613 6.3zM466.645 415c-31.801-37.832-62.938-57-92.645-57-29.707 0-60.844 19.168-92.64 57 31.796 37.832 62.937 57 92.64 57 29.703 0 60.844-19.164 92.645-57zM375 377c-20.988 0-38 17.012-38 38s17.012 38 38 38 38-17.012 38-38-17.012-38-38-38z"}))}n.p;function g(e){return c.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),c.createElement("path",{d:"M492 352c11.046 0 20-8.954 20-20V80c0-44.112-35.888-80-80-80H80C35.888 0 0 35.888 0 80v352c0 44.112 35.888 80 80 80h352c44.112 0 80-35.888 80-80 0-11.046-8.954-20-20-20s-20 8.954-20 20c0 22.056-17.944 40-40 40h-76v-78h36c11.046 0 20-8.954 20-20s-8.954-20-20-20h-36v-78h116v56c0 11.046 8.954 20 20 20zM156 472H80c-22.056 0-40-17.944-40-40v-38h116v78zm0-118H40v-78h116v78zm0-118H40v-78h116v78zm0-118H40V80c0-22.056 17.944-40 40-40h76v78zm160 354H196v-78h120v78zm0-118H196v-78h120v78zm0-118H196v-78h120v78zm0-118H196V40h120v78zm40-78h76c22.056 0 40 17.944 40 40v38H356V40zm0 196v-78h116v78H356z"}))}n.p;var j=n(7),O=n(29),v=n(53),y=n(31);const w="wpeform-data-table",x=j.f.header.withConfig({displayName:"styled__DataHeader",componentId:"sc-ugqkdl-0"})(["margin:0 0 "," 0;border-radius:",";margin:0 0 "," 0;background-color:",";box-shadow:",";padding:"," 0;display:flex;flex-flow:row wrap;max-width:100%;.","__row-bottom,.","__row-top{flex:0 0 100%;display:flex;flex-flow:row nowrap;align-items:center;max-width:100%;overflow-x:auto;padding:"," ",";.","__header-search{flex:1 1 auto;max-width:400px;}}.","__row-top{.","__header-bulk-actions{margin-right:16px;}}.","__header-cb{flex:0 0 auto;}.","__header-title{padding:0 ",";font-weight:700;font-size:",";color:",";flex:0 1 auto;text-transform:uppercase;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:200px;}.","__header-controls{margin-left:auto;display:flex;flex-flow:row nowrap;flex:0 0 auto;align-items:center;> *{margin-left:4px;}}.","__views{.ant-btn{font-size:14px;}}"],(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>Object(b.n)(e.theme.gutter/2)),(e=>e.theme.appBackgroundColor),(e=>e.theme.boxShadowElevationOne),(e=>Object(b.n)(e.theme.gutter/2)),w,w,(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.gutter)),w,w,w,w,w,(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.fz.base)),(e=>e.theme.headingColor),w,w),C=j.f.label.withConfig({displayName:"styled__SplitMenuItem",componentId:"sc-ugqkdl-1"})(["padding:8px 12px;display:flex;align-items:center;color:",";font-size:",";font-weight:",";text-transform:uppercase;cursor:pointer;background-color:transparent;transition:background-color ",",color ",";&:hover{background-color:",";}.ant-checkbox-wrapper,.ant-radio-wrapper{margin-right:",";display:inline-flex;align-items:center;justify-content:center;.ant-radio,.ant-checkbox{top:0;}}"],(e=>e.selected?e.theme.textColor:e.theme.textColorSecondary),(e=>Object(b.n)(e.theme.fz.small2)),(e=>e.selected?700:600),(e=>e.theme.transition),(e=>e.theme.transition),(e=>e.theme.backgroundHover),(e=>Object(b.n)(e.theme.gutter/2))),_=j.f.div.withConfig({displayName:"styled__SplitMenu",componentId:"sc-ugqkdl-2"})(["width:300px;display:flex;flex-flow:row nowrap;align-items:stretch;border-radius:",";background-color:",";box-shadow:",";overflow:hidden;"],(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>e.theme.appBackgroundColor),(e=>e.theme.boxShadowBase)),k=j.f.div.withConfig({displayName:"styled__SplitMenuColumn",componentId:"sc-ugqkdl-3"})(["width:150px;flex:1 0 150px;&:last-of-type{border-left:1px solid ",";}"],(e=>e.theme.borderColorSplit)),S=j.f.div.withConfig({displayName:"styled__FilterMenu",componentId:"sc-ugqkdl-4"})(["width:250px;padding:",";border-radius:",";background-color:",";box-shadow:",";.ant-select{width:100%;}"],(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>e.theme.appBackgroundColor),(e=>e.theme.boxShadowBase)),E=j.f.div.withConfig({displayName:"styled__FilterMenuItem",componentId:"sc-ugqkdl-5"})(["margin:0 0 "," 0;&:last-of-type{margin-bottom:0;}"],(e=>Object(b.n)(e.theme.gutter/4))),I=j.f.ul.withConfig({displayName:"styled__DataList",componentId:"sc-ugqkdl-6"})(["list-style:none;margin:0;padding:0;"]),T=j.f.div.withConfig({displayName:"styled__DataListItemInner",componentId:"sc-ugqkdl-7"})(["margin:0;padding:",";border-radius:",";display:flex;flex-flow:row nowrap;align-items:stretch;justify-content:flex-start;position:relative;&::after{border:12px solid ",";content:'';position:absolute;bottom:-1px;right:-1px;display:block;transition:",";}"],(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>Object(O.e)(1,e.theme.primaryColor)),(e=>Object(b.f)(["border-color"],e.theme.transition))),F=Object(j.f)(v.animated.li).withConfig({displayName:"styled__DataListItem",componentId:"sc-ugqkdl-8"})(["list-style:none;overflow:hidden;margin:0 0 "," 0;background-color:",";padding:0;will-change:opacity,transform,max-height,box-shadow,border-color;border-radius:",";box-shadow:",";border:1px solid ",";&:last-of-type{margin-bottom:0;}transition:",";&:hover{box-shadow:",";}&.is-selected{box-shadow:",";}&:focus,&.focused{outline:none;border-color:",";","{position:relative;outline:none;z-index:1;&::after{border-right-color:",";border-bottom-color:",";}}}&.is-header{box-shadow:",";&:hover{box-shadow:",";}}"],(e=>Object(b.n)(e.theme.gutter)),(e=>e.theme.appBackgroundColor),(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>e.theme.boxShadowElevationOne),(e=>Object(O.e)(1,e.theme.primaryColor)),(e=>Object(b.e)(["box-shadow","border-color"],e.theme.transition)),(e=>e.theme.boxShadow1dp),(e=>e.theme.boxShadow2dp),(e=>Object(O.e)(0,e.theme.primaryColor)),T,(e=>Object(O.e)(0,e.theme.primaryColor)),(e=>Object(O.e)(0,e.theme.primaryColor)),(e=>e.theme.boxShadowElevationOne),(e=>e.theme.boxShadowElevationOne)),P=j.f.div.withConfig({displayName:"styled__DataListItemCb",componentId:"sc-ugqkdl-9"})(["flex:0 0 auto;margin:0 "," 0 0;.ant-skeleton-avatar{height:20px;width:20px;border-radius:",";}"],(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.borderRadiusBase))),N=j.f.div.withConfig({displayName:"styled__DataListItemContent",componentId:"sc-ugqkdl-10"})(["flex:0 0 auto;width:calc(100% - 30px);.ant-skeleton-content{.ant-skeleton-title{margin:0 0 "," 0;height:",";}.ant-skeleton-paragraph{margin:0;}}"],(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(1.5*e.theme.fz.base))),M=j.f.footer.withConfig({displayName:"styled__DataFooter",componentId:"sc-ugqkdl-11"})(["padding:"," ",";margin:"," 0 0 0;border-radius:",";background-color:",";box-shadow:",";text-align:right;"],(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>e.theme.appBackgroundColor),(e=>e.theme.boxShadowElevationOne)),L=j.f.aside.withConfig({displayName:"styled__PreviewContainer",componentId:"sc-ugqkdl-12"})(["flex:0 0 calc(100% - ",");width:calc(100% - ",");padding:0;margin-left:",";"],(e=>Object(b.n)(400+e.theme.gutter)),(e=>Object(b.n)(400+e.theme.gutter)),(e=>Object(b.n)(e.theme.gutter))),B=j.f.div.withConfig({displayName:"styled__PreviewStickContainer",componentId:"sc-ugqkdl-13"})(["box-shadow:",";border-radius:",";background-color:",";position:sticky;top:",";"],(e=>e.theme.boxShadowElevationOne),(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>e.theme.appBackgroundColor),(e=>Object(b.n)(e.theme.gutter+h.f[2].navbarHeight))),D=j.f.div.withConfig({displayName:"styled__PreviewContent",componentId:"sc-ugqkdl-14"})(["height:calc( 100vh - "," );overflow-y:auto;",";padding:",";padding-bottom:270px;"],(e=>Object(b.n)(2*e.theme.gutter+h.f[2].navbarHeight+(e.hasToolbar?53:0))),y.w,(e=>e.hasPadding?Object(b.n)(e.theme.gutter):0)),R=j.f.div.withConfig({displayName:"styled__PreviewToolbar",componentId:"sc-ugqkdl-15"})(["height:",";border-bottom:1px solid ",";padding:"," ",";display:flex;flex-flow:row nowrap;align-items:center;justify-content:center;.to-left,.to-right{flex:0 0 auto;}.to-left{h4.heading{display:inline-block;padding:"," ",";background-color:",";color:",";font-weight:bold;font-size:",";border-radius:",";margin:0 "," 0 0;text-transform:uppercase;font-family:",";code{color:",";text-transform:none;}}}.to-right{margin:0 0 0 auto;padding:0 0 0 ",";}"],(e=>Object(b.n)(e.theme.gutter+33)),(e=>e.theme.borderColorSplit),(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.gutter/4)),(e=>Object(b.n)(e.theme.gutter)),(e=>e.theme.backgroundShade),(e=>e.theme.headingColor),(e=>Object(b.n)(e.theme.fz.small2)),(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>Object(b.n)(e.theme.gutter/2)),(e=>e.theme.fontFamilyMono),(e=>e.theme.errorColor),(e=>Object(b.n)(e.theme.gutter/2))),z=j.f.div.withConfig({displayName:"styled__PreviewEmptyPlaceholder",componentId:"sc-ugqkdl-16"})(["padding:50px 0;max-width:300px;margin:0 auto;"]),A=j.f.section.withConfig({displayName:"styled__DataTableColumns",componentId:"sc-ugqkdl-17"})(["display:flex;flex-flow:row nowrap;align-items:stretch;"]),H=j.f.div.withConfig({displayName:"styled__PreviewHeader",componentId:"sc-ugqkdl-18"})(["display:flex;flex-flow:row nowrap;width:100%;align-items:flex-start;justify-content:flex-start;max-width:100%;"]),V=j.f.h3.withConfig({displayName:"styled__PreviewTitle",componentId:"sc-ugqkdl-19"})(["",";margin:0;padding:0 "," 0 0;font-size:",";font-weight:700;color:",";flex:0 1 auto;.ant-skeleton-content{width:150px;.ant-skeleton-title{margin:0;}}"],b.m,(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.fz.base)),(e=>e.theme.headingColor)),$=j.f.div.withConfig({displayName:"styled__PreviewMeta",componentId:"sc-ugqkdl-20"})(["margin:0 0 0 auto;padding:0;font-size:",";font-weight:400;color:",";flex:0 0 auto;line-height:",";.ant-skeleton-content{.ant-skeleton-title{margin:0;}}"],(e=>Object(b.n)(e.theme.fz.small1)),(e=>e.theme.textColorSecondary),(e=>Object(b.n)(1.5715*e.theme.fz.base))),q=j.f.div.withConfig({displayName:"styled__PreviewData",componentId:"sc-ugqkdl-21"})(["margin:"," 0 0 0;font-size:",";color:",";p{font-size:",";line-height:1.5;}a,button{",";color:",";font-weight:600;&:hover{text-decoration:underline;}}em{font-style:italic;color:",";}strong{font-weight:600;color:",";border-bottom:2px dashed ",";}code{color:",";font-family:",";}p{margin:0 0 "," 0;&:last-child{margin-bottom:0;}}.user-input{word-break:break-all;hyphens:auto;}"],(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.fz.base)),(e=>e.theme.textColor),(e=>Object(b.n)(e.theme.fz.base)),b.a,(e=>e.theme.primaryDarkColor),(e=>e.theme.textColorSecondary),(e=>e.theme.headingColor),(e=>e.theme.borderColorBase),(e=>e.theme.errorColor),(e=>e.theme.fontFamilyMono),(e=>Object(b.n)(e.theme.gutter/2))),U=j.f.div.withConfig({displayName:"styled__PreviewActions",componentId:"sc-ugqkdl-22"})(["margin:"," "," 0;.ant-btn,.ant-skeleton{margin:",";}"],(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.gutter/-4)),(e=>Object(b.n)(e.theme.gutter/4))),W=j.f.div.withConfig({displayName:"styled__Preview",componentId:"sc-ugqkdl-23"})(["width:100%;&.is-header{","{text-transform:uppercase;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}","{.ant-pagination-simple .ant-pagination-simple-pager input{width:40px;text-align:right;}}}"],V,$),K=j.f.main.withConfig({displayName:"styled__DataContainer",componentId:"sc-ugqkdl-24"})(["flex:1 0 ",";max-width:100%;","{.","__row-top{flex-basis:",";flex-grow:",";.","__filters-sorter{margin-left:",";}}.","__row-bottom{margin-left:",";flex-basis:",";.","__view-mode{margin-right:",";}.","__header-pagination{","{padding-right:",";padding-left:",";min-width:120px;.ant-skeleton-content{width:80px;.ant-skeleton-title{margin:0;width:100% !important;}.ant-skeleton-paragraph{display:none;}}}}}}"],(e=>"table"===e.displayMode?"100%":"400px"),x,w,(e=>"table"===e.displayMode?"540px":"100%"),(e=>"table"===e.displayMode?1:0),w,(e=>"table"===e.displayMode?"12px":"auto"),w,(e=>"table"===e.displayMode?"auto":"0px"),(e=>"table"===e.displayMode?"auto":"100%"),w,(e=>"table"===e.displayMode?"16px":"0"),w,V,(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.gutter/2))),Y=j.f.span.withConfig({displayName:"styled__DDBadge",componentId:"sc-ugqkdl-25"})(["display:inline-flex;padding:0.4em 0.5em;margin:0 0.6em 0 0;font-size:10px;line-height:1;font-weight:bold;min-width:3em;align-items:center;justify-content:center;font-variant-numeric:tabular-nums;background-color:",";border-radius:4em;color:",";position:relative;top:-2px;"],(e=>e.theme.borderColorSplit),(e=>e.theme.headingColor)),G=j.f.div.withConfig({displayName:"styled__TableContainer",componentId:"sc-ugqkdl-26"})(["margin:"," 0 0 0;padding:",";background-color:",";border-radius:",";box-shadow:",";"],(e=>Object(b.n)(e.theme.gutter)),(e=>Object(b.n)(e.theme.gutter)),(e=>e.theme.appBackgroundColor),(e=>Object(b.n)(e.theme.borderRadiusBase)),(e=>e.theme.boxShadowElevationOne)),Q=j.f.div.withConfig({displayName:"styled__TableScroller",componentId:"sc-ugqkdl-27"})(["max-width:100%;min-height:300px;border:1px solid ",";border-radius:",";",";"],(e=>e.theme.borderColorSplit),(e=>Object(b.n)(e.theme.borderRadiusBase)),b.q),J=j.f.table.withConfig({displayName:"styled__Table",componentId:"sc-ugqkdl-28"})(["width:100%;border-collapse:separate;border-spacing:0px;border:0 none;font-size:",";vertical-align:top;table-layout:fixed;"],(e=>Object(b.n)(e.theme.fz.small1))),X=Object(b.d)(w,"table-cell"),Z=Object(j.f)(v.animated.tr).withConfig({displayName:"styled__Tr",componentId:"sc-ugqkdl-29"})(["background-color:",";.","--cb,.","--actionButtons{background-color:",";}&:nth-child(2n){background-color:",";.","--cb,.","--actionButtons{background-color:",";}}&:hover{background-color:",";.","--cb,.","--actionButtons{background-color:",";}}transition:",";"],(e=>e.theme.appBackgroundColor),X,X,(e=>e.theme.appBackgroundColor),(e=>e.theme.backgroundControl),X,X,(e=>e.theme.backgroundControl),(e=>e.theme.backgroundHover),X,X,(e=>e.theme.backgroundHover),(e=>Object(b.f)(["background-color"],e.theme.transitionControl))),ee=Object(j.e)(["width:200px;vertical-align:baseline;text-align:left;.ant-skeleton-title{margin:0;}.ant-skeleton-content .ant-skeleton-title{height:",";display:inline-block;vertical-align:middle;}.ant-skeleton-paragraph,.ant-skeleton-title + .ant-skeleton-paragraph{margin:0;display:none;}&.","--cb{position:sticky;left:0;z-index:100;border-right:1px solid ",";box-shadow:1px 0 2px 0 rgb(0 0 0 / 1%),2px 0 3px 0 rgb(0 0 0 / 6%);}&.","--actionButtons{position:sticky;right:0;z-index:100;border-left:1px solid ",";box-shadow:-1px 0 2px 0 rgb(0 0 0 / 1%),-2px 0 3px 0 rgb(0 0 0 / 6%);}transition:",";&:not(.","--actionButtons){",";a{color:",";text-decoration:underline;&:hover{text-decoration:none;}}button{text-align:left;background:transparent;border:0 none;outline:none;padding:0;cursor:pointer;display:inline;color:",";font-weight:400;font-style:normal;text-decoration:underline;&:hover{text-decoration:none;}}}"],(e=>Object(b.n)(1.5*e.theme.fz.base)),X,(e=>e.theme.borderColorSplit),X,(e=>e.theme.borderColorSplit),(e=>Object(b.f)(["background-color"],e.theme.transitionControl)),X,b.m,(e=>e.theme.primaryDarkColor),(e=>e.theme.primaryDarkColor)),te=j.f.th.withConfig({displayName:"styled__Th",componentId:"sc-ugqkdl-30"})(["",";padding:"," ",";font-weight:bold;color:",";border-bottom:1px solid ",";&.","--number{text-align:right;font-variant-numeric:tabular-nums;width:8em;}&.","--cb{padding:"," ",";width:",";.ant-skeleton{height:20px;width:20px;display:block;margin:0;}.ant-skeleton-avatar{height:20px;width:20px;border-radius:",";}}&.","--actionButtons{text-align:right;width:300px;}&.","--primary{width:300px;",";}"],ee,(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.gutter)),(e=>e.theme.headingColor),(e=>e.theme.borderColorSplit),X,X,(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(.75*e.theme.gutter)),(e=>Object(b.n)(1.5*e.theme.gutter+20)),(e=>Object(b.n)(e.theme.borderRadiusBase)),X,X,b.m),ne=j.f.td.withConfig({displayName:"styled__Td",componentId:"sc-ugqkdl-31"})(["",";padding:"," ",";color:",";border-bottom:1px solid ",";&.","--number{text-align:right;font-variant-numeric:tabular-nums;width:8em;}&.","--actionButtons{width:300px;text-align:right;.ant-btn-group{text-align:left;}}"],ee,(e=>Object(b.n)(e.theme.gutter/2)),(e=>Object(b.n)(e.theme.gutter)),(e=>e.theme.textColor),(e=>e.theme.borderColorSplit),X,X),ie=j.f.thead.withConfig({displayName:"styled__Thead",componentId:"sc-ugqkdl-32"})(["","{","{position:sticky;top:0;z-index:100;background-color:",";font-size:",";color:",";&:not(.","--element){text-transform:uppercase;}vertical-align:middle;&.","--cb{z-index:101;}&.","--actionButtons{z-index:101;}}background-color:",";.","--cb,.","--actionButtons{background-color:",";}}"],Z,te,(e=>e.theme.backgroundShade),(e=>Object(b.n)(e.theme.fz.small2)),(e=>e.theme.textColorSecondary),X,X,X,(e=>e.theme.backgroundShade),X,X,(e=>e.theme.backgroundShade)),oe=j.f.tbody.withConfig({displayName:"styled__Tbody",componentId:"sc-ugqkdl-33"})([""]),re=j.f.div.withConfig({displayName:"styled__UserInput",componentId:"sc-ugqkdl-34"})(["",";",";"],b.v,b.m),ae=j.f.span.withConfig({displayName:"styled__MutedText",componentId:"sc-ugqkdl-35"})(["color:",";opacity:0.75;font-weight:400;font-size:",";"],(e=>e.theme.textColorSecondary),(e=>Object(b.n)(e.theme.fz.small1))),se=j.f.div.withConfig({displayName:"styled__DataTableContainer",componentId:"sc-ugqkdl-36"})(["background-color:",";border-radius:",";&:fullscreen{","{height:calc( 100vh - "," );}",",",",","{border-radius:0;}}"],(e=>e.theme.backgroundShade),(e=>Object(b.n)(e.theme.borderRadiusBase)),Q,(e=>Object(b.n)(4*e.theme.gutter+72+52)),x,G,M),ce=j.f.div.withConfig({displayName:"styled__AntMenuItem",componentId:"sc-ugqkdl-37"})(["padding:"," 0;display:flex;flex-flow:row nowrap;align-items:center;justify-content:flex-start;font-size:",";text-transform:uppercase;> .anticon{font-size:",";color:",";margin:0 "," 0 0;}> .ant-btn{display:block;background-color:transparent;border:0 none;margin:0;padding:0;color:inherit;height:22px;width:100%;transition:none;text-align:left;}"],(e=>Object(b.n)(e.theme.gutter/6)),(e=>Object(b.n)(e.theme.fz.small1)),(e=>Object(b.n)(e.theme.fz.small1)),(e=>e.theme.textColorSecondary),(e=>Object(b.n)(e.theme.gutter/2)));var le=n(453),de=n(284),ue=n(1173),me=n(83),he=n(244),be=n(439),pe=n(36),fe=n(21);n(66);function ge(e,t){if("SET_CURRENT_PAGE"===t.type)return{...e,selectedRows:[],currentPage:t.payload.currentPage,previewItemId:null,canTrailItems:!0};if("SET_ITEMS_PER_PAGE"===t.type)return{...e,selectedRows:[],currentPage:1,itemsPerPage:t.payload.itemsPerPage,previewItemId:null,canTrailItems:!0};if("SET_LAST_CLICKED_ITEM_ID"===t.type)return{...e,lastClickedItemId:t.payload.lastClickedItemId};if("SET_PREVIEW_ITEM_ID"===t.type)return{...e,previewItemId:t.payload.previewItemId};if("SET_VIEW"===t.type)return{...e,selectedRows:[],currentPage:1,currentView:t.payload.currentView,filters:t.payload.filters,previewItemId:null,canTrailItems:!0};if("SET_ORDERBY"===t.type)return{...e,selectedRows:[],orderBy:t.payload.orderBy,previewItemId:null,canTrailItems:!0};if("SET_ORDERDIR"===t.type)return{...e,selectedRows:[],orderDir:t.payload.orderDir,previewItemId:null,canTrailItems:!0};if("SET_SEARCH"===t.type)return{...e,selectedRows:[],currentPage:1,search:t.payload.search,previewItemId:null,canTrailItems:!0};if("SET_SELECTED_ROWS"===t.type){const n={...e};return t.payload.selectedRows&&(n.selectedRows=t.payload.selectedRows),t.payload.lastClickedItemId&&(n.lastClickedItemId=t.payload.lastClickedItemId),n}return"SET_FILTERS"===t.type?{...e,selectedRows:[],currentPage:1,filters:t.payload.filters,previewItemId:null,canTrailItems:!0}:"SET_CAN_TRAIL_ITEMS"===t.type?{...e,canTrailItems:t.payload.canTrailItems}:"SET_DISPLAY_MODE"===t.type?{...e,displayMode:t.payload.displayMode}:"SET_STATE"===t.type?t.payload:e}function je(e,t){const n=Object(c.useReducer)(ge,t,e),i=Object(s.a)(n,2);return[i[0],i[1]]}function Oe(e,t){"string"==typeof e.currentView&&""!==e.currentView&&(t.currentView=e.currentView),t.currentPage=Object(pe.d)(e.currentPage,t.currentPage),t.itemsPerPage=e.itemsPerPage?Object(pe.d)(e.itemsPerPage,10):t.itemsPerPage,t.search=e.search?e.search:t.search,t.orderBy=e.orderBy?e.orderBy.toString():t.orderBy,t.orderDir=e.orderDir?e.orderDir.toString():t.orderDir,t.previewItemId=e.previewItemId?e.previewItemId.toString():t.previewItemId,t.displayMode=e.displayMode&&"table"===e.displayMode?"table":"preview"===e.displayMode?"preview":t.displayMode,t.filters&&null!=t.filters&&Object.keys(t.filters).forEach((n=>{var i;t.filters[n]=e[n]?null===(i=e[n])||void 0===i?void 0:i.toString():t.filters[n]}))}function ve(e){const t=e.initialFilters,n=e.initialOrderBy,i=e.initialOrderDir,o=e.initialView,r=e.initialDisplayMode,a=void 0===r?"preview":r;return{currentPage:1,currentView:o,filters:Object(fe.c)(t),itemsPerPage:20,lastClickedItemId:null,orderBy:n,orderDir:i,previewItemId:null,search:"",selectedRows:[],canTrailItems:!0,displayMode:a}}function ye(e){const t=e.currentView,n=e.currentPage,i=e.search,o=e.orderBy,r=e.orderDir,a=e.itemsPerPage,s=e.previewItemId,c={currentView:t,currentPage:n,search:i,orderBy:o,orderDir:r,itemsPerPage:a,previewItemId:null!=s?s:"",displayMode:e.displayMode};return null!=e.filters&&Object.keys(e.filters).forEach((t=>{var n;c[t]=null!==(n=e.filters[t])&&void 0!==n?n:""})),c}const we=Object(c.createContext)((()=>{}));const xe="wpeform-datatable-items-per-page",Ce="wpeform-datatable-display-mode";function _e(e){const t=e.location,n=e.initialDisplayMode,i=void 0===n?"preview":n,o=ve(e);let r=20;try{r=Object(pe.d)(window.localStorage.getItem(xe),20)}catch(e){}o.itemsPerPage=r;let a,s=i;try{s=window.localStorage.getItem(Ce),["preview","table"].includes(s)||(s=i)}catch(e){}o.displayMode=s;try{a=he.parse(t.search)}catch{a={}}return Oe(a,o),o}function ke(e){const t=Object(me.k)(),n=je(_e,{...e,location:t.location}),i=Object(s.a)(n,2),o=i[0],r=i[1];return Object(c.useEffect)((()=>{const e=o.itemsPerPage,n=o.displayMode,i=ye(o),r=`?${he.stringify(i)}`;t.location.search!==r&&t.replace({search:r}),window.localStorage.setItem(xe,e.toString()),window.localStorage.setItem(Ce,n)}),[o,t]),[o,r]}const Se=Object(c.createContext)([]);function Ee(){return Object(c.useContext)(Se)}const Ie=Object(c.createContext)(void 0);function Te(){return Object(c.useContext)(Ie)}function Fe(e){e.forEach((e=>{be.a.evict({id:"ROOT_QUERY",fieldName:e}),be.a.gc()}))}var Pe=n(1);const Ne=j.f.div.withConfig({displayName:"MutationButton__PopConfirmContainer",componentId:"sc-ppnfrf-0"})(["max-width:300px;"]);var Me=n(198);var Le=n(444),Be=n(359),De=n(50),Re=n(10),ze=n.n(Re);function Ae(e,t,n,i="preview"){const o=Object(j.h)();return Object(v.useTransition)(e,{keys:t,from:{opacity:0,transform:"preview"===i?"translate(0px, -30px)":"translate(-20px, 0x)",maxHeight:"400px"},enter:{opacity:1,transform:"translate(0px, 0px)",maxHeight:"400px"},leave:{opacity:0,transform:"translate(20px, 0px)",maxHeight:"0px"},config:{...o.springConfigGeneral,clamp:!0},trail:n.canTrailItems?125:void 0})}function He(e){const t=e.items,n=e.state,i=e.dispatch,o=e.generateItemRow,r=e.getItemId,a=e.handleCb,s=Ae(t,r,n);return Object(Pe.jsx)(Pe.Fragment,{children:s(((e,t)=>{var s;const c=r(t),l=n.selectedRows.includes(c);return Object(Pe.jsx)(F,{style:{opacity:e.opacity,transform:e.transform,maxHeight:null===(s=e.maxHeight)||void 0===s?void 0:s.to((e=>"400px"===e?"none":e))},tabIndex:0,role:"button",className:ze()({focused:n.previewItemId===c,"is-selected":l}),onClick:e=>{i({type:"SET_PREVIEW_ITEM_ID",payload:{previewItemId:c}})},onKeyDown:e=>{"Enter"!==e.code&&"Space"!==e.code||i({type:"SET_PREVIEW_ITEM_ID",payload:{previewItemId:c}})},children:Object(Pe.jsxs)(T,{children:[Object(Pe.jsx)(P,{children:Object(Pe.jsx)(Le.a,{checked:l,value:c,onChange:a,id:null!=c?c:void 0,onClick:e=>{e.stopPropagation()}})}),Object(Pe.jsx)(N,{children:o(t)})]})})}))})}function Ve(e){const t=e.items,n=e.state,o=e.handleCb,r=e.getItemId,a=e.renderTableCell,s=e.tableModeColumns,c=e.masterCb,l=Ae(t,r,n,"table");if(!a)throw new Error("No table cells renderer.");if(!s)throw new Error("No table cells to render.");return Object(Pe.jsx)(G,{children:Object(Pe.jsx)(Q,{children:Object(Pe.jsxs)(J,{children:[Object(Pe.jsx)(ie,{children:Object(Pe.jsxs)(Z,{children:[Object(Pe.jsx)(te,{className:Object(b.c)(X,{cb:!0}),children:c}),s.map((({value:e,label:t,type:n="text",width:i,title:o},r)=>Object(Pe.jsx)(te,{className:Object(b.c)(X,{[n]:!0,primary:0===r}),style:{width:i?Object(b.n)(i):void 0},title:o,children:t},e)))]})}),Object(Pe.jsx)(oe,{children:l(((e,t)=>{var c;const l=r(t),d=n.selectedRows.includes(l);return Object(Pe.jsxs)(Z,{style:{opacity:e.opacity,transform:e.transform,maxHeight:null===(c=e.maxHeight)||void 0===c?void 0:c.to((e=>"400px"===e?"none":e))},children:[Object(Pe.jsx)(te,{className:Object(b.c)(X,{cb:!0}),children:Object(Pe.jsx)(Le.a,{checked:d,value:l,onChange:o,id:null!=l?l:void 0})}),s.map(((e,o)=>{let r=a(t,e,n.currentView);const s=e.type,c=void 0===s?"text":s,l=e.value,d=e.width,u=Object(b.c)(X,{[c]:!0,primary:0===o});return"actionButtons"===c&&(r=Object(Pe.jsx)(i.a.Group,{children:r})),0===o?Object(Pe.jsx)(te,{className:u,style:{width:d?Object(b.n)(d):void 0},children:r},l):Object(Pe.jsx)(ne,{className:u,style:{width:d?Object(b.n)(d):void 0},children:r},l)}))]})}))})]})})})}var $e=n(243);function qe(){return Object(Pe.jsx)(F,{children:Object(Pe.jsxs)(T,{children:[Object(Pe.jsx)(P,{children:Object(Pe.jsx)($e.a.Avatar,{shape:"square",size:"small",active:!0})}),Object(Pe.jsx)(N,{children:Object(Pe.jsxs)(W,{children:[Object(Pe.jsxs)(H,{children:[Object(Pe.jsx)(V,{children:Object(Pe.jsx)($e.a,{paragraph:{rows:0},title:{width:"90%"},active:!0})}),Object(Pe.jsx)($,{children:Object(Pe.jsx)($e.a,{paragraph:{rows:0},title:{width:"58px"},active:!0})})]}),Object(Pe.jsx)(q,{children:Object(Pe.jsx)($e.a,{paragraph:{rows:2},title:!1,active:!0})}),Object(Pe.jsxs)(U,{children:[Object(Pe.jsx)($e.a.Button,{size:"small",active:!0,style:{width:"80px"}}),Object(Pe.jsx)($e.a.Button,{size:"small",active:!0,style:{width:"50px"}}),Object(Pe.jsx)($e.a.Button,{size:"small",active:!0,style:{width:"70px"}})]})]})})]})})}function Ue(e){const t=e.itemsPerPage;return Object(Pe.jsx)(Pe.Fragment,{children:Array.from({length:t}).map(((e,t)=>Object(Pe.jsx)(qe,{},t)))})}const We=Object(Pe.jsx)($e.a.Avatar,{shape:"square",size:"small",active:!0}),Ke=j.f.div.withConfig({displayName:"TableSkeleton__ActionButtonsContainer",componentId:"sc-fbatpy-0"})(["display:flex;flex-flow:row nowrap;align-items:center;justify-content:flex-end;> *{margin:0 2px;}"]);function Ye(e){const t=e.tableModeColumns;return Object(Pe.jsxs)(Z,{children:[Object(Pe.jsx)(te,{className:Object(b.c)(X,{cb:!0}),children:We}),t.map(((e,t)=>{const n=e.type,i=void 0===n?"text":n,o=e.value,r=e.width,a=Object(b.c)(X,{[i]:!0,primary:0===t});let s=Object(Pe.jsx)($e.a,{paragraph:{rows:0},title:{width:r?Object(b.n)(r-40):"80px"},active:!0});return 0===t&&(s=Object(Pe.jsx)($e.a,{paragraph:{rows:0},title:{width:r?Object(b.n)(r-40):"220px"},active:!0})),"actionButtons"===i&&(s=Object(Pe.jsxs)(Ke,{children:[Object(Pe.jsx)($e.a.Button,{active:!0,size:"small",shape:"square"}),Object(Pe.jsx)($e.a.Button,{active:!0,size:"small",shape:"square"}),Object(Pe.jsx)($e.a.Button,{active:!0,size:"small",shape:"square"})]})),0===t?Object(Pe.jsx)(te,{className:a,style:{width:r?Object(b.n)(r):void 0},children:s},o):Object(Pe.jsx)(ne,{className:a,style:{width:r?Object(b.n)(r):void 0},children:s},o)}))]})}function Ge(e){const t=e.itemsPerPage,n=e.tableModeColumns;return Object(Pe.jsx)(G,{children:Object(Pe.jsx)(Q,{children:Object(Pe.jsxs)(J,{children:[Object(Pe.jsx)(ie,{children:Object(Pe.jsxs)(Z,{children:[Object(Pe.jsx)(te,{className:Object(b.c)(X,{cb:!0}),children:We}),n.map((({value:e,label:t,type:n="text",width:i},o)=>Object(Pe.jsx)(te,{className:Object(b.c)(X,{[n]:!0,primary:0===o}),style:{width:i?Object(b.n)(i):void 0},children:t},e)))]})}),Object(Pe.jsx)(oe,{children:Array.from({length:t}).map(((e,t)=>Object(Pe.jsx)(Ye,{tableModeColumns:n},t)))})]})})})}function Qe(e){var t;const n=e.masterCbId,i=e.items,r=e.loadingData,a=e.totalItems,s=e.itemNamePlural,c=e.itemNameSingular,l=e.state,d=e.dispatch,u=e.displayMode,m=Object(h.d)("desktopHd");return Object(Pe.jsxs)(Pe.Fragment,{children:["preview"===u||"table"===u&&m?r&&!i?Object(Pe.jsx)(V,{as:"div",children:Object(Pe.jsx)($e.a,{active:!0,paragraph:{rows:0}})}):Object(Pe.jsx)(V,{title:a>1||0===a?s:c,children:Object(Pe.jsx)("label",{htmlFor:n,children:0===(null==i?void 0:i.length)?Object(Pe.jsx)(Pe.Fragment,{children:"0 "}):Object(Pe.jsxs)(Pe.Fragment,{children:[1+(l.currentPage-1)*l.itemsPerPage,"-",(null!==(t=null==i?void 0:i.length)&&void 0!==t?t:0)+(l.currentPage-1)*l.itemsPerPage," ","/ ",a," "]})})}):null,Object(Pe.jsx)($,{children:Object(Pe.jsx)(o.a,{simple:!0,current:l.currentPage,onChange:e=>{d({type:"SET_CURRENT_PAGE",payload:{currentPage:e}})},total:a,pageSize:l.itemsPerPage})})]})}function Je(e){const t=e.items,n=e.getItemId,i=e.state,o=e.dispatch,a=e.generateItemRow,l=e.totalItems,d=e.itemNameSingular,u=e.itemNamePlural,m=e.loadingData,h=e.emptyText,b=e.displayMode,p=e.renderTableCell,f=e.tableModeColumns,g=Object(c.useMemo)((()=>t?t.map((e=>n(e))):[]),[t,n]),j=i.lastClickedItemId,O=Object(c.useCallback)((e=>{e.target.checked?o({type:"SET_SELECTED_ROWS",payload:{selectedRows:g}}):o({type:"SET_SELECTED_ROWS",payload:{selectedRows:[]}})}),[o,g]),v=!!g.length&&g.every((e=>i.selectedRows.includes(e))),y=!!g.length&&g.some((e=>i.selectedRows.includes(e)))&&!v,w=Object(c.useCallback)((e=>{const t=e.target.value;let n=[...i.selectedRows];if(e.nativeEvent.shiftKey&&j&&g.includes(j)&&g.includes(t)){const i=g.findIndex((e=>e===j)),o=g.findIndex((e=>e===t)),r=Math.min(i,o),a=Math.max(i,o)+1,s=g.slice(r,a);e.target.checked?s.forEach((e=>{n.includes(e)||n.push(e)})):n=n.filter((e=>!s.includes(e)))}else e.target.checked&&!n.includes(t)?n.push(t):!e.target.checked&&n.includes(t)&&Object(De.d)(n,t);o({type:"SET_SELECTED_ROWS",payload:{selectedRows:n,lastClickedItemId:t}})}),[i.selectedRows,o,g,j]),x=Object(c.useState)((()=>Object(Be.a)())),C=Object(s.a)(x,1)[0],_=Object(Pe.jsx)(Le.a,{indeterminate:y,checked:v,onChange:O,id:C}),k=`${i.currentPage}${i.currentView}${JSON.stringify(i.filters)}${i.orderBy}${i.orderDir}${i.search}`;return Object(Pe.jsxs)(I,{as:"preview"===b?"ul":"div",children:["preview"===b?Object(Pe.jsx)(F,{className:"is-header",children:Object(Pe.jsxs)(T,{children:[Object(Pe.jsx)(P,{children:_}),Object(Pe.jsx)(N,{children:Object(Pe.jsx)(W,{className:"is-header",children:Object(Pe.jsx)(H,{children:Object(Pe.jsx)(Qe,{masterCbId:C,dispatch:o,itemNamePlural:u,itemNameSingular:d,items:t,loadingData:m,state:i,totalItems:l,displayMode:b})})})})]})}):null,m&&!t?"preview"===b?Object(Pe.jsx)(Ue,{itemsPerPage:i.itemsPerPage}):Object(Pe.jsx)(Ge,{itemsPerPage:i.itemsPerPage,tableModeColumns:f}):t&&t.length?"preview"===b?Object(Pe.jsx)(He,{items:t,getItemId:n,dispatch:o,generateItemRow:a,handleCb:w,state:i},k):Object(Pe.jsx)(Ve,{items:t,getItemId:n,handleCb:w,state:i,masterCb:_,renderTableCell:p,tableModeColumns:f},k):Object(Pe.jsx)(F,{children:Object(Pe.jsxs)(T,{children:[Object(Pe.jsx)(P,{}),Object(Pe.jsx)(N,{children:Object(Pe.jsx)(W,{children:Object(Pe.jsx)(q,{children:Object(Pe.jsx)(z,{children:Object(Pe.jsx)(r.a,{image:r.a.PRESENTED_IMAGE_SIMPLE,description:h})})})})})]})})]})}var Xe=n(57),Ze=n(363),et=n(1122),tt=n(166),nt=n(239);function it(e){return c.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),c.createElement("path",{d:"M215.116 511.916h-.405c-32.682-.216-60.292-28.608-60.292-62.001V190.96c0-23.558 13.344-44.39 34.826-54.365 21.373-9.926 45.754-6.813 63.796 8.095l127.324 94.817c8.859 6.598 10.693 19.127 4.096 27.986-6.597 8.859-19.127 10.694-27.986 4.096l-127.768-95.147a20.126 20.126 0 01-.959-.761c-9.12-7.701-18.881-4.094-21.655-2.806-2.738 1.272-11.673 6.334-11.673 18.086v258.955c0 12.886 10.833 21.937 20.555 22 4.097.028 8.888-.603 14.516-8.425l64.903-93.859a20.002 20.002 0 0116.433-8.625l106.576-.091c10.207-.526 16.529-8.203 18.851-14.672 1.499-4.174 2.961-12.112-4.09-18.383-8.254-7.34-8.995-19.981-1.655-28.235 7.341-8.255 19.982-8.995 28.236-1.655 17.46 15.526 23.267 39.204 15.155 61.793-8.64 24.059-30.35 40.206-55.31 41.139-.243.009-.486.014-.729.014l-96.525.082-59.042 85.384c-.058.084-.116.167-.176.25-11.821 16.546-28.067 25.283-47.002 25.283zm-36.865-399.494c9.619-5.43 13.015-17.629 7.584-27.249l-35-62c-5.43-9.618-17.628-13.015-27.249-7.584-9.619 5.43-13.015 17.629-7.584 27.249l35 62c3.676 6.512 10.455 10.171 17.435 10.171 3.33 0 6.707-.833 9.814-2.587zm-43.389 45.318c4.271-10.186-.523-21.907-10.709-26.178l-62-26c-10.184-4.271-21.906.523-26.178 10.709-4.271 10.186.523 21.907 10.709 26.178l62 26a19.926 19.926 0 007.726 1.562c7.817 0 15.241-4.611 18.452-12.271zm125.641-64.752l21-67C284.807 15.447 278.94 4.225 268.4.922c-10.542-3.305-21.763 2.562-25.066 13.103l-21 67c-3.304 10.541 2.563 21.763 13.103 25.066 1.991.624 4.006.921 5.988.921 8.509 0 16.398-5.475 19.078-14.024zm54.716 49.166l52-38c8.918-6.517 10.865-19.03 4.348-27.948s-19.03-10.864-27.948-4.348l-52 38c-8.918 6.517-10.865 19.03-4.348 27.948 3.917 5.36 9.998 8.201 16.164 8.201 4.094 0 8.226-1.253 11.784-3.853zM65.017 267.506l56-23c10.217-4.197 15.098-15.881 10.902-26.099-4.196-10.218-15.88-15.098-26.099-10.902l-56 23c-10.217 4.197-15.098 15.881-10.902 26.099 3.175 7.73 10.638 12.406 18.508 12.406a19.929 19.929 0 007.591-1.504z"}))}n.p;function ot(e){const t=e.bulkActions,n=e.dispatch,o=e.isDoingBulk,r=0===e.state.selectedRows.length||o||0===t.length,a=Te(),s=Ee();return Object(Pe.jsx)("div",{className:Object(b.d)(w,"header-bulk-actions"),children:Object(Pe.jsx)(Ze.a,{disabled:r,overlay:Object(Pe.jsx)(nt.a,{children:t.map((e=>Object(Pe.jsx)(nt.a.Item,{danger:e.danger,onClick:()=>{n({type:"SET_PREVIEW_ITEM_ID",payload:{previewItemId:null}}),n({type:"SET_CAN_TRAIL_ITEMS",payload:{canTrailItems:!1}}),e.onClick().then((()=>{n({type:"SET_SELECTED_ROWS",payload:{selectedRows:[]}}),a&&a(),Fe(s)})).catch((()=>{}))},children:e.title},e.id)))}),trigger:["click"],children:Object(Pe.jsxs)(i.a,{size:"small",type:r?"dashed":"default",disabled:o,className:Object(b.d)(w,"bulk-action"),children:[o?Object(Pe.jsx)(et.a,{indicator:Object(Pe.jsx)(tt.a,{style:{fontSize:"14px",marginRight:"8px"},spin:!0})}):Object(Pe.jsxs)(Pe.Fragment,{children:[Object(Pe.jsx)(l.b,{component:it})," "]}),Object(d.__)("BULK ACTION","wp-eform")]})})})}var rt=n(456),at=n(176);function st(e){return c.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),c.createElement("path",{d:"M492 .103H20c-11.046 0-20 8.954-20 20 0 77.49 22.928 145.332 72.155 213.502 30.712 42.531 85.808 73.844 113.845 87.866v121.426a20.002 20.002 0 0011.2 17.96l100 49a19.995 19.995 0 0019.383-.989A20.002 20.002 0 00326 491.897v-82.425c0-11.046-8.954-20-20-20s-20 8.954-20 20v50.353l-60-29.4V308.897a20 20 0 00-11.65-18.173c-37.338-17.156-85.782-47.322-109.766-80.536C64.849 155.163 44.258 100.64 40.597 40.103h430.806c-3.661 60.536-24.252 115.06-63.987 170.085-25.348 35.103-73.046 65.879-109.072 80.807-10.204 4.229-15.049 15.928-10.82 26.133 4.228 10.204 15.927 15.049 26.133 10.82 38.221-15.838 94.204-50.049 126.188-94.343C489.072 165.435 512 97.593 512 20.103c0-11.046-8.954-20-20-20z"}))}n.p;function ct(e){return c.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),c.createElement("path",{d:"M366.996 512c-11.047 0-20-8.953-20-20V175.992h-85.992c-15.777 0-29.895-9.433-35.969-24.035-6.097-14.66-2.812-31.398 8.367-42.648l91.094-91.633C335.828 6.277 350.922 0 366.996 0s31.168 6.277 42.5 17.676l91.094 91.633c11.183 11.246 14.469 27.988 8.37 42.648-6.073 14.602-20.194 24.035-35.972 24.035H451c-11.047 0-20-8.953-20-20s8.953-20 20-20h19.71L381.13 45.88A19.797 19.797 0 00366.996 40a19.804 19.804 0 00-14.133 5.879l-89.582 90.113h83.715c22.059 0 40 17.946 40 40V492c0 11.043-8.953 20-20 20zm-222.008 0c-16.074 0-31.168-6.277-42.5-17.676l-91.093-91.633c-11.184-11.25-14.47-27.988-8.368-42.648 6.07-14.602 20.192-24.04 35.97-24.04h85.991V20c0-11.047 8.953-20 20-20s20 8.953 20 20v316.008c0 22.055-17.945 40-40 40H41.273l89.582 90.113A19.804 19.804 0 00144.988 472c5.344 0 10.364-2.09 14.133-5.879l89.582-90.113h-19.71c-11.048 0-20-8.953-20-20s8.952-20 20-20h21.987c15.778 0 29.895 9.433 35.97 24.035 6.097 14.66 2.816 31.402-8.368 42.648l-91.094 91.633C176.156 505.723 161.063 512 144.988 512z"}))}n.p;var lt=n(1067);function dt(e){const t=e.renderFilters,n=e.state,o=e.dispatch,r=e.orderBys,a=e.resetFilters,u=r.find((e=>e.id===n.orderBy)),m=Object(c.useState)(!1),h=Object(s.a)(m,2),p=h[0],f=h[1],g=Object(c.useState)(!1),j=Object(s.a)(g,2),O=j[0],v=j[1],y=!function(e,t){let n=!0;return Object.keys(t).forEach((i=>{e[i]!==t[i]&&(n=!1)})),n}(n.filters,a);return Object(Pe.jsxs)("div",{className:Object(b.d)(w,"header-controls",Object(b.d)(w,"filters-sorter")),children:[void 0!==t?Object(Pe.jsxs)(i.a.Group,{size:"small",children:[Object(Pe.jsx)(Ze.a,{arrow:!0,visible:O,onVisibleChange:e=>v(e),overlay:Object(Pe.jsx)(S,{children:t}),trigger:["click"],placement:"bottomRight",children:Object(Pe.jsxs)(i.a,{size:"small",type:"default",children:[Object(Pe.jsx)(l.b,{component:st})," ",Object(d.__)("FILTER","wp-eform")]})}),Object(Pe.jsx)(at.a,{placement:"top",title:Object(d.__)("clear all filters.","wp-eform"),children:Object(Pe.jsx)(i.a,{size:"small",type:"default",danger:!0,disabled:!y,onClick:e=>{e.preventDefault(),o({type:"SET_FILTERS",payload:{filters:a}})},children:Object(Pe.jsx)(l.b,{component:lt.a})})})]}):null,Object(Pe.jsx)(at.a,{placement:"top",title:Object(d.__)("Sort by and order","wp-eform"),children:Object(Pe.jsx)(Ze.a,{arrow:!0,visible:p,onVisibleChange:e=>f(e),overlay:Object(Pe.jsxs)(_,{children:[Object(Pe.jsx)(k,{children:r.map((e=>{const t=e.id;return Object(Pe.jsxs)(C,{selected:n.orderBy===t,children:[Object(Pe.jsx)(rt.a,{checked:n.orderBy===t,onChange:e=>{e.target.checked&&o({type:"SET_ORDERBY",payload:{orderBy:t}})}})," ",e.title]},t)}))}),Object(Pe.jsx)(k,{children:null!=u&&u.sorter?Object(Pe.jsxs)(Pe.Fragment,{children:[Object(Pe.jsxs)(C,{selected:"ascend"===n.orderDir,children:[Object(Pe.jsx)(rt.a,{checked:"ascend"===n.orderDir,onChange:e=>{e.target.checked&&o({type:"SET_ORDERDIR",payload:{orderDir:"ascend"}})}})," ",Object(d.__)("Ascending","wp-eform")]}),Object(Pe.jsxs)(C,{selected:"descend"===n.orderDir,children:[Object(Pe.jsx)(rt.a,{checked:"descend"===n.orderDir,onChange:e=>{e.target.checked&&o({type:"SET_ORDERDIR",payload:{orderDir:"descend"}})}})," ",Object(d.__)("Descending","wp-eform")]})]}):null})]}),trigger:["click"],placement:"bottomRight",children:Object(Pe.jsx)(i.a,{size:"small",type:"default",children:Object(Pe.jsx)(l.b,{component:ct})})})})]})}var ut=n(205),mt=n(1106);function ht(e){const t=e.views,n=e.dispatch,o=e.currentView,r=e.resetFilters;return Object(Pe.jsx)(i.a.Group,{size:"small",className:Object(b.d)(w,"views"),children:t.map((e=>{const t=Object(Pe.jsx)(i.a,{size:"small",type:e.id===(null==o?void 0:o.id)?"primary":"dashed",danger:!!e.danger&&e.id===(null==o?void 0:o.id),onClick:t=>{t.preventDefault(),n({type:"SET_VIEW",payload:{currentView:e.id,filters:r}})},children:e.title},e.id);return e.help?Object(Pe.jsx)(at.a,{title:e.help,placement:"bottom",children:t},e.id):t}))})}function bt(e){var t;const n=e.views,o=e.dispatch,r=e.currentView,a=e.resetFilters;return Object(Pe.jsx)(Ze.a,{overlay:Object(Pe.jsx)(nt.a,{children:n.map((e=>Object(Pe.jsx)(nt.a.Item,{danger:!!e.danger&&e.id===(null==r?void 0:r.id),onClick:()=>{o({type:"SET_VIEW",payload:{currentView:e.id,filters:a}})},children:e.ddLabel},e.id)))}),trigger:["click"],children:Object(Pe.jsxs)(i.a,{size:"small",type:"default",style:{minWidth:"122px"},icon:Object(Pe.jsx)(l.b,{component:mt.a}),children:[null!==(t=null==r?void 0:r.ddLabel)&&void 0!==t?t:Object(d.__)("View Mode","wp-eform"),Object(Pe.jsx)(ut.a,{})]})})}function pt(e){const t=e.views,n=e.state,i=e.dispatch,o=e.resetFilters,r=e.displayMode,a=t.find((e=>e.id===n.currentView)),s=Object(h.d)("tablet"),c=Object(h.d)("desktopHd");return Object(Pe.jsx)("div",{className:Object(b.d)(w,"header-controls",Object(b.d)(w,"view-mode")),children:"table"===r?c?Object(Pe.jsx)(ht,{dispatch:i,resetFilters:o,views:t,currentView:a}):Object(Pe.jsx)(bt,{dispatch:i,resetFilters:o,views:t,currentView:a}):s?Object(Pe.jsx)(ht,{dispatch:i,resetFilters:o,views:t,currentView:a}):Object(Pe.jsx)(bt,{dispatch:i,resetFilters:o,views:t,currentView:a})})}function ft(e){return c.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),c.createElement("path",{d:"M511.867 330.25c-.015-15.5-9.285-29.348-23.613-35.273-14.313-5.918-30.625-2.672-41.567 8.27l-57.59 57.589-104.902-104.828 104.848-104.906c15.586-15.598 15.582-40.965-.008-56.555L334.48 39.992l117.47.051h.01c5.34 0 10.364 2.082 14.142 5.86a19.865 19.865 0 015.855 14.152l-.078 117.336-10.961-10.961c-7.813-7.809-20.473-7.809-28.277 0-7.813 7.808-7.813 20.468-.004 28.277l14.05 14.05c10.942 10.942 27.258 14.184 41.567 8.266 14.328-5.925 23.598-19.77 23.613-35.277l.082-121.664c.012-16.039-6.226-31.121-17.57-42.46C483.047 6.288 467.984.05 451.984.05h-.043L330.246 0c-15.484.016-29.324 9.3-35.258 23.648-5.937 14.36-2.699 30.711 8.254 41.665l57.516 57.515-104.852 104.91L151.07 122.977c-15.593-15.582-40.96-15.575-56.55.011l-54.403 54.403-.078-117.328a19.862 19.862 0 015.856-14.153c3.777-3.777 8.796-5.855 14.16-5.855h.011l117.446-.063-11.086 11.09c-7.809 7.809-7.809 20.469 0 28.277 7.808 7.813 20.472 7.813 28.281 0l14.047-14.046c10.953-10.954 14.191-27.31 8.254-41.665C211.074 9.301 197.234.016 181.718 0L60.07.063h-.035c-16.023 0-31.09 6.242-42.422 17.574C6.273 28.977.035 44.055.047 60.09l.082 121.664c.016 15.5 9.285 29.348 23.613 35.273 14.313 5.914 30.625 2.672 41.567-8.27l57.492-57.491 104.832 104.757-104.754 104.809c-15.586 15.594-15.582 40.965.008 56.55l54.5 54.5-117.375.126h-.024c-5.34 0-10.36-2.082-14.136-5.86a19.835 19.835 0 01-5.856-14.16l.121-117.375 10.961 10.961c7.813 7.809 20.473 7.809 28.281 0 7.809-7.808 7.809-20.472 0-28.281l-14.05-14.047c-10.942-10.941-27.254-14.187-41.563-8.27C9.414 300.903.145 314.75.13 330.25L0 451.945c-.016 16.051 6.223 31.137 17.57 42.485C28.902 505.762 43.965 512 59.988 512h.063l121.699-.129c15.5-.016 29.344-9.285 35.27-23.613 5.921-14.309 2.675-30.625-8.266-41.567l-57.586-57.586 104.754-104.812 104.906 104.832c15.594 15.582 40.961 15.574 56.547-.012l54.504-54.504.121 117.38a19.841 19.841 0 01-5.855 14.16 19.865 19.865 0 01-14.141 5.859h-.02l-117.379-.125 10.965-10.961c7.809-7.809 7.809-20.473 0-28.281-7.808-7.809-20.472-7.809-28.28 0l-14.048 14.046c-10.941 10.942-14.187 27.258-8.27 41.567 5.926 14.332 19.77 23.601 35.274 23.617l121.695.129h.067c16.02 0 31.086-6.238 42.418-17.57 11.347-11.348 17.586-26.438 17.566-42.485l-.125-121.695z"}))}n.p;function gt(e){const t=e.containerRef,n=Object(c.useState)(!!document.fullscreenElement),o=Object(s.a)(n,2),r=o[0],a=o[1];return Object(c.useEffect)((()=>{const e=()=>{document.fullscreenElement?a(!0):a(!1)};return document.addEventListener("fullscreenchange",e),()=>document.removeEventListener("fullscreenchange",e)}),[]),document.documentElement.requestFullscreen?Object(Pe.jsx)("div",{className:Object(b.d)(w,"header-controls"),children:Object(Pe.jsx)(at.a,{title:r?Object(d.__)("Exit fullscreen mode.","wp-eform"):Object(d.__)("Enter fullscreen mode.","wp-eform"),children:Object(Pe.jsx)(i.a,{size:"small",type:"dashed",onClick:e=>{var n;(e.preventDefault(),document.fullscreenElement)?document.exitFullscreen():null===(n=t.current)||void 0===n||n.requestFullscreen()},children:Object(Pe.jsx)(l.b,{component:r?lt.a:ft})})})}):null}function jt(e){const t=e.loadingData,n=e.totalItems,i=e.items,f=e.getItemId,g=e.resetFilters,j=void 0===g?{}:g,O=e.generatePreview,v=e.generateItemRow,y=e.itemNamePlural,C=e.itemNameSingular,_=e.state,k=e.dispatch,S=e.views,E=e.renderFilters,I=e.orderBys,T=e.bulkActions,F=e.isDoingBulk,P=e.emptyText,N=e.evictFieldNames,R=e.onMutation,H=e.tableModeColumns,V=e.renderTableCell,$=Object(h.d)("desktop"),q=Object(c.useState)(_.search),U=Object(s.a)(q,2),W=U[0],Y=U[1],G=Object(c.useState)(null!=n?n:0),Q=Object(s.a)(G,2),J=Q[0],X=Q[1];Object(c.useEffect)((()=>{void 0!==n&&X(n)}),[n]);const Z=Object(u.a)(((e,t)=>{t({type:"SET_SEARCH",payload:{search:e}})}),500),ee=Object(c.useCallback)((e=>{const t=e.target.value;Y(t),Z(t,k)}),[Z,k]);Object(c.useEffect)((()=>{Y(_.search)}),[_.search]);const te=Object(c.useRef)(null),ne="table"===_.displayMode&&V&&H&&$?"table":"preview";return Object(Pe.jsx)(we.Provider,{value:k,children:Object(Pe.jsx)(Se.Provider,{value:N,children:Object(Pe.jsx)(Ie.Provider,{value:R,children:Object(Pe.jsxs)(se,{className:w,ref:te,children:[Object(Pe.jsxs)(A,{children:[Object(Pe.jsxs)(K,{displayMode:ne,children:[Object(Pe.jsxs)(x,{children:[Object(Pe.jsxs)("div",{className:Object(b.d)(w,"row-top"),children:["table"===ne?Object(Pe.jsx)(ot,{isDoingBulk:F,bulkActions:T,state:_,dispatch:k}):null,Object(Pe.jsx)("div",{className:Object(b.d)(w,"header-search"),children:Object(Pe.jsx)(a.a,{type:"search",placeholder:Object(d.__)("search items","wp-eform"),prefix:Object(Pe.jsx)(l.b,{component:p}),size:"small",value:W,onChange:ee,allowClear:!0})}),Object(Pe.jsx)(dt,{renderFilters:E,state:_,dispatch:k,orderBys:I,resetFilters:j})]}),Object(Pe.jsxs)("div",{className:Object(b.d)(w,"row-bottom"),children:["table"===ne?Object(Pe.jsx)(gt,{containerRef:te}):null,"preview"===ne?Object(Pe.jsx)(ot,{isDoingBulk:F,bulkActions:T,state:_,dispatch:k}):null,Object(Pe.jsx)(pt,{views:S,state:_,dispatch:k,resetFilters:j,displayMode:ne}),"table"===ne?Object(Pe.jsx)("div",{className:Object(b.d)(w,"header-controls",Object(b.d)(w,"header-pagination")),children:Object(Pe.jsx)(Qe,{dispatch:k,itemNamePlural:y,itemNameSingular:C,loadingData:t,state:_,totalItems:J,items:i,displayMode:ne})}):null]})]}),Object(Pe.jsx)(Je,{loadingData:t,state:_,dispatch:k,generateItemRow:v,getItemId:f,items:i,itemNamePlural:y,itemNameSingular:C,totalItems:J,emptyText:P,displayMode:ne,tableModeColumns:H,renderTableCell:V})]}),$&&"preview"===ne?Object(Pe.jsx)(L,{children:Object(Pe.jsx)(B,{children:"trashed"===_.currentView?Object(Pe.jsx)(D,{children:Object(Pe.jsx)(z,{children:Object(Pe.jsx)(r.a,{description:Object(d.__)("Please untrash the item to see the preview.","wp-eform")})})}):_.previewItemId?O(_.previewItemId):Object(Pe.jsx)(D,{children:Object(Pe.jsx)(z,{children:Object(Pe.jsx)(r.a,{description:Object(d.__)("Please select an item from the list and the preview will show up here.","wp-eform")})})})})}):null]}),Object(Pe.jsx)(M,{children:Object(Pe.jsx)(o.a,{size:"default",showLessItems:!0,showSizeChanger:!0,current:_.currentPage,onChange:e=>{k({type:"SET_CURRENT_PAGE",payload:{currentPage:e}}),te.current&&Object(m.a)(te.current,{verticalOffset:-140})},total:J,pageSize:_.itemsPerPage,onShowSizeChange:(e,t)=>{k({type:"SET_ITEMS_PER_PAGE",payload:{itemsPerPage:t}})}})})]})})})})}jt.FilterMenuItem=E,jt.Preview=W,jt.PreviewHeader=H,jt.PreviewMeta=$,jt.PreviewTitle=V,jt.PreviewData=q,jt.PreviewActions=U,jt.PreviewContent=D,jt.PreviewToolbar=R,jt.ActionButton=function(e){return Object(Pe.jsx)(i.a,{type:"default",...e,size:"small"})},jt.MutationButton=function(e){const t=e.danger,n=void 0!==t&&t,o=e.mutation,r=e.variables,a=e.children,l=e.popconfirm,u=Object(c.useContext)(we),m=Ee(),h=Te(),b=Object(ue.a)(o,{variables:r}),p=Object(s.a)(b,2),f=p[0],g=p[1].loading,j=()=>{u({type:"SET_CAN_TRAIL_ITEMS",payload:{canTrailItems:!1}}),f().then((()=>{h&&h(),Fe(m)})).catch((e=>{de.b.error(e.message||Object(d.__)("Some error occured. Please retry!","wp-eform"))}))};return l?Object(Pe.jsx)(le.a,{title:Object(Pe.jsx)(Ne,{children:l}),onConfirm:j,okText:Object(d.__)("YES","wp-eform"),cancelText:Object(d.__)("NO","wp-eform"),children:Object(Pe.jsx)(i.a,{type:"default",size:"small",danger:n,loading:g,onClick:e=>{e.stopPropagation()},children:a})}):Object(Pe.jsx)(i.a,{type:"default",size:"small",danger:n,onClick:e=>{e.preventDefault(),e.stopPropagation(),j()},loading:g,children:a})},jt.RouterLinkButton=function(e){return Object(Pe.jsx)(Me.Link,{...e,className:"ant-btn ant-btn-default ant-btn-sm"})},jt.AnchorButton=function(e){return Object(Pe.jsx)("a",{...e,className:"ant-btn ant-btn-default ant-btn-sm"})},jt.Empty=function(e){return Object(Pe.jsx)(z,{children:Object(Pe.jsx)(r.a,{description:e.children})})},jt.DisplayModeUI=function(e){const t=e.state.displayMode;return Object(h.d)("desktop")?Object(Pe.jsxs)(Xe.b,{value:t,onChange:t=>{e.dispatch({type:"SET_DISPLAY_MODE",payload:{displayMode:t}})},children:[Object(Pe.jsxs)(Xe.b.Button,{size:"small",value:"table",children:[Object(Pe.jsx)(l.b,{component:g})," ",Object(d.__)("TABLE","wp-eform")]}),Object(Pe.jsxs)(Xe.b.Button,{size:"small",value:"preview",children:[Object(Pe.jsx)(l.b,{component:f})," ",Object(d.__)("LIST","wp-eform")]})]}):null},jt.Badge=Y,jt.UserInput=re,jt.MutedText=ae,jt.AntMenuItem=ce},1066:function(e,t,n){"use strict";n.d(t,"b",(function(){return o})),n.d(t,"a",(function(){return r}));var i=n(3);const o=new(n(148).a)("EForm Fonts");function r(e){if(!o.hasItem(e))return["inherit",null];const t=o.getItem(e);return[t.fontFamily,t.enqueue]}o.addItem("inherit",{name:Object(i.__)("Inherit from theme","wp-eform"),fontFamily:"inherit",enqueue:null}),o.addItem("system",{name:Object(i.__)("System UI","wp-eform"),fontFamily:'-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"',enqueue:null}),o.addItem("systemMono",{name:Object(i.__)("System UI Mono","wp-eform"),fontFamily:"'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, Courier, monospace",enqueue:null}),o.addItem("custom",{name:Object(i.__)("Custom Font","wp-eform"),fontFamily:"",enqueue:null}),o.addItem("alegreya",{name:"Alegreya",fontFamily:"'Alegreya', serif",enqueue:"https://fonts.googleapis.com/css2?family=Alegreya:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),o.addItem("b612",{name:"B612",fontFamily:"'B612', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=B612:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),o.addItem("titilliumweb",{name:"Titillium Web",fontFamily:"'Titillium Web', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Titillium+Web:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),o.addItem("vollkorn",{name:"Vollkorn",fontFamily:"'Vollkorn', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Vollkorn:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),o.addItem("ibmplexsans",{name:"IBM Plex Sans",fontFamily:"'IBM Plex Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap"}),o.addItem("crimsontext",{name:"Crimson Text",fontFamily:"'Crimson Text', serif",enqueue:"https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap"}),o.addItem("karla",{name:"Karla",fontFamily:"'Karla', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Karla:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),o.addItem("lora",{name:"Lora",fontFamily:"'Lora', serif",enqueue:"https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"}),o.addItem("playfairdisplay",{name:"Playfair Display",fontFamily:"'Playfair Display', serif",enqueue:"https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),o.addItem("archivo",{name:"Archivo",fontFamily:"'Archivo', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"}),o.addItem("spectral",{name:"Spectral",fontFamily:"'Spectral', serif",enqueue:"https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"}),o.addItem("roboto",{name:"Roboto",fontFamily:"'Roboto', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"}),o.addItem("montserrat",{name:"Montserrat",fontFamily:"'Montserrat', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),o.addItem("rubik",{name:"Rubik",fontFamily:"'Rubik', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),o.addItem("sourcesanspro",{name:"Source Sans Pro",fontFamily:"'Source Sans Pro', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap"}),o.addItem("cormorant",{name:"Cormorant",fontFamily:"'Cormorant', serif",enqueue:"https://fonts.googleapis.com/css2?family=Cormorant:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"}),o.addItem("worksans",{name:"Work Sans",fontFamily:"'Work Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),o.addItem("arvo",{name:"Arvo",fontFamily:"'Arvo', serif",enqueue:"https://fonts.googleapis.com/css2?family=Arvo:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),o.addItem("lato",{name:"Lato",fontFamily:"'Lato', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"}),o.addItem("ubuntu",{name:"Ubuntu",fontFamily:"'Ubuntu', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"}),o.addItem("ptserif",{name:"PT Serif",fontFamily:"'PT Serif', serif",enqueue:"https://fonts.googleapis.com/css2?family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),o.addItem("ptsans",{name:"PT Sans",fontFamily:"'PT Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=PT+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),o.addItem("poppins",{name:"Poppins",fontFamily:"'Poppins', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),o.addItem("firasans",{name:"Fira Sans",fontFamily:"'Fira Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),o.addItem("nunito",{name:"Nunito",fontFamily:"'Nunito', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"}),o.addItem("exo2",{name:"Exo 2",fontFamily:"'Exo 2', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),o.addItem("opensans",{name:"Open Sans",fontFamily:"'Open Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap"}),o.addItem("merriweather",{name:"Merriweather",fontFamily:"'Merriweather', serif",enqueue:"https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"}),o.addItem("notosans",{name:"Noto Sans",fontFamily:"'Noto Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),o.addItem("spacemono",{name:"Space Mono",fontFamily:"'Space Mono', monospace",enqueue:"https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap"}),o.addItem("librefranklin",{name:"Libre Franklin",fontFamily:"'Libre Franklin', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),o.addItem("alegreyasans",{name:"Alegreya Sans",fontFamily:"'Alegreya Sans', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&display=swap"}),o.addItem("chivo",{name:"Chivo",fontFamily:"'Chivo', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Chivo:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap"}),o.addItem("sourceserifpro",{name:"Source Serif Pro",fontFamily:"'Source Serif Pro', serif",enqueue:"https://fonts.googleapis.com/css2?family=Source+Serif+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap"}),o.addItem("archivonarrow",{name:"Archivo Narrow",fontFamily:"'Archivo Narrow', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Archivo+Narrow:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"}),o.addItem("prozalibre",{name:"Proza Libre",fontFamily:"'Proza Libre', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Proza+Libre:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap"}),o.addItem("cabin",{name:"cabin",fontFamily:"'Cabin', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"}),o.addItem("raleway",{name:"Raleway",fontFamily:"'Raleway', sans-serif",enqueue:"https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"}),o.addItem("anonymouspro",{name:"Anonymous Pro",fontFamily:"'Anonymous Pro', monospace",enqueue:"https://fonts.googleapis.com/css2?family=Anonymous+Pro:ital,wght@0,400;0,700;1,400;1,700&display=swap"})},1067:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));var i=n(0);function o(e){return i.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),i.createElement("path",{d:"M357.14 181.14l-73.355 73.36 73.356 73.36c7.812 7.808 7.812 20.472 0 28.28A19.929 19.929 0 01343 362a19.929 19.929 0 01-14.14-5.86l-73.36-73.355-73.36 73.356A19.929 19.929 0 01168 362a19.929 19.929 0 01-14.14-5.86c-7.813-7.808-7.813-20.472 0-28.28l73.355-73.36-73.356-73.36c-7.812-7.808-7.812-20.472 0-28.28 7.809-7.813 20.473-7.813 28.282 0l73.359 73.355 73.36-73.356c7.808-7.812 20.472-7.812 28.28 0 7.813 7.809 7.813 20.473 0 28.282zm79.88-106.16C388.668 26.63 324.379 0 256 0S123.332 26.629 74.98 74.98C26.63 123.332 0 187.621 0 256s26.629 132.668 74.98 181.02C123.332 485.37 187.621 512 256 512c46.813 0 92.617-12.758 132.46-36.895 9.45-5.722 12.47-18.02 6.747-27.464-5.723-9.45-18.023-12.47-27.469-6.746C334.145 461.242 295.504 472 256 472c-119.102 0-216-96.898-216-216S136.898 40 256 40s216 96.898 216 216c0 42.59-12.664 84.043-36.625 119.887-6.14 9.18-3.672 21.601 5.512 27.742 9.18 6.137 21.601 3.672 27.742-5.512C497 355.676 512 306.531 512 256c0-68.379-26.629-132.668-74.98-181.02z"}))}n.p},1069:function(e,t,n){"use strict";n.d(t,"a",(function(){return u}));n(0);var i=n(3),o=n(7),r=n(8),a=n(147),s=n(2),c=n(364),l=n(1039),d=n(1);o.f.div.withConfig({displayName:"GenericApolloError__ButtonContainer",componentId:"sc-10t13a5-0"})(["margin:"," ",";"],(e=>Object(s.n)(e.theme.gutter)),(e=>Object(s.n)(e.theme.gutter/-2)));function u(e){const t=e.children,n=e.themeStyle,o=e.error,s=e.retry,u=e.title,m=e.hideReload,h=void 0!==m&&m,b=e.retryLabel,p=e.widthOverride,f=e.ssr,g=void 0!==f&&f,j=e.type,O=void 0===j?"500":j;return Object(d.jsx)(l.a,{themeStyle:n,widthOverride:p,ssr:g,children:Object(d.jsx)(c.a,{type:O,title:u,description:Object(d.jsxs)(d.Fragment,{children:[t,o?Object(d.jsxs)(d.Fragment,{children:[Object(d.jsx)("p",{children:Object(i.__)("More information on the error can be found below.","wp-eform")}),Object(d.jsx)("p",{children:o.message})]}):null]}),footer:!h||s?Object(d.jsxs)(d.Fragment,{children:[h?null:Object(d.jsx)(a.b,{style:"3d",size:r.o.SMALL,onClick:()=>{window.location.reload()},children:Object(i.__)("RELOAD PAGE","wp-eform")}),s?Object(d.jsx)(a.b,{style:"3d",size:r.o.SMALL,onClick:s,colorful:!1,children:null!=b?b:Object(i.__)("RETRY WITHOUT RELOAD","wp-eform")}):null]}):null})})}},1070:function(e,t,n){"use strict";n.d(t,"a",(function(){return b}));n(0);var i=n(7),o=n(438),r=n(2),a=n(1078),s=n(1);const c=i.f.div.withConfig({displayName:"SubmissionSkeleton__SkeletonContainer",componentId:"sc-1eq1qk1-0"})([""," margin:0 auto;"],r.b);function l(){const e=Object(i.h)();return Object(s.jsxs)(s.Fragment,{children:[Object(s.jsx)(o.b,{shape:"rectangle",height:32+e.gutter/2,width:"100%",marginBottom:"small"}),Object(s.jsx)(o.b,{shape:"rectangle",height:2,width:"100%",marginBottom:"large"})]})}function d(){return Object(s.jsxs)(s.Fragment,{children:[Object(s.jsx)(l,{}),Object(s.jsx)(o.b,{shape:"rectangle",height:167,width:"100%",marginBottom:"large"})]})}const u=[52,36,49,65,42,63,86,38,75,57,43,51,85,72,44,55,45,59,75,76];function m(e){const t=Object(i.h)(),n=e.widthSet,r=u[n%u.length-1];return Object(s.jsxs)(s.Fragment,{children:[Object(s.jsx)(o.b,{shape:"rectangle",width:`${r}%`,height:1.5*t.fz.base,marginBottom:"small"}),Object(s.jsx)(o.b,{shape:"rectangle",width:"100%",height:92,marginBottom:"large"}),Object(s.jsx)(o.b,{shape:"rectangle",width:"100%",height:2,marginBottom:"large"})]})}function h(e){const t=Object(i.h)(),n=[];for(let t=0;t<e.controls;t++)n.push(Object(s.jsx)(m,{widthSet:t+1},t));return Object(s.jsxs)(s.Fragment,{children:[Object(s.jsx)(o.b,{shape:"rectangle",height:1.5*t.fz.small1+t.gutter/6,width:"100%",marginBottom:t.gutter/6}),Object(s.jsx)(o.b,{shape:"rectangle",height:1,width:"100%",marginBottom:"large"}),n]})}function b(e){const t=e.panels,n=void 0===t?2:t,i=e.controls,o=void 0===i?5:i,r=[];for(let e=0;e<n;e++)r.push(Object(s.jsx)(h,{controls:0===e?o:3},e));return Object(s.jsx)(c,{className:"wpeform-component-submissionskeleton",children:Object(s.jsxs)(a.a,{children:[Object(s.jsx)(d,{}),r]})})}b.PreviewToolbar=l},1072:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));const i=n(1189).a`
	fragment FElemAttributeConfig on FormElementConfigAttributesType {
		defaultValue
		prefilParameter
		prefilType
		readonly
	}
`},1073:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));const i=n(1189).a`
	fragment FElemInterfaceOptionsConfig on FormElementConfigMcqOptionType {
		answerDescription
		id
		label
		num
	}
`},1074:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));const i=n(1189).a`
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
`},1075:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));const i=n(1189).a`
	fragment FElemValidationFiltersConfig on FormElementConfigFiltersType {
		type
		minItems
		maxItems
		minString
		maxString
		minNum
		maxNum
	}
`},1076:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));const i=n(1189).a`
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
`},1077:function(e,t,n){"use strict";n(8)},1078:function(e,t,n){"use strict";n.d(t,"a",(function(){return s}));n(0);var i=n(7),o=n(2),r=n(1);const a=i.f.div.withConfig({displayName:"Wrapper__Container",componentId:"sc-cwluc8-0"})(["",";font-family:",";padding:",";background-color:",";border-radius:",";border:1px solid ",";"],o.b,(e=>e.theme.fontFamilyBody),(e=>Object(o.n)(e.theme.gutter)),(e=>e.theme.appBackgroundColor),(e=>Object(o.n)(e.theme.borderRadiusBase)),(e=>e.theme.borderColorLight));function s(e){return Object(r.jsx)(a,{children:e.children})}},1079:function(e,t,n){"use strict";n.d(t,"a",(function(){return w}));var i=n(1189);const o=i.a`
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
`;var r=n(1045),a=n(1046);const s=i.a`
	fragment FHeadingConfig on FormElementHeadingConfigType {
		interface {
			divider
			icon
			showTop
			size
			tag
		}
	}
`;var c=n(1047),l=n(1048),d=n(1049),u=n(1050),m=n(1051),h=n(1052),b=n(1053),p=n(1054),f=n(1055),g=n(1056),j=n(1057),O=n(1058),v=n(1059),y=n(1060);const w=i.a`
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
	${o}
	${r.a}
	${a.a}
	${s}
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
	${y.a}
`},1080:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));const i=n(1189).a`
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
`},1081:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));const i=n(1189).a`
	fragment FConfigSettingsTImer on FormSettingsTimerType {
		recordSubmissionTime
		showStopwatch
		submitTimer
		showTimer
		timeLimit
		timerMessage
	}
`},1082:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));const i=n(1189).a`
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
`},1083:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));const i=n(1189).a`
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
`},1084:function(e,t,n){"use strict";n.d(t,"a",(function(){return i}));const i=n(1189).a`
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
`},1085:function(e,t,n){"use strict";n.d(t,"useGesture",(function(){return c}));var i=n(1040),o=n(0),r=n.n(o),a=n(1086);n(1061),n(1062);function s(e,t={},n,i){const o=r.a.useMemo((()=>new a.a(e)),[]);if(o.applyHandlers(e,i),o.applyConfig(t,n),r.a.useEffect(o.effect.bind(o)),r.a.useEffect((()=>o.clean.bind(o)),[]),void 0===t.target)return o.bind.bind(o)}function c(e,t){return([i.a,i.d,i.f,i.g,i.c,i.b].forEach(i.e),function(e,t){const n=Object(a.b)(e,t||{}),i=n.handlers,o=n.nativeHandlers;return s(i,n.config,void 0,o)})(e,t||{})}},1086:function(e,t,n){"use strict";n.d(t,"a",(function(){return u})),n.d(t,"b",(function(){return f}));var i=n(6),o=n(1034);function r(e,t){if(null==e)return{};var n,i,o=function(e,t){if(null==e)return{};var n,i,o={},r=Object.keys(e);for(i=0;i<r.length;i++)n=r[i],t.indexOf(n)>=0||(o[n]=e[n]);return o}(e,t);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(e);for(i=0;i<r.length;i++)n=r[i],t.indexOf(n)>=0||Object.prototype.propertyIsEnumerable.call(e,n)&&(o[n]=e[n])}return o}const a={target(e){if(e)return()=>"current"in e?e.current:e},enabled:(e=!0)=>e,window:(e=(o.c.isBrowser?window:void 0))=>e,eventOptions:({passive:e=!0,capture:t=!1}={})=>({passive:e,capture:t}),transform:e=>e},s=["target","eventOptions","window","enabled","transform"];function c(e={},t){const n={};for(const r of Object.entries(t)){var o=Object(i.a)(r,2);const t=o[0],a=o[1];switch(typeof a){case"function":n[t]=a.call(n,e[t],t,e);break;case"object":n[t]=c(e[t],a);break;case"boolean":a&&(n[t]=e[t])}}return n}class l{constructor(e,t){Object(o.e)(this,"_listeners",new Set),this._ctrl=e,this._gestureKey=t}add(e,t,n,i,r){const a=this._listeners,s=Object(o.q)(t,n),c=this._gestureKey?this._ctrl.config[this._gestureKey].eventOptions:{},l=Object(o.d)(Object(o.d)({},c),r);e.addEventListener(s,i,l);const d=()=>{e.removeEventListener(s,i,l),a.delete(d)};return a.add(d),d}clean(){this._listeners.forEach((e=>e())),this._listeners.clear()}}class d{constructor(){Object(o.e)(this,"_timeouts",new Map)}add(e,t,n=140,...i){this.remove(e),this._timeouts.set(e,window.setTimeout(t,n,...i))}remove(e){const t=this._timeouts.get(e);t&&window.clearTimeout(t)}clean(){this._timeouts.forEach((e=>{window.clearTimeout(e)})),this._timeouts.clear()}}class u{constructor(e){Object(o.e)(this,"gestures",new Set),Object(o.e)(this,"_targetEventStore",new l(this)),Object(o.e)(this,"gestureEventStores",{}),Object(o.e)(this,"gestureTimeoutStores",{}),Object(o.e)(this,"handlers",{}),Object(o.e)(this,"config",{}),Object(o.e)(this,"pointerIds",new Set),Object(o.e)(this,"touchIds",new Set),Object(o.e)(this,"state",{shared:{shiftKey:!1,metaKey:!1,ctrlKey:!1,altKey:!1}}),function(e,t){t.drag&&m(e,"drag");t.wheel&&m(e,"wheel");t.scroll&&m(e,"scroll");t.move&&m(e,"move");t.pinch&&m(e,"pinch");t.hover&&m(e,"hover")}(this,e)}setEventIds(e){return Object(o.l)(e)?(this.touchIds=new Set(Object(o.f)(e)),this.touchIds):"pointerId"in e?("pointerup"===e.type||"pointercancel"===e.type?this.pointerIds.delete(e.pointerId):"pointerdown"===e.type&&this.pointerIds.add(e.pointerId),this.pointerIds):void 0}applyHandlers(e,t){this.handlers=e,this.nativeHandlers=t}applyConfig(e,t){this.config=function(e,t,n={}){const i=e,l=i.target,d=i.eventOptions,u=i.window,m=i.enabled,h=i.transform,b=r(i,s);if(n.shared=c({target:l,eventOptions:d,window:u,enabled:m,transform:h},a),t){const e=o.a.get(t);n[t]=c(Object(o.d)({shared:n.shared},b),e)}else for(const e in b){const t=o.a.get(e);t&&(n[e]=c(Object(o.d)({shared:n.shared},b[e]),t))}return n}(e,t,this.config)}clean(){this._targetEventStore.clean();for(const e of this.gestures)this.gestureEventStores[e].clean(),this.gestureTimeoutStores[e].clean()}effect(){return this.config.shared.target&&this.bind(),()=>this._targetEventStore.clean()}bind(...e){const t=this.config.shared,n={};let i;if(!t.target||(i=t.target(),i)){if(t.enabled){for(const t of this.gestures){const r=this.config[t],a=h(n,r.eventOptions,!!i);if(r.enabled){new(o.b.get(t))(this,e,t).bind(a)}}const r=h(n,t.eventOptions,!!i);for(const t in this.nativeHandlers)r(t,"",(n=>this.nativeHandlers[t](Object(o.d)(Object(o.d)({},this.state.shared),{},{event:n,args:e}))),void 0,!0)}for(const e in n)n[e]=Object(o.g)(...n[e]);if(!i)return n;for(const e in n){const t=Object(o.n)(e),r=t.device,a=t.capture,s=t.passive;this._targetEventStore.add(i,r,"",n[e],{capture:a,passive:s})}}}}function m(e,t){e.gestures.add(t),e.gestureEventStores[t]=new l(e,t),e.gestureTimeoutStores[t]=new d}const h=(e,t,n)=>(i,r,a,s={},c=!1)=>{var l,d;const u=null!==(l=s.capture)&&void 0!==l?l:t.capture,m=null!==(d=s.passive)&&void 0!==d?d:t.passive;let h=c?i:Object(o.h)(i,r,u);n&&m&&(h+="Passive"),e[h]=e[h]||[],e[h].push(a)},b=/^on(Drag|Wheel|Scroll|Move|Pinch|Hover)/;function p(e,t,n,i,r,a){if(!e.has(n))return;if(!o.b.has(i))return void 0;const s=n+"Start",c=n+"End";r[i]=e=>{let i;return e.first&&s in t&&t[s](e),n in t&&(i=t[n](e)),e.last&&c in t&&t[c](e),i},a[i]=a[i]||{}}function f(e,t){const n=function(e){const t={},n={},i=new Set;for(let o in e)b.test(o)?(i.add(RegExp.lastMatch),n[o]=e[o]):t[o]=e[o];return[n,t,i]}(e),o=Object(i.a)(n,3),r=o[0],a=o[1],s=o[2],c={};return p(s,r,"onDrag","drag",c,t),p(s,r,"onWheel","wheel",c,t),p(s,r,"onScroll","scroll",c,t),p(s,r,"onPinch","pinch",c,t),p(s,r,"onMove","move",c,t),p(s,r,"onHover","hover",c,t),{handlers:c,config:t,nativeHandlers:a}}},1087:function(e,t,n){"use strict";n.d(t,"a",(function(){return Ot}));var i=n(42),o=n(0),r=n(15),a=n(3),s=n(10),c=n.n(s),l=n(53),d=n(162),u=n.n(d),m=n(7),h=n(283),b=n(1085),p=n(2),f=n(18),g=n(287),j=n(29),O=n(1);const v="wpeform-component-progressbar",y=Object(p.d)(v,"bar"),w=Object(m.g)(["0%{width:0;opacity:0.1;}20%{width:0;opacity:0.5;}100%{width:100%;opacity:0;}"]),x=Object(m.f)(l.animated.div).withConfig({displayName:"Progressbar__AnimatedTabsProgress",componentId:"sc-70ygvj-0"})(["will-change:width;background-color:",";height:",";position:relative;&.","--is-active{&::before{position:absolute;top:0;right:0;bottom:0;left:0;background:",";opacity:0;animation:"," 2.4s cubic-bezier(0.23,1,0.32,1) infinite;content:'';}}"],(e=>e.theme.primaryColor),(e=>Object(p.n)(.25*e.theme.controlHeightBase)),y,(e=>e.theme.primaryBgText),w),C=Object(m.f)(l.animated.span).withConfig({displayName:"Progressbar__ProgressLabel",componentId:"sc-70ygvj-1"})(["margin:0;padding:0;color:",";font-size:",";line-height:1;font-weight:bold;position:absolute;right:0.2em;"],(e=>e.theme.textColorSecondary),(e=>Object(p.n)(e.theme.fz.small2))),_=m.f.div.withConfig({displayName:"Progressbar__ProgressContainer",componentId:"sc-70ygvj-2"})(["height:",";background-color:",";overflow:hidden;width:100%;"],(e=>Object(p.n)(.25*e.theme.controlHeightBase)),(e=>Object(j.d)(.05,e.theme.disabledColor))),k=m.f.div.withConfig({displayName:"Progressbar__ProgressbarWrapper",componentId:"sc-70ygvj-3"})(["",";position:relative;&.","--is-bottom-rounded{","{border-bottom-left-radius:",";border-bottom-right-radius:",";}}&.","--is-top-rounded{","{border-top-left-radius:",";border-top-right-radius:",";}}&.","--is-bottom-rounded.","--is-top-rounded{",",",",","::before{border-radius:",";}}&.","--label-position-top{","{top:-1.2em;}}&.","--label-position-bottom{","{bottom:-1.2em;}}"],p.b,v,_,(e=>Object(p.n)(e.theme.borderRadiusBase)),(e=>Object(p.n)(e.theme.borderRadiusBase)),v,_,(e=>Object(p.n)(e.theme.borderRadiusBase)),(e=>Object(p.n)(e.theme.borderRadiusBase)),v,v,_,x,x,(e=>Object(p.n)(.25*e.theme.controlHeightBase)),v,C,v,C);function S(e){const t=e.width,n=e.active,i=void 0!==n&&n,o=e.isBottomRounded,r=void 0!==o&&o,a=e.isTopRounded,s=void 0!==a&&a,c=e.showLabel,d=void 0===c||c,u=e.precision,h=void 0===u?2:u,b=e.labelPosition,f=void 0===b?"top":b,g=Object(m.h)(),j=Object(l.useSpring)({from:{width:"0%"},to:{width:`${t}%`},config:{...g.springConfigSlow,clamp:!0}}),w=Object(l.useSpring)({number:t,from:{number:0},config:{...g.springConfigSlow,clamp:!0}});return Object(O.jsxs)(k,{className:Object(p.c)(v,{"is-bottom-rounded":r,"is-top-rounded":s,"is-active":i,[`label-position-${f}`]:!0}),children:[Object(O.jsx)(_,{children:Object(O.jsx)(x,{style:j,className:Object(p.c)(y,{"is-active":!!i}),"aria-valuenow":t,"aria-valuemin":0,"aria-valuemax":100})}),d?Object(O.jsx)(C,{children:w.number.to((e=>`${e.toFixed(h)}%`))}):null]})}var E=n(8),I=n(36),T=n(361),F=n(66);const P="wpeform-component-tabs",N=Object(p.d)(P,"nav-button"),M=Object(p.d)(P,"button"),L=Object(p.d)(P,"button-icon"),B=Object(p.d)(P,"button-label"),D=Object(p.d)(P,"button-label-title"),R=Object(p.d)(P,"button-label-subtitle"),z=m.f.div.withConfig({displayName:"styled__TabsContainer",componentId:"sc-1t0opj6-0"})(["",";box-shadow:",";border-radius:",";overflow-anchor:none;background-color:",";"],p.b,(e=>e.theme.boxShadow4dp),(e=>Object(p.n)(e.theme.borderRadiusBase)),(e=>e.theme.appBackgroundColor)),A=m.f.nav.withConfig({displayName:"styled__TabsNavigation",componentId:"sc-1t0opj6-1"})(["background-color:",";border-top-left-radius:",";border-top-right-radius:",";overflow:hidden;display:flex;flex-flow:row nowrap;align-items:stretch;width:100%;position:relative;z-index:2;.","{padding:0;justify-content:center;position:absolute;left:0;top:0;flex:0 0 ",";width:",";height:100%;z-index:1;background-color:transparent;background-image:linear-gradient( to right,",","," 50%,"," 100% );&::before{position:absolute;pointer-events:none;content:'';display:block;top:0;left:0;width:100%;height:100%;background-color:",";opacity:0;transition:",";}&:disabled{opacity:0;pointer-events:none;}.","{position:relative;}.","{font-size:",";}&.right{background-image:linear-gradient( to left,",","," 50%,"," 100% );left:auto;right:0;}&:hover,&:focus{background-color:transparent;&::before{opacity:1;}}&:active{.","{transform:scale(0.8);}}}"],(e=>e.theme.primaryLightColor),(e=>Object(p.n)(e.theme.borderRadiusBase)),(e=>Object(p.n)(e.theme.borderRadiusBase)),N,(e=>Object(p.n)(.75*e.theme.gutter)),(e=>Object(p.n)(.75*e.theme.gutter)),(e=>e.theme.primaryLightColor),(e=>e.theme.primaryLightColor),(e=>Object(j.e)(1,e.theme.primaryLightColor)),(e=>e.theme.primaryColor),(e=>Object(p.f)(["opacity"],e.theme.transitionControl)),B,D,(e=>Object(p.n)(e.theme.fz.small2)),(e=>e.theme.primaryLightColor),(e=>e.theme.primaryLightColor),(e=>Object(j.e)(1,e.theme.primaryLightColor)),B),H=Object(m.f)(l.animated.div).withConfig({displayName:"styled__TabsScroller",componentId:"sc-1t0opj6-2"})(["flex:1 0 auto;width:100%;will-change:transform;touch-action:pan-y;"]),V=(Object(m.f)(l.animated.div).withConfig({displayName:"styled__AnimatedTabPanel",componentId:"sc-1t0opj6-3"})(["will-change:opacity,position,transform;"]),m.f.div.withConfig({displayName:"styled__TabsNavButtonsContainer",componentId:"sc-1t0opj6-4"})(["display:flex;flex-flow:row nowrap;touch-action:pan-y;"])),$=m.f.button.withConfig({displayName:"styled__TabButton",componentId:"sc-1t0opj6-5"})(["font-family:",";position:relative;overflow:hidden;flex:0 0 auto;display:flex;align-items:center;justify-content:flex-start;padding:"," ",";min-height:",";border:0 none;margin:0;outline:none;border-radius:0;background-color:",";cursor:pointer;color:",";text-align:left;transition:",";&.","--active{background-color:",";color:",";}&:hover{background-color:",";}&:focus{background-color:",";color:",";}&:active{.","{transform:scale(0.97);transform-origin:center center;}}.","{font-size:",";margin:0 "," 0 0;flex:0 0 auto;}.","{flex:0 0 auto;display:flex;flex-flow:column nowrap;}.","{font-size:",";font-weight:",";line-height:1;white-space:nowrap;}.","{font-size:",";font-style:",";line-height:1;white-space:nowrap;margin:0;}"],(e=>e.theme.fontFamilyHeading),(e=>Object(p.n)(e.theme.gutter/2)),(e=>Object(p.n)(e.theme.gutter)),(e=>Object(p.n)(1.25*e.theme.controlHeightBase)),(e=>e.theme.primaryLightColor),(e=>Object(j.e)(.3,e.theme.primaryBgText)),(e=>Object(p.f)(["background-color","color"],e.theme.transitionControl)),M,(e=>e.theme.primaryColor),(e=>e.theme.primaryBgText),(e=>e.theme.primaryColor),(e=>e.theme.primaryColor),(e=>e.theme.primaryBgText),B,L,(e=>Object(p.n)(e.theme.fz.large3)),(e=>Object(p.n)(e.theme.gutter/2)),B,D,(e=>Object(p.n)(e.theme.fz.large1)),(e=>e.theme.boldHeading?"500":"normal"),R,(e=>Object(p.n)(e.theme.fz.small2)),(e=>e.theme.italicHeading?"italic":"normal")),q=m.f.div.withConfig({displayName:"styled__TabPanel",componentId:"sc-1t0opj6-6"})(["position:relative;overflow:hidden;&:focus{outline:none;}"]),U=m.f.footer.withConfig({displayName:"styled__TabFooter",componentId:"sc-1t0opj6-7"})(["overflow:hidden;border-bottom-left-radius:",";border-bottom-right-radius:",";"],(e=>Object(p.n)(e.theme.borderRadiusBase)),(e=>Object(p.n)(e.theme.borderRadiusBase))),W=m.f.aside.withConfig({displayName:"styled__StopwatchContainer",componentId:"sc-1t0opj6-8"})(["padding:0 "," ",";"],(e=>Object(p.n)(1.5*e.theme.gutter)),(e=>Object(p.n)(.5*e.theme.gutter))),K=m.f.span.withConfig({displayName:"styled__StopwatchClock",componentId:"sc-1t0opj6-9"})(["display:block;font-size:",";color:",";font-weight:bold;line-height:1;"],(e=>Object(p.n)(e.theme.fz.large3)),(e=>e.theme.textColorSecondary)),Y=m.f.span.withConfig({displayName:"styled__StopwatchStamp",componentId:"sc-1t0opj6-10"})(["display:block;font-size:",";line-height:1;color:",";"],(e=>Object(p.n)(e.theme.fz.small2)),(e=>e.theme.textColorSecondary));function G(e){const t=e.title,n=e.subtitle,i=e.icon,o=e.onClick,a=e.active,s=e.className,c=e.id,l=e.disabled,d=Object(g.a)({darkBg:!0}),u=Object(r.a)(d,2),m=u[0],h=u[1];return Object(O.jsxs)($,{id:c,disabled:l,className:Object(p.c)(M,{active:!!a},s),onClick:e=>{e.preventDefault(),m(e),o()},type:"button",children:[h,i?Object(O.jsx)("span",{className:L,children:Object(O.jsx)(f.b,{iconClass:i})}):null,Object(O.jsxs)("span",{className:B,children:[Object(O.jsx)("span",{className:D,children:t}),n?Object(O.jsx)("span",{className:R,children:n}):null]})]})}function Q(e){var t;const n=e.currentTab,i=e.tabs,a=e.onTabChange,s=Object(m.h)(),d=Object(o.useRef)(null),h=u()(d),p=Object(o.useState)({leftDisabled:!0,rightDisabled:!1,left:0}),g=Object(r.a)(p,2),j=g[0],v=g[1],y=Object(l.useSpring)((()=>({from:{transform:"translateX(0px)"},to:{transform:`translateX(${-1*j.left}px)`},config:{...s.springConfigStiff,clamp:!0}}))),w=Object(r.a)(y,2),x=w[0],C=w[1];Object(o.useEffect)((()=>{C.start({transform:`translateX(${-1*j.left}px)`})}),[j.left,C]);const _=(e,t)=>{if(!d.current)return;let n=0;d.current.querySelectorAll("button").forEach((e=>{n+=e.offsetWidth}));const i=d.current.offsetWidth;let o=j.left-e;if(n<i?o=0:(o<0&&(o=0),o>n-i&&(o=n-i)),t){let e=!1,t=!1;0===o&&(e=!0),o+i>=n&&(t=!0),v({left:o,leftDisabled:e,rightDisabled:t})}else C.start({transform:`translateX(${-1*o}px)`})},k=Object(o.useCallback)(((e,t,n)=>{v({left:e,leftDisabled:t,rightDisabled:n})}),[]);Object(b.useGesture)({onDrag(e){const t=e.movement,n=e.down;_(t[0],!n)},onWheel(e){const t=e.event,n=e.movement;Math.abs(t.deltaX)<=Math.abs(t.deltaY)||(t.preventDefault(),t.stopPropagation(),_(n[0],!0))}},{target:null!==(t=d.current)&&void 0!==t?t:void 0,eventOptions:{passive:!1},drag:{filterTaps:!0}});const S=Object(o.useCallback)((e=>{if(!d.current)return;let t=0,n=0,i=!1,o=0;d.current.querySelectorAll("button").forEach((r=>{o+=r.offsetWidth,i||(r.getAttribute("id")===`tab-item-${e}`?(i=!0,n=r.offsetWidth):t+=r.offsetWidth)}));const r=d.current.offsetWidth;if(o<=r)return void k(0,!0,!0);if(t+n<=r)return void k(0,!0,!1);let a=t+n-r+90;n+90>r&&(a=t-.75*s.gutter),a<0&&(a=0),a>o-r&&(a=o-r),k(a,!1,a+r>=o)}),[s.gutter,k]);return Object(o.useLayoutEffect)((()=>{S(n)}),[n,S,h.width]),Object(O.jsxs)(A,{children:[Object(O.jsx)(G,{className:N,title:Object(O.jsx)(f.b,{iconClass:"fas fa-angle-left"}),onClick:()=>{_(150,!0)},disabled:j.leftDisabled}),Object(O.jsx)(H,{style:x,children:Object(O.jsx)(V,{ref:d,children:i.map((e=>Object(O.jsx)(G,{onClick:()=>{a(e.id)},active:n===e.id,id:`tab-item-${e.id}`,icon:e.icon,subtitle:e.subtitle,title:e.title},e.id)))})}),Object(O.jsx)(G,{className:c()(N,"right"),title:Object(O.jsx)(f.b,{iconClass:"fas fa-angle-right"}),onClick:()=>{_(-150,!0)},disabled:j.rightDisabled})]})}function J(e){const t=e.stopwatchStartTime,n=Object(o.useState)(0),i=Object(r.a)(n,2),s=i[0],c=i[1];Object(o.useEffect)((()=>{const e=()=>{const e=Math.abs(Date.now()-t);c(e)},n=setInterval(e,1e3);return e(),()=>{clearInterval(n)}}),[t]);const l=Object(I.c)(s),d=l.hours,u=l.minutes,m=l.seconds;return Object(O.jsxs)(W,{children:[Object(O.jsx)(K,{children:Object(a.sprintf)(Object(a._x)("%s:%s:%s","timer","wp-eform"),d,u,m)}),Object(O.jsx)(Y,{children:Object(a.sprintf)(Object(a.__)("time elapsed since %s","wp-eform"),Object(T.e)(t).format("LTS"))})]})}function X(e){const t=e.currentTab,n=e.onTabChange,i=e.tabs,r=e.children,a=e.className,s=e.scrollOnTabChange,c=void 0===s||s,l=e.tabScrollOffset,d=void 0===l?-100:l,u=e.footer,m=e.showProgressBar,b=void 0===m||m,f=e.showProgressLabel,g=void 0===f||f,j=e.showTabs,v=void 0===j||j,y=e.progressBarPosition,w=void 0===y?E.E.TOP:y,x=e.progressBarPrecision,C=void 0===x?2:x,_=e.forceProgress,k=e.stopwatchStartTime,I=Object(o.useRef)(null),T=Object(o.useRef)(null),N=Object(o.useRef)(!0);let M=i.findIndex((e=>e.id===t));-1===M&&(M=0);const L=_||M/(i.length||1)*100;return Object(o.useLayoutEffect)((()=>{N.current?N.current=!1:(T.current&&T.current.focus({preventScroll:!0}),c&&I.current&&Object(h.a)(I.current,{verticalOffset:d,cancelOnUserAction:!0,elementToScroll:Object(F.f)(I.current)[0]}))}),[t,c,d]),Object(O.jsxs)(z,{ref:I,className:Object(p.c)(P,{"has-footer":!!u},a),children:[v?Object(O.jsx)(Q,{currentTab:t,onTabChange:n,tabs:i}):null,b&&w===E.E.TOP?Object(O.jsx)(S,{width:L,labelPosition:"bottom",isTopRounded:!v,precision:C,showLabel:g}):null,Object(O.jsx)(q,{tabIndex:0,ref:T,children:r}),k?Object(O.jsx)(J,{stopwatchStartTime:k}):null,b&&w===E.E.BOTTOM?Object(O.jsx)(S,{width:L,isBottomRounded:!u,labelPosition:"top",precision:C,showLabel:g}):null,u?Object(O.jsx)(U,{children:u}):null]})}var Z=n(448),ee=n(147);const te="wpeform-component-animatedsvg",ne=Object(p.d)(te,"svg"),ie=Object(m.f)(l.animated.path).withConfig({displayName:"AnimatedSvg__AnimatedPathFill",componentId:"sc-1crsfqd-0"})(["will-change:opacity,transform;"]),oe=Object(m.f)(l.animated.path).withConfig({displayName:"AnimatedSvg__AnimatedPathStroke",componentId:"sc-1crsfqd-1"})(["stroke-dasharray:65 66;will-change:stroke-dashoffset;"]),re=m.f.div.withConfig({displayName:"AnimatedSvg__Container",componentId:"sc-1crsfqd-2"})(["",";display:inline-flex;align-items:center;justify-content:center;.","{height:1em;width:1em;display:block;}"],p.b,ne);function ae(e,t=2){const n=Object(l.useTrail)(t,(n=>({from:{strokeDashoffset:66},strokeDashoffset:0,config:n===t-1?e.springConfigSlow:{...e.springConfigGeneral,clamp:!0}})));return[Object(r.a)(n,1)[0],Object(l.useSpring)({from:{opacity:0,transform:"translate(0px, 0px)"},opacity:1,transform:"translate(2px, 2px)",config:e.springConfigSlow,delay:500})]}function se(e){const t=e.colorfulBg,n=Object(m.h)(),i=ae(n,2),o=Object(r.a)(i,2),a=o[0],s=o[1];return Object(O.jsx)(O.Fragment,{children:Object(O.jsxs)("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",className:ne,children:[Object(O.jsx)(ie,{style:s,stroke:t?n.successBackgroundColor:n.successColor,fill:t?n.successColor:n.successBackgroundColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"0",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(O.jsx)(oe,{strokeDashoffset:a[1].strokeDashoffset,stroke:t?n.successBackgroundColor:n.successColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(O.jsx)(oe,{strokeDashoffset:a[0].strokeDashoffset,stroke:t?n.successBackgroundColor:n.successColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M8.25 9.5L10.75 12L15.75 7"})]})})}function ce(e){const t=e.colorfulBg,n=Object(m.h)(),i=ae(n,3),o=Object(r.a)(i,2),a=o[0],s=o[1];return Object(O.jsx)(O.Fragment,{children:Object(O.jsxs)("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",className:ne,children:[Object(O.jsx)(ie,{style:s,stroke:t?n.warningBackgroundColor:n.warningColor,fill:t?n.warningColor:n.warningBackgroundColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"0",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(O.jsx)(oe,{strokeDashoffset:a[2].strokeDashoffset,stroke:t?n.warningBackgroundColor:n.warningColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(O.jsx)(oe,{strokeDashoffset:a[0].strokeDashoffset,stroke:t?n.warningBackgroundColor:n.warningColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M11.99 13H12.01"}),Object(O.jsx)(oe,{strokeDashoffset:a[1].strokeDashoffset,stroke:t?n.warningBackgroundColor:n.warningColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M12 6V10"})]})})}function le(e){const t=e.colorfulBg,n=Object(m.h)(),i=ae(n,3),o=Object(r.a)(i,2),a=o[0],s=o[1];return Object(O.jsx)(O.Fragment,{children:Object(O.jsxs)("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",className:ne,children:[Object(O.jsx)(ie,{style:s,stroke:t?n.errorBackgroundColor:n.errorColor,fill:t?n.errorColor:n.errorBackgroundColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"0",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(O.jsx)(oe,{strokeDashoffset:a[2].strokeDashoffset,stroke:t?n.errorBackgroundColor:n.errorColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(O.jsx)(oe,{strokeDashoffset:a[0].strokeDashoffset,stroke:t?n.errorBackgroundColor:n.errorColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M14.5 7L9.5 12"}),Object(O.jsx)(oe,{strokeDashoffset:a[1].strokeDashoffset,stroke:t?n.errorBackgroundColor:n.errorColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M9.5 7L14.5 12"})]})})}function de(e){const t=e.colorfulBg,n=Object(m.h)(),i=ae(n,3),o=Object(r.a)(i,2),a=o[0],s=o[1];return Object(O.jsx)(O.Fragment,{children:Object(O.jsxs)("svg",{width:"24",height:"24",viewBox:"0 0 24 24",fill:"none",xmlns:"http://www.w3.org/2000/svg",className:ne,children:[Object(O.jsx)(ie,{style:s,stroke:t?n.primaryBackgroundColor:n.primaryLightColor,fill:t?n.primaryLightColor:n.primaryBackgroundColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"0",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(O.jsx)(oe,{strokeDashoffset:a[2].strokeDashoffset,stroke:t?n.primaryBackgroundColor:n.primaryLightColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",fill:"none",d:"M14.5 2H9.5C5.36 2 2 5.36 2 9.5C2 12.76 4.09 15.53 7 16.56V22L12 17H14.5C18.64 17 22 13.64 22 9.5C22 5.36 18.64 2 14.5 2Z"}),Object(O.jsx)(oe,{strokeDashoffset:a[0].strokeDashoffset,stroke:t?n.primaryBackgroundColor:n.primaryLightColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M16.99 13H17"}),Object(O.jsx)(oe,{strokeDashoffset:a[1].strokeDashoffset,stroke:t?n.primaryBackgroundColor:n.primaryLightColor,strokeLinejoin:"round",strokeLinecap:"round",strokeMiterlimit:"10",strokeWidth:"1",d:"M12.99 13H13"})]})})}function ue(e){const t=e.colorfulBg,n=e.type,i=e.className;return Object(O.jsx)(re,{className:Object(p.c)(te,{[`type-${n}`]:!0,colorfulBg:t},i),children:"error"===n?Object(O.jsx)(le,{colorfulBg:t}):"warning"===n?Object(O.jsx)(ce,{colorfulBg:t}):"success"===n?Object(O.jsx)(se,{colorfulBg:t}):Object(O.jsx)(de,{colorfulBg:t})})}var me=n(98);const he="wpeform-component-actionfeedback",be=Object(p.d)(he,"title"),pe=Object(p.d)(he,"content"),fe=Object(p.d)(he,"footer"),ge=Object(p.d)(he,"icon"),je=m.f.div.withConfig({displayName:"ActionFeedback__IconContainer",componentId:"sc-irmrcs-0"})(["font-size:",";margin:0 0 "," 0;will-change:opacity,transform;display:flex;"],(e=>Object(p.n)(1.25*e.theme.fz.large8)),(e=>Object(p.n)(2*e.theme.gutter))),Oe=Object(m.f)(l.animated.h3).withConfig({displayName:"ActionFeedback__Title",componentId:"sc-irmrcs-1"})(["color:",";font-size:",";font-weight:bold;margin:0 0 "," 0;line-height:1.2;will-change:opacity,transform;"],(e=>e.theme.headingColor),(e=>Object(p.n)(e.theme.fz.large3)),(e=>Object(p.n)(e.theme.gutter))),ve=Object(m.f)(l.animated.article).withConfig({displayName:"ActionFeedback__Content",componentId:"sc-irmrcs-2"})(["",";will-change:opacity,transform;"],p.p),ye=Object(m.f)(l.animated.footer).withConfig({displayName:"ActionFeedback__Footer",componentId:"sc-irmrcs-3"})(["color:",";font-size:",";margin:"," 0 0 0;will-change:opacity,transform;"],(e=>e.theme.textColorSecondary),(e=>Object(p.n)(e.theme.fz.small1)),(e=>Object(p.n)(e.theme.gutter))),we=m.f.aside.withConfig({displayName:"ActionFeedback__Container",componentId:"sc-irmrcs-4"})(["",";margin:"," 0;padding:0 ",";&.","--size-tablet{","{font-size:",";}","{font-size:",";}}"],p.b,(e=>Object(p.n)(e.theme.gutter)),(e=>Object(p.n)(e.theme.gutter)),he,je,(e=>Object(p.n)(1.5*e.theme.fz.large8)),Oe,(e=>Object(p.n)(e.theme.fz.large4)));function xe(e){const t=e.type,n=e.title,i=e.children,a=e.className,s=e.scrollOnMount,c=void 0===s||s,d=e.scrollOffset,u=void 0===d?-100:d,b=e.footer,f=Object(m.h)(),g=Object(l.useTrail)(b?3:2,(e=>({from:{opacity:0,transform:"translate(0px, 20px)"},opacity:1,transform:"translate(0px, 0px)",config:0===e?f.springConfigGeneral:f.springConfigSlow,delay:500}))),j=Object(r.a)(g,1)[0],v=Object(p.u)(Object(me.c)(),he,{[`type-${t}`]:!0},a),y=Object(o.useRef)(!0),w=Object(o.useRef)(null);return Object(o.useLayoutEffect)((()=>{y.current&&(y.current=!1,c&&w.current&&Object(h.a)(w.current,{verticalOffset:u,cancelOnUserAction:!0,elementToScroll:Object(F.f)(w.current)[0]}))}),[c,u]),Object(O.jsxs)(we,{className:v,ref:w,children:[Object(O.jsx)(je,{className:ge,children:Object(O.jsx)(ue,{type:t,colorfulBg:!1})}),Object(O.jsx)(Oe,{style:j[0],className:be,children:n}),Object(O.jsx)(ve,{style:j[1],className:pe,children:i}),b?Object(O.jsx)(ye,{style:j[2],className:fe,children:b}):null]})}var Ce=n(366),_e=n(127),ke=n(34),Se=n(108),Ee=n(360),Ie=(n(199),n(447)),Te=n(218),Fe=n(216);function Pe(e){return e===E.k.BORDER_BOX?"border-box":e===E.k.CONTENT_BOX?"content-box":e===E.k.PADDING_BOX?"padding-box":"border-box"}const Ne=m.f.div.withConfig({displayName:"Page__PageBgContainer",componentId:"sc-19bqagh-0"})(["",";background-image:",";background-size:",";background-position:",";background-repeat:",";background-origin:",";background-clip:",";background-attachment:",";"],p.b,(e=>{var t;return null!==(t=e.bg)&&void 0!==t&&t.backgroundImage?`url("${e.bg.backgroundImage}")`:"none"}),(e=>{var t,n;return null!==(t=null===(n=e.bg)||void 0===n?void 0:n.backgroundSize)&&void 0!==t?t:"auto"}),(e=>{var t,n;return null!==(t=null===(n=e.bg)||void 0===n?void 0:n.backgroundPosition)&&void 0!==t?t:"0% 0%"}),(e=>{var t,n;return(n=null===(t=e.bg)||void 0===t?void 0:t.backgroundRepeat)===E.l.REPEAT_BOTH?"repeat":n===E.l.REPEAT_NONE?"no-repeat":n===E.l.REPEAT_X?"repeat-x":n===E.l.REPEAT_Y?"repeat-y":"no-repeat"}),(e=>{var t;return Pe(null===(t=e.bg)||void 0===t?void 0:t.backgroundOrigin)}),(e=>{var t;return Pe(null===(t=e.bg)||void 0===t?void 0:t.backgroundClip)}),(e=>{var t,n;return(n=null===(t=e.bg)||void 0===t?void 0:t.backgroundAttachment)===E.j.FIXED?"fixed":n===E.j.LOCAL?"local":"scroll"}));function Me(){var e,t;const n=Object(Se.l)(),i=Object(Ee.i)(Ee.b),s=n.structures.find((e=>e.id===i)),c=Object(Ee.i)(Ee.d),l=Object(Se.j)(),d=Object(Ee.j)();let u;if(Object(o.useEffect)((()=>{var e,t;if(!c)return()=>{};if(null!==(e=n.styles)&&void 0!==e&&null!==(t=e.pagination)&&void 0!==t&&t.autoProgress){var i;let e=!0;const t=setTimeout((()=>{var t,i;if(e)if(l.canNext){const e=d.getState().elements,t=Object(Fe.f)(s,n.elements,e),i=Object(Fe.a)(e,t);Object(r.a)(i,1)[0]&&l.goNext()}else null!==(t=n.styles)&&void 0!==t&&null!==(i=t.pagination)&&void 0!==i&&i.autoSubmit&&l.canSubmit&&l.submit()}),null!==(i=n.styles.pagination.autoProgressDelay)&&void 0!==i?i:100);return()=>{e=!1,clearTimeout(t)}}return()=>{}}),[c,n,d,l,s]),s){const e=s.children;u=Object(O.jsx)(Te.a,{elements:e,emptyMessage:Object(a.__)("This page is empty.","wp-eform")})}else u=Object(O.jsx)(Ie.a,{icon:Object(O.jsx)(f.b,{iconClass:"fas fa-envelope-open"}),children:Object(a.__)("This page does not exist. Kindly navigate away from it.","wp-eform")});return Object(O.jsx)(Ne,{bg:null!==(e=n.styles)&&void 0!==e&&null!==(t=e.customBackground)&&void 0!==t&&t.enabled?n.styles.customBackground:void 0,className:"wpeform-form-page",children:u})}n(286);var Le=n(33);const Be={message:Object(a.__)("Some error has occured.","wp-eform"),dynamicAnchors:null,mentions:null,id:"unknown"};function De(e){var t;const n=e.limitationMessage,i=Object(o.useMemo)((()=>[]),[]),r=Object(ke.n)(n.mentions),s=Object(ke.m)(n.dynamicAnchors),c=Object(ke.l)(n.message);return Object(O.jsx)(ke.f,{mode:"multiline",nodes:c||Object(Le.a)(Object(a.sprintf)(Object(a.__)("There has been some error related to %s.","wp-eform"),null!==(t=n.id)&&void 0!==t?t:"unknown")),excludeMentionsCharacters:i,additionalMentions:r,additionalDynamicAnchorTags:s})}function Re(e){const t=e.messageJson,n=Object(o.useMemo)((()=>{try{const e=JSON.parse(null!=t?t:"");return"object"==typeof e&&void 0!==e.dynamicAnchors&&void 0!==e.mentions&&void 0!==e.message?e:Be}catch(e){return Be}}),[t]),i=function(){const e=Object(Se.l)().elements;return Object(o.useCallback)((t=>{var n;return e[t]?Object(O.jsx)("strong",{children:Object(O.jsx)(ke.d,{currentElementId:null,nodes:Object(Le.c)(null===(n=e[t].appearance)||void 0===n?void 0:n.title),mode:"singleline"})}):null}),[e])}();return Object(O.jsx)(ke.c,{mentions:i,children:Object(O.jsx)(De,{limitationMessage:n})})}var ze=n(367),Ae=n.n(ze),He=n(175);function Ve(e){const t=e.time,n=e.onDone,i=Object(He.d)(t,n),o=Object(I.c)(1e3*i,"number"),r=o.hours,s=o.minutes,c=o.seconds;return Object(O.jsxs)("span",{className:"wpeform-component-inlinecountdown",children:[r>0?Object(a.sprintf)(Object(a._n)("%d hour, ","%d hours, ",r,"wp-eform"),r):null,r>0||s>0?Object(a.sprintf)(Object(a._n)("%d minute, ","%d minutes, ",s,"wp-eform"),s):null,Object(a.sprintf)(Object(a._n)("%d second","%d seconds",c,"wp-eform"),c)]})}var $e=n(437),qe=(n(120),n(1077),n(368));function Ue(e,t,n){if(!t)return"";const i=t.reduce(((e,t)=>(e[t.scoreId]=t,e)),{}),o="percentage"===n?e.scorePercentageLogic:e.scoreTotalLogic;let r="";return o.forEach((e=>{if(!e.scoreId||!i[e.scoreId]||!i[e.scoreId].has)return;const t=i[e.scoreId],o="percentage"===n?t.obtained/t.outof*100:t.obtained;o<=e.to&&o>=e.from&&(r=e.url)})),r}function We(e){const t=e.config,n=e.submissionLink,i=e.scoreData;let r=t.url;const s=Object(Ee.i)(Ee.c),c=Object(Se.l)();t.type===E.v.FLAT?r=t.url:t.type===E.v.PORTAL?r=WPEFormGraphQLApp.userPortal:t.type===E.v.SUBMISSION?r=null!=n?n:t.url:t.type===E.v.CONDITIONAL?r=function(e,t,n){let i="";return e.forEach((e=>{Object(qe.b)(e.events,t,n)&&(i=e.url)})),i}(t.conditionalLogic,s,c.elements):t.type===E.v.SCOREPERCENTAGE?r=Ue(t,i,"percentage"):t.type===E.v.SCORETOTAL&&(r=Ue(t,i,"total")),""===r&&(r=t.url);const l=Ae()(r),d=Object(o.useCallback)((()=>{t.iframeRedirect&&window.top&&window.top!==window.self?window.top.location.href=r:window.location.href=r}),[t.iframeRedirect,r]);Object($e.c)(d,t.delay,!l);const u=Object(o.useMemo)((()=>({"%REDIRECT_LINK%":r})),[r]);return l?Object(O.jsx)(ke.d,{mode:"multiline",nodes:Object(ke.g)(t.message),currentElementId:null,additionalMentions:{"::redirectDelay::":Object(O.jsx)(Ve,{time:t.delay})},additionalAnchors:u}):Object(O.jsx)("p",{children:Object(a.sprintf)(Object(a.__)("ERROR: The URL %s is invalid and cannot redirect. Please contact the site administrator for help.","wp-eform"),r)})}function Ke(e){const t=e.reset,n=e.delay,i=e.message;return Object($e.c)(t,n),Object(O.jsx)(ke.d,{mode:"singleline",nodes:Object(ke.g)(i),currentElementId:null,additionalMentions:{"::kioskResetTime::":Object(O.jsx)(Ve,{time:n})}})}const Ye="wpeform-component-timer",Ge=Object(m.f)(l.animated.div).withConfig({displayName:"Timer__TimerProgressContainer",componentId:"sc-1d2zn5q-0"})(["position:absolute;left:0;right:0;top:0;height:",";will-change:background-color;"],(e=>Object(p.n)(e.theme.controlHeightBase/8))),Qe=Object(m.f)(l.animated.div).withConfig({displayName:"Timer__TimerProgressAnimator",componentId:"sc-1d2zn5q-1"})(["will-change:width;position:absolute;right:0;top:0;height:",";background-color:",";max-width:100%;"],(e=>Object(p.n)(e.theme.controlHeightBase/8)),(e=>Object(j.b)(.1,e.theme.backgroundShade))),Je=m.f.div.withConfig({displayName:"Timer__TimerIconContainer",componentId:"sc-1d2zn5q-2"})(["flex:0 0 ",";margin:0 "," 0 0;height:",";width:",";font-size:",";line-height:1;display:flex;align-items:center;justify-content:center;color:",";"],(e=>Object(p.n)(.8*e.theme.controlHeightBase)),(e=>Object(p.n)(e.theme.gutter/2)),(e=>Object(p.n)(.8*e.theme.controlHeightBase)),(e=>Object(p.n)(.8*e.theme.controlHeightBase)),(e=>Object(p.n)(.8*e.theme.controlHeightBase)),(e=>Object(j.b)(.1,e.theme.backgroundShade)));function Xe(){return Object(O.jsx)(Je,{children:Object(O.jsx)(f.b,{iconClass:"fas fa-clock"})})}const Ze=m.f.div.withConfig({displayName:"Timer__TimerMainContainer",componentId:"sc-1d2zn5q-3"})(["width:calc( 100% - "," );flex:0 0 calc(100% - ",");"],(e=>Object(p.n)(.8*e.theme.controlHeightBase)),(e=>Object(p.n)(.8*e.theme.controlHeightBase))),et=m.f.div.withConfig({displayName:"Timer__TimerClockContainer",componentId:"sc-1d2zn5q-4"})(["display:flex;flex-flow:row nowrap;align-items:center;"]),tt=m.f.div.withConfig({displayName:"Timer__TimeContainer",componentId:"sc-1d2zn5q-5"})(["font-size:",";font-weight:bold;line-height:1.2;color:",";font-variant-numeric:tabular-nums;small{font-size:",";font-weight:normal;}"],(e=>Object(p.n)(e.theme.fz.large2)),(e=>e.theme.headingColor),(e=>Object(p.n)(e.theme.fz.small2))),nt=m.f.div.withConfig({displayName:"Timer__TickContainer",componentId:"sc-1d2zn5q-6"})(["font-size:",";margin:0 ",";line-height:1.2;"],(e=>Object(p.n)(e.theme.fz.large1)),(e=>Object(p.n)(e.theme.gutter/5))),it=m.f.div.withConfig({displayName:"Timer__TimerMessage",componentId:"sc-1d2zn5q-7"})(["font-size:",";color:",";margin:0;padding:0;",";.","{",";}"],(e=>Object(p.n)(e.theme.fz.small2)),(e=>e.theme.textColorSecondary),p.s,ke.a,p.s),ot=m.f.div.withConfig({displayName:"Timer__TimerWrapper",componentId:"sc-1d2zn5q-8"})(["display:flex;align-items:center;flex-flow:row nowrap;padding:",";padding-top:",";"],(e=>Object(p.n)(e.theme.gutter/2)),(e=>Object(p.n)(e.theme.gutter/2+e.theme.controlHeightBase/8))),rt=m.f.div.withConfig({displayName:"Timer__TimerContainer",componentId:"sc-1d2zn5q-9"})(["",";font-family:",";background-color:",";position:relative;&.","--hidden{display:none;}@media screen and (min-width:","){","{padding:",";padding-top:",";}","{flex-basis:",";margin-right:",";height:",";width:",";font-size:",";}","{width:calc( 100% - "," );flex-basis:calc( 100% - "," );}","{font-size:",";small{font-size:",";}}","{font-size:",";}","{font-size:",";}}"],p.b,(e=>e.theme.fontFamilyBody),(e=>e.theme.backgroundShade),Ye,(e=>Object(p.n)(e.theme.breakpoints.tablet)),ot,(e=>Object(p.n)(e.theme.gutter)),(e=>Object(p.n)(e.theme.gutter+e.theme.controlHeightBase/8)),Je,(e=>Object(p.n)(1.2*e.theme.controlHeightBase)),(e=>Object(p.n)(e.theme.gutter)),(e=>Object(p.n)(1.2*e.theme.controlHeightBase)),(e=>Object(p.n)(1.2*e.theme.controlHeightBase)),(e=>Object(p.n)(1.2*e.theme.controlHeightBase)),Ze,(e=>Object(p.n)(1.2*e.theme.controlHeightBase)),(e=>Object(p.n)(1.2*e.theme.controlHeightBase)),tt,(e=>Object(p.n)(e.theme.fz.large3)),(e=>Object(p.n)(e.theme.fz.small1)),nt,(e=>Object(p.n)(e.theme.fz.large2)),it,(e=>Object(p.n)(e.theme.fz.small1))),at=m.f.div.withConfig({displayName:"Timer__Placeholder",componentId:"sc-1d2zn5q-10"})(["height:",";@media screen and (min-width:","){height:",";}"],(e=>Object(p.n)(e.theme.gutter+e.theme.controlHeightBase/8+1.2*e.theme.fz.large2+1.2*e.theme.fz.small2+10)),(e=>Object(p.n)(e.theme.breakpoints.tablet)),(e=>Object(p.n)(2*e.theme.gutter+e.theme.controlHeightBase/8+1.2*e.theme.fz.large3+1.2*e.theme.fz.small1+10))),st=m.f.div.withConfig({displayName:"Timer__Portal",componentId:"sc-1d2zn5q-11"})(["position:fixed;bottom:0;left:0;width:100%;z-index:999995;"]);function ct(e){const t=e.time,n=e.onDone,i=e.message,r=e.showUI,s=e.width,c=void 0===s?"100%":s,d=e.containerLayout,u=void 0===d?E.A.FIXED:d,h=Object(He.d)(t,n),b=Object(m.h)(),f=h/t*100,g=Object(l.useSpring)({from:{backgroundColor:b.successColor},to:{backgroundColor:f>60?b.successColor:f>20?b.warningColor:b.errorColor},config:b.springConfigSlow}),j=Object(l.useSpring)({from:{width:"0%"},to:{width:`${Object(p.n)(100-f,"%")}`},config:b.springConfigSlow}),v=Object(I.c)(1e3*h,"string"),y=v.hours,w=v.minutes,x=v.seconds,C=Object(p.c)(Ye,{hidden:!r}),_=Object(o.useMemo)((()=>Object(I.c)(1e3*t,"number")),[t]).hours;return Object(O.jsx)(rt,{className:C,children:Object(O.jsx)(me.a,{width:c,containerLayout:u,noHorizontalPadding:!0,noVerticalPadding:!0,children:Object(O.jsxs)(ot,{children:[Object(O.jsx)(Ge,{style:g,children:Object(O.jsx)(Qe,{style:j})}),Object(O.jsx)(Xe,{}),Object(O.jsxs)(Ze,{children:[Object(O.jsxs)(et,{children:[_>0?Object(O.jsxs)(O.Fragment,{children:[Object(O.jsxs)(tt,{children:[y,Object(O.jsx)("small",{children:Object(a._x)("h","hours short form","wp-eform")})]}),Object(O.jsx)(nt,{children:":"})]}):null,Object(O.jsxs)(tt,{children:[w,Object(O.jsx)("small",{children:Object(a._x)("m","minutes short form","wp-eform")})]}),Object(O.jsx)(nt,{children:":"}),Object(O.jsxs)(tt,{children:[x,Object(O.jsx)("small",{children:Object(a._x)("s","seconds short form","wp-eform")})]})]}),i?Object(O.jsx)(it,{children:i}):null]})]})})})}ct.Placeholder=at,ct.Portal=st;var lt=n(281);function dt(e){const t=e.timerConfig,n=e.currentPageConfig,i=e.goNext,r=e.canSubmit,a=e.submit,s=e.submitting,c=e.width,l=e.containerLayout,d=Object(ke.l)(null==t?void 0:t.timerMessage),u=Object(o.useCallback)((()=>{0}),[r,i,a,t,s]);if(!t||!n)return null;if(t.submitTimer===E.G.NONE)return null;let m,h;if(t.submitTimer===E.G.OVERALL?(m=t.timeLimit,h="overall"):(m=n.config.timer,h=n.id),!m||m<0)return null;const b=t.showTimer&&!s&&Object(lt.a)("starter");return Object(O.jsxs)(O.Fragment,{children:[b?Object(O.jsx)(ct.Placeholder,{}):null,Object(O.jsx)(me.a.Portal,{children:Object(O.jsx)(ct.Portal,{children:Object(O.jsx)(ct,{showUI:b,time:m,message:d?Object(O.jsx)(ke.d,{nodes:d,currentElementId:null,mode:"singleline"}):void 0,onDone:u,width:c,containerLayout:l},h)})})]})}var ut=n(450),mt=n(449);const ht=m.f.div.withConfig({displayName:"Remarks__Container",componentId:"sc-123x1v6-0"})(["padding:",";border-radius:",";background-color:",";margin:0 0 "," 0;"],(e=>Object(p.n)(e.theme.gutter)),(e=>Object(p.n)(e.theme.borderRadiusBase)),(e=>e.theme.backgroundShade),(e=>Object(p.n)(e.theme.gutter)));function bt(){const e=Object(He.c)(),t=Object(Ee.i)(Ee.e),n=Object(Ee.h)(),i=Object(o.useCallback)((e=>{n({type:"SET_REMARKS",payload:{remarks:e}})}),[n]);return Object(O.jsx)(ht,{children:Object(O.jsx)(ut.a,{title:Object(a.__)("Administrator Remarks","wp-eform"),subtitle:Object(a.__)("this will show up in submission summary.","wp-eform"),id:`${e}-remarks`,children:Object(O.jsx)(mt.a,{value:t,onChange:i})})})}function pt(e){var t,n,i,s,c,l,d,u,m,h,b,p,f,g,j,v,y,w,x,C,_,k,S,I,T,F,P,N,M,L,B,D,R,z,A,H,V,$,q,U,W,K,Y,G,Q,J,te,ne,ie,oe,re,ae,se,ce,le,de,ue,me,he,be,pe,fe,ge,je,Oe,ve,ye,we,Ie,Te,Pe,Ne,Le,Be,ze,Ae,He,Ve,$e,qe,Ue,Ye,Ge,Qe,Je,Xe,Ze,et,tt,nt,it,ot,rt,at,st,ct,lt,ut,mt,ht,pt,ft,gt,jt;const Ot=e.activePage,vt=e.onActivePageChange,yt=e.onSubmit,wt=e.submitting,xt=e.submitted,Ct=e.submittedState,_t=e.submissionError,kt=e.onReset,St=e.onErrorRetry,Et=e.limitations,It=e.mutationData,Tt=e.notices,Ft=e.initialData,Pt=Object(Ee.h)(),Nt=Object(Ee.j)(),Mt=Object(Se.m)(),Lt=Object(Se.l)(),Bt=Object(Ee.i)(Ee.b),Dt=Object(Ee.i)(Ee.g),Rt=Object(Ee.i)(Ee.f),zt=Object(o.useState)(!1),At=Object(r.a)(zt,2),Ht=At[0],Vt=At[1],$t=Object(o.useState)(null),qt=Object(r.a)($t,2),Ut=qt[0],Wt=qt[1],Kt=Object(Se.n)(),Yt=Object(Se.i)();Object(o.useEffect)((()=>{Wt(null),Vt(!1),Pt({type:"SET_ELEMENTS_AND_STARTTIME",payload:{structures:Object(Fe.e)(Lt),elements:Object(Fe.d)(Lt,Mt,!0,Ft),formData:Lt,formMeta:Mt,conditionalsMap:Yt,fullReset:"preview"===Kt||"listview"===Kt}})}),[Pt,Mt,Lt,Yt,Ft,Kt]);const Gt=Object(o.useMemo)((()=>Lt.structures.filter((e=>{if("preview"===Kt)return!0;const t=Dt[e.id];return!t||!t.conditionallyHidden})).map((e=>({id:e.id,title:e.config.title,subtitle:e.config.subtitle,icon:e.config.icon||void 0})))),[Lt.structures,Kt,Dt]);Object(o.useEffect)((()=>{!Gt.find((e=>e.id===Bt))&&Gt.length&&Pt({type:"SET_CURRENT_PAGE",payload:Gt[0].id})}),[Gt,Bt,Pt]);const Qt=("newsubmission"===Kt||"useredit"===Kt)&&(null===(t=Lt.settings)||void 0===t||null===(n=t.timer)||void 0===n?void 0:n.submitTimer)!==E.G.NONE,Jt=Object(o.useMemo)((()=>Lt.structures.find((e=>e.id===Bt))),[Bt,Lt.structures]),Xt=Gt.findIndex((e=>e.id===Bt)),Zt=0===Xt?null:Gt[Xt-1]?Gt[Xt-1].id:null,en=Gt[Xt+1]?Gt[Xt+1].id:Bt,tn=Object(o.useCallback)(((e,t=!1)=>{var n,i;const o=()=>{Pt({type:"SET_CURRENT_PAGE",payload:e}),vt&&vt(e)};if("preview"===Kt||(null===(n=Lt.styles)||void 0===n||null===(i=n.pagination)||void 0===i?void 0:i.paginationRestriction)===E.i.NONE)return void o();if(Qt&&e===en&&t)return o(),Vt(!1),void Wt(null);const a=Nt.getState().elements,s=Object(Fe.f)(Jt,Lt.elements,a),c=Object(Fe.a)(a,s),l=Object(r.a)(c,2),d=l[0],u=l[1];if(Gt.findIndex((t=>t.id===e))<Xt){var m,h,b,p;if(Qt)return;if(null!==(m=Lt.styles)&&void 0!==m&&null!==(h=m.pagination)&&void 0!==h&&h.blockPreviousNavigation)return;return(null===(b=Lt.styles)||void 0===b||null===(p=b.pagination)||void 0===p?void 0:p.paginationRestriction)!==E.i.ONLY_WHEN_ALL_VALID||d?(Vt(!1),Wt(null),Pt({type:"SET_CURRENT_PAGE",payload:e}),void(vt&&vt(e))):(Vt(!0),void Wt(u))}if(d)return Vt(!1),Wt(null),Pt({type:"SET_CURRENT_PAGE",payload:en}),void(vt&&vt(en));Vt(!0),Wt(u)}),[vt,Kt,Jt,Xt,Pt,Lt,Nt,Gt,en,Qt]);Object(o.useEffect)((()=>{Ot&&Ot!==Bt&&Pt({type:"SET_CURRENT_PAGE",payload:Ot})}),[Pt,Ot,Bt]);const nn=!(Qt||!Zt||null!==(i=Lt.styles)&&void 0!==i&&null!==(s=i.pagination)&&void 0!==s&&s.blockPreviousNavigation||wt),on=Object(o.useCallback)((()=>{Zt&&tn(Zt)}),[Zt,tn]),rn=en!==Bt&&!wt,an=Object(o.useCallback)(((e=!1)=>{tn(en,e)}),[tn,en]),sn=en===Bt&&!wt,cn=Object(o.useCallback)(((e=!1)=>{if(Qt&&e)return void yt(Nt);const t=Nt.getState().elements,n=Object(Fe.f)(Jt,Lt.elements,t),i=Object(Fe.a)(t,n),o=Object(r.a)(i,2),a=o[0],s=o[1];if(!a)return Vt(!0),void Wt(s);yt(Nt)}),[Jt,Lt,Nt,yt,Qt]),ln=(!wt||wt&&xt)&&!Qt,dn=Object(o.useCallback)((()=>{Pt({type:"SET_ELEMENTS_AND_STARTTIME",payload:{structures:Object(Fe.e)(Lt),elements:Object(Fe.d)(Lt,Mt,!0),formData:Lt,formMeta:Mt,conditionalsMap:Yt,fullReset:!0}}),Wt(null),Vt(!1);const e=Gt[0].id;Pt({type:"SET_CURRENT_PAGE",payload:e}),vt&&vt(e),kt&&kt()}),[Pt,Lt,Mt,vt,Gt,kt,Yt]),un=Object(o.useCallback)((()=>{var e,t;window.confirm((null===(e=Lt.styles)||void 0===e||null===(t=e.pagination)||void 0===t?void 0:t.resetMessage)||Object(a.__)("This will reset the form. Action cannot be undone, are you sure?","wp-eform"))&&dn()}),[dn,Lt]),mn=Object(o.useMemo)((()=>({canNext:rn,canPrevious:nn,canSubmit:sn,goNext:an,goPrevious:on,submit:cn,canReset:ln,reset:un,submitting:wt,submitted:xt,submittedState:Ct})),[rn,nn,sn,an,on,cn,ln,un,wt,xt,Ct]),hn=null!==(c=Lt.styles)&&void 0!==c&&null!==(l=c.pagination)&&void 0!==l&&l.barlike?"flat":null!==(d=null===(u=Lt.styles)||void 0===u||null===(m=u.pagination)||void 0===m?void 0:m.style)&&void 0!==d?d:"flat",bn=null!==(h=null===(b=Lt.styles)||void 0===b||null===(p=b.pagination)||void 0===p?void 0:p.size)&&void 0!==h?h:E.o.DEFAULT,pn=null!==(f=null===(g=Lt.styles)||void 0===g||null===(j=g.pagination)||void 0===j?void 0:j.colored)&&void 0!==f&&f,fn=null===(v=Lt.styles)||void 0===v||null===(y=v.pagination)||void 0===y?void 0:y.rounded;let gn=Object(O.jsx)(ee.b,{style:hn,size:bn,colorful:pn,icon:null===(w=Lt.styles)||void 0===w||null===(x=w.pagination)||void 0===x?void 0:x.prevIcon,iconPosition:(null===(C=Lt.styles)||void 0===C||null===(_=C.pagination)||void 0===_?void 0:_.prevIconPosition)===E.a.BEFORE?"before":"after",onClick:on,rounded:fn,disabled:!nn,children:null===(k=Lt.styles)||void 0===k||null===(S=k.pagination)||void 0===S?void 0:S.prevLabel});const jn="newsubmission"===Kt||"preview"===Kt||"listview"===Kt?"new":"update",On="new"===jn?null===(I=Lt.styles)||void 0===I||null===(T=I.pagination)||void 0===T?void 0:T.submitIconPosition:null===(F=Lt.styles)||void 0===F||null===(P=F.pagination)||void 0===P?void 0:P.updateIconPosition;let vn=Object(O.jsx)(ee.b,{style:hn,size:bn,colorful:pn,icon:"new"===jn?null===(N=Lt.styles)||void 0===N||null===(M=N.pagination)||void 0===M?void 0:M.submitIcon:null===(L=Lt.styles)||void 0===L||null===(B=L.pagination)||void 0===B?void 0:B.updateIcon,iconPosition:On===E.a.BEFORE?"before":"after",onClick:()=>{cn()},rounded:fn,disabled:!sn,loading:wt,loadingDone:xt,loadedState:"success"===Ct?"success":"error",children:"new"===jn?null===(D=Lt.styles)||void 0===D||null===(R=D.pagination)||void 0===R?void 0:R.submitLabel:null===(z=Lt.styles)||void 0===z||null===(A=z.pagination)||void 0===A?void 0:A.updateLabel}),yn=Object(O.jsx)(ee.b,{style:hn,size:bn,colorful:pn,icon:null===(H=Lt.styles)||void 0===H||null===(V=H.pagination)||void 0===V?void 0:V.nextIcon,iconPosition:(null===($=Lt.styles)||void 0===$||null===(q=$.pagination)||void 0===q?void 0:q.nextIconPosition)===E.a.BEFORE?"before":"after",onClick:()=>{an()},rounded:fn,disabled:!rn,children:null===(U=Lt.styles)||void 0===U||null===(W=U.pagination)||void 0===W?void 0:W.nextLabel}),wn=null!==(K=Lt.styles)&&void 0!==K&&null!==(Y=K.pagination)&&void 0!==Y&&Y.showResetButton?Object(O.jsx)(ee.b,{style:hn,size:bn,colorful:pn,icon:null===(G=Lt.styles)||void 0===G||null===(Q=G.pagination)||void 0===Q?void 0:Q.resetIcon,iconPosition:(null===(J=Lt.styles)||void 0===J||null===(te=J.pagination)||void 0===te?void 0:te.resetIconPosition)===E.a.BEFORE?"before":"after",onClick:un,rounded:fn,disabled:!ln,children:null===(ne=Lt.styles)||void 0===ne||null===(ie=ne.pagination)||void 0===ie?void 0:ie.resetLabel}):null;null!==(oe=Lt.styles)&&void 0!==oe&&null!==(re=oe.pagination)&&void 0!==re&&re.hideWhenNotRelevant&&(nn||(gn=null),rn?vn=null:yn=null,ln||(wn=null)),1===Lt.structures.length&&(yn=null,gn=null);let xn=null;var Cn,_n,kn,Sn;wt&&xt&&"success"===Ct&&"newsubmission"===Kt&&((null===(Cn=Lt.styles)||void 0===Cn||null===(_n=Cn.redirection)||void 0===_n?void 0:_n.type)!==E.v.NONE?xn=Object(O.jsx)(We,{config:Lt.styles.redirection,submissionLink:null==It?void 0:It.submissionLink,scoreData:null==It?void 0:It.scoreData}):!0===(null===(kn=Lt.styles)||void 0===kn||null===(Sn=kn.formBehavior)||void 0===Sn?void 0:Sn.kioskMode)&&(xn=Object(O.jsx)(Ke,{reset:dn,delay:Lt.styles.formBehavior.kioskTime,message:Lt.styles.formBehavior.kioskMessage})));return Object(O.jsx)(O.Fragment,{children:wt&&xt?Object(O.jsx)(xe,{type:"success"===Ct?"success":"error",title:"success"===Ct?Object(O.jsx)(ke.d,{mode:"singleline",nodes:Object(ke.g)("useredit"===Kt?null===(ae=Lt.styles)||void 0===ae||null===(se=ae.formBehavior)||void 0===se?void 0:se.updateSubject:"adminedit"===Kt?Object(a.__)("The submission has been updated.","wp-eform"):null===(ce=Lt.styles)||void 0===ce||null===(le=ce.formBehavior)||void 0===le?void 0:le.subject),currentElementId:null}):Object(O.jsx)(ke.d,{mode:"singleline",nodes:Object(ke.g)(null!==(de=null===(ue=Lt.styles)||void 0===ue||null===(me=ue.formBehavior)||void 0===me?void 0:me.errorSubject)&&void 0!==de?de:Object(a.__)("Oops, we have encountered an error!","wp-eform")),currentElementId:null}),footer:xn,children:"success"===Ct?Object(O.jsx)(ke.d,{currentElementId:null,mode:"multiline",nodes:Object(ke.g)("useredit"===Kt?null===(he=Lt.styles)||void 0===he||null===(be=he.formBehavior)||void 0===be?void 0:be.updateMessage:"adminedit"===Kt?Object(a.__)("We have also sent an email to the user about this update.","wp-eform"):null===(pe=Lt.styles)||void 0===pe||null===(fe=pe.formBehavior)||void 0===fe?void 0:fe.message)}):Object(O.jsxs)(O.Fragment,{children:["submissionValidationLogic"===(null==_t||null===(ge=_t.graphQLErrors[0])||void 0===ge||null===(je=ge.extensions)||void 0===je?void 0:je.category)?Object(O.jsx)(Re,{messageJson:null!==(Oe=null==_t||null===(ve=_t.graphQLErrors[0])||void 0===ve?void 0:ve.message)&&void 0!==Oe?Oe:""}):null==_t?void 0:_t.message,St?Object(O.jsx)("p",{children:Object(O.jsx)(ee.b,{size:bn,style:hn,colorful:pn,icon:null!==(ye=null===(we=Lt.styles)||void 0===we||null===(Ie=we.formBehavior)||void 0===Ie?void 0:Ie.errorRetryButtonIcon)&&void 0!==ye?ye:"fas fa-sync-alt",iconPosition:(null===(Te=Lt.styles)||void 0===Te||null===(Pe=Te.formBehavior)||void 0===Pe?void 0:Pe.errorRetryButtonIconPosition)===E.a.AFTER?"after":"before",onClick:St,rounded:fn,children:null!==(Ne=null===(Le=Lt.styles)||void 0===Le||null===(Be=Le.formBehavior)||void 0===Be?void 0:Be.errorRetryButtonLabel)&&void 0!==Ne?Ne:Object(a.__)("RETRY","wp-eform")})}):null]})}):Object(O.jsx)(Se.d.Provider,{value:Ht,children:Object(O.jsx)(Se.a.Provider,{value:Ut,children:Object(O.jsx)(Se.c.Provider,{value:mn,children:Et&&Et.length>0&&"newsubmission"===Kt?Et.map((e=>Object(O.jsx)(_e.a.Bottom,{children:Object(O.jsx)(Ce.a,{type:"error",icon:"fas fa-times",dismissable:!1,children:Object(O.jsx)(De,{limitationMessage:e})})},e.id))):Object(O.jsxs)(O.Fragment,{children:["adminedit"===Kt?Object(O.jsx)(bt,{}):null,Tt&&Tt.length&&"newsubmission"===Kt?Tt.map((e=>Object(O.jsx)(_e.a.Bottom,{children:Object(O.jsx)(Ce.a,{type:"regular",icon:"fas fa-exclamation",dismissable:!0,children:Object(O.jsx)(De,{limitationMessage:e})})},e.id))):null,Object(O.jsxs)("form",{method:"post",action:"",autoComplete:null!==(ze=Lt.styles)&&void 0!==ze&&null!==(Ae=ze.formBehavior)&&void 0!==Ae&&Ae.disabledAutoComplete?"off":"on",onSubmit:e=>{e.preventDefault()},children:[Object(O.jsx)(X,{showTabs:null===(He=Lt.styles)||void 0===He||null===(Ve=He.pagination)||void 0===Ve?void 0:Ve.showTabs,currentTab:Bt,onTabChange:tn,showProgressBar:null===($e=Lt.styles)||void 0===$e||null===(qe=$e.pagination)||void 0===qe?void 0:qe.showProgressBar,showProgressLabel:null===(Ue=Lt.styles)||void 0===Ue||null===(Ye=Ue.pagination)||void 0===Ye?void 0:Ye.showProgressLabel,forceProgress:wt?100:void 0,progressBarPosition:null===(Ge=Lt.styles)||void 0===Ge||null===(Qe=Ge.pagination)||void 0===Qe?void 0:Qe.progressBarPosition,progressBarPrecision:null===(Je=Lt.styles)||void 0===Je||null===(Xe=Je.pagination)||void 0===Xe?void 0:Xe.progressDecimalPoint,scrollOnTabChange:null===(Ze=Lt.styles)||void 0===Ze||null===(et=Ze.pagination)||void 0===et?void 0:et.autoScroll,tabScrollOffset:void 0!==(null===(tt=Lt.styles)||void 0===tt||null===(nt=tt.pagination)||void 0===nt?void 0:nt.scrollOffset)?-1*Lt.styles.pagination.scrollOffset:-100,tabs:Gt,stopwatchStartTime:null!==(it=Lt.settings)&&void 0!==it&&null!==(ot=it.timer)&&void 0!==ot&&ot.recordSubmissionTime&&Lt.settings.timer.showStopwatch?Rt:void 0,footer:null!==(rt=Lt.styles)&&void 0!==rt&&null!==(at=rt.pagination)&&void 0!==at&&at.panelEnabled?Object(O.jsxs)(Z.a,{align:null!==(st=null===(ct=Lt.styles)||void 0===ct||null===(lt=ct.pagination)||void 0===lt?void 0:lt.alignment)&&void 0!==st?st:E.n.RIGHT,type:null!==(ut=Lt.styles)&&void 0!==ut&&null!==(mt=ut.pagination)&&void 0!==mt&&mt.barlike?"navbar":"regular",colorful:pn,hasGutterOnregular:!0,children:[gn,vn,yn,wn]}):null,children:Object(O.jsx)(Me,{})}),"newsubmission"===Kt||"useredit"===Kt?Object(O.jsx)(dt,{timerConfig:null===(ht=Lt.settings)||void 0===ht?void 0:ht.timer,currentPageConfig:Jt,goNext:an,submit:cn,canSubmit:sn,width:null===(pt=Lt.styles)||void 0===pt||null===(ft=pt.appearance)||void 0===ft?void 0:ft.maxWidth,containerLayout:null===(gt=Lt.styles)||void 0===gt||null===(jt=gt.appearance)||void 0===jt?void 0:jt.containerLayout,submitting:wt}):null]})]})})})})})}function ft(e){const t=e.children,n=e.mutationData,i=function(e){var t;const n=Object(Ee.i)(Ee.c),i=Object(Se.l)(),r=i.elements,a=null===(t=i.settings)||void 0===t?void 0:t.score,s=Object(o.useMemo)((()=>{var t;return e?{"::fName::":e.fName,"::lName::":e.lName,"::email::":e.email,"::phone::":e.phone,"::submissionId::":e.token,"::formName::":null!==(t=i.name)&&void 0!==t?t:""}:null}),[e,i.name]);return Object(o.useCallback)((t=>Object(ke.i)(t,n,r,s,a,null==e?void 0:e.scoreData)),[n,r,e,a,s])}(n),r=Object(o.useMemo)((()=>{const e={};return e["%FORM_LINK%"]=window.location.href,null!=n&&n.submissionLink&&(e["%SUBMISSION_LINK%"]=n.submissionLink),e}),[n]);return Object(O.jsx)(ke.c,{mentions:i,children:Object(O.jsx)(ke.b,{dynamicAnchors:r,children:t})})}var gt=n(1036);const jt=["formData","formMeta","mode","initialData","activePage","onActivePageChange","mutationData","formHeader"];function Ot(e){const t=e.formData,n=e.formMeta,r=e.mode,a=e.initialData,s=e.activePage,c=e.onActivePageChange,l=e.mutationData,d=e.formHeader,u=void 0===d?null:d,m=Object(i.a)(e,jt),h=t.styles,b=Object(gt.c)(h),p=Object(o.useMemo)((()=>{const e={};return t.conditionals.forEach((t=>{t.events.forEach((n=>{e[n.fieldid]||(e[n.fieldid]=[]),e[n.fieldid].includes(t.id)||e[n.fieldid].push(t.id)}))})),e}),[t]);return Object(O.jsx)(Ee.a,{initialData:null!=a?a:{...Fe.c,currentPage:null!=s?s:t.structures&&t.structures.length?t.structures[0].id:"",startTime:Date.now()},children:Object(O.jsx)(Se.e.Provider,{value:t,children:Object(O.jsx)(Se.f.Provider,{value:n,children:Object(O.jsx)(Se.g.Provider,{value:r,children:Object(O.jsx)(Se.b.Provider,{value:p,children:Object(O.jsx)(ft,{mutationData:l,children:Object(O.jsxs)(gt.a,{themeStyle:b,mode:"preview"!==r?"live":"preview",children:[u,Object(O.jsx)(pt,{activePage:s,onActivePageChange:c,...m,mutationData:l,initialData:a})]})})})})})})})}},1088:function(e,t,n){"use strict";n.d(t,"a",(function(){return m}));var i=n(1189);const o=i.a`
	fragment FConfigStyleAppearance on FormStylesAppearanceType {
		containerLayout
		maxWidth
		controlType
		controlAlignment
		controlLayout
	}
`,r=i.a`
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
`,a=i.a`
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
`,s=i.a`
	fragment FConfigStyleTheme on FormStylesThemeType {
		css
		customColorBg
		customColorPrimary
		customColorSecondary
		customColorText
		scheme
		darkMode
	}
`,c=i.a`
	fragment FConfigStyleTypography on FormStylesTypographyType {
		baseFont
		bodyFamily
		bodyFamilyCustom
		headFamily
		headFamilyCustom
		headFontBold
		headFontItalic
	}
`,l=i.a`
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
`,d=i.a`
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
`,u=i.a`
	fragment FConfigStyleTracking on FormStylesTrackingType {
		urlTracking
		urlTrackId
	}
`,m=i.a`
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
	${o}
	${r}
	${a}
	${s}
	${c}
	${l}
	${d}
	${u}
`},1089:function(e,t,n){"use strict";n.d(t,"a",(function(){return l})),n.d(t,"b",(function(){return h}));var i=n(0),o=n(7),r=n(36),a=n(21),s=n(2),c=n(1);const l="wpeform-component-graphskeleton",d=o.f.div.withConfig({displayName:"GraphSkeleton__Container",componentId:"sc-tm906v-0"})(["display:flex;flex-flow:row nowrap;max-width:100%;overflow:hidden;min-height:50px;align-items:flex-end;justify-content:space-between;"]),u=Object(o.g)(["0%{height:14%;}50%{height:100%;}100%{height:14%;}"]),m=o.f.div.withConfig({displayName:"GraphSkeleton__Bar",componentId:"sc-tm906v-1"})(["margin:0 1px;background-color:",";flex:0 0 auto;animation:"," 2300ms infinite;"],(e=>e.theme.backgroundShade),u);function h(e){const t=e.barWidth,n=void 0===t?6:t,o=e.bars,u=void 0===o?4:o,h=e.color,b=e.height,p=void 0===b?70:b,f=e.type,g=void 0===f?"bar":f,j=e.className,O={width:Object(s.n)(n)};h&&(O.backgroundColor=h);const v=Object(i.useMemo)((()=>Array.from({length:10}).map((()=>Object(r.h)(100,1e3)))),[]),y=Object(i.useMemo)((()=>Array.from({length:10}).map((()=>Object(r.h)(200,300)))),[]);return Object(c.jsx)(d,{className:Object(s.c)(l,{[`type-${g}`]:!0},j),style:{height:Object(s.n)(p)},children:Array.from({length:u}).map(((e,t)=>{const n=2300+Object(a.i)(t,y),i=-1*t*Object(a.i)(t,v);return Object(c.jsx)(m,{style:{...O,animationDuration:`${n}ms`,WebkitAnimationDuration:`${n}ms`,MozAnimationDuration:`${n}ms`,animationDelay:`${i}ms`,WebkitAnimationDelay:`${i}ms`,MozAnimationDelay:`${i}ms`}},t)}))})}},1091:function(e,t,n){"use strict";n.d(t,"b",(function(){return l}));var i=n(7),o=n(1102),r=n(1065);n.d(t,"a",(function(){return r.a})),n.d(t,"c",(function(){return r.b}));var a=n(361),s=n(1089);const c={datetime:"MMM D, YYYY, h:mm:ss a",millisecond:"h:mm:ss.SSS a",second:"h:mm:ss a",minute:"h:mm a",hour:"hA",day:"MMM D",week:"ll",month:"MMM YYYY",quarter:"[Q]Q - YYYY",year:"YYYY"};o.b._date.override({_id:"dayjs",formats:()=>c,parse(e,t){const n=typeof e;return null===e||"undefined"===n?null:"string"===n&&"string"==typeof t?Object(a.e)(e,t).isValid()?Object(a.e)(e,t).valueOf():null:e instanceof a.e?null:Object(a.e)(e).isValid()?Object(a.e)(e).valueOf():null},format:(e,t)=>Object(a.e)(e).format(t),add:(e,t,n)=>Object(a.e)(e).add(t,n).valueOf(),diff:(e,t,n)=>Object(a.e)(e).diff(Object(a.e)(t),n),startOf(e,t,n){if("isoWeek"===t){const t="number"==typeof n&&n>0&&n<7?n:1;return Object(a.e)(e).isoWeekday(t).startOf("day").valueOf()}return Object(a.e)(e).startOf(t).valueOf()},endOf:(e,t)=>Object(a.e)(e).endOf(t).valueOf()});const l=i.f.div.withConfig({displayName:"chartjs__ChartContainer",componentId:"sc-d85kru-0"})(["position:relative;width:100%;margin:0 auto;min-height:400px;display:flex;align-items:flex-end;.","{flex:0 0 100%;}"],s.a)},1093:function(e,t,n){"use strict";n.d(t,"a",(function(){return u}));n(0);var i=n(3),o=n(147),r=n(8),a=n(289),s=n(364),c=n(1039),l=n(1);function d(e){const t=e.lastError,n=e.resetError,a=e.themeStyle;return Object(l.jsx)(c.a,{themeStyle:a,children:Object(l.jsx)(s.a,{type:"client",title:Object(i.__)("Something went wrong","wp-eform"),description:Object(l.jsxs)(l.Fragment,{children:[Object(l.jsx)("p",{children:Object(i.__)("There was an error in the application. Reloading the page might fix it.","wp-eform")}),t&&t.toString?Object(l.jsxs)(l.Fragment,{children:[Object(l.jsx)("p",{children:Object(i.__)("More information on the error can be found below.","wp-eform")}),Object(l.jsx)("p",{children:t.toString()})]}):null]}),footer:Object(l.jsxs)(l.Fragment,{children:[Object(l.jsx)(o.b,{onClick:()=>{window.location.reload()},style:"3d",size:r.o.SMALL,children:Object(i.__)("RELOAD PAGE","wp-eform")}),Object(l.jsx)(o.b,{onClick:()=>{n()},style:"3d",size:r.o.SMALL,colorful:!1,children:Object(i.__)("RETRY WITHOUT RELOAD","wp-eform")})]})})})}function u(e){const t=e.children,n=e.themeStyle;return Object(l.jsx)(a.a,{fallback:(e,t)=>Object(l.jsx)(d,{resetError:e,lastError:t,themeStyle:n}),children:t})}},1094:function(e,t,n){"use strict";n.d(t,"b",(function(){return g})),n.d(t,"a",(function(){return j}));var i=n(1189),o=n(1080),r=n(1081),a=n(1082),s=n(1088),c=n(1083),l=n(1079),d=n(1063),u=n(1072),m=n(1073),h=n(1074),b=n(1075),p=n(1076),f=n(1084);const g=i.a`
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
	${o.a}
	# Settings Fragments
	${r.a}
	${a.a}
	# Style Fragments
	${s.a}
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
`,j=i.a`
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
`},1095:function(e,t,n){"use strict";n.d(t,"a",(function(){return I}));n(0);var i=n(7),o=n(29),r=n(438),a=n(2),s=n(127),c=n(8),l=n(165),d=n(1070),u=n(1);const m=i.f.div.withConfig({displayName:"FormSkeleton__SkeletonWrapper",componentId:"sc-1xvkpmg-0"})(["",";"],a.b),h=i.f.div.withConfig({displayName:"FormSkeleton__SkeletonContainer",componentId:"sc-1xvkpmg-1"})(["margin:0 auto;box-shadow:",";border-radius:",";overflow:hidden;"],(e=>e.theme.boxShadow4dp),(e=>Object(a.n)(e.theme.borderRadiusBase))),b=i.f.div.withConfig({displayName:"FormSkeleton__SkeletonTabsContainer",componentId:"sc-1xvkpmg-2"})(["background-color:",";width:100%;overflow:hidden;border-top-left-radius:",";border-top-right-radius:",";padding:0 "," 0 0;"],(e=>Object(o.d)(.003,e.theme.backgroundControl)),(e=>Object(a.n)(e.theme.borderRadiusBase)),(e=>Object(a.n)(e.theme.borderRadiusBase)),(e=>Object(a.n)(e.theme.gutter))),p=i.f.div.withConfig({displayName:"FormSkeleton__SkeletonTabsButtonsContainer",componentId:"sc-1xvkpmg-3"})(["height:",";overflow:hidden;display:flex;flex-flow:row nowrap;align-items:center;"],(e=>Object(a.n)(1.25*e.theme.controlHeightBase))),f=i.f.div.withConfig({displayName:"FormSkeleton__TabButtonContainer",componentId:"sc-1xvkpmg-4"})(["display:flex;flex-flow:row nowrap;width:150px;padding:0 ",";align-items:center;justify-content:flex-start;"],(e=>Object(a.n)(e.theme.gutter))),g=i.f.div.withConfig({displayName:"FormSkeleton__TabButtonIcon",componentId:"sc-1xvkpmg-5"})(["flex:0 0 ",";width:",";margin:0 "," 0 0;"],(e=>Object(a.n)(e.theme.fz.large3)),(e=>Object(a.n)(e.theme.fz.large3)),(e=>Object(a.n)(e.theme.gutter/2))),j=i.f.div.withConfig({displayName:"FormSkeleton__TabButtonLabels",componentId:"sc-1xvkpmg-6"})(["flex:0 0 calc( 100% - "," );display:flex;flex-flow:column nowrap;justify-content:space-between;align-items:flex-start;"],(e=>Object(a.n)(e.theme.gutter/2+e.theme.fz.large3)));function O(){const e=Object(i.h)();return Object(u.jsxs)(f,{children:[Object(u.jsx)(g,{children:Object(u.jsx)(r.b.Avatar,{height:e.fz.large3,color:"darker"})}),Object(u.jsxs)(j,{children:[Object(u.jsx)(r.b,{height:e.fz.large1,shape:"rectangle",width:"50px",marginBottom:.25*e.gutter,color:"darker"}),Object(u.jsx)(r.b,{height:e.fz.small2,shape:"rectangle",width:"90px",color:"darker"})]})]})}const v=[{title:48,subtitle:68},{title:33,subtitle:68},{title:36,subtitle:68},{title:31,subtitle:62},{title:29,subtitle:61},{title:36,subtitle:61},{title:36,subtitle:51},{title:21,subtitle:57},{title:32,subtitle:56},{title:33,subtitle:59},{title:24,subtitle:58},{title:37,subtitle:52},{title:22,subtitle:60},{title:21,subtitle:54},{title:29,subtitle:59},{title:25,subtitle:56},{title:37,subtitle:55},{title:38,subtitle:63},{title:43,subtitle:68},{title:49,subtitle:53}],y=[[172,128,140,149],[197,167,74,137],[145,108,140,166],[178,101,108,148],[140,194,114,105],[138,123,170,115],[148,107,129,165],[129,192,140,137],[109,186,175,81],[87,166,68,154],[194,199,110,193],[133,75,93,86],[114,108,173,82],[154,126,98,110],[168,196,183,106],[92,147,170,178],[92,144,138,70],[112,119,149,116],[172,187,114,162],[153,107,150,153]];function w(e){const t=e.widthSet,n=y[t%y.length-1];return Object(u.jsxs)(l.a,{columns:c.s.ONE,controlAlignment:c.B.LEFT,children:[Object(u.jsx)(l.a.Item,{children:Object(u.jsx)(r.b.MCQOption,{type:"radio",width:n[0]})}),Object(u.jsx)(l.a.Item,{children:Object(u.jsx)(r.b.MCQOption,{type:"radio",width:n[1]})})]})}function x(e){const t=e.widthSet,n=y[t%y.length-1];return Object(u.jsxs)(l.a,{columns:c.s.ONE,controlAlignment:c.B.LEFT,children:[Object(u.jsx)(l.a.Item,{children:Object(u.jsx)(r.b.MCQOption,{type:"checkbox",width:n[0]})}),Object(u.jsx)(l.a.Item,{children:Object(u.jsx)(r.b.MCQOption,{type:"checkbox",width:n[1]})}),Object(u.jsx)(l.a.Item,{children:Object(u.jsx)(r.b.MCQOption,{type:"checkbox",width:n[2]})}),Object(u.jsx)(l.a.Item,{children:Object(u.jsx)(r.b.MCQOption,{type:"checkbox",width:n[3]})})]})}function C(e){const t=e.widthSet,n=v[t%v.length-1],i=n.title,o=n.subtitle;return Object(u.jsx)(r.b.Label,{titleWidth:`${i}%`,subtitleWidth:`${o}%`})}function _(e){const t=e.type,n=e.widthSet;return Object(u.jsx)(s.a.Item,{columnSize:c.J.FULL,widths:[],children:Object(u.jsxs)(s.a.Gutter,{children:[Object(u.jsx)(C,{widthSet:n}),"checkbox"===t?Object(u.jsx)(x,{widthSet:n}):"radio"===t?Object(u.jsx)(w,{widthSet:n}):"input"===t?Object(u.jsx)(r.b.Text,{}):Object(u.jsx)(r.b.Textarea,{})]})})}function k(e){const t=e.panels,n=void 0===t?3:t,i=[];if(n>=1)for(let e=0;e<n;e++)i.push(Object(u.jsx)(O,{},e));else i.push(Object(u.jsx)(O,{},"1"));return Object(u.jsx)(b,{children:Object(u.jsx)(p,{children:i})})}function S(e){const t=e.controls,n=void 0===t?5:t,i=[];return n<1&&i.push(Object(u.jsx)(_,{widthSet:1,type:"radio"},"0")),n>=1&&i.push(Object(u.jsx)(_,{widthSet:1,type:"radio"},"1")),n>=2&&i.push(Object(u.jsx)(_,{widthSet:2,type:"input"},"2")),n>=3&&i.push(Object(u.jsx)(_,{widthSet:3,type:"checkbox"},"3")),n>=4&&i.push(Object(u.jsx)(_,{widthSet:4,type:"textarea"},"4")),n>=5&&i.push(Object(u.jsx)(_,{widthSet:5,type:"radio"},"5")),Object(u.jsx)(u.Fragment,{children:i})}const E=i.f.div.withConfig({displayName:"FormSkeleton__SkeletonTabsPanelContainer",componentId:"sc-1xvkpmg-7"})(["background-color:",";border-bottom-left-radius:",";border-bottom-right-radius:",";"],(e=>e.theme.appBackgroundColor),(e=>Object(a.n)(e.theme.borderRadiusBase)),(e=>Object(a.n)(e.theme.borderRadiusBase)));function I({panels:e=3,controls:t=5,hasEditHeader:n=!1}){return Object(u.jsxs)(m,{className:"wpeform-component-formskeleton",children:[n?Object(u.jsx)(d.a.PreviewToolbar,{}):null,Object(u.jsxs)(h,{children:[Object(u.jsx)(k,{panels:e}),Object(u.jsx)(E,{children:Object(u.jsx)(s.a,{children:Object(u.jsx)(S,{controls:Math.max(2,t)})})})]})]})}I.FormControl=_},1098:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));var i=n(0);function o(e){return i.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),i.createElement("path",{d:"M492 241c11.047 0 20-8.953 20-20v-61c0-44.113-35.887-80-80-80H160c-44.113 0-80 35.887-80 80v272c0 44.113 35.887 80 80 80h201.516c5.32 0 10.421-2.121 14.175-5.89l130.485-131.114A19.993 19.993 0 00512 360.891V321c0-11.047-8.953-20-20-20s-20 8.953-20 20v19.89h-60.11c-38.6 0-70 31.4-70 70V472H160c-22.055 0-40-17.945-40-40V160c0-22.055 17.945-40 40-40h272c22.055 0 40 17.945 40 40v61c0 11.047 8.953 20 20 20zm-80.11 139.89h31.989l-61.988 62.286V410.89c0-16.543 13.457-30 30-30zM80 40c-22.055 0-40 17.945-40 40v313c0 11.047-8.953 20-20 20s-20-8.953-20-20V80C0 35.887 35.887 0 80 0h312c11.047 0 20 8.953 20 20s-8.953 20-20 20H80zm331 160c0 11.047-8.953 20-20 20H200c-11.047 0-20-8.953-20-20s8.953-20 20-20h191c11.047 0 20 8.953 20 20zm-20 100H200c-11.047 0-20-8.953-20-20s8.953-20 20-20h191c11.047 0 20 8.953 20 20s-8.953 20-20 20zm-110 40c11.047 0 20 8.953 20 20s-8.953 20-20 20h-81c-11.047 0-20-8.953-20-20s8.953-20 20-20h81z"}))}n.p},1099:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));var i=n(0);function o(e){return i.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),i.createElement("path",{d:"M269.586 96.562l-142.804 142.56a19.999 19.999 0 00-5.007 8.342l-23.912 78.725a20 20 0 0024.475 25.087l80.725-22.362a20.008 20.008 0 008.793-5.122l142.57-142.363c23.276-22.335 23.275-62.519 0-84.854-23.394-23.394-61.459-23.396-84.84-.013zm-82.271 195.206l-40.61 11.25 11.886-39.131 107.097-106.913 28.288 28.288-106.661 106.506zm138.837-138.636l-3.871 3.865-28.284-28.284 3.861-3.854c7.797-7.799 20.486-7.799 28.283 0 7.799 7.797 7.799 20.485.011 28.273zM472 312V80c0-22.056-17.944-40-40-40H80c-22.056 0-40 17.944-40 40v352c0 22.056 17.944 40 40 40h352c22.056 0 40-17.944 40-40H117c-26.536-1.056-26.516-38.953 0-40h375c11.046 0 20 8.954 20 20v20c0 44.112-35.888 80-80 80H80c-44.112 0-80-35.888-80-80V80C0 35.888 35.888 0 80 0h352c44.112 0 80 35.888 80 80v232c-1.056 26.536-38.953 26.516-40 0z"}))}n.p},1100:function(e,t,n){"use strict";n.d(t,"b",(function(){return o})),n.d(t,"a",(function(){return r}));var i=n(1189);const o=i.a`
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
`,r=i.a`
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
	${o}
`},1101:function(e,t,n){"use strict";var i=n(5),o=n(4),r=n(9),a=n(0),s=n.n(a),c={icon:{tag:"svg",attrs:{viewBox:"64 64 896 896",focusable:"false"},children:[{tag:"path",attrs:{d:"M272.9 512l265.4-339.1c4.1-5.2.4-12.9-6.3-12.9h-77.3c-4.9 0-9.6 2.3-12.6 6.1L186.8 492.3a31.99 31.99 0 000 39.5l255.3 326.1c3 3.9 7.7 6.1 12.6 6.1H532c6.7 0 10.4-7.7 6.3-12.9L272.9 512zm304 0l265.4-339.1c4.1-5.2.4-12.9-6.3-12.9h-77.3c-4.9 0-9.6 2.3-12.6 6.1L490.8 492.3a31.99 31.99 0 000 39.5l255.3 326.1c3 3.9 7.7 6.1 12.6 6.1H836c6.7 0 10.4-7.7 6.3-12.9L576.9 512z"}}]},name:"double-left",theme:"outlined"},l=n(41),d=function(e,t){return a.createElement(l.a,Object(r.a)(Object(r.a)({},e),{},{ref:t,icon:c}))};d.displayName="DoubleLeftOutlined";var u=a.forwardRef(d),m={icon:{tag:"svg",attrs:{viewBox:"64 64 896 896",focusable:"false"},children:[{tag:"path",attrs:{d:"M533.2 492.3L277.9 166.1c-3-3.9-7.7-6.1-12.6-6.1H188c-6.7 0-10.4 7.7-6.3 12.9L447.1 512 181.7 851.1A7.98 7.98 0 00188 864h77.3c4.9 0 9.6-2.3 12.6-6.1l255.3-326.1c9.1-11.7 9.1-27.9 0-39.5zm304 0L581.9 166.1c-3-3.9-7.7-6.1-12.6-6.1H492c-6.7 0-10.4 7.7-6.3 12.9L751.1 512 485.7 851.1A7.98 7.98 0 00492 864h77.3c4.9 0 9.6-2.3 12.6-6.1l255.3-326.1c9.1-11.7 9.1-27.9 0-39.5z"}}]},name:"double-right",theme:"outlined"},h=function(e,t){return a.createElement(l.a,Object(r.a)(Object(r.a)({},e),{},{ref:t,icon:m}))};h.displayName="DoubleRightOutlined";var b=a.forwardRef(h),p=n(416),f=n(260),g=n(10),j=n.n(g),O=n(47),v=n(48),y=n(58),w=n(59),x=function(e){var t,n="".concat(e.rootPrefixCls,"-item"),o=j()(n,"".concat(n,"-").concat(e.page),(t={},Object(i.a)(t,"".concat(n,"-active"),e.active),Object(i.a)(t,"".concat(n,"-disabled"),!e.page),Object(i.a)(t,e.className,!!e.className),t));return s.a.createElement("li",{title:e.showTitle?e.page:null,className:o,onClick:function(){e.onClick(e.page)},onKeyPress:function(t){e.onKeyPress(t,e.onClick,e.page)},tabIndex:"0"},e.itemRender(e.page,"page",s.a.createElement("a",{rel:"nofollow"},e.page)))},C=13,_=38,k=40,S=function(e){Object(y.a)(n,e);var t=Object(w.a)(n);function n(){var e;Object(O.a)(this,n);for(var i=arguments.length,o=new Array(i),r=0;r<i;r++)o[r]=arguments[r];return(e=t.call.apply(t,[this].concat(o))).state={goInputText:""},e.buildOptionText=function(t){return"".concat(t," ").concat(e.props.locale.items_per_page)},e.changeSize=function(t){e.props.changeSize(Number(t))},e.handleChange=function(t){e.setState({goInputText:t.target.value})},e.handleBlur=function(t){var n=e.props,i=n.goButton,o=n.quickGo,r=n.rootPrefixCls,a=e.state.goInputText;i||""===a||(e.setState({goInputText:""}),t.relatedTarget&&(t.relatedTarget.className.indexOf("".concat(r,"-item-link"))>=0||t.relatedTarget.className.indexOf("".concat(r,"-item"))>=0)||o(e.getValidValue()))},e.go=function(t){""!==e.state.goInputText&&(t.keyCode!==C&&"click"!==t.type||(e.setState({goInputText:""}),e.props.quickGo(e.getValidValue())))},e}return Object(v.a)(n,[{key:"getValidValue",value:function(){var e=this.state.goInputText;return!e||isNaN(e)?void 0:Number(e)}},{key:"getPageSizeOptions",value:function(){var e=this.props,t=e.pageSize,n=e.pageSizeOptions;return n.some((function(e){return e.toString()===t.toString()}))?n:n.concat([t.toString()]).sort((function(e,t){return(isNaN(Number(e))?0:Number(e))-(isNaN(Number(t))?0:Number(t))}))}},{key:"render",value:function(){var e=this,t=this.props,n=t.pageSize,i=t.locale,o=t.rootPrefixCls,r=t.changeSize,a=t.quickGo,c=t.goButton,l=t.selectComponentClass,d=t.buildOptionText,u=t.selectPrefixCls,m=t.disabled,h=this.state.goInputText,b="".concat(o,"-options"),p=l,f=null,g=null,j=null;if(!r&&!a)return null;var O=this.getPageSizeOptions();if(r&&p){var v=O.map((function(t,n){return s.a.createElement(p.Option,{key:n,value:t.toString()},(d||e.buildOptionText)(t))}));f=s.a.createElement(p,{disabled:m,prefixCls:u,showSearch:!1,className:"".concat(b,"-size-changer"),optionLabelProp:"children",dropdownMatchSelectWidth:!1,value:(n||O[0]).toString(),onChange:this.changeSize,getPopupContainer:function(e){return e.parentNode},"aria-label":i.page_size,defaultOpen:!1},v)}return a&&(c&&(j="boolean"==typeof c?s.a.createElement("button",{type:"button",onClick:this.go,onKeyUp:this.go,disabled:m,className:"".concat(b,"-quick-jumper-button")},i.jump_to_confirm):s.a.createElement("span",{onClick:this.go,onKeyUp:this.go},c)),g=s.a.createElement("div",{className:"".concat(b,"-quick-jumper")},i.jump_to,s.a.createElement("input",{disabled:m,type:"text",value:h,onChange:this.handleChange,onKeyUp:this.go,onBlur:this.handleBlur,"aria-label":i.page}),i.page,j)),s.a.createElement("li",{className:"".concat(b)},f,g)}}]),n}(s.a.Component);S.defaultProps={pageSizeOptions:["10","20","50","100"]};var E=S;function I(){}function T(e){var t=Number(e);return"number"==typeof t&&!isNaN(t)&&isFinite(t)&&Math.floor(t)===t}function F(e,t,n){var i=void 0===e?t.pageSize:e;return Math.floor((n.total-1)/i)+1}var P=function(e){Object(y.a)(n,e);var t=Object(w.a)(n);function n(e){var i;Object(O.a)(this,n),(i=t.call(this,e)).getJumpPrevPage=function(){return Math.max(1,i.state.current-(i.props.showLessItems?3:5))},i.getJumpNextPage=function(){return Math.min(F(void 0,i.state,i.props),i.state.current+(i.props.showLessItems?3:5))},i.getItemIcon=function(e,t){var n=i.props.prefixCls,o=e||s.a.createElement("button",{type:"button","aria-label":t,className:"".concat(n,"-item-link")});return"function"==typeof e&&(o=s.a.createElement(e,Object(r.a)({},i.props))),o},i.savePaginationNode=function(e){i.paginationNode=e},i.isValid=function(e){var t=i.props.total;return T(e)&&e!==i.state.current&&T(t)&&t>0},i.shouldDisplayQuickJumper=function(){var e=i.props,t=e.showQuickJumper;return!(e.total<=i.state.pageSize)&&t},i.handleKeyDown=function(e){e.keyCode!==_&&e.keyCode!==k||e.preventDefault()},i.handleKeyUp=function(e){var t=i.getValidValue(e);t!==i.state.currentInputValue&&i.setState({currentInputValue:t}),e.keyCode===C?i.handleChange(t):e.keyCode===_?i.handleChange(t-1):e.keyCode===k&&i.handleChange(t+1)},i.handleBlur=function(e){var t=i.getValidValue(e);i.handleChange(t)},i.changePageSize=function(e){var t=i.state.current,n=F(e,i.state,i.props);t=t>n?n:t,0===n&&(t=i.state.current),"number"==typeof e&&("pageSize"in i.props||i.setState({pageSize:e}),"current"in i.props||i.setState({current:t,currentInputValue:t})),i.props.onShowSizeChange(t,e),"onChange"in i.props&&i.props.onChange&&i.props.onChange(t,e)},i.handleChange=function(e){var t=i.props,n=t.disabled,o=t.onChange,r=i.state,a=r.pageSize,s=r.current,c=r.currentInputValue;if(i.isValid(e)&&!n){var l=F(void 0,i.state,i.props),d=e;return e>l?d=l:e<1&&(d=1),"current"in i.props||i.setState({current:d}),d!==c&&i.setState({currentInputValue:d}),o(d,a),d}return s},i.prev=function(){i.hasPrev()&&i.handleChange(i.state.current-1)},i.next=function(){i.hasNext()&&i.handleChange(i.state.current+1)},i.jumpPrev=function(){i.handleChange(i.getJumpPrevPage())},i.jumpNext=function(){i.handleChange(i.getJumpNextPage())},i.hasPrev=function(){return i.state.current>1},i.hasNext=function(){return i.state.current<F(void 0,i.state,i.props)},i.runIfEnter=function(e,t){if("Enter"===e.key||13===e.charCode){for(var n=arguments.length,i=new Array(n>2?n-2:0),o=2;o<n;o++)i[o-2]=arguments[o];t.apply(void 0,i)}},i.runIfEnterPrev=function(e){i.runIfEnter(e,i.prev)},i.runIfEnterNext=function(e){i.runIfEnter(e,i.next)},i.runIfEnterJumpPrev=function(e){i.runIfEnter(e,i.jumpPrev)},i.runIfEnterJumpNext=function(e){i.runIfEnter(e,i.jumpNext)},i.handleGoTO=function(e){e.keyCode!==C&&"click"!==e.type||i.handleChange(i.state.currentInputValue)};var o=e.onChange!==I;"current"in e&&!o&&console.warn("Warning: You provided a `current` prop to a Pagination component without an `onChange` handler. This will render a read-only component.");var a=e.defaultCurrent;"current"in e&&(a=e.current);var c=e.defaultPageSize;return"pageSize"in e&&(c=e.pageSize),a=Math.min(a,F(c,void 0,e)),i.state={current:a,currentInputValue:a,pageSize:c},i}return Object(v.a)(n,[{key:"componentDidUpdate",value:function(e,t){var n=this.props.prefixCls;if(t.current!==this.state.current&&this.paginationNode){var i=this.paginationNode.querySelector(".".concat(n,"-item-").concat(t.current));i&&document.activeElement===i&&i.blur()}}},{key:"getValidValue",value:function(e){var t=e.target.value,n=F(void 0,this.state,this.props),i=this.state.currentInputValue;return""===t?t:isNaN(Number(t))?i:t>=n?n:Number(t)}},{key:"getShowSizeChanger",value:function(){var e=this.props,t=e.showSizeChanger,n=e.total,i=e.totalBoundaryShowSizeChanger;return void 0!==t?t:n>i}},{key:"renderPrev",value:function(e){var t=this.props,n=t.prevIcon,i=(0,t.itemRender)(e,"prev",this.getItemIcon(n,"prev page")),o=!this.hasPrev();return Object(a.isValidElement)(i)?Object(a.cloneElement)(i,{disabled:o}):i}},{key:"renderNext",value:function(e){var t=this.props,n=t.nextIcon,i=(0,t.itemRender)(e,"next",this.getItemIcon(n,"next page")),o=!this.hasNext();return Object(a.isValidElement)(i)?Object(a.cloneElement)(i,{disabled:o}):i}},{key:"render",value:function(){var e=this,t=this.props,n=t.prefixCls,r=t.className,c=t.style,l=t.disabled,d=t.hideOnSinglePage,u=t.total,m=t.locale,h=t.showQuickJumper,b=t.showLessItems,p=t.showTitle,f=t.showTotal,g=t.simple,O=t.itemRender,v=t.showPrevNextJumpers,y=t.jumpPrevIcon,w=t.jumpNextIcon,C=t.selectComponentClass,_=t.selectPrefixCls,k=t.pageSizeOptions,S=this.state,I=S.current,T=S.pageSize,P=S.currentInputValue;if(!0===d&&u<=T)return null;var N=F(void 0,this.state,this.props),M=[],L=null,B=null,D=null,R=null,z=null,A=h&&h.goButton,H=b?1:2,V=I-1>0?I-1:0,$=I+1<N?I+1:N,q=Object.keys(this.props).reduce((function(t,n){return"data-"!==n.substr(0,5)&&"aria-"!==n.substr(0,5)&&"role"!==n||(t[n]=e.props[n]),t}),{});if(g)return A&&(z="boolean"==typeof A?s.a.createElement("button",{type:"button",onClick:this.handleGoTO,onKeyUp:this.handleGoTO},m.jump_to_confirm):s.a.createElement("span",{onClick:this.handleGoTO,onKeyUp:this.handleGoTO},A),z=s.a.createElement("li",{title:p?"".concat(m.jump_to).concat(I,"/").concat(N):null,className:"".concat(n,"-simple-pager")},z)),s.a.createElement("ul",Object(o.a)({className:j()(n,"".concat(n,"-simple"),Object(i.a)({},"".concat(n,"-disabled"),l),r),style:c,ref:this.savePaginationNode},q),s.a.createElement("li",{title:p?m.prev_page:null,onClick:this.prev,tabIndex:this.hasPrev()?0:null,onKeyPress:this.runIfEnterPrev,className:j()("".concat(n,"-prev"),Object(i.a)({},"".concat(n,"-disabled"),!this.hasPrev())),"aria-disabled":!this.hasPrev()},this.renderPrev(V)),s.a.createElement("li",{title:p?"".concat(I,"/").concat(N):null,className:"".concat(n,"-simple-pager")},s.a.createElement("input",{type:"text",value:P,disabled:l,onKeyDown:this.handleKeyDown,onKeyUp:this.handleKeyUp,onChange:this.handleKeyUp,onBlur:this.handleBlur,size:"3"}),s.a.createElement("span",{className:"".concat(n,"-slash")},"/"),N),s.a.createElement("li",{title:p?m.next_page:null,onClick:this.next,tabIndex:this.hasPrev()?0:null,onKeyPress:this.runIfEnterNext,className:j()("".concat(n,"-next"),Object(i.a)({},"".concat(n,"-disabled"),!this.hasNext())),"aria-disabled":!this.hasNext()},this.renderNext($)),z);if(N<=3+2*H){var U={locale:m,rootPrefixCls:n,onClick:this.handleChange,onKeyPress:this.runIfEnter,showTitle:p,itemRender:O};N||M.push(s.a.createElement(x,Object(o.a)({},U,{key:"noPager",page:1,className:"".concat(n,"-item-disabled")})));for(var W=1;W<=N;W+=1){var K=I===W;M.push(s.a.createElement(x,Object(o.a)({},U,{key:W,page:W,active:K})))}}else{var Y=b?m.prev_3:m.prev_5,G=b?m.next_3:m.next_5;v&&(L=s.a.createElement("li",{title:p?Y:null,key:"prev",onClick:this.jumpPrev,tabIndex:"0",onKeyPress:this.runIfEnterJumpPrev,className:j()("".concat(n,"-jump-prev"),Object(i.a)({},"".concat(n,"-jump-prev-custom-icon"),!!y))},O(this.getJumpPrevPage(),"jump-prev",this.getItemIcon(y,"prev page"))),B=s.a.createElement("li",{title:p?G:null,key:"next",tabIndex:"0",onClick:this.jumpNext,onKeyPress:this.runIfEnterJumpNext,className:j()("".concat(n,"-jump-next"),Object(i.a)({},"".concat(n,"-jump-next-custom-icon"),!!w))},O(this.getJumpNextPage(),"jump-next",this.getItemIcon(w,"next page")))),R=s.a.createElement(x,{locale:m,last:!0,rootPrefixCls:n,onClick:this.handleChange,onKeyPress:this.runIfEnter,key:N,page:N,active:!1,showTitle:p,itemRender:O}),D=s.a.createElement(x,{locale:m,rootPrefixCls:n,onClick:this.handleChange,onKeyPress:this.runIfEnter,key:1,page:1,active:!1,showTitle:p,itemRender:O});var Q=Math.max(1,I-H),J=Math.min(I+H,N);I-1<=H&&(J=1+2*H),N-I<=H&&(Q=N-2*H);for(var X=Q;X<=J;X+=1){var Z=I===X;M.push(s.a.createElement(x,{locale:m,rootPrefixCls:n,onClick:this.handleChange,onKeyPress:this.runIfEnter,key:X,page:X,active:Z,showTitle:p,itemRender:O}))}I-1>=2*H&&3!==I&&(M[0]=Object(a.cloneElement)(M[0],{className:"".concat(n,"-item-after-jump-prev")}),M.unshift(L)),N-I>=2*H&&I!==N-2&&(M[M.length-1]=Object(a.cloneElement)(M[M.length-1],{className:"".concat(n,"-item-before-jump-next")}),M.push(B)),1!==Q&&M.unshift(D),J!==N&&M.push(R)}var ee=null;f&&(ee=s.a.createElement("li",{className:"".concat(n,"-total-text")},f(u,[0===u?0:(I-1)*T+1,I*T>u?u:I*T])));var te=!this.hasPrev()||!N,ne=!this.hasNext()||!N;return s.a.createElement("ul",Object(o.a)({className:j()(n,r,Object(i.a)({},"".concat(n,"-disabled"),l)),style:c,unselectable:"unselectable",ref:this.savePaginationNode},q),ee,s.a.createElement("li",{title:p?m.prev_page:null,onClick:this.prev,tabIndex:te?null:0,onKeyPress:this.runIfEnterPrev,className:j()("".concat(n,"-prev"),Object(i.a)({},"".concat(n,"-disabled"),te)),"aria-disabled":te},this.renderPrev(V)),M,s.a.createElement("li",{title:p?m.next_page:null,onClick:this.next,tabIndex:ne?null:0,onKeyPress:this.runIfEnterNext,className:j()("".concat(n,"-next"),Object(i.a)({},"".concat(n,"-disabled"),ne)),"aria-disabled":ne},this.renderNext($)),s.a.createElement(E,{disabled:l,locale:m,rootPrefixCls:n,selectComponentClass:C,selectPrefixCls:_,changeSize:this.getShowSizeChanger()?this.changePageSize:null,current:I,pageSize:T,pageSizeOptions:k,quickGo:this.shouldDisplayQuickJumper()?this.handleChange:null,goButton:A}))}}],[{key:"getDerivedStateFromProps",value:function(e,t){var n={};if("current"in e&&(n.current=e.current,e.current!==t.current&&(n.currentInputValue=n.current)),"pageSize"in e&&e.pageSize!==t.pageSize){var i=t.current,o=F(e.pageSize,t,e);i=i>o?o:i,"current"in e||(n.current=i,n.currentInputValue=i),n.pageSize=e.pageSize}return n}}]),n}(s.a.Component);P.defaultProps={defaultCurrent:1,total:0,defaultPageSize:10,onChange:I,className:"",selectPrefixCls:"rc-select",prefixCls:"rc-pagination",selectComponentClass:null,hideOnSinglePage:!1,showPrevNextJumpers:!0,showQuickJumper:!1,showLessItems:!1,showTitle:!0,onShowSizeChange:I,locale:{items_per_page:"条/页",jump_to:"跳至",jump_to_confirm:"确定",page:"页",prev_page:"上一页",next_page:"下一页",prev_5:"向前 5 页",next_5:"向后 5 页",prev_3:"向前 3 页",next_3:"向后 3 页",page_size:"页码"},style:{},itemRender:function(e,t,n){return n},totalBoundaryShowSizeChanger:50};var N=P,M=n(457),L=n(146),B=n(6);function D(){var e=a.useReducer((function(e){return e+1}),0);return Object(B.a)(e,2)[1]}var R=n(1115);var z=function(){var e=!(arguments.length>0&&void 0!==arguments[0])||arguments[0],t=Object(a.useRef)({}),n=D();return Object(a.useEffect)((function(){var i=R.a.subscribe((function(i){t.current=i,e&&n()}));return function(){return R.a.unsubscribe(i)}}),[]),t.current},A=n(116),H=n(161),V=function(e){return a.createElement(H.a,Object(o.a)({},e,{size:"small"}))},$=function(e){return a.createElement(H.a,Object(o.a)({},e,{size:"middle"}))};V.Option=H.a.Option,$.Option=H.a.Option;var q=function(e,t){var n={};for(var i in e)Object.prototype.hasOwnProperty.call(e,i)&&t.indexOf(i)<0&&(n[i]=e[i]);if(null!=e&&"function"==typeof Object.getOwnPropertySymbols){var o=0;for(i=Object.getOwnPropertySymbols(e);o<i.length;o++)t.indexOf(i[o])<0&&Object.prototype.propertyIsEnumerable.call(e,i[o])&&(n[i[o]]=e[i[o]])}return n},U=function(e){var t=e.prefixCls,n=e.selectPrefixCls,r=e.className,s=e.size,c=e.locale,l=e.selectComponentClass,d=e.responsive,m=e.showSizeChanger,h=q(e,["prefixCls","selectPrefixCls","className","size","locale","selectComponentClass","responsive","showSizeChanger"]),g=z(d).xs,O=a.useContext(L.b),v=O.getPrefixCls,y=O.direction,w=O.pagination,x=void 0===w?{}:w,C=v("pagination",t),_=null!=m?m:x.showSizeChanger;return a.createElement(A.a,{componentName:"Pagination",defaultLocale:M.a},(function(e){var t,m=Object(o.a)(Object(o.a)({},e),c),O="small"===s||!(!g||s||!d),w=v("select",n),x=j()((t={},Object(i.a)(t,"".concat(C,"-mini"),O),Object(i.a)(t,"".concat(C,"-rtl"),"rtl"===y),t),r);return a.createElement(N,Object(o.a)({},function(){var e=a.createElement("span",{className:"".concat(C,"-item-ellipsis")},"•••"),t=a.createElement("button",{className:"".concat(C,"-item-link"),type:"button",tabIndex:-1},a.createElement(p.a,null)),n=a.createElement("button",{className:"".concat(C,"-item-link"),type:"button",tabIndex:-1},a.createElement(f.a,null)),i=a.createElement("a",{className:"".concat(C,"-item-link")},a.createElement("div",{className:"".concat(C,"-item-container")},a.createElement(u,{className:"".concat(C,"-item-link-icon")}),e)),o=a.createElement("a",{className:"".concat(C,"-item-link")},a.createElement("div",{className:"".concat(C,"-item-container")},a.createElement(b,{className:"".concat(C,"-item-link-icon")}),e));if("rtl"===y){var r=[n,t];t=r[0],n=r[1];var s=[o,i];i=s[0],o=s[1]}return{prevIcon:t,nextIcon:n,jumpPrevIcon:i,jumpNextIcon:o}}(),h,{prefixCls:C,selectPrefixCls:w,className:x,selectComponentClass:l||(O?V:$),locale:m,showSizeChanger:_}))}))};t.a=U},1106:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));var i=n(0);function o(e){return i.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),i.createElement("path",{d:"M458.388 432.002c0 44.113-35.887 80-80 80H132.5c-44.113 0-80-35.887-80-80V119c0-44.113 35.887-80 80-80h3.801c8.531-22.758 30.5-39 56.2-39 33.086 0 60 26.914 60 60v141c0 33.087-26.914 60.001-60 60.001-33.087 0-60-26.914-60-60v-62c0-11.047 8.952-20 20-20 11.046 0 20 8.953 20 20v62c0 11.027 8.972 20 20 20 11.027 0 20-8.973 20-20V60c0-11.028-8.973-20-20-20-9.352 0-17.2 6.46-19.38 15.144.243 1.25.38 2.535.38 3.855 0 5.778-2.465 10.969-6.383 14.617C163.469 77.535 158.278 80 152.5 80c-2.175 0-4.261-.36-6.222-1H132.5c-22.054 0-40 17.946-40 40v313.002c0 22.054 17.946 40 40 40h245.892c22.055 0 40-17.946 40-40 0-11.047 8.953-20 20-20 11.043 0 19.996 8.953 19.996 20zm-306.888-50c-11.047 0-20 8.953-20 20 0 11.046 8.953 20 20 20h146c11.048 0 20.001-8.954 20.001-20 0-11.047-8.953-20-20-20h-146zm226.001-61c0-11.048-8.953-20-20-20h-206c-11.048 0-20 8.952-20 20 0 11.046 8.952 20 20 20h206c11.047 0 20-8.954 20-20zM378.388 39h-66.887c-11.047 0-20 8.953-20 20s8.953 20 20 20h66.887c22.059 0 40 17.946 40 40v213.001c0 11.047 8.957 20 20 20 11.047 0 20-8.953 20-20v-213c0-44.114-35.887-80-80-80z"}))}n.p},1107:function(e,t,n){"use strict";n.d(t,"a",(function(){return o})),n.d(t,"b",(function(){return r}));n(8);var i=n(88);n(108);function o(e,t){const n=!!i.wpEFormElementFrontCollection.hasItem(e.type)&&i.wpEFormElementFrontCollection.getItem(e.type);return!!n&&(!!n.getAnswerValue&&n.getAnswerValue(e,t))}function r(e,t){const n=!!i.wpEFormElementFrontCollection.hasItem(e.type)&&i.wpEFormElementFrontCollection.getItem(e.type);return!!n&&(!!n.getDisplayValue&&n.getDisplayValue(e,t))}},1115:function(e,t,n){"use strict";n.d(t,"b",(function(){return r}));var i=n(5),o=n(4),r=["xxl","xl","lg","md","sm","xs"],a={xs:"(max-width: 575px)",sm:"(min-width: 576px)",md:"(min-width: 768px)",lg:"(min-width: 992px)",xl:"(min-width: 1200px)",xxl:"(min-width: 1600px)"},s=new Map,c=-1,l={},d={matchHandlers:{},dispatch:function(e){return l=e,s.forEach((function(e){return e(l)})),s.size>=1},subscribe:function(e){return s.size||this.register(),c+=1,s.set(c,e),e(l),c},unsubscribe:function(e){s.delete(e),s.size||this.unregister()},unregister:function(){var e=this;Object.keys(a).forEach((function(t){var n=a[t],i=e.matchHandlers[n];null==i||i.mql.removeListener(null==i?void 0:i.listener)})),s.clear()},register:function(){var e=this;Object.keys(a).forEach((function(t){var n=a[t],r=function(n){var r=n.matches;e.dispatch(Object(o.a)(Object(o.a)({},l),Object(i.a)({},t,r)))},s=window.matchMedia(n);s.addListener(r),e.matchHandlers[n]={mql:s,listener:r},r(s)}))}};t.a=d},1118:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));var i=n(0);function o(e){return i.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),i.createElement("path",{d:"M175.995 471.988h-31.22c-20.778 0-37.877-15.575-39.823-36.247L80.83 122.997h310.33l-5.127 66.46c-.85 11.013 7.39 20.629 18.403 21.479.523.04 1.043.06 1.56.06 10.346 0 19.109-7.974 19.918-18.463l5.364-69.536h20.711c11.046 0 20-8.954 20-20 0-11.045-8.954-20-20-20H330.991V59.999C330.991 26.915 304.076 0 270.993 0h-69.998c-33.083 0-59.999 26.915-59.999 59.998v23H20c-11.046 0-20 8.954-20 20 0 11.045 8.954 19.999 20 19.999h20.71l24.373 315.978.023.278a79.82 79.82 0 0025.73 51.814 79.818 79.818 0 0053.937 20.919h31.222c11.046 0 20-8.954 20-20 0-11.045-8.954-19.998-20-19.998zm5-411.99c0-11.027 8.972-19.999 20-19.999h69.998c11.028 0 20 8.972 20 20v22.999H180.994v-23zm54.999 251.994c-11.046 0-20-8.954-20-20V182.995c0-11.045 8.954-20 20-20s20 8.955 20 20v108.997c0 11.046-8.954 20-20 20zm91.246-148.957c11.023.689 19.401 10.184 18.712 21.207l-2 32c-.662 10.598-9.467 18.752-19.941 18.752-.42 0-.841-.013-1.267-.04-11.024-.689-19.402-10.184-18.713-21.208l2-31.999c.69-11.023 10.186-19.405 21.209-18.712zm-161.263 19.087l10 228.928c.481 11.035-8.073 20.372-19.108 20.854-.297.013-.593.019-.888.019-10.644 0-19.497-8.389-19.966-19.127l-10-228.928c-.481-11.034 8.074-20.371 19.108-20.853 11.032-.5 20.372 8.073 20.854 19.107zm280.315 266.242c-21.262 21.258-44.113 34.106-67.92 38.19a20.162 20.162 0 01-3.405.29c-9.561 0-18.016-6.878-19.687-16.621-1.868-10.887 5.444-21.226 16.33-23.093 15.494-2.657 31.106-11.76 46.403-27.053 42.088-42.078 51.458-110.13 53.457-143.526-33.457 2.057-101.647 11.507-143.556 53.405-18.911 18.906-28.044 37.529-27.92 56.932.031 5.018.717 9.787 1.755 14.216 25.612-26.255 53.716-48.434 84.117-66.329 9.52-5.605 21.777-2.429 27.38 7.09 5.603 9.52 2.43 21.778-7.09 27.38-52.801 31.08-96.379 74.71-133.224 133.379-3.799 6.049-10.304 9.366-16.956 9.366a19.91 19.91 0 01-10.617-3.065c-9.354-5.875-12.175-18.22-6.3-27.573 10.229-16.288 21.098-31.642 32.577-46.051-5.356-11.472-11.512-27.974-11.64-48.158-.192-30.228 13.145-58.984 39.638-85.472 69.365-69.348 188.074-65.794 193.094-65.606 10.994.406 19.596 9.616 19.252 20.611-.004.121-.01.241-.015.361.309 15.715.025 125.646-65.673 191.327z"}))}n.p},1119:function(e,t,n){"use strict";n.d(t,"a",(function(){return ge}));var i=n(0),o=n(1129),r=n(3),a=n(8),s=n(1189),c=n(1094),l=n(1063);const d=s.a`
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
`;s.a`
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
`,s.a`
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
`;var u=n(1069),m=n(1093),h=n(1039),b=n(1095),p=n(1070),f=n(441),g=n(1043),j=n(15),O=n(1173),v=n(216),y=(n(199),n(120)),w=(n(108),n(88)),x=n(21),C=n(1);const _=Object(i.createContext)({__typename:"SubmissionType",adminRemarks:"",created:"",elements:[],email:"",fName:"",form:{__typename:"FormType",conditionals:[],elements:[],id:"",limitations:[],name:"",notices:[],pools:[],structures:[],styles:null,settings:null},id:"",ip:"",lName:"",lastUpdated:"",maxScore:0,paid:!1,paymentData:"",phone:"",referer:"",score:0,scoreData:[],submissionLink:"",time:0,token:"",urlTrack:"",user:null,canUserEdit:!1,downloadLink:null,printLink:null});function k(e,t=!0){return Object(i.useMemo)((()=>{if(!e)return[{},{}];const n=e.formMeta,i=e.submission;if(!i)return[{},{}];const o=i.form.elements.map((e=>{var t;return{...e,config:null!==(t=e.config)&&void 0!==t?t:{}}})),r=Object(y.b)(o),a=i.elements.map((e=>{var n,i;const o={errors:[],touched:!1,type:null!==(n=null===(i=r[e.id])||void 0===i?void 0:i.type)&&void 0!==n?n:"unknown",...e};return t&&(o.conditionallyHidden=!1),o})),s=Object(x.m)(Object(y.b)(a),"__typename"),c=Object.keys(r);c.forEach((e=>{const t=r[e];if(!s[t.id]&&n){const e=t.type;var i;if(w.wpEFormElementFrontCollection.hasItem(e))s[t.id]={conditionallyHidden:(null===(i=t.appearance)||void 0===i?void 0:i.initiallyHidden)||!1,id:t.id,type:e,touched:!1,scores:[],...Object(v.g)(n,t,!1)}}}));return Object.keys(s).forEach((e=>{c.includes(e)||delete s[e]})),[s,r]}),[e,t])}function S(){return Object(i.useContext)(_)}const E=Object(i.createContext)({});function I(){return Object(i.useContext)(E)}const T=Object(i.createContext)({});function F(){return Object(i.useContext)(T)}function P(e){const t=e.submissionWithFormData,n=e.children,i=k(t,!1),o=Object(j.a)(i,2),r=o[0],a=o[1];return Object(C.jsx)(_.Provider,{value:t.submission,children:Object(C.jsx)(E.Provider,{value:a,children:Object(C.jsx)(T.Provider,{value:r,children:n})})})}var N=n(1100);const M=s.a`
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
	${N.b}
`;var L=n(1042),B=n(1087),D=n(7),R=n(1090),z=n.n(R),A=n(2),H=n(18);const V=D.f.header.withConfig({displayName:"CancelEditHeader__Container",componentId:"sc-1bkxsiw-0"})(["",";margin:0 0 "," 0;padding:"," 0;border-bottom:2px solid ",";display:flex;align-items:center;justify-content:flex-start;"],A.b,(e=>Object(A.n)(e.theme.gutter)),(e=>Object(A.n)(e.theme.gutter/2)),(e=>e.theme.borderColorBase)),$=D.f.button.withConfig({displayName:"CancelEditHeader__CancelButton",componentId:"sc-1bkxsiw-1"})(["margin:0 0 0 auto;border:0 none;cursor:pointer;background-color:",";height:",";width:",";padding:0;display:flex;align-items:center;justify-content:center;font-size:",";border-radius:",";color:",";outline:none;transition:",";&:hover,&:focus{color:",";background-color:",";}&:active{color:",";background-color:",";}"],(e=>e.theme.appBackgroundColor),(e=>Object(A.n)(.8*e.theme.controlHeightBase)),(e=>Object(A.n)(.8*e.theme.controlHeightBase)),(e=>Object(A.n)(.35*e.theme.controlHeightBase)),(e=>Object(A.n)(e.theme.borderRadiusBase)),(e=>e.theme.textColorSecondary),(e=>Object(A.f)(["background-color","color"],e.theme.transitionControl)),(e=>e.theme.textColor),(e=>e.theme.backgroundHover),(e=>e.theme.textColor),(e=>e.theme.backgroundControl)),q=D.f.h4.withConfig({displayName:"CancelEditHeader__Heading",componentId:"sc-1bkxsiw-2"})(["font-family:",";line-height:1.5;margin:0;padding:0;width:calc( 100% - "," );font-size:",";color:",";margin:0;padding:0;font-weight:normal;strong{color:",";font-weight:bold;}"],(e=>e.theme.fontFamilyHeading),(e=>Object(A.n)(.8*e.theme.controlHeightBase+4)),(e=>Object(A.n)(e.theme.fz.base)),(e=>e.theme.textColorSecondary),(e=>e.theme.headingColor));function U(e){const t=e.onUserCancelEdit,n=e.submissionWithFormData,i=Object(r._x)("Editing submission on %%FORM%%","wpeform-useredit-heading","wp-eform"),o=z()(i,/%%([^%%]+)%%/,((e,t)=>{var i,o;switch(e){case"TOKEN":return Object(C.jsx)("strong",{children:null===(i=n.submission)||void 0===i?void 0:i.token},t);case"FORM":return Object(C.jsx)("strong",{children:null===(o=n.submission)||void 0===o?void 0:o.form.name},t);default:return Object(C.jsxs)("span",{children:["%%",e,"%%"]},t)}}));return Object(C.jsxs)(V,{className:"wpeform-useredit-header",children:[Object(C.jsx)(q,{children:o}),Object(C.jsx)($,{type:"button",onClick:e=>{e.preventDefault(),t&&t()},title:Object(r.__)("Cancel edit","wp-eform"),children:Object(C.jsx)(H.b,{"aria-label":Object(r.__)("Cancel edit","wp-eform"),iconClass:"fas fa-times"})})]})}function W(e){var t,n,o,a,s,c;const l=e.mode,d=e.submissionWithFormData,m=e.onAfterEdit,b=e.onUserCancelEdit,p=Object(O.a)(M,{fetchPolicy:"no-cache"}),f=Object(j.a)(p,2),g=f[0],y=f[1],w=Object(i.useCallback)(((e,t,n)=>{var i,o,r,a;return g({variables:{data:{elements:e,formId:null!==(i=null==d||null===(o=d.submission)||void 0===o?void 0:o.form.id)&&void 0!==i?i:"0",time:"adminedit"===l?void 0:t},id:"adminedit"===l?null==d||null===(r=d.submission)||void 0===r?void 0:r.id:void 0,token:"adminedit"!==l?null==d||null===(a=d.submission)||void 0===a?void 0:a.token:void 0,remarks:"adminedit"===l?n:void 0}}).then((e=>("adminedit"===l&&Object(L.a)(),m&&m(),e)))}),[l,null==d||null===(t=d.submission)||void 0===t?void 0:t.form.id,null==d||null===(n=d.submission)||void 0===n?void 0:n.id,null==d||null===(o=d.submission)||void 0===o?void 0:o.token,g,m]),x=Object(i.useMemo)((()=>{var e;return null!=d&&null!==(e=d.submission)&&void 0!==e&&e.form?Object(v.b)({form:d.submission.form,formMeta:d.formMeta}):null}),[d]),_=Object(v.j)(w,x,!0),S=_.submitting,E=_.submitted,I=_.reset,T=_.submit,F=_.submittedState,P=k(d),N=Object(j.a)(P,1)[0],D=Object(i.useMemo)((()=>Object.keys(N).length&&null!=d&&d.submission?{structures:{},currentPage:null!=x&&x.structures&&x.structures.length?x.structures[0].id:"",startTime:Date.now(),formId:d.submission.form.id,elements:N,remarks:d.submission.adminRemarks}:v.c),[N,d,null==x?void 0:x.structures]),R=Object(h.c)(null==d||null===(a=d.submission)||void 0===a?void 0:a.form.styles);return null!=d&&d.submission&&d.formMeta?"useredit"!==l||d.submission.canUserEdit?Object(C.jsx)(B.a,{initialData:D,formData:x,formMeta:d.formMeta,mode:l,submitting:S,submitted:E,submittedState:F,onReset:I,onSubmit:T,submissionError:y&&y.error?y.error:void 0,mutationData:null!==(s=null===(c=y.data)||void 0===c?void 0:c.updateSubmission)&&void 0!==s?s:void 0,onErrorRetry:I,formHeader:"useredit"===l&&b?Object(C.jsx)(U,{submissionWithFormData:d,onUserCancelEdit:b}):null}):Object(C.jsx)(u.a,{title:Object(r.__)("You cannot edit the submission","wp-eform"),type:"403",retry:b,retryLabel:Object(r.__)("GO BACK TO PREVIEW","wp-eform"),hideReload:!0,themeStyle:R,children:Object(C.jsx)("p",{children:Object(r.__)("It is not possible to edit this submission. Only managers can make changes to the data. If you think this is a mistake, kindly contact the site administrator.","wp-eform")})}):Object(C.jsx)(u.a,{themeStyle:R,title:Object(r.__)("Could not get submission data","wp-eform"),children:Object(C.jsx)("p",{children:Object(r.__)("There was some problem retrieving submission. Please reload the page and try again.","wp-eform")})})}var K=n(1036),Y=(n(281),n(34));function G(e){const t=e.children,n=S(),o=I(),r=F(),a=Object(i.useMemo)((()=>({"::fName::":n.fName,"::lName::":n.lName,"::email::":n.email,"::phone::":n.phone})),[n]),s=Object(i.useCallback)((e=>{var t;return Object(Y.i)(e,r,o,a,null===(t=n.form.settings)||void 0===t?void 0:t.score,n.scoreData)}),[o,r,a,n]),c=Object(i.useMemo)((()=>{const e={};return e["%FORM_LINK%"]=window.location.href,n.submissionLink&&(e["%SUBMISSION_LINK%"]=n.submissionLink),e}),[n]);return Object(C.jsx)(Y.c,{mentions:s,children:Object(C.jsx)(Y.b,{dynamicAnchors:c,children:t})})}var Q=n(361);const J=D.f.header.withConfig({displayName:"PreviewHeader__Container",componentId:"sc-1tyk7ac-0"})(["color:",";padding:"," 0;border-bottom:2px solid ",";margin:0 0 "," 0;display:flex;align-items:center;flex-flow:row wrap;"],(e=>e.theme.textColorSecondary),(e=>Object(A.n)(e.theme.gutter/2)),(e=>e.theme.borderColorBase),(e=>Object(A.n)(e.theme.gutter))),X=D.f.h4.withConfig({displayName:"PreviewHeader__DateHeading",componentId:"sc-1tyk7ac-1"})(["font-size:",";color:",";margin:0;padding:0;font-weight:bold;span{color:",";font-weight:normal;}flex:0 0 auto;"],(e=>Object(A.n)(e.theme.fz.base)),(e=>e.theme.headingColor),(e=>e.theme.textColorSecondary)),Z=D.f.aside.withConfig({displayName:"PreviewHeader__Controls",componentId:"sc-1tyk7ac-2"})(["margin:0 0 0 auto;display:flex;align-items:center;justify-content:center;@media print{display:none;}button{margin:0 2px;border:0 none;cursor:pointer;background-color:",";height:",";width:",";padding:0;display:flex;align-items:center;justify-content:center;font-size:",";border-radius:",";color:",";outline:none;transition:",";&:hover,&:focus{color:",";background-color:",";}&:active{color:",";background-color:",";}}"],(e=>e.theme.appBackgroundColor),(e=>Object(A.n)(.8*e.theme.controlHeightBase)),(e=>Object(A.n)(.8*e.theme.controlHeightBase)),(e=>Object(A.n)(.35*e.theme.controlHeightBase)),(e=>Object(A.n)(e.theme.borderRadiusBase)),(e=>e.theme.textColorSecondary),(e=>Object(A.f)(["background-color","color"],e.theme.transitionControl)),(e=>e.theme.textColor),(e=>e.theme.backgroundHover),(e=>e.theme.textColor),(e=>e.theme.backgroundControl));function ee({mode:e,canUserEdit:t,onUserEdit:n,printLink:i,downloadLink:o}){const a=S(),s=Q.e.utc(a.created,Q.g).local();return Object(C.jsxs)(J,{children:[Object(C.jsxs)(X,{children:[s.format(Q.b)," ",Object(C.jsxs)("span",{children:[Object(r.__)("at","wp-eform")," ",s.format(Q.d)]})]}),Object(C.jsxs)(Z,{children:[i?Object(C.jsx)("button",{title:Object(r.__)("Print submission","wp-eform"),type:"button",onClick:e=>{e.preventDefault();const t=window.open(i,"popup","width=600px&height=600px");t&&t.addEventListener("load",(()=>{t.print()}),!1)},children:Object(C.jsx)(H.b,{iconClass:"fas fa-print","aria-label":Object(r.__)("Print Submission","wp-eform")})}):null,o?Object(C.jsx)("button",{title:Object(r.__)("Download submission as PDF","wp-eform"),onClick:e=>{e.preventDefault(),window.open(o,"_blank")},type:"button",children:Object(C.jsx)(H.b,{iconClass:"fas fa-file-download","aria-label":Object(r.__)("Download submission as PDF","wp-eform")})}):null,"user"===e&&t?Object(C.jsx)("button",{title:Object(r.__)("Edit Submission","wp-eform"),onClick:e=>{e.preventDefault(),n&&n()},type:"button",children:Object(C.jsx)(H.b,{iconClass:"fas fa-edit","aria-label":Object(r.__)("Edit Submission","wp-eform")})}):null]})]})}var te=n(36),ne=n(1041);const ie=D.f.div.withConfig({displayName:"Metadata__Container",componentId:"sc-n1sjbx-0"})(["margin:0 0 "," 0;background-color:",";padding:",";border-radius:",";table{border-collapse:collapse;border:0 none;margin:0;padding:0;vertical-align:top;tr,td,th{border:0 none;vertical-align:top;}td,th{padding:",";color:",";font-size:",";text-align:left;}th{font-weight:bold;min-width:120px;@media screen and (min-width:768px){min-width:170px;}}td{width:calc(100% - 120px);@media screen and (min-width:768px){width:calc(100% - 170px);}",";}code{font-family:",";background-color:transparent;padding:0;margin:0;}a{color:",";text-decoration:underline;",";&:hover{text-decoration:none;}}}"],(e=>Object(A.n)(e.theme.gutter)),(e=>e.theme.backgroundShade),(e=>Object(A.n)(.75*e.theme.gutter)),(e=>Object(A.n)(e.theme.borderRadiusBase)),(e=>Object(A.n)(e.theme.gutter/4)),(e=>e.theme.textColor),(e=>Object(A.n)(e.theme.fz.base)),A.m,(e=>e.theme.fontFamilyMono),(e=>e.theme.linkColor),A.m),oe=D.f.div.withConfig({displayName:"Metadata__UserInput",componentId:"sc-n1sjbx-1"})(["",";margin:0;padding:0;"],A.v);function re(){var e,t,n,i,o,a;const s=S(),c=Q.e.utc(s.created).local(),l=s.lastUpdated;return Object(C.jsx)(ie,{children:Object(C.jsx)("table",{children:Object(C.jsxs)("tbody",{children:[Object(C.jsxs)("tr",{children:[Object(C.jsx)("th",{children:Object(r.__)("Form","wp-eform")}),Object(C.jsx)("td",{children:s.form.name})]}),Object(C.jsxs)("tr",{children:[Object(C.jsx)("th",{children:Object(r.__)("Submission Id","wp-eform")}),Object(C.jsx)("td",{children:Object(C.jsx)("code",{children:s.token})})]}),Object(C.jsxs)("tr",{children:[Object(C.jsx)("th",{children:Object(r.__)("Created On","wp-eform")}),Object(C.jsx)("td",{children:c.format(Q.c)})]}),l&&l!==Q.f?Object(C.jsxs)("tr",{children:[Object(C.jsx)("th",{children:Object(r.__)("Updated On","wp-eform")}),Object(C.jsx)("td",{children:Q.e.utc(l).local().format(Q.c)})]}):null,(s.score||s.maxScore)&&null!==(e=s.form.settings)&&void 0!==e&&null!==(t=e.score)&&void 0!==t&&t.scoreLists.length?Object(C.jsxs)("tr",{children:[Object(C.jsx)("th",{children:Object(C.jsx)(Y.f,{nodes:Object(Y.g)(s.form.settings.score.scoreLists[0].outcomeName),mode:"singleline"})}),Object(C.jsx)("td",{children:Object(r.sprintf)(Object(r._x)("%s / %s","submission-summary-score","wp-eform"),Object(te.a)(null!==(n=s.score)&&void 0!==n?n:0,null!==(i=s.form.settings.score.precision)&&void 0!==i?i:2),Object(te.a)(null!==(o=s.maxScore)&&void 0!==o?o:0,null!==(a=s.form.settings.score.precision)&&void 0!==a?a:2))})]}):null,s.submissionLink?Object(C.jsxs)("tr",{children:[Object(C.jsx)("th",{children:Object(r.__)("Record","wp-eform")}),Object(C.jsx)("td",{children:Object(C.jsx)("a",{href:s.submissionLink,children:s.submissionLink})})]}):null,s.adminRemarks?Object(C.jsxs)("tr",{children:[Object(C.jsx)("th",{children:Object(r.__)("Remarks","wp-eform")}),Object(C.jsx)("td",{children:Object(C.jsx)(oe,{children:s.adminRemarks})})]}):null,s.time?Object(C.jsxs)("tr",{children:[Object(C.jsx)("th",{children:Object(r.__)("Duration","wp-eform")}),Object(C.jsx)("td",{children:Object(ne.a)(s.time)})]}):null]})})})}var ae=n(1107),se=n(86);const ce=Object(i.createContext)({scores:[],precision:2});function le(e){var t,n,o,r,a;const s=e.children,c=S(),l=null===(t=c.form.settings)||void 0===t||null===(n=t.score)||void 0===n?void 0:n.scoreLists,d=null!==(o=null===(r=c.form.settings)||void 0===r||null===(a=r.score)||void 0===a?void 0:a.precision)&&void 0!==o?o:2,u=Object(i.useMemo)((()=>{const e=l?l.map((e=>{const t=Object(Y.g)(e.outcomeDescription);return{scoreId:e.id,title:Object(C.jsx)(Y.f,{nodes:Object(Y.g)(e.outcomeName),mode:"singleline"}),description:Object(Y.k)(t)?void 0:Object(C.jsx)(Y.f,{nodes:t,mode:"multiline"})}})):[];return{precision:d,scores:e}}),[l,d]);return Object(C.jsx)(ce.Provider,{value:u,children:s})}function de(e){var t,n,o;const r=e.element,a=e.submission,s=Object(Y.l)(null===(t=r.appearance)||void 0===t?void 0:t.answerDescription),c=Object(i.useContext)(ce),l=[];c.scores.forEach((e=>{const t=a.scores.find((t=>t.scoreId===e.scoreId));t&&t.has&&l.push({scoreId:e.scoreId,obtained:t.obtained,outof:t.outof,title:e.title,description:e.description})}));const d=Object(ae.a)(r,a.value);if(!1===d)return null;const u=Object(Y.g)(null===(n=r.appearance)||void 0===n?void 0:n.subtitle);return Object(C.jsx)(se.a,{title:Object(C.jsx)(Y.f,{nodes:Object(Y.g)(null===(o=r.appearance)||void 0===o?void 0:o.title),mode:"singleline"}),subtitle:Object(Y.k)(u)?void 0:Object(C.jsx)(Y.f,{nodes:u,mode:"singleline"}),answerDescription:s?Object(C.jsx)(Y.f,{nodes:s,mode:"multiline"}):void 0,answer:d,scorePrecision:c.precision,scores:l})}const ue=D.f.h2.withConfig({displayName:"PagePreview__Heading",componentId:"sc-srmz56-0"})(["",";font-size:",";color:",";font-weight:bold;font-family:",";margin:0 0 "," 0;padding:0 0 "," 0;border-bottom:2px solid ",";text-transform:uppercase;@media print{break-after:avoid;}"],A.b,(e=>Object(A.n)(e.theme.fz.small1)),(e=>e.theme.textColorSecondary),(e=>e.theme.fontFamilyHeading),(e=>Object(A.n)(e.theme.gutter)),(e=>Object(A.n)(e.theme.gutter/3)),(e=>e.theme.borderColorSplit)),me=D.f.section.withConfig({displayName:"PagePreview__Container",componentId:"sc-srmz56-1"})(["",";margin:0 0 "," 0;"],A.b,(e=>Object(A.n)(e.theme.gutter)));function he(e){const t=e.currentPage,n=t.config.title,i=Object(Y.l)(n),o=I(),r=F(),a=Object(v.f)(t,o,r).filter((e=>{const t=o[e],n=w.wpEFormElementFrontCollection.hasItem(t.type)?w.wpEFormElementFrontCollection.getItem(t.type):null;return!!n&&!!n.getAnswerValue}));return a.length?Object(C.jsxs)(me,{children:[i?Object(C.jsx)(ue,{children:Object(C.jsx)(Y.f,{nodes:i,mode:"singleline"})}):null,a.map((e=>Object(C.jsx)(de,{element:o[e],submission:r[e]},e)))]}):null}var be=n(1078);n(1065),n(29),n(127),n(33),n(1091);D.f.h5.withConfig({displayName:"ScoreData__DesignationHeading",componentId:"sc-kuwa45-0"})(["color:",";font-size:",";font-weight:bold;margin:0 0 "," 0;"],(e=>e.theme.headingColor),(e=>Object(A.n)(e.theme.fz.base)),(e=>Object(A.n)(.5*e.theme.gutter))),D.f.div.withConfig({displayName:"ScoreData__DesignationDescription",componentId:"sc-kuwa45-1"})(["color:",";font-size:",";margin:0 0 "," 0;padding:0 0 "," 0;border-bottom:1px dashed ",";&:last-child{border-bottom:0 none;margin-bottom:0;padding-bottom:0;}"],(e=>e.theme.textColor),(e=>Object(A.n)(e.theme.fz.base)),(e=>Object(A.n)(e.theme.gutter)),(e=>Object(A.n)(e.theme.gutter)),(e=>e.theme.borderColorLight)),D.f.div.withConfig({displayName:"ScoreData__Container",componentId:"sc-kuwa45-2"})(["background-color:",";margin:0 0 "," 0;"],(e=>e.theme.appBackgroundColor),(e=>Object(A.n)(e.theme.gutter)));function pe(e){var t,n;const i=e.submissionWithFormData,o=e.mode,s=e.onUserEdit,c=Object(K.c)(null==i||null===(t=i.submission)||void 0===t?void 0:t.form.styles);if(null==i||!i.submission)return Object(C.jsx)(u.a,{title:Object(r.__)("Could not get submission data","wp-eform"),children:Object(C.jsx)("p",{children:Object(r.__)("There was some problem retrieving submission. Please reload the page and try again.","wp-eform")})});return Object(C.jsx)(P,{submissionWithFormData:i,children:Object(C.jsx)(G,{children:Object(C.jsx)(le,{children:Object(C.jsx)(K.a,{themeStyle:c,mode:"live",widthOverride:"768px",containerLayoutOverride:a.A.FLUID,children:Object(C.jsxs)(be.a,{children:[Object(C.jsx)(ee,{mode:o,canUserEdit:null!==(n=i.submission.canUserEdit)&&void 0!==n&&n,onUserEdit:s,downloadLink:i.submission.downloadLink,printLink:i.submission.printLink}),Object(C.jsx)(re,{}),null,i.submission.form.structures.map((e=>Object(C.jsx)(he,{currentPage:e},e.id)))]})})})})})}function fe(e){const t=e.data,n=e.mode,i=e.onUserEdit;return Object(C.jsx)(pe,{submissionWithFormData:t,mode:n,onUserEdit:i})}function ge(e){const t=e.mode,n=e.id,s=void 0===n?null:n,c=e.token,l=void 0===c?null:c,j=e.panels,O=e.controls,v=e.themeStyle,y=e.onUserEdit,w=e.onUserCancelEdit,x=e.onAfterEdit,_=e.inShadow,k=void 0!==_&&_,S=e.cssHandles,E=void 0===S?[]:S,I=e.onReEnterSubmissionId,T=Object(o.b)(d,{fetchPolicy:"cache-first",variables:{id:s,token:l}}),F=T.data,P=T.loading,N=T.error,M=T.refetch,L=Object(i.useCallback)((()=>{M({id:s,token:l}),x&&x()}),[s,l,M,x]),B="userpreview"===t||"adminpreview"===t,D=Object(C.jsx)(g.a,{inShadow:k,cssHandles:E,children:Object(C.jsx)(h.a,{themeStyle:v,mode:"live",widthOverride:B?"768px":void 0,containerLayoutOverride:B?a.A.FLUID:void 0,children:"adminpreview"===t||"adminedit"===t?Object(C.jsx)(f.a,{}):B?Object(C.jsx)(p.a,{panels:j,controls:O}):Object(C.jsx)(b.a,{panels:j,controls:O,hasEditHeader:"useredit"===t})})});return N?Object(C.jsx)(g.a,{inShadow:k,cssHandles:E,children:Object(C.jsx)(u.a,{themeStyle:v,retry:null!=I?I:L,error:N,title:Object(r.__)("The submission could not be found","wp-eform"),widthOverride:"768px",retryLabel:I?Object(r.__)("RE ENTER SUBMISSION ID","wp-eform"):Object(r.__)("RETRY WITHOUT RELOAD","wp-eform"),children:Object(C.jsx)("p",{children:Object(r.__)("There was an error trying to fetch submission data from the server. Try refreshing the page to see if that resolves it.","wp-eform")})})}):P&&!F?D:Object(C.jsx)(g.a,{inShadow:k,cssHandles:E,children:Object(C.jsx)(m.a,{themeStyle:v,children:B?Object(C.jsx)(fe,{data:F,mode:"userpreview"===t?"user":"admin",onUserEdit:y}):Object(C.jsx)(W,{submissionWithFormData:F,mode:"adminedit"===t?"adminedit":"useredit",onAfterEdit:L,onUserCancelEdit:w})})})}},1122:function(e,t,n){"use strict";var i=n(4),o=n(5),r=n(6),a=n(10),s=n.n(a),c=n(629),l=n.n(c),d=n(60),u=n(0),m=n(146),h=n(54),b=n(104),p=function(e,t){var n={};for(var i in e)Object.prototype.hasOwnProperty.call(e,i)&&t.indexOf(i)<0&&(n[i]=e[i]);if(null!=e&&"function"==typeof Object.getOwnPropertySymbols){var o=0;for(i=Object.getOwnPropertySymbols(e);o<i.length;o++)t.indexOf(i[o])<0&&Object.prototype.propertyIsEnumerable.call(e,i[o])&&(n[i[o]]=e[i[o]])}return n},f=(Object(b.a)("small","default","large"),null);var g=function(e){var t=e.spinPrefixCls,n=e.spinning,a=void 0===n||n,c=e.delay,b=e.className,g=e.size,j=void 0===g?"default":g,O=e.tip,v=e.wrapperClassName,y=e.style,w=e.children,x=p(e,["spinPrefixCls","spinning","delay","className","size","tip","wrapperClassName","style","children"]),C=u.useState((function(){return a&&!function(e,t){return!!e&&!!t&&!isNaN(Number(t))}(a,c)})),_=Object(r.a)(C,2),k=_[0],S=_[1];u.useEffect((function(){var e=l()((function(){S(a)}),c);return e(),function(){var t;null===(t=null==e?void 0:e.cancel)||void 0===t||t.call(e)}}),[c,a]);var E=function(n){var r,a=n.direction,c=s()(t,(r={},Object(o.a)(r,"".concat(t,"-sm"),"small"===j),Object(o.a)(r,"".concat(t,"-lg"),"large"===j),Object(o.a)(r,"".concat(t,"-spinning"),k),Object(o.a)(r,"".concat(t,"-show-text"),!!O),Object(o.a)(r,"".concat(t,"-rtl"),"rtl"===a),r),b),l=Object(d.a)(x,["indicator","prefixCls"]),m=u.createElement("div",Object(i.a)({},l,{style:y,className:c,"aria-live":"polite","aria-busy":k}),function(e,t){var n=t.indicator,i="".concat(e,"-dot");return null===n?null:Object(h.c)(n)?Object(h.a)(n,{className:s()(n.props.className,i)}):Object(h.c)(f)?Object(h.a)(f,{className:s()(f.props.className,i)}):u.createElement("span",{className:s()(i,"".concat(e,"-dot-spin"))},u.createElement("i",{className:"".concat(e,"-dot-item")}),u.createElement("i",{className:"".concat(e,"-dot-item")}),u.createElement("i",{className:"".concat(e,"-dot-item")}),u.createElement("i",{className:"".concat(e,"-dot-item")}))}(t,e),O?u.createElement("div",{className:"".concat(t,"-text")},O):null);if(void 0!==w){var p=s()("".concat(t,"-container"),Object(o.a)({},"".concat(t,"-blur"),k));return u.createElement("div",Object(i.a)({},l,{className:s()("".concat(t,"-nested-loading"),v)}),k&&u.createElement("div",{key:"loading"},m),u.createElement("div",{className:p,key:"container"},w))}return m};return u.createElement(m.a,null,E)},j=function(e){var t=e.prefixCls,n=(0,u.useContext(m.b).getPrefixCls)("spin",t),o=Object(i.a)(Object(i.a)({},e),{spinPrefixCls:n});return u.createElement(g,Object(i.a)({},o))};j.setDefaultIndicator=function(e){f=e},t.a=j},1123:function(e,t,n){"use strict";n.d(t,"b",(function(){return o})),n.d(t,"a",(function(){return r}));var i=n(8);function o(e,t){return"owned"===e?i.w.OWNED:"shared"===e?i.w.SHARED:"trashed"===e?i.w.TRASHED:t?i.w.ALL:i.w.OWNED}function r(e,t){return t&&["all","trashed"].includes(e)||"shared"===e}},1128:function(e,t,n){"use strict";var i=n(9),o=n(0),r={icon:{tag:"svg",attrs:{viewBox:"64 64 896 896",focusable:"false"},children:[{tag:"path",attrs:{d:"M955.7 856l-416-720c-6.2-10.7-16.9-16-27.7-16s-21.6 5.3-27.7 16l-416 720C56 877.4 71.4 904 96 904h832c24.6 0 40-26.6 27.7-48zM480 416c0-4.4 3.6-8 8-8h48c4.4 0 8 3.6 8 8v184c0 4.4-3.6 8-8 8h-48c-4.4 0-8-3.6-8-8V416zm32 352a48.01 48.01 0 010-96 48.01 48.01 0 010 96z"}}]},name:"warning",theme:"filled"},a=n(41),s=function(e,t){return o.createElement(a.a,Object(i.a)(Object(i.a)({},e),{},{ref:t,icon:r}))};s.displayName="WarningFilled";t.a=o.forwardRef(s)},1135:function(e,t,n){"use strict";n.d(t,"a",(function(){return o}));var i=n(0);function o(e){return i.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),i.createElement("path",{d:"M156.84 263.348c-9.621-9.641-12.461-23.993-7.246-36.57 5.21-12.56 17.36-20.676 30.953-20.676h54.512L235 76.098c-.004-11.043 8.945-20.004 19.992-20.008H255c11.043 0 19.996 8.95 20 19.992l.059 130.016c-.008 22.437-17.196 40.004-39.13 40.004h-39.784l52.964 53.035c2.489 2.492 5.395 2.863 6.907 2.863 1.511 0 4.418-.371 6.906-2.863l56.215-56.282c-5.465-3.57-9.075-9.742-9.075-16.753 0-11.047 8.954-20 20-20h1.438c13.59 0 25.738 8.117 30.95 20.68a33.46 33.46 0 01-7.24 36.562l-63.987 64.062c-9.399 9.41-21.907 14.594-35.207 14.594-13.305 0-25.805-5.184-35.207-14.598l-63.97-64.054zM432 0h-39c-11.047 0-20 8.953-20 20s8.953 20 20 20h39c22.055 0 40 17.945 40 40v172c0 11.047 8.953 20 20 20s20-8.953 20-20V80c0-44.113-35.887-80-80-80zm80 352v80c0 44.113-35.887 80-80 80H80c-44.113 0-80-35.887-80-80V80C0 35.887 35.887 0 80 0h42c11.047 0 20 8.953 20 20s-8.953 20-20 20H80c-22.055 0-40 17.945-40 40v252h54.945c29.278 0 56.453 14.543 72.696 38.906A47.276 47.276 0 00207.055 392h96.89a47.276 47.276 0 0039.414-21.094C359.602 346.543 386.777 332 416.055 332H492c11.047 0 20 8.953 20 20zm-40 80v-60h-55.945a47.276 47.276 0 00-39.414 21.094C360.398 417.457 333.223 432 303.945 432h-96.89c-29.278 0-56.453-14.543-72.696-38.906A47.276 47.276 0 0094.945 372H40v60c0 22.055 17.945 40 40 40h352c22.055 0 40-17.945 40-40z"}))}n.p},1154:function(e,t,n){"use strict";n.d(t,"a",(function(){return l}));var i=n(13),o=n(0),r=n(1029),a=n(1129),s=n(1104),c=["refetch","reobserve","fetchMore","updateQuery","startPolling","subscribeToMore"];function l(e,t){var n=Object(a.a)(Object(s.a)(t&&t.client),e),l=Object(o.useRef)(),d=l.current?Object(r.a)(t,l.current):t,u=n.useQuery(Object(i.a)(Object(i.a)({},d),{skip:!l.current})),m=u.observable.options.initialFetchPolicy||n.getDefaultFetchPolicy(),h=Object.assign(u,{called:!!l.current}),b=Object(o.useMemo)((function(){for(var e={},t=function(t){var i=h[t];e[t]=function(){return l.current||(l.current=Object.create(null),n.forceUpdate()),i.apply(this,arguments)}},i=0,o=c;i<o.length;i++){t(o[i])}return e}),[]);return Object.assign(h,b),[Object(o.useCallback)((function(e){l.current=e?Object(i.a)(Object(i.a)({},e),{fetchPolicy:e.fetchPolicy||m}):{fetchPolicy:m};var t=n.asyncUpdate().then((function(e){return Object.assign(e,b)}));return t.catch((function(){})),t}),[]),h]}},1164:function(e,t,n){"use strict";n.r(t),n.d(t,"default",(function(){return Ce}));var i=n(161),o=n(15),r=n(0),a=n(18),s=n(3),c=n(1189),l=n(1129),d=n(1044),u=n(440),m=n(282),h=n(1064),b=n(8),p=n(245),f=n(446),g=n(1123),j=n(1063),O=n(176),v=n(83),y=n(1090),w=n.n(y),x=n(361),C=n(1041),_=n(36),k=n(1098),S=n(1099),E=n(1118),I=n(1135),T=n(1);const F=c.a`
	mutation UntrashSubmission($id: ID!) {
		untrashSubmission(id: $id)
	}
`,P=c.a`
	mutation DeleteSubmission($id: ID!) {
		deleteSubmission(id: $id)
	}
`,N=c.a`
	mutation TrashSubmission($id: ID!) {
		trashSubmission(id: $id)
	}
`;function M(e){const t=e.id;return Object(T.jsxs)(h.a.MutationButton,{mutation:F,variables:{id:t},children:[Object(T.jsx)(a.b,{component:E.a}),Object(T.jsx)("span",{children:Object(s.__)("UNTRASH","wp-eform")})]})}function L(e){const t=e.id;return Object(T.jsxs)(h.a.MutationButton,{mutation:P,variables:{id:t},danger:!0,popconfirm:Object(s.__)("The submission once deleted cannot be restored. Are you sure?","wp-eform"),children:[Object(T.jsx)(a.b,{component:f.a}),Object(T.jsx)("span",{children:Object(s.__)("DELETE","wp-eform")})]})}function B(e){const t=e.id;return Object(T.jsxs)(h.a.MutationButton,{danger:!0,mutation:N,variables:{id:t},children:[Object(T.jsx)(a.b,{component:f.a}),Object(T.jsx)("span",{children:Object(s.__)("TRASH","wp-eform")})]})}function D(e){var t;const n=e.currentView,i=e.path,o=e.node;return Object(T.jsx)(T.Fragment,{children:"trashed"===n?Object(T.jsxs)(T.Fragment,{children:[Object(T.jsx)(M,{id:o.id}),Object(T.jsx)(L,{id:o.id})]}):Object(T.jsxs)(T.Fragment,{children:[Object(T.jsxs)(h.a.RouterLinkButton,{to:`${i}/view/${o.id}`,children:[Object(T.jsx)(a.b,{component:k.a}),Object(T.jsx)("span",{children:Object(s.__)("PREVIEW","wp-eform")})]}),Object(T.jsxs)(h.a.AnchorButton,{href:null!==(t=o.downloadLink)&&void 0!==t?t:"#",target:"_blank",children:[Object(T.jsx)(a.b,{component:I.a}),Object(T.jsx)("span",{children:Object(s.__)("DOWNLOAD","wp-eform")})]}),Object(T.jsxs)(h.a.RouterLinkButton,{to:`${i}/edit/${o.id}`,children:[Object(T.jsx)(a.b,{component:S.a}),Object(T.jsx)("span",{children:Object(s.__)("EDIT","wp-eform")})]}),"shared"!==n?Object(T.jsx)(B,{id:o.id}):null]})})}function R(e){const t=e.item.node,n=e.state,i=e.dispatch,o=Object(v.n)().path,r=x.e.utc(t.created,x.g).local(),a=[Object(s._x)("Created on form %%FORM%%","submissions-list-meta","wp-eform")];t.ip&&a.push(Object(s._x)(" from %%IPADDR%%","submissions-list-meta","wp-eform")),t.email&&a.push(Object(s._x)(" by %%EMAIL%%","submissions-list-meta","wp-eform")),null!==t.score?a.push(Object(s._x)(" and obtained %%SCORE%%.","submissions-list-meta","wp-eform")):a.push(Object(s._x)(".","submissions-list-meta","wp-eform")),t.lastUpdated&&a.push(Object(s._x)(" Last updated %%LASTUPDATE%%.","submissions-list-meta","wp-eform"));const c=w()(a.join(""),/%%([^%%]+)%%/,((e,o)=>{var r,a,c;switch(e.toUpperCase()){case"IPADDR":return Object(T.jsx)("code",{className:"user-input",children:t.ip},o);case"FORM":return Object(T.jsx)("button",{className:"user-input",title:Object(s.__)("Show submissions from this form only.","wp-eform"),type:"button",onClick:e=>{e.preventDefault(),i({type:"SET_FILTERS",payload:{filters:{...n.filters,formId:t.formId}}})},children:t.formName},o);case"EMAIL":return Object(T.jsx)("a",{href:`mailto:${t.email}`,target:"_blank",rel:"nofollow noreferrer noopener",className:"user-input",children:t.email},o);case"SCORE":return Object(T.jsx)("strong",{children:Object(s.sprintf)(Object(s._x)("%1$f out of %2$f (%3$f%%)","submissions-list-meta","wp-eform"),Object(_.a)(null!==(r=t.score)&&void 0!==r?r:0,2),Object(_.a)(null!==(a=t.maxScore)&&void 0!==a?a:0,2),Object(_.a)(null!==(c=t.percentageScore)&&void 0!==c?c:0,2))},o);case"LASTUPDATE":if(t.lastUpdated){const e=x.e.utc(t.lastUpdated,x.g).local();return Object(T.jsx)(O.a,{title:e.format("LLL"),children:e.fromNow()},o)}}return Object(T.jsxs)("span",{children:["%%",e,"%%"]},o)}));return Object(T.jsxs)(h.a.Preview,{children:[Object(T.jsxs)(h.a.PreviewHeader,{children:[Object(T.jsx)(h.a.PreviewTitle,{children:Object(T.jsx)("label",{htmlFor:t.id.toString(),children:Object(C.b)(t.fName,t.lName)})}),Object(T.jsx)(h.a.PreviewMeta,{children:Object(T.jsx)(O.a,{title:r.format("LLL"),children:Object(T.jsx)("span",{children:r.fromNow()})})})]}),Object(T.jsx)(h.a.PreviewData,{children:Object(T.jsx)("p",{children:c})}),Object(T.jsx)(h.a.PreviewActions,{children:Object(T.jsx)(D,{node:t,path:o,currentView:n.currentView})})]})}var z=n(1128),A=n(130),H=n(284),V=n(1173);const $=c.a`
	mutation DeleteSubmissions($ids: [ID!]!) {
		deleteSubmissions(ids: $ids)
	}
`,q=c.a`
	mutation TrashSubmissions($ids: [ID!]!) {
		trashSubmissions(ids: $ids)
	}
`,U=c.a`
	mutation UnTrashSubmissions($ids: [ID!]!) {
		untrashSubmissions(ids: $ids)
	}
`;var W=n(57);function K(e){return r.createElement("svg",Object.assign({xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 512 512"},e),r.createElement("path",{d:"M330.031 325.512c7.77-7.828 7.723-20.469-.101-28.239-7.828-7.77-20.47-7.722-28.239.106l-119.8 120.695-87.703-87.969 172.187-172.777 101.348 101.348c7.797 7.797 20.437 7.797 28.234 0l.852-.852 92.539-91.043.117-.113c25.422-25.422 24.293-51.125 18.87-68.207-5.452-17.184-17.534-34.492-39.167-56.125-21.637-21.637-38.945-33.715-56.125-39.168-17.086-5.422-42.79-6.555-68.234 18.89L51.219 316.653a19.925 19.925 0 00-5.094 8.739L1.23 486.68a19.965 19.965 0 005.157 19.507 19.963 19.963 0 0019.535 5.051l159.824-45.398a19.87 19.87 0 0010.512-5.555L330.03 325.512zm70.93-284.285c13.953 4.43 29.492 18.87 39.969 29.343 10.476 10.477 24.914 26.016 29.343 39.973 2.356 7.418 2.895 15.926-8.996 27.836l-26.164 25.742-87.898-87.898 25.86-25.95c11.933-11.941 20.456-11.402 27.886-9.046zm-81.938 63.277l87.622 87.625-24.7 24.3-87.379-87.382 24.457-24.543zm-231.52 347.73L59.97 424.566l15.715-56.457 67.972 68.176-56.152 15.95zm424.032 38.91c0 11.028-8.937 19.965-19.965 19.965H248.977c-11.028 0-19.97-8.937-19.97-19.964 0-11.028 8.942-19.97 19.97-19.97H491.57c11.024 0 19.965 8.942 19.965 19.97z"}))}n.p;var Y=n(1106),G=n(1119),Q=n(437),J=n(114);function X(e){const t=e.submissionId,n=e.token,i=Object(r.useState)("preview"),c=Object(o.a)(i,2),l=c[0],d=c[1],u=Object(Q.d)(t),m=Object(J.d)("desktopHd");return Object(T.jsxs)(T.Fragment,{children:[Object(T.jsxs)(h.a.PreviewToolbar,{children:[Object(T.jsxs)("div",{className:"to-left",children:[Object(T.jsxs)("h4",{className:"heading",children:[Object(s.__)("Id","wp-eform")," ",Object(T.jsx)("code",{children:t})]}),n&&m?Object(T.jsxs)("h4",{className:"heading",children:[Object(s.__)("Token","wp-eform")," ",Object(T.jsx)("code",{children:n})]}):null]}),Object(T.jsx)("div",{className:"to-right",children:Object(T.jsxs)(W.b,{value:l,onChange:d,children:[Object(T.jsxs)(W.b.Button,{size:"small",value:"preview",children:[Object(T.jsx)(a.b,{component:Y.a})," ",Object(s.__)("PREVIEW","wp-eform")]}),Object(T.jsxs)(W.b.Button,{size:"small",value:"edit",children:[Object(T.jsx)(a.b,{component:K})," ",Object(s.__)("EDIT","wp-eform")]})]})})]}),Object(T.jsx)(h.a.PreviewContent,{hasToolbar:!0,ref:u,children:Object(T.jsx)(G.a,{id:t,mode:"preview"===l?"adminpreview":"adminedit"})})]})}var Z=n(1154),ee=n(1079),te=n(1072),ne=n(1073),ie=n(1074),oe=n(1075),re=n(1076),ae=n(216),se=n(33),ce=n(1107),le=(n(108),n(88));const de=Object(T.jsx)(h.a.MutedText,{children:Object(s.__)("N/A","wp-eform")}),ue=c.a`
	query FormForTableView($id: ID!) {
		form(id: $id) {
			id
			structures {
				id
				children
				config {
					title
				}
			}
			elements {
				appearance {
					title
				}
				children
				id
				type
				config {
					...FAllElementConfig
				}
			}
		}
	}
	${ee.a}
	${te.a}
	${ne.a}
	${ie.a}
	${oe.a}
	${re.a}
`;function me(e,t){const n=Object(v.n)().path,i=e.filters.formId,a=Object(Z.a)(ue,{fetchPolicy:"cache-and-network"}),c=Object(o.a)(a,2),l=c[0],d=c[1],u=d.data,m=d.error;Object(r.useEffect)((()=>{null!==i&&l({variables:{id:i}})}),[i,l]),Object(r.useEffect)((()=>{m&&H.b.error(`${Object(s.__)("An error has occured while trying to fetch the form. ","wp-eform")+m.message} ${m.graphQLErrors.join(", ")}`)}),[m]);const b=Object(r.useMemo)((()=>u?Object(ae.b)(u):null),[u]);return[Object(r.useMemo)((()=>{let t=[{value:"name",label:Object(s.__)("Name","wp-eform"),width:200},{value:"formName",label:Object(s.__)("Form","wp-eform"),width:250},{value:"created",label:Object(s.__)("Created","wp-eform"),width:200},{value:"email",label:Object(s.__)("Email","wp-eform"),width:200},{value:"phone",label:Object(s.__)("Phone","wp-eform"),width:150},{value:"score",label:Object(s.__)("Score","wp-eform"),width:150,type:"number"},{value:"maxScore",label:Object(s.__)("Out Of","wp-eform"),width:150,type:"number"},{value:"percentageScore",label:Object(s.__)("%-age","wp-eform"),width:150,type:"number"},{value:"ip",label:Object(s.__)("IP Addr","wp-eform"),width:150},{value:"time",label:Object(s.__)("Time","wp-eform"),width:150,type:"number"},{value:"updated",label:Object(s.__)("Updated","wp-eform"),width:200},{value:"adminRemarks",label:Object(s.__)("Admin Remarks","wp-eform"),width:200},{value:"referer",label:Object(s.__)("Referer","wp-eform"),width:350},{value:"actions",label:Object(s.__)("Actions","wp-eform"),width:400,type:"actionButtons"}];if(["score","maxScore","percentageScore"].includes(e.orderBy)){const e=t.splice(5,3);t.splice(2,0,...e)}else if("time"===e.orderBy){const e=t.splice(9,1);t.splice(2,0,...e)}if(b&&i){const e=[],n=[];b.structures.forEach((e=>{n.push(...Object(ae.i)(e.id,b))})),n.forEach((t=>{const n=b.elements[t];if(n){const r=!!le.wpEFormElementFrontCollection.hasItem(n.type)&&le.wpEFormElementFrontCollection.getItem(n.type);if(r&&r.hasSubmission&&r.getDisplayValue){var i,o;const r=Object(se.d)(null!==(i=null===(o=n.appearance)||void 0===o?void 0:o.title)&&void 0!==i?i:Object(s.__)("Unknown element","wp-eform"));e.push({value:t,label:Object(C.e)(r,150),title:r,type:"element",width:230})}}})),t=t.filter((e=>!["formName","email","phone"].includes(e.value))),t.splice(1,0,...e)}return t}),[e.orderBy,b,i]),Object(r.useCallback)((({node:i},o,r)=>{switch(o.value){case"name":return Object(T.jsx)("label",{htmlFor:i.id,children:Object(C.b)(i.fName,i.lName)});case"formName":return Object(T.jsx)("button",{type:"button",title:Object(s.__)("Show submissions from this form only.","wp-eform"),onClick:n=>{n.preventDefault(),t({type:"SET_FILTERS",payload:{filters:{...e.filters,formId:i.formId}}})},children:i.formName});case"created":return Object(T.jsx)("span",{children:x.e.utc(i.created).local().format(x.c)});case"updated":return i.lastUpdated?Object(T.jsx)("span",{children:x.e.utc(i.lastUpdated).local().format(x.c)}):de;case"adminRemarks":return i.adminRemarks?Object(T.jsx)(h.a.UserInput,{children:i.adminRemarks}):de;case"email":return i.email?Object(T.jsx)("a",{href:`mailto:${i.email}`,children:i.email}):de;case"phone":return i.phone?Object(T.jsx)("a",{href:`tel:${i.phone}`,children:i.phone}):de;case"score":return null!==i.score?Object(T.jsx)("span",{children:Object(_.a)(i.score,2)}):de;case"maxScore":return null!==i.maxScore?Object(T.jsx)("span",{children:Object(_.a)(i.maxScore,2)}):de;case"percentageScore":return null!==i.percentageScore?Object(T.jsx)("span",{children:Object(s.sprintf)(Object(s._x)("%1$s%%","percentage-score","wp-eform"),Object(_.a)(i.percentageScore,2))}):de;case"ip":return null!==i.ip?Object(T.jsx)("span",{children:i.ip}):de;case"actions":return Object(T.jsx)(D,{node:i,path:n,currentView:r});case"time":return i.time?Object(T.jsx)("span",{children:Object(C.a)(i.time)}):de;case"referer":return i.referer?Object(T.jsx)("a",{href:i.referer,target:"_blank",rel:"nofollow noopener noreferrer",title:i.referer,children:Object(C.e)(i.referer,80)}):de;default:return function(e,t,n){if(!n)return Object(T.jsx)("span",{children:Object(s.__)("Unknown","wp-eform")});const i=e.elements.find((e=>e.id===t.value));if(!i)return Object(T.jsx)("span",{});if(!n.elements[i.id])return Object(T.jsx)("span",{children:Object(s.__)("Unknown element","wp-eform")});if(i.conditionallyHidden)return Object(T.jsx)(h.a.MutedText,{title:Object(s.__)("This element is conditionally hidden in the submission.","wp-eform"),children:Object(s.__)("hidden","wp-eform")});const o=Object(ce.b)(n.elements[i.id],i.value);return!1===o?Object(s.__)("Unknown answer","wp-eform"):o}(i,o,b)}}),[n,e.filters,t,b])]}const he=Object(p.d)(),be=Object(p.g)();function pe(e){var t,n,o,r,a,c,l,d,u,m;const b=e.state,p=e.dispatch,f=e.filterData;return Object(T.jsxs)(T.Fragment,{children:[Object(T.jsx)(h.a.FilterMenuItem,{children:Object(T.jsx)(i.a,{size:"small",value:null!==(t=b.filters.category)&&void 0!==t?t:void 0,style:{width:"100%"},loading:!f,showSearch:!0,allowClear:!0,onClear:()=>{p({type:"SET_FILTERS",payload:{filters:{...b.filters,category:null}}})},placeholder:Object(s.__)("Category","wp-eform"),onSelect:e=>{p({type:"SET_FILTERS",payload:{filters:{...b.filters,category:e}}})},filterOption:(e,t)=>{var n,i;if(!t)return!1;const o=t.props.value,r=(null==f?void 0:f.submissionMeta)&&(null==f||null===(n=f.submissionMeta)||void 0===n||null===(i=n.categories)||void 0===i?void 0:i.find((e=>e.id===o)));return!!(r&&r.title&&r.title.toLowerCase().includes(e.toLowerCase()))},children:null==f||null===(n=f.submissionMeta)||void 0===n||null===(o=n.categories)||void 0===o?void 0:o.map((e=>Object(T.jsxs)(i.a.Option,{value:e.id,children:[Object(T.jsx)(h.a.Badge,{children:e.total}),e.title||Object(s.__)("Deleted","wp-eform")]},e.id)))})}),Object(T.jsx)(h.a.FilterMenuItem,{children:Object(T.jsx)(i.a,{size:"small",value:null!==(r=b.filters.submissionOwner)&&void 0!==r?r:void 0,style:{width:"100%"},loading:!f,showSearch:!0,allowClear:!0,onClear:()=>{p({type:"SET_FILTERS",payload:{filters:{...b.filters,submissionOwner:null}}})},placeholder:Object(s.__)("Submission Owner","wp-eform"),onSelect:e=>{p({type:"SET_FILTERS",payload:{filters:{...b.filters,submissionOwner:e}}})},filterOption:(e,t)=>{var n,i;if(!t)return!1;const o=t.props.value,r=(null==f?void 0:f.submissionMeta)&&(null==f||null===(n=f.submissionMeta)||void 0===n||null===(i=n.owners)||void 0===i?void 0:i.find((e=>e.id===o)));return!!(r&&r.username&&r.username.toLowerCase().includes(e.toLowerCase()))},children:null==f||null===(a=f.submissionMeta)||void 0===a||null===(c=a.owners)||void 0===c?void 0:c.map((e=>Object(T.jsxs)(i.a.Option,{value:e.id,children:[Object(T.jsx)(h.a.Badge,{children:e.total}),e.username,e.id===be?Object(T.jsx)("i",{children:Object(s.__)(" (you)","wp-eform")}):null]},e.id)))})}),(he&&["all","trashed"].includes(b.currentView)||"shared"===b.currentView)&&null!=f&&null!==(l=f.submissionMeta)&&void 0!==l&&l.formOwners?Object(T.jsx)(h.a.FilterMenuItem,{children:Object(T.jsx)(i.a,{size:"small",value:null!==(d=b.filters.formOwner)&&void 0!==d?d:void 0,style:{width:"100%"},allowClear:!0,onClear:()=>{p({type:"SET_FILTERS",payload:{filters:{...b.filters,formOwner:null}}})},showSearch:!0,placeholder:Object(s.__)("Form owner","wp-eform"),onSelect:e=>{p({type:"SET_FILTERS",payload:{filters:{...b.filters,formOwner:e}}})},filterOption:(e,t)=>{var n,i,o;if(!t)return!1;const r=t.props.value,a=(null==f?void 0:f.submissionMeta)&&(null==f||null===(n=f.submissionMeta)||void 0===n?void 0:n.formOwners)&&(null==f||null===(i=f.submissionMeta)||void 0===i||null===(o=i.formOwners)||void 0===o?void 0:o.find((e=>e.id===r)));return!!(a&&a.username&&a.username.toLowerCase().includes(e.toLowerCase()))},children:null==f||null===(u=f.submissionMeta)||void 0===u||null===(m=u.formOwners)||void 0===m?void 0:m.map((e=>Object(T.jsxs)(i.a.Option,{value:e.id,children:[Object(T.jsx)(h.a.Badge,{children:e.total}),e.username||Object(s.__)("Ghost","wp-eform"),e.id===be?Object(T.jsx)("i",{children:Object(s.__)(" (you)","wp-eform")}):null]},e.id)))})}):null]})}const fe=Object(p.g)(),ge=Object(p.d)(),je=c.a`
	query SubmissionsListQuery(
		$pagination: PaginationInput
		$filter: SubmissionFilterInput
	) {
		submissions(filter: $filter, pagination: $pagination) {
			totalCount
			edges {
				node {
					id
					adminRemarks
					created
					email
					fName
					lName
					formId
					formName
					lastUpdated
					submissionLink
					score
					maxScore
					percentageScore
					phone
					ip
					token
					time
					referer
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
					downloadLink
				}
			}
		}
	}
	${j.a}
`,Oe=[{id:"owned",title:Object(s.__)("OWNED","wp-eform"),ddLabel:Object(s.__)("OWNED","wp-eform"),help:Object(s.__)("Submissions from forms owned and managed by you.","wp-eform")},{id:"shared",title:Object(s.__)("SHARED","wp-eform"),ddLabel:Object(s.__)("SHARED","wp-eform"),help:Object(s.__)("Submissions from forms owned by others but shared with you.","wp-eform")}];ge&&Oe.push({id:"all",title:Object(s.__)("ALL","wp-eform"),ddLabel:Object(s.__)("ALL","wp-eform"),help:Object(s.__)("All submissions from all forms, you can access this because you are an administrator.","wp-eform")}),Oe.push({id:"trashed",title:Object(T.jsx)(a.b,{component:f.a}),ddLabel:Object(s.__)("TRASHED","wp-eform"),danger:!0,help:Object(s.__)("Trashed submissions.","wp-eform")});const ve=[{id:"id",sorter:!0,title:Object(s.__)("Submission Id","wp-eform")},{id:"formId",sorter:!0,title:Object(s.__)("Form Id","wp-eform")},{id:"fName",sorter:!0,title:Object(s.__)("First Name","wp-eform")},{id:"lName",sorter:!0,title:Object(s.__)("Last Name","wp-eform")},{id:"email",sorter:!0,title:Object(s.__)("Email","wp-eform")},{id:"phone",sorter:!0,title:Object(s.__)("Phone","wp-eform")},{id:"score",sorter:!0,title:Object(s.__)("Score","wp-eform")},{id:"maxScore",sorter:!0,title:Object(s.__)("Out of","wp-eform")},{id:"percentageScore",sorter:!0,title:Object(s.__)("% Score","wp-eform")},{id:"created",sorter:!0,title:Object(s.__)("Created","wp-eform")},{id:"lastUpdated",sorter:!0,title:Object(s.__)("Updated","wp-eform")},{id:"paid",sorter:!0,title:Object(s.__)("Paid","wp-eform")},{id:"time",sorter:!0,title:Object(s.__)("Time","wp-eform")}],ye={category:null,formOwner:null,submissionOwner:null,formId:null};function we(e){var t,n;const i=e.state,r=e.dispatch,a=e.filterData,c=e.onMutation,d=i.filters.formId,p=Object(l.b)(je,{fetchPolicy:"cache-and-network",variables:{pagination:{with:b.t.OFFSET,page:i.currentPage,orderby:i.orderBy,["ascend"===i.orderDir?"last":"first"]:i.itemsPerPage},filter:{asAdmin:!0,category:i.filters.category,submissionOwner:i.filters.submissionOwner,formId:d,formOwner:"owned"===i.currentView||"shared"===i.currentView?fe:i.filters.formOwner,search:i.search,resourceView:Object(g.b)(i.currentView,ge)}}}),f=p.data,j=p.loading,O=p.error,v=me(i,r),y=Object(o.a)(v,2),w=y[0],x=y[1],C=function(e){const t=e.selectedRows,n=Object(V.a)($,{variables:{ids:t}}),i=Object(o.a)(n,2),r=i[0],a=i[1].loading,c=Object(V.a)(q,{variables:{ids:t}}),l=Object(o.a)(c,2),d=l[0],u=l[1].loading,m=Object(V.a)(U,{variables:{ids:t}}),h=Object(o.a)(m,2),b=h[0],p=h[1].loading,f=a||u||p,g=[];return"trashed"===e.currentView?(g.push({id:"untrash",danger:!1,onClick:()=>b().catch((e=>{H.b.error(e.message||Object(s.__)("Something went wrong when untrashing the submissions.","wp-eform"))})),title:Object(s.__)("UNTRASH","wp-eform")}),g.push({id:"delete",danger:!0,onClick:()=>new Promise(((e,t)=>{A.a.confirm({title:Object(s.__)("Dangerous operation ahead","wp-eform"),content:Object(T.jsx)("p",{style:{fontSize:"16px"},children:Object(s.__)("Submissions once deleted permanently, cannot be restored. Are you sure?","wp-eform")}),okButtonProps:{danger:!0},okText:Object(s.__)("YES","wp-eform"),cancelText:Object(s.__)("CANCEL","wp-eform"),onCancel(){A.a.destroyAll(),t()},onOk(){e(r().catch((e=>{H.b.error(e.message||Object(s.__)("Something went wrong when deleting the submissions.","wp-eform"))})))},icon:Object(T.jsx)(z.a,{})})})),title:Object(s.__)("DELETE","wp-eform")})):"all"!==e.currentView&&"owned"!==e.currentView||g.push({id:"trash",danger:!0,onClick:()=>d().catch((e=>{H.b.error(e.message||Object(s.__)("Something went wrong when trying to trash the submissions","wp-eform"))})),title:Object(s.__)("TRASH","wp-eform")}),{isDoingBulk:f,bulkActions:g}}(i),_=C.bulkActions,k=C.isDoingBulk;let S=Object(s.__)("No submissions found.","wp-eform");return""!==i.search||null!=i.filters.category||null!=i.filters.formOwner||null!=i.filters.submissionOwner?S=Object(s.__)("No submissions found, please clear some of the filters.","wp-eform"):"shared"===i.currentView?S=Object(s.__)("No submissions from shared forms with you.","wp-eform"):"trashed"===i.currentView&&(S=Object(s.__)("Trash is empty.","wp-eform")),O&&!j?Object(T.jsx)(u.a,{children:Object(T.jsx)(m.a,{description:O.message,type:"500",to:()=>{window.location.reload()},title:Object(s.__)("Server Error","wp-eform"),buttonLabel:Object(s.__)("Reload","wp-eform")})}):Object(T.jsx)(u.a,{minimal:!0,children:Object(T.jsx)(h.a,{emptyText:S,evictFieldNames:["submissions","formMeta","submissionMeta"],onMutation:c,state:i,dispatch:r,views:Oe,renderFilters:Object(T.jsx)(pe,{state:i,dispatch:r,filterData:a}),resetFilters:ye,orderBys:ve,items:null==f||null===(t=f.submissions)||void 0===t?void 0:t.edges,generatePreview:e=>{var t;const n=null==f||null===(t=f.submissions)||void 0===t?void 0:t.edges.find((t=>t.node.id===e));return Object(T.jsx)(X,{submissionId:e,token:null==n?void 0:n.node.token})},generateItemRow:e=>Object(T.jsx)(R,{item:e,state:i,dispatch:r}),getItemId:e=>e.node.id,totalItems:null==f||null===(n=f.submissions)||void 0===n?void 0:n.totalCount,loadingData:j,itemNamePlural:Object(s.__)("submissions","wp-eform"),itemNameSingular:Object(s.__)("submission","wp-eform"),isDoingBulk:k,bulkActions:_,tableModeColumns:w,renderTableCell:x})})}const xe=c.a`
	query SubmissionMetaForFilter($resourceView: ResourceViewModeEnum!) {
		submissionMeta(resourceView: $resourceView) {
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
			forms {
				formId
				formName
				total
			}
			formOwners {
				id
				username
				total
			}
		}
	}
`;function Ce(){var e,t,n;const a=Object(h.b)({initialFilters:ye,initialView:"owned",initialOrderBy:"id",initialOrderDir:"descend"}),c=Object(o.a)(a,2),b=c[0],p=c[1],f=Object(r.useMemo)((()=>({resourceView:Object(g.b)(b.currentView,ge)})),[b.currentView]),j=Object(l.b)(xe,{fetchPolicy:"no-cache",variables:f}),O=j.loading,v=j.data,y=j.error,w=j.refetch,x=Object(r.useCallback)((()=>{w(f)}),[w,f]);return Object(T.jsxs)(T.Fragment,{children:[Object(T.jsx)(d.a,{title:Object(s.__)("Submissions","wp-eform"),backLink:null,controlLeft:Object(T.jsx)(i.a,{placeholder:Object(s.__)("Filter by a form","wp-eform"),value:b.filters.formId,onChange:e=>p({type:"SET_FILTERS",payload:{filters:{...b.filters,formId:null!=e?e:null}}}),allowClear:!0,size:"small",style:{width:"300px",maxWidth:"100%"},showSearch:!0,filterOption:(e,t)=>{var n;return(null==t||null===(n=t.title)||void 0===n?void 0:n.toLowerCase().indexOf(e.toLowerCase()))>=0},loading:O,disabled:O||!(null!=v&&null!==(e=v.submissionMeta)&&void 0!==e&&null!==(t=e.forms)&&void 0!==t&&t.length),children:null!=v&&null!==(n=v.submissionMeta)&&void 0!==n&&n.forms&&v.submissionMeta.forms.length?v.submissionMeta.forms.map((e=>{var t;return Object(T.jsxs)(i.a.Option,{value:e.formId,title:null!==(t=e.formName)&&void 0!==t?t:Object(s.__)("Unknown form","wp-eform"),children:[Object(T.jsx)(h.a.Badge,{children:e.total}),e.formName]},e.formId)})):Object(T.jsx)(i.a.Option,{value:"",title:"",children:Object(s.__)("please wait...","wp-eform")})}),controlRight:Object(T.jsx)(h.a.DisplayModeUI,{state:b,dispatch:p})}),y&&!O?Object(T.jsx)(u.a,{children:Object(T.jsx)(m.a,{description:y.message,type:"500",to:()=>{window.location.reload()},title:Object(s.__)("Server Error","wp-eform"),buttonLabel:Object(s.__)("Reload","wp-eform")})}):Object(T.jsx)(we,{filterData:v,state:b,dispatch:p,onMutation:x})]})}}}]);
//# sourceMappingURL=13-7a76a852.js.map