function show(target) {
    document.getElementById(target).style.display = 'block';
}

function hide(target) {
    document.getElementById(target).style.display = 'none';
}
 $('#overlay_div').click(function(){
document.getElementById("mySidenav").style.width = "0";
});

function openNav() {
      document.getElementById("mySidenav").style.width = "420px";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}