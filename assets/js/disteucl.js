<script type="text/javascript">
function disteucl(x1, y1, x2, y2){

	x1=0.017453292519943*x1;
	x2=0.017453292519943*x2;
	y1=0.017453292519943*y1;
	y2=0.017453292519943*y2;
	var dist=6367445*Math.acos(Math.sin(x1)*Math.sin(x2)+Math.cos(x1)*Math.cos(x2)*Math.cos(y2-y1));
	alert(dist);
}


disteucl(44.933393,4.892360000000053,44.735269,4.599038999999948);
</script>
