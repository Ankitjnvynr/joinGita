// Function to convert HTML element to image
function htmlToImage(element) {
    return new Promise(resolve => {
        html2canvas(element, { scale: 2 }).then(canvas => {
            resolve(canvas.toDataURL('image/png'));
        });
    });
}



// Event listener for download button click
document.getElementById('downloadButton').addEventListener('click', async (e) => {
    oldhtml = document.getElementById('downloadButton').innerHTML;
    document.getElementById('downloadButton').innerHTML =`<span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
  <span role="status">Creating Card...</span>`
    const studentIDCard = document.getElementById('studentIDCard');
    const dataUrl = await htmlToImage(studentIDCard);
    downloadImage(dataUrl);
    document.getElementById('downloadButton').innerHTML = oldhtml;
});

