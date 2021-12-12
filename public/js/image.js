function previewImage(defaultImage) {
    const files = document.getElementById("image").files;
    if (files.length > 0) {

        const fileReader = new FileReader();
        fileReader.onload = function (event) {
            document.getElementById("preview").setAttribute("src", event.target.result);
        }
        fileReader.readAsDataURL(files[0]);
    }
    else {
        document.getElementById("preview").setAttribute("src", `/storage/image/${defaultImage || "noImage.jpeg"}`);
    }
}