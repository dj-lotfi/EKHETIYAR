document.getElementById("<?php echo $modalId; ?>").getElementsByClassName("close")[0].onclick = function() {

    document.getElementById("<?php echo $modalId; ?>").style.display = "none";
};
document.getElementById("<?php echo $buttonId; ?>").onclick = function() {
    
    document.getElementById("<?php echo $modalId; ?>").style.display = "block";
};