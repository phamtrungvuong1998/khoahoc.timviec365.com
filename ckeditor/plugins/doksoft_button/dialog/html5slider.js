(function(){var m=document.createElement("input");try{m.type="range";if(m.type=="range"){return;}}catch(l){return;}m.style.background="linear-gradient(red, red)";if(!m.style.backgroundImage||!("MozAppearance" in m.style)){return;}var g;var j=navigator.platform=="MacIntel";var a={radius:j?9:6,width:j?22:12,height:j?16:20};var d="linear-gradient(transparent "+(j?"6px, #999 6px, #999 7px, #ccc 8px, #bbb 9px, #bbb 10px, transparent 10px":"9px, #999 9px, #bbb 10px, #fff 11px, transparent 11px")+", transparent)";var o={"min-width":a.width+"px","min-height":a.height+"px","max-height":a.height+"px",padding:"0 0 "+(j?"2px":"1px"),border:0,"border-radius":0,cursor:"default","text-indent":"-999999px"};var p={attributes:true,attributeFilter:["min","max","step","value"]};var i=document.createEvent("HTMLEvents");i.initEvent("input",true,false);var k=document.createEvent("HTMLEvents");k.initEvent("change",true,false);if(document.readyState=="loading"){document.addEventListener("DOMContentLoaded",h,true);}else{h();}addEventListener("pageshow",n,true);function h(){n();new MutationObserver(function(e){e.forEach(function(q){if(q.addedNodes){Array.forEach(q.addedNodes,function(r){if(!(r instanceof Element)){}else{if(r.childElementCount){Array.forEach(r.querySelectorAll("input[type=range]"),c);}else{if(r.mozMatchesSelector("input[type=range]")){c(r);}}}});}});}).observe(document,{childList:true,subtree:true});}function n(){Array.forEach(document.querySelectorAll("input[type=range]"),c);}function c(e){if(e.type!="range"){f(e);}}function f(H){var x,N,F,M,J,K,w;var I,L,z,E,G=H.value;if(!g){g=document.body.appendChild(document.createElement("hr"));b(g,{"-moz-appearance":j?"scale-horizontal":"scalethumb-horizontal",display:"block",visibility:"visible",opacity:1,position:"fixed",top:"-999999px"});document.mozSetImageElement("__sliderthumb__",g);}var s=function(){return""+G;};var r=function r(O){G=""+O;x=true;B();delete H.value;H.value=G;H.__defineGetter__("value",s);H.__defineSetter__("value",r);};H.__defineGetter__("value",s);H.__defineSetter__("value",r);Object.defineProperty(H,"type",{get:function(){return"range";}});["min","max","step"].forEach(function(O){if(H.hasAttribute(O)){N=true;}Object.defineProperty(H,O,{get:function(){return this.hasAttribute(O)?this.getAttribute(O):"";},set:function(P){P===null?this.removeAttribute(O):this.setAttribute(O,P);}});});H.readOnly=true;b(H,o);A();new MutationObserver(function(O){O.forEach(function(P){if(P.attributeName!="value"){A();N=true;}else{if(!x){G=H.getAttribute("value");B();}}});}).observe(H,p);H.addEventListener("mousedown",y,true);H.addEventListener("keydown",t,true);H.addEventListener("focus",v,true);H.addEventListener("blur",C,true);function y(Q){M=true;setTimeout(function(){M=false;},0);if(Q.button||!E){return;}var P=parseFloat(getComputedStyle(this).width);var R=(P-a.width)/E;if(!R){return;}var O=Q.clientX-this.getBoundingClientRect().left-a.width/2-(G-I)*R;if(Math.abs(O)>a.radius){F=true;this.value-=-O/R;}K=G;w=Q.clientX;this.addEventListener("mousemove",D,true);this.addEventListener("mouseup",q,true);}function D(P){var O=parseFloat(getComputedStyle(this).width);var Q=(O-a.width)/E;if(!Q){return;}K+=(P.clientX-w)/Q;w=P.clientX;F=true;this.value=K;}function q(){this.removeEventListener("mousemove",D,true);this.removeEventListener("mouseup",q,true);H.dispatchEvent(i);H.dispatchEvent(k);}function t(O){if(O.keyCode>36&&O.keyCode<41){v.call(this);F=true;this.value=G+(O.keyCode==38||O.keyCode==39?z:-z);}}function v(){if(!M){this.style.boxShadow=!j?"0 0 0 2px #fb0":"inset 0 0 20px rgba(0,127,255,.1), 0 0 1px rgba(0,127,255,.4)";}}function C(){this.style.boxShadow="";}function u(O){return !isNaN(O)&&+O==parseFloat(O);}function A(){I=u(H.min)?+H.min:0;L=u(H.max)?+H.max:100;if(L<I){L=I>100?I:100;}z=u(H.step)&&H.step>0?+H.step:1;E=L-I;B(true);}function e(){if(!x&&!N){G=H.getAttribute("value");}if(!u(G)){G=(I+L)/2;}G=Math.round((G-I)/z)*z+I;if(G<I){G=I;}else{if(G>L){G=I+~~(E/z)*z;}}}function B(R){e();var Q=F;F=false;if(Q&&G!=J){H.dispatchEvent(i);}if(!R&&G==J){return;}J=G;var O=E?(G-I)/E*100:0;var P="-moz-element(#__sliderthumb__) "+O+"% no-repeat, ";b(H,{background:P+d});}}function b(e,q){for(var r in q){e.style.setProperty(r,q[r],"important");}}})();