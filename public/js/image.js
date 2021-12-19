function setImageSrc(files, defaultImage, setImagePreview) {
    if (files.length > 0) {

        const fileReader = new FileReader();
        fileReader.onload = function (event) {
            setImagePreview(event.target.result);
        }
        fileReader.readAsDataURL(files[0]);
    }
    else {
        setImagePreview(`/storage/image/${defaultImage || "noImage.jpeg"}`);
    }
}