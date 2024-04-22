// Function to convert HTML element to image
function htmlToImage(element) {
    return new Promise(resolve => {
        html2canvas(element, { scale: 3 }).then(canvas => {
            resolve(canvas.toDataURL('image/png'));
        });
    });
}



// Event listener for download button click
document.getElementById('downloadButton').addEventListener('click', async () => {
    const studentIDCard = document.getElementById('studentIDCard');
    const dataUrl = await htmlToImage(studentIDCard);
    downloadImage(dataUrl);
});

