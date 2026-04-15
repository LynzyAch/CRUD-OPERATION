const apiContainer = document.getElementById('api-contain');
const searchForm = document.getElementById('search-form');
const searchInput = document.getElementById('search-input');

async function fetchAudioData(searchTerm) {
    try {
        const response = await fetch(`https://itunes.apple.com/search?term=${encodeURIComponent(searchTerm)}&limit=30`);
        const data = await response.json();

        const results = data.results;

        if (results.length === 0) {
            apiContainer.innerHTML = `<h4 class="text-light text-center w-100 mt-5">No signals found for "${searchTerm}"</h4>`;
            return;
        }

        let htmlContent = '<div class="row g-4">';

        results.forEach(item => {
            const title = item.trackName || item.collectionName || 'Unknown Transmission';
            const artist = item.artistName || 'Unknown Source';
            const genre = item.primaryGenreName || item.kind || 'Classified';
            const preview = item.previewUrl;

            const image = item.artworkUrl100 ? item.artworkUrl100.replace('100x100bb', '300x300bb') : 'https://via.placeholder.com/300';

            htmlContent += `
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="country-card">
                        <img src="${image}" alt="Cover" class="country-flag">
                        <h4 class="country-name" title="${title}">${title}</h4>
                        <div class="country-details">
                            <p><strong>Source:</strong> ${artist}</p>
                            <p><strong>Class:</strong> ${genre}</p>
                        </div>
                        
                        ${preview
                    ? `<audio controls src="${preview}" class="w-100 mt-3" style="height: 35px; outline: none; opacity: 0.8;"></audio>`
                    : `<p class="text-warning mt-3 mb-0" style="font-size: 12px; text-align: center;">* Audio feed restricted</p>`
                }
                    </div>
                </div>
            `;
        });

        htmlContent += '</div>';
        apiContainer.innerHTML = htmlContent;

    } catch (error) {
        console.error("Fetch error:", error);
        apiContainer.innerHTML = `<h3 class="text-danger text-center">System Error: No Internet Connection</h3>`;
    }
}

if (searchForm) {
    searchForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const term = searchInput.value.trim();
        if (term !== "") {
            apiContainer.innerHTML = `<h4 class="text-light text-center w-100 mt-5">Searching for "${term}"...</h4>`;
            fetchAudioData(term);
        }
    });
}

fetchAudioData('Linkin Park');

// Under Development Pop-up
function portfolio() {
    Swal.fire({
        title: "Portfolio?",
        text: "My Portfolio is under development proccess, stay tuned.",
        icon: "info"
    });
}

// --- Modal Data Population for Edit Feature ---
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-btn');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const email = this.getAttribute('data-email');
            const status = this.getAttribute('data-status');

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-fullname').value = name;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-status').value = status;
        });
    });
});

// handle input fields if empty or not
function getSearch(event) {
    const fields = ["to", "subject", "message"];
    let isEmpty = false;

    fields.forEach(id => {
        const field = document.getElementById(id);
        if (field.value.trim() === "") {
            isEmpty = true;
        }
    });

    if (isEmpty) {
        event.preventDefault();
        Swal.fire({
            title: "Empty Fields",
            text: "Please enter all fields before you proceed!",
            icon: "warning"
        });
    } else {
        const btn = event.target;
        btn.innerHTML = 'Sending...';
        btn.style.opacity = '0.5';
    }
}

document.addEventListener('play', function(e) {
    const allAudios = document.querySelectorAll('audio');
    
    allAudios.forEach(audio => {
        if (audio !== e.target) {
            audio.pause();
        }
    });
}, true);