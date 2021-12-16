function getImageSrc(files, defaultImage) {
    if (files.length > 0) {

        const fileReader = new FileReader();
        fileReader.onload = function (event) {
            console.log("event.target.result ", event.target.result);
            return event.target.result;
        }
        fileReader.readAsDataURL(files[0]);
    }
    else {
        return `/storage/image/${defaultImage || "noImage.jpeg"}`;
    }
}