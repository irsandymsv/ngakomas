var pic = "<?php echo $_SESSION["+"user"+"]->picture ?>" ;
if (pic == "") {
	$('#pic').attr('src', '../img/profil.png');
} else {
	$('#pic').attr('src', "../"+pic);
}