// var input = document.getElementById("selectAvatar");
// var avatar = document.getElementById("avatar");  

var convertBase64 = (file) => {
    return new Promise((resolve, reject) => {
        var fileReader = new FileReader();
        fileReader.readAsDataURL(file);

        fileReader.onload = () => {
            resolve(fileReader.result);
        };

        fileReader.onerror = (error) => {
            reject(error);
        };
    });
};

var uploadImage = async (event) => {
    var file = event.target.files[0];
    var base64 = await convertBase64(file);
    img_foto.src = base64; 
};

// Cara pkae
// var input_foto = document.getElementById("logo");
// var img_foto = document.getElementById("img_logo"); 
// input_foto.addEventListener("change", (e) => {
//     uploadImage(e);
// });