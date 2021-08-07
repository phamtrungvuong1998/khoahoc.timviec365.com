function v_action_list(n) {
	console.log(document.getElementById('action'+n).style.display);
	if (document.getElementById('action'+n).style.display == "block") {
		document.getElementById('action'+n).style.display = "none";
	}else{
		document.getElementById('action'+n).style.display = "block";
	}
}