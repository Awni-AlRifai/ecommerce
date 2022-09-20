var loadFile = function(event) {
    var output = document.getElementById('image-preview');
    var btn = document.getElementById('select-file-btn');
    btn.style.display = "none";
    output.style.display = "block";
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};