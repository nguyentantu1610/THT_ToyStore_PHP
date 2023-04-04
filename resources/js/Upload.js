const CLOUDINARY_URL = 'https://api.cloudinary.com/v1_1/ddt8drwas/upload';
const CLOUDINARY_UPLOAD_PRESET = 'qtajqz06';
const image = document.querySelector('#fileupload');
image.addEventListener('change', (e) => {

    const file = e.target.files[0];

    const formData = new FormData();
    formData.append('file', file);
    formData.append('upload_preset', CLOUDINARY_UPLOAD_PRESET);

    fetch(CLOUDINARY_URL, {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then((data) => {
            if (data.secure_url !== '') {
                const uploadedFileUrl = data.secure_url;
                localStorage.setItem('passportUrl', uploadedFileUrl)
                var url = data.secure_url;
                document.getElementById('productImage').value = url;
                document.getElementById('id').src = url;


            }
            else { alert('upload thất bại'); }
        })
        .catch(err => console.error(err));
});