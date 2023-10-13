var loadFile = function (event) {
    var image = document.getElementById("output");
    image.src = URL.createObjectURL(event.target.files[0]);

    // Send the image to the server
    saveImageToServer(event.target.files[0]);
};

function saveImageToServer(file) {
    var formData = new FormData();
    formData.append('avatar', file);

    fetch('/save-avatar', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // For Laravel CSRF protection
        }
    })
        .then(response => response.json())
        .then(data => {
        //    console.log(data);
            // Handle server response here (e.g., showing a success message)
        })
        .catch(error => {
            console.error('Error:', error);
            // Handle errors here (e.g., showing an error message to the user)
        });
}
