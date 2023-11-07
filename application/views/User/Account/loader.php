<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		body {
 background-color: #FFFCF9;
 overflow: hidden;
 text-align:center;
  display: flex;
  align-items: center;
  justify-content: center; 
}

body,
html {
 height: 100%;
 width: 100%;
 margin: 0;
 padding: 0;
}

svg {
 width: 100%;
 height: 100%;
 visibility: hidden;
 
}
	</style>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
		<svg id="mainSVG" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 600">
  <g >
     <polyline id="bridge1" points="345 315 345 278 385 278 385 322 425 322 425 285" fill="none" stroke="#d0ff55" stroke-miterlimit="10" stroke-width="6"/>
    <polyline id="bridge2" points="355 285 355 322 395 322 395 278 435 278 435 315" fill="none" stroke="#d0ff55" stroke-miterlimit="10" stroke-width="6"/>
    <polyline id="bridge3" points="365 315 365 278 405 278 405 322 445 322 445 285" fill="none" stroke="#d0ff55" stroke-miterlimit="10" stroke-width="6"/>
    <polyline id="bridge4" points="375 285 375 322 415 322 415 278 455 278 455 315" fill="none" stroke="#d0ff55" stroke-miterlimit="10" stroke-width="6"/> 		
  </g>
</svg>
<script type="text/javascript" src="https://unpkg.co/gsap@3/dist/gsap.min.js"></script>
<script type="text/javascript" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/16327/DrawSVGPlugin3.min.js"></script>
<script type="text/javascript" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/35984/ScrubGSAPTimeline_3_0.js"></script>
<script type="text/javascript">
	gsap.config({trialWarn: false});
let select = s => document.querySelector(s),
		selectAll = s =>  document.querySelectorAll(s),
		toArray = s => gsap.utils.toArray(s),
		mainSVG = select('#mainSVG'),
		colorArray = ["#724e91","#e54f6d","#0ad3ff","#f8c630"]


gsap.set('svg', {
	visibility: 'visible'
})
gsap.set('polyline', {
	stroke: gsap.utils.wrap(colorArray)
})
gsap.set('g', {
	scale: 2,
	transformOrigin: '-100% 50%'
})
let mainTl = gsap.timeline({
	defaults: {
		duration: 1
	},
		repeat: -1
});
mainTl.from('polyline', {
		drawSVG: '0% 15%',
		ease: 'back.in(0.5)',
	stagger: {
		each: 0.4,
		//repeat: -1,
	repeatDelay: 1,
	},
		//repeat: -1,
	//repeatDelay: 
	
})
 console.log(mainTl.duration())
mainTl.to('polyline', {
		drawSVG: '85% 100%',
		ease: 'back(0.3)',
	stagger: {
		each: 0.4,
		//repeat: -1,
	repeatDelay: 1,
	}	,
		//repeat: -1,
}, 0.65)
console.log(mainTl.duration())
mainTl.to('g', {
	duration: mainTl.duration(),
	x: -160,
	ease: 'none',
	//repeat: -1
}, 0) /**/

//ScrubGSAPTimeline(mainTl)
</script>
</body>
</html>
<