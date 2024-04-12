function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function(){
        var output = document.getElementById('imageContainer');
        output.innerHTML = '<img src="' + reader.result + '" alt="Choose image">';
    };
    reader.readAsDataURL(event.target.files[0]);
}

function setDefaultImage(src) {
    var output = document.getElementById('imageContainer');
    output.innerHTML = '<img src="' + src + '" alt="Default Image">';
}

function showDefaultImages() {
    var defaultImages = document.getElementById('defaultImages');
    if (defaultImages.style.display === "none") {
        defaultImages.style.display = "flex";
    } else {
        defaultImages.style.display = "none";
    }
}
